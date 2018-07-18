
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Transactions List
                          </header>
                 
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Sr.No.</th>
                                          <th>User Name</th>
                                          <th>Amount Credited</th>
                                          <th>Amount Debited</th>
                                          <th>Transaction Id</th>
                                          <th>Date Created</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                       <?php
                                       $i=1;
                                       foreach ($transaction as $key => $value) {
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
                                          <?php 
                                           if (!empty($value->amount_credited)) {
                                          echo $value->amount_credited; 
                                           }
                                           else{
                                            echo "N/A";
                                           }  ?>
                                        </td>
                                           <td>
                                          <?php 
                                           if (!empty($value->amount_debited)) {
                                          echo $value->amount_debited; 
                                           }
                                           else{
                                            echo "N/A";
                                           }  ?>
                                        </td>
                                               <td>
                                          <?php 
                                           if (!empty($value->txn_id)) {
                                          echo $value->txn_id; 
                                           }
                                           else{
                                            echo "N/A";
                                           }  ?>
                                        </td>
                        
                                        
                                        <td>
                                                <?php $date= $value->date_created;
                                          echo date("F d, Y", strtotime($date));?>
                                        </td>
                                        <td>                 
                                     <!-- delete btn btn-danger responsive wiDTH -->
                                          <button type="button" class="delete btn btn-danger responsive wiDTH_delete" id="<?php echo $value->deleteid;?>" >Delete</button>
                                         
                                           
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
    <script type="text/javascript" charset="utf-8">

          $(document).ready(function() {
              $('#example').dataTable( {
                
               "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
                "iDisplayLength": 100
                  // "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>