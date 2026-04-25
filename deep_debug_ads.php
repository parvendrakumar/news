<?php
// Simple DB check without full CI bootstrap if needed, but let's try a better bootstrap
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
$loader = require FCPATH . 'vendor/autoload.php';
$env = parse_ini_file('.env');
foreach($env as $k => $v) putenv("$k=$v");

// Manual DB connect
$db = mysqli_connect('localhost', 'root', '', 'news');
if (!$db) die("Connection failed: " . mysqli_connect_error());

$slug = 'cricket';
$res = mysqli_query($db, "SELECT * FROM categories WHERE slug = '$slug'");
$cat = mysqli_fetch_assoc($res);
echo "Category '$slug': " . ($cat ? "ID {$cat['id']}" : "NOT FOUND") . "\n";

$resAd = mysqli_query($db, "SELECT * FROM ad_management WHERE is_active = 1");
echo "\nActive Ads:\n";
while($ad = mysqli_fetch_assoc($resAd)) {
    echo "ID: {$ad['id']}, Slot: {$ad['slot_name']}, Target: {$ad['target_page']}, CatID: {$ad['target_category_id']}\n";
}
mysqli_close($db);
