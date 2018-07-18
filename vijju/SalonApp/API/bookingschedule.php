<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/pluggable.php');
global $wpdb;

$user_id = $_REQUEST['user_id'];
$barber_id = $_REQUEST['barber_id'];
$time_slot = $_REQUEST['time_slot'];
$slot_details =$_REQUEST['slot_details'];
$transaction_id = $_REQUEST['transaction_id'];
$amount = $_REQUEST['amount'];
$offer_used = $_REQUEST['offer_used'];


if($user_id == ''){
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
   			/* check schedule already exist */
   			
   		$sql = $wpdb->query('INSERT INTO tbl_schedule (user_id,barber_id, time_slot,transaction_id, slot_date,amount,offer_used,date_booking) VALUES("' . $user_id  . '","' . $barber_id  . '", "' . $time_slot . '", "' . $slot_date . '", "' . $transaction_id . '", "' . $amount . '", "' . $offer_used . '",NOW())');
   
   		$val = array(
				"Response" => true,      
						 "Message" => "save"
			);
			
			$getval = json_encode($val);
			echo $getval;
        /* send eamil after booing to barber and customer*/
        wp_new_booking_user_notification( $user_id,$barber_id,$time_slot,$slot_details,$transaction_id);// customer email
        wp_new_booking_barber_notification( $barber_id); // barber email
   
   }else{
   	$val = array(
            'Response' => false,
            'message' => 'User is not exist'
        );
       
        echo json_encode($val);
   }
}


//http://phphosting.osvin.net/SalonApp/API/bookingschedule.php?user_id=21&barber_id=31&time_slot=monday&slot_details=09:15&slot_details=24:157amount=kbhk&offer_used=bvnb


?>
