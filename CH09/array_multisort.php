<?php
$ar1 = array("10", 100, 100, "a");
$ar2 = array(1, 3, "2", 1);
array_multisort($ar1, $ar2);

var_dump($ar1);
var_dump($ar2);
?>