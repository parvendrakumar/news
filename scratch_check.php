<?php
try {
    $p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
    $q = $p->query("SHOW TABLES");
    foreach ($q as $r) {
        echo $r[0] . PHP_EOL;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
