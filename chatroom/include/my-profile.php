<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username']) && (!isset($_COOKIE['cookie_username']))){die(header('location: signin.php'));}
include"conn.php";

if(!(isset($_SESSION['username'])) && (!isset($_COOKIE['cookie_username']))){header("Location: index.php");
die();}
if(isset($_SESSION['username'])){$username=$_SESSION['username'];}else{$username=$_COOKIE['cookie_username'];}

$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$count=mysqli_num_rows($query);
if($count==0){die(header("Location: logout.php"));}

?>

<div class='padding-sm' style='padding-bottom:0;'>
<div class='row box-shadow-z1' >
<div class="box col-sm-12" id='middle_body' style='padding:0;margin-bottom:0;'>
						<div class="box-header">
						
							 	<span class='pull-right text-primary' id='photo_upload_status'></span>
							<h3>My Profile</h3>
						
						</div>
						 <div class="box-divider m-0"></div>
						 
						<div class="box-body inner-box-overflow" style='padding:0 0 10px 0;height: calc(100vh - 125px) !important;'>
						  
						
  <div class="item">
    <div class="item-bg">
      <img id="cover_pic_display" style='margin-top:-100px;height:300px;' src="../chatroom/upload/cover_pic/<?php if($row['cover_pic']==""){echo "user_default.jpg";}else{echo $row['cover_pic'];}?>" class="">
    </div>
    <div class="p-a-md">
      <div class="row m-t">
        <div class="col-sm-7">
          
		  
		    
		 <label  for='profile_pic' class="pull-left m-r-md">
				 <span class="image-cropper" style='cursor:pointer;'>
              <img style='' class="profile-pic profile_pic_display" src="../chatroom/upload/profile_pic/<?php if($row['profile_pic']==""){echo "user_default.jpg";}else{echo $row['profile_pic'];}?>"></img>
              <i class="on b-white"></i>
			  <span class="bottomimg  primary on"><span style='margin-left:38px;margin-top:10px' class="fas fa-edit"></span> </span>
            </span> 
			
				 
				  </label>
				  <input id="profile_pic"  name='image_file' type="file" style='display:none; '/>
				  
            
          <span class="clear m-b">
           <h3 class="m-0 m-b-xs">@ <?php echo $username; ?></h3>
            <p class="text-muted"><span class="m-r"><?php echo $row['mood']; ?></span> <small><i class="fa fa-map-marker m-r-xs"></i><?php echo $row['country']; ?></small></p>
           
            <div class="col-sm-8">
         
        </span>
          </div>
        </div>
        
      </div><label for='cover_pic' style='display:inline'><span style='cursor:pointer' class="pull-right fas fa-edit text-muted"> Edit Cover Photo</span></label> 
	  <input id="cover_pic"  name='cover_img_file' type="file" style='display:none; '/>
    </div>
  </div>
  <div class="dker p-x">
    <div class="row">
      <div class="col-sm-6 push-sm-6">
        <div class="p-y text-center text-sm-right">
         
        </div>
		
      </div>
      <div class="col-sm-6 pull-sm-6">
        <div class="p-y-md clearfix nav-active-primary">
          <ul class="nav nav-pills nav-sm">
            <li class="nav-item active">
          
            <li class="nav-item">
              <a class="nav-link active" href="" data-toggle="tab" data-target="#tab_4">Profile</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="padding">
    <div class="row">
      <div class="col-lg col-md-12 col-sm-12 col-xs-12">
        <div class="tab-content">      
       <div class="tab-pane p-v-sm active" id="tab_4">
            <div class="row m-b">
           
			   <div class="col-6">
			   <small class="text-muted">Country</small>
			   <select class="form-control c-select r" id="country_profile" name='country'>
			   <option value="<?php if($row['country']==""){ echo "India";}else{echo $row['country'];} ?>" selected>
			   <?php if($row['country']==""){ echo "India";}else{echo $row['country'];} ?>
			   </option>
			   <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="United States of America">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
			   </select>
              </div>
			  
			  <div class="col-6"><small class="text-muted">Language</small><input maxlength='100' type="text" class="form-control" id="language_profile" placeholder="Language" value="<?php echo $row['language']; ?>"></div>
			  </div>
			   <div class="row m-b">
			  <div class="col-6">
			  <small class="text-muted">Who can PM?</small>
			    <select id="pm_status_profile" class="form-control c-select r col-xs-6" >
				<option value="1" selected><?php if($row['pm_status']==1){echo "Everyone";} ?></option>
			   <option value="1">Everyone</option>
			   <option value="2">Nobody</option>
			   <option value="3">Only Registered Members</option>
			   
			   </select>
              </div>
			 
			   <div class="col-6">
			  <small class="text-muted">Gender</small>
			
			    <select class="form-control c-select r col-xs-6" id='gender_profile'>
				<option selected value="<?php echo $row['gender'];?>">
				<?php if($row['gender']==1){echo "Male";}elseif($row['gender']==2){echo "Female";}else{echo "Other";} ?>
				</option>
			   <option value="1">Male</option>
			   <option value="2">Female</option>
			   <option value="3">Other</option>
			   </select>
              </div>
              </div>
			  </div>
			  <div class="row m-b">
			   <div class="col-12"><small class="text-muted">My Mood</small><input maxlength='30' type="text" class="form-control" id='mood_profile' placeholder="Mood" value="<?php echo $row['mood']; ?>"></div>
			  </div>
            </div>
			
			
            <div>
              <small class="text-muted">Bio</small>
			  
			  <div class="form-group row m-b">
			  <div class="col-12">
			  <textarea maxlength="500" class="form-control" id="bio_profile"><?php echo $row['bio']; ?></textarea></div></div>
            </div>
			<button type="submit" id="profile_update_btn" class="btn  primary">Update Profile</button>
			<small><span class='text-primary sucs_updt' style='display:none'>Updated</span></small>
			<small><span class='text-danger error_updt' style='display:none'>Failed</span></small>
          </div>
	
		  <div class='box col-lg col-md-6 col-sm-12'><div class=" box-header"></i><h3>Friend List <i class="fas fa-user-friends"> </i></h3></div><div class="box-divider m-a-0"></div>
		   <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: 270px;'>
						<ul class="list no-border p-b">
						
						 <?php include('friend-list.php');?>
						 </ul>
          </div>
		  </div>
		  
		  <div class="box col-lg col-md-6 col-sm-12"><div class="box-header"><h3>Block List <i class="fas fa-ban"> </i> </h3></div><div class="box-divider m-a-0"></div>
		   <div class="box-body inner-box-overflow" style='padding:0px !important; overflow-x:hidden;height: 270px;'>
						<ul class="list no-border p-b">
						
						 <?php include('block-list.php');?>
						 </ul>
          </div>
		  </div>
        </div>
		
      </div>
    </div>
  </div>
