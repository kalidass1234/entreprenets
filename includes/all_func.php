<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);
if($_SERVER['HTTP_HOST']=='localhost')
{
	define('Host','localhost');
	define('User','root');
	define('Password','');
	define('Database','envision');
}
else
{
	define('Host','localhost');
	define('User','entrepre_envasio');
	define('Password','Password@!@#$%');
	define('Database','entrepre_envasion');
}
define('USERID',$_SESSION['adid']);
define('USERNAME',$_SESSION['adid_user']);

//define('Currency','£');
//define('Currency','£');
//define('CURRENCY','&pound;');

define('Currency','$');
define('CURRENCY','USD ');
define('CURRENCY_NAME','Dollar ');
define('url','http://198.154.192.169/~abhishek/pridezone/');
define("Matrix",2);
define("Depth",12);
require_once("../config/custom_function.php");
require_once("../config/mysql_class.php");
$mysql=new mysql_func;
$obj_query=new mysql_func();
$obj_rep=new Representative();
$obj_conn=new DBConnection();
$obj_conn->select_database(Host,User,Password,Database);
$COMPANY="Grenature";
$TITLE_USER="Welcome To Grenature";
$host_name=host_name();
$host_name=str_replace("userpanel","",$host_name);
//echo $host_name;
function spill($sponserid)
{
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
		if($valu<5)
		{
		$key1=$key11;
		break;
		}
	}
		
	   switch ($valu)
	   {
	   case '0':
	   $nom_id1=$sponserid[$key1];
	   //$i=$num_ro1;
	  // print "a";
		   break;
	   case '1':
	   $nom_id1=$sponserid[$key1];
	   //$i=$num_ro1;
		//  print "bb";
		   break;
			case '2':
	   $nom_id1=$sponserid[$key1];
	   //$i=$num_ro1;
		//  print "bb";
		   break;
			case '3':
	   $nom_id1=$sponserid[$key1];
	   //$i=$num_ro1;
		//  print "bb";
		   break;
		 
		  case '4':
	   $nom_id1=$sponserid[$key1];
	   //$i=$num_ro1;
		//  print "bb";
		   break;
		   
		   case '5':
	   
	if(!empty($nom_id1))
	{
	 break;
	}
		spill($rclid1);
	//$lev++;
	}
	return $nom_id1;
}

function user_ticket_notification($id)
{
	 $str_pin=mysql_query("select * from tickets where  user_id='$id' and status=1 and notification_status=0")or die(mysql_error());
	 $num=mysql_num_rows($str_pin);
	 if($num>0)
	 {
		 return $num;
	 }
	 else
	 {
		 return 0;
	 }
}



