
<?php   
include("PaypalFunctions.php");
$error='';

$Accesstoken=get_access_token();

if($Accesstoken->access_token)
{
}
else{
echo $error="Wrong Credentials";
}

 $Accesstoken= $Accesstoken->access_token;
$url = 'https://api.sandbox.paypal.com/v1/payments/payment';


$payment = '{
  "intent":"authorize",
  "redirect_urls":{
    "return_url":"http://phphosting.osvin.net/PaypalUsingAuthorize/success.php",
    "cancel_url":"http://phphosting.osvin.net/PaypalUsingAuthorize/cancel.php"
  },
  "payer":{
    "payment_method":"paypal"
  },
  "transactions":[
    {
      "amount":{
        "total":"1",
        "currency":"USD"
      },
      "description":"Authorize Payment using Paypal."
    }
  ]
}';
$json = $payment;



$curl = curl_init($url); 
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer '.$Accesstoken,
				'Accept: application/json',
				'Content-Type: application/json'
				));
	
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
	#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
	
	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode($response, TRUE);
echo "<pre>";
print_r($jsonResponse);



echo "//////////////////////////////Self//////////////////////////////";
$url="https://api.sandbox.paypal.com/v1/payments/payment/PAY-8DY29701X84218034KYKMA3Q";
$jsonResponse3=make_get_call($url,$Accesstoken);

print_r($jsonResponse3);




echo "//////////////////////////////Execute//////////////////////////////";
$url="https://api.sandbox.paypal.com/v1/payments/payment/PAY-25065331JS289280EKYKL63Y/execute";
$payment = '{ "payer_id" : "R2FB28EAMEDQ6" }';
$jsonResponse2=make_post_call($url,$Accesstoken,$payment);
print_r($jsonResponse2);
 ?>