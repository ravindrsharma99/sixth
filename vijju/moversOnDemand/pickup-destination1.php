<?php include 'Header.php'; ?>
<?php //include 'Left_sidebar.php'; ?>
<?php


if(isset($_POST['submit'])){
	echo "<pre>";print_r($_POST);die;
}



?>

<!-- MAIN CONTENT -->
<div class="container" id="main">
<div class="row  background_BluRr">
<div class="col-md-12 col-sm-12">
<div class="LogOut pull-right"><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
</div>
<!-- CUSTOM COLUMNS -->
<div class="row show-grid">
<div class="col-sm-1 col-md-1-offset"></div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_Green">
<span class=""><img src="images/img/step-1-white.png" alt="Step-1"></span>
</div>
<div class="progress_lin_RED"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="images/img/step2-grey.png" alt="Step-2"></span>
</div>
<div class="progress_lin"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="images/img/step3-grey.png" alt="Step-3"></span>
</div>
<div class="progress_lin"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="images/img/step4-grey.png" alt="Step-4"></span>
</div>
<div class="progress_lin"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="images/img/step5-grey.png" alt="Step-5"></span>
</div>
</div>
</div>
<!-- / CUSTOM COLUMNS -->
</div>
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<!-- Content Wrapper -->
<div class="Content_WraPper">
<div class="heaDiNg_main">
<h2 class="text-capitalize">Pickup & Destination</h2></div>
<div class="content-main content-pickup-dest">
<div class="content-map">
<form action="http://localhost/Movers/pickup-destination.php" method="POST">
<input id="pac-input" class="controls" type="text" placeholder="Start location">
<input id="searchh" class="controls" type="text" placeholder="End Location">
<div id="map" style="width:auto;height:400px;"></div>

<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3150.041692270873!2d144.89937881562923!3d-37.85931487974423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad666eed877d779%3A0x60ddae14a2f2c435!2s1+Ferguson+St%2C+Williamstown+VIC+3016%2C+Australia!5e0!3m2!1sen!2sin!4v1505221033115" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->


</div>
<div class="content-addr">
<div class="addr-inner addr-pickup">
<div class="addr-inner-img"><img src="images/pickup_location.png" class="img-responsive" /></div>
<div class="addr-inner-content">
<h5>Pickup Location</h5>
<input type="hidden" name ="pickup" id="location">
<input type="hidden" name="lat" id="lat">
<input type="hidden" name="lng" id="lng">
<p><span id="startLoc"></span></p>
</div>
</div>
<div class="dots"><img src="images/dots.png" class="img-responsive" /></div>
<div class="addr-inner addr-dest">
<div class="addr-inner-img"><img src="images/dropoff_location.png" class="img-responsive"></div>
<div class="addr-inner-content">
<h5>Dropoff Location</h5>
<input type="hidden" name="dropoff" id="location1">
<input type="hidden" name="lat1" id="lat1">
<input type="hidden" name="lng1" id="lng1">
<p><span id="endloc"></span></p>
</div>
</div>
</div>
<div class="select-movers-flights">
<div class="smf-inner">
<div class="smf-inner-content"><img src="images/movers_reqd.png"> <span>Movers Required</span></div>
<div class="smf-inner-btns"><img src="images/movers_reqd_single.png">
<label class="switch">
<input type="checkbox" checked>
<span class="slider round"></span>
</label>
<img src="images/movers_reqd.png"></div>
</div>
<div class="smf-inner">
<div class="smf-inner-content"><img src="images/flight-of-stairs_pickup.png"> <span>Flights of Stairs <i>(If no elevator)</i></span></div>
<div class="smf-inner-btns">
<div class="quantity-btn NUmber_Font">
<span class="input-group-btn btn-qty-left">
<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
<span class="glyphicon glyphicon-minus"></span>
</button>
</span>
<input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
<span class="input-group-btn btn-qty-right">
<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
<span class="glyphicon glyphicon-plus"></span>
</button>
</span>
</div>
</div>
</div>
<div class="smf-inner">
<div class="smf-inner-content"><img src="images/flight-of-stairs_dropoff.png"> <span>Flights of Stairs <i>(If no elevator)</i></span></div>
<div class="smf-inner-btns">
<div class="quantity-btn NUmber_Font">
<span class="input-group-btn btn-qty-left">
<button type="button" class="quantity-left-minus1 btn btn-danger btn-number"  data-type="minus" data-field="">
<span class="glyphicon glyphicon-minus"></span>
</button>
</span>
<input type="text" id="quantity1" name="quantity1" class="form-control input-number" value="10" min="1" max="100">
<span class="input-group-btn btn-qty-right">
<button type="button" class="quantity-right-plus1 btn btn-success btn-number" data-type="plus" data-field="">
<span class="glyphicon glyphicon-plus"></span>
</button>
</span>
</div>
</div>
</div>
</div>
</div>
<!-- / Content Wrapper -->
</div>
<div class="row">
<div class="col-md-12 col-sm-12">
<div class="previous">
<a href="#">
<button type="button">Previous</button>
</a>
<!-- <a href="http://localhost/Movers/Sidebar_vehicle-type.php"> -->
<input type="submit" name="submit" value="submit">
</a>
</div>
</div>
</div>
</form>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/e5033262f5.js"></script>
<script type="text/javascript">
$(document).ready(function() {

var quantitiy = 0;
$('.quantity-right-plus').click(function(e) {

// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity = parseInt($('#quantity').val());

// If is not undefined

$('#quantity').val(quantity + 1);


// Increment

});

$('.quantity-left-minus').click(function(e) {
// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity = parseInt($('#quantity').val());

// If is not undefined

// Increment
if (quantity > 0) {
$('#quantity').val(quantity - 1);
}
});

});
</script>

