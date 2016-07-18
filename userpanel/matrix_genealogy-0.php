<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
include('includes/page_acess.php');
session_start();
if(isset($_SESSION) && $_SESSION['adid'])
{
	//check_page_access($_SESSION['SD_User_Name'],'personal');// page permission for business and personal user.	
	$idd=$_SESSION['adid'];
	if(isset($_GET['msg']))
	$msg=$_REQUEST['msg'];
	else
	$msg='';
	$regdate_ip = getenv('REMOTE_ADDR');
	$s="select * from registration where user_name='$idd'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$id=$f['user_id'];
	
	$str="select * from registration where user_id='$id'";
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
	
	$quer2="select user_id,user_name,plan_name from registration where nom_id='$id' order by id";
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
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Welcome To BMC</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
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
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>

<script src="js/custom-scripts.js"></script>
<script language="javascript">
     function getname(PA)
    {
//   debugger;
       myval=PA;
        var temp = new Array();
        temp = myval.split(',');
//    if(temp[8] == "1")
//    {
//alert(temp[0]+'=='+temp[1]+'=='+temp[2]+'=='+temp[3]+'=='+temp[4]+'=='+temp[5]+'=='+temp[6]+'=='+temp[7]+'=='+temp[8]);
         val="<table width=310 border=1 bgcolor=red color='red' cellspacing=0 cellpadding=0  BorderColor=#215b3d  class=tabletext style='font-family:Arial, Helvetica, sans-serif;'><tr ><th height=31 align=left bgcolor=#000099 ><span style='font-size: 14px'><strong style='font-size:12px;color :#000' >User ID</strong></span></th><th bgcolor=#000099 style='font-size:12px;color :#000' align=left>"+temp[0]+"</th></tr><tr><th height=28 align=left  bgcolor=#000099 style='font-size:12px;color :#000'>Full  Name</th><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[1]+"</th></tr><tr><th height=28 align=left  bgcolor=#000099 style='font-size:12px;color :#000'> Country</th><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[2]+"</th></tr><tr><th height=28 align=left  bgcolor=#000099 style='font-size:12px;color :#000'> Email</th><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[3]+"</th></tr><tr bgcolor='#205932' style='color:#000;'><td width=75 height=28 bgcolor='#000099'><span style='font-size:12px;'><b>Sponsor  ID</b></span></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[4]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td width=75 height=28 bgcolor='#000099'><span style='font-size:12px;'><b>Sponsor Name</b></span></td><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[5]+"</th></tr><tr bgcolor='#fd7c01' style='color:#000;'><td height=28 width=175 bgcolor='#000099' style='font-size:12px;'><b>Total Member In Downline</b></td>  <td bgcolor='#000099' style='font-size:12px;'><b>"+temp[6]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td bgcolor='#000099' style='font-size:12px;'><b>D.O.J.</b></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[7]+"</b></td></tr></table>";



if(temp[0]!="" )
     {
      document.getElementById ("popup").innerHTML =val;
      document.getElementById ("popup").style.visibility ="visible";
      }

  var x =0,y = 0;
      if (document.pageYOffset)
       {
 x = window.event.clientX  ;
        /* get the mouse top position  */
        y = window.event.clientY + document.body.scrollTop + 40;
       }
       else if(document.documentElement && document.documentElement.scrollTop)
       {
 x = window.event.clientX  ;
        /* get the mouse top position  */
        y = window.event.clientY + document.body.scrollTop + 40;

      }
       else if(document.body)
       {
 
        x = window.event.clientX ;
      
        if(x > 418)
        {
             x = window.event.clientX-300 ;
             }
        /* get the mouse top position  */
        y = event.clientY + document.body.scrollTop + 35;
  
       }
       document.getElementById ("popup").style .posLeft =800;
        document.getElementById ("popup").style.posTop =y;

     
       //document.getElementById ("popup").style .width ="100%";
     
    }
 
     
    function empty()
    {
    document.getElementById ("popup").innerHTML ="";
    }
</script>
</head>
<style>
.binary_line1{background: url(tree_new.php_files/topline.gif) no-repeat ;border-top: solid #000 2px;}
</style>
<style>
.flyout1{
position:absolute;
width:300px;
height:170px;
background:#edf1ed;
overflow: auto;
border:1px solid #ccc;
border-radius:5px;
z-index:10000;
}
.flyout1 table td{
padding:2px;
}
.hidden{
visibility: hidden;
}
.flyout2 ,.flyout3, .flyout4 ,.flyout5{
position:absolute;
width:300px;
height:170px;
background:#edf1ed;
overflow: auto;
border:1px solid #ccc;
border-radius:5px;
z-index:10000;
}
.flyout table td, .flyout2 table td,.flyout3 table td,.flyout4 table td,.flyout5 table td{
padding:2px;
}
.hidden{
visibility: hidden;
}

.flyout{
position:absolute;
width:300px;
height:170px;
background:#edf1ed;

border:1px solid #ccc;
border-radius:5px;
z-index:10000;

}
.hidden1{
visibility: hidden;
}
.hidden2 {
visibility: hidden;
}

.element{
border-top:1px solid #000; height:10px; width: 92%;
}
.elementl{
float:left;
border-right:1px solid #000;

}
.elementr{
float:left;
border-left:1px solid #000;
}
.clear{
clear:both;
}
</style>
<body id="theme-default" class="full_block">
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
    <?php
		//include('switch-bar.php');
		$sql_ref="select * from registration where user_id='$ref_id'";
		$res_ref=mysql_query($sql_ref);
		$row_ref=mysql_fetch_assoc($res_ref);
		?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
         
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>MY TREE</h6>
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
		 <form action="tree_new.php?id=<?=$_POST[id];?>" method="get">
									<tr>
                                      
                                      <td width="400%" align="right" class="style56">Enter Username/User Id. </td>
                                      <td width="17%" align="left" class=""><label>
                                        <input name="id" type="text" id="id" />
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
                                          <td align="center"><img id="menu" src="<?php 
					  if(_check_member_status($id)==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($id)==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($id)==4){ ?>tree_new.php_files/director.png<?php } else if($x['image']){ echo "userimages/".$x['image'];} else {?>tree_new.php_files/executive.png<?php }?>" width="32" height="32" />
					  <div class="flyout hidden">
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
                                        </div>
					  </td>
                                        </tr>
			  <tr>
                <td align="center" style="color:#3399FF;"><?=$id?></td>
              </tr>
              <tr>
                <td align="center" style="color:#3399FF;"><?=$x[user_name];?></td>
              </tr>
              <?php if($row_stat[mem_status]){ ?>
               <tr>
                <td align="center" style="color:#3399FF;"><?php echo "<font color='red'>Inactive</font>";?></td>
              </tr>
              <?php }?>

                                        <tr>
                                          <td align="center" valign="top">&nbsp;</td>
                                        </tr>


                                        <tr>
                                          <td align="left" valign="top">
										  
										  <table width="100%" border="0">
							<tr>
							  <td colspan="5" align="center"><div align="center"><img src="images/arrow.gif" width="2" height="45" /></div></td>
							</tr>
							<tr>
							  <?
							   for($i=1;$i<=3;$i++)
							   {
							   ?>
							   		<td align="center" class="binary_line1"><img src="images/arrow.gif" width="2" height="45" /></td>
							   <?
							   }
							   ?>
							</tr>
                                            <tr>
                      <?
			   for($i=1;$i<=3;$i++)
			   { 
  if($i<=$ro2){
$d=$arr2[$i-1][0];
$str2="select * from registration where user_id='$d'";
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
  ?>  <td align="center"><a href="tree_new.php?id=<?=$arr2[$i-1][0]?>" target="_self"><img id="menu<?=$i ?>" src="<?php  if(_check_member_status($arr2[$i-1][0])==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($arr2[$i-1][0])==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($arr2[$i-1][0])==4){ ?>tree_new.php_files/director.png<?php } else if($x2['image']){ echo "userimages/".$x2['image'];} else {?>tree_new.php_files/executive.png<?php }?>" width="32" height="32" border="0"/></a>
					 <div class="flyout<?=$i ?> hidden">
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
                                  </div></td>
           <?
		   			}
					else
					{
						echo "<td><img src='tree_new.php_files/free.png' border='0' width='50' /></td>";
					}
			}
			elseif($i==$ro2+1)
			{
				echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>"; //"../personal_signup.php?nom=$id&ref=$id";
			}
			else
			{
			?>
			<td><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
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
			   $sql_stat="select mem_status from registration where user_id='$userid'";
			   $res_stat=mysql_query($sql_stat);
			   $row_stat=mysql_fetch_assoc($res_stat);
			   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
				$res_subs1=mysql_query($sql_subs1);
				$count_subs1=mysql_num_rows($res2);
				if($count_subs1)
				{
			  ?>
          <td align="center"><? echo $arr2[$i-1][0]."<br>".$arr2[$i-1][1];?><br>
            <?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
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
                                      </table></td>
							  </tr>
									<tr>
									  <td colspan="2" align="left" valign="top" class="style56">
									  <table width="100%" border="0">
<!--							<tr>
							  <td colspan="5"><div align="center"><img src="images/arrow.gif" width="2" height="45" /></div></td>
							</tr>-->
<!--							<tr>
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

				$quer3="select user_id,user_name,plan_name from registration where nom_id='".$arr2[0][0]."' order by id";
				$data3=mysql_query($quer3);
				while($x3=mysql_fetch_array($data3))
				{
				$arr3[]=$x3;
				}
				//print_r($arr3);
				$ro3=mysql_num_rows($data3);
//exit();
			   for($i=1;$i<=3;$i++)
			   { 
			   
					if($i<=$ro3){
					$d=$arr3[$i-1][0];
					$str3="select * from registration where user_id='$d'";
					$res3=mysql_query($str3);
					$x3=mysql_fetch_array($res3);
					$name3=$x3['first_name']." ".$x3['mid_name']." ".$x3['last_name'];
					
					$package3=$x3['plan_name'];
					$useridd=$arr3[$i-1][0];
					$sql_subs1="select * from registration where user_id='$useridd'";
					$res_subs1=mysql_query($sql_subs1);
					$count_subs1=mysql_num_rows($res3);
					if($count_subs1)
					{
					  ?><td align="center"><a href="tree_new.php?id=<?=$arr3[$i-1][0]?>" target="_self"><img id="menu<?=$i ?>" src="<?php  if(_check_member_status($arr3[$i-1][0])==1){ ?>tree_new.php_files/retailassociate.png<?php } else if(_check_member_status($arr3[$i-1][0])==2){ ?>tree_new.php_files/associate.png<?php } else if(_check_member_status($arr3[$i-1][0])==4){ ?>tree_new.php_files/director.png<?php } else if($x3['image']){ echo "userimages/".$x3['image'];} else {?>tree_new.php_files/executive.png<?php }?>" width="32" height="32" border="0"/></a>
					 <div class="flyout<?=$i ?> hidden">
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
                            </div></td>
								<?
								}
								else
								{
									echo "<td><img src='tree_new.php_files/free.png' border='0' width='50' /></td>";
								}
						}
						elseif($i==$ro2+1)
						{
							echo "<td><img src='tree_new.php_files/free.png' border='0' /></td>"; //"../personal_signup.php?nom=$id&ref=$id";
						}
						else
						{
						?>
						<td><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
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
			   if($i<=$ro3)
			   {
			   // find the member status
			   $userid=$arr3[$i-1][0];
			   $sql_stat="select mem_status from registration where user_id='$userid'";
			   $res_stat=mysql_query($sql_stat);
			   $row_stat=mysql_fetch_assoc($res_stat);
			   $sql_subs1="select * from subscription where user_id='$userid' and status=0 and type='2'";
				$res_subs1=mysql_query($sql_subs1);
				$count_subs1=mysql_num_rows($res2);
				if($count_subs1)
				{
			  ?>
          <td align="center"><? echo $arr3[$i-1][0]."<br>".$arr3[$i-1][1];?><br>
            <?php if($row_stat[mem_status]){ echo "<font color='red'>Inactive</font>";}?></td>
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

<!--
                                        <tr>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                          <td align="center"><img src="tree_new.php_files/free.png" border="0" width="50" /></td>
                                        </tr>-->
                                      </table></td>
							  </tr>
									<tr>
                                      
                                      <td width="400%" align="right" class="style56">&nbsp;</td>
                                      <td width="17%" align="left" class="">&nbsp;</td>
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
</body>
</html>
<script>
$("#menu").hover(function(){
    $('.flyout').toggleClass('hidden');
});

$("#menu1").hover(function(){
    $('.flyout1').toggleClass('hidden');
});
$("#menu2").hover(function(){
    $('.flyout2').toggleClass('hidden');
});
$("#menu3").hover(function(){
    $('.flyout3').toggleClass('hidden');
});
$("#menu4").hover(function(){
    $('.flyout4').toggleClass('hidden');
});
$("#menu5").hover(function(){
    $('.flyout5').toggleClass('hidden');
});
</script>
<?php
function _check_member_status($user_id)
{
	$sql="select * from subscription where user_id='$user_id' order by id desc limit 1";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['status'];
}
?>