<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>



    <input type="button" value="Google Drive" id="google">



<script type="text/javascript">
$("#google").click(function(){
   onApiLoad_custom();
  });

      // The Browser API key obtained from the Google API Console.
      // var developerKey = 'xxxxxxxYYYYYYYY-12345678';

      // The Client ID obtained from the Google API Console. Replace with your own Client ID.
    var clientId = "319301741688-lpgutvhptj527ojj5jh6nl15ecfbgri8.apps.googleusercontent.com";

    // Replace with your own project number from console.developers.google.com.
    // See "Project number" under "IAM & Admin" > "Settings"
    var appId = " 319301741688 ";

      // Scope to use to access user's photos.
    var scope = ['https://www.googleapis.com/auth/photos'];

    var pickerApiLoaded = false;
    var oauthToken;

      // Use the API Loader script to load google.picker and gapi.auth.
      function onApiLoad_custom() {
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
      }

      function onAuthApiLoad() {
        window.gapi.auth.authorize(
            {
              'client_id': clientId,
              'scope': scope,
              'immediate': false
            },
            handleAuthResult);
      }

      function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
      }

      function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
          oauthToken = authResult.access_token;
          createPicker();
        }
      }

      // Create and render a Picker object for picking user Photos.
      function createPicker() {
        if (pickerApiLoaded && oauthToken) {
          var picker = new google.picker.PickerBuilder().
              addView(google.picker.ViewId.DOCS).


                   addView(google.picker.ViewId.DOCUMENTS).
                addView(google.picker.ViewId.PRESENTATIONS).
                 addView(google.picker.ViewId.FOLDERS).

              setOAuthToken(oauthToken).
              // setDeveloperKey(developerKey).
              setCallback(pickerCallback).
              build();
          picker.setVisible(true);
        }
      }

      // A simple callback implementation.
      // function pickerCallback(data) {
      //   var url = 'nothing';
      //   if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
      //     var doc = data[google.picker.Response.DOCUMENTS][0];
      //     url = doc[google.picker.Document.URL];
      //   }
      //   var message = 'You picked: ' + url;
      //   document.getElementById('result').innerHTML = message;
      // }


         function pickerCallback(data) {
                var url = 'nothing';
                var name = 'nothing';
                if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
                    var doc = data[google.picker.Response.DOCUMENTS][0];
                    url = doc[google.picker.Document.URL];
                    name = doc.name;
                    var param = {'fileId': doc.id, 'oAuthToken': oauthToken, 'name': name}
                    console.log(param);
                    document.getElementById('result').innerHTML = "Downloading...";
                    $.post('down', param,
                            function (returnedData) {
                                document.getElementById('result').innerHTML = "Download completed";
                            });
                            }
                        }



    </script>
  </head>
  <body>
    <div id="result"></div>

    <!-- The Google API Loader script. -->
  </body>
</html>