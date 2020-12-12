<?php
$host = "localhost";
$user = "root";

$link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
$dbs = mysql_list_dbs($link);

while ($db_rows = mysql_fetch_row($dbs)) {
	print "<b>$db_rows</b><br/>";
	if (!mysql_select_db($db_rows[0])) {
		print "<dl><dd>Couldn'y connect ...".mysql_error()." </dl>";
		continue;
	}
	$tables = mysql_list_tables($db_rows[0], $link);
	print "<dl><dd>";
	while ($tables_rows = mysql_fetch_row($tables)) {
		print "<b>$tables_rows[0]</b>";
		$query_res = mysql_query("SELECT * from $tables_rows[0]");
		$num_fields =mysql_num_fields($query_res);
		print "<dl><dd>";
		for ($i; $i <$num_fields; $i++){
			print "<i>";
			print mysql_field_type($query_res, $i);
			print "</i><i>";
			print mysql_field_len($query_res, $i);
			print "</i><b>";
			print mysql_field_name($query_res, $i);
			print "</b><i>";
			print mysql_field_flags($query_res, $i);
			print "</i><br/>";
		}
		print "</dl>";
	}
	print "</dl>";
}
mysql_close($link);
?>