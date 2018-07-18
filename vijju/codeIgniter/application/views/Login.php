<!DOCTYPE html>
<html lang="en">
<?php //if(!isset($_SESSION)){ session_start();}
//if(!empty($_SESSION['user_id'])) {
//header('Location: index.php');
//}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login-</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo  base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo  base_url(); ?>css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo  base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo  base_url(); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo  base_url(); ?>css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
<div class="loginbg">
    <div class="container">

    <form class="form-signin"  id="form-signin"  name="form-signin" method="POST"  action="">

         <h2 class="form-signin-heading"><img src="img/buckup-logo.png" class="mR30"/> sign in now</h2>
        <div class="login-wrap">
           <div class="form-group ">
            <input type="text" class="form-control"  value="" id="username" name="username" placeholder="User ID" autofocus>
           </div>
           <div class="form-group ">
            <input type="password" class="form-control" value=""  id="userpassword" name="userpassword" placeholder="Password">
            </div>
             <div class="alert alert-block  fade in" style="display:none">
                                
                               
              </div>
            <button class="btn btn-lg btn-login btn-block" id="btnlogin" type="submit">Sign in</button>

        </div>


      </form>

    </div>

</div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.validate.min.js"></script>
	 <script>	
    //validate login form
   var vlogin = $("#form-signin").validate({
        rules: {
            username: {
                required: true
            },
            userpassword: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please enter a username"
            },
            userpassword: {
                required: "Please provide a password"
            }
        }
    });
    
    $("#btnlogin").click(function(){
    	
    		if(vlogin.form())
    		{
    			 var formdata = $('#form-signin').serialize();
				 var spinner;
				 $.ajax(
						 {
						     type: 'post',
						     url: 'includes/ajaxcall.php',
						     dataType: 'json',
							 data:formdata,
							 cache:false,
						     beforeSend: function() {
						    	  spinner = $('<img class="loading" style="float:right;margin-top:5px;">').insertBefore($("#btnlogin"));
							 	$("#btnlogin").fadeOut();
						     },
						     success: function(data) {
							// alert(data);
						         if (data != null) {
						             if (data.success == true) {

						            	 spinner.remove();
										 $('#form-signin div.alert').addClass('alert-success').html("<strong style=color:green;>Logged in Successfully</strong>");
		                                $('#form-signin div.alert').fadeIn('slow').delay(1000).fadeOut("slow",'linear', function()
									    {
													  window.location = 'index.php';
													  /* else if(role=="reseller") {
													  window.location = 'resellerdashboard.php';
													  }
													  else if(role=="salesrap") {
													  window.location = 'salesrapdashboard.php';
													  } */
													});
									 }
						             else {
																		
						            	 spinner.remove();
											 $('#form-signin div.alert').addClass('alert-danger').html("<strong>Invalid</strong>  username or password");
		                                $('#form-signin div.alert').fadeIn('slow').delay(1000).fadeOut("slow",'linear', function()
										{
						                $("#btnlogin").fadeIn();
						                });
										
						             }
						         }
						     },
							  error: function (request, status, error) { alert(status + ", " + error); spinner.remove();$("#btnlogin").fadeIn(); }
						 }); // end ajax  
    		}
    	return false;
    });
    </script>

  </body>
</html>
