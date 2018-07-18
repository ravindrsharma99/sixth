<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
// require (APPPATH . 'libraries/paypal-php-sdk/lib/paypal/rest-api-sdk-php/sample/bootstrap.php');
require (APPPATH .'libraries/autoload.php');
require(APPPATH.'/libraries/stripe.php');
//require APPPATH. '/libraries/Twilio.php';
require APPPATH. '/libraries/Twilio/autoload.php';
// use PayPal\Api\ItemList;
use PayPal\Api\Payment;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\PaymentExecution;
//       use PayPal\Api\Amount;
// use PayPal\Api\Details;
// use PayPal\Api\Item;
use PayPal\Api\Payer;
// // use PayPal\Api\ItemList;
// // use PayPal\Api\Payment;
// // use PayPal\Api\RedirectUrls;
// use PayPal\Api\Transaction;

/**
* This is an example of a few basic user interaction methods you could use
* all done with a hardcoded array
*
* @package         CodeIgniter
* @subpackage      Rest Server
* @category        Controller
* @author          Phil Sturgeon, Chris Kacerguis
* @license         MIT
* @link            https://github.com/chriskacerguis/codeigniter-restserver
*/
class User extends REST_Controller {

	function __construct()
	{
     // Construct the parent class
    parent::__construct();
    $this->load->database();
    $this->load->model('User_model');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->library('twilio');
      $this->config->load('paypal');
              $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
    $config = Array(

      'protocol' => 'sendmail',
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'wordwrap' => TRUE

      );
    Stripe\Stripe::setApiKey("sk_test_Lg9DUblnqYKJTdzU9YSAUS0n");

// $this->load->library('email', $config);
 // Configure limits on our controller methods
 // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
   $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
   $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
   $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
 }


 public function signup_post(){
  $data = array(
    'fname'=>$this->input->post('fname'),
    'lname'=>$this->input->post('lname'),
    'email'=>$this->input->post('email'),
    'password'=>md5($this->input->post('password')),
    'country_code'=>$this->input->post('country_code'),
    'phone'=>$this->input->post('phone'),
    'fb_id'=>$this->input->post('fb_id'),
    'google_id'=>$this->input->post('google_id'),
    'company_name'=>$this->input->post('company_name'),
    'date_created' =>date('Y-m-d H:i:s')
    );
  $loginParams =  array(
    'device_id'=>$this->input->post('device_id'),
    'unique_deviceId '=>$this->input->post('unique_deviceId'),
    'token_id'=>$this->input->post('token_id'),
    'date_created'=>date('Y-m-d H:i:s')
    );

  /*profile pic of user start*/

  $image='profile_pic';
  $upload_path='public/profile_pic';
  $imagename=$this->file_upload($upload_path,$image);
  $data['profile_pic']=$imagename;



        // $upload_path = "Public/img/app";
        // $image = 'profile_picFile';
        // $finalImage = $this->file_upload($upload_path, $image);
        // $myarray['profile_pic'] = $finalImage;



  /*profile pic of user end*/
  /*generation of refer code start*/
  $refercode="M".mt_rand(1000,9000).mb_substr($data['fname'], 0, 2).rand(5000,9000);
  /*generation of refer code end*/
  $type=$this->input->post('type');
  $user_refercode=$this->input->post('refercode');
  /*if user simply signup start*/
  if (empty($user_refercode)) {
    $signUpData=$this->User_model->sign_up($data,$loginParams,$type,$refercode,$user_refercode="");
  }
  /*if user simply signup end*/
  /*if user uses refer code on signup*/
  else{
   $getRes = $this->User_model->select_data('*','tbl_users',array('refercode'=>$user_refercode));
   if (!empty($getRes)) {
    $signUpData=$this->User_model->sign_up($data,$loginParams,$type,$refercode,$user_refercode);
    if (!empty($signUpData) && $signUpData != 0){
      $user=$signUpData[0]->id;
      $curr_refAmount = $this->User_model->select_data('*','tbl_setting');
      $amount = $curr_refAmount[0]->promo_amount;
      $data=array('balence'=>$amount,'user_id'=>$user,'date_created'=>date('Y-m-d H:i:s'));
                      // $addBal = $this->User_model->insert_data('tbl_wallet',array('balence'=>$amount,'user_id'=>$user,'date_created'=>date('Y-m-d H:i:s')));
      $var= $this->User_model->update_data('tbl_wallet',$data,array('user_id'=>$user));
      $addtransArray = array(
        'amount_credited'=>$amount,
        'user_id'=>$user,
        'txn_id'=>'fromReferrel',
        'type'=>"from referal",
        'date_created'=>date('Y-m-d H:i:s')
        );
      $addtrans = $this->User_model->insert_data('tbl_transactions',$addtransArray);
    }
  }
  else{

   $result = array(
     "controller" => "User",
     "action" => "signup",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Wrong Referrel Code ",
     );
   print_r(json_encode($result));
   die;
              //    $this->set_response($result,REST_Controller::HTTP_OK);
              //   return ;
 }
}



if (!empty($signUpData) && $signUpData != 0){
 $result = array(
   "controller" => "User",
   "action" => "signup",
   "ResponseCode" => true,
   "MessageWhatHappen" =>"sucessfully registered",
   "signUpResponse" => $signUpData
   );
}
else if($signUpData == 0){
 $result = array(
   "controller" => "User",
   "action" => "signup",
   "ResponseCode" => false,
   "MessageWhatHappen" => "User Already Exists",
   );
}

else {
 $result = array(
   "controller" => "User",
   "action" => "signup",
   "ResponseCode" => false,
   "MessageWhatHappen" => "Something went wrong",
   );
}
print_r(json_encode($result));
die;
       // $this->set_response($result,REST_Controller::HTTP_OK);
}
public function login_post(){
  $data = array(
    'phone'=>$this->input->post('phone'),
    'email'=>$this->input->post('email'),
    'password'=>md5($this->input->post('password')),
    'fb_id'=>$this->input->post('fb_id'),
    'google_id'=>$this->input->post('google_id'),
    'date_created' =>date('Y-m-d H:i:s')
    );
  $user_type= $this->input->post('user_type');
  $loginParams =  array(
    'device_id'=>$this->input->post('device_id'),
    'unique_deviceId '=>$this->input->post('unique_deviceId'),
    'token_id'=>$this->input->post('token_id'),
    'date_created' =>date('Y-m-d H:i:s')

    );
  /*login type 1,2 and 3 for mannual,fb and google*/
  $type = $this->input->post('type');
  $var = $this->User_model->login($data,$loginParams,$type,$user_type);

  if(!empty($var) && $var != 1 && $var != 0){
   $result = array(
     "controller" => "User",
     "action" => "login",
     "ResponseCode" => true,
     "MessageWhatHappen" => "Sucessfully Login",
     "loginResponse" => $var
     );
 }
 elseif ($var == 1) {
   $result = array(
     "controller" => "User",
     "action" => "login",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Wrong App"
     );
 }
 elseif($var== 0){
   $result = array(
     "controller" => "User",
     "action" => "login",
     "ResponseCode" => false,
     "MessageWhatHappen" => "User does not exist "
     );
 }
 elseif($var== 4){
   $result = array(
     "controller" => "User",
     "action" => "login",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Mover can not login in user app"
     );
 }
 $this->set_response($result, REST_Controller::HTTP_OK);
}
public function logout_post(){
 $user_id=$this->input->post('user_id');
 $unique_deviceId=$this->input->post('unique_deviceId');
 $log_out= $this->User_model->log_out($unique_deviceId,$user_id);
 if (!empty($log_out) && $log_out != 0){
   $result = array(
     "controller" => "User",
     "action" => "logout",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"sucessfully logged out",
     "logoutResponse" => $log_out
     );
 }
 else if($log_out == 0){
   $result = array(
     "controller" => "User",
     "action" => "logout",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Something went wrong"
     );
 }
 $this->set_response($result, REST_Controller::HTTP_OK);
}
public function getprofile_post(){
  $id= $this->input->post('user_id');
  $data=$this->User_model->getone($id);

  if ($data){
    $result = array(
      "controller" => "User",
      "action" => "getprofile",
      "ResponseCode" => true,
      "MessageWhatHappen" =>"your data shows sucessfully",
      "Response" => $data
      );
  }
  else {
    $result = array(
      "controller" => "User",
      "action" => "getprofile",
      "ResponseCode" => false,
      "MessageWhatHappen" =>"Something went wrong",
      );
  }
  $this->set_response($result,REST_Controller::HTTP_OK);
}
       // public function driverSignup_post(){
       //      $data = array(
       //      'fname'=>$this->input->post('fname'),
       //      'lname'=>$this->input->post('lname'),
       //      'email'=>$this->input->post('email'),
       //      'password'=>md5($this->input->post('password')),
       //      'phone'=>$this->input->post('phone'),
       //      'fb_id'=>$this->input->post('fb_id'),
       //      'google_id'=>$this->input->post('google_id'),
       //      'date_created' =>date('Y-m-d H:i:s')
       //      );

       //      $loginParams =  array(
       //      'device_id'=>$this->input->post('device_id'),
       //      'unique_deviceId '=>$this->input->post('unique_deviceId'),
       //      'token_id'=>md5($this->input->post('token_id')),
       //      'date_created'=>date('Y-m-d H:i:s')
       //      );
       //      $driverdetail =  array(
       //      'license_no'=>$this->input->post('license_no'),
       //      'rc_no '=>$this->input->post('rc_no'),
       //      'insurance_no'=>$this->input->post('insurance_no'),
       //      'vehicle_no '=>$this->input->post('vehicle_no'),
       //      );
       //      $file=$_FILES['license_image'];
       //      $name=$file['name'];
       //      $image='license_image';
       //      $upload_path='public/driverdetail/license_image';
       //      $imagename=$this->file_upload($upload_path,$image,$name);
       //      // print_r($imagename);die();
       //      $driverdetail['license_image']=$imagename;


       //      $file=$_FILES['rc_image'];
       //      $name=$file['name'];
       //      $image='rc_image';
       //      $upload_path='public/driverdetail/rc_image';
       //      $imagename=$this->file_upload($upload_path,$image,$name);
       //      $driverdetail['rc_image']=$imagename;



       //      $file=$_FILES['insurance_image'];
       //      $name=$file['name'];
       //      $image='insurance_image';
       //      $upload_path='public/driverdetail/insurance_image';
       //      $imagename=$this->file_upload($upload_path,$image);
       //      // $imagename=$this->file_upload($upload_path,$image,$name);
       //      $driverdetail['insurance_image']=$imagename;


       //      $file=$_FILES['driver_image'];
       //      $name=$file['name'];
       //      $image='driver_image';
       //      $upload_path='public/driverdetail/driver_image';
       //      // $imagename=$this->file_upload($upload_path,$image,$name);
       //      $imagename=$this->file_upload($upload_path,$image);
       //      $driverdetail['driver_image']=$imagename;

       //      $refercode="M".mt_rand(1000,9000).mb_substr($data['fname'], 0, 2).rand(5000,9000);
       //      // print_r($refercode);die();
       //      $type=$this->input->post('type');

