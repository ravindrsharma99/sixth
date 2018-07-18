
<?php   
/*
$postdata1 = array(
"mode" => "sandbox",
"CLIENT_ID" =>"AZFqlpZsolsUUC90nz8VPZluK1j6jGQ-lDg_aask3ufW2Ow8JdJSFBLCYgV4Cm2hkDdNqe9LQU64tk14",
"SECRET" => "EA2BP30oHSglMrrCBPR9fMsyXAC9xTDqE9ZjZl9nSZys4xYkC1oYXDlifBT5Esj1MHb0-UGh2Tjj_-9y"

);


$url1 = "https://api.sandbox.paypal.com/v1/oauth2/token"; // Add site api url
foreach($postdata1 as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string=rtrim($fields_string, '&');
$crl1 = curl_init();
curl_setopt($crl1,CURLOPT_URL, $url1);
curl_setopt($crl1, CURLOPT_RETURNTRANSFER, true); // return the output in string format
curl_setopt($crl1,CURLOPT_POSTFIELDS, $fields_string);
$result1 = curl_exec($crl1);
curl_close($crl1);
$data_arr_signup=array();
$myvisit_history=json_decode($result1);
echo '<pre>';
print_r($myvisit_history);

*/





/*

$postdata1 = array(
"grant_type" => "client_credentials"

);
$client="AZFqlpZsolsUUC90nz8VPZluK1j6jGQ-lDg_aask3ufW2Ow8JdJSFBLCYgV4Cm2hkDdNqe9LQU64tk14";
$secret="EA2BP30oHSglMrrCBPR9fMsyXAC9xTDqE9ZjZl9nSZys4xYkC1oYXDlifBT5Esj1MHb0-UGh2Tjj_-9y";

$url1 = "https://api.sandbox.paypal.com/v1/oauth2/token"; // Add site api url
foreach($postdata1 as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string=rtrim($fields_string, '&');
$crl1 = curl_init();
curl_setopt($crl1,CURLOPT_URL, $url1);

// Authenticate
curl_setopt($crl1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($crl1, CURLOPT_USERPWD, $client . ":" . $secret); 
// Send content in proper format
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/json'));      

curl_setopt($crl1, CURLOPT_RETURNTRANSFER, true); // return the output in string format
curl_setopt($crl1,CURLOPT_POSTFIELDS, $fields_string);
$result1 = curl_exec($crl1);
curl_close($crl1);
$data_arr_signup=array();
$myvisit_history=json_decode($result1);
echo '<pre>';
print_r($myvisit_history);
*/
/*
$postdata1=array(
		'intent' => 'authorize',
		'payer' => array(
			'payment_method' => 'credit_card',
			'funding_instruments' => array ( array(
					'credit_card' => array (
						'number' => '5493022963692972',
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
					'total' => '7.47',
					'currency' => 'USD'
					),
				'description' => 'payment by a credit card using a test script'
				))
		);

$client="AZFqlpZsolsUUC90nz8VPZluK1j6jGQ-lDg_aask3ufW2Ow8JdJSFBLCYgV4Cm2hkDdNqe9LQU64tk14";
$secret="EA2BP30oHSglMrrCBPR9fMsyXAC9xTDqE9ZjZl9nSZys4xYkC1oYXDlifBT5Esj1MHb0-UGh2Tjj_-9y";

$url1 = "https://api.sandbox.paypal.com/v1/payments/payment"; // Add site api url
foreach($postdata1 as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string=rtrim($fields_string, '&');
$crl1 = curl_init();
curl_setopt($crl1,CURLOPT_URL, $url1);

// Authenticate
curl_setopt($crl1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($crl1, CURLOPT_USERPWD, $client . ":" . $secret); 
// Send content in proper format
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/json'));      

curl_setopt($crl1, CURLOPT_RETURNTRANSFER, true); // return the output in string format
curl_setopt($crl1,CURLOPT_POSTFIELDS, $fields_string);
$result1 = curl_exec($crl1);
curl_close($crl1);
$data_arr_signup=array();
$myvisit_history=json_decode($result1);
echo '<pre>';
print_r($myvisit_history);

*/
//https://devtools-paypal.com/guide/authorize_capture_lookup_refund/php?interactive=OFF&env=sandbox


