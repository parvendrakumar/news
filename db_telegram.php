<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS telegram_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        bot_token VARCHAR(255) NULL,
        channel_id VARCHAR(100) NULL,
        is_active TINYINT(1) DEFAULT 0,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Insert default empty row if not exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM telegram_settings");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO telegram_settings (bot_token) VALUES ('')");
    }

    echo "Telegram API infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
