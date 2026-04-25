<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
$res = mysqli_query($db, "SELECT * FROM categories WHERE id = 85");
$cat = mysqli_fetch_assoc($res);
if ($cat) {
    echo "Category 85: Slug={$cat['slug']}\n";
} else {
    echo "Category 85 NOT FOUND\n";
}
mysqli_close($db);
