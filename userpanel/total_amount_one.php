<?php
/*session_start();
echo "<pre>"; print_r($_POST);
echo "<pre>"; print_r($_SESSION);
exit;*/
include('../includes/all_func.php');
error_reporting(0);
session_start();

$_SESSION['other_category']=$_POST['other_category'];
$_SESSION['other_duration']=$_POST['other_duration'];
$other_category=$_SESSION['other_category'];
if($other_category==3){$_SESSION['other_amount']=150; $_SESSION['other_duration']=12;}
if($other_category==2)
{
	/*if($_SESSION['duration']==1){$_SESSION['other_amount']=29.99;$_SESSION['other_duration']=1;}
	if($_SESSION['duration']==3){$_SESSION['other_amount']=254.94;$_SESSION['other_duration']=3;}
	if($_SESSION['duration']==6){$_SESSION['other_amount']=509.88;$_SESSION['other_duration']=6;}
	if($_SESSION['duration']==12){$_SESSION['other_amount']=1019.76;$_SESSION['other_duration']=12;}*/
	if($_SESSION['other_duration']==1){$_SESSION['other_amount']=29.99;}
	if($_SESSION['other_duration']==3){$_SESSION['other_amount']=29.99;}
	if($_SESSION['other_duration']==6){$_SESSION['other_amount']=29.99;}
	if($_SESSION['other_duration']==12){$_SESSION['other_amount']=29.99;}
}
if($other_category==1)
{
	if($_SESSION['duration']==1){$_SESSION['other_amount']=29.99;$_SESSION['other_duration']=1;}
	if($_SESSION['duration']==3){$_SESSION['other_amount']=89.97;$_SESSION['other_duration']=3;}
	if($_SESSION['duration']==6){$_SESSION['other_amount']=179.94;$_SESSION['other_duration']=6;}
	if($_SESSION['duration']==12){$_SESSION['other_amount']=359.88;$_SESSION['other_duration']=12;}
}
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_id=showuserid($_SESSION['SD_User_Name']);		
	$res_user=mysql_fetch_array(mysql_query("select * from registration where user_id='$user_id'"));
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

