<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
// Check if column exists first
$check = $p->query("SHOW COLUMNS FROM ad_management LIKE 'target_page'");
if (!$check->fetch()) {
    $p->exec('ALTER TABLE ad_management ADD COLUMN target_page VARCHAR(50) DEFAULT "all" AFTER slot_name');
    echo "COLUMN_ADDED";
} else {
    echo "COLUMN_EXISTS";
}
