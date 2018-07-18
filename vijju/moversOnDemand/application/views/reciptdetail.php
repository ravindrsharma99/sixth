<!-- MAIN CONTENT -->
<?php 
  $bookData = $booking_data[0];
  $image = unserialize($bookData->item_image);
  $date = date("d M y", strtotime($bookData->booking_date));
  date_default_timezone_set('UTC');          
  $asia_timestamp = strtotime($move_data[0]->completed_time);
  date_default_timezone_set($_SESSION['timezone_dynamic']);
  $utcDateTime = date("H:i:s", $asia_timestamp);
  $time = date("h:i A.", strtotime($utcDateTime));
  // echo "<pre>"; print_r($usersDetail[0]);
  // echo "<pre>";print_r($bookData);die; 
?>
<script type="text/javascript">
    //$('#FeedBack').addClass('menu_active');
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
<style type="text/css">
* {
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  box-sizing:border-box;
}

*:before, *:after {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}

.clearfix {
  clear:both;
}

.text-center {text-align:center;}

pre {
display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 1.42857143;
color: #333;
word-break: break-all;
word-wrap: break-word;
background-color: #F5F5F5;
border: 1px solid #CCC;
border-radius: 4px;
}

.header {
  padding:20px 0;
  position:relative;
  margin-bottom:10px;
  
}

.header:after {
  content:"";
  display:block;
  height:1px;
  background:#eee;
  position:absolute; 
  left:30%; right:30%;
}

.header h2 {
  font-size:3em;
  font-weight:300;
  margin-bottom:0.2em;
}

.header p {
  font-size:14px;
}

.success-box {
  margin:50px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}



/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:2.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#19A580;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#19A580;
}

