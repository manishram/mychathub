<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}


?> <div id="aside_2"  class="app-aside modal nav-dropdown">
  	<!-- fluid app aside -->
    <div class="right navside white dk" style='margin-top:55px;width:80%;' data-layout="column">
  	  
      <div class="scroll" data-flex >
          <nav class="scroll nav-light">
           <div class="b-b b-primary nav-active-primary">
          <ul class="nav nav-tabs" style='width:100%;height:48px;z-index:0;overflow-x:auto;overflow-y:hidden;'>
            <li style='width:33.33%;' class="nav-item" >
              <a class="nav-link active" style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab11" aria-expanded="false">
			 <center><i style='margin:0px; padding:0px;' class='fas fa-users fa-lg'></i> 
			 <small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Members</small>
			 </center>
			  
			  </a>
            </li>
            <li style='width:33.33%;' class="nav-item">
              <a class="nav-link" style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab12" aria-expanded="false"> <center>
<i style='margin:0px; padding:0px;' class='fas fa-globe-asia fa-lg'></i> 
<small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Rooms</small>
</center></a>
            </li>
            <li style='width:33.33%;' class="nav-item">
              <a class="nav-link " style='height:48px;border-radius:0;' href="" data-toggle="tab" data-target="#tab13" aria-expanded="true"><center>
<i style='margin:0px; padding:0px;' class='fas fa-user-friends fa-lg'></i> 
<small style='font-size:80%;padding:0;margin:0;' class="text-muted text-ellipsis">Friends</small>
</center></a>
            </li>
          </ul>
        </div>
        <div class="tab-content" >
          <div class="tab-pane animated fadeIn text-muted active" id="tab11" aria-expanded="false">
            <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 165px);'>
						<ul class="list no-border p-b members-list-ul-phone">
						 <?php include('room-members.php'); ?>
						   </ul>
						
						
			        </div>
					 
          </div>
          <div class="tab-pane animated fadeIn text-muted" id="tab12" aria-expanded="false">
		   <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 165px);'>
						<ul class="list no-border p-b ">
           <?php include('room-list-right.php'); ?>
		   </ul></div>
          </div>
          <div class="tab-pane animated fadeIn text-muted " id="tab13" aria-expanded="true">
		  <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 165px);'>
						<ul class="list no-border p-b ">
           <?php include('friend-list.php'); ?>
			</ul>
			</div>
          </div>
        </div>
      

        </nav>
      </div>
      <div class="modal inactive" style='z-index:10000;' id="chat" data-backdrop="false">
 
</div>	
    </div>
  </div>
 