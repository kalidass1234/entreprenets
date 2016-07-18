<?php
include("header.php");
include("pagination.php");

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
?>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <?php include("nav.php");?>
    <!-- Sidebar ends -->

  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left">Dashboard</h2>
        <div class="pull-right">
           <div id="reportrange" class="pull-right">
              <i class="fa fa-calendar"></i>
              <span></span> <b class="caret"></b>
           </div>
        </div>
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Dashboard</a>
        </div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">
         <div class="row">
         
            
              
              
          </div>
        <div class="row">  <div class="printer">
        
        
       
                       
                       <img src="../images/print.png"  onClick="printDiv('example');">
                       
                       
                      <script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>

        
      </div></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Invoice for Monthly bill</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content" id="example">

                   <div class="grid_12">
                     <div class="widget_wrap">
                       <div class="widget_top"> <span class="h_icon list"></span>
                         <h6></h6>
                       </div>
                       <div class="widget_content">
                         <div class=" page_content">
                           <div class="invoice_container">
                             <!--<div class="invoice_action_bar">
                               <?php //if($show_status=='Pending')
								//{
									?>
                               <div class="btn_30_light"> <a href="../ewallet.php?invoice_no=<?=$invoice?>">Pay Now</a> </div>
                               <?php
								//}
								?>
                               <div class="btn_30_light"> <a href="purchase_order.php" title="Back"><span class="icon zone_money_co"></span></a> </div>
                               <div class="btn_30_light"> <a href="invoice_details.php?invoice_no=<?=$invoice; ?>" target="_blank" title="Print"><span class="icon printer_co"></span></a> </div>
                               <div class="btn_30_light"> <a href="invo_detail_down.php?invoice_no=<?=$invoice; ?>" title="Download .doc"><span class="icon drive_disk_co"></span></a> </div>
                             </div>-->
                             <div class="grid_6 invoice_num"> <span>Invoice# <?php echo $invoice;?>&nbsp;&nbsp;<font color="#0099FF"><?php echo $show_status;?></font></span> </div>
                             <div class="grid_6 invoice_date"> Date: <?php echo date('d-M-Y',strtotime(invoice_date($invoice)));?> </div>
                             <span class="clear"></span>
                             <div class="grid_12 invoice_title">
                               <h5>
                                 <!--Invoice Title or Subject-->
                                 DELIVERY ORDER / INVOICE </h5>
                             </div>
                             <div class="grid_6 invoice_to">
                               <ul>
                                 <li> <strong><span>From</span></strong> <span>The Grenature</span> <span>145-157 ST JOHN STREET</span> <span>LONDON ENGLAND EC1V 4PW.</span> <span>Tel : +44 (0) 7450874013 </span> <span>Email: info@grenature.com</span> </li>
                               </ul>
                             </div>
                             <div class="grid_6 invoice_from">
                               <ul>
                                 <li> <strong><span>To</span></strong> <span><?php echo $fetchusr2['first_name'].' '.$fetchusr2['mid_name'].' '.$fetchusr2['last_name'];?></span> <span><?php echo $fetchusr2['address1'];?></span> <span><?php echo $fetchusr2['city'].', '.$fetchusr2['state'].', '.$fetchusr2['country'];?></span> <span><?php echo $fetchusr2['zip'];?></span> </li>
                               </ul>
                             </div>
                             <span class="clear"></span>
                             <div class="grid_12 invoice_details">
                               <div class="invoice_tbl">
                                 <table class="table table-striped table-bordered table-hover">
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
                             <!--  <p class="amount_word"> Amounts in word: <span><?php //echo convertNumber($tot-$totaldiscount+$totalshipping+$totaltax);?> <?php //echo CURRENCY_NAME;?> Only.</span> </p>-->
                               <p class="amount_word"> Mode: <span>
                                 <?php if($fetchpur2['pay_mode']=='credit')
									{echo ucwords($fetchpur2['pay_mode'])." CARD";} else {echo ucwords($fetchpur2['pay_mode']);}?>
                               </span> </p>
                               <?php 
									if($fetchpur2['pay_mode']=='credit')
									{
									$sql="select card_name,card_no,expiry_month_year,cvs_no from amount_detail where invoice_no='$invoice'";
									$res=mysql_query($sql);
									$row=mysql_fetch_assoc($res);
									?>
                               <blockquote class="quote_blue">
                                 <p> Cardholder's Name:<?php echo $row['card_name'];?> &nbsp;&nbsp;,
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
                             <span class="clear"></span> </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <!-- <div class="export padding-space"><a href="#">Export in excel</a></div>-->
                    <div class="widget-foot">
                     <?php //echo pagination($url,$parameters,$pages,$current_page);?>
                      <!--  <ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>
                     -->
                      <div class="clearfix"></div> 
                    </div>
                  </div>
                </div>
        </div>
		<!-- Matter ends -->
    </div>
    </div>
    </div>
    </div>
    <style>
	.invoice_container {
	margin:20px 0;
	position:relative;
}
.invoice_num {
	font-size:18px;
	margin-bottom:30px;
}
.invoice_num span {
	border:#ddd 1px solid;
	background:#fff;
	-moz-border-radius : 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	padding:10px;
	display:block;
}
.invoice_title {
	margin-bottom:40px;
}
.invoice_details {
	margin-bottom:20px;
	margin-top:20px;
}
.invoice_details table {
	width:100%;
}
.invoice_details table {
	border-left:#ccc 1px solid;
	border-right:#ccc 1px solid;
	border-bottom:#ccc 1px solid;
}
.invoice_details table thead tr {
	border-top:#ccc 1px solid;
	border-bottom:#999 1px solid;
}
.invoice_details table thead tr th {
	padding:10px;
	color:#000;
	box-shadow:
 0px 0px 2px rgba(000, 000, 000, 0.2), inset 0 1px 1px -1px #fff;
	-moz-box-shadow:
 0px 0px 2px rgba(000, 000, 000, 0.2), inset 0 1px 1px -1px #fff;
	-webkit-box-shadow:
 0px 0px 2px rgba(000, 000, 000, 0.2), inset 0 1px 1px -1px #fff;
	text-shadow:
 0px -1px 0px rgba(255, 255, 255, 1), 0px 1px 0px rgba(255, 255, 255, 0.2);
	border-right:#ccc 1px solid;
}
.invoice_details table tbody tr {
	border-bottom:#ccc 1px solid;
	background:#FFF;
	box-shadow:
 0px 0px 2px rgba(000, 000, 000, 0.2), inset 0 1px 1px -1px #fff;
	-moz-box-shadow:
 0px 0px 2px rgba(000, 000, 000, 0.2), inset 0 1px 1px -1px #fff;
	-webkit-box-shadow:
 0px 0px 2px rgba(000, 000, 000, 0.2), inset 0 1px 1px -1px #fff;
}
.invoice_details table tbody tr td {
	padding:7px 10px;
	border-right:#ccc 1px solid;
	text-align:center;
}
.invoice_details table tbody tr:last-child {
	border-bottom:none;
}
.invoice_details table .left_align {
	text-align:left;
}
.amount_word {
	font-size:13px;
	color:#333;
	margin-top:20px;
}
.amount_word span {
	font-weight:bold;
	color:#06C;
	text-transform:uppercase;
}
.invoice_container .notes {
	color:#C30;
	font-weight:bold;
	font-size:13px;
}
.grand_total {
	font-weight:bold;
	text-align:right !important;
}
.invoice_container .invoice_action_bar {
	position:absolute;
	top:0px;
	right:10px;
	z-index:9000;
}
.invoice_to li span, .invoice_from li span {
	display:block;
	line-height:18px;
}
.invoice_date {
	padding-top:10px;
	font-size:13px;
}
</style>
   <!-- Mainbar ends -->
<!-- Content ends -->
<!-- Footer starts -->
<?php
include("footer.php");
?>