<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Create Login Logs Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS login_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        email VARCHAR(255) NULL,
        ip_address VARCHAR(45) NOT NULL,
        user_agent VARCHAR(255) NOT NULL,
        status ENUM('success', 'failed') NOT NULL,
        attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. Add Security Columns to Users table
    $columns = [
        "failed_attempts INT DEFAULT 0",
        "locked_until DATETIME NULL",
        "last_login DATETIME NULL",
        "last_ip VARCHAR(45) NULL",
        "last_user_agent VARCHAR(255) NULL",
        "two_factor_secret VARCHAR(100) NULL",
        "two_factor_enabled TINYINT(1) DEFAULT 0",
        "password_updated_at DATETIME NULL",
        "otp_code VARCHAR(6) NULL",
        "otp_expires_at DATETIME NULL"
    ];

    foreach ($columns as $column) {
        $name = explode(' ', $column)[0];
        $res = $pdo->query("SHOW COLUMNS FROM users LIKE '$name'");
        if ($res->rowCount() == 0) {
            $pdo->exec("ALTER TABLE users ADD COLUMN $column");
        }
    }

    // 3. Create a table for blocked IPs
    $pdo->exec("CREATE TABLE IF NOT EXISTS blocked_ips (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(45) NOT NULL,
        reason VARCHAR(255) NULL,
        blocked_until TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    echo "Database updated successfully with security features.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
