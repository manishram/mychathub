<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
  <div class="row-col box-shadow-z3">
    <a data-dismiss="modal" class="pull-right text-muted text-lg p-a-sm m-r-sm">&times;</a>
    <div style='height:50px;' class="p-a primary b-b">
	 <a href class='pull-left w-32 m-l-sm' style="margin-top:-8px"><img id='pm_receiver_profile_pic' src='../assets/images/user_default.jpg' class='w-full img-circle' alt='...'></a>
     &nbsp <span class='h6'> </span>
    </div>
    <div class="row-row dker">
      <div class="row-body" id='scrollable-div'>
        <div class="row-inner" id='overflow-div-pm'>
          <div class="p-a-md" id='pm-chat-data'>
		  
		  
            
           
            
            
          </div>
		  
        </div>
      </div>
    </div>
	<div class="card bg-light emoji_picker_plate_pm" style="z-index:0;display:none;border:#ccc;box-shadow:0px 0px 2px 1px #c4c4c4;">
 <div class="card-header ">Emoji Plate
 <span style='float:right;cursor:pointer;' id='close_emoji_picker_btn_pm'><i class='fa fa-times text-muted'></i></span>
 </div>
  <div class="card-body " style='padding:5px;height:190px;overflow-y:auto;overflow-x:hidden;'>
    
    
	 <div class="container">
  <div class="row" style=''>
	
	<?php
$emoji_code = file($file, FILE_IGNORE_NEW_LINES);
$emoji_img = file($file_2, FILE_IGNORE_NEW_LINES);
$i=0;
while($i<sizeof($emoji_code)){
echo"
<div class='col text-center p-1 btn'  onClick='addTextTaginpm(`$emoji_code[$i]`); return false' style='cursor:pointer;'>
      <img src='include/emoji/face/$emoji_img[$i]' style='height:padding:0;20px;width:20px;'></img>
    </div>";	
	$i=$i+1;
}


?>
    
  </div>
  
</div>
 </div>
	
  </div>
    <div class="p-a b-t">
     <form class="clear" id='personal-chat-form' action='post'>
 <span class="emoji emoi_picker_open_btn_pm" style='cursor:pointer;'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path id='emoji_svg' fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg>
                </span>	  
	  <label  for='pm_img_input'>
				 <a class="pull-left w-24 m-r"><img style='margin-top:3px;cursor:pointer;' src="https://i.ibb.co/zNL2yg0/ib-attach.png" class="w-full img-circle" alt="..."></a>
      </label>
				  <input id="pm_img_input"  name='pm_attachment' type="file" style='display:none;'/>
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" autocomplete='off' maxlength='400' id='pm_input_text' name='pm_text' placeholder="Say something">
		  <input type="hidden" class="form-control" value='' id='receiver_id' name='receiver_user_id'>
          <span class="input-group-btn">
            <button class="btn primary b-a no-shadow" id='send_pm_btn' type="submit">SEND</button>
          </span>
        </div>
		
		
		


		
		
      </form>
	  
    </div>
  </div>



<script>

$('#personal-chat-form').submit(function(){ return false; });
$('.pm_attch_close').click(function(){
	 $('#UploadmodelWindowpm').modal('hide');
});

$('.emoi_picker_open_btn_pm').click(function(){
	$('.emoji_picker_plate_pm').slideToggle(300);
	

});

//emoji plate
   function addTextTaginpm(text){
    document.getElementById('pm_input_text').value += text;
   document.getElementById("pm_input_text").focus();
   }        
   
   $('body').delegate('#close_emoji_picker_btn_pm','click',function()
      {
	  $('.emoji_picker_plate_pm').hide(300); 


	 
	 });


    function readURLpm(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
				if(($("#pm_img_input")[0].files[0].type)=='audio/mp3'){
				$('#upload_image_preview_pm').attr('src', '../../assets/images/mp3.png');	
				}
				else if(($("#pm_img_input")[0].files[0].type)=='video/mp4')
				{
					$('#upload_image_preview_pm').attr('src', ' ../../assets/images/mp4.png');
					
				}
				else{
                $('#upload_image_preview_pm').attr('src', e.target.result);
				}
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	
	
	
	
	$('#UploadmodelWindowpm').on('hidden.bs.modal', function () {
    $('#pm_img_input').val(null);
			  $('#image-upload-foot-note-pm').val('');
});

$('#pm_img_input').change(function(){
	  
	   $('#UploadmodelWindowpm').modal('show');
        readURLpm(this);
		 $('#upload_image_confirm_btn_pm').text('Upload');
			  $('#upload_image_confirm_btn_pm').attr("disabled",false);
		      $('#cancel_img_upload_btn_pm').show();
			  $('#image_upload_error_pm').hide();
			  $('#image_upload_no_error_pm').show();
			  
			  
			   if($("#pm_img_input")[0].files[0].size>4194280 ||
			   (
			   ($("#pm_img_input")[0].files[0].type)!='image/png' &&
			   ($("#pm_img_input")[0].files[0].type)!='image/jpg' &&
			   ($("#pm_img_input")[0].files[0].type)!='image/jpeg' &&
			   ($("#pm_img_input")[0].files[0].type)!='image/gif' &&
			   ($("#pm_img_input")[0].files[0].type)!='audio/mp3' &&
			   ($("#pm_img_input")[0].files[0].type)!='video/mp4'
			   ))
			   
			   {
		         $('#upload_image_confirm_btn_pm').attr('disabled',true);
				 $('#image_upload_no_error_pm').hide();
		   	     $('#image_upload_error_pm').show();
		       }
    });
	
	
	
	
$('#upload_image_confirm_btn_pm').click(function(){
	$(this).text('Uploading...(');
	$(this).attr("disabled",true);
	$(this).attr("cursor","default");
	$('#cancel_img_upload_btn_pm').hide();
	var data = new FormData();
    data.append('pm_attachment', $('#pm_img_input').prop('files')[0]);
	data.append('image_text', $('#image-upload-foot-note-pm').val());
    data.append('receiver_user_id',$('#receiver_id').val());  
    $.ajax({
  xhr: function() {
    var xhr = new window.XMLHttpRequest();

    xhr.upload.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        percentComplete = parseInt(percentComplete * 100);
        $('#upload_image_confirm_btn_pm').text('Uploading...('+percentComplete+'%)');

        if (percentComplete === 100) {
			
			var ws_data=JSON.stringify({"data":$('#receiver_id').val(),"action":"update_pm"});
         	conn.send(ws_data);
count_new_pm_and_noti();
check_pm();	
count_new_pm_and_noti();

        }

      }
    }, false);

    return xhr;
  },
        type: 'POST',               
        processData: false, 
        contentType: false,
        data: data,
        url: 'include/send-pm.php',
        dataType : 'json',  
       
        success: function(output){
			
          if(output==1){
			   $('#UploadmodelWindowpm').modal('hide');
			  $('#pm_img_input').val(null);
			  $('#image-upload-foot-note-pm').val('');
 $('#upload_image_confirm_btn_pm').text('Done');		
		$(this).attr("cursor","pointer");
			 
	
	
		  }else{} 
		
		}
       
    }); 
	
	
});
</script>