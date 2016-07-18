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
  <div class="page_title"><!-- <span class="title_icon"><span class="computer_imac"></span></span>--> 
    <!--<h3>Dashboard</h3>--> 
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
              <h6>Available E Vouchers</h6>
            </div>
            <form method="post" action="">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="display">
                <!-- <tr>
		     <th scope="row">&nbsp;</th>
		     <td>&nbsp;</td>
		     <td>&nbsp;</td>
		     <th scope="row">&nbsp;</th>
		     <td>&nbsp;</td>
		     </tr>-->
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
                    </div></th>
                  <td><button type="submit" class="btn_small btn_blue" tabindex="1" name="submit"><span>Search</span></button></td>
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
           <?php
				  $user_id=showuserid($_SESSION['SD_User_Name']);
				  $sql_subs="select * from subscription where user_id='$user_id' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?>
            <table class="display data_tbl">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> E Voucher Code</th>
                  <th>Amount</th>
                  <th>Generation Date </th>
                  <th>Receive Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$srl1=1;
					$sql="select * from pins  where status=0 and receiver_id='$userid' order by crt_date desc";
					if(isset($_POST['submit']))
					{
						$frm=date('Y-m-d',strtotime($_POST['txtfrm']));
						$til=date('Y-m-d',strtotime($_POST['txttil']));
						$sql="select * from pins where status=0 and  crt_date between '$frm' AND '$til' and receiver_id='$userid' order by crt_date";
					}
					$res=mysql_query($sql);
					$count=mysql_num_rows($res);
					if($count>0)
					 {
						while($row=mysql_fetch_assoc($res))
						{
				?>
                <tr>
                  <td align="center" class="ptext"><?=$srl1?></td>
                  <td align="center" class="ptext"><?php echo $row['pin_no']; ?></td>
                   <td align="center" class="ptext">$<?php echo $row['amount']; ?></td>
                  <td align="center" class="ptext"><?php echo date('m-d-Y',strtotime($row['crt_date']));?></td>
                  <td align="center" class="ptext"><?php echo ($row['t_date']!='0000-00-00') ? date('m-d-Y',strtotime($row['t_date'])) :  '-';?></td>
                </tr>
                <?php
				$srl1++;
                }
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