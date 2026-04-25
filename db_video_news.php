<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS video_news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title_hi VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NULL,
        video_url VARCHAR(255) NOT NULL,
        thumbnail VARCHAR(255) NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        description_hi TEXT NULL,
        description_en TEXT NULL,
        meta_title VARCHAR(255) NULL,
        meta_keywords TEXT NULL,
        meta_description TEXT NULL,
        status ENUM('published', 'draft') DEFAULT 'published',
        views INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    echo "video_news table created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