function registernow()
{
	global $ref, $fname,$mname, $lname, $user_nm, $email, $pass, $dob,$address1,$address2,$city,$state,$country,$mobile,$sex,$acc_name,$acc_no,$ifsc,$bank_name,$bank_branch,$nominee_name,$nom_relation,$nom_contact,$nimini_dob,$zip,$image,$mem_type,$pin,$plan_name,$ssn,$category_one,$category_two,$category_three,$order_no,$paymode,$admin_ref_ref,$admin_ref,$duration,$category,$sp_name_guru,$amount,$subscription_id;
	//echo $ref." ".$mem_type." ".$pin." ".$fname." ".$lname." ".$user_nm." ".$email." ".$pass." ".$term." ".$age." ".$address1." ".$address2." ".$city." ".$state." ".$zipcode." ".$country." ".$squestion." ".$sanswer;

	$result_spill=mysql_fetch_array(mysql_query("select power_leg, power_status  from registration where user_id='$ref' and nom_id!=''"));
	// find user_id
	function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 8);
		
		$checkid=mysql_query("select user_id from registration where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	$user_id=userid();
	// check ref category is match to new registration
	$sql_check="select * from registration where user_id='$ref'";
	$res_check=mysql_query($sql_check);
	$row_check=mysql_fetch_assoc($res_check);
		if($category_two)
		{
			/*if($result_spill['power_status']==1)
			{
				$nom=$result_spill['power_leg'];
				$idx[]=$nom;
				$idx2[]=$nom;
				$nom_id=spill($idx);
			}
			else
			{
			 	$nom_id=spill(array($ref));
			}*/
			// check ref have the 5 member at first level and 20 people as reserve member
			if($row_check['category_three'] && $row_check['category_two'])
			{
				$ref2=$ref;
				//$guru_ref=$sp_name_guru;
			}
			else if($row_check['category_two'])
			{
				$ref2=$ref;
			}
			else if($row_check['category_three'])
			{
				$ref2=1234568;
				$guru_ref=$sp_name_guru;
			}
			if($ref2==1234568)
			{
				$nom_id=spill(array($ref2));
			}
			else
			{
				$obj_spill=new SpillOver();
				if($obj_spill->get_five_person($ref2))
				{
					if($obj_spill->get_twenty_reserve($ref2))
					{
						$obj_spill->set_twenty_reserve($ref2,$user_id);
						$nom_id='';
					}
					else
					{
						$nom_id=spill(array($ref2));
					}
				}
				else
				{
					$nom_id=spill(array($ref2));
				}
			}
			/*if($ref==1234567)
			{
				$guru_ref=$sp_name_guru;
			}*/
		}
	
	//echo "RefId:".$ref."&NomID:".$nom_id."&Pin:".$pin." ".$fname." ".$lname." ".$user_nm." ".$email." ".$pass." ".$term." ".$age." ".$address1." ".$address2." ".$city." ".$state." ".$zipcode." ".$country." ".$squestion." ".$sanswer;exit;
	function businessname()
	{
		//$encypt1=uniqid(rand(), true);
		$encypt1=uniqid(rand(2000050000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 8);
		
		$checkid=mysql_query("select business_name from registration where business_name='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			businessname();
		}
		else
		{
			return $pre_userid;
		}	
	}
	$business_name=businessname();
	
	$t_code=rand(1000,9999);
	
	if($mem_type=='vip')
	{
		//$plan_name=29.99;
		$curdate=date('Y-m-d');
		$sqlpin=mysql_query("update pins set status=1,t_date='$curdate',receiver_id='$user_id',sender_id='admin' where pin_no='$pin'");
		
		if($category_three)
		{
			$date = strtotime(date("Y-m-d", strtotime($curdate)) . " +12 month");
		}
		else
		{
			$date = strtotime(date("Y-m-d", strtotime($curdate)) . " +".$duration." month");
		}
		$enddate = date("Y-m-d",$date);
		if($category_one){ $sub_type=1;} 
		if($category_two)
		{
				$sub_type=2;
				if($duration==1)
				{
					$realsubs_fee=29.99;
				}
				else if($duration==3)
				{
					$realsubs_fee=254.94;
				}
				else if($duration==6)
				{
					$realsubs_fee=509.88;
				}
				else if($duration==12)
				{
					$realsubs_fee=1019.76;
				}
		}
		if($category_three){$sub_type=3;}
		$sqlsubscription=" insert into subscription(user_id,subs_fee,subs_date,end_date,payment_mode,type,order_no,duration,pin_no,subscription_id,realsubs_fee) values($user_id,'$amount','$curdate','$enddate','$paymode','$sub_type','$order_no','$duration','$pin','$subscription_id','$realsubs_fee');";
		//exit;
		mysql_query($sqlsubscription);
		mysql_query("update recurring_billing set user_id='$user_id' where subscription_id='$subscription_id'");
	}
	
	$final_ewallet3=mysql_query("insert into final_e_wallet set amount=0,user_id='$user_id'");
	
	if($admin_ref_ref)
	{
		$ref1=$admin_ref_ref;
	}
	else 
	{
		$ref1=$ref;
	}
	if($category_one){$duration_one=$duration; $subs_one_date=date('Y-m-d');}
	if($category_two){$duration_two=$duration; $subs_two_date=date('Y-m-d');}
	if($category_three){$duration_three=$duration; $subs_three_date=date('Y-m-d');}
	$reg_date=date('Y-m-d');
	if($country!=''){}else{$country='USA';}
	$query_reg="insert into registration (user_id,user_name,nom_id,user_pass,t_code,ref_id,ref_id_here,first_name,mid_name,last_name, email,address1,address2,city,state,country,mobile,sex,zip,image,pin_no,plan_name,user_plan,pan_no,category_one,category_two,category_three,business_name,dob,transaction_no,duration_one,duration_two,duration_three,subs_one_date,subs_two_date,subs_three_date, reg_date)
					values('$user_id','$user_nm','$nom_id','$pass','$t_code','$ref','$ref1','$fname','$mname','$lname','$email','$address1','$address2','$city','$state','$country','$mobile','$sex','$zip','$image','$pin','$plan_name','$mem_type','$ssn','$category_one','$category_two','$category_three','$business_name','$dob','$order_no','$duration_one','$duration_two','$duration_three','$subs_one_date','$subs_two_date','$subs_three_date','$reg_date')";
	//print_r($_FILES);
	//echo $query_reg;exit;				
	$result=mysql_query($query_reg);
	$bid=mysql_insert_id();
	//if($category_one)
	//email_to_sponser($ref1,$user_id,$user_nm);
	//if($category_three)
	//email_to_sponser1($ref1,$user_id,$user_nm);
	// check ref category
	// update billing and credit card info
	mysql_query("update billing_address set user_id='$user_id' where user_name='$user_nm'");
	$sql_ref_cat="select * from registration where user_id='$ref1'";
	$res_ref_cat=mysql_query($sql_ref_cat);
	$row_ref_cat=mysql_fetch_assoc($res_ref_cat);
	//echo $category_three." || ".$category_one." || ".$category_two;	exit;
	if($row_ref_cat['category_three'] && $row_ref_cat['category_two'])
	{
		if($category_three || $category_one)
		{
			$obj_com=new Commission();
			if($guru_ref)
			{
				$obj_com->commission_ref_guru($guru_ref,$nom_id,$user_id,$plan_name,$category);
			}
			else
			{
				$obj_com->commission_ref($ref1,$nom_id,$user_id,$plan_name,$category);
			}
		}
		else if($category_two)
		{
			if($obj_spill->get_five_person($ref2))
			{
/*				if($obj_spill->get_twenty_reserve($ref2))
				{}
				else
				{*/
				if($nom_id!='')
				{
				$obj_com=new Commission();
				$obj_com->commission_distribute($ref1,$nom_id,$user_id,$plan_name,$category);
				}
				/*}*/
				
			}
			//email_to_upline($nom_id,$user_id,$user_nm);
		}
	}
	else if($row_ref_cat['category_two'])
	{
		if($category_three || $category_one)
		{
			$obj_com=new Commission();
			if($guru_ref)
			{
				$obj_com->commission_ref_guru($guru_ref,$nom_id,$user_id,$plan_name,$category);
			}
			else
			{
			$obj_com->commission_ref($ref1,$nom_id,$user_id,$plan_name,$category);
			}
		}
		else if($category_two)
		{
			if($obj_spill->get_five_person($ref2))
			{
				/*if($obj_spill->get_twenty_reserve($ref2))
				{}
				else
				{*/
				if($nom_id!='')
				{
				$obj_com=new Commission();
				$obj_com->commission_distribute($ref1,$nom_id,$user_id,$plan_name,$category);
				}
				/*}*/
			}
			//email_to_upline($nom_id,$user_id,$user_nm);
		}
	}
	else if($row_ref_cat['category_three'])
	{
		$obj_com=new Commission();
		if($guru_ref)
		{
			$obj_com->commission_ref_guru($guru_ref,$nom_id,$user_id,$plan_name,$category);
		}
		else
		{
			$obj_com->commission_ref($ref1,$nom_id,$user_id,$plan_name,$category);
		}
	}
	/*if($mem_type=='vip' && $category_two)
	{
		$obj_com=new Commission();
		//echo $ref.','.$nom_id.','.$user_id.','.$plan_name;exit;
		$obj_com->commission_distribute($ref,$nom_id,$user_id,$plan_name);
		//level_commission($user_id,$plan_name,$ref,'new');
		//sent_mail_to_vip($user_id,$plan_name,0,'New Registration',$paymode,$pin);
	}
	if($mem_type=='vip' && ($category_three || $category_one) && )
	{
		$obj_com->commission_ref($ref,$nom_id,$user_id,$plan_name);
	}*/
	
	//-----------level commission-------//
if($bid)
{ 
	//mkdir("/home/develope/public_html/mike/$user_nm", 0755);
  	//copy("/home/develope/public_html/mike/index_format.php","/home/develope/public_html/mike/$user_nm/index.php");

     $from="info@visionteamnetwork.com"; // shopdeal admin username
	// $name=$fname." ".$lname;
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:VTN <$from>" . "\r\n";
	 $url="http://www.visionteamnetwork.com/".$user_nm;
     $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src='http://www.visionteamnetwork.com/img/logo.png'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>".stripslashes(htmlentities($user_nm)).",</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='50'>&nbsp;</td>
        <td height='50'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#3399FF; padding: 5px 0px '>Congratulations!</p></td>
        <td height='50'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'><strong>Welcome to VTN</strong>. You successfully completed your Registration.
 
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='24%'><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Username: </p></td>
            <td width='76%'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($user_nm))."</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>User ID</p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($user_id))."</p></td>
          </tr>
          <tr>
           <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Password: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($pass))."</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Transaction Pin: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($t_code))." </p></td>
          </tr>
		  
		  <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Refferal Link: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'><a href='$url'>".stripslashes(htmlentities($url))."</a></p></td>
          </tr>
		  
        </table></td>
        <td height='130'>&nbsp;</td>
      </tr>
	
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>VTN Admin</p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    </div>
  </div>
</div>
</body>
</html>";
 //  $header="From: info@infinitillio.com";
 //echo $msg;exit;
	  mail($email,'WELCOME',$msg,$headeruser1,'$from');
	  return $user_id;
	}	
}

