<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
  <title>MyChatHub | Guest Login Without Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="MyChatHub is a social platform where you can join rooms of your interest and interact with people in that room.">
<link rel="canonical" href="https://www.mychathub.in/">
<meta name="theme-color" content="#0cc2aa">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:title" content="MyChatHub - Guest Login Without Registration">
<meta property="og:description" content="MyChatHub is a social platform where you can join rooms of your interest and interact with people in that room.">
<meta property="og:url" content="https://www.mychathub.in/chatroom/guest-login.php">
<meta property="og:site_name" content="MyChatHub">

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
.is-valid{  padding-right: calc(1.5em + 0.75rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center right calc(0.375em + 0.1875rem);
  background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);}
  
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
      <div class="pull-center">
      </div>
    </div>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b text-sm">
       <center>Visit as Guest</center>
      </div>
      <form name="signup-form" id='signup-form' method='post' action='guest-acc-creat.php'>
        <div class="md-form-group float-label">
          
          <input type="text" name='username' id='username' class="md-input form-control" ng-model="user.text" autocomplete='off' required>
		  <small class='text-muted' style='font-size:10px;'>* Min. 3 chars | No special chars | Not already taken.</small>
		  <label>Choose username</label>
        </div>
           
        <div class="m-b-md">
          <label class="md-check">
            <input type="checkbox" name='tp' id='tp' class='' value='1' required><i class="primary"></i>Agree with <a id='tp_link' href class='text-primary'>terms and policy.</a>
          </label>
        </div>
        <button type="submit" id='submit-btn' class="btn  btn-block p-x-md" disabled='true'><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <center><div class="loader" id='loader-spin' style='display:none;' ></div><center><span id='btn-text'>Continue<span></button>
      </form>
	  </div>

    <div class="p-v-lg text-center">
     <div class="p-v-lg text-center">
      <div>Already have an account? <a ui-sref="access.signin" href="signin.php" class="text-primary _600">Sign in</a></div>
    </div> </div>
  </div>

<!-- ############ LAYOUT END-->

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<script>
  $('#signup-form').submit(function(){ return false; });
$('#submit-btn').click(function(){
	
$('#loader-spin').show();$('#btn-text').hide();$('#submit-btn').prop('disabled', true);
 

$.post($('#signup-form').attr('action'),$('#signup-form :input').serializeArray(),function(output){if(output=='1_ok'){window.location.replace("rooms.php");}else{window.location.replace("guest-login.php");}});



});
$('#username').keyup(function(){
var now_input_value = $('#username').val();
var username_length = $('#username').val().length;
           $.post('validate-username.php', {username: now_input_value}, function(output1){ if(now_input_value!='' &&output1==0 && username_length>=3 && /^[a-zA-Z0-9_ ]*$/.test(now_input_value) ){$('#username').removeClass('is-invalid');$('#username').addClass('is-valid');} else{$('#username').removeClass('is-valid');$('#username').addClass('is-invalid');}});
 });
 
 var check=function(){if( $('#username').hasClass('is-valid')&& $('#tp_link').hasClass('is-valid') && $('#loader-spin').is(':hidden')){$('#submit-btn').prop('disabled',false);$('#submit-btn').addClass('primary');}
else{$('#submit-btn').prop('disabled',true);$('#submit-btn').removeClass('primary');}

if($('#tp').prop('checked')==true){$('#tp_link').removeClass('');$('#tp_link').addClass('is-valid');}else{$('#tp_link').removeClass('is-valid');$('#tp_link').addClass('');}
  }
  setInterval(check,0);
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
