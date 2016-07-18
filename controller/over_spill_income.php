<?php
function ospill_i($nom_id)
               {
			 $query="select * from registration where user_id='$nom_id'";
              $result=mysql_query($query);
			  $row=mysql_fetch_array($result);
			  $ref=$row['ref_id'];
			  $spill_id=$row['nom_id'];
			  if($spill_id!=$ref)
			  {
			  //ospill_i($spill_id,$ref);
			  $query1="update registration set osincome=(osincome+15) where user_id='$ref'";
			  $result1=mysql_query($query1);
			   }
			   }
?>