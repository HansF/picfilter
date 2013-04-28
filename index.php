<?php

include('inc/header.php');
// On Windows:
echo "hello world";
$db = new SQLite3('mysqlitedb.db');

var_dump($db->querySingle('SELECT username FROM user WHERE userid=1'));
print_r($db->querySingle('SELECT username, email FROM user WHERE userid=1', true));


include('inc/footer.php');

?>