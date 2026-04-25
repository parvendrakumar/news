<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$s = $p->query('SELECT status, publish_at FROM news WHERE id = 78');
$r = $s->fetch(PDO::FETCH_ASSOC);
echo "STATUS: " . $r['status'] . "\n";
echo "PUBLISH_AT: " . $r['publish_at'] . "\n";
echo "NOW: " . date('Y-m-d H:i:s') . "\n";
