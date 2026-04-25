<?php
require 'app/Config/Paths.php';
$paths = new \Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';
$newsModel = new \App\Models\NewsModel();
$news = $newsModel->where('slug', 'bijnor-traffic-diversion-route')->first();
header('Content-Type: text/plain');
print_r($news);
