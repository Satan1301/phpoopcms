<?php
	header ( "Content-Type: image/gif" );
	$im  =  imagecreate ( 10,  200 );
	$red  =  imagecolorallocate ( $im,  255,  0,  0 );
	$white  =  imagecolorallocate ( $im ,  255,  255,  255 );
	$blue  =  imagecolorallocate ( $im ,  0 ,  0 ,  255 );
	$gray  =  imagecolorallocate ( $im , 0xC0, 0xC0 , 0xC0 );
	imagefill ( $im , 0 , 0 , $gray );
	imagefilledrectangle ( $im , 0 ,$bluehg, 3, 200, $blue );
	imagefilledrectangle ( $im , 6, $redhg, 10, 200, $red );
	imagegif ( $im );
?> 