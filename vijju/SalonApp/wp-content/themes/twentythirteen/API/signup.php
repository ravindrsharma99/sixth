<?php
include_once('../../../../wp-config.php');
include_once('../../../../wp-load.php');
include_once('../../../../wp-includes/wp-db.php');
global $wpdb;


$user_login = $_REQUEST['user_name'];
//$user_url = $_REQUEST[''];
$user_pass = $_REQUEST['password'];
$user_nicename = $_REQUEST['user_nicename'];
$user_email =$_REQUEST['user_email'];
//$user_registered =$_REQUEST[''];
//$user_activation_key =$_REQUEST[''];
$user_status =$_REQUEST['user_status'];
$signup_type =$_REQUEST['signup_type'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$display_name  = $first_name.' '.$last_name; 

//$website = "http://example.com";

 //$sql = $wpdb->query('INSERT INTO wp_users (user_login, user_pass, user_nicename,user_email,user_status,signup_type,display_name) VALUES("' . $user_login . '", "' . $user_pass . '", "' . $user_nicename . '", "' . $user_email . '", "1", "' . $signup_type . '", "' . $display_name . '")');
//  mysqli_query($conn,$sql);
$userdata = array(
    'user_login'  =>  $user_login,
    'user_pass'   =>  $user_pass,
   // 'user_url'    =>  $website,
    'user_nicename'    =>  $user_nicename,
    'user_email'    =>  $user_email,
   // 'user_registered'    =>  $website,
  //  'user_activation_key'    =>  $website,
  //  'user_status' => '1',
   // 'signup_type' => $signup_type,
    'display_name' => $display_name
    
);

 $user_id = wp_insert_user( $userdata );
 $sql = $wpdb->query('INSERT INTO tbl_user_details (user_id,  signup_type, authkey) VALUES("' . $user_id  . '", "' . $signup_type . '", "' . uniqid() . '")');


//phphosting.osvin.net/SalonApp/sign-up?first_name=adam&last_name=singh&user_name=adam&password=adam@123&user_nicename&user_email=adam@gmail.com

 //http://phphosting.osvin.net/SalonApp/sign-up?first_name=adam&last_name=singh&user_name=adam&password=adam@123&user_nicename&user_email=adam@gmail.com
?>?>
