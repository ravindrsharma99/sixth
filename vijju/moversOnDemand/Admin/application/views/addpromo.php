
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
     
            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add Promo Code
                          </header>
                          <div class="panel-body">
                              <div class="form align">
                                  <form class="cmxform form-horizontal tasi-form type_box_lab" id="signupForm" method="post" action="<?php echo base_url("Dashboard/promocode_list")?>" enctype="multipart/form-data" >
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Name</label>
                                              <input class=" form-control" id="Name" name="name" type="text" placeholder="Enter Promocode Name" required="" />
                                      </div>
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Value</label>
                                              <input class=" form-control" id="Value" name="value" type="text" placeholder="Enter Promocode Value" required="" />
                                      </div>

                                      <div class="form-group ">                                    
                                      <label for="username" class="control-label" name="type" >Type</label>
                                      <select name="type" required >
                                      <option>Select</option>
                                      <option value="1">Amount</option>
                                      <option value="2">Percentage</option>
                                      </select>

                                      </div>
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Max Usage</label>
                                              <input class=" form-control" id="maxusage" name="maxusage" type="number" placeholder="Enter Promocode Max Usage" required="" />
                                      </div>
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Per User Max Usage</label>
                                              <input class=" form-control" id="maxusage" name="perusermaxusage" type="number" placeholder="Enter Per User Max Usage" required="" />
                                      </div>
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Promo Usage</label>
                                              <input class=" form-control" id="promo usage" name="promo usage" type="number" placeholder="Enter Promocode promo usage" required="" />
                                      </div>

                                      <div class="form-group ">
                                      <label>Expiry Date </label>
                                      <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                      <input class="form-control" type="text" name="date" value="" readonly placeholder="Select Expiry Date" />
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                      </div>
                                      </div>

                                      <div class="form-group">
                                              <button class="btn btn-success submit" name="addpromo" type="submit">Submit</button>
                                          
                                      </div>
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
 <!-- <script src="<?php echo base_url("public/js/form-validation-script.js")?>"></script>   -->


  </body>
</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
      $(function () {
      $("#datepicker").datepicker({ 
      autoclose: true, 
      todayHighlight: true,
      });
      });
    </script>   
<!--     <script type="text/javascript">
    $(function () {
    $("#datepicker").datepicker({ 
    autoclose: true, 
    todayHighlight: true,
    // defaultDate: "11/1/2013",
    }).datepicker('update', new Date());;
    });


    </script>    -->

    

