<?php

	// Code By Qassim Hassan, wp-time.com
	
	session_start();

    include "Qassim_HTTP.php";

    $App_Key = "xxx"; // enter your app key

    $App_Secret = "xxx"; // enter your app secret

    $access_token_secret = $_SESSION["access_token_secret"]; // get user access token secret

    $access_token = $_SESSION["access_token"]; // get user access token

	$Header = array("Authorization: OAuth oauth_version=\"1.0\", oauth_signature_method=\"PLAINTEXT\", oauth_consumer_key=\"$App_Key\", oauth_token=\"$access_token\", oauth_signature=\"$App_Secret&$access_token_secret\"\r\n");

	$Data = 0; // data = 0 because we do not have data

	$JSON = 1; // json = 1 because we want json for this operation

	$Method = 0; // method = 0 because we want GET

	$API = Qassim_HTTP($Method, "https://api.dropbox.com/1/account/info", $Header, $Data, $JSON);

	$Result = $API; // user info result

	echo $Result["display_name"]." - ".$Result["email"]; // display user full name and email!

?>