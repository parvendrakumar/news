<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$res = $p->query("SELECT email, role_id FROM users WHERE email='parvendra@xsinfosol.com'");
print_r($res->fetch(PDO::FETCH_ASSOC));
