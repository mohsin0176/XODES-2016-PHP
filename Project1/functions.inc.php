<?PHP
include_once("config.php");

//takes title of the page and prints the header portion
function print_head($title) {
	print "<html>\n
	<head>\n
	<title>Online Voting System</title>\n
	</head>\n
	<body>\n
	<h2>$title</h2>";
}

//prints the footer of the page
function print_footer() {
	print "<hr><center>&copy; 2005. Suhreed Sarkar. All Rights Reserved.</center></body></html>";	
}

//Function to add the poll
function add_poll() {
	print_head("Adding Poll");
	if (isset($_POST['submit'])) {
    
    if (trim($_POST['qtitle']) == '') {
        die('ERROR: Please enter a question');
    }

    foreach ($_POST['options'] as $o) {
        if (trim($o) != '') {
            $atitles[] = $o;
        }
    }

    if (sizeof($atitles) <= 1) {
        die('ERROR: Please enter at least two answer choices');
    }

    $query = "INSERT INTO questions (qtitle, qdate) VALUES ('{$_POST['qtitle']}', NOW())";
    $result = mysql_query($query) or die("ERROR: $query.".mysql_error());

    $qid = mysql_insert_id();

    unset($query);
    unset ($result);

    foreach ($atitles as $atitle) {
        $query = "INSERT INTO answers (qid, atitle, acount) VALUES ('$qid', '$atitle', '0')";
        $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());
    }

    mysql_close($connection);

  	echo "<p>Poll successfully added to the database! Click <a href='admin.php'>here</a> to return to the main page</p>";
  
} else {
    die('ERROR: Data not correctly submitted');
	}
//may be here we need FORM to be shown - afterwards
print_footer();

}

function delete_poll($qid) {
	
	print_head("Deleting Poll");
	
	if ($_GET['qid'] && is_numeric($_GET['qid'])) {
    
    $query = "DELETE FROM answers WHERE qid = '".$_GET['qid']."'";
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

    $query = "DELETE FROM questions WHERE qid = '".$_GET['qid']."'";
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

    echo "<p>Poll successfully removed from the database! Click <a href = 'admin.php'>here</a> to return to the main page</p>";
} else {
    die('<p>ERROR: Data not correctly submitted</p>');
}

print_footer();
	
}

//Prints the form for voting
function print_form ($qid) {
	
	print_head("Voting Booth");	
	
	$query = "SELECT qid, qtitle FROM questions ORDER BY qdate DESC LIMIT 0, 1";
	$result = mysql_query($query) or die("ERROR: $query.".mysql_error());
	if (mysql_num_rows($result) > 0) {
    $row = mysql_fetch_object($result);
    $qid = $row->qid;
    
    //HTML Output
    echo '<h3>'.$row->qtitle .'</h3>';
    echo "<form method = \"post\" action = '".$_SERVER['PHP_SELF']."?op=vote_count'>";
    $query = "SELECT aid, atitle FROM answers WHERE qid = '$qid'";
    $result = mysql_query($query) or die("ERROR: $query.".mysql_error());
    if (mysql_num_rows($result) > 0) {

        while ($row = mysql_fetch_object($result)) {
            echo "<input type = radio name = aid value = '".$row->aid."'>".$row->atitle."</input><br />";
        }

    echo "<input type = hidden name = qid value = '".$qid."'>";
    echo "<input type = submit name = submit value = 'Vote!'>";
    }
    
    echo '</form>';
  } else {
    echo '<p>Sorry! Currently there is no active poll.</p>';
 }
print_footer();

}

function vote_count() {
		
	if (isset($_COOKIE) && !empty($_COOKIE)) {
    if ($_COOKIE['lastpoll'] && $_COOKIE['lastpoll'] == $_POST['qid']) {
        die('ERROR: You have already voted in this poll');
       }
   }

   setCookie('lastpoll', $_POST['qid'], time() + 2592000);
   
   print_head("Count Vote");
   
   if (isset($_POST['submit'])) {

    if (!isset($_POST['aid'])) {
        die('<p>ERROR: Please select one of the available choices</p>');
    }

    $query = "UPDATE answers SET acount = acount + 1 WHERE aid = ".$_POST['aid']." AND qid = ".$_POST['qid'];
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());


    echo '<p>Your vote was successfully registered!</p>';
  
	} else {
    	die('<p>ERROR: Data not correctly submitted</p>');
	}
   print_footer();
}

