<?php
$pdo = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$stmt = $pdo->query("SELECT value FROM settings WHERE `key` = 'activity_logs_status'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    $pdo->exec("INSERT INTO settings (`key`, `value`) VALUES ('activity_logs_status', '1')");
    echo "CREATED_ACTIVE";
} else {
    echo $row['value'];
}
