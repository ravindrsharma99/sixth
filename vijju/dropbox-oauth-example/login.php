<?php

	// Code By Qassim Hassan, wp-time.com
	
	session_start();

	include "Qassim_HTTP.php";

	$App_Key = "5kjdm3gkg8c80t2"; // enter your app key

	$App_Secret = "tnyfgi54i5u2dii"; // enter your app secret

	$Header = array("Authorization: OAuth oauth_version=\"1.0\", oauth_signature_method=\"PLAINTEXT\", oauth_consumer_key=\"$App_Key\", oauth_signature=\"$App_Secret&\"\r\n");

	$Data = 0; // data = 0 because we do not have data

	$JSON = 0; // json = 0 because we do not want json for this operation

	$Method = 1; // method = 1 because we want POST

	$API = Qassim_HTTP($Method, "https://api.dropbox.com/1/oauth/request_token", $Header, $Data, $JSON);

	$Result = explode("&", $API); // convert result to array

	$oauth_token_secret = str_replace("oauth_token_secret=", "", $Result[0]); // user oauth token secret

	$oauth_token = str_replace("oauth_token=", "", $Result[1]); // user oauth token

	$_SESSION["oauth_token_secret"] = $oauth_token_secret; // user oauth token secret save in session

	$_SESSION["oauth_token"] = $oauth_token; // user oauth token save in session

	$callback_url = "phphosting.osvin.net/vijju/dropbox-oauth-example/callback.php"; // enter your callback link

	$authorize_url = "https://www.dropbox.com/1/oauth/authorize?oauth_token=$oauth_token&oauth_callback=$callback_url";

	header("location: $authorize_url"); // redirect user to authorize page

?>