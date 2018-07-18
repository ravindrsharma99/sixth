<style>.displaynone{display:none} </style>

<script type="text/javascript">
    $('#homepage').addClass('menu_active');
</script>
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
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/step-1-grey.png" alt="Step-1"></span>
                </div>
                <div class="progress_lin"></div>
            </div>
          <!--   <div class="col-sm-2 col-md-2 text-center">
                <div class="Step_White">
                    <span class=""><img src="<?php echo base_url();?>public/images/img/step2-grey.png" alt="Step-2"></span>
                </div>
                <div class="progress_lin"></div>
            </div> -->
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
        <div class="col-lg-10 col-lg-offset-1">
            <!-- Content Wrapper -->
            <div class="Content_WraPper">
                <div class="heaDiNg_main">
                    <?php //echo $_SESSION['errorbookingResponseMessage']; ?>
                    <h2 class="text-capitalize">Select the move you require</h2>
                </div>
                    <span id="span" style="color:red;padding-left: 40%;font-size: 22px;"></span>

                <?php if ($this->session->flashdata('error')) { ?>
                      <h4 style="color:red;text-align: center;"><?php echo $this->session->flashdata('error').''.$_SESSION['errorbookingResponseMessage']; ?></h4>
                    </div>
                <?php } ?>

	            <form action="<?php echo base_url(); ?>location" method="POST" enctype="multipart/form-data">
                
                    <div class=" Content_WraPper-inner">
                    <div class="select-move-ul-wrap"><div class="row">
    				<?php            		
                		// $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getmove'));
                        $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getVehicleMove'));
                		$moveData = $user->Response->movedata;
                		$_SESSION['settingdata'] = $user->Response->settingdata;
     					foreach($moveData as $key){
					?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-slmp" onclick="MoveType('<?php echo $key->id;?>','<?php echo $key->type;?>');">
                        <div class="select-move-ul">  
                            <li class="itEms_baCk2">
                                <div class="text">
                                    <img src="<?php echo $key->icon;?>"  alt="Small Moves" class="img-responsive" />
                                    <h3 class="text-capitalize"><?php echo $key->title;?></h3>
                                </div>
                                <div class="img_OverLay2">
                                    <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                </div>
                            </li>
                        </div>
                    </div>                            
	                <?php } ?>
                    </div></div>
                   <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="MoveType(2)">
                            <div class="itEms_baCk2">
                                <div class="text">
                                    <img src="<?php echo base_url();?>/public/images/store-pickup.png"  alt="store pickup" class="img-responsive" />
                                    <h3 class="text-capitalize">store pickup</h3></div>
                                <div class="img_OverLay2">
                                    <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="MoveType(3)">
                            <div class="itEms_baCk2">
                                <div class="text">
                                    <img src="<?php echo base_url();?>/public/images/gumtree-pickup.png"  alt="gumtree pickup" class="img-responsive" />
                                    <h3 class="text-capitalize">gumtree pickup</h3></div>
                                <div class="img_OverLay2">
                                    <img src="<?php echo base_url();?>/public/images/step-done.png" alt="Tick">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="MoveType(4)" >
                            <div class="itEms_baCk2">
                                <div class="text">
                                    <img src="<?php echo base_url();?>/public/images/rubbish-removal.png" alt="rubbish removal" class="img-responsive" />
                                    <h3 class="text-capitalize">rubbish removal</h3></div>
                                <div class="img_OverLay2">
                                    <img src="<?php echo base_url();?>public/images/step-done.png" alt="Tick">
                                </div>
                            </div>
                        </div>
                    </div>-->
	                <input type = "hidden" name ="moveType" id="mainMove"></input>
	
                    <!--<div class="row displaynone" id ="recieptImage">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="reciept_conTainer">
                                <div class="reciept_back">
                                    <h2 class="text-capitalize">Reciept Number</h2>
                                </div>
                                <div class="reciept_conTainer_body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <form id="Reciept_Number">
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
                                                    <input type="text"  name  ="receiptNumber" class="form-control" id="exampleInputText1" placeholder="Order/Receipt Number">
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
                        </div> -->
                    <!-- </div> -->
                    </div>
                    <!--  Content Wrapper -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="previous">
                                <!-- <a href="<?php echo base_url('App/home/');print_r($_SESSION['user_details']->id);?>">
                                    <button type="button" >Previous</button>
                                </a> -->                                  
                                <button type="submit" name="hello" id="mveselc">Next</button>                                    
                            </div>
				        <!-- </form> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>/public/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/e5033262f5.js"></script>
<script type="text/javascript">
// document.getElementById("uploadBtn").onchange = function() {
//     document.getElementById("uploadFile").value = this.value;
// };
</script>            
<script type="text/javascript">
$('.select-move-ul li').click(function() {
    $('.select-move-ul li.active').removeClass('active');
    $(this).closest('li').addClass('active');
});
</script>
<script>
$('#span').html('');
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
$('#mveselc').click(function(){
    var lenn = $('#mainMove').val();
    if(lenn.length == 0){
        $('#span').html('Please select Move type');
        return  false;
    }else{
        return true;
    }
});
</script>      

