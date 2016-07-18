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

// store request history of voucher
if(isset($_POST['amount']) ){
	
	if(is_numeric($_POST['amount']) && is_numeric($_POST['no_of_voucher'])){
			
	
		if(strtolower($_FILES['slip']['type']) == 'image/jpeg' ||  strtolower($_FILES['slip']['type']) == 'image/jpg' || strtolower( $_FILES['slip']['type']) == 'image/gif' || strtolower($_FILES['slip']['type']) == 'image/png')
		{
			$blacklist = array(".php", ".phtml", ".php3", ".php4");
			foreach ($blacklist as $item)
			{
				if(preg_match("/$item\$/i", $_FILES['slip']['name']))
				{
					echo "sorry, this is not valid file."; exit;		
				} 
			}
			
			$imageinfo = @getimagesize($_FILES['slip']['tmp_name']); //check image size
			
			if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') 
			{
				echo "sorry, Upload JPEG, JPG, PNG, GIF file only"; exit;
			}
			else{
					
				if(isset($_FILES['slip']['name']))
				{
					$image2=$idd.'_'.time().'_'.substr(str_replace(" ", "_", $_FILES['slip']['name']),0,3).'.jpg';
					
					move_uploaded_file($_FILES['slip']['tmp_name'],"userimages/".$image2);
					
					$sql = "insert into pin_request set user_id='".$id."', amount='".$_POST['amount']."', no_of_pin='".$_POST['no_of_voucher']."', date='".date("Y-m-d")."', payment_slip='".$image2."'";
					mysql_query($sql);
					
					echo '<script type="text/javascript"> alert("Vouchers request send to admin succeffully!"); window.location.href="voucher-request-history.php"; </script>';
				}
			}
		
		}
		else{
			echo '<script type="text/javascript"> alert("Please upload scan copy of slip in image format"); </script>';
		}
		
	}
	else{
		echo '<script type="text/javascript"> alert("Please enter numeric values in amount and no of vouchers"); </script>';
	}
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
			<h3>Request for Voucher</h3>
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
							<h6>Request For E-voucher</h6>

						</div>
						<div class="widget_content">

							<div id="tab2">
								
								<form action="" method="post" onsubmit="return validation_form(this)" enctype="multipart/form-data">
									<p>
										<label for="amount">Amount</label>
									</p>
									<p>
										<input type="text" name="amount">
									</p>
									
									<p>
										<label for="amount">No of Vouchers</label>
									</p>
									<p>									
										<input type="text" name="no_of_voucher">
									</p>
									
									<p>
										<label for="amount">Payment Slip</label>
									</p>
									<p>
										<input type="file" name="slip">
									</p>
									
									<p>
										<input type="submit"  value="Submit">
									</p>
									
								</form>
								
								<script type="text/javascript">
									function validation_form(thisform){

										if(thisform.amount.value == ''){
											alert("Please enter amount");
											return false;
										}

										if(thisform.no_of_voucher.value == ''){
											alert("Please enter how much voucher you want");
											return false;
										}

										if(thisform.slip.value == ''){
											alert("Please upload payment slip");
											return false;
										}

										return true;
										
									}
								</script>
								
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