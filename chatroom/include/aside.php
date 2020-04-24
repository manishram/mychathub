 <?php
 if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

 ?>
 <div id="aside" style='z-index:2000;'  class="box-shadow-z3 app-aside modal nav-dropdown">
  	<!-- fluid app aside -->
    <div class="left navside white dk" data-layout="column">
  	 <div class="navbar  primary no-radius box-shadow-z4" style=''>
        <!-- brand -->
        <a class="navbar-brand" style='padding:0;'>
        	<img src="../assets/logo.svg" alt="." style='width:150px !important; max-height:35px !important;padding:0;' class="">
        	<img src="../assets/images/logo.png" alt="." class="hide">
        </a>
        <!-- / brand -->
      </div>
      <div class="scroll" data-flex style='overflow-y:auto;overflow-x:hidden;'>
	  
          <nav  class="scroll nav-light">
		  <div class="item">
  <div class="item-bg hidden-folded">
    <img src="../assets/images/user_default.jpg" class="opacity-3">
  </div>
  <div class="pos-rlt">
    <div class="nav-fold">
    	<a href="#/app/page/profile" ui-sref="app.page.profile">
        <span class="pull-right m-v-sm hidden-folded">
          <b class="label rounded success">9</b>
        </span>
        <span class="block">
          <img src="../assets/images/user_default.jpg" alt="..." class="w-40 img-circle">
        </span>
        <span class="clear hidden-folded m-t-sm">
          <span class="block _500"><?php echo $row['username'];?></span>
          <small class="block text-muted">INDIA</small>
        </span>
      </a>
    </div>   
  </div>
</div>
 <ul class="nav" ui-nav="" style='display:block;'>
            
 <li class='active'>
                  <a href="rooms.php">
                    <span class="nav-icon">
                      <i class="fas fa-home">
                   
                      </i>
                    </span>
                    <span class="nav-text">Home</span>
                  </a>
                </li>
            	
                <li>
                  <a class="my-profile-btn">
                    <span class="nav-icon">
                      <i class="fas fa-user ">
                   
                      </i>
                    </span>
                    <span class="nav-text">My Profile</span>
                  </a>
                </li>
				
				  <li>
                  <a href="logout.php">
                    <span class="nav-icon">
                      <i class="fas fa-sign-out-alt ">
                   
                      </i>
                    </span>
					<span class="nav-text">Sign Out</span>
                    
                  </a>
                </li>
			   
                
            
            
              </ul>
  
   </nav>
      </div>
	  <div class="box-divider m-0"></div>

       
    </div>
  </div>
