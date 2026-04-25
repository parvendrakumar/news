<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
if (!$db) die("Connection failed: " . mysqli_connect_error());

$slug = 'future-food';
echo "Slug: $slug\n";

$resNews = mysqli_query($db, "SELECT * FROM news WHERE slug = '$slug'");
$news = mysqli_fetch_assoc($resNews);

if ($news) {
    echo "News ID: {$news['id']}, Status: {$news['status']}, Publish At: {$news['publish_at']}\n";
    
    $resTrans = mysqli_query($db, "SELECT * FROM news_translations WHERE news_id = {$news['id']}");
    echo "\nTranslations:\n";
    while($t = mysqli_fetch_assoc($resTrans)) {
        echo "Lang: {$t['language']}, Title: {$t['title']}\n";
    }
} else {
    echo "News NOT FOUND\n";
    
    // Check if it's in video_news or stories
    $resVid = mysqli_query($db, "SELECT * FROM video_news WHERE slug = '$slug'");
    $vid = mysqli_fetch_assoc($resVid);
    if ($vid) echo "Found in video_news! ID: {$vid['id']}\n";
    
    $resStory = mysqli_query($db, "SELECT * FROM stories WHERE slug = '$slug'");
    $story = mysqli_fetch_assoc($resStory);
    if ($story) echo "Found in stories! ID: {$story['id']}\n";
}

mysqli_close($db);
