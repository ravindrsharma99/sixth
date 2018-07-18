       <!--  <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script> -->
       <script src="https://apis.google.com/js/api:client.js"></script>
        <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i');
        body{font-family: 'Lato', sans-serif;}
.profile {
  background-color: #f7f7f7;
  border: 3px solid #1bb68c;
  font-weight: 500;
  height: 160px;
  margin-top: 10px;
  padding: 10px;
  width: 350px;
}
.profile > a{
  color: #1bb68c;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 0.5px;
  text-decoration: underline;
}


.profile p{margin: 0px 0px 10px 0px;}
.head{margin-bottom: 10px;}
.head a{float: right;}
.profile img{width: 100px;float: left;margin: 0px 10px 10px 0px;}
.proDetails{float: left;}
  span.icon {
      background: url('{{path to your button image}}') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
      border-right: #2265d4 1px solid;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;
      padding-left: 42px;
      padding-right: 42px;
      font-size: 14px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;}
</style> 

<script>
    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function(){
            auth2 = gapi.auth2.init({
                client_id: '977212213737-0hetk3ndbhcllss7qjp1hi1o9gj734mi.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
            });
          attachSignin(document.getElementById('customBtn'));
        });
    };
    function attachSignin(element) {
        //console.log(element.id);
        auth2.attachClickHandler(element, {},
        function(googleUser) {
            document.getElementById('name').innerText = "Signed in: " +
            googleUser.getBasicProfile().getName();
            $.ajax({
                method:'POST',
                url:$base_url+'/App/googleLogin',
                data: {
                    google_id: googleUser.getBasicProfile().getId(),
                    name: googleUser.getBasicProfile().getName(),
                    familyname: googleUser.getBasicProfile().getFamilyName(),
                    imageUrl: googleUser.getBasicProfile().getImageUrl(),
                    email: googleUser.getBasicProfile().getEmail()
                },
                success:function(html){
                    if(html == 2){
                        var profileHTML = '<div class="profile"><img src="'+googleUser.getBasicProfile().getImageUrl()+'"/><br>  Welcome '+googleUser.getBasicProfile().getName()+'! click here for register <a href="javascript:void(0);" onclick="Redirect();">Click here...</a></div>';
                        $('.userContent').html(profileHTML);      
                    }else if(html == 1){             
                      window.location.href = $base_url+'/App/book_order';
                    }else{
                        console.log(hfsdgf);
                        return false;               
                    }
                }
            });
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
    }
</script>


    
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                  <div class="GEt_free">
                         <div class="userContent"></div>
                        <!-- <img src="<?php echo base_url();?>/public/images/free-estimate.png" alt="#" class="image-responsive">
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control bord_right" id="email" placeholder="Enter Pickup Address">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control bord_left" id="email" placeholder="Enter Destination Address">
                            </div>
                            <button type="button">Check Now</button>
                        </form> -->
                    </div>
                    <div class="banner-text"><h1><span>Welcome</span> to<br> Movers on Demand</h1><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><a href="<?php echo base_url("App/Estimate");?>">Get a Free Estimate</a></div>


                </div>
                <div class="col-md-5 col-sm-5">

                    <!-- signIN -->
                    <div class="SIgn_form">
                    <img src="<?php echo base_url();?>/public/images/signin-icon.png" alt="#">
                        <h1>Sign<span>In</span></h1>
                                                <h6> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor </h6>
			<div >
                               <span id ="error" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="LoginEmail" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="LoginPassword" placeholder="Password">
                        </div>
                        <a href="#" data-toggle="modal" data-target="#Forgot">Forgotten Password?</a>
<div class="social-icon-if">
                        <div class="FAV_sign">
                        <div class="fb-icon-index"><img src="<?php echo base_url();?>/public/images/facebook.png"></div>
                            <div class="fb-login-button" data-max-rows="1" data-size="small" data-button-type="continue_with" data-show-faces="false" onlogin="checkLoginState()" data-auto-logout-link="false" data-use-continue-as="false"></div>
                           <!--   <div class="g-signin2" id="custom_signin_button" data-onsuccess="onSignIn"></div> -->
                             <!-- <div id="gSignIn" onclick="log();"></div>-->
                                <!-- HTML for displaying user details -->
                                
                           <!--  <ul>
                                <li><a href="#"><i class="fa fa-google-plus" id="custom_signin_button" data-onsuccess="onSignIn" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            </ul> -->
                        </div>

                        <div id="gSignInWrapper">
                            <span class="label"></span>
                            <div id="customBtn" class="customGPlusSignIn">
                            <div class="google-icon-index"><img src="<?php echo base_url();?>/public/images/google-plus.png"></div>
                              <span class="icon"></span>
                              <span class="buttonText">Google</span>
                            </div>
                        </div></div>
                        <div id="name"></div>
                        <script>startApp();</script>



                        <div class="SIghIn">
                            <button id="signin" type="button">Sign In</button>
                            <h4>Don't have an account? <a href="<?php echo base_url();?>App/Signup" > Create Now!</a></h4>
                        </div>
                    </div>
                   <!--  sign UP -->



                </div>
            </div>
        </div>
    </section></section>
    <section class="download_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="app_store">
                        <h2>Lorem ipsum dolor sit amet.</br><span>Rate & Review</span> us on</h2>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="download_from">
                        <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                        <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_box">
                        <img src="<?php echo base_url();?>/public/images/Artboard.png" alt="#" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_RIGht">
                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit dolor sit.</h3>
                        <h5>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu.</h5>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                          <img class="media-object" src="<?php echo base_url();?>/public/images/feature.png" alt="#">
                                        </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Your Feature 1 goes here</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                          <img class="media-object" src="<?php echo base_url();?>/public/images/feature.png" alt="#">
                                        </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Your Feature 1 goes here</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                          <img class="media-object" src="<?php echo base_url();?>/public/images/feature.png" alt="#">
                                        </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Your Feature 1 goes here</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="SMall_mRGIN">
        <div class="container">
            <div class="row">
                <!--                                 <div class="col-md-6 col-sm-6">
                                  <div class="SAle_move">
                                    <img src="images/move-type.png">
                                    <div class="arrow">
                                      <h4>small moves</h4>
                                      <img src="images/movetype-arrow-green.png" alt="#">
                                    </div>
                                </div>

                                  <div class="SAle_move_hovr">
                                    <img src="images/move-type_ff.png">
                                    <div class="arrow_hovr">
                                      <h4>small moves</h4>
                                      <img src="images/movetype-arrow-green_ff.png" alt="#">
                                    </div>
                                </div>

                                </div> -->
                <div class="col-md-6 col-sm-6">
                    <div class="SAle_move">
                        <img src="<?php echo base_url();?>/public/images/move-type.png" class="opacity">
                          <img src="<?php echo base_url();?>/public/images/move-type-white.png" class="white">
                        <div class="arrow">
                            <h4>small moves</h4>
                            <!-- <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                           <img src="<?php echo base_url();?>/public/images/movetype-arrow-green_ff.png" class="boytm"> -->

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                                       <div class="SAle_move">
                        <img src="<?php echo base_url();?>/public/images/store-pickup-green.png" class="opacity">
                        <img src="<?php echo base_url();?>/public/images/store-pickup-white.png" class="white">
                        <div class="arrow">
                            <h4>Store Pickup</h4>
                            <!-- <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                           <img src="<?php echo base_url();?>/public/images/movetype-arrow-green_ff.png" class="boytm"> -->

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                   <div class="SAle_move">
                       <img src="<?php echo base_url();?>/public/images/gumtree-pickup-green.png" class="opacity">
                          <img src="<?php echo base_url();?>/public/images/gumtree-pickup-white.png" class="white">
                        <div class="arrow">
                            <h4>gumtree pickup</h4>
                           <!-- <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                           <img src="<?php echo base_url();?>/public/images/movetype-arrow-green_ff.png" class="boytm"> -->

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                   <div class="SAle_move">
                       <img src="<?php echo base_url();?>/public/images/rubbish-removal-green.png" class="opacity">
                          <img src="<?php echo base_url();?>/public/images/rubbish-removal-white.png" class="white">
                        <div class="arrow">
                            <h4>rubbish removal</h4>
                            <!-- <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                           <img src="<?php echo base_url();?>/public/images/movetype-arrow-green_ff.png" class="boytm"> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="select-vehicle_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="VEhicle_check">
                        <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit sit amet.</h2>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <button type="button">Check Now</button>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="MObile">
                        <img src="<?php echo base_url();?>/public/images/hand--phonr.png" alt="#" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="iTWorks">
                        <h2>Here's How it works</h2>
                        <p>Follow these simple steps and you're good to go!</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="MObile">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row MRgin_top">
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_box">
                        <img src="<?php echo base_url();?>/public/images/step-1.png" alt="#" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_RIGht">
                        <div class="media">
                            <div class="media-left radius">
                                <a class="NUmber_Font" href="#">1 </a>
                            </div>
                            <div class="media-body AAp_Req">
                                <h4 class="media-heading">Request in the app</h4>
                                <p>Set your pickup location and destination, choose the size of vehicle that is right for you, and when you would like us to arrive.</p>
                            </div>
                            <div class="download_Request">
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row MRgin_top">
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_RIGht">
                        <div class="media">
                            <div class="media-left radius">
                                <a class="NUmber_Font" href="#">2 </a>
                            </div>
                            <div class="media-body AAp_Req">
                                <h4 class="media-heading">Don't lift a finger</h4>
                                <p>We'll take it from here. Two strong Luggers arrive to load your stuff and secure it safely. We'll see you at your destination!</p>
                            </div>
<!--                             <div class="download_Request">
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_box">
                        <img src="<?php echo base_url();?>/public/images/step-2.png" alt="#" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="row MRgin_top">
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_box">
                        <img src="<?php echo base_url();?>/public/images/step-3.png" alt="#" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="GIft_RIGht">
                        <div class="media">
                            <div class="media-left radius">
                                <a class="NUmber_Font" href="#">3</a>
                            </div>
                            <div class="media-body AAp_Req">
                                <h4 class="media-heading">Rate and Review</h4>
                                <p>We unload your items and place them right where you want them. Tell us about your experience and tip your Luggers for a job well done.</p>
                            </div>
<!--                             <div class="download_Request">
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="CLient_slider">
        <div class="container-fluid remove_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!--              <ol class="carousel-indicators">
                              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol> -->
                            <div class="carousel-inner">
                                <div class="item  active">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="CIient_SAys">
                                                <div class="RADius">
                                                    <img src="<?php echo base_url();?>/public/images/radius.png" alt="#">
                                                </div>
                                                <h4>Simothy James</h4>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <div class="SUMery">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                <a href="#">Explore More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="CIient_SAys">
                                                <div class="RADius">
                                                    <img src="<?php echo base_url();?>/public/images/radius.png" alt="#">
                                                </div>
                                                <h4>Simothy James</h4>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <div class="SUMery">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                <a href="#">Explore More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="CIient_SAys">
                                                <div class="RADius">
                                                    <img src="<?php echo base_url();?>/public/images/radius.png" alt="#">
                                                </div>
                                                <h4>Simothy James</h4>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <div class="SUMery">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                <a href="#">Explore More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="REad_More">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="Read_text">
                        <h4>Become a <span>Mover</span> Now</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="REad_BUTon">
                        <button type="button">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
