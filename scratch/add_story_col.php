<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=news", "root", "");
    $pdo->query("ALTER TABLE bookmarks ADD COLUMN story_id INT(11) UNSIGNED DEFAULT NULL AFTER news_id");
    echo "Column story_id added successfully.";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "Column already exists.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
