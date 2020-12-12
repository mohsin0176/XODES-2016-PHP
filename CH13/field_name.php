<?php
$host = "localhost";
$user = "root";
$db = "my_site";

$link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
if ($link) {
	mysql_select_db($db) or die("Couldn't select $db :".mysql_error());
}
$result = mysql_query("SELECT * FROM site_users");
$num_fields = mysql_num_fields($result);
/*
for ($i=0; $i<$num_fields; $i++){
	echo "Length of ".mysql_field_name($result,$i)." is ".mysql_field_len($result,$i)." and flag is ".mysql_field_flags($result,$i)."<br/>";
}
*/
for ($i=0; $i<$num_fields; $i++){
	echo "Name: ".mysql_field_name($result,$i)."\t Length: ".mysql_field_len($result,$i)." \t Flag: ".mysql_field_flags($result,$i)."\t Type: ".mysql_field_type($result,$i)."<br/>";
}

mysql_free_result($result);
mysql_close($link);
?>