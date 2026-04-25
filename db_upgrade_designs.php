<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $otpContent = '
    <div style="font-family: \'Outfit\', Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f9fafb; border-radius: 24px; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="background-color: #dc2626; padding: 40px 20px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -1px;">CITY NEWS</h1>
            <p style="color: rgba(255,255,255,0.8); margin-top: 5px; font-size: 14px; font-weight: 600;">SECURE AUTHENTICATION</p>
        </div>
        <div style="padding: 40px; background-color: white;">
            <h2 style="color: #111827; margin-top: 0; font-size: 22px; font-weight: 700;">Security Verification</h2>
            <p style="color: #4b5563; line-height: 1.6; font-size: 16px;">Hello,<br>We received a request to access your account. Please use the verification code below to complete your login:</p>
            
            <div style="margin: 40px 0; text-align: center;">
                <div style="display: inline-block; background-color: #fef2f2; border: 2px dashed #f87171; padding: 20px 40px; border-radius: 16px;">
                    <span style="display: block; font-size: 12px; color: #ef4444; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Your OTP Code</span>
                    <span style="font-size: 48px; font-weight: 900; color: #111827; letter-spacing: 12px; font-family: monospace;">{otp}</span>
                </div>
                <p style="color: #9ca3af; font-size: 13px; margin-top: 15px;">This code is valid for <b>5 minutes</b>.</p>
            </div>

            <p style="color: #4b5563; line-height: 1.6; font-size: 14px;">If you did not request this code, your account security might be at risk. Please change your password immediately or contact support.</p>
        </div>
        <div style="background-color: #111827; padding: 30px; text-align: center;">
            <p style="color: #9ca3af; font-size: 12px; margin: 0;">&copy; ' . date('Y') . ' City News Media Group. All rights reserved.</p>
            <p style="color: #4b5563; font-size: 11px; margin-top: 10px;">This is an automated security notification. Please do not reply to this email.</p>
        </div>
    </div>';

    $resetContent = '
    <div style="font-family: \'Outfit\', Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f9fafb; border-radius: 24px; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="background-color: #dc2626; padding: 40px 20px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -1px;">CITY NEWS</h1>
            <p style="color: rgba(255,255,255,0.8); margin-top: 5px; font-size: 14px; font-weight: 600;">PASSWORD RECOVERY</p>
        </div>
        <div style="padding: 40px; background-color: white;">
            <h2 style="color: #111827; margin-top: 0; font-size: 22px; font-weight: 700;">Reset Your Password</h2>
            <p style="color: #4b5563; line-height: 1.6; font-size: 16px;">Hello,<br>You recently requested to reset your password for your City News account. Click the button below to set a new password:</p>
            
            <div style="margin: 40px 0; text-align: center;">
                <a href="{link}" style="display: inline-block; background-color: #dc2626; color: white; padding: 18px 40px; border-radius: 16px; font-weight: 800; text-decoration: none; font-size: 18px; box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);">Reset Password</a>
                <p style="color: #9ca3af; font-size: 13px; margin-top: 25px;">This link will expire in <b>60 minutes</b>.</p>
            </div>

            <p style="color: #4b5563; line-height: 1.6; font-size: 14px;">If the button above doesn\'t work, copy and paste this URL into your browser:</p>
            <p style="color: #dc2626; font-size: 12px; word-break: break-all; background: #fef2f2; padding: 10px; border-radius: 8px;">{link}</p>
        </div>
        <div style="background-color: #111827; padding: 30px; text-align: center;">
            <p style="color: #9ca3af; font-size: 12px; margin: 0;">&copy; ' . date('Y') . ' City News Media Group. All rights reserved.</p>
            <p style="color: #4b5563; font-size: 11px; margin-top: 10px;">If you did not request a password reset, you can safely ignore this email.</p>
        </div>
    </div>';

    // Update OTP
    $pdo->prepare("UPDATE broadcast_templates SET content = ? WHERE template_name = 'OTP Verification'")->execute([$otpContent]);
    // Update Reset
    $pdo->prepare("UPDATE broadcast_templates SET content = ? WHERE template_name = 'Password Reset'")->execute([$resetContent]);

    echo "Premium designs applied successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
