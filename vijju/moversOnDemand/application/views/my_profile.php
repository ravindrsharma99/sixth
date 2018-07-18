<?php //echo "<pre>";print_r($info);die;?>
    
    <!-- MAIN CONTENT -->
    <div class="container" id="main">
        <div class="row  background_BluRr">
            <div class="col-md-12">
                <div class="LogOut pull-right"><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <!-- Content Wrapper -->
                <div class="Content_WraPper">
                     <?php if ($this->session->flashdata('error')) { ?>
                          <h4 style="color:red;font-size: 20px;text-align: center;"><?php echo $this->session->flashdata('error'); ?></h4>
                    <?php } ?>
                    <form method ="post" action="" enctype="multipart/form-data">
                        <div class="heaDiNg_main">
                            <h2 class="text-capitalize">Edit Your Profile</h2>
                        </div>
                        <div class="Content_WraPper-inner">
                            <div class="EDit my_profile_img" id="fullpath">
                                <img src="<?php echo $info->profile_pic; ?>"><input type="file" name="upload_pic" value="">
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="EDit_Inputs cusTom_width">
                                        <div class="form-group">
                                            <label>Company :</label>
                                            <input class="form-control" id="email" name = 'company_name' value="<?php echo $info->company_name; ?>" placeholder="Company Name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>First Name :</label>
                                            <input class="form-control" id="email" name = 'fname' value="<?php echo $info->fname; ?>" placeholder="First Name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name :</label>
                                            <input class="form-control" id="email"  name = 'lname' value="<?php echo $info->lname; ?>" placeholder="Last Name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address :</label>
                                            <input class="form-control" id="email" onclick="myfun();" name = 'email' value="<?php echo $info->email; ?>" placeholder="Email Address" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Country Code :</label>
                                            <input class="form-control" id="email" name = 'country_code' value="<?php echo $info->country_code; ?>" placeholder="Country Code" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number :</label>
                                            <input class="form-control" id="email" name = 'phone' value="<?php echo $info->phone; ?>" placeholder="Mobile Number" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Old Password :</label>
                                            <input class="form-control" id="email" name = 'oldpass'  placeholder="Old Password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password :</label>
                                            <input class="form-control" id="email" name = 'newpass'  placeholder="New Password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password :</label>
                                            <input class="form-control" id="email" name = 'conpass'  placeholder="Confirm Password" type="password">
                                        </div>
                                        <div class="SAve add_floting">
                                            <button type="submit" name="editprofile">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- / Content Wrapper -->              
            </div>
        </div>
    </div>
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
    <script>
       function myfun(){
            $('#email').setReadOnly(true);
       }
    </script>