<?php
$mysqli = new mysqli("localhost", "root", "", "news");
$mysqli->set_charset("utf8mb4");

$res = $mysqli->query("SELECT id, slug, publish_at FROM news WHERE category_id = 10");
while ($row = $res->fetch_assoc()) {
    echo "ID: {$row['id']} | Slug: {$row['slug']} | PublishAt: {$row['publish_at']} | ServerTime: " . date('Y-m-d H:i:s') . "\n";
}

$mysqli->close();
?>
