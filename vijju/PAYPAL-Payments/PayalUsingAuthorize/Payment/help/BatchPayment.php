
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


echo "||||||||||||||||||||||||||||||||||||||||Mass Payment|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||\n";

			    
              
				$url="https://api.sandbox.paypal.com/v1/payments/payouts";
			   $batchId=uniqid();

			   $postdata = '{
								    "sender_batch_header": {
								        "sender_batch_id": "'.$batchId.'",
								        "email_subject": "You have a payment",
                                        "recipient_type": "EMAIL"
								    },
								    "items": [
								        {
								            "recipient_type": "EMAIL",
								            "amount": {
								                "value": 0.99,
								                "currency": "USD"
								            },
								            "receiver": "shirt-supplier-one@mail.com",
								            "note": "Thank you.",
								            "sender_item_id": "item_1"
								        },
								        {
								            "recipient_type": "EMAIL",
								            "amount": {
								                "value": 0.90,
								                "currency": "USD"
								            },
								            "receiver": "shirt-supplier-two@mail.com",
								            "note": "Thank you.",
								            "sender_item_id": "item_2"
								        },
								        {
								            "recipient_type": "EMAIL",
								            "amount": {
								                "value": 2.00,
								                "currency": "USD"
								            },
								            "receiver": "shirt-supplier-three@mail.com",
								            "note": "Thank you.",
								            "sender_item_id": "item_3"
								        }
								    ]
							}';
                 
              
				$json_resp = make_post_call($url,$Accesstoken,$postdata);

				echo "<pre>";
				print_r($json_resp);
                echo $json_resp['links'][0]['href'];


 ?>