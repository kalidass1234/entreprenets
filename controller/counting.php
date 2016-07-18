<?php
function counting($row_right)
		{
	include("connection.php");
			global $ii,$cc;
		$quer3="select * from registration where ref_id='$row_right'";
		$data3=mysql_query($quer3);
			while($arr2=mysql_fetch_array($data3))
			{
				$idx=$arr2['user_id'];
					//$data_dwn[]=$arr2;
					$ii++;
			
			

			}
			if(!empty($idx))
			{
					counting($idx);
}
			return $ii;
	
		}

?>