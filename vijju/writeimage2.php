<?php
header("Content-type: image/jpeg");
    $imgPath = '2.jpg';
    $image = imagecreatefromjpeg($imgPath);
    $color = imagecolorallocate($image, 255, 255, 255);
    $string = $_REQUEST['p'];
    $fontSize = "30";
    $x = 310;
    $y = 485;
	$font = imageloadfont('mono.ttf');
    imagestring($image, $fontSize, $x, $y, $string, $color);
    imagejpeg($image);



 /*  //Set the Content Type
  header('Content-type: image/jpeg');

  // Create Image From Existing File
  $jpg_image = imagecreatefromjpeg('loginbg.jpg');

  // Allocate A Color For The Text
  $white = imagecolorallocate($jpg_image, 255, 255, 255);

  // Set Path to Font File
  $font_path = 'glyphicons-halflings-regular.TTF';

  // Set Text to Be Printed On Image
  $text = "This is a sunset!";

  // Print Text On Image
  imagettftext($jpg_image, 25, 0, 75, 300, $white, $font_path, $text);

  // Send Image to Browser
  imagejpeg($jpg_image);

  // Clear Memory
  imagedestroy($jpg_image); */
?> 