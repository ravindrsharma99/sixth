<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
global $wpdb;


$user_id = $_REQUEST['user_id'];
$token = $_REQUEST['token'];

 if($user_id == '' || $token ==''){
 	echo json_encode(array('Response' => 'false', 'Message' => 'All fields are required'));
 }else{
$alreaady_logout = $wpdb->get_var($wpdb->prepare("SELECT * FROM tbl_login WHERE user_id= '".$user_id."' AND token= '".$token."' AND status=0") ); 
$logout_data = $wpdb->get_var($wpdb->prepare("SELECT * FROM tbl_login WHERE user_id= '".$user_id."' AND token= '".$token."' AND status=1") ); 
//print_r($logout_data);

	if($logout_data){
		$table = "tbl_login";
        $data_array = array('status' => '0');
        $where = array('token' =>  $token);
        $wpdb->update( $table, $data_array, $where );
       // echo $wpdb->last_query;
        echo json_encode(array('Response' => 'true', 'Message' => 'Logout successfully!'));
    }elseif($alreaady_logout){
    	echo json_encode(array('Response' => 'true', 'Message' => 'Already Logout'));
    }else{
    	echo json_encode(array('Response' => 'false', 'Message' => 'Not valid details'));
    }
}
//http://phphosting.osvin.net/SalonApp/API/logout.php?user_id=adam&token=asdasdas
?>
