<?php
ini_set('memory_limit','500M');
class showDwonMem
{
	function shoDwnMem($dwnid)
	{
		function showMemX($dwnid)
		{
			global $data_dwn,$le;
			$quer3="select * from registration where nom_id='$dwnid'";
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
		}	$str_reg="select * from registration where user_id='$dwnid'";
	$data_reg=mysql_query($str_reg);
	
	$arr_reg=mysql_fetch_array($data_reg);
		$dwnid=$arr_reg['user_id'];
	
	
		$quer="select * from registration where nom_id='$dwnid' and binary_pos='left'";
		$data=mysql_query($quer);
		
		
		
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2);
		}
	}
}
?>