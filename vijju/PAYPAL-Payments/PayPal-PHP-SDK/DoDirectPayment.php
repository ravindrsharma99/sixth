<?php

/************************************************************
 This is the main web page for the DoDirectPayment sample.
This page allows the user to enter name, address, amount,
and credit card information. It also accept input variable
paymentType which becomes the value of the PAYMENTACTION
parameter.

************************************************************/
// clearing the session before starting new API Call
session_unset();
?>
<html>
<head>
<title>PayPal Merchant SDK - DoDirectPayment API</title>
<link rel="stylesheet" href="Common/sdk.css"/>
<script class="include" type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>


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
<body>
	<div id="wrapper" style="width:100%; background:pink">
		<center>
		<img src="https://devtools-paypal.com/image/bdg_payments_by_pp_2line.png">
		<div id="header">
			<h3>Authorized Payment</h3>
			<div id="apidetails">Process a credit card payment.</div>
		</div></center>
		<div id="request_form" style="margin-left:670px; padding:5px">		
			<form id="MakePayment" >
				<div class="params">
					<div class="param_value">
					Payment type	<select name="paymentType" id="paymentType">
							<option value="sale" >Sale</option>
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
								<option value="visa" selected="selected">Visa</option>
								<option value="mastercard">MasterCard</option>
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
<option value="USD">USD</option>
<option value="AFN">AFN</option>
<option value="ALL">ALL</option>
<option value="DZD">DZD</option>
<option value="ARS">ARS</option>
<option value="AUD">AUD</option>
<option value="ATS">ATS</OPTION>
 
<option value="BSD">BSD</option>
<option value="BHD">BHD</option>
<option value="BDT">BDT</option>
<option value="BBD">BBD</option>
<option value="BEF">BEF</OPTION>
<option value="BMD">BMD</option>
 
<option value="BRL">BRL</option>
<option value="BGN">BGN</option>
<option value="CAD">CAD</option>
<option value="XOF">XOF</option>
<option value="XAF">XAF</option>
<option value="CLP">CLP</option>
 
<option value="CNY">CNY</option>
<option value="COP">COP</option>
<option value="XPF">XPF</option>
<option value="CRC">CRC</option>
<option value="HRK">HRK</option>
 
<option value="CYP">CYP</option>
<option value="CZK">CZK</option>
<option value="DKK">DKK</option>
<option value="DEM">DEM</OPTION>
<option value="DOP">DOP</option>
<option value="NLG">NLG</OPTION>
 
<option value="XCD">XCD</option>
<option value="EGP">EGP</option>
<option value="EEK">EEK</option>
<option value="EUR" selected>EUR</option>
<option value="FJD">FJD</option>
<option value="FIM">FIM</OPTION>
<option value="GRD">GRD</OPTION>
<option value="HKD">HKD</option>
 
<option value="INR">INR</option>
<option value="NZD">NZD</option>
<option value="RUB">RUB</option>
<option value="SAR">SAR</option>
<option value="SGD">SGD</option>
<option value="SDD">SDD</option>
<option value="AED">AED</option>
<option value="GBP">GBP</option>
<option value="USD">USD</option>
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
				<div id="mesg" style="display:none;">
				<h3 id="mesgerr"></h3>
				</div>						
			</form>
		</div>
	</div>
	<script language="javascript">
		generateCC();




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
                  //alert(data);
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