function count_user($user, $position=''){
	$query="";
	if($position!='')
		$query.="and binary_pos='$position' ";
		//echo "select count(purcheser_id) as total_count from level_income where income_id='$user' $query";
	$sql=mysql_query("select count(user_id) as total_count from registration where user_id='$user' $query") or die(mysql_error());
	
	$res=mysql_fetch_assoc($sql);
	return $res['total_count'];
}

function showuserimage($uid)
 {
	$sql_query="select image,sex from registration where user_id='$uid' or user_name='$uid'";
	 $sql_image=mysql_query($sql_query);
	 $rec_image=mysql_fetch_array($sql_image);
	  //echo "jena--".$rec_image['sex'];
   if($rec_image['image']!='')
	 {
		$imgg="userimages/".$rec_image['image'];
	 }
	 else
	{ 
	   if($rec_image['sex']=='male')
	   {
		   $imgg="tree_new.php_files/1.jpg"; 
	   }
	   else if($rec_image['sex']=='female')
	   {
		   $imgg="tree_new.php_files/female-red.gif"; 
	   }
	   else 
	   {
	   	 $imgg="tree_new.php_files/represent.png";
	   }
	 }	
	 
	 return $imgg;
}
function showpurchasing($user_name)
{
$userid=showuserid($user_name);	
$sql_purch=mysql_query("select tbv,bv from final_bv where user_id='$userid'");
$rec_purch=mysql_fetch_array($sql_purch);
return $rec_purch;
	
}
function showlegid($id,$leg)
{
//echo "select * from registration where nom_id='$id' and binary_pos='$leg'";
$sql_nom1l=mysql_query("select * from registration where nom_id='$id' and binary_pos='$leg' ");
$ff_nom1l=mysql_fetch_array($sql_nom1l);
return $ff_nom1l;
}
function checkuser($user_name)
{
//echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
	$checkid=mysql_query("select user_id from registration where user_name='$user_name' or user_id='$user_name'");
		if(mysql_num_rows($checkid)>0)
		{
			return false;
		}
		else
			return true;
}


