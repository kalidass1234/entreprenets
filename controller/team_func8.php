<?php
function team8($dwnid)
{
function team_right8($dwnid)
		{
		include("connection.php");
			global $data_dwn8,$busin8;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//$sta=$arr2['status'];
					$busin8 +=$arr2['plan_name'];
					$data_dwn8[]=$arr2;
					team_right8($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_right8($user2);
		}
}
?>