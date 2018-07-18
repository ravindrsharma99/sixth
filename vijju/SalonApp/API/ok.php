<?php
$postdata1 = array(
"method" =>"GET",
"consumer_key" =>"ck_f6399f4a869eab016b6f2a261ff183b35bcf7963",
"consumer_secret" => "cs_bdef844408277f4103596cfd9e381998d658b29d",
"ssl_verify" => "false",
);  
$url1 = "http://phphosting.osvin.net/SalonApp/wc-api/v2/products"; // Add site api url
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
?>
