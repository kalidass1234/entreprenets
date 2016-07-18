<?php

	
		function showMemX($dwnid,$id)
		{
			global $data_dwn,$le;
			$quer3="select * from registration where o_ref_id LIKE '$dwnid' and reg_date<='2012-03-07'";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$arr2;
					$le++;
					//print $data_dwn;
					if($idx!="blessings")
					{
					showMemX($idx,$id);
					}
			}
			//return $data_dwn;
		}
		
	//}
//}
?>