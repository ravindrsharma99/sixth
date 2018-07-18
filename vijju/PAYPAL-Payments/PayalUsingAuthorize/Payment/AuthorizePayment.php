<?php
//session_unset();
include("connect.php"); 

                                      $select_user = "select * from tbl_Payment_details";
                                      $query_user = mysqli_query($con, $select_user);
                                      while ($result_user = mysqli_fetch_assoc($query_user)) 
                                      {
                                          $data[] = $result_user;
                                      }

?>
<html>
<head>
<title>PayPal Merchant SDK - DoDirectPayment API</title>
<link rel="stylesheet" href="Common/sdk.css"/>
<link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
 <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
</head>
<body onload="GetAllTransactions3()">
	<div id="wrapper" style="width:100%; background:pink">
		<center>
		<img src="https://devtools-paypal.com/image/bdg_payments_by_pp_2line.png">
		<div id="header">
			
		</div></center>
		<div align="center" id="request_form" style=" padding:5px">	
		<br><br>	
		Select	Payment Method <select onchange="PaymentType(this.value)"><option value="">-Select-</option>
			<option value="Paypal">Paypal</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Refund">Refund</option>
			</select>
			<form id="MakePayment" style="display:none">
			<h3>Authorized Payment</h3>
			<div id="apidetails">Process a credit card payment.</div>
				<div class="params">
					<div class="param_value">
					Payment type	<select name="paymentType" id="paymentType">
							<!-- <option value="sale" >Sale</option> -->
						<option value="authorize" selected="selected">Authorization</option>
						</select>
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					First name	<input type="text" name="firstName" id="firstName" value=""/>
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Last name	<input type="text" name="lastName" id="lastName" value=""/>
					</div>
				</div>			
				<div class="params">
					<div class="param_value">
					Card type	<select name="creditCardType" id="creditCardType"
							onChange="javascript:generateCC(); return false;">
								<option value="visa" >Visa</option>
								<option value="mastercard" selected="selected">MasterCard</option>
								<option value="discover">Discover</option>
								<option value="amex">American Express</option>
						</select>				
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Card number	<input type="text" size="19" maxlength="19" name="creditCardNumber" id="creditCardNumber"> 
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Expiry date	<select name="expDateMonth" id="expDateMonth">
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<select name="expDateYear" id="expDateYear">					
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017" selected>2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>						
						</select>
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					CVV	<input type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" value="">
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Amount	 <input type="text" size="5" maxlength="7" name="amount" id="amount" value=""> 
					<select style="width:80px" name="currencies" id="currencies">
