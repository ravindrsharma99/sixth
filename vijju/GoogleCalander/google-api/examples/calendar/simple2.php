<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();

print_r($_SESSION);

$event = new Google_Event();
$event->setSummary('Appointment');
$event->setLocation('Somewhere');
$start = new Google_EventDateTime();
$start->setDateTime('2011-06-03T10:00:00.000-07:00');
$event->setStart($start);
$end = new Google_EventDateTime();
$end->setDateTime('2011-06-03T10:25:00.000-07:00');
$event->setEnd($end);
$attendee1 = new Google_EventAttendee();
$attendee1->setEmail('attendeeEmail');
// ...
$attendees = array($attendee1,
                   // ...
                  );
$event->attendees = $attendees;
$createdEvent = $service->events->insert('primary', $event);

echo $createdEvent->getId();

?>