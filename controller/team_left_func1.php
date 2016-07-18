<?php
function team_left1($dwnid)
{
function team_l1($dwnid)
		{
			global $data_dwn_l1;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//$sta=$arr2['status'];
					$data_dwn_l1[]=$arr2;
					team_l1($idx);

					
			}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_l1($user2);
		}
}
?>