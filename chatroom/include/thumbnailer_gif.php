<?php
$imagick = new Imagick($path);

$format = $imagick->getImageFormat();
if ($format == 'GIF'|| $format == 'gif') {
  $imagick = $imagick->coalesceImages();
  do {
     $imagick->resizeImage(150, null, Imagick::FILTER_BOX, 1);
  } while ($imagick->nextImage());
  $imagick = $imagick->deconstructImages();
  $imagick->writeImages($thumbnail_file_path_name, true);

}

$imagick->clear();
$imagick->destroy();
?>