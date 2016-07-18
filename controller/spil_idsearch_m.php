<?php
include("connection.php");
//include("controller/spill_ag.php");

function spill_id234($sponserid12)
{

global $nom_id_m,$lev;

foreach($sponserid12 as $key12 => $val12)
{
//print $val;
  $query12="select * from registration where nom_id='$val12' order by id";
$result12=mysql_query($query12);
 $num_ro12[]=mysql_num_rows($result12);
while($row12=mysql_fetch_array($result12))
{
$rclid11[]=$row12['user_id'];
}
}
foreach($num_ro12 as $key112 => $valu12)
{
if($valu12<10)
{
$key2=$key112;
break;
}
}
//print $valu;


//print $rclid1[7];
 
 //print $count=count($rclid1)."<br>";
   //print $key1."<br>";
    
   switch ($valu12)
   {
   case '0':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
  // print "a";
       break;
   case '1':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	    case '2':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
  
      case '3':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	   
	       case '4':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	   
	       case '5':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	   
	       case '6':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	   
	       case '7':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	   
	       case '8':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   
	       case '9':
   $nom_id_m=$sponserid12[$key2];
   //$i=$num_ro1;
    //  print "bb";
       break;
	   

  
  
   case '10':

if(!empty($nom_id_m))
{
 break;
}

 $lev=$lev+1; 
	spill_id234($rclid11);

}
//}
return $nom_id_m;
return $lev;


}


 ?>