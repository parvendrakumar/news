<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Visual Stories
    $pdo->exec("CREATE TABLE IF NOT EXISTS visual_stories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title_hi VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NULL,
        image VARCHAR(255) NOT NULL,
        content_hi TEXT NULL,
        content_en TEXT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        views INT DEFAULT 0,
        status ENUM('published', 'draft') DEFAULT 'published',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. Ad Management
    $pdo->exec("CREATE TABLE IF NOT EXISTS ad_management (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slot_name VARCHAR(100) UNIQUE NOT NULL,
        ad_type ENUM('image', 'google_ads', 'custom_code') DEFAULT 'image',
        image VARCHAR(255) NULL,
        link VARCHAR(255) NULL,
        custom_code TEXT NULL,
        is_active TINYINT(1) DEFAULT 1,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // 3. Subscribers
    $pdo->exec("CREATE TABLE IF NOT EXISTS subscribers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(180) UNIQUE NOT NULL,
        status ENUM('active', 'unsubscribed') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 4. Breaking Ticker
    $pdo->exec("CREATE TABLE IF NOT EXISTS breaking_ticker (
        id INT AUTO_INCREMENT PRIMARY KEY,
        content_hi TEXT NOT NULL,
        content_en TEXT NULL,
        link VARCHAR(255) NULL,
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    echo "Tables created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
