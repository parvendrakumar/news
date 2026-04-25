<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$s = $p->query('SELECT * FROM settings WHERE `key`="timezone"');
if(!$s->fetch()){
    $p->exec('INSERT INTO settings (`key`, `value`) VALUES ("timezone", "Asia/Kolkata")');
    echo "SAVED";
}else{
    echo "EXISTS";
}
