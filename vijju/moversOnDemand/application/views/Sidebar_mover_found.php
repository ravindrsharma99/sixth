
<?php //echo "<pre>";print_r($driver);die; ?>
    <!-- MAIN CONTENT -->
    <div class="container" id="main">
        <div class="row  background_BluRr">
            <div class="col-md-12 col-sm-12">
                <div class="LogOut pull-right"><a href="<?php echo base_url('App/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <!-- Content Wrapper -->
                <div class="Content_WraPper">
                    <div class="heaDiNg_main">
                        <h2 class="text-capitalize">mover found</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="blank_SpAce GRRn">
                                <h3 class="text-center text-capitalize">mover found!</h3></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="thumbnail text-center">
<!--                             <img src="<?php echo base_url('public/')?>images/mover-found.png" alt="Mover Picture" class="img-responsive">
 -->                              <img src="<?php echo $driver->profile_pic; ?>" alt="Mover Picture" class="img-responsive">
                              <div class="caption">
                                    <h4><?php echo $driver->fname.' '.$driver->lname; ?></h4>
                                    <h4><?php echo $vechile; ?></h4>
                                    <div class="Rating_StArs blank_SpAce">
                                        <p class="text-capitalize">average rating</p>
                                        <?php 
                                          for($i=0 ;$i<5;$i++){
                                            if($i>=$rating){
                                              echo '<i class="fa fa-star grey" aria-hidden="true"></i>';
                                            }else{
                                              echo '<i class="fa fa-star green" aria-hidden="true"></i>';
                                            } 
                                          }
                                        ?>
                                    </div>
                                    <div class="SIghIn CONitnew">
                                        <a href="<?php echo base_url(); ?>booking_detail"><button type="button">Move details</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content Wrapper -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="previous">
                           <!-- <a href="#">
                                <button type="button">Previous</button>
                            </a>
                            <a href="http://phphosting.osvin.net/Movers/select_move-type.php">
                                <button type="button">Next</button>
                            </a>
 -->                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
</body>

</html>
