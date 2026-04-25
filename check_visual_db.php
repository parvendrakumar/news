<?php
$mysqli = new mysqli("localhost", "root", "", "news");
$mysqli->set_charset("utf8mb4");

echo "--- Visual Stories in DB (Lang: hi) ---\n";
$res = $mysqli->query("
    SELECT news.slug, news_translations.title 
    FROM news 
    JOIN news_translations ON news_translations.news_id = news.id 
    JOIN categories ON categories.id = news.category_id
    WHERE categories.slug = 'visual-stories' 
    AND news_translations.language = 'hi'
");
while ($row = $res->fetch_assoc()) {
    echo "- " . $row['title'] . " (" . $row['slug'] . ")\n";
}

$mysqli->close();
?>
