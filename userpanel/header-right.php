<?php
error_reporting(E_ALL ^ E_NOTICE);

?>
	
		<div class="header_right">

			<div id="user_nav" style="width:270px;">
				<ul>
				<?php 
							$msenderid=showuserid($_SESSION['adid']);
							$sqlmsimage="select image,user_name from registration where user_id='$msenderid'";
							$resmsimage=mysql_query($sqlmsimage);
							$rowmsimage=mysql_fetch_assoc($resmsimage);
				?>
					<li class="user_thumb"><a href="user_profile.php"><span class="icon"><img src="<?php if($rowmsimage['image']){ echo "userimages/$rowmsimage[image]";} else { echo "images/user_thumb.png";}?>" width="30px" height="30px" alt="User"></span></a></li>
					<li class="user_info" style="width:158px;"><span class="user_name"><?php echo $rowmsimage['user_name'];?></span><span><a href="user_profile.php">Profile</a> &#124; <a href="http://support.trinitywealthvision.com/" target="_blank"></a> <!--&#124; <a href="#">Help&#63;</a>--></span></li>
					<li class="logout"><a href="../logout.php"><span class="icon"></span>Logout</a></li>
				</ul>
			</div>
		</div>