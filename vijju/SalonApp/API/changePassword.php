<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
global $wpdb;


$user_id = $_REQUEST['user_id'];
$password = $_REQUEST['password'];
wp_set_password( $password,$user_id) 


?>
 