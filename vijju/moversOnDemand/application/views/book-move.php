<!-- <?php //echo "<pre>";print_r($_SESSION);die; ?> -->
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
                    <?php if(isset($_SESSION['mybookingData'])){ ?>
                        <div class="Step_Green">
                            <span class=""><img src="<?php echo base_url();?>public/images/step3-white.png" alt="Step-3"></span>
                        </div>
                        <div class="progress_lin_RED"></div>
                    <?php }else{ ?>
                        <div class="Step_White">
                            <span class=""><img src="<?php echo base_url();?>public/images/img/step3-grey.png" alt="Step-3"></span>
                        </div>
                        <div class="progress_lin"></div>
                    <?php } ?>
                </div>
                <div class="col-sm-2 col-md-2 text-center">
                    <?php if(isset($_SESSION['selectedVehicle'])){ ?>
                        <div class="Step_Green">
                            <span class=""><img src="<?php echo base_url();?>public/images/step4-white.png" alt="Step-4"></span>
                        </div>
                        <div class="progress_lin_RED"></div>
                    <?php }else{ ?>
                        <div class="Step_White">
                            <span class=""><img src="<?php echo base_url();?>public/images/img/step4-grey.png" alt="Step-4"></span>
                        </div>
                        <div class="progress_lin"></div>
                    <?php } ?>
                </div>           
                <div class="col-sm-2 col-md-2 text-center">
                    <?php if(isset($_SESSION['selectedVehicle'])){ ?>
                        <div class="Step_Green">
                            <span class=""><img src="<?php echo base_url();?>public/images/step5-white.png" alt="Step-5"></span>
                        </div>
                        <div class="progress_lin_RED"></div>
                    <?php }else{ ?>
                        <div class="Step_White">
                            <span class=""><img src="<?php echo base_url();?>public/images/img/step5-grey.png" alt="Step-5"></span>
                        </div>
                        <div class="progress_lin"></div>
                    <?php } ?>
                </div>
                <div class="col-sm-2 col-md-2 text-center">
                    <?php if(isset($_SESSION['movingDesc'])){ ?>
                        <div class="Step_Green">
                            <span class=""><img src="<?php echo base_url();?>public/images/step2-white.png" alt="Step-2"></span>
                        </div>
                    <?php }else{ ?>  
                        <div class="Step_White">
                            <span class=""><img src="<?php echo base_url();?>public/images/img/step2-grey.png" alt="Step-2"></span>
                        </div>
                    <?php } ?>           
                </div>
            </div>
        <!-- / CUSTOM COLUMNS -->
    </div>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <!-- Content Wrapper -->          
            <div class="Content_WraPper">
                <div class="heaDiNg_main" ><h2 class="text-capitalize">Book Move</h2></div>
                    <!-- <form action="<?php echo base_url(); ?>App/page6" method="POST"> -->
                    <!-- <form action="<?php echo base_url(); ?>page6/<?php echo $value->id; ?>" method="POST"> -->
                        <div class="content-main content-book-move Content_WraPper-inner">
                            <div class="content-map">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?size=750x350&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|<?php print_r($_SESSION['mapData']['pickupLat']);?>,<?php print_r($_SESSION['mapData']['pickupLong']);?>&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|<?php print_r($_SESSION['mapData']['dropoffLat']);?>,<?php print_r($_SESSION['mapData']['dropoffLong']);?>&path=weight:5%7Ccolor:0x14456a%7Cenc:<?php print_r($_SESSION['mapData']['polyline']);?>&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img>
                                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3150.041692270873!2d144.89937881562923!3d-37.85931487974423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad666eed877d779%3A0x60ddae14a2f2c435!2s1+Ferguson+St%2C+Williamstown+VIC+3016%2C+Australia!5e0!3m2!1sen!2sin!4v1505221033115" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                            </div>
                            <div class="content-addr">
                                <div class="addr-inner addr-pickup">
                                    <div class="addr-inner-img">
                                        <img src="<?php echo base_url();?>public/images/pickup_location.png" class="img-responsive"/>
                                    </div>
                                    <div class="addr-inner-content">
                                        <h5>Pickup Location</h5>
                                        <p>
                                            <?php 
                                                if(isset($_SESSION['mapData'])){
                                                    print_r($_SESSION['mapData']['pickupAdd']);
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="addr-inner addr-dest">
                                    <div class="addr-inner-img">
                                        <img src="<?php echo base_url();?>public/images/dropoff_location.png" class="img-responsive">
                                    </div>
                                    <div class="addr-inner-content">
                                        <h5>Dropoff Location</h5>
                                        <p>
                                            <?php 
                                                if(isset($_SESSION['mapData'])){
                                                    print_r($_SESSION['mapData']['dropOffAdd']);
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="details-book-move-wrap">
                                <div class="details-book-move">
                                    <!-- <div class="dbm-inner dbm-time">
                                        <img src="<?php echo base_url();?>public/images/book-mover-time.png" class="img-responsive">
                                        <span>
                                            <b>Approx :</b><?php if(isset($_SESSION['mapData'])){print_r($_SESSION['mapData']['duration']);} ?>
                                        </span>
                                    </div> -->
                                    <div class="dbm-inner dbm-time TIMe_Date add_bordr">
<!--                                         <img src="<?php echo base_url();?>public/images/book-mover-time.png" class="img-responsive">
 --><i class="fa fa-calendar" aria-hidden="true"></i>
                                       
  <span>
                                            <h5>
                                                <?php
                                                    $datee = $_SESSION['calculatedSpecificFare']['booking_date'];
                                                    echo date("d M y", strtotime($datee)); 
                                                ?>
                                            </h5>
                                            <h4>
                                                <?php 
                                                    $start =  date("h:i A.", strtotime($_SESSION['calculatedSpecificFare']['slot_starttime']));
                                                    $end = date("h:i A.", strtotime($_SESSION['calculatedSpecificFare']['slot_endtime']));
                                                    echo $start." - ".$end;
                                                ?>
                                            </h5>
                                        </span>
                                    </div>
                                    <div class="dbm-inner dbm-price TIMe_Date add_bordr">
<!--                                         <img src="<?php echo base_url();?>public/images/book-mover-price.png" class="img-responsive">
 -->                                        <span><h3>Price Estimate <button type="button" class="info-btn" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </button></h3> <?php if(isset($_SESSION['calculatedSpecificFare'])){print_r("<p>$".$_SESSION['calculatedSpecificFare']['min_estimate_price']);echo "-$";print_r($_SESSION['calculatedSpecificFare']['max_estimate_price']."</p>");}?>
                                        </span>
                                        
                                    </div>
                                                  <!-- Modal -->
                                        <div class="modal modal-free-estimate fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> <img src="<?php echo base_url();?>public/images/cross.png" alt="#" class="img-responsive"></span></button>
                                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                                    </div>
                                                    <div class="modal-body"> 
                                                        <div class="list-estimate-wrap"> 
                                                            <div class="list-estimate"> 
                                                                <div class="estimate-list-img">
                                                                     <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/distance.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> <div class="details details-left"><h4 class="media-heading">Distance</h4> <p class="NUmber_Font"><?php echo ceil($_SESSION['mapData']['distInKms'])." Km"; ?></p> </div><div class="details details-right"><h4 class="media-heading">Charges</h4> <p class="NUmber_Font"><?php echo "$".$_SESSION['selectedVehicle']->km_charges; ?></p> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-estimate">
                                                            <div class="estimate-list-img"> 
                                                                <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/time.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> <div class="details details-left"><h4 class="media-heading">Time</h4> <p class="NUmber_Font"><?php echo ceil($_SESSION['mapData']['duration'])." mins"; ?></p> </div><div class="details details-right"><h4 class="media-heading">Charges</h4> <p class="NUmber_Font">
                                                                    <?php
                                                                    if($_SESSION['calculatedSpecificFare']['no_of_movers'] == 1){
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges1;
                                                                    }else{
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges2;
                                                                    }
                                                                 ?>
                                                                </p>
                                                             </div>
                                                        </div> 
                                                    </div>
                                                    <div class="list-estimate"> 
                                                        <div class="estimate-list-img">
                                                             <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/loading-unloading-time.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> 
                                                             <div class="details details-left Align_text">
                                                                <h4 class="media-heading">Loding/unloading</h4> <p><?php echo $_SESSION['selectedVehicle']->min_minutes." mins | ".$_SESSION['selectedVehicle']->max_minutes." mins"; ?> </p><p class="NUmber_Font">
                                                                 <?php
                                                                    if($_SESSION['calculatedSpecificFare']['no_of_movers'] == 1){
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges1;
                                                                    }else{
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges2;
                                                                    }
                                                                 ?>
                                                             </p>
                                                        </div>
                                                        <!-- <div class="details details-right">
                                                            <h4 class="media-heading">Charges</h4> <p class="NUmber_Font">$5/Km</p>
                                                        </div> -->
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="estimate-center"> 
                                               <div class="estimate-inner">
                                                   <div class="estimate-left">
                                                   <p class="estimate-label">Distance Charges</p>
                                                   <p class="estimate-label">Time Charges</p>
                                                </div>
                                                <div class="estimate-right">
                                                    <p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['km_chrge']; ?></p><p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['hour_chrge']; ?></p>
                                                </div> 
                                            </div>
                                            <div class="estimate-inner">
                                                <div class="estimate-left">
                                                   <p class="estimate-label"><b>Min</b> Loading/ Unloading Charges </p>
                                                   <p class="estimate-label"><b>Max</b> Loading/ Unloading Charges</p>
                                                </div>
                                                <div class="estimate-right">
                                                    <p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['min_loading']; ?></p><p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['max_loading']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="estimated-price">
                                            <div class="price-value"><h4>Min Price</h4><p class="NUmber_Font"><?php echo "$".$_SESSION['calculatedSpecificFare']['min_estimate_price']; ?></p></div>
                                            <div class="price-value"><h4>Max Price</h4><p class="NUmber_Font"><?php echo "$".$_SESSION['calculatedSpecificFare']['max_estimate_price']; ?></p></div>
                                        </div>
                                        <div class="estimate-terms">
                                            <p>*<span class="NUmber_Font color_change">10%</span> GST included in the final price.</p><p>*The minimum fare for a ride is $40.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 

                                    <!-- <div class="dbm-inner dbm-vehicle">
                                        <img src="<?php echo base_url();?>public/images/book-mover-vehicle.png" class="img-responsive">
                                        <span><b>Vehicle Type :</b><?php if(isset($_SESSION['selectedVehicle'])){print_r($_SESSION['selectedVehicle']->name);} ?>
                                        </span>
                                    </div> -->
                                    <div class="dbm-inner dbm-vehicle CARd_buton">
<!--                                         <img src="<?php echo base_url();?>public/images/book-mover-vehicle.png" class="img-responsive">
 -->                                        <span>
                                            <b>
                                                <?php 
                                                    if(empty($defaultCard)){
                                                         echo '
                                                            <form action="/moversOnDemand/App/Cards" method="POST">
                                                                <button type="submit" name="cardsub"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                 Add Payment <i class="fa fa-chevron-right floatt" aria-hidden="true"></i>
                                                                </button>
                                                            </form>';
                                                    }else{
                                                        foreach ($defaultCard as $key => $value) {
                                                            if($value->is_default == 1  || !empty($_SESSION['sel_card_name'])){
                                                                echo '
                                                                    <form action="/moversOnDemand/mycard" method="POST">
                                                                        <button type="submit" name="cardsub"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                         XXXX XXXX XXXX '.$value->card_no. '<i class="fa fa-chevron-right floatt" aria-hidden="true"></i>
                                                                        </button>
                                                                    </form>';
                                                            }else{
                                                                echo '
                                                                    <form action="/moversOnDemand/mycard" method="POST">
                                                                        <button type="submit" name="cardsub"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                         Add Payment <i class="fa fa-chevron-right floatt" aria-hidden="true"></i>
                                                                        </button>
                                                                    </form>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </b>
                                        </span>
                                    </div>
                                   
                                </div>
                                 <div class="dbm-inner dbm-promo APPly_Sms">
                                        <?php if(isset($_SESSION['promoapplydata'])){ ?>
                                            <a href="<?php echo base_url('promocancel'); ?>" class="ClOss CRooss">X</a>
                                             <p>You have applied promo code<span class="promo_name"> (<?php print_r($_SESSION['promoapplydata']->promo_code); ?>)</span>. You will get <span class="promo_name"><?php print_r($_SESSION['promoapplydata']->value) ; ?>%</span> discount on completion. Max discount will be upto <span class="promo_name"><?php echo "$".$_SESSION['promoapplydata']->max_amount; ?></span></p>
                                        <?php } else{ ?>
                                            
                                            <span><b><a href="<?php echo base_url('promo'); ?>">Have a Promo Code?</a></b></span>
                                        <?php } ?>
                                    </div>
                            </div>
                            </div>
                            <!-- / Content Wrapper -->
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="previous">
                                   <!--  <a href="<?php echo base_url('moving'); ?>">
                                        <button type="button">Previous</button>
                                    </a> -->
                                    <?php   if($defaultCard[0]->is_default == 1){ ?>
                                        <form class="NEXT_FORMBT" action="/moversOnDemand/find/<?php echo $defaultCard[0]->id; ?>" method="POST">		
                                            <button type="submit" name="submit">Next</button>
                                        </form>
                                    <?php } else { ?>
                                        <form class="NEXT_FORMBT" action="/moversOnDemand/find/<?php echo $_SESSION['sel_card_id']; ?>" method="POST">  
                                            <button type="submit" name="submit" <?php if(isset($_SESSION['sel_card_id'])){ }else{echo "disabled='disabled'"; } ?>>Next</button>
                                        </form>
                                    <?php } ?>
                                 </div>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
         <script src="https://use.fontawesome.com/e5033262f5.js"></script>

         <script type="text/javascript">$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});</script>
