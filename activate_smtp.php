<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("UPDATE smtp_settings SET is_active = 1 WHERE id = 1");
    echo "SMTP activated successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
