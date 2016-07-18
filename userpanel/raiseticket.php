<?php
include('../includes/all_func.php');
error_reporting(0);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$id=showuserid($_SESSION['SD_User_Name']);
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
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Support</h3>
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
						<h6>raise ticket </h6>
						<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Raise Ticket</a></li>
								
								<li><a href="#tab2">View Ticket Response</a></li>
								
							</ul>
						</div>
					</div>
					<div class="widget_content">
					<div>
						
					</div>
						<div id="tab1">
							<div class="rightmain">
				<div id="announcer" >
  <!--<div class="subheading"><a href="index.html">Home</a> >> Support</div>-->
  
  <div class="oilhold">
    <form action="raiseticket_func.php" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Category </label>
									<div class="form_input">
										<select data-placeholder="Category" style=" width:300px" class="chzn-select" tabindex="13" name="category">
											
											<optgroup label="Select Category">
											<option>Financial</option>
											<option>Technical</option>
											<option>General </option>
											<option>Product </option>
											</optgroup>
											
										</select>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Subject</label>
									<div class="form_input">
										<input name="filed01" type="text" tabindex="1" class="limiter" style="width:44%;" />
										
									</div>
								</div>
								</li>
							
								<li>
								<div class="form_grid_12">
									<label class="field_title">Message </label>
									<div class="form_input">
										<textarea name="filed06" class="input_grow" cols="50" rows="5" tabindex="5" ></textarea>
									</div>
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_gray"><span>Submit</span></button>
										<a href="support.php"><button type="button" class="btn_small btn_gray"><span>Back</span></button></a>
										
									</div>
								</div>
								</li>
							</ul>
						</form>

</div>

  
  </div>
			<div class="clr"></div>
		</div>	
						</div>
						<div id="tab2">
							
							<div class="widget_content">
						<h3>Response</h3>
						
						<table class="display ">
						<thead>
						<tr>
							<th>
								  Name
							</th>
							<th>
								  Ticket No
							</th>
							<th>
								 Subject
							</th>
							<th>
								 Category
							</th>
							
							<th>
								 Request Date
							</th>
							<th>
								 Status
							</th>
							<th>
								 Response Date
							</th>
							<th>View</th>
						</tr>
						</thead>
						<tbody>
						<?php
						  $str_pin="select * from tickets where user_id='$id' ORDER BY id DESC";
						  $res_pin=mysql_query($str_pin);
							$sr=1;			  
						  while($x=mysql_fetch_array($res_pin))
						  {
						   $idx=$id;
						  $str="select * from registration where user_id='$idx'";
							$res=mysql_query($str);
							$xy=mysql_fetch_array($res);
							$name=$xy['first_name']." ".$xy['mid_name']." ".$xy['last_name'];
			 			 ?>
							<tr>
                                  <td align="center" class="ptext"><?=$name?></td>
								  <td align="center" class="ptext"><?=$x['id']?></td>
                                  <td align="center" class="ptext"><?=substr($x['subject'],0,35)?><br><?=substr($x['subject'],36,35)?><br><?=substr($x['subject'],73,35)?></td>
                                  <td align="center" class="ptext"><?=$x['tasktype']?></td>
                                  
                                  <td align="center" class="ptext"><?=$x['t_date']?></td>
								  <td align="center" class="ptext"><?php if($x['status']==0){ echo "Pending";} else if($x['status']==1){ echo "Responsed";}?></td>
                                  <td align="center" class="ptext"><?=$x['c_t_date']?></td>
								  <td align="center" class="ptext"><a href="ticket.php?id=<?=$x['id'] ?>">Detail</a></td>
                                </tr>
                                <?
								}
								?>
						
						</tbody>
						<tfoot>
						
						</tfoot>
						</table>
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