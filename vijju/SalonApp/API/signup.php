<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/pluggable.php');
global $wpdb;


$user_login = $_REQUEST['user_email'];
$user_pass = $_REQUEST['password'];
$user_email =$_REQUEST['user_email'];
$display_name =$_REQUEST['full_name'];
$signup_type =$_REQUEST['signup_type'];
$user_type =$_REQUEST['user_type'];
$use_promo_code = $_REQUEST['use_promo_code'];



$userdata = array(
    'user_login'  =>  $user_login,
    'user_pass'   =>  $user_pass,
    'user_nicename'    =>  $user_nicename,
    'user_email'    =>  $user_email,
    'display_name' => $display_name
    
);

$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$my_personal_code = substr(str_shuffle($letters), 0, 8);

$refer_id = $wpdb->get_var( "SELECT user_id FROM tbl_user_details WHERE personal_code ='".$use_promo_code."'" );

if($user_email == '' || $user_pass == ''){
	echo json_encode(array('Response' => 'false', 'Message' => 'All fields are required'));
}elseif ( email_exists( $user_email ) ) {
		echo json_encode(array('Response' => 'false', 'Message' => 'This Email is already registered !'));
}elseif ( username_exists( $user_login ) ){
		echo json_encode(array('Response' => 'false', 'Message' => 'This User Name is already registered !'));
}else{
	//insert the record in wp_user table
		 $user_id = wp_insert_user( $userdata );
		 
		 wp_new_app_user_notification( $user_id,$user_pass);
		 //check is promo code exist
		 if($refer_id){
		 	$sql = $wpdb->query('INSERT INTO tbl_user_details (user_id,  signup_type, authkey,user_type,personal_code,refer_id) VALUES("' . $user_id  . '", "' . $signup_type . '", "' . uniqid() . '", "' . $user_type . '", "' . $my_personal_code . '", "' . $refer_id . '")');
		}else{
		 $sql = $wpdb->query('INSERT INTO tbl_user_details (user_id,  signup_type, authkey,user_type,personal_code) VALUES("' . $user_id  . '", "' . $signup_type . '", "' . uniqid() . '", "' . $user_type . '", "' . $my_personal_code . '")');
		}
		if($user_id){
				echo json_encode(array('Response' => 'true', 'Message' => 'User Registered successfully !', 'user_id' => $user_id));
		}else{
				echo json_encode(array('Response' => 'false', 'Message' => 'Try again !'));
		}
}
//http://phphosting.osvin.net/SalonApp/API/signup.php?full_name=adam singh&user_email=abc@gmail.com&password=adam@123&signup_type=facebook&user_type=barber
?>