function showMemX_new($dwnid)
		{
			global $data_dwn,$le;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$idx;
					++$le;
					//print $data_dwn;
					showMemX_new($idx);
			}
			//return $data_dwn;
		}
		
function level_count($crid,$tpid)
{ global $a;

$query1="select nom_id from registration where user_id='$crid'";
$result1=mysql_query($query1);
$row=mysql_fetch_array($result1);
$rclid1=$row['nom_id'];
$a=1;

if($rclid1!=$tpid)
{
level_count($rclid1,$tpid);$a++;
}
else
{
$a=1;
}
return $a;
}


function showuser($user_id)
{
	$sql="select user_name,first_name,last_name from registration where user_id='$user_id'";
	$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_assoc($result);
			return $row['user_name'];
		}
}
function showbusinessuser($user_id)
{
	$sql="select first_name,last_name,business_name from registration where user_id='$user_id'";
	$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_assoc($result);
			if($row['business_name']=='')
			{
				return $row['first_name'].' '.$row['last_name'];
			}
			else
			{
				return $row['business_name'];
			}
		}
}
function showuserid($user_name)
{
	$sql="select user_id from registration where user_name='$user_name' or user_id='$user_name'";
	$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_assoc($result);
			return $row['user_id'];
		}
}
function showusername($user_id)
{
	$sql="select user_name from registration where user_id='$user_id'";
	$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_assoc($result);
			return $row['user_name'];
		}
}
function showuserprofile($user_name)
{
	$sqluser="select * from registration where (user_name = '$user_name' OR user_id='$user_name')";
	$resuser=mysql_query($sqluser);
	return $rowuser=mysql_fetch_assoc($resuser);
}

function showuserinfo($user_id)
{
	$sqluser="select * from registration where  user_id='$user_id'";
	$resuser=mysql_query($sqluser);
	return $rowuser=mysql_fetch_assoc($resuser);
}

function showuserpaypal($user_id)
{
	$sqluser="select * from registration where  user_id='$user_id'";
	$resuser=mysql_query($sqluser);
	$rowuser=mysql_fetch_assoc($resuser);
	return $rowuser['paypal_account'];
}

function showuser_location($user_id)
{
	$sqluser="select city,state,country,zip from registration where  user_id='$user_id'";
	$resuser=mysql_query($sqluser);
	$rowuser=mysql_fetch_assoc($resuser);
	return $rowuser['zip'];
}

function showusertype($user_id)
{
	$sqluser="select user_type from registration where user_id='$user_id' or user_name='$user_id'";
	$resuser=mysql_query($sqluser);
	$rowuser=mysql_fetch_assoc($resuser);
	return $rowuser['user_type'];
}
function showmemtype($user_id)
{
	$sqluser="select category_one,category_two,category_three from registration where user_id='$user_id' or user_name='$user_id'";
	$resuser=mysql_query($sqluser);
	$rowuser=mysql_fetch_assoc($resuser);
	if($rowuser['category_three'])
	{
		return 3;
	}
	else if($rowuser['category_two'])
	{
		return 2;
	}
	else if($rowuser['category_one'])
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function formatbytes($file, $type)  
{  
    switch($type){  
        case "KB":  
            $filesize = filesize($file) * .0009765625; // bytes to KB  
        break;  
        case "MB":  
            $filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB  
        break;  
        case "GB":  
            $filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB  
        break;  
    }  
    if($filesize <= 0){  
        return $filesize = 'unknown file size';}  
    else{return round($filesize, 2).' '.$type;}  
}

/*-----------------------------------------------------------
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to show product order by
* Param Fourth has Order Type (asc or desc)
* Param Five has max limit of select item form tbl
* Return Array
*------------------------------------------------------------*/
function getProductByOrder($fields,$tbl,$order_field,$order)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl order by $order_field $order";
	$rs=mysql_query($sql);
	if($rs)
		return getRows($rs);
}
	
/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getSingleRecByWhere($fields,$tbl,$field_name,$val)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl where $field_name=$val";
	$rs=mysql_query($sql);
	if($rs)
		return getRow($rs);
}

/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getMultiRecByWhere($fields,$tbl,$field_name,$val)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl where $field_name=$val";
	$rs=mysql_query($sql);
	$count=mysql_num_rows($rs);
	if($count>0)
		return getRows($rs);
}

/*---------------------------------------
* rs is record set
* return Array
*---------------------------------------*/
	
function getRows($rs)
{
	$rows=array();
	while($row=mysql_fetch_array($rs))
	{
		$rows[]=$row;
	}
	if($rows)
		return $rows;
	else
		return false;
}	

/*---------------------------------------
* rs is record set
* return single Record Set
*---------------------------------------*/
	
function getRow($rs)
{
	return $row=mysql_fetch_array($rs);
}


/*---------------------------------------
* First Param is Array
* Second Param is key of array
* Third Param is show or not
*---------------------------------------*/

