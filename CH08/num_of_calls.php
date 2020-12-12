<?php

$num_of_calls =0;
function bigboss_called() {
	global $num_of_calls;
	$num_of_calls++;
	print "<h1>You called the Big Boss $num_of_calls time(s)</h1>";
}

bigboss_called();
print "Called for fixing printer";
bigboss_called();
print "Called for killing virus";
bigboss_called();
print "Called for a cup of coffee";

?>