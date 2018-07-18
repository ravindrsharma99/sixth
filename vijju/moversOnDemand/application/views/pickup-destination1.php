<?php 
	if(isset($_SESSION['mybookingData']['pickuplat'])){
		$ss = $_SESSION['mybookingData']['pickuplat'];
		$str = explode('.',$ss);
		$ds =  substr($str[1],0,-8);
		$p_lat = $str[0].'.'.$ds; 
		$ss = $_SESSION['mybookingData']['pickuplng'];
		$str = explode('.',$ss);
		$ds =  substr($str[1],0,-8);
		$p_lng = $str[0].'.'.$ds;			
	}
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACSueOTI5iEZBVIu-G7ROeW2DiQn8tVGw&libraries=places&callback=initAutocomplete" async defer>
</script>

<style type="text/css">

</style>
<!-- MAIN CONTENT -->
<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12 col-sm-12">
            <div class="LogOut pull-right"><a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
        </div>
        <!-- CUSTOM COLUMNS -->
        <div class="row show-grid">
            <div class="col-sm-1 col-md-1-offset"></div>
            <div class="col-sm-2 col-md-2 text-center">
                <?php if(isset($_SESSION['moveType'])){ ?>
                    <div class="Step_Green">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step-1-white.png" alt="Step-1"></span>
                    </div>
                    <div class="progress_lin_RED"></div>
                <?php }else{ ?>
                    <div class="Step_White">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step-1-white.png" alt="Step-1"></span>
                    </div>
                    <div class="progress_lin"></div>
                <?php } ?>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step3-grey.png" alt="Step-2"></span>
                </div>
                    <div class="progress_lin"></div>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step4-grey.png" alt="Step-4"></span>
                </div>
                <div class="progress_lin"></div>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step5-grey.png" alt="Step-5"></span>
                </div>
                <div class="progress_lin"></div>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step2-grey.png" alt="Step-2"></span>
                </div>               
            </div>
        </div>
        <!-- / CUSTOM COLUMNS -->
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <!-- Content Wrapper -->
            <div class="Content_WraPper">
                <div class="heaDiNg_main">
                    <h2 class="text-capitalize">Set Pickup and Dropoff location</h2></div>
                <div class="content-main content-pickup-dest Content_WraPper-inner">
                    <div class="content-map">
                         <form action="<?php echo base_url('vehcile');?>" method="POST"> 
                            <input id="pac-input" class="controlss" type="text" placeholder="Start location">
                            <input id="searchh" class="controlss" type="text" placeholder="End Location">
                            <div id="map" style="width:auto;height:400px;"></div>
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3150.041692270873!2d144.89937881562923!3d-37.85931487974423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad666eed877d779%3A0x60ddae14a2f2c435!2s1+Ferguson+St%2C+Williamstown+VIC+3016%2C+Australia!5e0!3m2!1sen!2sin!4v1505221033115" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                    </div>
                    <div class="content-addr">
                        <div class="addr-inner addr-pickup row">
                            <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/pickup_location.png" class="img-responsive" /></div>
                            <div class="addr-inner-content">
                                <h5>Pickup Location</h5>
                                <input type="hidden" name="pickup" id="location">
                                <input type="hidden" value = "<?php echo $p_lat;   ?>" name="pickuplat" id="lat">
                                <input type="hidden" value = "<?php echo $p_lng; ?>" name="pickuplng" id="lng">
                                <p><span id="startloc"><?php empty($_SESSION['mybookingData']['pickup'])? '': print_r($_SESSION['mybookingData']['pickup']); ?></span></p>
                            </div>
                        </div>
                       <!-- <div class="dots row">
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <img src="<?php echo base_url();?>public/images/dots.png" class="img-responsive" />
                            </div>
                        </div> -->
			<?php  //echo "<pre>";print_r($_SESSION['settingdata']);die;?>
                        <div class="addr-inner addr-dest row">
                            <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/dropoff_location.png" class="img-responsive"></div>
                            <div class="addr-inner-content">
                                <h5>Dropoff Location</h5>
                                <input type="hidden" name="dropoff" id="location1">
                                <input type="hidden" value = "<?php empty($_SESSION['mybookingData']['dropofflat'])? '': print_r($_SESSION['mybookingData']['dropofflat']); ?>" name="dropofflat" id="lat1" >
                                <input type="hidden"  value = "<?php empty($_SESSION['mybookingData']['dropofflng'])? '': print_r($_SESSION['mybookingData']['dropofflng']); ?>" name="dropofflng" id="lng1">
			        <input type="hidden" name="unloadingTime" id="unloadingTimeData" >
                                <input type="hidden" name="loadingTime" id="loadingTimeData">
				
                                <p><span id="endloc"><?php empty($_SESSION['mybookingData']['dropoff'])? '': print_r($_SESSION['mybookingData']['dropoff']); ?></span></p>
                            </div>
                        </div>
                    </div>
			<?php if($_SESSION['settingdata'][0]->movers_charges > 0){?>
                    <div class="select-movers-flights">
                        <div class="smf-inner">
                            <div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/movers_reqd.png"> <span>Movers Required</span></div>
                            <div class="smf-inner-btns"><img src="<?php echo base_url();?>public/images/movers_reqd_single.png">
                                <label class="switch">
                                    <input type="checkbox" name="moverRequired">
                                    <span class="slider round"></span>
                                </label>
                                <img src="<?php echo base_url();?>public/images/movers_reqd.png"></div>
                        </div>
				<?php } if($_SESSION['settingdata'][0]->flight_charges > 0){?>
                        <div class="smf-inner">
                            <div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/flight-of-stairs_pickup.png"> <span>Flights of Stairs <i>(If no elevator)</i></span></div>
                            <div class="smf-inner-btns">
                                <div class="quantity-btn NUmber_Font">
                                    <span class="input-group-btn btn-qty-left">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                    <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    </span>
                                    <input type="text" id="quantity" name="upstairs" class="form-control input-number" value="0" min="0" max="100">
                                    <span class="input-group-btn btn-qty-right">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </span>
                                </div>
                            </div>
                        </div>
			<?php } if($_SESSION['settingdata'][0]->loading_rate > 0){ ?>
                        <div class="smf-inner">
                            <div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/loading-time.png"> <span>Estimate Loading Time</span></div>
                            <div class="smf-inner-btns">
                                <a class="btn-lg EST_BUTON" data-toggle="modal" data-target="#ESTIMATELOADING1"><strong id="loadingTime">10</strong> Minutes</a>
                            </div>
                        </div>
			<?php  }  if($_SESSION['settingdata'][0]->unloading_rate > 0){ ?>
                        <div class="smf-inner">
                            <div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/unloading-time.png"> <span>Estimate Unloading Time</span></div>
                            <div class="smf-inner-btns">
                                <a class="btn-lg EST_BUTON" data-toggle="modal" data-target="#ESTIMATELOADING2"><strong  id="unloadingTime">10</strong> Minutes</a>
                            </div>
                        </div>
				<?php } if($_SESSION['settingdata'][0]->flight_charges > 0){ ?>
                        <div class="smf-inner">
                            <div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/flight-of-stairs_dropoff.png"> <span>Flights of Stairs <i>(If no elevator)</i></span></div>
                            <div class="smf-inner-btns">
                                <div class="quantity-btn NUmber_Font">
                                    <span class="input-group-btn btn-qty-left">
                                    <button type="button" class="quantity-left-minus1 btn btn-danger btn-number"  data-type="minus" data-field="">
                                    <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    </span>
                                    <input type="text" id="quantity1" name="downstairs" class="form-control input-number" value="0" min="0" max="100">
                                    <span class="input-group-btn btn-qty-right">
                                    <button type="button" class="quantity-right-plus1 btn btn-success btn-number" data-type="plus" data-field="">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		<?php } ?> 
                <!-- / Content Wrapper -->
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="previous">
                       <!--  <a href="<?php echo base_url('book'); ?>">
                            <button type="button">Previous</button>
                        </a> -->
                        <!-- <a href="http://localhost/Movers/Sidebar_vehicle-type.php"> -->
                        <button type="submit"  disabled="disabled" id="checkupData" name="submit">Next</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>