function getValue($args,$key,$echo=false)
{
	$arg=isset($args[$key])? $args[$key] : '&nbsp;';
	if($echo)
		echo $arg;
	else
		return $arg;
} 

/*--------------------------------------------
* Get right user for Edit product Detail
* Param First is User Name
* Param Second is Product Id
* return boollen value
*---------------------------------------------*/
function userProduct($uname,$pid)
{
	$userid=showuserid($uname);
	$add_prod_by=getSingleRecByWhere('add_by','product_category','p_cat_id',$pid);
	if($userid==getValue($add_prod_by,'add_by',false))
		return true;
	else
		return false;
	
}

/*--------------------------------------------
* Get right user for Edit product Detail
* Param First is User Name
* Param Second is Product Id
* return boollen value
*---------------------------------------------*/
/*function invoice_date($invoice)
{
	$sql="select date from purchase_detail where invoice_no='$invoice'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['date'];
}*/
function get_product_vailable_qty($id)
{
	$sql="select p_qty from product_category where p_cat_id='$id'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['p_qty'];
}


function get_category_name($id)
{
	$sql="select category_name from category_shop where c_id='$id'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['category_name'];
}

function get_sold_products($pid)
{
	$sql="SELECT count(pd_id) as cnt FROM `purchase_detail` WHERE `p_id` = '$pid'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['cnt'];
}

function get_user_count($user_type,$plan_name)
{
	$sql="SELECT count(id) as cnt FROM `registration`";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['cnt'];
}



function get_final_ewallet($user_id)
{
	$sqls="SELECT user_id FROM registration WHERE user_name='$user_id' OR user_id='$user_id'";
	$ress=mysql_query($sqls);
	$rows=mysql_fetch_assoc($ress);
	$sql="SELECT * FROM final_e_wallet WHERE user_id='".$rows['user_id']."'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['amount'];
}




function sent_mail_to_vip($user_id,$amount,$admin_charge,$Remark,$pay_mode,$invoiceno)
{
// find all detail about user
$sql=mysql_query("select * from registration where user_id='$user_id'");
$res=mysql_fetch_assoc($sql);
$email=$res['email'];
$total=$amount+$admin_charge;
$x=1;


$from="info@visionteamnetwork.com"; // shopdeal admin username
	// $name=$fname." ".$lname;
	 $headeruser="Mime-Version: 1.0\r\n";

       $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headeruser1="Mime-Version: 1.0\r\n";

       $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

       $headeruser1.= "From:VTN<$from>" . "\r\n";

$msg= "<html> <head><title></title></head>
	 <body><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width='51%'><img src='http://www.visionteamnetwork.com/img/logo.png' alt='' /></td>
        <td width='15%'>&nbsp;</td>
        <td width='34%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='45%'>&nbsp;</td>
            <td width='55%'>&nbsp;</td>
            </tr>
          <tr>
            <td><span class='invoice_title'>Date :</span></td>
            <td>".date("d-M-y")."</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td class='invoice_title'> Order no. </td>
            <td>".$invoiceno."</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='39%' valign='top'><table width='100%' border='0' cellspacing='2' cellpadding='2'>
          
		  $tr
		  
          <tr>
            <td class='invoice_title'><strong>Full Name:</strong></td>
            <td>".$name=$res['first_name']." ".$res['mid_name']." ".$res['last_name']."</td>
          </tr>
          <tr>
            <td class='invoice_title'><strong>Username:</strong></td>
            <td>".$res['user_name']."</td>
          </tr>
          <tr>
            <td class='invoice_title'><strong>User ID:</strong></td>
            <td>".$res['user_id']."</td>
          </tr>
          <tr>
            <td><span class='invoice_title'><strong>User Type:</strong></span></td>
            <td>".$res['user_type']."</td>
          </tr>
		   <tr>
            <td class='invoice_title'><span ><strong>User E-Mail:</strong></span></td>
            <td>".$res['email']."</td>
          </tr>
          
          <tr>
            <td class='invoice_title'><strong>User Mobile:</strong></td>
            <td>".$res['mobile']."</td>
          </tr>
		  <tr>
            <td class='invoice_title'>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
         
        </table></td>
        <td width='5%'>&nbsp;</td>
        <td width='41%' valign='top'><table width='100%' border='0' cellspacing='2' cellpadding='2'>
          <tr>
            <td><span class='invoice_title'><strong>Address1 :</strong></span></td>
            <td>".$res['address1'].' '.$res['address2']."</td>
          </tr>
        
          <tr>
            <td><span class='invoice_title'><strong>City :</strong> </span></td>
            <td>".$res['city']."</td>
          </tr>
		  <tr>
            <td width='49%' class='invoice_title'><strong>State :</strong> </td>
            <td width='51%'>".$res['state']."</td>
          </tr>
		  <tr>
            <td width='49%' class='invoice_title'><strong> Zip : </strong></td>
            <td width='51%'>".$res['zip']."</td>
          </tr>
          <tr>
            <td class='invoice_title'><strong> Country : </strong></td>
            <td>".$res['country']."</td>
          </tr>
         
          <tr>
            <td class='invoice_title'><strong>Payment Mode:</strong></td>
            <td>".$pay_mode."</td>
          </tr>
          <tr>
            <td class='invoice_title'>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class='invoice_title'>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> <table width='100%'  style='font-family:Verdana, Geneva, sans-serif; border:1px solid #000;'>
              <tr style='font-size:12px; padding:5px 0px; border:1px solid #000;'>
                <td width='8%' height='32' align='center' bgcolor='#e6e8e9' style=' border-bottom:1px solid #000;border-right:1px solid #000; padding:5px 0px;'><strong>Sr. No.</strong></td>
                    <td width='20%' align='center' bgcolor='#e6e8e9' style=' border-bottom:1px solid #000;border-right:1px solid #000;'><strong>Payment Type</strong></td>
                    <td width='14%' align='center' bgcolor='#e6e8e9' style=' border-bottom:1px solid #000;border-right:1px solid #000;'><strong>Amount($)</strong></td>
                    <td width='9%' align='center' bgcolor='#e6e8e9' style=' border-bottom:1px solid #000;border-right:1px solid #000;'><strong>Payment Mode</strong></td>
                  
                    <td width='9%' align='center' bgcolor='#e6e8e9' style=' border-bottom:1px solid #000;border-right:1px solid #000;'><strong>Total Amount($)</strong></td>
                  </tr>
              <tr>
                <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                  </tr>
             
              <tr>
                <td align='center' style=' border-bottom:1px solid #e1e1e1;border-right:1px solid #e1e1e1; padding:5px 0px;'>".$x."</td>
                    <td align='center' style=' border-bottom:1px solid #e1e1e1;border-right:1px solid #e1e1e1; padding:5px 0px;'>".$Remark."</td>
                    <td align='center' style=' border-bottom:1px solid #e1e1e1;border-right:1px solid #e1e1e1; padding:5px 0px;'>".$amount."</td>
                    <td align='center' style=' border-bottom:1px solid #e1e1e1;border-right:1px solid #e1e1e1; padding:5px 0px;'>".$pay_mode."</td>
          
                <td align='center' style=' border-bottom:1px solid #e1e1e1;border-right:1px solid #e1e1e1; padding:5px 0px;'>".$amount."</td>
                  </tr>
             
              <tr>
                <td colspan='5' align='right'>&nbsp;</td>
                  </tr>
              <tr>
                <td colspan='4' align='right'><strong>Total Amount:</strong></td>
                    <td align='center'>$".$amount."</td>
                  </tr>
          
             
             
              <tr>
                <td colspan='4' align='right'><strong>Admin Charge:</strong></td>
                <td  align='center'>$".$admin_charge."</td>
              </tr>
              <tr>
                <td colspan='4' align='right'><strong>Total Amount:</strong></td>
                    <td  align='center'>$".$total."</td>
                  </tr>
              <tr>
                <td colspan='5' align='right'>&nbsp;</td>
                  </tr>
              
            </table></td>
  </tr>
   <tr>
       
        <td colspan=3><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        
      </tr>
      
      <tr>
        <td colspan=3><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>Vision Team Network Admin</p></td>
        
      </tr>
</table></body>
</html>";

//echo $msg;
mail($email, 'Payment Confirmation', $msg, $headeruser1);
}

