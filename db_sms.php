<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS sms_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gateway_name VARCHAR(100) DEFAULT 'Generic Gateway',
        api_url TEXT NULL,
        api_key VARCHAR(255) NULL,
        sender_id VARCHAR(20) NULL,
        entity_id VARCHAR(50) NULL,
        template_id VARCHAR(50) NULL,
        is_active TINYINT(1) DEFAULT 0,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Insert default empty row if not exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM sms_settings");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO sms_settings (gateway_name) VALUES ('Twilio / MSG91 / Textlocal')");
    }

    echo "SMS API settings infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
