<?php
include('../includes/all_func.php');
error_reporting(0);
//session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$uid=showuserid($_SESSION['SD_User_Name']);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
if($_GET['sent'])
{
$table_name="message_sender";
//echo "update `message` set `read_sender`='0' where id='$_GET[id]' and sender_id = '$uid'";
mysql_query("update `message_sender` set `read_sender`='0' where id='$_GET[id]' and sender_id = '$uid'");
}
else if($_GET['inbox'])
{
$table_name="message";
mysql_query("update `message` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
else if($_GET['type']=='receiver')
{
$table_name="message";
mysql_query("update `message` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
else if($_GET['type']=='sender')
{
$table_name="message_sender";
mysql_query("update `message_sender` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
else if($_GET['type']=='draft')
{
$table_name="message_draft";
mysql_query("update `message_draft` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
//include('includes/notificationcount.php');
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
		<span class="title_icon"><span style="float:left;"><img src="backend-images/messaging.png" height="20" width="20" alt="" border="0" /></span></span>
		<h3>Message</h3>
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
					
					<div class="widget_content">
					<div>
						
					</div>
					<?php
					$id=$_GET['id'];
						$sql_sel=mysql_query("SELECT * FROM $table_name WHERE id=$id");
						$res_sel=mysql_fetch_array($sql_sel);
					?>
						<div class="oilhold">
   							<form action="delete_message_func1.php" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<?= $res_sel[reciever_name]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Subject</label>
									<div class="form_input">
										<?= $res_sel[subject] ?>
									</div>
								</div>
								</li>
							
								<li>
								<div class="form_grid_12">
									<label class="field_title">Message </label>
									<div class="form_input">
										<?= $res_sel[message] ?>
									</div>
								</div>
								</li>
								<?php if($res_sel['file_name']){?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Attach File </label>
									<div class="form_input">
										<a href="attachfile/<?= $res_sel[file_name] ?>" target="_blank">Attach File</a>
									</div>
								</div>
								</li>
								<?php
								}
								?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Message Time </label>
									<div class="form_input">
										<?php
								 $curdate=date('Y-m-d');
								 $sentdate=date('Y-m-d', strtotime($res_sel['msg_date']));
								 $curtime=strtotime($curdate);
								 $senttime=strtotime($sentdate);
								 if($senttime==$curtime){ echo date('H:i:s', strtotime($res_sel['ts']));}
								 else {  echo date('d M, Y',strtotime($res_sel['ts']));}
								 
								//echo date('d M, Y',strtotime($x1['ts']));?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
									<input type="hidden" id="table_name" name="table_name" value="<? echo $table_name;?>" />
										<?php
										if($_REQUEST['inbox']=='inbox')
										{
										?>
										<a href="compose.php?reply=reply&id=<?=$res_sel['id']?>"><button type="button" class="btn_small btn_gray"><span>Reply</span></button></a>
										<a href="compose.php?forword=forword&id=<?=$res_sel['id']?>"><button type="button" class="btn_small btn_gray"><span>Forward</span></button></a>
										<?php
										}
										?>
										<a href="javascript:message_print('<?=$res_sel['id']?>','<?php echo $_REQUEST['inbox']?>');"><button type="button" class="btn_small btn_gray"><span>Print</span></button></a>
										<button type="submit" class="btn_small btn_gray"><span>Delete</span></button>
										<a href="javascript:window.history.back();"><button type="button" class="btn_small btn_gray"><span>Back</span></button></a>
									</div>
								</div>
								</li>
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
		<span class="clear"></span>
	</div>
</div>
</body>
</html>
<script language="javascript">
function message_print(id,target)
{
	window.open("view-message_print.php?id="+id+"&target="+target,'popup','height=200,width=450');
}
</script>