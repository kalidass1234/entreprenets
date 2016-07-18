<?php
		function ospill_inner($spill_id, $ref)
			  {
			  if($ref==$spill_id)
			  {
			  $query1="select * from registration where user_id='$spill_id'";
              $result1=mysql_query($query1);
			  $row1=mysql_fetch_array($result1);
			  $ref1=$row1['ref_id'];
			  $spill_id1=$row1['nom_id'];
			  if($ref1==$spill_id1)
			  {
			   ospill_inner($spill_id1, $ref1);
			  }
			  else
			  {
			  $query1="update registration set osincome2=(osincome2+10) where user_id='$ref1'";
			  $result1=mysql_query($query1);
			  }	
			  }	
			  } 
			  
?>