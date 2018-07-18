
<?php   

$token="A015vcNyeOLHuV0pB.QqNKgtWLAv1WFtLCco2HtOlAwvq.Y";
$client="AZFqlpZsolsUUC90nz8VPZluK1j6jGQ-lDg_aask3ufW2Ow8JdJSFBLCYgV4Cm2hkDdNqe9LQU64tk14";
$secret="EA2BP30oHSglMrrCBPR9fMsyXAC9xTDqE9ZjZl9nSZys4xYkC1oYXDlifBT5Esj1MHb0-UGh2Tjj_-9y";

$url = $host.'https://api.sandbox.paypal.com/v1/payments/payment';
$payment = array(
		'intent' => 'sale',
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
					'currency' => 'USD'
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
				'Authorization: Bearer '.$token,
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

 ?>