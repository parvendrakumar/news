<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$res = $p->query("SELECT * FROM login_logs ORDER BY attempted_at DESC LIMIT 5");
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
