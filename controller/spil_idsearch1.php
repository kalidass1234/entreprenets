<?php
function spill_id1($sponserid,$position)
{
global $nom_id;
$query1="select * from registration where nom_id='$sponserid'";
$result1=mysql_query($query1);
$row=mysql_fetch_array($result1);
$rclid1=$row['user_id'];
//print $rclid1;
if($rclid1!="")
{
spill_id1($rclid1,$position);
}
else
{
$nom_id=$sponserid;

}
//print $spill_id;
return $nom_id;
}
?>