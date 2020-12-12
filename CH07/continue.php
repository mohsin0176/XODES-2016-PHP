<?php

$arr = array('one', 'two', 'three', 'four', 'stop', 'five');
while (list(, $val) = each($arr)) {
   if ($val == 'stop') {
       continue;    /* Here you can write 'continue 1;' */
   }
   echo "$val<br />\n";
}

?>