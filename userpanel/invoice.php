<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$invoice=$_GET['invoice_no'];
	$sltpur2=mysql_query("select * from purchase_detail where invoice_no='$invoice' limit 1");
	$fetchpur2=mysql_fetch_assoc($sltpur2);
	$userid=$fetchpur2['user_id'];
	$arr_status=array('Pending','Paid','Shipped','Cancaeled');
	$show_status=$arr_status[$fetchpur2['status']];
	//echo "select * from purchase_detail  where  invoice_no='$invoice'";
	$sltpur=mysql_query("select * from purchase_detail  where  invoice_no='$invoice'");
	$shipType=mysql_query("select shipping_address_type from amount_detail where invoice_no='$invoice'") or die(mysql_error());
	$rowType=mysql_fetch_assoc($shipType);
	if($rowType['shipping_address_type']=='same' || $rowType['shipping_address_type']=='')
	{
	$sltusr=mysql_query("select * from registration where user_id='$userid'");
	}
	elseif($rowType['shipping_address_type']=='diff')
	{
		$sltusr=mysql_query("select * from shipping_address where user_id='$userid'");
	}
	$fetchusr2=mysql_fetch_assoc($sltusr);
	
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
<title>Welcome To Grenature</title>
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
<style>
/******************************
create 25 by 25 multi boxes
******************************/
.boxs
{
	margin:0px 5px;
	float:left;
	height:25px;
	width:25px;
	border:1px solid #000;
	border-radius:3px;
	display:inline-block;
	margin-bottom:10px;
	cursor:pointer;
}
.clear-fix
{
	clear:both;
	overflow:hidden;
}
</style>
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
		<span class="title_icon"><span class="money_2"></span></span>
		<h3>Invoice Detail</h3>
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
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Invoice for Monthly bill</h6>
					</div>
					<div class="widget_content">
						<div class=" page_content">
							<div class="invoice_container">
								<div class="invoice_action_bar">
                                <?php if($show_status=='Pending')
								{
									?>
                                <div class="btn_30_light">
                                
										 <a href="../ewallet.php?invoice_no=<?=$invoice?>">Pay Now</a>
									</div>
                                <?php
								}
								?>
									<div class="btn_30_light">
                                   
										<a href="purchase_order.php" title="Back"><span class="icon zone_money_co"></span></a>
									</div>
                                    
                                    
                                    
                                    
									<div class="btn_30_light">
										<a href="invoice_details.php?invoice_no=<?=$invoice; ?>" target="_blank" title="Print"><span class="icon printer_co"></span></a>
									</div>
									<div class="btn_30_light">
										<a href="invo_detail_down.php?invoice_no=<?=$invoice; ?>" title="Download .doc"><span class="icon drive_disk_co"></span></a>
									</div>
								</div>
								<div class="grid_6 invoice_num">
									<span>Invoice# <?php echo $invoice;?>&nbsp;&nbsp;<font color="#0099FF"><?php echo $show_status;?></font></span>
								</div>
								<div class="grid_6 invoice_date">
									Date: <?php echo date('d-M-Y',strtotime(invoice_date($invoice)));?>
								</div>
								<span class="clear"></span>
								<div class="grid_12 invoice_title">
									<h5><!--Invoice Title or Subject-->DELIVERY ORDER / INVOICE  </h5>
								</div>
								<div class="grid_6 invoice_to">
									<ul>
										<li>
										<strong><span>From</span></strong>
										
										<span>The Grenature</span>
										<span>145-157 ST JOHN STREET</span>
										<span>LONDON ENGLAND EC1V 4PW.</span>
										<span>Tel : +44 (0) 7450874013  </span>
										<span>Email: info@grenature.com</span>
										</li>
									</ul>
								</div>
								<div class="grid_6 invoice_from">
									<ul>
										<li>
										<strong><span>To</span></strong>
										<span><?php echo $fetchusr2['first_name'].' '.$fetchusr2['mid_name'].' '.$fetchusr2['last_name'];?></span>
										<span><?php echo $fetchusr2['address1'];?></span>
										<span><?php echo $fetchusr2['city'].', '.$fetchusr2['state'].', '.$fetchusr2['country'];?></span>
										<span><?php echo $fetchusr2['zip'];?></span>
										</li>
									</ul>
								</div>
								<span class="clear"></span>
								<div class="grid_12 invoice_details">
									<div class="invoice_tbl">
										<table>
										<thead>
										<tr class=" gray_sai">
											<th>
												SI#
											</th>
											<th>
												Product ID
											</th>
											<th>
												Product
											</th>
											<th>
												Image
											</th>
                                           
											<th>
												Qty
											</th>
                                            <!--<th>
												Product Size
											</th>-->
											<th>
												Unit Price
											</th>
											<th>
												Total
											</th>
										</tr>
										</thead>
										<tbody>
										<?php 
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
											<td>
												<?php echo $count;?>
											</td>
											<td>
												<?php echo $pro;?>
											</td>
											<td>
												<?php echo $res['product_name'];?>
											</td>
                                            <td>
												<img src="../product_logos/<?php echo $res['image'];?>" width="40" height="40">
											</td>
                                            
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
											<td>
												<?php echo $h['quantity'];?>
											</td>
                                           <!-- <td>
												<?php echo $h['product_size'];?>
											</td>-->
											<td>
												<?php echo CURRENCY.' '.$price;?>
											</td>
											<td>
												<?php echo CURRENCY.' '.$tp;?>
											</td>
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
											<td colspan="6" class="grand_total">
												 Total:
											</td>
											<td>
												<?php echo CURRENCY.' '.$tot;?>
											</td>
										</tr>
										<tr>
											<td colspan="6" class="grand_total">
												Shipping:
											</td>
											<td>
												<?php //echo CURRENCY.' '.$totalshipping;?>
                                                <?php echo CURRENCY.' '.$ship_price;?>
											</td>
										</tr>
										
										<tr>
											<td colspan="6" class="grand_total">
												Tax:
											</td>
											<td>
												<?php echo CURRENCY.' '.round($totaltax,2);?>
											</td>
										</tr>
										<tr>
											<td colspan="6" class="grand_total">
												Discount:
											</td>
											<td>
												<?php echo CURRENCY.' '.$totaldiscount;?>
											</td>
										</tr>
										<tr>
											<td colspan="6" class="grand_total">
												Grand Total:
											</td>
											<td>
												<?php echo CURRENCY.' '.round(($tot-$totaldiscount+$ship_price+$totaltax),2);?>
											</td>
										</tr>
										</tbody>
										</table>
									</div>
									<p class="amount_word">
										Amounts in word: <span><?php echo convertNumber($tot-$totaldiscount+$totalshipping+$totaltax);?> <?php echo CURRENCY_NAME;?> Only.</span>
									</p>
									<p class="amount_word">
										Mode: <span><?php if($fetchpur2['pay_mode']=='credit')
									{echo ucwords($fetchpur2['pay_mode'])." CARD";} else {echo ucwords($fetchpur2['pay_mode']);}?></span>
									</p>
									<?php 
									if($fetchpur2['pay_mode']=='credit')
									{
									$sql="select card_name,card_no,expiry_month_year,cvs_no from amount_detail where invoice_no='$invoice'";
									$res=mysql_query($sql);
									$row=mysql_fetch_assoc($res);
									?>
									<blockquote class="quote_blue">
										<p>
										Cardholder's Name:<?php echo $row['card_name'];?> &nbsp;&nbsp;,
										Card Number:<?php echo $row['card_no'];?> &nbsp;&nbsp;,
										Expiry Date:<?php echo $row['expiry_month_year'];?> &nbsp;&nbsp;,
										CVV No:<?php echo $row['cvs_no'];?>
											<!--Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.-->
										</p>
									</blockquote>
									<?php
									}
									?>
									<!--<h5 class="notes">Notes:</h5>
									<p>
										Etiam convallis sodales elementum. Suspendisse interdum, nisi vitae pellentesque eleifend, justo nulla dictum lectus, consectetur elementum metus turpis quis mi. Integer non ante vel magna elementum aliquam. Aenean turpis turpis, porttitor eget ultrices quis, ornare eu sem. Duis luctus augue at nunc pharetra ac tristique diam fermentum. Aliquam lacinia neque in quam tincidunt bibendum non id libero.
									</p>-->
								</div>
								<span class="clear"></span>
							</div>
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
<?php
function convertNumber($num)  
{  
   list($num, $dec) = explode(".", $num);  
  
   $output = "";  
  
   if($num{0} == "-")  
   {  
      $output = "negative ";  
      $num = ltrim($num, "-");  
   }  
   else if($num{0} == "+")  
   {  
      $output = "positive ";  
      $num = ltrim($num, "+");  
   }  
  
   if($num{0} == "0")  
   {  
      $output .= "zero";  
   }  
   else  
   {  
      $num = str_pad($num, 36, "0", STR_PAD_LEFT);  
      $group = rtrim(chunk_split($num, 3, " "), " ");  
      $groups = explode(" ", $group);  
  
      $groups2 = array();  
      foreach($groups as $g) $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});  
  
      for($z = 0; $z < count($groups2); $z++)  
      {  
         if($groups2[$z] != "")  
         {  
            $output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))  
             && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");  
         }  
      }  
  
      $output = rtrim($output, ", ");  
   }  
  
   if($dec > 0)  
   {  
      $output .= " point";  
      for($i = 0; $i < strlen($dec); $i++) $output .= " ".convertDigit($dec{$i});  
   }  
  
   return $output;  
}

