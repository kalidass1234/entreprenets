	
<?  
include("controller/connection.php");
//include("controller/showDwonMem.php");
include("controller/spil_idsearch_m.php");
 
$str=mysql_query("select * from registration where mem_status=0");
$c_date=date('Y-m-d');
while($fetch=mysql_fetch_array($str)){
set_time_limit(0);

$user_id=$fetch[user_id];
$nom_m11=$user_id;
$idx23[]=$nom_m11;

 $nt_m=spill_id234($idx23);
 echo $lev;


$update=mysql_query("update registration set cycle='$cycle' where user_id='$user_id'");
$update1=mysql_query("update registration set level='$lev' where user_id='$user_id'");
unset($nom_id_m);
 unset($lev);
}




?>