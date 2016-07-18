<?php
include('header.php');
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$start=$_GET['start'];
	if(strlen($start) > 0 and !is_numeric($start)){
	echo "Data Error";
	exit;
	}
			 
	$eu = ($start - 0); 
	$limit =16;                                 // No of records to be shown per page.
	$this1 = $eu + $limit; 
	$back = $eu - $limit; 
	$next = $eu + $limit; 
	$id=showuserid($_SESSION['SD_User_Name']);
//echo "select * from credit_debit where user_id='$id' order by receive_date  limit $eu, $limit";
	$sqll=mysql_query("select * from bid_transfer_history where user_id='$id' order by id desc");
	$sqql=mysql_query("select * from bid_user_final where user_id='$id'");
	$f_current=mysql_fetch_array($sqql);
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
		<h3>My Transaction</h3>
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
					<div id="widget_tab">
							<ul>
							<li><a href="showmybid.php" class="">My Auctions</a></li>
								<li><a href="total_bid.php" class="">Total Bid</a></li>
								<li><a href="trade_bid.php" class="">Trade Bid</a></li>
								<li><a href="bid_manager_view.php" class="active_tab">My Bid History</a></li>
							</ul>
						</div>
						<span class="h_icon blocks_images"></span>
						<h6>Bid Transaction History</h6>
					</div>
					<div class="widget_content">
						<h3>Total Bid</h3>
						<form action="transferbidfun.php?page=trade" method="post" class="form_container left_label">
							<ul>
							<?php
						    $s="select * from bid_user_final where user_id='{$id}'";
							$q_r=mysql_query($s);
							$pin_receive_total=mysql_num_rows($q_r);
							while($row=mysql_fetch_array($q_r))
							{
								$x=$row['remain_bid_count'];
								$z+=$x;
							}
							$x=round($x,2);
			 			 ?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Total Bid</label>
									<div class="form_input">
										<?= $x;?>
										<span id="user"></span>
									</div>
								</div>
								</li>
							</ul>
							</form>	
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>
								 S.No.
							</th>
							<th>
								  Date
							</th>
							<th>
								  Remarks
							</th>
							<th>
								  BID RECEIVED
							</th>
							<th>
								  BID TRANSFERRED
							</th>
							
							
						</tr>
						</thead>
						<tbody>
						<?php
						
						$bal=0;
						$ii=0;
						    while($fetch=mysql_fetch_array($sqll)){
			 			 $bal=$bal+($fetch[credit_bid]-$fetch[debit_bid]);
						 $ii++;
						 ?>
							<tr>
								<td align="center" class="ptext"><?=$ii;?></td>
                                  <td align="center" class="ptext"><?=date('d-m-Y',strtotime($fetch[transaction_date]));?></td>
								  <td align="center" class="ptext"><?=$fetch[remark];?></td>
                                  <td align="center" class="ptext"><?=$fetch[credit_bid];?></td>
                                  <td align="center" class="ptext"><?=$fetch[debit_bid];?></td>
                                 
                                </tr>
                                <?
								}
								?>
						
						</tbody>
						<tfoot>
						
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			</div></div>
</div>
</body>
</html>