<?php
function saveRegistrationAdmin()
{
	global $ref_id, $pin, $upline, $nom_id, $binary, $plan, $plan_amt, $joining_date, $dob, $faname, $blgroup, $userid, $usernm,$userpass, $terms, $title, $userfname, $usermname, $userlname, $age, $mstatus, $sex, $nation, $address, $city, $state, $country, $zip, $mobile, $email, $nominee, $relation, $broad_inv, $reg_fee, $regdate, $ref_nm, $nage, $bankname, $branchname, $acno, $acc_detail, $cheque, $pancard, $bld_grp, $phoner, $phoneo, $dyid, $tcode, $topmem,$branch_code,$amount,$draft,$date,
	$applicant_bank,$applicant_branch,$account_type;
	$planamt=$plan;
	$date1=date("dmY");
	$regdate=date("Y-m-d");
//-----------------------------Binary-------------
   $length=5;
	$encypt=uniqid(rand(), true);
	$usid=str_replace(".", "", $encypt);
	$ud = substr($usid, 0, $length);
    $dyid=date("dmY");
	$quer="select MAX(id) from registration";
$data=mysql_query($quer);
$res=mysql_result($data, 0, 0);
$dyid12=$res+11110;

    $userid="PKW".$dyid12;
   $curpos=$binary;
   //$plan=100;
   $quers_sid="select count(*) from registration where user_id='$ref_id'";
   $dat_sid=mysql_query($quers_sid);
   $red_sid=mysql_result($dat_sid,0,0);
   $quers_emailid="select count(*) from registration where email='$email'";
   $dat_emailid=mysql_query($quers_emailid);
   $red_emailid=mysql_result($dat_emailid,0,0);
   $quers_mobile="select count(*) from registration where mobile='$mobile'";
   $dat_mobile=mysql_query($quers_mobile);
   $red_mobile=mysql_result($dat_mobile,0,0);
   if(($red_mobile>=7) || ($red_emailid>=7))
   {
   header("Location:join_now.php?error=Your Mobile or Email ID is registered 7 times");
   }
   else
   {
if($red_sid>0)
{
  

   $quers="select count(*) from pins where pin_no='$pin' and status=0 and amount='$plan'";
   $dat=mysql_query($quers);
   $red=mysql_result($dat,0,0);
if($red>0)
{
$quer="select count(*) from registration where nom_id='$nom_id'";
	$data=mysql_query($quer);
	$res=mysql_result($data, 0, 0);
		if($res>=2)
	{
	 
	  header("Location:join_now.php?error1=Upline ID Has Two Members Plz Insert Another ID");
	}
	else
	{
	
	if($binary=="Left")
	{
	$querle="select count(*) from registration where nom_id='$nom_id' and binary_pos='Left'";
	$datale=mysql_query($querle);
	$resle=mysql_result($datale, 0, 0);
		if($resle>=1)
		{
		header("Location:join_now.php?error=Upline ID Has Allready Left Member Plz Insert Another ID");
		}
	  
      else
		{
	
 $quer="insert into registration(user_id, nom_id, user_pass, t_code, plan_name, binary_pos, pin_no, ref_id, ref_nm, first_name, dob, sex, mstatus, nationality, pan_no, phoner, mobile, email, address, city, state, zip, country, nominee, relation, bank_nm, branch_nm, branchcode, amount, draft_no, applic_bank, appli_branch, applic_acc_type, ac_no, reg_date, terms, blood, status) values('$userid', '$nom_id', '$userpass', 12345, '$plan', '$binary', '$pin', '$ref_id', '$ref_nm', '$usernm', '$dob', '$sex', '$mstatus', '$nation', '$pancard', '$phoner', '$mobile', '$email', '$address', '$city', '$state', '$zip', '$country', '$nominee', '$relation', '$bankname', '$branchname', '$branch_code', '$amount', '$draft', '$applicant_bank', '$applicant_branch', '$account_type', '$acno', '$regdate', '$terms', '$blgroup', 0)";
	$data=mysql_query($quer) or die('ff');
	
	 /*$quer111="insert into final_e_wallet (user_id) values ('$userid')";
   $data111=mysql_query($quer111) or die('kk');*/
   
	 $query11="update pins set status=1 where pin_no='$pin'";
	 $dara=mysql_query($query11);
	 $from="info@pacifickingworld.com";
	 $name=$usertitle." ".$userfname." ".$usermname." ".$userlname;
     $msg= "Welcome to Pacfic King World

   You Are Successfully Registered. 
   You can access Your account with below details

   User Id :$userid

   Login Password:$userpass

   Best Regards, 

   Pacfic King World.";
	$msg .="Your registration is successfully done,Thanks for being a member of Pacfic King World.,";
	mail($email,'Registration',$msg,$from);
	 if($data)
	{
	    header("location:message.php?uid=$userid&name=$usernm&mobile=$mobile&pass=$userpass&tpass=12345");
}

}
}
if($binary=="Right")
	{
	
		$querRi="select count(*) from registration where nom_id='$nom_id' and binary_pos='Right'";
	    $dataRi=mysql_query($querRi);
	    $resRi=mysql_result($dataRi, 0, 0);
		if($resRi>=1)
		{
		header("Location:join_now.php?error=Upline ID Has Allready Right Member Plz Insert Another ID");
		}
	  
      else
		{
	
 $quer="insert into registration(user_id, user_pass, t_code, nom_id, plan_name, binary_pos, ref_id, ref_nm, pin_no, first_name, dob, sex, mstatus, nationality, pan_no, phoner, mobile, email, address, city, state, zip, country, nominee, relation, bank_nm, branch_nm, branchcode, amount, draft_no, applic_bank, appli_branch, applic_acc_type, ac_no, reg_date, terms, blood, status) values('$userid', '$userpass', 12345, '$nom_id', '$plan', '$binary', '$ref_id', '$ref_nm', '$pin', '$usernm', '$dob', '$sex', '$mstatus', '$nation', '$pancard', '$phoner', '$mobile', '$email', '$address', '$city', '$state', '$zip', '$country', '$nominee', '$relation', '$bankname', '$branchname', '$branch_code', '$amount', '$draft', '$applicant_bank', '$applicant_branch', '$account_type', '$acno', '$regdate', '$terms', '$blgroup', 0)";
	$data=mysql_query($quer) or die('ff');
	
	 /*$quer111="insert into final_e_wallet (user_id) values ('$userid')";
   $data111=mysql_query($quer111) or die('kk');*/
   
	 $query11="update pins set status=1 where pin_no='$pin'";
	 $dara=mysql_query($query11);
	 $from="info@pacifickingworld.com";
	 $name=$usertitle." ".$userfname." ".$usermname." ".$userlname;
     $msg= "Welcome to Pacfic King World

   You Are Successfully Registered. 
   You can access Your account with below details

   User Id :$userid

   Login Password:$userpass

   Best Regards, 

   Pacfic King World.";
	$msg .="Your registration is successfully done,Thanks for being a member of Pacfic King World.,";
	mail($email,'Registration',$msg,$from);
	 if($data)
	{
	    header("location:message.php?uid=$userid&name=$usernm&mobile=$mobile&pass=$userpass&tpass=12345");
}

}
}
}

	}
	
	else
{
header("Location:join_now.php?error=Invalid Pin number");
}
}
else
{
header("Location:join_now.php?error=Invalid Sponser ID");
}
	}
	}
?>