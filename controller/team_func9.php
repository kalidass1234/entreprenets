<?php
function team_l9($dwnid)
{
function team_left9($dwnid)
		{
		include("connection.php");
			global $data_dwn9, $busin9;
			$quer4="select * from registration where nom_id='$dwnid'";
			$data4=mysql_query($quer4);
			while($arr4=mysql_fetch_array($data4))
			{
					$idx=$arr4['user_id'];
					//$sta=$arr2['status'];
					$busin9 +=$arr4['plan_name'];
					$data_dwn9[]=$arr4;
					team_left9($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer33="select * from registration where nom_id='$dwnid'";
		$data33=mysql_query($quer33);
		while($arr33=mysql_fetch_array($data33))
		{
			$user33=$arr33['user_id'];
			team_left9($user33);
		}
}
?>