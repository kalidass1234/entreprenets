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
$bonus=$row_user['bonus'];
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
 
 
 if(isset($_POST['update']))
 {
 //print_r($_POST);
 $plan=$_POST['plan'];
 foreach($_POST['qty'] as $key => $value)
 {
 $aqry=mysql_fetch_assoc(mysql_query("select * from amount_detail where invoice_no='".$_POST['invoice']."'"));
 $pqry=mysql_query("select * from purchase_detail where p_id='$key' and invoice_no='".$_POST['invoice']."'");
 $prow=mysql_fetch_assoc($pqry);
 $p_volume=$prow['product_volume'];
 $p_price=$prow['price'];
 $invoice_bv=$value*$p_volume;
 $total_bv += $invoice_bv;
 $price=$value*$p_price;
 $total_price +=$price;
 mysql_query("update purchase_detail set quantity='$value',plan='$plan',invoice_bv='$invoice_bv',autoship_status='".$_POST['auto_ship']."' where p_id='$key' and invoice_no='".$_POST['invoice']."'");
 }
 $final_price=$total_price+$aqry['shipping_price'];
 
  mysql_query("update amount_detail set net_amount='$final_price',plan='$plan', total_amount='$final_price', total_bv='$total_bv', autoship_status='".$_POST['auto_ship']."' where invoice_no='".$_POST['invoice']."'");

 }
 
 
 
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
          

			  <div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Edit Auto Ship Detail
                         </h6>
				  </div>
					<div class="widget_content" >
						<!--<h3>Content Table</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>-->
						<form name="form1" action="" method="post" class="form_container left_label">
                        <input type="hidden" name="invoice" value="<?php echo $_GET['invoice_no']; ?>">
                        <ul>
                        <?php
                        $invoice=$_GET['invoice_no'];
  $pur_det=mysql_query("select * from purchase_detail  where  invoice_no='$invoice'");
                        while($r=mysql_fetch_array($pur_det))
									{
									
										$pid=$r['p_id'];
										$qunt=$r['quantity'];
                                        $plan=$r['plan'];
										$autoship_status=$r['autoship_status'];
										$psql=mysql_query("SELECT product_name FROM product_category where p_cat_id='$pid' ");
										$pres=mysql_fetch_array($psql);
                                        ?>
 <li>
								<div class="form_grid_12">
									<label class="field_title"><?php echo $pres['product_name']; ?> </label>
									<div class="form_input">
										<input type="text" name="qty[<?php echo $pid; ?>]" value="<?php echo $qunt; ?>">
									</div>
								</div>
								</li>
  <?php
  }
  ?>
  
 <li>
								<div class="form_grid_12">
									<label class="field_title">Status</label>
									<div class="form_input">
										<input type="radio" name="autoship_status" value="0" <?php if($autoship_status==0) echo "checked"; ?> >Active 
                                        <input type="radio" name="autoship_status" value="1" <?php if($autoship_status==1) echo "checked"; ?> >Inactive
									</div>
								</div>
								</li>
								
			<li>
            
           <!-- <li>
								<div class="form_grid_12">
									<label class="field_title">Plan</label>
									<div class="form_input">
										<input type="radio" name="plan" value="binary_plan" <?php //if($plan=='binary_plan') echo "checked"; ?> >Binary Plan
                                        <input type="radio" name="plan" value="monthly_plan" <?php //if($plan=='monthly_plan') echo "checked"; ?> >Monthly Plan
									</div>
								</div>
								</li>-->
								
								
			<li>
								<div class="form_grid_12">
									<label class="field_title"></label>
									<div class="form_input">
										<input type="submit" name="update" value="Edit" class="btn_small btn_gray">
									</div>
								</div>
								</li>					
  
 
