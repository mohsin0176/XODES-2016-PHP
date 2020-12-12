<?php
$dom = new DOMDocument();
$dom->load("articles.xml");

//print $dom->saveXML();
$titles = $dom->getElementsByTagName("title"); 
foreach($titles as $node) { 
   print $node->textContent . "\n"; 
}

foreach ($dom->documentElement->childNodes as $articles) { 
//if node is an element (nodeType == 1) and the name is "item" loop 
// further 
    if ($articles->nodeType == 1 && $articles->nodeName == "item") { 
        foreach ($articles->childNodes  as $item) { 
            //if node is an element and the name is "title", print it. 
            if ($item->nodeType == 1 && $item->nodeName == "title") { 
                print $item->textContent . "\n"; 
            } 
        } 
    } 
} 


?>