     <div class="nav-side-menu">
            <div class="brand"><img src="<?php echo base_url();?>/public/images/logo.png" alt="logo"></div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content menu-content-list collapse out">
                    <li id="profile_InFo">
                        <a href="<?php echo base_url('profile'); ?>">
                     <span>Profile : <?php print_r($_SESSION['user_details']->fname.' '.$_SESSION['user_details']->lname);?></span>
                     </a>
                    </li>
                    <li id="homepage">
                        <a href="<?php print_r(base_url('des/').$_SESSION['user_details']->id.'/book'); ?>">
                     <i class="fa fa-truck" aria-hidden="true"> </i><span>Book a Move</span>
                     </a>
                    </li>
                   
                    <li data-toggle="collapse" data-target="#" id="yourmoves">
                        <a href=" <?php echo base_url('booking_detail'); ?>"><i class="fa fa-calendar-o" aria-hidden="true"> </i> <span>Your Moves</span>
                     </a>
                    </li>
                    <li data-toggle="collapse" data-target="#" id="cards">
                        <a href="<?php echo base_url('mycard'); ?>"><i class="fa fa-credit-card" aria-hidden="true"> </i> <span>Payment</span></a>
                    </li> 
                    <li data-toggle="collapse" data-target="#" id="freeMoves">
                        <a href="<?php echo base_url('free_moves'); ?>"><i class="fa fa-ticket" aria-hidden="true"> </i> <span>Free Moves</span></a>
                    </li>
                    <li id="FeedBack">
                        <a href="<?php echo base_url('feedback'); ?>">
                     <i class="fa fa-commenting-o" aria-hidden="true"> </i> <span>Send Feedback</span>
                     </a>
                    </li>
      
            
                </ul>
            </div>
        </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- datepicer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>/public/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js">

<script type="text/javascript">
jQuery('.menu-content-list li').click(function() {
    jQuery('.menu-content-list li.menu_active').removeClass('menu_active');
    jQuery(this).closest('li').addClass('menu_active');
});</script>
