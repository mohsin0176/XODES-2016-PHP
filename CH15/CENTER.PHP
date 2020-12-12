<?php
header ("Content-type: image/png"); 
$im = imagecreate(500,100); 
$text="This Text Should be Horizontally Centered";
$font="arial.ttf";
//choose textcolor (black)
$green=ImageColorAllocate ($im, 0, 255, 0);
$red = imagecolorallocate($im, 255,0,0);
//check width of the text
$bbox=imagettfbbox (12, 0, $font, $text);
$xcorr=0-$bbox[6];
$mase=$bbox[2]+$xcorr;
//check width of the image
$width = imagesx($im);
//calculate x coordinates for text
$new_x=($width-$mase)/2;
//write text
imagettftext ($im, 12, 0, $new_x, 50, $red, $font, $text);
//output picture
imagepng($im);

echo "<img src=\"$im\" alt=\"TTFBox by PHP\">";
imagedestroy($im);
?>