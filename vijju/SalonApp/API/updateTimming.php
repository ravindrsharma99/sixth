<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
include_once('../wp-includes/pluggable.php');
global $wpdb;

echo $id = $_REQUEST['id'];
$user_id = $_REQUEST['user_id'];
$day = $_REQUEST['day'];
$timeFrom = $_REQUEST['timeFrom'];
$timeTo =$_REQUEST['timeTo'];

if($id == '' || $user_id== ""){
	$val = array(
        'response' => false,
        'message' => 'Sorry, You are not authorized'
    );
    
    $jsonval = json_encode($val);
    echo $jsonval;
 }else{
	
 	$time_diff = '60';
 	$timeStart = $timeFrom;
	$str_from_time = strtotime($timeStart);
	$str_to_time   = strtotime($timeTo);
	$diff =  $str_to_time - $str_from_time;
	$min_diff=floor($diff/60);
	$loovalue=$min_diff/$time_diff;
	$final_loop_value =floor($loovalue);
	$final = array();
	$i=1;
	while($i<=$final_loop_value){
		
	$starttimestamp = strtotime($timeStart.' + 0 minute');
	$endtimestamp = strtotime($timeStart.' + '.$time_diff.' minute');
	$start=date('H:i', $starttimestamp);
	$end=date('H:i', $endtimestamp);
	$final[]=$start.'-'.$end;
	$timeStart=$end;
	$i++;
	}
    $final_slots_value = implode(',', $final);
	//print_r($final_slots_value);
	$return='1';
	$check_day_exist = $wpdb->get_results( "SELECT * FROM tbl_timming_schedule WHERE barber_id='".$user_id."' and day ='".$day."' and id!='".$id."'" );
	$from_time = $_REQUEST['timeFrom'];
	$to_time =$_REQUEST['timeTo'];
	$maxTime = strtotime($to_time);
	$minTime = strtotime($from_time);
	$minutes= round(abs($maxTime - $minTime) / 60,2);
    foreach ($check_day_exist as $value) {
   	
    	// $from=  $value->timeFrom;
    	// $to = $value->timeTo; 
    	// $date = time();

    	  $fromtime=$value->timeFrom;
          $totime=$value->timeTo;

          if(  (strtotime($from_time) > strtotime($fromtime) && strtotime($from_time) < strtotime($totime)) || (strtotime($to_time) > strtotime($fromtime) && strtotime($to_time) < strtotime($totime)) )
          {
           $return=0;
          }

          if(  (strtotime($fromtime) > strtotime($from_time) && strtotime($fromtime) < strtotime($to_time)) || (strtotime($totime) > strtotime($from_time) && strtotime($totime) < strtotime($to_time)) )
          {
           $return=0;
          }

           if(  (strtotime($fromtime) == strtotime($from_time) &&  (strtotime($totime) == strtotime($to_time) )))
          {
           $return=0;
          }
		$return;
    }

   if($return == '0'){
   		$val = array(
            'Response' => false,
            'message' => 'time confection error'
        );
       
        echo json_encode($val);

	}elseif($from_time>$to_time){
		$val = array(
            'Response' => false,
            'message' => 'Please enter the valid time'
        );
       
        echo json_encode($val);

	}elseif( $minutes<60 ){
		$val = array(
            'Response' => false,
            'message' => 'Please enter minimum 1 hour'
        );
       
        echo json_encode($val);
	}elseif($final_slots_value == ""){
		$val = array(
            'Response' => false,
            'message' => 'Not valid Details'
        );
         echo json_encode($val);
	}else{
   		$table = "tbl_timming_schedule";
   		$data_array = array('timeFrom' => $timeFrom, 'timeTo' => $timeTo , 'timeSlot' => $final_slots_value,'date_created' => date("Y-m-d H:i:s"));
   		$where = array('id' =>  $id);
        $wpdb->update( $table, $data_array, $where );

   		$val = array(
				"Response" => true,      
						 "Message" => "Your time slot is update"
			);
			
			$getval = json_encode($val);
			echo $getval;
    }
    
   		

 }


//http://phphosting.osvin.net/SalonApp/API/upadteTimming.php?user_id=31&day=monday&timeFrom=09:15&timeTo=24:15


?>
