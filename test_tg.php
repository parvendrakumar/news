<?php
$token = "7255875161:AAGoIa5iSiK8ak9jL3IP9o3KFcciuDVKhhA";
$url = "https://api.telegram.org/bot$token/getMe";
$res = file_get_contents($url);
echo $res;
