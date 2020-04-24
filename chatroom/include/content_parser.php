<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username'])){die();}

$str = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(?:jpe?g|png|gif|mp3|mp4)#', function($arr)
{
    if(strpos($arr[0], 'http') !== 0)
    {
        $arr[0] = '' . $arr[0];
    }
    $url = parse_url($arr[0]);
if(isset($url['path'])){
    //video
	if(preg_match('#\.(mp4)$#', $url['path']))
    {$arr[0]=strstr($arr[0], '/upload/');
        return '
		<video class=img-thumbnail style=max-width:250px;max-height:250px; controls preload="metadata">
  <source src=".'.$arr[0].'" type="video/mp4">
</video><br>';
    }
	
	 //Audio
	if(preg_match('#\.(mp3)$#', $url['path']))
    {
		$arr[0]=strstr($arr[0], '/upload/');
        return '
		<audio style=max-width:100%;min-width:250px; controls preload="metadata">
  <source src=".'.$arr[0].'" type="audio/mpeg">
</audio><br>';
    }
	
    // images
    if(preg_match('#\.(png|jpg|jpeg|gif)$#', $url['path']))
    {$arr[0]=strstr($arr[0], '/upload/');
        return '<img style="max-width:120px;max-height:120px;cursor:pointer;" class="img-thumbnail room_chat_thumbs" data-toggle="modal" data-target="#original_image_display_modal"     src=".'.$arr[0].'" /><br>';
    }
    // youtube
    if(in_array($url['host'], array('www.youtube.com','m.youtube.com' ,'youtube.com'))
      && $url['path'] == '/watch'
      && isset($url['query']))
    {
        parse_str($url['query'], $query);
        return sprintf('<iframe style=max-width:250px;max-height:250px; class="embedded-video" src="https://www.youtube.com/embed/%s" allowfullscreen></iframe><br>', $query['v']);
}}else
    //links
    return sprintf('<a class=primary href="%1$s"><i class="fa fa-link" aria-hidden=true style=margin-top:5px></i> %1$s</a>', $arr[0]);
}, $str);


//this block detects emoji codes and replace them with emojis
$need_to_replace = file($file, FILE_IGNORE_NEW_LINES);
$to_be_replaced_with = file($file_2, FILE_IGNORE_NEW_LINES);


// transform the strings into regular expressions
$expressions_need_to_replace = array_map(
    function($placeholder) {
        return '/' . $placeholder . '/';
    },
    $need_to_replace
);



$new_str = preg_replace_callback(
    $expressions_need_to_replace,
    function($match) use ($need_to_replace, $to_be_replaced_with) {
        // first find out where in  $need_to_replace  the found match is
        $index = array_search($match[0], $need_to_replace);

        // get the image from the same location in  $to_be_replaced_with
        $image = $to_be_replaced_with[$index];

        // build the image string
        return "<img style='height:20px;width:20px;' src='include/emoji/face/". $image ."'/>";
    },
    $str
);

$str=$new_str;



?>