<?php 
ob_start();
session_start();
include("../controller/connection.php");
   
/*   CSV Export*/
function escape_csv_value($value) 
{
	$value = str_replace('"', '""', $value); // First off escape all " and make them ""
	if(preg_match('/,/', $value) or preg_match("/\n/", $value) or preg_match('/"/', $value))
	{ // Check if I have any commas or new lines
		return '"'.$value.'"'; // If I have new lines or commas escape them
	} 
	else 
	{
		return $value; // If no new lines or commas just return the value
	}
}

function redirectURL($url) 
{
	$url=$_SERVER['HTTP_REFERER'];
    echo '<script> window.location.href="'.$url.'"</script>"';
}

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=exportMatchingBonus.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userId'])
{
	$id = $_REQUEST['userId'];
}
$sql = "select * from binary_income b inner join registration r on b.income_id=r.user_id where b.income_id!='56789' AND b.bonus_name='2' order by b.id desc ";
$res = mysql_query($sql);
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;
while($row=mysql_fetch_assoc($res))
{
	$sqls = "select user_name from registration where 1 and user_id='".$row['income_id']."'";
	$ress = mysql_fetch_array(mysql_query($sqls));
	$sqlss = "select user_name from registration where 1 and user_id='".$row['matching_id']."'";
	$resss = mysql_fetch_array(mysql_query($sqlss));

	$ststuss = "Paid";

	$content .= escape_csv_value($i).",";
	$content .= escape_csv_value(date('d-m-Y', strtotime($row['b_date']))).",";
	$content .= escape_csv_value($row['user_id']).",";

	$content .= escape_csv_value($ress['user_name']).",";
	
	$content .= escape_csv_value($row['matching_id']).",";

	$content .= escape_csv_value($resss['user_name']).",";
	
	$content .= escape_csv_value($row['commission']).",";
	$content .= escape_csv_value($row['tds_amount']).",";

	$content .= escape_csv_value($row['trust_amount']).",";
	$content .= escape_csv_value($row['admin_amount']).",";
	$content .= escape_csv_value($row['final_amount']).",";

	$content .= escape_csv_value($ststuss).",";
    $content .= "\n";
	
	$i++;
}
						
$title .= "Sr No.,Date, Member Id,Member Name,Matching Id , Matching Name, Bonus (Rs),Tds Amount(Rs),Trust Amount(Rs),Admin Amount(Rs.),Final Amount ,Status "."\n";
echo $title;
echo $content;

?>