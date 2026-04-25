<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS broadcast_templates (
        id INT AUTO_INCREMENT PRIMARY KEY,
        module ENUM('email', 'sms', 'whatsapp', 'telegram') NOT NULL,
        template_name VARCHAR(100) NOT NULL,
        subject VARCHAR(255) NULL,
        content TEXT NOT NULL,
        placeholders VARCHAR(255) DEFAULT '{title}, {url}, {summary}, {category}',
        is_active TINYINT(1) DEFAULT 1,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Insert Default Templates
    $templates = [
        ['email', 'News Broadcast', 'Breaking News: {title}', '<h3>{title}</h3><p>{summary}</p><a href="{url}">Read Full Story</a>', '{title}, {url}, {summary}'],
        ['sms', 'News Flash', NULL, 'Breaking: {title} - Read more at {url}', '{title}, {url}'],
        ['whatsapp', 'Direct Bulletin', NULL, '🚀 *{title}*\n\n{summary}\n\n🔗 Read More: {url}', '{title}, {url}, {summary}'],
        ['telegram', 'Channel Update', NULL, '🔥 *{title}*\n\n{summary}\n\n👉 [Read Full Story]({url})', '{title}, {url}, {summary}']
    ];

    foreach($templates as $t) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO broadcast_templates (module, template_name, subject, content, placeholders) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute($t);
    }

    echo "Broadcast Templates infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
