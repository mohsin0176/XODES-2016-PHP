<?php
$host = "localhost";
$user = "root";
$db= "my_site";
$link = mysql_connect($host,$user) or die("Couldn't connect to database server");
mysql_select_db($db) or die("Couldn't select database");
$sql = 'CREATE TABLE `site_users` ('
        . ' `user_id` INT(10) NOT NULL AUTO_INCREMENT, '
        . ' `first_name` VARCHAR(20) NOT NULL, '
        . ' `last_name` VARCHAR(20) NOT NULL, '
        . ' `username` VARCHAR(10) NOT NULL, '
        . ' `user_email` VARCHAR(50) NOT NULL, '
        . ' `user_web` VARCHAR(50), '
        . ' `country` VARCHAR(30), '
        . ' `sex` INT(1),'
        . ' PRIMARY KEY (`user_id`)'
        . ' )'
        . ' TYPE = myisam';

mysql_query($sql) or die("Couldn't make the table");
mysql_close($link);

?>