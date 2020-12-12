<?PHP
function connect_dbs() {
	$host = "localhost";
    $user = "root";
    $link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
}

//select db names and populates options
function populate_dbs() {
	$host = "localhost";
    $user = "root";
    $link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
	$dbs = mysql_list_dbs($link);
    echo "<form action=\"$_SERVER[PHP_SELF]\" method=\"post\">";
	echo "Select a dababase:"; 
    echo "<select name=\"db\">";  
	$num_dbs = mysql_num_rows($dbs);
	for ($i = 0; $i < $num_dbs; $i++) {
   		$dbname = mysql_db_name($dbs,$i);
   		echo "<option>$dbname";
   }
   echo "</select>";
   echo "<input type=\"submit\" value=\"Go\">"; 
   echo "</form>";
   mysql_close($link);
}

function start_form(){
	 echo "<form action=\"$_SERVER[PHP_SELF]\" method=\"post\">";
     
}

function end_form() {
	echo "<input type=\"submit\" value=\"Go\">"; 
	echo "</form>";
}

function print_header() {
	echo "<html"
		."<head>"
		."<title>MySQL Database Browser</title>"
		."</head>"
		."<body>";
}

function print_footer () {
	echo "</body>"
		 ."</html>";
}

//Lists the tables in $db
function show_tables($db) {
	$host = "localhost";
    $user = "root";
    $link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
	$sql = "SHOW TABLES FROM $db";
    $result = mysql_query($sql);

    if (!$result) {
       echo "DB Error, could not list tables\n";
       echo 'MySQL Error: ' . mysql_error();
       exit;
     }
     echo "<p><b>Tables in $db:</b><p>";
     while ($row = mysql_fetch_row($result)) {
        echo ">>> {$row[0]}<br/>";
        }

      mysql_free_result($result);
      mysql_close($link);
}

function populate_tables($db) {
	$host = "localhost";
    $user = "root";
    $link = mysql_connect($host, $user) or die("Couldn't connect".mysql_error());
	$sql = "SHOW TABLES FROM $db";
    $result = mysql_query($sql);
    echo "<form action=\"$_SERVER[PHP_SELF]\" method=\"post\">";
    echo "<p>Select a Table:"
    	 ."<select name=\"table\">";
    
     while ($row = mysql_fetch_row($result)) {
           echo "<option>{$row[0]}";
        }
    
    echo "</select>";
    echo "<input type=\"submit\" value=\"Go\">"; 
	echo "</form>";
    mysql_free_result($result);
    mysql_close($link);
}


print_header();
if (isset($_POST['db'])) {
	populate_dbs();
	populate_tables($_POST['db']);
} else {
	populate_dbs();
}
show_tables($_POST['db']);
print_footer();

?>