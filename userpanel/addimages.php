<?php
include('header.php');
include('../includes/all_func.php');
error_reporting(0);
//session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$add_by=$_SESSION['SD_User_Name'];
	if(isset($_POST) && $_POST['edit']=='edit')
	{
	//print_r($_POST);exit;
	//print_r($_FILES);
		if(isset($_FILES['image1']['name']))
		{
		$id=$_POST['id'];
			$image2=$add_by."_".time().'_'.substr(str_replace(" ", "_", $_FILES['image1']['name']),0,3).'.jpg';
				//echo "insert into images (p_id, prop_image) values ('$id', '$image2')";exit;
				mysql_query("insert into images (p_id, p_image) values ('$id', '$image2')");
				move_uploaded_file($_FILES['image1']['tmp_name'],"../product_logos/".$image2);
				// start image croppping
/*$info = pathinfo("../product_logos/".$image2);
$img = imagecreatefromjpeg( "../product_logos/".$image2 );
$width = imagesx( $img );
$height = imagesy( $img );
$new_width = 100; 
$new_height = 100;
list($width,$hieght)=getimagesize("../product_logos/".$image2 );
	if($width>490)
	{
	$new_width=490;
	}
	else
	{
	$new_width=$width;
	}
	if($hieght>250)
	{
	$new_height=250;
	}
	else
	{
	$new_height=$hieght;
	}
$tmp_img = imagecreatetruecolor( $new_width, $new_height );
imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height,     $width, $height );
imagejpeg( $tmp_img, "../product_logos/".$image2 );*/
// end image cropping
		}

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
		<h3>Add Images</h3>
		<div class="top_search">
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
		</div>
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
						<h3>Add Images</h3>
						
						<form action="" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							
							<ul>
								<?php
								$id=$_GET['pid'];
				$sltimage=mysql_query("select * from images where p_id='$id' and status=0");
				$ct=1;
				while($fetchimg=mysql_fetch_array($sltimage))
				{
								?>
								<li>
								<div class="form_grid_12">
									<label class="field_title"><?php echo $ct;?></label>
									<div class="form_input">
										<img src="../product_logos/<?php echo $fetchimg['p_image'];?>" height="100" width="100">
									</div>
								</div>
								</li>
				<?php
				$ct++;
				}
				?>				
								<li>
								<div class="form_grid_12">
									<label class="field_title">Select Image</label>
									<div class="form_input">
										<input  name="image1"  type="file">
										<input  name="id" value="<?php echo $_GET['pid'];?>" type="hidden">
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