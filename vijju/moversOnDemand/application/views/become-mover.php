<!-- <?php
//echo"<pre>"; print_r($data);die;?>  -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Become a Mover</title>
  <!-- style -->
  <link href="<?php echo base_url("public/css/custom.css")?>" rel="stylesheet">
  <link href="<?php echo base_url("public/css/bootstrap.min.css")?>" rel="stylesheet">
  <!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,200i,300,400,500,500i,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">


</head>

<body>
    <section class="banner banner-book-mover">
        <header>
            <div class="container-fluid">
                <div class="ADd_padding">
                    <div class="col-md-12 col-sm-12">
                        <div class="navigation">
                            <div class="navbar-header">
                                <button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle" data-target="#bs-navbar" data-toggle="collapse" type="button">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="../" class="navbar-brand"><img src="images/logo.png" alt="#" class="img-responsive"></a>
                            </div>
                            <nav class="collapse navbar-collapse" id="bs-navbar">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li>
                                        <a href="#">
                                            <button type="button">Become a Mover</button>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
                <h2 align="center" style="color: red"><?php echo $this->session->flashdata('signup'); ?></h2>
                 <h2 align="center" style="color: red"><?php echo $this->session->flashdata('no'); ?></h2>
                 <h2 align="center" style="color: red"><?php echo $this->session->flashdata('already'); ?></h2> 

         
        <div class="header-caption-bm"> <div class="container-fluid">
                <div class="ADd_padding">
                    <h1>Become  <b>a Mover</b></h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris ni</p>




                </div></div></div>
        </section>



            <div class="bm-steps-section"><div class="container-fluid">
              <div class="ADd_padding"><!-- Nav tabs -->

                <div class="row"><div class="col-sm-10 col-sm-offset-1"><div class="bmss-inner-wrap">


                  <ul class="nav nav-tabs" role="tablist">


                    <li class="nav-item active">
                   <a class="nav-link" data-toggle="tab" href="#home" role="tab"><h1>Step <span class="NUmber_Font">1</span></h1><p>Enter your <b>Personal Details</b> here</p></a>
                    </li>


                    <li class="nav-item">
                      <a class="nav-link" href="#profile" data-toggle="tab"  role="tab"><h1>Step <span class="NUmber_Font">2</span></h1><p>Enter your <b>Account Details</b> here</p></a>
                    </li>


                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab" href="" role="tab"><h1>Step <span class="NUmber_Font">3</span></h1><p>Enter your <b>Vehicle Details</b> here</p></a>
                    </li>

                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel"><div class="EDit_Inputs">
                      <form method="POST"  action="<?php base_url('Driver/signup');?>" enctype="multipart/form-data">


                        <div class="form-group">
                          <label>Profile Image :</label>

                          <div class="upload-pic" id="aaa">
                          <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                          <div class="upload-btn-wrap">
                          <div class="upload-btn">
                          <input type="file"  name="profile_pic" onchange="readURL(this,'blah1','aaa');"  >
                          <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive ">
                          </div>
                          </div>
                          </div>

                           <img id="blah1" class="blah1" src="#" alt="your image" style="display:none" />
                        </div>


                        <div class="form-group">
                          <label>Full Name :</label>
                          <input class="form-control" id="fname" placeholder="Full Name" name="fname" type="text" required="">
                        </div>

                        <div class="form-group">
                          <label>Last Name :</label>
                          <input class="form-control" id="lname" placeholder="Last Name" name="lname" type="text" required="">
                        </div>

                        <div class="form-group">
                          <label>Email Address :</label>
                          <input class="form-control" id="email" placeholder="Email Address" name="email" type="text" required="">
                           <p id="errorMessage" style="display: none;">Please Enter a Valid Email.</p>

                        </div>
                        <div class="form-group">
                          <label>Mobile Number :</label>
                          <input class="form-control number" placeholder="Mobile Number" name="phone" type="text" required="">
                          <span id="errmsg"></span>
                        </div>
                        <div class="form-group">
                          <label>Located At :</label>
                          <div class="selectdiv">
                          <label>
                           <select name="pty_select" required=""> 
                           <option>Select Location</option>
                          <?php foreach($data as $key => $value){ ?>
                           <option value="<?php echo $value->id; ?>"><?php echo $value->city_name; ?></option> 
                           <?php } ?>
                         </select>
                         </label>
                         <img src="<?php echo base_url();?>/public/images/dropdown-arrow.png"/></div>
                       </div>

                       <div class="form-group">
                        <label>License No. :</label>
                        <input class="form-control"  placeholder="License No" type="text" name="license_no" required="">
                    
                      </div>

                      <div class="form-group">
                        <label>License Image :</label>

                        <div class="upload-pic" id="bbb">
                        <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                        <div class="upload-btn-wrap">
                        <div class="upload-btn">
                        <input type="file"  name="license_image_front" required="" onchange="readURL(this,'blah2','bbb');">
                        <img  src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                        </div>
                        </div>
                        </div>
                        <img id="blah2" class="blah2" src="#" alt="your image" style="display:none" />

                        <div class="upload-pic" id="ccc">
                        <img  src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                        <div class="upload-btn-wrap">
                        <div class="upload-btn">
                        <input type="file"  name="license_image_back" onchange="readURL(this,'blah3','ccc');" required="">
                        <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
   
                        </div>
                        </div>
                        </div>
                        <img id="blah3" class="blah3" src="#" alt="your image" style="display:none" />
                      </div>

                      <div class="SAve">  
                        <button a class="nav-link" data-toggle="tab" href="#profile" id="ee" role="tab">Save <span class="NUmber_Font"></span></a>
                        </a>
                      </div>
                  </div></div>




                  <div class="tab-pane" id="profile" role="tabpanel"><div class="EDit_Inputs">
                      <div class="form-group">
                        <label>Bank Name:</label>
                        <input class="form-control"  placeholder="Bank Name" type="text" name="bank_name" required="">
                      </div>

                      <div class="form-group">
                        <label>Account Name :</label>
                        <input class="form-control " placeholder="Account Name" type="text" name="account_name" required="">
                      </div>
                      <div class="form-group">
                        <label>Account Number :</label>
                        <input class="form-control "  placeholder="Account Number" type="text" name="account_number" required="">
                      </div>
                      <div class="form-group">    
                        <label>Account BSB :</label>               
                        <input class="form-control"  placeholder="Account BSB" type="password" name="account_bsb" required="">
                      </div>

                      <div class="SAve">
                        <button a class="nav-link" data-toggle="tab" href="#messages" role="tab">Save <span class="NUmber_Font"></span></a>
                        </div> 
                    </div></div>



                    <div class="tab-pane" id="messages" role="tabpanel"><div class="EDit_Inputs">

                      <div class="form-group">
                        <label>Vehicle Name :</label>
                        <input class="form-control"  placeholder="Vehicle Name" type="text" name="vehicle" required="">
                      </div>
                      <div class="form-group">
                        <label>Vehicle Type :</label>
                        <div class="selectdiv"><label> 

                        <select name="vehicle_id" class="form-control" required=""> 
                        <option>Select Vehicle Type</option>
                          <?php foreach($vehicletype as $key => $value){ ?>
                           <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option> 
                           <?php } ?>
                         </select>


                       </label>
                       <img src="<?php echo base_url();?>/public/images/dropdown-arrow.png"/></div>
                     </div>
                     <div class="form-group">
                      <label>Vehicle Number :</label>
                      <input class="form-control"  placeholder="Vehicle Number" type="text" name="vehicle_no" required="">
                    </div>
                    <div class="form-group">
                      <label>Vehicle RC :</label>
                      <div class="upload-pic" id="ddd">
                      <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input type="file" hidden="" name="rc_image_front" required="" onchange="readURL(this,'blah4','ddd');">
                      <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                      <img id="blah4" class="blah4" src="#" alt="your image" style="display:none" />


                      <div class="upload-pic" id="eee">
                      <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input required="" type="file" hidden="" name="rc_image_back" onchange="readURL(this,'blah5','eee');">
                      <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                      <img id="blah5" class="blah5" src="#" alt="your image" style="display:none" />
                    </div>

                    <div class="form-group">
                      <label>Vehicle Insurance :</label>
                      <div class="upload-pic" id="fff">
                      <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input type="file" hidden="" name="insurance_image_front" required="" onchange="readURL(this,'blah6','fff');">
                      <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                      <img id="blah6" class="blah6" src="#" alt="your image" style="display:none" />
                      <div class="upload-pic" id="ggg">
                      <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input required="" type="file" hidden="" name="insurance_image_back" onchange="readURL(this,'blah7','ggg');">
                      <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                      <img id="blah7" class="blah7" src="#" alt="your image" style="display:none" />
                    </div>

                    <div class="form-group">
                      <label>Vehicle Image :</label>
                      <div class="upload-pic" id="hhh">
                      <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap"><div class="upload-btn">
                      <input type="file" hidden="" name="vehicle_image_front" required="" onchange="readURL(this,'blah8','hhh');">
                      <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                      <img id="blah8" class="blah8" src="#" alt="your image" style="display:none" />
                      <div class="upload-pic" id="iii">
                      <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input required="" type="file" hidden="" name="vehicle_image_back" onchange="readURL(this,'blah9','iii');">
                      <img src="<?php echo base_url();?>/public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                      <img id="blah9" class="blah9" src="#" alt="your image" style="display:none" />
                    </div>

                    <div class="SAve">
                      <button type="submit" id="submit" name="submit">Save</button>
                    </div>
                  </form>
                </div></div>

              </div></div></div></div></div></div></div>
              <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
              <!-- Include all compiled plugins (below), or include individual files as needed -->
              <script src="<?php echo base_url();?>/public/js/bootstrap.min.js"></script> 
            </body>

            </html>
    <script type="text/javascript">
$(document).ready(function () {
  $(".number").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
    </script>
    
    <script type="text/javascript">
var validateEmail = function(elementValue) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(elementValue);
}

$('#ee').click(function() {
    var value = $('#email').val();
    var valid = validateEmail(value);
    if (!valid) {
        $("#errorMessage").show();    
        return false;
    }
});
    
$('#email').keyup(function() {

    var value = $(this).val();
    var valid = validateEmail(value);

    if (!valid) {
        $(this).css('color', 'red');
    } else {
        $(this).css('color', '#000');
    }

});


    </script>

<script type="text/javascript">
       function readURL(input,a,aaa) {
        
        $('.'+a).show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                  $("#"+aaa).hide();   
                    $('#'+a)
                        .attr('src', e.target.result)
                        .width(216)
                        .height(216);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
