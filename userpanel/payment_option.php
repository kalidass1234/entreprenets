<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_id=showuserid($_SESSION['SD_User_Name']);		
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_id='$user_id'"));
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
    <form action="upgrade_one.php" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
     <ul>
      <li>
       <div class="entry-content">	
    <h5 class="post-title cufon_headings">Membership</h5>
</div>
    <div class="norm_text">
        <table align="center" class="pmpro_checkout top1em" id="pmpro_levels_table" style="display: table;
        border-collapse: separate;
        border-spacing: 2px;
        border-color: gray; width:100%;">
            <thead style="display: table-header-group;
            vertical-align: middle;
            border-color: inherit;">
                <tr>
                  <th class="show_vision_level">Level</th>
                  <th class="show_vision_level">Initial Payment</th>
                  <th class="show_vision_level">Subscription Pricing</th>
                  <th class="show_vision_level">Trial Period/Duration</th>
                  <th class="show_vision_level">Select Payment</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //echo "<pre>"; print_r($_SESSION); 
            $category=$_SESSION['category_member'];
            if($category==2)
            {
            ?>
               <tr class="odd">
                    <td align="center">Vision Team Network Monthly <br><br>Membership</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$84.98</strong>per<br><br> Month</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=29.99&duration=1&category=2" class="link-select">Select</a></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 3<br><br> month option</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$254.94</strong>every 3 <br><br>Months</td>		
                    <td align="center"><strong>4 payments</strong> total.<br><br>
                    Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=254.94&duration=3&category=2" class="link-select">Select</a></td>
                </tr>
                <tr class="odd">
                    <td align="center">Vision Team Network Membership - 6 <br><br>month option</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$509.88</strong>every 6<br><br> Months</td>		
                    <td align="center"><strong>2 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=509.88&duration=6&category=2" class="link-select">Select</a></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 12 <br><br>month option</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$1,019.76</strong>every 12 <br><br>Months</td>		
                    <td align="center"><strong>1 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=1019.76&duration=12&category=2" class="link-select">Select</a></td>
                </tr>
             <?php
             }
             else if($category==3)
             {
             ?>
             <tr class="odd">
                    <td align="center"><nobr>Vision Team Network Monthly<br><br> Membership</nobr></td>
                    <td align="center">$150.00</td>
                    <td align="center"><strong>$150.00</strong>every 12 <br><br>Months</td>		
                    <td align="center"><strong>1 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=150.00&duration=12&category=3" class="link-select">Select</a></td>
                </tr>
             <?php
             }
             else if($category==1)
             {
             ?>
                <tr class="odd">
                    <td align="center">Vision Team Network Monthly <br><br>Membership</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$29.99</strong>per<br><br> Month</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=29.99&duration=1&category=1" class="link-select">Select</a></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 3 <br><br>month option</td>
                    <td align="center">$89.97</td>
                    <td align="center"><strong>$89.97</strong>every 3<br><br> Months</td>		
                    <td align="center"><strong>4 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=89.97&duration=3&category=1" class="link-select">Select</a></td>
                </tr>
                <tr class="odd">
                    <td align="center">Vision Team Network Membership - 6<br><br> month option</td>
                    <td align="center">$179.94</td>
                    <td align="center"><strong>$179.94</strong>every 6<br><br> Months</td>		
                    <td align="center"><strong>2 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=179.94&duration=6&category=1" class="link-select">Select</a></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 12 <br><br>month option</td>
                    <td align="center">$359.88</td>
                    <td align="center"><strong>$359.88</strong>every 12 <br><br>Months</td>		
                    <td align="center"><strong>1 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=359.88&duration=12&category=1" class="link-select">Select</a></td>
                </tr>
             <?php
             }
             ?>   
            </tbody>
            <tfoot>
                <tr>
                 <td colspan="5" align="center">
                  <small>--<a href="index.php">return to the member account</a>--</small>
                 </td>
                </tr>
            </tfoot>
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