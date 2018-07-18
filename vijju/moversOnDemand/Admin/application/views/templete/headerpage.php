  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
          </div>
          <!--logo start--> 
          <a href="<?php echo base_url('Dashboard')?>" class="logo" >Welcome to <span> Movers </span> Dashboard </a>
          <!--logo end-->
 
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                <!--   <li>
                      <input type="text" class="form-control search" placeholder="Search">
                  </li> -->
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <img alt="" src="<?php echo base_url("public/img/avatar1_small.jpg")?>">
                          <span class="username"><?php echo  $name; ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>

                          <li><a href="<?php echo base_url("Logout"); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                          
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>

      </header>
