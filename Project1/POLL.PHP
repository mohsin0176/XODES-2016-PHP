<?php

/* For common includes*/
include('config.php');  

/*************** print_form() function starts **************************/
function print_form () 
{
	global $host, $user, $pass, $db;
	
	$connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');
	mysql_select_db($db) or die('ERROR: Unable to select database!');
	$query = "SELECT qid, qtitle FROM questions ORDER BY qdate DESC LIMIT 0, 1";
	$result = mysql_query($query) or die("ERROR: $query.".mysql_error());
	if (mysql_num_rows($result) > 0) {
    $row = mysql_fetch_object($result);
    $qid = $row->qid;
    //HTML Output
    echo '<html><head><title>Online Voting System</title></head><body>';
    echo '<h2>'.$row->qtitle .'</h2>';
    echo "<form method = post action = '".$_SERVER['PHP_SELF']."'>";
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
    echo "</body></html>";
} else {
    echo 'Sorry! Currently there is no active poll.';
}

mysql_close($connection);
}
/****************** Function print_form end **********************************/

/***** vote-count() function starts ******************************************/

function vote_count()
{
	global $host, $db, $user, $pass;
	
	if (isset($_COOKIE) && !empty($_COOKIE)) {
    if ($_COOKIE['lastpoll'] && $_COOKIE['lastpoll'] == $_POST['qid']) {
        die('ERROR: You have already voted in this poll');
       }
   }

   setCookie('lastpoll', $_POST['qid'], time() + 2592000);
   
   echo "<html>
   <head>
   <title>Online Voting System</title>
   </head>
   <body>";
   if (isset($_POST['submit'])) {

    if (!isset($_POST['aid'])) {
        die('ERROR: Please select one of the available choices');
    }

    // ??????? ??????? ???? ?????????? ???? ??? ????
    include('config.php');
    
    // ??????? ????? ???? ????
    $connection = mysql_connect($host, $user, $pass) or die('ERROR: Unable to connect!');
    
    // ??????? ??????? ????
    mysql_select_db($db) or die('ERROR: Unable to select database!');
    
    // ????? ???????? ????? ????? ?????? ???? ????? ??????? ??????? aid ?????? ??????? ??? ?????
    $query = "UPDATE answers SET acount = acount + 1 WHERE aid = ".$_POST['aid']." AND qid = ".$_POST['qid'];
    $result = mysql_query($query) or die("ERROR: $query. ".mysql_error());

    // ??????? ????????????? ????? ???? ????
    mysql_close($connection);

    echo 'Your vote was successfully registered!';
    echo '</body></html>';
	} else {
    	die('ERROR: Data not correctly submitted');
	}
   
}
/**************** vote-count() function ends ***********************************/





?>