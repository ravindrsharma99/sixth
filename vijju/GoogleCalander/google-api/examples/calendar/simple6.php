<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//http://phphosting.osvin.net/vijju/GoogleCalander/google-api/examples/calendar/simple6.php
//http://stackoverflow.com/questions/21234911/dynamically-authenticate-to-google-calender-using-php-api-using-oauth-2-0 check through curl
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
//require_once '../../src/vendor/autoload.php';   files to be created
session_start();

print_r($_SESSION);
//print_r($_SESSION['oauth_access_token']) ;
$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_oauth2_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');
$cal = new Google_CalendarService($client);
/*if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}*/

	if (isset($authObj)) 
	{
		  	unset($_SESSION['token']);
		  	$client->authenticate($authObj);
			$_SESSION['token'] = $client->getAccessToken();
	 		 header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	}

	if (isset($_SESSION['token'])) 
	{
	  $client->setAccessToken($_SESSION['token']);
	}

	if ($client->getAccessToken()) 
	{
	  $calList = $cal->calendarList->listCalendarList();
	  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


	 $_SESSION['token'] = $client->getAccessToken();
	} else 
	{
	
		  	$authUrl = $client->createAuthUrl();
		 	 //print "<a class='login' href='$authUrl'>Connect Me!</a>";
			//$authUrl = "https://accounts.google.com/o/oauth2/token";
		  	$clienttoken_post = array(
					 //"client_id" => '286068949665-8f28p2bc9jqnhlaouk46mbo7egarlpb8.apps.googleusercontent.com'
				 	 );

		  		//	print_r($authUrl); die;
		  		//"client_secret" => 'kLUi_BWBhdv_RxxkGqstdYbU'

	  		$ch = curl_init($authUrl);

			    //curl_setopt($ch, CURLOPT_URL, $authUrl);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $clienttoken_post);
				curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("application/x-www-form-urlencoded"));
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_VERBOSE, true);

						  		

				// if($client->isAccessTokenExpired()) {  
				//echo 'Access Token Expired'; // debug
				$json_response = curl_exec($ch); // JSON value returned
				curl_close($ch);
				print_r($json_response); die;

				$authObj = json_decode($json_response);
				//print_r($authObj); die;


	}

/*  start code  */
if($client && $cal)
{

			$event = new Google_Event();
			$event->setSummary('Appointment');
			$event->setLocation('Osvin, It-park');
			$start = new Google_EventDateTime();
			$start->setDateTime('2016-09-13T23:00:00.000-06:00');
			$event->setStart($start);
			$end = new Google_EventDateTime();
			$end->setDateTime('2016-09-14T05:00:00.000-06:00');
			$event->setEnd($end);
			$attendee1 = new Google_EventAttendee();
			$email='vishal.bhasin103@gmail.com';
			$attendee1->setEmail($email);
			// ...
			 $attendees = array($attendee1
			                    
			                   );
			$event->attendees = $attendees;
			$createdEvent = $cal->events->insert('primary', $event);

			echo "Event Created";

}

/*stop code*/

?>