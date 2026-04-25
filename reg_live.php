<?php
$db = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$db->exec("INSERT IGNORE INTO global_modules (module_key, module_name) VALUES ('live_tv', 'Live TV Streaming')");
echo 'Module registered.';
