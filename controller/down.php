<?php
function down($id)
{
global $data_dwn,$data_dwn1,$data_dwn2,$data_dwn3,$data_dwn4,$data_dwn5;
$quer3="select * from registration where ref_id='$id'";
$data3=mysql_query($quer3);
while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$arr2;
					
					//print $data_dwn;
					//showMemX($idx);
                    /*-------------------- start3 level  --------------------*/
					$quer4="select * from registration where ref_id='$idx'";
                     $data4=mysql_query($quer4);
                 while($arr4=mysql_fetch_array($data4))
			{
					$idx4=$arr4['user_id'];
					$data_dwn1[]=$arr4;
	/*    ----------------4 level---------------*/
	$quer5="select * from registration where ref_id='$idx4'";
                     $data5=mysql_query($quer5);
					while($arr5=mysql_fetch_array($data5))
			{
					$idx5=$arr5['user_id'];
					$data_dwn2[]=$arr5;
/*-------------------5 level-----------------*/
	$quer6="select * from registration where ref_id='$idx5'";
                     $data6=mysql_query($quer6);
					while($arr6=mysql_fetch_array($data6))
			{
					$idx6=$arr6['user_id'];
					$data_dwn3[]=$arr6;
/*-------------------6 level-----------------*/
	$quer7="select * from registration where ref_id='$idx6'";
                     $data7=mysql_query($quer7);
					while($arr7=mysql_fetch_array($data7))
			{
					$idx7=$arr7['user_id'];
					$data_dwn4[]=$arr7;
}
/*-----------------end 5 level---------*/					
					
}
/* ------------end 4 level----------------*/

}
/*---------------end 3 level ------------------*/

              }
			  /*--------------End 2 level-------------------- */				
			}
			/*-----------------end 1 level---------*/					
}
?>