<?php
header("Content-type: image/png");
//height adn width
$height = 100;
$width = 200;
$font_size = 50;

if (!isset($text)) {
	$text = "Resize Me";
}
$im = imagecreate($width, $height);

//colors
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
$font = "arial.ttf";
$text_width = $width;
$text_height;

while (1) {
	$box = imagettfbbox($font_size, 0, $font, $text);
	$text_width = abs($box[2]);
	$text_body_height = (abs($box[7])) -2;
	
	if ($text_width<($width-20)) {
		break;
		$font_size--;
	}
	
}

$imXcenter = (int) ($width/2);
$imYcenter = (int) ($height/2);

imagettftext($im, $font_size, 0, (int) ($imXcenter - ($width/2)), (int) ($imYcenter - ($text_body_height/2)), $blue, $font, $text);
imagepng($im);

echo "<img src=\"$im\" alt=\"TTFBox by PHP\">";
imagedestroy($im);

?>
