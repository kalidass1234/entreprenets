<?php
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
//print_r($_POST);
	$idd=showuserid($_SESSION['SD_User_Name']);
	 if(isset($_POST['submit']))
	 {
		$sql_contact=mysql_query("select * from user_working_hour where user_id='$idd' and weekday_name='{$_POST['weekday_name']}' and hour_start='{$_POST['hour_start']}' and hour_end='{$_POST['hour_end']}'");
		if(mysql_num_rows($sql_contact)>0)
		{
		?>
			<script type="text/javascript">
			alert("This Working Hour is Already exist.");
			window.location.href='edit_user.php';
			</script>
		<?php
		}
		else
		{
		extract($_POST);
		
				 $insert="INSERT INTO user_working_hour set user_id='$idd', weekday_name='$weekday_name', hour_start='$hour_start', hour_end='{$hour_end}'";
				mysql_query($insert);
		?>
				<script type="text/javascript">
				alert("Working Hour Information Save Successfully .");
				window.location.href='edit_user.php';
				</script>
		<?php
		}
	}
	if(isset($_GET['del']))
	{
		$hid=$_GET['hid'];
		$modify_time=date('Y-m-d H:i:s');
		mysql_query("delete from user_working_hour where id='$hid'");
		?>
		<script type="text/javascript">
				alert("Working Hour Information Deleted Successfully .");
				window.location.href='edit_user.php';
				</script>
		<?php
	}
	if(isset($_POST['edit']))
	{
		$hid=$_POST['hid'];
		extract($_POST);
		mysql_query("update user_working_hour set  weekday_name='$weekday_name', hour_start='$hour_start', hour_end='{$hour_end}' where id='$hid'");
		?>
		<script type="text/javascript">
				alert("Working Hour Information Updated Successfully .");
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