<?php
function team12($dwnid)
{
function team_right12($dwnid)
		{
		include("connection.php");
			global $data_dwn12,$busin12;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//$sta=$arr2['status'];<br />
$busin12 +=$arr2['topup_amt'];
					$data_dwn12[]=$arr2;
					team_right12($idx);

		}
		//return $data_dwn;

		}
$quer="select * from registration where nom_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			team_right12($user2);
		}
}
?>