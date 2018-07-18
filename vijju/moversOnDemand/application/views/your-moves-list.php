<?php if(isset($_SESSION['MoveHistory'])){ $dec = json_decode($_SESSION['MoveHistory']);} ?>
<!-- MAIN CONTENT -->
<div id="main" class="container" >

<div class="your-moves-wrapper" >
<!-- <div class="header-your-moves">Your Moves</div> -->
<ul class="nav nav-tabs nav-listings" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#pending" onclick = "MoveListing(1,<?php echo $_SESSION['user_details']->id; ?>)" role="tab">Pending</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#active"  onclick = "MoveListing(2,<?php echo $_SESSION['user_details']->id; ?>)" role="tab">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#completed"  onclick = "MoveListing(3,<?php echo $_SESSION['user_details']->id; ?>)" role="tab">Completed</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#cancelled"  onclick = "MoveListing(4,<?php echo $_SESSION['user_details']->id; ?>)" role="tab">Cancelled</a>
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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
         <script src="https://use.fontawesome.com/e5033262f5.js"></script>
         <script type="text/javascript">
jQuery('.clickable1').click(function(){
jQuery('.clickable1').toggleClass('row-opened1');
});
jQuery('.clickable2').click(function(){
jQuery('.clickable2').toggleClass('row-opened2');
});
jQuery('.clickable3').click(function(){
jQuery('.clickable3').toggleClass('row-opened3');
});
jQuery('.clickable4').click(function(){
jQuery('.clickable4').toggleClass('row-opened4');
});
 </script>
</body>
</html>
