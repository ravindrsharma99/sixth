
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
$url = $host.'https://api.sandbox.paypal.com/v1/payments/payment';
$payment = array(
		'intent' => 'authorize',
		//'intent' => 'sale',
		'payer' => array(
			'payment_method' => 'credit_card',
			'funding_instruments' => array ( array(
					'credit_card' => array (
						'number' => '5500005555555559',
						'type'   => 'mastercard',
						'expire_month' => 12,
						'expire_year' => 2018,
						'cvv2' => 111,
						'first_name' => 'Joe',
						'last_name' => 'Shopper'
						)
					))
			),
		'transactions' => array (array(
				'amount' => array(
					'total' => '1',
					'currency' => 'EUR'
					),
				'description' => 'payment by a credit card using a test script'
				))
		);
$json = json_encode($payment);

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



if($jsonResponse['id'])
{
                echo "<pre>";
                print_r($jsonResponse);
				echo "||||||||||||||||||||||||||||||||||||||||SELF|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||\n";

			    $currency=$jsonResponse['transactions'][0]['amount']['currency'];
                $total=$jsonResponse['transactions'][0]['amount']['total'];;
              
				$payment_detail_url=$jsonResponse['transactions'][0]['related_resources'][0]['authorization']['links'][1]['href'];
								$postdata = array(
														'amount' => array (
																				'currency' => $currency,
																				'total'   => $total,
																			),
														  'is_final_capture' => true

                                				);
                 
               $json = json_encode($postdata);

				$json_resp = make_post_call($payment_detail_url,$Accesstoken,$json);

				print_r($json_resp);

}
else{
echo $error="Wrong Payment Details";
}






 ?>