       //      // $user_type=$this->input->post('user_type');

       //      $signUpData=$this->User_model->driversign_up($data,$loginParams,$type,$refercode,$driverdetail);
       //      // print_r($signUpData);die();

       //      if (!empty($signUpData) && $signUpData != 0){
       //           $result = array(
       //           "controller" => "User",
       //           "action" => "driverSignup",
       //           "ResponseCode" => true,
       //           "MessageWhatHappen" =>"sucessfully registered",
       //           "signUpResponse" => $signUpData
       //           );
       //      }
       //      else if($signUpData == 0){
       //           $result = array(
       //           "controller" => "User",
       //           "action" => "driverSignup",
       //           "ResponseCode" => false,
       //           "MessageWhatHappen" => "Driver Already Exists",
       //           );
       //      }else {
       //           $result = array(
       //           "controller" => "User",
       //           "action" => "driverSignup",
       //           "ResponseCode" => false,
       //           "MessageWhatHappen" => "Something went wrong",
       //           );
       //      }

       // $this->set_response($result,REST_Controller::HTTP_OK);
       // }


public function updateprofile_post(){
  $arra = array(
    'id'=>$this->input->post('id'),
    'fname'=>$this->input->post('fname'),
    'lname'=>$this->input->post('lname'),
    'company_name'=>$this->input->post('company_name'),
    'country_code'=>$this->input->post('country_code'),
    'phone'=>$this->input->post('phone'),
    );


  /*updation of profile pic start*/
  $image='profile_pic';
  $upload_path='public/profile_pic';
  $imagename=$this->file_upload($upload_path,$image);
  $arra['profile_pic']=$imagename;
  /*updation of profile pic end*/

  $data=array_filter($arra);


  $new_password=($this->input->post('newpassword'));
  $old_password=($this->input->post('oldpassword'));
  /*in case user want to update password start*/
  if(!empty($new_password) && !empty($old_password)){
    $passwordchk = $this->User_model->select_data('*','tbl_users',array('id'=>$data['id'],'password'=>md5($old_password)));
    /*checking of old password start*/
    if($passwordchk){
      $data['password']=md5($new_password);
      $var= $this->User_model->update_data('tbl_users',$data,array('id'=>$data['id']));
      $getRes = $this->User_model->select_data('*','tbl_users',array('id'=>$data['id']));
      $result = array(
        "controller" => "User",
        "action" => "updateprofile",
        "ResponseCode" => true,
        "MessageWhatHappen" =>"Your data updated sucessfully",
        "response"=>$getRes
        );
    }else {
     $result = array(
      "controller" => "User",
      "action" => "updateprofile",
      "ResponseCode" => false,
      "MessageWhatHappen" =>"oldpassword doesnot match"
      );
   }
 }
 /*checking of old password end*/


 /*in case user want to update password end*/



 /*in case user want to update information except password start*/
 elseif(empty($new_password && $old_password)){
   $passwordchk = $this->User_model->select_data('*','tbl_users',array('id'=>$data['id']));
   if($passwordchk){
    $var= $this->User_model->update_data('tbl_users',$data,array('id'=>$data['id']));
    $getRes = $this->User_model->select_data('*','tbl_users',array('id'=>$data['id']));
    $result = array(
      "controller" => "User",
      "action" => "updateprofile",
      "ResponseCode" => true,
      "MessageWhatHappen" =>"Your data updated sucessfully",
      "response"=>$getRes
      );
  }else {
   $result = array(
    "controller" => "User",
    "action" => "updateprofile",
    "ResponseCode" => false,
    "MessageWhatHappen" =>"Something went wrong"
    );
 }
}
/*in case user want to update information except password end*/
else{
 $result = array(
  "controller" => "User",
  "action" => "updateprofile",
  "ResponseCode" => false,
  "MessageWhatHappen" =>"Something went wrong",

  );

}
$this->set_response($result,REST_Controller::HTTP_OK);

}

public function getvechicle_get(){
  $data=$this->User_model->getallvechicle();
  if ($data){
   $result = array(
     "controller" => "User",
     "action" => "getvechicle",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"your data shows sucessfully",
     "Response" => $data
     );
 }else {
   $result = array(
     "controller" => "User",
     "action" => "getvechicle",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"No data exist in Table",
     );
 }
 $this->set_response($result,REST_Controller::HTTP_OK);
}
public function getmove_get(){

  $data['movedata']=$this->User_model->getallmove();
  $data['settingdata']=$this->User_model->select_data('loading_time,unloading_time','tbl_setting');

  if ($data){
   $result = array(
     "controller" => "User",
     "action" => "getmove",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"your data shows sucessfully",
     "Response" => $data
     );
 }
 else {
   $result = array(
     "controller" => "User",
     "action" => "getmove",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"No data exist in Table",
     );
 }
 $this->set_response($result,REST_Controller::HTTP_OK);
}
/*common file upload function */
       // Public function file_upload($upload_path,$image,$name){
       //   $baseurl = base_url();
       //   $config['upload_path'] = $upload_path;
       //   $config['allowed_types'] = 'gif|jpg|png|jpeg';
       //   $config['max_size'] = '5000';
       //   $config['file_name'] = $name;
       //   $config['max_width'] = '5024';
       //   $config['max_height'] = '5068';
       //   $this->load->library('upload', $config);
       //   $this->upload->initialize($config);
       //        if (!$this->upload->do_upload($image))
       //        {
       //             $error = array(
       //             'error' => $this->upload->display_errors()
       //             );
       //             return $imagename = "";
       //        }
       //        else
       //        {
       //             $this->upload->data();
       //             return $imagename = $baseurl . $upload_path .'/'.$name;
       //        }
       // }


       // public function sendotp_post()
       // {
       //      $this->load->library('twilio');
       //      $phone= $this->input->post('phone');
       //      $selectNumber=$this->User_model->select_data('phone','tbl_otp',array('phone'=>$phone));
       //      $otpGenerate = mt_rand(0,90000);
       //      $msg="This is your otp for registration".$otpGenerate;
       //      if (empty($selectNumber)) {

       //           $array=array('phone'=>$this->input->post('phone'),
       //           'otp'=>$otpGenerate
       //           );
       //           $admin=$this->User_model->twillio($phone,$msg);
       //                if ($admin==1) {

       //                     $name=$this->db->insert('tbl_otp',$array);
       //                     $otpId=$this->db->insert_id();
       //                     $insertdata=$this->User_model->select_data('*','tbl_otp',array('id'=>$otpId));
       //                     if ($insertdata){
       //                          $result = array(
       //                          "controller" => "User",
       //                          "action" => "sendotp",
       //                          "ResponseCode" => true,
       //                          "MessageWhatHappen" =>"your otp send sucessfully",
       //                          "Response" => $insertdata
       //                          );
       //                     }
       //                     else {
       //                          $result = array(
       //                          "controller" => "User",
       //                          "action" => "sendotp",
       //                          "ResponseCode" => false,
       //                          "MessageWhatHappen" =>"Something Went Wrong",
       //                          );
       //                     }

       //                }
       //                else{
       //                     $result = array(
       //                     "controller" => "User",
       //                     "action" => "sendotp",
       //                     "ResponseCode" => false,
       //                     "MessageWhatHappen" =>"Something Went Wrong",
       //                     );

       //                }
       //      }

       //      else{
       //           $existnumber=$this->User_model->twillio($phone,$msg);
       //           // print_r($existnumber);die();
       //           if ($existnumber==1) {

