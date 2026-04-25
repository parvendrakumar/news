<?php
require 'app/Config/Paths.php';
$paths = new \Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';
$newsModel = new \App\Models\NewsModel();
$db = \Config\Database::connect();

$slug = 'future-food';
echo "Checking News Slug: $slug\n\n";

// Check base news table
$news = $newsModel->where('slug', $slug)->first();
if ($news) {
    echo "News Found in base table:\n";
    print_r($news);
    
    // Check translations
    $translations = $db->table('news_translations')->where('news_id', $news['id'])->get()->getResultArray();
    echo "\nTranslations Found:\n";
    print_r($translations);
} else {
    echo "News NOT FOUND in base table.\n";
}
