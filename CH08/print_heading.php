<?php
function print_heading($text,$size) {
	print "<h".$size.">".$text."</h".$size.">";
}

print_heading("This will be in Heading One",1);
print_heading("This will be in Heading Two",2);
print_heading("This will be in Heading Three",3);
print_heading("This will be in Heading Four",4);


?>