       //                $arra12=$this->User_model->update_data('tbl_otp',array('otp'=>$otpGenerate,'date_modified'=>date('Y:m:d H:i:S')),array('phone'=>$phone));
       //                $updateddata=$this->User_model->select_data('*','tbl_otp',array('phone'=>$phone));
       //                if ($updateddata){
       //                     $result = array(
       //                     "controller" => "User",
       //                     "action" => "sendotp",
       //                     "ResponseCode" => true,
       //                     "MessageWhatHappen" =>"your otp send sucessfully",
       //                     "Response" => $updateddata
       //                     );
       //                }
       //                else{
       //                     $result = array(
       //                     "controller" => "User",
       //                     "action" => "sendotp",
       //                     "ResponseCode" => false,
       //                     "MessageWhatHappen" =>"Something Went Wrong",
       //                     );
       //                }
       //           }
       //           else{
       //                $result = array(
       //                "controller" => "User",
       //                "action" => "sendotp",
       //                "ResponseCode" => false,
       //                "MessageWhatHappen" =>"Something Went Wrong",
       //                );
       //           }
       //      }
       //      $this->set_response($result,REST_Controller::HTTP_OK);
       // }
       // public function findotp_get(){
       //      $phone= $this->input->get('phone');
       //      $phone= str_replace("+","",$phone);
       //      $phone= "+".trim($phone);
       //      // print_r($phone);die();
       //      $data=$this->User_model->select_data('phone,otp','tbl_otp',array('phone'=>$phone));
       //           if ($data){
       //                $result =  $data;
       //           }
       //           else {
       //                $result = array(
       //                "MessageWhatHappen" =>"Something went wrong",
       //                );
       //           }
       //      $this->set_response($result,REST_Controller::HTTP_OK);
       // }
public function bookmove_post(){
  $data = array(
   'user_id'=>$this->input->post('user_id'),
   'vehicle_id'=>$this->input->post('vehicle_id'),
   'moveType_id'=>$this->input->post('move_id'),
   'receipt_number'=>$this->input->post('receipt_number'),
   'pickup_loc'=>$this->input->post('pickup_loc'),
   'destination_loc'=>$this->input->post('destination_loc'),
   'booking_date'=>$this->input->post('booking_date'),
   'booking_time'=>$this->input->post('booking_time'),
   'estimated_price'=>$this->input->post('estimated_price'),
   'pickup_latitude'=>$this->input->post('pickup_latitude'),
   'pickup_longitude'=>$this->input->post('pickup_longitude'),
   'destination_latitude'=>$this->input->post('destination_latitude'),
   'destination_longitude'=>$this->input->post('destination_longitude'),
   'time_duration'=>$this->input->post('time_duration'),
   'distance'=>$this->input->post('distance'),
   'path_polyline'=>$this->input->post('path_polyline'),
   'pickup_level'=>$this->input->post('pickup_level'),
   'destination_level'=>$this->input->post('destination_level'),
   'pickup_movers'=>$this->input->post('pickup_movers'),
   'destination_movers'=>$this->input->post('destination_movers'),
   'description'=>$this->input->post('description'),

   'distance_fare'=>$this->input->post('distance_fare'),
   'hourly_fare'=>$this->input->post('hourly_fare'),
   'flight_fare'=>$this->input->post('flight_fare'),
   'loading_fare'=>$this->input->post('loading_fare'),
   'unloading_fare'=>$this->input->post('unloading_fare'),
   );



  /*item images start*/
  if (isset($_FILES['item_image1'])) {

    $image='item_image1';
    $upload_path='public/item_image';
    $imagename1 = $this->file_upload($upload_path,$image);
    $item1=$imagename1;
  }

  if (isset($_FILES['item_image2'])) {

    $image='item_image2';
    $upload_path='public/item_image';
    $imagename2=$this->file_upload($upload_path,$image);
        // $imagename=$this->file_upload($upload_path,$image,$name);
    $item2=$imagename2;
  }


  if (isset($_FILES['item_image3'])) {
    $image='item_image3';
    $upload_path='public/item_image';
    $imagename3=$this->file_upload($upload_path,$image);
    $item3=$imagename3;
  }


  if (isset($_FILES['item_image4'])) {
    $image='item_image4';
    $upload_path='public/item_image';
    $imagename4=$this->file_upload($upload_path,$image);
    $item4=$imagename4;
  }
  /*item images end*/

         // foreach($_POST['check'] as $check){          move_uploaded_file($_FILES['doc']['tmp_name'], $target_path);     chmod($target_path,0777);              copy($target_path, $target_path_2);     copy($target_path, $target_path_3);     }



  /*item images serilize start*/
  $seru=array($item1,$item2,$item3,$item4);
  $data['item_image']=serialize($seru);
  /*item images serialize end*/

  /*receipt image start*/
  if (isset($_FILES['receipt_image'])) {
    $image='receipt_image';
    $upload_path='public/receipt_image';
    $imagename=$this->file_upload($upload_path,$image);
    $data['receipt_image']=$imagename;
  }
  /*receipt image end*/

  /*get minimum booking charges from total price start */
  $minBookingCharge = $this->User_model->select_data('min_booking_charge','tbl_setting');
  $getbookingcharge = $minBookingCharge[0]->min_booking_charge;
  $amountdeduct = ($getbookingcharge / 100) * $data['estimated_price'];
  $deductprice=round($amountdeduct);
  /*get minimum booking charges from total price end*/

  $getBalance = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$data['user_id']));
  if(!empty($getBalance)){
    /*if user balence more then deduct balence start*/
    if($getBalance[0]->balence >= $amountdeduct){
      $Amount = ($getBalance[0]->balence - $amountdeduct);
      $newAmount=round($Amount);


      $uptDAta = $this->User_model->update_data('tbl_wallet',array('balence'=>$newAmount,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$data['user_id']));
      $transArray = array(
        'amount_debited'=>$deductprice,
        'user_id'=>$data['user_id'],
        'txn_id'=>'from_wallet',
        'type'=>'initial amount for booking',
        'date_created'=>date('Y-m-d H:i:s')
        );
      $transResponse = $this->User_model->insert_data('tbl_transactions',$transArray);
      $insertdata = $this->User_model->insert_data('tbl_booking',$data);
      $bookingdata=array('booking_id'=>$insertdata,'status'=>0);
      $inserthistorydata = $this->User_model->insert_data('tbl_moveHistory',$bookingdata);


      /*push code start*/
      $pushData['message'] = "You have recieved a request for new task";
      $pushData['action'] = "new move";
      $pushData['booking_id'] = $insertdata;
      $selectlogin=$this->User_model->bookmove($data);
      foreach ($selectlogin as  $loginUsers => $value) {
        $pushData['token'] = $value->token_id;
        if($loginUsers->device_id == 1){
         $this->User_model->iosPush($pushData);
       }else if($loginUsers->device_id == 0){
         $this->User_model->androidPush($pushData);
       }
     }
     /*push code end*/


     if(empty($insertdata)){
       $result = array(
         "controller" => "User",
         "action" => "bookmove",
         "ResponseCode" => false,
         "MessageWhatHappen" => "Something went wrong"
         );
     }else{
       $result = array(
         "controller" => "User",
         "action" => "bookmove",
         "ResponseCode" => true,
         "MessageWhatHappen" => "Booked successfully",
         "Move_id"=>$insertdata
         );
     }
   }
   /*if user balence more then deduct balence end*/
   else{
    $result = array(
      "controller" => "User",
      "action" => "bookmove",
      "ResponseCode" => false,
      "MessageWhatHappen" => "Insufficient balance",
      "bookedPercentage" => $getbookingcharge
      );
  }
}
else{
  $result = array(
    "controller" => "User",
    "action" => "bookmove",
    "ResponseCode" => false,
    "MessageWhatHappen" => "Insufficient balance",
    "bookedPercentage" => $getbookingcharge
    );
}
$this->set_response($result,REST_Controller::HTTP_OK);
}
public function SavemultipleFiles(){

  foreach($_POST['check'] as $check){
    move_uploaded_file($_FILES['doc']['tmp_name'], $target_path);
    chmod($target_path,0777);
    copy($target_path, $target_path_2);
    copy($target_path, $target_path_3);
  }

}

public function customerRating_post(){
 $data = array(
  'req_id'=>$this->input->post('req_id'),
  'driver_id'=>$this->input->post('driver_id'),
  'user_id'=>$this->input->post('user_id'),
  'rating'=>$this->input->post('rating')
  );
 $result=$this->User_model->customerRating($data);
 if ($result){
   $result = array(
     "controller" => "User",
     "action" => "customerRating",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"your rating has been sucessfully submitted",
     "Response" => $result
     );
 }
 else{
   $result = array(
     "controller" => "User",
     "action" => "customerRating",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Something Went Wrong",
     );
 }
 $this->set_response($result,REST_Controller::HTTP_OK);


}
public function addCard_post(){

 $data = array(
   'user_id'=> $this->input->post('user_id'),
   'token_id'=> $this->input->post('token_id'),
   'card_no'=> $this->input->post('card_no'),
   'is_default'=> $this->input->post('is_default'),
   );
 $updateddata=$this->User_model->select_data('*','tbl_stripeUsersDetail',array('card_no'=>$data['card_no'],'user_id'=>$data['user_id']));
 /*add card  start*/
 if(empty($updateddata)){
  /*generation of customer id start*/
  $createcustomer = \Stripe\Customer::create(array(
   "source" => $data['token_id'],
   "description" => "work")
  );
  /*generation of customer id end*/


  /*braintree start*/
                  // $result = Braintree_Customer::create([
                  // 'firstName' => 'Mike',
                  // 'lastName' => 'Jones',
                  // 'company' => 'Jones Co.',
                  // 'email' => 'mike.jones@example.com',
                  // 'phone' => '281.330.8004',
                  // 'fax' => '419.555.1235',
                  // 'website' => 'http://example.com'
                  // ]);

                  // $result->success;
                  // $result->customer->id;
  /*braintree end*/



  $customer_id = $createcustomer->id;

  $stripedetail=array(
   'user_id'=> $this->input->post('user_id'),
   'customer_id'=> $customer_id,
   'card_no'=> $this->input->post('card_no'),
   'is_default'=> $this->input->post('is_default'),
   );
  /*if user want to make default card start*/
  if($data['is_default']==1) {
    $status=0;
    $uptstripestatus = $this->User_model->update_data('tbl_stripeUsersDetail',array('is_default'=>$status),array('user_id'=>$data['user_id']));
    $uptstripestatus = $this->User_model->update_data('tbl_cardDetail',array('is_default'=>$status),array('user_id'=>$data['user_id']));
  }
  /*if user want to make default card end*/

  $this->db->insert('tbl_cardDetail', $data);
  $result = $this->db->insert('tbl_stripeUsersDetail', $stripedetail);
  if ($result){
   $result = array(
    "controller" => "User",
    "action" => "addCard",
    "ResponseCode" => true,
    "MessageWhatHappen" =>"card added sucessfully",
    );
 }
 else{
   $result = array(
     "controller" => "User",
     "action" => "addCard",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Something Went Wrong",
     );
 }
}
/*add card end*/
else{
 $result = array(
   "controller" => "User",
   "action" => "addCard",
   "ResponseCode" => false,
   "MessageWhatHappen" =>"card Already added",
   );
}
$this->set_response($result, REST_Controller::HTTP_OK);
}


