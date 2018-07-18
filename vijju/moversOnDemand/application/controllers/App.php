<?php
error_reporting(0);
// ini_set('display_errors','1');
class App extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model','',TRUE);
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library("braintree_lib");
		// date_default_timezone_set('UTC');
        // date_default_timezone_set($_SESSION['timezone_dynamic']);
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	/*home page view*/
	public function index(){
		$this->load->view('Template/header');
		$this->load->view('index');
		$this->load->view('Template/footer');
	}
	public function timezone(){
		$vv = $this->input->post('time');
		$_SESSION['timezone_dynamic'] = $vv;
		print_r($_SESSION['timezone_dynamic']);
	}
	public function CreateAccount(){
		$this->load->view('Template/inner/header');
		//$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Edit_Profile');
	}
	public function MyProfile(){
		if(isset($_POST['editprofile'])){
			$data = [
				'id'=>$_SESSION['user_details']->id,
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'company_name'=>$this->input->post('company_name'),
				'phone'=>$this->input->post('phone'),
				'oldpassword'=>$this->input->post('oldpass'),
				'newpassword'=>$this->input->post('newpass'),
				'country_code'=>$this->input->post('country_code'),
				'profile_pic'=>$_FILES['upload_pic']['name']
			];	
			$url = 'http://movers.com.au/Admin/api/User/updateprofile';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			// print_r($output);die;
			if($output->ResponseCode == 1){
				$this->session->set_flashdata('error',$output->MessageWhatHappen);
				$profile['info'] = $output->Response[0];
			}else{
				$this->session->set_flashdata('error',$output->MessageWhatHappen);
			}
		}

		$url = 'http://movers.com.au/Admin/api/User/getprofile';
		$data = [
			'user_id'=>$_SESSION['user_details']->id
		];
		$options = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
		)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		if($output->ResponseCode == 1){
			$profile['info'] = $output->Response[0];
		}else{
			$this->session->set_flashdata('error',$output->MessageWhatHappen);
		}
		// echo "<pre>";print_r($profile);die;
		$this->load->view('Template/inner/header',$profile);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('my_profile');
	}
	public function Signup(){
		$this->load->view('Template/header');
		$this->load->view('Sign_Up');
		$this->load->view('Template/footer');
	}
	public function Estimate(){
		$this->load->view('get-free-estimate');
		$this->load->view('Template/footer');
	}
	public function fbLogin(){
		$data = [
			'fname'=>$this->input->post('name'),
			'lname'=>$this->input->post('lname'),
			'email'=>$this->input->post('email'),
			'fb_id'=>$this->input->post('user_id'),
			'profile_pic'=>$this->input->post('picture')
		];
		$var = $this->Admin_model->select_data('fb_id','tbl_users',array('fb_id'=>$data['fb_id']));
		if(empty($var)){
			unset($_SESSION['gogledata']);
			$_SESSION['fbdata'] = $data;
			echo "2";
		}else{
			echo "1";
		}
	}
	public function googleLogin(){
		$data = [
			'fname'=>$this->input->post('name'),
			'lname'=>$this->input->post('familyname'),
			'email'=>$this->input->post('email'),
			'google_id'=>$this->input->post('google_id'),
			'profile_pic'=>$this->input->post('imageUrl')
		];
		$var = $this->Admin_model->select_data('google_id','tbl_users',array('google_id'=>$data['google_id']));
		if(empty($var)){
			unset($_SESSION['fbdata']);
			$_SESSION['gogledata'] = $data;
			echo "2";
		}else{
			echo "1";
		}
	}
	public function findplace12(){
		if(isset($_POST['origin'])){
			$origin = $_POST['origin'];
		    $destination = $_POST['destination'];
		    $place = "https://maps.googleapis.com/maps/api/geocode/json?address=".$origin."&key=AIzaSyDurzeFEiJdNJvMe72sxiCIxsOh0YT7YPY";
		    $json = file_get_contents($place);
		    $dataS = json_decode($json); 	
		    $check = $dataS->results[0]->address_components;
		    foreach ($check as $key => $value) {
		    	$hello = $value->types;		    	
		    	foreach($hello as $key => $type){
		    		if($type == "locality"){
		    			$locality = $value->long_name;
		    		}else{
		    			unset($hello[$key]);
		    		}
		    		if($type == "country"){
		    			$country = $value->long_name;
		    		}else{
		    			unset($hello[$key]);
		    		}
		    	}
		    }		   
		    $data = array(
				'city_name'=>$locality,
				'country_name'=>$country
			);
			$url = 'http://movers.com.au/Admin/api/User/getCities';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			if ($output->ResponseCode == 1) {
				$city_id = $output->Response[0]->id;
				$_SESSION['descity_id'] =$city_id;
				$this->getDistance();
			}else{
				return "error";
			}
		}	
	}
	public function findplace(){
		if(isset($_POST['origin'])){
			$origin = $_POST['origin'];
		    $destination = $_POST['destination'];
		    $place = "https://maps.googleapis.com/maps/api/geocode/json?address=".$origin."&key=AIzaSyDurzeFEiJdNJvMe72sxiCIxsOh0YT7YPY";
		    $json = file_get_contents($place);
		    $dataS = json_decode($json); 	
		    $check = $dataS->results[0]->address_components;
		    foreach ($check as $key => $value) {
		    	$hello = $value->types;		    	
		    	foreach($hello as $key => $type){
		    		if($type == "locality"){
		    			$locality = $value->long_name;
		    		}else{
		    			unset($hello[$key]);
		    		}
		    		if($type == "country"){
		    			$country = $value->long_name;
		    		}else{
		    			unset($hello[$key]);
		    		}
		    	}
		    }
		    // print_r($locality);
		    // print_r($country);		   
		    $data = array(
				'city_name'=>$locality,
				'country_name'=>$country
			);
			$url = 'http://movers.com.au/Admin/api/User/getCities';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			 // print_r($output);
			// $_SESSION['output'] = $output;
			if ($output->ResponseCode == 1) {
				$city_id = $output->Response[0]->id;
				// if(isset($_POST['abc']) == 1){
				// 	$_SESSION['descity_id'] =$city_id;
				// }else{
				$_SESSION['city_id'] =$city_id;
			//}
				$this->getDistance();
			}else{
				return "error";
			}
		}	
	}
	public function getDistance(){
		if(isset($_POST['origin'])){
		    $origin = $_POST['origin'];
		    $destination = $_POST['destination'];
			$url = "https://maps.googleapis.com/maps/api/directions/json?mode=driving&origin=".$origin."&destination=".$destination."&sensor=false&key=AIzaSyDurzeFEiJdNJvMe72sxiCIxsOh0YT7YPY";    
		    $json = file_get_contents($url);
		    $dataS = json_decode($json); 	   
			$newdis = ($dataS->routes[0]->legs[0]->distance->value) /1000;
			$mapData = array(
				'distance'=>$dataS->routes[0]->legs[0]->distance->value,
		  	    'duration'=>$dataS->routes[0]->legs[0]->duration->text,
				'duration_value'=>$dataS->routes[0]->legs[0]->duration->value,
				'pickupLat'=>$dataS->routes[0]->legs[0]->start_location->lat,
				'pickupLong'=>$dataS->routes[0]->legs[0]->start_location->lng,
				'dropoffLat'=>$dataS->routes[0]->legs[0]->end_location->lat,
				'dropoffLong'=>$dataS->routes[0]->legs[0]->end_location->lng,
				'pickupAdd'=>$dataS->routes[0]->legs[0]->start_address,
				'dropOffAdd'=>$dataS->routes[0]->legs[0]->end_address,
				'polyline'=>$dataS->routes[0]->overview_polyline->points,
				'distInKms'=>$newdis,
				'city_id'=>$_SESSION['city_id']
			);	
			$_SESSION['mapData'] =$mapData;
		    print_r(json_encode($mapData));
		}	
	}
	public function myLogin(){
		if(isset($_POST['mydata'])){
			$userinfo = $_POST['mydata'];
			// $_SESSION['timestamp'] = date('Y-m-d H:i:s');
			$_SESSION['user_details'] =(object)$userinfo;
			date_default_timezone_set('UTC');		       
	        $asia_timestamp = strtotime($selection);
	        date_default_timezone_set($_SESSION['timezone_dynamic']);
	        $utcDateTime = date("H:i:s", $asia_timestamp);
			$cur = date('Y-m-d H:i:s');
			$_SESSION['timeoout'] = strtotime($cur);
		}
	}
