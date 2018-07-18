
      <section id="main-content">

      <div class="header-caption-bm"> <div class="container-fluid">

                <h2 align="center" style="color: red"><?php echo $this->session->flashdata('signup'); ?></h2>
                 <h2 align="center" style="color: red"><?php echo $this->session->flashdata('no'); ?></h2>
                 <h2 align="center" style="color: red"><?php echo $this->session->flashdata('already'); ?></h2> 

                <div class="ADd_padding">
                    <h1>Become  <b>a Mover</b></h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris ni</p>




                </div></div></div>
          <section class="wrapper become-mover-wrapper site-min-height">
              <!-- page start--><div class="container-fluid"><div class="ADd_padding">
              <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                      <section class="panel">
                         


                          <div class="panel-body">
                              <div class="stepy-tab">
                                  <ul id="default-titles1" class="stepy-titles1 clearfix">
                                      <li id="" class="current-step">
                                         <h1>Step <span class="NUmber_Font">1</span></h1>
                                         <p>Enter your <b>Personal Details</b> here</p>
                                      </li>
                                      <li id="" class="">
                                           <h1>Step <span class="NUmber_Font">1</span></h1>
                                         <p>Enter your <b>Personal Details</b> here</p>
                                      </li>
                                      <li id="" class="">
                                   <h1>Step <span class="NUmber_Font">1</span></h1>
                                         <p>Enter your <b>Personal Details</b> here</p>s
                                      </li>
                                  </ul>
                              </div>
                              <form class="EDit_Inputs" id="default" enctype="multipart/form-data" method="post" action="<?php echo base_url("Driver/signup")?>">
                                  <fieldset title="Enter your Personal Details here" class="step" id="default-step-0">
                                      <legend> </legend>





                           <div class="form-group">
                          <label>Profile Image :</label>

                          <div class="upload-pic" id="aaa">
                          <img src="<?php echo base_url();?>/public/images/upload-pics-book-mover.png" class="img-responsive">
                          <div class="upload-btn-wrap">
                          <div class="upload-btn">
                          <input type="file"  name="profile_pic" onchange="readURL(this,'blah1','aaa');" required="" >
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
                                  <!--     <div class="form-group">
                                          <label class="control-label">Full Name</label>
                                        
                                              <input type="text" class="form-control" placeholder="Full Name" name="name" >
                                        
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label">Email Address</label>
                                          <input type="text" class="form-control" placeholder="Email Address" name="email">
                                          
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label">Phone No</label>
                                         
                                              <input type="text" class="form-control" placeholder="Phone No" name="phone">
                                        
                                      </div>
                                        <div class="form-group">
                                          <label class="control-label">Located At</label>
                                       
                                            <div class="selectdiv">
                          <label>
                           <select class="form-control" name="pty_select" required=""> 
                           <option>Select Location</option>
                                                     <option value="7">Delhi</option> 
                                                      <option value="9">Mohali</option> 
                                                    </select>
                         </label>
                         <img src="http://phphosting.osvin.net/moversOnDemand//public/images/dropdown-arrow.png"></div>
                                      </div>
                                        <div class="form-group">
                                          <label class=" control-label">Licence No</label>
                                       
                                              <input type="text" class="form-control" placeholder="Licence No" name="licenceno">
                                         
                                      </div> 
                         <div class="form-group">
                        <label class="control-label">Licence Image</label>
                              
                        <div class="upload-pic" id="bbb">
                        <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                        <div class="upload-btn-wrap">
                        <div class="upload-btn">
                        <input name="license_image_front" required="" onchange="readURL(this,'blah2','bbb');" type="file">
                        <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                        </div>
                        </div>
                        </div>

                        <div class="upload-pic" id="ccc">
                        <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                        <div class="upload-btn-wrap">
                        <div class="upload-btn">
                        <input name="license_image_back" onchange="readURL(this,'blah3','ccc');" required="" type="file">
                        <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
   
                        </div>
                        </div>
                        </div>
                                         
                                      </div> -->
                                

                                  </fieldset>
                                  <fieldset title="Enter your Account Details here" class="step" id="default-step-1" >
                                      <legend> </legend>


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




                                  </fieldset>
                                  <fieldset title="Enter your Vehicle Details here" class="step" id="default-step-2" >
                                      <legend> </legend>


                                  
<!--                                     <div class="form-group">
                                    <label class="control-label">Vehicle Number</label>
                   
                                    <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicleno">
                                   
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label">Vehicle Type</label>
                   
                                    <div class="selectdiv"><label> 

                        <select name="vehicle_id" class="form-control" required=""> 
                        <option>Select Vehicle Type</option>
                                                     <option value="14">XL Van</option> 
                                                      <option value="15">Van</option> 
                                                      <option value="16">Ute</option> 
                                                      <option value="17">Truck</option> 
                                                      <option value="18">TruckXl</option> 
                                                    </select>


                       </label>
                       <img src="http://phphosting.osvin.net/moversOnDemand//public/images/dropdown-arrow.png"></div>
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label">Vehicle Number</label>
                   
                                    <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicleno">
                                   
                                    </div>

                                      <div class="form-group">
                                      <label class="control-label">Vehicle RC</label>
                                    
                                      <div class="upload-pic" id="ddd">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input name="rc_image_front" required="" onchange="readURL(this,'blah4','ddd');" type="file" hidden="">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>

                      <div class="upload-pic" id="eee">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input required="" name="rc_image_back" onchange="readURL(this,'blah5','eee');" type="file" hidden="">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                                 
                                      </div>


                                        <div class="form-group">
                                        <label class="control-label">Vehicle Insurance</label>
                                     
                                       <div class="upload-pic" id="fff">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input name="insurance_image_front" required="" onchange="readURL(this,'blah6','fff');" type="file" hidden="">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>

                      <div class="upload-pic" id="ggg">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input required="" name="insurance_image_back" onchange="readURL(this,'blah7','ggg');" type="file" hidden="">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                                        
                                        </div>


                                        <div class="form-group">
                                          <label class="control-label">Vehicle Image</label>
                                    
                                            <div class="upload-pic" id="hhh">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap"><div class="upload-btn">
                      <input name="vehicle_image_front" required="" onchange="readURL(this,'blah8','hhh');" type="file" hidden="">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>

                      <div class="upload-pic" id="iii">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/upload-pics-book-mover.png" class="img-responsive">
                      <div class="upload-btn-wrap">
                      <div class="upload-btn">
                      <input required="" name="vehicle_image_back" onchange="readURL(this,'blah9','iii');" type="file" hidden="">
                      <img src="http://phphosting.osvin.net/moversOnDemand//public/images/book-mover-upload.png" class="img-responsive">
                      </div>
                      </div>
                      </div>
                                       
                                      </div>
 -->
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




                                     


                                    






      
                            
                                  </fieldset>
                                  <input type="submit" id="submit" name="submit" class="finish btn btn-danger" />
                              </form>
                          </div>
                      </section>
                  </div>
              </div></div></div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
    
      <!--footer end-->


    <!-- js placed at the end of the document so the pages load faster -->


    <!--script for this page-->
    <script src="<?php echo base_url("public/js/form-validation-script.js")?>"></script>


  </body>
</html>

     <script src="<?php echo base_url("public/js/jquery.stepy.js")?>"></script>


  <script>

      //step wizard

      $(function() {
          $('#default').stepy({
              backLabel: 'Previous',
              block: true,
              nextLabel: 'Next',
              titleClick: true,
              titleTarget: '.stepy-tab'
          });
      });
  </script>
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

$('#default-next-0').click(function() {
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
                        .width(281)
                        .height(250);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
