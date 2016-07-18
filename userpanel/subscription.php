<?php
include('../includes/all_func.php');
include('includes/page_acess.php');
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
	//check_page_access($_SESSION['SD_User_Name'],'personal');// page permission for business and personal user.	
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
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
		<h3>My Subscription</h3>
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
						<h6>My Subscription</h6>
					</div>
					
						
					<table class="display data_tbl">
						<thead>
						<tr>
							<th width="7%">
								  Package</th>
                           <th width="9%">
								  Package Type </th>
                            <th width="9%">
								  Virtual Office </th>
<th width="10%">
								  Payment Type</th>
                     <th width="8%">
								 Order No</th> 
                                 <th width="6%">
								 Pin No</th>      
<th width="9%">
								 Time Period</th>
				     <th width="10%">
								 Start Date</th>
				     <th width="13%">
								 Subscription Expire Date</th>
                      <th width="13%">
								Account Expire Date</th>    
				     <th width="6%">
								 Status							</th>
							
						</tr>
						</thead>
						<tbody>
						<?php
						$str_subs2="select * from subscription  where user_id='{$id}' and type=2";
						$res_subs2=mysql_query($str_subs2);
						$count_subs2=mysql_num_rows($res_subs2);
						
						$str_pin="select * from subscription  where user_id='{$id}' and status=0";
						$res_pin=mysql_query($str_pin);
						$count_pin=mysql_num_rows($res_pin);
						if($count_pin)
						{
						$sr=1;
						$curdate=date('Y-m-d');
						$curtime=time();		  
						while($x=mysql_fetch_array($res_pin))
						{
							$date = $x['subs_date'];
							$duration = $x['duration'];
							
							if($x[type]==2 && $x['cat_duration'] && $x['subs_fee']=='29.99')
							{
							$date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
							}
							else
							{
							$date = strtotime(date("Y-m-d", strtotime($date)) . " +".$duration." month");
							}
							$enddate = date("m-d-Y",$date);
							$date1 = strtotime(date("Y-m-d", strtotime($f['reg_date'])) . " +1 year");
							$enddate1 = date("m-d-Y",$date1);
							
							if($x['cat_duration'] && $x['type']==2 && $x['subs_fee']=='29.99')
							{
								if($duration==1)
								{
									$realsubs_fee=29.99;
								}
								else if($duration==3)
								{
									$realsubs_fee=254.94;
								}
								else if($duration==6)
								{
									$realsubs_fee=509.88;
								}
								else if($duration==12)
								{
									$realsubs_fee=1019.76;
								}
							}
			 			?>
						<tr>
                                  <td align="center" class="ptext"><?php if($x['subs_fee']) echo "$".$x['subs_fee']; else echo "Free";?></td>
                                  <td align="center" class="ptext"> <?=strtoupper($x['type']);?></td>
                                  <td align="center" class="ptext"> <?php if($x['cat_duration'] && $x['type']==2 && $x['subs_fee']=='29.99' && $count_subs2==1){ echo "Frist Month Free";}?></td>
                                  <td align="center" class="ptext"> <?=strtoupper($x['payment_mode']);?></td>
                                  <td align="center" class="ptext"> <?=$x['order_no'];?></td>
                                  <td align="center" class="ptext"> <?=$x['pin_no'];?></td>
                                  <td align="center" class="ptext"> <?php if($x['cat_duration'] && $x['type']==2 && $x['subs_fee']=='29.99'){ echo "1";}else{ echo $duration;}?> Months</td>
                                  <td align="center" class="ptext"><?=date('m-d-Y',strtotime($x['subs_date']));?></td>
                                  <td align="center" class="ptext"><?=$enddate;?></td>
                         		<td align="center" class="ptext"><?=$enddate1;?></td>
								  <td align="center" class="ptext"><?php if($x['status']==1) echo "<span class='badge_style b_pending'>Inactive</span>"; else if($x['status']==0){ echo "<span class='badge_style b_done'>Active</span>"; } else{ echo "<span class='badge_style b_pending'>Cancel</span>";} ?></td>
								
                       </tr>
                        <?
						}
						}
						?>
                        <?php
                        $str_pin="select * from subscription  where user_id='{$id}' and status=1";
						$res_pin=mysql_query($str_pin);
						$count_pin=mysql_num_rows($res_pin);
						if($count_pin)
						{
						$sr=1;
						$curdate=date('Y-m-d');
						$curtime=time();		  
						while($x=mysql_fetch_array($res_pin))
						{
							$date = $x['subs_date'];
							$duration = $x['duration'];
							
							if($x[type]==2 && $x['cat_duration'] && $x['subs_fee']=='29.99')
							{
							$date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
							}
							else
							{
							$date = strtotime(date("Y-m-d", strtotime($date)) . " +".$duration." month");
							}
							$enddate = date("m-d-Y",$date);
							$date1 = strtotime(date("Y-m-d", strtotime($f['reg_date'])) . " +1 year");
							$enddate1 = date("m-d-Y",$date1);
							
							if($x['cat_duration'] && $x['type']==2 && $x['subs_fee']=='29.99')
							{
								if($duration==1)
								{
									$realsubs_fee=29.99;
								}
								else if($duration==3)
								{
									$realsubs_fee=254.94;
								}
								else if($duration==6)
								{
									$realsubs_fee=509.88;
								}
								else if($duration==12)
								{
									$realsubs_fee=1019.76;
								}
							}
			 			?>
						<tr>
                                  <td align="center" class="ptext"><?php if($x['subs_fee']) echo "$".$x['subs_fee']; else echo "Free";?></td>
                                  <td align="center" class="ptext"> <?=strtoupper($x['type']);?></td>
                                  <td align="center" class="ptext"> &nbsp;<?php if($x['cat_duration'] && $x['type']==2 && $x['subs_fee']=='29.99'){ echo "Frist Month Free";}?></td>
                                  <td align="center" class="ptext"> <?=strtoupper($x['payment_mode']);?></td>
                                  <td align="center" class="ptext"> <?=$x['order_no'];?></td>
                                  <td align="center" class="ptext"> <?=$x['pin_no'];?></td>
                                  <td align="center" class="ptext"> <?php if($x['cat_duration'] && $x['type']==2 && $x['subs_fee']=='29.99'){ echo "1";}else{ echo $duration;}?> Months</td>
                                  <td align="center" class="ptext"><?=date('m-d-Y',strtotime($x['subs_date']));?></td>
                                  <td align="center" class="ptext"><?=$enddate;?></td>
                         		<td align="center" class="ptext"><?=$enddate1;?></td>
								  <td align="center" class="ptext"><?php if($x['status']==1) echo "<span class='badge_style b_pending'>Inactive</span>"; else if($x['status']==0){ echo "<span class='badge_style b_done'>Active</span>"; } else{ echo "<span class='badge_style b_pending'>Cancel</span>";} ?></td>
								
                       </tr>
                        <?
						}
						}
						?>
						</tbody>
						<tfoot>
						</tfoot>
						</table>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>