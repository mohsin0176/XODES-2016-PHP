<?php
class Articles extends DomDocument { 
    function __construct() { 
        //has to be called! 
        parent::__construct(); 
    } 
     
    function addArticle($title) { 
        $item = $this->createElement("item"); 
        $titlespace = $this->createElement("title"); 
        $titletext = $this->createTextNode($title); 
        $titlespace->appendChild($titletext); 
        $item->appendChild($titlespace); 
        $this->documentElement->appendChild($item); 
    } 
} 

$dom = new Articles(); 
$dom->load("articles.xml"); 
$dom->addArticle("XML in PHP5"); 
print $dom->saveXML("newfile.xml"); 

?>