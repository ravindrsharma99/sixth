<style>
.displaynone {
    display: none;
}
</style>
<!-- MAIN CONTENT -->
<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12">
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
    <div class="row">
        <form action="<?php echo base_url(); ?>book_order" method="POST" enctype="multipart/form-data">
            <!-- <div class="col-lg-10 col-lg-offset-1"> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8">
                    <!-- Content Wrapper -->
                    <div class="Content_WraPper">
                        <div class="heaDiNg_main">
                            <h2 class="text-capitalize">What are you moving?</h2>
                        </div>
                        <div class="Content_WraPper-inner">
                            <div class="col-md-12 col-sm-12">
                                <div class="DIScription_BOX">
                                    <textarea rows="10" cols="12" required  id="textmovedes" placeholder="" name="movingDesc"><?php if(isset($_SESSION['movingDesc'])){ print_r($_SESSION['movingDesc']);} ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="UPLoad_Outer">
                                    <p>Please Upload Photos of the item if available:</p>
                                    <div class="UPLoad_photo">
                                        <div class="uploaded-btn-outer">
                                            <img src="<?php echo base_url();?>public/images/background-upload-photos.png" class="img-responsive" id="largeImage" alt="#">
                                            <div class="uploaded-btn">
                                                <div class="uploaded-btn-inner"> <img src="<?php echo base_url();?>public/images/book-mover-upload.png" alt="#" class="download">
                                                    <label> Browse
                                                        <input type="file" id="files" multiple name="itemImage[]" > </label>
                                                        <input type='hidden' id='nnuumm'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <output id="list">
                                        <?php 
                                                if(isset($_SESSION['itemImage'])){
                                                    $imageshow = $_SESSION['itemImage'];
                                                    $i = 0;$j = 0;
                                                    foreach ($imageshow as $key => $value) {
                                                        $id = count($imageshow);
                                                        echo "<span id='span".$i."' class='pip' ><img onclick='myfun(".$i.");' id='img".$i."' style='height: 75px; border: 1px solid #000; margin: 5px' src='".$value."' title=''><br/><span class='remove' onclick='removefun(".$j.",".$id.");'><i class='fa fa-times'></i></span></span><input type='hidden' id='update".$i."' value='".$value."'>";
                                                        $i++; $j++;
                                                    }
                                                }else{

                                                }
                                            ?>
                                    </output>
                                </div>
                                <div id="largeImage"></div>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
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
                            <?php if(isset($_SESSION['receiptNumber'])){ ?>
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
                <!-- / Content Wrapper -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="previous">
                        <?php 
                            if($_SESSION['moveType'] == 73){ 
                                $btnname = 'recipt';
                            }else{
                                $btnname = 'pickup';
                            }
                         ?>
                            <!-- <a href="<?php echo base_url();?><?php echo $btnname; ?>">
                                <button type="button">Previous</button>
                            </a> -->
                            <button type="submit" name="submit" id="nnnxt">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
    <script>
    // function handleFileSelect(evt) {
    //     var files = evt.target.files;
    //  var data = files.length;

    //     // Loop through the FileList and render image files as thumbnails.
    //  if(data > 4){}else{
    //     for (var i = 0, f; f = files[i]; i++) {

    //       // Only process image files.
    //       if (!f.type.match('image.*')) {
    //         continue;
    //       }

    //       var reader = new FileReader();

    //       // Closure to capture the file information.
    //       reader.onload = (function(theFile) {
    //         $myinc = 1;
    //         return function(e) {
    //           // Render thumbnail.
    //           var span = document.createElement('span');
    //           span.setAttribute("id", 'span' + $myinc);
    //           span.innerHTML = 
    //           [
    //             '<img style="height: 75px; border: 1px solid #000; margin: 5px" src="', 
    //             e.target.result,
    //             '" title="', escape(theFile.name), 
    //             '"/><button id="x'+$myinc+'">[X]</button>'
    //           ].join('');

    //           document.getElementById('list').insertBefore(span, null);
    //       $myinc++;
    //         }; 
    //       })(f);

    //       // Read in the image file as a data URL.
    //       reader.readAsDataURL(f);
    //     }
    //  }
    //   }

    //   document.getElementById('files').addEventListener('change', handleFileSelect, false);
    </script>
    <script>
    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                    var coun = $(".pip").length;
                    if(coun == 0 || coun < 4){


                if (filesLength > 4) {  } else {
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        $myinc = 1;
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            var span = document.createElement('span');
                            span.setAttribute("id", 'span' + $myinc);
                            span.setAttribute("class", 'pip');
                            span.innerHTML = [
                                "<img onclick='myfun(" + $myinc + ");' id='img" + $myinc + "' style='height: 75px; border: 1px solid #000; margin: 5px' src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class='fa fa-times'></i></span>"
                            ].join('');

                            document.getElementById('list').insertBefore(span, null);
                            var c = $('#img1').attr('src');
                            $('#largeImage').attr('src', c).width(300).height(300);
                            $(".remove").click(function() {
                                var nm = $('#nnuumm').val();
                                var ccal = nm - 1;
                                $('#nnuumm').val(ccal);
                                $('#largeImage').attr('src', '<?php echo base_url();?>public/images/background-upload-photos.png');
                                $(this).parent(".pip").remove();
                                $('#files').val("");
                                // $('#files').removeAttr('disabled','disabled');
                            });
                            $myinc++;
                        });
                        fileReader.readAsDataURL(f);  }
                    }
                //}


                }else{
                    alert("You can only upload a maximum of 4 files"); return false; }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        document.getElementById('files').addEventListener('change', handleFileSelect, false);
    });
    </script>
    <script>
    function myfun($myinc) {
        //var oldSrc = '<?php echo base_url();?>public/images/background-upload-photos.png" class="img-responsive';

        var c = $('#img' + $myinc).attr('src');
        $('#largeImage').attr('src', c).width(300).height(300);
        // i++;
        //  $('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
        // $('#largeImage').html('<img width="330px" height="330px" src="'+ c + '" />');
    }

    function removefun(e, f) {
        // for($k = 1;$k > f;$k++){
        //     var newdata.$k = $('#update'+$k).val();
        // }
        $('#span' + e).addClass('displaynone');
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>App/removesession',
            data: 'key=' + e,
            success: function(result) {
                console.log(result);
                //location.reload(); 
            }
        });
    }
    </script>
    <script>
    $("#textmovedes").attr("required", "true");
    $('#nnnxt').attr("disabled", "disabled");
    jQuery(window).on("load", function() {
        var move = $('#loadd').val();
        if (move == 2) {
            $('.switch').trigger('click');
        }
    });
    // $('#nnnxt').click(function(){
    //     var des = $('#textmovedes').val();
    //     if(des == ""){
    //         $('#spandes').html('Please enter item description');
    //         return false;
    //     }else{
    //         return true;
    //     }
    // });
    $('#textmovedes').keypress(function(){ 
        $('#nnnxt').removeAttr('disabled','disabled');
    });
    </script>
    <script>
        setTimeout(function(){
            $("#loadd").attr("disabled", "disabled");
        }, 1000);
    </script>