# Sandbox
$host = 'https://api.sandbox.paypal.com';
$clientId = 'AQkquBDf1zctJOWGKWUEtKXm6qVhueUEMvXO_-MCI4DQQ4-LWvkDLIN2fGsd';
$clientSecret = 'EL1tVxAjhT7cJimnz5-Nsx9k2reTKSVfErNQF-CmrwJgxRtylkGTKlU4RvrX';
$token = '';
// function to read stdin
function read_stdin() {
        $fr=fopen("php://stdin","r");   // open our file pointer to read from stdin
        $input = fgets($fr,128);        // read a maximum of 128 characters
        $input = rtrim($input);         // trim any trailing spaces.
        fclose ($fr);                   // close the file handle
        return $input;                  // return the text entered
}
function get_access_token($url, $postdata) {
	global $clientId, $clientSecret;
	$curl = curl_init($url); 
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);
	curl_setopt($curl, CURLOPT_HEADER, false); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); 
#	curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
	if (empty($response)) {
	    // some kind of an error happened
	    die(curl_error($curl));
	    curl_close($curl); // close cURL handler
	} else {
	    $info = curl_getinfo($curl);
		echo "Time took: " . $info['total_time']*1000 . "ms\n";
	    curl_close($curl); // close cURL handler
		if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
			echo "Received error: " . $info['http_code']. "\n";
			echo "Raw response:".$response."\n";
			die();
	    }
	}
	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode( $response );
	return $jsonResponse->access_token;
}
function make_post_call($url, $postdata) {
	global $token;
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
	
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); 
	#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
	if (empty($response)) {
	    // some kind of an error happened
	    die(curl_error($curl));
	    curl_close($curl); // close cURL handler
	} else {
	    $info = curl_getinfo($curl);
		echo "Time took: " . $info['total_time']*1000 . "ms\n";
	    curl_close($curl); // close cURL handler
		if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
			echo "Received error: " . $info['http_code']. "\n";
			echo "Raw response:".$response."\n";
			die();
	    }
	}
	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode($response, TRUE);
	return $jsonResponse;
}
function make_get_call($url) {
	global $token;
	$curl = curl_init($url); 
	curl_setopt($curl, CURLOPT_POST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer '.$token,
				'Accept: application/json',
				'Content-Type: application/json'
				));
	
	#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
	$response = curl_exec( $curl );
	if (empty($response)) {
	    // some kind of an error happened
	    die(curl_error($curl));
	    curl_close($curl); // close cURL handler
	} else {
	    $info = curl_getinfo($curl);
		echo "Time took: " . $info['total_time']*1000 . "ms\n";
	    curl_close($curl); // close cURL handler
		if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
			echo "Received error: " . $info['http_code']. "\n";
			echo "Raw response:".$response."\n";
			die();
	    }
	}
	// Convert the result from JSON format to a PHP array 
	$jsonResponse = json_decode($response, TRUE);
	return $jsonResponse;
}
echo "\n";
echo "###########################################\n";
echo "Obtaining OAuth2 Access Token.... \n";
$url = $host.'/v1/oauth2/token'; 
$postArgs = 'grant_type=client_credentials';
$token = get_access_token($url,$postArgs);
echo "Got OAuth Token: ".$token;
echo "\n \n";
echo "###########################################\n";
echo "Making a Credit Card Payment... \n";
$url = $host.'/v1/payments/payment';
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
					'total' => '7.47',
					'currency' => 'USD'
					),
				'description' => 'payment by a credit card using a test script'
				))
		);
