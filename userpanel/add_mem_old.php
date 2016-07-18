<?php
include('../includes/all_func.php');
include('header.php');

if(!isset($_SESSION["uid"]))
{
 $_SESSION['uid']=$_SESSION['upd']; 
 }

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
		<h3>Add Members To Transfer Fund</h3>
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
                            _get_withdraw_config_list('fund_trans.php');
							?>
								<!--<li><a href="virtual_finance.php" >Available Funds</a></li>
								<li><a href="#tab2" class="active_tab"> Funds Transfer</a></li>
								<li><a href="request_payout.php"> Transfer to Bank</a></li>
								<li><a href="card.php"> Request a Check</a></li>
								<li><a href="shopdeal.php"> Payout To Paypal</a></li>-->
							</ul>
						</div>
						<span class="h_icon blocks_images"></span>
						<h6>Transaction History  </h6>
						
					</div>
					<div class="widget_content">
						
					<?php
                      if(_get_withdraw_config('fund_trans.php')):
					  ?>					
						<div id="tab2">
							
							<div class="oilhold">


<form id="forms1" name="forms1"  method="post" class="form_container left_label">
							
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
									<label class="field_title">First name</label>
									<div class="form_input">
									<input type="text" name="fname" id="name" /><input type="hidden" name="idq"   />
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Last Name</label>
									<div class="form_input">
									<input type="text" name="lname" id="name" /><input type="hidden" name="id" value="" />
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
									<input type="text" name="uname" id="name" /><input type="hidden" name="id" value="" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Id</label>
									<div class="form_input">
									<input type="text" name="uid" id="name" /><input type="hidden" name="id" value="" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
								<div class="form_input">
                                <button type="submit" name="Show" class="btn_small btn_gray"><span>Search</span></button>	
							<!--<input name="Show" type="submit" class="submit" id="button" value="Search" style="border:none"/>-->
									</div>
                                    </div>
								</li>
							</ul>
                            </form>
                            </div>
                            </div>
                   </div>
                   <div class="widget_content">         
<?php
if(isset($_POST['Show']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$uname=$_POST['uname'];
	$uid=$_POST['uid'];
	$sql_search="select * from registration where id!='' ";
	if($fname!='')
	{
		$sql_search .=" and first_name Like '%$fname%'";	
	}
	if($lname!='')
	{
		$sql_search .=" and last_name like '%$lname%'";	
	}
	if($uname!='')
	{
		$sql_search .=" and user_name='$uname'";	
	}
	if($uid!='')
	{
		$sql_search .=" and user_id='$uid'";	
	}
	 //echo $sql_search;
	//$quer="select * from registration where first_name = '$name', last_name='$name', user_name='$name', user_id='$name'";
	$data=mysql_query($sql_search);
	$num_rows=mysql_num_rows($data);
//echo $num_rows;
if($num_rows>0)
{
?>
				<table class="display data_tbl">
                <thead>
                <tr>
                	<th >Sl No.</th>
				   <th>Member ID</th>

                  <th>User Name</th>

                  <th>Name</th>
                  
                  <th>last Name</th>
                  <th>Action</th>
					</tr>
<tr><td colspan="6">&nbsp; </td></tr>
</thead>
<tbody>
                <?php
$sl=1;
while($arr=mysql_fetch_array($data))
{
		?>
        <tr>
    <td><div align="center"><?php echo $sl; ?></div></td>
          <td><div align="center"><?php echo $arr['user_id']; ?></div></td>
          <td><div align="center"><?php echo $arr['user_name']; ?></div></td>
          <td><div align="center"><?php echo $arr['first_name']; ?></div></td>
         <td><div align="center"><?php echo $arr['last_name']; ?></div></td>
<?php
$idq=$arr['user_id'];
$sql_check="select * from benificiery where member_id='$idq' and type='cash_wallet'";
$res_check=mysql_query($sql_check);
$count_check=mysql_num_rows($res_check);
if($count_check>0)
{
	?>
     <td><div align="center"><?php echo $msg="Username Already Added";?></div></td>
    <?php
}
else
{	
?>
          <td><div align="center"><a href="add_beni_func.php?dtl=<?php echo $arr['user_id']; ?>&amp;type=cash_wallet&return_url=fund_trans.php" class="head">Add</a></div></td>
<?php
}
?>
        </tr>
        <tr><td colspan="6">&nbsp; </td></tr>
       <?php	
$sl++;
}
?>
</tbody>
      </table>
<?php 
}
else
{
	print "<div align='center'><font color='red' size='+1'>Result Not Found</font></div>";
}
}

?>

</div></div>
					<?php
					  else:
					   echo "This section is block. Please Contact Admin.";
					  endif;
					  ?> 
</div>
</div>
</div>
</div>
</body>
</html>
