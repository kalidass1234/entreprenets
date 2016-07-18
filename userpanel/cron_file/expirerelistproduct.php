<?php
#======================================================================================#
# This cron execute once in a day tipicaly at 01:00 am and expire the product and related
# auctions that are expire at previous day
# If product choose for auto relist . Relist Product and auction that have option of auto relist
# 23-08-2013
include('../../includes/all_func.php');
$current_date=date('Y-m-d');
$curdate=date('Y-m-d H:i:s');
//$newdate =strtotime ( $current_date ) ;
$newdate = strtotime ( '- 1 day' , strtotime ( $current_date ) ) ;
$previous_date=date('Y-m-d',strtotime($current_date));
// start product expiration code
$sql="select date(end_time) as endtime,p_cat_id,penny_auction,add_by from product_category where status in (0,1,2)";
$res=mysql_query($sql);
$i=1;
while($row=mysql_fetch_assoc($res))
{
$id=$row['p_cat_id'];
//echo $i."->".strtotime($row['endtime'])."----------".$newdate."<br>";
	if(strtotime($row['endtime'])<=$newdate)
	{
		$sqlex="update product_category set status='3' where p_cat_id='$id'";
		$resex=mysql_query($sqlex);
		$resh=mysql_query("select id from product_history where p_id='$id' order by id desc limit 0,1");
		$rowh=mysql_fetch_assoc($resh);
		$hid=$rowh['id'];
		$sqlexh="update product_history set status='3' where id='$hid' and p_id='$id'";
		$resexh=mysql_query($sqlexh);
		echo $i."->Product Expire: Product Id:".$id."<br>";
		// expire penny auction 
		if($row['penny_auction']==1)
		{
			$sql_pa="select status,id from penny_auction where seller_id='$row[add_by]' and p_id='$row[p_cat_id]' and status=1";
			//echo $sql_pa.'<br>';
			$res_pa=mysql_query($sql_pa);
			$count_pa=mysql_num_rows($res_pa);
			if($count_pa>0)
			{
				$row_pa=mysql_fetch_assoc($res_pa);
				$update_pa="update penny_auction set status=3,expire_status=1 where id='$row_pa[id]'";
				//echo $update_pa.'<br>';
				mysql_query($update_pa);
				echo $i."->Auction Expire: Auction Id:".$row_pa['id']."<br>";
			}
		}
	}
	else
	{
		//echo $i."->Product Active: Product Id:".$id."<br>";
	}
	$i++;
}
// end product expiration code
//exit;
// start auto relist code
$sqlrl="select date(end_time) as endtime,p_cat_id,duration,add_by,status,penny_auction from product_category where status in (0,1,2,3) and autorelist='on'";
$resrl=mysql_query($sqlrl);
$i=1;
while($rowrl=mysql_fetch_assoc($resrl))
{
$idrl=$rowrl['p_cat_id'];
$duration=$rowrl['duration'];
		if($rowrl['status']==3){
		$status=0;
		}
		else
		{
		$status=$rowrl['status'];
		}
//echo $i."->".$idrl.'=='.$status.'=='.strtotime($rowrl['endtime'])."----------".$newdate."<br>";
	if(strtotime($rowrl['endtime'])<=$newdate)
	{
		$newdate1 = strtotime ( '+ '.$duration .'day' , strtotime ( $curdate ) ) ;
		$end_time = date ( 'Y-m-d H:i:s' , $newdate1 );
		
		$sqlex="update product_category set status='$status', `start_time`='$curdate', `end_time`='$end_time' where p_cat_id='$idrl'";
		//echo $sqlex.'<br>';
		$resex=mysql_query($sqlex);
		$resh=mysql_query("select id from product_history where p_id='$idrl' order by id desc limit 0,1");
		$rowh=mysql_fetch_assoc($resh);
		$hid=$rowh['id'];
		$sqlexhrel="update product_history set status='3' where id='$hid' and p_id='$idrl'";
		$resexhrel=mysql_query($sqlexhrel);
	
		
		$sqlhrel="INSERT INTO `product_history` (`id`, `p_id`, `status`, `duration`, `start_time`, `end_time`, `remark`, `add_by`, `modify_by`, `ts`) VALUES (NULL, '$idrl', '0', '$duration', '$curdate', '$end_time', 'Auto Relist Product', '$rowrl[add_by]', '$rowrl[add_by]', CURRENT_TIMESTAMP);";
	mysql_query($sqlhrel);
		echo $i."->Product Relist: Product Id:".$idrl."<br>";
		
		if($rowrl['penny_auction']==1)
		{
			$sql_pa="select status,id from penny_auction where seller_id='$rowrl[add_by]' and p_id='$rowrl[p_cat_id]' and expire_status=1";
			$res_pa=mysql_query($sql_pa);
			$count_pa=mysql_num_rows($res_pa);
			if($count_pa>0)
			{
				$row_pa=mysql_fetch_assoc($res_pa);
				$update_pa="update penny_auction set status=1,expire_status=0,start_list_date='$curdate',end_list_date='$end_time' where id='$row_pa[id]'";
				//echo $update_pa.'<br>';
				mysql_query($update_pa);
				echo $i."->Auction Relist: Auction Id:".$row_pa['id']."<br>";
			}
		}
	}
	else
	{
		//echo $i."->Product Active: Product Id:".$id."<br>";
	}
	$i++;
}
// end auto relist code
?>