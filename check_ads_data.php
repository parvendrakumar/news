<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$res = $p->query("SELECT * FROM ad_management");
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
