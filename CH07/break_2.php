<?php

$i = 0;
while (++$i) {
   switch ($i) {
   case 5:
       echo "At 5<br />\n";
       break 1;  /* for escaping 'switch' loop */
   case 10:
       echo "At 10; quitting<br />\n";
       break 2;  /* for escaping 'switch' and 'while' loop */
   default:
       break;
   }
}


?>