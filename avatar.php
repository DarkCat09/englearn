<?php
	$img = null;
	if (array_key_exists('id', $_GET)) {
		if (file_exists('./avatars/'.$_GET['id'].'.png')) {
			$img = imageCreateFromPng('./avatars/'.$_GET['id'].'.png');
		}
		elseif (file_exists('./avatars/'.$_GET['id'].'.jpg')) {
			$img = imageCreateFromJpeg('./avatars/'.$_GET['id'].'.jpg');
		}
		elseif (file_exists('./avatars/'.$_GET['id'].'.jpeg')) {
			$img = imageCreateFromJpeg('./avatars/'.$_GET['id'].'.jpeg');
		}
		elseif (file_exists('./avatars/'.$_GET['id'].'.gif')) {
			$img = imageCreateFromGif('./avatars/'.$_GET['id'].'.gif');
		}
		else {
			$img = imageCreateFromPng('./avatars/0.png');
		}
	}
	else {
		$img = imageCreateFromPng('./avatars/0.png');
	}
	$imgscaled = imagescale($img, 100);
	header('Content-type: image/png');
	imagepng($imgscaled);
	imagedestroy($imgscaled);
?>