<option value="USD" selected="">USD</option>
<option value="GBP">GBP</option>
<option value="EUR" >EUR</option>
<option value="CAD">CAD</option>
<option value="JPY">JPY</option>
</select>

					</div>
				</div>		
				<div class="params">
					<div class="param_value">
					Description	<input type="text" id="description">
					</div>
				</div>		
				<!-- <div class="section_header">Billing address</div>
				<div class="params">
					<div class="param_value">
					Address 1	<input type="text" size="25" maxlength="100" name="address1" value="">
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Address 2 (optional)	<input type="text" size="25" maxlength="100" name="address2" value="">
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					City	<input type="text" size="25" maxlength="40" name="city" value="">
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					State	<select id=state name="state">
							<option value=""></option>
							<option value="AK">AK</option>
							<option value="AL">AL</option>
							<option value="AR">AR</option>
							<option value="AZ">AZ</option>
							<option value="CA" >CA</option>
							<option value="CO">CO</option>
							<option value="CT">CT</option>
							<option value="DC">DC</option>
							<option value="DE">DE</option>
							<option value="FL">FL</option>
							<option value="GA">GA</option>
							<option value="HI">HI</option>
							<option value="IA">IA</option>
							<option value="ID">ID</option>
							<option value="IL">IL</option>
							<option value="IN">IN</option>
							<option value="KS">KS</option>
							<option value="KY">KY</option>
							<option value="LA">LA</option>
							<option value="MA">MA</option>
							<option value="MD">MD</option>
							<option value="ME">ME</option>
							<option value="MI">MI</option>
							<option value="MN">MN</option>
							<option value="MO">MO</option>
							<option value="MS">MS</option>
							<option value="MT">MT</option>
							<option value="NC">NC</option>
							<option value="ND">ND</option>
							<option value="NE">NE</option>
							<option value="NH">NH</option>
							<option value="NJ">NJ</option>
							<option value="NM">NM</option>
							<option value="NV">NV</option>
							<option value="NY">NY</option>
							<option value="OH">OH</option>
							<option value="OK">OK</option>
							<option value="OR">OR</option>
							<option value="PA">PA</option>
							<option value="RI">RI</option>
							<option value="SC">SC</option>
							<option value="SD">SD</option>
							<option value="TN">TN</option>
							<option value="TX">TX</option>
							<option value="UT">UT</option>
							<option value="VA">VA</option>
							<option value="VT">VT</option>
							<option value="WA">WA</option>
							<option value="WI">WI</option>
							<option value="WV">WV</option>
							<option value="WY">WY</option>
							<option value="AA">AA</option>
							<option value="AE">AE</option>
							<option value="AP">AP</option>
							<option value="AS">AS</option>
							<option value="FM">FM</option>
							<option value="GU">GU</option>
							<option value="MH">MH</option>
							<option value="MP">MP</option>
							<option value="PR">PR</option>
							<option value="PW">PW</option>
							<option value="VI">VI</option>
						</select>
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Zip code	<input type="text" size="10" maxlength="10" name="zip" value="95131"> (5 or 9 digits)
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Country	<input type="text" size="10" maxlength="10" name="country" value="US">
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					Phone	<input type="text" size="10" maxlength="10" name="phone" value="">
					</div>
				</div>
				<div class="params">
					<div class="param_value">
					IPN listener URL	<input type="text" size="80" maxlength="200" name="notifyURL" value="">
					</div>
				</div> -->
				
				<div class="params">
					<div class="param_name"></div>
					<div class="param_value">
					</div>
				</div>
				<div class="submit">
					<input type="button" id="DoDirectPaymentBtn" onclick="MakePayment()" value="Make Payment" />
				</div>	
			</form>
			<form id="MakePaymentPaypal" style="display:none">
			<h3>Paypal Payment</h3>
			<div id="apidetails">Process a Paypal payment.</div>
     				<div class="params">
					<div class="param_value">
					Amount*	 <input type="text" size="5" maxlength="7" name="amount" id="amount" value=""> 
					<select style="width:80px" name="currencies" id="currencies">
								<option value="USD" selected="">USD</option>
								<option value="GBP">GBP</option>
								<option value="EUR" >EUR</option>
								<option value="CAD">CAD</option>
								<option value="JPY">JPY</option>
                   </select>
					</div>
				</div>		
				<div class="params">
					<div class="param_name"></div>
					<div class="param_value">
					</div>
				</div>
				<div class="submit">
					<input type="button" id="DoDirectPaymentBtnPaypal" onclick="MakePaymentPaypal()" value="Make Payment" />
				</div>	
			</form>
			<form id="MakeRefundPayment" style="display:none" >
			<h3>Refund Payment</h3>
				<div class="params">
					<div class="param_value">
					Transaction Id	<input type="text" name="TransactionId" id="TransactionId" value=""/>
					</div>
				</div>			
				<div class="params">
					<div class="param_value">
					Amount	 <input type="text" size="5" maxlength="7" name="amount" id="amount" value=""> 
					<select style="width:80px" name="currencies" id="currencies">
<option value="USD" selected="">USD</option>
<option value="GBP">GBP</option>
<option value="EUR" >EUR</option>
<option value="CAD">CAD</option>
<option value="JPY">JPY</option>
</select>
					</div>
				</div>		
				<div class="params">
					<div class="param_value">
					Description	<input type="text" id="description">
					</div>
				</div>		
				<div class="params">
					<div class="param_name"></div>
					<div class="param_value">
					</div>
				</div>
				<div class="submit">
					<input type="button"  onclick="MakeRefundPayment()" value="Make Refund" />
				</div>	
			</form>
			<div id="mesg" style="display:;">
				<h3 id="mesgerr">
					<?php include("success.php"); ?>
				</h3>
		</div>	
		</div>
		<div class="adv-table">
		<div class="table-responsive" id="table-responsive">
		   <table cellpadding="0" cellspacing="0" border="1" class="display table table-bordered" id="hidden-table-info">
				<thead >
					<tr>
						<th>S No.</th>
						<th>Customer Name</th>
						<th>Transaction Id</th>
						<th>State</th>
						<th>Intent</th>
						<th>Amount</th>
						<th>Currency</th>
						<th>Authorization Id</th>
						<th>Payment Method</th>
                           <th>Action</th>
					</tr>
				</thead>
				<tbody id="tblbody">
<?php 

