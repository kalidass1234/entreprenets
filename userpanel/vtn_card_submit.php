<?php
include("../includes/all_func.php");
session_start();
$user_id=showuserid($_SESSION['SD_User_Name']);
//echo "<pre>"; print_r($_SESSION);exit;
$curdate=date('Y-m-d');
$dob=$_SESSION['vtn_year'].'-'.$_SESSION['vtn_months'].'-'.$_SESSION['vtn_day'];
$id_issue_date=$_SESSION['vtn_id_year'].'-'.$_SESSION['vtn_id_month'].'-'.$_SESSION['vtn_id_day'];
/*$insert = "insert into vtn_card set dob='$dob',id_issue_date='$id_issue_date',";
	
	foreach($_POST as $field=>$value)
	{
		if($field != 'year' && $field != 'months' && $field != 'day' && $field != 'id_year' && $field != 'id_month' && $field != 'id_day' && $field != 'check' )
		$insert .= $field."='".$value."',";
	}
$insert .= " user_id='$user_id', add_date='$curdate'";
	$insert = rtrim($insert,',');
	echo $insert;exit;*/
	$title=$_SESSION['vtn_title'];
	$vtn_fname=$_SESSION['vtn_fname'];
	$vtn_mname=$_SESSION['vtn_mname'];
	$vtn_lname=$_SESSION['vtn_lname'];
	$vtn_address=$_SESSION['vtn_address'];
	$vtn_mailing_address=$_SESSION['vtn_mailing_address'];
	$vtn_pobox_no=$_SESSION['vtn_pobox_no'];
	$vtn_mailing_pobox_no=$_SESSION['vtn_mailing_pobox_no'];
	$vtn_city=$_SESSION['vtn_city'];
	$vtn_mailing_city=$_SESSION['vtn_mailing_city'];
	$vtn_country=$_SESSION['vtn_country'];
	$vtn_mailing_country=$_SESSION['vtn_mailing_country'];
	
	$vtn_state=$_SESSION['vtn_state'];
$vtn_mailing_state=$_SESSION['vtn_mailing_state'];
$vtn_zip=$_SESSION['vtn_zip'];
$vtn_mailing_zip=$_SESSION['vtn_mailing_zip'];
$vtn_months=$_SESSION['vtn_months'];
$vtn_day=$_SESSION['vtn_day'];
$vtn_year=$_SESSION['vtn_year'];
$vtn_email=$_SESSION['vtn_email'];
$vtn_us_citizen=$_SESSION['vtn_us_citizen'];
$vtn_ssn_no=$_SESSION['vtn_ssn_no'];
$vtn_id_type=$_SESSION['vtn_id_type'];
$vtn_id_no=$_SESSION['vtn_id_no'];
$vtn_id_issue_country=$_SESSION['vtn_id_issue_country'];
$vtn_id_issue_state=$_SESSION['vtn_id_issue_state'];
$vtn_id_month=$_SESSION['vtn_id_month'];
$vtn_id_day=$_SESSION['vtn_id_day'];
$vtn_id_year=$_SESSION['vtn_id_year'];
$vtn_home_phone=$_SESSION['vtn_home_phone'];
$vtn_office_phone=$_SESSION['vtn_office_phone'];
$vtn_mobile_phone=$_SESSION['vtn_mobile_phone'];
$vtn_fax_no=$_SESSION['vtn_fax_no'];
	
	
	$insert="insert into vtn_card set dob='$dob',id_issue_date='$id_issue_date',title='$title',fname='$vtn_fname',mname='$vtn_mname',lname='$vtn_lname',address='$vtn_address',mailing_address='$vtn_mailing_address',pobox_no='$vtn_pobox_no',mailing_pobox_no='$vtn_mailing_pobox_no',city='$vtn_city',mailing_city='$vtn_mailing_city',country='$vtn_country',mailing_country='$vtn_mailing_country',state='$vtn_state',mailing_state='$vtn_mailing_stat',zip='$vtn_zip',mailing_zip='$vtn_mailing_zip',email='$vtn_email',us_citizen='$vtn_us_citizen',ssn_no='$vtn_ssn_no',id_type='$vtn_id_type',id_no='$vtn_id_no',id_issue_country='$vtn_id_issue_country',id_issue_state='$vtn_id_issue_state',home_phone='$vtn_home_phone',office_phone='$vtn_office_phone',mobile_phone='$vtn_mobile_phone',fax_no='$vtn_fax_no', user_id='$user_id', add_date='$curdate'";
	//echo $insert;exit;	
$arr=array('No','Yes');
$dob1=$_SESSION['vtn_months'].'/'.$_SESSION['vtn_day'].'/'.$_SESSION['vtn_year'];
$id_issue_date1=$_SESSION['vtn_id_month'].'/'.$_SESSION['vtn_id_day'].'/'.$_SESSION['vtn_id_year'];
$str="<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
   <form name='vtn_card_registration' action='vtn_card_submit.php' method='post'>
<table width='100%' border='2' style='border-collapse:collapse'>
	<tr bgcolor='#0099FF'>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
	  	<td width='43%' align='left'><img src='http://visionteamnetwork.com/img/logo.png'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>";
  
