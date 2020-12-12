<?php 
	header ("Content-type: image/png"); 

	$font_size = 15;
		
	$im = ImageCreate (300, 500); 

	$grey = ImageColorAllocate ($im, 230, 230, 230); 	
	$black = ImageColorAllocate ($im, 0, 0, 0); 

	$bbox = ImageTTFBBox($font_size, 0, "arial.ttf", "Bounding Box!");

	for($i = 0; $i < 7; $i++)
	/*	ImageTTFText($im, $font_size, 0, 10, ($i * ($font_size*2))+25, $black, 
			"arial.ttf", "\$bbox[$i] $bbox[$i]");
*/
	imagettftext($im,$font_size,0,10,($i * ($font_size*2))+25, $black, "arial.ttf", "\$bbox[$i] $bbox[$i]");

	ImagePng ($im); 
    echo "<img src=\"$im\" alt=\"Bounded Box\">";
	ImageDestroy ($im); 
?> 