public function cardListing_post(){
 $user_id = $this->input->post('user_id');
 $result=$this->User_model->cardlist($user_id);
 if ($result){
   $result = array(
     "controller" => "User",
     "action" => "cardListing",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"your data shows sucessfully",
     "Response" => $result
     );
 }
 else{
   $result = array(
     "controller" => "User",
     "action" => "cardListing",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Something Went Wrong",
     );
 }
 $this->set_response($result,REST_Controller::HTTP_OK);

}
public function transactionListing_post(){
 $user_id = $this->input->post('user_id');
 $result=$this->User_model->transactionListing($user_id);
 if ($result){
   $result = array(
     "controller" => "User",
     "action" => "transactionListing",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"your data shows sucessfully",
     "Response" => $result
     );
 }
 else{
   $result = array(
     "controller" => "User",
     "action" => "transactionListing",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Something Went Wrong",
     );
 }
 $this->set_response($result,REST_Controller::HTTP_OK);

}
public function addmoney_post(){
 $message = array(
  'user_id'=> $this->input->post('user_id'),
  'card_no'=> $this->input->post('card_no'),
  'date_created'=>date('Y-m_d H:i:s')
  );
 $amount= $this->input->post('amount');
 /*checking of card that exist or not start*/
 $card = $this->User_model->selectmoney_data($message);
 /*checking of card that exist or not end*/
 if(!empty($card)){
                      // Stripe\Stripe::setApiKey("sk_test_Lg9DUblnqYKJTdzU9YSAUS0n");

  $totalAmount = $amount * 100;



  /*transaction id from stripe start*/
  $charge = \Stripe\Charge::create(array(
    "amount" => $totalAmount,
    "currency" => "usd",
    "customer" => $card[0]->customer_id
    ));
  $txnId = $charge->balance_transaction;
  /*transaction id from stripe end*/





  $txnData=array
  (
    "user_id"=>$message['user_id'],
    "amount_credited"=>$amount,
    "card_no"=>$message['card_no'],
    "txn_id"=>$txnId,
    "type"=>"Added Money",
    "date_created"=>date('Y-m-d H:i:s')
    );
  $txnQuery = $this->User_model->insert_data('tbl_transactions',$txnData);


  $check_balence = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$message['user_id']));
  /*updation of new amount start*/
  $newAmount = $check_balence[0]->balence + $amount;
  $uptBal = $this->User_model->update_data('tbl_wallet',array('balence'=>$newAmount,' date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$message['user_id']));
  /*updation  of new amount end*/
}else{
  $txnQuery = '';
}
if(empty($txnQuery))

{
  $result = array(
    "controller" => "User",
    "action" => "addmoney",
    "ResponseCode" => false,
    "MessageWhatHappen" => "Something went wrong"

    );
}else{
  $result = array(
    "controller" => "User",
    "action" => "addmoney",
    "ResponseCode" => true,
    "MessageWhatHappen" => "Money added successfully"

    );
}
$this->set_response($result, REST_Controller::HTTP_OK);
}
public function deletecard_post(){
 $message = array(
  'user_id'=> $this->input->post('user_id'),
  'card_no'=> $this->input->post('card_no')
  );
 $data = $this->User_model->deletecard($message);
 if(empty($data))
 {
  $result = array(
    "controller" => "User",
    "action" => "deletecard",
    "ResponseCode" => true,
    "MessageWhatHappen" => "Card deleted sucessfully"
    );

}else{
  $result = array(
    "controller" => "User",
    "action" => "deletecard",
    "ResponseCode" => false,
    "MessageWhatHappen" => "Something went wrong"
    );
}
$this->set_response($result, REST_Controller::HTTP_OK);


}
public function applypromo_post(){
 $message = array(
  'user_id'=> $this->input->post('user_id'),
  'promo_code'=> $this->input->post('promo_code')
  );
 $signUpData = $this->User_model->applypromo($message);
 if($signUpData == 1){
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Expired",
     );
 }
 else if($signUpData == 0){
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Code dosent exist",
     );
 }
 else if($signUpData == 2){
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => true,
     "MessageWhatHappen" => "Applied Sucessfully",
     );
 }
 else if($signUpData == 3){
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Already Applied",
     );
 }
 else if($signUpData == 5){
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Already used refercode",
     );
 }
 else if($signUpData == 6){
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => true,
     "MessageWhatHappen" => "Sucessfully used refercode",
     );
 }
 else {
   $result = array(
     "controller" => "User",
     "action" => "applypromo",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Something went wrong",
     );
 }

 $this->set_response($result,REST_Controller::HTTP_OK);

}
public function yourMoveList_post(){
  $user_id = $this->input->post('user_id');
  $type = $this->input->post('type');
                // $result=$this->User_model->bookingHistory($user_id,$type);
  /*pending booking case start*/
  if($type==1){
    $acceptedbooking = $this->User_model->select_data('*','tbl_booking',array('user_id'=>$user_id,'is_accepted'=>0,'is_started'=>0,'is_completed'=>0,'is_cancelled'=>0,));
                  // $i=0;

                  // print_r($acceptedbooking);die();
    $acceptedbooking12=array();
    foreach ($acceptedbooking as $key => $value) {
      $acceptedbooking12= unserialize($value->item_image);
      $acceptedbooking[$key]->itemimages=$acceptedbooking12;
    }
    if(!empty($acceptedbooking)){
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => true,
        "MessageWhatHappen" =>"your data shows sucessfully",
        "Response" => $acceptedbooking,
        );
    }
    else{
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => false,
        "MessageWhatHappen" =>"Something went wrong",
        );
    }
  }
  /*pending booking case end*/
  /*started booking case start*/
  elseif($type==2){

    $acceptedbooking =  $this->db->query("select * from tbl_booking where user_id= ".$user_id." and( (is_accepted=1 or is_started=1) and is_completed=0 ) and is_cancelled =0 ")->result();
    $acceptedbooking12=array();
    foreach ($acceptedbooking as $key => $value) {
      $acceptedbooking12= unserialize($value->item_image);
      $acceptedbooking[$key]->itemimages=$acceptedbooking12;
    }
    if(!empty($acceptedbooking)){
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => true,
        "MessageWhatHappen" =>"your data shows sucessfully",
        "Response" => $acceptedbooking
        );
    }
    else{
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => false,
        "MessageWhatHappen" =>"Something went wrong",

        );

    }
  }
  /*started booking case end*/
  /*complete booking case start*/
  elseif($type==3){
    $acceptedbooking = $this->User_model->select_data('*','tbl_booking',array('user_id'=>$user_id,'is_completed'=>1));
    $acceptedbooking12=array();
    foreach ($acceptedbooking as $key => $value) {
      $acceptedbooking12= unserialize($value->item_image);

      $acceptedbooking[$key]->itemimages=$acceptedbooking12;
    }
    if(!empty($acceptedbooking)){
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => true,
        "MessageWhatHappen" =>"your data shows sucessfully",
        "Response" => $acceptedbooking
        );
    }
    else{
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => false,
        "MessageWhatHappen" =>"Something went wrong",

        );

    }
  }
  /*completed booking case end*/
  /*cancelled booking case start*/
  elseif($type==4){
    $acceptedbooking = $this->User_model->select_data('*','tbl_booking',array('user_id'=>$user_id,'is_cancelled'=>1));
    $acceptedbooking12=array();
    foreach ($acceptedbooking as $key => $value) {
      $acceptedbooking12= unserialize($value->item_image);

      $acceptedbooking[$key]->itemimages=$acceptedbooking12;
    }
    if(!empty($acceptedbooking)){
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => true,
        "MessageWhatHappen" =>"your data shows sucessfully",
        "Response" => $acceptedbooking
        );
    }
    else{
      $result = array(
        "controller" => "User",
        "action" => "yourMoveList",
        "ResponseCode" => false,
        "MessageWhatHappen" =>"Something went wrong",

        );

    }
  }
  /*cancelled booking case end*/
  $this->set_response($result,REST_Controller::HTTP_OK);
}
public function moveDetailHistory_post(){
  $message = array(
    'user_id'=> $this->input->post('user_id'),
    'move_id'=> $this->input->post('move_id'),
    'user_Type'=> $this->input->post('user_Type')
    );
  $moveHistorydata = $this->User_model->moveDetailHistory($message);
  $acceptedbooking12=array();
  foreach ($moveHistorydata['booking_data'] as $key => $value) {
    $acceptedbooking12= unserialize($value->item_image);

    $moveHistorydata['booking_data'][$key]->itemimages=$acceptedbooking12;
  }
                 // print_r($moveHistorydata);die();
  if(empty($moveHistorydata['booking_data']) && empty($moveHistorydata['move_data'])){
   $result = array(
     "controller" => "User",
     "action" => "moveDetailHistory",
     "ResponseCode" => false,
     "MessageWhatHappen" => "data does not exist in table",
     );
 }
 else{
  $result = array(
   "controller" => "User",
   "action" => "moveDetailHistory",
   "ResponseCode" => true,
   "MessageWhatHappen" => "Your data shows sucessfully",
   "response"=>$moveHistorydata
   );
}
$this->set_response($result,REST_Controller::HTTP_OK);

}
function forgotpassword_post() {

  $email = $this->post('email');

  $id = $this->User_model->forgotpassword($email);
        // print_r($id);die();

  if ($id == 0)
  {
   $result = array(
     "controller" => "user",
     "action" => "forgotpassword",
     "ResponseCode" => false,
     "MessageWhatHappen" => "Email does not exist in our database"
     );
 } else {

   $body = "<!DOCTYPE html>
   <head>
    <meta content=text/html; charset=utf-8 http-equiv=Content-Type />
    <title>Feedback</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <table style='background:rgba(28, 182, 140, 0.8) none repeat scroll 0 0; border: 3px solid #1cb68c;' width=60% border=0 bgcolor=#53CBE6 style=margin:0 auto; float:none;font-family: 'Open Sans', sans-serif; padding:0 0 10px 0; >
      <tr>
        <th width=20px></th>
        <th width=20px  style='padding-top:30px;padding-bottom:30px;'><img src='http://phphosting.osvin.net/moversOnDemand/public/img/changepassword/ic_van-logo.png' style='width: 40%;'></th>
        <th width=20px></th>
      </tr>
      <tr>
        <td width=20px></td>
        <td bgcolor=#fff style=border-radius:10px;padding:20px;>
          <table width=100%;>
            <tr>
              <th style=font-size:20px; font-weight:bolder; text-align:right;padding-bottom:10px;border-bottom:solid 1px #ddd;> Hello " . $id['fname'] . "</th>
            </tr>

            <tr>
              <td style=font-size:16px;>
                <p> You have requested a password retrieval for your user account at Movers.To complete the process, click the link below.</p>
                <p> This is valid for 30 Minutes.</p>
                <p><a href=" . site_url('api/User/newpassword?id=' . $id['b_id']) . ">Change Password</a></p>
              </td>
            </tr>


            <tr>
              <td style=text-align:center; padding:20px;>
                <h2 style=margin-top:50px; font-size:29px;>Best Regards,</h2>
                <h3 style=margin:0; font-weight:100;>Customer Support</h3>

              </td>
            </tr>
          </table>
        </td>
        <td width=20px></td>
      </tr>
      <tr>
        <td width=20px></td>
        <td style='text-align:center; color:#fff; padding:10px;'> Copyright © Movers All Rights Reserved</td>
        <td width=20px></td>
      </tr>
    </table>
  </body>";

  $this->load->library('email');
  $this->email->set_newline("\r\n");
  $this->email->to($email);
  $this->email->from('moverOndemand@gmail.com', 'MOVERS');
  $this->email->subject('Forgot Password');
  $this->email->message($body);
  $mail = $this->email->send();
  $result = array(
   "controller" => "user",
   "action" => "forgotpassword",
   "ResponseCode" => true,
   "MessageWhatHappen" => "Mail Sent Successfully"
   );
}

$this->set_response($result, REST_Controller::HTTP_OK);
}

function newpassword_get($user_id=null)
{
 if ($user_id!="") {
   $user_id = base64_decode($user_id);
 }else{
   $user_id = base64_decode($this->get('id'));
 }

 $useridArr = explode("_", $user_id);
 $user_id = $useridArr[0];
 $data['id'] = $user_id;


 $data['title'] = "new Password";
 $this->load->view('templete/header');
 $this->load->view('templete/newpassword', $data);
}

