<?PHP
header("Content-type: image/png");
$im = @imagecreate(100, 100)
   or die("Cannot Initialize new GD image stream");

// sets some colors
//$green = imagecolorallocate($im, 0, 255, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

// drawing arc
imagearc($im,50,50,90,90,0,270,$black);

//imagefill($im,0,99,$black);
imagepng($im); 
imagedestroy($im);

?>