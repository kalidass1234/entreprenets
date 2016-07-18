<?php
function team4($dwnid)
{
function team_right4($dwnid)
		{
		include("connection.php");
			global $data_dwn4, $busin4;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//$sta=$arr2['status'];
					$busin4 +=$arr2['plan_name'];
					$data_dwn4[]=$arr2;
					team_right4($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_right4($user2);
		}
}
?>