function updateNewpassword_post()
{

  $uid = $this->input->post('id');
  $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
  $id = $uid . "_" . $static_key;
  $id = base64_encode($id);
  $message = ['id' => $this->input->post('id') , 'password' => $this->input->post('password') , 'base64id' => $id];
  $this->load->library('form_validation');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
  $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]|md5');
  if ($this->form_validation->run() == FALSE)
  {

    $this->session->set_flashdata('msg', '<span style="color:red">Please Enter Same Password</span>');
    redirect("api/User/newpassword?id=" . $message['base64id']);
  }
  else
  {

    $this->User_model->updateNewpassword($message);
  }
}
public function updateCard_post(){
 $data = array(
  'id'=> $this->input->post('card_id'),
  'user_id'=> $this->input->post('user_id'),
  'card_no'=> $this->input->post('card_no'),
  'token_id'=> $this->input->post('token_id'),
  'is_default'=> $this->input->post('is_default')
  );
 $updateddata=$this->User_model->select_data('*','tbl_stripeUsersDetail',array('id'=>$data['id'],'user_id'=>$data['user_id']));
              // print_r($updateddata);die();
 /*already exist card case start*/
 if ($data['card_no']==$updateddata[0]->card_no && $data['user_id']==$updateddata[0]->user_id && $data['is_default']==$updateddata[0]->is_default) {

   $result = array(
     "controller" => "User",
     "action" => "updateCard",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Card Already exists",
     );
 }
 /*already exist card case end*/

 /*if user wants only is default case start*/
                  // elseif($data['card_no']==$updateddata[0]->card_no && $data['user_id']==$updateddata[0]->user_id && $data['is_default'] !=$updateddata[0]->is_default) {
                  //   if ($data['is_default']==1) {

                  //   }
                  //
                  //  $uptstripestatus = $this->User_model->update_data('tbl_stripeUsersDetail',array('is_default'=>$status),array('user_id'=>$data['user_id']));
                  //      $uptstripestatus = $this->User_model->update_data('tbl_stripeUsersDetail',array('is_default'=>$data['is_default']),array('user_id'=>$data['user_id'],'card_no'=>$data['card_no']));
                  //    $result = array(
                  //          "controller" => "User",
                  //          "action" => "updateCard",
                  //          "ResponseCode" => false,
                  //          "MessageWhatHappen" =>"Card updated sucessfully",
                  //          );
                  // }

 /*if user wants only is default case end*/



 /*update card case start*/
 else{
                 // Stripe\Stripe::setApiKey("sk_test_Lg9DUblnqYKJTdzU9YSAUS0n");



   /*stripe generation of customer id start*/
   $createcustomer = \Stripe\Customer::create(array(
     "source" => $data['token_id'],
     "description" => "work")
   );
   /*stripe generation of customer id end*/
   $customer_id = $createcustomer->id;

   $stripedetail=array(
     'user_id'=> $this->input->post('user_id'),
     'customer_id'=> $customer_id,
     'card_no'=> $this->input->post('card_no'),
     'is_default'=> $this->input->post('is_default'),
     );
   /*only update if user wants  to make updated card default card start*/
   if($data['is_default']==1) {
    $status=0;
    $uptstripestatus = $this->User_model->update_data('tbl_stripeUsersDetail',array('is_default'=>$status),array('user_id'=>$data['user_id']));
    $uptstripestatus12 = $this->User_model->update_data('tbl_cardDetail',array('is_default'=>$status),array('user_id'=>$data['user_id']));
  }
  /*only update if user wants  to make updated card default card end*/

// $updatespecific=$this->User_model->select_data('*','tbl_stripeUsersDetail',array('id'=>$data['id'],'user_id'=>$data['user_id']));


  /*updation of detail in tbl_carddetail and tbl_stripeuserdetail start*/
  $uptcard = $this->User_model->update_data('tbl_cardDetail',array('user_id'=>$data['user_id'],'card_no'=>$data['card_no'],'token_id'=>$data['token_id'],'is_default'=>$data['is_default']),array('user_id'=>$data['user_id'],'card_no'=>$updateddata[0]->card_no));
  $uptstripe = $this->User_model->update_data('tbl_stripeUsersDetail',array('user_id'=>$stripedetail['user_id'],'customer_id'=>$stripedetail['customer_id'],'card_no'=>$stripedetail['card_no'],'is_default'=>$stripedetail['is_default']),array('user_id'=>$data['user_id'],'id'=>$data['id']));
  /*updation of detail in tbl_carddetail and tbl_stripeuserdetail end*/


  if ($uptstripe){
   $result = array(
    "controller" => "User",
    "action" => "updateCard",
    "ResponseCode" => true,
    "MessageWhatHappen" =>"card updated sucessfully",
    );
 }
 else{
   $result = array(
     "controller" => "User",
     "action" => "updateCard",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Something Went Wrong",
     );
 }


}
/*update card case end*/


                     // else{
                     //       $result = array(
                     //       "controller" => "User",
                     //       "action" => "updateCard",
                     //       "ResponseCode" => false,
                     //       "MessageWhatHappen" =>"card Already added",
                     //       );
                     //  }
$this->set_response($result, REST_Controller::HTTP_OK);


}
public function moveAction_post(){
  $booking_id = $this->input->post('booking_id');
  $driver_id = $this->input->post('user_id');
  $type = $this->input->post('type');
  $cancelUser_type = $this->input->post('cancelUser_type');
  $totalPrice = $this->input->post('totalPrice');
  $reason = $this->input->post('reason');
  $bookingDetails = $this->User_model->select_data('*','tbl_booking',array('id'=>$booking_id));
            // print_r($bookingDetails);die();
  /*accepted case by driver*/
  if ($type==1) {
    /*for one time hit next hit get error*/
    if ($bookingDetails[0]->is_accepted==1 || $bookingDetails[0]->is_cancelled==1 || $bookingDetails[0]->is_completed==1) {
      $result = array(
        "controller" => "User",
        "action" => "moveAction",
        "ResponseCode" => false,
        "ErrorCode" => 401,
        "MessageWhatHappen" => "Move accepted failed"
        );
      $this->set_response($result, REST_Controller::HTTP_OK);
      return true;
    } else {
      $bookingdata = $this->User_model->update_data('tbl_booking',array('driver_id'=>$driver_id,'is_accepted'=>1),array('id'=>$booking_id));
      $moveData = array(
        "driver_id"=>$driver_id,
        "status"=>1,
        'accepted_time'=>date('Y-m-d H:i:s')
        );
      $insertMove_history = $this->User_model->update_data('tbl_moveHistory',$moveData,array("booking_id"=>$booking_id));
      $action = "Move booked";
      $bookinguserDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$bookingDetails[0]->user_id));
      $bookingdriverDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$driver_id));
      $bookingloginuserDetails = $this->User_model->select_data('*','tbl_login',array('user_id'=>$bookingDetails[0]->user_id,'status'=>1));
      $vehicleNumber = $this->User_model->select_data('*','tbl_driverDetail',array('driver_id'=>$driver_id));
                    // print_r($vehicleNumber);
      $vehicleName=$this->User_model->select_data('*','tbl_vechicleType',array('driver_id'=>$driver_id));
                    // print_r($vehicleName);

      /*rating in round off start*/
      $avgrating=$this->db->query("SELECT round(AVG(rating))  FROM tbl_customerRating WHERE driver_id= '".$driver_id."'")->result();


      /*rating in round off end*/


                    // print_r($bookingloginuserDetails);die();
      /*push message start*/
      $pushData['message'] = $bookingdriverDetails[0]->fname.' '.$bookingdriverDetails[0]->lname." has accepted your task request";
      $pushData['action'] = "Move accepted";
      $pushData['booking_id'] = $booking_id;
      $pushData['profile_pic']=$bookingdriverDetails[0]->profile_pic;
      $pushData['avgrating'] = $avgrating[0]->driverrating;
      $pushData['vehicleName'] = $vehicleName[0]->name;
      $pushData['vehicleNumber'] = $vehicleNumber[0]->vehicle_no;
      foreach ($bookingloginuserDetails as $key => $value) {

        $pushData['token'] = $value->token_id;
        if($value->device_id == 1){
          $this->User_model->iosPush($pushData);
        }else if($value->device_id == 0){
          $this->User_model->androidPush($pushData);
        }
      }
                 // die();
      /*push message end*/
    }
  }
  /*started case*/
  elseif ($type==2) {    /* started by driver*/
    /*for one time hit next hit get error*/
    if ($bookingDetails[0]->is_accepted==0 || $bookingDetails[0]->is_started==1 || $bookingDetails[0]->is_cancelled==1 || $bookingDetails[0]->is_completed==1) {
      $result = array(
        "controller" => "User",
        "action" => "moveAction",
        "ResponseCode" => false,
        "ErrorCode" => 401,
        "MessageWhatHappen" => "Move started failed"
        );
      $this->set_response($result, REST_Controller::HTTP_OK);
      return true;
    }else {
      $bookingdata = $this->User_model->update_data('tbl_booking',array('driver_id'=>$driver_id,'is_started'=>1),array('id'=>$booking_id));
      $moveData = array(
        "driver_id"=>$driver_id,
        "status"=>2,
        'started_time'=>date('Y-m-d H:i:s')
        );
      $insertMove_history = $this->User_model->update_data('tbl_moveHistory',$moveData,array("booking_id"=>$booking_id));
      $action = "Move started";
      $bookinguserDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$bookingDetails[0]->user_id));
      $bookingdriverDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$driver_id));
      $bookingloginuserDetails = $this->User_model->select_data('*','tbl_login',array('user_id'=>$bookingDetails[0]->user_id,'status'=>1));
      /*push message start*/
      $pushData['message'] = "Your task has started with ".$bookingdriverDetails[0]->fname.' '.$bookingdriverDetails[0]->lname;
      $pushData['action'] = "Move started";
      $pushData['booking_id'] = $booking_id;
      $pushData['Utype'] = 1;

      foreach ($bookingloginuserDetails as $key => $value) {

        $pushData['token'] = $value->token_id;
        if($value->device_id == 1){
          $this->User_model->iosPush($pushData);
        }else if($value->device_id == 0){
          $this->User_model->androidPush($pushData);
        }
      }
      /*push message end*/

    }
  }
  /*completion case*/
  elseif($type==3){   /*is completed by driver*/
    /*for one time hit next hit get error*/

    if ($bookingDetails[0]->is_accepted==0 || $bookingDetails[0]->is_started==0 || $bookingDetails[0]->is_cancelled==1 || $bookingDetails[0]->is_completed==1) {
      $result = array(
        "controller" => "User",
        "action" => "moveAction",
        "ResponseCode" => false,
        "ErrorCode" => 401,
        "MessageWhatHappen" => "Move completed failed"
        );
      $this->set_response($result, REST_Controller::HTTP_OK);
      return true;
    }else {

      $bookingdata = $this->User_model->update_data('tbl_booking',array('driver_id'=>$driver_id,'is_completed'=>1),array('id'=>$booking_id));
      $moveData = array(
        "driver_id"=>$driver_id,
        "status"=>3,
        'completed_time'=>date('Y-m-d H:i:s')
        );
      $insertMove_history = $this->User_model->update_data('tbl_moveHistory',$moveData,array("booking_id"=>$booking_id));
      $bookinguserDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$bookingDetails[0]->user_id));
      $action = "Move completed";
      $bookingdriverDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$driver_id));
      $bookingloginuserDetails = $this->User_model->select_data('*','tbl_login',array('user_id'=>$bookingDetails[0]->user_id,'status'=>1));
      $get_percentage = $this->User_model->select_data('min_booking_charge','tbl_setting');
      $percentage = $get_percentage[0]->min_booking_charge;
      $getUserBalance = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$bookinguserDetails[0]->id));


      /*in case promocode used by user start*/
      $getuserpromo= $this->User_model->select_data('*','tbl_promousers',array('user_id'=>$bookinguserDetails[0]->id,'is_used'=>2));
      if (!empty($getuserpromo)) {
        $getpromoValue = $this->User_model->select_data('*','tbl_promocode',array('promo_code'=>$getuserpromo[0]->promo_code));
        $promovalue=($getpromoValue[0]->value/100 )* $totalPrice;

        /*add promoamount in user wallet  table start*/

        $promoamountadded=$getUserBalance[0]->balence+$promovalue;
        $updatepromodata = $this->User_model->update_data('tbl_wallet',array('balence'=>$promoamountadded,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$bookinguserDetails[0]->user_id));
        $updatepromostatus = $this->User_model->update_data('tbl_promousers',array('is_used'=>1),array('user_id'=>$bookinguserDetails[0]->id,'promo_code'=>$getuserpromo[0]->promo_code));

        /*transcation report added in case of promo amount added start*/

        $transUserArray = array(
          'amount_credited'=>$promovalue,
          'user_id'=>$bookinguserDetails[0]->id,
          'txn_id'=>'promoamountaddition',
          'type'=>'promo value added',
          'date_created'=>date('Y-m-d H:i:s')
          );
        $transResponse = $this->User_model->insert_data('tbl_transactions',$transUserArray);

        /*transcation report added in case of promo amount added end*/

        /*add promoamount in user wallet  table end*/
      }
      /*in case promocode used by user end*/


      /*customer deduction start*/
      $newAmount = $getUserBalance[0]->balence - $totalPrice;
      $uptDAta = $this->User_model->update_data('tbl_wallet',array('balence'=>$newAmount,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$bookingDetails[0]->user_id));
      $transUserArray = array(
        'amount_debited'=>$newAmount,
        'user_id'=>$bookingDetails[0]->user_id,
        'txn_id'=>'from_wallet',
        'type'=>'deduction againest booking',
        'date_created'=>date('Y-m-d H:i:s'),
        );
      $transResponse = $this->User_model->insert_data('tbl_transactions',$transUserArray);
      /*customer deduction end*/

      /*driver pay start*/


                // $getDriverBalance = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$bookingdriverDetails[0]->id));
                // $updatedriveramount=$getDriverBalance[0]->balence+$totalPrice;
                // $uptdriverDAta = $this->User_model->update_data('tbl_wallet',array('balence'=>$newAmount,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$bookingdriverDetails[0]->id));
                // $transUserArray = array(
                // 'amount_credited'=>$updatedriveramount,
                // 'user_id'=>$bookingdriverDetails[0]->id,
                // 'txn_id'=>'from_wallet',
                // 'type'=>'booking completion',
                // 'date_created'=>date('Y-m-d H:i:s')
                // );
                // $transResponse = $this->User_model->insert_data('tbl_transactions',$transUserArray);


      /*update in driver fund table start*/
      $getDriverBalance = $this->User_model->select_data('*','tbl_driversFund',array('driver_id'=>$bookingdriverDetails[0]->id));
                 // print_r($getDriverBalance);die();
      $updatedriveramount=$getDriverBalance[0]->outstanding_amount+$totalPrice;
      $uptdriverDAta = $this->User_model->update_data('tbl_driversFund',array('outstanding_amount'=>$updatedriveramount,'date_modified'=>date('Y-m-d H:i:s')),array('driver_id'=>$bookingdriverDetails[0]->id));

      $transUserArray = array(
        'amount_credited'=>$totalPrice,
        'user_id'=>$bookingdriverDetails[0]->id,
        'txn_id'=>'from_wallet',
        'type'=>'booking completion',
        'date_created'=>date('Y-m-d H:i:s')
        );
      $transResponse = $this->User_model->insert_data('tbl_transactions',$transUserArray);
      /*update in driver fund table end*/
      /*driver pay end*/


      /*send push message start*/
      $pushData['message'] = "Your task with ".$bookingdriverDetails[0]->fname.' '.$bookingdriverDetails[0]->lname." has completed";
      $pushData['action'] = "Move completed";
      $pushData['booking_id'] = $booking_id;
      $pushData['Utype'] = 1;
      foreach ($bookingloginuserDetails as $key => $value) {
        $pushData['token'] = $value->token_id;
        if($value->device_id == 1){
          $this->User_model->iosPush($pushData);
        }else if($value->device_id == 0){
          $this->User_model->androidPush($pushData);
        }
      }
      /*send push message end*/


      /*invoice mail start*/
      $bookinguserDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$bookingDetails[0]->user_id));
      $bookingdriverDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$driver_id));
      $time= $this->User_model->select_data('*','tbl_moveHistory',array('booking_id'=>$booking_id));
      /*value for invoice email templete start*/
      $username=$bookinguserDetails[0]->fname;
      $total=$bookingDetails[0]->total_price;
      $pick=$bookingDetails[0]->pickup_loc;
      $drop=$bookingDetails[0]->destination_loc;

      $starttime=$bookingDetails[0]->booking_time;
      $completetime=$time[0]->completed_time;
      $currentdate=date('Y-m-d');

      $drivername=$bookingdriverDetails[0]->fname;
      $estimate=$bookingDetails[0]->estimated_price;
      $email = $bookinguserDetails[0]->email;
      /*values for invoice email templete end*/
      /* To customer */
      $body =
      '<!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invoice email</title>

        <style type="text/css">
          .table_width {
            width: 600px;
            margin: 0px auto;
            float: none;
          }
          .map img {
            width: 600px;
          }
          .logo > img {
           padding: 7px 0;
           width: 45%;}
           .logo {
            float: none;
            padding: 0px;
            margin: 0px;
            text-align: center;
          }
          .headings h1 {
            color: #5c5c5c;
            font-size: 30px;
            margin: 0;
            padding: 0;
            font-weight: 600;
            text-align: center;
          }
          .headings h4 {
            color: #727272;
            font-size: 17px;
            line-height: 31px;
            margin: 0;
            padding: 4px 0 0;
            font-weight: normal;
          }
          .headings {
            float: none;
            padding: 10px 27px;
            text-align: center;
          }
          .timing {
            background: #f6f6f6 none repeat scroll 0 0;
            padding: 5px 17px;
          }

          .Estimated h4{
            color: #5c5c5c;
            font-size: 20px;
            margin: 0;
            padding: 11px 0 0;
            font-weight: 500;
            text-align: center;

          }
          .timing h3 {
            color: #5c5c5c;
            font-size: 20px;
            margin: 0;
            padding: 11px 0 0;
            font-weight: 500;
          }

          .timing span {
            color: #434343;
            float: right;
            font-size: 14px;
            font-weight: normal;
            padding: 0px 11px 2px;
          }

          .profile img {
            width: 60%;
            padding: 20px 11px;
          }
          .go_with h5 {
            color: #848484;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            padding: 0;
          }
          .go_with h5 span {
            color: #333;
          }
          .rating {
            background: #f6f6f6;
            padding: 0px;
            width: 80%;
            margin: 0px auto;
          }
          .rating p {
            color: #727272;
            font-size: 17px;
            margin: 0;
            padding: 14px 10px;
          }
          .discription p {
            margin: 0px;
            padding: 0 0 0 12px;
            line-height: 31px;
            font-size: 14px;
            color: #727272;
            font-weight: normal;
          }
          .boder_bottom {
            border-bottom: 1px solid #eeeeee;
            padding: 0 0 10px;
          }
          .fare h3 {
            color: #000;
            font-size: 18px;
            line-height: 31px;
            margin: 0;
            padding: 13px 0 0;
            font-weight: normal;
          }
          .base_fare h4 {
            color: #848484;
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            padding: 10px 0;
          }
          .base_fare p {
            color: #848484;
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            padding: 10px 0;
            text-align: right;
          }
          .total h4 {
            color: #000;
            font-size: 18px;
            line-height: 31px;
            margin: 0;
            padding: 3px 0 0;
            font-weight: normal;
          }
          .total p {
            color: #000;
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            padding: 16px 0;
            text-align: right;
          }
          .copy_right {
            background: #2b92df none repeat scroll 0 0;
            margin: 0;
            padding: 3px 0 0;
            text-align: center;
          }
          .copy_right > p {
            color: #ffffff;
            font-size: 18px;
            padding: 0px 0 0;
            text-align: center;
          }
          .postion {position: relative!important;top: -29px!important;}

          .table_width{width: 600px; margin: 0px auto; float: none; background: #dddddd none repeat scroll 0 0;}
        </style>
      </head>

      <body style="font-family: "Roboto", sans-serif;">

        <div class="table_width">
          <table cellpading="0" cellspacing="0" border="0" style="width:600px background-color:#ccc; margin:0px auto;">

            <tr>

              <th class="map"><img src="http://phphosting.osvin.net/moversOnDemand/public/img/map.jpg">
              </th>
            </tr>

            <tr>
              <td class="logo"><img src="http://phphosting.osvin.net/moversOnDemand/public/img/ic_logo_dashboard.png">
              </td>
            </tr>

            <tr>
              <td class="headings"><h4>Thanks for choosing MOVERS, '.$username.'</h4></td>
            </tr>
            <tr>                <td class="headings"><h4>'.$currentdate.'</h4></td>
            </tr>
            <tr><td class="headings"><h1> Total price</h1><h1>$ '.$total.'</h1></td></tr>




            <tr>
              <td>
                <table>
                  <td width="30%" class="profile"><img src="http://phphosting.osvin.net/moversOnDemand/public/img/dum.png" >
                  </td>
                  <td class="go_with" vertical-align="top" width="70%">

                    <table width="100%">
                      <tr>
                        <td class="headings"><h1> You Rode with Osvin '.$drivername.'</h1></td>

                      </tr>
                    </table>
                  </td>
                </table>
              </td>
            </tr>

            <tr>
              <td>
                <table width="100%">
                  <tr>
                    <td width="50%" class="Estimated">
                      <h4>Estimated fare</h4>
                    </td>
                    <td width="50%" class="Estimated">
                      <h4>'.$estimate.'</h4>
                    </td>
                  </tr>

                </table>

              </td>
            </tr>




            <tr>
              <td class="boder_bottom">
                <table width="100%">
                  <tr class="">
                    <td width="50%" class="Estimated">
                      <h4>Total Fare</h4>
                    </td>
                    <td width="50%" class="Estimated">
                      <h4>'.$total.'</h4>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>                <td class="copy_right">
              <p>Copyright &copy; 2017 Movers On Demand All rights reserved. </p>
            </td></tr>



          </table>
        </div>
      </body>

      </html>';
      $this->load->library('email');
      $this->email->from('support@moversOnDemand.com', 'Movers');
      $this->email->to($email);
      $this->email->subject('Request Completed');
      $this->email->message($body);
      $this->email->send();
      /*invoice email end*/

    }
  }
  /*cancelled case*/
  elseif ($type==4) {
    /*for one time hit next hit get error*/
    if ($bookingDetails[0]->is_started==1 || $bookingDetails[0]->is_cancelled==1 || $bookingDetails[0]->is_completed==1) {
      $result = array(
        "controller"   => "User",
        "action"       => "moveAction",
        "ResponseCode" => false,
        "ErrorCode"    => 401,
        "MessageWhatHappen" => "Move cancelled failed"
        );
      $this->set_response($result, REST_Controller::HTTP_OK);
      return true;
    }else {
      if ($cancelUser_type==1) {   /*cancelled by driver start*/

       $bookingdata = $this->User_model->update_data('tbl_booking',array('driver_id'=>$driver_id,'is_cancelled'=>1),array('id'=>$booking_id));

       $updateMove_history = $this->User_model->update_data('tbl_moveHistory',array('status'=>4,'cancelled_time'=>date('Y-m-d H:i:s'),'cancelled_by'=>1),array('booking_id'=>$booking_id,'driver_id'=>$driver_id));
       $bookinguserDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$bookingDetails[0]->user_id));
       $bookingdriverDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$driver_id));
       $bookingloginuserDetails = $this->User_model->select_data('*','tbl_login',array('user_id'=>$bookingDetails[0]->user_id,'status'=>1));
       /*push message start*/
       $pushData['message'] = $bookingdriverDetails[0]->fname.' '.$bookingdriverDetails[0]->lname." has cancelled your task request";
       $pushData['action'] = "Move cancelled";
       $pushData['booking_id'] = $booking_id;
       $pushData['Utype'] = 1;
       foreach ($bookingloginuserDetails as $key => $value) {

        $pushData['token'] = $value->token_id;
        if($value->device_id == 1){
          $this->User_model->iosPush($pushData);
        }else if($value->device_id == 0){
          $this->User_model->androidPush($pushData);
        }
      }
      /*push message end*/

      /*refund user in case of cancel by driver start*/
      $minBookingCharge = $this->User_model->select_data('min_booking_charge','tbl_setting');
      $getbookingcharge = $minBookingCharge[0]->min_booking_charge;
      $amountdeduct = ($getbookingcharge / 100) * $bookingDetails[0]->estimated_price;

      $deductprice=round($amountdeduct);
      $getBalance = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$bookingDetails[0]->user_id));

      $Amount = ($getBalance[0]->balence + $deductprice);
      $newAmount=round($Amount);
      $uptDAta = $this->User_model->update_data('tbl_wallet',array('balence'=>$newAmount,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$bookingDetails[0]->user_id));
      $transArray = array(
        'amount_credited'=>$deductprice,
        'user_id'=>$bookingDetails[0]->user_id,
        'txn_id'=>'refund ',
        'type'=>'refund againest cancelled booking',
        'date_created'=>date('Y-m-d H:i:s')
        );
      $transResponse = $this->User_model->insert_data('tbl_transactions',$transArray);
      /*refund user in case of cancel by driver end*/
      /*reason of cancel start*/
      $cancelArray = array(
        'user_id'=>$bookingDetails[0]->user_id,
        'status'=>1,
        'driver_id'=>$driver_id,
        'reason'=>$reason,
        'date_created'=>date('Y-m-d H:i:s')
        );
      $transResponse = $this->User_model->insert_data('tbl_cancelBooking',$cancelArray);
      /*reason of cancel end*/
      $action = "Move cancelled";

      /*cancelled by driver end*/
    }
    else if($cancelUser_type == 2) {   /*cancelled by user*/
      $bookingdata = $this->User_model->update_data('tbl_booking',array('driver_id'=>$driver_id,'is_cancelled'=>1),array('id'=>$booking_id));
      $updateMove_history = $this->User_model->update_data('tbl_moveHistory',array('status'=>4,'cancelled_time'=>date('Y-m-d H:i:s'),'cancelled_by'=>2),array('booking_id'=>$booking_id));

      /*refund user in case of booking time is greater then 24 hours start*/
      /*check time interval start*/
      $bookdate=$bookingDetails[0]->booking_date;
      $booktime=$bookingDetails[0]->booking_time;
      $curentdatetime=date('Y-M-d H:i:s');
      $combineddatetime = $bookdate . ' ' . $booktime;
      $interval = round((strtotime($combineddatetime) - strtotime($curentdatetime))/3600, 1);
      $action = "Move cancelled";
      /*check time interval end*/

      if ($interval>24) {
        $minBookingCharge = $this->User_model->select_data('min_booking_charge','tbl_setting');
        $getbookingcharge = $minBookingCharge[0]->min_booking_charge;
        $amountdeduct = ($getbookingcharge / 100) * $bookingDetails[0]->estimated_price;

        $deductprice=round($amountdeduct);
        $getBalance = $this->User_model->select_data('*','tbl_wallet',array('user_id'=>$bookingDetails[0]->user_id));

        $Amount = ($getBalance[0]->balence + $deductprice);
        $newAmount=round($Amount);
        $uptDAta = $this->User_model->update_data('tbl_wallet',array('balence'=>$newAmount,'date_modified'=>date('Y-m-d H:i:s')),array('user_id'=>$bookingDetails[0]->user_id));
        $transArray = array(
          'amount_credited'=>$deductprice,
          'user_id'=>$bookingDetails[0]->user_id,
          'txn_id'=>'refund ',
          'type'=>'refund againest cancelled booking'
          );
        $transResponse = $this->User_model->insert_data('tbl_transactions',$transArray);
      }

      /*refund user in case of booking time is greater then 24 hours end*/
      /*else only cancelled and not to be refund*/

      /*notification to driver that user has cancelled start*/
      $bookingdriverDetails = $this->User_model->select_data('*','tbl_users',array('id'=>$bookingDetails[0]->driver_id));
      $bookinglogindriverDetails = $this->User_model->select_data('*','tbl_login',array('user_id'=>$bookingDetails[0]->driver_id,'status'=>1));
              // print_r($bookingdriverDetails);die;
      /*push code start*/
      $pushData['message'] = $bookingdriverDetails[0]->fname.' '.$bookingdriverDetails[0]->lname." has cancelled your booking request";
      $pushData['action'] = "Move cancelled";
      $pushData['booking_id'] = $booking_id;
      $pushData['Utype'] = 1;
      foreach ($bookinglogindriverDetails as $key => $value) {

        $pushData['token'] = $value->token_id;
        if($value->device_id == 1){
          $this->User_model->iosPush($pushData);
        }else if($value->device_id == 0){
          $this->User_model->androidPush($pushData);
        }
      }
      /*push code end*/
      /*notification to driver that user has cancelled end*/

      /*reason of cancel start*/
      $cancelArray = array(
        'user_id'=>$bookingDetails[0]->user_id,
        'status'=>2,
        'driver_id'=>$driver_id,
        'reason'=>$reason
        );
      $transResponse = $this->User_model->insert_data('tbl_cancelBooking',$cancelArray);
      /*reason of cancel end*/


    }
  }

}/*cancel type end*/
if(empty($bookingdata)){
  $result = array(
    "controller" => "User",
    "action" => "moveAction",
    "ResponseCode" => false,
    "MessageWhatHappen" => "Not updated"
    );
}else{
  $result = array(
    "controller" => "User",
    "action" => "moveAction",
    "ResponseCode" => true,
    "MessageWhatHappen" => $action." successfully"
    );
}
$this->set_response($result, REST_Controller::HTTP_OK);
}

