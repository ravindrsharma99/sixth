<!-- <script type="text/javascript"></script> -->

<script type="text/javascript">
    $('#FeedBack').addClass('menu_active');</script>
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
    <!-- MAIN CONTENT -->
    <div class="container" id="main">
        <div class="row  background_BluRr">
            <div class="col-md-12 col-sm-12">
                <div class="LogOut pull-right"><a href="<?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
            </div>
            <!-- CUSTOM COLUMNS -->
            <!--  <div class="row show-grid">
               <div class="col-sm-1 col-md-1-offset"></div>
               <div class="col-sm-2 col-md-2 text-center">
                  <div class="Step_Green">
                     <span class=""><img src="images/img/step-1-white.png" alt="Step-1"></span>
                  </div>
               </div>
               <div class="col-sm-2 col-md-2 text-center">
                  <div class="Step_White">
                     <span class=""><img src="images/img/step2-grey.png" alt="Step-2"></span>
                  </div>
               </div>
               <div class="col-sm-2 col-md-2 text-center">
                  <div class="Step_White">
                     <span class=""><img src="images/img/step3-grey.png" alt="Step-3"></span>
                  </div>
               </div>
               <div class="col-sm-2 col-md-2 text-center">
                  <div class="Step_White">
                     <span class=""><img src="images/img/step4-grey.png" alt="Step-4"></span>
                  </div>
               </div>
               <div class="col-sm-2 col-md-2 text-center">
                  <div class="Step_White">
                     <span class=""><img src="images/img/step5-grey.png" alt="Step-5"></span>
                  </div>
               </div>
            </div> -->
            <!-- / CUSTOM COLUMNS -->
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <!-- Content Wrapper -->
                <?php 
                  echo "<p>".$_SESSION['feedrespone']."</p>";
                ?>
                <form action="" method="POST">
                  <div class="Content_WraPper Content_WraPper-inner">
                      <div class="heaDiNg_main">
                          <h2 class="text-capitalize">mover feedback</h2>
                      </div>
                      <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class=" text-center">
                                  <img src="<?php echo base_url(); ?>public/images/feedback-van.png" alt="Mover Van" class="img-responsive blank_SpAce">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 col-sm-12">
                              <h3 class="text-center text-capitalize">thanks! you're the best!</h3>
                              <h4 class="text-center weight_300">We work super hard to make Movers On Demand best for you!</h4>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 col-sm-12">
                              <h3 class="text-center">Please support us by rating.</h3>
                              <h4 class="text-center weight_300">It means the world to us and will help us a lot!</h4>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="Rating_StArs_big text-center blank_SpAce">
                            <input type='hidden' id='star-rating' name='rating'>
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
                                  <button type="submit" name="submitfeed">submit</button>
                                <!--   <p class="text-capitalize text-GreEn"><a href="">no thanks!</a></p> -->
                              </div>
                          </div>
                      </div>
                  </div>
                </form>
                <!-- / Content Wrapper -->
               <!--  <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="previous">
                            <a href="#">
                                <button type="button">Previous</button>
                            </a>
                            <a href="#">
                                <button type="button">Next</button>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
