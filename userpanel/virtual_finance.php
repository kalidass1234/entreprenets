<?php
include('../includes/all_func.php');
include('header.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['adid'])
{
	//transaction history
$id=showuserid($_SESSION['adid']);
$query2=" select * from credit_debit where user_id='$id' order by receive_date";
$result2=mysql_query($query2);
echo mysql_error();
$nume=mysql_num_rows($result2);
$sqll=mysql_query("select * from credit_debit where user_id='$id' order by receive_date  limit $eu, $limit");
$sqql=mysql_query("select * from final_e_wallet where user_id='$id'");
$f_current=mysql_fetch_array($sqql);
}
else
{
	echo "<script language='javascript'>window.location.href='../index.php';</script>";exit;
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
		<h3>Cash Wallet</h3>
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
							<?php
                            _get_withdraw_config_list('virtual_finance.php')
							?>
								<!--<li><a href="#tab1" class="active_tab">Available Funds</a></li>
								<li><a href="fund_trans.php">Funds Transfer</a></li>
								<li><a href="request_payout.php">Transfer to Bank Account</a></li>
								<li><a href="card.php">Request Bank Check</a></li>
								<li><a href="shopdeal.php">Payout To Paypal</a></li>-->
                                <!--<li><a href="shopdeal_vtncard.php">Payout To VTN Card</a></li>-->
							</ul>
						</div>
						<span class="h_icon blocks_images"></span>
						<!--<h6>Transaction History  </h6>-->
						
						<div>
						</div>
					</div>
					<div class="widget_content">
                      <?php
                      if(_get_withdraw_config('virtual_finance.php')):
					  ?>
					  <div id="tab1">
						<div class="widget_content">
						<table class="display data_tbl">
						<thead>
						<tr>
						<td colspan="2">&nbsp;</td>
						</tr>
                        <tr>
						<td colspan="2">&nbsp;</td>
						</tr>
                        <tr>
						<td colspan="2">&nbsp;</td>
						</tr>
						</thead>
						<tbody>
						<?php
						    $s="select * from final_e_wallet where user_id='{$id}'";
							$q_r=mysql_query($s);
							$pin_receive_total=mysql_num_rows($q_r);
							while($row=mysql_fetch_array($q_r))
							{
								$x=$row['amount'];
								$z+=$x;
							}
							$x=round($x,2);
			 			 ?>
                         <tr>
						<td colspan="2"><h3>Cash Wallet</h3></td>
						</tr>
                        <tr>
                            <td>
                            	Total Amount
                            </td>
                            <td align="center" class="ptext"><?= $x. ' USD'?></td>
                        </tr>
						</tbody>
						<tfoot>
						</tfoot>
						</table>
                       
					</div>	
						</div>
                      <?php
					  else:
					   echo "This section is block. Please Contact Admin.";
					  endif;
					  ?>
					</div>
				</div>
			</div>
			</div></div>
</div>
</body>
</html>
<script language="javascript">
function checkUser(val,target)
{
	var urldata="ref="+val+"&target="+target;
             $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_checkuser.php",
                data: urldata,
                success: function(html) {
                    if(html)
					{
						$('#user_'+target).html(html);
					}
					else
					{
						return false;	
					}
                }
            });
}
</script>