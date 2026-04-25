<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=news", "root", "");
    $stmt = $pdo->query("DESCRIBE comments");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
