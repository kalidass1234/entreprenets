<?php
session_start();
include('connection.php');
$clstab=$_REQUEST['id'];
$user_id=$_SESSION['adid'];
$quer="select * from closing$clstab where user_id='$user_id'";
$data=mysql_query($quer);
$ro=mysql_fetch_array($data);
/*
$direct1=$ro['direct_income'];
$binary1=$ro['binary_income'];
//$binary2=$ro['binary_income1'];
$bstatus=$ro['binary_status'];
			if($bstatus==0)
			 {
			 $binary2=$ro['binary_income1'];
			 }
			 else
			 {
			 $binary2=0;
			 }
	if($ro['working']=='Working')
			 {	
				$binary=$binary1+$binary2;
				}
			 else
			 {
			 $binary=0;
			 }

//$binary=$binary1+$binary2;
//$binary=$binary1+$binary2;
 if($binary!=0 && $ro['working']=='Working')
			 {
			 $nwork=$ro['nwork'];
			 }
			 elseif($ro['working']=='Non Working')
			 {
			 $nwork=$ro['nwork'];
			 }
			 else
			 {
			 $nwork=0;
			 }
			  if($binary!=0 && $ro['working']=='Working')
			 {
			 $growthincome=$ro['growth_income'];
             }
			 else
			 {
			 $growthincome=0;
			 }
//$nwork=$ro['nwork'];
$slincome1=$ro['slincome1'];
$slincome2=$ro['slincome2'];
$slincome3=$ro['slincome3'];
*/
$invest_in=$ro['plan_name'];
	         $in_in=$ro['investment_income'];
			 $level_in=$ro['level_income'];
			 $net1=$ro['net_income'];
			 $tds=$ro['tds']; 
			 $admin_charge=$ro['admin_charge'];
			 $cl_no=$ro['closing'];
			 $to=$net1;
			 /*
if($binary!=0 && $ro['working']=='Working')
			 {
			 $net1=$ro['net_income'];
			 }
			 elseif($ro['working']=='Non Working')
			 {
			 $net1=$ro['net_income'];
			 }
			 else
			 {
			 $net1=0;
			 }
			 if($binary!=0 && $ro['working']=='Working')
			 {
			 $tds=$ro['tds'];
			 }
			 elseif($ro['working']=='Non Working')
			 {
			 $tds=$ro['tds'];
			 }
			 else
			 {
			 $tds=0; 
			 }
			  if($binary!=0 && $ro['working']=='Working')
			 {
			 $admin_charge=$ro['admin_charge'];
			 }
			 elseif($ro['working']=='Non Working')
			 {
			 $admin_charge=$ro['admin_charge'];
			 }
			 else
			 {
			 $admin_charge=0;
			 }
			 */
			 ?>
<link href="../css/style1.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<table width="95%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
                            <?php  
					$quer="select * from registration where nom_id='$id'";
						$data=mysql_query($quer);
						$res=mysql_num_rows($data);
						
							?>
                            <td width="7%"  align="center" bgcolor="#575757" class="plan"  >Srl.</td>
                            <td width="6%"  align="center" bgcolor="#575757" class="plan"  >Closing No. </td>
                            <td width="6%"  align="center" bgcolor="#575757" class="plan"  >Investment</td>
                            <td width="4%"  align="center" bgcolor="#575757" class="plan"  >Income</td>
                            <td width="5%"  align="center" bgcolor="#575757" class="plan"  >Detail</td>
  </tr>
  <tr>

    <td align="center" valign="middle" class="plan">1</td>
        <td align="center" valign="middle" class="plan"><?php 
		print $clstab;
		
		?></td>
        <td align="center" valign="middle" class="plan"><?= $invest_in?></td>
    <td align="center" valign="middle" class="plan">
      <?=$to?>
    </td>
    <td align="center" valign="middle"><a href="statement1.php?id=<?=$user_id?>&closing=<?=$clstab?>" class="plan">Click For Detail </a></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
