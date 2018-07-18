<?php
/*
 *	$Id: wsdlclient3c.php,v 1.2 2004/10/01 19:57:20 snichol Exp $
 *
 *	WSDL client sample.
 *
 *	Service: WSDL
 *	Payload: rpc/literal
 *	Transport: http
 *	Authentication: none
 */
include("../../loveandloss/wp-config.php");


if(!isset($_SESSION)){ session_start();}
$con=mysqli_connect("localhost",DB_USER,DB_PASSWORD,DB_NAME);

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


 

?> 
