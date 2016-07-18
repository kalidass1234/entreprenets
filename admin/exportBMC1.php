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
header("Content-Disposition: attachment; filename=exportBMC1.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userId'])
{
	$id = $_REQUEST['userId'];
}
$sql = "select * from level_income where 1 AND package_id='14' GROUP by income_id order by l_id desc ";
$res = mysql_query($sql);
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;
while($row=mysql_fetch_assoc($res))
{
	$select = mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE 1 and user_id='".$row['income_id']."'"));
	$res_catb=mysql_fetch_array(mysql_query("select SUM(commission) as commissions from level_income where package_id='14' AND income_id!='56789' AND income_id='".$row['income_id']."' "));

	$ststuss = "UnPaid";

	$content .= escape_csv_value($i).",";
	$content .= escape_csv_value($row['income_id']).",";
	$content .= escape_csv_value($select['user_name']).",";
	$content .= escape_csv_value($res_catb['commissions']).",";
	$content .= escape_csv_value($res_catb['commissions']).",";
	$content .= escape_csv_value($ststuss).",";
	//$content .= escape_csv_value(round($obj_query->get_field_name("final_e_wallet","amount"," user_id='$row[user_id]'"),2)).",";
	$content .= escape_csv_value(date('d-m-Y', strtotime($row['l_date']))).",";

    $content .= "\n";
	
	$i++;
}
						
$title .= "Sr No., Member Id,Member Name,Bonus, Final Amount,Status, Date "."\n";
echo $title;
echo $content;

?>