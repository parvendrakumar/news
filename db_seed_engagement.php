<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Polls
    $p1 = "कौन सी समाचार श्रेणी आपको सबसे अधिक पसंद है?";
    $p1_en = "Which news category do you prefer most?";
    $stmt = $pdo->prepare("INSERT IGNORE INTO polls (question_hi, question_en) VALUES (?, ?)");
    $stmt->execute([$p1, $p1_en]);
    $pollID = $pdo->lastInsertId();

    $opts = [
        ['खेल (Sports)', 'Sports', 45],
        ['राजनीति (Politics)', 'Politics', 120],
        ['मनोरंजन (Entertainment)', 'Entertainment', 78],
        ['प्रौद्योगिकी (Tech)', 'Technology', 34]
    ];
    foreach($opts as $o) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO poll_options (poll_id, option_hi, option_en, votes) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pollID, $o[0], $o[1], $o[2]]);
    }

    // 2. Activity Logs
    $logs = [
        [1, 'PUBLISH_NEWS', 'Published article: Breaking News Ticker Launched'],
        [1, 'UPDATE_STORY', 'Updated visual story: City Lights 2026'],
        [1, 'DELETE_SUBSCRIBER', 'Removed invalid email: test@spam.com'],
        [1, 'CREATE_AD', 'Initialized slot: HOMEPAGE_TOP_BANNER'],
        [1, 'PUBLISH_VIDEO', 'Published video: SpaceX Moon Mission']
    ];
    foreach($logs as $l) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO activity_logs (user_id, action, details, ip_address) VALUES (?, ?, ?, '127.0.0.1')");
        $stmt->execute($l);
    }

    echo "Engagement and Audit sample data seeded successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
