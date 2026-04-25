<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$tables = ['global_modules', 'news', 'settings', 'activity_logs', 'smtp_settings'];
foreach($tables as $t) {
    $s = $p->query("SHOW TABLES LIKE '$t'");
    echo "$t: " . ($s->fetch() ? 'OK' : 'MISSING') . "\n";
}
