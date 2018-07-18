
<?php //print_r($_SESSION['NewBook_id']);die; ?>
<style type="text/css">
.retry .close{
  color: #b1b1b1;
  opacity: 1;
}
.retry{
  border-bottom: 0px;
}

.try_buton a{
  background: #2b92df none repeat scroll 0 0;
  border: 1px solid #2b92df;
  border-radius: 5px;
  color: #ffffff;
  font-size: 16px;
  font-weight: 500;
  margin: 35px 0 0;
  padding: 6px 23px;
  text-decoration: none;
}

.NO_mover{
  width: 100%;
  float: none;
  text-align: center;
}

</style>


<div id="retry" style="  background: #ffffff none repeat scroll 0 0; height: 200px; left: 0; top:0px; right: 0; bottom:0px; margin:auto; opacity: 1;  display:none; padding: 0; position: absolute;  width: 600px; z-index: 9999; transition:all 3s;" >
<p>Sorry! No Service Provider found.Do you want retry again?</p>
<a href = "<?php echo base_url(); ?>Booking/retryBooking/<?php echo $id; ?>"><button type="button"  style="">Cancel</button></a>
  <a href="<?php echo base_url(); ?>Booking/book_order"><button type="button">Wait</button></a>
</div>




    <!-- MAIN CONTENT -->
    <div class="container" id="main">
        <div class="row  background_BluRr">
            <div class="col-md-12 col-sm-12">
                <div class="LogOut pull-right"><a href="<?php echo base_url('App/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <!-- Content Wrapper -->
                <div class="Content_WraPper">
                    <div class="heaDiNg_main" id="heading">
                        <h2 class="text-capitalize">Searching For Mover</h2>
                        <a href="#" data-toggle="modal" data-target="#cancelbokreqr">
                          <button type="button">Cancel</button>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="emptymover">   
                          <div class="pulse-box">
                                <svg class="pulse-svg" width="50px" height="50px" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  
                                  <circle class="circle first-circle" fill="#FF6347" cx="50%" cy="50%" r="50"></circle>
                                  <circle class="circle second-circle" fill="#FF6347" cx="50%" cy="50%" r="50"></circle>
                                  <circle class="circle third-circle" fill="#FF6347" cx="50%" cy="50%" r="50"></circle>
                                  <circle class="circle" fill="#19a580"  cx="50%" cy="50%" r="60"><h2 class="pulse_CounTer" id='timer'></h2></circle>
                              </svg>
                          </div>
                          <h4 class="text-center text-capitalize">Searching Mover...</h4>                           
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showerror">
                        <div class="NO_mover">
                          <h2>SORRY,NO MOVER FOUND</h2>
                          <p>We will notify you once we found mover for you.</p>
                          <a href="#" data-toggle="modal" data-target="#cancelbokreqr"><button type="button">Cancel</button></a> <a href="<?php echo base_url(); ?>book"><button type="button">Please Wait</button></a>
                          </div>
                        </div>
                    </div>
                </div>
                <!-- / Content Wrapper -->
                    <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="previous">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
</body>

</html>
<script type="text/javascript">
$('#showerror').hide();
function radialTimer() {
  var self = this;
  this.seconds = 0;
  this.count = 0;
  this.degrees = 0;
  this.interval = null;
  this.timerHTML = "<div class='n'></div><div class='slice'><div class='q'></div><div class='pie r'></div><div class='pie l'></div></div>";
  this.timerContainer = null;
  this.number = null;
  this.slice = null;
  this.pie = null;
  this.pieRight = null;
  this.pieLeft = null;
  this.quarter = null;
 this.init = function(e, s) {
    self.timerContainer = $("#" + e);
    self.timerContainer.html(self.timerHTML);
    self.number = self.timerContainer.find(".n");
    self.slice = self.timerContainer.find(".slice");
    self.pie = self.timerContainer.find(".pie");
    self.pieRight = self.timerContainer.find(".pie.r");
    self.pieLeft = self.timerContainer.find(".pie.l");
    self.quarter = self.timerContainer.find(".q");
    // start timer
    self.start(s);
  }
  this.start = function(s) {
    self.seconds = s;
    self.interval = window.setInterval(function () {
      self.number.html(self.seconds - self.count);
      self.count++;
     if(self.count == 59){
     	//window.location.href = "<?php echo base_url(); ?>App/page6";
     // $('#retry').show();
     $('#showerror').show();
      $('#emptymover').hide();
      $('#heading').hide();
    } 
      if (self.count > (self.seconds - 1)) clearInterval(self.interval);
      self.degrees = self.degrees + (360 / self.seconds);
      if (self.count >= (self.seconds / 2)) {
        self.slice.addClass("nc");
        if (!self.slice.hasClass("mth")) self.pieRight.css({"transform":"rotate(180deg)"});
        self.pieLeft.css({"transform":"rotate(" + self.degrees + "deg)"});
        self.slice.addClass("mth");
        if (self.count >= (self.seconds * 0.75)) self.quarter.remove();
      } else {
        self.pie.css({"transform":"rotate(" + self.degrees + "deg)"});
      }
      $helo = <?php print_r($_SESSION['NewBook_id']); ?> ;
         $.ajax({
            method: 'POST',
            url: 'http://movers.com.au/Admin/api/User/FindDriver',
            data: 'book_id='+$helo,
            success: function(html) {
              // console.log(html);
              if(html.ResponseCode == true){
                $id = html.response[0].driver_id;
                window.location.href = "<?php echo base_url(); ?>mover/"+$id;
              }else{
                return false;
              }
            }});
    }, 1000);

  }
}

var Timer;

$(document).ready(function() {
  Timer = new radialTimer();
  Timer.init("timer", 59);
});
</script>

  <div class="modal fade" id="cancelbokreqr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header REmove_BORder">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            <div class="WANt_PLay">
                <h6>Are you sure you want to cancel?</h6>
            </div>
            <span style="color:red; padding-left: 37%;font-size: inherit;" id="span"></span>  
        </div>
        <form action="<?php echo base_url(); ?>book_cancel/<?php print_r($_SESSION['NewBook_id']); ?>" method="POST" id="formdata">
          <div class="add-card-content text-center">
            <textarea rows="6" cols="1" id="comment" name="comment"></textarea>
            <input type="checkbox" name="checkbox" id="checkbox" placeholder="Enter reason here..."> <p>I agree with cancellation policy</p>
          </div>
          <div class="modal-footer REmove_BORder">
              <div class="PAy_TOcard">
                <input type="submit" id="submit" name="cancelmovebook" value="Yes">
                <button data-dismiss="modal" type="button">No</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div> 


<script>
  $(document).ready(function(){
    $('#formdata').submit(function(){
      $comment = $('#comment').val();
      if($comment.length == 0){
        $('#span').html('Comment field empty!');
        return false;
      }else{
        $('#span').html('');
      }
      if(!jQuery("#checkbox").is(":checked")){
        $('#span').html('Please click on checkbox!');
        return false;
      }else{
        return true;
      }
     
    });
  });
</script>