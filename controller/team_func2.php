<?php
function team2($dwnid)
{
function team_right2($dwnid)
		{
		include("connection.php");
			global $data_dwn2, $busin2;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//$sta=$arr2['status'];
					$busin2 +=$arr2['plan_name'];
					$data_dwn2[]=$arr2;
					team_right2($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_right2($user2);
		}
}
?>