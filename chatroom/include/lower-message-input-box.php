<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?> 
	<?php include('include/emoji-picker.php');   ?>
<div id="msg-input-div" class='box-header ' style='position:sticky;bottom:0;z-index:1000;background-color:#919696;width:100%;height:50px;padding:5px;'>

<div class='row'>
	
		<div class="input-group " style='margin:0px 20px 0px 15px' >        
		
		<br>
		
		<form class="conversation-compose" id='post-room-msg-form' method='post'>
                <div class="emoji emoi_picker_open_btn" style='cursor:pointer;'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path id='emoji_svg' fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg>
                </div>
				
                <input class="input-msg form-control" id='room_msg_input' style='margin-left:-1px;height:38px;'  maxlength='400' name='room-msg-input' placeholder="Type here.." autocomplete="off" />
                <div class="photo" style='margin-left:-1px;padding:2px;'>
                  <label  for='room_chat_img_input'>
				  <img class='attachment_input_btn' style='margin-top:3px;cursor:pointer;' src="https://i.ibb.co/zNL2yg0/ib-attach.png" alt="" width="25" height="25">
				  </label>
                  <label  for='room_chat_img_input'>
				  <img class='image_input_btn' style='margin-top:3px;cursor:pointer;' src="https://i.ibb.co/vHXYtHF/ib-camera.png" alt="" width="25" height="25"></label>
				  <input id="room_chat_img_input"  name='image_file' type="file" style='display:none;'/>
                <button id='post-room-msg' type='submit' class="send">
                    <div class="circle" style='margin-top:-2px;height:35px;width:35px;background:none;'>
                <i class="fa fa-paper-plane" style='color:#0cc2aa;font-size:20px;'></i>     
                    </div>
                  </button>
				</div>
                
              </form>
		</div></div>
 	
</div>


<div class="modal fade" id="delete_my_post_modal" role="dialog">
            <div class="modal-dialog modal-sm vertical-align-center">
              <div class="modal-content">
			  <div class="modal-header" style='background:#0cc2aa'>
        <h5 class="modal-title" id="exampleModalLongTitle" style='color:#fff;'>Are you sure to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		
      </div>                
<center> 
	  <div class="modal-body">
                  <input type='hidden' id='id_of_msg_to_dlt' value=''/>
<br>
		<button style='color:#fff;' id='delete_room_msg_confirm_btn' class='btn btn-sm btn-outline rounded b-danger text-danger'><i class='fas fa-trash-alt'> </i> &nbsp Delete</button>
		<button style='color:#fff;' data-dismiss="modal" id="cancel_img_upload_btn" class='btn btn-sm btn-outline rounded b-primary text-primary'>&nbsp Close &nbsp </button><br>
		<br>
	
		 </div>
		</center>  </div>
            </div>
        </div>

	
  
<center> 
</div>
<div class="modal fade" id="UploadmodelWindow" role="dialog">
            <div class="modal-dialog modal-sm vertical-align-center">
              <div class="modal-content">
			  <div class="modal-header" style='background:#0cc2aa'>
        <h5 class="modal-title" id="exampleModalLongTitle" style='color:#fff;'>Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		
      </div>                
<center> 
	  <div class="modal-body">
                  
               
<img style='height:80px;' id="upload_image_preview" src="#" alt="Your Selected File" />        
		 <span id='image_upload_no_error' style='display:none'><br>
		 
		<i class="fa fa-check-circle text-success" style="margin-top:5px;font-size:30px;"></i>
		</span>
		 <span id='image_upload_error' style='display:none'><br>
		  <i class='fa fa-times-circle text-danger' style='margin-top:5px;font-size:30px;'></i></span>
		 
		 
		      <hr>
			  <font style='font-size:10px;color:#ababab ;' ><p>*Only jpg/png/gif/mp4/mp3 file allowed.| Max. file size 4mb.</p></font>
			  <input style='border-radius:10px;' id='image-upload-foot-note' type='text' class='form-control' placeholder='Foot note (Optional)'/><br>
		<button style='color:#fff;' id='upload_image_confirm_btn' class='btn btn-sm btn-outline rounded b-primary text-primary'>Upload</button>
		<button style='color:#fff;' data-dismiss="modal" id="cancel_img_upload_btn" class='btn btn-sm btn-outline rounded b-danger text-danger'>Cancel</button><br>
		<br>
	
		 </div>
		</center>  </div>
            </div>
        </div>
<div class="modal fade" style="z-index:1001 !importand;" id="UploadmodelWindowpm" role="dialog">
            <div class="modal-dialog modal-sm vertical-align-center">
              <div class="modal-content">
			  <div class="modal-header" style='background:#0cc2aa'>
        <h5 class="modal-title" id="exampleModalLongTitle" style='color:#fff;'>Send File</h5>
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		
      </div>                
<center> 
	  <div class="modal-body">
                  
               
