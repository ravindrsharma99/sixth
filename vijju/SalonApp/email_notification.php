<?php
$sql_1 = "select * from tbl_user where id ='".$user_id."'";
$result2_1 = mysqli_query($con,$sql_1);
while($row12_1 = mysqli_fetch_assoc($result2_1))
{
	   $data_result = $row12_1;
}
 
$sql_doc = "select * from tbl_user where id ='".$doctor_id."'";
$result_doc = mysqli_query($con,$sql_doc);
while($row_doc = mysqli_fetch_assoc($result_doc))
{
	   $data_doc = $row_doc;
}


$fullname=$data_result["fname"].' '.$data_result["lname"];
$patient_name=$data_result['fname'];
if(empty($patient_name))
{
//$patient_email=  $data_result['email'];
//$patient_email=explode("@",$patient_email);
//$patient_name=$patient_email[0];
$patient_name="User";
}else
{
$patient_name=$data_result["fname"].' '.$data_result["lname"];
}


$doc_name=$data_doc["fname"].' '.$data_doc["lname"];
$doc_email=$data_doc["email"];

$to = $data_result['email']; // note the comma
$subject = 'Appointment Confirmation and Prepare for the visit';
$empty=" ";

// message
$time_slot=explode("-",$timeslot);


if(!empty($amount))
{
$ApponttType= '<p>Thank you for booking an e-appointment with Doctor Online! A total of Rs '.$amount.' was billed to your account.</p>';
}else
{
 $ApponttType= '<p>Thank you for booking an e-appointment with Doctor Online! This appointment is free of cost.</p>';
}



$message = '<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
    <title>Newsletter template</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
</head>
<table width="60%" border="0" bgcolor="#04caa9" style="margin:0 auto; float:none;font-family: Open Sans, sans-serif; padding:0 0 10px 0;">
  <tr>
    <th width="20px"></th>
    <th style="padding-top:30px;padding-bottom:30px;"> <img src="http://phphosting.osvin.net/doctorOnline/api/logo2.png"></th>
       <th width="20px"></th>
  </tr>
  <tr>
    <td width="20px"></td>
    <td bgcolor="#fff" style="border-radius:10px;padding:20px;">
<table width="100%;">
  <tr>
    <th style="font-size:20px; font-weight:bolder; text-align:left;padding-bottom:10px;border-bottom:solid 1px #ddd;">Dear '.$patient_name.'</th>
  </tr>
  <tr>
    <td style="font-size:16px;">
'.$ApponttType.'
    <p>Here are the details of your upcoming appointment.</p> 
    </td>
  </tr>
  <tr>
    <td>
    <table bgcolor="#09aa8f" width="100%" style="color:#fff;text-align:center;">
<tr>
<th style="border:solid 1px #aee3da; color:black">Day & Date</th>
<th style="border:solid 1px #aee3da;color:black">Time</th>
<th style="border:solid 1px #aee3da;color:black">Patient Name</th>
<th style="border:solid 1px #aee3da;color:black">Doctor Name</th>
<th style="border:solid 1px #aee3da;color:black">Reason for Visit</th>
</tr>
<tr>
<td style="border:solid 1px #aee3da;">'.date('l', strtotime($slot_date)).' '.date('d M, Y', strtotime($slot_date)).'</td>
<td style="border:solid 1px #aee3da;">'.date('h:i A', strtotime($time_slot[0])).' - '.date('h:i A', strtotime($time_slot[1])).'</td>
<td style="border:solid 1px #aee3da;">'.$patient_name.'</td>
<td style="border:solid 1px #aee3da;">'.$doc_name.'</td>
<td style="border:solid 1px #aee3da;">'.$purpose_of_visit.'</td>
</tr>  
</table>
</td>
  </tr>
<tr><td>You can review your appointment details, cancel your appointment or reschedule by going to the <b>My Appointments</b> section of your Doctor Online app.</td></tr>
  <tr>
<tr><td><b>Please Note: Appointments may be canceled without any charges up to 24 hours prior to the scheduled start time of the appointment.</b></td></tr>
<tr><td><b>Prepare for the Visit:</b> To start, we recommend writing down a few questions or concerns to discuss with your healthcare provider.</td></tr>
<tr><td><b>Mobile Visit:</b><br>
&bull; We recommend that you open your Doctor Online app a few minutes before your appointment is scheduled to begin.<br>
&bull; Connect to WiFi to ensure a stronger connection.</td></tr>
<tr><td><b>Computer Visit:</b><br>
&bull; You must log in at www.doctorinsta.com a few minutes before your appointment begins.<br>
&bull; Be sure you are connected to a strong Internet connection.</td></tr> 
<tr><td>At the start of your appointment you initiate your Video Visit. Just click Start button as it becomes active.</td></tr>
<tr><td>If you have any questions feel free to reply to this email, we are always happy to help!</td></tr>
    <td style="text-align:left; padding:20px;">
   <h1 style="margin:0; font-size:29px;">Thank you!</h1>
<h2 style="margin:0; font-weight:100;">Doctor Online Team<br>
http://phphosting.osvin.net/doctorOnline/testdocotorinsta/<br>
osvin315@gmail.com</h2>
</td>
  </tr>
</table>
  </td>
    <td width="20px"></td>
  </tr>
   <tr>
    <td width="20px"></td>
    <td style="text-align:center; color:#fff; padding:10px;"> Copyright ©'.date("Y").' Doctor Online All Rights Reserved</td>
    <td width="20px"></td>
  </tr>
</table>';


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Osvin <osvinw@gmail.com>'. "\r\n";
$headers .= 'From: Doctor Online <osvin315@gmail.com>' . "\r\n";
$headers .= 'Cc: '.$doc_email.'' . "\r\n";

// Mail it
$email_re=mail($to, $subject, $message, $headers);
?>