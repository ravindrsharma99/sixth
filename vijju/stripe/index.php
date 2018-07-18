<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('stripe-php-3.9.0/vendor/autoload.php');

 Stripe\Stripe::setApiKey("sk_test_2qv0Eb4amJvFknh5FARehelg"); 

// $token=$_REQUEST['stripeToken'];
// $email="Customer for ".$_REQUEST['stripeEmail'];
// $amount = $_REQUEST['amount'];
// $stripeAmount = $amount*100;


// $customer =  \Stripe\Customer::create(array(
//                       "description"   => $email, // $15.00 this time 
//                       "source" => $token // Previously stored, then retrieved
//                       ));

//echo "<pre>";print_r($customer);die;

  // $pay =  \Stripe\Charge::create(array(
  //                     "amount"   => $stripeAmount, // $15.00 this time 
  //                     "currency" => "usd",
  //                     "customer" => $customer->id // Previously stored, then retrieved
  //                     ));
$pay=\Stripe\Token::create(array(
  "card" => array(
    "number" => "4242424242424242",
    "exp_month" => 5,
    "exp_year" => 2019,
    "cvc" => "314"
  )
));
 echo "<pre>";
print_r($pay);die;


    if(isset($pay->balance_transaction))
    {
    	header("Location:https://www.secretflightdeals.com/thanks?success&transaction=".$pay->balance_transaction);
    }else
    {
    	header("Location:https://www.secretflightdeals.com/thanks?transaction-fail");
    }

            // $txnId = $pay->balance_transaction;

?>