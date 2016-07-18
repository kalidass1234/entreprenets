<?php 
include("../includes/all_func.php");

include_once ("header.php"); 
if(!isset($_SESSION['SD_User_Name']))
{
 header('location:../index.php');
}
//unset($_SESSION['product_category']);
//print_r($_SESSION); 
 $p=$_SESSION['product_name'];
$q=$_SESSION['quantity'];
//$p_cat=$_SESSION['product_category'];
if($p!='')
 $product=explode(",",$p);
else $product=$p;

if($q!='')
$quntity=explode(",",$q);
else
$quntity=$q;
/*if($p_cat!='')
$product_category=explode(",",$p_cat);
else
$product_category=$p_cat;*/
?>

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
<?php include('left-bar.php');?>
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
		<h3>E-Shop</h3>
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
            <div class="grid_12">
		  <div class="widget_wrap tabby">
					<div class="widget_top">
						
						<h6>My Current Cart</h6>
						
					</div>
					<div class="widget_content">
					<div>
						
					</div>
						<div id="tab2">
							<div class="widget_content">
						
						<table class="display ">
						<thead>
						<tr>
							
							<th>
								 Sr. No.</th>
                                   <th>&nbsp; </th>
							<th>
							  Logo
						  </th>
							
							<th>
							  Name Of Product
						  </th>
							<th>Quantity</th>
							<th>Unit Price </th>
							<!--<th>
							  Total BV 
						  </th>-->
							<th>
							  Total Price 
							</th>
						</tr>
						</thead>
						<tbody>
						<?php //print_r($product);
						$z=count($product);
						  
						$sr=1;
						if($product!='')	 {
						for($i=0; $i<$z; $i++)
						{ 
						 $pro=$product[$i];
						 $qun=$quntity[$i];
						 $cat_id=$product_category[$i];
						 $sql_pro="select * from product_category pn WHERE pn.p_cat_id='{$pro}'";
						  $res_pro=mysql_query($sql_pro);
						 $x1=mysql_fetch_array($res_pro);
						   $total_cost= $x1['cost_price']*$qun;
							$shipping+=$x1['shipping'];
			 			 ?>
							<tr>
                                  
                                  
                                  <td align="center" class="ptext"><?php echo $sr?></td>
                                   <td width="20%" align="center" bordercolor="#333333" bgcolor="#EEEEEE" class="border_dotted"><a href="new_cart.php?del=1&p_cat_id=<? echo $res[p_cat_id];?>&quantity=<? echo $qun;?>&p_cat_id=<? echo $res[p_cat_id];?>&keyv=<?php echo $i;?>"><img src="images/delete.png"></a></td>
                                  <td align="center" class="ptext"><img src="../product_logos/<?php echo $x1['image']?>" width="100" height="100" alt=""></td>
                                  <td align="center" class="ptext"><?php echo $x1['product_name'] ?></td>
                                  <td align="center" class="ptext"><?php echo $qun?></td>
                                  <td align="center" class="ptext">$<?php echo $x1['cost_price']?></td>
                                  <!--<td align="center" class="ptext"><?php echo $x1['business_volume']*$qun; ?></td>-->
								  <td align="center" class="ptext">$<?php echo $total_cost ?></td>
                                </tr>
                                <?php
							$sr++;	
							$total_amount+=$total_cost;
							}
						}
							   $_SESSION['total_amount_now']=$total_amount;
							   $_SESSION['shipping']=$shipping;
								?>
						
						</tbody>
						<tfoot>
						<tr>  <th>&nbsp;</th>
                         <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        <th ><a href="eshop.php">
                <input type="submit" name="submit" value="Continue Shopping"   class="btn_small btn_blue"/>
              </a></th>
               <th>&nbsp;</th>
              <th><a href="product_invoice.php" >
                <input type="submit" name="submit" value="Check Out" class="btn_small btn_blue"/>
              </a></th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
						</tfoot>
						</table>
					</div>
						</div>
						
						
					</div>
				</div>
			</div>
	  
          </div>
        </div>
      <span class="clear"></span></div>
	  <span class="clear"></span> </div>
	  
	  
</div>
</body>
</html>