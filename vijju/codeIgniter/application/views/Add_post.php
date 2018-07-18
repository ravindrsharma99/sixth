<?php 
?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
				<!-- <div class="alert alert-success  alert-block fade in">
							<button data-dismiss="alert" class="close close-sm" type="button">
								<i class="fa fa-times"></i>
							</button>
							<h4>
								<i class="fa fa-ok-sign"></i>
                Add
							</h4>
				</div> -->
			
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add Post <?php if($this->session->flashdata('msg')): ?>
    <p><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>
                          </header>
                          <div class="panel-body">
                            <div class="form">
  <?php 
 
/* if(isset($_GET['id']))
{                                   
foreach($result as $row)   
 {                                                    
 
*/
   ?>
                                    <?php echo form_open('Add_post/process'); ?>
                                      <div class="form-group ">
                                          <label for="businessname" class="control-label col-lg-1">Post Title : </label>
                                          <div class="col-lg-3">
                                            <input  value="<?php // echo $row['id']; ?>"  name="id" type="hidden" />
                                           <input class=" form-control" value="<?php // echo $row['emailid']; ?>" id="posttitle" name="posttitle" type="text" />   
                                          </div>
                                          <label for="businessname" class="control-label col-lg-1">Post : </label>
                                          <div class="col-lg-6">

                                          <textarea class=" form-control" id="post" name="post"></textarea>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input type="submit" name="submit" value="submit" class="btn btn-danger">
                                              <!--button class="btn btn-default" type="button">Cancel</button-->
                                          </div>
                                      </div>
                                  </form>
<?php //}} ?>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

    <!--script for this page-->
	  <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo  base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo  base_url(); ?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo  base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo  base_url(); ?>js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="<?php echo  base_url(); ?>js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="<?php echo  base_url(); ?>js/form-validation-script.js"></script>


  </body>
</html>