public function getdriverprofile_post(){
 $id= $this->input->post('driver_id');
 $data['profiledata'] = $this->User_model->select_data('*','tbl_users',array('id'=>$id));
 $data['driverdetaildata'] = $this->User_model->select_data('*','tbl_driverDetail',array('driver_id'=>$id));
 $data['vehicle_detail'] = $this->User_model->select_data('*','tbl_vechicleType',array('id'=>$data['driverdetaildata'][0]->vehicle_id));
 $data['walletdata'] = $this->User_model->select_data('balence','tbl_wallet',array('user_id'=>$id));
 $data['transactiondata'] = $this->User_model->select_data('*','tbl_transactions',array('user_id'=>$id));

 /*rating in round off start*/
 $data['avgrating']=$this->db->query("SELECT round(AVG(rating)) as driverrating FROM tbl_customerRating WHERE driver_id=$id")->result();
 /*rating in round off end*/

 if ($data){
  $result = array(
    "controller" => "User",
    "action" => "getdriverprofile",
    "ResponseCode" => true,
    "MessageWhatHappen" =>"your data shows sucessfully",
    "Response" => $data
    );
}
else {
  $result = array(
    "controller" => "User",
    "action" => "getdriverprofile",
    "ResponseCode" => false,
    "MessageWhatHappen" =>"Something went wrong",
    );
}
$this->set_response($result,REST_Controller::HTTP_OK);
}
/*cron for calculating outstanding amount for booking completion*/
      // public function driverbalance_get(){
      //   $this->db->select('*,tbl_users.fb_signUp as outsandingAmount');
      //   $this->db->from('tbl_wallet');
      //   $this->db->join('tbl_users', 'tbl_users.id = tbl_wallet.user_id',left);
      //   $this->db->join('tbl_driversFund','tbl_driversFund.driver_id=tbl_wallet.user_id');
      //   $this->db->where('tbl_users.user_Type',2);
      //   $data = $this->db->get()->result();
      //   // echo "<pre>"; print_r($data);die();
      //   foreach ($data as $key => $value) {
      //     $query=$this->db->query("SELECT * from tbl_booking where driver_id = $value->user_id and is_completed = 1")->result();
      //     $data12=array();
      //       foreach ($query as $key => $value12) {
      //         $data12[] = $value12->total_price;
      //       }
      //   $value->outsandingAmount=array_sum($data12);
      //   $uptDAta = $this->User_model->update_data('tbl_driversFund',array('outstanding_amount'=>$value->outsandingAmount,'date_modified'=>date('Y-m-d H:i:s')),array('driver_id'=>$value->driver_id));
      //   }
      // return $data;
      // }

