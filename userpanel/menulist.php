<?php
include('header.php');
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	$s="select user_id from registration where user_name='$idd'";
	$ffr=mysql_query($s);
	$f=mysql_fetch_array($ffr);
	$user_id=$f['user_id'];
	if($_GET['del']==0 && $_GET['pid'])
	{
		$pid=$_GET['pid'];
		mysql_query("update pricemenulist set status='0' where id='$pid'");
	}
	if($_GET['del']==1 && $_GET['pid'])
	{
		$pid=$_GET['pid'];
		mysql_query("update pricemenulist set status='1' where id='$pid'");
	}
	if($_GET['del']==2 && $_GET['pid'])
	{
		$pid=$_GET['pid'];
		mysql_query("update pricemenulist set status='2' where id='$pid'");
	}
	$sql="select * from pricemenulist where  add_by='$user_id' and type='menulist'  order by id desc";
	$res=mysql_query($sql);
	$countmr=mysql_num_rows($res);
	
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
		<h3>MenuList</h3>
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
					
					<div  id="widget_tab">
							<ul>
								
								<li><a href="pricelist.php"  class="">PriceList</a></li>
								<li><a href="#tab1"  class="active_tab">MenuList</a></li>
							</ul>
						</div>
				
					<h6 style="margin:9px;"> <a href="add_menulist.php">Add New</a></h6>
				
					<div class="widget_content">
					

						<table class="display data_tbl" border="0">
						<thead>
					
						<tr>
							
							<th>
								 Headline
							</th>
							<th>
								 Service Name
							</th>
							
						
							<th>
								 Price
							</th>
							
							
							<th>
								 Deatil
							</th>
							<th>
								 Status
							</th>
							<th>
								 Edit
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$c=1;
						while($row=mysql_fetch_assoc($res))
						{
						
						?>
						<tr>
							
							<td class="center">
								<?php 
								
								echo $row['heading'];?>
							</td>
							<td class="center">
								<?php 
								
								echo $row['product_name'];?>
							</td>
							
							
							<td class="center">
								 <?php echo $row['price'];?>
							</td>
							
							<td class="center">
							<!--pricelist_profile.php?pid=<?php echo $row['id'];?>-->
									<a href="#">View Detail</a>
							</td>
							<td class="center">
								<?php
								if($row['status']==0)
								{
								?>
								<span class="badge_style b_done">Available</span>
								<?php
								}
								else if($row['status']==1)
								{
								?>
								<span class="badge_style b_pending">Delete</span>
								<?php
								}
								else if($row['status']==2)
								{
								?>
								<span class="badge_style b_pending">Suspended</span>
								<?php
								}
								?>
								
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="add_menulist.php?edit=edit&pid=<?php echo $row['id'];?>" title="Edit">Edit</a></span>
							</td>
						</tr>
						<?php
						$c++;
						}
						?>
					
						
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