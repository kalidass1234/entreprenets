<?php
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
//print_r($_POST);
	$idd=showuserid($_SESSION['SD_User_Name']);
	 if(isset($_POST['submit']))
	 {
		$sql_contact=mysql_query("select * from card_info where user_id='$idd' and card_no='{$_POST['card_no']}'");
		if(mysql_num_rows($sql_contact)>0)
		{
		?>
			<script type="text/javascript">
			alert("This Card No is Already exist.");
			window.location.href='edit_user.php';
			</script>
		<?php
		}
		else
		{
		extract($_POST);
		$expiry_month_year=$_POST['exmonth'].'-'.$_POST['exyy'];
				 $insert="INSERT INTO card_info set user_name='{$_SESSION['SD_User_Name']}', card_no='$card_no', card_name='$card_name', expiry_month_year='{$expiry_month_year}',cvs_no='$cvs_no', user_id='$idd'";
				mysql_query($insert);
		?>
				<script type="text/javascript">
				alert("Card Information Save Successfully .");
				window.location.href='edit_user.php';
				</script>
		<?php
		}
	}
	if(isset($_GET['del']))
	{
		$cardid=$_GET['cardid'];
		$modify_time=date('Y-m-d H:i:s');
		mysql_query("update card_info set status=0 ,modify_time='$modify_time',modify_by='$idd' where id='$cardid'");
		?>
		<script type="text/javascript">
				alert("Card Information Deleted Successfully .");
				window.location.href='edit_user.php';
				</script>
		<?php
	}
	if(isset($_POST['edit']))
	{
		$cardid=$_POST['card_id'];
		$modify_time=date('Y-m-d H:i:s');
		extract($_POST);
		$expiry_month_year=$_POST['exmonth'].'-'.$_POST['exyy'];
		mysql_query("update card_info set card_name='$card_name',card_no='$card_no',expiry_month_year='$expiry_month_year',cvs_no='$cvs_no' ,modify_time='$modify_time',modify_by='$idd' where id='$cardid'");
		?>
		<script type="text/javascript">
				alert("Card Information Updated Successfully .");
				window.location.href='edit_user.php';
				</script>
		<?php
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}


?>