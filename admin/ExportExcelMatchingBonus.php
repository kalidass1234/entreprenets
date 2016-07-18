<?php
include("config/config.php");
error_reporting(0);
session_start();

					$privilege_id=$_SESSION['privilege_uid'];
					$country_id=$_SESSION['admin_country_id'];
					$country_name=$_SESSION['admin_country_name'];
					$admin_type=$_SESSION['admin_type'];
/*else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}*/
//include('includes/notificationcount.php');


//Enter the headings of the excel columns

$heading.="<table border='1'><tr>";
						$heading="Date,User Id,Matching Id,Percentage(%),Level,Bonus(BV),Bonus(USD),TDS(%),TDS Amount,Miscellaneous(%),Miscellaneous Amount,Final Bonus(USD)";
						
						
						$record = "date,income_id,user_id,com_percent,level,commission_bv,commission,tds_percent,tds_amount,miscellaneous_percent,miscellaneous_amount,final_amount";

$contents=$heading."\n";
$field=$record;
//$contents=$_POST['heading']."\n";
//$table_name=$_POST['table'];
//$field=$_POST['record'];
//$con=$_POST['con'];






//Mysql query to get records from datanbase
//You can customize the query to filter from particular date and month etc...Which will depends your database structure.

 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					$country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
			 
			 $user_query=mysql_query("select m.date,m.income_id,m.user_id,m.com_percent,m.level,m.commission_bv,m.commission,m.tds_percent,m.tds_amount,m.miscellaneous_percent,m.miscellaneous_amount,m.final_amount from matching_bonus m inner join registration r on m.income_id=r.user_id where m.income_id!='cmp' $country_search $search_string $con_search order by m.l_id desc");


//$user_query = mysql_query("SELECT $field FROM $table_name $con") or die(mysql_query());
$num=mysql_num_rows($user_query);
//While loop to fetch the records
$record=$field;
$record=explode(",",$record);

while($row = mysql_fetch_assoc($user_query))
{
	
	for($i=0;$i<count($record);$i++)
	{
	 $r=$record[$i];
$contents.=$row[$r].",";

	}
	$contents.="\n";
}

// remove html and php tags etc.
$contents = strip_tags($contents); 

//header to make force download the file
header("Content-Disposition: attachment; filename=ExcelReport-".date('d-m-Y').".csv");
print $contents;

//For more examples related PHP visit www.webinfoipedia.com and enjoy demo and free download..
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
