<?php
$content = file_get_contents('app/Controllers/Home.php');
preg_match_all('/function\s+([a-zA-Z0-9_]+)/', $content, $matches);
print_r($matches[1]);
