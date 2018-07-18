<?php  //print_r($_SESSION['gogledata']);die; ?>
<!-- MAIN CONTENT -->
<div class="container" >
    <div class="row">
        <div class="col-lg-12">
            <!-- Content Wrapper -->
            <div class="Content_WraPper remove_margin">
                <div class="heaDiNg_main">
                    <h2 class="text-capitalize">Create Account</h2></div>
                <div class="EDit">
                     <img src="<?php if(isset($_SESSION['fbdata']['profile_pic'])){ echo $_SESSION['fbdata']['profile_pic']; }elseif(isset($_SESSION['gogledata']['profile_pic'])){ echo $_SESSION['gogledata']['profile_pic']; } ?>" alt="#">
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                     <div class="remove_padding EDit_Inputs_wrap">
                        <div class="EDit_Inputs after_login">
                             <span id ="error" style="color:red"></span>
                            <form>
                            <input type="hidden" id ="usertyped" > </input>
                                <div class="form-group">
                                    <label>Company Name(optional):</label>
                                    <input type="text" class="form-control" id="comname" placeholder="Company Name">
                                </div>
                                <div class="form-group">
                                    <label>*First Name :</label>
                                     <input type="text" class="form-control" id="fname" placeholder="First Name" value="<?php if(isset($_SESSION['fbdata']['fname'])){ echo $_SESSION['fbdata']['fname']; }elseif(isset($_SESSION['gogledata']['fname'])){ echo $_SESSION['gogledata']['fname']; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>*Last Name :</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name" value="<?php if(isset($_SESSION['fbdata']['lname'])){ echo $_SESSION['fbdata']['lname']; }elseif(isset($_SESSION['gogledata']['lname'])){ echo $_SESSION['gogledata']['lname']; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>*Email Address :</label>
                                    <input type="email" class="form-control" id="emailid"  onkeyup="email_validate(this.value);" placeholder="Email Address" value="<?php if($_SESSION['fbdata']['email'] != "undefined"){ echo $_SESSION['fbdata']['email']; }else{ echo ''; } if(isset($_SESSION['gogledata']['email'])){ echo $_SESSION['gogledata']['email']; }else{ echo ''; }?>">
                                </div>
                                <div class="form-group">
                                    <label>*Country Code :</label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" id="ccode" placeholder="Country Code">
                                </div>
                                <div class="form-group">
                                    <label>*Mobile Number :</label>
                                     <input type="text" class="form-control" id="number" onkeypress="return isNumber(event)" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label>*New Password :</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>*Confirm Password :</label>
                                     <input type="password" class="form-control" id="conpass" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <label>*Referral Code :</label>
                                     <input type="email" class="form-control" id="ref" placeholder="Referral Code">
                                </div>
                                <div class="SIghIn add_floting">
                                    <button id ="signup" type="button">SIGN UP</button>
                                </div>
                                <?php if(isset($_SESSION['fbdata'])){ ?>
                                    <input type="hidden" value="2" id="usertype">
                                    <input type="hidden" value="<?php echo $_SESSION['fbdata']['fb_id']; ?>" id="fb_id">
                                <?php }elseif(isset($_SESSION['gogledata'])){ ?>
                                    <input type="hidden" value="3" id="usertype">
                                    <input type="hidden" value="<?php echo $_SESSION['gogledata']['google_id']; ?>" id="google_id">
                                <?php } ?>
                            </form>
                        </div>
                    </div></div>
                </div>
            </div>
            <!-- / Content Wrapper -->
           <!--  <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="previous">
                        <a href="#">
                            <button type="button">Previous</button>
                        </a>
                        <a href="#">
                            <button type="button">Next</button>
                        </a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>