</ul>
</form>
                        
                        
                        
						<div class="grid_12 invoice_details">
						  <div class="invoice_tbl">
						    <table class="display data_tbl" >
						      <thead>
						        <tr class=" gray_sai">
						          <th> SI# </th>
						          <th> Product ID </th>
						          <th> Product </th>
						          <th> Image </th>
						          <th> Qty </th>
						          <!--<th>
												Product Size
											</th>-->
						          <th> Unit Price </th>
						          <th> Total </th>
					            </tr>
					          </thead>
						      <tbody>
						        <?php 
                               $invoice=$_GET['invoice_no'];
  $sltpur=mysql_query("select * from purchase_detail  where  invoice_no='$invoice'");
										$tweight=0;
									$tot=0;
									$count=1;
									$overall_tax=0;
									$totaldiscount=0;
									while($h=mysql_fetch_array($sltpur))
									{
									//print_r($h);exit;
										$pro=$h['p_id'];
										$qun=$h['quantity'];
										//echo "SELECT * FROM products where p_id='$pro' ";
										$sql=mysql_query("SELECT * FROM product_category where p_cat_id='$pro' ");
										$res=mysql_fetch_array($sql);
										
										//$overall_tax+=$h['tax'];
										
										//$tweight+=$h[weight];
										
											$price=$h['price'];
											$discount=$h[discount];
										
										$tax=0;
										$tax=$h['tax'];
										
										$tp=$price*$h[quantity];
										//$discount=$h[discount];
										$totalshipping+=$h[shipping];
										//echo $totalshipping.'=='.$h[shipping]."<br>";
										 //$tottax=$tp*$tax/100;
										$tottax=$tax;
				  						$applytax+= $tottax;
										
										if($h['section'])
										{
											$src="../$h[section]/product.php?pid=".$res['p_cat_id'];
										}
										
										$color=$h['color'];
										$color_qty=$h['color_qty'];
										
										
										
										$qry=mysql_query("select * from shipping") or die(mysql_error());
			$ship=mysql_fetch_assoc($qry);
			//echo $n=mysql_num_rows($qry);
			if($ship['from_product']==1)
			{
			 $ship_price=$ship_price+$res['shipping'];
			}
			elseif($ship['status']==1)
			{
			if($ship['type']=='price')
			{
				$ship_price=$ship['price'];
			}
			else
			{
				$ship_price=($total*$ship['percentage'])/100;

			}
			}
			elseif($ship['from_api'])
			{
			}
										?>
						        <tr>
						          <td><?php echo $count;?></td>
						          <td><?php echo $pro;?></td>
						          <td><?php echo $res['product_name'];?></td>
						          <td><img src="../product_logos/<?php echo $res['image'];?>" width="40" height="40"></td>
						          <!--<td class="left_align">
                                            <?php 
											if($color!='')
											{
											$arr_color=explode(",",$color);
											$arr_color_qty=explode(",",$color_qty);
											for($i=0;$i<count($arr_color);$i++)
											{
											?>
                                            <span>
                                             <div class="boxs"  style="background-color:<?php echo $arr_color[$i];?>;" ></div>
                                             <?php echo "<strong>Qty</strong>:".$arr_color_qty[$i];?>
                                             </span>
												<?php 
												}
												}
												else
												{
												echo "No Specify Color";
												}
												//echo "Color:".$color." Qty:".$color_qty;?>
											</td>-->
						          <td><?php echo $h['quantity'];?></td>
						          <!-- <td>
												<?php echo $h['product_size'];?>
											</td>-->
						          <td><?php echo CURRENCY.' '.$price;?></td>
						          <td><?php echo CURRENCY.' '.$tp;?></td>
					            </tr>
						        <?php
										$tot+=$tp;
										$totaldiscount+=$discount;
										$count++;
									}
									//$totaldiscount=$tot*$discount/100;
									/*$sqltax="select tax from tax where status='1'";
									$restax=mysql_query($sqltax);
									$rowtax=mysql_fetch_assoc($restax);
									$tax=$rowtax['tax'];  
									$totaltax=$tot*$tax/100; */ 
									$totaltax=$applytax; 
										?>
						        <tr>
						          <td colspan="6" class="grand_total"> Total: </td>
						          <td><?php echo CURRENCY.' '.$tot;?></td>
					            </tr>
						        <tr>
						          <td colspan="6" class="grand_total"> Shipping: </td>
						          <td><?php //echo CURRENCY.' '.$totalshipping;?>
						            <?php echo CURRENCY.' '.$ship_price;?></td>
					            </tr>
						        <tr>
						          <td colspan="6" class="grand_total"> Tax: </td>
						          <td><?php echo CURRENCY.' '.round($totaltax,2);?></td>
					            </tr>
						        <tr>
						          <td colspan="6" class="grand_total"> Discount: </td>
						          <td><?php echo CURRENCY.' '.$totaldiscount;?></td>
					            </tr>
						        <tr>
						          <td colspan="6" class="grand_total"> Grand Total: </td>
						          <td><?php echo CURRENCY.' '.round(($tot-$totaldiscount+$ship_price+$totaltax),2);?></td>
					            </tr>
                                
                                
                                
                                
                                
					          </tbody>
					        </table>
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