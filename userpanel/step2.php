<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
$sql_sel=mysql_query("SELECT * FROM cms_seven WHERE category=2");
						$res_sel=mysql_fetch_array($sql_sel);
if(isset($_POST['submit']))
{
	//echo "<pre>"; print_r($_POST);
	// check the all five answer
	$answer1=$res_sel['answer1'];
	$answer2=$res_sel['answer2'];
	$answer3=$res_sel['answer3'];
	$answer4=$res_sel['answer4'];
	$answer5=$res_sel['answer5'];
	
	$answer11=$_POST['answer1'];
	$answer12=$_POST['answer2'];
	$answer13=$_POST['answer3'];
	$answer14=$_POST['answer4'];
	$answer15=$_POST['answer5'];
	if($answer1==$answer11)
	{
		if($answer2==$answer12)
		{
			if($answer3==$answer13)
			{
				if($answer4==$answer14)
				{
					if($answer5==$answer15)
					{

							echo "<script language='javascript'>alert('Congrates You Are Move to Third Step.');window.location.href='step3.php';</script>";exit;
					}
					else
					{
						echo "<script language='javascript'>alert('Fifth Answer is wrong.');window.location.href='step2.php';</script>";exit;
					}
				}
				else
				{
					echo "<script language='javascript'>alert('Fourth Answer is wrong.');window.location.href='step2.php';</script>";exit;
				}
			}
			else
			{
				echo "<script language='javascript'>alert('Third Answer is wrong.');window.location.href='step2.php';</script>";exit;
			}
		}
		else
		{
			echo "<script language='javascript'>alert('Second Answer is wrong.');window.location.href='step2.php';</script>";exit;
		}
	}
	else
	{
		echo "<script language='javascript'>alert('First Answer is wrong.');window.location.href='step2.php';</script>";exit;
	}
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
		<h3>Step2</h3>
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
						
						//echo "SELECT * FROM promo WHERE n_id=$id";
						
					?>
						<div class="oilhold">
   							<form action="" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Title</label>
									<div class="form_input">
										<?= $res_sel[title]; ?>
									</div>
								</div>
								</li>
								
							
								<li>
								<div class="form_grid_12">
									<!--<label class="field_title">Formula </label>-->
									<div class="form_input" style="margin-left:0px;">
										<?php  echo $res_sel['content']; ?>
									</div>
								</div>
								</li>
								<!--Show here the five question and answer-->
                                <?php
                                for($i=1;$i<=5;$i++)
								{
								?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Question <?php echo $i;?> </label>
									<div class="form_input">
										<?php  echo $res_sel['question'.$i]; ?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Answer <?php echo $i;?> </label>
									<div class="form_input">
										<input type="radio" name="answer<?php echo $i;?>" value="1"><?php  echo $res_sel['answer'.$i.'_1']; ?>
                                        <br>
                                        <input type="radio" name="answer<?php echo $i;?>" value="2"><?php  echo $res_sel['answer'.$i.'_2']; ?>
                                        <br>
                                        <input type="radio" name="answer<?php echo $i;?>" value="3"><?php  echo $res_sel['answer'.$i.'_3']; ?>
                                        <br>
                                        <input type="radio" name="answer<?php echo $i;?>" value="4"><?php  echo $res_sel['answer'.$i.'_4']; ?>
                                        <br>
									</div>
								</div>
								</li>
                                <?php
                                }
								?>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
										<button type="submit" name="submit" class="btn_small btn_gray"><span>Next Step</span></button>
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