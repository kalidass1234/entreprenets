<?php 
class Commission
{
	function makeBoard($user_id,$ref,$nom_id,$package_amnt)
	{
		$selectPackageAmnt = mysql_query("select nom_id,ref_id,package_amount from registration where user_id='$user_id' ");
		$fetchPackageAmnt = mysql_fetch_array($selectPackageAmnt);
		$packageAmnt = $fetchPackageAmnt['package_amount'];  
		
		// Check Board Of Ref

		$selectBoardNoOfRef = "select * from board_main where user_id='$ref' AND board_status = '0'";
		$resultB = mysql_query($selectBoardNoOfRef);
		$fetchResultB=mysql_fetch_assoc($resultB);
		$boardNumberOfRef = $fetchResultB['board_no'];

		// Fetch Data From board_main Table
		$selectBoardNoOfUserId = "select * from board_main where user_id='$user_id'";
		$result = mysql_query($selectBoardNoOfUserId);
		$fetchResult=mysql_fetch_assoc($result);
		$boardNumber = $fetchResult['board_no'];
		$boardStatus = $fetchResult['board_status'];
		$boardDate = $fetchResult['board_date'];

		// Fetch MAX(CELL NUMBER) From board_status Table
		$selectMaxCellNo = "select max(cell_no) as max_cell,board_owner_id from board_status where 1";
		$resultMax = mysql_query($selectMaxCellNo);
		$fetchMax=mysql_fetch_assoc($resultMax);
		$boardOwnerId = $fetchMax['board_owner_id'];

		// Fetch Data From board_status Table
		$selectCellNoOfUserId = "select * from board_status where board_owner_id='$boardOwnerId'";
		$results = mysql_query($selectCellNoOfUserId);
		$fetchResults=mysql_fetch_assoc($results);
		$boardNumberCell = $fetchResults['board_number'];
		$cellNo = $fetchResults['cell_no'];
		$userIdPerCell = $fetchResults['user_id'];
		$boardOwnerId = $fetchResults['board_owner_id'];

		if($board_no!='')
		{
			//$qryInsert = "INSERT INTO board_main SET board_status='0', board_no='1', board_date='', user_id='".$user_id."'";
		}
		else
		{
			// Fetch MAX(Cell Number) From board_status Table
			
			$selectMaxCellNoR = "select max(cell_no) as max_cell,board_owner_id from board_status where 1 AND board_owner_id='".$boardOwnerId."' AND package_id = '".$package_amnt."'";
			$resultMaxR = mysql_query($selectMaxCellNoR);
			$fetchMaxR = mysql_fetch_assoc($resultMaxR);
			$maxCellR = $fetchMaxR['max_cell'];

			if($maxCellR == 13 || $maxCellR == 26 || $maxCellR == 39 || $maxCellR == 52 || $maxCellR == 65 || $maxCellR == 78 || $maxCellR == 91)
			{
				// Fetch MAX(BOARD NUMBER) From board_main Table

				$selectMaxBoardNo = "select max(board_no) as max_board_no from board_main where 1 AND user_id='$ref' AND package_id ='$package_amnt' ";
				$resultMaxBoard = mysql_query($selectMaxBoardNo);
				$fetchMaxBoard=mysql_fetch_assoc($resultMaxBoard);
				$maxBoard = $fetchMaxBoard['max_board_no'];
				if($maxBoard!='')
				{
					$newBoardNumberr = $maxBoard+1;
				}

				$selectMaxBoardNoU = "select max(board_no) as max_board_no from board_main where 1 AND user_id='$user_id' AND package_id ='$package_amnt' ";
				$resultMaxBoardU = mysql_query($selectMaxBoardNoU);
				$fetchMaxBoardU =mysql_fetch_assoc($resultMaxBoardU);
				$maxBoardU = $fetchMaxBoardU['max_board_no'];
				//echo "<br>";
				if($maxBoardU!='')
				{
					$newBoardNumber = $maxBoardU+1;
				}
				else
				{
					$newBoardNumber = 1;	
				}

				if($maxBoard=='1')
				{
					$qryInsertBM = "UPDATE board_main SET board_no='".$newBoardNumberr."' WHERE user_id='".$ref."'";
					$exeQryInsertBM = mysql_query($qryInsertBM);
				}
				if($maxBoardU=='')
				{
					$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='".$newBoardNumber."', board_date='', user_id='".$user_id."', package_id ='$package_amnt'";
					$exeQryInsertBM = mysql_query($qryInsertBM);
				}

			}
			else
			{
				// Fetch MAX(BOARD NUMBER) From board_main Table
				
				$selectMaxBoardNo = "select max(board_no) as max_board_no from board_main where 1 AND user_id='$user_id' AND package_id ='$package_amnt' ";
				$resultMaxBoard = mysql_query($selectMaxBoardNo);
				$fetchMaxBoard=mysql_fetch_assoc($resultMaxBoard);
				$maxBoard = $fetchMaxBoard['max_board_no'];
				
				if($maxBoard!='')
				{
					$newBoardNumber = $maxBoard+1;
				}
				else
				{
					$newBoardNumber = 1;	
				}
				
				$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='".$newBoardNumber."', board_date='', user_id='".$user_id."', package_id ='$package_amnt'";
				$exeQryInsertBM = mysql_query($qryInsertBM);
				$newCellNumber = $maxCell+1;
			}

			while($nom_id!='cmp')
			{

				// Fetch MAX(BOARD NUMBER) From board_main Table
				$selectMaxBoardNoRR = "select max(board_no) as max_bo from board_main where 1 AND user_id='".$nom_id."' AND package_id = '".$package_amnt."'";
				$resultMaxBoardRR = mysql_query($selectMaxBoardNoRR);
				$fetchMaxBoardRR = mysql_fetch_assoc($resultMaxBoardRR);
				$fetchBoardRR = $fetchMaxBoardRR['max_bo'];
				if($fetchBoardRR=='')
				{
					$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='1', board_date='', user_id='".$nom_id."', package_id ='$package_amnt'";
					$exeQryInsertBM = mysql_query($qryInsertBM);

					$selectMaxBoardNoRR = "select max(board_no) as max_bo from board_main where 1 AND user_id='".$nom_id."' AND package_id = '".$package_amnt."'";
					$resultMaxBoardRR = mysql_query($selectMaxBoardNoRR);
					$fetchMaxBoardRR = mysql_fetch_assoc($resultMaxBoardRR);
					$fetchBoardRR = $fetchMaxBoardRR['max_bo'];
				}

				// Fetch MAX(CELL NUMBER) From board_status Table
				$selectMaxCellNoRR = "select max(cell_no) as max_cell,board_owner_id from board_status where 1 AND board_owner_id='".$nom_id."' AND board_number = '$newBoardNumber' AND package_id = '".$package_amnt."'";
				$resultMaxRR = mysql_query($selectMaxCellNoRR);
				$fetchMaxRR = mysql_fetch_assoc($resultMaxRR);
				$maxCellRR = $fetchMaxRR['max_cell'];
	
				$countMaxCellNoRef = mysql_num_rows(mysql_query("select * from board_status where 1 AND upper_id='".$nom_id."' AND board_number = '$newBoardNumber' AND package_id = '$package_amnt'"));
				if($countMaxCellNoRef>0)
				{
					$selectMaxCellNoRef = "select max(cell_no) as max_cell from board_status where 1 AND upper_id='".$nom_id."' AND board_number = '$newBoardNumber' AND package_id = '$package_amnt'";
					$resultMaxRef = mysql_query($selectMaxCellNoRef);
					$fetchMaxRef=mysql_fetch_assoc($resultMaxRef);
					$maxCellRef = $fetchMaxRef['max_cell'];
					$newCellNumber = $maxCellRef+1;
				}
				else
				{
					$newCellNumber = 1;
				}


				// Check Board Of Ref
				/*$selectBoardNoOfRef = "select * from board_main where user_id='$ref' AND board_status = '0'";
				$resultB = mysql_query($selectBoardNoOfRef);
				$fetchResultB=mysql_fetch_assoc($resultB);
				$boardNumberOfRef = $fetchResultB['board_no'];*/

				if($nom_id!='cmp' && $nom_id!=0)
				{
					$qryInsertBS = "INSERT INTO board_status SET board_number='".$fetchBoardRR."', package_id ='$packageAmnt', cell_no='".$newCellNumber."', board_owner_id='".$ref."', user_id='".$user_id."',upper_id='".$nom_id."'";
					
					$exeQryInsertBS = mysql_query($qryInsertBS);
				}
				else
				{
					break;
				}

				$selectNom = mysql_query("select nom_id,nom_id_70,nom_id_140,ref_id from registration where user_id='$nom_id' ");
				$fetchNom = mysql_fetch_array($selectNom);


				if($fetchNom['nom_id']!='0' && $fetchNom['nom_id']!='')
				{
					$nom_id=$fetchNom['nom_id'];
				}
				else if($fetchNom['nom_id_70']!='0' && $fetchNom['nom_id_70']!='')
				{
					$nom_id=$fetchNom['nom_id_70'];
				}
				else if($fetchNom['nom_id_140']!='0' && $fetchNom['nom_id_70']!='')
				{
					$nom_id=$fetchNom['nom_id_140'];
				}	
				else if($fetchNom['nom_id_35_70']!='0' && $fetchNom['nom_id_35_70']!='')
				{
					$nom_id=$fetchNom['nom_id_35_70'];
				}	
				else if($fetchNom['nom_id_70_140']!='0' && $fetchNom['nom_id_70_140']!='')
				{
					$nom_id=$fetchNom['nom_id_70_140'];
				}	
			
				$ref = $fetchNom['ref_id'];

			}

		}

	}

