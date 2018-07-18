    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="CUstomers">
                        <h3>Customers</h3>
                        <a href="#">Services</a>
                        <a href="#">Get an estimate</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="CUstomers">
                        <h3>Movers</h3>
                        <a href="#">Become a Mover</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="CUstomers">
                        <h3>Questions</h3>
                        <a href="#">Frequently Asked Question</a>
                        <a href="#">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="CUstomers">
                        <h3>Download</h3>
                        <a href="#"> <img src="<?php echo base_url();?>/public/images/playstore.png" alt="#" class="img-responsive"></a>
                        <a href="#"> <img src="<?php echo base_url();?>/public/images/app-store.png" alt="#" class="img-responsive"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <section class="COpy_right">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="COPy">
                        <a href="#">&copy; 2017 Movers On-Demand </a>
                    </div>
                    <div class="FAV_icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="PRivacy">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="Forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
		
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="EMAil">
			 <span id ="error1" style="color:red"></span>
                        <p>Enter your account email address and we'll send you out a new password</p>
                        <input id ="forgotemail" type="text" placeholder="Enter Your Email Address Here">
                        <button id="saveforgot" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>/public/js/bootstrap.min.js"></script>
</body>

</html>