function get_product_name($id)
{
	$sql="select product_name from product_category where p_cat_id='$id'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['product_name'];
}

function get_user_image($user_id)
{
	$sql="select image from registration where user_id='$user_id'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['image'];
}

function email_to_upline($nom_id,$user_id,$user_nm)
{
	 $from='info@visionteamnetwork.com';
	 // get nom email
	 $sql="select * from registration where user_id='$nom_id'";
	 $res=mysql_query($sql);
	 $row=mysql_fetch_assoc($res);
	 $email=$row['email'];
	 $upline_name=$row['user_name'];
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:VTN <$from>" . "\r\n";
	 $url="http://www.visionteamnetwork.com/".$user_nm;
     $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src='http://www.visionteamnetwork.com/img/logo.png'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>Hi ".stripslashes(htmlentities($upline_name)).",</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>


      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'>Congratulation you have a new associate member that sign in your down-line.
</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>VTN Admin</p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    </div>
  </div>
 
</div>

</body>
</html>";
 //  $header="From: info@infinitillio.com";
  //echo $msg;exit;
   
	  mail($email,'WELCOME',$msg,$headeruser1,'$from');
}
function email_to_sponser($ref_id,$user_id,$user_nm)
{
	 $from='info@visionteamnetwork.com';
	 // get nom email
	 $sql="select * from registration where user_id='$ref_id'";
	 $res=mysql_query($sql);
	 $row=mysql_fetch_assoc($res);
	 $email=$row['email'];
	 $upline_name=$row['user_name'];
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:VTN <$from>" . "\r\n";
	 $url="http://www.visionteamnetwork.com/".$user_nm;
     $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src='http://www.visionteamnetwork.com/img/logo.png'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>Hi ".stripslashes(htmlentities($upline_name)).",</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'>Congratulation you have a new associate member that just sign in your direct membership.
</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>VTN Admin</p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    </div>
  </div>
 
</div>

</body>
</html>";
 //  $header="From: info@infinitillio.com";
  //echo $msg;exit;
   
	  mail($email,'WELCOME',$msg,$headeruser1,'$from');
}
function email_to_sponser1($ref_id,$user_id,$user_nm)
{
	 $from='info@visionteamnetwork.com';
	 // get nom email
	 $sql="select * from registration where user_id='$ref_id'";
	 $res=mysql_query($sql);
	 $row=mysql_fetch_assoc($res);
	 $email=$row['email'];
	 $upline_name=$row['user_name'];
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:VTN <$from>" . "\r\n";
	 $url="http://www.visionteamnetwork.com/".$user_nm;
     $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src='http://www.visionteamnetwork.com/img/logo.png'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>Hi ".stripslashes(htmlentities($upline_name)).",</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'>Congratulation you have a new affiliate member that sign in your affiliate referral membership.
</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>VTN Admin</p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>";
 //  $header="From: info@infinitillio.com";
  //echo $msg;exit;
   
	  mail($email,'WELCOME',$msg,$headeruser1,'$from');
}

