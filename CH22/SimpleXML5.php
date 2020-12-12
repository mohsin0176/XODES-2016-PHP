<?php
$sxe = simplexml_load_file("articles.xml"); 

foreach($sxe->children() as $second_level) { 
    print "Second Level Node:".$sxe->$second_level.textContent."\n"; 
} 

?>
