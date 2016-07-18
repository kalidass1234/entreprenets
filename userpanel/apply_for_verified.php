<?php
include('../includes/all_func.php');
//error_reporting(0);

if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
if(isset($_GET['msg']))
$msg=$_REQUEST['msg'];
else
$msg='';
	$idd=$_SESSION['SD_User_Name'];
$s="select user_id,plan_name,user_type,nom_id from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$sql="select * from apply_for_verify where user_id='$id'";
$res=mysql_query($sql);
$row=mysql_fetch_assoc($res);
$count=mysql_num_rows($res);


//end summary
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
<title>Welcome to shopdeal share</title>
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
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
</head>
<style>
.binary_line1{background: url(images/topline.gif) no-repeat center top;border-top: solid #000 2px;}
</style>
<script language="javascript">
function search_node(val)
{
	if(val=='jdate')
	{
		document.getElementById('search-td2').style.display='table-row';
		document.getElementById('search-td1').style.display='none';
	}
	else if(val=='unm')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate Login Name';
		document.getElementById('uid').name='unm';
	}
	else if(val=='uid')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate User ID';
		document.getElementById('uid').name='uid';
	}
}
$(document).ready(function(){
$('#bl').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'PDF':
		case 'JPG':
        case 'JPEG':
        case 'PNG':
        case 'GIF':
		case 'pdf':
		case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
               break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
			//alert(this.value);
    }
		});
		
		$('#st').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'PDF':
		case 'JPG':
        case 'JPEG':
        case 'PNG':
        case 'GIF':
		case 'pdf':
		case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
               break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
		});
		
	$('#ft').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'PDF':
		case 'JPG':
        case 'JPEG':
        case 'PNG':
        case 'GIF':
		case 'pdf':
		case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
               break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
		});	
});		
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
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Apply For Verified Affiliate </h3>
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
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Apply For Verified Affiliate </h6>
						
					</div>
					<div class="widget_content">
						<div id="tab1">
							<div class="oilhold">
   							<form action="applyforverify.php" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
							<?php
							if($count>0)
							{
								if($row['status']==1)
								{
									?>
									
									<li>
									<div class="form_grid_12">
										<label class="field_title">&nbsp;</label>
										<div class="form_input">
										<font color="#006633">You Request For Verified Seller on <?php echo $row['apply_date'];?> Accept By Admin.</font>										</div>
									</div>
									</li>
									
									<?php
								}
								else if($row['status']==2)
								{
									?>
									
									<li>
									<div class="form_grid_12">
										<label class="field_title">&nbsp;</label>
										<div class="form_input">
										<font color="#FF0000">You Request For Verified Seller on <?php echo $row['apply_date'];?> Denied By Admin.</font>										</div>
									</div>
									</li>
									
									<?php
								}
								else
								{
									?>
									<li>
									<div class="form_grid_12">
										<label class="field_title">&nbsp;</label>
										<div class="form_input">
										<font color="#FF0000">Your Request Sent To Admin For Approval.</font>
										</div>
									</div>
									</li>
									<?php
								}
							}
							else
							{
							
							?>
								
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title">Term and condition </label>
									<div class="form_input">
										<input type="checkbox" name="tc" required>
										<span id="user"></span>
									</div>
								</div>
								</li>-->
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Id Verification(in png,jpg,jpeg and pdf) </label>
									<div class="form_input">
										<input type="file" name="bl" id="bl" required>
										<span id="user"></span>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address Verification(in png,jpg,jpeg and pdf) </label>
									<div class="form_input">
										<input type="file" name="st" id="st" required>
										<span id="user"></span>
									</div>
								</div>
								</li>
								
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title">Federal Tax ID document (in png,jpg,jpeg and pdf)</label>
									<div class="form_input">
										<input type="file" name="ft" id="ft" required>
										<span id="user"></span>
									</div>
								</div>
								</li>-->
							
								<li>
								<div class="form_grid_12">
									<label class="field_title">Transaction Password</label>
									<div class="form_input">
										<input name="password" type="password" required="required" tabindex="1" class="" style="width:44%;" />
										<span id="user"></span>
									</div>
								</div>
								</li>
							
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
										<button type="submit" class="btn_small btn_gray"><span>Upgrade Now</span></button>
									</div>
								</div>
								</li>
							<?php
							}
							?>	
							</ul>
						</form>
					  <!--<img src="images/support-ticket.jpg" border="0" />
					<br />
					 <div align="center" style="padding-top:20px;">
					  <input name="raise_ticket" class="btn" type="button"  value="Raise Ticket" onClick="window.location.href='raise-ticket.php'"/>
					  </div>-->
					</div>
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