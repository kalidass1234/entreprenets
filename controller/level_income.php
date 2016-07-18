<?php
session_start();
include('connection.php');
$clstab=$_REQUEST['id'];
$user_id=$_SESSION['adid'];
$quer="select * from level_income where ref_id='$user_id' and level='$clstab'";
$data=mysql_query($quer);

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


$invest_in=$ro['plan_name'];
	         $in_in=$ro['investment_income'];
			 $level_in=$ro['level_income'];
			 $net1=$ro['net_income'];
			 $tds=$ro['tds']; 
			 $admin_charge=$ro['admin_charge'];
			 $cl_no=$ro['closing'];
			 $to=$level_in+$in_in;
			 
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
                            
                            <td  align="center" bgcolor="#575757" class="plan"  >Srl.</td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Member ID </td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Member Name </td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Level </td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Date Of Joining </td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Sponsor ID </td>
                            <td  align="center" bgcolor="#575757" class="plan"  >Sponsor Name </td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Investment </td>
                            <td  align="center" bgcolor="#575757" class="plan"  > Level Income </td>
                            <td  align="center" bgcolor="#575757" class="plan"  >&nbsp;</td>
  </tr>
  
  <?php
  
while($ro=mysql_fetch_array($data))  
  {
  
   $us_id=$ro['user_id'];
	$re_id=$ro['ref_id'];				
	$quer1="select * from registration where user_id='$us_id'";
						$data1=mysql_query($quer1);
						$res1=mysql_fetch_array($data1);
						$name=$res1['first_name']." ".$res1['mid_name']." ".$res1['last_name'];
						$quer2="select * from registration where user_id='$re_id'";
						$data2=mysql_query($quer2);
						$res2=mysql_fetch_array($data2);
						$name_spo=$res2['first_name']." ".$res2['mid_name']." ".$res2['last_name'];
						?>
     
  <tr>

    <td align="center" valign="middle" class="plan">1</td>
        <td align="center" valign="middle" class="plan"><?php 
		print $ro['user_id'];
		
		?></td>
        <td align="center" valign="middle" class="plan"><?php 
		print $name;
		
		?></td>
    <td align="center" valign="middle" class="plan"><?php 
		print $ro['level'];
		
		?></td>
    <td align="center" valign="middle" class="plan"><?php 
		print $ro['user_id'];
		
		?></td>
	<input type="hidden" name="Email" value="<?=$email?>" />
    <td align="center" valign="middle" class="plan"><?php 
		print $ro['ref_id'];
		
		?></td>
    <td align="center" valign="middle" class="plan"><?php 
		print $name_spo;
		
		?></td>
    <td align="center" valign="middle" class="plan"><?php 
		print $res1['plan_name'];
		
		?></td>
    <td align="center" valign="middle" class="plan"><?php 
		print $ro['level_income'];
		
		?></td>
    <td align="center" valign="middle"><a href="statement1.php?id=<?=$user_id?>&closing=<?=$clstab?>" class="plan">Click For Detail </a></td>
  </tr>
  
  
  
  
  <?php
  }
  
  ?>
  
  
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
