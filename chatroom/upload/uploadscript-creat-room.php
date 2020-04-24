<form method='post' enctype="multipart/form-data"><div class="form-group" >
		<table style='width:100%;'>
		<tr>
		<td style='max-width:70%;'>
		<label for="room_icon"><small>Choose icon for room:</small></label>
              <input type="file" id="room_icon" name='room_icon' class="form-control">
            <small class='text-muted' style='font-size:10px;'>* Max-size:100kb | <font id='file_type_err' class=''>Only jpeg/png.</font></small>
		
		</td>
		<td style='width:30%;'>
		<button class="btn btn-fw " type='submit' id='icon_upload_btn' style='padding:12px 0px 10px 0px;margin-top:9px;display:none;' disabled=''><i class='fa fa-upload'></i></button>
		
		</td>
		</tr>
		</table>
		</form>
<script>
$('#room_icon').change(function(){
	 if($('#room_icon').get(0).files.length != 0){$('#icon_upload_btn').show(100);}
	    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
		case 'PNG':
		case 'JPEG':
		case 'JPG':
            $('#icon_upload_btn').attr('disabled', false).addClass('primary');
			$('#file_type_err').removeClass('danger');
			$('#room_icon').removeClass('is-invalid');
            break;
        default:
            $('#icon_upload_btn').attr('disabled', true).removeClass('primary');
            this.value = '';
			$('#file_type_err').addClass('danger');
			$('#room_icon').removeClass('is-valid');
			$('#room_icon').addClass('is-invalid');
			
    } 
	 
 });
 
 $('#icon_upload_btn').click(function(){
	 ajax = new XMLHttpRequest();
ajax.onreadystatechange = function () {

    if (ajax.status) {

        if (ajax.status == 200 && (ajax.readyState == 4)){
            //To do tasks if any, when upload is completed
        }
    }
}
ajax.upload.addEventListener("progress", function (event) {

    var percent = (event.loaded / event.total) * 100;
    //**percent** variable can be used for modifying the length of your progress bar.
    console.log(percent);

});

ajax.open("POST", 'include/upload-image.php', true);
var room_con_value = $('#room_icon').val();
 ajax.send({room_icon: room_con_value});
//ajax.s
 });
 
</script>