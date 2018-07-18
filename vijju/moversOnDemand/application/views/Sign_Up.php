
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="GEt_free">
                        <img src="<?php echo base_url();?>/public/images/free-estimate.png" alt="#" class="image-responsive">
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control bord_right" id="email" placeholder="Enter Pickup Address">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control bord_left" id="email" placeholder="Enter Destination Address">
                            </div>
                            <button type="button">Check Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5">

                    <!-- signIN -->
                    <div class="SIgn_form">
                        <h1>Sign<span>Up</span></h1>
                        <img src="<?php echo base_url();?>/public/images/signin-icon.png" alt="#">
                 
			<div class="form-group">
                               <span id ="error" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="comname" placeholder="Company Name">
                        </div>
                        <div class="Half_inputs">
                        <div class="form-group">
                            <input type="text" class="form-control" id="fname"  maxlength="25" onkeypress="return isname(event)" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lname" maxlength="25" onkeypress="return isname(event)" placeholder="Last Name">
                        </div>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" id="emailid"  onkeyup="email_validate(this.value);" placeholder="Email Address">
                        </div>
                       <div class="Half_inputs">
                        <div class="form-group">
                            <input type="text" class="form-control" onkeypress="return isNumber(event)" id="ccode" placeholder="Country Code">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="number" onkeypress="return isNumber(event)" placeholder="Phone Number">
                        </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="ref" placeholder="Referral Code">
                        </div>
                       <div class="Half_inputs">
                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="conpass" placeholder="Confirm Password">
                        </div>
                        </div>
                            <input type="hidden" value="1" id="usertype">       
                        <div class="SIghIn">
                            <button id ="signup" type="button">SIGN UP</button>
                            <h4>Already have an account? <a href="<?php echo base_url();?>App"> SIGN IN!</a></h4>
                        </div>
                    </div>
                   <!--  sign UP -->



                </div>
            </div>
        </div>
    </section>
    <section class="download_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="app_store">
                        <h2>Lorem ipsum dolor sit amet.</br><span>Rate & Reivew</span> us on</h2>
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
                                <h4 class="media-heading">Your Feathur 1 goes here</h4>
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
                                <h4 class="media-heading">Your Feathur 1 goes here</h4>
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
                                <h4 class="media-heading">Your Feathur 1 goes here</h4>
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
                        <img src="<?php echo base_url();?>/public/images/move-type.png">
                        <div class="arrow">
                            <h4>small moves</h4>
                            <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="SAle_move">
                        <img src="<?php echo base_url();?>/public/images/move-type.png">
                        <div class="arrow">
                            <h4>small moves</h4>
                            <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="SAle_move">
                        <img src="<?php echo base_url();?>/public/images/move-type.png">
                        <div class="arrow">
                            <h4>small moves</h4>
                            <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="SAle_move">
                        <img src="<?php echo base_url();?>/public/images/move-type.png">
                        <div class="arrow">
                            <h4>small moves</h4>
                            <img src="<?php echo base_url();?>/public/images/movetype-arrow-green.png" alt="#">
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
                                <a href="#">1 </a>
                            </div>
                            <div class="media-body AAp_Req">
                                <h4 class="media-heading">Request in the app</h4>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
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
                                <a href="#">1 </a>
                            </div>
                            <div class="media-body AAp_Req">
                                <h4 class="media-heading">Request in the app</h4>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <div class="download_Request">
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                            </div>
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
                                <a href="#">1 </a>
                            </div>
                            <div class="media-body AAp_Req">
                                <h4 class="media-heading">Request in the app</h4>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

                            </div>
                            <div class="download_Request">
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                                <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                            </div>
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
  
