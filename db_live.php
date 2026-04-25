<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS live_streams (
        id INT AUTO_INCREMENT PRIMARY KEY,
        stream_title VARCHAR(255) NOT NULL,
        stream_url TEXT NOT NULL,
        provider ENUM('youtube', 'facebook', 'other') DEFAULT 'youtube',
        is_active TINYINT(1) DEFAULT 1,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Insert Default Stream if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM live_streams");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO live_streams (stream_title, stream_url, provider) VALUES ('City News Live TV', 'https://www.youtube.com/embed/live_stream?channel=CHANNEL_ID', 'youtube')");
    }

    echo "Live Stream infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
