$base_url = "http://phphosting.osvin.net/moversOnDemand";	
function vehicledata( name, length, height,width, weight,icon,id){
$('#checkpost').removeAttr("disabled");
$('#mybad').html('<div class="col-md-12 col-sm-12"><div class="TRuck"><h4>Select The appropriate sized vehicle.</h4><img src="'+icon+'" alt="#" class="img-responsive"><h5>Max Size- '+length+'m(L)X '+width+'m(W)X '+height+'(H)</br>Max Weight-'+weight+'kg</h5></div></div>');
	$('#vehicleData').val(id);
}

function MoveListing(type,id){
	var page = 1;
$.ajax({
	      method:'POST',
	      url: $base_url+'/movelist',
	      data:'user_id='+id+'&type='+type+'&page='+page,
	      // dataType: 'json',
	      success:function(result){	
          // console.log(result);return false;
          $('#myTable tbody').html(result); 
          // alert(result.Response[0]);
         // console.log(result);return false;	
			    // $data = result;
   			  //alert(result.ResponseCode);return false;	
    	// 		if(result.ResponseCode == true){
    	// 			$.ajax({
    	// 				method:'POST',
    	// 				url: $base_url+'/App/yourMoveListData',
    	// 				data:'data='+JSON.stringify(result)+'&mytype='+type,
    	// 				// dataType: 'json',
    	// 				success:function(result){	
     //            console.log(result);return false; 
    	// 				  $('#myTable tbody').html(result);		
    	// 				}
    	// 			});	
				 //  }else{	//alert(result.ResponseCode);
				 //    $('#myTable tbody').html('No Data Found In The Table');
					// }
	      }
		  });
	
}

function promoListing(type,id){
   	$.ajax({
	    method:'POST',
	    url: 'http://movers.com.au/Admin/api/User/getPromo',
	    data:'user_id='+id+'&type='+type,
	    dataType: 'json',
	    success:function(result){   
	      // console.log(result);return false;
	      $data = result.response;
	      if(result.ResponseCode == true){
	        $.ajax({
	          method:'POST',
	          url: $base_url+'/App/getPromoData',
	          data:'data='+JSON.stringify(result),
	          success:function(result){
	            // console.log(result);
	            $('#showmydata').html(result);   
	          }
	        });
	      }else{
	        $('#showmydata').html('');   
	      }
	    }
  	});  
}

function isname(event){
var inputValue = event.which;
if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
$('#error').text('Please enter alphabet.');
event.preventDefault(); 
}else{
$('#error').text('');
}
}
function isNumber(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
$('#error').text('Please enter number');	
return false;
}
$('#error').text('');	
return true;
}
function email_validate(email){
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
if(regMail.test(email) == false){
$('#error').text('Email address is not valid yet.');
}
else{
$('#error').text('You have entered a valid Email address!');
}
}
function MoveType(evt,type){
		if(type ==1){
			$('#recieptImage').removeClass('displaynone');
      $("#exampleInputText1").prop('required',true);			
			}else{$('#recieptImage').addClass('displaynone');
      $("#exampleInputText1").prop('required',false);}
$('#mainMove').val(evt);
}

