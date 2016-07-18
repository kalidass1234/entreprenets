<?php
class showDwonMem
{
	function shoDwnMem($dwnid)
	{
		function showMemX($dwnid)
		{
			global $data_dwn;
			$quer3="select * from account_master where ref_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$arr2;
					//print $data_dwn;
					showMemX($idx);
			}
			//return $data_dwn;
		}
		$quer="select * from account_master where ref_id='$dwnid'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2);
		}
	}
}
?>