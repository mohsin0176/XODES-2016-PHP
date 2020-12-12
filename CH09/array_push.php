<?php

$web = array("Web Publishing", "XML", "PHP Web Development");


$webnum = array_push($web, "Java 2", "ASP.NET");


print "There are $webnum books in this category (\$web).";


foreach ($web as $book ) {
		print "$book <br>";
	}
?>