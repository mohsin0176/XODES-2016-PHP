<?PHP
$host = "localhost";
$user = "root";
$db = "my_site";

$link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
if ($link) {
	mysql_select_db($db) or die("Couldn't select $db :".mysql_error());
}
$result = mysql_query("SELECT * FROM site_users");
$num_rows = mysql_num_rows($result);
print "There are currently $num_rows rows in the table.<br/>";
print "<table border=1>";
while ($a_row = mysql_fetch_row($result)) {
	print "<tr>";
	foreach ($a_row as $field) {
		print "<td>$field</td>";
	}
	print "<td><a href=\"edit_user.php?id=".$a_row[0]."\">Edit</a></td>";
	print "</tr>";
}
print "</table>";
mysql_close($link);
?>