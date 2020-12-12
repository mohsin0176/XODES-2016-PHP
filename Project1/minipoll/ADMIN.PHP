<?php
print '<html><head><title>Online Voting System</title><link rel="stylesheet" href="poll.css"></head><body>';

include_once("config.php");
include_once ("miniPollAdmin.class.php");
$connection = mysql_connect($host,$user,$pass);
mysql_select_db($db,$connection);

$admin = new miniPollAdmin;

$admin->newPollForm();

if (isset($_GET['opt'])) {
	$opt = $_GET['opt'];
	$pollid = $_GET['pollid'];
	if ($opt == 'activate') {
		$admin->activatePoll($pollid);
	}
	if ($opt == 'delete') {
		$admin->deletePoll($pollid);
	}

}

echo "<br />";
if (isset($_GET['q'])) {
	$pollname = $_GET['pollname'];
	$q = $_GET['q'];
	$admin->createPoll($pollname, $q);
}
$admin->listPolls();

mysql_close($connection);
echo  "</body></html>";
?>