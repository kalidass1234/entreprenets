<?php  

function saveRegistrationAdmin()
{
	define(URL, "http://198.154.192.169/~develope/joshua/");
global $ref_id1, $ping, $upline, $nom_id, $binary, $plang, $plan_amt, $joining_date, $dobg, $faname, $district, $blgroup, $user_id, $usernm, $passg, $title, $userfname, $usermname, $userlname, $age, $mstatus, $sex, $nation, $addressg, $cityg, $stateg, $countryg, $zipg, $mobileg, $emailg, $nominee, $relation, $broad_inv, $reg_fee, $regdate, $ref_nm, $nage, $bankname, $branchname, $acno, $acc_detail, $cheque, $pancard, $bld_grp, $phoner,$phoneg, $phoneo, $dyid, $tcode, $topmem,$branch_code,$amount,$draft,$date,$applicant_bank,$applicant_branch,$account_type,$exp_ref_id,$id_card,$education,$lname,$fname,$mid_nameg,$sur_name,$first_nameg, $last_nameg, $bank_nm, $branch_nm, $ac_no, $cheque_name,$branchcode,$secret_question,$secret, $address2,$nom_id1,$packageg,$plan_name,$mode,$sponsor_user_name,$sponsor_pass, $sponsor_txt_pass, $user_type, $bank_nameg,$bank_codeg,$ac_numberg,$cd1g,$cd2g,$user_id_sponsor,$x1,$sub_for, $paymentg, $ssng, $invoice, $total_plan_amt;
$fullname=$first_nameg.' '.$mid_nameg.' '.$last_nameg;
$fname=$first_nameg;
	$email=$emailg;
	$username=$user_id;
	$address=$addressg;
	$city=$cityg;
	$country=$countryg;
	$phone=$phoneg;
	$mobile=$mobileg;
	
	$date1=date("dmY");
	$regdate=date("Y-m-d");
	$cur_date=date('Y-m-d');
   // $dyid=date("dmY");
//$quer="select MAX(id) from registration";
//$data=mysql_query($quer);
//$res=mysql_result($data, 0, 0);
//$dyid12=$res+11111;

   
 //  $curpos=$binary; 
   $userid=isset($_SESSION['sessionuserid']) ? $_SESSION['sessionuserid'] : '';
   $quers_sid="select  user_type, astatus, gstatus, subs_date, first_name, mid_name, last_name, user_id  from registration where user_id='$ref_id1'";
   $dat_sid=mysql_query($quers_sid);
    $reff_show=mysql_fetch_array($dat_sid);
	$ref_name=$reff_show['first_name']. ' '.$reff_show['mid_name'].' '.$reff_show['last_name'];
	$ref_id=$reff_show['user_id'];
   $red_sid=mysql_num_rows($dat_sid);
  $user_typeref=$reff_show[user_type];
   $astatus=$reff_show['astatus'];
   $gstatus=$reff_show['gstatus'];
   function meberins()
 {
  //$encypt1=uniqid(rand(), true);
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);
  
  $checkid=mysql_query("select invoice from membership where invoice='$pre_userid'");
  if(mysql_num_rows($checkid)>0)
  {
   meberins();
  }
  else
   return $pre_userid;
 }
 $invoicem=meberins();
