<?php

$big = array("a", "b","c","d","e","f","g");
$small = array_slice($big, 2, 3);
foreach ($small as $var ) {
	print "$var <br>";
	}
?>