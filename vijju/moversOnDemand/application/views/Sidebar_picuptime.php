    <!-- MAIN CONTENT -->

<?php

    $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getVehicleMove'));
    // $timeData = $user->Response->timemanagementdata;
    $setting = $user->Response->settingdata[0];

    // echo "<pre>";print_r($timeData);
    $current = date('Y-m-d');
    for($i = 0; $i < $setting->type ; $i++){
        $date = date('Y-m-d', strtotime("+".$i."days", strtotime($current)));
        $dayName[] = date('Y-m-d', strtotime($date));      
    }
    // echo "<pre>";print_r($_SESSION); die; 
?>




<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12 col-sm-12">
            <div class="LogOut pull-right"><a href="<?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
        </div>
        <!-- CUSTOM COLUMNS -->
        <div class="row show-grid">
            <div class="col-sm-1 col-md-1-offset"></div>
            <div class="col-sm-2 col-md-2 text-center">
                <?php if(isset($_SESSION['moveType'])){ ?>
                    <div class="Step_Green">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step-1-white.png" alt="Step-1"></span>
                    </div>
                    <div class="progress_lin_RED"></div>
                <?php }else{ ?>
                    <div class="Step_White">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step-1-white.png" alt="Step-1"></span>
                    </div>
                    <div class="progress_lin"></div>
                <?php } ?>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
               <?php if(isset($_SESSION['mybookingData'])){ ?>
                    <div class="Step_Green">
                        <span class=""><img src="<?php echo base_url();?>public/images/step3-white.png" alt="Step-3"></span>
                    </div>
                    <div class="progress_lin_RED"></div>
                <?php }else{ ?>
                    <div class="Step_White">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step3-grey.png" alt="Step-3"></span>
                    </div>
                    <div class="progress_lin"></div>
                <?php } ?>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <?php if(isset($_SESSION['selectedVehicle'])){ ?>
                    <div class="Step_Green">
                        <span class=""><img src="<?php echo base_url();?>public/images/step4-white.png" alt="Step-4"></span>
                    </div>
                    <div class="progress_lin_RED"></div>
                <?php }else{ ?>
                    <div class="Step_White">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step4-grey.png" alt="Step-4"></span>
                    </div>
                    <div class="progress_lin"></div>
                <?php } ?>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step5-grey.png" alt="Step-5"></span>
                </div>
                <div class="progress_lin"></div>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step2-grey.png" alt="Step-2"></span>
                </div>               
            </div>
        </div>
        <!-- / CUSTOM COLUMNS -->
    </div>
    <div class="row">
        <!-- <div class="col-lg-10 col-lg-offset-1"> -->
        <div class="col-lg-12">
            <!-- Content Wrapper -->
            <div class="col-lg-8">
                 <?php if($_SESSION['moveType'] == 73){ $url = 'recipt'; }else{ $url = 'moving'; } ?>
                <form id="contactus-form1" action="<?php echo base_url(); ?><?php echo $url; ?>" method="POST" > 
                    <div class="Content_WraPper">
                        <div class="heaDiNg_main">
                            <h2 class="text-capitalize">Set Pickup Time</h2>
                        </div>
                        <div class="">  
                            <div class="Content_WraPper-inner">  
                                <div class="col-md-12 col-sm-12">
                                    <div class="TRuck">
                                        <!-- <img src="<?php echo base_url();?>public/images/selected-van-big.png" alt="#" class="img-responsive"> -->
                                        <img src="<?php echo $_SESSION['selectedVehicle']->icon; ?>" alt="<?php echo $_SESSION['selectedVehicle']->name; ?>" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="PRIce_TIMing">
                                        <h2 class="NUmber_Font"><?php if(isset($_SESSION['calculatedSpecificFare'])){print_r("$".$_SESSION['calculatedSpecificFare']['min_estimate_price']);echo "-$";print_r($_SESSION['calculatedSpecificFare']['max_estimate_price']);}?></h2>
                                        <div class="price-btn"> 
                                            <p>Price Estimate</p>
                                            <button type="button" class="info-btn" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal modal-free-estimate fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> <img src="<?php echo base_url();?>public/images/cross.png" alt="#" class="img-responsive"></span></button>
                                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                                    </div>
                                                    <div class="modal-body"> 
                                                        <div class="list-estimate-wrap"> 
                                                            <div class="list-estimate"> 
                                                                <div class="estimate-list-img">
                                                                     <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/distance.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> <div class="details details-left"><h4 class="media-heading">Distance</h4> <p class="NUmber_Font"><?php echo ceil($_SESSION['mapData']['distInKms'])." Km"; ?></p> </div><div class="details details-right"><h4 class="media-heading">Charges</h4> <p class="NUmber_Font"><?php echo "$".$_SESSION['selectedVehicle']->km_charges; ?></p> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-estimate">
                                                            <div class="estimate-list-img"> 
                                                                <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/time.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> <div class="details details-left"><h4 class="media-heading">Time</h4> <p class="NUmber_Font"><?php echo ceil($_SESSION['mapData']['duration'])." mins"; ?></p> </div><div class="details details-right"><h4 class="media-heading">Charges</h4> <p class="NUmber_Font">
                                                                    <?php
                                                                    if($_SESSION['calculatedSpecificFare']['no_of_movers'] == 1){
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges1;
                                                                    }else{
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges2;
                                                                    }
                                                                 ?>
                                                                </p>
                                                             </div>
                                                        </div> 
                                                    </div>
                                                    <div class="list-estimate"> 
                                                        <div class="estimate-list-img">
                                                             <a href="#"> <img alt="" class="" src="<?php echo base_url();?>public/images/loading-unloading-time.png" data-holder-rendered="true" style=""> </a> </div> <div class="estimate-list-content"> 
                                                             <div class="details details-left Align_text">
                                                                <h4 class="media-heading">Loding/unloading</h4> <p><?php echo $_SESSION['selectedVehicle']->min_minutes." mins | ".$_SESSION['selectedVehicle']->max_minutes." mins"; ?> </p><p class="NUmber_Font">
                                                                 <?php
                                                                    if($_SESSION['calculatedSpecificFare']['no_of_movers'] == 1){
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges1;
                                                                    }else{
                                                                        echo "$".$_SESSION['selectedVehicle']->movers_charges2;
                                                                    }
                                                                 ?>
                                                             </p>
                                                        </div>
                                                        <!-- <div class="details details-right">
                                                            <h4 class="media-heading">Charges</h4> <p class="NUmber_Font">$5/Km</p>
                                                        </div> -->
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="estimate-center"> 
                                               <div class="estimate-inner">
                                                   <div class="estimate-left">
                                                   <p class="estimate-label">Distance Charges</p>
                                                   <p class="estimate-label">Time Charges</p>
                                                </div>
                                                <div class="estimate-right">
                                                    <p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['km_chrge']; ?></p><p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['hour_chrge']; ?></p>
                                                </div> 
                                            </div>
                                            <div class="estimate-inner">
                                                <div class="estimate-left">
                                                   <p class="estimate-label"><b>Min</b> Loading/ Unloading Charges </p>
                                                   <p class="estimate-label"><b>Max</b> Loading/ Unloading Charges</p>
                                                </div>
                                                <div class="estimate-right">
                                                    <p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['min_loading']; ?></p><p class="estimate-desc NUmber_Font"><?php echo "$".$_SESSION['showHistory']['max_loading']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="estimated-price">
                                            <div class="price-value"><h4>Min Price</h4><p class="NUmber_Font"><?php echo "$".$_SESSION['calculatedSpecificFare']['min_estimate_price']; ?></p></div>
                                            <div class="price-value"><h4>Max Price</h4><p class="NUmber_Font"><?php echo "$".$_SESSION['calculatedSpecificFare']['max_estimate_price']; ?></p></div>
                                        </div>
                                        <div class="estimate-terms">
                                            <p>*<span class="NUmber_Font">10%</span> GST included in the final price.</p><p>*The minimum fare for a ride is $40.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <div class="DATe_time" >            
                        <h3>Select pickup window?</h3>
                    </div>
                    <!-- </div> -->
                    <div class="col-md-12 col-sm-12">
                        <div class="TIMing">
                            <!-- <button type="button">12 Aug 2017</button>
                            <div id="dtp" class="clearfix">
                                 <div class="e" data-id="y">
                                    <div class="up">+</div>
                                    <div class="val">..</div>
                                    <div class="down">-</div>
                                </div>
                                <div class="e" data-id="m">
                                    <div class="up">+</div>
                                    <div class="val">..</div>
                                    <div class="down">-</div>
                                </div>
                                <div class="e" data-id="d">
                                    <div class="up">+</div>
                                    <div class="val">..</div>
                                    <div class="down">-</div>
                                </div>
                                <div class="e" data-id="h">
                                    <div class="up">+</div>
                                    <div class="val">..</div>
                                    <div class="down">-</div>
                                </div>
                                <div class="e" data-id="i">
                                    <div class="up">+</div>
                                    <div class="val">..</div>
                                    <div class="down">-</div>
                                </div>
                            </div> -->
                            <div class='input-group date' >
                            <input type="hidden" id="timeslotsel" name="timeslotsel">
                                <select id="select" onchange="choice1(this)">
                                    <option value="" class="slectTimes"> --SELECT-- </option>
                                    <?php // $tomorrow = date("Y-m-d", strtotime("+1 day"));
                                        $i = 1;$j = 2;
                                        foreach ($dayName as $key => $value) {  if($value == $current){ $value = "Today"; }  if($i == 8){$i = 1;}
                                    ?>
                                        <option value="<?php echo $i ; ?>" id="opt<?php echo $j; ?>"><?php echo $value; ?></option>
                                    <?php $i++; $j++; } ?>
                                </select>
                                <select id="timeslot">
                                    <option>--None--</option>
                                </select>                                        
                            </div>
                            <!-- <div class='input-group date' > -->
                                <!-- <input type='text' class="form-control" value="<?php //if(isset($_SESSION['calculatedSpecificFare']['datetime'])){print_r($_SESSION['calculatedSpecificFare']['datetime']);}?>" name="datepick" id='min-date'/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span> -->
                            <!-- </div> -->

                            <span id="error" style="color:red"><?php if(isset($_SESSION['errorbookingdate'])){print_r($_SESSION['errorbookingdate']);}?></span>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- / Content Wrapper -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="previous">
                                <!-- <a href="<?php echo base_url('vehcile'); ?>">
                                    <button type="button">Previous</button>
                                </a> -->
                                    <?php if($_SESSION['moveType'] == 73){ 
                                        $btnname = 'datepick';
                                        }else{
                                        $btnname = 'receiptup';
                                        }
                                     ?>
                                    <button type="submit"  id="contact_uss"  name=<?php echo $btnname; ?>>Next</button>
                            
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                    <div class="Content_WraPper2">
                        <div class="right-side-menu">
                            <div class="Content_WraPper-inner">
                            
                            <img class="img-responsive" src="https://maps.googleapis.com/maps/api/staticmap?size=750x350&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|<?php print_r($_SESSION['mapData']['pickupLat']);?>,<?php print_r($_SESSION['mapData']['pickupLong']);?>&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|<?php print_r($_SESSION['mapData']['dropoffLat']);?>,<?php print_r($_SESSION['mapData']['dropoffLong']);?>&path=weight:5%7Ccolor:0x14456a%7Cenc:<?php print_r($_SESSION['mapData']['polyline']);?>&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img>
                            <div class="content-addr">
                                <div class="addr-inner addr-pickup row">
                                    <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/pickup_location.png" class="img-responsive" /></div>
                                    <div class="addr-inner-content">
                                        <h5>Pickup Location</h5>
                                        <p class="LOCTION_text"><span id="startloc">
                                    <?php 
                                        if(isset($_SESSION['mapData'])){
                                            print_r($_SESSION['mybookingData']['pickup']);
                                        }
                                    ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="addr-inner addr-dest row">
                                    <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/dropoff_location.png" class="img-responsive"></div>
                                    <div class="addr-inner-content">
                                        <h5>Dropoff Location</h5>
                                        <p class="LOCTION_text"><span id="endloc">
                                    <?php 
                                        if(isset($_SESSION['mapData'])){
                                            print_r($_SESSION['mybookingData']['dropoff']);
                                        }
                                    ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="Divider_line"></div> -->
                            <?php  if(isset($_SESSION['selectedVehicle'])){ ?>
                                <div class="col-md-12">
                                    <h4>Vehicle Type</h4>
                                    <h5 class="pull-left">
                                        <?php  print_r($_SESSION['selectedVehicle']->name); ?>
                                    </h5>
                                    <div class="pull-right">  
                                         <?php echo "<img src='".$_SESSION['selectedVehicle']->icon."' width='160px' height='60px'></img>"; ?>
                                    </div> 
                                </div>
                                <div class="Divider_line"></div>
                            <?php } if(isset($_SESSION['movereq'])){ ?>                            
                                <div class="col-md-12">
                                    <h4 class="pull-left">Movers</h4>
                                    <div class="smf-inner-btns pull-right SIDE_RIGHT">
                                        <img src="<?php echo base_url();?>public/images/movers_reqd_single.png">
                                        <label class="switch">
                                            <input type="checkbox" value="<?php if(isset($_SESSION['movereq'])){ print_r($_SESSION['movereq']); } ?>" name="moverRequired" id="loadd">
                                            <span class="slider round"></span>
                                        </label>
                                        <img src="<?php echo base_url();?>public/images/movers_reqd.png">
                                    </div>
                                </div>
                                <div class="Divider_line"></div>
                            <?php } if(!empty($_SESSION['calculatedSpecificFare']['slot_starttime'])){ ?>
                                <div class="col-md-12">
                                    <h4 class="pull-left"> Time </h4>
                                    <h4 class="pull-right">
                                        <?php 
                                            $start =  date("h:i A.", strtotime($_SESSION['calculatedSpecificFare']['slot_starttime']));
                                            $end = date("h:i A.", strtotime($_SESSION['calculatedSpecificFare']['slot_endtime']));
                                            echo "<p>".$start." - ".$end."</p>";
                                        ?>
                                    </<h4>
                                </div>
                                <div class="Divider_line"></div>
                            <?php } if(isset($_SESSION['calculatedSpecificFare'])){ ?>
                                <div class="col-md-12">
                                    <h4 class="pull-left"> Estimate Price </h4>
                                    <h4 class="pull-right">
                                        <?php print_r("$".$_SESSION['calculatedSpecificFare']['min_estimate_price']);echo "-$";print_r($_SESSION['calculatedSpecificFare']['max_estimate_price']); ?>
                                    </h4>
                                </div>
                                <div class="Divider_line"></div>
                            <?php } if(isset($_SESSION['receiptNumber'])){ ?>
                                <div class="col-md-12">
                                    <h4 class="pull-left"> Receipt Detail </h4>
                                    <h4 class="pull-right">
                                        <?php 
                                            if(isset($_SESSION['receiptImage'])){
                                                echo "";
                                                echo "<img src='".$_SESSION['receiptImage']."' width='100px' height='80px'></img>";
                                            }
                                            if(isset($_SESSION['receiptNumber'])){
                                                echo "<p>Receipt No: ".$_SESSION['receiptNumber'];
                                            }
                                        ?>
                                    </<h4>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>                                                                          
                        
            </div></div>

        </div>
	</div>
<!-- </form> -->
</div>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/js/bootstrap-material-datetimepicker.js"></script>
    <script>
        // $(document).ready(function(){
        //     var type = '<?php echo $_SESSION['settingdata'][0]->type; ?>';
        //     var days = '<?php echo $_SESSION['settingdata'][0]->no_of_days; ?>';
        //     var today = new Date();
        //     var time = 24 - today.getHours()
        //     if(type == 1){
        //         $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() ,maxDate: moment().add(1, 'h') ,useCurrent: true,shortTime: false});
        //         $('#min-date').bootstrapMaterialDatePicker().on('change', function(e, date){});
        //     }else if (type == 2){
        //         $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() ,maxDate: moment().add(time,'h') ,useCurrent: true,shortTime: false});
        //         $('#min-date').bootstrapMaterialDatePicker().on('change', function(e, date){});
        //     }else{
        //         $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() ,maxDate: moment().add(days, 'd') ,useCurrent: true,shortTime: false});
        //         $('#min-date').bootstrapMaterialDatePicker().on('change', function(e, date){});
        //     }
            // jq.material.init();
        //});
    </script>
    <script>
        function choice1(select) {
            var date = select.options[select.selectedIndex].text;
            // alert(date);
            $('#date').val(date);
            $("#timeslot").attr("required", "true");
            var num = $('select').val();
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>App/timeslot',
                data:'value='+num+'&date='+date,
                success:function(html){
                    $('#timeslot').html(html);
                     // console.log(html);return false;
                }
            });
        }
        $('#timeslot').click(function(){
            var time = $('#timeslot').val();
            $('#timeslotsel').val(time);
        });
    </script>
    <script>
     $("#timeslot").attr("required", "true");
        jQuery(window).on("load", function(){
        var move = $('#loadd').val();
            if(move == 2){
                $('.switch').trigger('click');
            }
        });
    </script>
    <script>
        (function($) {
            $.fn.toggleDisabled = function() {
                return this.each(function() {
                    var $this = $(this);           
                   $this.attr('disabled', 'disabled');
                });
            };
        })(jQuery);

        $(function() {
            jQuery(window).on("load", function(){
                var st = $('#loadd').toggleDisabled();
                setInterval(st, 10000 );
            });
        });
    </script>
  
</body>

</html>
