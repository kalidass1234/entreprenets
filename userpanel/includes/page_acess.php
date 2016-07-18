<?php 
function check_page_access($username,$permit='')
{
	$check_page_access=mysql_query("select user_type from registration where user_name='$username'");
	$count=mysql_num_rows($check_page_access);
	if($count>0)
	{
		if($permit!='')
		{
			$row=mysql_fetch_assoc($check_page_access);
			if($row['user_type']==$permit)
			{
				
			}
			else
			{
				echo "<script language='javascript'>window.location.href='error.php';</script>";exit;
			}
		}
	}
	else
	{
		echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
	}
}
?>