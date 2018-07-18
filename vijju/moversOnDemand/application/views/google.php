
<meta name="google-signin-client_id" content="977212213737-0hetk3ndbhcllss7qjp1hi1o9gj734mi.apps.googleusercontent.com">

<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<script type="text/javascript" src="jquery-2.0.3.js"></script>
<script type="text/javascript" src="jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.countdownTimer.css" />

<style>
.profile{
    border: 3px solid #B7B7B7;
    padding: 10px;
    margin-top: 10px;
    width: 350px;
    background-color: #F7F7F7;
    height: 160px;
}
.profile p{margin: 0px 0px 10px 0px;}
.head{margin-bottom: 10px;}
.head a{float: right;}
.profile img{width: 100px;float: left;margin: 0px 10px 10px 0px;}
.proDetails{float: left;}

</style>

<div class="container" id="main">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div id="gSignIn" onclick="log();"></div>
            <!-- HTML for displaying user details -->
            <div class="userContent"></div>
            <div id="countdowntimer"><span id="future_date"><span></div>


            <script>
                function log(googleUser){
                    var profile = googleUser.getBasicProfile();
                    var google_id =  profile.getId();
                    var givenname =  profile.getGivenName();
                    var familyname =  profile.getFamilyName();
                    var getImageUrl =  profile.getImageUrl();
                    var getEmail =  profile.getEmail();

                    var profileHTML = '<div class="profile"><div class="head">Welcome '+givenname+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></div>';
                    profileHTML += '<img src="'+getImageUrl+'"/><div class="proDetails"><p>'+familyname+'</p><p>'+getEmail+'</p><p>'+google_id+'</p></div></div>';

                    $('.userContent').html(profileHTML);
                    $('#gSignIn').slideUp('slow');
                }
                function onFailure(error) {
                    alert(error);
                }            
                function renderButton() {
                    gapi.signin2.render('gSignIn', {
                        'scope': 'profile email',
                        'width': 240,
                        'height': 40,
                        'longtitle': true,
                        'theme': 'dark',
                        'onsuccess': log,
                        'onfailure': log
                    });
                }
                function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                        $('.userContent').html('');
                        $('#gSignIn').slideDown('slow');
                    });
                }
            </script>
            <script>
                $(function(){
                    $("#future_date").countdowntimer({
                        seconds : 5‚
                        size : "lg"
                    });
                });
            </script>
        </div>
    </div>
</div>