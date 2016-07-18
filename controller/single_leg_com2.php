<?php
function single_leg_com2($ref_id)
               {
			 $query="select * from registration where user_id='$ref_id'";
              $result=mysql_query($query);
			  $row=mysql_fetch_array($result);
			  $ref=$row['ref_id'];
			  $spill_id=$row['nom_id'];
			   $query1="select * from registration where user_id='$ref'";
              $result1=mysql_query($query1);
			  $row1=mysql_fetch_array($result1);
			   $ref1=$row1['ref_id'];
			  $spill_id1=$row1['nom_id'];
			  if($ref1!="")
			  {
			  $query2="update registration set slincome2=(slincome2+15) where user_id='$ref1'";
			  $result2=mysql_query($query2);
			  }
			   }
?>