	function matrixBonus($user_id)
	{
		$Remark=" Get 3 X 2 Matrix Commission From Member $user_id";
		$bonus = "1";
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		if($row['nom_id']!='0' && $row['nom_id']!='')
		{
			$nom_id=$row['nom_id'];
		}
		else if($row['nom_id_70']!='0' && $row['nom_id_70']!='')
		{
			$nom_id=$row['nom_id_70'];
		}
		else if($row['nom_id_140']!='0' && $row['nom_id_70']!='')
		{
			$nom_id=$row['nom_id_140'];
		}		
		else if($row['nom_id_35_70']!='0' && $row['nom_id_35_70']!='')
		{
			$nom_id=$row['nom_id_35_70'];
		}	
		else if($row['nom_id_70_140']!='0' && $row['nom_id_70_140']!='')
		{
			$nom_id=$row['nom_id_70_140'];
		}

		$ref_id=$row['ref_id'];
		$pack_id = $row['package_id'];
		$cur_date = date('Y-m-d');
		$total_pv=$row['point_value'];
		$packageAmountUser = $row['package_amount'];
		$user_namePurchaser=$row['user_name'];

		// find Level For Users ACCORDIN TO PACKAGE
		$selectLevels="SELECT package_name FROM package WHERE package_id='$pack_id'";
		$executeLevels = mysql_query($selectLevels);
		$fetchLevels = mysql_fetch_array($executeLevels);
		$packname = $fetchLevels['package_name'];
		
		$totalLevel_max = 2;
		$invoice = invoice();

		$i=1;
		while($nom_id !='cmp')
		{
			$selectNomId = "select * from registration where user_id='$nom_id'";
			$resNomId=mysql_query($selectNomId);
			$rowNomId=mysql_fetch_assoc($resNomId);
			
			if($rowNomId['nom_id']!='0' && $rowNomId['nom_id']!='')
			{
				$nom_id=$rowNomId['nom_id'];
			}
			else if($rowNomId['nom_id_70']!='0' && $rowNomId['nom_id_70']!='')
			{
				$nom_id=$rowNomId['nom_id_70'];
			}
			else if($rowNomId['nom_id_140']!='0' && $rowNomId['nom_id_70']!='')
			{
				$nom_id=$rowNomId['nom_id_140'];
			}	
			
			$packageAmountNom = $rowNomId['package_amount'];

			$com_id = $rowNomId['user_id'];
			$income_id=$com_id;
			//$pack_id=$rowNomId['package_id'];
			// get the income_id level
			$selectLevels="SELECT package_name,first_level_comm,second_level_comm,total_price FROM package WHERE package_id='$pack_id'";
			
			$executeLevels = mysql_query($selectLevels);
			$fetchLevels = mysql_fetch_array($executeLevels);
			$packname = $fetchLevels['package_name'];
			$userPrice = $fetchLevels['total_price'];

			$first_level_comm = $fetchLevels['first_level_comm'];

			$second_level_comm = $fetchLevels['second_level_comm'];
			// find total level wise commission per

			if($i==1)
			{
				$first_level_comm= $first_level_comm - 5;
				
				$commission=$userPrice*$first_level_comm/100;
				if($packageAmountUser > $packageAmountNom)
				{
					$commission=$userPrice*5/100;
				}
			}
			else if($i==2)
			{
				$commission=$userPrice*$second_level_comm/100;
				if($packageAmountUser > $packageAmountNom)
				{
					$commission=$userPrice*3/100;
				}
			}

			/*................
			// 1PV = .1USD
			*/
			$usdAmount = $commission;
			
			/*................*/
			// INSERT INFORMATION INTO LEVEL-INCOME TABLE

			if($com_id!='cmp' && $com_id!='')
			{
				if($i<=$totalLevel_max)
				{
					 $qryInsertLI = "INSERT INTO level_income SET income_id='".$income_id."', level='".$i."', commission='".$commission."', l_date='".$cur_date."', remark='".$Remark."', payout_date='', package='".$packname."', package_id='".$pack_id."', purchaser_id='".$user_id."',purchaser_uname='".$user_namePurchaser."', invoice='".$invoice."',bonus_name='".$bonus."',usdAmount = '".$usdAmount."'";
					
					$sqlInsetLevelIncome = mysql_query($qryInsertLI);
					$Commission = new Commission();
					//$Commission->update_pv($income_id,$commission,$user_id,$bonus);
				}
			}
			if($i == $totalLevel_max)
			{
				break;	
			}
			$i++;
		}

	}
	
