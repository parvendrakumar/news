<?php
// Scratch script to add custom_author column
require_once 'public/index.php'; // This might not work easily for CLI

$db = \Config\Database::connect();
try {
    $db->query("ALTER TABLE news ADD COLUMN custom_author VARCHAR(255) NULL AFTER author_id");
    echo "Column added successfully.\n";
} catch (\Exception $e) {
    echo "Error or already exists: " . $e->getMessage() . "\n";
}
