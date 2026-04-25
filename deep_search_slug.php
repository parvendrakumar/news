<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
if (!$db) die("Connection failed: " . mysqli_connect_error());

$slug = 'future-food';
echo "Searching for slug: $slug\n\n";

// Check tables
$tables = ['news', 'visual_stories', 'video_news'];
foreach($tables as $table) {
    $res = mysqli_query($db, "SELECT id, slug FROM $table WHERE slug = '$slug'");
    if ($row = mysqli_fetch_assoc($res)) {
        echo "FOUND in $table! ID: {$row['id']}\n";
    }
}

// Check partial match
echo "\nPartial matches in 'news' table:\n";
$resPart = mysqli_query($db, "SELECT id, slug, status FROM news WHERE slug LIKE '%future%' OR slug LIKE '%food%' LIMIT 10");
while($row = mysqli_fetch_assoc($resPart)) {
    echo "ID: {$row['id']}, Slug: {$row['slug']}, Status: {$row['status']}\n";
}

mysqli_close($db);
