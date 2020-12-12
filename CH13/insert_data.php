<?php
$dbuser= "root";
$db = "my_site";
$link = mysql_connect("localhost", $dbuser);
if ( ! $link )
	die ("Could’nt connect to MySQL");
mysql_select_db($db, $link);
$sql = "INSERT INTO `site_users` (`user_id`, `first_name`, `last_name`, `username`, `user_email`, `user_web`, `country`, `sex`) VALUES (\'\', \'Suhreed\', \'Sarkar\', \'suhreed\', \'info@suhreed.org\', \'www.suhreed.org\', \'Bangladesh\', 1)";
mysql_query($sql);
mysql_close($link);
?>