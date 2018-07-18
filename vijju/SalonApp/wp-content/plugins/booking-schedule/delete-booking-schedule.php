<?php 
include_once('include/include.php');
?>
    <?php 
//delete-booking-schedule.php
    $deleteId = $_REQUEST['id'];
    /*delete the booking schedule*/
		$table = "tbl_schedule";
		$where = array('id' =>  $deleteId);
		$delete=$wpdb->delete( $table, $where );
//$delete=$wpdb->get_results($wpdb->prepare("DELETE  FROM tbl_schedule  where id=$deleteId"));
if($delete)
{
wp_redirect( "admin.php?page=historySchedule");

}
  ?> 
