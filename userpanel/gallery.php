<?php
include('../includes/all_func.php');
include('header.php');
?>
<script language="javascript">
function setprofileimage(checkval)
{
	if(document.getElementById('checkbox'+checkval).checked==true)
	{
		document.getElementById('checkbox'+checkval).checked=true;
		var splitarr = $('#idstr').val().split(',');
		var i;
		for(i=0;i<splitarr.length;i++)
		{
			if(splitarr[i]==checkval)
			{
				$("#span"+checkval).addClass('checked');
			}
			else
			{
				$("#span"+splitarr[i]).removeClass('checked');
			}
		}
		applyprofileimage(checkval,'yes');
	}
	else
	{
		document.getElementById('checkbox'+checkval).checked=false;
		$("#span"+checkval).removeClass('checked');
		applyprofileimage(checkval,'no');
	}
}
function applyprofileimage(checkval,cond)
{
var urldata="checkval="+checkval+"&status="+cond;
	  $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_publicimage.php",
                data: urldata,
                success: function(html) {
                    //$('#userprofileimage').html(html);
                }
            });
}
</script>
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
		<span class="title_icon"><span class="image_1"></span></span>
		<h3>Gallery</h3>
		<!--<div class="top_search">
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
			
			<div class="grid_12 full_block" style="height:auto;">
				<div class="widget_wrap" style="height:auto;">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Photo Gallery </h6><h6><a href="addgallary.php">Add Images</a></h6>
					</div>
					<div class="widget_content">
						
						<div class="gall_wrap" style="height:auto;">
							
					
							
							<ul class="portfolio group">
							<?php
							$sql="select * from userimages where user_name='$_SESSION[SD_User_Name]'";
							$res=mysql_query($sql);
							while($row=mysql_fetch_assoc($res))
							{
							?>
								<li class="item" data-id="id-1" data-type="hannah">
								<a href="userimages/<?php echo $row['user_image'];?>" rel="gallery"><img src="userimages/<?php echo $row['user_image'];?>" width="210" height="130" alt="<?php echo $_SESSION['SD_User_Name'];?>"/></a>
								</li>
							<?php }?>
								
							</ul>
						</div>
                     
					</div>
					
			  </div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>