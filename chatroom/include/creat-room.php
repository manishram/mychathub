<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
<style>
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
  
.loader {
  border: 3px solid #f3f3f3; /* Light grey */
  border-top: 3px solid #92e8dd;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 1.0s linear infinite;
}
</style>
<center><form name="signin-form" id='creat-room-form' method='post' action='add-room.php' class='box-shadow-z1' style='max-width:800px;padding:20px;'>
        <div class="md-form-group float-label">
          <input type="text" autocomplete='off'  class="md-input form-control" maxlength='20' name='room_name' id='room_name' ng-model="user.text" required>
          <small class='text-muted' style='font-size:10px;float:left !important;'>* 3-20 chars | Not already existing | No special chars.</small>
		  <label>Name of Room</label>
		  
        </div>
		
        <div class="md-form-group float-label">
          <input type="text" autocomplete='off'  class="md-input" name='room_desc' maxlength='80' id='room_desc' ng-model="user.text" required>
          <small class='text-muted' style='font-size:10px;float:left !important;'>* max 80 chars | This will be short room description</small>         
		 <label>Room Description</label>
        </div>  
 <div class="md-form-group float-label">
          <input autocomplete='off'  type="text" class="md-input" maxlength='300' name='room_msg' id='room_msg' ng-model="user.text" required>
          <small class='text-muted' style='font-size:10px;float:left !important;'>* max 300 chars | This will appear when user enters room.</small>
		  <label>Welcome message and Rules</label>
        </div>  		