function initAutocomplete() {
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
	
    var map = new google.maps.Map(document.getElementById('map'), {
	
      center: {lat: 30.7262141,lng: 76.8451191},
      zoom: 15,
      mapTypeId: 'roadmap'
    });	
    var marker = new google.maps.Marker({
      map: map,
      position: {lat: 30.7262141,lng: 76.8451191},
      draggable: true,
      icon: 'http://movers.com.au/Admin/public/appicon/ic_pickup.png',
      // icon : 'http://phphosting.osvin.net/Admin/public/appicon/ic_pickup.png',
      anchorPoint: new google.maps.Point(0, -29)
    });
    var mark = new google.maps.Marker({
      map: map,
      position: {lat: 30.7262141,lng: 76.8451191},
      draggable: true,
      icon: 'http://movers.com.au/Admin/public/appicon/ic_dropoff.png',
      // draggable: 'http://phphosting.osvin.net/Admin/public/appicon/ic_dropoff.png',
      anchorPoint: new google.maps.Point(0, -29)
    });     
	   
    var input = document.getElementById('pac-input');
    var search = document.getElementById('searchh');
	
    var geocoder = new google.maps.Geocoder();

    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var searchBox1 = new google.maps.places.SearchBox(search);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(search);

    var infowindow = new google.maps.InfoWindow();
    
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });
    map.addListener('bounds_changed', function() {
      searchBox1.setBounds(map.getBounds());
    });

    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();
	console.log(places);
      if (places.length == 0) {
        return;
      }          
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
	
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng(),mark.getPosition().lat(),mark.getPosition().lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
        showTooltip(infowindow,marker,place.formatted_address);
      });
      map.fitBounds(bounds);
    });
    searchBox1.addListener('places_changed', function() {
      var places = searchBox1.getPlaces();
      if (places.length == 0) {
        return;
      }          
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
        mark.setPosition(place.geometry.location);
        mark.setVisible(true);
        bindDataToForm1(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng(),marker.getPosition().lat(),marker.getPosition().lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, mark);
        showTooltip1(infowindow,mark,place.formatted_address);
      });
      map.fitBounds(bounds);
    });
    google.maps.event.addListener(marker, 'dragend', function() {
      geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if(status == google.maps.GeocoderStatus.OK) {
          if(results[0]){        
            bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng(),mark.getPosition().lat(),mark.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
            showTooltip(infowindow,marker,results[0].formatted_address);
            document.getElementById('pac-input');
          }
        }
      });
    });
    google.maps.event.addListener(mark, 'dragend', function() {
      geocoder.geocode({'latLng': mark.getPosition()}, function(results, status) {
        if(status == google.maps.GeocoderStatus.OK) {
          if(results[0]){        
            bindDataToForm1(results[0].formatted_address,mark.getPosition().lat(),mark.getPosition().lng(),marker.getPosition().lat(),marker.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, mark);
            showTooltip1(infowindow,mark,results[0].formatted_address);
            document.getElementById('searchInput');
          }
        }
      });
    });
  }
  function bindDataToForm(address,lat,lng,lat1,lng1){	
    document.getElementById('startloc').innerHTML = address;
    document.getElementById('location').value = address;
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;
	  var origin = lat+','+lng;
	  var destination = lat1+','+lng1;
	$.ajax({
	      method:'POST',
	      url: $base_url+'/App/findplace',
	      data:'origin='+origin+'&destination='+destination,
	      success:function(result){	
        console.log(result);
			$data = JSON.parse(result);
			// if($data.distInKms < 1){
          if($data.city_id == null){
				alert("Sorry! we don't provide service in this area.");
					$("#checkupData").prop("disabled", true);	
				  }else
			       {	
				$("#checkupData").removeAttr("disabled");
				//$data = result.split(',');
				//console.log($data);	
					}
	      		        }
		           }); 
	  		}
  function showTooltip(infowindow,marker,address){
    google.maps.event.addListener(marker, 'click', function() { 
      infowindow.setContent(address);
      infowindow.open(map, marker);
    });
  }
  function showTooltip1(infowindow,mark,address){
    google.maps.event.addListener(mark, 'click', function() { 
      infowindow.setContent(address);
      infowindow.open(map, mark);
    });
  }
  function bindDataToForm1(address,lat,lng,lat1,lng1){		
    document.getElementById('endloc').innerHTML = address;
    document.getElementById('location1').value = address;
    document.getElementById('lat1').value = lat;
    document.getElementById('lng1').value = lng;
	  var origin = lat1+','+lng1;
	  var destination = lat+','+lng;
	$.ajax({
      method:'POST',
      url: $base_url+'/App/findplace12',
      data:'origin='+origin+'&destination='+destination+'&abc=1',
      success:function(result){
        // console.log(result);return false;
		$data =  JSON.parse(result);
		 if($data.city_id == null){			
			alert("Sorry! we don't provide service in this area.");	
			  }else{
		         }
      		        }
                   }); 
  		}
  $("#myModal").on('show.bs.modal', function(event) {
    setTimeout(function() {
        initAutocomplete();
        google.maps.event.trigger(map, "resize");
    }, 1000);
  });

	
