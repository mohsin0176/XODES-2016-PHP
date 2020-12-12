<?php
// set up array of points for polygon
$values = array(
           40,  50,  // Point 1 (x, y)
           20,  240, // Point 2 (x, y)
           60,  60,  // Point 3 (x, y)
           240, 60,  // Point 4 (x, y)
           50,  30,  // Point 5 (x, y)
           10,  10   // Point 6 (x, y)
           );

// create image
$image = imagecreate(250, 250);

// some colors
$bg   = imagecolorallocate($image, 200, 200, 200);
$blue = imagecolorallocate($image, 0, 0, 255);

// draw a polygon
imagefilledpolygon($image, $values, 6, $blue);

// flush image
header('Content-type: image/gif');
imagecolortransparent($image,$bg);
imagegif($image);
echo "<img src=\"$image\" alt=\"Polygon Created by PHP\">";
imagedestroy($image);
 ?>