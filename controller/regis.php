<?php
session_start();

include("controller/connection.php");
include("controller/register.php");
include("controller/spil_idsearch.php");
include("controller/bcount.php");

srand((double)microtime()*100000000); 

function gen_id() 
{ 
    $id = 'A'; 

    for ($i=1; $i<=5; $i++) { 
        if (rand(0,1)) { 
            // letter 
            $id .= chr(rand(65, 90)); 
        } else { 
            // number; 
            $id .= rand(0, 9); 
        } 
    } 
    return $id; 

} 

$newID = gen_id();

if($_GET[normal]){

 $ref_id=$_SESSION['sponser_id'];
  $plan=$_SESSION['plan'];
  $fname=$_SESSION['fname'];
  $mname=$_SESSION['mname'];
 $lname=$_SESSION['lname'];
 $sex=$_SESSION['sex'];
 $address=$_SESSION['address'];
 $address2=$_SESSION['address2'];
 $city=$_SESSION['city'];
 $zip=$_SESSION['zip'];
 $state=$_SESSION['state'];
$country=$_SESSION['country'];
 $mobile=$_SESSION['mobile'];
 $phoner=$_SESSION['phoner'];
 $email=$_SESSION['email'];
 $id_card=$_SESSION['id_card'];
 $user_id=$_SESSION['user_id'];    
$pass=$_SESSION['pass'];      
 $dob=$_SESSION['dob'];
 $co_op=$_SESSION['co_op'];
  $order_no=$newID; 
 $mode='Pins';
//echo $lev;
//$sec_ques=$_REQUEST['sec_ques'];
//$sec_ans=$_REQUEST['sec_ans'];
//$dob=$_REQUEST['dob'];
//$nominee=$_REQUEST['nominee'];
//$relation=$_REQUEST['relation'];
//$u_language=$_REQUEST['u_language'];
$pin=$_REQUEST['pin_no'];
saveRegistrationAdmin();
}

if($_GET[wallet]){
$ref_id=$_SESSION['sponser_id'];
  $plan=$_SESSION['plan'];
  $fname=$_SESSION['fname'];
  $mname=$_SESSION['mname'];
 $lname=$_SESSION['lname'];
 $sex=$_SESSION['sex'];
 $address=$_SESSION['address'];
 $address2=$_SESSION['address2'];
 $city=$_SESSION['city'];
 $zip=$_SESSION['zip'];
 $state=$_SESSION['state'];
$country=$_SESSION['country'];
 $mobile=$_SESSION['mobile'];
 $phoner=$_SESSION['phoner'];
 $email=$_SESSION['email'];
 $id_card=$_SESSION['id_card'];
 $user_id=$_SESSION['user_id'];    
$pass=$_SESSION['pass'];      
 $dob=$_SESSION['dob'];
 $co_op=$_SESSION['co_op'];
 $order_no=$newID; 
 $mode='e-wallet';
//echo $nom_id1;
$sponsor_user_name=$_REQUEST[ref_nm];
$sponsor_pass=$_REQUEST[ref_pass];
$sponsor_txt_pass=$_REQUEST[ref_tcode];
$order_no=$newID; 

 $validate1=mysql_query("select * from registration where user_name='$sponsor_user_name' and user_pass='$sponsor_pass' and t_code='$sponsor_txt_pass'" );
 $x1=mysql_num_rows($validate1);
$fetch_user=mysql_fetch_array($validate1);
$user_id_sponsor=$fetch_user[user_id];
if($x1>0){
 $ewallet=mysql_query("select * from final_e_wallet where user_id='$user_id_sponsor'" );
$fetch_wallet=mysql_fetch_array($ewallet);
 $amount=$fetch_wallet[amount];
if($amount>=$plan){

saveRegistrationAdmin();
}
else{?>
<script type="text/javascript">
alert('Insufficient Fund');
location.href='payment_acc.php?error=Insufficient Fund';
</script><? }}
else{

?>
<script type="text/javascript">
alert('Invalid Account.Please Try Again');
location.href='payment_acc.php?error=Invalid Account.Please Try Again';
</script><? } }

if($_GET[paypal]=='1'){

$ref_id=$_SESSION['sponser_id'];
  $plan=$_SESSION['plan'];
  $fname=$_SESSION['fname'];
  $mname=$_SESSION['mname'];
 $lname=$_SESSION['lname'];
 $sex=$_SESSION['sex'];
 $address=$_SESSION['address'];
 $address2=$_SESSION['address2'];
 $city=$_SESSION['city'];
 $zip=$_SESSION['zip'];
 $state=$_SESSION['state'];
$country=$_SESSION['country'];
 $mobile=$_SESSION['mobile'];
 $phoner=$_SESSION['phoner'];
 $email=$_SESSION['email'];
 $id_card=$_SESSION['id_card'];
 $user_id=$_SESSION['user_id'];    
$pass=$_SESSION['pass'];      
 $dob=$_SESSION['dob'];
 $co_op=$_SESSION['co_op'];
 $order_no=$_GET[order_no]; 
 $mode='Paypal';

saveRegistrationAdmin();
}



?>