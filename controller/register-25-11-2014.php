<?php 
session_start();
include_once("../controller/connection.php");
require_once "../admin/function.php";
require_once "commision.php";
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
$matrix = '';
$matrix = '2';

$gender='';	
$birth_date='';
$country='';
$state='';
$city='';
$ref_id = '';
$address='';
$t_code = '';

function spill($sponserid)
{
	$lev=1;
	global $nom_id1,$lev;
	foreach($sponserid as $key => $val)
	{
		$query1="select * from registration where nom_id='$val' order by id";
		$result1=mysql_query($query1);
		$num_ro1[]=mysql_num_rows($result1);
		while($row=mysql_fetch_array($result1))
		{
			$rclid1[]=$row['user_id'];
		}
	}
	foreach($num_ro1 as $key11 => $valu)
	{
		if($valu<3)
		{
			$key1=$key11;
			break;
		}
	}
    switch ($valu)
    {
	   case '0':
	   $nom_id1=$sponserid[$key1];
		   break;

	   case '1':
	   $nom_id1=$sponserid[$key1];
		   break;
			case '2':
	   $nom_id1=$sponserid[$key1];
		   break;
		   case '3':
		if(!empty($nom_id1))
		{
		 break;
		}
		$lev++;
		spill($rclid1);
	 }
	
	 return $nom_id1;
	 return $lev;
}


function invoice()
{
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);
  
  $checkid=mysql_query("select invoice from subscribe where invoice='$pre_userid'");
  if(mysql_num_rows($checkid)>0)
  {
  	invoice();
  }
  else
  {
    return $pre_userid;
  }
}
 
