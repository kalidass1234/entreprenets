<?php 
class Commission
{
	function invoice()
	{
	  $encypt1=uniqid(rand(1000000000,9999999999), true);
	  $usid1=str_replace(".", "", $encypt1);
	  $pre_userid = substr($usid1, 0, 10);
	  
	  $checkid=mysql_query("select invoice from subscribe where invoice='$pre_userid'");
	  if(mysql_num_rows($checkid)>0)
	  {
		invoice();
	  }
	  else
	  {
		return $pre_userid;
	  }
	}
	/*function level_count_refForLeft($sponserid,$posi)
	{
		global $nom_id;
		$query1="select * from registration where ref_id='$sponserid' and binary_pos='$posi' AND status_commission='0'";
		$result1=mysql_query($query1);
		$row=mysql_fetch_array($result1);
		$rclid1=$row['user_id'];

		$i=mysql_num_rows($result1);
		 
		return $i;
	
	}
	
	function findRefLeftRightDownlinesUserId($ref_id,$binaryPos)
	{
		$leftRightUserId = array();
		$query1="select * from registration where ref_id='$ref_id' and binary_pos='$binaryPos' AND status_commission='0'";
		$result1=mysql_query($query1);
		while($row=mysql_fetch_array($result1))
		{
			$leftRightUserId[]=$row['user_id'];
		}
		return $leftRightUserId;
	}*/
	
	/*function countNomTotal($user_id)
	{
		$nomArray = array();
		while($nom_id !="cmp")
		{
			$selectNomId = "select nom_id from registration where user_id='$user_id'";
			$resNomId=mysql_query($selectNomId);
			$rowNomId=mysql_fetch_assoc($resNomId);

			if($rowNomId['nom_id'] !='cmp')
			{
				$nom_id = $rowNomId['nom_id'];
				$user_id = $rowNomId['nom_id'];
				array_push($nomArray,$nom_id);
			}
			else
			{
				break;	
			}
		}
		return $nomArray;
	}

	function countNomTotals($nom_id)
	{
		$nomArray = array();
		$nomArray[] = $nom_id;
		while($nom_id !="cmp")
		{
			$selectNomId = "select * from registration where nom_id='$nom_id'";
			$resNomId=mysql_query($selectNomId);
			$rowNomId=mysql_fetch_assoc($resNomId);
			if($rowNomId['nom_id'] !='cmp')
			{
				$nom_id = $rowNomId['nom_id'];
				array_push($nomArray,$nom_id);
			}
			else
			{
				break;	
			}
		}
		return $nomArray;
	}
	
	function countNomTotalLeftRightMemDetails($user_id,$binaryPos)
	{
		//echo $user_id;
		$useridArray = array();
		//$useridArray[] = $user_id;
		while($user_id !="")
		{
			$selectNomId = "select * from registration where nom_id='$user_id' AND binary_pos = '".$binaryPos."'";
			$resNomId=mysql_query($selectNomId);
			$rowNomId=mysql_fetch_assoc($resNomId);
			if($rowNomId['user_id'] !='')
			{
				$user_id = $rowNomId['user_id'];
				array_push($useridArray,$user_id);
			}
			else
			{
				break;	
			}
		}
		//print_r($useridArray);
		return $useridArray;
	}
	
	function findPositionAccordingToNom($nom_id,$user_id)
	{
			$selectnompos=mysql_query("select binary_pos from registration where user_id='$nom' ");
			$fetchnompos=mysql_fetch_array($selectnompos);
			$pos=$fetchnompos['binary_pos'];
	}
*/
	/*function countNomTotalLeftRight($user_id,$binaryPos)
	{
		//echo $user_id;
		$useridArray = array();
		//$useridArray[] = $user_id;
		while($user_id !="")
		{
			$selectNomId = "select * from registration where nom_id='$user_id' AND binary_pos = '".$binaryPos."' AND status_commission='0'";
			$resNomId=mysql_query($selectNomId);
			$rowNomId=mysql_fetch_assoc($resNomId);
			if($rowNomId['user_id'] !='')
			{
				$user_id = $rowNomId['user_id'];
				array_push($useridArray,$user_id);
			}
			else
			{
				break;	
			}
		}
		//print_r($useridArray);
		return $useridArray;
	}
*/
	function binaryPairBonus($user_id)
	{
		$sql="select nom_id,ref_id,binary_pos,package_id from registration where (user_id='$user_id' OR user_name ='$user_id')";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		$nom_id=$row['nom_id'];
		$ref_id=$row['ref_id'];
		$binaryPos=$row['binary_pos'];
		$pack_id = $row['package_id'];
		$cur_date = date('Y-m-d');
		$invoice = $this->invoice();

// Find Package Information of Registerd User

		$selectPackageInfoOfRegisterdUser="SELECT package_name,total_price,subs_commission,binary_type2,matching_commission,binary_commission FROM package WHERE package_id='$pack_id'";
		$executePackageInfoOfRegisterdUser = mysql_query($selectPackageInfoOfRegisterdUser);
		$fetchPackageInfoOfRegisterdUser = mysql_fetch_array($executePackageInfoOfRegisterdUser);
		$packageName = $fetchPackageInfoOfRegisterdUser['package_name'];
		$totalPrice = $fetchPackageInfoOfRegisterdUser['total_price'];
		$binary_type2 = $fetchPackageInfoOfRegisterdUser['binary_type2'];
		$subs_commission = $fetchPackageInfoOfRegisterdUser['subs_commission'];
		$matching_commission = $fetchPackageInfoOfRegisterdUser['matching_commission'];
		$binary_commission = $fetchPackageInfoOfRegisterdUser['binary_commission'];

		$sqls="select user_id from registration where (user_id ='$user_id' OR user_name ='$user_id')";
		$ress=mysql_query($sqls);
		$rowa=mysql_fetch_assoc($ress);

// Insert Binary Pair Level Commission

		//$countNomTotal = $this->countNomTotal($user_id);
		$countNomTotals = count($countNomTotal);

		foreach($countNomTotal as $records)
		{
			// Find Total Left and Right Downline (REF) Count of Sponsor
			
			$leftDownLineCount = $this->countNomTotalLeftRight($records,'left');
			$countLeftDownLine = count($leftDownLineCount);
			$rightDownLineCount = $this->countNomTotalLeftRight($records,'right');
			$countRightDownLine = count($rightDownLineCount);

			$Remark=" Get Binary Pair Commission From Member $user_id";
			$bonus = "1";


			$qryInsertLI = "INSERT INTO level_income SET income_id='".$records."', l_date='".$cur_date."', remark='".$Remark."', package='".$packageName."', package_id='".$pack_id."', purchaser_uname='".$user_id."',binaryPosition = '".$binaryPos."', purchaser_id='".$rowa['user_id']."', invoice='".$invoice."',bonus_name='".$bonus."'";
			$sqlInsetLevelIncome = mysql_query($qryInsertLI);
				
			$selectnompos=mysql_query("select binary_pos from registration where user_id='$records' ");
			$fetchnompos=mysql_fetch_array($selectnompos);
			$binaryPos=$fetchnompos['binary_pos'];
// Find Total USER ID of Left and Right Downline (REF) of Sponsor

		}
			if($ref_id!='cmp')
			{
				$Remark=" Get Sponsorship Commission From Member $user_id";
				$bonus = "3";

				$commission = $totalPrice * $subs_commission/100;

					$adminPercent = 5;
					$adminAmount = $commission *$adminPercent/100;
					
					$trustPercent = 5;
					$trustAmount = $commission *$trustPercent/100;
					
					$tdsPercent = 10;
					$tdsAmount = $commission *$tdsPercent/100;
					
					$finalAmount = $commission - ($adminAmount+$trustAmount+$tdsAmount);
					
					$qryInsertLI = "INSERT INTO binary_income SET income_id='".$ref_id."',admin_amount='".$adminAmount."',trust_amount='".$trustAmount."',tds_amount='".$tdsAmount."', commission='".$commission."', b_date='".$cur_date."', remark='".$Remark."', package_id='".$pack_id."', purchaser_id='".$rowa['user_id']."',bonus_name='".$bonus."',final_amount = '".$finalAmount."'";
				$sqlInsetLevelIncome = mysql_query($qryInsertLI);
				
					$sqlamount="select amount from final_e_wallet where (user_id='$ref_id')";
					$resamount=mysql_query($sqlamount);
					$rows=mysql_fetch_assoc($resamount);
					$rows['amount'];
					$fa = $rows['amount']+$finalAmount;
			
					$updateFinalEwallet = mysql_query("UPDATE final_e_wallet SET amount='$fa' where (user_id='$ref_id') ");
					$updateCreditDebit = mysql_query("INSERT INTO credit_debit SET user_id = '".$ref_id."',credit_amt='$finalAmount',receiver_id='".$ref_id."', receiver_date='".$cur_date."', Remark='Sponsership Pair Bonus'");
			
			}

	}

