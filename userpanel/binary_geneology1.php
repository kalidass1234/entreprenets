<?php

include('../includes/all_func.php');

error_reporting(E_ALL ^ E_NOTICE);

include('includes/page_acess.php');

session_start();

if(isset($_SESSION) && $_SESSION['SD_User_Name'])

{

	//check_page_access($_SESSION['SD_User_Name'],'personal');// page permission for business and personal user.	

$idd=$_SESSION['SD_User_Name'];

if(isset($_GET['msg']))

$msg=$_REQUEST['msg'];
else

$msg='';

$regdate_ip = getenv('REMOTE_ADDR');

$s="select * from registration where user_name='$idd'";

$r=mysql_query($s);

$f=mysql_fetch_array($r);

$id=$f['user_id'];
if(isset($_GET['id']) && $_GET['id']!='')
{
$id_show=$_GET['id'];
}
else
{
$id_show=$id;
}
$str="select * from registration where user_id='$id_show' or user_name='$id_show'";

$res=mysql_query($str);

$x=mysql_fetch_array($res);

$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];



$sltsub=mysql_query("select max(subs_date) from subscription5 where user_id='$id_show'");

$sub_date=date("m t Y",strtotime(@mysql_result($sltsub,0,0)));
$l1=$x['left_count'];

$r1=$x['right_count'];

$sl1=$x['sleft_count'];

$sr1=$x['sright_count'];

$usl1=$l1-$sl1;

$usr1=$r1-$sr1;


