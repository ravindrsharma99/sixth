<?php

$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
//$paypal_url='https://www.paypal.com/cgi-bin/webscr';// original
$paypal_id='viju25042612@gmail.com'; // Business email ID
?>
<h4>Welcome, Guest</h4>

<div class="product">            
    <div class="image">
        <img src="gang.jpg" />
    </div>
    <div class="name">
         Payment
    </div>
    <div class="price">
        Price:$100
    </div>
    <div class="btn">
    <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="Vijju Payment">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" value="100">
    <input type="hidden" name="cpp_header_image" value="http://www.phpgang.com/wp-content/uploads/gang.jpg">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="http://phphosting.osvin.net/vijju/cancel.php">
    <input type="hidden" name="return" value="http://phphosting.osvin.net/vijju/success.php">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
/////////////////////////////

<!-
a3 - amount to billed each recurrence
p3 - number of time periods between each recurrence
t3 - time period (D=days, W=weeks, M=months, Y=years)




The sample HTML code below illustrates a basic Subscribe button with these features:

    No trial periods
    A subscription price of $5.00 USD
    A monthly billing cycle
    The subscription ends only when the merchant or subscriber cancel it.

->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="alice@mystore.com">

    <!-- Specify a Subscribe button. -->
    <input type="hidden" name="cmd" value="_xclick-subscriptions">
    <!-- Identify the subscription. -->
    <input type="hidden" name="item_name" value="Alice's Weekly Digest">
    <input type="hidden" name="item_number" value="DIG Weekly">

    <!-- Set the terms of the regular subscription. -->
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="a3" value="5.00">
    <input type="hidden" name="p3" value="1">
    <input type="hidden" name="t3" value="M">

    <!-- Set recurring payments until canceled. -->
    <input type="hidden" name="src" value="1">

    <!-- Display the payment button. -->
    <input type="image" name="submit" border="0"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
    <img alt="" border="0" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>
    

<!-
a3 - amount to billed each recurrence
p3 - number of time periods between each recurrence
t3 - time period (D=days, W=weeks, M=months, Y=years)



The sample HTML code below illustrates a Subscribe button that require renewal, with these features:

    A subscription price of $69.95 USD
    A monthly billing cycle
    Expiration after 6 months, requiring renewal


->

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="viju25042612@gmail.com">

    <!-- Specify a Subscribe button. -->
    <input type="hidden" name="cmd" value="_xclick-subscriptions">

    <!-- Identify the subscription. -->
    <input type="hidden" name="item_name" value="Youth Guardian's Monthly Digest">
    <input type="hidden" name="item_number" value="DIG Weekly">

    <!-- Set the terms of the recurring payments. -->
    <input type="hidden" name="a3" value="50">
    <input type="hidden" name="p3" value="1">
    <input type="hidden" name="t3" value="M">

    <!-- Set recurring payments to stop after 12 billing cycles. -->
    <input type="hidden" name="src" value="1">
    <input type="hidden" name="srt" value="12">

    <!-- Display the payment button. -->
    <input type="image" name="submit" border="0"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
    <img alt="" border="0" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>








<!- 
https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/subscribe_buttons/
https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/subscribe_buttons/#id08ADFJ00NC4 
->


<?php
/*

$client = new SoapClient( 'https://www.sandbox.paypal.com/wsdl/PayPalSvc.wsdl',
                           array( 'soap_version' => SOAP_1_1 ));

$cred = array( 'Username' => $username,
               'Password' => $password,
               'Signature' => $signature );

$Credentials = new stdClass();
$Credentials->Credentials = new SoapVar( $cred, SOAP_ENC_OBJECT, 'Credentials' );

$headers = new SoapVar( $Credentials,
                        SOAP_ENC_OBJECT,
                        'CustomSecurityHeaderType',
                        'urn:ebay:apis:eBLBaseComponents' );

$client->__setSoapHeaders( new SoapHeader( 'urn:ebay:api:PayPalAPI',
                                           'RequesterCredentials',
                                           $headers ));

$args = array( 'Version' => '71.0',
               'ReturnAllCurrencies' => '1' );

$GetBalanceRequest = new stdClass();
$GetBalanceRequest->GetBalanceRequest = new SoapVar( $args,
                                                     SOAP_ENC_OBJECT,
                                                     'GetBalanceRequestType',
                                                     'urn:ebay:api:PayPalAPI' );

$params = new SoapVar( $GetBalanceRequest, SOAP_ENC_OBJECT, 'GetBalanceRequest' );

$result = $client->GetBalance( $params );

echo 'Balance is: ', $result->Balance->_, $result->Balance->currencyID;

*/


//https://developer.paypal.com/docs/classic/api/PayPalSOAPAPIArchitecture/

?>

<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:ebay:api:PayPalAPI" xmlns:urn1="urn:ebay:apis:eBLBaseComponents">
   <soapenv:Header>
      <urn:RequesterCredentials>
           <urn1:Credentials>
            <urn1:Username>xxxx</urn1:Username>
            <urn1:Password>xxxx</urn1:Password>
            <urn1:Signature>xxxx</urn1:Signature>
         </urn1:Credentials>
      </urn:RequesterCredentials>
   </soapenv:Header>
   <soapenv:Body>
      <urn:GetBalanceReq>
         <urn:GetBalanceRequest>
            <urn1:Version>83.0</urn1:Version>
            <urn:ReturnAllCurrencies>0</urn:ReturnAllCurrencies>
         </urn:GetBalanceRequest>
      </urn:GetBalanceReq>
   </soapenv:Body>
</soapenv:Envelope>





<SOAP-ENV:Envelope "...">
   <SOAP-ENV:Header>
    "..."
   </SOAP-ENV:Header>
   <SOAP-ENV:Body id="_0">
      <GetBalanceResponse xmlns="urn:ebay:api:PayPalAPI">
         <Timestamp xmlns="urn:ebay:apis:eBLBaseComponents">2011-10-20T17:27:54Z</Timestamp>
         <Ack xmlns="urn:ebay:apis:eBLBaseComponents">Success</Ack>
         <CorrelationID xmlns="urn:ebay:apis:eBLBaseComponents">e6bb1ac6861d7</CorrelationID>
         <Version xmlns="urn:ebay:apis:eBLBaseComponents">83.0</Version>
         <Build xmlns="urn:ebay:apis:eBLBaseComponents">2183220</Build>
         <Balance xsi:type="cc:BasicAmountType" currencyID="USD">0.00</Balance>
         <BalanceTimeStamp xsi:type="xs:dateTime">2011-10-20T17:27:54Z</BalanceTimeStamp>
      </GetBalanceResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>






</div>
</div>