$(function() {
	$('#files').bind("change", function() {
    	 var formData = new FormData();
       // alr = 
       // chk = document.getElementById('nnuumm').value
	 len = document.getElementById('files').files.length
// chh = len + chk
	if (len >4){
	 alert("You can only upload a maximum of 4 files");
   return false;
	}else{
     for (var i = 0, len = document.getElementById('files').files.length; i < len; i++) {
	formData.append("files" + i, document.getElementById('files').files[i]);
  $('#nnuumm').val(len);
  // if ( len < chk){
  // $("#files").attr("disabled", "disabled"); }
  }
	}	
return false;
$.ajax({
url : "file-upload.php",
type : 'post',
data : formData,
dataType : 'html',
async : true,
processData: false,  // tell jQuery not to process the data
contentType: false,   // tell jQuery not to set contentType
error : function(request) {
alert('error!!');
console.log(request.responseText);
},
success : function(json) {
alert('success!!');
$('#upload-result')[0].append(json);
     }
   });
 }); 
});
$(document).ready(function(){
$("#Loading").click(function(){ $loaded = $("#quantity3").val();
 	$("#loadingTime").text($loaded);
	$("#loadingTimeData").val($loaded);	
		
 });
$("#Unloading").click(function(){ $unloaded = $("#quantity4").val();
	
	$("#unloadingTime").text($unloaded);
	$("#unloadingTimeData").val($unloaded);	

 });
$("#saveforgot").click(function(){
$email = $('#forgotemail').val();
if($email.length== 0){
$('#error1').text('Please enter email first'); 
}else{
$.ajax({
type: "POST",
url: "http://movers.com.au/Admin/api/User/forgotpassword",
// url : 'http://phphosting.osvin.net/Admin/api/User/forgotpassword',
data: {'email':$email},
cache: false,
success: function(html){
$messages = html.MessageWhatHappen;
$('#error1').text($messages); 
console.log($messages);
  }
 });
}
});


$("#signup").click(function(){
  $comname = $('#comname').val();
  $fname = $('#fname').val();
  $lname = $('#lname').val();
  $email = $('#emailid').val();
  $ccode = $('#ccode').val();
  $number = $('#number').val();
  $ref = $('#ref').val();
  $pass = $('#pass').val();
  $conpass = $('#conpass').val();
  $type= $('#usertype').val();
  $fb = $('#fb_id').val();
  $google = $('#google_id').val();
  //console.log($data);
  //return false;
  if($comname=='' || $fname==''||  $number==''|| $ccode=='' || $pass=='' || $conpass==''){
    $('#error').text('Please fill the required fields');		
  }else{
    $('#error').text('');		
    if($pass != $conpass){
      $('#error').text('Confirm Password Error');
    }else{
      $.ajax({
        type: "POST",
        //url: $base_url+"/Admin/api/User/signup",
        url:'http://movers.com.au/Admin/api/User/signup',
        data: 'fname='+$fname+'&lname='+$lname+'&email='+$email+'&password='+$conpass+'&phone='+$number+'&profile_pic='+''+'&fb_id='+$fb+'&google_id='+$google+'&device_id='+''+'&unique_deviceId='+''+'&token_id='+''+'&type='+$type+'&refercode='+$ref+'&country_code='+$ccode+'&company_name='+$comname,
        cache: false,
        // dataType: 'json',
        success: function(html){
          //console.log(html);

          $data  = $.parseJSON(html);
          $messages = $data.MessageWhatHappen;
          $('#error').text($messages);
          //location.href = $base_url+"/App/home/"+html.loginResponse[0].id; 
        }
      });
    }				
  }
});

$("#signin").click(function(){
	$email = $('#LoginEmail').val();
	$pass = $('#LoginPassword').val();
	if($email=='' || $pass==''){
    $('#error').text('Please fill the required fields');		
	}else{
	  $('#error').text('');		
  	$.ajax({
    	type: "POST",
    	url: "http://movers.com.au/Admin/api/User/login",
    	data: {'email':$email,'password':$pass,'fb_id':'','google_id':'','device_id':2,'unique_deviceId':'','token_id':'','type':1,'user_type':1},
    	cache: false,
    	success: function(html){
        $messages = html.MessageWhatHappen;
        if(html.ResponseCode==true){
          $.ajax({
            type: "POST",
            url: $base_url+"/login",
            data: {'mydata':html.loginResponse[0]},
            cache: false,
            success: function(html){
              location.href = $base_url+"/book";
              return false;
            }
          });
        }
          $('#error').text($messages); 
     	}
	  });
	}
});
});
// function statusChangeCallback(response) {
// console.log('statusChangeCallback');
// console.log(response);
// if (response.status === 'connected') {
// testAPI();
// } else {
// document.getElementById('status').innerHTML = 'Please log ' +
// 'into this app.';
//    }
// }
//  function checkLoginState() {
// 	FB.getLoginStatus(function(response) {
// 	testAPI();
// 	});
// 	}