//purchasing callculation..
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

         val="<table width=310 border=1 bgcolor=red color='red' cellspacing=0 cellpadding=0  BorderColor=#215b3d  class=tabletext style='font-family:Arial, Helvetica, sans-serif;'><tr ><th height=31 align=left bgcolor=#000099 ><span style='font-size: 14px'><strong style='font-size:12px;color :#000' >User ID</strong></span></th><th bgcolor=#000099 style='font-size:12px;color :#000' align=left>"+temp[0]+"</th></tr><tr><th height=28 align=left  bgcolor=#000099 style='font-size:12px;color :#000'>Full  Name</th><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[1]+"</th></tr><tr><th height=28 align=left  bgcolor=#000099 style='font-size:12px;color :#000'> Email</th><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[2]+"</th></tr><tr><th height=28 align=left  bgcolor=#000099 style='font-size:12px;color :#000'> Mobile</th><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[3]+"</th></tr><tr bgcolor='#205932' style='color:#000;'><td width=75 height=28 bgcolor='#000099'><span style='font-size:12px;'><b>D.O.J</b></span></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[4]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td width=75 height=28 bgcolor='#000099'><span style='font-size:12px;'><b>PlaceMent ID</b></span></td><th bgcolor=#000099 align=left style='font-size:12px;color :#000'>"+temp[5]+"</th></tr><tr bgcolor='#fd7c01' style='color:#000;'><td height=28 width=175 bgcolor='#000099' style='font-size:12px;'><b>PlaceMent Name</b></td>  <td bgcolor='#000099' style='font-size:12px;'><b>"+temp[6]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td  height=28 bgcolor='#000099' style='font-size:12px;'><b>Sponser ID</b></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[7]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td  height=28 bgcolor='#000099' style='font-size:12px;'><b>Sponser Name</b></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[8]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td height=28 bgcolor='#000099' style='font-size:12px;'><b>Left Count/Right</b></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[9]+"</b>/"+temp[10]+"</td></tr><tr bgcolor='#205932' style='color:#000;'><td  height=28 bgcolor='#000099' style='font-size:12px;'><b>C.Month Purch. Left/Right</b></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[11]+"/"+temp[12]+"</b></td></tr><tr bgcolor='#205932' style='color:#000;'><td height=28 bgcolor='#000099' style='font-size:12px;'><b>Total Purch.Left/Right</b></td><td bgcolor='#000099' style='font-size:12px;'><b>"+temp[13]+"/"+temp[14]+"</b></td></tr></table>";
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
.border-green {
	border-bottom:3px solid #090;
}
.border-red {
	border-bottom:3px solid #FF0000;
}
.border-yellow {
	border-bottom:3px solid #FFCC33;
}
</style>
<style type="text/css">
#tree2 {
	width:250px;
	padding: 10px;
	float:left;
}
.style15 {
	color: #5F7E9E
}
.style16 {
	color: #7C462E
}
.style17 {
	color: #5F7E9E;
	font-size: 12px;
}
.style55 {
	font-size: 12px
}
.arialwhite {
	font-size:14px;
	font-weight:bold;
	color:#b10000;
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
    <!--<span class="title_icon"><span class="coverflow"></span></span>-->
    <!--<h3>My Tree</h3> -->
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
  <?php	include('switch-bar.php');	?>
  <div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
        <h6 align="center" style="color:#0033FF">Welcome <?php echo $_SESSION['SD_User_Name'];?> </h6>
        <div class="widget_wrap" >
          <div class="widget_top" align="center">
            <h6>MY Binary TREE</h6>
            <!--<table width="100%" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td  width="10%" valign="top">&nbsp;</td>
            <td width="18%" align="center"    class="arialwhite" ><a href="genealogy.php">Summary</a></td>
            <td width="18%" align="center" class="arialwhite" ><a href="genealogydoenline.php">View Left Downlines</a></td>
            <td width="18%" align="center" class="arialwhite" ><a href="genealogydoenline_r.php">View Right Downlines</a></td>
            <td width="18%" align="center" class="arialwhite" ><a href="direct_member.php">Direct Members</a></td>
            <td align="center" width="18%" class="arialwhite" style="background:#b72c07; padding:13px 0px; color:white; font-size:16px; font-weight:bold; border-radius:4px;"
             >  Binary Geneology</td>
            </tr>
        </table>-->
          </div>
          <div id="popup" style="z-index: 1000; position: absolute; border:1px solid; color:#999999; background-color:#E3E3E4; visibility:visible;"> </div>
          <div style="overflow-x:scroll;">
            <div>
              <div class="workarea_left" style="width:950px; float:left; height:auto; margin-left:0px; ">
                <table width="97%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tbody>
                    <tr>
                      <td align="center" valign="top" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td colspan="2"><a href="binary_geneology.php"><img src="images/back.png" height="50px" width="70px"></a></td>
                            </tr>
                            <tr>
                              <td colspan="2"><form action="binary_geneology.php?id=<?=$_POST[id];?>" method="get">
                                  <table width="100%">
                                    <tr>
                                      <td align="right" class="style56">&nbsp;</td>
                                      <td align="left" class="">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td width="18%" align="right" class="style56">Enter Username/User Id. </td>
                                      <td width="17%" align="left" class=""><label>
                                        <input name="id" type="text" id="id" />
                                        <input type="submit" name="Submit" value="Search" />
                                        </label></td>
                                    </tr>
                                  </table>
                                </form></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"></td>
                            </tr>
                            <tr>
                              <td align="center" width="50%"></td>
                              <td width="50%" align="center" class="">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><table>
                                  <tbody>
                                    <?php
									 
    $imgg=showuserimage($id_show);
   
    $nom_id=$x['nom_id'];
	 
	$uname_nom=showusername($nom_id);
	$sponser_id=$x['ref_id'];
	 
	$uname_spon=showusername($sponser_id);
	//$purch=showpurchasing($id_show);
	
  //$tot_currnet_personalpurch=$objpurch->self_purchasing($id_show);
  //$tot_currnet_teampurch=$objpurch->team_purchasing($id_show);
 
									?>
                                    <tr>
                                      <td height="28">&nbsp;</td>
                                      <td><img  src="<?php echo $imgg;?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $id_show; ?>,<?php echo $name; ?>,<?php echo $x['email']; ?>,<?php echo $x['mobile']; ?>,<?php echo $x['reg_date']; ?>,<?php echo  $x['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $x['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $x['left_count'];?>,<?php echo $x['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                                <span class="font11-blue style15"><?php echo $x[user_id]; ?><br />
                                <?php echo $x[user_name]; 
												?></span><span class="font_12_normal style15"><br class="middle_text" />
                                </span></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><div align="center"><img src="tree_new.php_files/topline.gif" width="1" height="15" /> </div></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
                    <tr>
                      <td align="center" valign="top" width="33%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td width="100%"><table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td width="50%" height="1"></td>
                                      <td  style="background-image:url(tree_new.php_files/line.gif)" width="50%"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" width="100%"><img src="tree_new.php_files/arrow.gif" border="0" width="2" height="40" /></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"><table width="100%">
                                  <tbody>
                                    <tr>
                                      <td></td>
                                      <?php 
										//echo "select * from registration where nom_id='$id' and binary_pos='left'";
	$ff_nom1l=showlegid($id_show,'left'); 
    $uuidd=$ff_nom1l['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom1l['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom1l['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                                      <td><div align="center">
                                          <?php if(empty($ff_nom1l[user_id]) && $id_show!='') 
							{ ?>
                                          <a href="javascript:void(0);" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                          <?php } else {  

											 ?>
                                          <a href="binary_geneology1.php?id=<?php echo $ff_nom1l[user_id]; ?>&amp;binary=<?php echo 'left';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom1l[user_id]; ?>,<?php echo $ff_nom1l[first_name]." ".$ff_nom1l[last_name]; ?>,<?php echo $ff_nom1l['email']; ?>,<?php echo $ff_nom1l['mobile']; ?>,<?php echo $ff_nom1l['reg_date']; ?>,<?php echo  $ff_nom1l['nom_id']; ?>,<?php echo $uname_nom; ?>,<? echo  $ff_nom1l['ref_id'];?>,<?php echo $uname_spon; ?>,<? echo  $ff_nom1l['left_count'];?>,<?php echo $ff_nom1l['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                          <?php } ?>
                                        </div></td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="middle_text">
                                          <tr>
                                            <td align="center" valign="middle" class="middle_text style15 style16"><?php if(!empty($ff_nom1l[user_id])) {echo $ff_nom1l[user_id];} else {echo "Open";} ?>
                                              <br />
                                              <?php echo $ff_nom1l[user_name]; ?></a></td>
                                          </tr>
                                        </table></td>
                                      <td></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <br />
                              </td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"><img src="tree_new.php_files/topline.gif" width="1" height="15" /> </td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td align="center" valign="top" width="33%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td width="100%"><table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td style="background-image:url(tree_new.php_files/line.gif)" width="50%" height="1"></td>
                                      <td width="50%"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" width="100%"><img src="tree_new.php_files/arrow.gif" border="0" width="2" height="40" /></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr>
                              <td width="100%" height="87" align="center"><table>
                                  <tbody>
                                    <tr>
                                      <td></td>
                                      <?php 
	$ff_nom1r=showlegid($id_show,'right');
    $uuidd=$ff_nom1r['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom1r['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom1r['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                                      <td><?php if(empty($ff_nom1r[user_id]) && $id!="") 
											{ ?>
                                        <a href="javascript:void(0);" target="_blank"> <img  src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                        <?php } else {  ?>
                                        <a href="binary_geneology1.php?id=<?php echo $ff_nom1r[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom1r[user_id]; ?>,<?php echo $ff_nom1r[first_name]." ".$ff_nom1r[last_name]; ?>,<?php echo $ff_nom1r['email']; ?>,<?php echo $ff_nom1r['mobile']; ?>,<?php echo $ff_nom1r['reg_date']; ?>,<?php echo  $ff_nom1r['nom_id']; ?>,<?php echo $uname_nom; ?>,<? echo  $ff_nom1r['ref_id'];?>,<?php echo $uname_spon?>,<? echo  $ff_nom1r['left_count'];?>,<?php echo $ff_nom1r['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                        <?php } ?>
                                      </td>
                                      <td></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <span class="font11-blue style15 style16">
                                <?php if(!empty($ff_nom1r[user_id])) {echo $ff_nom1r[user_id];} else {echo "Open";} ?>
                                <br />
                                <?php echo $ff_nom1r[user_name]; ?><br />
                                </span></td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"><img src="tree_new.php_files/topline.gif" width="1" height="15" /> </td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
                    <tr>
                      <td width="27%" height="115" align="center" valign="top"><table width="99%" border="0" cellpadding="0" cellspacing="0" class="middle_text">
                          <tbody>
                            <tr>
                              <td width="100%"><table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td width="50%" height="1"></td>
                                      <td style="background-image:url(tree_new.php_files/line.gif)" width="50%"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" width="100%"><img src="tree_new.php_files/arrow.gif" border="0" width="2" height="40" /></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <?php 
    $ff_nom2l=showlegid($ff_nom1l[user_id],'left');
    $uuidd=$ff_nom2l['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom2l['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom2l['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                            <tr>
                              <td align="center" width="100%"><? if($ff_nom1l[user_id]==''){?>
                                <img  src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                <?php } elseif(empty($ff_nom2l[user_id]) && $ff_nom1l[user_id]!=" ")
									{ ?>
                                <a href="../registration.php?pl_id=<? echo $ff_nom1l[user_id];?>&amp;pos=<?php echo 'left';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                <?php } else {   ?>
                                <a href="binary_geneology1.php?id=<?php echo $ff_nom2l[user_id]; ?>&amp;binary=<?php echo 'left';?>"><img src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom2l[user_id]; ?>,<?php echo $ff_nom2l[first_name]." ".$ff_nom2l[last_name]; ?>,<?php echo $ff_nom2l['email']; ?>,<?php echo $ff_nom2l['mobile']; ?>,<?php echo $ff_nom2l['reg_date']; ?>,<?php echo  $ff_nom2l['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom2l['ref_id'];?>,<?php echo $uname_spon; ?>,<? echo  $ff_nom2l['left_count'];?>,<?php echo $ff_nom2l['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                <?php }  ?>
                                <br/>
                                <span class="top_menu"> <span class="style15"> <span class="style55">
                               
                                <?php if($ff_nom1l[user_id]==''){echo "Empty";} 
								elseif(!empty($ff_nom2l[user_id])) {echo $ff_nom2l[user_id];} 
								else {echo "Open";} ?>
                                </span></span></span><span class="style17"><br />
                                <?php if($ff_nom1l[user_id]==''){echo "";} elseif(!empty($ff_nom2l[user_id])) {echo $ff_nom2l[user_name];} else {echo "";} ?>
                                </span></td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td align="center" valign="top" width="23%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td width="100%"><table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td style="background-image:url(tree_new.php_files/line.gif)" width="50%" height="1"></td>
                                      <td width="50%"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" width="100%"><img src="tree_new.php_files/arrow.gif" border="0" width="2" height="40" /></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr>
                              <?php 
    $ff_nom2r=showlegid($ff_nom1l[user_id],'right');
    $uuidd=$ff_nom2r['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom2r['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom2r['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                              <td align="center" width="100%"><? if($ff_nom1l[user_id]==''){?>
                                <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                <?php } elseif(empty($ff_nom2r[user_id]) && $ff_nom1l[user_id]!=" ")  
									{ ?>
                                <a href="../registration.php?pl_id=<? echo $ff_nom1l[user_id];?>&amp;pos=<?php echo 'right';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                <?php } else {  

											 ?>
                                <a href="binary_geneology1.php?id=<?php echo $ff_nom2r[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom2r[user_id]; ?>,<?php echo $ff_nom2r[first_name]." ".$ff_nom2r[last_name]; ?>,<?php echo $ff_nom2r['email']; ?>, <?php echo $ff_nom2r['mobile']?>,<?php echo $ff_nom2r['reg_date']; ?>,<?php echo  $ff_nom2r['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom2r['ref_id'];?>,<?php echo $uname_spon; ?>,<? echo  $ff_nom2r['left_count'];?>,<?php echo $ff_nom2r['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                <?php } ?>
                                <br />
                                <span class=""> <span class="style15"> <span class="style55">
                                <?php if($ff_nom1l[user_id]==''){echo "Empty";} elseif(!empty($ff_nom2r[user_id])) {echo $ff_nom2r[user_id];} else {echo "Open";} ?>
                                </span></span></span><span class="style17"><br />
                                <?php echo $ff_nom2r[user_name]; ?></span></td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td align="center" valign="top" width="28%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td width="100%"><table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td width="50%" height="1"></td>
                                      <td style="background-image:url(tree_new.php_files/line.gif)" width="50%"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" width="100%"><img src="tree_new.php_files/arrow.gif" border="0" width="2" height="40" /></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <?php  
	$ff_nom22l=showlegid($ff_nom1r[user_id],'left');
    $uuidd=$ff_nom22l['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom22l['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom22l['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                            <tr>
                              <td align="center" width="100%"><?  if($ff_nom1r[user_id]==''){?>
                                <img  src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                <?php } elseif(empty($ff_nom22l[user_id]) && $ff_nom1r[user_id]!=" ")
									{ ?>
                                <a href="../registration.php?pl_id=<? echo $ff_nom1r[user_id];?>&amp;pos=<?php echo 'left';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                <?php } else {   ?>
                                <a href="binary_geneology1.php?id=<?php echo $ff_nom22l[user_id]; ?>&amp;binary=<?php echo 'left';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom22l[user_id]; ?>,<?php echo $ff_nom22l[first_name]." ".$ff_nom22l[last_name]; ?>,<?php echo $ff_nom22l['email']; ?>,<?php echo $ff_nom22l['mobile']; ?>,<?php echo $ff_nom22l['reg_date']; ?>,<?php echo  $ff_nom22l['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom22l['ref_id'];?>,<?php echo $uname_spon; ?>,<? echo  $ff_nom22l['left_count'];?>,<?php echo $ff_nom22l['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                <?php }  ?>
                                <br />
                                <span class=""> <span class="style15"> <span class="style55">
                                <?php if($ff_nom1r[user_id]==''){echo "Empty";} elseif(!empty($ff_nom22l[user_id])) {echo $ff_nom22l[user_id];} else {echo "Open";} ?>
                                </span></span></span><span class="style17"><br />
                                <?php  if($ff_nom1r[user_id]==''){echo "";} elseif(!empty($ff_nom22l[user_id])) {echo $ff_nom22l[user_name];} else {echo "";}//echo $ff_nom22l[user_name]; ?>
                                <br />
                                </span>&nbsp;</a> </td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td align="center" valign="top" width="22%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="middle_text">
                          <tbody>
                            <tr>
                              <td width="100%"><table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody>
                                    <tr>
                                      <td style="background-image:url(tree_new.php_files/line.gif)" width="50%" height="1"></td>
                                      <td width="50%"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" width="100%"><img src="tree_new.php_files/arrow.gif" border="0" width="2" height="40" /></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr>
                              <?php
	$ff_nom22r=showlegid($ff_nom1r[user_id],'right');
    $uuidd=$ff_nom22r['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom22r['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom22r['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                              <td align="center" width="100%"><div align="center" class="font11-blue">
                                  <?php if($ff_nom1r[user_id]==''){?>
                                  <img  src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                  <?php } elseif(empty($ff_nom22r[user_id]) && $ff_nom1r[user_id]!=" ")
									{ ?>
                                  <a href="../registration.php?pl_id=<? echo $ff_nom1r[user_id];?>&amp;pos=<?php echo 'right';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                  <?php } else { ?>
                                  <a href="binary_geneology1.php?id=<?php echo $ff_nom22r[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img class="<?php if($vpstatus=='qualified'){ echo "green";} else if($vpstatus=='active') { echo "yellow";} else if($vpstatus=='inactive') { echo "red"; } ?>" src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom22r[user_id]; ?>,<?php echo $ff_nom22r[first_name]." ".$ff_nom22r[last_name]; ?>,<?php echo $ff_nom22l['email']; ?>,<?php echo $ff_nom22r['mobile']; ?>,<?php echo $ff_nom22r['reg_date']; ?>,<?php echo  $ff_nom22r['nom_id']; ?>,<?php echo $uname_nom; ?>,<? echo  $ff_nom22r['ref_id'];?>,<?php echo $uname_spon; ?>,<? echo  $ff_nom22r['left_count'];?>,<?php echo $ff_nom22r['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                  <?php  } ?>
                                  <br />
                                  <span class=""> <span class="style15"> <span class="style55">
                                  <?php if($ff_nom1r[user_id]==''){echo "Empty";} elseif(!empty($ff_nom22r[user_id])) {echo $ff_nom22r[user_id];} else {echo "Open";} ?>
                                  </span></span></span><span class="style17"><br />
                                  <?php echo $ff_nom22r[user_name]; ?></span></div></td>
                            </tr>
                            <tr>
                              <td align="center" width="100%"></td>
                            </tr>
                            <tr>
                              <td align="center"></td>
                            </tr>
                            <tr>
                              <td align="center"></td>
                            </tr>
                            <tr>
                              <td align="center"></td>
                            </tr>
                            <tr>
                              <td align="center"></td>
                            </tr>
                            <tr>
                              <td align="center"></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <?php
	$ff_nom81=showlegid($ff_nom2l[user_id],'left');
    $uuidd=$ff_nom81['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom81['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                    <tr>
                      <td height="115" align="center" valign="top"><table width="100%" border="0">
                          <tr>
                            <td align="center"><img src="tree_new.php_files/topline.gif" alt="" width="1" height="15" /></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0">
                                <tr>
                                  <td>&nbsp;</td>
                                  <td style="border-top:1px solid #000; border-left:1px solid #000;">&nbsp;</td>
                                  <td style="border-right:1px solid #000; border-top:1px solid #000;">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"  ><table width="100%" border="0">
                                <tr>
                                  <td height="242" align="center" valign="top"><?
								 //echo $ff_nom2l[user_id].'=='.$ff_nom81[user_id];
								 if($ff_nom2l[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom2l[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom2l[user_id];?>&amp;pos=<?php echo 'left';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"><img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?>,<?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php echo $ff_nom81['mobile']; ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom; ?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom2l[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) { echo $ff_nom81[user_id];
									} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                  <?php
    $ff_nom81=showlegid($ff_nom2l[user_id],'right');
    $uuidd=$ff_nom81['user_id'];
    $imgg=showuserimage($uuidd);
    $nom_id=$ff_nom81['nom_id'];
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	$uname_spon=showusername($sponser_id);
?>
                                  <td align="center" valign="top"><?  if($ff_nom2l[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom2l[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom2l[user_id];?>&amp;pos=<?php echo 'right';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?> ,<?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php  echo $ff_nom81['email'];  ?>,<?php  echo $ff_nom81['mobile'];  ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom; ?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom2l[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom81[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                      <td align="center" valign="top"><table width="100%" border="0">
                          <tr>
                            <td align="center"><img src="tree_new.php_files/topline.gif" alt="" width="1" height="15" /></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0">
                                <tr>
                                  <td>&nbsp;</td>
                                  <td style="border-top:1px solid #000; border-left:1px solid #000;">&nbsp;</td>
                                  <td style="border-right:1px solid #000; border-top:1px solid #000;">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php
   $ff_nom81=showlegid($ff_nom2r[user_id],'left');
   $uuidd=$ff_nom81['user_id'];
   $imgg=showuserimage($uuidd);
   $nom_id=$ff_nom81['nom_id'];
   $uname_nom=showusername($nom_id);
   $sponser_id=$ff_nom81['ref_id'];
   $uname_spon=showusername($sponser_id);
?>
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0">
                                <tr>
                                  <td height="239" align="center" valign="top"><? if($ff_nom2r[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom2r[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom2r[user_id];?>&amp;pos=<?php echo 'left';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?>,<?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php echo $ff_nom81['mobile']; ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom2r[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom2r[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                  <?php
						
						
						$ff_nom81=showlegid($ff_nom2r[user_id],'right');
   $uuidd=$ff_nom81['user_id'];
   $imgg=showuserimage($uuidd);
   
    $nom_id=$ff_nom81['nom_id'];
	 
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	 
	$uname_spon=showusername($sponser_id);
					?>
                                  <td align="center" valign="top"><? if($ff_nom2r[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom2r[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom2r[user_id];?>&amp;pos=<?php echo 'right';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img   src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?>, <?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php echo $ff_nom81['mobile']; ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom2r[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom81[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                      <td align="center" valign="top"><table width="100%" border="0">
                          <tr>
                            <td align="center"><img src="tree_new.php_files/topline.gif" alt="" width="1" height="15" /></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0">
                                <tr>
                                  <td>&nbsp;</td>
                                  <td style="border-top:1px solid #000; border-left:1px solid #000;">&nbsp;</td>
                                  <td style="border-right:1px solid #000; border-top:1px solid #000;">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php
						 
						 $ff_nom81=showlegid($ff_nom22l[user_id],'left');
   $uuidd=$ff_nom81['user_id'];
   $imgg=showuserimage($uuidd);
   
    $nom_id=$ff_nom81['nom_id'];
	 
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	 
	$uname_spon=showusername($sponser_id);
  ?>
                          <tr>
                            <td align="left" valign="top"  ><table width="100%" border="0">
                                <tr>
                                  <td height="242" align="center" valign="top"><?  if($ff_nom22l[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom22l[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom22l[user_id];?>&amp;pos=<?php echo 'left';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img   src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?>,<?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php echo $ff_nom81['mobile']; ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon; ?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom22l[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom81[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                  <?php
								   
								 $ff_nom81=showlegid($ff_nom22l[user_id],'right');
   $uuidd=$ff_nom81['user_id'];
   $imgg=showuserimage($uuidd);
   
    $nom_id=$ff_nom81['nom_id'];
	 
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	 
	$uname_spon=showusername($sponser_id);
					?>
                                  <td align="center" valign="top"><? if($ff_nom22l[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom22l[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom22l[user_id];?>&amp;pos=<?php echo 'right';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img   src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?>,<?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php  echo $ff_nom81['mobile'];  ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $nom_name;?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $sponser_name;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom22l[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom81[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                      <td align="center" valign="top"><table width="100%" border="0">
                          <tr>
                            <td align="center"><img src="tree_new.php_files/topline.gif" alt="" width="1" height="15" /></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0">
                                <tr>
                                  <td>&nbsp;</td>
                                  <td style="border-top:1px solid #000; border-left:1px solid #000;">&nbsp;</td>
                                  <td style="border-right:1px solid #000; border-top:1px solid #000;">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php
						 
						 $ff_nom81=showlegid($ff_nom22r[user_id],'left');
   $uuidd=$ff_nom81['user_id'];
   $imgg=showuserimage($uuidd);
   
    $nom_id=$ff_nom81['nom_id'];
	 
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	 
	$uname_spon=showusername($sponser_id);
?>
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0">
                                <tr>
                                  <td align="center"><?  if($ff_nom22r[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom22r[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom22r[user_id];?>&amp;pos=<?php echo 'left';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img  src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?> ,<?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php echo $ff_nom81['mobile']; ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom;?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom22r[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom81[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php //echo $ff_nom81[user_name]; ?>
                                    </span></td>
                                  <?php
					
					
					 $ff_nom81=showlegid($ff_nom22r[user_id],'right');
   $uuidd=$ff_nom81['user_id'];
   $imgg=showuserimage($uuidd);
   
    $nom_id=$ff_nom81['nom_id'];
	 
	$uname_nom=showusername($nom_id);
	$sponser_id=$ff_nom81['ref_id'];
	 
	$uname_spon=showusername($sponser_id);
?>
                                  <td align="center"><?php
								
							 if($ff_nom22r[user_id]==''){?>
                                    <img   src="tree_new.php_files/empty.png" width="50" height="41" border="0" />
                                    <?php } elseif(empty($ff_nom81[user_id]) && $ff_nom22r[user_id]!=" ")  
									{ ?>
                                    <a href="../registration.php?pl_id=<? echo $ff_nom22r[user_id];?>&amp;pos=<?php echo 'right';?>&amp;sponsor_id=<?php echo $id;?>" target="_blank"> <img src="tree_new.php_files/white-user.gif" width="50" height="41" border="0" /></a>
                                    <?php } else {  

											 ?>
                                    <a href="binary_geneology1.php?id=<?php echo $ff_nom81[user_id]; ?>&amp;binary=<?php echo 'right';?>"><img   src="<?php echo $imgg; ?>" width="50" height="41" border="0" onMouseOut="empty()" onMouseOver="getname('<?php echo $ff_nom81[user_id]; ?>, <?php echo $ff_nom81[first_name]." ".$ff_nom81[last_name]; ?>,<?php echo $ff_nom81['email']; ?>,<?php echo $ff_nom81['mobile']; ?>,<?php echo $ff_nom81['reg_date']; ?>,<?php echo  $ff_nom81['nom_id']; ?>,<?php echo $uname_nom; ?>,<? echo  $ff_nom81['ref_id'];?>,<?php echo $uname_spon;?>,<? echo  $ff_nom81['left_count'];?>,<?php echo $ff_nom81['right_count']; ?>,<?php echo $tot_current_left;?>,<?php echo $tot_current_right;?>,<?php echo $rec_tot_purch['legAbv'];?>,<?php echo $rec_tot_purch['legBbv'];?>')"/></a>
                                    <?php } ?>
                                    <br />
                                    <span class=""> <span class="style15"> <span class="style55">
                                    <?php if($ff_nom22r[user_id]==''){echo "Empty";} elseif(!empty($ff_nom81[user_id])) {echo $ff_nom81[user_id];} else {echo "Open";} ?>
                                    </span></span></span><span class="style17"><br />
                                    <?php echo $ff_nom81[user_name]; ?></span></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <span class="clear"></span> </div>
</div>
</body>
</html><script>
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
.flyout table td, .flyout2 table td {
	padding:4px;
}
.hidden {
	visibility: hidden;
}
.flyout {
	position:absolute;
	width:300px;
	height:190px;
	background:#edf1ed;
	overflow: auto;
	border:1px solid #ccc;
	border-radius:5px;
	z-index:10000;
}
<?php for($i=1;
$i<=$ro2;
$i++) {
$ml=15*$i;
?> .flyout<?=$i ?> {
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
.flyout<?=$i ?> table td {
padding:4px;
}
 <?php
}
?>
</style>
