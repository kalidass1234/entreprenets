<?php
session_start();
$session_id=$_SESSION['adid']; //$session id
$path = "userimages/";
include('../includes/all_func.php');
$id=showuserid($_SESSION['adid']);
//print_r($_FILES);exit;
	$valid_formats = array("jpg", "png", "gif", "bmp","JPG", "PNG", "GIF", "BMP","jpeg","JPEG");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['image']['name'];
			$size = $_FILES['image']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*1024))
						{
							$actual_image_name = $_SESSION['adid'].'_'.time().'_'.substr(str_replace(" ", "_", $txt),0,3).".".$ext;
							$tmp = $_FILES['image']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
								mysql_query("UPDATE registration SET image='$actual_image_name' WHERE user_name='$session_id'");
								mysql_query("INSERT INTO `userimages` (`user_name`, `user_image`,`user_id`) VALUES ('$session_id', '$actual_image_name','$id');");	
									echo "<img src='userimages/".$actual_image_name."'  class='img-polaroid' width='140' hieght='140'>";
// start image croppping
/*$info = pathinfo("userimages/".$actual_image_name);
$img = imagecreatefromjpeg( "userimages/".$actual_image_name );
$width = imagesx( $img );
$height = imagesy( $img );
$new_width = 100; 
$new_height = 100;
list($width,$hieght)=getimagesize("userimages/".$actual_image_name );
	if($width>100)
	{
	$new_width=100;
	}
	else
	{
	$new_width=$width;
	}
	if($hieght>100)
	{
	$new_height=100;
	}
	else
	{
	$new_height=$hieght;
	}
$tmp_img = imagecreatetruecolor( $new_width, $new_height );
imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,     $width, $height );
imagejpeg( $tmp_img, "userimages/thumb/".$actual_image_name );*/
// end image cropping
								}
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
?>