// 	window.fbAsyncInit = function() {
// 	FB.init({
// 	appId      : '473627996352923',
// 	cookie     : true,  
// 	xfbml      : true,  
// 	version    : 'v2.8' 
// 	});
//      };
// (function(d, s, id) {

// var js, fjs = d.getElementsByTagName(s)[0];
// if (d.getElementById(id)) return;
// js = d.createElement(s); js.id = id;
// js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=true&cookie=true&version=v2.8&appId=473627996352923";
// fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));
//    function testAPI() {
//     FB.login(function(response) {
//      if (response.authResponse) {
//        console.log('Welcome!  Fetching your information.... ');
//        FB.api('/me', function(response) {
//          console.log('Good to see you, ' + response.email + '.');
//          alert('Good to see you, ' + response.email + '.');
//        });
//      } else {
//        console.log('User cancelled login or did not fully authorize.');
//      }
//    }, {scope:'email'}); } 
// function testAPI() {
    // console.log('Welcome!  Fetching your information.... ');
    // FB.api('/me', function(response) {
    //   console.log(response.email);
    //   document.getElementById('status').innerHTML =
    //     'Thanks for logging in, ' + response + '!';
    // });

// function testAPI() {
//   FB.login(function(response) {
// console.log('Welcome!  Fetching your information.... ');
// FB.api('/me', { locale: 'tr_TR', fields: 'id,first_name,middle_name,last_name,email,picture' },
// function(response) {
// console.log(response.id);
// console.log(response);
// console.log(response.first_name);
// var first_name = response.first_name;
// var middle_name = response.middle_name;
// var last_name = response.last_name;
// var id = response.id;
// var email = response.email;
// var picture = response.picture.data.url;
// var data_to_send = 'name='+first_name+'&mname='+middle_name+'&lname='+last_name+"&user_id="+id+'&email='+email+'&picture='+picture ;
// alert (data_to_send);return false;
// $.ajax({
//     method:'POST',
//     url:$base_url+"/App/fbLogin",
//     data:'name='+first_name+'&mname='+middle_name+'&lname='+last_name+"&user_id="+id+'&email='+email+'&picture='+picture,
//     success:function(html){
//         // if(html != ){
//         //     $btn = '<div style="font-size: 18px;color: red;">Please Click Sign Up Button For Registration </p> <a data-toggle="modal" href="#Sign_model" style="padding:17%;">Sign Up</a></div>';
//         //     $dsply = $.parseJSON(html);
//         //     $fname = $dsply.key;
//         //     $lname = $dsply.key1;
//         //     $email = $dsply.key2;
//         //     $fb_id = $dsply.key3;
//         //     $image = $dsply.key4;
//         //     $('#fnamee').val($fname);
//         //     $('#lnamee').val($lname);
//         //     $('#emailll').val($email);
//         //     $('#fbb_id').val($fb_id);
//         //     $('#imagee').val($image);
//         //     $('#show_msg').html($btn);
//         //}
//         if(html == 1){
//             window.location.href = $base_url+'/App/book_order';
//         }else if(html == 2){
//             window.location.href = $base_url+'/App/CreateAccount';
//         }else{

//         }
//     }
// });

// });
// }


