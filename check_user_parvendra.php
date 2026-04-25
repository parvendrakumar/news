<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$res = $p->query("SELECT email, failed_attempts, locked_until FROM users WHERE email='parvendra@xsinfosol.com'");
print_r($res->fetch(PDO::FETCH_ASSOC));
