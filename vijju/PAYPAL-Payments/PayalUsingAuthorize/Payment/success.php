<body style="background:pink">
<?php

if( isset($_REQUEST['paymentId']) && !empty($_REQUEST['paymentId']))
{
include("PaypalFunctions.php");
$transactionId=$_REQUEST['paymentId'];
$Accesstoken=$_REQUEST['accesstoken'];
$PayerID=$_REQUEST['PayerID'];

$url=ApiUrl."v1/payments/payment/$transactionId/execute";
$payment = '{ "payer_id" : "'.$PayerID.'" }';
$jsonResponse=make_post_call($url,$Accesstoken,$payment);


                         if($jsonResponse['id'])
                            { 

                              echo "<h2 align='center' style='color:green'>Transaction Done Sucessfully</h2>";
                                echo '<h2 align="center" style="color:green">Your Transaction Id is "'. $transactionId .'"</h2>';
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
                               $transactionId=$jsonResponse['id'];
                               $state=$jsonResponse['state'];
                               $intent=$jsonResponse['intent'];
                               $amount=$jsonResponse['transactions'][0]['amount']['total'];
                               $currency=$jsonResponse['transactions'][0]['amount']['currency'];
                               $authorizationId=$jsonResponse['transactions'][0]['related_resources'][0]['authorization']['id'];
                               $paymentMethod=$jsonResponse['payer']['payment_method'];
                               $firstName=$jsonResponse['payer']['payer_info']['first_name'];
                               $lastName=$jsonResponse['payer']['payer_info']['last_name'];
                               $createdTime=$jsonResponse['create_time'];

                               $CaptureURL=$jsonResponse['transactions'][0]['related_resources'][0]['authorization']['links'][1]['href'];
                               $refundURL=$json_resp['links'][1]['href'];

                               $qry = "insert into tbl_Payment_details(AccessToken,transactionId,state,intent,amount,currency,authorizationId,paymentMethod,firstName,lastName,createdTime,captureURL,refundURL) values('$Accesstoken','$transactionId','$state','$intent','$amount','$currency','$authorizationId','$paymentMethod','$firstName','$lastName','$createdTime','$CaptureURL','$refundURL')";
                                    mysqli_query($con,$qry);
                             }else
                             {
                               // echo "<span align='center' style='color:red'>Sometihing Went Wrong</span>";	
                             }

}
else
{
//echo "<h2 align='center' style='color:red'>Sometihing Went Wrong</h2>";	
}
?> 
</body>