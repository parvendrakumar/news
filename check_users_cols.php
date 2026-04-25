<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $res = $pdo->query("DESCRIBE users");
    $cols = $res->fetchAll(PDO::FETCH_COLUMN);
    echo implode(', ', $cols);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
