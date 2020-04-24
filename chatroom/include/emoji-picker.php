<div class="card bg-light emoji_picker_plate" style="display:none;border:#ccc;box-shadow:0px 0px 2px 1px #c4c4c4;margin-top:-275px;margin-left:30px;max-width: 19rem;">
 <div class="card-header ">Emoji Plate
 <span style='float:right;cursor:pointer;' id='close_emoji_picker_btn'><i class='fa fa-times text-muted'></i></span>
 </div>
  <div class="card-body " style='padding:5px;height:190px;overflow-y:auto;overflow-x:hidden;'>
    
    
	 <div class="container">
  <div class="row" style=''>
	
	<?php
	$file='include/emoji/emoji_1.txt';
	$file_2='include/emoji/emoji_2.txt';
$emoji_code = file($file, FILE_IGNORE_NEW_LINES);
$emoji_img = file($file_2, FILE_IGNORE_NEW_LINES);
$i=0;
while($i<sizeof($emoji_code)){
echo"
<div class='col text-center p-1 btn'  onClick='addTextTag(`$emoji_code[$i]`); return false' style='cursor:pointer;'>
      <img src='include/emoji/face/$emoji_img[$i]' style='height:padding:0;20px;width:20px;'></img>
    </div>";	
	$i=$i+1;
}


?>
    
  </div>
  
</div>
 </div>
	
  </div>

