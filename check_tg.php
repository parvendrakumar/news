<?php
// Simple DB check without full CI4 boot if possible
$env = parse_ini_file('.env');
$host = $env['database.default.hostname'] ?? 'localhost';
$user = $env['database.default.username'] ?? 'root';
$pass = $env['database.default.password'] ?? '';
$name = $env['database.default.database'] ?? 'news';

$conn = new mysqli($host, $user, $pass, $name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM telegram_settings LIMIT 1");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    print_r($row);
} else {
    echo "No settings found or table missing.";
}
$conn->close();
