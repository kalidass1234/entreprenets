<?php
function team_l3($dwnid)
{
function team_left3($dwnid)
		{
			global $data_dwn3, $ii;
			$quer41="select * from registration where nom_id='$dwnid'";
			$data41=mysql_query($quer41);
			while($arr41=mysql_fetch_array($data41))
			{
					$idx41=$arr41['user_id'];
					//$sta=$arr2['status'];
					$data_dwn3[]=$arr41;
					team_left3($idx41);

					$ii++;
			}
		//return $data_dwn;

		}
$quer43="select * from registration where nom_id='$dwnid'";
		$data43=mysql_query($quer43);
		while($arr43=mysql_fetch_array($data43))
		{
			$user43=$arr43['user_id'];
			team_left3($user43);
		}
}
?>