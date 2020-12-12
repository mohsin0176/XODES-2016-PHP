<?php
header("Content-type: image/png");
$im = @imagecreate(100, 100)
   or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 0, 255, 0);
 
// sets background to red

$background = imagecolorallocate($im, 255, 0, 0);

// sets some colors
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

// drawing lines
imageline($im,10,10,80,80,$black);
imagepng($im); 
imagedestroy($im);
?>
