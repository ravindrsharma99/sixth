
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
           Booking List
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

          <div class="row CUSTOM_TAB">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pending Booking</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Started Booking</a></li>
              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Completed Booking</a></li>
              <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Cancelled Booking</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home">
        <div class="panel-body">
          <div class="adv-table">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped example" id="example">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>User Name</th>
                    <th>Vechicle Name</th>
                    <th>Move Name</th>
                    <th>Receipt Number</th>
                    <th>Pick Up Location</th>
                    <th>Destination Location</th>
                    <th>Total Price</th>
                 <!--    <th>Receipt image</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($pending_booking_list as $key => $value) {
                    // print_r($booking);die();

                  ?>
                  <tr id ='hello<?php echo $value->booked_id; ?>'> 
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php 
                      if (isset($value->fname)) {
                                            // $name=$this->db->query()
                        echo $value->fname." ".$value->lname; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php echo  $value->vehiclename; ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->title)) {
                        echo $value->title; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->receipt_number)) {
                        echo $value->receipt_number; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->pickup_loc)) {
                       echo $value->pickup_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->destination_loc)) {
                       echo $value->destination_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->total_price)) {
                       echo $value->total_price;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
            <!--         <td class="image_setting" >
                      <?php if (!empty($value->receipt_image)) {  ?>
                      <img src=" <?php echo  $value->receipt_image; ?>">
                      <?php }
                      else{ ?>
                      <img src=" <?php echo  base_url("public/img/demo.png"); ?>">
                      <?php
                    } ?>

                  </td> -->

                  <td>                 
                    <!--    <button type="button" class="btn btn-info deleteAction responsive" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-fname="<?php echo $value->fname; ?>" data-lname="<?php echo $value->lname; ?>" >Edit</button> -->
                    <button type="button" class="delete btn btn-danger responsive" id="<?php echo $value->booked_id;?>" >Delete</button>
          
                    <a href="<?php echo base_url("Dashboard/booking_detail/$value->booked_id")?>">
                    <input type="submit" value="Details" class="btn btn-primary prim blok_btn responsive" id="<?php echo $value->booked_id;?>"></input>
                    </a>


                       <!-- <button type="button" class="btn btn-info deleteAction responsive assign" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-fname="<?php echo $value->fname; ?>" data-lname="<?php echo $value->lname; ?>" >Assign</button> -->


                        <button type="button" class="btn btn-info deleteAction responsive assign" id="<?php echo $value->booked_id;?>" >Assign</button> 


                  </td>
                </tr>

                <?php 
                $i++;
              }
              ?>
            </tbody>

          </table>
        </div>
        </div>
        </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="profile">    <div class="panel-body">
          <div class="adv-table">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped example" id="example">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>User Name</th>
                    <th>Vechicle Name</th>
                    <th>Move Name</th>
                    <th>Receipt Number</th>
                    <th>Pick Up Location</th>
                    <th>Destination Location</th>
                    <th>Total Price</th>
                 <!--    <th>Receipt image</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($started_booking_list as $key => $value) {
                   // echo "<pre>"; print_r($value);die();

                  ?>
                  <tr id ='hello<?php echo $value->booked_id; ?>'> 
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php 
                      if (isset($value->fname)) {
                                            // $name=$this->db->query()
                        echo $value->fname." ".$value->lname; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php echo  $value->vehiclename; ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->title)) {
                        echo $value->title; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->receipt_number)) {
                        echo $value->receipt_number; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->pickup_loc)) {
                       echo $value->pickup_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->destination_loc)) {
                       echo $value->destination_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->total_price)) {
                       echo $value->total_price;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
            <!--         <td class="image_setting" >
                      <?php if (!empty($value->receipt_image)) {  ?>
                      <img src=" <?php echo  $value->receipt_image; ?>">
                      <?php }
                      else{ ?>
                      <img src=" <?php echo  base_url("public/img/demo.png"); ?>">
                      <?php
                    } ?>

                  </td> -->

                  <td>                 
                    <!--    <button type="button" class="btn btn-info deleteAction responsive" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-fname="<?php echo $value->fname; ?>" data-lname="<?php echo $value->lname; ?>" >Edit</button> -->
                    <button type="button" class="delete btn btn-danger responsive" id="<?php echo $value->booked_id;?>" >Delete</button>
          
                    <a href="<?php echo base_url("Dashboard/booking_detail/$value->booked_id")?>">
                    <input type="submit" value="Details" class="btn btn-primary prim blok_btn responsive" id="<?php echo $value->booked_id;?>"></input>
                    </a>

                     <button type="button" class="end btn btn-danger responsive" id="<?php echo $value->booked_id;?>" >End</button>

                  </td>
                </tr>

                <?php 
                $i++;
              }
              ?>
            </tbody>

          </table>
        </div>
        </div>
        </div></div>
              <div role="tabpanel" class="tab-pane" id="messages">    <div class="panel-body">
          <div class="adv-table">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped example" id="example">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>User Name</th>
                    <th>Vechicle Name</th>
                    <th>Move Name</th>
                    <th>Receipt Number</th>
                    <th>Pick Up Location</th>
                    <th>Destination Location</th>
                    <th>Total Price</th>
                 <!--    <th>Receipt image</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($completed_booking_list as $key => $value) {
                    // print_r($booking);die();

                  ?>
                  <tr id ='hello<?php echo $value->booked_id; ?>'> 
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php 
                      if (isset($value->fname)) {
                                            // $name=$this->db->query()
                        echo $value->fname." ".$value->lname; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php echo  $value->vehiclename; ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->title)) {
                        echo $value->title; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->receipt_number)) {
                        echo $value->receipt_number; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->pickup_loc)) {
                       echo $value->pickup_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->destination_loc)) {
                       echo $value->destination_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->total_price)) {
                       echo $value->total_price;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
            <!--         <td class="image_setting" >
                      <?php if (!empty($value->receipt_image)) {  ?>
                      <img src=" <?php echo  $value->receipt_image; ?>">
                      <?php }
                      else{ ?>
                      <img src=" <?php echo  base_url("public/img/demo.png"); ?>">
                      <?php
                    } ?>

                  </td> -->

                  <td>                 
                    <!--    <button type="button" class="btn btn-info deleteAction responsive" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-fname="<?php echo $value->fname; ?>" data-lname="<?php echo $value->lname; ?>" >Edit</button> -->
                    <button type="button" class="delete btn btn-danger responsive" id="<?php echo $value->booked_id;?>" >Delete</button>
          
                    <a href="<?php echo base_url("Dashboard/booking_detail/$value->booked_id")?>">
                    <input type="submit" value="Details" class="btn btn-primary prim blok_btn responsive" id="<?php echo $value->booked_id;?>"></input>
                    </a>


                  </td>
                </tr>

                <?php 
                $i++;
              }
              ?>
            </tbody>

          </table>
        </div>
        </div>
        </div></div>
              <div role="tabpanel" class="tab-pane" id="settings">    <div class="panel-body">
          <div class="adv-table">
            <div class="table-responsive">
              <table  class="display table table-bordered table-striped example" id="example">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>User Name</th>
                    <th>Vechicle Name</th>
                    <th>Move Name</th>
                    <th>Receipt Number</th>
                    <th>Pick Up Location</th>
                    <th>Destination Location</th>
                    <th>Total Price</th>
                 <!--    <th>Receipt image</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($cancelled_booking_list as $key => $value) {
                    // print_r($booking);die();

                  ?>
                  <tr id ='hello<?php echo $value->booked_id; ?>'> 
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php 
                      if (isset($value->fname)) {
                                            // $name=$this->db->query()
                        echo $value->fname." ".$value->lname; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php echo  $value->vehiclename; ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->title)) {
                        echo $value->title; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->receipt_number)) {
                        echo $value->receipt_number; 
                      }
                      else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->pickup_loc)) {
                       echo $value->pickup_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->destination_loc)) {
                       echo $value->destination_loc;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
                    <td>
                      <?php 
                      if (!empty($value->total_price)) {
                       echo $value->total_price;}
                       else{
                        echo "N\A";
                      }  ?>
                    </td>
            <!--         <td class="image_setting" >
                      <?php if (!empty($value->receipt_image)) {  ?>
                      <img src=" <?php echo  $value->receipt_image; ?>">
                      <?php }
                      else{ ?>
                      <img src=" <?php echo  base_url("public/img/demo.png"); ?>">
                      <?php
                    } ?>

                  </td> -->

                  <td>                 
                    <!--    <button type="button" class="btn btn-info deleteAction responsive" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-fname="<?php echo $value->fname; ?>" data-lname="<?php echo $value->lname; ?>" >Edit</button> -->
                    <button type="button" class="delete btn btn-danger responsive" id="<?php echo $value->booked_id;?>" >Delete</button>
          
                    <a href="<?php echo base_url("Dashboard/booking_detail/$value->booked_id")?>">
                    <input type="submit" value="Details" class="btn btn-primary prim blok_btn responsive" id="<?php echo $value->booked_id;?>"></input>
                    </a>


                  </td>
                </tr>

                <?php 
                $i++;
              }
              ?>
            </tbody>

          </table>
        </div>
        </div>
        </div></div>
            </div>
          </div>












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


  <!-- popup start-->
        <div class="panel-body">
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Assign</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" id="default" method="POST" action="<?php echo base_url("Dashboard/assign")?>">
                      <div class="form-group type_box lables">
                       
                        <div class="col-lg-12">
                        <label>First Name:</label>
                          <input type="text"  class="form-control" id="fname"  name="fname" value="" >
                        </div>
                   
               

                      </div>
                   
                      <input type="hidden" name= "submitid" id='hiddid' value=""/>
                      <button  type="submit" class="btn btn-info editdata submit"  >Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
       <!--popup end-->



