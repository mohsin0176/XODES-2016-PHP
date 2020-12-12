<?php
$sxe = simplexml_load_file("articles.xml"); 
foreach($sxe->item as $item) { 
    print $item->title ."\n"; 
}
?>
