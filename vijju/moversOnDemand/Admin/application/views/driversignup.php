
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Movers SignUp
                          </header>


                          <div class="panel-body">
                              <div class="stepy-tab">
                                  <ul id="default-titles" class="stepy-titles clearfix">
                                      <li id="default-title-0" class="current-step">
                                          <div>Basic Detail</div>
                                      </li>
                                      <li id="default-title-1" class="">
                                          <div>Account Detail</div>
                                      </li>
                                      <li id="default-title-2" class="">
                                          <div>Vehicle Detail</div>
                                      </li>
                                  </ul>
                              </div>
                              <form class="form-horizontal" id="default" enctype="multipart/form-data" method="post" action="<?php echo base_url("Driver/DriverSignup")?>">
                                  <fieldset title="Step1" class="step" id="default-step-0">
                                      <legend> </legend>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Full Name</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Full Name" name="name" >
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Email Address</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Email Address" name="email">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Phone No</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Phone No" name="phone">
                                          </div>
                                      </div>
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Located At</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Located At" name="location">
                                          </div>
                                      </div>
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Licence No</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Licence No" name="licenceno">
                                          </div>
                                      </div>
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Licence Front Image</label>
                                          <div class="col-lg-10">
                                              <input type="file" class="form-control" name="licencefront">
                                          </div>
                                      </div>
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Licence Back Image</label>
                                          <div class="col-lg-10">
                                              <input type="file" class="form-control" name="licenceback" >
                                          </div>
                                      </div>

                                  </fieldset>
                                  <fieldset title="Step 2" class="step" id="default-step-1" >
                                      <legend> </legend>


                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Bank Name</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Bank Name" name="bankname">
                                          </div>
                                      </div>


                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Account Name</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="Account Name" name="accountname">
                                          </div>
                                      </div>


                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Account Number</label>
                                          <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="Account Number" name="accountnumber" >
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Account BSB</label>
                                          <div class="col-lg-10">
                                          <input type="text" class="form-control" placeholder="Account BSB" name="accountbsb">
                                          </div>
                                      </div>

                                  </fieldset>
                                  <fieldset title="Step 3" class="step" id="default-step-2" >
                                      <legend> </legend>


                                  
                                    <div class="form-group">
                                    <label class="col-lg-2 control-label">Vehicle Number</label>
                                    <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicleno">
                                    </div>
                                    </div>

                                      <div class="form-group">
                                      <label class="col-lg-2 control-label">RC Image Front</label>
                                      <div class="col-lg-10">
                                      <input type="file" class="form-control" placeholder="RC Image Front" name="rcfront">
                                      </div>
                                      </div>


                                        <div class="form-group">
                                        <label class="col-lg-2 control-label">RC Image Back</label>
                                        <div class="col-lg-10">
                                        <input type="file" class="form-control" placeholder="RC Image Back" name="rcback">
                                        </div>
                                        </div>


                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Vehicle Image Front</label>
                                          <div class="col-lg-10">
                                            <input type="file" class="form-control" placeholder="Vehicle Image Front" name="vehiclefront">
                                          </div>
                                      </div>


                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Vehicle Image Side</label>
                                          <div class="col-lg-10">
                                            <input type="file" class="form-control" placeholder="Vehicle Image Side" name="vehicleside">
                                          </div>
                                        </div>



                                      <div class="form-group">
                                      <label class="col-lg-2 control-label">Insurance Image Front</label>
                                      <div class="col-lg-10">
                                      <input type="file" class="form-control" placeholder="Insurance Image Front" name="insurancefront">
                                      </div>
                                      </div>


                                        <div class="form-group">
                                        <label class="col-lg-2 control-label">Insurance Image Back</label>
                                        <div class="col-lg-10">
                                        <input type="file" class="form-control" placeholder="Insurance Image Back" name="insuranceback">
                                        </div>
                                        </div>






      
                            
                                  </fieldset>
                                  <input type="submit" class="finish btn btn-danger" value="Finish"/>
                              </form>
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
