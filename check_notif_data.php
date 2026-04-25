<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
$res = mysqli_query($db, "SELECT * FROM notifications ORDER BY id DESC LIMIT 10");
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
mysqli_close($db);
