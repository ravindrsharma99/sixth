<!-- MAIN CONTENT -->
<?php 
  $bookData = $booking_data[0];
  $image = unserialize($bookData->item_image);
  $pricing = $pricing_data[0];
  // echo "<pre>"; print_r($usersDetail[0]);
  // echo "<pre>";print_r($bookData);die; 
?>
<div id="main" class="container">
  <div class="row  background_BluRr">
    <div class="col-md-12 col-sm-12">
        <div class="LogOut pull-right"><a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
            <span>Logout</span></a>
        </div>
    </div>
    <div class="col-md-12">
                    <div class="heading-bgtop"><h1>Your Moves</h1></div>
                </div>
    <div class="row show-grid">
        <div class="col-sm-1 col-md-1-offset"></div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-10 col-lg-offset-1">
    <div class="Content_WraPper">
    <div class="your-moves-wrapper">
     
        <div class="content-move-detail">
          <div class="row">
            <div class="col-md-12 col-sm-12">                              
              <div class="Back_butn">
                <a href="<?php echo base_url('booking_detail'); ?>">Back</a>
              </div>
            </div>
            </div>
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="map-details">
                    <div class="content-map">
                      <img src="https://maps.googleapis.com/maps/api/staticmap?size=370x250&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|<?php echo $bookData->pickup_latitude; ?>,<?php echo $bookData->pickup_longitude;?>&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|<?php echo $bookData->destination_latitude;?>,<?php echo $bookData->destination_longitude;?>&path=weight:5%7Ccolor:0x14456a%7Cenc:<?php echo base64_decode($bookData->path_polyline);?>&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img>
                    </div>
                    <div class="content-map-details Content_WraPper-inner move-details-inner">
                      <div class="content-addr-your-move">
                        <div class="addr-inner addr-pickup">
                            <div class="addr-inner-img">
                              <img src="<?php echo base_url();?>public/images/move-details-pickup.png" class="img-responsive">
                            </div>
                            <div class="addr-inner-content">
                              <h5>Pickup Location</h5>
                              <p><?php echo $bookData->pickup_loc; ?></p>
                            </div>
                        </div>                      
                        <div class="addr-inner addr-dest">
                            <div class="addr-inner-img">
                              <img src="<?php echo base_url();?>public/images/move-details-destination.png" class="img-responsive">
                            </div>
                            <div class="addr-inner-content">
                              <h5>Dropoff Location</h5>
                              <p><?php echo $bookData->destination_loc; ?></p>
                            </div>
                        </div>
                      </div>
                      <?php     
                      $result = $this->Admin_model->secondsToTime($pricing->time);
                      ?>

                      <div class="content-md-footer-details">
                        <div class="fd-detail fd-time alignment"><div class="fd-img"><p>Move #<?php echo $bookData->id; ?></p></div><p>
                          <?php
                              date_default_timezone_set('UTC');          
                              $asia_timestamp = strtotime($bookData->booking_date);
                              date_default_timezone_set($_SESSION['timezone_dynamic']);
                              $utcDateTime = date("H:i:s", $asia_timestamp);
                              $bdate = date("d M y", strtotime($utcDateTime));

                              if($move_data[0]->status == 0){
                                date_default_timezone_set('UTC');          
                                $asia_timestamp = strtotime($bookData->slot_starttime);
                                date_default_timezone_set($_SESSION['timezone_dynamic']);
                                $utcDateTime1 = date("H:i:s", $asia_timestamp);
                                $startt =  date("h:i A.", strtotime($utcDateTime1));

                                date_default_timezone_set('UTC');          
                                $asia_timestamp = strtotime($bookData->slot_endtime);
                                date_default_timezone_set($_SESSION['timezone_dynamic']);
                                $utcDateTime2 = date("H:i:s", $asia_timestamp);
                                $endt = date("h:i A.", strtotime($utcDateTime2));
                                $ss = $startt."-".$endt;
                                echo $bdate.' '.$ss;
                                $text = 'Pending';
                              }elseif($move_data[0]->status == 1){
                                $tz = 'accepted_time';
                                $text = 'Assigned';}
                              elseif($move_data[0]->status == 2){
                                $tz = 'started_time';
                                $text = 'EnRoute';
                              }
                              elseif($move_data[0]->status == 3){
                                $tz = 'completed_time';
                                $text = 'Completed';
                              }
                              else{
                                $tz = 'cancelled_time';
                                $text = 'Cancelled';
                              } 
                                if($move_data[0]->status == 1 || $move_data[0]->status == 2 || $move_data[0]->status == 3 || $move_data[0]->status == 4){
                                  date_default_timezone_set('UTC');          
                                  $asia_timestamp = strtotime($move_data[0]->$tz);
                                  date_default_timezone_set($_SESSION['timezone_dynamic']);
                                  $utcDateTime2 = date("H:i:s", $asia_timestamp);
                                  $ssa = date("h:i A.", strtotime($utcDateTime2));
                                  echo $bdate.' at '.$ssa;
                                }
                          ?>
                        </p></div>
                          <div class="fd-detail fd-dflights add_right">
                            <div class="fd-img">
                              <?php echo "$".$pricing->min_estimate_price.' - '.$pricing->max_estimate_price; ?>
                              <button type="button" class="info-btn" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                              </button>
                              <a href="#" class="move-label completed add_width"><?php echo $text; ?></a>
                            </div>
                          </div> 
                      </div>
                      <!-- Model -->
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
                                      <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/distance.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> <div class="details details-left"><h4 class="media-heading">Distance</h4> <p class="NUmber_Font"><?php echo $pricing->distance." Km"; ?></p> </div><div class="details details-right"><h4 class="media-heading">Charges</h4> <p class="NUmber_Font"><?php echo "$".$pricing->vehicle_km_charge; ?></p> 
                                  </div>
                                </div>
                              </div>
                              <div class="list-estimate">
                                  <div class="estimate-list-img"> 
                                      <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/time.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> <div class="details details-left"><h4 class="media-heading">Time</h4> <p class="NUmber_Font"><?php echo round(($pricing->time / 60) % 60)." mins"; ?></p> </div><div class="details details-right"><h4 class="media-heading">Charges</h4> <p class="NUmber_Font">
                                          <?php echo "$".$pricing->vehicle_mover_time_charge; ?>
                                      </p>
                                   </div>
                              </div> 
                            </div>
                            <div class="list-estimate"> 
                                <div class="estimate-list-img">
                                     <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/loading-unloading-time.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> 
                                     <div class="details details-left Align_text">
                                        <h4 class="media-heading">Loding/unloading</h4> <p><?php echo $pricing->min_time." mins | ".$pricing->max_time." mins"; ?> </p><p class="NUmber_Font">
                                         <?php echo "$".$pricing->vehicle_mover_time_charge;  ?>
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
                                      <p class="estimate-desc NUmber_Font"><?php echo "$".$pricing->distance_price; ?></p><p class="estimate-desc NUmber_Font"><?php echo "$".$pricing->time_price; ?></p>
                                  </div> 
                              </div>
                              <div class="estimate-inner">
                                  <div class="estimate-left">
                                     <p class="estimate-label"><b>Min</b> Loading/ Unloading Charges </p>
                                     <p class="estimate-label"><b>Max</b> Loading/ Unloading Charges</p>
                                  </div>
                                  <div class="estimate-right">
                                      <p class="estimate-desc NUmber_Font"><?php echo "$".$pricing->min_loading_unloading_fare; ?></p><p class="estimate-desc NUmber_Font"><?php echo "$".$pricing->max_loading_unloading_fare; ?></p>
                                  </div>
                              </div>
                            </div>
                            <div class="estimated-price">
                                <div class="price-value"><h4>Min Price</h4><p class="NUmber_Font"><?php echo "$".$pricing->min_estimate_price; ?></p></div>
                                <div class="price-value"><h4>Max Price</h4><p class="NUmber_Font"><?php echo "$".$pricing->max_estimate_price; ?></p></div>
                            </div>
                            <div class="estimate-terms">
                                <p>*<span class="NUmber_Font color_change">10%</span> GST included in the final price.</p><p>*The minimum fare for a ride is <?php echo $pricing->vehicle_min_fare; ?>.</p>
                            </div>
                          </div>
                        </div>
                        </div>
                      </div> 





                      <div class="movetype-vehicle center_Align">
                        <div class="align_left"><p>Receipt Number: <?php echo $bookData->receipt_number; ?></p></div>
                        <div class="receipt_number">
                        <div class="movetype mv-inner">
                          <?php if(isset($moveDetail[0]->icon)){ ?>
                            <img src="<?php echo $moveDetail[0]->icon; ?>" width="200px" height="200px">
                            <p><?php echo $moveDetail[0]->title; ?></p>
                          <?php }else{} ?>
                        </div>
                        <div class="vehicle mv-inner">
                          <?php if(isset($vehicleDetail[0]->icon)){ ?>
                            <img src="<?php echo $vehicleDetail[0]->icon; ?>" width="200px" height="200px">
                             <p><?php echo $vehicleDetail[0]->name; ?></p>
                          <?php }else{} ?>
                        </div>
                      </div>
                      </div> 

                      <div class="content-md-footer-details center_Align">
                        <div class="fd-detail fd-time"><div class="fd-img"><img src="<?php echo base_url();?>public/images/move-details-time.png" class="img-responsive"></div><p><?php print_r($result);?></p></div>
                        <div class="fd-detail fd-distance"><div class="fd-img"><img src="<?php echo base_url();?>public/images/move-details-distance.png" class="img-responsive"></div><p><?php echo ceil($pricing->distance); ?> Kms</p></div>
                        <div class="fd-detail fd-movers"><div class="fd-img"><img src="<?php echo base_url();?>public/images/move-details-movers.png" class="img-responsive"></div><p><?php echo $pricing->no_of_movers; ?> Movers</p></div>
                        <!-- <div class="fd-detail fd-pflights"><div class="fd-img"><img src="<?php echo base_url();?>public/images/move-details-flight-up.png" class="img-responsive"></div><p><?php echo $bookData->pickup_level; ?> Flights</p></div>
                        <div class="fd-detail fd-dflights"><div class="fd-img"><img src="<?php echo base_url();?>public/images/move-details-flight-down.png" class="img-responsive"></div><p><?php echo $bookData->destination_level; ?> Flights</p></div> -->
                        <div class="fd-detail fd-dflights"><div class="fd-img"><img src="<?php echo base_url();?>public/images/loading-time-grey.png" class="img-responsive"></div><p><?php if(empty($pricing->min_time)){ echo "0";}else{ echo $pricing->min_time;} ?> Minutes</p></div>
                       <div class="fd-detail fd-dflights"><div class="fd-img"><img src="<?php echo base_url();?>public/images/unloading-time-grey.png" class="img-responsive"></div><p><?php echo $pricing->max_time; ?> Minutes</p></div> 	
                        <!-- <div class="item_details"><a href="#">item_details</a></div> -->
                      </div>  
