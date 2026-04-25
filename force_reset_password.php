<?php
$email = 'parvendra@xsinfosol.com';
$password = 'Admin@201301';
$hash = password_hash($password, PASSWORD_DEFAULT);

$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
$res = $p->prepare("UPDATE users SET password = ?, failed_attempts = 0, locked_until = NULL WHERE email = ?");
if ($res->execute([$hash, $email])) {
    echo "PASSWORD_RESET_SUCCESSFUL";
} else {
    echo "FAILED_TO_RESET_PASSWORD";
}
