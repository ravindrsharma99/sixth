<head><style type="text/css">
#audio-preview {
  background: #ffffff;
  width: auto;
  padding: 20px;
  display: inline-block;
}

#audio-upload {
  cursor: pointer;
  background-color: #bdc3c7;
  color: #ecf0f1;
  padding: 20px;
  font-size: 20px;
  text-transform: uppercase;
}
</style></head>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Vechicle List
                            <a class="btn btn-info add_move" role="button" href="<?php echo base_url("Dashboard/addvechicle")?>">Add Vechicle </a>

                          </header>
                                <?php if ($this->session->flashdata('msg1')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg1'); 
                                ?>
                                </div>
                                <?php } ?>
                                       <?php if ($this->session->flashdata('msg2')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg2'); 
                                ?>
                                </div>
                                <?php } ?>
                                 <?php if ($this->session->flashdata('msg3')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg3'); 
                                ?>
                                </div>
                                <?php } ?>
                                      <?php if ($this->session->flashdata('msg4')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg4'); 
                                ?>
                                </div>
                                <?php } ?>
                                 <?php if ($this->session->flashdata('msg5')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg5'); 
                                ?>
                                </div>
                                <?php } ?>
                          <div class="panel-body">
                          <input type="file" id="rll"  onchange="handleFiles12(this,'rlly');" />
<audio id="rllly" controls>
  <source src="" id="rlly" />
</audio>






<!--  <input type="file" id="rll" />
<audio id="rllly" controls>
  <source src="" id="rlly" />
</audio>

<input type="file" id="rll1" />
<audio id="rllly1" controls>
  <source src="" id="rlly1" />
</audio>
<input type="file" id="rll2" />
<audio id="rllly2" controls>
  <source src="" id="rlly2" />
</audio> -->
 





<script type="text/javascript">
   function handleFiles12(event,a) {

  var files = event.target.files;
  $('#rlly').attr("src", URL.createObjectURL(files[0]));
  // document.getElementById("rllly").load();
  $('#'+rllly).load();
}
document.getElementById("rll").addEventListener("change", handleFiles12, false);



//   function handleFiles1(event) {
//   var files = event.target.files;
//   $("#rlly1").attr("src", URL.createObjectURL(files[0]));
//   document.getElementById("rllly1").load();
// }
// document.getElementById("rll1").addEventListener("change", handleFiles1, false);



//   function handleFiles2(event) {
//   var files = event.target.files;
//   $("#rlly2").attr("src", URL.createObjectURL(files[0]));
//   document.getElementById("rllly2").load();
// }
// document.getElementById("rll2").addEventListener("change", handleFiles2, false);
</script>

<!-- 
                                <input type="file" id="input"/>
                              <audio id="sound" controls></audio> -->



        <!--       <input type='file' id="files" name="files" multiple onchange="previewAudio(this);" />
                <audio controls>                    
                <source id="test3" src="" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>   -->



<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#audio-upload",
    preview_box: "#audio-preview",
    no_label: true
  });
});
</script>

