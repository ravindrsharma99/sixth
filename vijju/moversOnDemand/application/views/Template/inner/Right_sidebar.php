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
                                        print_r($_SESSION['mapData']['pickupAdd']);
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
                                        print_r($_SESSION['mapData']['pickupAdd']);
                                    }
                                ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="Divider_line"></div> -->
                        <div class="col-md-12">
                            <h4>Vehicle Type</h4>
                            <h5 class="pull-left">
                                <?php
                                    if(isset($_SESSION['selectedVehicle'])){ 
                                         print_r($_SESSION['selectedVehicle']->name);
                                    }
                                ?>
                            </h5>
                            <div class="pull-right">  
                                 <?php
                                    if(isset($_SESSION['selectedVehicle'])){ 
                                        echo "<img src='".$_SESSION['selectedVehicle']->icon."' width='160px' height='60px'></img>";
                                    }
                                ?>
                            </div> 
                        </div>
                        <div class="Divider_line"></div>
                        
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
                        <div class="col-md-12">
                            <h4 class="pull-left"> Time </h4>
                            <h4 class="pull-right">
                                <?php 
                                    if(isset($_SESSION['calculatedSpecificFare'])){
                                        $start =  date("h:i A.", strtotime($_SESSION['calculatedSpecificFare']['slot_starttime']));
                                        $end = date("h:i A.", strtotime($_SESSION['calculatedSpecificFare']['slot_endtime']));
                                        echo "<p>".$start." - ".$end."</p>";
                                    }
                                ?>
                            </<h4>
                        </div>

                        <div class="Divider_line"></div>
                        <div class="col-md-12">
                            <h4 class="pull-left"> Estimate Price </h4>
                            <h4 class="pull-right">
                                <?php if(isset($_SESSION['calculatedSpecificFare'])){print_r("$".$_SESSION['calculatedSpecificFare']['min_estimate_price']);echo "-$";print_r($_SESSION['calculatedSpecificFare']['max_estimate_price']);} ?>
                            </h4>
                        </div>

                        <div class="Divider_line"></div>
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
                    </div>
                </div>
            </div>  