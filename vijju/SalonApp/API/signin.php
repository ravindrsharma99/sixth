  <?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
global $wpdb;

$userEmail = $_REQUEST['user_email'];
$username = $_REQUEST['user_email'];
$password = $_REQUEST['password'];
$token = $_REQUEST['token'];
$device_id = $_REQUEST['device_id'];


$check = wp_authenticate_username_password( NULL,$username,$password);

if($username == '' || $password ==''){
	echo json_encode(array('Response' => 'false', 'Message' => 'All fields are required'));
}elseif($check->errors['invalid_username']){
	echo json_encode(array('Response' => 'false', 'Message' => 'Invalid username'));
}
elseif($check->errors['incorrect_password']){
	echo json_encode(array('Response' => 'false', 'Message' => 'Incorrect Password'));
}elseif(!is_wp_error( $check )){
	
	$creds = array();
	$creds['user_login'] = $username;
	$creds['user_password'] = $password;
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	$user_ID = $user->ID;
	$token_already_exist = $wpdb->get_var( "SELECT token FROM tbl_login WHERE token='".$token."' AND status = '0'" );
	$already_login = $wpdb->get_var($wpdb->prepare( "SELECT status FROM tbl_login WHERE status = '1' AND user_id='".$user_ID."'") );
	
	if($already_login){
		echo json_encode(array('Response' => 'false', 'Message' => 'User already Login'));
	}elseif($token_already_exist){
	 	$table = "tbl_login";
        $data_array = array('user_id' => $user_ID, 'device_id' => $device_id,'status' => '1', 'created' => 'NOW()');
         $where = array('token' =>  $token);
         $wpdb->update( $table, $data_array, $where );
    	 echo json_encode(array('Response' => 'true', 'Message' => 'User Logged in successfully!', 'user_id' => $user_ID));
	 }else{
		$sql = $wpdb->query('INSERT INTO tbl_login (user_id, token, device_id,created) VALUES("' . $user_ID  . '", "' . $token . '", "' . $device_id . '",NOW())');
		echo json_encode(array('Response' => 'true', 'Message' => 'User Logged in successfully!', 'user_id' => $user_ID));
	}
		
}

//http://phphosting.osvin.net/SalonApp/API/signin.php?token=asdasd&device_id=sdfsdff34&user_email=gjh@jhg.com&password=123123
?>