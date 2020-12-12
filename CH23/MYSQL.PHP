<?php
echo "<html><head><title>Error connecting Database Server</title></head><body>";
	/* Connect to the MySQL database */
    $db_connection = mysql_connect("localhost", "root", "")
		or die("Could not connect to DB");
		
	/* Select the MasteringPHP database */
    mysql_select_db ("my", $db_connection)
		//or die("Could not find DB");

	/* Store the query to be executed in a variable */
	$query = "SELECT FirstName, LastName FROM Owner;";
	
	 /* Send the query to MySQL for execution */
    $query_result = mysql_query ($query, $db_connection);
	
	/* Begin table to format data */
	print "<table border=\"1\">\n";
    print "<tr><td align=\"center\" colspan=\"4\" bgcolor=\"#ffff99\">";
	print "<strong>Owners</strong>";
	print "</td></tr>";
	
	/* Loop over query displaying all returned rows */
	while ($row = mysql_fetch_object ($query_result)) 
	{
		print "\t<tr>";
		print "\t\t<td>" . $row->FirstName . "</td>";
		print "\t\t<td>" . $row->LastName . "</td>";		
		print "\t</tr>";
	}
	print "</table>\n";
	print "</body>";
    
	/* Close the connection with the database */
   mysql_close($db_connection);
?>

