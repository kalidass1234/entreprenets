<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
  if(showusertype($_SESSION['SD_User_Name'])=='business')
  {
	$idd=showuserid($_SESSION['SD_User_Name']);
  }
  else
  {
  	echo "<script language='javascript'>window.location.href='error.php';</script>";exit;
  }	
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
		<h3>Tax</h3>
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
            <div class="grid_12">
		  <div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Taxes</h6><h6><a href="addtax.php">Add New Tax</a></h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Compose Message</a></li>
								
								<li><a href="inbox.php">Indox</a></li>
								<li><a href="#tab3">Sent </a></li>
							</ul>
						</div>-->
					</div>
					<div class="widget_content">
					<div>
						
					</div>
						<!--<div id="tab1">
							<div class="oilhold">
   							<form action="message1.php" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<input name="u_name" type="text" tabindex="1" class="" style="width:44%;" />
									
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Name</label>
									<div class="form_input">
										<input name="filed01" type="text" tabindex="1" class="limiter" style="width:44%;" />
										
									</div>
								</div>
								</li>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Contact No</label>
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
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
										<button type="submit" class="btn_small btn_gray"><span>Send To User</span></button>
										<button type="reset" class="btn_small btn_gray"><span>Reset</span></button>
										
									</div>
								</div>
								</li>
							</ul>
						</form>
					 
					</div>	
					</div>-->
				
						
						<div id="tab3">
							 <form id="form_send_box2" name="form_send_box" action="delete_contact_func1.php" method="post">
							
					<div class="widget_content">
						<!--<h3>My Contacts</h3>-->
						<table class="display" id="action_tbl">
						<thead>
						<tr>
							<th class="center">
								<!--<input name="checkbox" type="checkbox" value="" class="checkall">-->
							</th>
						
							<th>
								State Name
							</th>
							<th >
								 Tax (%)
							</th>
							<th >Date Of Create</th>
							<th >Create By User</th>
							<th >Active/Inactive</th>
							
							<th  style="border-right:none;">Edit
							</th>
							<th  style="border-right:none;">&nbsp;
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
						  $str1="select * from tax where user_id='$idd' order by id desc";
							$res1=mysql_query($str1);
						  $i=1;
						  while($x1=mysql_fetch_array($res1))
						  {
						  $st1=$x1['status'];
		 					$id=$x1['id'];
			 			 ?>
						<tr>
							<td class="center tr_select ">
								<!--<input name="checkbox[]" type="checkbox" value="<?= $x1[id]; ?> ">-->
							</td>
							
						
							<td class="center">
								<?=$x1['state_name'];?>
							</td>
							<td class=" center" >
								 <?=$x1['tax'];?>
							</td>
							<td class="center"><?=date('m/d/Y',strtotime($x1['crt_date']));?></td>
							<td class="center sdate" >
								 <span class=" "><?=$x1['created_by_user'];?></span>
							</td>
							
							<td class="center" >
							<?php
						  if($st1==1)
						  {
						  $us3="Inactive";
						  ?>
						  <a href="settax.php?id=<?php echo $id;?>&status=<?php echo $st1?>" onClick="if(confirm('do you want to make it active')){ return true;} else { return false;}"><span class="badge_style b_pending"><?php echo $us3;?></span></a>
						  <?php
						 
						  }
						  else
						  {
						  $us2="Active";
						  //print $us3;
						   
						  //print $us1;
						  ?>
                          <a href="settax.php?id=<?php echo $id;?>&status=<?php echo $st1?>" onClick="if(confirm('do you want to make it Inactive')){ return true;} else { return false;}"><span class="badge_style b_done"><?php echo $us2;?></span></a>
						  <?php
						  }
						  ?>
							</td>
							
							<td class="center" style="border-right:none;">
							<span><a class="action-icons c-edit" href="addtax.php?id=<?php echo $id;?>&edit=edit" ></a></span>
						  	</td>
							<td class="center"  style="border-right:none;">&nbsp;
								
							</td>
						</tr>
						<?php $i++; } ?>
						
						
						
						</tbody>
						<tfoot>
						<!--<tr>
							<th class="center">
								<input name="checkbox" type="checkbox" value="" class="checkall">
							</th>
							<th>
								 Id
							</th>
							<th>
								 Task
							</th>
							<th>
								 Dead Line
							</th>
							<th>
								 Priority
							</th>
							<th>
								 Status
							</th>
							<th>
								 Complete Date
							</th>
							<th>
								 Action
							</th>
						</tr>-->
						</tfoot>
						</table>
					</div>
					<input type="submit" style="display:none;" name="Submit">
					
					</form>
						</div>
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