<?php

include('../includes/all_func.php');
//error_reporting(E_ALL ^ E_NOTICE);
//session_start();
include('header.php');
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	$s="select user_id from registration where user_name='$idd'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$id=$f['user_id'];
	if(isset($_POST) && $_POST['edit']=='edit')
	{
	//print_r($_POST);exit;
	//print_r($_FILES);
		if(isset($_FILES['image1']['name']))
		{
			//$id=$_POST['id'];
				$image2=$idd.'_'.time().'_'.substr(str_replace(" ", "_", $_FILES['image1']['name']),0,3).'.jpg';
				//echo "insert into images (user_id,user_name, user_image) values ('$id','$idd', '$image2')";exit;
				mysql_query("insert into userimages (user_id,user_name, user_image) values ('$id','$idd', '$image2')");
				move_uploaded_file($_FILES['image1']['tmp_name'],"userimages/".$image2);
// start image croppping
/*$info = pathinfo("userimages/".$image2);
$img = imagecreatefromjpeg( "userimages/".$image2 );
$width = imagesx( $img );
$height = imagesy( $img );
$new_width = 100; 
$new_height = 100;
list($width,$hieght)=getimagesize("userimages/".$image2 );
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
imagejpeg( $tmp_img, "userimages/thumb/".$image2 );*/
// end image cropping

		}
		echo "<script language='javascript'>alert('Image Uploaded Successfully.');window.location.href='gallery.php';</script>";exit;
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>

<body id="theme-default" class="full_block">
<?php
include('left-bar.php');
?>
<div id="container">
	<div id="header" class="blue_lin">
		<div class="header_left">
			<?php
			include('header-left.php');
			?>
			<?php
			include('menu-mobile.php');
			?>
		</div>
		<?php
		include('header-right.php');
		?>
	</div>
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Gallary</h3>
	<!--	<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>-->
	</div>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Add Images</h6>
					</div>
					<div class="widget_content">
						
						
						<form action="" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							
							<ul>
												
								<li>
								<div class="form_grid_12">
									<label class="field_title">Select Image</label>
									<div class="form_input">
										<input  name="image1"  type="file">
										<input  name="id" value="<?php echo $id;?>" type="hidden">
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="hidden" name="edit" value="edit">
										<button type="submit" class="btn_small btn_blue"><span>Submit</span></button>
										
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>