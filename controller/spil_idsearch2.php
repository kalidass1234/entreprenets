<?php
include("connection.php");
//include("controller/spill_ag.php");
//$nom=$_SESSION['sponser_id'];
$nom='112519';
$idx[]=$nom;
function spill_id23($sponserid)
{

global $nom_id1,$a;
$level=1;
foreach($sponserid as $key => $val)
{
//print $val;
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
if($valu<3)
{
$key1=$key11;
break;
}
}
//print $valu;


//print $rclid1[7];
 
 //print $count=count($rclid1)."<br>";
   //print $key1."<br>";
    
   switch ($valu)
   {
   case '0':
   $nom_id1=$sponserid[$key1];
   //$i=$num_ro1;
  // print "a";
       break;
   case '1':
   $nom_id1=$sponserid[$key1];
   //$i=$num_ro1;
    //  print "bb";
       break;
   case '2':
   $nom_id1=$sponserid[$key1];
   //$i=$num_ro1;
      //print "c";
       break;
   case '3':
 if(!empty($nom_id1))
{
 break;
}

$a=$level+1;
	spill_id23($rclid1);

}
//}
return $nom_id1;
return $a;
}

/*function spill_id1($idx)
{
global $nom_id;
$query1="select * from registration where nom_id='$idx' order by id";
$result1=mysql_query($query1);
 $num_ro1=mysql_num_rows($result1);
 if($num_ro1>=4)
 {
 $nom_id=spill_id23($idx);
}
else
{
$nom_id=$idx;
}

return $nom_id;
}
*/
  $nt=spill_id23($idx);
 echo $a;
?>