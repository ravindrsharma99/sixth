

<!-- MAIN CONTENT -->
<div class="container" id="main">
<div class="row  background_BluRr">
<div class="col-md-12">
<div class="LogOut pull-right"><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
</div>
<!-- CUSTOM COLUMNS -->
<div class="row show-grid">
<div class="col-sm-1 col-md-1-offset"></div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_Green">
<span class=""><img src="<?php echo base_url();?>public/images/img/step-1-white.png" alt="Step-1"></span>
</div>
<div class="progress_lin_RED"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="<?php echo base_url();?>public/images/img/step2-grey.png" alt="Step-2"></span>
</div>
<div class="progress_lin"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="<?php echo base_url();?>public/images/img/step3-grey.png" alt="Step-3"></span>
</div>
<div class="progress_lin"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="<?php echo base_url();?>public/images/img/step4-grey.png" alt="Step-4"></span>
</div>
<div class="progress_lin"></div>
</div>
<div class="col-sm-2 col-md-2 text-center">
<div class="Step_White">
<span class=""><img src="<?php echo base_url();?>public/images/img/step5-grey.png" alt="Step-5"></span>
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
<h2 class="text-capitalize">Pickup & Destination </h2></div>
<div class="content-main content-pickup-dest">
<div class="content-map">
 <div id ="mapsss" style="height:400px"></div>
</div>
<input type="text" id="waysearch" placeholder="Search Location">
<div class="content-addr">
<div class="addr-inner addr-pickup">
<div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/pickup_location.png" class="img-responsive" /></div>
<div class="addr-inner-content">
<h5>Pickup Location</h5>
<p>1 Ferguson St, Williamstown VIC 3016</p>
</div>
</div>

<div class="dots"><img src="<?php echo base_url();?>public/images/dots.png" class="img-responsive" /></div>
<div class="addr-inner addr-dest">
<div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/dropoff_location.png" class="img-responsive"></div>
<div class="addr-inner-content">
<h5>Dropoff Location</h5>
<p>1 Ferguson St, Williamstown VIC 3016</p>
</div>
</div> 
</div>
<form action="<?php echo base_url(); ?>App/page3" method="POST">
<div class="select-movers-flights">
<div class="smf-inner">
<div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/movers_reqd.png"> <span>Movers Required</span></div>
<div class="smf-inner-btns"><img src="<?php echo base_url();?>public/images/movers_reqd_single.png">
<label class="switch">
<input type="checkbox" >
<span class="slider round"></span>
</label>
<img src="<?php echo base_url();?>public/images/movers_reqd.png"></div>
</div>
<div class="smf-inner">
<div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/flight-of-stairs_pickup.png"> <span>Flights of Stairs <i>(If no elevator)</i></span></div>
<div class="smf-inner-btns">
<div class="quantity-btn NUmber_Font">
<span class="input-group-btn btn-qty-left">
<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
<span class="glyphicon glyphicon-minus"></span>
</button>
</span>
<input type="text" id="quantity" name="quantity" class="form-control input-number" value="0" min="0" max="100">
<span class="input-group-btn btn-qty-right">
<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
<span class="glyphicon glyphicon-plus"></span>
</button>
</span>
</div>
</div>
</div>
<div class="smf-inner">
<div class="smf-inner-content"><img src="<?php echo base_url();?>public/images/flight-of-stairs_dropoff.png"> <span>Flights of Stairs <i>(If no elevator)</i></span></div>
<div class="smf-inner-btns">
<div class="quantity-btn NUmber_Font">
<span class="input-group-btn btn-qty-left">
<button type="button" class="quantity-left-minus1 btn btn-danger btn-number"  data-type="minus" data-field="">
<span class="glyphicon glyphicon-minus"></span>
</button>
</span>
<input type="text" id="quantity1" name="quantity" class="form-control input-number" value="0" min="0" max="100">
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
 <button type="submit" name="submit">Next</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
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
<script type="text/javascript">
		  function selectStart() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var fullAddress = JSON.parse(this.responseText);
                        var str = fullAddress.results[0].formatted_address;
                        document.getElementById("start_location").value = fullAddress.results[0].formatted_address;
                        document.getElementById("start_location_outer").value = fullAddress.results[0].formatted_address;
                        document.getElementById("start_location_outer_d").value = fullAddress.results[0].formatted_address;
                        document.getElementById("start_location_lat").value = map.getCenter().lat();
                        document.getElementById("start_location_lng").value = map.getCenter().lng();
                    }
                };
                xhttp.open("GET", 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + map.getCenter().lat() + ',' + map.getCenter().lng() + '&sensor=true', true);
                xhttp.send();
            }
                 function initMap() {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                map = new google.maps.Map(document.getElementById('mapsss'), {
                   // center: {
                    //      lat: 30.7262141,
                    //      lng: 76.8451191
                    // },
                    zoom: 16
                });
                var marker = new google.maps.Marker({
                  map: map,
                 // position: {lat: 30.7262141,lng: 76.8451191},
                  draggable: true,
                  anchorPoint: new google.maps.Point(0, -29)
                });
                var input = document.getElementById('waysearch');
                var geocoder = new google.maps.Geocoder();
                var searchBox = new google.maps.places.SearchBox(input);
                var infowindow = new google.maps.InfoWindow();
                map.addListener('bounds_changed', function() {
                  searchBox.setBounds(map.getBounds());
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
                    });
                  map.fitBounds(bounds);
                });               
                map.addListener('center_changed', function() {
                    marker.setPosition(map.getCenter());
			console.log(map.getCenter().lat());
			console.log(map.getCenter().lng());
                });
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var marker = new google.maps.Marker({
                          map: map,
                          position: pos,
                          draggable: true,
                          anchorPoint: new google.maps.Point(0, -29)
                        });
                        map.setCenter(pos);
                    }, function() {
                    });                    
                } else {
                    alert("Your browser doesn't support geo location. Please scroll manually.");
                }
            }
            </script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACSueOTI5iEZBVIu-G7ROeW2DiQn8tVGw&libraries=places&callback=initMap">
</script>