<!-- ///////////////// MODEL POPUP FOR ESTIMATE LOADING TIME /////////////// -->

<div class="modal fade EST_BUTON_POP" id="ESTIMATELOADING1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content Plus_Gren">
      <div class="modal-body">
            <center><h3 class="MODEl_Hading">Select Minutes</h3></center>
            <div class="POPUP_BUTn_INCREMENT">
                <div class="quantity-btn NUmber_Font">
                    <span class="input-group-btn btn-qty-left">
                        <button type="button" class="quantity-left-minus3 btn btn-danger btn-number"  data-type="minus" data-field="">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                    </span>
                    <input type="text" id="quantity3" name="quantity3" class="form-control input-number" value="10" min="10" max="100">
                    <span class="input-group-btn btn-qty-right">
                        <button type="button" class="quantity-right-plus3 btn btn-success btn-number" data-type="plus" data-field="">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    </span>
                </div>
            </div>
      </div>
      
       <div class="modal-footer BOTm">
        <center>
            <button type="button" class="POPBTN_cmn" data-dismiss="modal" >Cancel</button><!-- data-dismiss="modal" -->
            <button type="button" id ="Loading" class="POPBTN_cmn">Set</button>
        </center>
      </div>
      
    </div>
  </div>
</div>

<!-- ///////////////// MODEL POPUP FOR ESTIMATE LOADING TIME /////////////// -->




