<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS smtp_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        smtp_host VARCHAR(255) NULL,
        smtp_port VARCHAR(10) NULL,
        smtp_user VARCHAR(255) NULL,
        smtp_pass VARCHAR(255) NULL,
        smtp_crypto ENUM('none', 'tls', 'ssl') DEFAULT 'tls',
        from_email VARCHAR(255) NULL,
        from_name VARCHAR(255) NULL,
        is_active TINYINT(1) DEFAULT 0,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Insert default empty row if not exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM smtp_settings");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO smtp_settings (smtp_host) VALUES ('smtp.example.com')");
    }

    echo "SMTP settings infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
