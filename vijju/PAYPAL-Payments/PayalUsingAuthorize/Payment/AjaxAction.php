<?php
//if(!isset($_SESSION)){session_start();}
include("connect.php"); 
include("PaypalFunctions.php");
/*
echo '<pre>';
print_r($_POST);die;
*/
if( isset($_POST['action']) && $_POST['action']=="AuthorizePayment")
   {
                
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
                $url = ApiUrl.'v1/payments/payment';
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

                               $transactionId=$jsonResponse['id'];
                               $state=$jsonResponse['state'];
                               $intent=$jsonResponse['intent'];
                               $amount=$jsonResponse['transactions'][0]['amount']['total'];
                               $currency=$jsonResponse['transactions'][0]['amount']['currency'];
                               $authorizationId=$jsonResponse['transactions'][0]['related_resources'][0]['authorization']['id'];
                               $paymentMethod=$jsonResponse['payer']['payment_method'];
                               $firstName=$jsonResponse['payer']['funding_instruments'][0]['credit_card']['first_name'];
                               $lastName=$jsonResponse['payer']['funding_instruments'][0]['credit_card']['last_name'];
                               $createdTime=$jsonResponse['create_time'];

                                $CaptureURL=$jsonResponse['transactions'][0]['related_resources'][0]['authorization']['links'][1]['href'];
                                $refundURL=$json_resp['links'][1]['href'];
                                
                                $qry = "insert into tbl_Payment_details(AccessToken,transactionId,state,intent,amount,currency,authorizationId,paymentMethod,firstName,lastName,createdTime,captureURL,refundURL) values('$Accesstoken','$transactionId','$state','$intent','$amount','$currency','$authorizationId','$paymentMethod','$firstName','$lastName','$createdTime','$CaptureURL','$refundURL')";
                                    mysqli_query($con,$qry); 
                                    
                                $error='<span style="color:green">Transaction Done Successfully. Your Transaction Id is "'.$transactionId.'"</span>'; 
            }
            else
            {
                      
                       if(empty($error))
                       { 
                      $error="<span style='color:red'>Error in Transaction. Please try Again !</span>";
                       }
            }
            echo $error;
   } 

  if(isset($_POST['action']) && $_POST['action']=="Refund")
   {
    
        $id=$_POST['id'];
        $qry = "select * from tbl_Payment_details where id ='$id'";
        $query=mysqli_query($con,$qry);
        $result = mysqli_fetch_assoc($query);
        //print_r($result);
        $refund_url=$result['refundURL'];
        $currency=$result['currency'];
        $total=$result['amount'];
        $Accesstoken=$result['AccessToken'];
        $description="This is Refund Description";
                         
                          $postdata = array(
                                                'amount' => array (
                                                                        'currency' => $currency,
                                                                        'total'   => $total,
                                                                  ),
                                                'description' => $description
                                                );
                 
                        $json = json_encode($postdata);
                        $jsonResponse = make_post_call_refund($refund_url,$Accesstoken,$json);
                       
                //print_r($jsonResponse);
               if($jsonResponse['state'])
                 {
                                $state=$jsonResponse['state']; 
                                
                                        if($state=="failed")
                                        {
                                           $color="red"; 
                                        }
                                        else
                                        {
                                           $color="green";
                                        }
                                echo "<span style='color:".$color."'>Your Refund is ".$state."</span>";

                }else
                  {
                                
                                if($jsonResponse['message'])
                                {
                                    echo "<span style='color:red'>".$jsonResponse['message']."</span>";
                                } 
                                else
                                {
                                    echo "<span style='color:red'>Error in Refund ! Please try Again</span>";
                                } 
                  } 
   }
  

  if(isset($_POST['action']) && $_POST['action']=="MakeRefundPayment")
   {
    
                    $id=$_POST['TransactionId'];
                    $currency=$_POST['currencies'];
                    $total=$_POST['amount'];
                    $description=$_POST['description'];
                    $qry = "select * from tbl_Payment_details where transactionId ='$id'";
                    $query=mysqli_query($con,$qry);
                    $result = mysqli_fetch_assoc($query);

                if($result['id'])
                    {
                    }
                    else
                    {       
                     echo "<span style='color:red'>Please Enter Valid Transaction Id</span>";
                    die;
                    }

                    //print_r($result);
                    $refund_url=$result['refundURL'];
                    $Accesstoken=$result['AccessToken'];
                    
                                     
                                      $postdata = array(
                                                            'amount' => array (
                                                                                    'currency' => $currency,
                                                                                    'total'   => $total,
                                                                              ),
                                                            'description' => $description
                                                            );
                             
                                     $json = json_encode($postdata);
                                    $jsonResponse = make_post_call_refund($refund_url,$Accesstoken,$json);
                                   
                 //print_r($jsonResponse);
                         if($jsonResponse['state'])
                         {
                          $state=$jsonResponse['state']; 
                          
                                  if($state=="failed")
                                  {
                                     $color="red"; 
                                  }
                                  else
                                  {
                                     $color="green";
                                  }
                          echo "<span style='color:".$color."'>Your Refund is ".$state."</span>";

                         }else
                         {
                                
                                if($jsonResponse['message'])
                                {
                                echo "<span style='color:red'>".$jsonResponse['message']."</span>";
                                } 
                                else
                                {
                                 echo "<span style='color:red'> Error in Refund ! Please try Again</span>";
                                } 
                         } 
   }

 if( isset($_POST['action']) && $_POST['action']=="PaypalPayment")
   {
                
                $firstName=$_POST['firstName'];
                $lastName=$_POST['lastName'];
                $amount=$_POST['amount'];
                $currencies=$_POST['currencies'];
                
                $error='';
                $Accesstoken=get_access_token();
                if($Accesstoken->access_token)
                {
                }
                else{
                 $error="Wrong Client Credentials";
                }

                $Accesstoken= $Accesstoken->access_token;
                $url = ApiUrl.'v1/payments/payment';
                $payment = '{
                                      "intent":"authorize",
                                      "redirect_urls":{
                                      "return_url":"http://phphosting.osvin.net/PaypalUsingAuthorize/AuthorizePayment.php?accesstoken='.$Accesstoken.'",
                                        "cancel_url":"http://phphosting.osvin.net/PaypalUsingAuthorize/cancel.php?cancel=true"
                                      },
                                      "payer":{
                                        "payment_method":"paypal"
                                      },
                                      "transactions":[
                                        {
                                          "amount":{
                                            "total":"'.$amount.'",
                                            "currency":"'.$currencies.'"
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
                    
                    if($jsonResponse['id'])
                    {
                    echo $jsonResponse['links'][1]['href'];
                    }
                    //print_r($jsonResponse);

     } 

?>