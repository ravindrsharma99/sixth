<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="<?php echo base_url("public/img/favicon.png")?>">

    <title>Movers On Demand Admin Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("public/css/bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?php echo base_url("public/css/bootstrap-reset.css")?>" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url("public/assets/font-awesome/css/font-awesome.css")?>" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("public/css/style.css")?>" rel="stylesheet">
    <link href="<?php echo base_url("public/css/style-responsive.css")?>" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo base_url("public/img/favicon.ico")?>" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body login_background">

    <div class="container">

    <!--   <form class="form-signin" method="post" action="<?php echo base_url("Login")?>">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="User ID" name="email" autofocus>
            <input type="password" class="form-control" placeholder="Password" name="password" >

            <button class="btn btn-lg btn-login btn-block" type="submit" name="submit" >Sign in</button>
        

        </div>
      </form> -->

      <div class="form-signinn ">
          <div class="text-center logo2"><img src="<?php echo base_url("public/img/ic_van-logo.png")?>" width="250px">  </div>
          <label style="color:#4CA6EA"></label> 
          <form class="form-signin" method="post" action="<?php echo base_url("Login")?>">
    
            <!-- <h2 class="form-signin-heading "> sign in now</h2>  -->        
            <div class="login-wrap form_login">
              <div class="form-group ">
                <input class="form-control" value="" id="email" name="email" placeholder="Email ID" autofocus="" type="text">
                   <div class="error"></div>

              </div>
              <div class="form-group ">
                <input class="form-control" value="" id="password" name="password" placeholder="Password" type="password">
                 <div class="error"></div>

              </div>
              <div class="alert alert-block  fade in" style="display:none"></div>
              <button class="btn btn-lg btn-login btn-block" id="btnlogin" type="submit">Sign in</button>
              <!-- <a href="#">Forgot Password</a> -->
            </div>
          </form>
        </div>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url("public/js/jquery.js")?>"></script>
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>


  </body>
</html>
