
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
     
            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add Vechicle
                          </header>
                          <div class="panel-body">
                              <div class="form align">
                                  <form class="cmxform form-horizontal tasi-form type_box_lab"  id="signupForm" enctype="multipart/form-data" method="post" action="<?php echo base_url("Dashboard/addedvechicle")?>">
                                      <div class="form-group ">
                                          <label for="firstname" class="control-label col-lg-2">Name</label>
                                              <input class=" form-control" id="name" name="name" type="text" placeholder="Vechicle Name" required="" />
                                      </div>
                                      <div class="form-group ">
                                          <label for="lastname" class="control-label col-lg-2">Icon</label>
                                              <input class=" form-control" id="icon" name="icon" type="file" required="" />
                                      </div>
                                      <div class="form-group ">
                                          <label for="username" class="control-label col-lg-2">Height</label>
                                              <input class="form-control number" id="height" name="height" type="text" placeholder="Height" required=""  />
                                      </div>
                                        <div class="form-group ">
                                          <label for="username" class="control-label col-lg-2">Length</label>
                                              <input class="form-control number" id="length" name="length" type="text" placeholder="Length" required=""  />
                                      </div>
                                       <div class="form-group ">
                                          <label for="username" class="control-label col-lg-2">Width</label>
                                              <input class="form-control number" id="width" name="width" type="text" placeholder="Width" required=""  />
                                      </div>
                                        <div class="form-group ">
                                          <label for="username" class="control-label col-lg-2">Weight</label>
                                              <input class="form-control number" id="weight" name="weight" type="text" placeholder="Weight" required="" />
                                      </div>
                                        <div class="form-group "  >

                                          <label for="username" class="control-label col-lg-2">Hour Charges</label>
                                              <input class="form-control number"  name="hourcharges" type="text" placeholder="Hour Charges" required="" />
                                      </div>
                                        <div class="form-group" >
                                          <label for="username" class="control-label col-lg-2">Km Charges</label>
                                              <input class="form-control number"  name="kmcharges"  type="text" onkeypress='return validateQty(event);' placeholder="Km Charges" required="" />
                                      </div>
                               <img src="<?php echo base_url("public/img/favicon.ico")?>" id="gif" style="display: block; margin: 0 auto; width: 100px; visibility: hidden;">

                                      <div class="form-group">
                                              <button class="btn btn-success submit load_button" type="submit">Submit</button>
                                          
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
    <script src="<?php echo base_url("public/js/form-validation-script.js")?>"></script>


  </body>
</html>
<script type="text/javascript">
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

<!--   <script type="text/javascript">
    // $('.load_button').submit(function() {
    //     $('#gif').show(); 
    //     return true;
    // });
    $('#login_form').submit(function() {
    $('#gif').css('visibility', 'visible');
});
</script>
 -->
