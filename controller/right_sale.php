<?php
function team_fulll($dwnid)
{
function team_full_left($dwnid)
		{
			global $data_dwn_fl;
			$quer4="select * from registration where nom_id='$dwnid' and plan_amt>=4000";
			$data4=mysql_query($quer4);
			while($arr4=mysql_fetch_array($data4))
			{
					$idx=$arr4['user_id'];
					$busin1 +=$arr4['topup_amt'];
					$data_dwn_fl[]=$arr4;
					team_full_left($idx);

					$ii++;
			}
		//return $data_dwn;

		}
$quer33="select * from registration where nom_id='$dwnid' and plan_amt>=4000";
		$data33=mysql_query($quer33);
		while($arr33=mysql_fetch_array($data33))
		{
			$user33=$arr33['user_id'];
			team_full_left($user33);
		}
}
?>