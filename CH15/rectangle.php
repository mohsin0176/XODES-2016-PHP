<?php
header("Content-type: image/png");
$im = @imagecreate(200, 200)
   or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 255, 255, 255);
 
// sets some colors
$red = imagecolorallocate($im, 255, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

// drawing filled rectangle
imagefilledrectangle($im,10,10,180,180,$red);

//showing the image as PNG
imagepng($im); 
echo "<img src=\"$image\" alt=\"Pie Chart Created by PHP\">";
imagedestroy($im);

?>