<?php
session_start();
//print "sd";
if(!isset($_SESSION['SD_User_Name'])){
header('location:../index.php');
}
include("../includes/all_func.php");
$idd=$_SESSION['SD_User_Name'];
$t_code=$_POST['tcode'];
//$my_salt='0OkMjU7UjMkO0#@!';
//$t_code=hash('sha256', $my_salt.$t_code);
$s="select * from registration where user_name='$idd' and t_code='$t_code'";

$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
 $n=$_REQUEST['evoucher'];
//echo "<br>";
//echo "<pre>";print_r($_POST);exit;
$amt=$_REQUEST['amt'];
$c=mysql_num_rows($r);

function get_rand_id($length)
{

  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,36);
   $rand_id .= assign_rand_value($num);
   }
  }
return $rand_id;
}
function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
    case "2":

     $rand_value = "b";

    break;

    case "3":

     $rand_value = "c";

    break;

    case "4":

     $rand_value = "d";

    break;

    case "5":

     $rand_value = "e";

    break;

    case "6":

     $rand_value = "f";

    break;

    case "7":

     $rand_value = "g";

    break;

    case "8":

     $rand_value = "h";

    break;

    case "9":

     $rand_value = "i";

    break;

    case "10":

     $rand_value = "j";

    break;

    case "11":

     $rand_value = "k";

    break;

    case "12":

     $rand_value = "l";

    break;

    case "13":

     $rand_value = "m";

    break;

    case "14":

     $rand_value = "n";

    break;

    case "15":

     $rand_value = "o";

    break;

    case "16":

     $rand_value = "p";

    break;

    case "17":

     $rand_value = "q";

    break;

    case "18":

     $rand_value = "r";

    break;

    case "19":

     $rand_value = "s";

    break;

    case "20":

     $rand_value = "t";

    break;

    case "21":

     $rand_value = "u";

    break;

    case "22":

     $rand_value = "a";

    break;

    case "23":

     $rand_value = "w";

    break;

    case "24":

     $rand_value = "x";

    break;

    case "25":

     $rand_value = "y";

    break;

    case "26":

     $rand_value = "z";

    break;

    case "27":

     $rand_value = "0";

    break;

    case "28":

     $rand_value = "1";

    break;

    case "29":

     $rand_value = "2";

    break;

    case "30":

     $rand_value = "3";

    break;

    case "31":

     $rand_value = "4";

    break;

    case "32":

     $rand_value = "5";

    break;

    case "33":

     $rand_value = "6";

    break;

    case "34":

     $rand_value = "7";

    break;

    case "35":

     $rand_value = "8";

    break;

    case "36":

     $rand_value = "9";

    break;

  }

return $rand_value;

}

