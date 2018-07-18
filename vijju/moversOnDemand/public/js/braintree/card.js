/* Credit Card Type Check */
function cardValidate()
{
$('#card_number').validateCreditCard(function(result) 
{
var N=$(this).val();
var C=$(this).attr("class");
$(this).attr("class","");
if(result && N.length>0)
{
$(this).addClass(result.card_type.name);
if(result.valid && result.length_valid && result.luhn_valid)
{
$(this).addClass('valid');  
$(this).attr("rel","1");
}
else
{
$(this).attr("rel","0");  
}
}
else
{
$(this).removeClass(C);
}
});
}

$(document).ready(function() 
{
/* Button Enable*/
$("#paymentForm input[type=text]").on("keyup",function()
{
var cardValid=$("#card_number").attr('rel');
var C=$("#card_name").val();
var M=$("#expiry_month").val();
var Y=$("#expiry_year").val();
var CVV=$("#cvv").val();
var expName =/^[a-z ,.'-]+$/i;
var expMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
var expYear = /^16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31$/;
var expCVV=/^[0-9]{3,3}$/;
var cardCheck=$('#card_number').attr("rel");

if(cardValid>0 && expName.test(C) && expMonth.test(M) && expYear.test(Y) && expCVV.test(CVV) && parseInt(cardCheck)>0)
{ 
$('#paymentButton').prop('disabled', false);   
$('#paymentButton').removeClass('disable');
}
else
{
$('#paymentButton').prop('disabled', true);  
$('#paymentButton').addClass('disable'); 
}

});

cardValidate();

/* Card Click */
$("#cards li").click(function(){
    var x=$.trim($(this).html());
    $("#card_number").val(x);
    cardValidate();
})

/*Payment Form */
$("#paymentForm").submit(function() 
{
var datastring = $(this).serialize();
$.ajax({
type: "POST",
url: "cardProcess.php",
data: datastring,
dataType: "json",
beforeSend: function()
{  
$("#paymentButton").val('Processing..')
},
success: function(data) 
{

$.each(data.OrderStatus, function(i,data)
{
var HTML;
if(data)
{
 $("#paymentGrid").slideUp("slow");  
 $("#orderInfo").fadeIn("slow");

if(data.status == '1')
{
HTML="Order <span>"+data.orderID+"</span> has been created successfully."; 
}
else if(data.status == '2')
{
HTML="Transaction has been failed, please use other card."; 
}
else
{
HTML="Card number is not valid, please use other card."; 
}

$("#orderInfo").html(HTML);
}


});


},
error: function(){ alert('error handing here'); }
});
return false;

});

});