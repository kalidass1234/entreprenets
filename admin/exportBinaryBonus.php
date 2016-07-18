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
header("Content-Disposition: attachment; filename=exportRegistration.csv");
header("Pragma: no-cache");
header("Expires: 0");

if($_REQUEST['userId'])
{
	$id = $_REQUEST['userId'];
}
$sql = "select * from registration  where '1' order by id desc ";
$res = mysql_query($sql);
$totc_unpaid = 0;
$total = 0;
$content = '';
	  
$title = '';
$i=1;
while($row=mysql_fetch_assoc($res))
{
	$ststuss = "Active";

	$content .= escape_csv_value($i).",";
	$content .= escape_csv_value($row['user_id']).",";
	$content .= escape_csv_value($row['user_name']).",";
	$content .= escape_csv_value($row['first_name']." ".$row['last_name']).",";
	$content .= escape_csv_value($row['email']).",";
	$content .= escape_csv_value($ststuss).",";
	$content .= escape_csv_value($row['ref_id']).",";
	//$content .= escape_csv_value(round($obj_query->get_field_name("final_e_wallet","amount"," user_id='$row[user_id]'"),2)).",";
	$content .= escape_csv_value(date('d-m-Y', strtotime($row['reg_date']))).",";

    $content .= "\n";
	
	$i++;
}
						
$title .= "Sr No., Member Id,Member Name,Name, Email,Status,Sponser Id, Date "."\n";
echo $title;
echo $content;

?>