$json = json_encode($payment);
$json_resp = make_post_call($url, $json);
foreach ($json_resp['links'] as $link) {
	if($link['rel'] == 'self'){
		$payment_detail_url = $link['href'];
		$payment_detail_method = $link['method'];
	}
}
$related_resource_count = 0;
$related_resources = "";
foreach ($json_resp['transactions'] as $transaction) {
	if($transaction['related_resources']) {
		$related_resource_count = count($transaction['related_resources']);
		foreach ($transaction['related_resources'] as $related_resource) {
			if($related_resource['sale']){
				$related_resources = $related_resources."sale ";
				$sale = $related_resource['sale'];
				foreach ($sale['links'] as $link) {
					if($link['rel'] == 'self'){
						$sale_detail_url = $link['href'];
						$sale_detail_method = $link['method'];
					}else if($link['rel'] == 'refund'){
						$refund_url = $link['href'];
						$refund_method = $link['method'];
					}
				}
			} else if($related_resource['refund']){
				$related_resources = $related_resources."refund";
			}	
		}
	}
}
echo "Payment Created successfully: " . $json_resp['id'] ." with state '". $json_resp['state']."'\n";
echo "Payment related_resources:". $related_resource_count . "(". $related_resources.")";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Payment Details... \n";
$json_resp = make_get_call($payment_detail_url);
echo "Payment details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']. "'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Sale details...\n";
$json_resp = make_get_call($sale_detail_url);
echo "Sale details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Refunding a Sale... \n";
$refund = array(
		'amount' => array(
			'total' => '7.47',
			'currency' => 'USD'
			)
	       );
$json = json_encode($refund);
$json_resp = make_post_call($refund_url, $json);
echo "Refund processed " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Sale details...\n";
$json_resp = make_get_call($sale_detail_url);
echo "Sale details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Payment Details... \n";
$json_resp = make_get_call($payment_detail_url);
$related_resource_count = 0;
$related_resources = "";
foreach ($json_resp['transactions'] as $transaction) {
	if($transaction['related_resources']) {
		$related_resource_count = count($transaction['related_resources']);
		foreach ($transaction['related_resources'] as $related_resource) {
			if($related_resource['sale']){
				$related_resources = $related_resources."sale ";
			} else if($related_resource['refund']){
				$related_resources = $related_resources."refund";
			}
		}
	}
}
echo "Payment details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']. "' \n";
echo "Payment related_resources:". $related_resource_count . "(". $related_resources.")";
echo "\n \n";
echo "###########################################\n";
echo "Saving a Credit Card in vault... \n";
$url = $host.'/v1/vault/credit-card';
$creditcard = array(
		'payer_id' => 'testuser@yahoo.com',
		'number' => '4417119669820331',
		'type'   => 'visa',
		'expire_month' => 11,
		'expire_year' => 2018,
		'first_name' => 'John',
		'last_name' => 'Doe'
		);
$json = json_encode($creditcard);
$json_resp = make_post_call($url, $json);
$credit_card_id = $json_resp['id'];
echo "Credit Card saved ".$credit_card_id." with state '".$json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Making a Payment with saved credit card... \n";
$url = $host.'/v1/payments/payment';
$payment = array(
                'intent' => 'sale',
                'payer' => array(
                        'payment_method' => 'credit_card',
                        'funding_instruments' => array ( array(
                                        'credit_card_token' => array (
                                                'credit_card_id' => $credit_card_id,
                                                'payer_id' => 'testuser@yahoo.com'
                                                )
                                        ))
                        ),
                'transactions' => array (array(
                                'amount' => array(
                                        'total' => '7.47',
                                        'currency' => 'USD'
                                        ),
                                'description' => 'payment using a saved card'
                                ))
                );
