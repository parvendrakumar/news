<?php
$db = \Config\Database::connect();
$fields = $db->getFieldNames('subscribers');
print_r($fields);
