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
		date_default_timezone_set('UTC');       
        // date_default_timezone_set('Asia/Calcutta');  
	
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
	public function CreateAccount(){
		$this->load->view('Template/inner/header');
		//$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Edit_Profile');
	}
	public function Signup(){
		$this->load->view('Template/header');
		$this->load->view('Sign_Up');
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
			//print_r($output);
			if ($output->ResponseCode == 1) {
				$city_id = $output->Response[0]->id;
				if(isset($_POST['abc']) == 1){

				}else{
				$_SESSION['city_id'] =$city_id;
			}
				$this->getDistance();
			}else{
				return "error";
			}
		}	
	}
	public function getDistance(){

		  if(isset($_POST['origin'])){
		    // print_r($val);
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
	public function home($id){
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
		$result = $this->db->query('select * from tbl_users where id = '.$id)->row();
		$_SESSION['user_details'] = $result;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('select_move-type');
	}
	public function page1(){
		if(isset($_FILES['receiptImage'])){
			 $filen = $_FILES["receiptImage"]['name'];
			 $path = 'public/receipt_image/'.$filen; 
			   $mypath = base_url('public/receipt_image/').$filen;
				
				if(move_uploaded_file($_FILES["receiptImage"]['tmp_name'],$path)) 
					{
				$GLOBALS['msg'] .= "File# ".($j+1)." ($filen) uploaded successfully<br>";
				$_SESSION['receiptImage'] = $mypath;
					//print_r($_SESSION);die;
					}
					else {
				$GLOBALS['msg'] = "No files found to upload"; //No file upload message 
				}
			}
		if(isset($_POST['moveType'])){
		$_SESSION['moveType'] =	$_POST['moveType'];
		$_SESSION['receiptNumber'] = $_POST['receiptNumber'];
		}
		//echo "<pre>";print_r($_SESSION);die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('moving');	
	}
	
	public function page2(){
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
			   }
			  }
			 }
			 else {
			  $GLOBALS['msg'] = "No files found to upload"; //No file upload message 
			}
			//print_r($GLOBALS['msg']);echo "<pre>";print_r($mypath);die;
			
		$_SESSION['itemImage'] = $mypath;}
		if(isset($_POST['movingDesc'])){
		  $_SESSION['movingDesc'] = $_POST['movingDesc'];			
			}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('pickup-destination1');
		}
	public function page3(){

		if(isset($_POST['submit'])){
			// echo "<pre>";print_r($_SESSION);die;
		$_SESSION['mybookingData']=$_POST;
			}
		$this->load->view('Template/inner/header');	
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_vehicle-type');
		}
	public function page4(){
		//echo "<pre>";print_r($_SESSION);die;
		if(isset($_POST['submit'])){
		//	echo "<pre>";print_r($_POST);echo "<pre>";print_r($_SESSION);die;
		foreach($_SESSION['vehicleData'] as $key){
			if($key->id == $_POST['vehicleData']){
		$_SESSION['selectedVehicle'] = $key;	
				}
			     }
	
		$upstair_flight = $_SESSION['mybookingData']['upstairs'];
		$downstair_flight = $_SESSION['mybookingData']['downstairs'];
		$upstair_flight_charges = ($_SESSION['settingdata'][0]->flight_charges *$upstair_flight);
		$downstair_flight_charges = ($_SESSION['settingdata'][0]->flight_charges *$downstair_flight);

		// $total_flight_charges = $upstair_flight_charges + $downstair_flight_charges;
		$loading_rate   = $_SESSION['settingdata'][0]->loading_rate*$_SESSION['mybookingData']['loadingTime'];
		$unloading_rate   = $_SESSION['settingdata'][0]->unloading_rate*$_SESSION['mybookingData']['unloadingTime'];
	
		if($_SESSION['mybookingData']['moverRequired'] == 'on'){
		$pickup_movers =1;
		$movers_charges   = $_SESSION['settingdata'][0]->movers_charges;
		}else{
			$pickup_movers = 0;
			$movers_charges   = 0;
		}
			$hoursCharged = ceil($_SESSION['mapData']['duration_value'] /3600);
			// $data1  =str_replace(' mins', '', $hoursCharged);$data = 
			// $data = $hoursCharged/3600;
		$hours_charges = ceil($_SESSION['selectedVehicle']->hours_charges*$hoursCharged);
		$km_charges   =  ceil($_SESSION['selectedVehicle']->km_charges*$_SESSION['mapData']['distInKms']);
		$totalEstimate = ceil($km_charges + $hours_charges+$movers_charges+$loading_rate+$unloading_rate+$upstair_flight_charges+$downstair_flight_charges);
		$_SESSION['calculatedSpecificFare'] = array(
				'user_id'=>$_SESSION['user_details']->id,
				'vehicle_id' =>$_SESSION['selectedVehicle']->id,
				'move_id'=>$_SESSION['moveType'],
				'receipt_number'=>135,
				'pickup_loc'=>$_SESSION['mapData']['pickupAdd'],
				'destination_loc'=>$_SESSION['mapData']['dropOffAdd'],
				'booking_date'=>0,
				'booking_time'=>0,
				'estimated_price'=>$totalEstimate,
				'total_price'=>0,
				'pickup_latitude'=>$_SESSION['mapData']['pickupLat'],
				'pickup_longitude'=>$_SESSION['mapData']['pickupLong'],
				'destination_latitude'=>$_SESSION['mapData']['dropoffLat'],
				'destination_longitude'=>$_SESSION['mapData']['dropoffLong'],
				'pickup_level'=>$upstair_flight,
				'destination_level'=>$downstair_flight,
				'destination_movers'=>0,
				'description'=>$_SESSION['movingDesc'],
				'receipt_image'=>$_SESSION['receiptImage'],
				'pickup_movers'=>$pickup_movers,
				'time_duration'=>$_SESSION['mapData']['duration_value'],
				'distance'=>$_SESSION['mapData']['distInKms'],
				'path_polyline'=>base64_encode($_SESSION['mapData']['polyline']),
				'item_image1'=>$_SESSION['itemImage'][0],
				'item_image2'=>$_SESSION['itemImage'][1],
				'item_image3'=>$_SESSION['itemImage'][2],
				'item_image4'=>$_SESSION['itemImage'][3],
				'distance_fare'=>$km_charges,
				'hourly_fare'=>$hours_charges,
				'pickup_flight_fare'=>$upstair_flight_charges,
				'destination_flight_fare'=>$downstair_flight_charges,
				'loading_fare'=>$loading_rate,
				'loading_time'=>$_SESSION['mybookingData']['loadingTime'],
				'unloading_fare'=>$unloading_rate,				
				'unloading_time'=>$_SESSION['mybookingData']['unloadingTime'],				
				'movers_fare'=>$movers_charges,			
				);	
			  }	
		//echo "<pre>";print_r($_SESSION['calculatedSpecificFare']);die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_picuptime');		
	}

	public function cancelpromocode(){
		unset($_SESSION['promoapplydata']);
		redirect('App/page5');
	}
	public function page5(){
		if(isset($_POST['applypromo'])){
			$data12 = [
				'user_id'=>$_SESSION['user_details']->id,
				'promo_id'=>empty($this->input->post('promoid'))?'':$this->input->post('promoid'),
				'promocode'=>empty($this->input->post('promocode'))?'':$this->input->post('promocode')
			];
			// print_r($data12);die;
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
			// echo "<pre>";print_r($output);die;
			if($output->ResponseCode == 1) { /* Handle error */ 
				unset($_SESSION['errorpromo']);
				$responseData =  $output->response;
				$_SESSION['promoapplydata'] = $responseData->promocode[0];
				$_SESSION['promoapplyid'] = $responseData->promodata[0]->id;
				// redirect('App/page5');
			}else{
				unset($_SESSION['promoapplydata']);
				$error = $output->MessageWhatHappen;
				$_SESSION['errorpromo'] = $error;
				redirect('App/promocode');
			}
			
		}	
		if(isset($_POST['datepick'])){
			$datetime= str_replace('/','-',$_POST['datepick']);
			$date_arr = explode(' ',$datetime);
			$sdate=date('Y-m-d', strtotime($date_arr[0]));
			$mydate = $sdate.' '.$date_arr[1]. ':00';
			date_default_timezone_set('Asia/Calcutta');
			$asia_timestamp = strtotime($mydate);
			date_default_timezone_set('UTC');
			$utcDate = date("Y-m-d", $asia_timestamp);
			$utcTime = date("H:i:s", $asia_timestamp);

			$_SESSION['calculatedSpecificFare']['booking_date'] = $utcDate;
			$_SESSION['calculatedSpecificFare']['booking_time'] = $utcTime;	
               	}
		
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('book-move');	
	}
	public function promocode($promoid=null){
		
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
			$error_msg ="NO DATA FOUND";
		}
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('free-moves-listings');
	}
	public function freeMove(){

		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Sidebar_free_moves');
	}
	public function getPromoData(){
		if(isset($_POST['data'])){
			$data = json_decode($_POST['data']);
				$mydata = $data->response->available;
				//print_r($mydata);die;
				$promodata = $data->response->promocodes;
				$referdata = $data->response->refercode;
				if(isset($mydata) && !empty($mydata)){
					$daa.=' <form action="'.base_url().'App/page5" method="POST">';
						foreach ($mydata as $key => $value) {
							$date = date("d M y", strtotime($value->expiry_date));
						$daa .='
							<div class="promo-code-listing">
							  	<div class="pcl-right-content text_grey">
									<div class="add_apply">
										<span>'.$value->promo_code.'</span>
										<a href="#" data-toggle="modal" data-target="#applypromo'.$value->id.'">Apply</a>
									</div>
								  	<p class="main-content"><b>'.$value->value.'% off</b> on your next referral. Avail offer max upto $'.$value->max_amount.'.</p><p class="content-subheading">Valid till ' .$date.'</p>
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
									             	<input type="hidden" name="promoid" value="'.$value->id.'">
									              	<input type="submit" name="applypromo" value="Yes">
									             
									            </div>
									        </div>
								      	</div>
								    </div>
								</div>
							</div>

							  ';
						}
							$daa  .= '</form>';

				}
				if(isset($promodata) && !empty($promodata)){
					foreach ($promodata as $key => $value) {
						$date = date("d M y", strtotime($value->expire_date));
									$daa .='
 <div class="promo-code-listing">
 <div class="pcl-left-img"><img src="'.base_url('public').'/images/referral-code.png" class="img-responsive"></div>
  <div class="pcl-right-content text_grey"><p class="main-content"><b>'.$value->value.'% off</b> on your next referral. Avail offer max upto $'.$value->max_amount.'.</p><p class="content-subheading">Valid till ' .$date.'</p></div>

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
	public function Cards($cardid=null){
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
			if ($output->ResponseCode == 1) { /* Handle error */ 
				$responseData =  $output->response;
				$this->session->set_flashdata('success','Card deleted sucessfully');
			}else{
				$this->session->set_flashdata('success','Something Went Wrong.');		
			}
		}

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
		//echo "<pre>";print_r($output);die;
		if($output->ResponseCode == 1) { /* Handle error */ 
			$responseData['cardlist'] =  $output->Response;
			$_SESSION['bookCharge'] = $output->setData[0]->min_booking_charge;
		}else{
			$error_msg ="NO DATA FOUND";
			//echo $error_msg; 				
		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar',$responseData);
		$this->load->view('card');
	}

	public function page6($cardid){
		if(isset($_POST['submit'])){
			$bookingDateTimeCheck = $_SESSION['calculatedSpecificFare']['booking_date']." ".$_SESSION['calculatedSpecificFare']['booking_time'];
			$currentdate = date('Y-m-d H:i:s'); 
			if($currentdate < $bookingDateTimeCheck){
				unset($_SESSION['errorbookingdate']);
			}else{ 
			    $_SESSION['errorbookingdate'] = "Check Booking Date Time";
				redirect('App/page4');
			}
			
			// $data = $_SESSION['calculatedSpecificFare'];
			// $net_amount = $_SESSION['calculatedSpecificFare']['estimated_price'];
			//$Bookcharge = $_SESSION['bookCharge'];
			//$net_amount = $net_amount * $Bookcharge / 100 ;
			//$_SESSION['calculatedSpecificFare']['estimated_price'] = $net_amount;
			$_SESSION['calculatedSpecificFare']['card_id'] = $cardid;
			$_SESSION['calculatedSpecificFare']['promoid'] = empty($_SESSION['promoapplydata'])?'':$_SESSION['promoapplyid'];
			$_SESSION['calculatedSpecificFare']['city_id'] = $_SESSION['city_id'];
			$newData = $_SESSION['calculatedSpecificFare'];
			//echo "<pre>";print_r($newData);die;
			$url = 'http://movers.com.au/Admin/api/User/bookmove';
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
							
			if ($output->ResponseCode == 0) { /* Handle error */ 
				$_SESSION['errorbookingResponseMessage'] = $output->MessageWhatHappen;	
				// $re = [','];
				// echo "<pre>"; $vv = str_replace($re,'</br>',json_encode($_SESSION['calculatedSpecificFare']));
				// 		print_r(str_replace('"', '',$vv));	
				// print_r($output);die;
				redirect('App/home/$_SESSION["user_details"]->id');
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
				'totalPrice'=>$this->input->post('amount'),
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
				$this->session->set_flashdata('success',$output->MessageWhatHappen);
				redirect('App/yourmoves');
			}else{
				$this->session->set_flashdata('success',$output->MessageWhatHappen);
				redirect('App/yourmoves');
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
			$mover = ['driver'=>$driver_data,'rating'=>$rating];
		}else{

		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar',$mover);
		$this->load->view('Sidebar_mover_found');	
	}
	public function yourMoveListData(){
		$_SESSION['MoveHistory'] = $_POST['data'];			
			$dec = json_decode($_SESSION['MoveHistory']);
			
			$myData = $dec->Response; 
			//echo "<pre>";print_r($myData);die;	
		$user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getvechicle'));
		$VehicleData = $user->Response;
		  foreach($VehicleData as $keys=>$vAlues){
                           	$nameS[$vAlues->id] = $vAlues->name;
                              }
	  if($dec->ResponseCode == true){
		foreach($myData as $key=>$value){
			$date = date("d M y", strtotime($value->booking_date));
			date_default_timezone_set('UTC'); 
	        $datetime = $value->booking_time ;
	        $asia_timestamp = strtotime($datetime);
	        date_default_timezone_set('Asia/Calcutta');
	        $utcDateTime = date("H:i:s", $asia_timestamp);
	        $time = date("h:i A.", strtotime($utcDateTime));
           
				if($_POST['mytype'] == 1){
					$text = 'Pending';
				}elseif($_POST['mytype'] == 2){
					$text = 'Active';}
				elseif($_POST['mytype'] == 3){
					$text = 'Completed';
				}
				else{
					$text = 'Cancelled';
				}
			$vehicleId= $value->vehicle_id;										 
     $data .=  '<tr  data-toggle="collapse" data-target="#accordion'.$key.'" class="clickable clickable'.$key.'">
       <td class="NUmber_Font">'. $value->booking_date.'</td>      
      <td class="NUmber_Font">$'.$value->estimated_price.'<button class="move-label completed">'.$text.'</button></td>
        <td>'.$nameS[$vehicleId].'</td>
      <td>'.$value->pickup_loc.'</td>
      <td>'.$value->destination_loc.'</td>
    </tr>
       
<tr>    <td colspan="6"> 

    <div id="accordion'.$key.'" class="collapse"><div class="your-move-detail-box">
        <div class="row"><div class="col-md-12 col-lg-4 col-sm-12"><div class="mdb-img">
<img src="https://maps.googleapis.com/maps/api/staticmap?size=350x250&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|'.$value->pickup_latitude.','.$value->pickup_longitude.'&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|'.$value->destination_latitude.','.$value->destination_longitude.'&path=weight:5%7Ccolor:0x14456a%7Cenc:'.base64_decode($value->path_polyline).'&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img></div></div>
 <div class="col-md-12 col-lg-5 col-sm-12 main-center-border-mdb"><div class="mdb-content"><h4 class="NUmber_Font price">$'.$value->estimated_price.'</h4><p class="time-date">MoveID : '.$value->id. '<br>'.$date.'  '.$time.'</p>
     <div class="content-addr-your-move">
<div class="addr-inner addr-pickup"><div class="addr-inner-img"><img src=" '.base_url("public/").'images/move-details-pickup.png" class="img-responsive"></div> <div class="addr-inner-content"><h5>Pickup Location</h5><p>'.$value->pickup_loc.'</p></div></div>
<div class="dots"><img src="'.base_url("public/").'images/dots-grey.png" class="img-responsive"></div>
<div class="addr-inner addr-dest"><div class="addr-inner-img"><img src="'.base_url("public/").'images/move-details-destination.png" class="img-responsive"></div> <div class="addr-inner-content"><h5>Dropoff Location</h5><p>'.$value->destination_loc.'</p></div></div>
</div></div>
</div>
<div class="SIghIn">
	<form action="'.base_url().'App/MoveDetails/'.$value->id.'">
<button type="submit">View Details</button>
</form>
</div>
</div></div></div>
</div></div></td></tr>';

			 } 
			}
			else{
			$data ="No Data Found";	
		
			}
   				print_r($data);die;
		}

	
	public function yourmoves(){	
		
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
			//echo "<pre>";print_r($output);die;						
			if ($output->ResponseCode == 0) { /* Handle error */ 
			$_SESSION['errorbookingResponseMessage'] = $output->MessageWhatHappen;
				//print_r($output);die;
			//redirect('App/page1');
			}else{
			
			$_SESSION['NewBook_id'] = $output->Move_id;
			unset($_SESSION['errorbookingResponseMessage']);
					}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('movelist');	
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
				}else{print 1;}
			}
              	 }
	public function logout(){
		session_destroy();
		redirect('App/index');
		}
	     
	public function MoveDetails($move_id){
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
									
			if ($output->ResponseCode == 0) { /* Handle error */ 
				$error_msg ="NO DATA FOUND";
			}else{
				$responseData =  $output->response;					
				}	
			//echo "<pre>";print_r($responseData);die;
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
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
		// echo "<pre>"; print_r($output);die;					
		if ($output->ResponseCode == 0) {  
			$error_msg ="NO DATA FOUND";
		}else{
			$responseData =  $output->response;					
		}
		

		if(isset($_POST['editsubmit'])){
			unset($_SESSION['retryBook']);
			$user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getmove'));
			// echo "<pre>";print_r($user);
			// echo "<pre>";print_r($output);die;
			$moveData = $user->Response->movedata;
			$settingData = $user->Response->settingdata;
			$datebook = $output->response->booking_data[0]->booking_date;
			$datetime = $output->response->booking_data[0]->booking_time;
			$movers_charge = $output->response->booking_data[0]->movers_fare;
			$loading_rate = $output->response->booking_data[0]->loading_fare;
			$unloading_rate = $output->response->booking_data[0]->unloading_fare;
			$upstair_flight_charges = $output->response->booking_data[0]->pickup_flight_fare;
			$downstair_flight_charges = $output->response->booking_data[0]->destination_flight_fare;

			$hour_charge = $output->response->vehicleDetail[0]->hours_charges;
			$km_charge = $output->response->vehicleDetail[0]->km_charges;
			
			$hoursCharged = ceil($_SESSION['mapData']['duration_value'] /3600);
			$hours_charges = ceil($hour_charge*$hoursCharged);
			$km_charges   =  ceil($km_charge*$_SESSION['mapData']['distInKms']);
			$totalEstimate = ceil($km_charge + $hours_charge + $movers_charge + $loading_rate + $unloading_rate + $upstair_flight_charges + $downstair_flight_charges);
			$bdata = [
				'user_id'=>$_SESSION['user_details']->id,
				'pickup_loc'=>$_SESSION['mapData']['pickupAdd'],
				'destination_loc'=>$_SESSION['mapData']['dropOffAdd'],
				'booking_date'=>0,
				'booking_time'=>0,
				'estimated_price'=>$totalEstimate,
				'pickup_latitude'=>$_SESSION['mapData']['pickupLat'],
				'pickup_longitude'=>$_SESSION['mapData']['pickupLong'],
				'destination_latitude'=>$_SESSION['mapData']['dropoffLat'],
				'destination_longitude'=>$_SESSION['mapData']['dropoffLong'],
				'time_duration'=>$_SESSION['mapData']['duration_value'],
				'distance'=>$_SESSION['mapData']['distance'],
				'path_polyline'=>$_SESSION['mapData']['polyline'],
				'distance_fare'=>$km_charges,
				'hourly_fare'=>$hours_charges,
				'book_id'=>$output->response->booking_data[0]->id,
				'city_id'=>$_SESSION['city_id']
			];

			$date = date("d M y", strtotime($output->response->booking_data[0]->booking_date));
			date_default_timezone_set('UTC'); 
	        $datetime = $output->response->booking_data[0]->booking_time;
	        $asia_timestamp = strtotime($datetime);
	        date_default_timezone_set('Asia/Calcutta');
	        $utcDateTime = date("H:i:s", $asia_timestamp);
	        $time = date("h:i A.", strtotime($utcDateTime));
			$bookingDateTimeCheck = $date.''.$time;
			$current = $output->servertime;
			$_SESSION['editbookdata'] = $bdata;
			//print_r($_SESSION['editbookdata']);die;
			if($current < $bookingDateTimeCheck){
				$_SESSION['editbookdata']['booking_date'] = $datebook;
				$_SESSION['editbookdata']['booking_time'] = $datetime;
				redirect('App/bookeditdata');
			}else{
				redirect('App/select_time');
			}
			
		}	
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('edit_destination');
	}
	public function select_time(){
		//echo"<pre>";print_r($_SESSION['editbookdata'] );die;
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('edit_booktime');
	}
	public function book_select_time(){
		$datetimee= str_replace('/','-',$_POST['datepick']);
		$date_arr = explode(' ',$datetime);
		$sdate=date('Y-m-d', strtotime($date_arr[0]));
		$_SESSION['editbookdata']['booking_date'] = $sdate;
		$_SESSION['editbookdata']['booking_time'] = $date_arr[1].":00";
		redirect('App/bookeditdata');		
	}
	public function cardList($move_id,$time,$date){
		if(isset($_POST['retrysubmit'])){
			unset($_SESSION['editbookdata']);
			$data12 = [
				'move_id'=>$move_id,
				'booking_date'=>$date,
				'booking_time'=>$time,
				'promoid'=>''
			];
			$_SESSION['retryBook'] = $data12;

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
			//print_r($data1);die;
			$url = 'http://movers.com.au/Admin/api/User/retryMove';
		}else{
			$data1 = $_SESSION['editbookdata'];
			//print_r($_SESSION['editbookdata']);die;
			$url = 'http://movers.com.au/Admin/api/User/editMove';
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
		if ($output->ResponseCode == 1) {
		// print_r($output->Move_id);die;
			$msg = $output->MessageWhatHappen; 
			$_SESSION['NewBook_id'] = $output->Move_id;
		}else{
			echo "hello";				
		}
		$this->load->view('Template/inner/header');
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('Search_mover');			
	}	
	public function ApplyreferCode(){
		if(isset($_POST['applypromo'])){
			$data12 = [
				'user_id'=>$_SESSION['user_details']->id,
				'promo_id'=>empty($this->input->post('promoid'))?'':$this->input->post('promoid'),
				'promocode'=>empty($this->input->post('promocode'))?'':$this->input->post('promocode')
			];
			// print_r($data12);die;
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
			echo "<pre>";print_r($output);die;
			if($output->ResponseCode == 1) { /* Handle error */ 
				unset($_SESSION['errorpromo']);
				$_SESSION['successpromodata'] =  $output->response;
			}else{
				$error = $output->MessageWhatHappen;
				$_SESSION['errorpromo'] = $error;
			}
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
		//echo"<pre>";print_r($output);die;
		if($output->ResponseCode == 1) { /* Handle error */ 
			$responseData =  $output->response;
		}else{
			$error_msg ="NO DATA FOUND";
		}
		$this->load->view('Template/inner/header',$responseData);
		$this->load->view('Template/inner/Left_sidebar');
		$this->load->view('free_moves_listing1');	
	}
	
}

