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
header("Content-Disposition: attachment; filename=exportFinalBonus.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userId'])
{
	$id = $_REQUEST['userId'];
}

$sql = "select b_date,income_id,bonus_name from binary_income where income_id!='56789' GROUP by income_id order by id desc ";
$res = mysql_query($sql);
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;
while($row=mysql_fetch_assoc($res))
{
	
					$res_catb=mysql_fetch_array(mysql_query("select SUM(final_amount) as fis from binary_income where bonus_name='1' AND income_id!='56789' AND income_id='".$row['income_id']."' "));

					$res_catm=mysql_fetch_array(mysql_query("select SUM(final_amount) as fis  from binary_income where bonus_name='2' AND income_id!='56789' AND income_id='".$row['income_id']."'"));

					$res_cats=mysql_fetch_array(mysql_query("select SUM(final_amount) as fis  from binary_income where bonus_name='3' AND income_id!='56789'  AND income_id='".$row['income_id']."'"));
					
$finalAmounts = $res_catb['fis'] + $res_catm['fis']+ $res_cats['fis'];

	$sqls = "select user_name from registration where 1 and user_id='".$row['income_id']."'";
	$ress = mysql_fetch_array(mysql_query($sqls));
	
	$select = mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_id='".$row['purchaser_id']."'"));
	$selectP = mysql_fetch_array(mysql_query("SELECT * FROM package WHERE package_id='".$row['package_id']."'"));
				 
	$ststuss = "Paid";


	$content .= escape_csv_value($i).",";
	$content .= escape_csv_value(date('d-m-Y', strtotime($row['b_date']))).",";
	$content .= escape_csv_value($row['income_id']).",";
	
	$content .= escape_csv_value($ress['user_name']).",";

	$content .= escape_csv_value($res_catb['fis']).",";
	$content .= escape_csv_value($res_catm['fis']).",";
	$content .= escape_csv_value($res_cats['fis']).",";

	$content .= escape_csv_value($finalAmounts).",";

	$content .= escape_csv_value($ststuss).",";
    $content .= "\n";
	
	$i++;
}
						
$title .= "Sr No.,Date, Member Id,Member Name,Binary Amount(Rs),Matching Bonus Amount(Rs.), Sponsership Bonus (Rs),Final Amount ,Status "."\n";
echo $title;
echo $content;

?>