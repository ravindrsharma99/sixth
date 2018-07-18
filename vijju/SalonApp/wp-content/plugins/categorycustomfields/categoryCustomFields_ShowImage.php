<?php
# Constants
//echo urlencode("c:/xampp/htdocs/wp/wp-content/uploads/2011/05/DSCN0039.JPG");
$MAX_WIDTH=10000;
$MAX_HEIGHT= 10000;
if(isset($_GET['width']))
	$MAX_WIDTH = $_GET['width'];
if(isset($_GET['height'])>0)
	$MAX_HEIGHT = $_GET['height'];
# Get image location

$image_path = $_GET['path'];
//$image_path="c:/xampp/htdocs/wp/wp-content/uploads/2011/05/DSCN0039.JPG";

# Load image
$img = null;
$a=explode('.', $image_path);
$a=end($a);
$ext = strtolower($a);
if ($ext == 'jpg' || $ext == 'jpeg') {

    $img = @imagecreatefromjpeg($image_path);
	
} else if ($ext == 'png') {
    $img = @imagecreatefrompng($image_path);
# Only if your version of GD includes GIF support
} else if ($ext == 'gif') {
    $img = @imagecreatefrompng($image_path);
}


# If an image was successfully loaded, test the image for size
if ($img) {

    # Get image size and scale ratio
    $width = imagesx($img);
    $height = imagesy($img);
    $scale = min($MAX_WIDTH/$width, $MAX_HEIGHT/$height);

    # If the image is larger than the max shrink it
    if ($scale < 1) {
        $new_width = floor($scale*$width);
        $new_height = floor($scale*$height);

        # Create a new temporary image
        $tmp_img = imagecreatetruecolor($new_width, $new_height);

        # Copy and resize old image into new image
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0,
                         $new_width, $new_height, $width, $height);
        imagedestroy($img);
        $img = $tmp_img;
    }
}

# Create error image if necessary
if (!$img) {
    $img = imagecreate($MAX_WIDTH, $MAX_HEIGHT);
    imagecolorallocate($img,0,0,0);
    $c = imagecolorallocate($img,70,70,70);
    imageline($img,0,0,$MAX_WIDTH,$MAX_HEIGHT,$c2);
    imageline($img,$MAX_WIDTH,0,0,$MAX_HEIGHT,$c2);
}

# Display the image
header("Content-type: image/jpeg");
imagejpeg($img);
?>