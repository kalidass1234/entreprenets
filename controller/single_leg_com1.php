<?php
function single_leg_com1($ref_id)
               {
			 $query="select * from registration where user_id='$ref_id'";
              $result=mysql_query($query);
			  $row=mysql_fetch_array($result);
			  $ref=$row['ref_id'];
			  $spill_id=$row['nom_id'];
			  if($ref!="")
			  {
			  $query1="update registration set slincome1=(slincome1+25) where user_id='$ref'";
			  $result1=mysql_query($query1);
			  }
			   }
?>