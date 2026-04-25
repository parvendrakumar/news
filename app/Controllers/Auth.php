<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return session()->get('role_id') == 1 ? redirect()->to('admin/dashboard') : redirect()->to('user/dashboard');
        }

        // Check if we need to show CAPTCHA (after 2 failed attempts in this session)
        $failedAttempts = $this->session->get('login_failed_attempts') ?? 0;
        $showCaptcha = $failedAttempts >= 2;

        $captchaCode = null;
        if ($showCaptcha) {
            $captchaCode = rand(1000, 9999);
            $this->session->set('login_captcha_code', $captchaCode);
        }

        return view('auth/login', [
            'showCaptcha' => $showCaptcha,
            'captchaCode' => $captchaCode,
            'isAuthPage'  => true
        ]);
    }

    public function attemptLogin()
    {
        $throttler = \Config\Services::throttler();
        
        // 1. Rate Limiting (5 attempts per minute per IP)
        if ($throttler->check($this->request->getIPAddress(), 5, 60) === false) {
            return redirect()->back()->withInput()->with('error', 'Too many attempts. Please try again in 1 minute.');
        }

        $rules = [
            'email'    => 'required|valid_email|trim',
            'password' => 'required',
        ];

        // 2. CAPTCHA Check (triggered after 2 failed attempts in this session)
        $sessionFailed = $this->session->get('login_failed_attempts') ?? 0;
        if ($sessionFailed >= 2) {
            $rules['captcha'] = 'required';
            $submittedCaptcha = $this->request->getPost('captcha');
            $sessionCaptcha = $this->session->get('login_captcha_code');
            
            // Only check if they actually submitted something (avoid premature error on 2nd fail transition)
            if ($submittedCaptcha !== null && $submittedCaptcha != $sessionCaptcha) {
                return redirect()->back()->withInput()->with('error', 'Invalid Security Code. Please try again.');
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $ipAddress = $this->request->getIPAddress();
        $userAgent = $this->request->getUserAgent()->getAgentString();

        // 5. Suspicious Activity Detection (Rapid attempts from same IP for different users)
        $logModel = new \App\Models\LoginLogModel();
        $recentAttemptsCount = $logModel->where('ip_address', $ipAddress)
                                        ->where('attempted_at >', date('Y-m-d H:i:s', strtotime('-1 minute')))
                                        ->countAllResults();
        
        if ($recentAttemptsCount > 10) { // Too many attempts for ANY users from this IP
            log_message('critical', "Suspicious activity detected from IP: $ipAddress. Multiple users login try.");
            // Optionally block IP in DB
            $db = \Config\Database::connect();
            $db->table('blocked_ips')->insert([
                'ip_address' => $ipAddress,
                'reason' => 'Multiple rapid login attempts',
                'blocked_until' => date('Y-m-d H:i:s', strtotime('+30 minutes'))
            ]);
            return redirect()->back()->withInput()->with('error', 'Suspicious activity detected. Your IP has been temporarily blocked.');
        }

        // Check if IP is blocked
        $db = \Config\Database::connect();
        $blocked = $db->table('blocked_ips')->where('ip_address', $ipAddress)->where('blocked_until >', date('Y-m-d H:i:s'))->get()->getRow();
        if ($blocked) {
            return redirect()->back()->withInput()->with('error', 'Your IP is currently blocked until ' . $blocked->blocked_until);
        }

        $user = $this->userModel->where('email', $email)->first();

        // 14. Disable Username Enumeration (Generic "Invalid credentials")
        $genericError = 'Invalid email or password.';

        if (!$user) {
            $this->logLogin(null, $email, 'failed');
            $this->incrementSessionFailed();
            return redirect()->back()->withInput()->with('error', $genericError);
        }

        // 17. IP Whitelist (Admin) - Optional setting
        /*
        if ($user['role_id'] == 1) { // Admin
            $allowedIPs = ['127.0.0.1', '::1', '192.168.29.202']; // Example whitelist
            if (!in_array($ipAddress, $allowedIPs)) {
                log_message('alert', "Admin login attempt from unauthorized IP: $ipAddress for user: $email");
                return redirect()->back()->withInput()->with('error', 'Unauthorized access location.');
            }
        }
        */

        // 6. Account Lock Check
        if ($user['locked_until'] && $user['locked_until'] > date('Y-m-d H:i:s')) {
            $diff = strtotime($user['locked_until']) - time();
            $mins = ceil($diff / 60);
            return redirect()->back()->withInput()->with('error', "Account is locked due to multiple failed attempts. Try again in $mins minutes.");
        }

        if (password_verify($password, $user['password'])) {
            // Success!
            
            if (($user['status'] ?? 'active') === 'inactive') {
                return redirect()->back()->withInput()->with('error', 'Your account has been deactivated. Please contact an administrator.');
            }

            // 4. Device / Browser Tracking Alert
            if ($user['last_ip'] && ($user['last_ip'] !== $ipAddress || $user['last_user_agent'] !== $userAgent)) {
                // 13. Login Alerts (New device alert)
                log_message('warning', "New device/IP login detected for user: $email. Old IP: {$user['last_ip']}, New IP: $ipAddress");
                // In a real app, send an email alert here.
                $this->session->setFlashdata('warning', 'Security Alert: We detected a login from a new device or location.');
            }

            // Reset failed attempts
            $this->userModel->update($user['id'], [
                'failed_attempts' => 0,
                'locked_until' => null,
                'last_login' => date('Y-m-d H:i:s'),
                'last_ip' => $ipAddress,
                'last_user_agent' => $userAgent,
            ]);

            $this->session->remove('login_failed_attempts');
            $this->logLogin($user['id'], $email, 'success');

            // 8. Session Regeneration
            session()->regenerate(true);

            // 3. Two-Factor Authentication (OTP)
            // Especially for admin (role_id 1) or if 2FA is enabled
            if ($user['role_id'] == 1 || ($user['two_factor_enabled'] ?? false)) {
                return $this->initiate2FA($user);
            }

            $this->setSession($user);
            return session()->get('role_id') == 1 ? redirect()->to('admin/dashboard') : redirect()->to('user/dashboard');
        } else {
            // Failed password
            $this->logLogin($user['id'], $email, 'failed');
            $this->incrementSessionFailed();

            // Increment DB failed attempts and lock if reach 5
            $newFailedCount = ($user['failed_attempts'] ?? 0) + 1;
            $updateData = ['failed_attempts' => $newFailedCount];
            if ($newFailedCount >= 5) {
                // 6. Account Lock (10 minutes)
                $updateData['locked_until'] = date('Y-m-d H:i:s', strtotime('+10 minutes'));
                log_message('error', "Account locked for user $email due to 5 failed attempts.");
            }
            $this->userModel->update($user['id'], $updateData);

            return redirect()->back()->withInput()->with('error', $genericError);
        }
    }

    private function logLogin($userId, $email, $status)
    {
        $logModel = new \App\Models\LoginLogModel();
        $logModel->save([
            'user_id' => $userId,
            'email' => $email,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'status' => $status,
        ]);
    }

    private function incrementSessionFailed()
    {
        $count = $this->session->get('login_failed_attempts') ?? 0;
        $this->session->set('login_failed_attempts', $count + 1);
    }

    private function initiate2FA($user)
    {
        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $this->userModel->update($user['id'], [
            'otp_code' => $otp,
            'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
        ]);

        // Log for development
        log_message('info', "OTP for user {$user['email']}: $otp");

        // Actually send OTP via enabled channels
        $emailSent = $this->sendEmailOtp($user['email'], $otp);
        
        // SMS sending (if mobile exists and SMS is active)
        $smsSent = false;
        if (!empty($user['mobile_number'])) { // Assuming mobile_number might exist or be added
            $smsSent = $this->sendSmsOtp($user['mobile_number'], $otp);
        }

        $this->session->set('temp_user_id', $user['id']);
        
        $message = "A verification code has been sent to your registered email.";
        if ($smsSent) {
            $message = "A verification code has been sent to your registered email and mobile.";
        }

        if ($emailSent || $smsSent) {
            return redirect()->to('auth/verify-otp')->with('success', $message);
        }

        return redirect()->to('auth/verify-otp')->with('warning', 'OTP generated but delivery failed. Please check system logs for the code.');
    }

    public function verifyOtp()
    {
        if (!$this->session->get('temp_user_id')) {
            return redirect()->to('login');
        }
        return view('auth/verify_otp', ['isAuthPage' => true]);
    }

    public function resendOtp()
    {
        $userId = $this->session->get('temp_user_id');
        if (!$userId) {
            return redirect()->to('login');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to('login');
        }

        // Generate and save fresh OTP
        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $this->userModel->update($userId, [
            'otp_code' => $otp,
            'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
        ]);

        if ($this->sendEmailOtp($user['email'], $otp)) {
            return redirect()->back()->with('success', 'A new verification code has been sent.');
        }

        return redirect()->back()->with('error', 'Failed to resend code. Please check your connection.');
    }

    public function attemptVerifyOtp()
    {
        $userId = $this->session->get('temp_user_id');
        $otp = $this->request->getPost('otp');
        
        log_message('debug', "OTP Verification attempt. UserID: ".($userId ?? 'NULL').", Submitted OTP: $otp, SessionID: ".session_id());

        if (!$userId) {
            log_message('error', "OTP Verification failed: No temp_user_id in session.");
            return redirect()->to('login')->with('error', 'Session expired. Please try again.');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            log_message('error', "OTP Verification failed: User not found for ID $userId.");
            return redirect()->to('login')->with('error', 'User not found.');
        }

        $now = time();
        $expires = strtotime($user['otp_expires_at']);
        
        log_message('debug', "User OTP in DB: {$user['otp_code']}, Expires: {$user['otp_expires_at']} ($expires), Now: $now");

        if ($user['otp_code'] === $otp && $expires > $now) {
            $this->userModel->update($userId, ['otp_code' => null, 'otp_expires_at' => null]);
            $this->session->remove('temp_user_id');
            $this->setSession($user);
            return session()->get('role_id') == 1 ? redirect()->to('admin/dashboard') : redirect()->to('user/dashboard');
        }

        log_message('warning', "OTP Verification failed: Mismatch or expired. Match: ".($user['otp_code'] === $otp ? 'YES' : 'NO').", Valid Time: ".($expires > $now ? 'YES' : 'NO'));
        return redirect()->back()->with('error', 'Invalid or expired OTP.');
    }


    public function register()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('admin/dashboard');
        }
        return view('auth/register', ['isAuthPage' => true]);
    }

    public function loginOtp()
    {
        return view('auth/login_otp', ['isAuthPage' => true]);
    }

    public function sendLoginOtp()
    {
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'No account found with that email address.');
        }

        if (($user['status'] ?? 'active') === 'inactive') {
            return redirect()->back()->with('error', 'Your account has been deactivated.');
        }

        // Generate and save OTP
        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $this->userModel->update($user['id'], [
            'otp_code' => $otp,
            'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes'))
        ]);

        // Send OTP via Email
        if (!$this->sendEmailOtp($user['email'], $otp)) {
            // If it returns false, it means SMTP is inactive or delivery failed
            // But we already logged the error inside sendEmailOtp
            return redirect()->back()->with('error', 'Failed to send verification code. Please contact support or check system logs.');
        }

        $this->session->set('temp_user_id', $user['id']);
        return redirect()->to('auth/verify-otp')->with('success', 'A login code has been sent to your email.');
    }
    private function sendEmailOtp($to, $otp)
    {
        log_message('error', "Executing sendEmailOtp for: $to with OTP: $otp");
        
        $db = \Config\Database::connect();
        $smtp = $db->table('smtp_settings')->where('is_active', 1)->get()->getRowArray();

        if (!$smtp) {
            log_message('error', "SMTP settings not found or not active in database.");
            return false;
        }

        // Real email sending logic
        $emailService = \Config\Services::email();
        
        $config = [
            'protocol'   => 'smtp',
            'SMTPHost'   => $smtp['smtp_host'],
            'SMTPPort'   => (int)$smtp['smtp_port'],
            'SMTPUser'   => $smtp['smtp_user'],
            'SMTPPass'   => $smtp['smtp_pass'],
            'SMTPCrypto' => $smtp['smtp_crypto'] != 'none' ? $smtp['smtp_crypto'] : '',
            'mailType'   => 'html',
            'charset'    => 'utf-8',
            'newline'    => "\r\n",
            'fromEmail'  => $smtp['from_email'],
            'fromName'   => $smtp['from_name']
        ];
        
        // Fetch dynamic template
        $template = $db->table('broadcast_templates')
                       ->where('template_name', 'OTP Verification')
                       ->where('is_active', 1)
                       ->get()->getRowArray();

        // Fetch dynamic logo from settings
        $siteLogo = $db->table('settings')->where('key', 'site_logo')->get()->getRowArray();
        $logoFile = !empty($siteLogo['value']) ? $siteLogo['value'] : 'logo.png';
        $logoUrl = base_url('uploads/settings/' . $logoFile);

        $subject = $template ? str_replace('{otp}', $otp, $template['subject']) : 'Your Secure Login Code';
        $message = $template ? str_replace(['{otp}', '{logo}'], [$otp, $logoUrl], $template['content']) : "Your secure login code is: <b>$otp</b>. It will expire in 5 minutes.";

        $emailService->initialize($config);
        $emailService->setTo($to);
        $emailService->setSubject($subject);
        $emailService->setMessage($message);
        
        if ($emailService->send()) {
            log_message('error', "SUCCESS: Email sent to $to");
            return true;
        } else {
            $debugger = $emailService->printDebugger(['headers', 'subject', 'body']);
            log_message('error', "FAILURE: Email sending failed to $to. Debugger info: " . $debugger);
            return false;
        }
    }

    private function sendSmsOtp($mobile, $otp)
    {
        $db = \Config\Database::connect();
        $sms = $db->table('sms_settings')->where('is_active', 1)->get()->getRowArray();

        if (!$sms || empty($sms['api_url'])) {
            return false;
        }

        // Fetch template
        $template = $db->table('broadcast_templates')
                       ->where('template_name', 'OTP Verification')
                       ->where('is_active', 1)
                       ->get()->getRowArray();

        $message = $template ? str_replace('{otp}', $otp, $template['subject'] . ": " . $otp) : "Your secure OTP is: $otp";

        $params = [
            'apikey'    => $sms['api_key'],
            'sender'    => $sms['sender_id'],
            'mobile'    => $mobile,
            'message'   => $message,
            'entityid'  => $sms['entity_id'],
            'templateid' => $sms['template_id']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sms['api_url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            log_message('error', "SMS Failure to $mobile: $err");
            return false;
        }

        log_message('info', "SMS Success to $mobile: $response");
        return true;
    }

    public function attemptRegister()
    {
        // 12. Password Policy (Min 8, 1 upper, 1 number, 1 special)
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => [
                'rules'  => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'errors' => [
                    'regex_match' => 'Password must contain at least one uppercase letter, one number, and one special character.',
                    'min_length'  => 'Password must be at least 8 characters long.'
                ]
            ],
            'confirm_password' => 'matches[password]',
            'full_name' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'full_name' => $this->request->getPost('full_name'),
            'role_id'   => 3, // Default to Reporter
            'password_updated_at' => date('Y-m-d H:i:s')
        ];

        $this->userModel->save($data);

        return redirect()->to('login')->with('success', 'Registration successful! Please login.');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            // Generic message for security
            return redirect()->back()->with('success', 'If your email exists in our system, you will receive a reset link shortly.');
        }

        $token = bin2hex(random_bytes(32));
        $this->userModel->update($user['id'], [
            'reset_token' => $token,
            'reset_expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ]);

        $resetLink = base_url("auth/reset-password/$token");
        
        // Log for development
        log_message('info', "Password reset link for $email: $resetLink");
        
        // Reusing the SMTP helper logic
        $this->sendEmailReset($email, $resetLink);

        return redirect()->back()->with('success', 'If your email exists in our system, you will receive a reset link shortly.');
    }

    private function sendEmailReset($to, $link)
    {
        $db = \Config\Database::connect();
        $smtp = $db->table('smtp_settings')->where('is_active', 1)->get()->getRowArray();

        if ($smtp) {
            $emailService = \Config\Services::email();
            $config = [
                'protocol'   => 'smtp',
                'SMTPHost'   => $smtp['smtp_host'],
                'SMTPPort'   => (int)$smtp['smtp_port'],
                'SMTPUser'   => $smtp['smtp_user'],
                'SMTPPass'   => $smtp['smtp_pass'],
                'SMTPCrypto' => $smtp['smtp_crypto'] != 'none' ? $smtp['smtp_crypto'] : '',
                'mailType'   => 'html',
                'charset'    => 'utf-8',
                'newline'    => "\r\n",
                'fromEmail'  => $smtp['from_email'],
                'fromName'   => $smtp['from_name']
            ];
            // Fetch dynamic template
            $template = $db->table('broadcast_templates')
                           ->where('template_name', 'Password Reset')
                           ->where('is_active', 1)
                           ->get()->getRowArray();

            // Fetch dynamic logo from settings
            $siteLogo = $db->table('settings')->where('key', 'site_logo')->get()->getRowArray();
            $logoFile = !empty($siteLogo['value']) ? $siteLogo['value'] : 'logo.png';
            $logoUrl = base_url('uploads/settings/' . $logoFile);

            $subject = $template ? $template['subject'] : 'Password Reset Request - City News';
            $message = $template ? str_replace(['{link}', '{logo}'], [$link, $logoUrl], $template['content']) : "Click the following link to reset your password: <a href='$link'>$link</a>. This link will expire in 1 hour.";

            $emailService->initialize($config);
            $emailService->setTo($to);
            $emailService->setSubject($subject);
            $emailService->setMessage($message);
            $emailService->send();
        }
    }

    public function resetPassword($token)
    {
        $user = $this->userModel->where('reset_token', $token)
                                ->where('reset_expires_at >', date('Y-m-d H:i:s'))
                                ->first();

        if (!$user) {
            return redirect()->to('login')->with('error', 'Invalid or expired reset token.');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    public function attemptResetPassword()
    {
        $token = $this->request->getPost('token');
        $user = $this->userModel->where('reset_token', $token)
                                ->where('reset_expires_at >', date('Y-m-d H:i:s'))
                                ->first();

        if (!$user) {
            return redirect()->to('login')->with('error', 'Invalid or expired reset token.');
        }

        // Strict Password Policy
        $rules = [
            'password' => [
                'rules'  => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'errors' => [
                    'regex_match' => 'Password must contain at least one uppercase letter, one number, and one special character.',
                    'min_length'  => 'Password must be at least 8 characters long.'
                ]
            ],
            'confirm_password' => 'matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($user['id'], [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'password_updated_at' => date('Y-m-d H:i:s'),
            'reset_token' => null,
            'reset_expires_at' => null
        ]);

        return redirect()->to('login')->with('success', 'Password reset successful! Please login.');
    }

    private function setSession($user)
    {
        $db       = \Config\Database::connect();
        $role     = $db->table('roles')->where('id', $user['role_id'])->get()->getRowArray();
        $roleName = $role['name'] ?? 'Reporter';

        $data = [
            'userId'     => $user['id'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'fullName'   => $user['full_name'],
            'roleId'     => $user['role_id'],
            'userRole'   => $roleName,   // used by has_role() and check_admin()
            'isLoggedIn' => true,
        ];

        $this->session->set($data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
