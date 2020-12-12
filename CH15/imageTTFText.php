<?php

// Set the content-type
header("Content-type: image/png");

// Create the image
$im = imagecreate(400, 30);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 255, 0, 0);
$black = imagecolorallocate($im, 0, 0, 0);

// The text to draw
$text = 'This is my Text';
// Replace path by your own font path
$font = 'arial.ttf';

// Add some shadow to the text
imagettftext($im, 20, 0, 11, 21, $red, $font, $text);

// Add the text
imagettftext($im, 20, 0, 9, 19, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
echo "<img src=\"$im\">";
imagedestroy($im);
?>