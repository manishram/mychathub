<?php
include"include/app-data.php";

include"conn.php";
session_start();
if((isset($_SESSION['username'])) || (isset($_COOKIE['cookie_username'])) && (isset($_COOKIE['cookie_session_id']))){
	header("Location: rooms.php");
}
else{}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>MyChatHub | Singin To Enter Chatroom</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#0cc2aa">
<meta name="description" content="Signin page for registered users. Enter your username and password and you will enter your chat room.">
<meta name="keywords" content="login to mychathub, signin mychathub, signin, chat, chat rooms, chatroom, chatrooms, free chat without registration, chat with strangers, online chat">



<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:title" content="MyChatHub - Online Chat Rooms For Everyone |  Free And Without Registration">
<meta property="og:description" content="MyChatHub provides free online chat rooms of your interest. Select the chat room and get started for free without registration.">
<meta property="og:url" content="https://www.mychathub.in/chatroom/signin.php">
<meta property="og:site_name" content="MyChatHub">
<meta property="og:image" content="https://www.mychathub.in/assets/img/mychathub-screenshot.png">

<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="MyChatHub" />
<meta name="apple-mobile-web-app-status-bar-style" content="#0a8d7c"/>



  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
  
<link href="../assets/img/favicon.png" rel="icon">

<link rel="icon" sizes="128x128" href="../assets/img/icons/icon-128x128.png">
<link rel="apple-touch-icon" sizes="128x128" href="../assets/img/icons/icon-128x128.png">
<link rel="icon" sizes="192x192" href="../assets/img/icons/icon-192x192.png">
<link rel="apple-touch-icon" sizes="192x192" href="../assets/img/icons/icon-192x192.png">
<link rel="icon" sizes="256x256" href="../assets/img/icons/icon-256x256.png">
<link rel="apple-touch-icon" sizes="256x256" href="../assets/img/icons/icon-256x256.png">
<link rel="icon" sizes="384x384" href="../assets/img/icons/icon-384x384.png">
<link rel="apple-touch-icon" sizes="384x384" href="../assets/img/icons/icon-384x384.png">
<link rel="icon" sizes="512x512" href="../assets/img/icons/icon-512x512.png">
<link rel="apple-touch-icon" sizes="512x512" href="../assets/img/icons/icon-512x512.png">


 
</head>
<style>
.loader {
  border: 3px solid #f3f3f3; /* Light grey */
  border-top: 3px solid #92e8dd;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 1.0s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.is-invalid{padding-right: calc(1.5em + 0.75rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
  background-repeat: no-repeat;
  background-position: center right calc(0.375em + 0.1875rem);
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);}
</style>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->
  <div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar">
      <div class="">
	  <center><img src="../assets/mychathub-logo.svg" style="height:50px;"></img></center>
      </div>
    </div>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b text-sm">
       <center>Sign In</center>
      </div> 
	  
	  <form name="signin-form" id='signin-form' method='post' action='start-session.php'>
        <div class="md-form-group float-label">
          <input type="text" class="md-input" name='username' ng-model="user.text" required>
          <label>Username</label>
        </div>
        <div class="md-form-group float-label">
          <input type="password" class="md-input" name='password' ng-model="user.password" required>
          <label>Password</label>
        </div>      
		<div class="m-b-md" id='wrong-text' style='display:none;'>        
          <label class="md-check">
            <p class='text-danger is-invalid' >Wrong username or password</p>
          </label>
        </div>
        <div class="m-b-md">        
          <label class="md-check">
            <input type="checkbox" name='keepsigned' value='1' checked><i class="primary"></i> Keep me signed in
          </label>
        </div>
        <button type="submit" id='submit-btn' class="btn primary btn-block p-x-md" ><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <center><div class="loader" id='loader-spin' style='display:none;' ></div><center><span id='btn-text'>Sign In<span></button>
     </form>
	 
	 <br>
<center><a href='guest-login.php'><button type="submit" class="btn btn-sm btn-outline  b-primary text-primary">Visit as Guest</button></a></center>
	  </div>

    <div class="p-v-lg text-center">
      <div class="m-b"><a ui-sref="access.forgot-password" href="forgot-password.php" class="text-primary _600">Forgot password?</a></div>
      <div>Do not have an account? <a ui-sref="access.signup" href="signup.php" class="text-primary _600">Sign up</a></div>
    </div>
  </div>

<!-- ############ LAYOUT END-->

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<script>
  
  
 $('#signin-form').submit(function(){ return false; });
$('#submit-btn').click(function(){
	

$.post($('#signin-form').attr('action'),$('#signin-form :input').serializeArray(),
function(output){console.log(output);if(output == 1){$('#submit-btn').removeClass('primary');$('#loader-spin').show();$('#btn-text').hide();$('#submit-btn').prop('disabled',true);$('#wrong-text').hide();window.location.replace("rooms.php");}
else{$('#wrong-text').show();$('#loader-spin').hide();$('#btn-text').show();}});
	});

</script>
  <!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../libs/jquery/PACE/pace.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>

  <script src="scripts/app.js"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>

<!-- endbuild -->

</body>

</html>
