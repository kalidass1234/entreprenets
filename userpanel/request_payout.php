<?php
include('../includes/all_func.php');
include('header.php');

error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['adid'])
{
	//transaction history
$id=showuserid($_SESSION['adid']);
$query2=" select * from credit_debit where user_id='$id' order by receive_date desc";
$result2=mysql_query($query2);
echo mysql_error();
$nume=mysql_num_rows($result2);
  $sqll=mysql_query("select * from credit_debit where user_id='$id' order by receive_date desc limit $eu, $limit");
  $sqql=mysql_query("select * from final_e_wallet where user_id='$id'");
  $f_current=mysql_fetch_array($sqql);
}
else
{
	echo "<script language='javascript'>window.location.href='../index.php';</script>";exit;
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


function checkStatus11(str)
{
	
	if(str=='manual')
	{
		var d = new Date();
    var weekday = new Array(7);
    weekday[0] = "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";

    var n = weekday[d.getDay()];
	//alert(n);
		var day ="<?php echo _get_withdrawal_day(); ?>";
		//alert(from_day);
		//var to_day ="<?php //echo _get_withdrawal_to_day(); ?>";
		//alert(to_day);
		if(n==day)
		{
			document.getElementById("bank_info").style.display=block;
		}
		else
		{
			alert("Our weekly payout day is "+day+". Today is "+n+". You can choose automatic withdrawal option");
			document.getElementById("bank_info").style.display="none";
		}
		}
		if(str=='automatic')
	{
		
		document.getElementById("bank_info").style.display="block";
		
		
	}
		
	
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
	<?php //include('switch-bar.php');?>
	<div id="content">
		<div class="grid_container">
	<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
					<div id="widget_tab">
							<ul>
							<?php
                            _get_withdraw_config_list('request_payout.php');
							?>
								<!--<li><a href="virtual_finance.php" >Available Funds</a></li>
								<li><a href="fund_trans.php"> Funds Transfer</a></li>
								<li><a href="#tab3" class="active_tab">Transfer to Bank Account</a></li>
								<li><a href="card.php"> Request Bank Check</a></li>
								<li><a href="shopdeal.php"> Payout To Paypal</a></li>
                                <li><a href="shopdeal_vtncard.php"> Payout To VTN Card</a></li>-->
							</ul>
						</div>
						<span class="h_icon blocks_images"></span>
						
						
					</div>
					<div class="widget_content">
                   
					<?php
						_get_withdrawal_day_message();
                      if(_get_withdraw_config('request_payout.php')):
					?>
						<div id="tab3">
                         <div class="form_input">
										<font color="#003399"><?php echo $_REQUEST['msg'].''.$_REQUEST['msg_r'];?></font>
									</div>
							
							<div class="oilhold">
   							<form action="request_func.php?id=peronal" method="post" class="form_container left_label">
							<?php 
							$sqluser="select * from member_bank_detail where user_id='$id' and default_status=1";
							$resuser=mysql_query($sqluser);
							$nnn=mysql_num_rows($resuser);
							$rowuser=mysql_fetch_assoc($resuser);
							?>
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
									<label class="field_title"></label>
									<div class="form_input">
							
                                        <label><input type="hidden" name="request_type" checked="checked" value="automatic" onChange="checkStatus11(this.value)" > </label>
                                        
										
									</div>
								</div>
								</li>
                                <?php
								$n=date('l');
								$day = _get_withdrawal_day();
								
								if($n==$day)
	{
	?>
    <div>
    <?php
	}
	else
	{
	?>
	
                                <div style="display:none" id="bank_info">
                             
                      <?php
	}
	?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Available Balance</label>
									<div class="form_input">
										<label><?= $x. ' $'?></label>
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Bank Info</label>
									<div class="form_input">
		<style>
		td
		{
			padding:5px !important; background:#ccc; box-radius:15px; border:#bbb 1px solid !important;
		}
		</style>								
                                 <?php
								 if($nnn>0)
								 {
									 ?>       
                                         <table width="400" >
  <tr>
    <td>Bank Account Name</td>
    <td><?php echo $rowuser['account_name']; ?></td>
  </tr>
  <tr>
    <td>Bank Name</td>
    <td><?php echo $rowuser['bank_name']; ?></td>
  </tr>
  <tr>
    <td>Branch Name</td>
    <td><?php echo $rowuser['branch_name']; ?></td>
  </tr>
  <tr>
    <td>Account No.</td>
    <td><?php echo $rowuser['account_no']; ?></td>
  </tr>

  <tr>
    <td>Ifsc Code</td>
    <td><?php echo $rowuser['swift_code']; ?></td>
  </tr>

  <tr>
    <td>City</td>
    <td><?php echo $rowuser['city']; ?></td>
  </tr>
  <tr>
    <td>State</td>
    <td><?php echo $rowuser['state']; ?></td>
  </tr>

</table>
<?php
								 }
								 ?>
										
										<a href="bank_info.php?refferal_link=request_payout.php">Add Bank Info</a>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Amount To withdraw</label>
									<div class="form_input">
									<input name="account_no" type="hidden" tabindex="1" value="<?php echo $rowuser['account_no'];?>" required class="" style="width:44%;"  />
									<input name="account_name" type="hidden" tabindex="2" value="<?php echo $rowuser['account_name'];?>" required class="" style="width:44%;" />
									<input name="bank_name" type="hidden" tabindex="3" value="<?php echo $rowuser['bank_name'];?>" required class="" style="width:44%;" />
									<input name="branch_name" type="hidden" tabindex="4"  value="<?php echo $rowuser['branch_name'];?>" required  class="" style="width:44%;" />
									<input name="swift_code" type="hidden" tabindex="5" value="<?php echo $rowuser['swift_code'];?>" required class="" style="width:44%;" />
                                 
                                 <input name="routing_no" type="hidden" tabindex="5" value="<?php echo $rowuser['routing_no'];?>" required class="" style="width:44%;" />
                                 <input name="iban_no" type="hidden" tabindex="5" value="<?php echo $rowuser['iban_no'];?>" required class="" style="width:44%;" />
                                 <input name="country" type="hidden" tabindex="5" value="<?php echo $rowuser['country'];?>" required class="" style="width:44%;" />
                                 <input name="state" type="hidden" tabindex="5" value="<?php echo $rowuser['state'];?>" required class="" style="width:44%;" />   
                                    
           <input name="city" type="hidden" tabindex="5" value="<?php echo $rowuser['city'];?>" required class="" style="width:44%;" />   
                                                               
                                    
                                    
                                    
                                    
										<input name="amount" type="text" tabindex="6" required onKeyUp="if(isNaN(this.value)){this.value='';}" onBlur="if(isNaN(this.value)){this.value='';} showadmincharge(this.value);" class="" style="width:44%;" />
										
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
									<label class="field_title">Remark </label>
									<div class="form_input">
										<textarea name="mamo" class="input_grow" cols="50" rows="5" tabindex="7" ></textarea>
									</div>
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
										<button type="submit" class="btn_small btn_gray"><span>Request</span></button>
										<button type="reset" class="btn_small btn_gray"><span>Reset</span></button>
										
									</div>
								</div>
								</li>
                                </div>
								<li>
								<div class="form_grid_12">
									
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
                    <?php
					  else:
					   echo "This section is block. Please Contact Admin.";
					  endif;
					?>
        	   </div>
			</div>
		  </div>
		</div>
      </div>
</div>
</body>
</html>
<script language="javascript">

function checkStatus()
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