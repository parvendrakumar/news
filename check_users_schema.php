<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$res = $p->query("DESCRIBE users");
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
