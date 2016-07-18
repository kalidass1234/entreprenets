<?php
include("../../includes/all_func.php");
#get $3 commission to guru recruiter
# First find the member who have the level 3 only
$curdate=date('Y-m-d');

$sql="select * from registration where category_three=1 and category_two=0 and category_one=0 and mem_status=0";
$res=mysql_query($sql);
while($row=mysql_fetch_assoc($res))
{
	$income_id=$row['user_id'];
	$sql_user="select * from registration where ref_id='$income_id' where mem_status=0 and category_two=1";
	$res_user=mysql_query($sql_user);
	$count_user=mysql_num_rows($res_user);
	if($count_user)
	{
		$row_user=mysql_fetch_assoc($res_user);
		$purchaser_id=$row_user['user_id'];
		$sql_income="select * from level_income_admin where income_id='$income_id' and purcheser_id='$purchaser_id'";
		$res_income=mysql_query($sql_income);
		$count_income=mysql_num_rows($res_income);
		if($count_income)
		{
			$row_income=mysql_fetch_assoc($res_income);
			//give commission to guru recruiter $3. 
			$insert="insert into level_income_admin set income_id='guru',purcheser_id='$purchaser_id',level='1',commission='3',date='$curdate',status=0,paid_status=0,section='Direct Sponseer',remark='Get Direct Sponser Benifit(Affiliate Refferal)',invoice_amt='29.99',user_level='2'";
			mysql_query($insert);
		}
	}
}
?>