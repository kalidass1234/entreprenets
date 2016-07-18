<?php
include('../includes/all_func.php');
include('header.php');

error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
//transaction history
	$id=showuserid($_SESSION['SD_User_Name']);
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
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<script>
function showadmincharge(val)
{

	 if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				var str=xmlhttp.responseText;
				var res = str.split(",");
				var tot=res[1];
				document.getElementById("admincharge").innerHTML="$"+res[0];
				document.getElementById("totalpaid").innerHTML="$"+res[1];
				}
			  }
			xmlhttp.open("GET","ajax_admin_charge.php?amount="+val,true);
			xmlhttp.send();
}
</script>
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
		<h3>VTN Virtual  Bank</h3>
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
	<?php //include('switch-bar.php');?>
	<div id="content">
		<div class="grid_container">
	<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
					<div id="widget_tab">
							<ul>
							
								<li><a href="tp_wallet.php" >Available TP</a></li>
								<li><a href="tp_trans.php" >Transfer To User</a></li>
								<li><a href="#tab2" class="active_tab"> Transfer to Cash Wallet</a></li>
							</ul>
						</div>
						<span class="h_icon blocks_images"></span>
						<h6>Transaction History  </h6>
						
					</div>
					<div class="widget_content">
					
						<div id="tab2">
							
							<div class="oilhold">
   							<form action="submit.php" method="post" class="form_container left_label">
							<?php
						    $s="select * from final_tp where user_id='{$id}'";
							$q_r=mysql_query($s);
							$pin_receive_total=mysql_num_rows($q_r);
							while($row=mysql_fetch_array($q_r))
							{
								$x=$row['amount'];
								$z+=$x;
							}
							$x=round($x,2);
			 			 ?>
							<ul>
							<li>
								<div class="form_grid_12">
									<label class="field_title">&nbsp;</label>
									<div class="form_input">
										<label>&nbsp;</label>
										
									</div>
								</div>
								</li>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Available Balance</label>
									<div class="form_input">
										<label><?= $x. ' USD'?></label>
										
									</div>
								</div>
								</li>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title">Member ID / Username.</label>
									<div class="form_input">
										<input name="loginid" type="text" tabindex="1" class="" style="width:44%;" onChange="checkUser(this.value,'fundtransfer');"  />
										<span id="user_fundtransfer"></span>
									</div>
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<label class="field_title">Amount</label>
									<div class="form_input">
										<input name="max_amt" type="text" tabindex="1" class="" onBlur="showadmincharge(this.value);" style="width:44%;" />
										
									</div>
								</div>
								</li>
								<li >
								<div class="form_grid_12">
									<label class="field_title">Admin Charge</label>
									<div class="form_input" id="admincharge">
										$0
									</div>
								</div>
								</li>
                                <li >
								<div class="form_grid_12">
									<label class="field_title">Total</label>
									<div class="form_input" id="totalpaid">
										$0
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Remarks </label>
									<div class="form_input">
										<textarea name="remark" class="input_grow" cols="50" rows="5" tabindex="5" ></textarea>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    <input type="hidden" name="action" value="tp_tranfer_cash">
										<button type="submit" class="btn_small btn_gray"><span>Transfer To Cash Wallet</span></button>
										<button type="reset" class="btn_small btn_gray"><span>Reset</span></button>
										<span class="blue"><?php echo $_GET['msg']; ?></span>
									</div>
								</div>
								</li>
							</ul>
						</form>
					  <!--<img src="images/support-ticket.jpg" border="0" />
					<br />
					 <div align="center" style="padding-top:20px;">
					  <input name="raise_ticket" class="btn" type="button"  value="Raise Ticket" onClick="window.location.href='raise-ticket.php'"/>
					  </div>-->
					</div>
						</div>
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
	//alert(val+'--'+target);
	var urldata="ref="+val+"&target="+target;
             $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_checkuser.php",
                data: urldata,
                success: function(html) {
				//alert(target+'---'+html);
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