<br>  
						  
						</div>
					</div>


					</div>


            
 
			
			
			
         
         
        </div>
    <style>


.bottomimg {
	 // height: 45px;
  // width: 90px;
  // display: inline-block;
  // margin: 0 1em 1em 0;
  // border-bottom-left-radius: 96px;
  // border-bottom-right-radius: 96px;
  
  // opacity:0.7;
  // margin-left:-93px;
  // margin-top:48px;
}

	</style>
	
	<script>
	$('#profile_update_btn').click(function(){
		$.post('include/update-profile.php',{country: $('#country_profile').val(), language: $('#language_profile').val(), pm_status: $('#pm_status_profile').val(), gender:$('#gender_profile').val(), mood:$('#mood_profile').val(), bio: $('#bio_profile').val()},function(output){
			if(output==111111){
				$('.error_updt').hide();$('.sucs_updt').fadeIn("slow").fadeOut('slow');
			}else{$('.sucs_updt').hide();$('.error_updt').fadeIn("fast").fadeOut('slow');}
		});
		
	});
	
	
	
	
$('#profile_pic').change(function(){
		 if($("#profile_pic")[0].files[0].size>2097152 ||
			   (
			   ($("#profile_pic")[0].files[0].type)!='image/png' &&
			   ($("#profile_pic")[0].files[0].type)!='image/jpg' &&
			   ($("#profile_pic")[0].files[0].type)!='image/jpeg'
			   )){
				alert('Only jpg/jpeg and png image of size less than 2mb is allowed.');   
			   }else{
				  
	var datax = new FormData();
    datax.append('image_file', $('#profile_pic').prop('files')[0]);
	datax.append('pictype', 'a');
    $.ajax({
  xhr: function() {
    var xhr = new window.XMLHttpRequest();

    xhr.upload.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        percentComplete = parseInt(percentComplete * 100);
        $('#photo_upload_status').text('Uploading...('+percentComplete+'%)');

        if (percentComplete === 100) {
		$('#photo_upload_status').hide();

        }

      }
    }, false);

    return xhr;
  },
        type: 'POST',               
        processData: false, 
        contentType: false,
        data: datax,
        url: 'include/profile-image-upload.php',
        dataType : 'text',  
       
        success: function(output){
			if(output.slice(0, 6)=="okdone"){
				$(".profile_pic_display").attr("src","../chatroom/upload/profile_pic/"+output.slice(6, output.length));
			}
	
		  else{} 
		
		}
       
    });
	}
});





$('#cover_pic').change(function(){
		 if($("#cover_pic")[0].files[0].size>2097152 ||
			   (
			   ($("#cover_pic")[0].files[0].type)!='image/png' &&
			   ($("#cover_pic")[0].files[0].type)!='image/jpg' &&
			   ($("#cover_pic")[0].files[0].type)!='image/jpeg'
			   )){
				alert('Only jpg/jpeg and png image of size less than 2mb is allowed.');   
			   }else{
	var datax = new FormData();
    datax.append('image_file', $('#cover_pic').prop('files')[0]);
	datax.append('pictype', 'b');
    $.ajax({
  xhr: function() {
    var xhr = new window.XMLHttpRequest();

    xhr.upload.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        percentComplete = parseInt(percentComplete * 100);
        $('#photo_upload_status').text('Uploading...('+percentComplete+'%)');

        if (percentComplete === 100) {
		$('#photo_upload_status').hide();

        }

      }
    }, false);

    return xhr;
  },
        type: 'POST',               
        processData: false, 
        contentType: false,
        data: datax,
        url: 'include/profile-image-upload.php',
        dataType : 'text',  
       
        success: function(output){
			if(output.slice(0, 6)=="okdone"){
				$("#cover_pic_display").attr("src","../chatroom/upload/cover_pic/"+output.slice(6, output.length));
			}
	
		  else{} 
		
		}
       
    });
	}
});
		
	
	
	
	
	
	
</script>
