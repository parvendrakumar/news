<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $templates = [
        [
            'module' => 'email',
            'template_name' => 'OTP Verification',
            'subject' => 'Your Secure Login Code - {otp}',
            'content' => '<h3>Security Verification</h3><p>Your secure login code is: <b style="font-size: 24px; color: #dc2626;">{otp}</b></p><p>This code will expire in 5 minutes.</p><hr><p>If you did not request this code, please ignore this email.</p>',
            'placeholders' => '{otp}',
            'is_active' => 1
        ],
        [
            'module' => 'email',
            'template_name' => 'Password Reset',
            'subject' => 'Password Reset Request',
            'content' => '<h3>Reset Your Password</h3><p>We received a request to reset your password. Click the link below to proceed:</p><div style="margin: 20px 0;"><a href="{link}" style="background: #dc2626; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold;">Reset Password</a></div><p>Alternatively, copy and paste this link: {link}</p><p>This link will expire in 1 hour.</p>',
            'placeholders' => '{link}',
            'is_active' => 1
        ]
    ];

    foreach ($templates as $t) {
        $stmt = $pdo->prepare("SELECT id FROM broadcast_templates WHERE template_name = ?");
        $stmt->execute([$t['template_name']]);
        if ($stmt->rowCount() == 0) {
            $sql = "INSERT INTO broadcast_templates (module, template_name, subject, content, placeholders, is_active) 
                    VALUES (:module, :template_name, :subject, :content, :placeholders, :is_active)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($t);
        }
    }

    echo "Security templates added successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
