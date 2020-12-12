<?php
$dbname ="my_site";
$link = mysql_connect('localhost', 'root');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

$sql = 'CREATE DATABASE '.$dbname;
if (mysql_query($sql, $link)) {
   echo "Database $dbname created successfully\n";
} else {
   echo 'Error creating database: ' . mysql_error() . "\n";
}

?>