/*update driver latitude and longitude api*/
public function updateDriverLoc_post(){
  $user_id = $this->input->post('user_id');
  $latitude = $this->input->post('latitude');
  $longitude = $this->input->post('longitude');
  $result=$this->User_model->update_data('tbl_users',array('latitude'=>$latitude,'longitude'=>$longitude),array('id'=>$user_id));
  if ($result){
   $result = array(
     "controller" => "User",
     "action" => "updateDriverLoc",
     "ResponseCode" => true,
     "MessageWhatHappen" =>"your data updated sucessfully",

     );
 }
 else{
   $result = array(
     "controller" => "User",
     "action" => "updateDriverLoc",
     "ResponseCode" => false,
     "MessageWhatHappen" =>"Something Went Wrong",
     );
 }
 $this->set_response($result,REST_Controller::HTTP_OK);

}

public function file_upload($upload_path, $image) {

  $baseurl = base_url();
  $config['upload_path'] = $upload_path;
  $config['allowed_types'] = 'gif|jpg|png|jpeg';
  $config['max_size'] = '5000';
  $config['max_width'] = '5024';
  $config['max_height'] = '5068';
  $config['overwrite'] = FALSE;



  $this->load->library('upload', $config);
  if (!$this->upload->do_upload($image))
  {
    $error = array(
      'error' => $this->upload->display_errors()
      );
                 // print_r($error); die;
    return $imagename = "";
  }
  else
  {
    $detail = $this->upload->data();
    return $imagename = $baseurl . $upload_path .'/'. $detail['file_name'];
  }
}
public function getcurrentMove_post(){
  $user_id=$this->input->post('user_id');
  $date=date('Y-m-d');
  $time=date('H:i:s');

  $accdata = $this->User_model->select_data('*','tbl_booking',array('driver_id'=>$user_id,'is_accepted'=>1,'is_started'=>1,'is_completed'=>0));
  if (!empty($accdata)) {
    $data['booking_data']=$this->User_model->select_data('*','tbl_booking',array('driver_id'=>$user_id,'is_accepted'=>1,'is_started'=>1,'is_completed'=>0));

    $acceptedbooking12=array();
    foreach ($data['booking_data'] as $key => $value) {
      $acceptedbooking12= unserialize($value->item_image);
      $data['booking_data'][$key]->itemimages=$acceptedbooking12;
    }
  }
  else{
    $data['booking_data']=$this->db->query("SELECT * FROM tbl_booking where driver_id = '".$user_id."' AND booking_date = '".$date."' AND booking_time >='".$time."' ORDER BY booking_time ASC LIMIT 1")->result();

    $acceptedbooking12=array();
    foreach ($data['booking_data'] as $key => $value) {
      $acceptedbooking12= unserialize($value->item_image);
      $data['booking_data'][$key]->itemimages=$acceptedbooking12;
    }

  }
  $data['move_data'] = $this->User_model->select_data('*','tbl_moveHistory',array('booking_id'=>$data['booking_data'][0]->id));
  $getvehicleid = $this->User_model->select_data('vehicle_id','tbl_driverDetail',array('driver_id'=>$data['booking_data'][0]->driver_id));


// if ($user_type==1) {
// $data['usersDetail'] = $this->User_model->select_data('fname,lname,country_code,phone,profile_pic','tbl_users',array('id'=>$data['booking_data'][0]->driver_id));
// $data['vehiclename'] = $this->User_model->select_data('name','tbl_vechicleType',array('id'=>$getvehicleid[0]->vehicle_id));
// $rating = $this->User_model->select_data('rating','tbl_customerRating',array('req_id'=>$data['booking_data'][0]->id));
// $data['rating']= $this->User_model->select_data('rating','tbl_customerRating',array('req_id'=>$data['booking_data'][0]->id));

// if (!empty($data['booking_data'][0]->driver_id)) {
// $data['avgrating']= $this->User_model->select_data('round(AVG(rating)) as driverrating','tbl_customerRating',array('driver_id'=>$data['booking_data'][0]->driver_id));
// }
// else{
// $data['avgrating']=array();
// }
// }
// else{
  $data['usersDetail'] = $this->User_model->select_data('fname,lname,country_code,phone,profile_pic','tbl_users',array('id'=>$data['booking_data'][0]->user_id));
// }

  if ($data){
    $result = array(
      "controller" => "User",
      "action" => "getcurrentMove",
      "ResponseCode" => true,
      "MessageWhatHappen" =>"your data shows sucessfully",
      "Response" => $data
      );
  }
  else {
    $result = array(
      "controller" => "User",
      "action" => "getcurrentMove",
      "ResponseCode" => false,
      "MessageWhatHappen" =>"Something went wrong",
      );
  }
  $this->set_response($result,REST_Controller::HTTP_OK);
}