if($red_sid>0)
{
 
	if(($sub_for!=NULL || $sub_for!=0) and $plan_amt!=0 )
	{ 
	  $subdate=$regdate;
	  $rep_date=strtotime($subdate);
	  $rep_date= date('Y-m-d',strtotime("+$sub_for months",$rep_date));
	 }
   /*$quers="select count(*) from pins where pin_no='$pin' and status=0 ";
   $dat=mysql_query($quers);
   $red=mysql_result($dat,0,0);
   if(($red>0) or (1==1))*/
	
if((1==1))	
	{
	/*$quers_pinst="select * from pins where pin_no='$pin'";
   $dat_pinst=mysql_query($quers_pinst);
   
   $red_pinst=mysql_fetch_array($dat_pinst);*/
  $name_invoice="فاليونير - قسم الفواتير";
   $quer="insert into registration(user_id, user_name, nom_id, user_pass, t_code, plan_name,  pin_no, ref_id,  first_name, mid_name, last_name, dob, phoner,mobile,email, address,city, state, zip, country, reg_date, subs_date,status,sex,plan_amt,payment_mode,user_type,bank_nm,branchcode,ac_no,pan_no,phoneo,title_nm,sub_for, payment_type, ssn)values('$userid', '$user_id', '$nom_id1', '$passg', '$passg', '$plan_name', '$pin', '$ref_id1', '$first_nameg', '$mid_nameg', '$last_nameg', '$dobg', '$phoner', '$phoneg','$emailg','$addressg','$cityg', '$stateg', '$zipg', '$countryg', '$regdate','$rep_date','0', '$sex','$packageg','$mode','$user_type','$bank_nameg','$bank_codeg','$ac_numberg','$cd1g','$cd1g','','$sub_for', '$paymentg', '$ssng')";
 
	$data=mysql_query($quer) or die(mysql_error());
	$success_id=mysql_insert_id();
 if($success_id!=''){ $useridnoti=$nom_id1;
 	$sql_tax=mysql_fetch_array(mysql_query("select * from tax order by id desc limit 1"));
	$sale_tax=$sql_tax['sales'];
	if($user_type=='m'){ 
	$news_type='a';
		$sql_membership=mysql_fetch_array(mysql_query("select * from mem_fee order by id desc limit 1"));
		$mem_fee=$sql_membership['fees'];
		 
	
	$mem_tax=($sale_tax*$mem_fee)/100;
	$total_price=$mem_tax+$mem_fee;
		mysql_query("INSERT INTO membership SET  user_id='{$userid}', date='$cur_date', member_fees='$mem_fee', payment_type='$paymentg', user_type='$user_type', invoice='$invoicem', total_price='$total_price'");
		/******* Check The active Status ************/	
			if($astatus==0){
				$res_astatus=mysql_query("SELECT ref_id FROM registration WHERE ref_id='$ref_id1' ");
				$count_astatus=mysql_num_rows($res_astatus);
				if($count_astatus>=2 && $reff_show['subs_date']!='0000-00-00'){
					mysql_query("UPDATE registration SET astatus=1 WHERE user_id='$ref_id1'");
				}
			}
		/*******End: Check The active Status ************/
		/******* Check The Gold Status ************/	
			if($gstatus==0 && $reff_show['subs_date']!='0000-00-00'){
				$res_gstatus=mysql_query("SELECT ref_id FROM registration WHERE ref_id='$ref_id1'  and astatus=1");
				$count_gstatus=mysql_num_rows($res_gstatus);
				if($count_gstatus>=4){
					mysql_query("UPDATE registration SET gstatus=1 WHERE user_id='$ref_id1'");
					
				}
			}
		/*******End: Check The Gold Status ************/
 		for($noticount=1; $noticount<=5; $noticount++){
	 
	  $notiresult=mysql_fetch_array(mysql_query("select email, nom_id, user_id, first_name, mid_name, last_name from registration where user_id='$useridnoti'"));
	
	 $_SESSION['ref_name']=ucfirst($notiresult[first_name]).' '.ucfirst($notiresult[mid_name]).' '.ucfirst($notiresult[last_name]);
	
	  $useridnoti=$notiresult[nom_id];
		mysql_query( "INSERT INTO notify SET user_id='{$userid}', nom_id='$notiresult[user_id]', date='$cur_date', note='register', level='$noticount'") or die(mysql_error());
		$to=$notiresult[email];
		$from="marketing@valunaire.com";
		$subject =  " عضو جديد إنضم إلى فريقك"; 
	$name_downlin=" فاليونير - قسم التسويق";
		
		$message =   "<html>
	<head>
	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	
	<title>Valunaire.com</title>
	</head>
	<body style='margin:0px; padding:0px; color:#202320; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; '>
	<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0' data-mobile='true' dir='rtl' style='background-color: rgb(255, 255, 255);'>
    <thead><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' width='600' class='wrapper' style='width: 600px;'></table></td></tr></thead><tbody><tr>
        <td valign='top' align='center' style='padding:0;margin:0;'>
            <table align='center' border='0' cellspacing='0' cellpadding='0' width='600' style='width: 600px;' class='wrapper'>
                <tbody><tr>
                    <td align='left' valign='top' style='padding:0;margin:0;'>
                        <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                            <tbody><tr>
                                <td valign='top' align='left' style='padding: 5px 0px 5px 18px; margin: 0px; border-right-width: 19px; border-right-style: solid; border-right-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(4, 7, 7); background-image: url(http://valunaire.com/images/Log.png); line-height: 2.05; background-position: 50% 50%; background-repeat: no-repeat no-repeat;'><div><br></div><div style='text-align: left;'><br></div><div><br></div></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td align='center' valign='top' style='padding:0;margin:0;'>
                        <table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'>
                            <tbody><tr>
                                <td width='65%' valign='top' align='center'>
                                    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                                        <tbody><tr>
                                            <td align='left' valign='top' style='margin:0;padding:0;'>
                                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                                    <tbody><tr>
                                                        <td valign='top' align='left' style='padding: 3px 10px 10px 18px; margin: 0px; border-left-width: 18px; border-left-style: solid; border-left-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(255, 215, 0);'><div style='text-align: center; '><span style='font-size: 38px; font-weight: bold;'>&nbsp;لديك عضو جديد</span></div></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td width='34%' valign='top' align='center'>
                                    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                                        <tbody><tr>
                                            <td align='left' valign='top' style='margin:0;padding:0;'>
                                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                                    <tbody><tr>
                                                        <td valign='top' align='left' style='padding: 10px 19px 10px 8px; margin: 0px; font-family: Arial, sans-serif; color: rgb(178, 178, 178); border: 1px none transparent;'><div style='text-align: center; '><span style='color: rgb(178, 178, 178); font-family: Arial, sans-serif; background-color: transparent; float: none; display: inline !important; font-weight: bold;'><font size='15' style='font-size: 15px;'>فاليونير - قسم التسويق</font></span></div></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td align='left' valign='top' style='padding:0;margin:0;'>
                        <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                            <tbody><tr>
                                <td valign='top' align='left' style='padding: 20px 19px 20px 18px; margin: 0px; font-family: Arial, sans-serif; color: rgb(77, 77, 77); border: 1px none transparent;'><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'>مرحباً بك $_SESSION[ref_name]</span></div><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'><br></span></div><div style='text-align: right;'><span style='font-size: 18px;'>تهانينا، لقد إنضم العضو $user_id إلى هيكل الأعمال الخاص بك.</span></div><div style='text-align: right;'><span style='background-color: transparent; font-size: 18px;'><br>رقم موبيل العضو: $phoneg</span></div><div style='text-align: right;'><span style='font-size: 18px;'>البريد الإلكتروني الخاص بالعضو: $emailg</span></div></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td valign='top' align='left' style='padding:0;margin:0;'>
                        
                    </td>
                </tr>
                <tr><td><table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' data-editable='text'><tbody><tr><td style='padding: 10px; font-family: Arial, Helvetica, sans-serif; color: rgb(38, 38, 38); border: 1px none transparent;'><span style='font-weight: bold;'>مع أطيب التحيات</span><br></td></tr></tbody></table></td></tr><tr>
                    <td align='left' valign='top' style='padding: 0px; margin: 0px;'> 
                        <table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' data-editable='line' style='margin: auto; padding: 0px;'>
                            <tbody><tr>
                                <td valign='top' align='center' style='padding: 35px 19px 21px 18px; margin: 0px;'><div style='height: 1px; line-height: 1px; border-top-width: 1px; border-top-style: dotted; border-top-color: rgb(232, 223, 204);'>
                                        <img src='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' alt='' width='1' height='1' style='display:block;'>
                                    </div></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr><tr><td><table cellpadding='0' cellspacing='0' align='right' data-editable='image'><tbody><tr><td valign='top' align='left' style='margin: 0px; padding: 10px 0px;'><img src='https://multimedia.getresponse.com/126/475126/photos/1349250.png?img1377345049962' width='600' style='border: 0px none transparent; display: block;' height='279' data-src='https://multimedia.getresponse.com/126/475126/photos/1349250.png|600|279|366|171|0|0' data-origsrc='https://multimedia.getresponse.com/126/475126/photos/1349248.png'></td></tr></tbody></table></td></tr>
                
                <tr>
                    <td align='center' valign='top' style='padding:0;margin:0;'>
                        
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>
			</body></html>";
			$header="Mime-Version: 1.0\r\n";
	
		    $header.= 'Content-type: text/html; charset=iso-8859-1;  charset=UTF-8' . "\r\n";
		   $header.= 'Content-Transfer-Encoding: 8bit'."\r\n";
			 $header.="From: "."=?UTF-8?B?".base64_encode($name_downlin)."?="." < ". $from." > \r\n";
		 $header.= 'X-Mailer: PHP/' . phpversion(); 
		mail($to, $subject, $message, $header);
	 if($notiresult[nom_id]=='cmp') break;
			
		} 
		$note="member";
	}
	else{ $note="prospect";
	$news_type='p';
	$useridnoti=$ref_id1;
		$notiresult=mysql_fetch_array(mysql_query("select email, nom_id, user_id, first_name, mid_name, last_name from registration where user_id='$useridnoti'"));

 $_SESSION['ref_name']=ucfirst($notiresult[first_name]).' '.ucfirst($notiresult[mid_name]).' '.ucfirst($notiresult[last_name]);

  
	mysql_query( "INSERT INTO notify SET user_id='{$userid}', nom_id='$useridnoti', date='$cur_date', note='register', level='1'") or die(mysql_error());
	$to=$notiresult['email'];
	$from="marketing@valunaire.com";
	$subject =  " عضو جديد إنضم إلى فريقك"; 
	$name_downlin=" فاليونير - قسم التسويق";
   	$message =   "<html>
<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<title>Valunaire.com</title>
</head>
<body style='margin:0px; padding:0px; color:#202320; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; '>
<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0' data-mobile='true' dir='rtl' style='background-color: rgb(255, 255, 255);'>
    <thead><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' width='600' class='wrapper' style='width: 600px;'></table></td></tr></thead><tbody><tr>
        <td valign='top' align='center' style='padding:0;margin:0;'>
            <table align='center' border='0' cellspacing='0' cellpadding='0' width='600' style='width: 600px;' class='wrapper'>
                <tbody><tr>
                    <td align='left' valign='top' style='padding:0;margin:0;'>
                        <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                            <tbody><tr>
                                <td valign='top' align='left' style='padding: 5px 0px 5px 18px; margin: 0px; border-right-width: 19px; border-right-style: solid; border-right-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(4, 7, 7); background-image: url(http://valunaire.com/images/Log.png); line-height: 2.05; background-position: 50% 50%; background-repeat: no-repeat no-repeat;'><div><br></div><div style='text-align: left;'><br></div><div><br></div></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td align='center' valign='top' style='padding:0;margin:0;'>
                        <table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'>
                            <tbody><tr>
                                <td width='65%' valign='top' align='center'>
                                    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                                        <tbody><tr>
                                            <td align='left' valign='top' style='margin:0;padding:0;'>
                                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                                    <tbody><tr>
                                                        <td valign='top' align='left' style='padding: 3px 10px 10px 18px; margin: 0px; border-left-width: 18px; border-left-style: solid; border-left-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(255, 215, 0);'><div style='text-align: center; '><span style='font-size: 38px; font-weight: bold;'>&nbsp;لديك عضو جديد</span></div></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td width='34%' valign='top' align='center'>
                                    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                                        <tbody><tr>
                                            <td align='left' valign='top' style='margin:0;padding:0;'>
                                                <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                                    <tbody><tr>
                                                        <td valign='top' align='left' style='padding: 10px 19px 10px 8px; margin: 0px; font-family: Arial, sans-serif; color: rgb(178, 178, 178); border: 1px none transparent;'><div style='text-align: center; '><span style='color: rgb(178, 178, 178); font-family: Arial, sans-serif; background-color: transparent; float: none; display: inline !important; font-weight: bold;'><font size='15' style='font-size: 15px;'>فاليونير - قسم التسويق</font></span></div></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td align='left' valign='top' style='padding:0;margin:0;'>
                        <table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                            <tbody><tr>
                                <td valign='top' align='left' style='padding: 20px 19px 20px 18px; margin: 0px; font-family: Arial, sans-serif; color: rgb(77, 77, 77); border: 1px none transparent;'><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'>مرحباً بك $_SESSION[ref_name]</span></div><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'><br></span></div><div style='text-align: right;'><span style='font-size: 18px;'>تهانينا، لقد إنضم العضو $user_id إلى هيكل الأعمال الخاص بك.</span></div><div style='text-align: right;'><span style='background-color: transparent; font-size: 18px;'><br>رقم موبيل العضو: $phoneg</span></div><div style='text-align: right;'><span style='font-size: 18px;'>البريد الإلكتروني الخاص بالعضو: $emailg</span></div></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td valign='top' align='left' style='padding:0;margin:0;'>
                        
                    </td>
                </tr>
                <tr><td><table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' data-editable='text'><tbody><tr><td style='padding: 10px; font-family: Arial, Helvetica, sans-serif; color: rgb(38, 38, 38); border: 1px none transparent;'><span style='font-weight: bold;'>مع أطيب التحيات</span><br></td></tr></tbody></table></td></tr><tr>
                    <td align='left' valign='top' style='padding: 0px; margin: 0px;'> 
                        <table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' data-editable='line' style='margin: auto; padding: 0px;'>
                            <tbody><tr>
                                <td valign='top' align='center' style='padding: 35px 19px 21px 18px; margin: 0px;'><div style='height: 1px; line-height: 1px; border-top-width: 1px; border-top-style: dotted; border-top-color: rgb(232, 223, 204);'>
                                        <img src='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' alt='' width='1' height='1' style='display:block;'>
                                    </div></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr><tr><td><table cellpadding='0' cellspacing='0' align='right' data-editable='image'><tbody><tr><td valign='top' align='left' style='margin: 0px; padding: 10px 0px;'><img src='https://multimedia.getresponse.com/126/475126/photos/1349250.png?img1377345049962' width='600' style='border: 0px none transparent; display: block;' height='279' data-src='https://multimedia.getresponse.com/126/475126/photos/1349250.png|600|279|366|171|0|0' data-origsrc='https://multimedia.getresponse.com/126/475126/photos/1349248.png'></td></tr></tbody></table></td></tr>
                
                <tr>
                    <td align='center' valign='top' style='padding:0;margin:0;'>
                        
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>
		</body></html>";
		$header="Mime-Version: 1.0\r\n";
		 $header.= 'Content-type: text/html; charset=iso-8859-1;  charset=UTF-8' . "\r\n";
		   $header.= 'Content-Transfer-Encoding: 8bit'."\r\n";
		    $header.="From: "."=?UTF-8?B?".base64_encode($name_downlin)."?="." < ". $from." > \r\n";
		 $header.= 'X-Mailer: PHP/' . phpversion(); 
	mail($to, $subject, $message, $header);
	}
	if ($data)
	{
		mysql_query( "UPDATE prospect_user SET status=1 WHERE   ref_id='{$ref_id1}' and pemail='$emailg'");
	if (($sub_for!=NULL) or ($user_type!=NULL ))
	{
	if(($sub_for!=NULL || $sub_for!=0) and $plan_amt!=0 )
	{ 
	 
	 $forday=$sub_for;
  $date=date('Y-m-d');
$edate=strtotime($date);

 $edate=date('Y-m-d',strtotime("+$forday months",$edate));
 //function for commission of subscription
  $sql_mem=mysql_query("select user_id from mem_subscribe where '$date' BETWEEN s_date and e_date and user_id='$userid' AND package='{$plan_name}'");
  $count_subscrip=mysql_num_rows($sql_mem);
 // echo "insert into mem_subscribe (user_id,user_name,p_id, sub_for,type,s_date,e_date,price,package, invoice , rep_date, total_price, product_no) values ('$userid','$user_id','$plan_name','$sub_for','$user_type','$date','$edate','$plan_amt','$plan_name', '$invoice', '$rep_date', '$total_plan_amt', '2')";
  if($count_subscrip<1){
	  if($user_type=='c') {$note="custmem";
	  $news_type='c';} else { $note="repmem";
	  $news_type='r';
	  }
	  if($sub_for==1) $subscr="الإشتراك الشهري";
	  else if($sub_for==12) $subscr="الاشتراك السنوي";
	  $subs_tax=($sale_tax*$plan_amt)/100;
 mysql_query("insert into mem_subscribe (user_id,user_name,p_id, sub_for,type,s_date,e_date,price,package, invoice , rep_date, total_price, product_no) values ('$userid','$user_id','$plan_name','$sub_for','$user_type','$date','$edate','$plan_amt','$plan_name', '$invoice', '$rep_date', '$total_plan_amt', '2')") or die(mysql_error());
 $from="billing@valunaire.com";
  $msg_sub_invoice="
	 	<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>Valunaire.com</title>
<style>
table {
	border-collapse:collapse;
}
</style>
</head>
<body style='margin:0px; padding:0px; color:#202320; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; ' dir='rtl'>
<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0' data-mobile='true' dir='ltr' style='background-color: rgb(255, 255, 255);'>
  <thead>
    <tr>
      <td align='center'><table cellpadding='0' cellspacing='0' border='0' width='600' class='wrapper' style='width: 600px;'>
        </table></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td valign='top' align='center' style='padding:0;margin:0;'><table align='center' border='0' cellspacing='0' cellpadding='0' width='600' style='width: 600px;' class='wrapper'>
          <tbody>
            <tr>
              <td align='left' valign='top' style='padding:0;margin:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='padding: 5px 0px 5px 18px; margin: 0px; border-right-width: 19px; border-right-style: solid; border-right-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(4, 7, 7); background-image: url(http://valunaire.com/images/Log.png); line-height: 2.05; background-position: 50% 50%; background-repeat: no-repeat no-repeat; height:100px;'><div><br>
                        </div>
                        <div style='text-align: left;'><br>
                        </div>
                        <div><br>
                        </div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='center' valign='top' style='padding:0;margin:0;'><table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'>
                  <tbody>
                    <tr>
                      <td width='65%' valign='top' align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                          <tbody>
                            <tr>
                              <td align='left' valign='top' style='margin:0;padding:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                  <tbody>
                                    <tr>
                                      <td valign='top' align='left' ><img src='http://198.154.192.169/~develope/joshua/userpanel/invoice_image.png'></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td width='34%' valign='top' align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                          <tbody>
                            <tr>
                              <td align='left' valign='top' style='margin:0;padding:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                  <tbody>
                                    <tr>
                                      <td valign='top' align='left' style='padding: 10px 19px 10px 8px; margin: 0px; font-family: Arial, sans-serif; color: rgb(178, 178, 178); border: 1px none transparent;'><div style='text-align: center; '><span style='color: rgb(178, 178, 178); font-family: Arial, sans-serif; background-color: transparent; float: none; display: inline !important; font-weight: bold;'><font size='15' style='font-size: 15px;'>فاليونير - قسم الفواتير</font></span></div></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='padding:0;margin:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='padding: 20px 19px 20px 18px; margin: 0px; font-family: Arial, sans-serif; color: rgb(77, 77, 77); border: 1px none transparent;'><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'>مرحباً بك&nbsp;$fullname</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'><br>
                          </span></div>
                        <div style='text-align: right;'>
                          <table width='100%' border='0'>
                            <tr>
                              <td><table width='100%' border='0'>
                                  <tr>
                                    <td><span style='margin-top:-10px; '><img src='http://198.154.192.169/~develope/joshua/userpanel/images/val.png' alt='' width='192' height='77'></span></td>
                                    <td align='center'><span style=''><img src='http://198.154.192.169/~develope/joshua/userpanel/images/paid.png' alt=''></span></td>
                                    <td align='right'><span style=''><img src='http://198.154.192.169/~develope/joshua/userpanel/images/invoice1.png' alt='' width='173' height='48'></span></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width='100%' border='0'>
                                  <tr>
                                    <td>$fullname</td>
                                    <td><strong>إسم العميل/العضو</strong></td>
                                    <td>$invoice</td>
                                    <td><strong><span dir='RTL'>رفم الفاتورة#</span></strong></td>
                                  </tr>
                                  <tr>
                                    <td>$mobileg</td>
                                    <td><strong>رقم العميل/العضو</strong></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width='100%' border='0' style='border:1px solid #CCC;'>
                                  <tr>
                                    <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>موزع/ممثل المبيعات</span></strong></td>
                                    <td align='center' bgcolor='#EBEBEB' ><strong><span dir='RTL'>رقم موزع/ممثل المبيعات</span></strong></td>
                                  </tr>
                                  <tr>
                                    <td align='center' style='border-right:1px solid #ccc;'>$ref_name</td>
                                    <td align='center' style='border-right:1px solid #ccc;'>$ref_id</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width='100%' border='0' style=' border:1px solid #ccc;'>
                                  <tr>
                                    <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي</span></strong></td>
                                    <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>سعر المنتج</span></strong></td>
                                    <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>وصف المنتج</span></strong></td>
                                    <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>رقم المنتج</span></strong></td>
                                  </tr>
                                  <tr>
                                    <td style='border-right:1px solid #ccc;'>&nbsp;</td>
                                    <td align='center' style='border-right:1px solid #ccc;'>$plan_amt</td>
                                    <td align='center' style='border-right:1px solid #ccc;'><span dir='RTL'>$subscr</span></td>
                                    <td align='center' style='border-right:1px solid #ccc;'>-</td>
                                  </tr>
                                  <tr>
                                    <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
                                    <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
                                    <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
                                    <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align='center' style='border-right:1px solid #ccc;  border-bottom:1px solid #ccc;'>$plan_amt</td>
                                    <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي  الفرعي</span></strong></td>
                                  </tr>
                                  <tr>
                                    <td align='center' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>$subs_tax</td>
                                    <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الضريبة</span></strong></td>
                                  </tr>
                                  <tr>
                                    <td align='center' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>$total_plan_amt</td>
                                    <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي</span></strong></td>
                                  </tr>
                                  <tr>
                                    <td align='center' style='border-right:1px solid #ccc;'>$total_plan_amt</td>
                                    <td colspan='3' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>المبلغ  المدفوع</span></strong></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                        </div>
                        <div style='text-align: right;'><span style='font-size: 18px;'><br>
                          </span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'><br>
                          </span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>**** هل ترغب بالمساعدة؟ ***</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>هل تريد الإستفسار عن فاتورتك؟ هل تريد الدعم الفني من قسم الفواتير؟</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>إرسل رسالة إلى billing@valunaire.com</span></div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td valign='top' align='left' style='padding:0;margin:0;'></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='padding: 0px; margin: 0px;'><table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' data-editable='line' style='margin: auto; padding: 0px;'>
                  <tbody>
                    <tr>
                      <td valign='top' align='center' style='padding: 25px 19px 21px 18px; margin: 0px;'><div style='height: 1px; line-height: 1px; border-top-width: 1px; border-top-style: dotted; border-top-color: rgb(232, 223, 204);'> <img src='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' alt='' width='1' height='1' style='display:block;'> </div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><table cellpadding='0' cellspacing='0' align='right' data-editable='image'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='margin: 0px; padding: 10px 0px;'><img src='https://multimedia.getresponse.com/126/475126/photos/1348904.png?img1377327615232' width='600' data-src='https://multimedia.getresponse.com/126/475126/photos/1348904.png|600|186|328|153|0|0' height='186' data-origsrc='https://multimedia.getresponse.com/126/475126/photos/1348903.png' style='border: 0px none transparent; display: block;'></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='center' valign='top' style='padding:0;margin:0;'></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
	 ";
	 $header="Mime-Version: 1.0\r\n";
	
		    $header.= 'Content-type: text/html; charset=iso-8859-1;  charset=UTF-8' . "\r\n";
		   $header.= 'Content-Transfer-Encoding: 8bit'."\r\n";
		     $header.="From: "."=?UTF-8?B?".base64_encode($name_invoice)."?="." < ". $from." > \r\n";
		    $header.= "X-Mailer: PHP". phpversion() ."\r\n";  
		$subject_subs="إيصال إستلام عن الفاتورة ".$invoicem." : للعضو ".$fullname;
   /*	$header .= "Reply-To: $from \r\n";
$header .= "Return-Path: $from \r\n";*/
		
	
		mail($emailg,$subject_subs,stripslashes($msg_sub_invoice),$header);
		
	/***********************************************/
	/******      Mail for Upgrade as Member   ******/
	
	$noti_subs=mysql_fetch_array(mysql_query("select * from notification WHERE note='upgrade'")); 
	
	
	
	 /*************mail send and short codes ****************/
	 $subject_subs = stripslashes($noti_subs['email']);
	$pattern = '/\[name]/U';
	$replacement = $fullname;
	$result_name= preg_replace($pattern, $replacement, $subject_subs);
	
	$pattern = '/\[FirstName]/U';
	$replacement = $fname;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[UserId]/U';
	$replacement = $id;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	$pattern = '/\[Email]/U';
	$replacement = $email;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[UserName]/U';
	$replacement = $username;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Address]/U';
	$replacement = $address;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[City]/U';
	$replacement = $city;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Country]/U';
	$replacement = $country;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Phone]/U';
	$replacement = $phone;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Mobile]/U';
	$replacement = $mobile;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	
	
	$from_subs=trim($noti_subs['fromemail']);
	
     $msg= trim($result_name);
	 $from="billing@valunaire.com";
	 $msg_subs_invoice="
	 	             <html>
	<head>
	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	
	<title>Valunaire.com</title>
    <style>
    table
{
border-collapse:collapse;
}
    </style>
	</head>
	<body style='margin:0px; padding:0px; color:#202320; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; ' dir='rtl'>
    <table width='100%' align='center' border='0' cellpadding='0' cellspacing='0' data-mobile='true' dir='ltr' style='background-color: rgb(255, 255, 255);'>
  <thead>
    <tr>
      <td align='center'><table cellpadding='0' cellspacing='0' border='0' width='600' class='wrapper' style='width: 600px;'>
        </table></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td valign='top' align='center' style='padding:0;margin:0;'><table align='center' border='0' cellspacing='0' cellpadding='0' width='600' style='width: 600px;' class='wrapper'>
          <tbody>
            <tr>
              <td align='left' valign='top' style='padding:0;margin:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='padding: 5px 0px 5px 18px; margin: 0px; border-right-width: 19px; border-right-style: solid; border-right-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(4, 7, 7); background-image: url(http://valunaire.com/images/Log.png); line-height: 2.05; background-position: 50% 50%; background-repeat: no-repeat no-repeat; height:100px;'><div><br>
                        </div>
                        <div style='text-align: left;'><br>
                        </div>
                        <div><br>
                        </div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='center' valign='top' style='padding:0;margin:0;'><table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'>
                  <tbody>
                    <tr>
                      <td width='65%' valign='top' align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                          <tbody>
                            <tr>
                              <td align='left' valign='top' style='margin:0;padding:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                  <tbody>
                                    <tr>
                                      <td valign='top' align='left'><img src='http://198.154.192.169/~develope/joshua/userpanel/invoice_image.png'></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td width='34%' valign='top' align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                          <tbody>
                            <tr>
                              <td align='left' valign='top' style='margin:0;padding:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                  <tbody>
                                    <tr>
                                      <td valign='top' align='left' style='padding: 10px 19px 10px 8px; margin: 0px; font-family: Arial, sans-serif; color: rgb(178, 178, 178); border: 1px none transparent;'><div style='text-align: center; '><span style='color: rgb(178, 178, 178); font-family: Arial, sans-serif; background-color: transparent; float: none; display: inline !important; font-weight: bold;'><font size='15' style='font-size: 15px;'>فاليونير - قسم الفواتير</font></span></div></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='padding:0;margin:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='padding: 20px 19px 20px 18px; margin: 0px; font-family: Arial, sans-serif; color: rgb(77, 77, 77); border: 1px none transparent;'><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'>مرحباً بك&nbsp;$ref_name</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'><br>
                          </span></div>
                        <div style='text-align: right;'>
           
	<table width='100%' border='0'>
	  <tr>
	    <td><table width='100%' border='0'>
	      <tr>
	        <td><span style='margin-top:-10px; '><img src='http://198.154.192.169/~develope/joshua/userpanel/images/val.png' alt='' width='192' height='77'></span></td>
	        <td align='center'><span style=''><img src='http://198.154.192.169/~develope/joshua/userpanel/images/paid.png' alt=''></span></td>
	        <td align='right'><span style=''><img src='http://198.154.192.169/~develope/joshua/userpanel/images/invoice1.png' alt='' width='173' height='48'></span></td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width='100%' border='0'>
	      <tr>
	        <td>$fullname</td>
	        <td><strong>إسم العميل/العضو</strong></td>
	        <td>$invoice</td>
	        <td><strong><span dir='RTL'>رفم الفاتورة#</span></strong></td>
          </tr>
	      <tr>
	        <td>$mobile</td>
	        <td><strong>رقم العميل/العضو</strong></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width='100%' border='0' style='border:1px solid #CCC;'>
	      <tr>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>موزع/ممثل المبيعات</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' ><strong><span dir='RTL'>رقم موزع/ممثل المبيعات</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc;'>$ref_name</td>
	        <td align='center' style='border-right:1px solid #ccc;'>$ref_id</td>
          </tr>
	      
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width='100%' border='0' style=' border:1px solid #ccc;'>
	      <tr>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>سعر المنتج</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>وصف المنتج</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>رقم المنتج</span></strong></td>
          </tr>
	      <tr>
	        <td style='border-right:1px solid #ccc;'>&nbsp;</td>
	        <td align='center' style='border-right:1px solid #ccc;'>$fees</td>
	        <td align='center' style='border-right:1px solid #ccc;'><span dir='RTL'>إشتراك سنوي في خدمة فاليونير</span></td>
	        <td align='center' style='border-right:1px solid #ccc;'>-</td>
          </tr>
	     
	      <tr>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc;  border-bottom:1px solid #ccc;'>$fees</td>
	        <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي  الفرعي</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>$mem_tax</td>
	        <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الضريبة</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>$total_price</td>
	        <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc;'>$total_price</td>
	        <td colspan='3' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>المبلغ  المدفوع</span></strong></td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
    </table>
	
                        
                        </div>
                        <div style='text-align: right;'><span style='font-size: 18px;'><br>
                          </span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'><br>
                          </span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>**** هل ترغب بالمساعدة؟ ***</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>هل تريد الإستفسار عن فاتورتك؟ هل تريد الدعم الفني من قسم الفواتير؟</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>إرسل رسالة إلى billing@valunaire.com</span></div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td valign='top' align='left' style='padding:0;margin:0;'></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='padding: 0px; margin: 0px;'><table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' data-editable='line' style='margin: auto; padding: 0px;'>
                  <tbody>
                    <tr>
                      <td valign='top' align='center' style='padding: 25px 19px 21px 18px; margin: 0px;'><div style='height: 1px; line-height: 1px; border-top-width: 1px; border-top-style: dotted; border-top-color: rgb(232, 223, 204);'> <img src='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' alt='' width='1' height='1' style='display:block;'> </div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><table cellpadding='0' cellspacing='0' align='right' data-editable='image'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='margin: 0px; padding: 10px 0px;'><img src='https://multimedia.getresponse.com/126/475126/photos/1348904.png?img1377327615232' width='600' data-src='https://multimedia.getresponse.com/126/475126/photos/1348904.png|600|186|328|153|0|0' height='186' data-origsrc='https://multimedia.getresponse.com/126/475126/photos/1348903.png' style='border: 0px none transparent; display: block;'></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='center' valign='top' style='padding:0;margin:0;'></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body></html>
	 ";
	 $name_subs=$noti_subs['name'];
	 $header="Mime-Version: 1.0\r\n";
	 
	$header.= 'Content-type: text/html; charset=iso-8859-1;  charset=UTF-8' . "\r\n";
		   $header.= 'Content-Transfer-Encoding: 8bit'."\r\n";
	   $header_subs.= $header. 'From: '."=?UTF-8?B?".base64_encode($name_subs)."?="." <" .$from_subs. " > \r\n" .
                  'X-Mailer: PHP/' . phpversion();
	
		$subject_subs=$noti_subs['email_subject'];
		mysql_query( "INSERT INTO notify SET user_id='{$userid}', nom_id='$userid', date='$regdate', note='{$noti_subs['note']}', level='0'") or die(mysql_error());
		mail($email,$subject_subs,$msg,$header_subs);
		
	/****** End: Mail for Upgrade as Member   ******/
	/***********************************************/
		
 }

}
//commission
/*if($reff_show[user_type]=='m')
{

 if($user_type=='c')
  {
$onemonthcomm=(($plan_amt/$sub_for)*0.50);
	}
	else if ($user_type=='m')
	{
	$onemonthcomm=(($plan_amt/$sub_for)*0.25);
	}
	$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$ref_id1'"));
$fbalance1=$fbal_1[amount]+$onemonthcomm;

 $com112="insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id1','$onemonthcomm','$userid',CURDATE(),'Direct   Commission','0','$user_id','Direct Commission from  $user_id','$fbalance1')";
$res11=mysql_query($com112) or die(mysql_error());
$final_ewallet5=mysql_query("update final_e_wallet set amount=(amount+$onemonthcomm) where user_id='$ref_id1'") or die(mysql_error());
	
	  $inslev56="insert into  level_income (income_id ,package ,commission, remark,l_date,status) values ('$ref_id1','Direct Commission','1','$onemonthcomm','Direct Commission',CURDATE(),'0')";
  $inslevel4=mysql_query($inslev56) or die(mysql_error());	

  
  }*/
  
  // end commission
	}
	
	}
	else 	
	{
	header("Location:../../../index.php?error=Please Enter  Unique User Name");
	}

	
	 $quer111="insert into final_e_wallet (user_id,amount) values ('$userid','0')";
   $data111=mysql_query($quer111);
   $quer1111="insert into ad_e_wallet (user_id,amount) values ('$userid','0')";
   $data1111=mysql_query($quer1111);
	/*$query11="update pins set status=1 where pin_no='$pin'";
	 $dara=mysql_query($query11);*/
	 
	
	$noti=mysql_fetch_array(mysql_query("select * from notification WHERE note='$note'")); 
	
	
	 /*************mail send and short codes ****************/
	 $subject = stripslashes($noti['email']);
	$pattern = '/\[name]/U';
	$replacement = $fullname;
	$result_name= preg_replace($pattern, $replacement, $subject);
	
	$pattern = '/\[FirstName]/U';
	$replacement = $fname;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[UserId]/U';
	$replacement = $userid;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	$pattern = '/\[Email]/U';
	$replacement = $email;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[UserName]/U';
	$replacement = $username;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Address]/U';
	$replacement = $address;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[City]/U';
	$replacement = $city;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Country]/U';
	$replacement = $country;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Phone]/U';
	$replacement = $phone;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	$pattern = '/\[Mobile]/U';
	$replacement = $mobile;
	$result_name= preg_replace($pattern, $replacement, $result_name);
	
	
	
	$from_reg=trim($noti['fromemail']);
	 $name=$usertitle." ".$usernm." ".$usermname." ".$userlname;
     $msg= trim($result_name);
	 
	 
	 /************Invoice REgistration******************/
	 $net_price_reg=$mem_tax+$mem_fee;
	 $from="billing@valunaire.com";
	 $msg_reg_invoice="
	 	             <html>
	<head>
	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	
	<title>Valunaire.com</title>
    <style>
    table
{
border-collapse:collapse;
}
    </style>
	</head>
	<body style='margin:0px; padding:0px; color:#202320; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; ' dir='rtl'>
    <table width='100%' align='center' border='0' cellpadding='0' cellspacing='0' data-mobile='true' dir='ltr' style='background-color: rgb(255, 255, 255);'>
  <thead>
    <tr>
      <td align='center'><table cellpadding='0' cellspacing='0' border='0' width='600' class='wrapper' style='width: 600px;'>
        </table></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td valign='top' align='center' style='padding:0;margin:0;'><table align='center' border='0' cellspacing='0' cellpadding='0' width='600' style='width: 600px;' class='wrapper'>
          <tbody>
            <tr>
              <td align='left' valign='top' style='padding:0;margin:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='padding: 5px 0px 5px 18px; margin: 0px; border-right-width: 19px; border-right-style: solid; border-right-color: rgb(255, 255, 255); font-family: Arial, sans-serif; color: rgb(255, 255, 255); background-color: rgb(4, 7, 7); background-image: url(http://valunaire.com/images/Log.png); line-height: 2.05; background-position: 50% 50%; background-repeat: no-repeat no-repeat; height:100px;'><div><br>
                        </div>
                        <div style='text-align: left;'><br>
                        </div>
                        <div><br>
                        </div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='center' valign='top' style='padding:0;margin:0;'><table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'>
                  <tbody>
                    <tr>
                      <td width='65%' valign='top' align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                          <tbody>
                            <tr>
                              <td align='left' valign='top' style='margin:0;padding:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                  <tbody>
                                    <tr>
                                      <td valign='top' align='left'><img src='http://198.154.192.169/~develope/joshua/userpanel/invoice_image.png'></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td width='34%' valign='top' align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0' align='left'>
                          <tbody>
                            <tr>
                              <td align='left' valign='top' style='margin:0;padding:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                                  <tbody>
                                    <tr>
                                      <td valign='top' align='left' style='padding: 10px 19px 10px 8px; margin: 0px; font-family: Arial, sans-serif; color: rgb(178, 178, 178); border: 1px none transparent;'><div style='text-align: center; '><span style='color: rgb(178, 178, 178); font-family: Arial, sans-serif; background-color: transparent; float: none; display: inline !important; font-weight: bold;'><font size='15' style='font-size: 15px;'>فاليونير - قسم الفواتير</font></span></div></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='padding:0;margin:0;'><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' data-editable='text'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='padding: 20px 19px 20px 18px; margin: 0px; font-family: Arial, sans-serif; color: rgb(77, 77, 77); border: 1px none transparent;'><div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'>مرحباً بك&nbsp;$fullname</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px; background-color: transparent;'><br>
                          </span></div>
                        <div style='text-align: right;'>
           
	<table width='100%' border='0'>
	  <tr>
	    <td><table width='100%' border='0'>
	      <tr>
	        <td><span style='margin-top:-10px; '><img src='http://198.154.192.169/~develope/joshua/userpanel/images/val.png' alt='' width='192' height='77'></span></td>
	        <td align='center'><span style=''><img src='http://198.154.192.169/~develope/joshua/userpanel/images/paid.png' alt=''></span></td>
	        <td align='right'><span style=''><img src='http://198.154.192.169/~develope/joshua/userpanel/images/invoice1.png' alt='' width='173' height='48'></span></td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width='100%' border='0'>
	      <tr>
	        <td>$fullname</td>
	        <td><strong>إسم العميل/العضو</strong></td>
	        <td>$invoicem</td>
	        <td><strong><span dir='RTL'>رفم الفاتورة#</span></strong></td>
          </tr>
	      <tr>
	        <td>$mobileg</td>
	        <td><strong>رقم العميل/العضو</strong></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width='100%' border='0' style='border:1px solid #CCC;'>
	      <tr>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>موزع/ممثل المبيعات</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' ><strong><span dir='RTL'>رقم موزع/ممثل المبيعات</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc;'>$ref_name</td>
	        <td align='center' style='border-right:1px solid #ccc;'>$ref_id</td>
          </tr>
	      
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width='100%' border='0' style=' border:1px solid #ccc;'>
	      <tr>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>سعر المنتج</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>وصف المنتج</span></strong></td>
	        <td align='center' bgcolor='#EBEBEB' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>رقم المنتج</span></strong></td>
          </tr>
	      <tr>
	        <td style='border-right:1px solid #ccc;'>&nbsp;</td>
	        <td align='center' style='border-right:1px solid #ccc;'>$mem_fee</td>
	        <td align='center' style='border-right:1px solid #ccc;'><span dir='RTL'>إشتراك سنوي في خدمة فاليونير</span></td>
	        <td align='center' style='border-right:1px solid #ccc;'>-</td>
          </tr>
	     
	      <tr>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
	        <td style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>&nbsp;</td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc;  border-bottom:1px solid #ccc;'>$mem_fee</td>
	        <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي  الفرعي</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>$mem_tax</td>
	        <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الضريبة</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'>$net_price_reg</td>
	        <td colspan='3' style='border-right:1px solid #ccc; border-bottom:1px solid #ccc;'><strong><span dir='RTL'>الإجمالي</span></strong></td>
          </tr>
	      <tr>
	        <td align='center' style='border-right:1px solid #ccc;'>$net_price_reg</td>
	        <td colspan='3' style='border-right:1px solid #ccc;'><strong><span dir='RTL'>المبلغ  المدفوع</span></strong></td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
    </table>
	
                        
                        </div>
                        <div style='text-align: right;'><span style='font-size: 18px;'><br>
                          </span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'><br>
                          </span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>**** هل ترغب بالمساعدة؟ ***</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>هل تريد الإستفسار عن فاتورتك؟ هل تريد الدعم الفني من قسم الفواتير؟</span></div>
                        <div style='text-align: right;'><span style='font-size: 18px;'>إرسل رسالة إلى billing@valunaire.com</span></div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td valign='top' align='left' style='padding:0;margin:0;'></td>
            </tr>
            <tr>
              <td align='left' valign='top' style='padding: 0px; margin: 0px;'><table border='0' cellpadding='0' cellspacing='0' align='center' width='100%' data-editable='line' style='margin: auto; padding: 0px;'>
                  <tbody>
                    <tr>
                      <td valign='top' align='center' style='padding: 25px 19px 21px 18px; margin: 0px;'><div style='height: 1px; line-height: 1px; border-top-width: 1px; border-top-style: dotted; border-top-color: rgb(232, 223, 204);'> <img src='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' alt='' width='1' height='1' style='display:block;'> </div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><table cellpadding='0' cellspacing='0' align='right' data-editable='image'>
                  <tbody>
                    <tr>
                      <td valign='top' align='left' style='margin: 0px; padding: 10px 0px;'><img src='https://multimedia.getresponse.com/126/475126/photos/1348904.png?img1377327615232' width='600' data-src='https://multimedia.getresponse.com/126/475126/photos/1348904.png|600|186|328|153|0|0' height='186' data-origsrc='https://multimedia.getresponse.com/126/475126/photos/1348903.png' style='border: 0px none transparent; display: block;'></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align='center' valign='top' style='padding:0;margin:0;'></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body></html>
	 ";
	 $name_reg=$noti['name'];
	 $header="Mime-Version: 1.0\r\n"; 
	 $header.= 'Content-type: text/html; charset=iso-8859-1;  charset=UTF-8' . "\r\n";
	 $header.= 'Content-Transfer-Encoding: 8bit'."\r\n";
		    
     $header_invoive.= $header. 'From: '."=?UTF-8?B?".base64_encode($name_invoice)."?=".' < ' .$from. " > \r\n" .
                  'X-Mailer: PHP/' . phpversion();
				 
	 $header_reg.= $header. 'From: '."=?UTF-8?B?".base64_encode($name_reg)."?="." <" .$from_reg. " > \r\n" .
                  'X-Mailer: PHP/' . phpversion();
   /*	$header .= "Reply-To: ".$from." \r\n";
$header .= "Return-Path: ".$from."  \r\n";*/
		//$noti_sql=mysql_fetch_array(mysql_query("select * from notification where note=''"));
		$subject_reg=$noti['email_subject'];
		mail($emailg,$subject_reg,$msg,$header_reg);
		
		mysql_query( "INSERT INTO notify SET user_id='{$userid}', nom_id='$userid', date='$regdate', note='{$noti['note']}', level='0'") or die(mysql_error());
		$news_sql=mysql_query("select * from promo where user_type='$news_type'");
		while($result_news=mysql_fetch_array($news_sql)){
			$newsid=$result_news['n_id'];
			mysql_query("INSERT INTO news_noti SET news_id, user_id, status) values('$newsid', '$userid', '0')");
		}
	 if($data)
	{
	$_SESSION['adid']=$userid;
	$_SESSION['usertypelogin']=$user_type;
	if($user_type=='m'){
		$subject_reg_invoice=" إيصال إستلام عن الفاتورة ".$invoicem." : للعضو ".$fullname;
		mail($emailg,$subject_reg_invoice,$msg_reg_invoice,$header_invoive);
		
		 mkdir("/home/wordpres/public_html/$user_id", 0755);
		copy("/home/wordpres/public_html/index_format.php","/home/wordpres/public_html/$user_id/index.php");
	}
	print "<script language='javascript'>document.location='../../../userpanel/index.php'</script>";

	}
	}
}

	else{
		header("Location:payment_pin.php?pinerror=Invalid Pin number");
	}
		
}

	else
		{
		header("Location:http://198.154.192.169/~develope/joshua/index.php?error=Invalid Sponser ID");
		}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to Valunaire </title>
</head>
<body></body>
</html>