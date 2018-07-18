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
                <?php if(isset($_SESSION['selectedVehicle'])){ ?>
                    <div class="Step_Green">
                        <span class=""><img src="<?php echo base_url();?>public/images/step5-white.png" alt="Step-5"></span>
                    </div>
                    <div class="progress_lin_RED"></div>
                <?php }else{ ?>
                     <div class="Step_White">
                        <span class=""><img src="<?php echo base_url();?>public/images/img/step5-grey.png" alt="Step-5"></span>
                    </div>
                    <div class="progress_lin"></div>
                <?php } ?>
            </div>
            <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step2-grey.png" alt="Step-2"></span>
                </div>               
            </div>
        </div>
        <!-- / CUSTOM COLUMNS -->
    </div>
    <form action="<?php echo base_url(); ?>moving" method="POST" enctype="multipart/form-data">
        <input type = "hidden" name ="moveType1" id="mainMove"></input>
        <div class="row" id ="recieptImage">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8">
                    <div class="reciept_conTainer">
                        <div class="reciept_back">
                            <h2 class="text-capitalize">Reciept Number</h2>
                        </div>
                        <div class="reciept_conTainer_body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="fileUpload btn btn-block btn-default">
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <span class="text-capitalize">Upload Receipt</span>
                                                <input type="file" name="receiptImage" id="filerep" class="upload" />
                                            </div>
                                            <p class="help-block text-center">and/or</p>
                                        </div>
                                        <div class="bLank_div"></div>
                                        <div class="form-group">
                                            <label for="exampleInputText1">Order/Receipt Number</label>
                                            <!-- exampleInputText1 -->
                                            <input type="text"  name  ="receiptNumber" class="form-control" id="recptnumbr" placeholder="Order/Receipt Number">
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="image_holDer"> <p class="default-receipt-img">Receipt Image</p>
                                        <span class="plaCehoLder" id="recipt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <input type="checkbox" value="<?php if(isset($_SESSION['movereq'])){ print_r($_SESSION['movereq']); } ?>" name="moverRequired" id="loadd">
                                            <span class="slider round"></span>
                                        </label>
                                        <img src="<?php echo base_url();?>public/images/movers_reqd.png">
                                    </div>
                                </div>
                                <div class="Divider_line"></div>
                            <?php } if(isset($_SESSION['calculatedSpecificFare'])){ ?>
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
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="previous">
                    <!-- <a href="<?php echo base_url('pickup'); ?>">
                        <button type="button">Previous</button>
                    </a> -->
                        <button type="submit" name="receiptup1" id="nnxxtt">Next</button>            
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#filerep").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
            if(filesLength > 4){}else{
                for(var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        var span = document.createElement('span');
                            span.setAttribute("id", 'span12');
                            span.setAttribute("class", 'pip');
                            span.innerHTML = 
                            [
                                "<img style='height: 250px; width:250px;' src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" + "<br/><span class=\"remove\"><i class='fa fa-times' aria-hidden='true'></i></span>"
                            ].join('');
          
                        document.getElementById('recipt').insertBefore(span, null);
                        $(".remove").click(function(){
                            //$('#largeImage').attr('src','<?php echo base_url();?>public/images/background-upload-photos.png');
                            $(this).parent(".pip").remove();
                            $('#filerep').val("");
                        });       
                    });
                    fileReader.readAsDataURL(f);
                }
            }
        });
    }else{
    alert("Your browser doesn't support to File API")
    }
    document.getElementById('filerep').addEventListener('change', handleFileSelect, false);
});

// $("#delete").click(function(){
//     //$('#recipt').attr('src','<?php echo base_url();?>public/images/background-upload-photos.png');
//     $(this).parent(".pip").remove();
//     $('#files').val("");
// }); 
</script>
 <script>
    $("#recptnumbr").attr("required", "true");
    $('#nnxxtt').attr("disabled", "disabled");
    jQuery(window).on("load", function(){
    var move = $('#loadd').val();
        if(move == 2){
            $('.switch').trigger('click');
        }
    });

    $('#recptnumbr').keypress(function(){ 
        $('#nnxxtt').removeAttr('disabled','disabled');
    });
    setTimeout(function(){
        $("#loadd").attr("disabled", "disabled");
    }, 1000);
    </script>
   
