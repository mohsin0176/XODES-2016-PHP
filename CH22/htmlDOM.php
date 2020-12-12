<?php
$dom = new DomDocument(); 
$dom->loadHTMLFile("http://www.w3.org/"); 
$titles = $dom->getElementsByTagName("h3"); 
foreach ($titles as $title) {
	print $title->textContent."<br>";
}

?>