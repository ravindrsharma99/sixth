<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once 'vendor/autoload.php'; 


/*
  $client = new Google_Client();

  $client->setApplicationName("Client_Library_Examples");

  $client->setDeveloperKey("YOUR_APP_KEY");

  $service = new Google_Service_Books($client);*/

 $client = new Google_Client();
        $client->setApplicationName("Google Calendar PHP Starter Application");
        $client->setClientId('');
        $client->setClientSecret('');
        $client->setRedirectUri('worked.html'); //I made a file called "worked.html" in the same directory that just says "it worked!"
        $client->setDeveloperKey('SecretLongDeveloperKey');
        $cal = new Google_CalendarService($client);

if (isset($_GET['logout'])) {
    unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
}

$authUrl = $client->createAuthUrl();

 if (!$client->getAccessToken()){

    $event = new Google_Event();

        $event->setSummary('Halloween');
        $event->setLocation('The Neighbourhood');
        $start = new Google_EventDateTime();
        $start->setDateTime('2012-10-31T10:00:00.000-05:00');
        $event->setStart($start);
        $end = new Google_EventDateTime();
        $end->setDateTime('2012-10-31T10:25:00.000-05:00');
        $event->setEnd($end);
        $createdEvent = $cal->events->insert('secretLongCalendarId@group.calendar.google.com', $event);

}


echo $createdEvent->getId();

?>

?>