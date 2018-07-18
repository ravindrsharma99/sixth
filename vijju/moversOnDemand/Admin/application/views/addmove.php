
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
     
            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add Move
                          </header>
                          <div class="panel-body">
                              <div class="form align">
                                 <!--  <form class="cmxform form-horizontal tasi-form type_box_lab" id="signupForm" method="post" action="<?php echo base_url("Dashboard/addedmove")?>" enctype="multipart/form-data" >
                                      <div class="form-group ">
                                            <label for="firstname" class="control-label">Title</label>
                                              <input class=" form-control" id="title" name="title" type="text" placeholder="Enter Move Title" required="" />
                                      </div>
                                      <div class="form-group">
                                          <label for="lastname" class="control-label">Icon</label>
                                              <input class=" form-control" id="icon" name="icon" type="file" required="" />
                                      </div>
                                        <div class="form-group ">                                    
                                          <label for="username" class="control-label">Type</label>
                                          <select name="type" required >
                                          <option>Select</option>
                                          <option value="1">Order</option>
                                          <option value="2">Move</option>
                                            </select>

                                      </div>
                               

                                      <div class="form-group">
                                              <button class="btn btn-success submit" type="submit">Submit</button>
                                          
                                      </div>
                                  </form> -->



                                  <input type="file" name="abc" id="add" value=""  >
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

<script type="text/javascript">
  
$("#add").change(function(){
        var file_data = $("#add").prop("files")[0];   
    var form_data = new FormData();
    form_data.append("file", file_data);
   $.ajax({
        url: "ajax",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(){
            alert("works"); 
        }
    });

});   
</script>
  </body>
</html>