<?php $moverDetails = $move_data[0]; if($moverDetails->status == 3 || $moverDetails->status == 1 || $moverDetails->status == 2){ ?>
                      <div class="content-md-footer-details center_Align add_border">
                        <div class="row">
                        <div class="col-sm-12 col-md-2">
                        <div class="fmv-img fmv-inner driver_detail">
                        <!-- <img src="<?php echo base_url('public/')?>images/mover-found.png" class="img-circle img-responsive"> -->
                        <img src="<?php echo $profiledata[0]->profile_pic; ?>" />
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-10">
                        <div class="fmv-driver-info fmv-inner driver_alignment"> 
                        <h4><?php echo $profiledata[0]->fname.' '.$profiledata[0]->lname; ?></h4>
                        <h6><?php echo $vehicleDetail[0]->name.' '.$vehicledata[0]->vehicle_no; ?></h6>
                        <span class="fmv-rate-driver-label">Average Rating</span>
                        <div class="stars fmv-inner stars">
                        <?php 
                        $rating = $avgrating[0]->driverrating;
                        for($i=1;$i<=5;$i++){
                        if($i<=$rating){ 
                        echo '<i class="fa fa-star green" aria-hidden="true"></i>';
                        }else{
                        echo '<i class="fa fa-star grey" aria-hidden="true"></i>';
                        }
                        }
                        ?>
                        </div>
                        </div>
                        </div>
                      </div>
                      </div>

                    </div>  
                  </div>
                </div>
              <?php } ?>

            

        <?php 
            $static_key = "!fvsdsdj!kldf!@19uyfd%6n4b32@&2kj2z";
            $carswid = $bookData->id . "_" . $static_key;
            $ediId = base64_encode($carswid);
          if($moverDetails->status == 0){ 
        ?>
          <div class="BOOking_cancel">
             <a href="#" data-toggle="modal" data-target="#pendingcancelmove">Cancel</a>
             <a href="<?php echo base_url(); ?>editmove/<?php echo $ediId ; ?>">Edit Move</a>
          </div>

        <?php } if($moverDetails->status == 1){ ?>
      		<div class="BOOking_cancel">
             <a href="#" data-toggle="modal" data-target="#pendingcancelmove">Cancel</a>
          </div>
        <?php }  ?>

         <div class="get_start"><?php if($move_data[0]->status == 3){ ?>
          <a href="<?php echo base_url(); ?>receipt/<?php echo $ediId; ?>"><button type="button">Get Recipt</button></a>
        <?php } ?></div>
        <div class="header-your-moves footer-move-details">
          <div class="row">
