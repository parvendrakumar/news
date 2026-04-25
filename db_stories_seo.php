<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("ALTER TABLE visual_stories 
                ADD COLUMN meta_title VARCHAR(255) NULL AFTER status,
                ADD COLUMN meta_keywords TEXT NULL AFTER meta_title,
                ADD COLUMN meta_description TEXT NULL AFTER meta_keywords");

    echo "SEO columns added to visual_stories successfully.";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "SEO columns already exist.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
