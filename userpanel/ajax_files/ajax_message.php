<?php 
include("../../includes/all_func.php");
session_start();
//echo "<pre>"; print_r($_POST);
extract($_POST);
# update message to delete
if($target=='inbox')
{
	mysql_query("update message set status=1 where id in ($ss)");
	echo mysql_affected_rows();
}
else if($target=='sent')
{
	mysql_query("update message_sender set status=1 where id in ($ss)");
	echo mysql_affected_rows();
}
else if($target=='draft')
{
	mysql_query("update message_draft set status=1 where id in ($ss)");
	echo mysql_affected_rows();
}
else
{

	$arrid=explode(',',$ss);
	$c=0;
	for($i=0;$i<count($arrid);$i++)
	{
		$arr=explode('_',$arrid[$i]);
		//print_r($arr);
		if(trim($arr[1],' ')=='sender')
		{
			$id=trim($arr[0].' ');
			//echo "update message_sender set status=1 where id ='$id' "."<br>";
			mysql_query("update message_sender set status=2 where id ='$id' ");
			$c=$c+mysql_affected_rows();
		}
		else if(trim($arr[1],' ')=='receiver')
		{
			$id1=trim($arr[0].' ');
			//echo "update message set status=1 where id ='$id1' <br>";
			mysql_query("update message set status=2 where id ='$id1' ");
			$c=$c+mysql_affected_rows();
		}
		else if(trim($arr[1],' ')=='draft')
		{
			$id1=trim($arr[0].' ');
			//echo "update message set status=1 where id ='$id1' <br>";
			mysql_query("update message_draft set status=2 where id ='$id1' ");
			$c=$c+mysql_affected_rows();
		}
	}
	echo $c;
}

?>