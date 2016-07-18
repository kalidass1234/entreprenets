<?php
//include ("connection.php");
function ck_exp_ref($rid)
{
global $exp_ref_id;
//$rid='a';
$sll_15_expref="select * from registration where user_id='$rid'";
    $sl_15_expref=mysql_query($sll_15_expref);
    $ress_15_expref=mysql_fetch_array($sl_15_expref) ;     
     $si11_15_expref=$ress_15_expref['ref_id'];
	 
	 $sll_15_expref_count="select count(*) from registration_exp where user_id='$rid'";
    $sl_15_expref_count=mysql_query($sll_15_expref_count);
    $ress_15_expref_count=mysql_result($sl_15_expref_count,0,0) ;
	
	if($ress_15_expref_count==0)
	{
	ck_exp_ref($si11_15_expref);
	}
	else
	{
	$exp_ref_id=$rid;
	}
	return $exp_ref_id;
	 
}
/*print $aaa=ck_exp_ref('a');
*/?>