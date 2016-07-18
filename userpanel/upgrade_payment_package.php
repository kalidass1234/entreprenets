<?php
include('../includes/all_func.php');
//error_reporting(0);
//session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_id=showuserid($_SESSION['SD_User_Name']);		
	$res_user=mysql_fetch_array(mysql_query("select * from registration where user_id='$user_id'"));
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title><?php echo $TITLE_USER;?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<!-- The plugin stylehseet -->
<link rel="stylesheet" href="vtncard/jquery.bubbleSlideshow/jquery.bubbleSlideshow.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/custom-scripts.js"></script>
</head>
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
		<h3>Upgrade Payment Package</h3>
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
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Upgrade Payment Package</h6>
					</div>
     <?php
    //echo "select * from registration where user_id='".USERID."' and bonus=1";
	//echo "select * from registration where user_id='".USERID."' and bonus=1";
	$result=mysql_query("select * from registration where user_id='".USERID."' and bonus=1");
	$count=mysql_num_rows($result);
	?>
<style>
.form_container ul li 
{
	background: url(../images/dot.png) repeat-x bottom;
	position: relative;
	padding: 5px 15px 15px 10px;
}
.show_vision_level
{
	font-weight: bold;
	color: #ffffff;
	padding: 10px;border-right: 1px solid #eee;
	border-bottom: 1px solid #eee;
	border-top: 1px solid #eee;
	background: #555;
}
.link-select
{
	background-color: #666;
	color: #FFF;
	display: inline-block;
	margin: 0;
	background-position: top left;
	background-repeat: repeat-x;
	cursor: pointer;
	border-radius: 4px;
	-moz-border-radius: 4px;
	padding: 5px 10px;
	text-decoration: none;
	text-shadow: 1px 1px 3px #000;
	border: none;
	font-family: Arial, Helvetica, sans-serif;
}
</style>           
<div class="widget_content" style="background-color:#FFFFFF">
<form action="upgrade_one.php" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
<ul>
    <li>
    <?php
    if($count)
    {
        $row=mysql_fetch_assoc($result);
        $Date=$row['bonus_date'];
        $expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));
		$package_id=$row['category_one'];
		$sql_p="select * from member_package where id='$package_id'";
		$res_p=mysql_query($sql_p);
		$row_p=mysql_fetch_assoc($res_p);
		$product_id=$row_p['product_id'];
		$sql=mysql_query("SELECT * FROM product_category where p_cat_id in ($product_id)");
	
    ?>
        <h3 style="color: #800080;">Account Upgraded . Will Expire on <?php echo $expire_date;?> </h3>
        <h6>  Digital Download Of The Starter Promo Kit: <a href="<?php echo $row_p['dowload_link'];?>">Click Here To Download</a></h6>
        <?php
			while($res=mysql_fetch_array($sql))
			{
											  if($res['product_pdf']!='')
											  {
											  ?>
											  <a href="<?php echo "secure_download.php?type=pdf&pid=".$res['p_cat_id']."&invoice=".$invoice; ?>" target="_blank"><img src="../images/PDF.png" width="90" height="90" /></a>
											  <?php
											  }
											  else
											  {
											  ?>
											  <img src="../images/PDF.png" width="90" height="90" />
											  <?php
											  }
											  ?>
												
                                                <br>
                                                <?php
                  if($res['product_video']!='')
				  {
				  ?>
                  <a href="<?php echo "../product_logos/product_video/".$res['product_video']; ?>"><img src="../images/File-Video-icon.png" width="90" height="90" /></a>
                  <?php
                  }
				  else
				  {
				  ?>
                  <img src="../images/File-Video-icon.png" width="90" height="90" />
                  <?php
				  }
				  ?>
                                     
                  <br>
                  <?php
                  if($res['product_exe']!='')
				  {
				  ?>
                  <a href="<?php echo "../product_logos/product_exe/".$res['product_exe']; ?>">Click Here To Download Software</a>
                  <?php
                  }
				  ?>
                  <br>
                  <?php
                  if($res['product_zip']!='')
				  {
				  ?>
                  <a href="<?php echo "../product_logos/product_zip/".$res['product_zip']; ?>">Click Here To Download Zip</a>
                  <?php
                  }
				  ?>
                  <br>
                  <?php
                  if($res['download_link']!='')
				  {
				  ?>
                  <a href="<?php echo $res['download_link']; ?>">Click Here To Download Product</a>
                  <?php
                  }
				  }
				  ?>           
        <div class="entry-content">	
        	<?php echo $row_p['description'];?>
        </div>
    <?php
    }
    else
    {
	// check that request sent or not 
		$result_request=mysql_query("select * from registration where user_id='".USERID."' and bonus_request=1");
		$count_request=mysql_num_rows($result_request);
		if($count_request)
		{
    ?>   
        <h3 style="color: #800080;">Your Upgrade Request Sent To Admin. Please Wait For Approval.</h3>
        <?php
        }
		else
		{
		?>
        <h3 style="color: #800080;"><a href="upgrade_account1.php?userupgrade=true&Session_id=<?php echo $_SESSION['Session_Rand_No'];?>">Click Here If You Want to Upgrade Account.</a></h3>
        <?php
		}
		?>
        <div class="entry-content"></div>
        
    <?php
    }
    ?>
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