function host_name()
{
	$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	if ($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
	} 
	else 
	{
		$pageURL .= $_SERVER["SERVER_NAME"].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
	}
	return $pageURL;
}

function _query($slt, $table, $where=false)
{
	//echo "select ".$slt." from ".$table." where ".$where;
	return mysql_query("select ".$slt." from ".$table." where ".$where);
}

function _query_execute($sql)
{
	return mysql_query($sql);
}

function _execute_query($slt, $table, $where=false, $order_by)
{
	//echo "select ".$slt." from ".$table." where ".$where." order by ".$order_by;
	return mysql_query("select ".$slt." from ".$table." where ".$where." order by ".$order_by );
}

function _execute_join_query($select, $table1,$table2,$on, $where=false, $order_by)
{
	 $sql="select ".$select." from ".$table1." inner join ".$table2." on ".$on." where ".$where." order by ".$order_by;

	return mysql_query($sql);
}

function _result($res, $p1, $p2)
{
	return mysql_result($res, $p1, $p2);
}

function _num_row($res)
{
	return mysql_num_rows($res);
}

function _get_row($res)
{
	$row=mysql_fetch_array($res);
	return $row[0];
}

function _get_all_row($res)
{
	$row=mysql_fetch_assoc($res);
	return $row;
}

function _get_pid()
{
	return mysql_insert_id();
}

function _insert_tbl($insert_arr,$tbl)
{
 $sql="INSERT INTO $tbl set ";
 foreach($insert_arr as $key=>$val)
 $sql.=$key."='".addslashes($val)."',";
 $sql=substr($sql,0,strlen($sql)-1);
 //echo $sql; echo "<br>";exit;
 $rs=_query_execute($sql);
 if($rs)
  return true;
 else
  return false;
}

function _update_tbl($update,$tbl,$where,$addslashes=false)
{
 $sql="update $tbl set ";
 foreach($update as $key=>$val)
 {
  if($addslashes)
   $val = addslashes($val); 
  $sql.=$key."='".$val."',";
 }
 $sql=substr($sql,0,strlen($sql)-1);
 $sql.=" where $where ";
// echo $sql; "<br>";
 $rs=_query_execute($sql);
 if($rs)
  return true;
 else
  return false;
}

function _get_withdraw_config_list($script_name=false)
{
	$sql="select * from master_withdraw_config where withdraw_status=0";
	$res=mysql_query($sql); 
	while($row=mysql_fetch_assoc($res))
	{
		if($row['script_name']==$script_name){$class="class='active_tab'";}else{ $class="";}
		echo "<li><a href='".$row['script_name']."' $class >".$row['withdraw_tab']."</a></li>";
	}
}

function _get_withdraw_config($script_name)
{
	$sql="select * from master_withdraw_config where withdraw_status=0 and script_name='$script_name'";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	return $count;
}

function _get_member_status($user_id,$type=false)
{
	if($type=='binary')
	{
		$sql="select * from registration where ref_id='$user_id' and reseller=1";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>=6)
		{
			echo "Qualify";
		}
		else
		{
			echo "Pending";
		}
	}
	else
	{
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		if($type=='reseller')
		{
			if($row['reseller'])
			{
				return "Reseller";
			}
			else
			{
				return "Pending";
			}
		}
		else if($type=='affiliate')
		{
			if($row['bonus'])
			{
				return "Affiliate";
			}
			else
			{
				return "Pending";
			}
		}
		else if($type=='rank')
		{
			if($row['user_plan'])
			{
				return $row['user_plan'];
			}
			else
			{
				return "Pending";
			}
		}
	}
}

function total_direct_referral_commission($id)
{
	$sql="SELECT final_amount FROM `direct_referral_bonus`
WHERE income_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res=mysql_query($sql);
						while($row=mysql_fetch_assoc($res))
						{
							
							$final_amount +=$row['final_amount'];
						}
						return $final_amount;
}

