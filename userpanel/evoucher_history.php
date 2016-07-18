<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
include('header.php');

$idd=$_SESSION['SD_User_Name'];
$userid=showuserid($idd);
if(isset($_SESSION['SD_User_Name']))
{
	$user_id=showuserid($_SESSION['SD_User_Name']);
	$curdate=date('Y-m-d:H:i:s');

}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<style>
.table td {
	padding:1%;
	font-size:1.2em;
}
</style>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
  <div id="actionsBoxMenu" class="menu"> <span id="cntBoxMenu">0</span> <a class="button box_action">Archive</a> <a class="button box_action">Delete</a> <a id="toggleBoxMenu" class="open"></a> <a id="closeBoxMenu" class="button t_close">X</a> </div>
  <div class="submenu"> <a class="first box_action">Move...</a> <a class="box_action">Mark as read</a> <a class="box_action">Mark as unread</a> <a class="last box_action">Spam</a> </div>
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
	include('switch-bar.php');
	?>
  <div id="content">
    <div class="grid_container"> 
     
     
      
      <h6 align="center" style="color:#0033FF">Welcome <?php echo $_SESSION['SD_User_Name'];?> </h6>
      <div class="grid_12 full_block">
        <div class="widget_wrap">
          <div class="widget_content">
            <div class="widget_top" align="center">
              <h6>E Vouchers History </h6>
            </div>
            <form method="post" action="">
            <?php
				  $user_id=showuserid($_SESSION['SD_User_Name']);
				  $sql_subs="select * from subscription where user_id='$user_id' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="display">
       
              
              <tr>
                <th scope="row">&nbsp;</th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <th scope="row">&nbsp;</th>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td scope="row">Date From:</td>
                <td><input type="text" name="txtfrm" class="datepicker" id="txtfrm" readonly="true" size="15" placeholder="From" style="margin-left:3em;" value="<?=$frm?>" required /></td>
                <td>&nbsp;</td>
                <td scope="row">Date To:</td>
                <td><input type="text" name="txttil" class="datepicker" id="txttil" readonly="true" placeholder="Till" size="15" value="<?=$til?>" required /></td>
              </tr>
              <tr>
                <th colspan="2" scope="row"><div class="invoice_action_bar"> 
                    
                    <!--<div class="btn_30_light">
										<a href="#" original-title="Pay Now"><span class="icon zone_money_co"></span></a>
									</div>-->
                    
                    <div class="btn_30_light"> <a href="#" original-title="Print"><span class="icon printer_co"></span></a> </div>
                    <div class="btn_30_light"> <a href="#" original-title="Download .pdf"><span class="icon drive_disk_co"></span></a> </div>
                  </div></th>
                <td><button type="submit" class="btn_small btn_blue" tabindex="1"><span>Search</span></button></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              
            </table>
            </form>
          </div>
          <div class="widget_content">
            <table class="display data_tbl">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> E Voucher Code</th>
                 <th> Amount</th>
                  <th>Purchase Date</th>
                  <th>Transfered From </th>
                   <th>Transfered To </th>
                    <th>Used By </th>
                     <th>Used For </th>
                      <th>Used Date </th>
                  </tr>
              </thead>
              <tbody>
                <?php
						$srl1=1;
						$str1="select * from pins where (created_by_user='$userid' or receiver_id='$userid' or sender_id='$userid')  order by id desc";
						if(isset($_POST['submit'])){
							$frm=date('Y-m-d',strtotime($_POST['txtfrm']));
							$til=date('Y-m-d',strtotime($_POST['txttil']));
							$str1="select * from pins where status=0 and  (crt_date between '$frm' AND '$til') and ( created_by_user='$userid' or receiver_id='$userid' or sender_id='$userid') order by id desc";
						}
						//echo $str1;
						$res1=mysql_query($str1);
						$res=mysql_query($sql);
						    while($x1=mysql_fetch_assoc($res1))
							{
							if($x1[sender_id]=='admin'){
							$sender='ADMIN';}else{$sender=$fetch_s['user_name'];}
							$sql_receiver=mysql_query("select * from registration where user_id='$x1[receiver_id]'");
							$fetch_r=mysql_fetch_array($sql_receiver);
						 ?>
                <tr>
                  <td align="center" class="ptext"><?=$srl1?></td>
                   <td align="center" class="ptext"><?=$x1['pin_no']?></td>
                   <td align="center" class="ptext">$<?=$x1['amount']?></td>
                  <td align="center" class="ptext"><?php echo date('F d,Y',strtotime($x1['t_date']));?></td>
                  <td align="center" class="ptext"><?php echo showusername($x1['sender_id']);?></td>
                 
                  <td align="center" class="ptext"><?php echo showusername($x1['transfer_to']);?></td>
                  <td align="center" class="ptext"><?php if($x1['used_by']){echo showusername($x1['used_by']);}?></td>
                  <td align="center" class="ptext"><?php echo $x1['used_for'];?></td>
                  <td align="center" class="ptext"><?php if($x1['used_date']!='0000-00-00'){echo $x1['used_date'];} else{ echo "NA";}?></td>
                </tr>
                <?
							$srl1++;	
							}
						?>
              </tbody>
              
            </table>
            <?php
                        }
						else
						{
						echo "<p>You  are not authorize to access this section.</p>";
						}
						?>
          </div>
        </div>
      </div>
      <span class="clear"></span></div>
    <span class="clear"></span> </div>
</div>
</body>
</html>