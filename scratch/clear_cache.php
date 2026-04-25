<?php
// Bootstrap CI4
define('FCPATH', __DIR__ . '/public');
require __DIR__ . '/../vendor/autoload.php';
$app = \Config\Services::cache();
$app->clean();
echo "Cache cleared successfully.\n";
