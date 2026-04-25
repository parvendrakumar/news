<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
$res = mysqli_query($db, "SELECT * FROM visual_stories WHERE id = 5");
$story = mysqli_fetch_assoc($res);
print_r($story);
mysqli_close($db);
