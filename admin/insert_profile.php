<?php
include "../controller/connection.php";
include "function.php";
include "../controller/function.php";
include("../controller/spil_idsearch.php");
include("../controller/level_count_register.php");
include "../controller/commision.php";
$cur_date=date('Y-m-d');
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

$invoicem=invoice();
$txtid=$_REQUEST['iddd'];

$nomid=$_REQUEST['ref_id'];
$txtref=$_REQUEST['ref_id'];

$sql_ref=mysql_fetch_array(mysql_query("select user_id from registration where user_id='$txtref' or user_name='$txtref'"));
$txtref=$sql_ref['user_id'];
$uname=trim($_REQUEST['user_name']);
$userid=$_REQUEST['userid'];
$plan=$_REQUEST['plan'];
$pin=$_REQUEST['pin'];
$ref=$_REQUEST['ref'];
$txtref;
$user_id1=userid();
$_SESSION['sessionuserid']=$user_id1;
$query="select user_id from registration where (user_id='$txtref' or user_name='$txtref') and nom_id!=''";
$dat=mysql_query($query);
$result_ref=mysql_fetch_array($dat);
$txtref=$result_ref['user_id'];
$res=mysql_num_rows($dat);

$nom_res=mysql_query("select user_id from registration where (user_id='$nomid' or user_name='$nomid') AND user_name!='' and nom_id!=''");
$nomid_result=mysql_fetch_array($nom_res);
$nomid=$nomid_result['user_id'];
$count_noms=mysql_num_rows($nom_res);

if($nomid=='')
{
	$idx[]=$txtref;
	$idx2[]=$txtref;
	$nt=spill($idx);
	$nomid=$nom_id1;
} 
else if($nomid!='')
{ 
	if($nomid!=$txtref)
	level_count($nomid,$txtref);
	$nomid;
	$idx[]=$nomid;
	$idx2[]=$nomid;
	$nt=spill($idx);
	$nomid=$nom_id1;
}

