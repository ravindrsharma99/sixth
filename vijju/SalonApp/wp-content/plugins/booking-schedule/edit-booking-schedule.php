<?php 
include_once('include/include.php');
?>
		<div class="wrap">
    <?php    echo "<h2>" . __( 'Edit Booking', 'booking_trdom' ) . "</h2>"; ?>

    <?php 
    $editId = $_REQUEST['id'];
    /*upadte the booking schedule*/
    if($_REQUEST['booking_hidden'] ==  'Y'){
    	$booking_time_slot = $_REQUEST['booking_time_slot'];
    	$booking_slot_date = $_REQUEST['booking_slot_date'];
    	$booking_active_status = $_REQUEST['booking_active_status'];

		$table = "tbl_schedule";
		$data_array = array('time_slot' => $booking_time_slot, 'slot_date' => $booking_slot_date,'active_status' => $booking_active_status);
		$where = array('id' =>  $editId);
		$wpdb->update( $table, $data_array, $where );

    }
    /*select the record by the id*/
		
		$editRecords = $wpdb->get_results( "SELECT * FROM tbl_schedule WHERE id ='".$editId."'" );
		$cstId = $editRecords[0]->user_id;
		$brbrId = $editRecords[0]->barber_id;
		$customer_data = get_userdata($cstId);
		$barber_data = get_userdata( $brbrId );
		
     ?>
     
    <form name="booking_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="booking_hidden" value="Y">
        <?php    echo "<h4>" . __( 'Booking Settings', 'booking_trdom' ) . "</h4>"; ?>
        <p><?php _e("User Name: " ); ?><input readonly="readonly" type="text" name="booking_customer_name" value="<?php echo $customer_data->display_name; ?>" size="20"><?php _e(" ex: user_name" ); ?></p>
        <p><?php _e("Barber Name: " ); ?><input readonly="readonly" type="text" name="booking_barber_name" value="<?php echo $barber_data->display_name; ?>" size="20"><?php _e(" ex: barber_name" ); ?></p>
        <p><?php _e("Time Slot: " ); ?><input type="date" name="booking_time_slot" value="<?php echo $editRecords[0]->time_slot; ?>" size="20"><?php _e(" ex: time_slot" ); ?></p>
        <p><?php _e("Slot Date: " ); ?><input type="text" name="booking_slot_date" value="<?php echo $editRecords[0]->slot_date; ?>" size="20"><?php _e(" ex: slot_date" ); ?></p>
        <p><?php _e("Amount: " ); ?><input readonly="readonly" type="text" name="booking_amount" value="<?php echo $editRecords[0]->amount; ?>" size="20"><?php _e(" ex: amount" ); ?></p>
         <p><?php _e("Booking Date: " ); ?><input readonly="readonly" type="text" name="booking_date_booked" value="<?php echo $editRecords[0]->date_booking; ?>" size="20"><?php _e(" ex: date_booking" ); ?></p>
          <p><?php _e("Active Status: " ); ?>
			<select name="booking_active_status">
				<option <?php if($editRecords[0]->active_status == '1'){echo 'selected="selected"';} ?> value="1">Active</option>
				<option <?php if($editRecords[0]->active_status == '0'){echo 'selected="selected"';} ?>  value="0">Deactive</option>
			</select>
          <?php _e(" ex: active_status" ); ?></p>
       <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Edit booking', 'booking_trdom' ) ?>" />
        </p>
    </form>
</div>
	