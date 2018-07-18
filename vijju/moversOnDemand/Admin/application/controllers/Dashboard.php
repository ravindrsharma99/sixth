<?php
error_reporting(E_ALL);
ini_set('display_error', 1);


defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/PHPExcel.php';
require_once APPPATH.'third_party/PHPReport.php';


// require_once APPPATH.'third_party/pdf/fpdf/fpdf.php';
// require_once APPPATH.'third_party/pdf/fpdf/fpdi.php';



class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model','',TRUE);

		$this->load->library('session');
		$this->load->library("braintree_lib");
		$this->load->library('pagination');


		     $this->load->helper(array('form', 'url'));
		        // $this->load->library('PHPReport');
        $this->load->helper('download');
        // $this->load->library('PHPReport');


		
		$session_data = $this->session->userdata('logged_in');
		if(!$session_data){
			redirect('Login');
		}
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
	public function index()
	{
		$num['totalusers']= $this->db->count_all_results('tbl_users');
		$loginuserscount=$this->db->query("SELECT COUNT(DISTINCT user_id) as loginusers FROM tbl_login where status=1")->row();
		$num['loginusers']=$loginuserscount->loginusers;
		$num['totalmoves']= $this->db->count_all_results('tbl_moveType');
		$num['totalvechicle']= $this->db->count_all_results('tbl_vechicleType');

		$this->template();
		$this->load->view('home',$num);

	}


	/*sidebar,header,headerpage loaded for all view common*/
	public function template($data=null)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['name']=$session_data['fullname'];
		$this->load->view('templete/header');
		$this->load->view('templete/headerpage',$data);
		$this->load->view('templete/sidebar');
        // Footer is loaded in view for js flexibility
	}


    /*user list*/
	public function user_list()
	{
		$data['users']=$this->Admin_model->user_list();
		$this->template();
		$this->load->view('users_list',$data);
	}



	/*driver list*/
	public function driver_list()
	{
		/*update driver list*/
		if (isset($_POST['submitid'])) {
			if (empty($_POST['fname']|| $_POST['lname']   )) {
				$this->session->set_flashdata('msg1', 'Please fill valid fields');
				redirect(base_url()."Dashboard/driver_list");
			}

			$id=$_POST['submitid'];
			$edge = array('fname' => $_POST['fname'], 'lname' => $_POST['lname']);
			$users=array_filter($edge);
			$this->db->where('id', $id);
			$result= $this->db->update('tbl_users', $users);
			if ($result) {
				$this->session->set_flashdata('msg2', 'Driver Updated Sucessfully');
				redirect(base_url()."Dashboard/driver_list");
			}
			else {
				$this->session->set_flashdata('msg3', 'Something Went Wrong');
				redirect(base_url()."Dashboard/driver_list");
			}

		}
		$data['drivers']=$this->Admin_model->driver_list();
		$this->template();
		$this->load->view('driver_list',$data);
	}
	/*booking list*/
	public function booking_list()
	{
		$data['pending_booking_list']=$this->Admin_model->pending_booking_list();
		$data['started_booking_list']=$this->Admin_model->started_booking_list();
		$data['completed_booking_list']=$this->Admin_model->completed_booking_list();
		$data['cancelled_booking_list']=$this->Admin_model->cancelled_booking_list();
		$this->template();
		$this->load->view('booking_list',$data);
	}
	/*end button in started booking */
	public function end_booking(){
		$id=$_POST['id'];
		//print_r($_POST);die;
		$result=$this->Admin_model->update_data('tbl_booking',array('is_completed'=>1),array('id'=>$id));
		$result=$this->Admin_model->update_data('tbl_moveHistory',array('status'=>3,'completed_time'=>date('Y-m-d H:i:s')),array('id'=>$id));
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}


	/*booking list users detail per user id*/
	public function booking_detail($id){
		
		$data['booking']=$this->Admin_model->booking_detail($id);
		$this->template();	
		$this->load->view('booking_detail',$data);
	}


	/*edit users and driver list*/
	public function edituserlist(){
		if (isset($_POST)) {

			if (empty($_POST['fname']|| $_POST['lname']   )) {
				$this->session->set_flashdata('msg1', 'Please fill valid fields');
				redirect(base_url()."Dashboard/user_list");
			}

			$id=$_POST['submitid'];
			$edge = array('fname' => $_POST['fname'], 'lname' => $_POST['lname']);
			print_r($edge);
			$users=array_filter($edge);
			print_r($users);
			$this->db->where('id', $id);
			$result= $this->db->update('tbl_users', $users);
			if ($result) {
				$this->session->set_flashdata('msg2', 'Users Updated Sucessfully');
				redirect(base_url()."Dashboard/user_list");
			}
			else {
				$this->session->set_flashdata('msg3', 'Something Went Wrong');
				redirect(base_url()."Dashboard/user_list");
			}

		}

	}
	/*move list*/
	public function move_list()
	{
		$data['move']=$this->Admin_model->move_list();
		$this->template();
		$this->load->view('movelist',$data);
	}
	/*view for add move*/
	public function addmove(){
		$this->template();
		$this->load->view('addmove');
	}
	/* move adding*/
	public function addedmove(){
		if (isset($_POST)) {
			if (empty($_POST['title'] && $_POST['type'])) {
				echo "please fill all fields";
			}
			else{
				$data = array(
					'title' => $_POST['title'] ,
					'type' => $_POST['type'] ,

					);

				$file=$_FILES['icon'];
				$name=$file['name'];
				$image='icon';
				$upload_path='public/movetypeicon';
				$imagename=$this->file_upload($upload_path,$image,$name);
				$data['icon']=$imagename;
				$result = $this->db->insert('tbl_moveType', $data);
				if ($result) {
					$this->session->set_flashdata('msg4', 'Move Added Sucessfully');
					redirect('Dashboard/move_list');
				}
			}
		}

	}
	/*edit move list*/
	public function editmovelist(){
		if (isset($_POST)) {


			if (empty($_POST['title']|| $_POST['type']  )) {
				$this->session->set_flashdata('msg1', 'Please fill valid fields');
				redirect(base_url()."Dashboard/move_list");
			}

			$id=$_POST['submitid'];

			$file=$_FILES['icon'];
			$name=$file['name'];
			$image='icon';
			$upload_path='public/movetypeicon';
			$imagename=$this->file_upload($upload_path,$image,$name);


			$edge = array('title' => $_POST['title'], 'type' => $_POST['type'],'icon'=>$imagename);
			$plans=array_filter($edge);
			$this->db->where('id', $id);
			$result= $this->db->update('tbl_moveType', $plans);
			if ($result) {
				$this->session->set_flashdata('msg2', 'Move Updated Sucessfully');
				redirect(base_url()."Dashboard/move_list");
			}
			else {
				$this->session->set_flashdata('msg3', 'Something Went Wrong');
				redirect(base_url()."Dashboard/move_list");
			}

		}

	}

    /*delete movetype*/
	public function deletemove(){
		$id=$_POST['id'];
		$table='tbl_moveType';
		$result=$this->Admin_model->delete($id,$table);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}

	/*delete booking*/
	public function deletebooking(){
		$id=$_POST['id'];
		$table='tbl_booking';
		$result=$this->Admin_model->delete($id,$table);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*vechicle type list*/
	public function vechicle_list()
	{
		$data['vechicle']=$this->Admin_model->vechicle_list();
		$this->template();
		$this->load->view('vechiclelist',$data);

	}
	/*view for addvechicle*/
	public function addvechicle(){
		$this->template();
		$this->load->view('addvechicle');
	}
	/*add vechicle*/
	public function addedvechicle(){
		if (isset($_POST)) {
			if (empty($_POST['name'] && $_POST['height'] && $_POST['length'] && $_POST['width'] && $_POST['weight']) ) {
				echo "please fill all fields";
			}
			elseif (($_POST['hourcharges'] != 0 || $_POST['kmcharges'] != 0) ) {
				$data = array(
					'name' => $_POST['name'] ,
					'height' => $_POST['height'] ,
					'length' => $_POST['length'],
					'width' => $_POST['width'],
					'weight' => $_POST['weight'],
					'hours_charges' => $_POST['hourcharges'],
					'km_charges' => $_POST['kmcharges'],	
					);
				$file=$_FILES['icon'];
				$name=$file['name'];
				$image='icon';
				$upload_path='public/vechicletypeicon';
				$imagename=$this->file_upload($upload_path,$image,$name);
				$data['icon']=$imagename;
				$result = $this->db->insert('tbl_vechicleType', $data);
				if ($result) {
					$this->session->set_flashdata('msg4', 'Vechicle Added Sucessfully');
					redirect('Dashboard/vechicle_list');
				}
			}
			else{

				$this->session->set_flashdata('msg5', 'Pease enter more then 0 value for KM charges or Hours charges ');
				redirect('Dashboard/vechicle_list');
			}
		}

	}
	/*edit vechicle list*/
	public function editvechiclelist(){
		if (isset($_POST)) {
			if(($_POST['hours_charges'] != 0 || $_POST['km_charges'] != 0) ) {

				$file=$_FILES['icon'];
				$name=$file['name'];
				$image='icon';
				$upload_path='public/vechicletypeicon';
				$imagename=$this->file_upload($upload_path,$image,$name);

				$id=$_POST['submitid'];

				$edge = array('name' => $_POST['name'], 'height' => $_POST['height'],'length' => $_POST['length'],'width' => $_POST['width'],'weight' => $_POST['weight'],'hours_charges' => $_POST['hours_charges'],'km_charges' => $_POST['km_charges'],'icon' => $imagename);
				$plans=array_filter($edge);
				$this->db->where('id', $id);
				$result= $this->db->update('tbl_vechicleType', $plans);
				if ($result) {
					$this->session->set_flashdata('msg2', 'vechicle Updated Sucessfully');
					redirect(base_url()."Dashboard/vechicle_list");
				}
				else {
					$this->session->set_flashdata('msg3', 'Something Went Wrong');
					redirect(base_url()."Dashboard/vechicle_list");
				}

			}
			else {
				$this->session->set_flashdata('msg5', 'Pease enter more then 0 value for KM charges or Hours charges ');
				redirect('Dashboard/vechicle_list');
			}
		}

	}
    /*delete vechicletype*/
	public function deletevechicle(){
		$id=$_POST['id'];
		$table='tbl_vechicleType';
		$result=$this->Admin_model->delete($id,$table);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*delete transaction*/
	public function deletetxn(){
		$id=$_POST['id'];
		$table='tbl_transactions';
		$result=$this->Admin_model->delete($id,$table);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*delete user*/
	public function deleteuser(){
		$id=$_POST['id'];
		$table='tbl_users';
		$result=$this->Admin_model->delete($id,$table);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*make user commercial*/
	public function usercommercial(){
		$id=$_POST['id'];
		$result=$this->Admin_model->usercommercial($id);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*make user commercial*/
	public function usernormal(){
		$id=$_POST['id'];
		$result=$this->Admin_model->usernormal($id);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*promocodes list*/
	public function promocode_list()
	{
		/*edit promo list*/
		if (isset($_POST['editpromo'])) {
			$id=$_POST['edit'];	    
			$edge = array('promo_code' => $_POST['promo'], 'value' => $_POST['value'],'type' => $_POST['type'],'max_usage' => $_POST['maxusage'],'promo_usage' => $_POST['promousage'],'expiry_date' => $_POST['date'],'user_max_usage'=> $_POST['maxusageperuser']);
			$plans=array_filter($edge);
			$this->db->where('id', $id);
			$result= $this->db->update('tbl_promocode', $plans);
			if ($result) {
				$this->session->set_flashdata('msg4', 'Promo Code Updated Sucessfully');
				redirect(base_url()."Dashboard/promocode_list");
			}
			else {
				$this->session->set_flashdata('msg3', 'Something Went Wrong');
				redirect(base_url()."Dashboard/promocode_list");
			}

		}
		/*add new promo in the list*/
		elseif (isset($_POST['addpromo'])) {
			// print_r($_POST);die();
			if (empty($_POST['name']|| $_POST['value'] || $_POST['type'] || $_POST['maxusage'] || $_POST['promo_usage'] ||$_POST['date']  )) {
				$this->session->set_flashdata('msg1', 'Please fill valid fields');
				redirect(base_url()."Dashboard/promo_list");
			}
			$data = array('promo_code' => $_POST['name'], 'type' => $_POST['type'], 'value' => $_POST['value'], 'max_usage' => $_POST['maxusage'], 'promo_usage' => $_POST['promo_usage'], 'user_max_usage' => $_POST['perusermaxusage'], 'expiry_date' => $_POST['date']);	
			$result = $this->db->insert('tbl_promocode', $data);
			if ($result) {
				$this->session->set_flashdata('msg2', 'Promo Code Added Sucessfully');
				redirect(base_url()."Dashboard/promocode_list");
			}
			else {
				$this->session->set_flashdata('msg3', 'Something Went Wrong');
				redirect(base_url()."Dashboard/promocode_list");
			}


		}

		$data['promocode']=$this->Admin_model->promocode_list();
		// $this->template();
		$this->load->view('promocode_list',$data);
	}
	/*add promocodes list*/
	public function addpromocode()
	{
		$this->template();
		$this->load->view('addpromo',$data);

	}
	/*	delete promo code*/
	public function deletepromo(){
		$id=$_POST['id'];
		$table='tbl_promocode';
		$result=$this->Admin_model->delete($id,$table);
		if ($result) {
			echo true;
		}
		else{
			echo false;
		}
	}
	/*common upload function*/
	Public function file_upload($upload_path,$image,$name) {                                  /* File upload function */
		$baseurl = base_url();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5000';
		$config['file_name'] = $name;
		$config['max_width'] = '5024';
		$config['max_height'] = '5068';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($image))
		{
			$error = array(
				'error' => $this->upload->display_errors()
				);
                 // print_r($error);die();
			return $imagename = "";
		}
		else
		{
			$this->upload->data();
			return $imagename = $baseurl . $upload_path .'/'.$name;
		}
	}
	public function addsetting()
	{
		if (isset($_POST['setting'])) {
			$settingid=$_POST['settingid'];

			$edge = array('min_booking_charge' => $_POST['title'],'type' => $_POST['type'],'buffer_time' => $_POST['time'],'promo_amount'=>$_POST['refrralamount'],'loading_time'=>$_POST['loadintime'],'unloading_time'=>$_POST['unloadingtime'],'flight_charges'=>$_POST['flightcharges']);
			$plans=array_filter($edge);
			$this->db->where('id', $settingid);
			$result= $this->db->update('tbl_setting', $plans);
			if($result){
				$this->session->set_flashdata('msg4', 'Data Updated Sucessfully');
				redirect(base_url()."Dashboard/addsetting");
			}
			else {
				$this->session->set_flashdata('msg3', 'Something Went Wrong');
				redirect(base_url()."Dashboard/addsetting");
			}

		}

		$data['setting']=$this->Admin_model->setting_list();
		$this->template();
		$this->load->view('addsetting',$data);
	}
	public function transaction_list(){
		$data['transaction']=$this->Admin_model->transaction_list();
		$this->template();
		$this->load->view('transaction',$data);
	}
	public function wallet_list(){
		$data['wallet_customerlist']=$this->Admin_model->wallet_customerlist();
		$data['wallet_driverlist']=$this->Admin_model->wallet_driverlist();
		$this->template();
		$this->load->view('wallet',$data);
	}
	/*pay to driver from admin panel outstanding amount*/
	public function payamount(){
		if (isset($_POST)) {
				// print_r($_POST);die();

			
			$amount=$_POST['amnt'];
			$id=$_POST['submitid'];
			$newAmt=$_POST['amount'];
			$card=$_POST['cardnumber'];
			$expiry=$_POST['expirydate'];
			


			/*braintree transaction process start*/
			$result = Braintree_Transaction::sale(array(
				'amount' => $amount,
				'creditCard' => array(
					'number' => $card,
					'expirationDate' => $expiry
					)
				));
			$clientToken = Braintree_ClientToken::generate();
			/*braintree transaction process end*/

			if ($result->success) {
				$getdata = $this->Admin_model->select_data('*','tbl_wallet',array('user_id'=>$id));
				$get_amount = $this->Admin_model->select_data('*','tbl_driversFund',array('driver_id'=>$id));
				$oldAmt=$get_amount[0]->outstanding_amount;
				$oldpaid_Amt=$get_amount[0]->paid_amount;
				$old=$getdata[0]->balence;
				$newAmount=$old+$amount;
				$uptDAta = $this->Admin_model->update_data('tbl_wallet',array('balence'=>$newAmount,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$id));
				$newOutStanding_amnt= $oldAmt-$amount;
				$newpaid_amnt=$oldpaid_Amt+$amount;
				$this->Admin_model->update_data('tbl_driversFund',array('outstanding_amount'=>$newOutStanding_amnt,'paid_amount'=>$newpaid_amnt),array('driver_id'=>$id));
				// echo true;


				$this->session->set_flashdata('msg1', 'Amount Paid sucessfully');
				redirect(base_url()."Dashboard/wallet_list");

			}
			else if ($result->transaction) {
				$this->session->set_flashdata('msg2', 'Something Went wrong');
				redirect(base_url()."Dashboard/wallet_list");
				echo false;
			} else {
				$this->session->set_flashdata('msg2', 'Something Went wrong');
				redirect(base_url()."Dashboard/wallet_list");
				echo false;
			}
			
		}
	}	
	
	public function push_notification(){
		if (!empty($_POST['message'])) {
			$email=$_POST['email'];
			if (($_POST['fooby']==1 || $_POST['fooby']==2)) {
				$type=$_POST['fooby'];
				$this->db->select('*');
				$this->db->from('tbl_users');
				$this->db->join('tbl_login', 'tbl_login.user_id = tbl_users.id');
				$this->db->where('tbl_login.status', 1);
				$this->db->where('tbl_users.user_Type', $type);
				$data = $this->db->get()->result();
			}elseif(!empty($email)){
				$this->db->select('*');
				$this->db->from('tbl_users');
				$this->db->join('tbl_login', 'tbl_login.user_id = tbl_users.id');
				$this->db->where('tbl_login.status', 1);
				$this->db->where('tbl_users.email',$email);
				$data = $this->db->get()->result();
			//	echo"<pre>";print_r($data);die;
			}
			else{
				$this->db->select('*');
				$this->db->from('tbl_users');
				$this->db->join('tbl_login', 'tbl_login.user_id = tbl_users.id');
				$this->db->where('tbl_login.status', 1);
				$data = $this->db->get()->result();
			}
			foreach ($data as $key => $value) {
				$pushData['msg']=$_POST['message'];
				$pushData['token_id']=$value->token_id;	
				if ($value->device_id==0) {
					if ($value->user_Type==1) {
						$pushData['Utype']=1;
						$push=$this->androidPush($pushData);
					}
					else{
						$pushData['Utype']=2;
						$push=$this->androidPush($pushData);
					}
				}
				else{
					if ($value->user_Type==1) {
						$pushData['Utype']=1;
						$push=$this->iosPush($pushData);
					}
					else{
						$pushData['Utype']=2;
						$push=$this->iosPush($pushData);
					}

				}
			}
			if ($data) {
				$this->session->set_flashdata('msg1', 'Broadcast message has been sent sucessfully');
				redirect(base_url()."Dashboard/push_notification");
			}
			else{
				$this->session->set_flashdata('msg2', 'Something Went wrong');
				redirect(base_url()."Dashboard/push_notification");
			}
		}
		$this->template();
		$this->load->view('push');
	}
	public function androidPush($pushData=null){


		$mytime = date("Y-m-d H:i:s");
	    $api_key = "AAAAhyf2Jug:APA91bHP9_oA8arOG3aUVBAt9tqjaGUvr3Od4G7XZAFxsvfMCyVf31YB21f0cy_dwz-vFuGp9a1jV8rfMEQty8OQo5we71epg2v9m-QtS9jvNz_fMUO2vz1_6qE1gtuV17e8Ouir_wMV"; 
	 $fcm_url = 'https://fcm.googleapis.com/fcm/send';
	 $fields = array(
	 	'registration_ids' => array(
	 		$pushData['token_id']
	 		) ,
	 	'data' => array(
	 		"message" =>$pushData['msg'] ,
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
	 curl_close($curl_handle);
	}

	public function iosPush($pushData=null) {
		$deviceToken = $pushData['token_id'];
		$passphrase = '';
		$ctx = stream_context_create();
		if($pushData['Utype'] == 1){
			stream_context_set_option($ctx, 'ssl', 'local_cert', './certs/MoversPushDevelpoment.p12');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		}else if($pushData['Utype'] == 2){

			stream_context_set_option($ctx, 'ssl', 'local_cert', './certs/MoversPushDevelpoment.p12');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		}
    // Open a connection to the APNS server
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
		$body['aps'] = array(
			"message" =>$pushData['msg'] ,
			'sound' => 'default'
			);

	}
	public function assign(){
		


			$list = $this->Admin_model->freeServiceProviders($minTime,$maxTime);
		if (!empty($list)) {
			$arr = '';
			foreach ($list as $key => $value) {
				// print_r($value);
				$arr .= "<option value=$value->id> #$value->id | $value->email | $value->fname $value->lname </option>";
			}
			$a = '<div class="form-group">
			<label for="selectbox">Assign Service Provider</label>
			<select class="form-control" id="serviceProvider" name = "serviceProvider">
			<option disabled>Select Service Provider</option>'.$arr.'
			</select>
			<input type="hidden" name="reqid" value="'.$_POST["reqid"].'">
			<input type="hidden" name="userId" value="'.$_POST["userId"].'">
			</div><button type="submit" name = "assignServiceProvider" value="1" class="btn btn-default">Submit</button>';
			echo json_encode($a);
		} else {
			echo json_encode("No Service Provider Available");
		}
	}



	public function abcd(){


			$filename="abc";

            $result  = $this->db->get('tbl_driversFund')->result();
			//header info for browser
			// header("content-type:application/csv;charset=UTF-16-LE");
			header("Content-Type: application/charset=UTF-16-LE;vnd.openxmlformats-officedocument.spreadsheetml.sheet.csv.xls.xlsx");    
			header("Content-Disposition: attachment; filename='$filename.xls");  
			header("Pragma: no-cache"); 
			header("Expires: 0");
			/*******Start of Formatting for Excel*******/   
			//define separator (defines columns in excel & tabs in word)
			$sep = "\t"; //tabbed character
			//start of printing column names as names of MySQL fields
			foreach($result[0] as $key => $value){


			echo $key. "\t";
			}
			print("\n");  

			//end of printing column names  
			//start while loop to get data
	
			foreach($result as $key2 => $row)
			{
			// $result[$key2]->Skills=str_replace(",", "|", $result[$key2]->Skills);
			// $result[$key2]->Causes=str_replace(",", "|", $result[$key2]->Causes);
			// $result[$key2]->Location=str_replace(",", "|", $result[$key2]->Location);
			// $result[$key2]->Vallenteers_Email_Addresses=str_replace(",", "|", $result[$key2]->Vallenteers_Email_Addresses);
			$schema_insert = "";
			foreach($row as $key => $value)
			{
			//print_r($value);

			if(!isset($value))
			$schema_insert .= "0".$sep;
			elseif ($value != "")
			$schema_insert .= "$value".$sep;
			else
			$schema_insert .= " ".$sep;
			}

			print(trim($schema_insert));
			print "\n";
			}
		
     }


    




	public function uploadCsv(){
	
		$this->excel = new PHPExcel(); 


$file_info = pathinfo($_FILES["result_file"]["name"]);
$file_directory = "public/vechicletypeicon";
$new_file_name = date("d-m-Y ") . rand(000000, 999999) .".". $file_info["extension"];

if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
{   
    $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
    $objReader	= PHPExcel_IOFactory::createReader($file_type);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
   // $sheet_data= $objPHPExcel->getActiveSheet()->fromArray($sheet, null, 'A1');
    $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    // print_r($sheet_data);
    // die;
    // $sheet_data= $objPHPExcel->setActiveSheetIndex(0)->rangeToArray('A1:A15');

   // $worksheet = $objPHPExcel->getActiveSheet();

// $k=1;

foreach($sheet_data as $row ) {
	// print_r($row);

	 $nick_name = $row[A];
          $first_name = $row[B];
          $last_name = $row[C];


          // print_r($nick_name);
          // print_r($first_name);
          // print_r($last_name);


  
        $result = array(
                'driver_id' => $nick_name,
                'outstanding_amount' => $first_name,
                'paid_amount'=>$last_name
        );

        // print_r($result);
        $this->db->insert('tbl_driversFund',$result);


}
die;


  // $sheet_data=  $objPHPExcel->setActiveSheetIndex(0)->rangeToArray('A1:A15');

  // $arrayCount = count($sheet_data);  // Here get total count of row in that Excel sheet

  //   for( $i=2; $i<=$arrayCount; $i++ )
  //   {
  //   	print_r($arrayCount);die;
  //       $value1 = trim($sheet_data[$i]["A"]);       
  //       var_dump($value1);
  //   }
  //   die;


  print_r($sheet_data);die;



    foreach($sheet_data as $data)
    {
    	// $abcdef=$data[A];
    	print_r($data);

    	// print_r($value);
    	// foreach ($data[A] as $key => $value) {
        // print_r($abc);
        // $add=	explode(" ",$abc[0]);

        // print_r($add[0]);
        // print_r($add[1]);
        // print_r($add[2]);



          $nick_name = $add[0];
          $first_name = $add[1];
          $last_name = $add[2];


          // print_r($nick_name);
          // print_r($first_name);
          // print_r($last_name);


  
        $result = array(
                'driver_id' => $nick_name,
                'outstanding_amount' => $first_name,
                'paid_amount'=>$last_name
        );

        // print_r($result);
        // $this->db->insert('tbl_driversFund',$result);
	}
	die;

}
}

public function pdfedit(){

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("contractFinalTrans.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);
//set position in pdf document
// now write some text above the imported page
//$pdf->SetFont('Arial');
$pdf->SetFontSize(10);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(50, 50);
$pdf->Write(0, "page 1");///print this output
$pdf->SetAutoPageBreak(true,22);
$pdf->addPage();
$tplIdx = $pdf->importPage(2);
//$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);
//set position in pdf document
// now write some text above the imported page
//$pdf->SetFont('Arial');
$pdf->SetFontSize(10);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(100 , 100);
$pdf->Write(0, "page 2");
$pdf->Output(); 

}

public function abc(){
		// $this->template();
		$this->load->view('abc.php');
}

public function ajax(){

	// print_r($_FILES);die;

			$file=$_FILES['file'];
				$name=$file['name'];
				$image='file';
				$upload_path='public/vechicletypeicon';
				$imagename=$this->file_upload($upload_path,$image,$name);
				print_r($imagename);die;




}

public function down(){
	$param = $_REQUEST;


	// print_r($param);die;
	
$oAuthToken = $param['oAuthToken'];
$fileId = $param['fileId'];
$getUrl = 'https://www.googleapis.com/drive/v2/files/' . $fileId . '?alt=media';
$authHeader = 'Authorization: Bearer ' . $oAuthToken;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $getUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$data = curl_exec($ch);






                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL,"http://52.27.59.10:3001/api/places/".$id);
                //  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                // curl_setopt($ch, CURLOPT_POSTFIELDS,$aa);  //Post Fields
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
                // curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeader);
                // $server_output = curl_exec ($ch);
                // curl_close ($ch);
                // $server_output=json_decode($server_output);




// print_r($data);die;
$name=trim($param['name']);

// file_put_contents($param['name'], $data);
// $filestring =(file_get_contents($data));
file_put_contents('public/vechicletypeicon/'.$name, $data);
die;
}

public function abcf($offset=0){

  
  // $config['total_rows'] = $this->Admin_model->totalMovies();
  
  // $config['base_url'] = base_url()."Dashboard/abcf";
  // $config['per_page'] = 5;
  // $config['uri_segment'] = '2';

  // $config['full_tag_open'] = '<div class="pagination"><ul>';
  // $config['full_tag_close'] = '</ul></div>';

  // $config['first_link'] = '« First';
  // $config['first_tag_open'] = '<li class="prev page">';
  // $config['first_tag_close'] = '</li>';

  // $config['last_link'] = 'Last »';
  // $config['last_tag_open'] = '<li class="next page">';
  // $config['last_tag_close'] = '</li>';

  // $config['next_link'] = 'Next →';
  // $config['next_tag_open'] = '<li class="next page">';
  // $config['next_tag_close'] = '</li>';

  // $config['prev_link'] = '← Previous';
  // $config['prev_tag_open'] = '<li class="prev page">';
  // $config['prev_tag_close'] = '</li>';

  // $config['cur_tag_open'] = '<li class="active"><a href="">';
  // $config['cur_tag_close'] = '</a></li>';

  // $config['num_tag_open'] = '<li class="page">';
  // $config['num_tag_close'] = '</li>';


  // $this->pagination->initialize($config);
  //  $data["links"] = $this->pagination->create_links();
   

  // $query = $this->Admin_model->getMovies(5,$this->uri->segment(2));
  
  // // $data['MOVIES'] = null;
  
  // if($query){
  //  $data['MOVIES'] =  $query;
  // }

      $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Admin_model->
            fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

  $this->load->view('movelist', $data);
        // $this->load->view("example1", $data);



 
}

 public function example1() {
        $config = array();
        $config["base_url"] = base_url() . "Dashboard/example1";
        $config["total_rows"] = $this->Admin_model->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Admin_model->
            fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view("example", $data);
    }
    public function test(){
    	echo "fdsflkjdsflk;";
    }




}


