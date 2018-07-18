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
</html>