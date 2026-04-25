<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=news", "root", "");
    $pdo->query("CREATE TABLE IF NOT EXISTS notifications (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(11) UNSIGNED NOT NULL,
        title VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        type VARCHAR(50) DEFAULT 'info',
        is_read TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id),
        INDEX (is_read)
    )");
    echo "Notifications table created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