if($_SESSION['category']==2){$_SESSION['amount']=29.99;}
$plan_name=$_SESSION['other_amount']+$_SESSION['amount'];
//echo $plan_name."#".$_SESSION['other_amount']."#".$_SESSION['amount'];exit;
if($_POST['pin']!='')
{
	$sql_pin="select * from pins where status=0 and amount='$plan_name' and pin_no='$_POST[pin]'";
	$res_pin=mysql_query($sql_pin);
	$count_pin=mysql_num_rows($res_pin);
	if($count_pin>0)
	{
		
	}
	else
	{
		$return_page=$_POST['return_page'];
		echo "<script type='text/javascript'>alert('Wrong Voucher Code.');window.location.href='$return_page';</script>";exit;
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
		<h3> Payment Package</h3>
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
						<h6>Payment Package</h6>
				  </div>
     <style>
.form_container ul li {
	background: url(../images/dot.png) repeat-x bottom;
position: relative;
padding: 5px 15px 15px 10px;
}
.show_vision_level
{
font-weight: bold;
color: #ffffff;
padding: 10px;border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
border-top: 1px solid #eee;
background: #555;
}
.odd
{
border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;background: #F8F9FC;
}
.even
{
border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;
}
.link-select
{
background-color: #666;
background-image: url(http://visionteamnetwork.com/wp-content/plugins/paid-memberships-pro/images/bg_grad-chrome.gif);
color: #FFF;
display: inline-block;
margin: 0;
background-position: top left;
background-repeat: repeat-x;
cursor: pointer;
border-radius: 4px;
-moz-border-radius: 4px;
padding: 5px 10px;
text-decoration: none;
text-shadow: 1px 1px 3px #000;
border: none;
font-family: Arial, Helvetica, sans-serif;
}
	 </style>           
<div class="widget_content" style="background-color:#FFFFFF">
<?php if($_POST['pin']!=''){$action='joinnew.php';}else{$action='pay_authorize_new.php';}?>
    <form action="<?php echo $action;?>" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
     <ul>
      <li>
       <div class="entry-content">	
    <h5 class="post-title cufon_headings">Membership</h5>
</div>
    <div class="norm_text">
        <table align="center" class="pmpro_checkout top1em" id="pmpro_levels_table" cellpadding="5" cellspacing="5" style="display: table;
        border-collapse: separate;
        border-spacing: 2px;
        border-color: gray; width:100%;">
            <thead style="display: table-header-group;
            vertical-align: middle;
            border-color: inherit;">
                <tr>
                  <th class="show_vision_level">Level</th>
                  <th class="show_vision_level">Initial Payment</th>
                  <th class="show_vision_level">Discription Package</th>
                  <th class="show_vision_level">Trial Period/Duration</th>
               
                </tr>
            </thead>
            <tbody>
           		<?php $arr_cat=array('','Discount Benifit Member','Discount Benifit Member+Residual Income','Affiliate Refferal');?>
               <tr class="odd">
                    <td align="center"><?php echo $_SESSION['category'];?></td>
                    <td align="center">$<?php echo $_SESSION['amount'];?></td>
                    <td align="center">$<?php echo $arr_cat[$_SESSION['category']];?></td>		
                    <td align="center"><?php echo $_SESSION['duration'];?> Months</td>
                    
                </tr>
                <tr class="odd">
                    <td align="center"><?php echo $_SESSION['other_category'];?></td>
                    <td align="center">$<?php echo $_SESSION['other_amount'];?></td>
                    <td align="center">$<?php echo $arr_cat[$_SESSION['other_category']];?></td>		
                    <td align="center"><?php echo $_SESSION['other_duration'];?> Months</td>
                </tr>
                <tr class="odd">
                    <td align="center">Total</td>
                    <td align="center">$<?php echo $_SESSION['amount']+$_SESSION['other_amount'];?></td>
                    <td align="center">&nbsp;</td>		
                    <td align="center">&nbsp;</td>
                </tr>
             <input type="hidden" name="x_first_name" value="<?php echo $_POST['x_first_name'];?>">
             <input type="hidden" name="x_last_name" value="<?php echo $_POST['x_last_name'];?>">
             <input type="hidden" name="exp_year" value="<?php echo $_POST['exp_year'];?>">
             <input type="hidden" name="exp_month" value="<?php echo $_POST['exp_month'];?>">
             <input type="hidden" name="card_type" value="<?php echo $_POST['card_type'];?>">
             <input type="hidden" name="card_no" value="<?php echo $_POST['card_no'];?>">
             <input type="hidden" name="cvv" value="<?php echo $_POST['cvv'];?>">
             <input type="hidden" name="x_address" value="<?php echo $_POST['x_address'];?>">
             <input type="hidden" name="x_city" value="<?php echo $_POST['x_city'];?>">
             <input type="hidden" name="x_state" value="<?php echo $_POST['x_state'];?>">
             <input type="hidden" name="x_zip" value="<?php echo $_POST['x_zip'];?>">
             <input type="hidden" name="x_mobile" value="<?php echo $_POST['x_mobile'];?>">
             <input type="hidden" name="x_email" value="<?php echo $_POST['x_email'];?>">
             <input type="hidden" name="other_category" value="<?php echo $_POST['other_category'];?>"> 
             <input type="hidden" name="other_duration" value="<?php echo $_SESSION['other_duration'];?>"> 
             <input type="hidden" name="pin" value="<?php echo $_POST['pin'];?>">
             <input type="hidden" name="return_page" value="<?php echo $_POST['return_page'];?>">  
            <tr class="even">
                    <td align="center" colspan="4"><input type="button" name="Back" onClick="redirect_previous(<?php echo $_SESSION['category'];?>);" value="Back">&nbsp;&nbsp;<input type="submit" name="submit" value="Proceed"></td>
                </tr>
            </tbody>
            
        </table>
      </div>
     </li>
    </ul>
    </form>
          </div>
        </div>
      </div>
    </div>
   <span class="clear"></span>
  </div>
 </div>
</body>
</html>
<script>
function redirect_previous(cat)
{
	if(cat==1)
	{
		window.location.href='member-secure_new.php';
	}
	if(cat==2)
	{
		window.location.href='member-secure_two_new.php';
	}
}
</script>