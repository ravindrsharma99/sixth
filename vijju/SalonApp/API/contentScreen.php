<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/post-template.php');
global $wpdb;

$content_name =  $_REQUEST['content_name'];
if($content_name == ""){
	echo json_encode(array('Response' => 'false', 'Message' => 'Content Name is blank'));

}else{
	if($content_name == 'about'){
		$single_id = "137";
	}elseif($content_name == 'how-it-work'){
		$single_id = "135";
	}elseif($content_name == 'privacy'){
		$single_id = "133";
	}elseif($content_name == 'terms'){
		$single_id = "131";
	}
	
	$page_details = get_page( $single_id );
	$content = $page_details->post_content;
	echo json_encode(array('Response' => 'true', 'Message' => 'successfully', 'page-content' => $content));
}
//http://phphosting.osvin.net/SalonApp/API/contentScreen.php?content_name=privacy
?>
