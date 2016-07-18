<?php

	
		function showMemX($dwnid)
		{
			global $data_dwn,$le;
			$quer3="select * from registration where nom_id='$dwnid'";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$idx;
					$le++;
					//print $data_dwn;
					
					showMemX($idx);
					//}
			}
			//return $data_dwn;
		}
		
	//}
//}
?>