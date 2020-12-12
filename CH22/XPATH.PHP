<?php
$dom = new DOMDocument();
$dom->load("articles.xml");

$xp = new domxpath($dom); 
$titles = $xp->query("/articles/item/title"); 
foreach ($titles as $node) { 
    print $node->textContent . "\n"; 
} 


?>