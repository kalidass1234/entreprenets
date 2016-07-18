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



$quer2="select user_id,user_name,plan_name, nom_id, ref_id, mem_status from registration where ref_id='$id' order by id";

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
	echo "<script language='javascript'>window.location.href='../login.php';</script>";exit;

}
include('header.php'); 
?>
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
.binary_line1 {
	background: url(images/topline.gif) no-repeat center top;
	border-top: solid #000 2px;
}
</style>
<style>
.flyout1 {
	position:absolute;
	width:300px;
	height:170px;
	background:#edf1ed;
	overflow: auto;
	border:1px solid #ccc;
	border-radius:5px;
	z-index:10000;
}
.flyout1 table td {
	padding:2px;
}
.hidden {
	visibility: hidden;
}
.flyout2, .flyout3, .flyout4, .flyout5 {
	position:absolute;
	width:300px;
	height:170px;
	background:#edf1ed;
	overflow: auto;
	border:1px solid #ccc;
	border-radius:5px;
	z-index:10000;
}
.flyout table td, .flyout2 table td, .flyout3 table td, .flyout4 table td, .flyout5 table td {
	padding:2px;
}
.hidden {
	visibility: hidden;
}
.flyout {
	position:absolute;
	width:300px;
	height:170px;
	background:#edf1ed;
	border:1px solid #ccc;
	border-radius:5px;
	z-index:10000;
}
.hidden1 {
	visibility: hidden;
}
.hidden2 {
	visibility: hidden;
}
.binary_line1 {
	background: url(images/tree2.png) no-repeat center top;
	border-top: 2px solid black;
}
.element {
	border-top:1px solid #000;
	height:10px;
	width: 92%;
}
.elementl {
	float:left;
	border-right:1px solid #000;
}
.elementr {
	float:left;
	border-left:1px solid #000;
}
.clear {
	clear:both;
}
.border-top {
border-top: 1px solid #000;
}
.border-left {
border-left: 1px solid #000;
}
.border-green{
	border-bottom:3px solid #090;
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
       
        <div class="widget_wrap" >
          <div class="widget_top" align="center"> 
            <h6>MY Unilevel TREE</h6>
          </div>
          <div id="popup" style="z-index: 1000; position: absolute; border:1px solid; color:#999999; background-color:#E3E3E4; visibility:visible;"> </div>
          <div style="overflow-x:scroll;">
          <div>
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center"><table width="100" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <?  
								if($x['package_amount'] == '35.00')
								{
									$img = "35.png";	
								}
								if($x['package_amount'] == '70.00')
								{
									$img = "70.png";	
								}
								if($x['package_amount'] == '140.00')
								{
									$img = "140.png";
								}


								 ?>
                              <td align="center"><div class="margint10 round-border"> <a href="#"  id="menu"  > <img src="../paymentimage/<?=$img; ?>" width="32" height="42"  id="menu_link2"/></a>  </div>
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
                                      <td align="left"><?php echo $date=date("d-m-y", strtotime($x[reg_date])); ?></td>
                                    </tr>
                                  </table>
                                </div></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                          <td height="20" style="padding-top:5px;" align="center"><?=$id?></td>
                        </tr>
                        <tr>
                          <td align="center"><?=$x[user_name]?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                                      <td colspan="<?=$ro2?>"><div align="center"><?php if($ro2>0){ ?><img src="images/line.png" width="2" height="45" /><?php } ?></div></td>
                                    </tr>
                        <tr>
                          <td align="center">
                         
                          <table width="100%" border="0">
                          
                            <tr>
                              <td><table width="100%" border="0">
                              <tr>  <?php
						  		 for($i=1;$i<=$ro2;$i++)
								{
									if($x2['package_amount'] == '35.00')
									{
										$img1 = "35.png";	
									}
									if($x2['package_amount'] == '70.00')
									{
										$img1 = "70.png";	
									}
									if($x2['package_amount'] == '140.00')
									{
										$img1 = "140.png";
									}
									$d=$arr2[$i-1][0];
									$str2="select * from registration where user_id='$d'";
									$res2=mysql_query($str2);
									$x2=mysql_fetch_array($res2);
									$name2=$x2['first_name']." ".$x2['mid_name']." ".$x2['last_name'];
									$package2='';
						  
						  ?>
                                  <td width="10%" class="<?=($i!=1)? 'border-top' : '' ?>">&nbsp;</td>
                                  <td width="10%" class="border-left <?=($i==$ro2)? '' : 'border-top' ?>">&nbsp;</td>
                               <? } ?> </tr>
                               
                    <tr><?	
						 	 for($i=1;$i<=$ro2;$i++)
									   {
									   
										    if($x2['package_amount'] == '35.00')
											{
												$img1 = "35.png";	
											}
											if($x2['package_amount'] == '70.00')
											{
												$img1 = "70.png";	
											}
											if($x2['package_amount'] == '140.00')
											{
												$img1 = "140.png";
											}
										 
										$d=$arr2[$i-1][0];
										 $str2="select * from registration where user_id='$d'";
										$res2=mysql_query($str2);
										$x2=mysql_fetch_array($res2);
										$name2=$x2['first_name']." ".$x2['mid_name']." ".$x2['last_name'];
										$package2='';
										$useridd=$arr2[$i-1][0];
					?>
                              <td align="center" colspan="2"><a id="menu<?=$i ?>" href="matrix_gen.php?id=<?=$arr2[$i-1][0]?>&level=<? if($_GET[level]!=''){echo $_GET[level]+1;}else{echo 2;}?>" <?= ($x2['ref_id']==$s_user) ? 'class=""' : '' ?>><img src="../paymentimage/<?=$img1; ?>" width="32" height="42"  id="menu_link"/></a>
                              
                              <div class="flyout<?=$i ?> hidden"><table width="98%" border="0" cellspacing="1" cellpadding="1">
									  <tr>
										<td align="left">User ID</td>
										<td align="left"><?=$arr2[$i-1][0] ?></td>
									  </tr>
									  <tr>
										<td align="left">Full  Name</td>
										<td align="left"><?=$name2 ?></td>
									  </tr>
									  <?php if($x2[mobile_down_view]==0){ ?>
									  <tr>
										<td align="left">Mobile</td>
										<td align="left"><?=$x2[mobile]?></td>
									  </tr>
									  <?php } ?>
									  <tr>
										<td align="left">Country</td>
										<td align="left"><?=$x2['country'];?></td>
									  </tr>
									  <?php if($x2[email_down_view]==0){ ?>
									  <tr>
										<td align="left">Email</td>
										<td align="left"><?php echo $x2['email']; ?></td>
									  </tr>
									  <?php } ?>
									  <tr>
										<td align="left">Sponsor  ID</td>
										<td align="left"><?php echo $x2['ref_id']; ?></td>
									  </tr>
									  
									  <tr>
										<td align="left">D.O.J</td>
										<td align="left"><?php echo $date2=date("m-d-Y", strtotime($x2[reg_date])); ?></td>
									  </tr>
									</table>
									</div>
                              
                              </td>
							  
							  
							  <?php
							}
							?></tr><tr>
								<?php
									for($i=1;$i<=$ro2;$i++)
									   {
									   
										  if($arr2[$i-1][5]>$date_check){$img1='represent.png';}
										 else $img1='affil.png';
										 
										$d=$arr2[$i-1][0];
										 $str2="select * from registration where user_id='$d'";
										$res2=mysql_query($str2);
										$x2=mysql_fetch_array($res2);
										$name2=$x2['first_name']." ".$x2['mid_name']." ".$x2['last_name'];
										$package2='';
									
								?>
                                
                                <td align="center" colspan="2"><table width="100%" border="0">
                                <!--<tr>
                                  <td>&nbsp;</td>
                                  <td class="border-green">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>-->
                                <tr>
                                  <td  colspan="3" align="center"><p style="padding:5px 0px 0px 0px; margin:0.2em 0"> <?=$arr2[$i-1][0]?></p></td>
                                  </tr>
                                <tr>
                                  <td colspan="3" align="center"> <?=$arr2[$i-1][1]?></td>
                                </tr>
                              </table>
                              
                              </td>
                               
                                <?php
								}
                                ?>
                                </tr>
                               </table>
                            </td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" id="table1">
                              <tr>
                                <td><p>&nbsp;</p>
                                  <p>&nbsp;</p>
                                  <p>&nbsp;</p>
                                 </td>
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

                              <tr></tr>
                            </table></td>
                        </tr>
                      </table>
                      </td>
                      </tr>
                      </table>
        </div>
        </div>
        </div>
      </div>
    </div>
    <span class="clear"></span> </div>
</div>
</body>
</html>
<script>
$("#menu").hover(function(){
    $('.flyout').toggleClass('hidden');
});
<?php for($i=1;$i<=$ro2;$i++){ ?>
$("#menu<?=$i ?>").hover(function(){
    $('.flyout<?=$i ?>').toggleClass('hidden');
});


<?php } ?>
</script>
<style type="text/css">
.flyout table td, .flyout2 table td{
padding:4px;
}
.hidden{
visibility: hidden;
}

.flyout{
position:absolute;
width:300px;
height:190px;
background:#edf1ed;
overflow: auto;
border:1px solid #ccc;
border-radius:5px;
z-index:10000;

}
<?php for($i=1;$i<=$ro2;$i++){ 
$ml=15*$i;
?>
.flyout<?=$i ?>{
	position:absolute;
width:290px;
height:200px;
background:#edf1ed;
overflow: auto;
border:1px solid #ccc;
border-radius:5px;
z-index:10000;
margin-left:-<?=$ml ?>px;
}
.flyout<?=$i ?> table td{
padding:4px;
}


<?php } ?>
</style>