<?php

$web = array("Web Publishing", "XML", "PHP Web Development");
$network = array ("Expert Networking", "Linux Networking");


$books = array_merge($web, $network);

foreach ($books as $book ) {
		print "$book <br>";
	}

?>