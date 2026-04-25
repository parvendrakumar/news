<?php
$token = "7255875161:AAGoIa5iSiK8ak9jL3IP9o3KFcciuDVKhhA";
$chatId = "7255875161";
$url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&text=Test+from+City+News";
$res = file_get_contents($url);
echo $res;
