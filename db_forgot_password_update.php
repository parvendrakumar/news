<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $columns = [
        "reset_token VARCHAR(100) NULL",
        "reset_expires_at DATETIME NULL"
    ];

    foreach ($columns as $column) {
        $name = explode(' ', $column)[0];
        $res = $pdo->query("SHOW COLUMNS FROM users LIKE '$name'");
        if ($res->rowCount() == 0) {
            $pdo->exec("ALTER TABLE users ADD COLUMN $column");
        }
    }

    echo "Database updated successfully with forgot password columns.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
