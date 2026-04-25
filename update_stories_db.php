<?php
// Bootstrap CI4
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require_once __DIR__ . '/vendor/codeigniter4/framework/system/Test/bootstrap.php';

$db = \Config\Database::connect();
$db->table('visual_stories')->where('image', 'story4.jpg')->update(['image' => 'story4.png']);
$db->table('visual_stories')->where('image', 'story5.jpg')->update(['image' => 'story5.png']);
echo "Database updated.\n";
