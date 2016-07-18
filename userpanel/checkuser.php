<?php
include("../controller/connection.php");
$q=$_GET["q"]; 
$sql=mysql_query("select * from registration where user_name='$q' OR user_id='$q'");
$res=mysql_fetch_array($sql);
if(mysql_num_rows($sql)>0)  {
	echo '<span style="color:#4D8044; margin-left:10px;">'.$res[first_name].' '.$res[mid_name].' '.$res[last_name].'</span>';
}else echo 'This is not a valid uername/userid';
?>


