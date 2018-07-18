<?php
//session_unset();


?>
<html>
<head>
<title>PayPal Merchant SDK - DoDirectPayment API</title>
<link rel="stylesheet" href="Common/sdk.css"/>
<link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />


<script language="JavaScript">
	function generateCC(){
		var cc_number = new Array(16);
		var cc_len = 16;
		var start = 0;
		var rand_number = Math.random();

		switch(document.DoDirectPaymentForm.creditCardType.value)
        {
			case "Visa":
				cc_number[start++] = 4;
				break;
			case "Discover":
				cc_number[start++] = 6;
				cc_number[start++] = 0;
				cc_number[start++] = 1;
				cc_number[start++] = 1;
				break;
			case "MasterCard":
				cc_number[start++] = 5;
				cc_number[start++] = Math.floor(Math.random() * 5) + 1;
				break;
			case "Amex":
				cc_number[start++] = 3;
				cc_number[start++] = Math.round(Math.random()) ? 7 : 4 ;
				cc_len = 15;
				break;
        }

        for (var i = start; i < (cc_len - 1); i++) {
			cc_number[i] = Math.floor(Math.random() * 10);
        }

		var sum = 0;
		for (var j = 0; j < (cc_len - 1); j++) {
			var digit = cc_number[j];
			if ((j & 1) == (cc_len & 1)) digit *= 2;
			if (digit > 9) digit -= 9;
			sum += digit;
		}

		var check_digit = new Array(0, 9, 8, 7, 6, 5, 4, 3, 2, 1);
		cc_number[cc_len - 1] = check_digit[sum % 10];

		document.DoDirectPaymentForm.creditCardNumber.value = "";
		for (var k = 0; k < cc_len; k++) {
		//	document.DoDirectPaymentForm.creditCardNumber.value += cc_number[k];
		}
	}
</script>
</head>
<body onload="GetAllTransactions3()">
	<div id="wrapper" style="width:100%; background:pink">
		<center>
		<img src="https://devtools-paypal.com/image/bdg_payments_by_pp_2line.png">
		<div id="header">
			<h3>Welcome</h3>
			<div id="apidetails">Process a credit card payment.</div>
		</div></center>
		<div align="center" id="request_form" style=" padding:5px">		
				
			<a href=""><div style="height:50px; width:100px; background:green; padding:10px">
			Authorize Payment
			</div>
            </a>
			<br/>
			<a href="">
			<div style="height:50px; width:100px; background:green; padding:10px;">
			Capture an authorized payment
			</div>
            </a>
			<br/>
			<a href="">
			<div style="height:50px; width:100px; background:green; padding:10px">
			Reauthorize a payment
			</div>
            </a>
			<br/>
			<a href="">
			<div style="height:50px; width:100px; background:green; padding:10px;">
			Refund captured payment
			</div>
			</a>

				
		</div>
		<div class="adv-table">
		<div class="table-responsive" id="table-responsive">
		  
			</div>
		</div>
	</div>

<script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/common-scripts.js"></script>

	<script language="javascript">
		

$('#hidden-table-info').dataTable({
"aaSorting": [[1, 'asc']],
         });


function MakePayment() {


//var val=$("#currencies").val();
//alert(val);

var action="AuthorizePayment";
$(".loadermyli").show();
 $.ajax(
             {
                 type: 'post',
                 url: 'AjaxAction.php',
                 data: $('#MakePayment').serialize() + "&action=" + action,  
                 cache:false,
                 success: function(data) 
                 {
                 // alert(data);
                   var data=data.trim();
                     if(data!="") 
                       {
                       $('#mesg').show()
                       $("#mesgerr").html(data);
                       $("#mesgerr").css('color', 'red');
                       
                       }else
                       {
                       $('#mesg').show()
                       $("#mesgerr").html("Payment Done Successfully");
                       $("#mesgerr").css('color', 'green');
                       }   
                   $(".loadermyli").hide();
                 }

                 }); // end ajax  */

}


function GetAllTransactions() {


//var val=$("#currencies").val();
//alert(val);

var action="GetAllTransactions";
$(".loadermyli").show();
 $.ajax(
             {
                 type: 'post',
                 url: 'AjaxAction.php',
                 data: {action : action},  
                 cache:false,
                 success: function(data) 
                 {
                  //alert(data);
                   var data=data.trim();
                     
$('#hidden-table-info').dataTable({
"aaSorting": [[1, 'asc']],
         });


                     if(data!="") 
                       {
                       $("#table-responsive").html(data);
                       }else
                       {
                       }   
                   $(".loadermyli").hide();
                 }

                 }); // end ajax  */

}


	</script>


<style>
th:hover {
    background-color:     rgb(238, 238, 238);

}
.loadermyli {
background-color: rgba(0,  0,  0,  0.5);
height: 100%;
width: 100%;
position:fixed;
top:0;
left:0;
bottom:0;
z-index:9999;
}
    
.loadermyli img{
position:absolute;
left:47%;
top:42%;}

.loadermyli2 {
background-color: rgba(0,  0,  0,  0.5);
height: 100%;
width: 100%;
position:fixed;
top:0;
left:0;
bottom:0;
z-index:9999;
}
    
.loadermyli2 img{
position:absolute;
left:47%;
top:42%;} 

.actions a {
width: 150px;
height: 46px;
background-repeat: no-repeat;
background-size: 150px 46px;
display: block;
text-indent: -9999px;
float: left;
}


}
</style>


<div class="loadermyli" style="display:none;">
  <img class="loadermy_img" src="svg-loaders/oval.svg" width="80" alt="">
</div>
</body>
</html>