$json = json_encode($payment);
$json_resp = make_post_call($url, $json);
echo "Payment Created successfully: " . $json_resp['id'] ." with state '". $json_resp['state']."'\n";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining all Payments (list) ... \n";
$payment_list_url = $host.'/v1/payments/payment?start_id=PAY-1JJ14633E59990232KE6QU3I';
$json_resp = make_get_call($payment_list_url);
echo "Number of Payment resources returned: " . count($json_resp['payments']);
$counter = 0;
foreach ($json_resp['payments'] as $payment) {
	echo "\n" . $counter++ . ". " . $payment['id'];
}
echo "\nNext Payment ID: ". $json_resp['next_id'];
echo "\nObtaining subset (2-4) of the Payments ... \n";
$payment_list_url = $host.'/v1/payments/payment?start_index=1&count=3';
$json_resp = make_get_call($payment_list_url);
echo "Number of Payment resources returned: " . count($json_resp['payments']);
$counter = 0;
foreach ($json_resp['payments'] as $payment) {
        echo "\n" . $counter++ . ". " . $payment['id'];
}
echo "\nNext Payment ID: ". $json_resp['next_id'];
echo "\nObtaining the next 10 starting from the previous next_id ... \n";
$payment_list_url = $host.'/v1/payments/payment?start_id='.$json_resp['next_id'];
$json_resp = make_get_call($payment_list_url);
echo "Number of Payment resources returned: " . count($json_resp['payments']);
$counter = 0;
foreach ($json_resp['payments'] as $payment) {
        echo "\n" . $counter++ . ". " . $payment['id'];
}
echo "\n \n";
echo "###########################################\n";
echo "Making a Credit Card Authorization... \n";
$url = $host.'/v1/payments/payment';
$payment = array(
                'intent' => 'authorize',
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
                                        'total' => '7.47',
                                        'currency' => 'USD'
                                        ),
                                'description' => 'payment by a credit card using a test script'
                                ))
                );
$json = json_encode($payment);
$json_resp = make_post_call($url, $json);
foreach ($json_resp['links'] as $link) {
        if($link['rel'] == 'self'){
                $payment_detail_url = $link['href'];
                $payment_detail_method = $link['method'];
        }
}
$related_resource_count = 0;
$related_resources = "";
foreach ($json_resp['transactions'] as $transaction) {
        if($transaction['related_resources']) {
                $related_resource_count = count($transaction['related_resources']);
                foreach ($transaction['related_resources'] as $related_resource) {
                        if($related_resource['authorization']){
                                $related_resources = $related_resources."authorization ";
                                $authorization = $related_resource['authorization'];
                                foreach ($authorization['links'] as $link) {
                                        if($link['rel'] == 'self'){
                                                $auth_detail_url = $link['href'];
                                                $auth_detail_method = $link['method'];
                                        }else if($link['rel'] == 'refund'){
                                                $refund_url = $link['href'];
                                                $refund_method = $link['method'];
                                        }else if($link['rel'] == 'void'){
                                                $void_url = $link['href'];
                                                $void_method = $link['method'];
                                        }else if($link['rel'] == 'capture'){
                                                $capture_url = $link['href'];
                                                $capture_method = $link['method'];
                                        }
                                }
                        } else if($related_resource['refund']){
                                $related_resources = $related_resources."refund";
                        }
                }
        }
}
echo "Payment Created successfully: " . $json_resp['id'] ." with state '". $json_resp['state']."'\n";
echo "Payment related_resources:". $related_resource_count . "(". $related_resources.")";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Payment Details... \n";
$json_resp = make_get_call($payment_detail_url);
echo "Payment details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']. "'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Authorization details...\n";
$json_resp = make_get_call($auth_detail_url);
echo "Authorization details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Capturing Authorization ...\n";
$capture = array(
                'amount' => array(
                        'total' => '5.47',
                        'currency' => 'USD'
                        )
               );
