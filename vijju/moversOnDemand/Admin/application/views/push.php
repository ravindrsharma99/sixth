
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->


    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Notification
          </header>
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
          <div class="panel-body">
            <div class="form align">
              <form class="cmxform form-horizontal tasi-form type_box_lab" id="signupForm" method="post" action="<?php echo base_url("Dashboard/push_notification")?>" enctype="multipart/form-data" >


                <div class="form-group ">
                  <label for="firstname" class="control-label">Message</label>
                  <input class=" form-control" id="message" name="message" type="text" placeholder="Enter Push Message" required="" />
                </div>


                <div id="opwp_woo_tickets" class="float_ad">  
                  <p>Select Specific User</p>      
                  <input type="checkbox" class="maxtickets_enable_cb" name="fooby">
                  <div class="max_tickets">
                    <input type="text" name="email" placeholder="Select Specific User"  class="ful_width">
                  </div>
                </div>

                <div id="opwp_woo_tickets" class="float_ad">  
                  <p>Customer</p>      
                  <input type="checkbox" class="maxtickets_enable_cb" value="1" name="fooby">
                </div>

                <div id="opwp_woo_tickets" class="float_ad">        
                  <p>Drivers</p>
                  <input type="checkbox" class="maxtickets_enable_cb" value="2" name="fooby">
                </div>

                <div id="opwp_woo_tickets" class="float_ad">        
                  <p>All</p>
                  <input type="checkbox" class="maxtickets_enable_cb" value="3" name="fooby"> 
                </div>

                <div class="form-group">
           <!--        <button class="btn btn-success submit" type="submit">Send</button> -->
                   <input class="btn btn-success submit" type="submit" value="Submit" disabled>
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
 jQuery(document).ready(function($) {
   $('input.maxtickets_enable_cb').change(function(){
    if ($(this).is(':checked'))
      $(this).next('div.max_tickets').show();
    else
      $(this).next('div.max_tickets').hide();
  }).change();
 });
</script> 
<script type="text/javascript">
  $("input:checkbox").on('click', function() {
    var $box = $(this);
    if ($(this).is(':checked')){
      $(this).next('div.max_tickets').show();
    }
    if ($box.is(":checked")) {
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      $(group).prop("checked", false);
      $(group).next('div.max_tickets').hide();
      $box.prop("checked", true);
    } 
  });

  var checkboxes = $("input[type='checkbox']"),
  //alert(checkboxes);
    submitButt = $("input[type='submit']");

checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});
</script>