$x=1;
foreach($data as $data)
{
				
$refund='';
if(empty($data['refundURL']))
{
$refund='disabled';
}

	echo "<tr class='gradeX'><td>$x</td><td>$data[firstName] $data[lastName]</td><td>$data[transactionId]</td><td>$data[state]</td><td>$data[intent]</td><td>$data[amount]</td><td>$data[currency]</td><td>$data[authorizationId]</td><td>$data[paymentMethod]</td><td><input $refund onclick='refund($data[id])' type='button' value='Refund'/></td></tr>";              
	$x++;   

}
?>
				</tbody>
			</table>
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
"aaSorting": [[0, 'asc']],
         });



//  For Credit Card Payment  

function MakePayment() {
var data='';
$("#mesgerr").html(data);
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
                       }else
                       {
                       $('#mesg').show()
                       $("#mesgerr").html("<span style='color:red'>Error in Transaction ! Please try Again</span>");
                       }   
                   $(".loadermyli").hide();
                 }

                 }); // end ajax  */

}


//  For Refund From Transaction Table  

function refund(id) 
{
var data='';
$("#mesgerr").html(data);

var action="Refund";
var id=id;

$(".loadermyli").show();
 $.ajax(
             {
                 type: 'post',
                 url: 'AjaxAction.php',
                 data: {action : action, id : id},  
                 cache:false,
                 success: function(data) 
                 {
                  //alert(data);
                   var data=data.trim();
                     if(data!="") 
                       {
                       $('#mesg').show()
                       $("#mesgerr").html(data);
                       $("#mesgerr").css('color', 'green');
                       
                       }else
                       {
                       $('#mesg').show()
                       $("#mesgerr").html("Error in Refund ! Please try Again");
                       $("#mesgerr").css('color', 'red');
                       }   
                   $(".loadermyli").hide();
                 }

                 }); // end ajax  */

}

 
//  For Refund From Form by Transaction Id

  function MakeRefundPayment()
{

var data='';
$("#mesgerr").html(data);

var action="MakeRefundPayment";

$(".loadermyli").show();
 $.ajax(
             {
                 type: 'post',
                 url: 'AjaxAction.php',
                 data: $('#MakeRefundPayment').serialize() + "&action=" + action,
                 cache:false,
                 success: function(data) 
                 {
                  //alert(data);
                   var data=data.trim();
                     if(data!="") 
                       {
                       $('#mesg').show()
                       $("#mesgerr").html(data);
                       $("#mesgerr").css('color', 'green');
                       
                       }else
                       {
                       $('#mesg').show()
                       $("#mesgerr").html("Error in Refund ! Please try Again");
                       $("#mesgerr").css('color', 'red');
                       }   
                   $(".loadermyli").hide();
                 }

                 }); // end ajax  */

}


//For Payment Through Paypal
function MakePaymentPaypal() {
var data='';
$("#mesgerr").html(data);

var action="PaypalPayment";
$(".loadermyli").show();
 $.ajax(
             {
                 type: 'post',
                 url: 'AjaxAction.php',
                 data: $('#MakePaymentPaypal').serialize() + "&action=" + action,  
                 cache:false,
                 success: function(data) 
                 {
                  //alert(data);
                   var data=data.trim();
                     if(data!="") 
                       {
                       
                        window.location=data;
                       //window.open(data, '_blank');

                       }else
                       {
                       $('#mesg').show()
                       $("#mesgerr").html("<span style='color:red'>Error in Transaction ! Please try Again</span>");
                       }   
                   $(".loadermyli").hide();
                 }

                 }); // end ajax  */
}


//For Payment Type Selected from select box 

function PaymentType(val) 
{

		var data='';
		$("#mesgerr").html(data);

			$('#mesg').hide();
		if(val=="Credit Card")
		{
		 
		$("#MakeRefundPayment").hide();
		    $("#MakePaymentPaypal").hide();
			$("#MakePayment").show();
		}
		if(val=="Paypal")
		{
			$("#MakeRefundPayment").hide();
		    $("#MakePayment").hide();
			$("#MakePaymentPaypal").show();
		}
		if(val=="Refund")
		{
		    $("#MakePayment").hide();
			$("#MakePaymentPaypal").hide();
			$("#MakeRefundPayment").show();
		}


}
	</script>

<!--  Css For Loading IMAGE  -->
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

<!--  DIV For Loading IMAGE  -->
<div class="loadermyli" style="display:none;">
  <img class="loadermy_img" src="svg-loaders/oval.svg" width="80" alt="">
</div>
</body>
</html>