<?php
include ('../includes/all_func.php');
error_reporting ( E_ALL ^ E_NOTICE );
session_start ();
if (isset ( $_SESSION ) && $_SESSION ['adid']) {
	$idd = $_SESSION ['adid'];
	if (isset ( $_GET ['msg'] ))
		$msg = $_REQUEST ['msg'];
	else
		$msg = '';
	$regdate_ip = getenv ( 'REMOTE_ADDR' );
	$s = "select * from registration where user_name='$idd'";
	$ffr = mysql_query ( $s );
	$f = mysql_fetch_array ( $ffr );
	$id = $f ['user_id'];
	
	$str = "select * from registration where user_id='$id'";
	$res = mysql_query ( $str );
	$x = mysql_fetch_array ( $res );
	$ref_id = $x ['ref_id'];
	$name = $x ['first_name'] . " " . $x ['mid_name'] . " " . $x ['last_name'];
	$category_one = $x ['category_one'];
	$category_two = $x ['category_two'];
	$category_three = $x ['category_three'];
	// echo $id;
	
	// end summary
} else {
	echo "<script language='javascript'>window.location.href='login.php';</script>";
	exit ();
}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width" />
<title><?php echo $TITLE_USER;?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet"
	type="text/css">
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
.binary_line1 {
	background: url(images/topline.gif) no-repeat center top;
	border-top: solid #000 2px;
}
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
include ('left-bar.php');
?>
<div id="container">
		<div id="header" class="blue_lin">
			<div class="header_left">
			<?php
			include ('header-left.php');
			?>
			<?php
			include ('menu-mobile.php');
			?>
		</div>
		<?php
		include ('header-right.php');
		?>
	</div>
		<div class="page_title">
			<span class="title_icon"><span class="coverflow"></span></span>
			<h3>Transfer E-voucher</h3>
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
							<h6>Transfer Voucher</h6>

						</div>
						<div class="widget_content">

							<div id="tab2">
							<form action="" method="post" onsubmit="return validation_voucher(this)">
 								<table class="display data_tbl">


									<thead>

										<tr>
											
											<th>S.No.</th>
											<th>Voucher Code</th>
											<th>Receiver ID</th>
											<th>Receiver Name</th>
											<th>Remark</th>
											<th>Date</th>
											<th>Amount</th>
											<th>Status</th>
											
										</tr>
									</thead>


									<tbody>           
                          <?php
							
                            $j = 1;
                            
                            $sql_ref = "select * from pins where sender_id='$id'";
                            $res_ref = mysql_query ( $sql_ref );
                           
							while ( $direct = mysql_fetch_array ( $res_ref ) ) {
							
							$used_status = array('Fresh','Used');	
							
							// get receiver name
							$sql_receiver = "select first_name, last_name from registration where user_id='". $direct['receiver_id']."'";
							$rst_receiver = mysql_query($sql_receiver);
							
							$name = '';
							
							if( mysql_num_rows($rst_receiver) > 0 ){

								$args_receiver = mysql_fetch_assoc($rst_receiver);
								
								$name = $args_receiver['first_name']." ".$args_receiver['last_name'];
							}
							
						  ?>
						  
							 <tr>
							 	
								<td class="center"><?php echo $j;?></td>
								<td class="center"><?php echo $direct['pin_no'];?></td>
								<td class="center"><?php echo $direct['receiver_id'];?></td>
								<td class="center"><?php echo $name;?></td>
								<td class="center"><?php echo $direct['created_by_user'];?></td>
								<td class="center"><?php echo date("d-m-Y",strtotime($direct['crt_date']));?></td>
								<td class="center">$<?php echo number_format($direct['amount'],2);?></td>
								
								<td class="center"><?php echo $used_status[$direct['status']];?></td>
								
							</tr>
							
                            <?php
								$j ++;
							}
							
							?>
						
						</tbody>
						
						
								</table>
								</form>
								
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