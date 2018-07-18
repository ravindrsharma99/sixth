<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');




// create new imagick object from image.jpg
$im = new Imagick( "frame_0.png" );

// change format to png
$im->setImageFormat( "svg" );

// output the image to the browser as a png
header( "Content-Type: image/svg" );
echo $im;

// or you could output the image to a file:
//$im->writeImage( "image.png" );




?>