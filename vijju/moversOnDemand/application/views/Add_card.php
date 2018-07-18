<!-- MAIN CONTENT -->
<div class="container" id="main">
  <div class="row  background_BluRr">
    <div class="col-md-12 col-sm-12">
      <div class="LogOut pull-right"><a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
        <span>Logout</span></a>
      </div>
    </div>
    <!-- CUSTOM COLUMNS -->
    <div class="row show-grid">
      <div class="col-sm-1 col-md-1-offset"></div>
          
      </div>
      <!-- / CUSTOM COLUMNS -->
    </div>
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="Content_WraPper Content_WraPper-inner">
          <div class="heaDiNg_main">
            <h2 class="text-capitalize">Add Card</h2>
          </div>
          
            <!-- <span id="span" style="color:green; text-align:center;"></span> -->
            <span id="error" style="color:red; text-align: center;"></span>
            <div class="row">
            <div class="col-md-12 col-sm-12">
            <div class="EDit_Inputs_wrap eiw-card">
              <div class="EDit_Inputs align_text">
                <h4>Please enter your card details.</h4>
                  <form action="#" method="POST">
                   <div class="form-group">
                      <label>Card Holder Name :</label>
                      <input class="form-control" id="name" name="name" placeholder="Enter Name" type="text">
                  </div>
                  <div class="form-group">
                      <label>Card Number :</label>
                      <input class="form-control num" id="cardno" maxlength="16" name="cardno" placeholder="Enter Card Number" type="text">
                  </div>
                  <div class="form-group">
                      <label>Month :</label>
                      <input class="form-control num" id="month" maxlength="2" name="month" placeholder="MM" type="text">
                  </div>
                  <div class="form-group">
                      <label>Year :</label>
                      <input class="form-control num" id="year" maxlength="4" name="year" placeholder="YYYY" type="text">
                  </div>
                  <div class="form-group">
                      <label>CVV :</label>
                      <input class="form-control num" id="ccv" maxlength="4" name="ccv" placeholder="CVV" type="text">
                  </div>
                  <div class="form-group">
                  <label>yes no</label>
                  <div class="smf-inner-btns none_floating">
<!--                     <img src="<?php echo base_url();?>public/images/movers_reqd_single.png">
 -->                      <label class="switch">
                          <input type="checkbox" value ="1" name="moverRequired" id="movereqred">
                          <span class="slider round"></span>
                      </label>
<!--                       <img src="<?php echo base_url();?>public/images/movers_reqd.png">
 -->                  </div>
                  </div>
                  
                  <div class="CARd_Save">
                    <button type="button" id="cardsubmit">Save</button>
                  </div>
                </form>
                <p>Your payment is handled securely by BrainTree.</p>
              </div>
            </div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>
  $(document).ready(function() {
    $('.num').keypress(function(e) {
      var verified = (e.which == 8 || e.which == undefined || e.which == 0) ? null : String.fromCharCode(e.which).match(/[^0-9]/);
      if (verified) { $('#error').html('Please enter numbers.'); e.preventDefault();}else{
         $('#error').html('');
      }
    });
  });
  $(document).ready(function(){
    $("#name").keypress(function(event){
        var inputValue = event.which;
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
             $('#error').html('Please enter alphabet.');
            event.preventDefault(); 
        }else{
           $('#error').html('');
        }
    });
  });
  function Redirect(){  
    window.location=$base_url+"/mycard"; 
  }
  $('#cardsubmit').click(function(){
    $name = $('#name').val();
    $cardno = $('#cardno').val();
    $month = $('#month').val();
    $year = $('#year').val();
    $ccv = $('#ccv').val();
    $default = 0;
    var clientToken = '<?php echo $token->token; ?>';
    if($name == '' || $cardno == '' || $month == '' || $year == '' || $ccv == '' || clientToken == ''){
      $('#error').html('Please fill card details!');
      return false;
    }else{
      $('#cardsubmit').prop("disabled", true);
      var client = new braintree.api.Client({clientToken: clientToken});
      client.tokenizeCard({
        number: $cardno,
        cardholderName: $name,
        expirationMonth: $month,
        expirationYear: $year,
        cvv: $ccv,
      }, function (err, nonce) {
        console.log(nonce);
        $.ajax({
          method:'POST',
          url:$base_url+"/create",
          data:'payment_method_nonce='+nonce+'&cardno='+$cardno+'&month='+$month+'&year='+$year+'&name='+$name+'&default='+$default,
          success:function(html){
             //console.log(html);
            if(html == 1){
              $('#span').html('Sucessfully Added');
              setTimeout('Redirect()', 3000);
            }else{
              $('#cardsubmit').removeAttr('disabled');
              $('#error').html(html);
            }
          }
        });
      });
    }
  });
</script>