<!-- ///////////////// MODEL POPUP FOR ESTIMATE LOADING TIME /////////////// -->

<div class="modal fade EST_BUTON_POP" id="ESTIMATELOADING2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content Plus_Gren">
      <div class="modal-body">
            <center><h3 class="MODEl_Hading">Select Minutes</h3></center>
            <div class="POPUP_BUTn_INCREMENT">
                <div class="quantity-btn NUmber_Font">
                    <span class="input-group-btn btn-qty-left">
                    <button type="button" class="quantity-left-minus4 btn btn-danger btn-number"  data-type="minus" data-field="">
                    <span class="glyphicon glyphicon-minus"></span>
                    </button>
                    </span>
                    <input type="text" id="quantity4" name="quantity4" class="form-control input-number" value="10" min="1" max="100">
                    <span class="input-group-btn btn-qty-right">
                    <button type="button" class="quantity-right-plus4 btn btn-success btn-number" data-type="plus" data-field="">
                    <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    </span>
                </div>
            </div>
      </div>
      
       <div class="modal-footer BOTm">
        <center>
            <button type="button" class="POPBTN_cmn" data-dismiss="modal" >Cancel</button><!-- data-dismiss="modal" -->
            <button type="button" id="Unloading" class="POPBTN_cmn">Set</button>
        </center>
      </div>
      
    </div>
  </div>
</div>

<!-- ///////////////// MODEL POPUP FOR ESTIMATE LOADING TIME /////////////// -->








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
    <script type="text/javascript">
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        var quantitiy1 = 0;
        $('.quantity-right-plus1').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity1 = parseInt($('#quantity1').val());
            // If is not undefined
            $('#quantity1').val(quantity1 + 1);
            // Increment
        });

        $('.quantity-left-minus1').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity1 = parseInt($('#quantity1').val());
            // If is not undefined
            // Increment
            if (quantity1 > 0) {
                $('#quantity1').val(quantity1 - 1);
            }
        });
        var quantitiy2 = 0;
        $('.quantity-right-plus2').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity2 = parseInt($('#quantity2').val());
            // If is not undefined
            $('#quantity2').val(quantity2 + 1);
            // Increment
        });

        $('.quantity-left-minus2').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity2 = parseInt($('#quantity2').val());
            // If is not undefined
            // Increment
            if (quantity2 > 0) {
                $('#quantity2').val(quantity2 - 1);
            }
        });



    var quantitiy3 = 10;
            $('.quantity-right-plus3').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity3 = parseInt($('#quantity3').val());
                // If is not undefined
                $('#quantity3').val(quantity3 + 1);
                // Increment
            });

            $('.quantity-left-minus3').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity3 = parseInt($('#quantity3').val());
                // If is not undefined
                // Increment
                if (quantity3 > 10) {
                    $('#quantity3').val(quantity3 - 1);
                }
            });

    var quantitiy4 = 10;
            $('.quantity-right-plus4').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity4 = parseInt($('#quantity4').val());
                // If is not undefined
                $('#quantity4').val(quantity4 + 1);
                // Increment
            });

            $('.quantity-left-minus4').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity4 = parseInt($('#quantity4').val());
                // If is not undefined
                // Increment
                if (quantity4 > 10) {
                    $('#quantity4').val(quantity4 - 1);
                }
            });
        });




    </script>
