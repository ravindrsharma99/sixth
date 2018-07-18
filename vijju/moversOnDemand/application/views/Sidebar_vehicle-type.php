    <!-- MAIN CONTENT -->
    <style>.displaynone{display:none} </style>
    <div class="container" id="main">
        <div class="row  background_BluRr">
            <div class="col-md-12 col-sm-12">
                <div class="LogOut pull-right"><a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
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
                    <div class="Step_White">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step4-grey.png" alt="Step-4"></span>
                    </div>
                    <div class="progress_lin"></div>
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
            <div class="col-lg-12">
                <!-- Content Wrapper -->
                <div class="col-lg-8">
                <div class="Content_WraPper">
                    <div class="heaDiNg_main">
                        <h2 class="text-capitalize">Select Vehicle Type</h2></div>
        				<?php 
        				// $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getvechicle'));
                        $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getVehicleMove'));
        				$VehicleData = $user->Response->vehicledata;
        				$_SESSION['vehicleData'] = $user->Response->vehicledata;

        				?>                       
                   
			            <form action="<?php echo base_url(); ?>pickup" method="POST">
                            <div class="Content_WraPper-inner">
                                <div class="col-md-12 col-sm-12  TRuck" id="mybad" > <!-- truck_big css -->
                                <?php if ($this->session->flashdata('error')) { ?>
                                          <h4 style="color:red;text-align: center;"><?php echo $this->session->flashdata('error'); ?></h4>
                                        </div>
                                    <?php } ?>

                                    <div class="TRuck ">
                                       <!--  <h4>Select The appropriate sized vehicle.</h4>
                                        <img src="<?php print_r($_SESSION['vehicleData'][0]->icon);?>" alt="#" class="img-responsive">
                                        <h5>Max Size- 2.3m(L)X 1.5m(W)X 1.3(H)</br>
                                        Max Weight-2500kg</h5> -->
                                        <h4>Choosing your vehicle.</h4>
                                        <img src="<?php echo base_url('public/images/feedback-van.png'); ?>" alt="#" class="img-responsive">
                                        <h5>Each vehicle comes with 2 strong movers. We'll have straps,blankets and wrap tp protect your item.</h5>
                                    </div>
                                </div>
			                    <input type = "hidden" id= "vehicleData" name="vehicleData"></input>
                                <!-- <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="itEms_baCk">
                                            <img src="images/ute.png" alt="Small Moves" class="img-responsive center-block" />
                                            <h3 class="text-capitalize">small moves</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="itEms_baCk">
                                            <img src="images/van.png" alt="Small Moves" class="img-responsive center-block" />
                                            <h3 class="text-capitalize">small moves</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="itEms_baCk">
                                            <img src="images/xl-van.png" alt="Small Moves" class="img-responsive center-block" />
                                            <h3 class="text-capitalize">small moves</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="itEms_baCk">
                                            <img src="images/truck.png" alt="Small Moves" class="img-responsive center-block" />
                                            <h3 class="text-capitalize">small moves</h3>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="select-move-ul-wrap slv-wrap">
                                      <h2>What size do you need?</h2>
					                <?php
		                               //echo "<pre>";print_r($_SESSION['vehicleData'][0]);die;
					                   $i = 1;
 					                  foreach($VehicleData as $key){						
								    ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-slmp" onclick ="return vehicledata('<?php echo $key->name; ?>','<?php echo $key->length; ?>','<?php echo $key->height; ?>','<?php echo $key->width; ?>','<?php echo $key->weight; ?>','<?php echo $key->icon; ?>','<?php echo $key->id; ?>');">
                                        <div class="select-move-ul">
                                            <li class="itEms_baCk2 <?php// if($i==1){echo 'active';}?>" >
                                                <div class="text">
    	                                           <img src="<?php echo $key->icon;?>" alt="Small Moves" id="icon<?php echo $i; ?>" class="img-responsive center-block" />
                                                    <h3 class="text-capitalize" id="VehicleName<?php echo $i ;?>"><?php echo $key->name;?></h3>
                                                </div>
                                                <div class="img_OverLay2">
                                                    <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                    <?php $i++;} ?>
                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="itEms_baCk2">
                                            <div class="text">
                                        <img src="<?php echo base_url();?>public/images/van.png" alt="Small Moves" class="img-responsive center-block" />
                                                <h3 class="text-capitalize">van moves</h3></div>
                                            <div class="img_OverLay2">
                                                <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="itEms_baCk2">
                                            <div class="text">
                                        <img src="<?php echo base_url();?>public/images/xl-van.png" alt="Small Moves" class="img-responsive center-block" />
                                                <h3 class="text-capitalize">xl-van moves</h3></div>
                                            <div class="img_OverLay2">
                                                <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="itEms_baCk2">
                                            <div class="text">
                                        <img src="<?php echo base_url();?>public/images/truck.png" alt="Small Moves" class="img-responsive center-block" />
                                                <h3 class="text-capitalize">truck moves</h3></div>
                                            <div class="img_OverLay2">
                                                <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                    <div class="select-movers-flights displaynone" id="movereqrd">
                                        <div class="smf-inner">
                                            <div class="smf-inner-content">
                                                <img src="<?php echo base_url();?>public/images/movers_reqd.png"><span>Movers Required</span>
                                            </div>
                                            <div class="smf-inner-btns"><img src="<?php echo base_url();?>public/images/movers_reqd_single.png">
                                                <label class="switch">
                                                    <input type="checkbox" value ="1" name="moverRequired" id="movereqred">
                                                    <span class="slider round"></span>
                                                </label>
                                                <img src="<?php echo base_url();?>public/images/movers_reqd.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Content Wrapper -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="previous">
                                        <!-- <a href="<?php echo base_url('App/page1'); ?>">
                                            <button type="button">Previous</button>
                                        </a> -->
                                        <button type="submit" disabled="disabled" id="checkpost" name="submit">Next</button>                                
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="Content_WraPper2">
                        <div class="right-side-menu">
                            <div class="Content_WraPper-inner">
                            
                            <img class="img-responsive" src="https://maps.googleapis.com/maps/api/staticmap?size=750x350&markers=icon:http://movers.com.au/Admin/public/appicon/ic_pickup.png|color:0x288cd7|shadow:true|<?php print_r($_SESSION['mapData']['pickupLat']);?>,<?php print_r($_SESSION['mapData']['pickupLong']);?>&markers=icon:http://movers.com.au/Admin/public/appicon/ic_dropoff.png|color:0x288cd7|shadow:true|<?php print_r($_SESSION['mapData']['dropoffLat']);?>,<?php print_r($_SESSION['mapData']['dropoffLong']);?>&path=weight:5%7Ccolor:0x14456a%7Cenc:<?php print_r($_SESSION['mapData']['polyline']);?>&key=AIzaSyAtYoGDXguJ0LVCuz0Vby2abe1bcYEWjnk"></img>
                            <div class="content-addr">
                                <div class="addr-inner addr-pickup row">
                                    <div class="addr-inner-img"><img src="<?php echo base_url();?>public/images/pickup_location.png" class="img-responsive" /></div>
                                    <div class="addr-inner-content Custom_sizes">
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
                                    <div class="addr-inner-content Custom_sizes">
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
                                            <input type="checkbox" value="<?php if(isset($_SESSION['movereq'])){ print_r($_SESSION['movereq']); echo "disabled";} ?>" name="moverRequired" id="loadd">
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

                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$('.select-move-ul li').click(function() {
    $('.select-move-ul li.active').removeClass('active');
    $(this).closest('li').addClass('active');
    $('#movereqrd').removeClass('displaynone');
});
</script>
<script>
$('#movereqred').click(function(){
    $('#movereqred').toggle(function(){
        var val = $('#movereqred').val();
        if(val == 1){
            $('#movereqred').val('2');
        }else{
            $('#movereqred').val('1');
        }
    });
});
</script>
</body>

</html>


