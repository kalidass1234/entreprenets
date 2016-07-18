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
		<h3>Add New Debit/Credit Card Info</h3>
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
						<span class="h_icon blocks_images"></span>
						<h6>Add New Debit/Credit Card Info</h6>
                        
					</div>
					<div class="widget_content">
						<?php 
							 $sqluser="select * from billing_address where id='$_GET[id]' and user_id='$id' and status=0";
							 $resuser=mysql_query($sqluser);
							 $countuser=mysql_num_rows($resuser);
							 $rowuser=mysql_fetch_assoc($resuser);
							 if($countuser)
							 {
							 	$action="update";
							 }
							 else
							 {
							 	$action="insert";
							 }
							 $sql_user="select * from registration where user_id='$id'";
							 $res_user=mysql_query($sql_user);
							 $row_user=mysql_fetch_assoc($res_user);
							?>
						<div id="tab4">
							<div class="oilhold">
   							<form action="update_creditcard.php?id=<?php echo $_GET['id'];?>&action=<?php echo $action;?>" method="post" class="form_container left_label">
							<ul>
                            <li>
								<div class="form_grid_12">
									<label class="field_title"><strong>Billing Address</strong></label>
									<div class="form_input">
										<label>&nbsp;</label>
									</div>
								</div>
								</li>
                               
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Address1</label>
									<div class="form_input">
										<label><input type="text" name="address1" value="<?=$row_user['address1'];?>"></label>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">City</label>
									<div class="form_input">
										<label><input type="text" name="city" value="<?=$row_user['city'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">State</label>
									<div class="form_input">
										<label><input type="text" name="state" value="<?=$row_user['state'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Zip</label>
									<div class="form_input">
										<label><input type="text" name="zip" value="<?=$row_user['zip'];?>"></label>
									</div>
								</div>
								</li>
                                  <li>
								<div class="form_grid_12">
									<label class="field_title"><strong>Credit Card Information </strong></label>
									<div class="form_input">
										<label>&nbsp;</label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Name On The Card</label>
									<div class="form_input">
										<label>
                                       <input type="text" name="card_name" value="<?=$rowuser['card_name'];?>"></label>
									</div>
								</div>
								</li>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Card Type</label>
									<div class="form_input">
										<label>
                                        <select name="card_type">
                                        <option value="Visa" <?php if($rowuser['card_type']=='Visa'){ echo "selected";}?>>Visa</option>
                                        <option value="Mastercard" <?php if($rowuser['card_type']=='Mastercard'){ echo "selected";}?>>Mastercard</option>
                                        <option value="Discover" <?php if($rowuser['card_type']=='Discover'){ echo "selected";}?>>Discover</option>
                                        </select>
                                        <!--<input type="text" name="card_tyep" value="<?=$rowuser['card_type'];?>">--></label>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Card No</label>
									<div class="form_input">
										<label>
                                        <?php echo substr($rowuser['card_no'], -4);?>
                                        <input type="text" name="card_no" value=""></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Expiry Date</label>
									<div class="form_input">
										<label><input type="text" name="exp_date" value="<?=$rowuser['exp_date'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Card Security Code </label>
									<div class="form_input">
										<label><input type="text" name="cvv" value="<?=$rowuser['cvv'];?>"></label>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="id" name="id" value="<?php  echo $rowuser['id'];?>" />
										<button type="submit" class="btn_small btn_gray"><span>Submit</span></button>
                                        <?php
                                        if($countuser)
							 			{
										?>
                                        <a href="cancel_debitcard.php?id=<?php  echo $rowuser['id'];?>">Cancel</a>
                                        <?php
										}
										?>
										<span class="blue"><?php if($_GET['msg_r']) echo $_GET['msg_r']; else if($_GET['msg']) echo $_GET['msg']; ?></span>
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