<?php
class showDwonMem_rt
{
	function shoDwnMem_rt($dwnid)
	{
	
	
		if(!function_exists(showMemX_rt))
		{
		function showMemX_rt($dwnid)
		{
	
			global $data_dwn_rt;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn_rt[]=$arr2;
					//print $data_dwn;
					showMemX_rt($idx);
			}
			//return $data_dwn;
		}
		
		
		}
		$quer="select * from registration where nom_id='$dwnid' and binary_pos='right'";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX_rt($user2);
		}
	}
}
?>