<img style='height:80px;' id="upload_image_preview_pm" src="#" alt="Your Selected File" />        
		 <span id='image_upload_no_error' style='display:none'><br>
		 
		<i class="fa fa-check-circle text-success" style="margin-top:5px;font-size:30px;"></i>
		</span>
		 <span id='image_upload_error_pm' style='display:none'><br>
		  <i class='fa fa-times-circle text-danger' style='margin-top:5px;font-size:30px;'></i></span>
		 
		 
		      <hr>
			  <font style='font-size:10px;color:#ababab ;' ><p>*Only jpg/png/gif/mp4/mp3 file allowed.| Max. file size 4mb.</p></font>
			  <input style='border-radius:10px;' id='image-upload-foot-note-pm' type='text' class='form-control' placeholder='Foot note (Optional)'/><br>
		<button style='color:#fff;' id='upload_image_confirm_btn_pm' class='btn btn-sm btn-outline rounded b-primary text-primary'>Upload</button>
		<button style='color:#fff;' data-dismiss="modal" id="cancel_img_upload_btn_pm" class=' btn btn-sm btn-outline rounded b-danger text-danger'>Cancel</button><br>
		<br>
	
		 </div>
		</center>  </div>
            </div>
        </div>
		

      
<script>
$('.emoi_picker_open_btn').click(function(){
	$('.emoji_picker_plate').slideToggle(300);
	

});

//emoji plate
   function addTextTag(text){
    document.getElementById('room_msg_input').value += text;
   document.getElementById("room_msg_input").focus();
   }        
   
   $('body').delegate('#close_emoji_picker_btn','click',function()
      {
	  $('.emoji_picker_plate').hide(300); 


	 
	 });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
				if(($("#room_chat_img_input")[0].files[0].type)=='audio/mp3'){
				$('#upload_image_preview').attr('src', '../../assets/images/mp3.png');	
				}
				else if(($("#room_chat_img_input")[0].files[0].type)=='video/mp4')
				{
					$('#upload_image_preview').attr('src', ' ../../assets/images/mp4.png');
					
				}
				else{
                $('#upload_image_preview').attr('src', e.target.result);
				}
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	
	
	
	
	$('#UploadmodelWindow').on('hidden.bs.modal', function () {
    $('#room_chat_img_input').val(null);
			  $('#image-upload-foot-note').val('');
});

  
   $('#room_chat_img_input').change(function(){
	  
	   $('#UploadmodelWindow').modal('show');
        readURL(this);
		 $('#upload_image_confirm_btn').text('Upload');
			  $('#upload_image_confirm_btn').attr("disabled",false);
		      $('#cancel_img_upload_btn').show();
			  $('#image_upload_error').hide();
			  $('#image_upload_no_error').show();
			  
			  
			   if($("#room_chat_img_input")[0].files[0].size>4194280 ||
			   (
			   ($("#room_chat_img_input")[0].files[0].type)!='image/png' &&
			   ($("#room_chat_img_input")[0].files[0].type)!='image/jpg' &&
			   ($("#room_chat_img_input")[0].files[0].type)!='image/jpeg' &&
			   ($("#room_chat_img_input")[0].files[0].type)!='image/gif' &&
			   ($("#room_chat_img_input")[0].files[0].type)!='audio/mp3' &&
			   ($("#room_chat_img_input")[0].files[0].type)!='video/mp4'
			   ))
			   
			   {
		         $('#upload_image_confirm_btn').attr('disabled',true);
				 $('#image_upload_no_error').hide();
		   	     $('#image_upload_error').show();
		       }
    });

$('#upload_image_confirm_btn').click(function(){
	$(this).text('Uploading...(');
	$(this).attr("disabled",true);
	$(this).attr("cursor","default");
	$('#cancel_img_upload_btn').hide();
	var data = new FormData();
    data.append('image_file', $('#room_chat_img_input').prop('files')[0]);
	  data.append('image_text', $('#image-upload-foot-note').val());
  
    $.ajax({
  xhr: function() {
    var xhr = new window.XMLHttpRequest();

    xhr.upload.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        percentComplete = parseInt(percentComplete * 100);
        $('#upload_image_confirm_btn').text('Uploading...('+percentComplete+'%)');

        if (percentComplete === 100) {
var ws_data=JSON.stringify({"data":myrmdat,"action":"update_room_msg"});
	conn.send(ws_data);
check();
	
        }

      }
    }, false);

    return xhr;
  },
        type: 'POST',               
        processData: false, 
        contentType: false,
        data: data,
        url: 'include/upload-image.php',
        dataType : 'json',  
       
        success: function(output){
			
          if(output==1){
			   $('#UploadmodelWindow').modal('hide');
			  $('#room_chat_img_input').val(null);
			  $('#image-upload-foot-note').val('');
 $('#upload_image_confirm_btn').text('Done');		
		$(this).attr("cursor","pointer");
			 
	
	
		  }else{} 
		}
       
    }); 
	
	
});




$('#delete_room_msg_confirm_btn').click(function(){
	$.post('include/delete-room-msg.php',{msg_id:$('#id_of_msg_to_dlt').val()}, function(output){
		if(output==1){
			
			var msg_id=$('#id_of_msg_to_dlt').val();
		$('#delete_my_post_modal').modal('hide');
	    $("small[msgid='"+msg_id+"']").closest('.msg_div_box').remove();
		var ws_data=JSON.stringify({"data":msg_id,"action":"update_dlt_room_msg"});
	conn.send(ws_data);
		}
		else{}
	});
});


</script>