<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/pluggable.php');
global $wpdb;

$userId = $_REQUEST['userId'];

if($userId == ""){
	$val = array(
        'response' => false,
        'message' => 'Sorry, You are not authorized'
    );
    header('content-type:application/json');
    $jsonval = json_encode($val);
    echo $jsonval;
}else{
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $country = $_REQUEST['country'];
    $zip = $_REQUEST['zip'];
    $user_bio = $_REQUEST['user_bio'];
    $profile_image = $_REQUEST['profile_image'];
    $barber_type = $_REQUEST['barber_type'];
    

	$aux = get_userdata( $userId );

     /*     * * Check if the user with user id already exist ** */
   if($aux->ID==$userId){
	   
	   	if ( ! function_exists( 'wp_handle_upload' ) ) {
	   		require_once( ABSPATH . 'wp-admin/includes/file.php' );
	   	}

	   	$uploadedfile = $_FILES['profile_image'];

	   	$upload_overrides = array( 'test_form' => false );

	   	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

	   	if ( $movefile && !isset( $movefile['error'] ) ) {
	   		 
	   		// echo '<pre>';
	   		// var_dump( $movefile);
	   		 $profile_image = $movefile["url"];
    	   	 $table = "tbl_user_details";
             /* check user type*/
             $check_user_type = $wpdb->get_var( "SELECT user_type FROM tbl_user_details WHERE user_id='".$userId."'" );
             
             if($check_user_type == 'barber'){
                $data_array = array('user_bio' => $user_bio, 'profile_image' => $profile_image, 'barber_type' => $barber_type);   
             }else{
                $data_array = array('user_bio' => $user_bio, 'profile_image' => $profile_image);
             }
           	 $where = array('user_id' =>  $userId);
             $wpdb->update( $table, $data_array, $where );
        	 $user_updated_success = array(
                'Response' => TRUE,
                'Message' => 'Profile update Successfully'
            );
            //header('content-type:application/json');
            echo json_encode($user_updated_success);

	   	} else {
	    /**
	     * Error generated by _wp_handle_upload()
	     * @see _wp_handle_upload() in wp-admin/includes/file.php
	     */
	    	echo $movefile['error'];
	    	 $table = "tbl_user_details";
	       	 $data_array = array('user_bio' => $user_bio);
	         $where = array('user_id' =>  $userId);
	         $wpdb->update( $table, $data_array, $where );
	    	 $user_updated_success = array(
                'Response' => TRUE,
                'Message' => 'Profile update Successfully'
            );
            //header('content-type:application/json');
            echo json_encode($user_updated_success);

	   		
		}
   
     }else{
   	  $val = array(
            'Response' => false,
            'message' => 'User is not exist'
        );
        header('content-type:application/json');
        echo json_encode($val);
    }
}

?>
