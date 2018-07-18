<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/pluggable.php');
global $wpdb;

$id = $_REQUEST['id'];
$user_id = $_REQUEST['user_id'];


if($id == '' || $user_id== ""){
	$val = array(
        'response' => false,
        'message' => 'Sorry, You are not authorized'
    );
    
    $jsonval = json_encode($val);
    echo $jsonval;
 }else{
	
  $aux = get_userdata( $user_id );
  
     /*     * * Check if the user with user id already exist ** */
   if($aux->ID==$user_id){
	//print_r($final_slots_value);
  	
         $table = "tbl_timming_schedule";
     		 $where = array('id' =>  $id);
          $wpdb->update( $table, $data_array, $where );
          $wpdb->delete( $table, $where, $where_format = null );

     		$val = array(
  				"Response" => true,      
  						 "Message" => "Your time slot is deleted"
  			);
  			
  			$getval = json_encode($val);
  			echo $getval;
      
    }else{
      $val = array(
            'Response' => false,
            'message' => 'User is not exist'
        );
       
        echo json_encode($val);
   }
    
   		

 }


//http://phphosting.osvin.net/SalonApp/API/upadteTimming.php?user_id=31&day=monday&timeFrom=09:15&timeTo=24:15


?>
