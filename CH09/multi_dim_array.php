<?php

$fruits = array ( "fruits"  => array( "a" => "orange",
                                      "b" => "banana",
                                      "c" => "apple"
                                    ),
                 "numbers" => array ( 1,2,3,4,5,6),
                 "holes"   => array (    "first",
                                      5 => "second",
                                          "third"
                                    )
               );

echo $fruits["holes"][5];    // prints "second"
echo $fruits["fruits"]["a"]; // prints "orange"
unset($fruits["holes"][0]);  // remove "first"


$juices["apple"]["green"] = "good";


?>