<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("ALTER TABLE video_news 
                ADD COLUMN author_name VARCHAR(255) NULL AFTER status");

    echo "Author column added to video_news successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
