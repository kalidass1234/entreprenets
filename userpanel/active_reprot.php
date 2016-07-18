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
	$sqll=mysql_query("select * from credit_debit where user_id='$id' order by id desc");
	$sqql=mysql_query("select * from final_e_wallet where user_id='$id'");
	$f_current=mysql_fetch_array($sqql);
 $sql_user="select * from registration where user_id='$id'";
 $res_user=mysql_query($sql_user);
 $row_user=mysql_fetch_assoc($res_user);
 $bonus=$row_user['bonus'];
 $category_one=$row_user['category_one'];
 $category_two=$row_user['category_two'];
 $category_three=$row_user['category_three'];	
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
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
  <div class="page_title"> <span class="title_icon"><span class="computer_imac"></span></span>
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
          <div class="widget_top"> <span class="h_icon blocks_images"></span>
            <h6>ACTIVE REPORT </h6>
            <div id="widget_tab">
							<ul>
								<li><a href="financial_manager_view.php" >Transaction History</a></li>
								<li><a href="#" class="active_tab">Active Status Report</a></li>
                                <li><a href="history_summary_report.php">History Summary Report</a></li>
								
							</ul>
						</div>
          </div>
          <div class="widget_content">
            <?php
function _get_com_count($table,$user_id,$closing_no)
{
	$sql_affiliate="select * from $table where income_id='$user_id' and status=0 and paid_status=0 and closing='$closing_no'";
	$res_affiliate=mysql_query($sql_affiliate);
	$count_abonus=mysql_num_rows($res_affiliate);
	return $count_abonus;
}

function _get_total_com($table,$user_id,$closing_no)
{
	if($level)
	{
		$con_level=" and level='$level'";
	}
	$sql_affiliate1="select sum(commission) as total_b_com from $table where income_id='$user_id' and status=0 and paid_status=0 and closing='$closing_no'";
	$res_affiliate1=mysql_query($sql_affiliate1);
	$row_affiliate1=mysql_fetch_assoc($res_affiliate1);
	$total_b_com=$row_affiliate1['total_b_com'];
	return $total_b_com;
}

function _get_total_com_bonus($table,$user_id,$closing_no)
{
	$sql_affiliate1="select sum(commission) as total_b_com from $table where income_id='$user_id' and status=0 and paid_status=0 and closing='$closing_no'";
	$res_affiliate1=mysql_query($sql_affiliate1);
	$row_affiliate1=mysql_fetch_assoc($res_affiliate1);
	$total_b_com=$row_affiliate1['total_b_com'];
	return $total_b_com;
}			 
// get closing date and no
$sql_closing="select * from closing where status=0 order by id desc limit 1 ";
$res_closing=mysql_query($sql_closing);
$row_closing=mysql_fetch_assoc($res_closing);
$closing_no=$row_closing['closing_no'];
$closing_no=0;
// get usre residual income
$count_residual=_get_com_count('level_income',$id,$closing_no);
if($count_residual)
{
	$total_r_com=_get_total_com('level_income',$id,$closing_no);
}
if($count_residual)
{
	$total_r_com_bonus=_get_total_com_bonus('level_income_bonus',$id,$closing_no);
}
if($count_residual)
{
	$total_r_com_total=_get_total_com('level_income_total',$id,$closing_no);
}
// end of user residual income

// get usre affiliate income
$count_affiliate=_get_com_count('level_income_admin',$id,$closing_no);
if($count_affiliate)
{
	$total_a_com=_get_total_com('level_income_admin',$id,$closing_no);
}
// end of user affiliate income

// get usre guru income
$count_guru=_get_com_count('level_income_admin','guru',$closing_no);
if($count_guru)
{
	$total_g_com=_get_total_com('level_income_admin','guru',$closing_no);
}
// end of user guru income

// get usre guru income
$count_abonus=_get_com_count('level_income_bonus',$id,0);
if($count_abonus)
{
	$total_b_com=_get_total_com('level_income_bonus',$id,0);
}
// end of user guru income


?>
            <table class="display">
