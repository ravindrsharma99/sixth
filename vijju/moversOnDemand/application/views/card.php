<!-- MAIN CONTENT -->
<?php //echo "<pre>";print_r($_SESSION['calculatedSpecificFare']);print_r($_SESSION['selectedVehicle']);die; ?>
<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12 col-sm-12">
            <div class="LogOut pull-right"><a href=" <?php echo base_url('logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span></a>
            </div>
        </div>
        <div class="row show-grid">
            <div class="col-sm-1 col-md-1-offset"></div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="Content_WraPper Content_WraPper-inner">
                    <div class="heaDiNg_main">
                        <h2 class="text-capitalize">Add Card</h2>
                    </div>
                    <div class="EDit">
                        <a href="<?php echo base_url('add_card'); ?>"><img src="<?php echo base_url(); ?>public/images/image-uploaded.png" alt="#"></a>
                    </div>
                    <div class="row">
                        <?php 
                            if ($this->session->flashdata('success')) { 
                                echo "<h4 style='color:green;text-align:center;'>".$this->session->flashdata('success')."</h4>";
                            }
                        ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="SAVed_CArds">
                                <h4>Your Saved Cards</h4>
                                <?php foreach ($cardlist as $key => $value) { $cardno = $value->card_no; ?>
                                    <div class="CHECK_Filds">
                                        <div class="CLick_box">
                                            <div class="control-group">
                                                <?php if(isset($_POST['cardsub']) || isset($_SESSION['calculatedSpecificFare'])){ ?>
                                                    <a href="#" data-toggle="modal" data-target="#CRAd_Pay<?php echo $value->id; ?>">
                                                        <label class="control control--radio">
                                                            <input type="radio" name="radio" checked="checked" />
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                    </a>
                                                <?php }else{ ?>
                                                    <label class="control control--radio">
                                                        <input type="radio" name="radio" checked="checked" />
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#"><img class="media-object" src="<?php echo base_url(); ?>public/images/card-payment.png" alt="#"></a>
                                            </div>
                                            <div class="media-body">
                                                <h2 class="media-heading">Card Number</h2>
                                                    <p><?php echo "xxxx xxxx xxxx ".$cardno; ?></p>
                                                <div class="CRoss">
                                                    <a href="#" data-toggle="modal" data-target="#deleteCard<?php echo $value->id; ?>"><img src="<?php echo base_url(); ?>public/images/delete-card.png" alt="#"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="CRAd_Pay<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header REmove_BORder">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <!--<h4 class="modal-title" id="myModalLabel">Modal title</h4>-->
                                                </div>
                                                <div class="modal-body">
                                                    <div class="WANt_PLay">
                                                        <h6>Are you sure you want to pay this card?</h6>
                                                    </div>
                                                </div>
                                                <div class="add-card-content text-center"> <p><?php echo "xxxx xxxx xxxx ".$cardno; ?></p>
                                                 <input type="hidden" value="<?php echo $value->id; ?>" name="ghjg">
                                                 <p>Note: First <?php echo $_SESSION['bookCharge']."%"; ?> and rest payment will be done from this card.</p></div>
                                                <div class="modal-footer REmove_BORder">
                                                    <div class="PAy_TOcard">
                                                        <!-- <form action="/moversOnDemand/App/page6/<?php echo $value->id; ?>" method="POST"> -->
                                                            <!-- <input type="submit" name="submit" value="Yes"> -->
                                                        <!-- </form> -->
                                                        <?php 
                                                            $static_key = "!fvsdsdj!kldfoi$uyfd%6n4b32@&2kj2z";
                                                            $carid = $value->id . "_" . $static_key;
                                                            $card_Id = base64_encode($carid);
                                                            $carname = $cardno . "_" . $static_key;
                                                            $card_Name = base64_encode($carname);
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>App/page2/<?php echo $card_Id; ?>/<?php echo $card_Name; ?>"><input type="button" name="submit" value="Yes"></a>
                                                        <button data-dismiss="modal" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteCard<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!--<div class="modal-header REmove_BORder">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                </div>-->
                                                <div class="modal-body">
                                                    <div class="WANt_PLay">
                                                        <h6>Are you sure you want to delete this card?</h6>
                                                    </div>
                                                </div>
                                                <div class="modal-footer REmove_BORder">
                                                    <div class="PAy_TOcard">
                                                        <!-- <a href="<?php echo base_url(); ?>App/CardDelete/<?php// echo $value->id; ?>"> -->
                                                        <form action="/moversOnDemand/card_del/<?php echo $card_Id; ?>" method="POST">
                                                            <input type="submit" name="delcard" value="Yes">
                                                        </form>
                                                            <button data-dismiss="modal" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                              <!--   <div class="CHECK_Filds">
                                    <div class="CLick_box">
                                        <div class="control-group">
                                            <label class="control control--radio">
                                                <input type="radio" name="radio" checked="checked" />
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img class="media-object" src="<?php echo base_url(); ?>public/images/card-payment.png" alt="#"></a>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="media-heading">Card Name</h2>
                                            <p>XXXXX56789</p>
                                            <div class="CRoss">
                                                <a href="#" data-toggle="modal" data-target="#CRAd_Pay"><img src="<?php echo base_url(); ?>public/images/delete-card.png" alt="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
    </div>
    <!-- Modal -->
    
    <!-- Modal -->
    <div class="modal fade" id="SUCcesfully" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header REmove_BORder">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!--<h4 class="modal-title" id="myModalLabel">Modal title</h4>-->
                </div>
                <div class="modal-body">
                    <div class="WANt_PLay">
                        <img src="images/added_successfully.png" alt="#">
                        <h6>Add Succesfully!</h6>
                    </div>
                </div>
                <!--<div class="modal-footer REmove_BORder">
                    <div class="PAy_TOcard">
                     <button type="button">YES</button>
                     <button type="button">IGNORE</button>

                    </div>
                </div> -->
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function() {
    jQuery('.menu-content-list li.menu_active').removeClass('menu_active');
    $('#cards').addClass('menu_active');
});</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- datepicer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/e5033262f5.js"></script>
    <script type="text/javascript">
    Date.prototype.getMyMount = function() { return this.getMonth() + 1; }
    Date.prototype.addYear = function(y) { this.setYear(this.getFullYear() + y); return this; }
    Date.prototype.addMonth = function(m) { this.setMonth(this.getMonth() + m); return this; }
    Date.prototype.addDays = function(d) { this.setTime(this.getTime() + (d * 24 * 60 * 60 * 1000)); return this; }
    Date.prototype.addHours = function(h) { this.setTime(this.getTime() + (h * 60 * 60 * 1000)); return this; }
    Date.prototype.addMinutes = function(m) { this.setTime(this.getTime() + (m * 60 * 1000)); return this; }
    var t = function(n, func) {
        this.func = func;
        this.v = n;
        this.val = function() { return (this.v + '').length > 2 ? this.v : (("0" + this.v).slice(-2)); }
    };
    var md = {};
    md.init = function(s) { this.ts = new Date(s); return this; }
    md.initAttr = function() {
        this.y = new t(this.ts.getFullYear(), 'addYear');
        this.m = new t(this.ts.getMyMount(), 'addMonth');
        this.d = new t(this.ts.getDate(), 'addDays');
        this.h = new t(this.ts.getHours(), 'addHours');
        this.i = new t(this.ts.getMinutes(), 'addMinutes');
        return this;
    }
    md.update = function(attr, corect) {
        var func = this[attr].func;
        this.ts[func](corect)
        return this.view();
    }
    md.view = function() {
        this.initAttr();
        var m = ['y', 'm', 'd', 'h', 'i'];
        m.forEach(function(k) {
            var el = $('.e[data-id=' + k + '] .val');
            el.text(md[k].val());
        });
        return this;
    }

    md.init('2017-03-28 17:13:50').view();

    $('#dtp .e').on('mousewheel', function(e) {
        var ow = e.originalEvent.wheelDelta;
        var od = e.originalEvent.detail;
        var d = (ow > 0 || od < 0) ? 1 : -1;
        var name = $(this).data('id');

        $(this).find(d > 0 ? '.up' : '.down').finish().effect("highlight", 'fast');
        md.update(name, d);
    });
    $('#dtp .e .up, #dtp .e .down').on('click', function(e) {
        $(this).finish().effect("highlight", 'fast');
        var name = $(this).closest('.e').data('id');
        var d = $(this).hasClass('up') ? 1 : -1;
        md.update(name, d);
    });
    </script>
</body>

</html>
