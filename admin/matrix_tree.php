<?php 
//include('../includes/all_func_admin.php');
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/page_acess.php');

include('header.php');
include("pagination.php");

if(isset($_REQUEST['user_id']))
{
	$id = $_REQUEST['user_id'];	
}
if(isset($_REQUEST['search']) || $_REQUEST['user_id'])
{
	$id = $_REQUEST['user_id'];


	if($id!='')
	{

		//check_page_access($_SESSION['SD_User_Name'],'personal');// page permission for business and personal user.	

	$regdate_ip = getenv('REMOTE_ADDR');
	$s="select * from registration where (user_name='$id' OR user_id='$id')";
	
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$id=$f['user_id'];
	$package_amount=$f['package_amount'];

	$str="select * from registration where user_id='$id' and package_amount = '$package_amount'";

	$res=mysql_query($str);
	$x=mysql_fetch_array($res);
	$ref_id=$x['ref_id'];
	$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
	$category_one=$x['category_one'];
	$category_two=$x['category_two'];
	$category_three=$x['category_three'];
	
	$sltsub=mysql_query("select max(subs_date) from subscription5 where user_id='$id'");
	$sub_date=date("m t Y",strtotime(@mysql_result($sltsub,0,0)));
	
	$l1=$x['left_count'];
	$r1=$x['right_count'];
	$sl1=$x['sleft_count'];
	$sr1=$x['sright_count'];
	$usl1=$l1-$sl1;
	$usr1=$r1-$sr1;
	
	$quer2="select user_id,user_name,plan_name from registration where nom_id='$id' and package_amount = '$package_amount' order by id";
	$data2=mysql_query($quer2);
	while($x2=mysql_fetch_array($data2))
	{
	$arr2[]=$x2;
	}
	//print_r($arr2);
	$ro2=mysql_num_rows($data2);
	}
}
else
{
	//echo "<script language='javascript'>window.location.href='login.php';
}


function _check_member_status($user_id)
{
	$sql="select * from subscription where user_id='$user_id' order by id desc limit 1";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['status'];
}
?>
<!-- Main content starts --><head>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<style>

