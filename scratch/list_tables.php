<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=news", "root", "");
    $stmt = $pdo->query("SHOW TABLES");
    print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
