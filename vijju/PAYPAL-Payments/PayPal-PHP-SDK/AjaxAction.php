<?php
//if(!isset($_SESSION)){session_start();}
//include("credentials.php"); 
/*
echo '<pre>';
print_r($_POST);die;
*/
if( isset($_POST['action']) && $_POST['action']=="AuthorizePayment")
{

include("PaypalFunctions.php");

$paymentType=$_POST['paymentType'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$expDateMonth=$_POST['expDateMonth'];
$expDateYear=$_POST['expDateYear'];
$cvv2Number=$_POST['cvv2Number'];
$amount=$_POST['amount'];
$currencies=$_POST['currencies'];
$description=$_POST['description'];


$error='';
$Accesstoken=get_access_token();
if($Accesstoken->access_token)
{
}
else{
 $error="Wrong Credentials";
}

$Accesstoken= $Accesstoken->access_token;
$url = $host.'https://api.sandbox.paypal.com/v1/payments/payment';
$payment = array(
        'intent' => $paymentType,
        //'intent' => 'sale',
        'payer' => array(
            'payment_method' => 'credit_card',
            'funding_instruments' => array ( array(
                    'credit_card' => array (
                        'number' => $creditCardNumber,
                        'type'   => $creditCardType,
                        'expire_month' => $expDateMonth,
                        'expire_year' => $expDateYear,
                        'cvv2' => $cvv2Number,
                        'first_name' => $firstName,
                        'last_name' => $lastName
                        )
                    ))
            ),
        'transactions' => array (array(
                'amount' => array(
                    'total' => $amount,
                    'currency' => $currencies
                    ),
                'description' => $description
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
               // print_r($jsonResponse);
                
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

                //print_r($json_resp);

}
else{
          
           if(empty($error))
           { 
          $error="Wrong Payment Details";
           }
}

echo $error;



} ?>