<?php
if($id==1234567)
{
?>            
              <thead>
                <tr>
                  <th> USER NAME: <?php echo $_SESSION['SD_User_Name'];?> </th>
                  <th> USER ID: <?php echo showuserid($_SESSION['SD_User_Name']);?> </th>
                  <th> STARTING DATE:
                    <?php  echo date('m/01/Y');?>
                  </th>
                  <th> CLOSING DATE:
                    <?php  echo date('m/t/Y');?>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                </tr>
                <tr>
                  <th> RESIDAUL INCOME </th>
                  <th> AFFILIATE REFERRAL </th>
                  <th> GURUS RECRUITER </th>
                  <th> TOTALS </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">LEVEL 1</td>
                  <td align="center" class="ptext"><?php echo $count_affiliate;?></td>
                  <td align="center" class="ptext"><?php echo $count_guru;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                </tr>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                </tr>
                <tr>
                  <th> DOLLAR AMOUNTS </th>
                  <th> DOLLAR AMOUNTS </th>
                  <th> DOLLAR AMOUNTS </th>
                  <th>&nbsp; </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">$<?php echo $total_r_com_total;?></td>
                  <td align="center" class="ptext">$<?php echo $total_a_com;?></td>
                  <td align="center" class="ptext">$<?php echo $total_g_com;?></td>
                  <td align="center" class="ptext">$<?php echo $total_r_com_total+$total_a_com+$total_g_com;?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext"><strong>UNPAID</strong></td>
                </tr>
              </tfoot>
<?php
}
else if($id!=1234567 && $category_two && $category_three)
{
?>
<thead>
                <tr>
                  <th> USER NAME: <?php echo $_SESSION['SD_User_Name'];?> </th>
                  <th> USER ID: <?php echo showuserid($_SESSION['SD_User_Name']);?> </th>
                  <th> STARTING DATE:
                    <?php  echo date('m/01/Y');?>
                  </th>
                  <th> CLOSING DATE:
                    <?php  echo date('m/t/Y');?>
                  </th>
                  
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  
                </tr>
                <tr>
                  <th> RESIDAUL INCOME </th>
                  
                  <th> AFFILIATE REFERRAL </th>
                  <th>&nbsp;</th>
                  <th> TOTALS </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">LEVEL 1</td>
                  
                  <td align="center" class="ptext"><?php echo $count_affiliate;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                </tr>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>

                </tr>
                <tr>
                  <th> DOLLAR AMOUNTS </th>
                  
                  <th> DOLLAR AMOUNTS </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">$<?php echo $total_r_com_total;?></td>
                  
                  <td align="center" class="ptext">$<?php echo $total_a_com;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">$<?php echo $total_r_com_total+$total_a_com;?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext"><strong>UNPAID</strong></td>
                </tr>
              </tfoot>
<?php
}
else if($category_two)
{
?>
<thead>
                <tr>
                  <th> USER NAME: <?php echo $_SESSION['SD_User_Name'];?> </th>
                  <th> USER ID: <?php echo showuserid($_SESSION['SD_User_Name']);?> </th>
                  <th> STARTING DATE:
                    <?php  echo date('m/01/Y');?>
                  </th>
                  <th> CLOSING DATE:
                    <?php  echo date('m/t/Y');?>
                  </th>
                  
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  
                </tr>
                <tr>
                  <th> RESIDAUL INCOME </th>
                  
                  <th> AFFILIATE REFERRAL </th>
                  <th>&nbsp;</th>
                  <th> TOTALS </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">LEVEL 1</td>
                  
                  <td align="center" class="ptext">Not Active</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                </tr>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>

                </tr>
                <tr>
                  <th> DOLLAR AMOUNTS </th>
                  
                  <th> DOLLAR AMOUNTS </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">$<?php echo $total_r_com_total;?></td>
                  
                  <td align="center" class="ptext">None</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">$<?php echo $total_r_com_total;?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext"><strong>UNPAID</strong></td>
                </tr>
              </tfoot>
<?php
}
else if($category_three)
{
?>
<thead>
                <tr>
                  <th> USER NAME: <?php echo $_SESSION['SD_User_Name'];?> </th>
                  <th> USER ID: <?php echo showuserid($_SESSION['SD_User_Name']);?> </th>
                  <th> STARTING DATE:
                    <?php  echo date('m/01/Y');?>
                  </th>
                  <th> CLOSING DATE:
                    <?php  echo date('m/t/Y');?>
                  </th>
                  
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  
                </tr>
                <tr>
                  <th> RESIDAUL INCOME </th>
                  
                  <th> AFFILIATE REFERRAL </th>
                  <th>&nbsp;</th>
                  <th> TOTALS </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">Not Active</td>
                  
                  <td align="center" class="ptext"><?php echo $count_affiliate;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                </tr>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>

                </tr>
                <tr>
                  <th> DOLLAR AMOUNTS </th>
                  
                  <th> DOLLAR AMOUNTS </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">None</td>
                  
                  <td align="center" class="ptext">$<?php echo $total_a_com;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">$<?php echo $total_a_com;?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext"><strong>UNPAID</strong></td>
                </tr>
              </tfoot>
<?php
}
?>
            </table>
 
 <?php

 if($category_two && $bonus && $count_abonus)
 {
 ?>           
            <table class="display">
              <thead>
                <tr>
                  <th> USER NAME: <?php echo $_SESSION['SD_User_Name'];?> </th>
                  <th> USER ID: <?php echo showuserid($_SESSION['SD_User_Name']);?> </th>
                   <th>&nbsp; </th>
                  <th> CLOSING DATE:
                    <?php  echo date('m/t/Y');?>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                 
                </tr>
                <tr>
                  <th> RESIDAUL INCOME </th>
                  <th> QUICK START BONUS </th>
                  <th>&nbsp;  </th>
                  
                  <th> TOTALS </th>
                </tr>
                <tr>
                  <td align="center" class="ptext">LEVEL 1</td>
                  <td align="center" class="ptext"><?php echo $count_abonus*5;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  
                </tr>
                <tr>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  <th>&nbsp; </th>
                  
                </tr>
                <tr>
                  <th> DOLLAR AMOUNTS </th>
                  <th> DOLLAR AMOUNTS </th>
                  <th>&nbsp;  </th>
                  <th>&nbsp;  </th>
                  
                </tr>
                <tr>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">$<?php echo $total_b_com;?></td>
                  <td align="center" class="ptext">&nbsp;</td>
                  
                  <td align="center" class="ptext">$<?php echo $total_b_com;?></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  <td align="center" class="ptext">&nbsp;</td>
                  
                  <td align="center" class="ptext"><strong>UNPAID</strong></td>
                </tr>
              </tfoot>
            </table>
<?php } ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>