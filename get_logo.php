<?php
$pdo = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$stmt = $pdo->query("SELECT value FROM settings WHERE `key` = 'site_logo'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo $row ? $row['value'] : 'NOT_FOUND';
