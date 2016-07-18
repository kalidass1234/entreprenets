<?php
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
//print_r($_POST);
	$idd=showuserid($_SESSION['SD_User_Name']);
	
	if(isset($_GET['del']))
	{
		$login_id=$_GET['login_id'];
		$modify_time=date('Y-m-d H:i:s');
		mysql_query("update user_login set status=2  where id='$login_id'");
		?>
		<script type="text/javascript">
				alert("User Deleted Successfully .");
				window.location.href='create_userinfo.php';
				</script>
		<?php
	}
	else if(isset($_POST['edit']) && $_POST['login_id']!='')
	{
	
				$login_id=$_POST['login_id'];
				$modify_time=date('Y-m-d H:i:s');
				extract($_POST);
				
				mysql_query("update user_login set password='$password' where id='$login_id'");
				//echo mysql_result($result, 0,0);exit;
				?>
				<script type="text/javascript">
						alert("User Information Updated Successfully .");
						window.location.href='create_userlist.php';
						</script>
				<?php
	}
	else if(isset($_POST['submit']))
	 {
		$sql_contact=mysql_query("select * from registration where user_name='{$_POST['user_name']}' ");
		if(mysql_num_rows($sql_contact)>0)
		{
		?>
			<script type="text/javascript">
			alert("This User is Already exist.");
			window.location.href='create_userlist.php';
			</script>
		<?php
		}
		else
		{
			$sql_contact=mysql_query("select * from user_login where user_name='{$_POST[user_name]}'");
			if(mysql_num_rows($sql_contact)>0)
			{
			?>
				<script type="text/javascript">
				alert("This User is Already exist.");
				window.location.href='create_userlist.php';
				</script>
			<?php
			}
			else
			{
					extract($_POST);
					
					 $insert="INSERT INTO user_login set user_id='$idd', password='{$_POST[password]}', user_name='{$_POST[user_name]}', operator_type='employee',role_type='gift_card,coupon',user_type='business'";
					// echo $insert;exit;
					mysql_query($insert);
					
			?>
					<script type="text/javascript">
					alert("User Information Save Successfully .");
					window.location.href='create_userlist.php';
					</script>
			<?php
			}
		}
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}


?>