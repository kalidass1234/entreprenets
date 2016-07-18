<?php
function team_right1($dwnid)
{
function team_r1($dwnid)
		{
			global $data_dwn_r1;
			$quer4="select * from registration where nom_id='$dwnid'";
			$data4=mysql_query($quer4);
			while($arr4=mysql_fetch_array($data4))
			{
					$idx=$arr4['user_id'];
					//$sta=$arr2['status'];
					$data_dwn_r1[]=$arr4;
					team_r1($idx);

				
			}
		//return $data_dwn;

		}
$quer33="select * from registration where nom_id='$dwnid'";
		$data33=mysql_query($quer33);
		while($arr33=mysql_fetch_array($data33))
		{
			$user33=$arr33['user_id'];
			team_r1($user33);
		}
}
?>