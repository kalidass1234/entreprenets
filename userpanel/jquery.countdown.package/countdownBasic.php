<?php
@session_start();
if($_SERVER['HTTP_HOST']=='localhost')
{
	define('Host','localhost');
	define('User','root');
	define('Password','');
	define('Database','creative');
}
else
{
	define('Host','localhost');
	define('User','trinityr_trinity');
	define('Password','trinity');
	define('Database','trinityr_trinity');
}
mysql_connect(Host,User,Password);
mysql_select_db(Database);
function showuserid($user_name)
{
	$sql="select user_id from registration where user_name='$user_name' or user_id='$user_name'";
	$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_assoc($result);
			return $row['user_id'];
		}
}
$user_id=showuserid($_SESSION['SD_User_Name']);
// check the member 30 days period 
$sql="select * from registration where user_id='$user_id' and bonus=1 and reseller=0";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
if($count)
{
	$row=mysql_fetch_assoc($res);
	$str_subs="select * from subscription  where user_id='{$user_id}' and subs_fee<>0 order by id desc limit 1";
	$res_subs=mysql_query($str_subs);
	$row_subs=mysql_fetch_assoc($res_subs);
	//
	$sql_first="select * from reseller_first where user_id='{$user_id}'";
	$res_first=mysql_query($sql_first);
	$count_first=mysql_num_rows($res_first);
	$row_first=mysql_fetch_assoc($res_first);
	
	$date = $row_first['first_reseller_date'];
	$date = strtotime($date);
	$date = strtotime("+30 day", $date);
	$time=$date;
	$reg_date_30=date('m/d/Y', $date);
}
else 
{
	$sql_r="select * from registration where user_id='$user_id' and bonus=1 and reseller=1";
	$res_r=mysql_query($sql_r);
	$count_r=mysql_num_rows($res_r);
	$row_r=mysql_fetch_assoc($res_r);
	
	$str_subs="select * from subscription_qualification  where user_id='{$user_id}' and subs_fee<>0 order by id desc limit 1";
	$res_subs=mysql_query($str_subs);
	$row_subs=mysql_fetch_assoc($res_subs);
	
	$sql_first="select * from reseller_first where user_id='{$user_id}'";
	$res_first=mysql_query($sql_first);
	$count_first=mysql_num_rows($res_first);
	$row_first=mysql_fetch_assoc($res_first);
	
	$date = $row_first['first_reseller_date'];
	
	$date = strtotime($date);
	$date = strtotime("+30 day", $date);
	$time=$date;
	$reg_date_30=date('m/d/Y', $date);
}
$cur_date=date('Y-m-d');
$cur_time=strtotime($cur_date);

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>jQuery Countdown</title>
<link rel="stylesheet" href="jquery.countdown.css">
<style type="text/css">
#defaultCountdown { width: 240px; height: 45px; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jquery.plugin.js"></script>
<script src="jquery.countdown.js"></script>
<?php
if($cur_time<$time)
{
?>
<script>
$(function () {
	var austDay = new Date();
	//alert(austDay);
	austDay = new Date('<?php echo $_GET['end_date'];?>');
	//alert(austDay);
	$('#defaultCountdown').countdown({until: austDay});
	$('#year').text(austDay.getFullYear());
});
</script>
<?php
}
?>
</head>
<body>
<div id="defaultCountdown"></div>
<p style="margin-top:0px; color:#c16a1c">
<?php 
if($count)
{ 
	echo "Your Free Period countdown";
} 
else
{ 
	if($count_r)
	{ 
		echo "You are move to monthly Qualification.<br>";
		if($cur_time>$time)
		{
			echo "You Need To Subscribe Monthly Qualification.";
		}
	}
	
}
?></p>
</body>
</html>