<!--             <div class="col-sm-12 col-md-4">
              <div class="fmv-img fmv-inner driver_detail">
                <!-- <img src="<?php echo base_url('public/')?>images/mover-found.png" class="img-circle img-responsive"> --
                <img src="<?php echo $profiledata[0]->profile_pic; ?>" />
              </div>
            </div>
            <div class="col-sm-12 col-md-8">
              <div class="fmv-driver-info fmv-inner driver_alignment"> 
                <b><?php echo $profiledata[0]->fname.' '.$profiledata[0]->lname; ?></b> <br>
                  <b><?php echo $vehicleDetail[0]->name.' '.$vehicledata[0]->vehicle_no; ?></b>
              <span class="fmv-rate-driver-label fmv-inner">Average Rating</span>
              <div class="stars fmv-inner">
                <?php 
                  $rating = $avgrating[0]->driverrating;
                  for($i=1;$i<=5;$i++){
                    if($i<=$rating){ 
                      echo '<i class="fa fa-star green" aria-hidden="true"></i>';
                    }else{
                      echo '<i class="fa fa-star grey" aria-hidden="true"></i>';
                    }
                  }
                ?>
              </div>
                </div>
            </div> -->
        <!--     <div class="col-lg-5 col-sm-12 col-md-12">

            </div> -->
            <?php  if($moverDetails->status == 4){ $_SESSION['retryPromoVal'] = 'OKO'; ?>
           
               <?php if(isset($_SESSION['promoapplydata'])){ ?>
                  <a href="<?php echo base_url('App/cancelretrypromocode'); ?>" class="ClOss">X</a>
                   <p>You have applied promo code<span> (<?php print_r($_SESSION['promoapplydata']->promo_code); ?>)</span>. You will get <span><?php print_r($_SESSION['promoapplydata']->value) ; ?>%</span> discount on completion. Max discount will be upto <?php echo "$".$_SESSION['promoapplydata']->max_amount; ?></p>
              <?php } else{ ?>
             <div class="BOOking_cancel">
                 <a href="<?php echo base_url(); ?>App/promocode/<?php echo $bookData->id; ?>">Have A Promo Code?</a>
              <?php } ?>
            </div>
            <div class="BOOking_cancel">
              <a href="#" data-toggle="modal" data-target="#retrymove">Retry Move</a>
              <!-- <form action="<?php echo base_url(''); ?>App/cardList/<?php echo $bookData->id; ?>/<?php echo $bookData->booking_time; ?>/<?php echo $bookData->booking_date; ?>" method="POST">
                <input type="submit" name="retrysubmit" value="Retry Move">
              </form> -->
            </div>
            <?php } ?>
          </div>
        </div>
      </div></div></div></div>
    </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

  <script>
    $(function(){
        $("#full img:eq(0)").nextAll().hide();
        $("#small img").click(function(e){
            var index = $(this).index();
            $("#full img").eq(index).show().siblings().hide();
        });
    });
  </script>



  <!--   Retry model -->
   <div class="modal fade" id="retrymove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header REmove_BORder">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            <div class="WANt_PLay">
                <h6>Do you want to retry this Move?</h6>
            </div>
        </div>
       <!--  <form action="<?php echo base_url(''); ?>App/cardList/<?php echo $bookData->id; ?>/<?php echo $bookData->slot_starttime; ?>/<?php echo $bookData->slot_endtime; ?>/<?php echo $bookData->booking_date; ?>" method="POST"> -->
        <form action="<?php echo base_url(''); ?>App/cardList/<?php echo $bookData->id; ?>" method="POST">
          <div class="modal-footer REmove_BORder">
              <div class="PAy_TOcard">
                <button data-dismiss="modal" type="button">No</button>
                <button type="submit" name="retrysubmit" value="Retry Move">Yes</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="pendingcancelmove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header REmove_BORder">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            <div class="WANt_PLay">
                <h6>Are you sure you want to cancel?</h6>
            </div>
            <span style="color:red; padding-left: 37%;font-size: inherit;" id="span"></span>    
        </div>
        <!-- <span id="span"></span> -->
        <form action="<?php echo base_url(); ?>App/cancelbook/<?php echo $bookData->id; ?>" method="POST" id="formdata">
          <div class="add-card-content text-center">
            <textarea rows="6" cols="1"  id="comment" name="comment"></textarea>
            <input type="checkbox" name="checkbox" id="checkbox" placeholder="Enter reason here..."> <p>I agree with cancellation policy</p>
            <!-- <input type="hidden" name="amount" value="<?php echo $bookData->estimated_price;?>"> -->
          </div>
          <div class="modal-footer REmove_BORder">
              <div class="PAy_TOcard">
                <input type="submit" id="submit" name="cancelmovebook" value="Yes">
                <button data-dismiss="modal" type="button">No</button>
              </div>
          </div>
        </form>

  </div>

  <script>
    $(document).ready(function(){
      $('#formdata').submit(function(){
        $comment = $('#comment').val();
        //alert($comment);return false;
        if($comment.length == 0){
          $('#span').html('Comment field empty!');
          return false;
        }else{
          $('#span').html('');
        }
        if(!jQuery("#checkbox").is(":checked")){
          $('#span').html('Please click on checkbox!');
          return false;
        }else{
          return true;
        }
       
      });
    });
  </script>
