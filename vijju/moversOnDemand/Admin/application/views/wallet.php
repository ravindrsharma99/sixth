<!--sidebar end-->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
           Wallet List
         </header>
        

         <div class="alert alert-danger alert-dismissable" id="sucess"  style="display: none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         Amount Paid Sucessfully
        </div>
           <div class="alert alert-danger alert-dismissable" id="error"  style="display: none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         Something Went Wrong
        </div>



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
        <div class="row CUSTOM_TAB">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Customer List</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Driver List</a></li>
            
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
              <div class="panel-body">
                <div class="adv-table">
                  <table  class="display table table-bordered table-striped example" id="example">
                    <thead>
                      <tr>
                        <th>Sr.No.</th>
                        <th>User Name</th>
                        <th>Balance</th>
                        <th>Phone</th>
                        <th>Date Created</th>
                        <!--      <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=1;
                      foreach ($wallet_customerlist as $key => $value) {
                                                  // print_r($value);die();
                        ?>
                        <tr id ='hello<?php echo $value->deleteid; ?>'> 
                          <td>
                            <?php echo $i; ?>
                          </td>
                          <td>
                            <?php 
                            if (isset($value->fname)) {
                              echo $value->fname." ". $value->lname; 
                            }
                            else{
                              echo "N\A";
                            }  ?>
                          </td>
                          <td>
                            <?php echo  round($value->balence); ?>
                          </td>
                          <td>
                            <?php 
                            if (!empty($value->phone)) {
                              echo $value->country_code." -". $value->phone; 
                            }
                            else{
                              echo "N\A";
                            }  ?>
                          </td>


                          <td>
                            <?php $date= $value->date_created;
                            echo date("F d, Y", strtotime($date));?>
                          </td>
                           <!--        <td>                 
                            
                                    <button type="button" class="delete btn btn-danger responsive wiDTH" id="<?php echo $value->deleteid;?>" >Delete</button>
                                   
                                     
                                  </td> -->
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
                    <div role="tabpanel" class="tab-pane" id="profile"> <div class="panel-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped example" id="example">
                          <thead>
                            <tr>
                              <th>Sr.No.</th>
                              <th>User Name</th>
                              <th>Balance</th>
                              <th>OutStanding Amount</th> 
                              <th>Phone</th>
                              <th>Date Created</th>
                              <th>Action</th> 
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            foreach ($wallet_driverlist as $key => $value) {
                      // echo"<pre>";print_r($value);die();
                              ?>
                              <tr id ='hello<?php echo $value->user_id; ?>'> 
                                <td>
                                  <?php echo $i; ?>
                                </td>
                                <td>
                                  <?php 
                                  if (isset($value->fname)) {
                                    echo $value->fname." ". $value->lname; 
                                  }
                                  else{
                                    echo "N\A";
                                  }  ?>
                                </td>
                                <td>
                                  <?php echo  round($value->balence); ?>
                                </td>

                                <td id="myAmnt<?php echo $value->user_id;?>">
                                  <?php 
                                  if (!empty($value->outstanding_amount)) {
                                    echo $value->outstanding_amount; 
                                  }
                                  else{
                                    echo "N\A";
                                  }  ?>
                                </td> 
                                <td>
                                  <?php 
                                  if (!empty($value->phone)) {
                                    echo $value->country_code." -". $value->phone; 
                                  }
                                  else{
                                    echo "N\A";
                                  }  ?>
                                </td>

                                <td>
                                  <?php $date= $value->date_created;
                                  echo date("F d, Y", strtotime($date));?>
                                </td>
                                <td>                 

                                  <button type="button" class=" btn btn-danger responsive wiDTH" id="<?php echo $value->user_id;?>" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->user_id; ?>" data-amount="<?php echo $value->outstanding_amount; ?>" >Pay</button>

                                </td>
                              </tr>

                              <?php 
                              $i++;
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div></div>

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
      <!--<script src="js/jquery.js"></script>-->
<!--     <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script> -->
    <!--popup start-->
    <div class="panel-body">
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Enter Driver Payment Detail</h4>
            </div>
             <div class="alert alert-danger alert-dismissable" id="errormodal"  style="display: none;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         Something Went Wrong
        </div>
            <div class="modal-body">
 <form class="form-horizontal" id="default" method="POST" action="<?php echo base_url("Dashboard/payamount")?>" enctype="multipart/form-data"> 
              <!--  <form class="form-horizontal" id="idForm" method="POST"  enctype="multipart/form-data"> -->
              

                <div class="form-group type_box">
                    <div class="col-lg-12">
                    <label>Card Number</label>
                    <input type="number"  required="" class="form-control"  name="cardnumber" id="cardnumber" value="" placeholder="enter card number">
                  </div>
                  
                  <div class="col-lg-12">
                    <label>Expiry Date</label>
                    <input type="text"  required="" class="form-control"   name="expirydate" id="expirydate" value="" placeholder="select expiry date" >
                  </div>

                  <div class="col-lg-12">
                    <label>Amount</label>
                    <input type="number"  class="form-control" id="myInput"  name="amnt" value="" required="" >
                  </div>
                  <p id="errorMessage" style="display: none;">Withdraw Amount Should be lesser than Total outstanding Amount.</p>
                  <p id="errorMessage1" style="display: none;">OutStanding Amount is Nill.</p>

                </div>

         

          
      <input type="hidden"  class="form-control" id="amount"  name="amount" value="" > 
                <input type="hidden" name= "submitid" id='hiddid' value=""/>
             <!--    <button  type="submit" class="btn btn-info editdata submit" onclick="submitPay()" id="sub">Submit</button> -->
                <button  type="submit" class="btn btn-info editdata submit load_button" id="sub">Submit</button>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--popup end-->  

  </body>
  </html>


  <script> 
   $(document).ready(function(){

     $(".delete").click(function(event){
      var result = confirm("Are you Sure to delete?");
      if (result) {

       var id = $(this).attr("id");  

       $.ajax({
        type: "POST",
        url: "<?php echo base_url("Dashboard/deletetxn")?>",
        data: {id:id},
        success: function(response) {
          if (response == true)
          {
            $("#hello"+id).slideUp(100, function() {
              $(this).remove();
            });

          }
          else if(response == false)
          {
            alert("Error"); 
          } else{
            alert('cannot delete the id');
          }

        }
      });

       event.preventDefault();
     }
     else{

     }
   })
   });
 </script>

 <script type="text/javascript">

   $(document).ready(function() {
     $('#myModal').on('show.bs.modal', function(e) {
      var userid = $(e.relatedTarget).data('id');
      var amount = $(e.relatedTarget).data('amount');
      document.getElementById('hiddid').value = userid;
      document.getElementById('amount').value = amount;
    });

   });
  
 </script>
 <script>
  $('#myInput').change(function() {
    var newAmt = parseInt($(this).val()); // get the current value of the input field.
    var id = $('#hiddid').val();
    var amnt = parseInt($('#myAmnt'+id).html().trim());

  if(amnt>0) {

    if (newAmt>amnt) {
      $("#errorMessage").show();
      $(this).val(amnt);
    } else{
      $("#errorMessage").hide();
    };
    }else{
      $("#errorMessage1").show();
    document.getElementById("sub").disabled = true;
    }
  });
</script>
<!-- <script type="text/javascript">
  $("#sub").click(function(e){
  var cardnumber = $('#cardnumber').val();
  var expirydate = $('#expirydate').val();
  var amount = $('#myInput').val();
      var id = $('#hiddid').val();
      var amnt = parseInt($('#myAmnt'+id).html().trim());
      var submitid=$('#hiddid').val();
       $.ajax({
        type: "POST",
        url: "<?php echo base_url("Dashboard/payamount")?>",
        data: {cardnumber:cardnumber,expirydate:expirydate,amount:amount,submitid:submitid,amnt:amnt},
        success: function(response) {
           if (response == true)
          {
            // var pay_total =var amnt - var amount ;
            //   document.getElementById('myAmnt'+id).innerHTML = "pay_total";
              $('#myModal').modal('hide')
              $("#sucess").show();
              setTimeout(function () {
              window.location.href = "<?php echo base_url("Dashboard/wallet_list")?>"; //will redirect to your blog page 
              }, 2000); //will call the function after 2 secs.

          }
          else{
               // $('#myModal').modal('hide')
               $("#errormodal").show();
          }

        }
    });
   e.preventDefault();
});
</script> -->