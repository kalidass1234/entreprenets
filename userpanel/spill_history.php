<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	if(isset($_GET['msg']))
	$msg=$_REQUEST['msg'];
	else
	$msg='';
	$regdate_ip = getenv('REMOTE_ADDR');
	$s="select * from registration where user_name='$idd'";
	$ffr=mysql_query($s);
	$f=mysql_fetch_array($ffr);
	$id=$f['user_id'];
	
	$str="select * from registration where user_id='$id'";
	$res=mysql_query($str);
	$x=mysql_fetch_array($res);
	$ref_id=$x['ref_id'];
	$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
	$category_one=$x['category_one'];
	$category_two=$x['category_two'];
	$category_three=$x['category_three'];
	//echo $id;
	//echo "select * from reserve_member where receiver_id='$id' order by id";
	$dir=mysql_query("select * from reserve_member where user_id='$id' and status=1 order by id");
	$dir_count=mysql_num_rows($dir);
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
		<h3>Spill Over</h3>
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
    <?php
		//include('switch-bar.php');
		$sql_ref="select * from registration where user_id='$ref_id'";
		$res_ref=mysql_query($sql_ref);
		$row_ref=mysql_fetch_assoc($res_ref);
  	?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
          <h6 align="center" style="color:#0033FF">
          <?php
          if($ref_id=='cmp' || $ref_id=='')
		  {
		  ?>
          <p style="text-align:left; overflow:hidden;">
          <img src="http://visionteamnetwork.com/img/s-logo.png" width="100" style="float:left; border:2px solid #e1e1e1; border-radius:5px; margin:0 10px 0 0" height="100">  
		  <strong>Sponser:</strong> Company<br><br>
          <strong>Status:</strong>Active
          </p>
          <?php
		  }
		  else
		  {
		  ?>
          <p style="text-align:left; overflow:hidden;">
          <img src="userimages/<?php echo $row_ref['image'];?>" width="100" style="float:left; border:2px solid #e1e1e1; border-radius:5px; margin:0 10px 0 0" height="100">  
		  
		  <strong>Sponser:</strong> <?php echo $row_ref['user_name'];?><br><br>
          
          <strong>Status:</strong><?php if($row_ref['user_name']){ echo "Active";}else{ echo "Inactive";}?>
          </p>
          <?php
          }
		  ?>
          </h6>
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>TRANSFER MEMBERS RESERVE HISTORY</h6>
						
					</div>
					<div class="widget_content">
						<?php
						// check category two subscription is available or not
						$sql_subs="select * from subscription where user_id='$id' and status=0 and type='2'";
						$res_subs=mysql_query($sql_subs);
						$count_subs=mysql_num_rows($res_subs);
                        if($category_two && $count_subs)
						{
                        /*if($category_two)
						{*/
						?>
						<div id="tab2" >
                        <form name="" action="spill1_submit.php" method="post">
							<table width="100%">
                            <thead>
                            <tr>
                            <th width="6%" >S.No.</th>
                            
                            <th width="18%" >User ID</th>
                            <th width="20%" >Username</th>
                            <th width="17%" >Status</th>
                            <th width="13%" >Receiver Id</th>				  
                            <th width="11%">Sender Id</th>
                            <th width="11%">Transfer Date</th>
                            </tr>
                            <tr style="border:1px solid #FFFFFF;">
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>				  
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            </tr>
                            </thead>                             
                            <tbody>           
                            <?php 
							$j=1;
							while($direct=mysql_fetch_array($dir)){
							if($direct[status]=='0'){$status='Active';} else{$status='Transfer';}
							$name_direct=ucfirst($direct['first_name'])." ".ucfirst($direct['mid_name'])." ".ucfirst($direct['last_name']);
							?>
							 <tr>
                              <td class="center" align="center"><?php echo $j;?></td>
                              
                              <td class="center" align="center"><?php echo $direct['member_id'];?></td>
							  <td class="center" align="center"><?php echo showusername($direct['member_id']);?></td>
                              <td class="center" align="center"><?php echo $status;?></td>  
                  <td class="center" align="center"><?php echo showusername($direct['receiver_id']);?></td>
                              <td class="center" align="center"><?php echo showusername($direct['sender_id']);?></td>
                              <td class="center" align="center"><?php echo date('m-d-Y',strtotime($direct['transfer_date']));?></td>
                            </tr>
                            <?php
							$j++;
							}
							?>
                            <tr style="border:1px solid #FFFFFF;">
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>
                            <th >&nbsp;</th>				  
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            </tr>
                            
						</tbody>
					  </table>
                      </form>
						</div>
						<?php
                        }
						else
						{
						?>
                        <p>
                        	You  are not authorize to access this section.<br>
							You Need To Upgrade Your Account To See This Part.<br>
                            <span ><a href="upgrade_account.php" class="badge_style b_pending">Upgrade</a></span>
						</p>
                        <?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>