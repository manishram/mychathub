<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>	  <div id="aside_2"  class="app-aside modal nav-dropdown">
  	<!-- fluid app aside -->
    <div class="right navside white dk" style='width:80%;' data-layout="column">
  	  
      <div class="scroll" data-flex >
          <nav class="scroll nav-light">
         <div class="b-b b-primary nav-active-primary box-shadow-z2">
          <ul class="nav " style=" width:100%;height:48px;z-index:0;overflow-x:auto;overflow-y:hidden;">
            
            <li style="width:100%;" class="nav-item">
              <a class="nav-link active" style="line-height:1.0rem;height:48px" href="" data-toggle="tab" data-target="#tab6" aria-expanded="true"><center>
<i style="margin:7px; padding:0px;" class="fas fa-user-friends fa-lg"></i>
<small style="font-size:80%;padding:0;margin:0;" class=" text-ellipsis">Friends</small>
</center></a>
            </li>
          </ul>
        </div>
        <div class="tab-content" >
          <div class="tab-pane animated fadeIn text-muted active" id="tab13" aria-expanded="true">
          
						  	 <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: calc(100vh - 100px);'>
						<ul class="list no-border p-b">
						
						 <?php include('friend-list.php');?>
						 </ul>
          </div>
		  </div>
        </div>
      

        </nav>
      </div>
      <div class="modal inactive" style='z-index:10000;' id="chat" data-backdrop="false">
  <div style='width:125%;' class="right w-xxl white dk b-l">
  	<div ui-include="'../views/blocks/modal.chat.html'"></div>
  </div>
</div>	
    </div>
  </div>
 
	