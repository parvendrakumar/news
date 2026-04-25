<?php
try {
    $p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
    $p->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $p->exec("ALTER TABLE ad_management ADD target_category_id INT DEFAULT 0 AFTER target_page");
    echo "Successfully added target_category_id column.";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column target_category_id already exists.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