$quers_subs = new Database();  
$quers_subs->select('registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' "); 
$count_subs= $quers_subs->numResults;
	
	/**********End: For subscription *******/
 

function userid()
{
	$encypt1=uniqid(rand(1000000000,9999999999), true);
	$usid1=str_replace(".", "", $encypt1);
	$pre_userid = substr($usid1, 0, 10);
	$checkid=mysql_query("select invoice from subscribe where invoice='$pre_userid'");
	if(mysql_num_rows($checkid)>0)
	{
		userid();
	}
	else
	{
		return $pre_userid;
	}
}

$date=date('Y-m-d');
$cdate=strtotime($date);
$check_date=date('Y-m-d',strtotime("+1 months",$cdate)); 

if($res>0 or $count_noms>0)
{

	$txtref2=$_REQUEST['ref_id'];
	$fname=$_REQUEST['first_name'];
	$lname=$_REQUEST['last_name'];
	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$country=$_REQUEST['country'];
	$zip=$_REQUEST['zip'];
	$phoner=$_REQUEST['phoner'];
	$mobile=$_REQUEST['mobile'];
	$email=$_REQUEST['email'];
	$mstatus=$_POST['login'];
	$user_pass=$_POST['user_pass'];
	$t_code=$_POST['t_code'];
	$package=$_POST['package_id'];

	$sql_user=mysql_num_rows(query("select user_id from registration where user_name='$uname'"));

	$sqlPackage=mysql_fetch_array(query("select package_name,total_price from package where package_id='$package'"));


if($sql_user<=0 && $uname!='')
{

	$userIP = $_SERVER['REMOTE_ADDR'];


 $query="insert into registration set first_name='$fname', last_name='$lname', city='$city', state='$state', country='$country',phoner='$phoner', email='$email' ,  t_code='$t_code', user_pass='$user_pass', package_id='$package', package_name='".$sqlPackage['package_name']."', user_id='$user_id1', nom_id='$nomid', ref_id='$txtref', user_name='$uname', reg_date='$date',package_amount='".$sqlPackage['total_price']."' ,zip='$zip', mobile='$mobile',userIP='".$userIP."'";

		$res=mysql_query($query) or die($query.mysql_error());
		$regid=mysql_insert_id();

		$start_date = $date;
		$date = strtotime($start_date);
		$dateAfterOneMonth = strtotime("+30 day", $date);
		$dateAfterOneMonth =date('Y-m-d', $dateAfterOneMonth);


	if($nomid!='')
	{
		$invoice = invoice();
		mysql_query("INSERT INTO subscribe SET user_id='".$user_id1."', pack_amnt='".$packamount."', p_id='".$packId."', pack_name='".$packname."', s_date='".$start_date."', e_date='".$dateAfterOneMonth."',status='0',invoice = '".$invoice."'");
		//mysql_query("INSERT INTO final_bv SET user_id='".$user_id1."', personel_bv='".$point_value."', totalbv='".$point_value."', invoice='".$invoice."'");

		/** Insert user record in E - wallet for manage amount */
		$query1="insert into final_e_wallet (user_id,amount) values ('$user_id1','0')";
		
		$result1=mysql_query($query1) or die($query1.mysql_error());

	
	/*************  Commission For Level-Income Table For Fast Start Bonus AND update RANK-BV Table FOR POINT VALUE  *****************/
		//$insertPv = mysql_query("INSERT INTO rank_bv SET tpv = 0, date='$start_date', pv=0,user_id='$user_id1'");	
		//$insertFS = $Commission->Fast_Start($user_id1,$ref_id);
		//$insertMatrixBonus = $Commission->matrixBonus($user_id1,$ref_id);
	    //$coddedBonus = $Commission->coddedBonus($user_id1);

		//$updatePvofUplineWhenRegister = $Commission->updatePvofUplineWhenRegister($user_id1,$point_value);



	 $from="abhishekmaxtratechnologies@gmail.com";
	 $msg_reg_invoice="<html><head><title></title></head>
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
	 Username : $uname
	</p></td>
			<td>&nbsp;</td>
		  </tr>
			<tr>
				<td >Password : $user_pass</td>
		    </tr> 
		  <tr>
			<td >Transaction Password: $t_code</td>
			
		  </tr>
		  <tr>
			<td >Your New Website URL is: <a href='http://198.154.192.169/~abhishek/jedi/$user_nm' target='blank'>http://198.154.192.169/~abhishek/jedi/$user_nm</a></td>
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
		<td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>fastrewards LLC </p></td>
		<td>&nbsp;</td>
	  </tr>
		<tr>
		<td>&nbsp;</td>
		<td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@fastrewards.com </p></td>
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
	 $name_reg=$noti['name'];
	 $header="Mime-Version: 1.0\r\n";
	 $header.= 'Content-type: text/html; charset=iso-8859-1;  charset=UTF-8' . "\r\n";
	 $header.= 'Content-Transfer-Encoding: 8bit'."\r\n";
     $header_invoive.= $header. 'From: '."=?UTF-8?B?".base64_encode($name_invoice)."?=".' < ' .$from. " > \r\n" .
				  'X-Mailer: PHP/' . phpversion();
	 $header_reg.= $header. 'From: '."=?UTF-8?B?".base64_encode($name_reg)."?="." <" .$from_reg. " > \r\n" .
				  'X-Mailer: PHP/' . phpversion();
	 $subject_reg=" fastrewards REGISTRATION";
	 mail($email,$subject_reg,$msg_reg_invoice,$header_reg,"-f$from");

		/*****************************/

	if($count_nom<1){
		 $msg="Successfull.";
	?><script type="text/javascript">document.location.href='admin_main.php?page_number=1&msg=<?= $msg?>';</script>
	<?php 
		
	}
///////////********End:check the nominee id exist or not***********///////

	}
	 if($res)
   {
	   	//$update_rank=new RankUpdate;
	  	//$update_rank->update_rank();
   		$msg="User Has Been Inserted Successfully";
		

	?><script type="text/javascript">document.location.href='admin_main.php?page_number=1&msg=<?=$msg?>'</script>
    <?php
    }	
	}
	else{
		
		$msg="Username is not available.";
	?><script type="text/javascript">document.location.href="admin_main.php?page_number=1&msg=<?=$msg?>"</script>
    <? 
		
	}
  			
} 
			/************ unserilize product and infromations **/
			
else 
{
	$msg="Please enter a valid username";
	?><script type="text/javascript">document.location.href="admin_main.php?page_number=1&msg=<?=$msg?>"</script>
    <?
}
?>