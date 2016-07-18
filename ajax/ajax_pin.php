<?php session_start();

include("../controller/connection.php");
$id=$_POST['id'];
$pos=isset($_POST['pos']) ? $_POST['pos'] : '';

$selectuser1=mysql_query("select pin_no from pins where pin_no='$id'");
$fetchuser1=mysql_fetch_array($selectuser1);
$fetchuser1Count = mysql_num_rows($selectuser1);

if($fetchuser1Count > 0)
{
echo "yes";
}
else
{
echo  "no";
}

?>
