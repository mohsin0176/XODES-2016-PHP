<?PHP
$host = "localhost";
$user = "root";
$db = "my_site";

$link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
if ($link) {
	mysql_select_db($db) or die("Couldn't select $db :".mysql_error());
}
$result = mysql_query("DELETE FROM site_users WHERE user_id > 15");
print "Affected rows:".mysql_affected_rows();

mysql_close($link);
?>