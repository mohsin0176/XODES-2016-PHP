<?php
print '<html><head><title>Online Voting System</title><link rel="stylesheet" href="poll.css"></head><body>';
include_once("config.php");
include_once("miniPoll.class.php");

$connection = mysql_connect ($host, $user, $pass) or die ("Unable to connect");
mysql_select_db ($db) or die ("Unable to select database");

$mypoll = new miniPoll();
$mypoll->pollForm();

mysql_close($connection);
echo  "</body></html>";
?>