<div id="audio-preview">No file selected</div><br />
<input type="file" name="audio" id="audio-upload" />

                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped example" id="example">
                                      <thead>
                                      <tr>
                                          <th>Sr.No.</th>
                                          <th>Name</th>
                                          <th style="width:230px;">Icon</th>
                                          <th>Height</th>
                                          <th>Length</th>
                                          <th>Width</th>
                                          <th>Weight</th>
                                          <th>Hours Charges</th>
                                          <th>KM Charges</th>
                                          <th>Date Created</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                       <?php
                                       $i=1;
                                       foreach ($vechicle as $key => $value) {
                                  
                                        ?>

                                        <tr id ='hello<?php echo $value->id; ?>'> 
                                        <td>

                                          <?php echo $i; ?>
                                        </td>
                                        <td>
                                      
                                          <?php 

                                           if (isset($value->name)) {
                                          echo $value->name; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                        <td class="image_setting" >
                                      
                                      <img src=" <?php echo  $value->icon; ?>">
                                        </td>
                                           <td>
                                            
                                          <?php 
                                           if (!empty($value->height)) {
                                          echo $value->height; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                              <td>
                                            
                                          <?php 
                                           if (!empty($value->length)) {
                                          echo $value->length; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                                <td>
                                            
                                          <?php 
                                           if (!empty($value->width)) {
                                          echo $value->width; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                              <td>
                                            
                                          <?php 
                                           if (!empty($value->weight)) {
                                          echo $value->weight; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                              <td>
                                            
                                          <?php 
                                           if (!empty($value->hours_charges)) {
                                          echo $value->hours_charges; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                              <td>
                                            
                                          <?php 
                                           if (!empty($value->km_charges)) {
                                          echo $value->km_charges; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                        <td>
                                          <?php $date= $value->creation_date;
                                          echo date("F d, Y", strtotime($date));
                                           ?>
                                        </td>
                                          <td>
                                          <button type="button" class="btn btn-info deleteAction responsive" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-name="<?php echo $value->name; ?>" data-icon="<?php echo $value->icon; ?>" data-height="<?php echo $value->height; ?>" data-length="<?php echo $value->length; ?>" data-width="<?php echo $value->width; ?>" data-weight="<?php echo $value->weight; ?>" data-hours_charges="<?php echo $value->hours_charges; ?>" data-km_charges="<?php echo $value->km_charges; ?>" >Edit</button>
                                          <button type="button" class="delete btn btn-danger responsive" id="<?php echo $value->id;?>" >Delete</button>
                                         
                                        </td>
                                       </tr>

                                      <?php 
                                        $i++;
                                        }
                                       

                                        ?>




                                      </tbody>
                           
                                  </table>

                                  <input type="file" id="songs"  onchange="readURL(this);" multiple>
<audio controls id="myAudio" autoplay></audio>




<!--  <input type="file" id="rll" />
<audio id="rllly" controls>
  <source src="" id="rlly" />
</audio>

<input type="file" id="rll1" />
<audio id="rllly1" controls>
  <source src="" id="rlly1" />
</audio>
<input type="file" id="rll2" />
<audio id="rllly2" controls>
  <source src="" id="rlly2" />
</audio> -->
 



<script type="text/javascript">
function handleFiles12(event) {
  // var songs = $("#songs").val(),
   var vehicle_no = $("#vehicle_no").val();
    myAudio = document.getElementById("myAudio");
function next(n){
  var url = URL.createObjectURL(files[n]);
  myAudio.setAttribute('src', url);
  myAudio.play();
}
var _next = 0,
    files,
    len;
songs.addEventListener('change', function() {
  files = songs.files;
  len = files.length;
  if(len){
    next(_next);
  }
});
myAudio.addEventListener("ended", function(){
   _next += 1;
   next(_next);
   console.log(len, _next);
   if((len-1)==_next){
     _next=-1;
   }
});
}
</script>
                                </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>





      <!--main content end-->
      <!--popup start-->
       <div class="panel-body">
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Update Your Detail Here</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" id="default" method="POST" action="<?php echo base_url("Dashboard/editvechiclelist")?>" enctype="multipart/form-data">
                        <div class="top_image ">
                         <label>Icon:</label> <img  id="icon"   src="" >
                        </div>
                      <div class="form-group type_box">
                       
                        <div class="col-lg-12">
                          <label>Name:</label>
                           <input type="text"  class="form-control" id="name"  name="name" value="" >
                        </div>
                         <div class="col-lg-12">
                         <label>Icon:</label>
                          <input type="file"  class="form-control"   name="icon" >
                        </div>
                         <div class="col-lg-12">
                        <label> Height: </label>
                        <input type="text"  class="form-control number"  id="height"  name="height" value="">
                        </div>
                         <div class="col-lg-12">
                         <label>Length : </label>
                         <input type="text"  class="form-control number" id="length"  name="length" value="" >
                        </div>
                         <div class="col-lg-12">
                         <label>Width : </label>
                         <input type="text"  class="form-control number" id="width"  name="width" value="" >
                        </div>
                         <div class="col-lg-12">
                         <label>Weight : </label>
                         <input type="text"  class="form-control number" id="weight"  name="weight" value="" >
                        </div>
                         <div class="col-lg-12">
                         <label>Hours Charges : </label>
                         <input type="text"  class="form-control number" id="hours_charges"  name="hours_charges" value="" >
                        </div>
                         <div class="col-lg-12">
                         <label>Km Charges:</label>
                          <input type="text"  class="form-control number"  id="km_charges"  name="km_charges" value="">
                        </div>

                      </div>
                   
                      <input type="hidden" name= "submitid" id='hiddid' value=""/>
                      <button  type="submit" class="btn btn-info editdata submit"  >Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <!--popup end-->  
      <!--footer start-->        
        <?php 
        $this->load->view('templete/footer');
        ?>
      <!--footer end-->
  
 

    <!--script for this page only-->

  </body>
</html>

<script type="text/javascript">

       $(document).ready(function() {
       $('#myModal').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('id');
    var name = $(e.relatedTarget).data('name');
    var icon = $(e.relatedTarget).data('icon');
    var height = $(e.relatedTarget).data('height');
    var weight = $(e.relatedTarget).data('weight');
    var length = $(e.relatedTarget).data('length');
    var width = $(e.relatedTarget).data('width');
    var hours_charges = $(e.relatedTarget).data('hours_charges');
    var km_charges = $(e.relatedTarget).data('km_charges');
    
    document.getElementById('hiddid').value = userid;
    document.getElementById('name').value = name;
    document.getElementById('icon').src = icon;
    document.getElementById('height').value = height;
    document.getElementById('weight').value = weight;
    document.getElementById('length').value = length;
        document.getElementById('width').value = width;
    document.getElementById('hours_charges').value = hours_charges;
    document.getElementById('km_charges').value = km_charges;
    


       });

     });
 
   </script>

 <script> 
 $(document).ready(function(){

   $(".delete").click(function(event){
        var result = confirm("Are you Sure to delete?");
        if (result) {
         var id = $(this).attr("id");  
         $.ajax({
          type: "POST",
          url: "http://phphosting.osvin.net/moversOnDemand/Dashboard/deletevechicle",
          data: {id:id},
          success: function(response) {
                  if (response == true)
                  {
                    $("#hello"+id).slideUp(100, function() {
                      $(this).remove();
                    });

                  }
                  else if(response == false)
                  {
                    alert("Error");
                  } else{
                    alert('cannot delete the id');
                  }
           }
         });
         event.preventDefault();
       }
       else{

       }
       })
 });
</script>
<!-- <script type="text/javascript">
 $('.number').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
    eve.preventDefault();
  }
     
// this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
 $('.number').keyup(function(eve) {
  if($(this).val().indexOf('.') == 0) {    $(this).val($(this).val().substring(1));
  }
 });
});
</script> -->
<script type="text/javascript">
  input.onchange = function(e){
  var sound = document.getElementById('sound');
  sound.src = URL.createObjectURL(this.files[0]);
  // not really needed in this exact case, but since it is really important in other cases,
  // don't forget to revoke the blobURI when you don't need it
  sound.onend = function(e) {
    URL.revokeObjectURL(this.src);
  }
}
</script>