//echo "<pre>"; print_r($_POST); exit;
if($_POST['pay_mode']!='')
{
if($c>0)
{
if($n>0 && $amt>0){

	$table=$_POST['pay_mode'];
	if($table=='final_e_wallet')
	{
		$table_sub='credit_debit';
	}
	else if($table=='funding_e_wallet')
	{
		$table_sub='funding_history';
	}
	else if($table=='flifejacket_e_wallet')
	{
				$find_ljid=mysql_fetch_assoc(mysql_query("select * from lifejacket_interest where status=0 and interest>0 and user_id='$id' limit 1"));
				mysql_query("update lifejacket_interest set status=1 where user_id='$id' and id='$$find_ljid[id]'");
		$table_sub='lifejacket_history';
	}
	$str_b="select CAST(`amount` AS SIGNED) as amount from $table where user_id='$id'";
	$res_b=mysql_query($str_b);
	$row_b=mysql_fetch_array($res_b);
	$w_amount=$row_b['amount'];
	$w_ded=$n*$amt;
	$t_pin_amount=$n*$amt;
	if($w_amount>=$t_pin_amount)
	{
		$create_date=date('Y-m-d');
		for($i=1;$i<=$n;$i++)
		{
			$length=10;
			$userid=get_rand_id($length);
		//	print "sd";
		 $qur="insert into pins(pin_no,amount,status,crt_date,created_by_user,receiver_id, t_date) values('$userid','$amt',0,'$create_date','$id','$id', '$create_date')";
		 mysql_query("INSERT INTO pin_history SET pin_no='$userid',  crt_date='$create_date', used_for='', t_date='$create_date', creater_id='$id',used_by='',receiver_id=''");
		 $res=mysql_query($qur);
		}
		$str_w="update $table set amount=(amount-$t_pin_amount) where user_id='$id'";
		$res_w=mysql_query($str_w);
		$ff=mysql_query("select * from  $table where user_id='$id'");
		$fetch=mysql_fetch_array($ff);
		$update_dr="insert into $table_sub(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark,final_bal) values('$id',0,'$t_pin_amount','','$create_date','','E Voucher Purchased','','','$fetch[amount]')";
		 $aa=mysql_query($update_dr);
		// send_voucher_purchase_mail($_SESSION['SD_User_Name'],$id,$t_pin_amount,$f['email']);
		$msg="Voucher Created Successfully";
		echo "<script type='text/javascript'>alert('Voucher Created Successfully');window.location.href='purchase_evoucher.php?msg=$msg';</script>";
		//header("location:purchase_evoucher.php?msg=$msg");
	}
	else
	{
	$msg="Insufficient Fund";
	echo "<script type='text/javascript'>alert('Insufficient Fund');window.location.href='purchase_evoucher.php?notamount=1&msg=$msg';</script>";
	header('location:purchase_evoucher.php?notamount=1&msg='.$msg);
	}}
	
	else{
	$msg="Wrong Method";
	echo "<script type='text/javascript'>alert('IWrong Method');window.location.href='purchase_evoucher.php?notamount=1&msg=$msg';</script>";
	header('location:purchase_evoucher.php?notamount=1&msg='.$msg);
	}
	}
	else
	{
		$msg="Wrong Transaction Code";
			echo "<script type='text/javascript'>alert('Wrong Transaction Code');window.location.href='purchase_evoucher.php?msg=$msg';</script>";
	}
}
else if($_POST['payopt1']!='')
{
if($c>0)
{
if($n>0 && $amt>0){
		$flag=0;
		$flag2=0;
		$final_amount=$amount;
		$pauopt1=$_POST['payopt1'];
		$total_fund_available=0;
		$amount_ded=0;
		foreach ($pauopt1 as $value)
		{
		#get sum oall selected wallet
		$table=$value;
			$all_row=mysql_fetch_assoc(mysql_query("select CAST(`amount` AS SIGNED) as amount from $table where user_id='$user_id'"));
			$total_fund_available=$total_fund_available+$all_row['amount'];
		}
		//echo $total_fund_available.">=".$amount; exit; 
		$str_b="select CAST(`amount` AS SIGNED) as amount from $table where user_id='$id'";
	$res_b=mysql_query($str_b);
	$row_b=mysql_fetch_array($res_b);
	$w_amount=$row_b['amount'];
	$w_ded=$n*$amt;
	$t_pin_amount=$n*$amt;
	$amount=$t_pin_amount;
	if($total_fund_available>=$t_pin_amount)
	{
		if($total_fund_available>$amount)
		{
			foreach ($_POST['payopt1'] as $value)
			{
				$table=$value;
				# check amount from table
				$check1=mysql_num_rows(mysql_query("select * from $table where user_id='$id' and amount>='$amount' "));	
				
				/*if($check1>0)
				{
					$update_final_ewallet=mysql_query("update $table set amount=amount-$amount where user_id='$user_id'");
					if($table=='final_e_wallet')
					{
						$table_sub='credit_debit';
					}
					else if($table=='funding_e_wallet')
					{
						$table_sub='funding_history';
					}
					else if($table=='flifejacket_e_wallet')
					{
						$table_sub='lifejacket_history';
						$find_ljid=mysql_fetch_assoc(mysql_query("select * from lifejacket_interest where status=0 and user_id='$user_id' order by id desc limit 1"));
						mysql_query("update lifejacket_interest set status=1 where user_id='$user_id' and id='$$find_ljid[id]'");
					}
				
					$insert_to_credit_debit="insert into $table_sub(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status,lifejacket_id,transaction_no) values('$user_id','$amount','0','admin','$user_id','$start_date','','Purchase Life Jacket $ljid ','','Purchase Life Jacket $ljid','','1','1','$id','$ljid')";
				
					mysql_query($insert_to_credit_debit);
					$flag++;
				break;
				}
				else
				{*/
					$sql_check=mysql_query("select * from $table where user_id='$id'");
					$row_check=mysql_fetch_assoc($sql_check);
					if($final_amount>0 && $tot_amount_ded<$amount)
					{
						//$amount_ded=$row_check['amount'];
						if($row_check['amount']<$final_amount)
						{
							$final_amount=$final_amount-$row_check['amount'];
						}
						else
						{
							$final_amount=$final_amount-$amount_ded;
						}
						$amount_ded=$final_amount;
						$tot_amount_ded+=$amount_ded;
						//echo "update $table set amount=amount-$amount_ded where user_id='$user_id' $tot_amount_ded <br>";
						$update_final_ewallet=mysql_query("update $table set amount=amount-$amount_ded where user_id='$id'");
						if($table=='final_e_wallet')
						{
							$table_sub='credit_debit';
						}
						else if($table=='funding_e_wallet')
						{
							$table_sub='funding_history';
						}
						else if($table=='flifejacket_e_wallet')
						{
									$find_ljid=mysql_fetch_assoc(mysql_query("select * from lifejacket_interest where status=0 and user_id='$id' order by id desc limit 1"));
									mysql_query("update lifejacket_interest set status=1 where user_id='$id' and id='$$find_ljid[id]'");
							$table_sub='lifejacket_history';
						}
					
						$insert_to_credit_debit="insert into $table_sub(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status,lifejacket_id,transaction_no) values('$id','$amount_ded','0','admin','$user_id','$start_date','','Purchase Life Jacket $ljid ','','Purchase Life Jacket $ljid','','1','1','$id','$ljid')";
					
						mysql_query($insert_to_credit_debit);
						$flag2++;
					/*}*/
					}
				if($flag>0)
				{
					break;
				}
			}
		
			$create_date=date('Y-m-d');
			for($i=1;$i<=$n;$i++)
			{
				$length=10;
				$userid=get_rand_id($length);
			//	print "sd";
			 $qur="insert into pins(pin_no,amount,status,crt_date,created_by_user,receiver_id, t_date) values('$userid','$amt',0,'$create_date','$id','$id', '$create_date')";
			 mysql_query("INSERT INTO pin_history SET pin_no='$userid',  crt_date='$create_date', used_for='', t_date='$create_date', creater_id='$id',used_by='',receiver_id=''");
			 $res=mysql_query($qur);
			}
			$str_w="update $table set amount=(amount-$t_pin_amount) where user_id='$id'";
			$res_w=mysql_query($str_w);
			$ff=mysql_query("select * from  $table where user_id='$id'");
			$fetch=mysql_fetch_array($ff);
			$update_dr="insert into $table_sub(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark,final_bal) values('$id',0,'$t_pin_amount','','$create_date','','E Voucher Purchased','','','$fetch[amount]')";
			 $aa=mysql_query($update_dr);
			// send_voucher_purchase_mail($_SESSION['SD_User_Name'],$id,$t_pin_amount,$f['email']);
			$msg="Voucher Created Successfully";
			// send mail to admin
		$email_from='subhash@maxtratechnologies.com';
		$to_company_email=$f['email'];
		$to_company_cname=$_SESSION['SD_User_Name'];
		$headeruser1="Mime-Version: 1.0\r\n";
		$headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headeruser1 .= "From:  <".$email_from.">" . "\r\n";	
		$msg="<html>
		<head>
		<meta http-equiv= 'Content-Type ' content= 'text/html; charset=utf-8 '>
		<title>livingwell.com</title>
		</head>
		<body style= 'margin:0px; padding:0px; color:#cc0000; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; '>
		  <div id= 'content ' style= 'width:98.5%; overflow:hidden; border:8px solid  #FF0000; '>
		<table width= '100% ' border= '0 ' cellspacing= '0 ' cellpadding= '0 '>
		  <tr>
			<td width= '2% '>&nbsp;</td>
			<td width= '96% '>&nbsp;</td>
			<td width= '2% '>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><strong>Hi VTN Member </strong></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td> You successfully purchase $n evouchers of amount $amt USD<br>Please check your available pins. </td>
			<td>&nbsp;</td>
		  </tr>
		   <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		   <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		   <tr>
			<td>&nbsp;</td>
			<td><strong>VTN  Admin</strong></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</table>
		</div>
		</body>
		</html>";

					$sql_email="select * from master_email ";
					$res_email=mysql_query($sql_email);
					$row_email=mysql_fetch_assoc($res_email);
					
					$replicate_email=$row_email['evoucher'];
					
					$mail=mail($replicate_email,"New Voucher Purchase from $to_company_cname", $msg, $headeruser1);
					$mail3=mail($to_company_email,"Voucher Purchase ", $msg, $headeruser1); 
			// end to send mail to admin
			echo "<script type='text/javascript'>alert('Voucher Created Successfully');window.location.href='purchase_evoucher.php?msg=$msg';</script>";
			//header("location:purchase_evoucher.php?msg=$msg");
		}
		else
		{
				echo "<script language='javascript'>alert('You Have Not Sufficient Balance In Selected E-Wallet. Please Choose Different Wallet');window.location.href='purchase_evoucher.php?notamount=1';</script>";
		}
	}
	else
	{
	$msg="Insufficient Fund";
	echo "<script language='javascript'>alert('You Have Not Sufficient Balance In Selected E-Wallet. Please Choose Different Wallet');window.location.href='purchase_evoucher.php?notamount=1';</script>";
	header('location:purchase_evoucher.php?notamount=1&msg='.$msg);
	}
	}
	else
	{
	$msg="Wrong Method";
	echo "<script language='javascript'>alert('Wrong Method');window.location.href='purchase_evoucher.php?notamount=1';</script>";
	header('location:purchase_evoucher.php?notamount=1&msg='.$msg);
	}
	}
	else
	{
		$msg="Wrong Transaction Code";
			echo "<script type='text/javascript'>alert('Wrong Transaction Code');window.location.href='purchase_evoucher.php?msg=$msg';</script>";
	}
}
?>