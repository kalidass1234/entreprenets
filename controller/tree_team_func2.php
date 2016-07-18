<?php

function team2($dwnid)
{
function team_right2($dwnid)
		{
			global $data_dwn2, $ii, $rii;
			$quer31="select * from registration where nom_id='$dwnid'";
			$data31=mysql_query($quer31);
			while($arr21=mysql_fetch_array($data31))
			{
					$idx1=$arr21['user_id'];
					//$sta=$arr2['status'];
					$data_dwn2[]=$arr21;
					team_right2($idx1);

			}
		//return $data_dwn;

		}
$quer3="select * from registration where nom_id='$dwnid'";
		$data3=mysql_query($quer3);
		while($arr3=mysql_fetch_array($data3))
		{
			$user23=$arr3['user_id'];
			team_right2($user23);
		}
}
?>