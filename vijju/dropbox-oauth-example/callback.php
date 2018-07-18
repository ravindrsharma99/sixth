<?php

    // Code By Qassim Hassan, wp-time.com

    session_start();

    include "Qassim_HTTP.php";

    $App_Key = "xxx"; // enter your app key

    $App_Secret = "xxx"; // enter your app secret

    $oauth_token_secret = $_SESSION["oauth_token_secret"]; // get user oauth token secret

    $oauth_token = $_SESSION["oauth_token"]; // get user oauth token

    $Header = array("Authorization: OAuth oauth_version=\"1.0\", oauth_signature_method=\"PLAINTEXT\", oauth_consumer_key=\"$App_Key\", oauth_token=\"$oauth_token\", oauth_signature=\"$App_Secret&$oauth_token_secret\"\r\n");

    $Data = 0; // data = 0 because we do not have data

    $JSON = 0; // json = 0 because we do not want json for this operation

    $Method = 1; // method = 1 because we want POST

    $API = Qassim_HTTP($Method, "https://api.dropbox.com/1/oauth/access_token", $Header, $Data, $JSON);

    $Result = explode("&", $API); // convert result to array

    $access_token_secret = str_replace("oauth_token_secret=", "", $Result[0]); // user access token secret

    $access_token = str_replace("oauth_token=", "", $Result[1]); // user access token

    $_SESSION["access_token_secret"] = $access_token_secret; // user access token secret save in session

    $_SESSION["access_token"] = $access_token; // user access token save in session

    header("location: success.php"); // redirect user to succes page

?>