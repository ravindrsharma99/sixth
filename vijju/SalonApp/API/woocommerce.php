<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
global $wpdb;



$email =$_REQUEST['email'];
$user_login =$_REQUEST['username'];
if (!empty($email)) {
	if( email_exists( $email )) {
		$user = get_user_by_email( $email );
		$userId =$user->ID;
		$static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
		$id = $userId . "_" . $static_key;
		$base_id = base64_encode($id);
		$url = get_site_url() . "/API/reset-password.php/?id=" . $base_id;
		

    		$to = $email;
			$subject = "RESET PASSWORD";
			$body = "<!DOCTYPE html>
					<head>
						<meta content=text/html; charset=utf-8 http-equiv=Content-Type />	
						<title>Recover Password</title>
				<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
				</head>
					<body>		
				<table width=100%;>
				  <tr>
				    <td style=font-size:16px;>
				    <p> You have request a password retrieval for your user account complete the process, click the link below.</p>
					<p><a href=" . $url . ">" . $url . "</a></p>
				    </td>
				  </tr>
				  </table>
				  
    		</body>" ;
			$headers = array('Content-Type: text/html; charset=UTF-8');

			wp_mail( $to, $subject, $body, $headers ); 
    		
      /* stuff to do when email address exists */
      	echo json_encode(array("Response" => true, "Message" => "You will receive an email with a link to reset your password"));
                 
  	 }else{
  	 	echo json_encode(array('Response' => 'false', 'Message' => 'User with this email is not exist'));
  	 }
}else{
	echo json_encode(array('Response' => 'false', 'Message' => 'Please Provide an email address'));
}



//http://phphosting.osvin.net/SalonApp/API/forget-password.php?email=osvinandroid@gmail.com&username=push
?>
