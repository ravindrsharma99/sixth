<?php 
/*
Plugin Name: Booking Schedule
Description: This is a display the booking schedule
Author: Gagandeep singh
Version: 1.0
*/

// upcoming all schedule
function upcoming_schedule_admin() {
    include('upcoming-schedule_import_admin.php');
}
function upcoming_schedule_sub_admin_actions() {
	add_menu_page("bookingSchedule","Booking Schedule", 1,"upcomingSchedule","upcoming_schedule_admin");
}
 
add_action('admin_menu', 'upcoming_schedule_sub_admin_actions');

// history all schedule
function history_schedule_admin() {
    include('history-schedule_import_admin.php');
}
function history_schedule_sub_admin_actions() {
	global $submenu;
	add_submenu_page("upcomingSchedule","History", "History",1,"historySchedule","history_schedule_admin");
	$submenu['upcomingSchedule'][0][0] = 'Upcomimg';
}
 add_action('admin_menu', 'history_schedule_sub_admin_actions');


function editBookingSchedule() {
		include('edit-booking-schedule.php');
	}
	function editPageBookingSchedule() {
		  add_submenu_page(NULL,NULL,NULL, 1, "editSchedule", "editBookingSchedule");
	}
	add_action('admin_menu', 'editPageBookingSchedule');



//delete

function deleteBookingSchedule() {
		include('delete-booking-schedule.php');
	}
	function deletePageBookingSchedule() {
		  add_submenu_page(NULL,NULL,NULL, 1, "deleteSchedule", "deleteBookingSchedule");
	}
	add_action('admin_menu', 'deletePageBookingSchedule');





?>

