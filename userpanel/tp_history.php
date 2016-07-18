<?php
include('../includes/all_func.php');
include('header.php');

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
	$sqll=mysql_query("select * from final_tp_history where user_id='$id' and (`receive_date` between '$from_date' and '$end_date') order by id desc");
	$sqll=mysql_query("select * from final_tp_history where (receiver_id='$id' or sender_id='$id') and status=0 order by id desc");
	$sqql=mysql_query("select * from final_tp where user_id='$id'");
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
						<span class="h_icon blocks_images"></span>
						<h6>Transaction History  </h6>
                        <div id="widget_tab">
							<ul>
								<li><a href="#" class="active_tab">TP Wallet History</a></li>
								<li><a href="financial_manager2.php" >TP Wallet</a></li>
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
								 TP RECEIVED
							</th>
							<!--<th>
								 Request Withdraw or Transferred 
							</th>
                            <th>
								 Administration Fees
							</th>-->
                            <th>
								 TP withdraw or Transferred
							</th>
							<!--<th>
								 BALANCE</th>-->
							
						</tr>
						</thead>
						<tbody>
						<?php
						$final_amount=$f_current['amount'];
						$bal=0;
						$ii=0;
						    while($fetch=mysql_fetch_array($sqll)){
			 			 $bal=$bal+($fetch[credit_amt]-$fetch[debit_amt]);
						 $ii++;
						 ?>
							<tr>
								<td align="center" class="ptext"><?=$ii;?></td>
                                  <td align="center" class="ptext"><?=date('m-d-Y',strtotime($fetch[receive_date]));?></td>
								  <td align="center" class="ptext"><?=$fetch[Remark];?></td>
                                  <td align="center" class="ptext"><?=$fetch[credit_amt];?></td>
                                  <td align="center" class="ptext"><?=$fetch[debit_amt];?></td>
                                  <!--<td align="center" class="ptext"><?=$fetch[admin_charge];?></td>
                                  <td align="center" class="ptext"><?php echo ($fetch[debit_amt]-$fetch[admin_charge]);?></td>-->
                                  <!--<td align="center" class="ptext"><?=$bal;?></td>-->
                                  
                                </tr>
                                <?
								}
								?>
						
						</tbody>
						<tfoot>
						<tr>
                        	<td colspan="5" align="center"><strong>Final Balance:<?php echo round($final_amount,2);?>&nbsp;TP</strong></td>
                        </tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			</div></div>
</div>
</body>
</html>