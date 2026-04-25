<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
$res = mysqli_query($db, "SHOW FULL COLUMNS FROM visual_stories LIKE 'slug'");
$col = mysqli_fetch_assoc($res);
echo "Collation for slug in visual_stories: {$col['Collation']}\n";

$res2 = mysqli_query($db, "SHOW FULL COLUMNS FROM news LIKE 'slug'");
$col2 = mysqli_fetch_assoc($res2);
echo "Collation for slug in news: {$col2['Collation']}\n";
mysqli_close($db);
