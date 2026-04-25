<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS whatsapp_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gateway_name VARCHAR(100) DEFAULT 'Meta Business API',
        api_url VARCHAR(255) DEFAULT 'https://graph.facebook.com/v17.0/',
        api_key TEXT NULL,
        phone_number_id VARCHAR(100) NULL,
        waba_id VARCHAR(100) NULL,
        is_active TINYINT(1) DEFAULT 0,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Insert default empty row if not exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM whatsapp_settings");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO whatsapp_settings (gateway_name) VALUES ('Meta Cloud API / Wathi / Interakt')");
    }

    echo "WhatsApp API infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
