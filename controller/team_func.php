<?php
function team($dwnid)
{
function team_right($dwnid)
		{
			global $data_dwn, $ii, $rii;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//$sta=$arr2['status'];
					$data_dwn[]=$arr2;
					team_right($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_right($user2);
		}
}
?>