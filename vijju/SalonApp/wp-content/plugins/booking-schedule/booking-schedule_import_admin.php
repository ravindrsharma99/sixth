<?php 
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
global $wpdb;

 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Booking schedule</title>
		<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js " type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){
	    	$('#myTable').DataTable();
		});
		</script>
	</head>
	<body>
		<div class="wrap">
		    <?php echo "<h2>" . __( 'Booking schedule', 'booking_schedule_trdom' ) . "</h2>"; ?>
		    <table id="myTable" class="display" border="1" cellpadding="10" cellspacing="10" width="100%">
				<thead>
					<tr>
						<th>User Name</th>
						<th>Barber Name</th>
						<th>Time Slot</th>
						<th>Slot Date</th>
						<th>Amount</th>
						<th>Booking Date</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					// get all record from tb schedule
					$booking_schedule =  $wpdb->get_results($wpdb->prepare("SELECT * FROM tbl_schedule"));
					foreach ($booking_schedule as  $value) {
						$customer_data = get_userdata( $value->user_id );
						$barber_data = get_userdata( $value->barber_id );
						$originalDate = $value->slot_date;
						$newDate = date("jS \of F, Y", strtotime($originalDate));
						?>
						<tr>
							<td><?php echo $customer_data->display_name; ?></td>
							<td><?php echo $barber_data->display_name  ?></td>
							<td><?php echo $value->time_slot; ?></td>
							<td><?php echo $newDate; ?></td>
							<td><?php echo $value->amount; ?></td>
							<td><?php echo $value->date_booking; ?></td>
						</tr>
						<?php }
						?>
				</tbody>
			</table>
		</div>
	</body>
</html>