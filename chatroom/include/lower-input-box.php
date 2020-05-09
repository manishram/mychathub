<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

?>
<div id="msg-input-div" class='box-header ' style='z-index:0;background-color:#919696;width:100%;height:50px;padding:5px;;box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.15), 0 -1px 0px rgba(0, 0, 0, 0.02);'><div class='row'>
						<div class="input-group " style='margin:0px 20px 0px 15px' >        
		<br><form class="conversation-compose" id='' >
                <div class="emoji">
                  <i class="fa fa-globe-asia" style='color:#ccc;font-size:15px;'></i> 
                </div>
                <input class="input-msg" id='room-search-input-box' style='height:38px;' maxlength='200'  name='room_search_input' placeholder="Search room.." autocomplete="off" >
                <div class="photo">
                  
                <button id='search-room-btn' type='submit' class="send">
                    <div class="circle" style='height:35px;width:35px;background:none;'>
                <i class="fa fa-search" style='color:#0cc2aa;font-size:20px;'></i>     
                    </div>
                  </button>
				</div>
                
              </form>
		</div></div>

</div>
<script>
$('#room-search-input-box').keyup(function(){
	$('#room-search-loading').eq(0).show();
	$.get('include/search-room.php',{room_search_input: $('#room-search-input-box').val()},function(output){
		$('#list-of-rooms').empty();$('#room-search-loading').eq(0).hide();$('#list-of-rooms').append(output);
	});
});

$('#search-room-btn').click(
function(){
	event.preventDefault()
	$('#room-search-loading').eq(0).show();
	$.get('include/search-room.php',{room_search_input: $('#room-search-input-box').val()},function(output){
		$('#list-of-rooms').empty();$('#room-search-loading').eq(0).hide();$('#list-of-rooms').append(output);
	});
}
);
</script>