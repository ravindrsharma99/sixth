<?php if(isset($_SESSION['MoveHistory'])){ $dec = json_decode($_SESSION['MoveHistory']);} ?>
<script type="text/javascript">
    $('#yourmoves').addClass('menu_active');</script>
<!-- MAIN CONTENT -->
<div id="main" class="container" >
<div class="row  background_BluRr">
  
                <div class="col-md-12">
                    <div class="LogOut pull-right"><a href=" http://phphosting.osvin.net/moversOnDemand/App/logout"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
                </div>
                <div class="col-md-12">
                    <div class="heading-bgtop"><h1>Your Moves</h1></div>
                </div>
                <!-- CUSTOM COLUMNS -->
    </div><?php
if ($this->session->flashdata('success') != ''): 
    echo $this->session->flashdata('success'); 
endif; ?>
<div class="your-moves-wrapper your-moves-list" >



<!-- <div class="header-your-moves">Your Moves</div> -->
<ul class="nav nav-tabs nav-listings" role="tablist">
  <li class="nav-item active">
    <a class="nav-link " data-toggle="tab" href="#pending" onclick = "MoveListing(1,<?php print_r($_SESSION['user_details']->id);?>)" role="tab">Pending</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#active"  onclick = "MoveListing(2,<?php print_r($_SESSION['user_details']->id);?>)" role="tab">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#completed"  onclick = "MoveListing(3,<?php print_r($_SESSION['user_details']->id);?>)" role="tab">Completed</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#cancelled"  onclick = "MoveListing(4,<?php print_r($_SESSION['user_details']->id);?>)" role="tab">Cancelled</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content tab-content-listing">
  <div class="tab-pane active" id="pending" role="tabpanel"><div class="table-responsive">
<table class="table table-your-moves" id="myTable">
  <thead>
    <tr>
      <th>Date </th>      
      <th>Fare</th>
      <th>Vehicle</th>
      <th>Pickup</th>
      <th>Dropoff</th>
    </tr>
  </thead>
  <tbody>		
 </tbody></table></div></div>
</div>
 </div>
 </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <script src="https://use.fontawesome.com/e5033262f5.js"></script>

</body>
</html>
