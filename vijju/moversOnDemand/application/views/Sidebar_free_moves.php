<!-- MAIN CONTENT -->
<script type="text/javascript">
    $('#freeMoves').addClass('menu_active');</script>
<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12 col-sm-12">
            <div class="LogOut pull-right">
                <a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
                  <span>Logout</span>
                </a>
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <!-- Content Wrapper -->
            <div class="Content_WraPper Content_WraPper-inner free-moves-wrapper">
                <div class="heaDiNg_main">
                    <h2 class="text-capitalize">free moves</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class=" text-center">
                            <div class="free-moves-img"><img src="<?php echo base_url('public/');?>images/free-moves-bg.png" alt="Free Moves" class="img-responsive blank_SpAce"></div>
                            <h1 class="text-GreEn text-capitalize">get $20 off</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h4 class="text-center text_grey weight_300 desc_code">Get free moves worth upto $20 when you refer a friend to try Movers.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="InVite_coDe-wrap"> <div class="InVite_coDe">
                            <span><?php print_r($_SESSION['user_details']->refercode);?></span><img src="<?php echo base_url('public/');?>images/coupon-code.png" class="img-responsive">
                        </div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="share-referral text-center"><a> <span class="text_grey">Share Referral Code</span></a></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                <div class="previous btn-green btn-big">
                    <a href="<?php echo base_url('refercode'); ?>">
                        <button type="button">Promo/Referral Code</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content Wrapper -->              
    </div>
</div>

