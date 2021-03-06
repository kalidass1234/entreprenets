<?php 
ob_start();
session_start();
include("../controller/connection.php");
if(!isset($_SESSION['adid']))
{
	header('location:../index.php');
}
   
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
header("Content-Disposition: attachment; filename=exportCoddedBonus.csv");
header("Pragma: no-cache");
header("Expires: 0");


if(isset($_SESSION['adid']))
{
	$id = $_SESSION['adid'];
		$select = "select user_id from registration where (user_id='$id' OR user_name = '$id') ";
		$resNomId=mysql_query($select);
		$rowNomIdCount=mysql_fetch_array($resNomId);

}
$sql = "select * FROM binary_income WHERE income_id = '".$rowNomIdCount['user_id']."' AND bonus_name='2' ORDER BY id DESC";
$res = mysql_query($sql);
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;
while($row=mysql_fetch_assoc($res))
{
	$sqls = "select user_name from registration where 1 and user_id='".$row['matching_id']."'";
	$ress = mysql_fetch_array(mysql_query($sqls));
	$ststuss = "Paid";

						
	$content .= escape_csv_value($i).",";
	$content .= escape_csv_value(date('d-m-Y', strtotime($row['b_date']))).",";
	$content .= escape_csv_value($row['matching_id']).",";
	$content .= escape_csv_value($ress['user_name']).",";

	$content .= escape_csv_value($row['tds_amount']).",";
	$content .= escape_csv_value($row['trust_amount']).",";
	$content .= escape_csv_value($row['admin_amount']).",";
	$content .= escape_csv_value($row['commission']).",";
	$content .= escape_csv_value($row['final_amount']).",";
	$content .= escape_csv_value($ststuss).",";
    $content .= "\n";
	
	$i++;
}
						
$title .= "Sr No.,Date, Matching Id,User Name,Tds Amount, Trust Amount, Admin Amount, Commission (Rs),Final Amount (Rs),Status "."\n";
echo $title;
echo $content;

?>