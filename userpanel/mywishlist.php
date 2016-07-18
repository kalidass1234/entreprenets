<?php
include('header.php');
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	$s="select user_id,email from registration where user_name='$idd'";
	$ffr=mysql_query($s);
	$f=mysql_fetch_array($ffr);
	$user_id=$f['user_id'];
	
	if($_GET['del']==1 && $_GET['pid'])
	{
		$pid=$_GET['pid'];
		mysql_query("delete from product_wishlist  where id='$pid'");
	}
	if($_GET['del']==2 && $_GET['pid'] && $_GET['auction_id'])
	{
		$pid=$_GET['pid'];
		mysql_query("update product_wishlist set get_notify=1  where id='$pid'");
		if($f['email'])
		{
			$sql_not="select * from penny_auction where id='$_GET[auction_id]'";
			$res_not=mysql_query($sql_not);
			$row_not=mysql_fetch_assoc($res_not);
			if($row_not['status']==1)
			{
				if($row_not['reserve_bid']>0)
				{
					$msg="Countdown Will Start After Reserve Bid Met( When Total Bid upto $row_not[reserve_bid]) and After 5 Minutes Trigger Count Down. ";
				}
				else
				{
					$msg="Countdown Will Start After 24 Hour Countdown Clock Stop. ";
				}
			}
			else if($row_not['status']==2 || $row_not['status']==4)
			{
				$winner_name=showusername($row_not['winner_id']);
				$msg="Auction Won By $winner_name . New Will Comes After 1/2 Hour.";
			}
			else if($row_not['status']==3)
			{
				$msg="Auction Stop Due To Low Quantity.";
			}
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: <subhash@maxtratechnologies.com>' . "\r\n";
			mail($f['email'],"Notification ",$msg,$headers);
		}
	}
	if($_GET['del']==3 && $_GET['pid'])
	{
		$pid=$_GET['pid'];
		mysql_query("update product_wishlist set get_notify=0 where id='$pid'");
	}
		
	
	
	mysql_query("update product_wishlist set read_viewer=0  where user_id='$user_id'");
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
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
		<h3>My Wishlist</h3>
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
			<div class="grid_12 full_block">

				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Product Details  </h6>
					</div>
					<div class="widget_content">
						
						<table class="display data_tbl" border="0">
						<thead>
						
						<tr>
							
							<th>
								 Category Name
							</th>
							<th>
								 Product Name
							</th>
							<th>
								 Condition
							</th>
							<th>
							Qty
							</th>
							
							<th>
							Product's Price
							</th>
							<th>
								 Image
							</th>
							
							<th>
								 Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$c=1;
						$sqlwish="select * from product_wishlist where user_id='$user_id'";
						$reswish=mysql_query($sqlwish);
						while($rowwish=mysql_fetch_assoc($reswish))
						{
						$p_cat_id=$rowwish['p_id'];
						$sql="select * from product_category where p_cat_id='$p_cat_id' order by p_cat_id desc";
						$res=mysql_query($sql);
						$row=mysql_fetch_assoc($res);
						if($row['daily_deal'] || $row['gift_card'])
						{
							$price=$row['cost_price']-($row['cost_price']*$row['dailydeal_discount']/100);
						}
						else
						{
							$price=$row['cost_price'];
						}
						?>
						<tr>
							
							<td class="center">
								<?php 
								$catid=$row['cat_id'];
								$sql_cat=mysql_query("select category_name from category_shop where c_id='$catid'");
								$rowcat=mysql_fetch_assoc($sql_cat);
								echo $rowcat['category_name'];?>
							</td>
							<td class="center">
								 <a href="../profile.php?pid=<?php echo $row['p_cat_id'];?>"><?php echo $row['product_name'];?></a>
							</td>
							<td class="center">
								 <?php
								
								  echo $row['condition_name'];
								  ?>
							</td>
							<td class="center">
								 <?php echo $rowwish['quantity'];?>
							</td>
							
							<td class="center">
								 <?php echo $price;?>
							</td>
							<td class="center">
								<div class="user-thumb">
									<a href="#"><img height="40" width="40" alt="User" src="../product_logos/<?php echo $row['image'];?>"></a>
								</div>
							</td>
							
							<td class="center">
								<?php
								if($row['p_qty']>0 && $row['status']==0)
								{
								?>
								<a href="../onclick/wishto_payment.php?id=<?php echo $rowwish['id'];?>" title="Buy Now"><span class="badge_style b_done">Buy Now</span></a>
								<?php
								}
								else
								{
									echo "Product Expire";
								}
								?>
							</td>
							<td class="center">
							<?php
							if($row['penny_auction']==1 && $rowwish['get_notify']==0)
							{
							?>
							<span><a class="action-icons c-pending" href="mywishlist.php?del=2&pid=<?php echo $rowwish['id'];?>&auction_id=<?php echo $rowwish['auction_id'];?>" title="Get Notification">Get Notification</a></span>						<?php
							}
							?>
							<?php
							if($row['penny_auction']==1 && $rowwish['get_notify']==1)
							{
							?>
							<span><a class="action-icons c-status" href="mywishlist.php?del=3&pid=<?php echo $rowwish['id'];?>" title="Remove Notification">Remove Notification</a></span>
							<?php
							}
							?>
				<span><a class="action-icons c-delete" href="mywishlist.php?del=1&pid=<?php echo $rowwish['id'];?>" title="Delete">Delete</a></span>
							
							</td>
						</tr>
						<?php
						$c++;
						
						}
						?>
						<!--<tr>
							<td>
								<a href="#">Jaman</a>
							</td>
							<td>
								<a href="#">Ui Jaman</a>
							</td>
							<td>
								 Address Line
							</td>
							<td class="center">
								 jaman@hostname.com
							</td>
							<td class="center">
								<div class="user-thumb">
									<a href="#"><img height="40" width="40" alt="User" src="images/user-thumb1.png"></a>
								</div>
							</td>
							<td class="center">
								<span class="badge_style b_suspend">Suspended</span>
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Approve</a></span><span><a class="action-icons c-suspend" href="#" title="Suspend">Suspend</a></span>
							</td>
						</tr>-->
						
						</tbody>
						
						</table>
					</div>
					</div>
					</div>
				
					
				</div>
			</div>
</div>
</body>
</html>