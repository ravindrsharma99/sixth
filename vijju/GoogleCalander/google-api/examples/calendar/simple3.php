<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
//require_once '../../src/vendor/autoload.php';
session_start();

//print_r($_SESSION['token']);

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_oauth2_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');
$cal = new Google_CalendarService($client);
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

/*if (isset($_SESSION['token'])) {*/
  $client->setAccessToken('{"access_token":"ya29.Ci9eA-N2z_J8DO46YZtqg05zGWuZGieg5MyTw93JnnRN6WcXaXCKogKvn0eFjH5LWg","token_type":"Bearer","expires_in":3600000,"refresh_token":"1\/Qq6TIBBZk0jtpTmJi1q7adHlxGFmWHQ4ltfPrXywkYc","created":1473843487}');
/*}*/

if ($client->getAccessToken()) {
  //$calList = $cal->calendarList->listCalendarList();
  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


 $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

/*  start code  */
if($client && $cal)
{

			$event = new Google_Event();
			$event->setSummary('Appointment');
			$event->setLocation('Osvin, It-park');
			$start = new Google_EventDateTime();
			$start->setDateTime('2016-09-15T10:00:00.000-07:00');
			$event->setStart($start);
			$end = new Google_EventDateTime();
			$end->setDateTime('2016-09-15T10:25:00.000-07:00');
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