	function level_count_nom($crid,$tpid)
	{ 
		global $a1;
		$query1="select * from registration where user_id='$crid'";
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
			$this->level_count_nom($rclid1,$tpid);$a1++;
		}
		else
		{
			$a1=1;
		}
		return $a1;
	}

	function shoDwnMem($dwnid,$tid)
	{
		global $data_dwn,$lel;
		$quer="select user_id,nom_id,ref_id,user_name,reg_date from registration where ref_id='$dwnid' and nom_id!='' AND package = 'Diamond' order by id asc ";
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
		$quer3="select user_id,nom_id,ref_id,user_name,reg_date from registration where ref_id='$dwnid' and nom_id!='' AND package = 'Diamond' order by id asc ";
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
		$quer="select user_id,nom_id,ref_id,user_name,reg_date from registration where ref_id='$sponsorId' AND package = 'Diamond'";
		$data=mysql_query($quer);
		$count=mysql_num_rows($data);
		return $count;
	}

	
	
	function showDirectUserOfThisRefForCoded($sponsorId)
	{
		$quer="select user_id,nom_id,ref_id,user_name,reg_date from registration where ref_id='$sponsorId'";
		$data=mysql_query($quer);
		$count=mysql_num_rows($data);
		return $count;
	}
	

}

$Commission = new Commission();
?>
