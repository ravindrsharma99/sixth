<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");
print_r($_SESSION);
// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_oauth2_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');
$cal = new Google_CalendarService($client);
//$client->setAccessType('offline');
/*if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}*/

/*if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}*/

/*if (isset($authObj)) {
  $client->authenticate($authObj);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}*/

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken())
 {
	  $calList = $cal->calendarList->listCalendarList();
	  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";

	$_SESSION['token'] = $client->getAccessToken();
 } 	else {
  			$authUrl = $client->createAuthUrl();
			  // print "<a class='login' href='$authUrl'>Connect Me!</a>";
			  //$oauth2token_url = "https://accounts.google.com/o/oauth2/token";
			 $clienttoken_post = array(
			 "client_id" => '286068949665-8f28p2bc9jqnhlaouk46mbo7egarlpb8.apps.googleusercontent.com',
			 "client_secret" => 'kLUi_BWBhdv_RxxkGqstdYbU');


			 	//$curl = curl_init($authUrl); 

				/*$curl = curl_init();

		    curl_setopt($curl, CURLOPT_URL, '$authUrl');
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
			curl_setopt ($curl, CURLOPT_HTTPHEADER, Array("application/x-www-form-urlencoded"));
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			// if($client->isAccessTokenExpired()) {  
			//echo 'Access Token Expired'; // debug
			$json_response = curl_exec($curl); // JSON value returned
			curl_close($curl);
			$authObj = json_decode($json_response);*/
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
			$end->setDateTime('2016-09-14T05:00:00.000-06	:00');
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