//////////////////////////////////////////////////////////////////////// Booking Tab /////////////////////////////////////////////////////////////////////////////

	public function desBooking(){		
		redirect('book');
	}
	public function home(){
		unset($_SESSION['calculatedSpecificFare']);
		unset($_SESSION['receiptImage']);
		unset($_SESSION['moveType']);
		unset($_SESSION['receiptNumber']);
		unset($_SESSION['movingDesc']);
		unset($_SESSION['mybookingData']);
		unset($_SESSION['itemImage']);
		unset($_SESSION['selectedVehicle']);
		unset($_SESSION['mapData']);
		unset($_SESSION['promoapplydata']);
		unset($_SESSION['promoapplyid']);
		unset($_SESSION['city_id']);
		unset($_SESSION['descity_id']);
		unset($_SESSION['movereq']);
		unset($_SESSION['sel_card_id']);
		unset($_SESSION['sel_card_name']);
		unset($_SESSION['showHistory']);
		unset($_SESSION['time_slot']);
		unset($_SESSION['promoapplyid']);
		unset($_SESSION['editbookdata']);
		unset($_SESSION['retryBook']);
		unset($_SESSION['retryPromoVal']);
		unset($_SESSION['retryPromoVal_id']);
		unset($_SESSION['errorpromo']);
		unset($_SESSION['NewBook_id']);
		unset($_SESSION['retryMove']);

		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('select_move-type');
	}
	public function prehome(){
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('select_move-type');
	}
	public function page1(){
		// if(isset($_FILES['receiptImage'])){
		// 	$filen = $_FILES["receiptImage"]['name'];
		// 	$path = 'public/receipt_image/'.$filen; 
		// 	$mypath = base_url('public/receipt_image/').$filen;
				
		// 	if(move_uploaded_file($_FILES["receiptImage"]['tmp_name'],$path)){
		// 		$GLOBALS['msg'] .= "File# ".($j+1)." ($filen) uploaded successfully<br>";
		// 		$_SESSION['receiptImage'] = $mypath;
		// 			//echo "<pre>";print_r($_SESSION);die;
		// 	}else{
		// 		$GLOBALS['msg'] = "No files found to upload"; //No file upload message 
		// 	}
		// }
		//if(isset($_POST['moveType'])){
			// if(!empty($_POST['moveType'])){
				$_SESSION['moveType'] =	$_POST['moveType'];
				// $_SESSION['receiptNumber'] = $_POST['receiptNumber'];			
				 // echo "<pre>";print_r($_SESSION);die;
				$this->load->view('Template/inner/header');
				$this->load->view('Template/inner/Left_sidebar');
				//$this->load->view('moving');	
				$this->load->view('pickup-destination1');
			// }else{
			// 	$this->session->set_flashdata('error',"Please select Move type");
			// 	redirect('App/home');
			// }
		// }else{
		// 	$this->session->set_flashdata('error',"Please select Move type");
		// 	redirect('book');
		// }
	}
	public function page3(){
		if(isset($_POST['submit'])){
			$_SESSION['mybookingData']=$_POST;
		}
		// echo "<pre>"; print_r($_SESSION);die;
		$this->load->view('Template/inner/header');	
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_vehicle-type');
	}	
	public function page4(){
		if(isset($_POST['submit'])){
			foreach($_SESSION['vehicleData'] as $key){
				if($key->id == $_POST['vehicleData']){
					$_SESSION['selectedVehicle'] = $key;	
				}
			}
			$_SESSION['movereq'] = empty($this->input->post('moverRequired'))?1:$this->input->post('moverRequired');
			if($_SESSION['movereq'] == 1){
				$move_charge = $_SESSION['selectedVehicle']->movers_charges1;
			}else{
				$move_charge = $_SESSION['selectedVehicle']->movers_charges2;
			}
			$hoursCharged = round(($_SESSION['mapData']['duration_value'] / 60) % 60);
			$km_charges   =  round($_SESSION['selectedVehicle']->km_charges*$_SESSION['mapData']['distInKms'],2);
			$hour_charges = round($hoursCharged * $move_charge,2);
			$min_hour = round($_SESSION['selectedVehicle']->min_minutes * $move_charge,2);
			$max_hour = round($_SESSION['selectedVehicle']->max_minutes * $move_charge,2);
			$min_fare = round($km_charges + $hour_charges + $min_hour,2);
			$max_fare = round($km_charges + $hour_charges + $max_hour,2);
			$_SESSION['showHistory'] = [
				'km_chrge'=>$km_charges,
				'hour_chrge'=>$hour_charges,
				'min_loading'=>$min_hour,
				'max_loading'=>$max_hour
			];
			$_SESSION['calculatedSpecificFare'] = array(
				'user_id'=>$_SESSION['user_details']->id,
				'vehicle_id' =>$_SESSION['selectedVehicle']->id,
				'move_id'=>$_SESSION['moveType'],
				'receipt_number'=>'',
				'pickup_loc'=>$_SESSION['mapData']['pickupAdd'],
				'destination_loc'=>$_SESSION['mapData']['dropOffAdd'],
				'booking_date'=>'',
				'pickup_latitude'=>$_SESSION['mybookingData']['pickuplat'],
				'pickup_longitude'=>$_SESSION['mybookingData']['pickuplng'],
				'destination_latitude'=>$_SESSION['mybookingData']['dropofflat'],
				'destination_longitude'=>$_SESSION['mybookingData']['dropofflng'],
				'description'=>'',
				'receipt_image'=>'',
				'time_duration'=>$_SESSION['mapData']['duration_value'],
				'distance'=>$_SESSION['mapData']['distInKms'],
				'path_polyline'=>base64_encode($_SESSION['mapData']['polyline']),
				'item_image1'=>'',
				'item_image2'=>'',
				'item_image3'=>'',
				'item_image4'=>'',
				'pickupcity_id'=>$_SESSION['city_id'],
				'destinationcity_id'=>$_SESSION['descity_id'],
				'slot_starttime'=>'',
				'slot_endtime'=>'',
				'no_of_movers'=>$_SESSION['movereq'],
				'time_zone_start'=>'',
				'time_zone_end'=>'',
				'min_estimate_price'=>$min_fare,
				'max_estimate_price'=>$max_fare		
			);	
		}
		// echo "<pre>";print_r($_SESSION);die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_picuptime');		
	}
	public function page5(){		
		if(isset($_POST['datepick'])){
			// $datetime= str_replace('/','-',$_POST['datepick']);
			// $date_arr = explode(' ',$datetime);
			// $sdate=date('Y-m-d', strtotime($date_arr[0]));
			// $mydate = $sdate.' '.$date_arr[1]. ':00';
			// date_default_timezone_set('Asia/Calcutta');
			// $asia_timestamp = strtotime($mydate);
			// date_default_timezone_set('UTC');
			// $utcDate = date("Y-m-d", $asia_timestamp);
			// $utcTime = date("H:i:s", $asia_timestamp);
			// $_SESSION['calculatedSpecificFare']['datetime'] = $_POST['datepick']; 
			// $_SESSION['calculatedSpecificFare']['booking_date'] = $utcDate;
			// $_SESSION['calculatedSpecificFare']['booking_time'] = $utcTime;	
			$ttime = $this->input->post('timeslotsel');
			$explode = explode('-',$ttime);
			$_SESSION['calculatedSpecificFare']['booking_date'] = $_SESSION['time_slot'];
			$_SESSION['calculatedSpecificFare']['slot_starttime'] = $explode[0];
			$_SESSION['calculatedSpecificFare']['slot_endtime'] = $explode[1];	
			$_SESSION['calculatedSpecificFare']['time_zone_start'] = $_SESSION['time_slot'].' '.$explode[0];
			$_SESSION['calculatedSpecificFare']['time_zone_end'] = $_SESSION['time_slot'].' '.$explode[1];
        }
		// echo "<pre>";print_r($_SESSION);die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		// $this->load->view('book-move');	
		$this->load->view('store_pickup');
	}
	public function page9(){
		if(isset($_POST['receiptup'])){	
			$ttime = $this->input->post('timeslotsel');
			$explode = explode('-',$ttime);
			$_SESSION['calculatedSpecificFare']['booking_date'] = $_SESSION['time_slot'];
			$_SESSION['calculatedSpecificFare']['slot_starttime'] = $explode[0];
			$_SESSION['calculatedSpecificFare']['slot_endtime'] = $explode[1];	
			$_SESSION['calculatedSpecificFare']['time_zone_start'] = $_SESSION['time_slot'].' '.$explode[0];
			$_SESSION['calculatedSpecificFare']['time_zone_end'] = $_SESSION['time_slot'].' '.$explode[1];
        }
		if(isset($_FILES['receiptImage'])){
			$filen = $_FILES["receiptImage"]['name'];
			$path = 'public/receipt_image/'.$filen; 
			$mypath = base_url('public/receipt_image/').$filen;
				
			if(move_uploaded_file($_FILES["receiptImage"]['tmp_name'],$path)){
				$GLOBALS['msg'] .= "File# ".($j+1)." ($filen) uploaded successfully<br>";
				$_SESSION['receiptImage'] = $mypath;
				$_SESSION['calculatedSpecificFare']['receipt_image'] = $mypath;
					//echo "<pre>";print_r($_SESSION);die;
			}else{
				$GLOBALS['msg'] = "No files found to upload"; //No file upload message 
			}
		}
		if(isset($_POST['moveType1'])){
			$_SESSION['receiptNumber'] = $_POST['receiptNumber'];
			$_SESSION['calculatedSpecificFare']['receipt_number'] = $_POST['receiptNumber'];
		}
		// echo "<pre>";print_r($_SESSION);die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('moving');
	}
	public function page2($cardId=null,$cardName=null){
		if($cardId != null && $cardName != null){
			$name = base64_decode($cardName);
			$cardN = explode('_',$name);
			$nameC = base64_decode($cardId);
			$cardI = explode('_',$nameC);
			$_SESSION['sel_card_name'] = $cardN[0];
			$_SESSION['sel_card_id'] = $cardI[0];
		}
		if(isset($_FILES['itemImage'])){ 
			if(count($_FILES["itemImage"]['name'])>0)
				 { 
				$GLOBALS['msg'] = ""; //initiate the global message
				  for($j=0; $j < count($_FILES["itemImage"]['name']); $j++)
				 { 
				   $filen = $_FILES["itemImage"]['name']["$j"]; //file name
				   $path = 'public/item_image/'.$filen; //generate the destination path
			           $mypath[] = base_url('public/item_image/').$filen;
				   if(move_uploaded_file($_FILES["itemImage"]['tmp_name']["$j"],$path)) 
				      {
				    $GLOBALS['msg'] .= "File# ".($j+1)." ($filen) uploaded successfully<br>";
				    $_SESSION['itemImage'] = $mypath;
				    $_SESSION['calculatedSpecificFare']['item_image1']=$_SESSION['itemImage'][0];
					$_SESSION['calculatedSpecificFare']['item_image2']=$_SESSION['itemImage'][1];
					$_SESSION['calculatedSpecificFare']['item_image3']=$_SESSION['itemImage'][2];
					$_SESSION['calculatedSpecificFare']['item_image4']=$_SESSION['itemImage'][3];
				   }else{
				    $_SESSION['itemImage'] = '';}
				  }
				 }
				 else {
				  $GLOBALS['msg'] = "No files found to upload"; //No file upload message 
				}
				//print_r($GLOBALS['msg']);echo "<pre>";print_r($mypath);die;				
			// $_SESSION['itemImage'] = $mypath;
		}
		if(isset($_POST['movingDesc'])){
		  $_SESSION['movingDesc'] = $_POST['movingDesc'];
		  $_SESSION['calculatedSpecificFare']['description'] = $_POST['movingDesc'];			
		}

		$data = [
			'user_id'=>$_SESSION['user_details']->id
		];
		$url = 'http://movers.com.au/Admin/api/User/cardListing';
		// $url = 'http://phphosting.osvin.net/Admin/api/User/cardListing';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		if($output->ResponseCode == 1) { /* Handle error */ 
			$responseData['defaultCard'] =  $output->Response;
			$_SESSION['bookCharge'] = $output->setData[0]->min_booking_charge;
		}else{
			$error_msg ="NO DATA FOUND";
			//echo $error_msg; 				
		}
		// echo "<pre>";print_r($output);die;
		// echo "<pre>";print_r($_SESSION);die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar',$responseData);
		// $this->load->view('pickup-destination1');
		$this->load->view('book-move');
	}
	public function promocode($promoid=null){
		if($promoid != null){
			$_SESSION['retryPromoVal_id'] = $promoid;
		}
		$data = [
			'user_id'=>$_SESSION['user_details']->id,
			'type'=>1
		];
		$url = 'http://movers.com.au/Admin/api/User/getPromo';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		// echo"<pre>";print_r($output);die;
		if($output->ResponseCode == 1) { /* Handle error */ 
			$responseData =  $output->response;
		}else{
			$error_msg ="NO DATA FOUND";
		}
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('free-moves-listings');
	}
	public function prodata(){
		if(isset($_POST['applypromo'])){
			$data12 = [
				'user_id'=>$_SESSION['user_details']->id,
				'promo_id'=>empty($this->input->post('promoid'))?'':$this->input->post('promoid'),
				'promocode'=>empty($this->input->post('promocode'))?'':$this->input->post('promocode')
			];
			$url = 'http://movers.com.au/Admin/api/User/applypromo';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data12)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			if($output->ResponseCode == 1) {
				unset($_SESSION['errorpromo']);
				$responseData =  $output->response;
				$_SESSION['promoapplydata'] = $responseData->promocode[0];
				$_SESSION['promoapplyid'] = $responseData->promodata[0]->id;
				$_SESSION['calculatedSpecificFare']['promoid'] = $responseData->promodata[0]->id;
				redirect('book_order');
			}else{
				unset($_SESSION['promoapplydata']);
				$error = $output->MessageWhatHappen;
				$_SESSION['errorpromo'] = $error;
				redirect('promo');
			}			
		}
	}
	public function cancelpromocode(){
		unset($_SESSION['promoapplydata']);
		unset($_SESSION['promoapplyid']);
		redirect('App/page2');
	}	
	public function getPromoData(){
		if(isset($_POST['data'])){
			$data = json_decode($_POST['data']);
			$mydata = $data->response->available;
			$promodata = $data->response->promocodes;
			$referdata = $data->response->refercode;
			if(isset($mydata) && !empty($mydata)){
				if(isset($_SESSION['calculatedSpecificFare'])){
					$url_page = 'datapro';
				}
				elseif(isset($_SESSION['retryPromoVal'])){
					$url_page = 'promoretry';
				}else{
					$url_page = 'applyrefer';
				}
				foreach ($mydata as $key => $value) {
					$date = date("d M y", strtotime($value->expiry_date));
					$daa .='
						<div class="promo-code-listing">
						  	<div class="pcl-right-content text_grey">
								<div class="add_apply">
									<span>'.$value->promo_code.'</span>
									<a href="#" data-toggle="modal" data-target="#applypromo'.$value->id.'">Apply</a>
								</div>
							  	<p class="main-content"><b>'.$value->value.'% off</b> on booking. Avail offer max upto $'.$value->max_amount.'.</p><p class="content-subheading">Valid till ' .$date.'</p>
						  	</div>
						   	<div class="modal fade" id="applypromo'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							    <div class="modal-dialog" role="document">
							      	<div class="modal-content">
								        <div class="modal-header REmove_BORder">
								            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
								        </div>
								        <div class="modal-body">
								            <div class="WANt_PLay">
								                <h6>Do you really want to apply this promocode?</h6>
								            </div>
								        </div>
								        <div class="modal-footer REmove_BORder">
								            <div class="PAy_TOcard">
								              <button data-dismiss="modal" type="button">No</button>									             	
				 								<form action="'.base_url().''.$url_page.'" method="POST">
													<input type="hidden" name="promoid" value="'.$value->id.'">
									              	<input type="submit" name="applypromo" value="Yes">
									            </form>
								            </div>
								        </div>
							      	</div>
							    </div>
							</div>
						</div>
						  ';
				}							 
			}
			if(isset($promodata) && !empty($promodata)){
				foreach ($promodata as $key => $value) {
					$date = date("d M y", strtotime($value->expiry_date));
					$daa .='
						<div class="promo-code-listing">
							<div class="pcl-left-img"><img src="'.base_url('public').'/images/referral-code.png" class="img-responsive"></div>
							<div class="pcl-right-content text_grey"><p class="main-content"><b>'.$value->value.'% off</b> on booking. Avail offer max upto $'.$value->max_amount.'.</p><p class="content-subheading">Valid till ' .$date.'</p></div>
							<div class="modal fade" id="applypromo'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							    <div class="modal-dialog" role="document">
							      	<div class="modal-content">
								        <div class="modal-header REmove_BORder">
								            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
								        </div>
								        <div class="modal-body">
								            <div class="WANt_PLay">
								                <h6>Do you really want to apply this promocode?</h6>
								            </div>
								        </div>
								        <div class="modal-footer REmove_BORder">
								            <div class="PAy_TOcard">
								              <button data-dismiss="modal" type="button">No</button>						             	
												<form action="'.base_url().'App/'.$url_page.'" method="POST">
													<input type="hidden" name="promoid" value="'.$value->id.'">
								              		<input type="submit" name="applypromo" value="Yes">
								             	</form>
								            </div>
								        </div>
							      	</div>
							    </div>
							</div>
						</div>';		
				}
				
			}
			if(isset($referdata) && !empty($referdata)){
				foreach ($referdata as $key => $value) {
					$daa .='
						<div class="promo-code-listing">
						  <div class="pcl-left-img"><img src="'.base_url('public').'/images/referral-code.png" class="img-responsive"></div>
						  <div class="pcl-right-content text_grey"><p class="main-content"><b>'.$value->value.'% off</b> on your next referral. Avail offer max upto $'.$value->max_amount.'.</p><p class="content-subheading">Referred to Samantha Jones.</p></div>
						</div>';
				}					
			}
		}
		echo $daa;
	}
	public function deleteCard($cardid){
		$crd = base64_decode($cardid);
		$expl = explode('_',$crd);
		$cardid = $expl[0];
		if((isset($_POST['delcard'])) && $_POST['delcard'] == "Yes"){
			$data = [
				'user_id'=>$_SESSION['user_details']->id,
				'card_id'=>$cardid
			];
			$url = 'http://movers.com.au/Admin/api/User/deletecard';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			if ($output->ResponseCode == 1) {
				$responseData =  $output->response;
				$this->session->set_flashdata('success','Card deleted sucessfully');
			}else{
				$this->session->set_flashdata('success','Something Went Wrong.');		
			}
			redirect('mycard');
		}
	}
	public function Cards(){
		$data = [
			'user_id'=>$_SESSION['user_details']->id
		];
		$url = 'http://movers.com.au/Admin/api/User/cardListing';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		if($output->ResponseCode == 1) {
			$responseData['cardlist'] =  $output->Response;
			$_SESSION['bookCharge'] = $output->setData[0]->min_booking_charge;
		}else{
			$error_msg ="NO DATA FOUND";				
		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar',$responseData);
		$this->load->view('card');
	}
	public function page6($cardid){
		if(isset($_POST['submit'])){
			$bookingDateTimeCheck = $_SESSION['calculatedSpecificFare']['booking_date']." ".$_SESSION['calculatedSpecificFare']['booking_time'];
			// $currentdate = date('Y-m-d H:i:s'); 
			// if($currentdate < $bookingDateTimeCheck){
			// 	unset($_SESSION['errorbookingdate']);
			// }else{ 
			//     $_SESSION['errorbookingdate'] = "Check Booking Date Time";
			// 	redirect('App/page4');
			// }
			
			// $data = $_SESSION['calculatedSpecificFare'];
			// $net_amount = $_SESSION['calculatedSpecificFare']['estimated_price'];
			//$Bookcharge = $_SESSION['bookCharge'];
			//$net_amount = $net_amount * $Bookcharge / 100 ;
			//$_SESSION['calculatedSpecificFare']['estimated_price'] = $net_amount;
			$_SESSION['calculatedSpecificFare']['card_id'] = $cardid;
			$_SESSION['calculatedSpecificFare']['promoid'] = empty($_SESSION['promoapplydata'])?'':$_SESSION['promoapplyid'];
			// $_SESSION['calculatedSpecificFare']['city_id'] = $_SESSION['city_id'];
			$newData = $_SESSION['calculatedSpecificFare'];
			// echo "<pre>";print_r($newData);die;
			$url = 'http://movers.com.au/Admin/api/User/bookmove';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/bookmove';
			$options = array(
			'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($newData)
			)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
					// echo "<pre>";print_r($output);die;		
			if ($output->ResponseCode == 0) { /* Handle error */ 
				$_SESSION['errorbookingResponseMessage'] = $output->MessageWhatHappen;	
				// $re = [','];
				// echo "<pre>"; $vv = str_replace($re,'</br>',json_encode($_SESSION['calculatedSpecificFare']));
				// 		print_r(str_replace('"', '',$vv));	
				// print_r($output);die;
				redirect('App/desbooking');
			}else{
				$_SESSION['NewBook_id'] = $output->Move_id;
			//echo "<pre>";print_r($newData); print_r($_SESSION['NewBook_id']);die;
				unset($_SESSION['errorbookingResponseMessage']);
				// unset($_SESSION['calculatedSpecificFare']);
			}
		}			
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Search_mover');	
	}
	public function cancelbook($bookid){
		if(isset($_POST['cancelmovebook'])){
			$data = array(
				'user_id'=>$_SESSION['user_details']->id,
				'booking_id'=>$bookid,
				'type'=>4,
				'totalPrice'=>'',
				'cancelUser_type'=>2,
				'reason'=>$this->input->post('comment')
			);
			$url = 'http://movers.com.au/Admin/api/User/moveAction';
			$options = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			//print_r($output);
			if($output->ResponseCode == 1) { /* Handle error */ 
				// $this->session->set_flashdata('success',$output->MessageWhatHappen);
				redirect('App/desBooking');
			}else{
				// $this->session->set_flashdata('success',$output->MessageWhatHappen);
				redirect('App/desBooking');
			}
		}
	}	
	public function FindDriver(){
	// $query  = $this->db->query('select * from tbl_booking where id = '.$_SESSION['NewBook_id'].' and is_accepted = 1')->result();
	// 	 print_r($query);
		$data = array(
			'book_id'=>$this->input->post('book_id')
		);
		$url = 'http://movers.com.au/Admin/api/User/FindDriver';
		// $url = 'http://phphosting.osvin.net/Admin/api/User/FindDriver';
		$options = array(
			'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);	
		print_r($output);
	}
	public function MoverFound($id){
		//print_r($id);
		$data = array(
			'driver_id'=>$id
		);
		$url = 'http://movers.com.au/Admin/api/User/getdriverprofile';
		// $url = 'http://phphosting.osvin.net/Admin/api/User/getdriverprofile';
		$options = array(
			'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);	
		//echo"<pre>";print_r($output);die;
		if($output->ResponseCode == 1) { /* Handle error */ 
			$driver_data = $output->Response->profiledata[0];
			$rating = $output->Response->avgrating[0]->driverrating;
			$vehicle = $output->Response->vehicle_detail[0]->name.' - '.$output->Response->driverdetaildata[0]->vehicle_no;
			$mover = ['driver'=>$driver_data,'vechile'=>$vehicle,'rating'=>$rating];
		}else{

		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar',$mover);
		$this->load->view('Sidebar_mover_found');	
	}

////////////////////////////////////////////////////////////////////// Your Moves ///////////////////////////////////////////////////////////////////////////////
	public function moves(){
		redirect('App/yourmoves');
	}
	public function yourmoves(){
		unset($_SESSION['promoapplydata']);
		unset($_SESSION['promoapplyid']);
		unset($_SESSION['sel_card_id']);
		unset($_SESSION['sel_card_name']);
		unset($_SESSION['showHistory']);
		unset($_SESSION['promoapplyid']);
		unset($_SESSION['editbookdata']);
		unset($_SESSION['retryBook']);
		unset($_SESSION['retryPromoVal']);
		unset($_SESSION['retryPromoVal_id']);
		unset($_SESSION['errorpromo']);
		unset($_SESSION['retryMove']);			
		$url = 'http://movers.com.au/Admin/api/User/yourMoveList';
		$data = array(
			'user_id'=>$_SESSION['user_details']->id,
			'type' =>1,
			'page'=>1			
		);
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);				
		if ($output->ResponseCode == 0) { /* Handle error */ 
			$_SESSION['errorbookingResponseMessage'] = $output->MessageWhatHappen;
		}else{			
			$_SESSION['NewBook_id'] = $output->Move_id;
			unset($_SESSION['errorbookingResponseMessage']);
		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('movelist');	
	}	
	public function yourMoveListData(){
		function custom_sort($a,$b) {
	        return $b->id > $a->id;
	    }
		$data = array(
			'user_id'=>$this->input->post('user_id'),
			'type'=>$this->input->post('type'),
			'page'=>$this->input->post('page')
		);
		$url = 'http://movers.com.au/Admin/api/User/yourMoveList';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		if($output->ResponseCode == 1){
			$_SESSION['MoveHistory'] = $output;	
			$dec = $_SESSION['MoveHistory'];			
			$myData = $dec->Response;
			usort($myData, "custom_sort"); 
			$user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getvechicle'));
			$VehicleData = $user->Response;
			foreach($VehicleData  as $keys=>$vAlues){
	            $nameS[$vAlues->id] = $vAlues->name;
	        }
			foreach($myData as $key=>$value){
				$startt = $this->convertTime($value->slot_starttime);
				$endt =  $this->convertTime($value->slot_endtime);
				$date = date("d M y", strtotime($value->booking_date));

				if($_POST['type'] == 1 && $value->move_data[0]->status == 0){
					$ss = $startt."-".$endt;
					$text = 'Pending';
				}elseif($_POST['type'] == 2 && $value->move_data[0]->status == 1){
					$datetime = $value->move_data[0]->accepted_time;
					$text = 'Assigned';}
				elseif($_POST['type'] == 2 && $value->move_data[0]->status == 2){
					$datetime = $value->move_data[0]->started_time;
					$text = 'EnRoute';
				}
				elseif($_POST['type'] == 3 && $value->move_data[0]->status == 3){
					$datetime = $value->move_data[0]->completed_time;
					$text = 'Completed';
				}
				else{
					$datetime = $value->move_data[0]->cancelled_time;
					$text = 'Cancelled';
				}				
		       	// date_default_timezone_set('UTC');		       
		        // $asia_timestamp = strtotime($datetime);
		        // date_default_timezone_set($_SESSION['timezone_dynamic']);
		        // $utcDateTime = date("H:i:s", $asia_timestamp);
		        // $time = date("h:i A.", strtotime($utcDateTime));
		        $static_key = "0*vsdsdj!kld$#uyfd%6n4b32@&2kj2z";
                $valid = $value->id . "_" . $static_key;
                $mvalId = base64_encode($valid);
		        $time = $this->convertTime($datetime);
		        if($value->move_data[0]->status == 1 || $value->move_data[0]->status == 2 || $value->move_data[0]->status == 3 || $value->move_data[0]->status == 4){
		     		$ss = " at ".$time;
		     	}

				$vehicleId= $value->vehicle_id;										 
				$data .=  '
					<tr  data-toggle="collapse" data-target="#accordion'.$key.'" class="clickable clickable'.$key.'">
						<td class="NUmber_Font">'.$date.' '.$ss.'</td>      
						<td class="NUmber_Font">$'.$value->pricing_data[0]->min_estimate_price.' - $'.$value->pricing_data[0]->max_estimate_price.'<button class="move-label completed">'.$text.'</button></td>
						<td>'.$nameS[$vehicleId].'</td>
						<td>'.$value->pickup_loc.'</td>
						<td>'.$value->destination_loc.'</td>
				    </tr>	   
					<tr>
						<td colspan="6">
					    	<div id="accordion'.$key.'" class="collapse">
					    		<div class="your-move-detail-box">
						        	<div class="row">
						        		<div class="col-md-12 col-lg-4 col-sm-12">
						        			<div class="mdb-img">
												<img src="https://maps.googleapis.com/maps/api/staticmap?size=350x250&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|'.$value->pickup_latitude.','.$value->pickup_longitude.'&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|'.$value->destination_latitude.','.$value->destination_longitude.'&path=weight:5%7Ccolor:0x14456a%7Cenc:'.base64_decode($value->path_polyline).'&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img>
											</div>
										</div>
										<div class="col-md-12 col-lg-5 col-sm-12 main-center-border-mdb">
											<div class="mdb-content">
												<h4 class="NUmber_Font price">$'.$value->pricing_data[0]->min_estimate_price.' - $'.$value->pricing_data[0]->max_estimate_price.'</h4><p class="time-date">MoveID #'.$value->id. ' with '.$nameS[$vehicleId].'<br>'.$date.'  '.$ss.'</p>
								     			<div class="content-addr-your-move moves-listing-detail">
													<div class="addr-inner addr-pickup">
														<div class="addr-inner-img">
															<img src=" '.base_url("public/").'images/move-details-pickup-list.png" class="img-responsive">
														</div> 
														<div class="addr-inner-content">
															<h5>Pickup Location</h5><p>'.$value->pickup_loc.'</p>
														</div>
													</div>
													<div class="addr-inner addr-dest">
														<div class="addr-inner-img">
															<img src="'.base_url("public/").'images/move-details-destination.png" class="img-responsive">
														</div>
														<div class="addr-inner-content">
															<h5>Dropoff Location</h5><p>'.$value->destination_loc.'</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-lg-3 col-sm-12 SIghIn">
											<form action="'.base_url().'movedetail/'.$mvalId.'" method="POST">
												<button type="submit">View Details</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>';
			}
			echo $data;die;
	   		// print_r($data);die;
	   	}else{
	   		echo 'No Data Found In The Table';
	   	}
	}
	public function retrypromo(){
		if(isset($_POST['applypromo'])){
			$data12 = [
				'user_id'=>$_SESSION['user_details']->id,
				'promo_id'=>empty($this->input->post('promoid'))?'':$this->input->post('promoid'),
				'promocode'=>empty($this->input->post('promocode'))?'':$this->input->post('promocode')
			];
			$url = 'http://movers.com.au/Admin/api/User/applypromo';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data12)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			// print_r($output);die;
			if($output->ResponseCode == 1) {
				unset($_SESSION['errorpromo']);
				$responseData =  $output->response;
				$_SESSION['promoapplydata'] = $responseData->promocode[0];
				//$_SESSION['promoapplyid'] = $responseData->promodata[0]->id;
				$_SESSION['retryMove']['promoid'] = $responseData->promodata[0]->id;
				redirect('movedetail/'.$_SESSION['retryPromoVal_id']);
			}else{
				unset($_SESSION['promoapplydata']);
				$error = $output->MessageWhatHappen;
				$_SESSION['errorpromo'] = $error;
				redirect('App/promocode/'.$_SESSION['retryPromoVal_id']);
			}			
		}
	}
	public function cancelretrypromocode(){
		unset($_SESSION['promoapplydata']);
		unset($_SESSION['promoapplyid']);
		redirect('movedetail/'.$_SESSION['retryPromoVal_id']);
	}
	public function googlepage(){
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('google');	
	}
	public function checkDateTime(){
		if(isset($_POST['date'])){
			$date = date('d/m/Y H:i');
			if($_POST['date'] < $date){
				print 0;			
			}else{
				print 1;
			}
		}
    }
	public function logout(){
		session_destroy();
		redirect(base_url());
	}	     
	public function MoveDetails($move_id){
		$moid = base64_decode($move_id);
		$es = explode('_',$moid);
		$move_id = $es[0];
		$url = 'http://movers.com.au/Admin/api/User/moveDetailHistory';
		$data = array(
			  'user_id'=>$_SESSION['user_details']->id,
			  'move_id' =>$move_id,
			  'user_Type'=>2			
			);
		$options = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
		)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);

		$url1 = 'http://movers.com.au/Admin/api/User/getdriverprofile';
		$data1 = array(
			'driver_id'=>$output->response->booking_data[0]->driver_id	
		);
		$options1 = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data1)
		)
		);
		$context1  = stream_context_create($options1);
		$result1 = file_get_contents($url1, false, $context1);
		$output1 = json_decode($result1);									
		if($output->ResponseCode == 0) { /* Handle error */ 
			$error_msg ="NO DATA FOUND";
		}else{
			$responseData =  $output->response;
			$responseData1 = $output1->Response;				
		}
		// echo "<pre>";print_r($output1);
		// echo "<pre>";print_r($output);die;
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar',$responseData1);
		$this->load->view('your-moves-detail');	
	}	
	public function AddCard(){
		$token['token'] = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/braintreeToken'));
		$this->load->view('Template/inner/header',$token);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Add_card');
	}
	public function create(){
		$rep = $this->input->post('cardno');
		$card = substr($rep,12);
		$rep1 = $this->input->post('year');
		$year = substr($rep1,2);
		$data = [
			//'token'=>$this->input->post('token'),
			'user_id'=>$_SESSION['user_details']->id,
			'name'=>$this->input->post('name'),
			'card_no'=>$card,
			'expiry_month'=>$this->input->post('month'),
			'expiry_year'=>$year,
			'nounce'=>$this->input->post('payment_method_nonce'),
			'is_default'=>$this->input->post('default')
		];
		$url = 'http://movers.com.au/Admin/api/User/addcard';
		// $url = 'http://phphosting.osvin.net/Admin/api/User/addcard';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		//print_r($output);die;					
		if ($output->ResponseCode == 1) { /* Handle error */ 
			$responseData =  $output->ResponseCode;
			echo $responseData;
		}else{
			$error_msg ="NO DATA FOUND";
			echo $error_msg; 				
		}
	}
	public function Edit_Move($id,$vehicle=null){
		$sd = base64_decode($id);
		$ex = explode('_', $sd);
		$id = $ex[0];
		$data = array(
			'user_id'=>$_SESSION['user_details']->id,
			'move_id' =>$id,
			'user_Type'=>2
		);
		$url = 'http://movers.com.au/Admin/api/User/moveDetailHistory';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		$responseData = $output->response;

		$moveDa =  $output->response->booking_data[0];
		$priceDa =  $output->response->pricing_data[0];
		$vehicle = $output->response->vehicleDetail[0];
		$edit_array = [
			'user_id'=>$_SESSION['user_details']->id,
			'pickup_loc'=>$moveDa->pickup_loc,
			'destination_loc'=>$moveDa->destination_loc,
			'booking_date'=>$moveDa->booking_date,
			'slot_starttime'=>$moveDa->slot_starttime,
			'slot_endtime'=>$moveDa->slot_endtime,
			'pickup_latitude'=>$moveDa->pickup_latitude,
			'pickup_longitude'=>$moveDa->pickup_longitude,
			'destination_latitude'=>$moveDa->destination_latitude,
			'destination_longitude'=>$moveDa->destination_longitude,
			'time_duration'=>$priceDa->time,
			'distance'=>$priceDa->distance,
			'path_polyline'=>$moveDa->path_polyline,
			'time_zone_start'=>$moveDa->time_zone_start,
			'time_zone_end'=>$moveDa->time_zone_end,
			'book_id'=>$id,
			'pickupcity_id'=>$moveDa->pickupcity_id,
			'destinationcity_id'=>$moveDa->destinationcity_id,
			'min_estimate_price'=>$priceDa->min_estimate_price,
			'max_estimate_price'=>$priceDa->max_estimate_price,
			'time_zone_start'=>$moveDa->time_zone_start,
			'time_zone_end'=>$moveDa->time_zone_end
		];

		if(isset($_POST['editsubmit'])){
			unset($_SESSION['retryBook']);

			$_SESSION['mybookingData']=$_POST;

			if($priceDa->no_of_movers == 1){
				$move_charge = $vehicle->movers_charges1;
			}else{
				$move_charge = $vehicle->movers_charges2;
			}
    		$hoursCharged = round(($_SESSION['mapData']['duration_value'] / 60) % 60);
			$km_charges   =  round($vehicle->km_charges*$_SESSION['mapData']['distInKms']);
			$hour_charges = round($hoursCharged * $move_charge);
			$min_hour = round($vehicle->min_minutes * $move_charge);
			$max_hour = round($vehicle->max_minutes * $move_charge);
			$min_fare = round($km_charges + $hour_charges + $min_hour);
			$max_fare = round($km_charges + $hour_charges + $max_hour);
			$bdata = [
				'user_id'=>$edit_array['user_id'],
				'pickup_loc'=>$_SESSION['mapData']['pickupAdd'],
				'destination_loc'=>$_SESSION['mapData']['dropOffAdd'],
				'booking_date'=>$edit_array['booking_date'],
				'slot_starttime'=>$edit_array['slot_starttime'],
				'slot_endtime'=>$edit_array['slot_endtime'],
				'pickup_latitude'=>$_SESSION['mybookingData']['pickuplat'],
				'pickup_longitude'=>$_SESSION['mybookingData']['pickuplng'],
				'destination_latitude'=>$_SESSION['mybookingData']['dropofflat'],
				'destination_longitude'=>$_SESSION['mybookingData']['dropofflng'],
				'time_duration'=>$_SESSION['mapData']['duration_value'],
				'distance'=>$_SESSION['mapData']['distance'],
				'path_polyline'=>$_SESSION['mapData']['polyline'],
				'time_zone_start'=>$edit_array['time_zone_start'],
				'time_zone_end'=>$edit_array['time_zone_end'],
				'book_id'=>$edit_array['book_id'],
				'pickupcity_id'=>$_SESSION['city_id'],
				'destinationcity_id'=>$_SESSION['descity_id'],
				'min_estimate_price'=>$min_fare,
				'max_estimate_price'=>$max_fare,
				'time_zone_start'=>$edit_array['time_zone_start'],
				'time_zone_end'=>$edit_array['time_zone_end']
			];

			//echo "<pre>";print_r($bdata);die;
			$url = 'http://movers.com.au/Admin/api/User/editMove';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($bdata)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			if ($output->ResponseCode == 1) {
				$msg = $output->MessageWhatHappen; 
				$_SESSION['NewBook_id'] = $output->Move_id;
				$this->load->view('Template/inner/header');
				$this->load->view('Template/inner/Left_sidebar');
				$this->load->view('Search_mover');
			}
			// echo "<pre>";print_r($_SESSION['editbookdata']);die;
			// $date = strtotime($output->response->booking_data[0]->booking_date);
			// $check_start_time = strtotime($output->response->booking_data[0]->booking_date.' '.$moveDa->slot_starttime);
   //  		$check_end_time = strtotime($output->response->booking_data[0]->booking_date.' '.$moveDa->slot_endtime);
			// $current = $output->servertime;
			// $csort = strtotime($current);
			// if($csort > $check_end_time){
			// 	redirect('App/select_time');
			// }else{
			// 	redirect('App/bookeditdata');
			// }
		}

		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('edit_destination');
			// $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getmove'));
			// echo "<pre>";print_r($user);
			// echo "<pre>";print_r($output);die;
			// $moveData = $user->Response->movedata;
			// $settingData = $user->Response->settingdata;
			// $datebook = $output->response->booking_data[0]->booking_date;
			// $datetime = $output->response->booking_data[0]->booking_time;
			// $movers_charge = $output->response->booking_data[0]->movers_fare;
			// $loading_rate = $output->response->booking_data[0]->loading_fare;
			// $unloading_rate = $output->response->booking_data[0]->unloading_fare;
			// $upstair_flight_charges = $output->response->booking_data[0]->pickup_flight_fare;
			// $downstair_flight_charges = $output->response->booking_data[0]->destination_flight_fare;

			// $hour_charge = $output->response->vehicleDetail[0]->hours_charges;
			// $km_charge = $output->response->vehicleDetail[0]->km_charges;
			
			// $hoursCharged = ceil($_SESSION['mapData']['duration_value'] /3600);
			// $hours_charges = ceil($hour_charge*$hoursCharged);
			// $km_charges   =  ceil($km_charge*$_SESSION['mapData']['distInKms']);
			// $totalEstimate = ceil($km_charge + $hours_charge + $movers_charge + $loading_rate + $unloading_rate + $upstair_flight_charges + $downstair_flight_charges);
			

			// $date = date("d M y", strtotime($output->response->booking_data[0]->booking_date));
			// date_default_timezone_set('UTC'); 
	  //       $datetime = $output->response->booking_data[0]->booking_time;
	  //       $asia_timestamp = strtotime($datetime);
	  //       date_default_timezone_set('Asia/Calcutta');
	  //       $utcDateTime = date("H:i:s", $asia_timestamp);
	  //       $time = date("h:i A.", strtotime($utcDateTime));
			// $bookingDateTimeCheck = $date.''.$time;
			// $current = $output->servertime;
			// $_SESSION['editbookdata'] = $bdata;
			// //print_r($_SESSION['editbookdata']);die;
			// if($current < $bookingDateTimeCheck){
			// 	$_SESSION['editbookdata']['booking_date'] = $datebook;
			// 	$_SESSION['editbookdata']['booking_time'] = $datetime;
			// 	redirect('App/bookeditdata');
			// }else{
			// 	redirect('App/select_time');
			// }	
			
			// print_r($date);echo"<br>";
			// print_r($check_start_time);echo"<br>";
			// print_r($check_end_time);echo"<br>";
			// print_r($csort);echo"<br>";
	}
	public function select_time(){
		//echo"<pre>";print_r($_SESSION['editbookdata'] );die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('edit_booktime');
	}
	public function book_select_time(){
		// $datetimee= str_replace('/','-',$_POST['datepick']);
		// $date_arr = explode(' ',$datetime);
		// $sdate=date('Y-m-d', strtotime($date_arr[0]));
		// $_SESSION['editbookdata']['booking_date'] = $sdate;
		// $_SESSION['editbookdata']['booking_time'] = $date_arr[1].":00";
		if(isset($_POST['timesubedit'])){
			$ttime = $this->input->post('timeslotsel');
			$explode = explode('-',$ttime);
			$_SESSION['editbookdata']['booking_date'] = $_SESSION['time_slot'];
			$_SESSION['editbookdata']['slot_starttime'] = $explode[0];
			$_SESSION['editbookdata']['slot_endtime'] =  $explode[1];
			$_SESSION['editbookdata']['time_zone_start'] = $_SESSION['time_slot'].' '.$explode[0];
			$_SESSION['editbookdata']['time_zone_end'] = $_SESSION['time_slot'].' '.$explode[1];
			redirect('App/bookeditdata');
		}else{
			redirect('App/select_time');
		}

		if(isset($_POST['timesub'])){
			$ttime = $this->input->post('timeslotsel');
			$explode = explode('-',$ttime);
			$_SESSION['retryBook']['booking_date'] = $_SESSION['time_slot'];
			$_SESSION['retryBook']['slot_starttime'] = $explode[0];
			$_SESSION['retryBook']['slot_endtime'] =  $explode[1];
			$_SESSION['retryBook']['time_zone_start'] = $_SESSION['time_slot'].' '.$explode[0];
			$_SESSION['retryBook']['time_zone_end'] = $_SESSION['time_slot'].' '.$explode[1];
			redirect('App/bookeditdata');
		}else{
			redirect('App/select_time');
		}		
	}
	public function cardList($move_id){
		if(isset($_POST['retrysubmit'])){
			unset($_SESSION['editbookdata']);

			$url = 'http://movers.com.au/Admin/api/User/moveDetailHistory';
			$data = array(
				  'user_id'=>$_SESSION['user_details']->id,
				  'move_id' =>$move_id,
				  'user_Type'=>2			
				);
			$options = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			// echo "<pre>";print_r($output);die;
			$data12 = [
				'move_id'=>$move_id,
				'booking_date'=>$output->response->booking_data[0]->booking_date,
				'slot_starttime'=>$output->response->booking_data[0]->slot_starttime,
				'slot_endtime'=>$output->response->booking_data[0]->slot_endtime,
				'time_zone_start'=>$output->response->booking_data[0]->time_zone_start,
				'time_zone_end'=>$output->response->booking_data[0]->time_zone_end,
				'min_estimate_price'=>$output->response->pricing_data[0]->min_estimate_price,
				'max_estimate_price'=>$output->response->pricing_data[0]->max_estimate_price,
				'promoid'=>$output->response->booking_data[0]->promoid
			];
			// echo "<pre>";print_r($data12);die;
			$_SESSION['retryBook'] = $data12;

			$data = [
				'user_id'=>$_SESSION['user_details']->id
			];
			$url = 'http://movers.com.au/Admin/api/User/cardListing';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/cardListing';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			//echo "<pre>";print_r($output);die;
			if($output->ResponseCode == 1) { /* Handle error */ 
				$responseData['cardlist'] =  $output->Response;
				$_SESSION['bookCharge'] = $output->setData[0]->min_booking_charge;
			}else{
				$error_msg ="NO DATA FOUND";			
			}
			$this->load->view('Template/inner/header');
			$this->load->view('Template/inner/Left_sidebar',$responseData);
			$this->load->view('card1');
		}else{
			redirect('App/yourmoves');
		}
	}
	public function bookeditdata($cardid=null){
		if(isset($_SESSION['retryBook'])){
			$_SESSION['retryBook']['card_id'] = $cardid;
			$data1 = $_SESSION['retryBook'];
			$url = 'http://movers.com.au/Admin/api/User/retryMove';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/retryMove';
		}else{
			$data1 = $_SESSION['editbookdata'];
			$url = 'http://movers.com.au/Admin/api/User/editMove';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/editMove';
		}
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data1)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		// echo "<pre>";print_r($output);die;
		if ($output->ResponseCode == 1) {
		// print_r($output->Move_id);die;
			$msg = $output->MessageWhatHappen; 
			$_SESSION['NewBook_id'] = $output->Move_id;
		}else{
			// $this->session->set_flashdata('mmsg', $output->MessageWhatHappen); 
			redirect('App/select_time');
		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Search_mover');			
	}
	public function apply_refre_code(){
		if(isset($_POST['applypromo'])){
			$data12 = [
				'user_id'=>$_SESSION['user_details']->id,
				'promo_id'=>empty($this->input->post('promoid'))?'':$this->input->post('promoid'),
				'promocode'=>empty($this->input->post('promocode'))?'':$this->input->post('promocode')
			];
			// print_r($data12);die;
			$url = 'http://movers.com.au/Admin/api/User/applypromo';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/applypromo';
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data12)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			if($output->ResponseCode == 1) { /* Handle error */ 
				unset($_SESSION['errorpromo']);
				$_SESSION['successpromodata'] =  "successfully applied promocode";
			}else{
				unset($_SESSION['successpromodata']);
				$_SESSION['errorpromo'] = $output->MessageWhatHappen;
			}
			redirect('refercode');
		}
	}	
	public function ApplyreferCode(){
		$data = [
			'user_id'=>$_SESSION['user_details']->id,
			'type'=>1
		];
		$url = 'http://movers.com.au/Admin/api/User/getPromo';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		//echo"<pre>";print_r($output);die;
		if($output->ResponseCode == 1) { /* Handle error */ 
			$responseData =  $output->response;
		}else{
			$error_msg = $output->message;
		}
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('free_moves_listing1');	
	}
	public function error(){
		//$url = 'http://movers.com.au/Admin/api/User/updateItemimages';
		$this->load->view('Template/inner/header');
		$this->load->view('error_404');
	}
	public function edit_items($id){
		$data = array(
			'user_id'=>$_SESSION['user_details']->id,
			'move_id' =>$id,
			'user_Type'=>2
		);
		$url = 'http://movers.com.au/Admin/api/User/moveDetailHistory';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/moveDetailHistory';
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);
		// echo "<pre>"; print_r($output);die;					
		if ($output->ResponseCode == 0) {  
			$error_msg ="NO DATA FOUND";
		}else{
			$responseData =  $output->response->booking_data[0];					
		}
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('edit_moving');
	}
	public function freeMove(){
		unset($_SESSION['errorpromo']);
		unset($_SESSION['successpromodata']);
		//unset($_SESSION['calculatedSpecificFare']);
		unset($_SESSION['retryPromoVal']);
		unset($_SESSION['retryPromoVal_id']);
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_free_moves');
	}
	public function recipt($move_id){
		$bv = base64_decode($move_id);
		$es = explode('_',$bv);
		$move_id = $es[0];
		if(isset($_POST['submitcustaing'])){
			$send_data = [
				'move_id'=>$move_id,
				'driver_id'=>$this->input->post('driver'),
				'user_id'=>$_SESSION['user_details']->id,
				'rating'=>$this->input->post('rating'),
				'comment'=>$this->input->post('comment')
			];
			$url1 = 'http://movers.com.au/Admin/api/User/customerRating';
			$options1 = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($send_data)
				)
			);
			$context1  = stream_context_create($options1);
			$result1 = file_get_contents($url1, false, $context1);
			$output1 = json_decode($result1);
		}

		$url = 'http://movers.com.au/Admin/api/User/moveDetailHistory';
		$data = array(
			  'user_id'=>$_SESSION['user_details']->id,
			  'move_id' =>$move_id,
			  'user_Type'=>2			
			);
		$options = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
		)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$output = json_decode($result);

		$url1 = 'http://movers.com.au/Admin/api/User/getdriverprofile';
		$data1 = array(
			'driver_id'=>$output->response->booking_data[0]->driver_id	
		);
		$options1 = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data1)
		)
		);
		$context1  = stream_context_create($options1);
		$result1 = file_get_contents($url1, false, $context1);
		$output1 = json_decode($result1);	
								
		if($output->ResponseCode == 0) { /* Handle error */ 
			$error_msg ="NO DATA FOUND";
		}else{
			$responseData =  $output->response;
			$responseData1 = $output1->Response;
			// echo "<pre>";print_r($responseData);
			// echo "<pre>";print_r($responseData1);die;				
		}
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar',$responseData1);
		$this->load->view('reciptdetail');
	}
	public function feedback(){
		if(isset($_POST['submitfeed'])){
			$url = 'http://movers.com.au/Admin/api/User/feedback';
			// $url = 'http://phphosting.osvin.net/Admin/api/User/feedback';
			$data = [
				'user_id'=>$_SESSION['user_details']->id,
				'comment'=>$this->input->post('comment'),
				'rating'=>$this->input->post('rating')
			];
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$output = json_decode($result);
			//echo "<pre>";print_r($output);die;
			if ($output->ResponseCode == 1) {  
				$responseData =  $output->response;
				$_SESSION['feedrespone'] = $responseData;
			}else{
				$responseData =  $output->response;
				unset($_SESSION['feedrespone']);		
			}
		}
		$this->load->view('Template/inner/header',$output);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_mover_feedback');
	}
	public function removesession(){
		// print_r($_POST);die;
		$key = $this->input->post('key');
		unset($_SESSION['itemImage'][$key]);
		echo "unset";
	}
	public function timeslot(){
		$val = $this->input->post('value');
		$sel_date = $this->input->post('date');
		$current = date('H:i:s');
		if($sel_date == "Today"){
			$_SESSION['time_slot'] = date('Y-m-d');
		}else{
			$_SESSION['time_slot'] = $sel_date;
		}

		for($i = 0; $i < 7 ; $i++){
		    $date = date('Y-m-d', strtotime("-".$i."days", strtotime($sel_date)));
		    $dayName = date('D', strtotime($date));
		    if($dayName == "Mon"){
		       $startdate1 = $date;
		    }
	    }
	    $selectedDate = strtotime($startdate1);
		$check_time = strtotime($current);
		$time1 = new DateTime($sel_date);
		$time2 = new DateTime($startdate1);
		$interval = $time1->diff($time2);
		$days = $interval->d + 1;
		// print_r($days);die;

		if($days > 7){
			$diif = $days - 7;
			$dayNew = $diif;
		}else{
			if($sel_date == "Today" && $startdate1 == $current){
				$dayNew = 1;
			}else{
				$dayNew = $days;
			}
		}
		// print_r($dayNew);die;
		$start =  date("h:i A.", strtotime($current));		
		$user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getVehicleMove'));
		// $user = json_decode(file_get_contents('http://phphosting.osvin.net/Admin/api/User/getVehicleMove'));
    	$timeData = $user->Response->timemanagementdata;
    	// print_r($timeData);die;
    	foreach ($timeData as $key => $value) {
    		if($key == $dayNew){
    			foreach ($value as $key1 => $data) {
    				$check_start_time = strtotime($data->start_time);
    				$check_end_time = strtotime($data->end_time);
    				$str2 = date("H:i:s", strtotime( "$data->end_time - 30 mins")) ;
    				$half = strtotime($str2);
    				if(($check_end_time < $check_time) && $val == 1 ){
    					unset($value[$key1]);
    				}elseif($half < $check_time && $val == 1){
    					unset($value[$key1]);
    				}elseif(($check_start_time < $check_time || $check_end_time <= $check_time) && $val == 1){
    					echo "<option value=".$data->start_time."-".$data->end_time.">WithIn 1 Hour</option>";
    				}else{
    					$start = date("h:i A.", strtotime($data->start_time));
    					$end = date("h:i A.", strtotime($data->end_time));
	    				$ss = $start."-".$end;
	    				echo "<option value=".$data->start_time."-".$data->end_time.">".$ss."</option>";
    				}
    			}
    		}
    	}    	
	}
	public function convertTime($selection){
		date_default_timezone_set('UTC');		       
        $asia_timestamp = strtotime($selection);
        date_default_timezone_set($_SESSION['timezone_dynamic']);
        $utcDateTime = date("H:i:s", $asia_timestamp);
        $time = date("h:i A.", strtotime($utcDateTime));
        return $time;
	}	
}

?>