function convertGroup($index)  
{  
   switch($index)  
   {  
      case 11: return " decillion";  
      case 10: return " nonillion";  
      case 9: return " octillion";  
      case 8: return " septillion";  
      case 7: return " sextillion";  
      case 6: return " quintrillion";  
      case 5: return " quadrillion";  
      case 4: return " trillion";  
      case 3: return " billion";  
      case 2: return " million";  
      case 1: return " thousand";  
      case 0: return "";  
   }  
}  
  
function convertThreeDigit($dig1, $dig2, $dig3)  
{  
   $output = "";  
  
   if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";  
  
   if($dig1 != "0")  
   {  
      $output .= convertDigit($dig1)." hundred";  
      if($dig2 != "0" || $dig3 != "0") $output .= " and ";  
   }  
  
   if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);  
   else if($dig3 != "0") $output .= convertDigit($dig3);  
  
   return $output;  
}  
  
function convertTwoDigit($dig1, $dig2)  
{  
   if($dig2 == "0")  
   {  
      switch($dig1)  
      {  
         case "1": return "ten";  
         case "2": return "twenty";  
         case "3": return "thirty";  
         case "4": return "forty";  
         case "5": return "fifty";  
         case "6": return "sixty";  
         case "7": return "seventy";  
         case "8": return "eighty";  
         case "9": return "ninety";  
      }  
   }  
   else if($dig1 == "1")  
   {  
      switch($dig2)  
      {  
         case "1": return "eleven";  
         case "2": return "twelve";  
         case "3": return "thirteen";  
         case "4": return "fourteen";  
         case "5": return "fifteen";  
         case "6": return "sixteen";  
         case "7": return "seventeen";  
         case "8": return "eighteen";  
         case "9": return "nineteen";  
      }  
   }  
   else  
   {  
      $temp = convertDigit($dig2);  
      switch($dig1)  
      {  
         case "2": return "twenty-$temp";  
         case "3": return "thirty-$temp";  
         case "4": return "forty-$temp";  
         case "5": return "fifty-$temp";  
         case "6": return "sixty-$temp";  
         case "7": return "seventy-$temp";  
         case "8": return "eighty-$temp";  
         case "9": return "ninety-$temp";  
      }  
   }  
}  
  
function convertDigit($digit)  
{  
   switch($digit)  
   {  
      case "0": return "zero";  
      case "1": return "one";  
      case "2": return "two";  
      case "3": return "three";  
      case "4": return "four";  
      case "5": return "five";  
      case "6": return "six";  
      case "7": return "seven";  
      case "8": return "eight";  
      case "9": return "nine";  
   }  
}   
?>