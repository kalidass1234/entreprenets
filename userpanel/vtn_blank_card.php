<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['adid'])
{
	 $sql_welcome=mysql_fetch_array(mysql_query("SELECT * FROM static_page order by id desc limit 0,1"));	
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_name='{$_SESSION['adid']}'"));
}
else
{
	echo "<script language='javascript'>window.location.href='../index.php';</script>";exit;
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
		<h3>VTN Card</h3>
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
						<h6>VTN Card</h6>
					</div>
     <style>
.form_container ul li {
	background: url(../images/dot.png) repeat-x bottom;
position: relative;
padding: 5px 15px 15px 10px;
}
	 </style>           
					<div class="widget_content" style="background-color:#FFFFFF">
                    <?php
					//($res_user['category_two'] && $res_user['category_one']) || ($res_user['category_two'] && $res_user['category_three']) || ($res_user['category_one'] && $res_user['category_three']) || $res_user['category_three']
					$useridd=$res_user['user_id'];
					$sql_subs="select * from subscription where user_id='$useridd' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?>
<ul id="slideShow"></ul>
      
        
        <!-- JavaScript includes -->
	        <script src="vtncard/jquery.bubbleSlideshow/bgpos.js"></script>
        <script src="vtncard/jquery.bubbleSlideshow/jquery.bubbleSlideshow.js"></script>
        <script src="vtncard/js/script.js"></script>
						
						<form action="vtn_card.php" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
								<li>
                                <h3 style="color: #800080;">Program Overview</h3>
								<div class="norm_text">
										<p>The Vision Team Network PayCard provides our members with the most comprehensive PayCard benefit and ePayroll program designed for our valued members choosing to convert to electronic delivery of payroll at zero cost. The Vision Team Network PayCard Visa Payroll Card ePayStub solution and online W2 forms eliminate paper in the payroll office and benefit employers, employees and the environment.
<br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;rapid! PayCard convert all employees over to standard direct deposit. Eliminate Payroll checks.
<br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;ePayStub  Provide paystubs electronically to all employees and eliminate paystub distribution.
<br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;eW2  Reduce your companys requirement to mail paper W2s by providing electronic access.
<br><br>
The ePayStub and online W2 forms provide multiple outlets for employees to view their electronic statements and tax documents. Your company can expect to see immediate savings and realize efficiencies by eliminating distribution of regular pay checks and wage statements.	</p>
								</div>
								</li>
                                
                                <li>
                                 <h3 style="color: #800080;">Membership Benefits</h3>
								<div class="norm_text">
                                    <p>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;NO paycheck cashing fees . Save more than 50% versus check cashing fees
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;NO lost checks
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;NO overdraft fees
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;NO need to carry large sums of money
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;24x7 access to pay
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;FREE multilingual customer service 7x24x365
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;FREE access to their pay
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;FREE access to monitor transactions online and text alerts*
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;FREE Savings Account Access
<br><br>
                                    &bull;&nbsp;&nbsp;&nbsp;&nbsp;Cash Back Rewards
<br><br>
                                    * (STANDARD TEXT MESSAGING RATES MAY APPLY)
                                    </p>
								</div>
								</li>
                                
                                <li>
                                 <h3 style="color: #800080;">Bonus Features</h3>
								<div class="norm_text">
                                
                                <p>
                                 These services provide greater convenience, added security and exceptional value to cardholders and include:
                                    <br> <br>
                                
                                <strong>Text Alerts</strong> – Cardholders may elect to have text messages with information about their card balance or transactions sent directly to their cell phone On-Demand or Event Driven.
                                 <br> <br>
<strong>Cash Back Merchant Rewards</strong> – Cardholders can opt into a cash back merchant rewards program that pays them for normal purchasing behavior.
 <br> <br>
<strong>Interest Bearing Savings</strong> – Cardholders have access to an interest bearing savings account or "purse" in their account.
 <br> <br>
<strong>Bill Payment</strong> – Cardholders can pay their bills over the phone or Web portal. Portability – The rapid! PayCard is the employee's private card account.
 <br> <br>
<strong>Cardholder Issued Check</strong> – Cardholders can write a check for payment or receive 100% of their pay off their card.
 <br> <br>
<strong>Allpoint® ATM Withdrawal</strong> – The rapid! PayCard is currently a member of the Allpoint ATM surcharge-free network access at more than 37,000 locations.
                                
                                </p>
                                    <p>
                                    ADDITIONAL METHODS TO ACCESS THEIR PAY
                                    <br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;POS Store Purchase (including cash-back, where available)
<br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;Request a Check
<br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;US Post Office Money Order
<br><br>
&bull;&nbsp;&nbsp;&nbsp;&nbsp;Electronic Transfer to a bank account
                                    
                                    </p>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									
									<div class="form_input">
									Note: There will be a $3.99 fee for issuing the debit card.
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									
									<div class="form_input">
									<strong>No Hidden Fee -</strong>	Click <span style="color: #800080;"><a title="VTN Card Fees" href="vtn_card_fees.php" target="_blank"><span style="color: #800080;"><strong>HERE</strong></span></a></span> to view fees
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">&nbsp; </label>
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="12"><span>Sign Up</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
                        <?php
                        }
						else
						{
						echo "<p>You are not authorize to access this section.</p>";
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