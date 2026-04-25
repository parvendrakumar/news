<?php
require 'app/Config/Paths.php';
$paths = new \Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';
$db = \Config\Database::connect();

$slug = 'cricket';
$cat = $db->table('categories')->where('slug', $slug)->get()->getRowArray();
echo "Category Info for '$slug':\n";
print_r($cat);

if ($cat) {
    $catId = $cat['id'];
    $ads = $db->table('ad_management')
              ->where('is_active', 1)
              ->get()
              ->getResultArray();
    echo "\nActive Ads:\n";
    foreach($ads as $ad) {
        echo "ID: {$ad['id']}, Slot: {$ad['slot_name']}, Target Page: {$ad['target_page']}, Target Cat: {$ad['target_category_id']}\n";
    }
}
