<?php
$db = mysqli_connect('localhost', 'root', '', 'news');
$res = mysqli_query($db, "DESCRIBE notifications");
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
mysqli_close($db);
