 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class User_model extends CI_Model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');

	}
	public function sign_up($data,$loginParams,$type,$refercode,$user_refercode){
    /*mannual signup start*/
	if ($type == 1) {

		$data['manual_signUp'] = 1;
		$data['user_Type']=1;
		$data['refercode']=$refercode;
		$data['used_refercode']=$user_refercode;

		$var = $this->db->select('*')
		->from('tbl_users')
		->where('email',$data['email'])
		->get()->result();
			if(empty($var)){	
	    
						$this->db->insert('tbl_users', $data);
						$insertId = $this->db->insert_id();
						/*initial amount 0 in wallet for user*/
						$amount =0;
						$addBal = $this->User_model->insert_data('tbl_wallet',array('balence'=>$amount,'user_id'=>$insertId,'date_created'=>date('Y-m-d H:i:s')));
						$loginParams['user_id'] = $insertId;
						$this->db->insert('tbl_login', $loginParams);
						$getRes = $this->User_model->select_data('*','tbl_users',array('id'=>$insertId));
						return $getRes;			
			}
			else{
	
				return 0;
			}
	 }
	 /*mannual signup end*/
	 /*fb signup start*/
		elseif($type == 2) { 
			$data['fb_signUp'] = 1;
			$data['user_Type'] =1;
			$data['refercode'] =$refercode;
			$data['used_refercode']=$user_refercode;
			$query = $this->db->select('*')
			->from('tbl_users');
			if($data['fb_id']){$query->where('fb_id',$data['fb_id']);}
			if($data['email']){$query->or_where('email',$data['email']);}
				$var= $query->get()->result();
				if(empty($var)){								
					$this->db->insert('tbl_users', $data);
					$insertId = $this->db->insert_id();
					/*initial amount 0 in wallet for user*/
					$amount =0;
					$addBal = $this->User_model->insert_data('tbl_wallet',array('balence'=>$amount,'user_id'=>$insertId,'date_created'=>date('Y-m-d H:i:s')));
					$loginParams['user_id'] = $insertId;
					$this->db->insert('tbl_login', $loginParams);
					$getRes = $this->User_model->select_data('*','tbl_users',array('id'=>$insertId));
					return $getRes;
				}
				else{
   					return 0;
				}
		}
		/*fb signup end*/
		/*google signup start*/
		elseif($type == 3) { 
			$data['google_signUp'] = 1;
			$data['user_Type'] = 1 ;
			$data['refercode']=$refercode;
			$data['used_refercode']=$user_refercode;
			$query = $this->db->select('*')
			->from('tbl_users');
			if($data['google_id']){$query->where('google_id',$data['google_id']);}
			if($data['email']){$query->or_where('email',$data['email']);}
			$var= $query->get()->result();
				if(empty($var)){	
					$this->db->insert('tbl_users', $data);
					$insertId = $this->db->insert_id();
					/*initial amount 0 in wallet for user*/
					$amount =0;
					$addBal = $this->User_model->insert_data('tbl_wallet',array('balence'=>$amount,'user_id'=>$insertId,'date_created'=>date('Y-m-d H:i:s')));
					$loginParams['user_id'] = $insertId;
					$this->db->insert('tbl_login', $loginParams);
					$getRes = $this->User_model->select_data('*','tbl_users',array('id'=>$insertId));
					return $getRes;
				}else{
					return 0;
				}	
		} 
		/*google signup end*/
	}
	public function login($data,$loginParams,$type,$user_type){
		/*mannual login start*/
			if ($type == 1) {
				$selectData = $this->db->select('*')
				->from('tbl_users')
				->where('email',$data['email'])
				->where('password',$data['password'])
				->get()->result();

					if(empty($selectData)){		     
					return 0;
					}
					else
					{
         				$typer=$selectData[0]->user_Type;
         				/*checking of type in case customer app or driver app*/
						if ($user_type==$typer) {
					
							$loginParams['user_id'] = $selectData[0]->id;
							$this->db->insert('tbl_login', $loginParams);
							$getRes = $this->User_model->select_data('*','tbl_users',array('email'=>$data['email']));
							return $getRes;
						}
						else{
							return 1;
						}
				    }
			}
			/*mannual login end*/
			/*fb login start*/
			else if ($type == 2){
				$selectsocial = $this->db->select('*')
				->from('tbl_users')
				->where('fb_id',$data['fb_id'])
				->get()->row();
				/*if fb id doesnot exists start*/
					if(empty($selectsocial)){
						if(!empty($data['email'])){
						$selectemail = $this->db->select('*')
						->from('tbl_users')
						->where('email',$data['email'])
						->get()->row();
						/*if email exist and id doesnot exist start*/
							if (!empty($selectemail)){
						       $typer=$selectemail->user_Type;
								/*checking of type in case customer app or driver app*/
								if ($user_type==$typer) {
									$data['fb_signUp']=1;
									$filterdata=array_filter($data);
									$data['user_Type']=$user_type;
									$this->db->where('email', $data['email']);
									$this->db->update('tbl_users', $filterdata); 
									$getdata=$this->User_model->select_data('*','tbl_users',array('email'=>$data['email']));
									return $getdata;
								}
								else{
									return 1;
								}
							}
							else{
								return 0;
							}
						}
						/*if email exist and id doesnot exist end*/
						else{
							return 0;
						}
					}
					/*if fb id doesnot exists end*/
					else
					{
					$typer=$selectsocial->user_Type;
					/*checking of type in case customer app or driver app*/
						if ($user_type==$typer) {
							$loginParams['user_id'] = $selectsocial->id;
							$this->db->insert('tbl_login', $loginParams);
							$getRes = $this->User_model->select_data('*','tbl_users',array('fb_id'=>$data['fb_id']));
							return $getRes;
						} 
						else{
							return 1;
						}
					}
			}
			/*fb login end*/
			/*google login start*/
			else if ($type == 3){
				$selectsocial = $this->db->select('*')
				->from('tbl_users')
				->where('google_id',$data['google_id'])
				->get()->row();
				/*if google id doesnot exists start*/
					if(empty($selectsocial)){
						if(!empty($data['email'])){
						$selectemail = $this->db->select('*')
						->from('tbl_users')
						->where('email',$data['email'])
						->get()->row();
						/*if email exist and id doesnot exist start*/
							if (!empty($selectemail)){
						       $typer=$selectemail->user_Type;
						       /*checking of type in case customer app or driver app*/
								if ($user_type==$typer) {

									$data['google_signUp']=1;
									$filterdata=array_filter($data);
									$data['user_Type']=$user_type;
									$this->db->where('email', $data['email']);
									$this->db->update('tbl_users', $filterdata); 
									$getdata=$this->User_model->select_data('*','tbl_users',array('email'=>$data['email']));
									return $getdata;
								}
								else{
									return 1;
								}
							}
							/*if email exist and id doesnot exist end*/
							else{
								return 0;
							}
						}
						else{
							return 0;
						}
					}
					/*if google id doesnot exists end*/
					else
					{

					$typer=$selectsocial->user_Type;
					/*checking of type in case customer app or driver app*/
						if ($user_type==$typer) {
							$loginParams['user_id'] = $selectsocial->id;
							$this->db->insert('tbl_login', $loginParams);
							$getRes = $this->User_model->select_data('*','tbl_users',array('google_id'=>$data['google_id']));
							return $getRes;
						} 
						else{
							return 1;
						}
					}

			}
			/*google login end*/

	
	}
		
	 	public function log_out($unique_deviceId,$user_id){

	 		$selectdata=$this->db->select('*')
	 		->from('tbl_login')
	 		->where('user_id',$user_id)
	 		->get()->result();
	 		if (!empty($selectdata)) {
	 			$data = array('status' => '0');
	 			$this->db->where('unique_deviceId',$unique_deviceId);
	 			$this->db->where('user_id',$user_id);
	 			$qu= $this->db->update('tbl_login',$data);
	 			return $qu;
	 		}
	 		else{
	 			return 0;
	 		}
	 	}
	 	public function getone($id){
	 		$result=$this->User_model->select_data('*','tbl_users',array('id'=>$id));
	 		return $result;

	 	}
	 	public function getalldata(){
	 		$getdata=    $this->db->select('*')->from('tbl_users')->get()->result();
	 		return $getdata;

	 	}
	 	public function getallvechicle(){
	 		$getdata=    $this->db->select('*')->from('tbl_vechicleType')->get()->result();
	 		return $getdata;

	 	}
	 	public function getallmove(){
	 		$getdata=    $this->db->select('*')->from('tbl_moveType')->get()->result();
	 		return $getdata;

	 	}
	 	public function movetype($data){
	 		$result = $this->db->insert('tbl_moveType',$data);
	 		$insertId = $this->db->insert_id();   
	 		$getdata=    $this->db->select('*')->from('tbl_moveType')->where('id', $insertId)->get()->row();
	 		return $getdata;
	 	}
	 	public function vechicletype($data){
	 		$result = $this->db->insert('tbl_vechicleType',$data);
	 		$insertId = $this->db->insert_id();   
	 		$getdata=    $this->db->select('*')->from('tbl_vechicleType')->where('id', $insertId)->get()->row();
	 		return $getdata;
	 	}

		public function insert_data($tbl_name,$data)                                         /* Data insert */
	    {
	      	$this->db->insert($tbl_name, $data);
	       	$insert_id = $this->db->insert_id();
	        return $insert_id;

	    }
		public function twillio($number,$msg)
		{ 
			$this->load->library('twilio');
			// $from = '+15512727143';
			$from = '+15005550006';
			$response = $this->twilio->sms($from, $number, $msg);

			if($response->IsError)
				// echo 'Error: ' . $response->ErrorMessage;
				return 2;
			else
				return 1;
		}
		public function bookmove($data){
			
			$gettime= $this->db->query("select buffer_time from tbl_setting")->row();
			$time=$gettime->buffer_time;
			$getdata= $this->db->query("SELECT a.id,a.email,b.token_id,b.device_id,(select buffer_time from tbl_setting) as timed, ( 3959 * acos( cos( radians(30.5455) ) * cos( radians( latitude ) ) * cos( radians(longitude) - radians(72.0554) ) + sin( radians(30.5455) ) * sin( radians( latitude ) ) ) ) as distance FROM`tbl_users` AS a JOIN tbl_login AS b ON a.id = b.user_id WHERE a.user_Type = 2 AND a.id NOT IN ( SELECT driver_id  FROM `tbl_booking`  WHERE CONCAT('".$data['booking_date']."', ' ', '".$data['booking_time']."') BETWEEN CONCAT(booking_date, ' ', booking_time) AND DATE_ADD(CONCAT(booking_date, ' ', booking_time) , INTERVAL ('".$data['time_duration']."' + (('".$time."')*2)) MINUTE) OR DATE_ADD(CONCAT('".$data['booking_date']."', ' ', '".$data['booking_time']."'), INTERVAL('".$data['time_duration']."' + (('".$time."')*2)) MINUTE) BETWEEN CONCAT(booking_date, ' ', booking_time) AND DATE_ADD(CONCAT(booking_date, ' ', booking_time) , INTERVAL ('".$data['time_duration']."' + (('".$time."')*2)) MINUTE))")->result();
			// print_r($getdata);die();
	 		return $getdata;
		}
		public function customerRating($data){
	    	$array = $this->db->insert('tbl_customerRating',$data);
	 		$insertId = $this->db->insert_id();   
	 		$getdata=    $this->db->select('*')->from('tbl_customerRating')->where('id', $insertId)->get()->row();
	 		return $getdata;

		}
		 public function applypromo($message){

		 	$data['promo'] = $this->User_model->select_data('*','tbl_promocode',array('promo_code'=>$message['promo_code']));
         	$data['refer'] = $this->User_model->select_data('*','tbl_users',array('refercode'=>$message['promo_code']));

                    if (empty($data)) {
                        return 0;/////code doesnt exist
                    }
                    /*promo code case start*/
                    elseif (!empty($data['promo'])) {
                    
   						/*first we check expiry date*/
                         $promodata=$this->db->query("SELECT * FROM tbl_promocode WHERE promo_code= '".$message['promo_code']."' and  expiry_date > CURDATE()")->result();
                   if (empty($promodata)) {
                       return 1;///////////expired
                    }
                   else{
                   	/*we check wheather previousely applied promo code and not used */
                 $promodata12=$this->db->query("select * from tbl_promousers where user_id='".$message['user_id']."' and promo_code = '".$message['promo_code']."'")->result();
                  if (empty($promodata12)) {
                 $curr_refAmount = $this->User_model->select_data('*','tbl_promocode',array('promo_code'=>$message['promo_code']));
                 // $amount = $curr_refAmount[0]->value;


                 // $walletdata = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$message['user_id']));
                 $user=$message['user_id'];
                 // $getlatest=$amount+$walletdata[0]->balence;
                 // $data=array('balence'=>$getlatest,'user_id'=>$user);
                 // $var= $this->User_model->update_data('tbl_wallet',$data,array('user_id'=>$message['user_id']));



                 /*update in tbl_promousers that users has applied code but not used*/
                 $addBal = $this->User_model->insert_data('tbl_promousers',array('promo_code'=>$message['promo_code'],'is_used'=>2,'user_id'=>$user,'date_created'=>date('Y-m-d H:i:s')));



                 // $addtransArray = array(
                 // 'amount_credited'=>$amount,
                 // 'user_id'=>$user,
                 // 'txn_id'=>'frompromo',
                 // 'type'=>"from promo",
                 // 'date_created'=>date('Y-m-d H:i:s')
                 // );
                 // $addtrans = $this->User_model->insert_data('tbl_transactions',$addtransArray);
                 return 2; ///////applied sucessfully        
                 }
                 elseif($promodata12[0]->is_used==2){
                    return 3;///////already applied
                  }
                  else{
                  	return 4;

                  }
                 }
               
                }
                /*promo code case end*/




                /*refer code case start*/
                 elseif (!empty($data['refer'])) {
                 $refer = $this->User_model->select_data('used_refercode','tbl_users',array('id'=>$message['user_id']));
                 /*check that user has never used refercode*/
                  if (empty($refer[0]->used_refercode)) {
                 /*checking of current promo amount from admin panel*/
                  $curr_refAmount = $this->User_model->select_data('*','tbl_setting');                 
                 $amount = $curr_refAmount[0]->promo_amount;
                 $walletdata = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$message['user_id']));
                 $user=$message['user_id'];
                 /*addition of referal amount in wallet*/
                 $getlatest=$amount+$walletdata[0]->balence;
                 $data=array('balence'=>$getlatest,'user_id'=>$user);
                 $var= $this->User_model->update_data('tbl_wallet',$data,array('user_id'=>$message['user_id']));
                 // $addBal = $this->User_model->insert_data('tbl_promousers',array('promo_code'=>$message['promo_code'],'user_id'=>$user,'date_created'=>date('Y-m-d H:i:s')));
                 $addtransArray = array(
                 'amount_credited'=>$amount,
                 'user_id'=>$user,
                 'txn_id'=>'frompromo',
                 'type'=>"from promo",
                 'date_created'=>date('Y-m-d H:i:s')
                 );
                 $addtrans = $this->User_model->insert_data('tbl_transactions',$addtransArray);
                 $data=array('used_refercode'=>$message['promo_code']);
                 $insertusedcode= $this->User_model->update_data('tbl_users',$data,array('id'=>$message['user_id']));
                 return 6; ////////sucessfully used refercode
                    }
                    else{
                     return 5;///////already used refercode 	
                  }
                 }
                 /*refer code case end*/
        }
                   
		public function addcard($data){
	 		$getdata = $this->db->select('*')->from('tbl_cardDetail')->where('card_no', $data['card_no'])->get()->row();
	 		if (empty($getdata)) {
					$array = $this->db->insert('tbl_cardDetail',$data);
					$insertId = $this->db->insert_id();
					$getdata=    $this->db->select('*')->from('tbl_cardDetail')->where('id', $insertId)->get()->row();  
	 			    return $getdata;
	 		}
	 		else{
	 			return 0;
	 		}

		}
		public function cardlist($user_id){
		    $getdata = $this->User_model->select_data('*','tbl_cardDetail',array('user_id'=>$user_id));
	        return $getdata;
		}
		public function transactionListing($user_id){
		    $getdata['transactionListing'] = $this->User_model->select_data('*','tbl_transactions',array('user_id'=>$user_id));
		    $getdata['walletdata'] = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$user_id));
	        return $getdata;
		}
		public function moveDetailHistory($message){


		    $getdata['booking_data'] = $this->User_model->select_data('*','tbl_booking',array('id'=>$message['move_id']));
		    $getdata['move_data'] = $this->User_model->select_data('*','tbl_moveHistory',array('booking_id'=>$message['move_id']));
		   

		    $getvehicleid = $this->User_model->select_data('vehicle_id','tbl_driverDetail',array('driver_id'=>$getdata['booking_data'][0]->driver_id));
		    if ($message['user_Type']==1) {	

$getdata['usersDetail'] = $this->User_model->select_data('fname,lname,country_code,phone,profile_pic','tbl_users',array('id'=>$getdata['booking_data'][0]->driver_id));

$getdata['vehiclename'] = $this->User_model->select_data('name','tbl_vechicleType',array('id'=>$getvehicleid[0]->vehicle_id));
$rating = $this->User_model->select_data('rating','tbl_customerRating',array('req_id'=>$message['move_id']));


$getdata['rating']= $this->User_model->select_data('rating','tbl_customerRating',array('req_id'=>$message['move_id']));


$getdata['avgrating']=$this->db->query("SELECT round(AVG(rating)) as driverrating FROM tbl_customerRating WHERE driver_id='".$getdata['booking_data'][0]->driver_id."'")->result();

		    }

		    else{

		    	 $getdata['usersDetail'] = $this->User_model->select_data('fname,lname,country_code,phone,profile_pic','tbl_users',array('id'=>$getdata['booking_data'][0]->user_id));
		    }



	        return $getdata;
		}
		public function deletecard($message){
			$tables = array('tbl_cardDetail','tbl_stripeUsersDetail');
			$this->db->where('user_id', $message['user_id']);
			$this->db->where('card_no', $message['card_no']);
	        $getdata= $this->db->delete($tables);
	        // print_r($getdata);die();
	        return $getdata; 
		}
		public function selectmoney_data($message){
	         $getmoney = $this->db->select('*')
	                             ->from('tbl_stripeUsersDetail')
	                             ->where('card_no',$message['card_no'])
	                             ->where('user_id',$message['user_id'])
	                             ->get()->result();
	                             // print_r($getmoney);die();

	        return $getmoney;

	    }
	    public function update_data($tbl_name,$data,$where){                                 /* Update data */

	      $this->db->where($where);
	      $this->db->update($tbl_name,$data);

	     return($this->db->affected_rows())?1:0;
	    }

	    public function select_data($selection,$tbl_name,$where=null,$order=null)                   /* Select data with condition*/
		    {
		      if (empty($where)&&empty($order)) {
		      $data_response = $this->db->select($selection)
		           ->from($tbl_name)
		           ->get()->result();
		    }
		    elseif(empty($order)){
		    $data_response =
		    $this->db->select($selection)
		           ->from($tbl_name)
		           ->where($where)
		           ->get()->result();

		    }else{
		    $data_response =
		    $this->db->select($selection)
		           ->from($tbl_name)
		           ->where($where)
		           ->order_by($order)
		           ->get()->result();
		    }
	    return $data_response;

	    }
		// public function getLocationNew($data)                                         /* Get Location new*/
		// 	{
		// 		// print_r($data);die();
		// 		  $selectDrivers =	 $this->db->select(" ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians(longitude) - radians($long) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM tbl_users")
		// 	  ->where('user_type',2)
		// 	  ->order_by('distance', 'DESC')
		// 	 // ->limit(20, 0)
		// 	  ->get()->result();
		// 	  // print_r($selectDrivers);die;

		// 	  return $selectDrivers;

		// 	}
		/*push notification for android common function*/
    public function androidPush($pushData=null){
    	// print_r($pushData);
	    $mytime = date("Y-m-d H:i:s");
	    // if($pushData['Utype'] == 2){
	    // $api_key = "AAAAhyf2Jug:APA91bHP9_oA8arOG3aUVBAt9tqjaGUvr3Od4G7XZAFxsvfMCyVf31YB21f0cy_dwz-vFuGp9a1jV8rfMEQty8OQo5we71epg2v9m-QtS9jvNz_fMUO2vz1_6qE1gtuV17e8Ouir_wMV"; //for driver app
	    // }else if($pushData['Utype'] == 1){
	     $api_key = "AAAANVzzBLc:APA91bHbiNHUFrqMisFYeCXmk11hnwNCG9WfzuiRoHGiiQD0wL9Quv4SlEaNgd6pQdqObnL7eetzJ5MSk1Pq0agkPwiOh_J5M9sxcS9HlchG5g90yxcIh4-AGXIbCTYiZ0vg6bSKu1wR";  //for user app
	    // $api_key="";
	    // }
	    $fcm_url = 'https://fcm.googleapis.com/fcm/send';
	 	$fields = array(
      		'registration_ids' => array(
        	$pushData['token']
      		) ,
	     	 'data' => array(
	      	  "message" =>$pushData['message'] ,
	      	  "action" => $pushData['action'],
	      	  'booking_id' => $pushData['booking_id'],
	      	  'profile_pic' => $pushData['profile_pic'],
	      	  "avgrating" => $pushData['avgrating'],
	      	  "vehicleName" => $pushData['vehicleName'],
	      	  'vehicleNumber' => $pushData['vehicleNumber'],
	       	  "time" => $mytime
	      ) ,
	    );
	    $headers = array(
	      'Authorization: key=' . $api_key,
	      'Content-Type: application/json'
	    );
	    $curl_handle = curl_init();
	    // set CURL options
	    curl_setopt($curl_handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	    curl_setopt($curl_handle, CURLOPT_URL, $fcm_url);
	    curl_setopt($curl_handle, CURLOPT_POST, true);
	    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($fields));
	    $response = curl_exec($curl_handle);
	    // print_r($response);die();
	    curl_close($curl_handle);
  	}
	/*push notification for ios common function*/
  	public function iosPush($pushData=null) {
    // print_r($pushData);
    $deviceToken = $pushData['token'];
    $passphrase = '';
    $ctx = stream_context_create();
    if($pushData['Utype'] == 1){
    stream_context_set_option($ctx, 'ssl', 'local_cert', './certs/MoversPushDevelpoment.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
    }else if($pushData['Utype'] == 2){

    stream_context_set_option($ctx, 'ssl', 'local_cert', './certs/MoversPushDevelpoment.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
    }
    // Open a connection to the APNS server

    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
   // if (!$fp) exit("Failed to connect: $err $errstr" . PHP_EOL);
  
    	 $body['aps'] = array(
        "message" =>$pushData['message'] ,
        "action" => $pushData['action'],
        'booking_id' => $pushData['booking_id'],
        'sound' => 'default'
    );

   
    
	}
	public function forgotpassword($email)
	{
		$select_user = $this->db->select('*')->from('tbl_users')->where('email', $email)->get()->row();
		if (empty($select_user->id))
		{
		return 0;
		}
		else
		{
		$static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
		$id = $select_user->id . "_" . $static_key;
		$result['b_id'] = base64_encode($id);
		// $result['decb']=base64_decode($result['b_id']);
		$result['user_id'] = $select_user->id;
		$result['fname'] = $select_user->fname;
		$time=date('Y-m-d H:i:s');
		$getforgot = $this->db->select('*')->from('tbl_forgotPassword')->where('user_id', $select_user->id)->get()->result();

		if (empty($getforgot)) {
        	 $addtransArray = array(
                      'user_id'=>$select_user->id,
                      'time'=>date('Y-m-d H:i:s'),
                      'status' => 1
                      );
                      $addtrans = $this->insert_data('tbl_forgotPassword',$addtransArray);
		}
		else{
			  $uptBal = $this->update_data('tbl_forgotPassword',array('status'=>1,' time'=>date('Y-m-d H:i:s')),array('user_id'=>$select_user->id));
		}
        }
		return $result;	
	}
	public function updateNewpassword($message){
				$getforgot = $this->db->select('*')->from('tbl_forgotPassword')->where('user_id', $message['id'])->get()->result();
				$sendtime=$getforgot[0]->time;
				$time=date('Y-m-d H:i:s');
				$det= date('Y-m-d H:i:s', strtotime("$sendtime  +30 minutes"));
				/*checking that user can update password only in 30 minute*/
				if ($time <= $det && $getforgot[0]->status==1) {
				$update_pwd = $this->db->where('id', $message['id']);
				$this->db->update("tbl_users", array(
				'password' => md5($message['password']))
				);
				$update_pwd2 = $this->db->where('user_id', $message['id']);
				$this->db->update("tbl_forgotPassword", array(
				'status' => 0)
				);
				if ($update_pwd)
				$this->session->set_flashdata('msg', '<span style="color:green">Password Changed Successfully</span>');
				redirect("api/User/newpassword?id=" . $message['base64id']);
				}
				else{
				$this->session->set_flashdata('msg', '<span style="color:red">Your Reset Password Link has been Expired</span>');
				redirect("api/User/newpassword?id=" . $message['base64id']);
				}
	}




}
