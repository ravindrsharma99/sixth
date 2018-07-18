<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'DeveloperAccountEmail' => $developer_account_email, 'ApplicationID' => $application_id, 'DeviceID' => $device_id, 
						'IPAddress' => $device_ip_address, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature, 'APISubject' => $api_subject);
$PayPal = new PayPal_Adaptive($PayPalConfig);

// Prepare request arrays
$GetVerifiedStatusFields = array(
								'EmailAddress' => '', 					// Required.  The email address of the PayPal account holder.
								'FirstName' => '', 						// The first name of the PayPal account holder.  Required if MatchCriteria is NAME
								'LastName' => '', 						// The last name of the PayPal account holder.  Required if MatchCriteria is NAME
								'MatchCriteria' => ''					// Required.  The criteria must be matched in addition to EmailAddress.  Currently, only NAME is supported.  Values:  NAME, NONE   To use NONE you have to be granted advanced permissions
								);

$PayPalRequestData = array('GetVerifiedStatusFields' => $GetVerifiedStatusFields);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->GetVerifiedStatus($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>