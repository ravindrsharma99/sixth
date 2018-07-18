<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/pluggable.php');
global $wpdb;


$category = $_REQUEST['category'];

if($category == 'main'){
  $parentId = '0';
}elseif($category == 'facial'){
  $parentId = '1';
}elseif($category == 'hair-cutting'){
  $parentId = '29';
}elseif($category == 'eyebrow'){
  $parentId = '36';
}elseif($category == 'hair-spa'){
  $parentId = '37';
}elseif($category == 'massage'){
  $parentId = '38';
}else{
  $parentId = 'NA';
}
if($parentId =='0'){
$message = 'Main services';
}else{
$message = 'Sub Services';
}

  $args = array(
      'orderby' => 'id',
      'hide_empty'=> 0,
      //'child_of' => 1, //Child of Category 
      'parent' => $parentId, //Parent of Category 
  );
  $categories = get_categories($args);
  // echo '<pre>';	
  //  print_r($categories);
  $val = array(
        'response' => true,
        'message' => $message,
        'categories' => $categories
    );
    
    $jsonval = json_encode($val);
    echo $jsonval;


//http://phphosting.osvin.net/SalonApp/API/getCategories.php?category=all


?>
