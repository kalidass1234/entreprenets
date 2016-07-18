<?php
function team_fullr($dwnid)
{
function team_full_right($dwnid)
		{
			global $data_dwn_fr;
			$quer3="select * from registration where nom_id='$dwnid' and plan_amt>=4000";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$busin +=$arr2['topup_amt'];
					$data_dwn_fr[]=$arr2;
					team_full_right($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid' and plan_amt>=4000";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_full_right($user2);
		}
}
?>