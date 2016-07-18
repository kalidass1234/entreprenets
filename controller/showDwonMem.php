<?php
class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel, $le;
			$quer3="select user_id from registration where nom_id='$dwnid' order by id desc";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$arr2;
				//	$levv=level_count($idx,$tid);
					$lel[]=$levv;
					++$le;
					//print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select user_id from registration where nom_id='$dwnid' order by id desc";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2,$tid);
		}
	}
}
?>