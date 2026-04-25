<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$s = $p->query('SELECT email FROM users');
while($r=$s->fetch()) echo $r['email'] . PHP_EOL;
