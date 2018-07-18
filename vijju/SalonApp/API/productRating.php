<?php 
$data = '{
  "order": {
    "payment_details": {
      "method_id": "swdfsd",
      "method_title": "Direct Bank Transfer1",
      "paid": true
    },
    "billing_address": {
      "first_name": "Joasdhn",
      "last_name": "asd",
      "address_1": "969 Market",
      "address_2": "",
      "city": "San Francisco",
      "state": "CA",
      "postcode": "94103",
      "country": "US",
      "email": "john.doe@example.com",
      "phone": "(555) 555-5555"
    },
    "shipping_address": {
      "first_name": "xadasd",
      "last_name": "asdas",
      "address_1": "969 Market",
      "address_2": "",
      "city": "San Francisco",
      "state": "CA",
      "postcode": "94103",
      "country": "US"
    },
    "customer_id": 31,
    "line_items": [
      {
        "product_id": 87,
        "quantity": 1
      },
      {
        "product_id": 89,
        "quantity": 1,
        "variations": {
          "pa_color": "Black"
        }
      }
    ],
    "shipping_lines": [
      {
        "method_id": "flat_rate",
        "method_title": "Flat Rate",
        "total": 10
      }
    ]
  }
}';                                                                    
//$data_string = json_encode($data);                                                                                   
                                                                                                                     
$ch = curl_init('http://phphosting.osvin.net/SalonApp/wc-api/v3/order/?oauth_consumer_key=ck_f6399f4a869eab016b6f2a261ff183b35bcf7963');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json');                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);
print_r($result);
 ?>