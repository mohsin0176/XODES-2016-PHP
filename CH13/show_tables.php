<?PHP
$host = "localhost";
$user = "root";


$link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
$dbname = "mypoll";

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
   echo "DB Error, could not list tables\n";
   echo 'MySQL Error: ' . mysql_error();
   exit;
}

while ($row = mysql_fetch_row($result)) {
   echo "Table: {$row[0]}<br/>";
}

mysql_free_result($result);

mysql_close($link);
?>