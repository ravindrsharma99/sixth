<?php 
include_once('include/include.php');
?>
<div class="wrap">
	<?php echo "<h2>" . __( 'History schedule', 'booking_schedule_trdom' ) . "</h2>"; ?>
	<table id="myTable" class="display" border="1" cellpadding="10" cellspacing="10" width="100%">
		<thead>
			<tr>
				<th>User Name</th>
				<th>Barber Name</th>
				<th>Time Slot</th>
				<th>Slot Date</th>
				<th>Amount</th>
				<th>Booking Date</th>
				<th>Action</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
	// get all history from tb schedule
			$booking_schedule =  $wpdb->get_results($wpdb->prepare("SELECT * FROM tbl_schedule  where slot_date < NOW()"));
			foreach ($booking_schedule as  $value) {
				$customer_data = get_userdata( $value->user_id );
				$barber_data = get_userdata( $value->barber_id );
				$originalDate = $value->slot_date;
				$newDate = date("jS \of F, Y", strtotime($originalDate));
				$id = $value->id;
				?>
				<tr>
					<td><?= $customer_data->display_name; ?></td>
					<td><?= $barber_data->display_name  ?></td>
					<td><?= $value->time_slot; ?></td>
					<td><?= $newDate; ?></td>
					<td><?= $value->amount; ?></td>
					<td><?= $value->date_booking; ?></td>
					<td><?= '<a href="'.home_url().'/wp-admin/admin.php?page=editSchedule&id='.$id.'">Edit</a>'; ?>&nbsp;
                      <?= '<a href="'.home_url().'/wp-admin/admin.php?page=deleteSchedule&id='.$id.'">Delete</a>'; ?>
					</td>
					<td><?php if($value->active_status=='0'){ echo 'Deactive';}else{echo 'Active';} ?></td>
				</tr>
				<?php }
				?>
			</tbody>
		</table>
	</div>
