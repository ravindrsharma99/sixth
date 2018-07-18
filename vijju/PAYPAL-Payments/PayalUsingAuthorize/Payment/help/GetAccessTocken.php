
<?php   

$clientId="AZFqlpZsolsUUC90nz8VPZluK1j6jGQ-lDg_aask3ufW2Ow8JdJSFBLCYgV4Cm2hkDdNqe9LQU64tk14qqq";
$clientSecret="EA2BP30oHSglMrrCBPR9fMsyXAC9xTDqE9ZjZl9nSZys4xYkC1oYXDlifBT5Esj1MHb0-UGh2Tjj_-9y";

$url = $host.'https://api.sandbox.paypal.com/v1/oauth2/token'; 
$postdata = 'grant_type=client_credentials';


	$curl = curl_init($url); 
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);
	curl_setopt($curl, CURLOPT_HEADER, false); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); 
	curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
	
	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode( $response );



echo "<pre>";
print_r($jsonResponse);




 ?>