
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
     
            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Setting
                          </header>
                         <?php 
                           $chargetype=$setting[0]->type;
                           ?> 
                                         <?php if ($this->session->flashdata('msg1')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg1'); 
                                ?>
                                </div>
                                <?php } ?>
                                       <?php if ($this->session->flashdata('msg2')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg2'); 
                                ?>
                                </div>
                                <?php } ?>
                                 <?php if ($this->session->flashdata('msg3')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg3'); 
                                ?>
                                </div>
                                <?php } ?>
                                      <?php if ($this->session->flashdata('msg4')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg4'); 
                                ?>
                                </div> 
                                <?php } ?>

                          <div class="panel-body">
                              <div class="form align">
                                  <form class="cmxform form-horizontal tasi-form type_box_lab" id="signupForm" method="post" action="<?php echo base_url("Dashboard/addsetting")?>" enctype="multipart/form-data" >
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Min booking charges (%)</label>
                                              <input class=" form-control number" id="title" name="title" type="text" placeholder="Enter Minimum Booking charges" value="<?php echo $setting[0]->min_booking_charge ?>" required="" />
                                      </div>
                                  
                                 <!--    <div class="form-group ">                                    
                                    <label for="username" class="control-label">Min booking charges Type</label>

                                    <select name="type" id="type"  >
                                    <option value="1" <?php if($chargetype == "1") echo "selected"; ?>>Amount</option>
                                    <option value="2" <?php if($chargetype == "2") echo "selected"; ?>>Percentage</option>
                                    </select>

                                    </div> -->
                                      <div class="form-group ">
                                      <label for="firstname" class="control-label">Set Buffer Time (in minutes)</label>
                                      <input class=" form-control number" id="title" name="time" type="text" placeholder="Set Minimum Buffer Time" value="<?php echo $setting[0]->buffer_time ?>" required="" />
                                      </div>


                                       <div class="form-group ">
                                      <label for="firstname" class="control-label">Referral Amount ($)</label>
                                      <input class=" form-control number" id="refrralamount" name="refrralamount" type="text" placeholder="Set Minimum Buffer Time" value="<?php echo $setting[0]->promo_amount ?>" required="" />
                                      </div>

                                       <div class="form-group ">
                                      <label for="firstname" class="control-label">Loading Time (in minutes)</label>
                                      <input class=" form-control number" id="loadingtime" name="loadingtime" type="text" placeholder="Set Minimum Buffer Time" value="<?php echo $setting[0]->loading_time ?>" required="" />
                                      </div>

                                       <div class="form-group ">
                                      <label for="firstname" class="control-label">UnLoading Time (in minutes)</label>
                                      <input class=" form-control number" id="unloadingtime" name="unloadingtime" type="text" placeholder="Set Minimum Buffer Time" value="<?php echo $setting[0]->unloading_time ?>" required="" />
                                      </div>

                                       <div class="form-group ">
                                      <label for="firstname" class="control-label">Flight Charges</label>
                                      <input class=" form-control number" id="flightcharges" name="flightcharges" type="text" placeholder="Set Minimum Buffer Time" value="<?php echo $setting[0]->flight_charges ?>" required="" />
                                      </div>
                               
                                      


                                      <input type="hidden" value="<?php echo  $setting[0]->id; ?>" name="settingid" >

                                      <div class="form-group">
                                              <button class="btn btn-success submit" name="setting"  type="submit">Submit</button>
                                          
                                      </div>
                                  </form>


                                          <form class="cmxform form-horizontal tasi-form type_box_lab" id="f" method="post" action="<?php echo base_url("Dashboard/uploadCsv")?>" enctype="multipart/form-data" >
                                      <input type="file" name="result_file" value="">
<button class="btn btn-success submit" name="abc"  type="submit">Submit</button>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <?php 
      $this->load->view('templete/footer');
      ?>
      <!--footer end-->


    <!-- js placed at the end of the document so the pages load faster -->


    <!--script for this page-->
    <script src="<?php echo base_url("public/js/form-validation-script.js")?>"></script>


  </body>
</html>
<!-- <script type="text/javascript">
 $('.number').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
    eve.preventDefault();
  }
     
// this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
 $('.number').keyup(function(eve) {
  if($(this).val().indexOf('.') == 0) {    $(this).val($(this).val().substring(1));
  }
 });
});
</script>
 -->