	/*function level_count_nomForLeft($crid,$tpid)
	{ 
		global $a1;
		//$crid = '12345';
		$query1="select * from registration where user_id='$crid'";
		//exit();
		$result1=mysql_query($query1);
		$row=mysql_fetch_array($result1);
		$rclid1=$row['nom_id'];
		$a1=1;
		
		if($rclid1!=$tpid)
		{
			if($rclid1=='cmp')
			{
				return "hi";
			}
			$this->level_count_nomForLeft($rclid1,$tpid);
			$a1++;
		}
		else
		{
			$a1=1;
		}
		return $a1;
	}*/

	/*function shoDwnMem($dwnid,$tid)
	{
		global $data_dwn,$lel;
		$quer="select user_id,nom_id,ref_id,user_name,reg_date from registration where nom_id='$dwnid' and nom_id!='' order by id asc ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			$data_dwn=$this->showMemX($user2,$tid);
		}
		return $data_dwn;
	}
	function showMemX($dwnid,$tid)
	{
		global $data_dwn,$lel;
		$quer3="select user_id,nom_id,ref_id,user_name,reg_date from registration where nom_id='$dwnid' and nom_id!='' order by id asc ";
		$data3=mysql_query($quer3);
		while($arr2=mysql_fetch_array($data3))
		{
			$idx=$arr2['user_id'];
			$data_dwn[]=$arr2['user_id'];
			$levv=$this->level_count_nom($idx,$tid);
			$lel[]=$levv;
			$this->showMemX($idx,$tid);
		}
		return $data_dwn;
	}

	function showDirectUserOfThisRef($sponsorId)
	{
		$quer="select user_id,nom_id,ref_id,user_name,reg_date from registration where ref_id='$sponsorId'";
		$data=mysql_query($quer);
		$count=mysql_num_rows($data);
		return $count;
	}*/

}

$Commission = new Commission();
?>