a.tooltip1 {outline:none; }
a.tooltip1 strong {line-height:30px;}
a.tooltip1:hover {text-decoration:none;} 
a.tooltip1 span {
    z-index:10;display:none; padding:14px 20px;
    margin-top:-30px; margin-left:28px;
    width:300px; line-height:16px;
}
a.tooltip1:hover span{
    display:inline; position:absolute; color:#111;
    border:1px solid #DCA; background:#fffAF0;}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
    
/*CSS3 extras*/
a.tooltip1 span
{
    border-radius:4px;
    box-shadow: 5px 5px 8px #CCC;
}
</style>
</head>

<div class="content">
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends -->
  <!-- Main bar -->
  <div class="mainbar">
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Dashboard</h2>
      <div class="pull-right">
        <div id="reportrange" class="pull-right"> <i class="fa fa-calendar"></i> <span></span> <b class="caret"></b> </div>
      </div>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <!-- Divider -->
        <span class="divider">/</span> <a href="#" class="bread-current">Dashboard</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->
    <div class="matter">
      
      
      
      
      
      
      
      
      
      
      <!-- Make Tree -->
      <!-- Make Tree -->
      <!-- Make Tree -->
      <!-- Make Tree -->
      <!-- Make Tree -->      
      <!-- Make Tree -->
      <!-- Make Tree -->
      <!-- Make Tree -->
      <!-- Make Tree -->
      <!-- Make Tree -->  
      
      
      
<div id="container">
	
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>My Tree</h3>
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

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
         
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						
					</div>
					<div id="popup" style="z-index: 1000; position: absolute; border:1px solid; color:#999999; background-color:#E3E3E4; visibility:visible;"> </div>
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
						
						<tr>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>
							<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolorlight="#FFFFFF" border-collapse:="border-collapse:" collapse;="collapse;">
        <tbody>
		 <form action="" method="post" name="form_01">
         <input type="hidden" name="search" id= "search" value="1">
									<tr>
                                      
                                      <td width="400%" align="right" class="style56">Enter Username/User Id. </td>
                                      <td width="17%" align="left" class=""><label>
                                        <input name="user_id" type="text" id="user_id" value=""/>
                                        <input type="submit" name="Submit" class="btn_small btn_gray" value="Search" />
                                      </label></td>
									</tr>
									</form>
									<tr>
                                      
                                      <td width="400%" align="right" class="style56"><?php echo _check_member_status($id);?>&nbsp;</td>
                                      <td width="17%" align="left" class="">&nbsp;</td>
									</tr>
									<tr>
									  <td align="right" class="style56">&nbsp;</td>
									  <td align="left" class="">&nbsp;</td>
							  </tr>
									<tr>
									  <td colspan="2" align="left" valign="top" class="style56"><table width="100%" border="0">
                                        <tr>
                                          <!--<td align="center" valign="top"><div style="width:100px; height:100px; background:#ccc;"></div></td>-->
                                          
<td align="center" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                <?php
				$sql_Count="select * from registration where nom_id='$id' ";
				
				$res_sql_Count=mysql_query($sql_Count);
				$count_res_sql_Count=mysql_num_rows($res_sql_Count);
				if($count_res_sql_Count>0)
				{
					if($x['package_amount'] == '35.00')
					{
						$img = "35.png";	
					}
                    else if($x['package_amount'] == '70.00')
					{
						$img = "70.png";	
					}
                    else if($x['package_amount'] == '140.00')
					{
						$img = "70.png";
					}
					?>
                      <td align="center">
                      
                      <a href="#" class="tooltip1">
    <img id="menu" src="<?php 
					  if(_check_member_status($id)==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($id)==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($id)==4){ ?>tree_new.php_files/director.png<?php } //else if($x['image']){ echo "userimages/".$x['image'];} else {?>../paymentimage/<?=$img?><?php // }?>" width="32" height="32" />
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong><table width="98%" border="0" cellspacing="1" cellpadding="1">
                                            <tr>
                                              <td align="left">User ID</td>
                                              <td align="left"><?=$id ?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">Full  Name</td>
                                              <td align="left"><?=$name ?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">Mobile</td>
                                              <td align="left"><?=$x[mobile]?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">Country</td>
                                              <td align="left"><?=$x['country'];?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">Email</td>
                                              <td align="left"><?php echo $x['email']; ?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">Sponsor  ID</td>
                                              <td align="left"><?php echo $x['ref_id']; ?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">Member</td>
                                              <td align="left"><?=$x[total_count];?></td>
                                            </tr>
                                            <tr>
                                              <td align="left">D.O.J</td>
                                              <td align="left"><?php echo $date=date("m-d-Y", strtotime($x[reg_date])); ?></td>
                                            </tr>
                                          </table>
    </span>
</a>

<!--Second tooltip-->

                      
                    
					  </td>
                      <?php } else { ?>
						<td align="center"><img src='tree_new.php_files/free.png' border='0' width='' /></td>
					<?php } ?>

                    </tr>
                </table></td>

                                        </tr>
<?php

$sql_Count="select * from registration where nom_id='$id' ";
$res_sql_Count=mysql_query($sql_Count);
$count_res_sql_Count=mysql_num_rows($res_sql_Count);
if($count_res_sql_Count>0)
{?>
<tr>
                <td align="center" style="color:#3399FF;"><?=$id?></td>
              </tr>
              <tr>
                <td align="center" style="color:#3399FF;"><?=$x[user_name];?></td>
              </tr>
              <tr>
                <td align="center" style="color:#3399FF;">$<?=$x[package_amount];?></td>
              </tr>
                      <?php } else { ?>
						<td align="center"><font color="#39F">Empty</font></td>
					  <?php } ?>
                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>                                        
                                        <tr>
                                          <td align="left" valign="top"><table width="100%" border="0">
                                            <tr>
                                             <!-- <td align="center"><div style="width:100px; height:100px; background:#ccc;"></div></td>
                                              <td align="center"><div style="width:100px; height:100px; background:#ccc;"></div></td>
                                              <td align="center"><div style="width:100px; height:100px; background:#ccc;"></div></td>-->
                                              
<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align:center;">
<!--                    <tr>
                      <td colspan="5"><div align="center"><img src="images/arrow.gif" width="2" height="45" /></div></td>
                    </tr>
                    <tr>
                      <?
			  for($i=1;$i<=3;$i++)
			   {
			   ?>
                      <td  class="binary_line1"><img src="images/arrow.gif" width="2" height="45" /></td>
                      <?
			   }
			   ?>
                    </tr>-->
                    <tr>
                     
                
                      <?
			   for($i=1;$i<=3;$i++)
			   { 
  if($i<=$ro2){
$d=$arr2[$i-1][0];
$str2="select * from registration where user_id='$d' and package_amount = '$package_amount'";
$res2=mysql_query($str2);
$x2=mysql_fetch_array($res2);
$name2=$x2['first_name']." ".$x2['mid_name']." ".$x2['last_name'];

$package2=$x2['plan_name'];
$useridd=$arr2[$i-1][0];
//$sql_subs1="select * from subscription where user_id='$useridd' and status=0 and type='2'";
//$res_subs1=mysql_query($sql_subs1);
$count_subs1=mysql_num_rows($res2);
if($count_subs1)
{

	if($x2['package_amount'] == '35.00')
	{
		$img = "35.png";	
	}
	else if($x2['package_amount'] == '70.00')
	{
		$img = "70.png";	
	}
	else if($x2['package_amount'] == '140.00')
	{
		$img = "70.png";
	}

  ?>  <td>
    <a href="admin_main.php?page_number=200&user_id=<?=$arr2[$i-1][0];?>" class="tooltip1">
    <img id="menu<?=$i ?>" src="<?php  if(_check_member_status($arr2[$i-1][0])==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($arr2[$i-1][0])==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($arr2[$i-1][0])==4){ ?>tree_new.php_files/director.png<?php } //else if($x2['image']){ echo "userimages/".$x2['image'];} else {?>../paymentimage/<?=$img?><?php //}?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>
        

                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr2[$i-1][0] ?></td>
									  </tr>
									  <tr>
										<td align="left">Full  Name</td>
										<td align="left"><?=$name2 ?></td>
									  </tr>
									  <tr>
										<td align="left">Mobile</td>
										<td align="left"><?=$x2[mobile]?></td>
									  </tr>
									  <tr>
										<td align="left">Country</td>
										<td align="left"><?=$x2['country'];?></td>
									  </tr>
									  <tr>
										<td align="left">Email</td>
										<td align="left"><?php echo $x2['email']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left"><?php echo $x2['ref_id']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Member</td>
										<td align="left"><?=$x2[total_count];?></td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left"><?php echo $date2=date("d-m-y", strtotime($x2[reg_date])); ?></td>
									  </tr>
									</table>
                                    </span>
                                    </a>
                                        </div></td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='' /></td>";
					}
			}
			elseif($i==$ro2+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>"; //"../personal_signup.php?nom=$id&ref=$id";
			}
			else
			{
			?>
			<td><img src="tree_new.php_files/free.png" border="0" width="" /></td>
			<?
			}
				}
				?>
          </tr>
          <tr style="color:#3399FF;">
              <?php
			   for($i=1;$i<=3;$i++)
			   {
			  // print_r($arr2[$i-1]);
			   if($i<=$ro2)
			   {
			   // find the member status
			   $userid=$arr2[$i-1][0];
			   $sql_stat="select mem_status,package_amount from registration where user_id='$userid' and package_amount = '$package_amount'";
			   $res_stat=mysql_query($sql_stat);
			   $row_stat=mysql_fetch_assoc($res_stat);
			   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
				$res_subs1=mysql_query($sql_subs1);
				$count_subs1=mysql_num_rows($res2);
				if($count_subs1)
				{
			  ?>
          <td><? echo $arr2[$i-1][0]."<br>".$arr2[$i-1][1]."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
              <?
			  }
			  else
			  {
			  echo " <td>Empty</td>";
			  }
				}
				elseif($i==$ro2+1)
				echo " <td>Empty</td>";
				else
				echo " <td>Empty</td>";
				}
				?>
         </tr>
         </table></td>
               </tr>
                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>  

                                          </table></td>
                                        </tr>
                                      </table></td>
							  </tr>
									<tr>
									  <td colspan="2" align="left" valign="top" class="style56"><table width="100%" border="0">
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      <!-- LAST LEVEL-->
                                      
                                      
                                        <tr>
     									  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align:center;">
<!--                    <tr>
                      <td colspan="5"><div align="center"><img src="images/arrow.gif" width="2" height="45" /></div></td>
                    </tr>
                    <tr>
                      <?
			  for($i=1;$i<=3;$i++)
			   {
			   ?>
                      <td  class="binary_line1"><img src="images/arrow.gif" width="2" height="45" /></td>
                      <?
			   }
			   ?>
                    </tr>-->
                    <tr>
                     
                
                      <?
			   for($i=1;$i<=3;$i++)
			   { 
$quer3="select user_id,user_name,plan_name from registration where nom_id='".$arr2[0][0]."' and package_amount = '$package_amount' order by id";
$data3=mysql_query($quer3);
while($x3=mysql_fetch_array($data3))
{
$arr3[]=$x3;
}
//print_r($arr3);
$ro3=mysql_num_rows($data3);


  if($i<=$ro3){
$d=$arr3[$i-1][0];
$str3="select * from registration where user_id='$d' and package_amount = '$package_amount'";
$res3=mysql_query($str3);
$x3=mysql_fetch_array($res3);
$name3=$x3['first_name']." ".$x3['mid_name']." ".$x3['last_name'];

$package3=$x3['plan_name'];
$useridd=$arr3[$i-1][0];
//$sql_subs1="select * from subscription where user_id='$useridd' and status=0 and type='2'";
//$res_subs1=mysql_query($sql_subs1);
$count_subs1=1;
if($count_subs1)
{

	if($x3['package_amount'] == '35.00')
	{
		$img = "35.png";	
	}
	else if($x3['package_amount'] == '70.00')
	{
		$img = "70.png";	
	}
	else if($x3['package_amount'] == '140.00')
	{
		$img = "70.png";
	}

  ?>  <td>
      <a href="admin_main.php?page_number=200&user_id=<?=$arr3[$i-1][0];?>" class="tooltip1">
    <img id="menu<?=$i ?>" src="<?php  if(_check_member_status($arr3[$i-1][0])==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($arr3[$i-1][0])==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($arr3[$i-1][0])==4){ ?>tree_new.php_files/director.png<?php } //else if($x2['image']){ echo "userimages/".$x2['image'];} else {?>../paymentimage/<?=$img?><?php //}?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>

                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr3[$i-1][0] ?></td>
									  </tr>
									  <tr>
										<td align="left">Full  Name</td>
										<td align="left"><?=$name3 ?></td>
									  </tr>
									  <tr>
										<td align="left">Mobile</td>
										<td align="left"><?=$x3[mobile]?></td>
									  </tr>
									  <tr>
										<td align="left">Country</td>
										<td align="left"><?=$x3['country'];?></td>
									  </tr>
									  <tr>
										<td align="left">Email</td>
										<td align="left"><?php echo $x3['email']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left"><?php echo $x3['ref_id']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Member</td>
										<td align="left"><?=$x3[total_count];?></td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left"><?php echo $date3=date("d-m-y", strtotime($x3[reg_date])); ?></td>
									  </tr>
									</table>
                                    </span>
                                   </a>
                                        </div></td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='' /></td>";
					}
			}
			elseif($i==$ro3+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>"; //"../personal_signup.php?nom=$id&ref=$id";
			}
			else
			{
			?>
			<td><img src="tree_new.php_files/free.png" border="0" width="" /></td>
			<?
			}
				}
				?>
          </tr>
          <tr style="color:#3399FF;">
              <?php
			   for($i=1;$i<=3;$i++)
			   {
			   //print_r($arr3[$i-1]);

			   if($i<=$ro3)
			   {
				   
			   // find the member status
			   $userid=$arr3[$i-1][0];
			   $sql_stat="select mem_status,package_amount from registration where user_id='$userid' and package_amount = '$package_amount'";
			   $res_stat=mysql_query($sql_stat);
			   $row_stat=mysql_fetch_assoc($res_stat);
			   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
				$res_subs1=mysql_query($sql_subs1);
				$count_subs1=1;
				if($count_subs1)
				{
			  ?>
          <td><? echo $arr3[$i-1][0]."<br>".$arr3[$i-1][1]."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
              <?
			  }
			  else
			  {
			  echo " <td>Empty</td>";
			  }
				}
				elseif($i==$ro3+1)
				echo " <td>Empty</td>";
				else
				echo " <td>Empty</td>";
				}
				?>
         </tr>
         </table></td>
         
         
         
         
         
         
         
         
         
         
         
         
         
										  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align:center;">
<!--                    <tr>
                      <td colspan="5"><div align="center"><img src="images/arrow.gif" width="2" height="45" /></div></td>
                    </tr>
                    <tr>
                      <?
			  for($i=1;$i<=3;$i++)
			   {
			   ?>
                      <td  class="binary_line1"><img src="images/arrow.gif" width="2" height="45" /></td>
                      <?
			   }
			   ?>
                    </tr>-->
                    <tr>
                     
                
                      <?
			   for($i=1;$i<=3;$i++)
			   { 
$quer4="select user_id,user_name,plan_name from registration where nom_id='".$arr2[1][0]."' and package_amount = '$package_amount' order by id";
$data4=mysql_query($quer4);
while($x4=mysql_fetch_array($data4))
{
$arr4[]=$x4;
}
//print_r($arr3);
$ro4=mysql_num_rows($data4);


  if($i<=$ro4){
$d=$arr4[$i-1][0];
$str4="select * from registration where user_id='$d' and package_amount = '$package_amount'";
$res4=mysql_query($str4);
$x4=mysql_fetch_array($res4);
$name4=$x4['first_name']." ".$x4['mid_name']." ".$x4['last_name'];

$package4=$x4['plan_name'];
$useridd=$arr4[$i-1][0];
//$sql_subs1="select * from subscription where user_id='$useridd' and status=0 and type='2'";
//$res_subs1=mysql_query($sql_subs1);
$count_subs1=1;
if($count_subs1)
{

	if($x4['package_amount'] == '35.00')
	{
		$img = "35.png";	
	}
	else if($x4['package_amount'] == '70.00')
	{
		$img = "70.png";	
	}
	else if($x4['package_amount'] == '140.00')
	{
		$img = "70.png";
	}

  ?>  <td>
        <a href="admin_main.php?page_number=200&user_id=<?=$arr4[$i-1][0];?>" class="tooltip1">
    <img id="menu<?=$i ?>" src="<?php  if(_check_member_status($arr4[$i-1][0])==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($arr4[$i-1][0])==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($arr4[$i-1][0])==4){ ?>tree_new.php_files/director.png<?php } //else if($x2['image']){ echo "userimages/".$x2['image'];} else {?>../paymentimage/<?=$img?><?php //}?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>

                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr4[$i-1][0] ?></td>
									  </tr>
									  <tr>
										<td align="left">Full  Name</td>
										<td align="left"><?=$name4 ?></td>
									  </tr>
									  <tr>
										<td align="left">Mobile</td>
										<td align="left"><?=$x4[mobile]?></td>
									  </tr>
									  <tr>
										<td align="left">Country</td>
										<td align="left"><?=$x4['country'];?></td>
									  </tr>
									  <tr>
										<td align="left">Email</td>
										<td align="left"><?php echo $x4['email']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left"><?php echo $x4['ref_id']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Member</td>
										<td align="left"><?=$x4[total_count];?></td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left"><?php echo $date4=date("d-m-y", strtotime($x4[reg_date])); ?></td>
									  </tr>
									</table>
                                    </span>
                                    </a>
                                        </div></td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='' /></td>";
					}
			}
			elseif($i==$ro4+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>"; //"../personal_signup.php?nom=$id&ref=$id";
			}
			else
			{
			?>
			<td><img src="tree_new.php_files/free.png" border="0" width="" /></td>
			<?
			}
				}
				?>
          </tr>
          <tr style="color:#3399FF;">
              <?php
			   for($i=1;$i<=3;$i++)
			   {
			   //print_r($arr3[$i-1]);

			   if($i<=$ro4)
			   {
				   
			   // find the member status
			   $userid=$arr4[$i-1][0];
			   $sql_stat="select mem_status,package_amount from registration where user_id='$userid' and package_amount = '$package_amount'";
			   $res_stat=mysql_query($sql_stat);
			   $row_stat=mysql_fetch_assoc($res_stat);
			   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
				$res_subs1=mysql_query($sql_subs1);
				$count_subs1=1;
				if($count_subs1)
				{
			  ?>
          <td><? echo $arr4[$i-1][0]."<br>".$arr4[$i-1][1]."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
              <?
			  }
			  else
			  {
			  echo " <td>Empty</td>";
			  }
				}
				elseif($i==$ro4+1)
				echo " <td>Empty</td>";
				else
				echo " <td>Empty</td>";
				}
				?>
         </tr>
         </table></td>









                                          
                                          <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align:center;">
<!--                    <tr>
                      <td colspan="5"><div align="center"><img src="images/arrow.gif" width="2" height="45" /></div></td>
                    </tr>
                    <tr>
                      <?
			  for($i=1;$i<=3;$i++)
			   {
			   ?>
                      <td  class="binary_line1"><img src="images/arrow.gif" width="2" height="45" /></td>
                      <?
			   }
			   ?>
                    </tr>-->
                    <tr>
                     
                
                      <?
			   for($i=1;$i<=3;$i++)
			   { 
$quer5="select user_id,user_name,plan_name from registration where nom_id='".$arr2[2][0]."' and package_amount = '$package_amount' order by id";
$data5=mysql_query($quer5);
while($x5=mysql_fetch_array($data5))
{
$arr5[]=$x5;
}
//print_r($arr3);
$ro5=mysql_num_rows($data5);


  if($i<=$ro5){
$d=$arr5[$i-1][0];
$str5="select * from registration where user_id='$d' and package_amount = '$package_amount'";
$res5=mysql_query($str5);
$x5=mysql_fetch_array($res5);
$name5=$x5['first_name']." ".$x5['mid_name']." ".$x5['last_name'];

$package5=$x5['plan_name'];
$useridd=$arr5[$i-1][0];
//$sql_subs1="select * from subscription where user_id='$useridd' and status=0 and type='2'";
//$res_subs1=mysql_query($sql_subs1);
$count_subs1=1;
if($count_subs1)
{

	if($x5['package_amount'] == '35.00')
	{
		$img = "35.png";	
	}
	else if($x5['package_amount'] == '70.00')
	{
		$img = "70.png";	
	}
	else if($x5['package_amount'] == '140.00')
	{
		$img = "70.png";
	}

  ?>  <td>
   <a href="admin_main.php?page_number=200&user_id=<?=$arr5[$i-1][0];?>" class="tooltip1">
    <img id="menu<?=$i ?>" src="<?php  if(_check_member_status($arr5[$i-1][0])==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($arr5[$i-1][0])==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($arr5[$i-1][0])==4){ ?>tree_new.php_files/director.png<?php } //else if($x2['image']){ echo "userimages/".$x2['image'];} else {?>../paymentimage/<?=$img?><?php //}?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>
  

                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr5[$i-1][0] ?></td>
									  </tr>
									  <tr>
										<td align="left">Full  Name</td>
										<td align="left"><?=$name5 ?></td>
									  </tr>
									  <tr>
										<td align="left">Mobile</td>
										<td align="left"><?=$x5[mobile]?></td>
									  </tr>
									  <tr>
										<td align="left">Country</td>
										<td align="left"><?=$x5['country'];?></td>
									  </tr>
									  <tr>
										<td align="left">Email</td>
										<td align="left"><?php echo $x5['email']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left"><?php echo $x5['ref_id']; ?></td>
									  </tr>
									  <tr>
										<td align="left">Member</td>
										<td align="left"><?=$x5[total_count];?></td>
									  </tr>
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left"><?php echo $date5=date("d-m-y", strtotime($x5[reg_date])); ?></td>
									  </tr>
									</table>
                                    </span>
                                    </a>
                                        </td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='' /></td>";
					}
			}
			elseif($i==$ro5+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>"; //"../personal_signup.php?nom=$id&ref=$id";
			}
			else
			{
			?>
			<td><img src="tree_new.php_files/free.png" border="0" width="" /></td>
			<?
			}
				}
				?>
          </tr>
          <tr style="color:#3399FF;">
              <?php
			   for($i=1;$i<=3;$i++)
			   {
			   //print_r($arr3[$i-1]);

			   if($i<=$ro5)
			   {
				   
			   // find the member status
			   $userid=$arr5[$i-1][0];
			   $sql_stat="select mem_status,package_amount from registration where user_id='$userid' and package_amount = '$package_amount' ";
			   $res_stat=mysql_query($sql_stat);
			   $row_stat=mysql_fetch_assoc($res_stat);
			   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
				$res_subs1=mysql_query($sql_subs1);
				$count_subs1=1;
				if($count_subs1)
				{
			  ?>
          <td><? echo $arr5[$i-1][0]."<br>".$arr5[$i-1][1]."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
              <?
			  }
			  else
			  {
			  echo " <td>Empty</td>";
			  }
				}
				elseif($i==$ro5+1)
				echo " <td>Empty</td>";
				else
				echo " <td>Empty</td>";
				}
				?>
         </tr>
         </table></td>
                                         
                                          <!--<td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>
                                          <td align="center"><div style="width:50px; height:50px; background:#ccc;"></div></td>-->
                                        </tr>
                                      </table></td>
							  </tr>
									<tr>
                                      
                                      <td width="400%" align="right" class="style56">&nbsp;</td>
                                      <td width="17%" align="left" class="">&nbsp;</td>
									</tr>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

              <tr>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
              </tr>                                    
                                    
                                    
<tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="paddin_td">
                    <td width="21%" align="center">BMC1 $35.00 </td>
                    <td width="26%" align="center"> BMC2 $70.00 </td>
                    <td width="23%" align="center">BMC3 $140.00 </td>
					
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
					 <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="center"><img src="../paymentimage/35.png" width="48" height="49" /></td>
                    <td align="center"><img src="../paymentimage/70.png" width="48" height="49" /></td>
					 <td align="center"><img src="../paymentimage/140.png" width="48" height="49" /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
					<td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>

          <tr>
            <td width="400%" colspan="2" align="left">
			
			<!------put the table for tree here-------------->			</td>
          </tr>
        </tbody>
      </table>
	  
						  </td>
						</tr>
						
					  </table>
				    
				</div>
			</div>
		</div>
		<span class="clear"></span>
		
	</div>
</div>      
      
      
      
      
      
  </div>
</div>
<!-- Mainbar ends -->
<!-- Content ends -->
<!-- Footer starts -->
<?php
include("footer.php");
?>