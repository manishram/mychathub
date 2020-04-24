<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>		            
        <div class="b-b b-primary nav-active-primary">
          <ul class="nav nav-tabs" style='width:100%;height:48px;z-index:0;overflow-x:auto;overflow-y:hidden;'>
            <li style='width:33.33%;' class="nav-item" >
              <a class="nav-link active" style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab4" aria-expanded="false">
			 <center><i style='margin:0px; padding:0px;' class='fas fa-users fa-lg'></i> 
			 <small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Members</small>
			 </center>
			  
			  </a>
            </li>
            <li style='width:33.33%;' class="nav-item">
              <a class="nav-link" style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab5" aria-expanded="false"> <center>
<i style='margin:0px; padding:0px;' class='fas fa-globe-asia fa-lg'></i> 
<small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Rooms</small>
</center></a>
            </li>
            <li style='width:33.33%;' class="nav-item">
              <a class="nav-link " style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab6" aria-expanded="true"><center>
<i style='margin:0px; padding:0px;' class='fas fa-user-friends fa-lg'></i> 
<small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Friends</small>
</center></a>
            </li>
          </ul>
        </div>
        <div class="tab-content" >
          <div class="tab-pane animated fadeIn text-muted active" id="tab4" aria-expanded="false">
            <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 115px);'>
						<ul class="list no-border p-b members-list-ul">
						 <?php include('room-members.php'); ?>
						  </ul>
						
						
			        </div>
					 
          </div>
          <div class="tab-pane animated fadeIn text-muted" id="tab5" aria-expanded="false">
		  <div class="box-body inner-box-overflow room_list_right" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 115px);'>
						<ul class="list no-border p-b">
            <?php include('room-list-right.php'); ?>
			</ul>
			</div>
          </div>
          <div class="tab-pane animated fadeIn text-muted " id="tab6" aria-expanded="true">
 <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 115px);'>
						<ul class="list no-border p-b">         
		 <?php include('friend-list.php');?>

          </ul>
		  </div></div>
		  
        </div>
      
		<div class="modal fade" id="room_pass_modal" style='z-index:10000 !important;' role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enter Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
  
  <form name="signin-form" id='enter_room_form' method='post'>
 <div class="md-form-group float-label">
 	<input type='hidden' id='room_id' name='room_id'>
          <input type="password" class="md-input" name='room_pass' ng-model="user.text" required>
		  <small class='text-muted' style='font-size:10px;'>* Room Password.</small>
          <label>Password</label>
        </div>
		<center><small style='display:none;' id='wrong_room_pass_msg' class='text-danger'>* Wrong Password Entered!!</small></center><br>
        <button type="submit" id='enter_room_after_pass' class="btn primary btn-block p-x-md" ><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <center><div class="loader" id='loader-spin' style='display:none;' ></div><center><span id='btn-text'>Enter Room<span></button>
     </form>
      </div>
      
    </div>
  </div>
</div>			
							
	