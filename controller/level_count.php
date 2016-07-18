<?php //include("connection.php");

function level_count($crid,$tpid)
{ 
	$a=0;
	global $a;
	$query1="select ref_id from registration where user_id='$crid'";
	$result1=mysql_query($query1);
	$row=mysql_fetch_array($result1);
	$rclid1=$row['ref_id'];
	$a=1;

	if($rclid1!=$tpid)
	{	
		if($rclid1=="cmp")
		{
			?><script>
			alert('This member not exist in your downline');
			</script>
			<?php 
			break;
		}
		
		level_count($rclid1,$tpid);
		$a++;
	}
	else
	{
		$a=1;
	}
return $a;
}


function level_count_nom($crid,$tpid)
{ 
	$a1=0;
	global $a1;
	$query1="select * from registration where user_id='$crid'";
	$result1=mysql_query($query1);
	$row=mysql_fetch_array($result1);
	$rclid1=$row['nom_id'];
	$a1=1;
	
	if($rclid1!=$tpid)
	{
		if($rclid1=='cmp')
		{
			?>
			<script>
			alert('This member not exist in your downline');
			document.location="../userpanel/metrixlevel.php";
			</script>
			<?php 
			break;
		}
		level_count_nom($rclid1,$tpid);$a1++;
	}
	else
	{
		$a1=1;
	}
	
return $a1;
}
/*$crid='1353920538';
$tpid='4096003135';
echo $a=level_count($crid,$tpid)
*/
?>