<script type="text/javascript">
$(document).ready(function() {

var quantitiy1 = 0;
$('.quantity-right-plus1').click(function(e) {

// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity1 = parseInt($('#quantity1').val());

// If is not undefined

$('#quantity1').val(quantity1 + 1);


// Increment

});

$('.quantity-left-minus1').click(function(e) {
// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity1 = parseInt($('#quantity1').val());

// If is not undefined

// Increment
if (quantity1 > 0) {
$('#quantity1').val(quantity1 - 1);
}
});

});
</script>
</body>

</html>

<script>
  function initAutocomplete() {
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 30.7262141,lng: 76.8451191},
      zoom: 16,
      mapTypeId: 'roadmap'
    });
    var marker = new google.maps.Marker({
      map: map,
      position: {lat: 30.7262141,lng: 76.8451191},
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
    });
    var mark = new google.maps.Marker({
      map: map,
      position: {lat: 30.7262141,lng: 76.8451191},
      draggable: true,
      icon: 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png',
      anchorPoint: new google.maps.Point(0, -29)
    });        
    var input = document.getElementById('pac-input');
    var search = document.getElementById('searchh');

    var geocoder = new google.maps.Geocoder();

    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var searchBox1 = new google.maps.places.SearchBox(search);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(search);

    var infowindow = new google.maps.InfoWindow();
    
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });
    map.addListener('bounds_changed', function() {
      searchBox1.setBounds(map.getBounds());
    });

    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();
      if (places.length == 0) {
        return;
      }          
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
        showTooltip(infowindow,marker,place.formatted_address);
      });
      map.fitBounds(bounds);
    });

    searchBox1.addListener('places_changed', function() {
      var places = searchBox1.getPlaces();
      if (places.length == 0) {
        return;
      }          
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
        mark.setPosition(place.geometry.location);
        mark.setVisible(true);

        bindDataToForm1(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, mark);
        showTooltip1(infowindow,mark,place.formatted_address);
      });
      map.fitBounds(bounds);
    });

    google.maps.event.addListener(marker, 'dragend', function() {
      geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if(status == google.maps.GeocoderStatus.OK) {
          if(results[0]){        
            bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
            showTooltip(infowindow,marker,results[0].formatted_address);
            document.getElementById('pac-input');
          }
        }
      });
    });

    google.maps.event.addListener(mark, 'dragend', function() {
      geocoder.geocode({'latLng': mark.getPosition()}, function(results, status) {
        if(status == google.maps.GeocoderStatus.OK) {
          if(results[0]){        
            bindDataToForm1(results[0].formatted_address,mark.getPosition().lat(),mark.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, mark);
            showTooltip1(infowindow,mark,results[0].formatted_address);
            document.getElementById('searchInput');
          }
        }
      });
    });
  }
  function bindDataToForm(address,lat,lng){
    document.getElementById('startloc').innerHTML = address;
    document.getElementById('location').value = address;
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;

  }
  function showTooltip(infowindow,marker,address){
    google.maps.event.addListener(marker, 'click', function() { 
      infowindow.setContent(address);
      infowindow.open(map, marker);
    });
  }
  function showTooltip1(infowindow,mark,address){
    google.maps.event.addListener(mark, 'click', function() { 
      infowindow.setContent(address);
      infowindow.open(map, mark);
    });
  }
  function bindDataToForm1(address,lat,lng){
    document.getElementById('endloc').innerHTML = address;
    document.getElementById('location1').value = address;
    document.getElementById('lat1').value = lat;
    document.getElementById('lng1').value = lng;
    
  }
  $("#myModal").on('show.bs.modal', function(event) {
    setTimeout(function() {
        initAutocomplete();
        google.maps.event.trigger(map, "resize");
    }, 1000);
  });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACSueOTI5iEZBVIu-G7ROeW2DiQn8tVGw&libraries=places&callback=initAutocomplete" async defer></script>