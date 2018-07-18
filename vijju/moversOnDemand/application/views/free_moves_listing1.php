<?php //echo "<pre>";print_r($promocodes);die; ?>
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
      <div class="Content_WraPper free-moves-wrapper">
        <div class="heaDiNg_main ">
          <h2 class="text-capitalize">Promo/Referral Code</h2>
          <p><?php if(isset($_SESSION['successpromodata'])){echo $_SESSION['successpromodata'];}else{ echo $_SESSION['errorpromo']; } ?><p>
          <div class="apply-code-input">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                <form action="<?php echo base_url(); ?>applyrefer" method="POST">
                  <div class="col-sm-8 col-md-8 col-lg-10">
                    <div class="enter-code">
                      <input class="form-control" type="text" placeholder="Enter Code here..." name="promocode">
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-2 col-xs-4 col-xs-offset-4 col-sm-offset-0">
                    <div class="previous apply-code btn-green">
                      <a href="http://phphosting.osvin.net/Movers/free-moves-listings.php">
                        <input type="submit" name="applypromo" value="Apply">
                      </a>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="promo-code-tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
              <a class="nav-link " data-toggle="tab" href="#applied-code" onclick = "promoListing(1,<?php print_r($_SESSION['user_details']->id); ?>)" role="tab" aria-controls="home">Applied</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#available-code"  onclick = "promoListing(2,<?php print_r($_SESSION['user_details']->id); ?>)" role="tab" aria-controls="profile">Available</a>
            </li>
          </ul>
           <div class="tab-content" id ="showmydata">
            <?php if(isset($refercode[0])){ ?>
            <a href="#" data-toggle="modal" data-target="#applyreffer">
              <div class="promo-code-listing">
                <div class="pcl-left-img"><img src="<?php echo base_url(); ?>/public/images/referral-code.png" class="img-responsive"></div>
                <div class="pcl-right-content text_grey"><p class="main-content"><b><?php echo $refercode[0]->referdata->referal_percentage ; ?>% off</b> on booking. Avail offer max upto <?php echo "$ ".$refercode[0]->referdata->referal_amount; ?>.</p><p class="content-subheading">Referred By <?php echo $refercode[0]->referbyname->fname.' '.$refercode[0]->referbyname->lname; ?></p></div>
              </div>
            </a>
            <?php } else{} ?>

            <?php
              foreach($promocodes as $key => $value){
                $date = date("d M y", strtotime($value->expiry_date));
                echo '<div>
                        <a href="#" data-toggle="modal" data-target="#applypromo'.$value->id.'"><div class="promo-code-listing">
                          <div class="pcl-left-img"><img src="'.base_url('public').'/images/referral-code.png" class="img-responsive"></div>
                          <div class="pcl-right-content text_grey"><p class="main-content"><b>'.$value->value.'% off</b> on your next referral. Avail offer max upto $'.$value->max_amount.'.</p><p class="content-subheading">Valid till ' .$date.'</p></div>
                         </div>
                        </a>
                      
                    </div> ';
                  }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  