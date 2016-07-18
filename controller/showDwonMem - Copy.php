<?php
class showDwonMem
{
	function shoDwnMem($dwnid)
	{
		function showMemX($dwnid)
		{
			global $data_dwn,$le;
			$quer3="select * from registration where nom_id='$dwnid' ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$arr2;
					++$le;
					//print $data_dwn;
					showMemX($idx);
			}
			//return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid' ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2);
		}
	}
}
?>