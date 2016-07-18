<?php session_start();

//include("controller/spill_ag.php");

function spill($sponserid)
{
	$lev=1;
	global $nom_id1,$lev;
	//$lev=1;

	foreach($sponserid as $key => $val)
	{
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
		if($valu<2)
		{
			$key1=$key11;
			break;
		}
	}
   switch ($valu)
   {
	   case '0':
	   $nom_id1=$sponserid[$key1];
		   break;

	   case '1':
	   $nom_id1=$sponserid[$key1];
		   break;
			case '2':
		if(!empty($nom_id1))
		{
		 break;
		}
		$lev++;
		spill($rclid1);
	}

	return $nom_id1;
	return $lev;
}

//echo $nomid=spill_id23(array('3007889'));
/*
$sql_ref="select id,ref_id from registration where  mem_status='1' order by id asc";
$rst=mysql_query($sql_ref) or die($sql.mysql_error());
$i=1;

while($row=mysql_fetch_array($rst))
{

	$id=$row['id'];
	$ref_id=$row['ref_id'];
	$nomid=spill_id23(array($ref_id));
	 
	//echo $nomid."<br>";
		
	$update="update registration set nom_id='$nomid' where id='$id'";
	if(mysql_query($update))
	{
		echo $i++;
		echo "<br>";
	}

unset($nomid);}
*/

?>