public function driverMovelisting_post(){
 $driver_id=$this->input->post('driver_id');
 $type=$this->input->post('type');
 if ($type==1) {
  $acceptedbooking =  $this->db->query("select * from tbl_booking where driver_id= ".$driver_id." and (is_accepted=1 or is_started=1) and is_completed=0 and is_cancelled=0")->result();

  $acceptedbooking12=array();
  foreach ($acceptedbooking as $key => $value) {
    $acceptedbooking12= unserialize($value->item_image);
    $acceptedbooking[$key]->itemimages=$acceptedbooking12;
  }


  if(!empty($acceptedbooking)){
    $result = array(
      "controller" => "User",
      "action" => "driverMovelisting",
      "ResponseCode" => true,
      "MessageWhatHappen" =>"your data shows sucessfully",
      "Response" => $acceptedbooking,
      );
  }
  else{
    $result = array(
      "controller" => "User",
      "action" => "driverMovelisting",
      "ResponseCode" => false,
      "MessageWhatHappen" =>"Something went wrong",
      );
  }
}
elseif ($type==2) {
 $acceptedbooking = $this->User_model->select_data('*','tbl_booking',array('driver_id'=>$driver_id,'is_accepted'=>1,'is_started'=>1,'is_completed'=>1));

 $acceptedbooking12=array();
 foreach ($acceptedbooking as $key => $value) {
  $acceptedbooking12= unserialize($value->item_image);
  $acceptedbooking[$key]->itemimages=$acceptedbooking12;
}
if(!empty($acceptedbooking)){
  $result = array(
    "controller" => "User",
    "action" => "driverMovelisting",
    "ResponseCode" => true,
    "MessageWhatHappen" =>"your data shows sucessfully",
    "Response" => $acceptedbooking,
    );
}
else{
  $result = array(
    "controller" => "User",
    "action" => "driverMovelisting",
    "ResponseCode" => false,
    "MessageWhatHappen" =>"Something went wrong",
    );
}

}
elseif($type==3){
  $acceptedbooking = $this->User_model->select_data('*','tbl_booking',array('driver_id'=>$driver_id,'is_cancelled'=>1));

  $acceptedbooking12=array();
  foreach ($acceptedbooking as $key => $value) {
    $acceptedbooking12= unserialize($value->item_image);
    $acceptedbooking[$key]->itemimages=$acceptedbooking12;
  }
  if(!empty($acceptedbooking)){
    $result = array(
      "controller" => "User",
      "action" => "driverMovelisting",
      "ResponseCode" => true,
      "MessageWhatHappen" =>"your data shows sucessfully",
      "Response" => $acceptedbooking,
      );
  }
  else{
    $result = array(
      "controller" => "User",
      "action" => "driverMovelisting",
      "ResponseCode" => false,
      "MessageWhatHappen" =>"Something went wrong",
      );
  }

}
$this->set_response($result,REST_Controller::HTTP_OK);

}
public function twiliocalling_post(){
        //$this->load->library('twilio');
         $sid = "ACd9ea436674ec2d8744d2652cb265858e"; // Your Account SID from www.twilio.com/console
         $token = "db31d00ca08a02d08005f04bb07aa754"; // Your Auth Token from www.twilio.com/console

         $client = new Twilio\Rest\Client($sid, $token);

             // Read TwiML at this URL when a call connects (hold music)
         $call = $client->calls->create(
            '8881231234', // Call this number
         '+1 551-272-7143', // From a valid Twilio number
         array(
          'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
          )
         );
       }


       public function plaid_get(){
    $vars = array(
            'client_id: "59e43af6bdc6a4604915c791"',
          'secret :  "442a9f1209b2c8f53aa0ebbf90d5e2"',
            'username :  "plaid_test"',
            'password :  "plaid_good"',

         );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://sandbox.plaid.com/connect");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type: application/json'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        print_r($server_output);die;


     }

     public function pliad_get(){
        $vars = array(
            'client_id'=>'59ba6ffebdc6a46595e87b82',
          'secret'=>'90524a193a2f129b69e60a7db63a80',
            // 'count'=> 200,
              // 'offset'=> 0,
          // 'public_key'=>'86b3f4c10a4aaf62cb9b788371ebbb',
                // 'institution_id'=> 'ins_109512'
              // Account ID:: qMaxXybRMEcymBADZ6J8FeZmBQj7ENTxxLPrr
// Account name:: Plaid Checking
// Institution name:: Tartan Bank
          // 'public_token'=>'public-sandbox-5681cec5-c91c-4cb2-bcca-f839f1c90420'
          'access_token'=>'access-sandbox-068785d3-f001-4cb3-ab5e-09df332edead',



			"start_date"=> "2017-10-01",
			"end_date"=> "2017-10-20",




         );
        $aa=json_encode($vars);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://sandbox.plaid.com/transactions/get");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$aa);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type: application/json'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        print_r($server_output);
     }
     public function hello_get(){

          $payer = new Payer();
          $payer->setPaymentMethod("paypal");
          // print_r($payer);die;

          // Set redirect urls
          $redirectUrls = new RedirectUrls();
          $redirectUrls->setReturnUrl('https://api.sandbox.paypal.com/v1/payments/payment')
            ->setCancelUrl('https://api.sandbox.paypal.com/v1/payments/payment');

          // Set payment amount
          $amount = new Amount();
          $amount->setCurrency("USD")
            ->setTotal(10);
            // print_r($amount);die;

          // Set transaction object
          $transaction = new Transaction();
          $transaction->setAmount($amount)
            ->setDescription("Payment description");
            // print_r($transaction);die;

          // Create the full payment object
          $payment = new Payment();
          $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
            // print_r($payment);die;
     }


     public function add_get(){



      $fileurl = 'http://phphosting.osvin.net/moversOnDemand/Admin/public/php_tutorial.pdf';
header("Content-type:application/pdf");
header('Content-Disposition: attachment; filename=' . $fileurl);
readfile( $fileurl );

}


function abc_get(){
error_reporting(E_ALL);
ini_set('display_errors',1);

$zip = new ZipArchive;
// $zip->open('test_new.zip', ZipArchive::CREATE=== TRUE
//   echo "dffdj;k";

// echo "dfkjdf';";

if ($zip->open('test112.zip', ZipArchive::CREATE) === TRUE)
{
    // Add files to the zip file
    $zip->addFile('giphy.gif');
    $zip->addFile('giphy.gif');

    $zip->addFile('random.txt', 'newfile.txt');

    // Add a file new.txt file to zip using the text specified
    $zip->addFromString('new.txt', 'text to be added to the new.txt file');

    // All files are added, so close the zip file.
    $zip->close();
}


// print_r($zip);die;

// die;


$aa=$this->db->query("SELECT * from tbl_users")->result();
$files=array();
foreach ($aa as $key => $value) {
  $files[]=$value->profile_pic;
}
$zipname = 'file.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
  $zip->addFile($file);
}
$zip->close();







}
function downloadFile($file) {
    error_reporting(E_ALL);
ini_set('display_errors',1);

$zip = new ZipArchive;


echo "dfkjdf';";



die;


     // $abc=$this->db->query("SELECT * from tbl_users")->result();

     // foreach ($abc as $key => $value) {


      // print_r($value);die;
       // $file=$value->profile_pic;
  $ar_ext = explode('.', $file);
  $ext = strtolower(end($ar_ext));
  $extensions = array(
    'bmp' => 'image/bmp',
    'csv' => 'text/csv',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'exe' => 'application/octet-stream',
    'gif' => 'image/gif',
    'htm' => 'text/html',
    'html' => 'text/html',
    'ico' => 'image/vnd.microsoft.icon',
    'jpeg' => 'image/jpg',
    'jpe' => 'image/jpg',
    'jpg' => 'image/jpg',
    'pdf' => 'application/pdf',
    'png' => 'image/png',
    'ppt' => 'application/vnd.ms-powerpoint',
    'psd' => 'image/psd',
    'swf' => 'application/x-shockwave-flash',
    'tif' => 'image/tiff',
    'tiff' => 'image/tiff',
    'xhtml' => 'application/xhtml+xml',
    'xml' => 'application/xml',
    'xls' => 'application/vnd.ms-excel',
    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'zip' => 'application/zip'
  );
  $ctype = isset($extensions[$ext]) ? $extensions[$ext] : 'application/force-download';

header('Content-Type: '. $ctype);
header('Content-Disposition: attachment; filename=abc.png' . $file);
 header('Content-Transfer-Encoding: binary');

readfile( $file );
// }
}
public function abdd_get(){
	$abc=array('95','96',"97");
	print_r(serialize($abc));die;
}

   }
