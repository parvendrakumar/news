<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$p->exec("UPDATE users SET failed_attempts=0, locked_until=NULL WHERE email='parvendra@xsinfosol.com'");
echo "RESET SUCCESSFUL";
