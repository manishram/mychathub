<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <title>MyChatHub | Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#0cc2aa">
<meta name="description" content="Forgot your password? You can recover your password of mychathub chat room by providing your username and you will receive email with step to recover your password.">
<meta name="keywords" content="forgot password, mychathub, login to mychathub, signin mychathub, signin, chat, chat rooms, chatroom, chatrooms, free chat without registration, chat with strangers, online chat">



<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:title" content="MyChatHub - Online Chat Rooms For Everyone |  Free And Without Registration">
<meta property="og:description" content="MyChatHub provides free online chat rooms of your interest. Select the chat room and get started for free without registration.">
<meta property="og:url" content="https://www.mychathub.in/chatroom/guest-login.php">
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
</head>
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
      <div class="m-b">
        Forgot your password?
        <p class="text-xs m-t">Enter your <strong>username</strong> below and we will send you an email to your given email address.</p>
      </div>
      <form name="reset" class='' method='post' action='forgot-pass-email.php'>
        <div class="md-form-group float-label">
           <input type="text" name='username' id='forgot-pass-username' class="md-input form-control" autocomplete='off' required>
          <label>Your Username</label>
		 
        </div>
        <button type="submit" class="btn primary btn-block p-x-md">Send</button>
      </form>
    </div>
    <p id="alerts-container"></p>
    <div class="p-v-lg text-center">Return to <a ui-sref="access.signin" href="signin.php" class="text-primary _600">Sign in</a></div>    
  </div>

<!-- ############ LAYOUT END-->

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
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
