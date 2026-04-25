<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$s = $p->query('SELECT @@sql_mode');
echo $s->fetch()[0];
