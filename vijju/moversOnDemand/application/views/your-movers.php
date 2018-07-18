
<!-- MAIN CONTENT -->
<div id="main" class="container" >

<div class="your-moves-wrapper" >
<div class="row  background_BluRr">
                <div class="col-md-12">
                    <div class="LogOut pull-right"><a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
                </div>
                <!-- CUSTOM COLUMNS -->
    </div>
              
<div class="header-your-moves">Your Moves</div>

<div class="table-responsive">

<table class="table table-your-moves">
  <thead>
    <tr>
      <th>Date </th>
      <th>Driver</th>
      <th>Fare</th>
      <th>Vehicle</th>
      <th>Pickup</th>
      <th>Dropoff</th>
    </tr>
  </thead>
  <tbody>

					<?php
					$myData = $output->Response; 
						//print_r($myData);die; 
					foreach($myData as $key=>$value){
				
							 ?>
       <tr  data-toggle="collapse" data-target="#accordion" class="clickable clickable<?php echo $key;?>">
       <td class="NUmber_Font"><?php echo $value->booking_date;?></td>
      <td>Otto</td>
      <td class="NUmber_Font"><?php echo $value->estimated_price;?> <button class="move-label completed">Completed</button></td>
        <td>XL Van</td>
      <td><?php echo $value->pickup_loc;?></td>
      <td><?php echo $value->destination_loc;?></td>
    </tr>
       
<tr>    <td colspan="6"> 

    <div id="accordion" class="collapse"><div class="your-move-detail-box">
      <div class="row"><div class="col-md-12 col-lg-4 col-sm-12"><div class="mdb-img">
<img src="https://maps.googleapis.com/maps/api/staticmap?size=350x250&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|<?php echo $value->pickup_latitude;?>,<?php echo $value->pickup_longitude;?>&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|<?php echo $value->destination_latitude;?>,<?php echo $value->destination_longitude;?>&path=weight:5%7Ccolor:0x14456a%7Cenc:<?php echo base64_decode($value->path_polyline);?>&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img></div></div>


      <div class="col-md-12 col-lg-5 col-sm-12 main-center-border-mdb"><div class="mdb-content"><h4 class="NUmber_Font price">$<?php echo $value->estimated_price;?></h4><p class="time-date"><?php echo $value->booking_date ; echo "  ".$value->booking_time; ?></p>

      <div class="content-addr-your-move">
    
<div class="addr-inner addr-pickup"><div class="addr-inner-img"><img src="<?php echo base_url('public/');?>images/move-details-pickup.png" class="img-responsive"></div> <div class="addr-inner-content"><h5>Pickup Location</h5><p><?php echo $value->pickup_loc;?></p></div></div>

<div class="addr-inner addr-dest"><div class="addr-inner-img"><img src="<?php echo base_url('public/');?>images/move-details-destination.png" class="img-responsive"></div> <div class="addr-inner-content"><h5>Pickup Location</h5><p><?php echo $value->destination_loc;?></p></div></div>

</div></div>
</div>
 <div class="ccol-md-12 col-lg-3 col-sm-12"><div class="mdb-star-detail"><div class="stars"><i class="fa fa-star green" aria-hidden="true"></i>
<i class="fa fa-star green" aria-hidden="true"></i>
<i class="fa fa-star green" aria-hidden="true"></i>
<i class="fa fa-star green" aria-hidden="true"></i>
<i class="fa fa-star grey" aria-hidden="true"></i></div>
<div class="SIghIn">
 <button type="button">View Details</button>
  </div>
</div></div></div>
         </div></div></td></tr> 

  </div> <?php } ?>
 </tbody></table></div></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
         <script src="https://use.fontawesome.com/e5033262f5.js"></script>
         <!--<script type="text/javascript">
jQuery('.clickable0').click(function(){
jQuery('.clickable0').toggleClass('row-opened0');
});
jQuery('.clickable1').click(function(){
jQuery('.clickable1').toggleClass('row-opened1');
});
jQuery('.clickable2').click(function(){
jQuery('.clickable2').toggleClass('row-opened2');
});
jQuery('.clickable3').click(function(){
jQuery('.clickable3').toggleClass('row-opened3');
});
 </script> -->
</body>
</html>
