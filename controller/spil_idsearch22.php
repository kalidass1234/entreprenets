<?php
session_start();

include("connection.php");
//include("controller/spill_ag.php");
$length=10;
	$encypt=uniqid(rand(), true);
	$usid=str_replace(".", "", $encypt);
	$userpass = substr($usid, 0, $length);
	$encypt1=uniqid(rand(), true);
	$usid1=str_replace(".", "", $encypt1);
	$userpass1 = substr($usid1, 0, $length);
	$user_id1=$userpass1;
	$_SESSION['sessionuserid']=$user_id1;
$nom=$_SESSION['sponser_id'];
$nom='12345';
$idx[]=$nom;
function spill_id23($sponserid)
{

global $nom_id1,$a;
$level=1;
foreach($sponserid as $key => $val)
{
print $val.'<br>';
echo   "INSERT INTO notify SET user_id='{$_SESSION['sessionuserid']}', nom_id='$val', date=NOW(), notific='yes'";
echo '<br>';
  $query1="select * from registration where nom_id='$val' order by id";
$result1=mysql_query($query1);
 $num_ro1[]=mysql_num_rows($result1);
while($row=mysql_fetch_array($result1))
{
$rclid1[]=$row['user_id'];
}
}
foreach($num_ro1 as $key11 => $valu)
{
if($valu<10)
{
$key1=$key11;
break;
}
}
print $valu.'<br>';


//print $rclid1[7];
 
 print $count=count($rclid1)."<br>";
   print $key1."<br>";
    
   switch ($valu)
   {
   case '0':
   $nom_id1=$sponserid[$key1];
   $i=$num_ro1;
   print "a";
       break;
   case '1':
  echo $nom_id1=$sponserid[$key1];
   $i=$num_ro1;
     print "bb";
       break;
  
   case '2':
 if(!empty($nom_id1))
{
 break;
}

$a=$level+1;
	spill_id23($rclid1);

}

return $nom_id1;
return $a;
}


  $nt=spill_id23($idx);
 
?>