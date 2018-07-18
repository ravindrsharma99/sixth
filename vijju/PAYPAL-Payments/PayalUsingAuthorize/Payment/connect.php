<?php

if(!isset($_SESSION)){ session_start();}
date_default_timezone_set('Asia/Kolkata');
$con=mysqli_connect("localhost","sk_paypal_u1","sk_paypal_u@1","sk_paypal4method");

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 

define("clientId", "AZFqlpZsolsUUC90nz8VPZluK1j6jGQ-lDg_aask3ufW2Ow8JdJSFBLCYgV4Cm2hkDdNqe9LQU64tk14");
define("clientSecret", "EA2BP30oHSglMrrCBPR9fMsyXAC9xTDqE9ZjZl9nSZys4xYkC1oYXDlifBT5Esj1MHb0-UGh2Tjj_-9y");
define("ApiUrl", "https://api.sandbox.paypal.com/");

?> 
