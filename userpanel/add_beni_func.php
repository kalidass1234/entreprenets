<?php session_start();
include('../includes/all_func.php');
$id=showuserid($_SESSION['adid']);
if(isset($_REQUEST['dtl']))
{
	$uid_add=$_REQUEST['dtl'];	
	$type=$_REQUEST['type'];
	//echo "insert into search_mem set user_id='$id',benificary_id='$uid_add',date=curdate()";
	$sql_add_serch=mysql_query("insert into benificiery set user_id='$id',member_id='$uid_add',type='$type',add_date=curdate()");
	 if($type=='cash_wallet')
	 {
	 	header("Location:fund_trans.php"); exit;
	 }
	 else if($type=='tp_wallet')
	 {
	 	header("Location:tp_trans.php"); exit;
	 }
	 else
	 {
	 	header("Location:index.php"); exit;
	 }
	 	
}
?>