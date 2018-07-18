<html class="gr__formget_com">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Verify Gmail Address via SMTP</title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script src="js/jquery.js"></script>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-43981329-1']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        <?php
        include_once ('lib/smtp_validateEmail.class.php');
        $SMTP_Validator = new SMTP_validateEmail();
        ?>

        <div id="main">
            <h1>Verify Gmail Address via SMTP</h1>
            <div id="login">
                <h2>Validate Your Gmail Address</h2>
                <hr>
                <form action="" method="POST">
                    <input type="text" name="val_check_email" class="email_box" placeholder="Username"/><label><b>@gmail.com</b></label>
                    <br><br>
                    <input type="submit" value="Check" id="submit"/><br>
                    <span></span>
                </form>
            </div>
            <!-- Right side div -->
            <div id="formget">
                <a href="http://www.formget.com/app"><img src="img/formget.jpg" alt="Online Form Builder"></a>
            </div>
            <div id="note">
                <?php
                if (isset($_POST['val_check_email'])) {
                    $email = $_POST['val_check_email'];
                    
                    if ($email != "") {
                        $email.="@gmail.com";
                        $results = $SMTP_Validator->validate(array($email));
                        echo "<p class='result'><b>RESULT : </b></p>";
                        if ($results[$email]) {
                            echo "<p><b>Congratulations!!!</b> The email address " . "<span class='success'><strong>" . $email . "</strong></span>" . " exists!</p>";
                        } else {
                            echo "<p><b>Sorry!!!</b> The email address " . "<span class='fail'><strong>" . $email . "</strong></span>" . " <strong>doesn't</strong> exists!<br>";
                        }
                    }
                }
                ?>
            </div>
        </div>
        <script>
            jQuery(document).ready(function() {
                jQuery("#submit").click(function() {
                    var val = jQuery('.email_box').val();
                    if (val == "") {
                        alert('Please enter an email.');
                    }
                });
            });
        </script>
    </body>
</html>


