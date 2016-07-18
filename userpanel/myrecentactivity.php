<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$id=showuserid($_SESSION['SD_User_Name']);

}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
//include('includes/notificationcount.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title><?php echo $TITLE_USER;?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/layout.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/themes.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/typography.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/shCore.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/data-table.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/form.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/wizard.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/sprite.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/gradient.css" rel="stylesheet" type="text/css" media="screen">
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
<script>
	$(function () {
    $.jqplot._noToImageButton = true;
    var prevYear = [["2011-08-01",398], ["2011-08-02",255.25], ["2011-08-03",263.9], ["2011-08-04",154.24],
    ["2011-08-05",210.18], ["2011-08-06",109.73], ["2011-08-07",166.91], ["2011-08-08",330.27], ["2011-08-09",546.6],
    ["2011-08-10",260.5], ["2011-08-11",330.34], ["2011-08-12",464.32], ["2011-08-13",432.13], ["2011-08-14",197.78],
    ["2011-08-15",311.93], ["2011-08-16",650.02], ["2011-08-17",486.13], ["2011-08-18",330.99], ["2011-08-19",504.33],
    ["2011-08-20",773.12], ["2011-08-21",296.5], ["2011-08-22",280.13], ["2011-08-23",428.9], ["2011-08-24",469.75],
    ["2011-08-25",628.07], ["2011-08-26",516.5], ["2011-08-27",405.81], ["2011-08-28",367.5], ["2011-08-29",492.68],
    ["2011-08-30",700.79], ["2011-08-31",588.5], ["2011-09-01",511.83], ["2011-09-02",721.15], ["2011-09-03",649.62],
    ["2011-09-04",653.14], ["2011-09-06",900.31], ["2011-09-07",803.59], ["2011-09-08",851.19], ["2011-09-09",2059.24],
    ["2011-09-10",994.05], ["2011-09-11",742.95], ["2011-09-12",1340.98], ["2011-09-13",839.78], ["2011-09-14",1769.21],
    ["2011-09-15",1559.01], ["2011-09-16",2099.49], ["2011-09-17",1510.22], ["2011-09-18",1691.72],
    ["2011-09-19",1074.45], ["2011-09-20",1529.41], ["2011-09-21",1876.44], ["2011-09-22",1986.02],
    ["2011-09-23",1461.91], ["2011-09-24",1460.3], ["2011-09-25",1392.96], ["2011-09-26",2164.85],
    ["2011-09-27",1746.86], ["2011-09-28",2220.28], ["2011-09-29",2617.91], ["2011-09-30",3236.63]];
    var currYear = [["2011-08-01",796.01], ["2011-08-02",510.5], ["2011-08-03",527.8], ["2011-08-04",308.48],
    ["2011-08-05",420.36], ["2011-08-06",219.47], ["2011-08-07",333.82], ["2011-08-08",660.55], ["2011-08-09",1093.19],
    ["2011-08-10",521], ["2011-08-11",660.68], ["2011-08-12",928.65], ["2011-08-13",864.26], ["2011-08-14",395.55],
    ["2011-08-15",623.86], ["2011-08-16",1300.05], ["2011-08-17",972.25], ["2011-08-18",661.98], ["2011-08-19",1008.67],
    ["2011-08-20",1546.23], ["2011-08-21",593], ["2011-08-22",560.25], ["2011-08-23",857.8], ["2011-08-24",939.5],
    ["2011-08-25",1256.14], ["2011-08-26",1033.01], ["2011-08-27",811.63], ["2011-08-28",735.01], ["2011-08-29",985.35],
    ["2011-08-30",1401.58], ["2011-08-31",1177], ["2011-09-01",1023.66], ["2011-09-02",1442.31], ["2011-09-03",1299.24],
    ["2011-09-04",1306.29], ["2011-09-06",1800.62], ["2011-09-07",1607.18], ["2011-09-08",1702.38],
    ["2011-09-09",4118.48], ["2011-09-10",1988.11], ["2011-09-11",1485.89], ["2011-09-12",2681.97],
    ["2011-09-13",1679.56], ["2011-09-14",3538.43], ["2011-09-15",3118.01], ["2011-09-16",4198.97],
    ["2011-09-17",3020.44], ["2011-09-18",3383.45], ["2011-09-19",2148.91], ["2011-09-20",3058.82],
    ["2011-09-21",3752.88], ["2011-09-22",3972.03], ["2011-09-23",2923.82], ["2011-09-24",2920.59],
    ["2011-09-25",2785.93], ["2011-09-26",4329.7], ["2011-09-27",3493.72], ["2011-09-28",4440.55],
    ["2011-09-29",5235.81], ["2011-09-30",6473.25]];
    var plot1 = $.jqplot("chart1", [prevYear, currYear], {
        seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
        title: 'Monthly Revenue',
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
            {
                fill: true,
                label: '2010'
            },
            {
                label: '2011'
            }
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%b %e",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: "2011-08-01",
                max: "2011-09-30",
                tickInterval: "7 days",
                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    formatString: "$%'d",
                    showMark: false
                }
            }
        }
    });
});
/*=================
CHART 8
===================*/
$(function(){
  var plot2 = $.jqplot ('chart8', [[3,7,9,1,5,3,8,2,5]], {
      // Give the plot a title.
      title: 'Plot With Options',
      // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
      axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
      // Likewise, seriesDefaults specifies default options for all
      // series in a plot.  Options specified in seriesDefaults or
      // axesDefaults can be overridden by individual series or
      // axes options.
      // Here we turn on smoothing for the line.
      seriesDefaults: {
		  shadow: false,   // show shadow or not.
          rendererOptions: {
              smooth: true
          }
      },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "X Axis",
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
          label: "Y Axis"
        }
      },
		grid: {
         borderColor: '#ccc',     // CSS color spec for border around grid.
        borderWidth: 2.0,           // pixel width of border around grid.
        shadow: false               // draw a shadow for grid.
    }
    });
});
</script>
</head>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div>
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
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>My Recent Activities</h3>
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
		?>
	<div id="content">
		<div class="grid_container"><span class="clear"></span>
		  <div class="grid_12">
			  <div class="widget_wrap">
					<div class="widget_top g_blue">
						<span class="h_icon list_images"></span>
						<h6>Receive SDS Bucks from shoppers and pay no fee | <span style="margin-left:30px;"><a href="#">Learn How</a></span></h6>
				  </div>
				  <div class="widget_content">
				  <?php 
				  if(isset($_POST))
				  {
				  	if(count($_POST['checkbox'])>0)
					{
						foreach($_POST['checkbox'] as $checkbox)
						{
							$checkbox1.="'".$checkbox."',";
						}
						$checkbox1=rtrim($checkbox1,',');
						if(strlen($checkbox1)>0)
						{
							$condition=" and pay_mode in ($checkbox1)";
						}
					}
					//$count_payout=mysql_num_rows($res_payout);
				  }
				  	$curdate=date('Y-m-d');
					$sevenday=date('Y-m-d',strtotime ( '- 7 day' , strtotime ( $curdate ) ));
				  	$sql_paylist="select * from purchase_detail where seller_id='$id' and (date between '$sevenday' and '$curdate')  $condition ";
					$res_payout=mysql_query($sql_paylist);
					$sql_paylist1="select * from purchase_detail where seller_id='$id'  $condition ";
					$res_payout1=mysql_query($sql_paylist1);
				  ?>
					<form name="paysearch" id="paysearch" action="" method="post">
						<table class="display" >
                          <thead>
                            <tr>
                              <th colspan="6" class="center">Type of Payment Receive </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="center tr_select "><label>
                                <input type="checkbox" name="checkbox[]" value="ewallet" <?php if(isset($_POST['checkbox']) && in_array('ewallet',$_POST['checkbox'])){ echo "checked";}?> />
                                </label>
                                &nbsp; </td>
                              <td>SDS Buck  </td>
                             
                              <td class="sdate center"><input type="checkbox" name="checkbox[]" value="paypal" <?php if(isset($_POST['checkbox']) && in_array('paypal',$_POST['checkbox'])){ echo "checked";}?> />
                              </td>
                              <td class="center">Paypal Id  </td>
                              <td class="center"><label>
                                <input type="text" name="textfield" />
                              </label></td>
                            </tr>
                            <tr>
                              <td class="center tr_select "><input type="checkbox" name="checkbox[]" value="credit" <?php if(isset($_POST['checkbox']) && in_array('credit',$_POST['checkbox'])){ echo "checked";}?> /></td>
                              <td>Visa,Master Card,American Express,Discover Via SDS's Buck </td>
                              
                              <td class="sdate center"><input type="checkbox" name="checkbox[]" value="other" <?php if(isset($_POST['checkbox']) && in_array('other',$_POST['checkbox'])){ echo "checked";}?> /></td>
                              <td class="center">Other</td>
                              <td class="center"><input type="text" name="textfield2" /></td>
                            </tr>
							<tr>
                              <td colspan="5" class="center tr_select "><button type="submit" class="btn_small btn_blue" tabindex="12"><span>Search</span></button></td>
                              </tr>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
						</form>
						
						<div class="grid_12">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>My Recent Activity</h6>
						<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Payment Received</a></li>
								<li><a href="#tab2" class="">Payment Sent</a></li>
								<li><a href="#tab3" class="">View all of my Transaction</a></li>
							</ul>
						</div>

					</div>
					<div class="widget_content">
						<div id="tab1" style="display: block;">
							<div class="post_list">
								
								<table class="display" >
						<thead>
						<tr>
						  <th colspan="5" class="center">My Recent Activity last 7 days(<?php echo date('M d,Y',strtotime($sevenday)).' - '.date('M d,Y');?>) </th>
						  </tr>
						<tr>
							<th>Date</th>
							<th>Section</th>
							<th>Member Id</th>
							<th>Payment Type</th>
							<th>Order Status/Actions</th>
							<th>Gross</th>
							<th>Detail</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$count_payout=1;
						if($count_payout>0)
						{
							while($row_payout=mysql_fetch_assoc($res_payout))
							{
							$gross_amount=(($row_payout['quantity']*$row_payout['price'])-(($row_payout['quantity']*$row_payout['price'])*$row_payout['discount']/100)+$row_payout['shipping']+(($row_payout['quantity']*$row_payout['price'])*$row_payout['tax']/100));
						?>
						<tr>
							<td class="center tr_select "><?php echo date('M d,Y',strtotime($row_payout['date']));?></td>
							<td class="sdate center">
								<a href="#"><?php echo get_purchase_section($row_payout['p_id']);?></a>
							</td>
							<td class="sdate center">
								<a href="#"><?php echo showusername($row_payout['user_id']);?></a></td>
							<td class="sdate center"><?php echo $row_payout['pay_mode'];?></td>
							<td class="center" id="shiptrace_<?php echo $row_payout['pd_id']?>">
							<?php 
							if($row_payout['ship_status']==0)
							{
							?>
							
							<select name="shipc_<?php echo $row_payout['pd_id']?>" id="shipc_<?php echo $row_payout['pd_id']?>">
							<option value="UPS">UPS</option>
							<option value="USPS">USPS</option>
							<option value="Fedex">Fedex</option>
							<option value="DHL">DHL</option>
							<option value="Other">Other</option>
							</select>
							<!--<input name="shipc_<?php echo $row_payout['pd_id']?>" id="shipc_<?php echo $row_payout['pd_id']?>" type="text" value="" placeholder="Enter Shipping Carriers">-->
							<input name="ship_<?php echo $row_payout['pd_id']?>" id="ship_<?php echo $row_payout['pd_id']?>" type="text" value="" placeholder='Enter Tracking#'>
							<a href="javascript:void(0)" onClick="shipproduct('<?php echo $row_payout['pd_id']?>','<?php echo $row_payout['p_id']?>')">ship product</a>
							<?php 
							}
							else
							{
							?>
								<span class="badge_style b_high">shipped</span>	</td>
							<?php 
							}
							?>
								<td class="sdate center">$<?php echo $gross_amount;?> USD</td>
								<td class="sdate center"><a href="invoice.php?invoice_no=<?php echo $row_payout['invoice_no'];?>">Detail</a></td>
						  </tr>
						<?php
							}
						}
						?>
						<!--<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<span class="badge_style b_high">shipped</span>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<input name="" type="text" Value='Enter Tracking#'>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<span class="badge_style b_high">shipped</span>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<input name="" type="text" Value='Enter Tracking#'>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>-->
						</tbody>
						<tfoot>
						</tfoot>
						</table>
								
							</div>
						</div>
						<div id="tab2" style="display: none;">
							<div class="post_list">
							<?php
							$sql_paylist="select * from credit_debit where sender_id='$id' and (debit_amt<>0 or debit_amt<>'') and (receive_date between '$sevenday' and '$curdate')  ";
							$res_paylist=mysql_query($sql_paylist);
							?>
								<table class="display" >
						<thead>
						<tr>
						  <th colspan="5" class="center">My Recent Activity last 7 days(<?php echo date('M d,Y',strtotime($sevenday)).' - '.date('M d,Y');?>) </th>
						  </tr>
						<tr>
							<th>Date</th>
							<th>Remark</th>
							<th>Member Id</th>
							
							<th>Debit Amount</th>
							
						  </tr>
						</thead>
						<tbody>
						<?php
						while($row_paylist=mysql_fetch_assoc($res_paylist))
						{
						?>
						<tr>
							<td class="center tr_select "><?php echo date('M d,Y',strtotime($row_paylist['receive_date']));?></td>
							<td class="sdate center"><?php echo $row_paylist['TranDescription'];?> </td>
							<td class="sdate center">
								<a href="#"><?php echo $row_paylist['receiver_id'];?></a></td>
							
								<td class="sdate center">$<?php echo $row_paylist['debit_amt'];?> USD</td>
								
						</tr>
						<?php
						}
						?>
						<!--<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<input name="" type="text" Value='Enter Tracking#'>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<span class="badge_style b_high">shipped</span>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<input name="" type="text" Value='Enter Tracking#'>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>-->
						</tbody>
						<tfoot>
						</tfoot>
						</table>
							</div>
						</div>
						<div id="tab3" style="display: none;">
							<div class="user_list">
								<table class="display" >
						<thead>
						<tr>
						  <th colspan="5" class="center">My Recent Activity last 7 days(<?php echo date('M d,Y').' - '.date('M d,Y',strtotime($sevenday));?>) </th>
						  </tr>
						<tr>
							<th>Date</th>
							<th>Section</th>
							<th>Member Id</th>
							<th>Payment Type</th>
							<th>Order Status/Actions</th>
							<th>Gross</th>
							<th>Detail</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$count_payout=1;
						if($count_payout>0)
						{
							while($row_payout=mysql_fetch_assoc($res_payout1))
							{
							$gross_amount=(($row_payout['quantity']*$row_payout['price'])-(($row_payout['quantity']*$row_payout['price'])*$row_payout['discount']/100)+$row_payout['shipping']+$row_payout['tax']);
						?>
						<tr>
							<td class="center tr_select "><?php echo date('M d,Y',strtotime($row_payout['date']));?></td>
							<td class="sdate center">
								<a href="#"><?php echo get_purchase_section($row_payout['p_id']);?></a>
							</td>
							<td class="sdate center">
								<a href="#"><?php echo showusername($row_payout['seller_id']);?></a></td>
							<td class="sdate center"><?php echo $row_payout['pay_mode'];?></td>
							<td class="center" id="shiptrace_<?php echo $row_payout['pd_id']?>">
							<?php 
							if($row_payout['ship_status']==0)
							{
							?>
							
							<input name="shipc_<?php echo $row_payout['pd_id']?>" id="shipc_<?php echo $row_payout['pd_id']?>" type="text" value="" placeholder="Enter Shipping Carriers">
							<input name="ship_<?php echo $row_payout['pd_id']?>" id="ship_<?php echo $row_payout['pd_id']?>" type="text" value="" placeholder='Enter Tracking#'>
							<a href="javascript:void(0)" onClick="shipproduct('<?php echo $row_payout['pd_id']?>','<?php echo $row_payout['p_id']?>')">ship product</a>
							<?php 
							}
							else
							{
							?>
								<span class="badge_style b_high">shipped</span>	</td>
							<?php 
							}
							?>
								<td class="sdate center">$<?php echo $gross_amount;?> USD</td>
								<td class="sdate center"><a href="invoice.php?invoice_no=<?php echo $row_payout['invoice_no'];?>">Detail</a></td>
						  </tr>
						<?php
							}
						}
						?>
						<!--<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<span class="badge_style b_high">shipped</span>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<input name="" type="text" Value='Enter Tracking#'>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<span class="badge_style b_high">shipped</span>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>
						<tr>
							<td class="center tr_select ">Jul 2,2013 </td>
							<td class="sdate center">
								<a href="#">Daily Deal</a>						  </td>
							<td class="sdate center">
								<a href="#">Vanle</a></td>
							<td class="sdate center">Visa</td>
							<td class="center">
								<input name="" type="text" Value='Enter Tracking#'>	</td>
								<td class="sdate center">$50.00 USD</td>
								<td class="sdate center"><a href="#">Detail</a></td>
						  </tr>-->
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
				</div>
			</div>
			<span class="clear"></span><span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>
<script language="javascript">
function shipproduct(pd_id,p_id)
{
	var track_no=$('#ship_'+pd_id).val();
	var shipc=$('#shipc_'+pd_id).val();
	if(shipc=='')
	{
		alert("Please Enter Shipping Carriers Info");
		$('#shipc_'+pd_id).focus();
		return false;
	}
	if(track_no=='')
	{
		alert("Please Enter Tracking Number");
		$('#ship_'+pd_id).focus();
		return false;
	}
	var urldata="pd_id="+pd_id+"&track_no="+track_no+"&p_id="+p_id+"&shipc="+shipc;
             $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_ship_tracking.php",
                data: urldata,
                success: function(html) {
                    //alert(html);
					if(html=='yes')
					{
						$('#shiptrace_'+pd_id).html('<span class="badge_style b_high">shipped</span>');
						return false;
					}
					else
					{
						return false;	
					}
                }
            });
}
</script>