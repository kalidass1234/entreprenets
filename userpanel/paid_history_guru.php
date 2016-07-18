<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$id=showuserid($_SESSION['SD_User_Name']);

$sql_user="select * from registration where user_id='$id'";
$res_user=mysql_query($sql_user);
$row_user=mysql_fetch_assoc($res_user);
$ref_id=$row_user['ref_id'];
$reg_date=$row_user['reg_date'];
$category_one=$row_user['category_one'];
$category_two=$row_user['category_two'];
$category_three=$row_user['category_three'];
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
		<h3>Dashboard</h3>
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
		<div class="grid_container"><span class="clear"></span>
		  <div class="grid_12">
          <h6 align="center" style="color:#0033FF">
          <p style="text-align:left; overflow:hidden;">
          <img src="userimages/<?php echo $row_ref['image'];?>" width="100" style="float:left; border:2px solid #e1e1e1; border-radius:5px; margin:0 10px 0 0" height="100">  
		  
		  <strong>Sponser:</strong> <?php echo $row_ref['user_name'];?><br><br>
          
          <strong>Status:</strong><?php if($row_ref['user_name']){ echo "Active";}else{ echo "Inactive";}?>
          <br><br>
          
          <strong>UserId:</strong><?php echo $id;?>
          </p>
          
          </h6>
         
			  <div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Gurus recruiter History</h6>
                         <div id="widget_tab">
							<ul>
								<li><a href="paid_history_bonus.php" >Residual/Bonus History</a></li>
								<li><a href="paid_history_ref.php" >Affiliate History</a></li>
                               <?php if(showuserid($_SESSION['SD_User_Name'])==1234567){?>
                               <li><a href="paid_history_guru.php" class="active_tab">Gurus History</a></li>
							   <?php }?>	
							</ul>
						</div>
				  </div>
                   <div class="widget_content">
                  <form action="" method="post">
				<ul id="search_box">
					<li>
                    <?php 
					$yy=date('Y');
					?>
					<select name="year">
                    
                    <option value="<?php echo $yy;?>"><?php echo $yy;?></option>
                    </select>
					</li>
                    <li>
                    <?php 
					$arr_months=array('','January','February','March','April','May','June','July','August','September','October','November','December');
					?>
					<select name="months">
                    <?php for($m=1;$m<count($arr_months);$m++){?>
                    <option value="<?php echo $m;?>"><?php echo $arr_months[$m];?></option>
                    <?php }?>
                    </select>
					</li>
					<li>
                    <button type="submit" name="submit" class="btn_small btn_blue">Search</button>
					<!--<input name="" type="submit" value="" class="search_btn">-->
					</li>
				</ul>
			</form>
                  </div>
					<div class="widget_content">
						<!--<h3>Content Table</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>-->
<?php
if(showuserid($_SESSION['SD_User_Name'])==1234567)
{
							$arr_status=array("Pending","Approved");
							$arr_section=array("market_place"=>"Market Place","daily_deal"=>"Daily Deal","gift_card"=>"Gift Card","coupon"=>"Coupon","merchant_circle"=>"Merchant Circle");
if(isset($_POST['submit']) && $_POST['year']!='')
{
	$year=$_POST['year'];
	$months=$_POST['months'];
	$from_date=date("$year-$months-01");
	$end_date=date("$year-$months-t");
}
else
{
	$from_date=date("Y-m-01");
	$end_date=date("Y-m-t");
}							
							//$sql="select * from level_income where income_id='$id' and level<>0 order by l_id desc";
$sql="SELECT invoice_amt, commission, purcheser_id, remark, level, invoice_amt,status , paid_status, ts,date,user_level,payout_date FROM `level_income_admin` WHERE income_id = 'guru' AND level <>0 and status=2 and paid_status=2 and (`date` between '$from_date' and '$end_date') ORDER BY `ts` DESC";
$res=mysql_query($sql);
?>
						<table class="display data_tbl" >
						<thead>
						<tr>
							<th>S.No</th>
							<th>Date </th>
                            <th>Paid Date </th>
							<th>Down MemberId</th>
							<th>Down Member Name</th>
							<th>Description</th>
							<th>User Level</th>
							
							<th>Bonus</th>
							<th>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$ii=1;
						while($row=mysql_fetch_assoc($res))
						{
						$tot+=$row['invoice_amt'];
						$totc+=$row['commission'];
						?>
						<tr>
						<td class="center">
								<?php echo $ii;?> 
						  </td>
						<td class="center">
								<?php echo date('m/d/Y',strtotime($row['date']));?>
						  </td>
                          <td class="center">
								<?php echo date('m/d/Y',strtotime($row['payout_date']));?>
						  </td> 
						<td class="center">
								<?php echo $row['purcheser_id'];?> 
						  </td>
						<td class="center">
								<?php echo showusername($row['purcheser_id']);?> 
						</td>
						  <td class="center">
								<?php echo wordwrap($row['remark'],25,"<br>\n");?>
						  </td>
						  <td class="center">
								<?php echo $row['user_level'];?>
						  </td>
				<td class="center">$<?php echo $row['commission'];?></td>
                <td class="center"><?php if($row['status']==2 && $row['paid_status']==2) echo "Paid"; else if($row['paid_status']==4) echo "Cancel"; else echo "Unpaid";?></td>
						</tr>
						<?php
						$ii++;
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>Total</th>
							<th>&nbsp;</th>
							<th>$<?php echo $totc;?></th>
							<th>&nbsp;</th>
						</tr>
						</tfoot>
						</table>
 <?php
 }
 else
 {
 	echo "You  are not authorize to access this section.";
 }
 ?>                       
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