<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS global_modules (
        id INT AUTO_INCREMENT PRIMARY KEY,
        module_key VARCHAR(50) UNIQUE NOT NULL,
        module_name VARCHAR(100) NOT NULL,
        is_enabled TINYINT(1) DEFAULT 1,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    $modules = [
        ['visual_stories', 'Visual Stories (9:16)'],
        ['video_news', 'Video News Library'],
        ['ad_manager', 'Ad Management Engine'],
        ['breaking_ticker', 'Breaking News Ticker'],
        ['polls', 'Polls & Surveys'],
        ['subscribers', 'Subscriber Management'],
        ['smtp', 'SMTP Email Gateway'],
        ['sms', 'SMS API Gateway'],
        ['whatsapp', 'WhatsApp Business API'],
        ['telegram', 'Telegram Bot API']
    ];

    foreach($modules as $m) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO global_modules (module_key, module_name) VALUES (?, ?)");
        $stmt->execute($m);
    }

    echo "Global Module Orchestration infrastructure created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
