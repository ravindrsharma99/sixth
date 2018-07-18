<style>

</style>
    <!-- MAIN CONTENT -->
    <div class="container" id="main">
        <div class="row  background_BluRr">
            <div class="col-md-12">
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
                    <div class="heaDiNg_main">
                        <h2 class="text-capitalize">What are you moving?</h2></div>
                    <div class="Content_WraPper-inner">
                        <div class="col-md-12 col-sm-12">
				 <form action="<?php echo base_url(); ?>App/page2" method="POST" enctype="multipart/form-data">
                            <div class="DIScription_BOX">
                                <textarea rows="10" cols="" required  name="movingDesc" ><?php echo $description ; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="UPLoad_Outer">
                                <p>Please Upload Photos of the item if available:</p>
                                <div class="UPLoad_photo"><div class="uploaded-btn-outer">
                                    <img src="<?php echo base_url();?>public/images/background-upload-photos.png" class="img-responsive" id="largeImage" alt="#">
                                  <div class="uploaded-btn"> <div class="uploaded-btn-inner">  <img src="<?php echo base_url();?>public/images/book-mover-upload.png" alt="#" class="download">
                                    <label> Browse
                                        <input type="file" id="files" multiple name="itemImage[]" > </label></div></div></div>
                                </div>
				                <output id="list">
                                    <?php
                                    $i = 1;
                                    foreach ($itemimages as $key => $value) {
                                        echo "<span id='span".$i."' class='pip'>
                                                <img onclick='myfun(".$i.");' src='".$value."' style='height: 75px; border: 1px solid #000; margin: 5px' ><br><span class='remove'><i class='fa fa-times'></i></span>
                                            </span>";
                                    $i++ ; } 
                                    ?>
                                </output>
                            </div>
                            <div id="largeImage"></div>
                        </div>
                    </div>
                </div>
                <!-- / Content Wrapper -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="previous">
                            <a href="<?php echo base_url('App/home/');print_r($_SESSION['user_details']->id);?>">
                                <button type="button">Previous</button>
                            </a>
		                <button type="submit" name="submit">Next</button>
			
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
	<script>
	
// function handleFileSelect(evt) {
//     var files = evt.target.files;
// 	var data = files.length;
   
//     // Loop through the FileList and render image files as thumbnails.
// 	if(data > 4){}else{
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
// 	}
//   }

//   document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
<script>
$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
            if(filesLength > 4){}else{
                for(var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    $myinc = 1;
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        var span = document.createElement('span');
                            span.setAttribute("id", 'span' + $myinc);
                            span.setAttribute("class", 'pip');
                            span.innerHTML = 
                            [
                                "<img onclick='myfun("+$myinc+");' id='img"+$myinc+"' style='height: 75px; border: 1px solid #000; margin: 5px' src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class='fa fa-times'></i></span>"
                            ].join('');
          
                        document.getElementById('list').insertBefore(span, null);
                        $(".remove").click(function(){
                            $('#largeImage').attr('src','<?php echo base_url();?>public/images/background-upload-photos.png');
                            $(this).parent(".pip").remove();
                            $('#files').val("");
                        });
                        $myinc++;          
                    });
                    fileReader.readAsDataURL(f);
                }
            }
        });
    }else{
    alert("Your browser doesn't support to File API")
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
});
</script>
<script>
function myfun($myinc){
   //var oldSrc = '<?php echo base_url();?>public/images/background-upload-photos.png" class="img-responsive';
    
    var c = $('#img'+$myinc).attr('src');
    $('#largeImage').attr('src',c).width(300).height(300);
    // i++;
    //  $('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
    // $('#largeImage').html('<img width="330px" height="330px" src="'+ c + '" />');
}
</script>