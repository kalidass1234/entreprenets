<?php 
//include('../includes/all_func_admin.php');
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/page_acess.php');

include('header.php');
include("pagination.php");
$id ='';
if(isset($_REQUEST['user_id']))
{
	$id = $_REQUEST['user_id'];	
}
if(isset($_REQUEST['stage']))
{
	$stage = $_REQUEST['stage'];
}
else
{
	$stage = 1;	
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
	
		$str="select * from board_status where board_owner_id='$id' and package_id = '$package_amount' AND upper_id = '$id' AND board_number= '$stage' ORDER BY cell_no ASC LIMIT 1,1 ";
		$res=mysql_query($str);
		$x=mysql_fetch_array($res);
	
	
		if($stage=='1')
		{
			$quer2="select * from board_status where board_owner_id='$id' and package_id = '140.00' AND board_number= '$stage' AND upper_id = '$id' ORDER BY cell_no ASC LIMIT 1,3";
			$data2=mysql_query($quer2);
			while($x2=mysql_fetch_array($data2))
			{
			$arr2[]=$x2;
			}
			//print_r($arr2);
			$ro2=mysql_num_rows($data2);
		}
		else
		{
			$quer2="select * from board_status where board_owner_id='$id' and package_id = '140.00' AND board_number= '$stage' AND upper_id = '$id' ORDER BY cell_no ASC LIMIT 0,3";
			$data2=mysql_query($quer2);
			while($x2=mysql_fetch_array($data2))
			{
			$arr2[]=$x2;
			}
			//print_r($arr2);
			$ro2=mysql_num_rows($data2);
		}

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
<script>
function changehistorys(val,user_id){
	$.post('ajax1.php?mode=changehistory',{'val':val},function(data){
	});
	if(val!='' && val!='<?=$_SESSION['changehistoryval'];?>'){
	  var con=confirm("Do you want to change Circle?"); 
	  if(con==true){
		document.location.href='admin_main.php?page_number=205&user_id='+user_id+'&stage='+val;
		return true;
	  } else {
		return false;
	  }
	}
}
</script>
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
	<div id="header" class="blue_lin">
		<div class="header_left">
			<?php
			//include('header-left.php');
			?>
			<?php
			//include('menu-mobile.php');
			?>
		</div>
		<?php
		//include('header-right.php');
		?>
	</div>
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>My Board</h3>
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
					<div class="widget_top" id="checkloading">
						<span class="h_icon list_image"></span>
						<h6>MY Board</h6>
                        <?php
						
						if($id!='')
						{
						?>
                        <h6>Circle - <?=$stage;?></h6>
                        <h6>History - 
                            <select name="history" id="history" onChange="changehistorys(this.value,<?=$id?>);">
                                <option value="">Select</option>
                            <?php for($i=1; $i<25; $i++){ ?>
                                <option value="<?=$i?>" <?php if($i==$_GET['stage']){?> selected <?php }?> ><?=$i?></option>
                            <?php } ?>   
                            </select>
                        </h6>
<?php } ?>
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
					
					$str="select * from registration where user_id='$id' ";
					$res=mysql_query($str);
					$x=mysql_fetch_array($res);

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
<a href="tree_new.php?id=<?=$id?>" class="tooltip1">
    <img id="menu" src="<?php 
					  if(_check_member_status($id)==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($id)==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($id)==4){ ?>tree_new.php_files/director.png<?php } //else if($x['image']){ echo "userimages/".$x['image'];} else {?>../paymentimage/<?=$img?><?php // }?>" width="32" height="32" />
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>

                      
				
                                          <table width="98%" border="0" cellspacing="1" cellpadding="1">
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
					  </td>
                    </tr>
                </table></td>

                                        </tr>
<tr>
                <td align="center" style="color:#3399FF;"><?=$id?></td>
              </tr>
              <tr>
                <td align="center" style="color:#3399FF;"><?=$x[user_name];?></td>
              </tr>
              <tr>
                <td align="center" style="color:#3399FF;">$<?=$x[package_amount];?></td>
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
                                        <tr>
                                          <td align="left" valign="top"><table width="100%" border="0">
                                            <tr>
<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align:center;">
                    <tr>
                      <?
					   for($i=1;$i<=3;$i++)
					   { 
						  if($i<=$ro2){
							$d=$arr2[$i-1][3];
							
							$str2="select * from registration where user_id='$d' and package_amount = '140.00'";
							$res2=mysql_query($str2);
							$x2=mysql_fetch_array($res2);
							$name2=$x2['first_name']." ".$x2['mid_name']." ".$x2['last_name'];

							$package2=$x2['plan_name'];
							$useridd=$d;

							$count_subs1=1;
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
					  ?>  
  <td>
  <a href="" class="tooltip1">
    <img id="menu<?=$i ?>" src= "../paymentimage/<?=$img?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>
  
                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$d ?></td>
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
                                        </a></td>
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
					$d=$arr2[$i-1][3];
					$str2="select * from registration where user_id='$d' and package_amount = '140.00'";
					$res2=mysql_query($str2);
					$x2=mysql_fetch_array($res2);
					$name2=$x2['user_name'];

					$package2=$x2['plan_name'];
					$useridd=$d;			   // find the member status
				    $userid=$arr2[$i-1][4];
				    $sql_stat="select * from registration where user_id='$userid'";
				    $res_stat=mysql_query($sql_stat);
				    $row_stat=mysql_fetch_assoc($res_stat);
	
					$count_subs1=1;
					if($count_subs1)
					{
				  ?>
              <td><? echo $useridd."<br>".$name2."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
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
                     
			   <?php
			   for($i=1;$i<=3;$i++)
			   { 

					$quer3="select * from board_status where board_owner_id='".$id."' and package_id = '70.00' AND board_number= '$stage' AND upper_id = '$id' ORDER BY cell_no ASC LIMIT 3,6";
					$data3=mysql_query($quer3);
					while($x3=mysql_fetch_array($data3))
					{
					$arr3[]=$x3;
					}

					$ro3=mysql_num_rows($data3);
					
					if($i<=$ro3){
					$d=$arr3[$i-1][3];
					
					$str3="select * from registration where user_id='$d' and package_amount = '140.00'";
					$res3=mysql_query($str3);
					$x3=mysql_fetch_array($res3);
					$name3=$x3['first_name']." ".$x3['mid_name']." ".$x3['last_name'];
					
					$package3=$x3['plan_name'];
					$useridd=$d;

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
					
					  ?>  
<td>
<a href="" class="tooltip1">
   <img id="menu<?=$i ?>" src="../paymentimage/<?=$img?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>
  
                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$d ?></td>
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
                                        </a></td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='' /></td>";
					}
			}
			elseif($i==$ro3+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>";
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
				   if($i<=$ro3)
				   {
					   $userid=$arr3[$i-1][3];
					   $sql_stat="select * from registration where user_id='$userid' and package_amount = '140.00'";
					   $res_stat=mysql_query($sql_stat);
					   $row_stat=mysql_fetch_assoc($res_stat);

						$count_subs1=1;
						if($count_subs1)
						{
			  ?>
          <td><? echo $arr3[$i-1][3]."<br>".$row_stat['user_name']."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
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

                    <tr>
                     
                
                      <?
			   for($i=1;$i<=3;$i++)
			   { 
			   
					$quer4="select * from board_status where board_owner_id='".$id."' and package_id = '70.00' AND board_number= '$stage' AND upper_id = '$id' ORDER BY cell_no ASC LIMIT 6,9";
					$data4=mysql_query($quer4);
					while($x4=mysql_fetch_array($data4))
					{
					$arr4[]=$x4;
					}

					$ro4=mysql_num_rows($data4);

					if($i<=$ro4){
					
					$d=$arr4[$i-1][3];
					$str4="select * from registration where user_id='$d' and package_amount = '140.00'";
					$res4=mysql_query($str4);
					$x4=mysql_fetch_array($res4);
					$name4=$x4['first_name']." ".$x4['mid_name']." ".$x4['last_name'];
					
					$package4=$x4['plan_name'];
					$useridd=$arr4[$i-1][3];

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
					
					  ?>  
<td>
<a href="" class="tooltip1">
<img id="menu<?=$i ?>" src="../paymentimage/<?=$img?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>
  
                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr4[$i-1][3] ?></td>
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
                                        </a></td>
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
					$d=$arr4[$i-1][3];
					
					$str4="select * from registration where user_id='$d' and package_amount = '140.00'";
					$res4=mysql_query($str4);
					$x4=mysql_fetch_array($res4);
					$name4=$x4['user_name'];

					$useridd=$arr4[$i-1][3];
					
				$count_subs1=1;
				if($count_subs1)
				{
			  ?>
          <td><? echo $d."<br>".$name4."<br>"."$".$x4['package_amount'];?><br><?php if($x4[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
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

					$quer5="select * from board_status where board_owner_id='".$id."' and package_id = '70.00' AND board_number= '$stage' AND upper_id = '$id' ORDER BY cell_no ASC LIMIT 9,12";
					$data5=mysql_query($quer5);
					while($x5=mysql_fetch_array($data5))
					{
					$arr5[]=$x5;
					}
					//print_r($arr3);
					$ro5=mysql_num_rows($data5);

					if($i<=$ro5){
					$d=$arr5[$i-1][3];
					$str5="select * from registration where user_id='$d' and package_amount = '140.00'";
					$res5=mysql_query($str5);
					$x5=mysql_fetch_array($res5);
					$name5=$x5['first_name']." ".$x5['mid_name']." ".$x5['last_name'];
					
					$package5=$x5['plan_name'];
					$useridd=$arr5[$i-1][0];
					
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
					
					  ?>  
                      <td>
<a href="" class="tooltip1">
<img id="menu<?=$i ?>" src="../paymentimage/<?=$img?>" width="32" height="32" border="0"/>
    <span>
        <img class="callout" src="images/callout.gif" />
        <strong>

					 
                               <table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr5[$i-1][3] ?></td>
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
                                        </div></td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='' /></td>";
					}
			}
			elseif($i==$ro5+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>";
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
				   if($i<=$ro5)
				   {

				   // find the member status
				   $userid=$arr5[$i-1][3];
				   $sql_stat="select * from registration where user_id='$userid' and package_amount = '140.00' ";
				   $res_stat=mysql_query($sql_stat);
				   $row_stat=mysql_fetch_assoc($res_stat);
				   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
					$res_subs1=mysql_query($sql_subs1);
					$count_subs1=1;
					if($count_subs1)
					{
			  ?>
          <td><? echo $arr5[$i-1][3]."<br>".$row_stat['user_name']."<br>"."$".$row_stat['package_amount'];?><br><?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
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