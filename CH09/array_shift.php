<?php

$fruits = array("Apple", "Orange", "Mango", "Jackfruit");

while (count($fruits)) {
$fruit = array_shift($fruits);
print "Thrown away: $fruit<br>";
print "Now we have ".count($fruits)." fruit(s) in \$fruits basket <br>";
}

?>