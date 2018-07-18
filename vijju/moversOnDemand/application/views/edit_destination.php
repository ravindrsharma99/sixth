<?php //echo "<pre>";print_r($hello);die;
    $book = $booking_data[0];
    $static_key = "hbjkewhdkj@!88(*@098";
    $b_id = $book->id."_".$static_key;
    $iidb = base64_encode($b_id);
    //print_r($book); ?>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACSueOTI5iEZBVIu-G7ROeW2DiQn8tVGw&libraries=places&callback=initAutocomplete" async defer>
</script>

<style type="text/css">
.EST_BUTON{background: #202020 none repeat scroll 0 0; border: 0 none; border-radius: 50px; color: white; font-size: 26px; height: 68px; text-align: center; width: 174px; }
.modal-footer.BOTm {background: #17a37c; border: 0px solid #ccc; padding: 0; }
.POPBTN_cmn {background: transparent; width: 49%; float: left; border: 0px solid; color: #fff; font-size: 25px; margin: 0; padding: 12px 0; /* line-height: 39px; */ }
.POPBTN_cmn:first-child{border-right:1px solid #ccc; }
.POPBTN_cmn:hover{color: #000}
.POPUP_BUTn_INCREMENT {width: 190px; /* text-align: center; */ /* display: inline-block; */ /* float: left; */ margin: auto; }
.MODEl_Hading{color: #fff; font-size: 26px; margin-bottom: 13px;}
.modal-content {position: relative; background-color: #535353; -webkit-background-clip: padding-box; background-clip: padding-box; border: 0px solid #000; border: 1px solid rgba(0,0,0,.2); border-radius: 0; outline: 0; -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5); box-shadow: 0 3px 9px rgba(0,0,0,.5); }
#pac-input {border: 1px solid #ccc; height: 34px; font-size: 18px; padding: 0 6px; width: 250px; }
#searchh{border: 1px solid #ccc; height: 34px; font-size: 18px; padding: 0 6px;  width: 250px; }
.addr-inner-content h5 {line-height: 44px;}
.quantity-btn .input-group-btn.btn-qty-left .btn-danger, .quantity-btn .input-group-btn.btn-qty-right .btn-success, .quantity-btn .quantity-left-minus1.btn.btn-danger.btn-number, .quantity-btn .quantity-right-plus1.btn.btn-success.btn-number {
    background: #1cb68c none repeat scroll 0 0;
    border-radius: 50% !important;
    border: 0px;
}
#floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
</style>

<!-- MAIN CONTENT -->
<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12 col-sm-12">
            <div class="LogOut pull-right"><a href=" <?php echo base_url('App/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
        </div>
        <!-- CUSTOM COLUMNS -->
        <div class="row show-grid">
            <div class="col-sm-1 col-md-1-offset"></div>
            
        </div>
        <!-- / CUSTOM COLUMNS -->
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <!-- Content Wrapper -->
            <div class="Content_WraPper">
                <form action="<?php echo base_url(); ?>App/Edit_Move/<?php echo $iidb; ?>/<?php echo $book->vehicle_id; ?>" method="POST">
                    <div class="heaDiNg_main">
                        <h2 class="text-capitalize">Move Details</h2></div>
                    <div class="content-main content-pickup-dest">
                        <div class="content-map">
                            <input id="pac-input" class="controlss" type="text" placeholder="Start location">
                            <input id="searchh" class="controlss" type="text" placeholder="End Location">
                            <div id="floating-panel">
                                <b>Mode of Travel: </b>
                                <select id="mode">
                                  <option value="DRIVING">Driving</option>
                                  <option value="WALKING">Walking</option>
                                  <option value="BICYCLING">Bicycling</option>
                                  <option value="TRANSIT">Transit</option>
                                </select>
                            </div>
                            <div id="map" style="width:auto;height:400px;"></div>
                        </div>
                        <div class="content-addr">
                            <div class="addr-inner addr-pickup row">
                                <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/pickup_location.png" class="img-responsive" /></div>
                                <div class="addr-inner-content">
                                    <h5>Pickup Location</h5>
                                    <input type="hidden" name="pickup" id="location" value="<?php echo $book->pickup_loc; ?>">
                                    <input type="hidden" name="pickuplat" id="lat" value="<?php echo $book->pickup_latitude; ?>">
                                    <input type="hidden" name="pickuplng" id="lng" value="<?php echo $book->pickup_longitude; ?>">
                                    <p><span id="startloc"><?php echo $book->pickup_loc; ?></span></p>
                                </div>
                            </div>
                            <div class="addr-inner addr-dest row">
                                <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/dropoff_location.png" class="img-responsive"></div>
                                <div class="addr-inner-content">
                                    <h5>Dropoff Location</h5>
                                    <input type="hidden" name="dropoff" id="location1" value="<?php echo $book->destination_loc; ?>">
                                    <input type="hidden" name="dropofflat" id="lat1" value="<?php echo $book->destination_latitude; ?>">
                                    <input type="hidden" name="dropofflng" id="lng1" value="<?php echo $book->destination_longitude; ?>">
    			                    <input type="hidden" name="unloadingTime" id="unloadingTimeData" >
                                    <input type="hidden" name="loadingTime" id="loadingTimeData">
    				
                                    <p><span id="endloc"><?php echo $book->destination_loc; ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- / Content Wrapper -->
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="previous">
                        <button type="submit"  disabled="disabled" id="checkupData" name="editsubmit">Save Changes</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
    <script type="text/javascript">
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
        var quantitiy2 = 0;
        $('.quantity-right-plus2').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity2 = parseInt($('#quantity2').val());
            // If is not undefined
            $('#quantity2').val(quantity2 + 1);
            // Increment
        });

        $('.quantity-left-minus2').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity2 = parseInt($('#quantity2').val());
            // If is not undefined
            // Increment
            if (quantity2 > 0) {
                $('#quantity2').val(quantity2 - 1);
            }
        });



    var quantitiy3 = 10;
            $('.quantity-right-plus3').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity3 = parseInt($('#quantity3').val());
                // If is not undefined
                $('#quantity3').val(quantity3 + 1);
                // Increment
            });

            $('.quantity-left-minus3').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity3 = parseInt($('#quantity3').val());
                // If is not undefined
                // Increment
                if (quantity3 > 10) {
                    $('#quantity3').val(quantity3 - 1);
                }
            });

    var quantitiy4 = 10;
            $('.quantity-right-plus4').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity4 = parseInt($('#quantity4').val());
                // If is not undefined
                $('#quantity4').val(quantity4 + 1);
                // Increment
            });

            $('.quantity-left-minus4').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity4 = parseInt($('#quantity4').val());
                // If is not undefined
                // Increment
                if (quantity4 > 10) {
                    $('#quantity4').val(quantity4 - 1);
                }
            });
        });




    </script>
    </body>

    </html>
