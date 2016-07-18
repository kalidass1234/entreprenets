<?php
session_start();
//print "sd";
if(!isset($_SESSION['SD_User_Name'])){
header('location:../index.php');
}
include("../includes/all_func.php");
$idd=$_SESSION['SD_User_Name'];

//$my_salt='0OkMjU7UjMkO0#@!';
//$t_code=hash('sha256', $my_salt.$t_code);
$s="select * from registration where user_name='$idd' ";

$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
 $n=$_SESSION['evoucher'];
//echo "<br>";
//echo "<pre>";print_r($_POST);exit;
$amt=$_SESSION['amount'];
$order_no=$_SESSION['orderno'];
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
		$create_date=date('Y-m-d');
		for($i=1;$i<=$n;$i++)
		{
			$length=10;
			$userid=get_rand_id($length);
		//	print "sd";
		 $qur="insert into pins(pin_no,amount,status,crt_date,created_by_user,receiver_id, t_date) values('$userid','$amt',0,'$create_date','$id','$id', '$create_date')";
		 mysql_query("INSERT INTO pin_history SET pin_no='$userid',order_no='$order_no',  crt_date='$create_date', t_date='$create_date', creater_id='$id'");
		 $res=mysql_query($qur);
		}
		unset($_SESSION['evoucher']);
		unset($_SESSION['amount']);
		// send_voucher_purchase_mail($_SESSION['SD_User_Name'],$id,$t_pin_amount,$f['email']);
		$msg="Voucher Created Successfully";
		echo "<script type='text/javascript'>alert('Voucher Created Successfully');window.location.href='purchase_evoucher.php?msg=$msg';</script>";
		//header("location:purchase_evoucher.php?msg=$msg");

?>