//Function for showing poll results
function show_results($qid) {
	
	print_head("Results of the Poll");
	
    if ($qid && is_numeric($qid)) {
    
    $query = "SELECT qtitle FROM questions WHERE qid = '".$qid."'";
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());
    $row = mysql_fetch_object($result);
    echo '<h3>'.$row->qtitle.'</h3>';

    // ?????????????? ????? ???
    unset($query);
    unset($result);
    unset($row);

    // ???? ??? ???? ????? ?? ?? ??? ???
    $query = "SELECT qid, SUM(acount) AS total FROM answers GROUP BY qid HAVING qid = '".$qid."'";
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());
    $row = mysql_fetch_object($result);
    $total = $row->total;

    if ($total > 0) {
        unset($query);
        unset($result);
        unset($row);

       $query = "SELECT atitle, acount FROM answers WHERE qid = '".$qid."'";
        $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

       if (mysql_num_rows($result) > 0) {
            
            echo '<table border=1 cellspacing=0 cellpadding=15>';

            while($row = mysql_fetch_object($result)) { 
                echo '<tr>';
                echo '<td>'.$row->atitle.'</td>';
                echo '<td>'.$row->acount.'</td>';
                echo '<td>';
                for ($i = 0; $i < (int)($row->acount*100 / $total); $i++) echo "<img src='mainbar.gif'"; 
                echo '</td>';
                echo '<td>'.round(($row->acount/$total) * 100, 2).'%</td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td><u>TOTAL</u></td>';
            echo '<td>'.$total.'</td>';
            echo '<td> &nbsp;</td>';
            echo '<td>100%</td>';
            echo '</tr>';
            echo '</table>';
        }
    } else {
        echo '<p>No votes cast yet<p>';
    }

}
else {
    die('<p>ERROR: Data not correctly submitted</p>');
	}
	print_footer();
}

function admin_menu() {
	print_head("Administration Panel");
	
	$query = 'SELECT qid, qtitle, qdate FROM questions ORDER BY qdate DESC';
	$result = mysql_query($query) or die('ERROR: $query. '.mysql_error());
	
	if (mysql_num_rows($result) > 0) {
    print "<table>";
    while($row = mysql_fetch_object($result)) {
    echo <<<EOT
        <tr>
            <td>$row->qtitle</td>
            <td><a href = "$_SERVER[PHP_SELF]?op=view_results&amp;qid=$row->qid">view report</a></td>
            <td><a href = "$_SERVER[PHP_SELF]?op=delete_poll&amp;qid=$row->qid">delete poll</a></td>
        	<td><a href = "$_SERVER[PHP_SELF]?op=vote&amp;qid=$row->qid"'>Cast Vote</a></td>
         </tr>
EOT;
	}
} else {

    echo "<p>No polls currently configured</p>";
	}
	print "</table>";
//to print 'Add New Poll' Form
add_new_poll();

print_footer();

}

function add_new_poll() {
 echo <<<EOT
	<h4>Add New Question:</h4>
	<form action = "$_SERVER[PHP_SELF]?op=add_poll" method ="post">
	<table border = '0' cellspacing = '5'>
	<tr>
    	<td>Question</td>
    	<td><input type = 'text' name = 'qtitle'></td>
	</tr>
	<tr>
    	<td>Option #1</td>
    	<td><input type = 'text' name = 'options[]'></td>
	</tr>
	<tr>
    	<td>Option #2</td>
    	<td><input type = 'text' name = 'options[]'></td>
	</tr>
	<tr>
    	<td>Option #3</td>
    	<td><input type = 'text' name = 'options[]'></td>
	</tr>
	<tr>
    	<td>Option #4</td>
    	<td><input type = 'text' name = 'options[]'></td>
	</tr>
	<tr>
    	<td>Option #5</td>
    	<td><input type = 'text' name = 'options[]'></td>
	</tr>
	<tr>
    	<td colspan = '2' align = 'right'><input type = 'submit' name = 'submit' value = 'Add Question'>
    	</td>
	</tr>
	</table>
	</form>
EOT;
		
}

switch(op) {
	case "view_results":
		show_results($qid);
		break;
	
	case "vote":
		print_form($qid);
		break;
	case "admin":
		admin_menu();
		break;
	case "vote_count":
	   vote_count();
	   break;
	 
	default:
	print_form();
}


?>