$json = json_encode($capture);
$json_resp = make_post_call($capture_url, $json);
echo "Capture processed " . $json_resp['id'] ." with state '". $json_resp['state']."'";
foreach ($json_resp['links'] as $link) {
        if($link['rel'] == 'self'){
                $capture_detail_url = $link['href'];
                $capture_detail_method = $link['method'];
        }else if($link['rel'] == 'refund'){
                    $refund_url = $link['href'];
                    $refund_method = $link['method'];
            }
}
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Authorization details...\n";
$json_resp = make_get_call($auth_detail_url);
echo "Authorization details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Capture details...\n";
$json_resp = make_get_call($capture_detail_url);
echo "Capture details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Refunding a Capture... \n";
$refund = array(
                'amount' => array(
                        'total' => '2.47',
                        'currency' => 'USD'
                        )
               );
$json = json_encode($refund);
$json_resp = make_post_call($refund_url, $json);
echo "Refund processed " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Capture details...\n";
$json_resp = make_get_call($capture_detail_url);
echo "Capture details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Voiding Authorization ...\n";
$void = array();
$json = json_encode($void);
$json_resp = make_post_call($void_url, $json);
echo "Void processed " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining Authorization details...\n";
$json_resp = make_get_call($auth_detail_url);
echo "Authorization details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";
echo "###########################################\n";
echo "Obtaining parent Payment Details for the Authorization ... \n";
$json_resp = make_get_call($payment_detail_url);
$related_resource_count = 0;
$related_resources = "";
foreach ($json_resp['transactions'] as $transaction) {
        if($transaction['related_resources']) {
                $related_resource_count = count($transaction['related_resources']);
                foreach ($transaction['related_resources'] as $related_resource) {
                        if($related_resource['authorization']){
                                $related_resources = $related_resources."authorization ";
                        } else if($related_resource['capture']){
                                $related_resources = $related_resources."capture ";
                        } else if($related_resource['refund']){
	                            $related_resources = $related_resources."refund ";
	                       }
                }
        }
}
echo "Payment details obtained for: " . $json_resp['id'] ." with state '". $json_resp['state']. "' \n";
echo "Payment related_resources:". $related_resource_count . "(". $related_resources.")";
echo "\n \n";
echo "###########################################\n";
echo "Initiating a Payment with PayPal Account... \n";
$url = $host.'/v1/payments/payment';
$payment = array(
                'intent' => 'sale',
                'payer' => array(
                        'payment_method' => 'paypal'
		),
                'transactions' => array (array(
                                'amount' => array(
                                        'total' => '7.47',
                                        'currency' => 'USD'
                                        ),
                                'description' => 'payment using a PayPal account'
                                )),
		'redirect_urls' => array (
			'return_url' => 'http://www.return.com/?test=123',
			'cancel_url' => 'http://www.cancel.com'
		)
                );
$json = json_encode($payment);
$json_resp = make_post_call($url, $json);
foreach ($json_resp['links'] as $link) {
	if($link['rel'] == 'execute'){
		$payment_execute_url = $link['href'];
		$payment_execute_method = $link['method'];
	} else 	if($link['rel'] == 'approval_url'){
			$payment_approval_url = $link['href'];
			$payment_approval_method = $link['method'];
		}
}
echo "Payment Created successfully: " . $json_resp['id'] ." with state '". $json_resp['state']."'\n\n";
echo "Please goto ".$payment_approval_url." in your browser and approve the payment with a PayPal Account.\n";
echo "Enter PayerId from the return url to continue:";
$payerId = read_stdin();
echo "\n \n";
echo "###########################################\n";
echo "Executing the PayPal Payment for PayerId (".$payerId.")... \n";
$payment_execute = array(
		'payer_id' => $payerId
	       );
$json = json_encode($payment_execute);
$json_resp = make_post_call($payment_execute_url, $json);
echo "Payment Execute processed " . $json_resp['id'] ." with state '". $json_resp['state']."'";
echo "\n \n";


 ?>