</body>
</html>

<script type="text/javascript">

       $(document).ready(function() {
       $('#myModal').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('id');
    var fname = $(e.relatedTarget).data('fname');
    document.getElementById('hiddid').value = userid;
    document.getElementById('fname').value = fname;


    


       });

     });
 
   </script>
<script> 
 $(document).ready(function(){

  $(".end").click(function(event){
        var result = confirm("booking will be ended");
        if (result) {

         var id = $(this).attr("id");  
         //alert(id);

         $.ajax({
          type: "POST",
          url: "<?php echo base_url("Dashboard/end_booking")?>",
          data: {id:id},
          success: function(response) {
           // alert(response);
                  if (response == true)
                  {
                    alert('ended');
                  }
                  else if(response == false)
                  {
                    alert("Error");
                  } 
                  else{
                    alert('something went wrong');
                  }
       

           }
         });

         event.preventDefault();
       }
       else{

       }
       })

   $(".delete").click(function(event){
    var result = confirm("Are you Sure to delete?");
    if (result) {

     var id = $(this).attr("id");  

     $.ajax({
      type: "POST",
      url: "<?php echo base_url("Dashboard/deletebooking")?>",
      data: {id:id},
      success: function(response) {
                   // console.log(response);return false;
                   if (response == true)
                   {
                    $("#hello"+id).slideUp(100, function() {
                      $(this).remove();
                    });

                  }
                  else if(response == false)
                  {
                    alert("Error");
                  } 
                  else{
                    alert('cannot delete the id');
                  }


                }
              });

     event.preventDefault();
   }
   else{

   }
 })



    $(".assign").click(function(event){

     var id = $(this).attr("id");  
     $.ajax({
      type: "POST",
      url: "<?php echo base_url("Dashboard/assign")?>",
      data: {id:id},
      success: function(response) {
                   // console.log(response);return false;
                   if (response == true)
                   {
                    $("#hello"+id).slideUp(100, function() {
                      $(this).remove();
                    });

                  }
                  else if(response == false)
                  {
                    alert("Error");
                  } 
                  else{
                    alert('cannot delete the id');
                  }


                }
              });

     event.preventDefault();
  
 })

 });
</script>
