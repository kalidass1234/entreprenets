<?php
include("../includes/all_func.php");
$q=trim($_GET["q"]); 
$sql="SELECT * FROM registration WHERE (user_id='$q'  or user_name='$q') ";
$result = mysql_query($sql);
$num=mysql_num_rows($result);
if($num>0){
$x=mysql_fetch_array($result);
$name=$x['first_name']." ".$x['last_name'];

  echo "<b style='color:green'>$name</b>";}else{echo "<b style='color:#FF0000'>No Member Exist</b>";}
?>
