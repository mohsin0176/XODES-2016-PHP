<?php
print '<html><head><title>Online Voting System</title><link rel="stylesheet" href="poll.css"></head><body>';
include_once("config.php");
include_once ("miniPoll.class.php");
$connection = mysql_connect($host, $user, $pass);
mysql_select_db($db,$connection);


$mypoll = new miniPoll;

if (isset($_GET['poll']) && is_numeric($_GET['pollid'])) {
	$pollid = $_GET['pollid'];

	if (isset($_GET['voteid']) && is_numeric($_GET['voteid'])) {
		$voteid = $_GET['voteid'];
		$mypoll->processPoll($pollid, $voteid);
	}

}
if (isset($_GET['pollid'])) {
	$pollid = $_GET['pollid'];
	$mypoll->pollResults($pollid);
}
mysql_close($connection);
echo  "</body></html>";

?>