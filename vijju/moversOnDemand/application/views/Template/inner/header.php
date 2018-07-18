<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- style -->
    <link href="<?php echo base_url();?>public/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/css/bootstrap.min.css" rel="stylesheet">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,200i,300,400,500,500i,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-material-datetimepicker.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('/public/js/myscript.js'); ?>"></script>
    
    <script type="text/javascript" src="<?php echo base_url('/public/js/time/jquery-1.9.0.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/public/js/time/jstz-1.0.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/public/js/time/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/public/js/time/moment-timezone.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/public/js/time/moment-timezone-data.js'); ?>"></script>
    </head>

<body onload="MoveListing(type = 1 ,id =<?php print_r($_SESSION['user_details']->id);?>)">
<script type="text/javascript">
    $(document).ready(function() {      
    var tz = jstz.determine();
    var timezone = tz.name();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>App/timezone',
        data:'time='+timezone,
        success:function(result){
            console.log(result);
        }
    });       
    //var current_time =  moment().tz(timezone).format('MMMM Do YYYY, h:mm:ss a');  ////  // display current time based on user location
    // alert(timezone);
    });
</script>

<?php 
//set timeout period in seconds
$idleTime= 60*2;
//check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeoout'])){
    $fe = date('Y-m-d H:i:s');
    $session_life = strtotime($fe) - $_SESSION['timeoout'];
    if($session_life > $idleTime){
        echo "<a href='".base_url()."'>Click here</a>";
    }
}

?>