function total_upgrade_commission($id)
{
	$sql1="SELECT final_amount FROM `upgrade_bonus`
WHERE income_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res1=mysql_query($sql1);
						while($row1=mysql_fetch_assoc($res1))
						{
							
							$final_amount +=$row1['final_amount'];
						}
						return $final_amount;
}
function total_binary_commission($id)
{
	$sql2="SELECT final_amount FROM `binary_income`
WHERE user_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res2=mysql_query($sql2);
						while($row2=mysql_fetch_assoc($res2))
						{
							
							$final_amount +=$row2['final_amount'];
						}	
						return $final_amount;
						
}
function total_five_star_special_commission($id)
{
	
	$sql3="SELECT final_amount FROM `five_star_special_bonus`
WHERE income_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res3=mysql_query($sql3);
						while($row3=mysql_fetch_assoc($res3))
						{
							
							$final_amount +=$row3['final_amount'];
						}
						return $final_amount;	
}
function total_matching_commission($id)
{
	$sql4="SELECT final_amount FROM `matching_bonus`
WHERE income_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res4=mysql_query($sql4);
						while($row4=mysql_fetch_assoc($res4))
						{
							
							$final_amount +=$row4['final_amount'];
						}	
						return $final_amount;
}
function total_repurchase_commission($id)
{
	$sql5="SELECT final_amount FROM `repurchase_bonus_one`
WHERE income_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res5=mysql_query($sql5);
						while($row5=mysql_fetch_assoc($res5))
						{
							
							$final_amount +=$row5['final_amount'];
						}
						return $final_amount;	
}

function total_repurchase__binary_commission($id)
{
	$sql5="SELECT final_amount FROM `repurchase_binary_income`
WHERE user_id = '$id' ORDER BY `ts` DESC";
 //echo $sql;
						$res5=mysql_query($sql5);
						while($row5=mysql_fetch_assoc($res5))
						{
							
							$final_amount +=$row5['final_amount'];
						}
						return $final_amount;	
}

function _get_daily_task_status($user_id)
{
	$sql="select * from weekly_adds_mp where status=1 and user_id='$user_id'";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	return $count;
}


function _get_referral_volume($user_id)
{
	$drbQry=mysql_query("select sum(invoice_bv) as income_bv from direct_referral_bonus where income_id='$user_id' ") or die(mysql_error());
		
		$drbRow=mysql_fetch_assoc($drbQry);
		$income_bv=$drbRow['income_bv'];
		return $income_bv;
}

function _get_referral_percentage($user_id)
{
	$drbQry=mysql_query("select sum(invoice_bv) as income_bv from direct_referral_bonus where income_id='$user_id'") or die(mysql_error());
		
		$drbRow=mysql_fetch_assoc($drbQry);
		$income_bv=$drbRow['income_bv'];
		if($income_bv>=0 && $income_bv<=299)
		{
		$per=18;	
		}
		elseif($income_bv>=300 && $income_bv<=599)
		{
		$per=23;
		}
		elseif($income_bv>=600)
		{
		$per=28;		
		}
		return $per;
		
}



function _get_member_rank($user_name)
{
	
	$qry=mysql_query("select * from user_rank ur inner join user_rank_achieve ura on ur.id=ura.rank_id where ura.username='$user_name'") or die(mysql_error());
	$num=mysql_num_rows($qry);
		$row=mysql_fetch_assoc($qry);
		$rank_name=$row['rank_name'];
		$rank_target=$row['rank_target'];
	if($num>0)
	{
		if($rank_target<30)
		{
			return "Below Rank";
		}
		
		else
		{
		return $rank_name;
		}
	}
	else
	{
		return "Customer";
	}
	
}

function _get_personal_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id='$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql) ;
	$row=mysql_fetch_assoc($res);
	 $row['total']; 
	if($row['total']!='')
	{
	
	return $row['total'];
	}
	else
	{
		return 0;
	}
}


function _get_left_team_sale_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id<>'$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['total']." PV";
}

function _get_right_team_sale_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id<>'$user_id' and  income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['total']." PV";
}


function _get_team_sale_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id<>'$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['total']." PV";
}



function _get_team_sale($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_amt) as total from purchase_sale where purcheser_id<>'$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['total']." ";
}

/*function _get_withdrawal_day()
{
	$day=date('d');
	
	$sql="select * from withdrawl_date ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	$from_day=$row['from_date'];
	$to_day=$row['to_date'];
	if($day>='1' && $day<=5)
	{
	
	}
	else
	{
		echo "<br><font color='red'>Withdraw Of Amount Only On ".$from_day."-".$to_day." of month. So Please wait for ".$from_day."-".$to_day." or choose automatic option. Today is ".$day."</font>";//exit;
	}
}*/


function _get_withdrawal_day_message()
{
	$day=date('l');
	if($day=='Friday')
	{
	
	}
	else
	{
		echo "<br><font color='red'>Withdraw Of Amount Only On Friday. So Please Wait For Friday. Today is ".$day."</font>";//exit;
	}
}


function _get_withdrawal_day()
{
	$sql="select * from withdrawl_date ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	$day=$row['day'];
	return $day;
	
}
function _get_withdrawal_from_day()
{
	$sql="select * from withdrawl_date ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	$from_day=$row['from_date'];
	return $from_day;
	
}

function _get_withdrawal_to_day()
{
	$sql="select * from withdrawl_date ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	$to_day=$row['to_date'];
	return $to_day;
	
}

function _get_withdraw_today($user_id,$withdraw_limit)
{
	$today=date('Y-m-d');
	$sql="select sum(amount) as cnt from withdraw_fund where user_id='$user_id' and with_date='$today'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	if($row['cnt']>=$withdraw_limit)
	{
		return false;
	}
	else
	{
		return true;
	}
	
	
	
	
	
	
}