<?php
//database settings
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mypoll';

$connection = mysql_connect($host, $user, $pass);
$mydb = mysql_select_db($db,$connection);

?>