<div class="m-b-md" id='div_room_type' >  		
<select class="form-control c-select " name='room_type' id='room_type'>
   <option value="" disabled selected>Type of room?</option>
                  <option value='0'>Public</option>
                  <option value='1'>Private</option>
                </select>		
		</div>
		 <div class="md-form-group float-label" style='display:none;' id='div_room_pass'>
          <input type="password" class="md-input" maxlength='30' name='room_pass' id='room_pass' ng-model="user.text" autocomplete='off' required>
          <small class='text-muted' style='font-size:10px;float:left !important;'>* Min 4 chars | Password for your private room.</small>
		  <label>Room Password</label>
        </div>  
		
		
		<div class="m-b-md" id='div_who_can'>        
      <select   class="form-control c-select" name='who_can' id='who_can'>
   <option value=""  style='font-color:#0cc2aa' disabled selected>Who can enter room?</option>
                  <option value='0'>All</option>
                  <option value='1'>Only Registered Members</option>
                <option value='2'>Only VIP members</option>
				<option value='3'>Only Guests</option>
				</select>
        </div>
        <div class="m-b-md" id='div_room_cat'>        
      <select name='room_cat' id='room_cat' class="form-control c-select">
   <option value="" disabled selected>Room category</option>
                  <option value='0'>Science and Technology</option>
                  <option value='1'>Entertainment</option>
				  <option value='2'>Others</option>
                
				</select>
        </div>
		
		
             
            <br>
        <button type="submit" id='submit-btn' class="btn btn-block p-x-md" ><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <center><div class="loader" id='loader-spin' style='display:none;' ></div></center><span id='btn-text'>Creat Room<span></button>
     </form>
	 
	 <div id='room_created_div' style='display:none;'>
	 <br>
	 <i class='fa fa-check-circle' style='font-size:50px;color:#0cc2aa;'></i><br>
	 <font style='font-size:20px;'>Room Created Successfully</font><br>
	 <br>
	 <a href='rooms.php' class='btn primary'>Home</a>
	 </div>
	  <div id='room_err_div' style='display:none;'>
	  <br>
	 <i class='fa fa-times-circle text-danger' style='font-size:50px;'></i><br>
	 <font style='font-size:20px;'>Something Went wrong :(</font><br>
	 <br>
	 <a href='index.php' class='btn grey'>Go Back</a>
	 </div>
	 <br>
	 </center>
	 <script>
	  $('#creat-room-form').submit(function(){ return false; });
$('#submit-btn').click(function(){
	
$('#loader-spin').show();$('#btn-text').hide();$('#submit-btn').prop('disabled', true);
 
$.post($('#creat-room-form').attr('action'),$('#creat-room-form :input ').serializeArray(),function(output){if(output==1){$('#creat-room-form').hide(300);$('#room_created_div').show(400) }else{$('#creat-room-form').hide(300);$('#room_err_div').show(400) }
});
});
	 
	 
	 $('#room_name').keyup(function(){
var room_name_value = $('#room_name').val();
var room_name_length = $('#room_name').val().length;
           $.post('include/validate-room.php', {room_name: room_name_value}, function(output1){ if(room_name_value!='' &&output1==0 && room_name_length>=3 && room_name_length<=20 && /^[a-zA-Z0-9_ ]*$/.test(room_name_value) ){$('#room_name').removeClass('is-invalid');$('#room_name').addClass('is-valid');} else{$('#room_name').removeClass('is-valid');$('#room_name').addClass('is-invalid');}});
 });
 
 	 $('#room_msg').keyup(function(){
var room_msg_value = $('#room_msg').val();
var room_msg_length = $('#room_msg').val().length;
            if(room_msg_value!='' && room_msg_length<=300 ){$('#room_msg').removeClass('is-invalid');$('#room_msg').addClass('is-valid');} else{$('#room_msg').removeClass('is-valid');$('#room_msg').addClass('is-invalid');}
			
			
			});

 
  $('#room_desc').keyup(function(){
var room_desc_value = $('#room_desc').val();
var room_desc_length = $('#room_desc').val().length;
            if(room_desc_value!='' && room_desc_length<=80 ){$('#room_desc').removeClass('is-invalid');$('#room_desc').addClass('is-valid');} else{$('#room_desc').removeClass('is-valid');$('#room_desc').addClass('is-invalid');}
			
			
			});
 
  $('#room_type').click(function(){
var room_type_value = $('#room_type').val();
            if(room_type_value!='' && (room_type_value=='0' || room_type_value=='1')){$('#div_room_type').removeClass('is-invalid');$('#div_room_type').addClass('is-valid');} else{$('#div_room_type').removeClass('is-valid');$('#div_room_type').addClass('is-invalid');}
			
			if(room_type_value=='1'){$('#div_room_pass').show(300);}else{$('#div_room_pass').hide(300);}
			
			});
			
 $('#room_pass').keyup(function(){
var room_pass_value = $('#room_pass').val();
var room_pass_length = $('#room_pass').val().length;
 if(room_pass_value!='' && room_pass_length<=30 && room_pass_length>=4){$('#room_pass').removeClass('is-invalid');$('#room_pass').addClass('is-valid');} else{$('#room_pass').removeClass('is-valid');$('#room_pass').addClass('is-invalid');}});		

			
  $('#who_can').click(function(){
var who_can_value = $('#who_can').val();
            if(who_can_value!='' && (who_can_value=='0' || who_can_value=='1'|| who_can_value=='2')|| who_can_value=='3'){$('#div_who_can').removeClass('is-invalid');$('#div_who_can').addClass('is-valid');} else{$('#div_who_can').removeClass('is-valid');$('#div_who_can').addClass('is-invalid');}
		
			});
			
			$('#room_cat').click(function(){
var room_cat_value = $('#room_cat').val();
            if(room_cat_value!='' && (room_cat_value=='0'|| room_cat_value=='1'||room_cat_value=='2' )){$('#div_room_cat').removeClass('is-invalid');$('#div_room_cat').addClass('is-valid');} else{$('#div_room_cat').removeClass('is-valid');$('#div_room_cat').addClass('is-invalid');}
			
			
			});
			
 var check=function(){
	 var room_type_value = $('#room_type').val();
	 var pass_checker;
	 if(room_type_value=='1'){pass_checker=$('#room_pass').hasClass('is-valid');}else{pass_checker=true;}
	 if( $('#room_name').hasClass('is-valid') && $('#room_desc').hasClass('is-valid') && $('#room_msg').hasClass('is-valid')&& $('#div_room_type').hasClass('is-valid') && $('#div_who_can').hasClass('is-valid') && $('#div_room_cat').hasClass('is-valid') 
&& (pass_checker)
	 && $('#loader-spin').is(':hidden')){$('#submit-btn').prop('disabled',false);$('#submit-btn').addClass('primary');}
else{$('#submit-btn').prop('disabled',true);$('#submit-btn').removeClass('primary');}

  }
  
  setInterval(check,1000);
  
  
	 </script>