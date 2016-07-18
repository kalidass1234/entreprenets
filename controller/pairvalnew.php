<?php
class pearVal
{
	function prVal()
	{
		global $regdate, $cnt, $uidmain;
		include('connection.php');
		$regdate=date("Y-m-d");
		$quer="select * from registration";
		$data=mysql_query($quer);
		while($res=mysql_fetch_array($data))
		{
			$uidx2=array();
			$uidmain=$res['user_id'];
			$qur22="select * from registration where nom_id='$uidmain'";
			$dat22=mysql_query($qur22);
			while($r22=mysql_fetch_array($dat22))
			{
				$ridd=$r22['user_id'];
				$uidx2=$ridd;
				countDown($uidx2);

			}  
			$cnt=0;
		}
		
	}
}

function downCnt($uid)
{
	global $regdate, $cnt;
	$regdate=date("Y-m-d");
	$quer2="select * from registration where nom_id='$uid'";
	$data2=mysql_query($quer2);
	while($xn=mysql_fetch_array($data2))
	{	
		$cnt++;
		$next=$xn['user_id'];
		$id=$next;
		downCnt($id);
	}
}
function countDown($uid)
	{	
	global $cnt, $regdate, $uidmain;	
	$regdate=date("Y-m-d");
	$oldid=$uidmain;
	$oldqty=$cnt;
		downCnt($uid);
	$qurnx="update registration set left_count='$oldqty' where user_id='$uidmain'";
	$datnx=mysql_query($qurnx);	

	if($uidmain==$oldid)
	{
		$rightqt=$cnt-$oldqty;
	}
	$qurnx2="update registration set right_count='$rightqt' where user_id='$uidmain'";
	$datnx2=mysql_query($qurnx2);	
	//----------------------------------------------------
	if($oldqty<$rightqt)
	{
		$pairqty=$oldqty;
	}
	elseif($rightqt<$oldqty)
	{
		$pairqty=$rightqt;
	}
	else
	{
		$pairqty=0;
	}
	$qurnx3="update registration set cur_pairs='$pairqty' where user_id='$uidmain'";
	$datnx3=mysql_query($qurnx3);
	if($pairqty>10)
	{
		if($oldqty<$rightqt)
	{
		$caryf=$rightqt+$oldqty-10;
	}
	elseif($rightqt<$oldqty)
	{
		$caryf=$oldqty+$rightqt-10;
	}
	else
	{
		$caryf=0;
	}
	}
	else
	{
		if($oldqty<$rightqt)
	{
		$caryf=$rightqt-$oldqty;
	}
	elseif($rightqt<$oldqty)
	{
		$caryf=$oldqty-$rightqt;
	}
	else
	{
		$caryf=0;
	}
	}
	$qurnx4="update registration set carry_for='$caryf' where user_id='$uidmain'";
	$datnx4=mysql_query($qurnx4);
	
	
}
$one = new pearVal();
$one->prVal();
?>