</style>
<script type="text/javascript">
  $(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    $('#star-rating').val(ratingValue);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>
<?php
  $pricing = $pricing_data[0];
  $moverDetails = $move_data[0];
  $static_key = "!fvsdsdj!kldf!@19uyfd%6n4b32@&2kj2z";
  $carswid = $bookData->id . "_" . $static_key;
  $ediId = base64_encode($carswid);
?>

<div id="main" class="container">
  <div class="row  background_BluRr">
    <div class="col-md-12 col-sm-12">
        <div class="LogOut pull-right"><a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
            <span>Logout</span></a>
        </div>
    </div>
    <div class="row show-grid">
        <div class="col-sm-1 col-md-1-offset"></div>
        </div>
    </div>
    <div class="your-moves-wrapper">
        <div class="Back_butn">
          <a href="<?php echo base_url(); ?>movedetail/<?php echo $ediId; ?>">Back</a>
        </div>
      <div class="header-your-moves">Move Details</div>
        <div class="content-move-detail">

          <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                    <div class=" Content_WraPper-inner">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="map-details">
                    <div class="content-map">
                      <img src="https://maps.googleapis.com/maps/api/staticmap?size=370x250&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|<?php echo $bookData->pickup_latitude; ?>,<?php echo $bookData->pickup_longitude;?>&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|<?php echo $bookData->destination_latitude;?>,<?php echo $bookData->destination_longitude;?>&path=weight:5%7Ccolor:0x14456a%7Cenc:<?php echo base64_decode($bookData->path_polyline);?>&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img>
                    </div>
                    <div class="content-moveID">
                      <div class="moveID"><p class="m-heading">MoveID#<?php echo $bookData->id; ?></p><p class="m-subheading"><?php echo $date." at ".$time; ?></p></div>
                      <div class="move-price"><p class="m-price"><?php echo "$".$pricing->min_estimate_price.'-'.$pricing->max_estimate_price;?></p></div>
                    </div>
                    <div class="content-map-details">
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
                      // $result = $this->App->convertTime($move_data[0]->completed_time);
                      ?>
                    
                    </div>  
                  </div>
                </div>
         <div class="col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
                  <div class="fare-details">
                    <div class="fr-detail-section fr-detail-section1">
                      <?php if($moverDetails->status == 3){ ?>
                        <div class="fr-detail-inner">
                          <p class="label-fr">Paid By</p>
                          <p class="value NUmber_Font">$xxxxxxxxxxxx<?php echo $bookData->cardno[0]->card_no;?></p>
                        </div>
                      <?php } ?>
  	                  <div class="fr-detail-inner">
                        <p class="label-fr">Distance Fare</p>
                        <p class="value NUmber_Font"><?php echo "$".$pricing->distance_price; ?></p>
                      </div>
  	                  <div class="fr-detail-inner">
                        <p class="label-fr">Time Fare</p>
                        <p class="value NUmber_Font"><?php echo "$".$pricing->time_price;?></p>
                      </div>
                      <div class="fr-detail-inner">
                        <p class="label-fr">Extra Fare</p>
                        <p class="value NUmber_Font"><?php echo "$".$pricing->extra_fare;?></p>
                      </div>
  	                  <div class="fr-detail-inner">
                        <p class="label-fr">GST</p>
                        <p class="value NUmber_Font"><?php echo "$".$pricing->gst_price;?></p>
                      </div>
                    	<!-- <div class="fr-detail-inner">
                        <p class="label-fr">Unloading Fare</p>
                        <p class="value NUmber_Font">$<?php echo $bookData->unloading_fare;?></p>
                      </div>
                    	<div class="fr-detail-inner">
                        <p class="label-fr">Pickup Flight Fare</p>
                        <p class="value NUmber_Font">$<?php echo $bookData->pickup_flight_fare;?></p>
                      </div>
                      <div class="fr-detail-inner">
                        <p class="label-fr">Dropoff Flight Fare</p>
                        <p class="value NUmber_Font">$<?php echo $bookData->destination_flight_fare;?></p>
                      </div> -->		
                    </div>
                    <div class="fr-detail-section fr-detail-section2">
                      <div class="fr-detail-inner"><p class="label-fr">Subtotal</p><p class="value NUmber_Font">$1.03</p></div>
                      <div class="fr-detail-inner"><p class="label-fr">Discount</p><p class="value NUmber_Font">$1.03</p></div>
                    </div> 
                    <?php $moverDetails = $move_data[0];if($moverDetails->status != 3){ ?>
                      <div class="fr-detail-section fr-detail-section3">
                        <div class="fr-detail-inner"><p class="label-fr">Estimated Total </p>
                          <p class="value NUmber_Font">$<?php echo $bookData->estimated_price;?></p>
                        </div>
                      </div>
                    <?php } elseif($moverDetails->status == 3){ if(!empty($bookData->discount_amount)){ ?>
                       <div class="fr-detail-section fr-detail-section3">
                        <div class="fr-detail-inner"><p class="label-fr">subtotal</p>
                          <p class="value NUmber_Font">$<?php echo $bookData->estimated_price;?></p>
                        </div>
                      </div>
                      <div class="fr-detail-inner">
                        <p class="label-fr">Discount Promo Used(<?php echo $promodata[0]->promo_code; ?>)</p>
                        <p class="value NUmber_Font">$<?php echo $bookData->discount_amount ;?></p>
                      </div>
                      <div class="fr-detail-inner">
                        <p class="label-fr">Total</p>
                        <p class="value NUmber_Font">$<?php echo $bookData->estimated_price - $bookData->discount_amount ;?></p>
                      </div>
                    <?php }else{ ?>

                       <div class="fr-detail-section fr-detail-section3">
                        <div class="fr-detail-inner"><p class="label-fr">Estimated Total </p>
                          <p class="value NUmber_Font">$<?php echo $bookData->estimated_price;?></p>
                        </div>
                      </div>

                    <?php }} ?>

                  </div>
                  <div class="header-your-moves footer-move-details">
                  <div class="row">
                      <!-- <div class="fmv-img fmv-inner"> -->

                        <div class="row">
                        <div class="col-sm-12 col-md-2">
                        <div class="fmv-img fmv-inner driver_detail">
                        <!-- <img src="<?php echo base_url('public/')?>images/mover-found.png" class="img-circle img-responsive"> -->
                        <img src="<?php echo $profiledata[0]->profile_pic; ?>"/>
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-10">
                        <div class="fmv-driver-info fmv-inner driver_alignment"> 
                        <h4><?php echo $profiledata[0]->fname.' '.$profiledata[0]->lname; ?></h4>
                        <h6><?php echo $vehicleDetail[0]->name.' '.$vehicledata[0]->vehicle_no; ?></h6>
                      <!--   <span class="fmv-rate-driver-label">Average Rating</span> -->
                        </div>
                                             <?php 
                        $rating = $rating[0]->rating;
                        if(!empty($rating)){
                          echo '<span class="fmv-rate-driver-label fmv-inner">You rated</span><div class="stars fmv-inner">';
                          for($i=1;$i<=5;$i++){
                            if($i<=$rating){ 
                              echo '<i class="fa fa-star green" aria-hidden="true"></i>';
                            }else{
                              echo '<i class="fa fa-star grey" aria-hidden="true"></i>';
                            }
                          }
                          echo "</div>";
                        }else{
                      ?>
<!--                       <span class="fmv-rate-driver-label fmv-inner">Rate Mover</span>
 -->                      <div class="stars fmv-inner floting">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Rate Your Mover</button>
                      </div>
                      <?php } ?>
                        </div>

        <!--             <div class="col-lg-5 col-sm-12 col-md-12">
 
                    </div> -->
          </div>
                  <!-- <div id="full">
                     <?php foreach($image as $key=>$value){ 
                      if(empty($value)){
                        unset($key);
                      }else{
                        echo " <img src= '".$value."' width='320px ' height='300px'> ";
                      }
                    } ?>
                  </div> -->
                  <br>
                  <!-- <div id="small">
                  <?php 
                    foreach($image as $key=>$value){ 
                      if(empty($value)){
                        unset($key);
                      }else{
                        echo " <img src= '".$value."' width='50px ' height='50px'> ";
                      }
                    }
                  ?>
                  </div> -->
                   <?php $moverDetails = $move_data[0]; if($moverDetails->status == 0){ ?>
                      <a href="<?php echo base_url(); ?>App/edit_items/<?php echo $bookData->id; ?>">Edit item Details</a>
                    <?php } ?>
                </div> 

                    <!-- Button trigger modal -->
           <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
             Rate mover
            </button> -->

            <!-- Modal -->
            <div class="modal rate-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="thumbnail-wrapper text-center">
                          <div class="thumbnail-inner text-center">
                            <img src="<?php echo $profiledata[0]->profile_pic; ?>" alt="Mover Van" class="img-responsive">
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <h3 class="text-center text-capitalize rate-mover-name"><?php echo $profiledata[0]->fname.' '.$profiledata[0]->lname; ?></h3>
                          <h4 class="text-center weight_300 rate-mover-title">Rate you Mover</h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <div class="Rating_StArs_big text-center blank_SpAce">
                            <input type='hidden' id='star-rating' name='rating'>
                            <input type="hidden" name="driver" value="<?php echo $profiledata[0]->id; ?>">
                            <div class='rating-stars text-center'>
                              <ul id='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                  <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                  <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                  <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                  <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                  <i class='fa fa-star fa-fw'></i>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 text-center">
                          <div class="textarea_CusTom">
                            <textarea class="form-control" name="comment" rows="6" placeholder="Write a thank you note"></textarea>
                          </div>
                          <div class="SIghIn blank_SpAce">
                            <button type="submit" name="submitcustaing">submit</button>
                              <!--<p class="text-capitalize text-GreEn"><a href="">no thanks!</a></p> -->
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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



  <script>
    $(document).ready(function(){
      $('#formdata').submit(function(){
        $comment = $('#comment').val();
        //alert($comment);return false;
        if($comment == ''){
          $('#span').html('enetr comment tab');
          return false;
        }else if($comment != ''){
          $('#span').html('');
        }
        if(!jQuery("#checkbox").is(":checked")){
          $('#span').html('click checkbox');
          return false;
        }else{
          return true;
        }
       
      });
    });
  </script>
