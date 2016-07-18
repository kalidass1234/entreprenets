<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$id=showuserid($_SESSION['SD_User_Name']);
$sql_user="select * from registration where user_id='$id'";
$res_user=mysql_query($sql_user);
$row_user=mysql_fetch_assoc($res_user);
$ref_id=$row_user['ref_id'];
$bonus=$row_user['bonus'];
$reg_date=$row_user['reg_date'];
$category_one=$row_user['category_one'];
$category_two=$row_user['category_two'];
$category_three=$row_user['category_three'];
}
/*else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}*/
//include('includes/notificationcount.php');


//Enter the headings of the excel columns
$contents=$_POST['heading3']."\n";
$table_name=$_POST['table'];
$field=$_POST['record'];
$con=$_POST['con'];
//Mysql query to get records from datanbase
//You can customize the query to filter from particular date and month etc...Which will depends your database structure.
$user_query = mysql_query("SELECT $field FROM $table_name $con") or die(mysql_query());
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
?>