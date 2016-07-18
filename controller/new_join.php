<?php
class showDwonMem_newj
{
	function shoDwnMem_newj($dwnid)
	{
		function showMemX_newj($dwnid)
		{
			global $data_dwn_newj;
			$curtill_dt=date('Y-m-d');
								$d_d=explode('-',$curtill_dt);
								$d_d1=$d_d[2];
							 $curfrm_dt=$d_d[0]."-".$d_d[1]."-".($d_d1-7);
							 $i=1;
			$quer3="select * from registration where nom_id='$dwnid' order by reg_date";
			$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn_newj[]=$arr2;
					//print $data_dwn;
					showMemX_newj($idx);
			}
			//return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid' order by reg_date";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX_newj($user2);
		}
	}
}
?>