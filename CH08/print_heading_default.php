<?php
function print_heading($text,$size=2) {
	print "<h".$size.">".$text."</h".$size.">";
}

print_heading("This will be in Heading One",1);
print_heading("I did not mention the size");
print_heading("This will be in Heading Three",3);
print_heading("This will be in Heading Four",4);


?>