function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);
  if (response.status === 'connected') {
    testAPI();
  } else {
    document.getElementById('status').innerHTML = 'Please log ' +
      'into this app.';
  }
}
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    //statusChangeCallback(response);
    testAPI();
  });
}
window.fbAsyncInit = function() {
  FB.init({
   appId      : '473627996352923',
    cookie     : true,  
                       
    xfbml      : true,  
    version    : 'v2.8' 
  });
};
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=true&cookie=true&version=v2.8&appId=473627996352923";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
function testAPI() {
  console.log('Welcome!  Fetching your information.... ');
  FB.api('/me', { locale: 'tr_TR', fields: 'id,first_name,middle_name,last_name,email,picture' },
  function(response) {
    console.log(response.id);
    console.log(response.email);
    console.log(response.first_name);
    console.log(response.middle_name);
    var first_name = response.first_name;
    var middle_name = response.middle_name;
    var last_name = response.last_name;
    var id = response.id;
    var email = response.email;
    //var picture = response.picture.data.url;
    var picture = "http://graph.facebook.com/" + response.id + "/picture?type=normal";
    console.log(picture);
    // alert(picture);
    // return false;

    $.ajax({
        method:'POST',
        url:$base_url+"/App/fbLogin",
        data:'name='+first_name+'&mname='+middle_name+'&lname='+last_name+"&user_id="+id+'&email='+email+'&picture='+picture,
        success:function(html){
          if(html == 1){
            location.href = $base_url+"/App/desBooking";
          }else if(html == 2){
             $('#usertyped').val(1);
             var profileHTML = '<div class="profile"><img src="'+picture+'"/><br>  Welcome '+first_name+'! click here for register <a href="javascript:void(0);" onclick="Redirect();">Click here...</a></div>';

            $('.userContent').html(profileHTML);
            //$('#gSignIn').slideUp('slow');
            // console.log(html);return false;
              //window.location.href = $base_url+'/App/CreateAccount';
          }else{
            return false;
          }
        }
    });              
  });
}
// function onSignIn(googleUser) {
// 	$('#custom_signin_button').click(function(){      
// 	var profile = googleUser.getBasicProfile();
// 	var google_id =  profile.getId();
// 	var givenname =  profile.getGivenName();
// 	var familyname =  profile.getFamilyName();
// 	var getImageUrl =  profile.getImageUrl();
// 	var getEmail =  profile.getEmail();
// 	var data_to_send =  'google_id='+google_id+'&name='+givenname+'&lastname='+familyname+"&profile_pic="+getImageUrl+'&email='+ getEmail;
//   console.log(data_to_send);return false;
//   	$.ajax({
//     	method:'POST',
//     	url:$base_url+'/App/googleLogin',
//     	data: {
//     	google_id: google_id,
//     	name: givenname,
//     	familyname: familyname,
//     	imageUrl: getImageUrl,
//     	email: getEmail
//     	},
//     	success:function(html){
//       	if(html == 2){
//             //console.log(html);return false;
//           window.location.href = $base_url+'/App/CreateAccount';        
//       	}else if(html == 1){             
//       	 window.location.href = $base_url+'/App/book_order';
//       	}else{
//         	console.log(hfsdgf);
//         	return false;               
//         }
//     	}
//     });
//   });
// }
function Redirect(){  
  window.location=$base_url+'/App/CreateAccount'; 
} 

function log(googleUser){
  var profile = googleUser.getBasicProfile();
  var google_id =  profile.getId();
  var givenname =  profile.getGivenName();
  var familyname =  profile.getFamilyName();
  var getImageUrl =  profile.getImageUrl();
  var getEmail =  profile.getEmail();

  $.ajax({
    method:'POST',
    url:$base_url+'/App/googleLogin',
    data: {
    google_id: google_id,
    name: givenname,
    familyname: familyname,
    imageUrl: getImageUrl,
    email: getEmail
    },
    success:function(html){
      if(html == 2){
       // var profileHTML = '<div class="profile"><img src="'+getImageUrl+'"/><br>  Welcome '+givenname+'! click here for register <a href="javascript:void(0);" onclick="Redirect();">Click here...</a></div>';

        //$('.userContent').html(profileHTML);
       // $('#gSignIn').slideUp('slow');
        //console.log(html);return false;
       window.location.href = $base_url+'/App/CreateAccount';
        //document.write("Thanks for logging! You will be redirected to a new page in 5 seconds"); 
        //setTimeout('Redirect()', 5000);      
      }else if(html == 1){             
        window.location.href = $base_url+'/App/book_order';
      }else{
        console.log(hfsdgf);
        return false;               
      }
    }
  });
}
function onFailure(error) {
    alert(error);
}            
function renderButton() {
  gapi.signin2.render('gSignIn', {
      'scope': 'profile email',
      'width': 140,
      'height': 35,
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

$(document).ready(function() {
$('#contact_us').click(function(e){
		e.preventDefault();
	$current_date = $('#min-date').val();
	$.ajax({
		  method: "POST" ,
		  url: $base_url+"/App/checkDateTime",
		  data: { date: $current_date }
		}).done(function(msg) {
			console.log(msg);
			//document.getElementById("contactus-form1").submit();
			if(msg == 1){
				
				$("#contactus-form1").submit();		
							}
		else{		$("#error").text("Please enter correct booking date time");
				//return false;
	 
		    }
		});
	});
var quantitiy = 0;
$('.quantity-right-plus').click(function(e) {
// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity = parseInt($('#quantity').val());
// If is not undefined
$('#quantity').val(quantity + 1);
// Increment
});
$('.quantity-left-minus').click(function(e) {
// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity = parseInt($('#quantity').val());
// If is not undefined
// Increment
if (quantity > 0) {
$('#quantity').val(quantity - 1);
}
});
});

