<?php
$pdo = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$stmt = $pdo->query('SELECT email, otp_code FROM users');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['email'] . " : " . ($row['otp_code'] ?? 'NULL') . "\n";
}
