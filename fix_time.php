<?php
$mysqli = new mysqli("localhost", "root", "", "news");
$mysqli->set_charset("utf8mb4");

$mysqli->query("UPDATE news SET publish_at = '2026-04-12 10:00:00' WHERE category_id = 10");
echo "Publish dates corrected for Visual Stories.\n";

$mysqli->close();
?>