function registernow($payment_mode)
{
	global $ref, $fname, $lname,  $user_nm, $email, $pass,$address1,$city,$state,$zipcode, $mobile;
	$Commission = new Commission();
	$cur_date=date('Y-m-d');
	
	
	$fname=$_SESSION['fnamer'];
	$lname=$_SESSION['lnamer'];
	$fname=ucfirst($fname);
	$lname=ucfirst($lname);

	//$ref_id = $_SESSION['ref_id'];
	$street1 = $_SESSION['street1r'];
	$street2 = $_SESSION['street1r'];
	$zip = $_SESSION['zipr'];
	$country = $_SESSION['countryr'];
	$state = $_SESSION['stater'];
	$city = $_SESSION['cityr'];
	$phoner = $_SESSION['phonerr'];
	$mobile = $_SESSION['mobiler'];

	$email = $_SESSION['emailr'];
	$user_nm = $_SESSION['user_name'];
	
	$pass=$_SESSION['passr'];
	$t_code=$_SESSION['trans_pinr'];
	$curr_time =  date("h:i:s");
	$nom_id=spill(array($ref));	
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d G:i:s');
	$date=date('Y-m-d');
	function userid()
	{
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 10);
		
		$checkid=mysql_query("select user_id from registration where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	$user_id=userid();
	
	$_SESSION['user_id']=$user_id;
	/*-----------------------------------------
	 * Get BV of Product according Package
	 * Product Volume get from product table
	 * Insert Rec in Final BV Table
	*----------------------------------------*/
	
	$mem_status = 0;
	$nom_id_BankWire='';
	if($payment_mode == "manual"){
		$mem_status = 1;
		$nom_id='';
		$nom_id_BankWire=spill(array($ref));
	}

	$userIP = $_SERVER['REMOTE_ADDR'];

	//$sponser_name = getUserName($ref);

  	$query_reg="insert into registration SET user_id='$user_id', user_name='$user_nm', nom_id='$nom_id', user_pass='$pass', t_code='$t_code', ref_id='$ref', mem_status='$mem_status',first_name='$fname', last_name='$lname', email='$email', city='$city',state='$state',country='$country', reg_date='$date', phoner='$phoner',mobile='$mobile', street1='$street1',street2= '".$street2."',zip='".$_SESSION['zip']."',package_id='".$_SESSION['package_id']."',userIP='".$userIP."',package_name='".$_SESSION['package_name']."',package_amount='".$_SESSION['Pprice']."'";

$start_date = $date;
$date = strtotime($start_date);
$dateAfterOneMonth = strtotime("+365 day", $date);
$dateAfterOneMonth =date('Y-m-d', $dateAfterOneMonth);

	if($nom_id!='')
	{
		$invoice = invoice();
		mysql_query("INSERT INTO subscribe SET user_id='".$user_id."', s_date='".$start_date."', e_date='".$dateAfterOneMonth."',status='0',invoice = '".$invoice."'");
		//mysql_query("INSERT INTO final_bv SET user_id='".$user_id."', personel_bv='".$point_value."', totalbv='".$point_value."', invoice='".$invoice."'");
	}

	$result=mysql_query($query_reg) or die("Error: ".$query_reg.mysql_error());
	$regid=mysql_insert_id();
	
	/** send in mail */

	if("manual" != $payment_mode)
	{

		/** Insert user record in E - wallet for manage amount */
		$query1="insert into final_e_wallet (user_id,amount) values ('$user_id','0')";

		$result1=mysql_query($query1) or die($query1.mysql_error());
		$sql_pack=mysql_query("select * from package where package_id='{$_SESSION['package_id']}'");
		$res_pack=mysql_fetch_array($sql_pack);
		$amount=$res_pack["total_price"];
		if($payment_mode=='evoucher')
		{
			$pin_no = $_SESSION['pin_no'];
			$updatePins = "UPDATE pins SET used_by='$user_id',used_for='register' ,used_date='$date',pif_status='2' WHERE pin_no = '$pin_no'";
			$exeUpdate = mysql_query($updatePins);
		}

		if($payment_mode=='ewallets')
		{
			$sponserid = $ref;
			$totalSponserAmount = $_SESSION['totalSponserAmount'];
			$totalAmount = $_SESSION['Pprice'];
			$remainAmount = $totalSponserAmount - $totalAmount;
			$updateEwallet = "UPDATE  final_e_wallet SET status=0 ,amount='$remainAmount' WHERE user_id='$sponserid'";
			$exeUpdate = mysql_query($updateEwallet);

			/**  Select Total Amount From Final-EWallet Table **/

			$selectFinalBalFromCreditDebit = mysql_fetch_array(mysql_query("SELECT final_bal FROM credit_debit WHERE user_id='".$ref."'"));
			$amount = $totalAmount + $selectFinalBalFromCreditDebit['final_bal'];

			$insertCreditDebit = "INSERT INTO credit_debit SET user_id='$sponserid', status=0, TranDescription = 'Registration', Remark = 'Registration' ,final_bal='$totalAmount' ,receiver_id='$sponserid',credit_amt='0',debit_amt='$totalAmount',receive_date='$date' ";
			
			$exeInsertCreditDebit = mysql_query($insertCreditDebit);

			//exit();
		}
	 	$invoicem=$_SESSION['invoice'];
	/*************  Commission For Level-Income Table For Fast Start Bonus AND update RANK-BV Table FOR POINT VALUE  *****************/

		if($nom_id!='')
		{
			//$insertPv = mysql_query("INSERT INTO rank_bv SET tpv = 0, date='$start_date', pv=0,user_id='$user_id'");	
			//$insertFS = $Commission->Fast_Start($_SESSION['user_id'],$ref_id);
			$binaryPairBonus = $Commission->binaryPairBonus($user_id);
			//$coddedBonus = $Commission->coddedBonus($_SESSION['user_id']);
			//$updatePvofUplineWhenRegister = $Commission->updatePvofUplineWhenRegister($_SESSION['user_id'],$point_value);
		}

 	$from="abhishekmaxtratechnologies@gmail.com"; //  admin username
	// $name=$fname." ".$lname;

	$time=date("Y-m-d_H:i:s", time());
	$to=$email;
	/*$email = base64_encode($email);
	$check_sp = base64_encode($check_sp);
	$mem_type = base64_encode($mem_type);
	$user_type = base64_encode($user_type);
	$sponser_id = base64_encode($ref);
	$nom_id = base64_encode($nom_id);*/
	$userid=base64_encode($user_id);
	$name=$fname;
	 
	   $headeruser="Mime-Version: 1.0\r\n";
       $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	   $headeruser1="Mime-Version: 1.0\r\n";
       $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headeruser1.= "From: abhishekmaxtratechnologies@gmail.com <$from>" . "\r\n";
     $msg= "<html><head><title></title></head>
	 <body>
 <div style='width:800px; margin:0px auto;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>Hello $name, </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Thank you for joining our exciting business opportunity; we look forward to seeing you succeed.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
	    <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Please be sure to save this e-mail or make note of your unique User ID; You will need to use your User ID when logging in and managing your site. </p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'>Your details are:
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Your User Id is:  $user_id
</p></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
Your Username : $user_nm
</p></td>
        <td>&nbsp;</td>
      </tr>
        <tr>
			<td >Password : $pass</td>
		  </tr> 
		  <tr>
			<td >Transaction Password: $pass</td>
		  </tr>
      <tr>
        <td height='77'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Yours in Success, </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Envision </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@envision.com </p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    
</body>
</html>";
//echo $msg;

//exit;
	mail($to,' Envision REGISTRATION',$msg,$headeruser1,"-f$from");
	//$subject ='fastrewards REGISTRATION';
	//mail($to,$subject,$msg,$headeruser1,"From: $from\n");

$sql_spondetl=mysql_query("select * from registration where user_id='$ref'");
$rec_sponse=mysql_fetch_array($sql_spondetl);
$spon_name=$rec_sponse['first_name']." ".$rec_sponse['last_name'];
$spon_email=$rec_sponse['email'];


/////////////******************************//
 	$from="support@envision.com"; //  admin username
	// $name=$fname." ".$lname;

	$time=date("Y-m-d_H:i:s", time());
	$to=$email;
	/*$email = base64_encode($email);
	$check_sp = base64_encode($check_sp);
	$mem_type = base64_encode($mem_type);
	$user_type = base64_encode($user_type);
	$sponser_id = base64_encode($ref);
	$nom_id = base64_encode($nom_id);*/
	$userid=base64_encode($user_id);
	$name=$fname;
	$headeruser="Mime-Version: 1.0\r\n";
    $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headeruser1="Mime-Version: 1.0\r\n";
    $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headeruser1.= "From: abhishekmaxtratechnologies@gmail.com <$from>" . "\r\n";
    $msg= "<html><head><title></title></head>
	<body>
 <div style='width:800px; margin:0px auto;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>Hello $spon_name, </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Congratulations! You now have a new team member. I would like to take this opportunity to advise you that ".ucfirst($name)." has joined your team.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
	    <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Please take the time to contact them and welcome them to your team. Guide them through their new site and any questions they may have. </p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'>Your new team members' details are:
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
  Name:  $name
</p></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Email: $to
</p></td>
        <td>&nbsp;</td>
      </tr>

      <tr>
        <td height='77'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Yours in Success, </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Envision </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@envision.com </p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    
</body>
</html>";
//echo $msg;
//exit;
	mail($spon_email,' Your Envision New Team Membre',$msg,$headeruser1,"-f$from");

		$_SESSION['adid']=$user_id;
		if($_SESSION['return_page']!='')
		{
			$return_page=$_SESSION['return_page'];
			header("Location:../$return_page");
		}
		else
		header("Location:../userpanel/");
	}
else
{

	mail($to,' Envision REGISTRATION',$msg,$headeruser1,"-f$from");
	//$subject ='fastrewards REGISTRATION';
	//mail($to,$subject,$msg,$headeruser1,"From: $from\n");


 	$from="support@envision.com"; //  admin username
	// $name=$fname." ".$lname;

	$time=date("Y-m-d_H:i:s", time());
	$to=$email;
	/*$email = base64_encode($email);
	$check_sp = base64_encode($check_sp);
	$mem_type = base64_encode($mem_type);
	$user_type = base64_encode($user_type);
	$sponser_id = base64_encode($ref);
	$nom_id = base64_encode($nom_id);*/
	$userid=base64_encode($user_id);
	$name=$fname;
	$headeruser="Mime-Version: 1.0\r\n";
    $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headeruser1="Mime-Version: 1.0\r\n";
    $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headeruser1.= "From: abhishekmaxtratechnologies@gmail.com <$from>" . "\r\n";
    $msg= "<html><head><title></title></head>
	<body>
 <div style='width:800px; margin:0px auto;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>Hello $spon_name, </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Congratulations! You now have a new team member. I would like to take this opportunity to advise you that ".ucfirst($name)." has joined your team.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
	    <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Please take the time to contact them and welcome them to your team. Guide them through their new site and any questions they may have. </p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'>Your new team members' details are:
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
  Name:  $name
</p></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Email: $to
</p></td>
        <td>&nbsp;</td>
      </tr>

      <tr>
        <td height='77'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Yours in Success, </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Envision </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@envision.com </p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    
</body>
</html>";
//echo $msg;
//exit;
	mail($spon_email,' Your Envision New Team Membre',$msg,$headeruser1,"-f$from");


	$from="abhishekmaxtratechnologies@gmail.com"; //  admin username
	// $name=$fname." ".$lname;

	$time=date("Y-m-d_H:i:s", time());
	$to=$email;
	/*$email = base64_encode($email);
	$check_sp = base64_encode($check_sp);
	$mem_type = base64_encode($mem_type);
	$user_type = base64_encode($user_type);
	$sponser_id = base64_encode($ref);
	$nom_id = base64_encode($nom_id);*/
	$userid=base64_encode($user_id);
	$name=$fname;
	 
	   $headeruser="Mime-Version: 1.0\r\n";
       $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	   $headeruser1="Mime-Version: 1.0\r\n";
       $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headeruser1.= "From: abhishekmaxtratechnologies@gmail.com <$from>" . "\r\n";
     $msg= "<html><head><title></title></head>
	 <body>
 <div style='width:800px; margin:0px auto;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>Hello ".$_SESSION['user_name'].", </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Thank you for joining our exciting business opportunity; we look forward to seeing you succeed.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
	    <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Please be sure to save this e-mail or make note of your unique User ID; You will need to use your User ID when logging in and managing your site. </p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'>Your new team members' details are:
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Your Distributor ID is:  $user_nm
</p></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Username : $user_nm
</p></td>
        <td>&nbsp;</td>
      </tr>
        <tr>
			<td >Password : $pass</td>
		  </tr> 
		  <tr>
			<td >Transaction Password: $ref</td>
		  </tr>
      <tr>
        <td height='77'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Yours in Success, </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Envision LLC </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@envision.com </p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    
</body>
</html>";
//echo $msg;

	$_SESSION['adid']=$user_id;
	if($_SESSION['return_page']!='')
	{
		$return_page=$_SESSION['return_page'];
		header("Location:../$return_page");
	}
	else
	header("Location:../bankWire.php?user_id=".$user_id."");

}
	
}

/*$_SESSION['adid'];

$binaryPairBonus = $Commission->binaryPairBonus($_SESSION['adid']);
exit();*/
$ref=$_SESSION['ref_id'];
$fname=$_SESSION['first_name'];

$lname=$_SESSION['last_name'];
$email=$_SESSION['email'];
$_SESSION['user_name'];
$user_nm=$_SESSION['user_name'];


$mobile=$_SESSION['phone'];
$address1=$_SESSION['address'];
$city=$_SESSION['city'];

$state=$_SESSION['state'];
$pass=$_SESSION['password1'];


 $sql_check="select id from registration where email='$email'";

$res_check=mysql_query($sql_check);
 $count_check=mysql_num_rows($res_check);
//$_SESSION['payment_mode']='free';
 $payment_mode=isset($_SESSION['payment_mode']) ? $_SESSION['payment_mode'] : $_GET['payment'] ; 
  $sql_check_cust="select id from registration where user_id='$ref' ";

$res_check_cust=mysql_query($sql_check_cust);
 $count_check_cust=mysql_num_rows($res_check_cust);

if($user_nm!=''){
	if($count_check==0)
	{
		if($count_check_cust>0)
		{	
			if($payment_mode=='evoucher' )
			{
				registernow($payment_mode);
			}
			elseif($payment_mode=='ewallets')
			{
				registernow($payment_mode);
			}
			elseif($payment_mode=='manual')
			{
				registernow($payment_mode);
			}
			else 
			{ 
				header("Location:../payment.php?msg=choose right option of payment");
			}
		}
		else{
		
			?>
			<script language="javascript">
			alert("This user can not be register any member.");
			document.location.href='../';
			</script>
			<?php
			
		}
	}
	else
	{
		?>
		<script language="javascript">
		alert("This email is already registered. Please choose different Email");
		document.location.href='../';
		</script>
		<?php
	}
}
else{
	?>
		<script language="javascript">
		alert("Please enter a valid username.");
		document.location.href='../';
		</script>
		<?php
}


/*if(isset($_SESSION['fname_r']))
{
	unset($_SESSION['fname_r']);	
}
if(isset($_SESSION['father_name_r']))
{
	unset($_SESSION['father_name_r']);	
}
if(isset($_SESSION['lname_r']))
{
	unset($_SESSION['lname_r']);	
}
if(isset($_SESSION['sponser_name_r']))
{
	unset($_SESSION['sponser_name_r']);	
}
if(isset($_SESSION['comobile_r']))
{
	unset($_SESSION['comobile_r']);	
}
if(isset($_SESSION['gender']))
{
	unset($_SESSION['gender']);	
}
if(isset($_SESSION['address']))
{
	unset($_SESSION['address']);	
}
if(isset($_SESSION['state']))
{
	unset($_SESSION['state']);	
}
if(isset($_SESSION['city']))
{
	unset($_SESSION['city']);	
}
if(isset($_SESSION['corelationship_r']))
{
	unset($_SESSION['corelationship_r']);	
}
if(isset($_SESSION['phoner_r']))
{
	unset($_SESSION['phoner_r']);	
}
if(isset($_SESSION['conemail_r']))
{
	unset($_SESSION['conemail_r']);	
}
if(isset($_SESSION['CoEmail_r']))
{
	unset($_SESSION['CoEmail_r']);	
}
if(isset($_SESSION['CoFirstName_r']))
{
	unset($_SESSION['CoFirstName_r']);	
}
if(isset($_SESSION['repassword_r']))
{
	unset($_SESSION['repassword_r']);	
}
if(isset($_SESSION['email_r']))
{
	unset($_SESSION['email_r']);	
}
if(isset($_SESSION['pass_r']))
{
	unset($_SESSION['pass_r']);	
}
if(isset($_SESSION['user_name_r']))
{
	unset($_SESSION['user_name_r']);	
}
if(isset($_SESSION['refid_r']))
{
	unset($_SESSION['refid_r']);	
}
if(isset($_SESSION['con_transaction_pin_r']))
{
	unset($_SESSION['con_transaction_pin_r']);	
}
if(isset($_SESSION['transaction_pin_r']))
{
	unset($_SESSION['transaction_pin_r']);	
}
if(isset($_SESSION['bankname']))
{
 	unset($_SESSION['bankname']);
}		
if(isset($_SESSION['bankac']))
{
  	unset($_SESSION['bankac']);
}			
if(isset($_SESSION['branchname']))
{
  	unset($_SESSION['branchname']);
}		
if(isset($_SESSION['ifsc']))
{
 	unset($_SESSION['ifsc']);
}*/
?>