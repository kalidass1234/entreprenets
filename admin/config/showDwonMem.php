<?php
class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' and nom_id!='' order by id asc ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					
					$data_dwn[]=$arr2['user_id'];
					$levv=level_count_nom($idx,$tid);
					$lel[]=$levv;
					
					print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid' and nom_id!='' order by id asc ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2,$tid);
		}
 		//return $user2;
	}
	

	function shoDwnMemL($dwnid,$tid)
	{
		function showMemXL($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' and nom_id!='' and binary_pos='left' order by id asc ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					
					$data_dwn[]=$arr2['user_id'];
					$levv=level_count_nom($idx,$tid);
					$lel[]=$levv;
					
					print $data_dwn;
					showMemXL($idx,$tid);
			}
			return $data_dwn;
			
		}
		$quer="select * from registration where nom_id='$dwnid' and nom_id!='' and binary_pos='left'  order by id asc ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemXL($user2,$tid);
		}
 		//return $user2;
	}
	
	function shoDwnMemR($dwnid,$tid)
	{
		function showMemXR($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' and nom_id!='' and binary_pos='right' order by id asc ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					
					$data_dwn[]=$arr2['user_id'];
					$levv=level_count_nom($idx,$tid);
					$lel[]=$levv;
					
					print $data_dwn;
					showMemXR($idx,$tid);
			}
			return $data_dwn;
			
		}
		$quer="select * from registration where nom_id='$dwnid' and nom_id!='' and binary_pos='left'  order by id asc ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemXR($user2,$tid);
		}
 		//return $user2;
	}
	
	function level_count_nom($crid,$tpid)
	{ 
		$a1=0;
		global $a1;
		$query1="select * from registration where user_id='$crid'";
		$result1=mysql_query($query1);
		$row=mysql_fetch_array($result1);
		$rclid1=$row['nom_id'];
		$a1=1;
		
		if($rclid1!=$tpid)
		{
			if($rclid1=='cmp')
			{
				break;
			}
			$this->level_count_nom($rclid1,$tpid);
			$a1++;
		}
		else
		{
			$a1=1;
		}
		
	return $a1;
	}
	

}
$showDwonMem = new showDwonMem();
?>