$str.="<tr bgcolor='#0099FF'>
     <th style='line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;' colspan='4'>Register New Cardholder </th>
     </tr>
     <tr><td colspan='4'>&nbsp;</td></tr>
     <tr>
     <td width='20%' height='30' align='right' valign='top'><span>10-digit Card ID</span></td>
     <td width='30%' height='30' >&nbsp;&nbsp;Office Use Only</td>
     <td width='20%' height='30' align='right' valign='top' class='txt'><span>Customer ID</span></td>
     <td width='30%' height='30'>&nbsp;&nbsp;Office Use Only</td>
     </tr>
     
     <tr><td colspan='4'>&nbsp;</td></tr>
     
     <tr bgcolor='#0099FF'>
     <th style='line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;' colspan='4'>Cardholder Information</th>
     </tr>
     <tr><td colspan='4'>&nbsp;</td></tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Title</span></td>
     <td height='30'>".$vtn_title."</td>
     <td height='30' align='right' valign='top'><span>First Name</span></td>
     <td height='30'>".$vtn_fname."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Middle Name/Initial</span></td>
     <td height='30'>".$vtn_mname."</td>
     <td height='30' align='right' valign='top'><span>Last Name</span></td>
     <td height='30'>".$vtn_lname."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Physical Address </span></td>
     <td height='30'>".$vtn_address."</td>
     <td height='30' align='right' valign='top'><span>Mailing Address</span></td>
     <td height='30'>".$vtn_mailing_address."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>P.O. Box is not allowed as the physical address</span></td>
     <td height='30' valign='top'>".$vtn_pobox_no."</td>
     <td height='30' align='right' valign='top'><span>&nbsp;</span></td>
     <td height='30' valign='top'>".$vtn_mailing_pobox_no."</td>
     </tr>
    <tr>
     <td height='30' align='right' valign='top'><span>City</span></td>
     <td height='30'>".$vtn_city."</td>
     <td height='30' align='right' valign='top'><span>City</span></td>
     <td height='30'>".$vtn_mailing_city."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Country</span></td>
     <td height='30'>".$vtn_country."</td>
     <td height='30' align='right' valign='top'><span>Country</span></td>
     <td height='30'>".$vtn_mailing_country."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>State/Province</span></td>
     <td height='30'>
     ".$vtn_state."</td>
     <td height='30' align='right' valign='top'><span>State/Province</span></td>
     <td height='30'>".$vtn_mailing_state."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Postal Code</span></td>
     <td height='30'>".$vtn_zip."</td>
     <td height='30' align='right' valign='top'><span>Postal Code</span></td>
     <td height='30'>".$vtn_mailing_zip."</td>
     </tr>
     <tr><td colspan='4'>&nbsp;</td></tr>
     <tr bgcolor='#0099FF'>
     <th style='line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;' colspan='4'>Personal Information</th>
     </tr>
     <tr><td colspan='4'>&nbsp;</td></tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Birth Date</span></td>
     <td height='30'>".$dob1."</td>
     <td height='30' align='right' valign='top'><span>Email Address</span></td>
     <td height='30'>".$vtn_email."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>U. S. Citizen ?</span></td>
     <td height='30'>".$arr[$vtn_us_citizen]."</td>
     <td height='30' align='right' valign='top'><span>SSN (ex. 123456789)</span></td>
     <td height='30'>".$vtn_ssn_no."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top' ><span>ID Type</span></td>
     <td height='30'>".$vtn_id_type."</td>
     <td height='30' align='right' valign='top' ><span>ID Number </span></td>
     <td height='30'>".$vtn_id_no."</td>
     </tr>
     <tr>
     <td height='30' align='right' valign='top'><span>ID Issuing Country/State</span></td>
     <td height='30'>".$vtn_id_issue_country."/".$vtn_id_issue_state."</td>
     <td height='30' align='right' valign='top'><span>ID Expiration Date</span></td>
     <td height='30'>".$id_issue_date1."</td>
     </tr>
     <tr><td colspan='4'>&nbsp;</td></tr>
     <tr bgcolor='#0099FF'>
     <th style='line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;' colspan='4'>Additional Contact Information</th>
     </tr>
     <tr><td colspan='4'>&nbsp;</td></tr>
     <tr>
     <td height='30' align='right' valign='top'><span>Home Phone</span></td>
     <td height='30'>".$vtn_home_phone."</td>
     <td height='30' align='right' valign='top'><span>Office Phone</span></td>
     <td height='30'>".$vtn_office_phone."</td>
     </tr>
     
     <tr>
     <td height='30' align='right' valign='top'><span>Mobile Phone</span></td>
     <td height='30'>".$vtn_mobile_phone."</td>
     <td height='30' align='right' valign='top'><span>Fax Number</span></td>
     <td height='30'>".$vtn_fax_no."</td>
     </tr>
     ";
$str.="</table>
</form>
</div>
</body>
</html>";

$from="info@visionteamnetwork.com"; // shopdeal admin username
$email="vtnappcard@gmail.com";
	// $name=$fname." ".$lname;
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.="From:VTN <$from>" . "\r\n";
	 mail($email,'VTN CARD REGISTRATION',$str,$headeruser1,'$from');
mysql_query($insert);
echo "<script type='text/javascript'>alert('You Successfully Submit Your Information.');window.location.href='vtn_card.php';</script>";
/*header("Location:vtn_card.php");*/	
?>