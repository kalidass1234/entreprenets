<?php 
class Commission
{
	function selectPackage($package_amnt)
	{
		$selectPackageAmnt = mysql_query("select cell_nom_35,ref_id,package_amount from registration where user_id='$package_amnt' ");
		$fetchPackageAmnt = mysql_fetch_array($selectPackageAmnt);
	}
	
	function boardMainTableOfRef($ref)
	{
		$selectBoardNoOfRef = "select * from board_main where user_id='$ref' AND board_status = '0'";
		$resultB = mysql_query($selectBoardNoOfRef);
		$fetchResultB=mysql_fetch_assoc($resultB);
		return $fetchResultB;
	}

	function boardMainTableOfUser($user_id,$package_amnt)
	{
		$selectBoardNoOfUserIds = "select board_no from board_main where 1 AND  package_id = '".$package_amnt."' AND user_id ='".$user_id."' AND board_status='0'";echo "<br>";
		$results = mysql_query($selectBoardNoOfUserIds);
		$fetchResults=mysql_fetch_array($results);
		return $fetchResults['board_no'];
	}
	
	function boardStatusTableOfUser($user_id)
	{
		$recordsArray = array();
		$selectCellNoOfUserId = "select * from board_status where user_id='$user_id'";
		$results = mysql_query($selectCellNoOfUserId);
		while($fetchResults=mysql_fetch_array($results))
		{
			$recordsArray[] = $fetchResults;
		}
		return $recordsArray;
	}

	function maxBoardNumber()
	{
		$selectBoardNoOfUserId = "select max(board_no) as maxboard from board_main where 1";
		$result = mysql_query($selectBoardNoOfUserId);
		$fetchResult=mysql_fetch_assoc($result);
		return $fetchResult['maxboard'];
	}

	function maxCellNumber($user_id,$package_amnt)
	{
		if($user_id!=0)
		{
			$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND (upper_id='".$user_id."') AND package_id = '".$package_amnt."'";

		}
		else
		{
			$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND (upper_id='".$user_id."' OR upper_id='0') AND package_id = '".$package_amnt."'";

		}

		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}
	
	function maxCellNumberA($user_id,$package_amnt)
	{

		$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND (upper_id='".$user_id."' OR upper_id='0') AND package_id = '".$package_amnt."' AND cell_status = '0'";

		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}

	function fetchBoard($user_id,$package_amnt)
	{
		$selectBoardNoOfUserId = "SELECT board_no FROM board_main WHERE 1 AND user_id='".$user_id."' AND package_id = '".$package_amnt."' AND board_status = '0'";
		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}
	
	function maxCellNumberAgain($user_id,$package_amnt,$board_number)
	{
		$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND cell_status = '0' AND (upper_id='".$user_id."' OR upper_id='0') AND package_id = '".$package_amnt."' AND board_number = '$board_number'";

		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}
	
	function makeBoard($user_id,$ref,$nom_id,$package_amnt)
	{
		// Fetch MAX BOARD NO From board_main Table
		$fetchResult = $this->maxBoardNumber();
		$boardNumbers = $fetchResult+1;

		// Fetch MAX(CELL NUMBER) From board_status Table
		$fetchMaxRR = $this->maxCellNumber($nom_id,$package_amnt);
		$maxCellRR = $fetchMaxRR['max_cell'];
		$newBoardNumber = $fetchMaxRR['boardN'];
			
		$current_date = date('Y-m-d');
		while($nom_id!='cmp')
		{
			// Fetch (BOARD NUMBER) From board_main Table

			if($ref!='cmp')
			{
				$countTotalsR =mysql_num_rows(mysql_query("SELECT * FROM board_main WHERE user_id='".$ref."' AND package_id ='$package_amnt' "));
			}
			if($countTotalsR == 0 && $ref!='cmp')
			{
				$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='$boardNumbers', board_date='', user_id='".$ref."', package_id ='$package_amnt'";
				
				$exeQryInsertBM = mysql_query($qryInsertBM);
			}
			
			$countTotals =mysql_num_rows(mysql_query("SELECT * FROM board_main WHERE user_id='".$user_id."' AND package_id ='$package_amnt'"));

			if($countTotals == 0)
			{
				$fetchResult = $this->maxBoardNumber();
				$boardNumbers = $fetchResult+1;
				$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='$boardNumbers', board_date='', user_id='".$user_id."', package_id ='$package_amnt'";
				
				$exeQryInsertBM = mysql_query($qryInsertBM);
			}

			$fetchMaxBoardRR = $this->boardMainTableOfUser($nom_id,$package_amnt);
		 	$fetchBoardRR = $fetchMaxBoardRR;

			if($ref != 'cmp')
			{
				$fetchMaxRRs = $this->fetchBoard($ref,$package_amnt);
				$newBoardNumbers = $fetchMaxRRs['board_no'];

				$countRef = mysql_num_rows(mysql_query("select * from board_status where 1 AND (upper_id='".$ref."' OR upper_id='0') AND board_number = '$newBoardNumbers' AND package_id = '$package_amnt' AND cell_status='0'"));
				
			}
			if($countRef==0 && $ref != 'cmp')
			{
				$qryInsertBS = "INSERT INTO board_status SET board_number='".$newBoardNumbers."', package_id ='$package_amnt', cell_no='1', board_owner_id='".$ref."', user_id='".$ref."',upper_id='0'"; 
				$exeQryInsertBS = mysql_query($qryInsertBS);
			}
				$fetchMaxRR = $this->maxCellNumber($nom_id,$package_amnt);
				$maxCellRR = $fetchMaxRR['max_cell'];
				
				$fetchMaxRR = $this->fetchBoard($nom_id,$package_amnt);
				$newBoardNumber = $fetchMaxRR['board_no'];
				
	 			$countMaxCellNoRef = mysql_num_rows(mysql_query("select * from board_status where 1 AND (upper_id='".$nom_id."' OR upper_id='0') AND board_number = '$newBoardNumber' AND package_id = '$package_amnt'"));

			if($countMaxCellNoRef>0)
			{
				if($nom_id!=0)
				{
					$fetchMaxRR = $this->maxCellNumber($nom_id,$package_amnt);
					$maxCellRR = $fetchMaxRR['max_cell'];
					
					$fetchMaxRR = $this->fetchBoard($nom_id,$package_amnt);
					$newBoardNumber = $fetchMaxRR['board_no'];
					
					$selectMaxCellNoRef = "select max(cell_no) as max_cell from board_status where 1 AND (upper_id='".$nom_id."' OR upper_id='0') AND board_number = '$newBoardNumber' AND package_id = '$package_amnt'";
					
					$resultMaxRef = mysql_query($selectMaxCellNoRef);
					$fetchMaxRef=mysql_fetch_assoc($resultMaxRef);
					$maxCellRef = $fetchMaxRef['max_cell'];
					$newCellNumber = $maxCellRef+1;

				}
				if($newCellNumber>13)
				{
					
					$fetchMaxRR = $this->maxCellNumberA($nom_id,$package_amnt);
					echo "sss".$newBoardNumber = $fetchMaxRR['boardN'];

					$fetchMaxRR = $this->maxCellNumberAgain($nom_id,$package_amnt,$newBoardNumber);
					$maxCellRR = $fetchMaxRR['max_cell'];

					if($maxCellRR!='')
					{
						$selectMaxCellNoRef = "select max(cell_no) as max_cell from board_status where 1 AND (upper_id='".$nom_id."' OR upper_id='0') AND board_number = '$newBoardNumber' AND package_id = '$package_amnt'";
						$resultMaxRef = mysql_query($selectMaxCellNoRef);
						$fetchMaxRef=mysql_fetch_assoc($resultMaxRef);
						$maxCellRef = $fetchMaxRef['max_cell'];
						$newCellNumber = $maxCellRef+1;
					}
					else
					{
						$newCellNumber = 1;
					}
				}
			}
			else
			{
				$newCellNumber = 1;
			}

			if($nom_id!='cmp' && $nom_id!=0)
			{
					$fetchMaxRR = $this->fetchBoard($nom_id,$package_amnt);
					$newBoardNumber = $fetchMaxRR['board_no'];
					$qryInsertBS = "INSERT INTO board_status SET board_number='".$newBoardNumber."', package_id ='$package_amnt', cell_no='".$newCellNumber."', board_owner_id='".$ref."', user_id='".$user_id."',upper_id='".$nom_id."'"; 
					$exeQryInsertBS = mysql_query($qryInsertBS);
			}
			else
			{
				break;
			}

			if($newCellNumber == 13)
			{
				$fetchResult = $this->maxBoardNumber();
				$boardNumbers = $fetchResult+1;
				$updateBoardMain = "UPDATE board_main SET board_status='1',board_date='$current_date' WHERE user_id='".$nom_id."' AND package_id ='$package_amnt'";
				$exeQryUpdateBM = mysql_query($updateBoardMain);
				
				$updateBoardMain = "UPDATE board_status SET cell_status = '1' WHERE 1 AND (upper_id='".$nom_id."' OR upper_id='0') AND package_id ='$package_amnt'";
				$exeQryUpdateBM = mysql_query($updateBoardMain);

				$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='$boardNumbers', board_date='', user_id='".$nom_id."', package_id ='$package_amnt'";
				$exeQryInsertBM = mysql_query($qryInsertBM);

				$updateMainRegis = "UPDATE registration SET cell_status_35 = '1' WHERE 1 AND  ref_id ='$ref'";
				$exeQryUpdateBM = mysql_query($updateMainRegis);
			}

			$selectNom = mysql_query("select cell_nom_35,cell_nom_70,nom_id_140,ref_id from registration where user_id='$nom_id' ");
			$fetchNom = mysql_fetch_array($selectNom);
	
			if($fetchNom['cell_nom_35']!='0' && $fetchNom['cell_nom_35']!='')
			{
				$nom_id=$fetchNom['cell_nom_35'];
			}
			else if($fetchNom['cell_nom_70']!='0' && $fetchNom['cell_nom_70']!='')
			{
				$nom_id=$fetchNom['cell_nom_70'];
			}
			else if($fetchNom['nom_id_140']!='0' && $fetchNom['nom_id_140']!='')
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

			$nom_id=$fetchNom['cell_nom_35'];
			$ref = $fetchNom['ref_id'];
		}

	}

	function matrixBonus($user_id)
	{
		$bonus = "1";
		/*------ Fetch Info of Registerd User START ------*/
		$sql="select * from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		
		$ref_id=$row['ref_id'];
		$pack_id = $row['package_id'];
		$cur_date = date('Y-m-d');
		$total_pv=$row['point_value'];
		$packageAmountUser = $row['package_amount'];
		$user_namePurchaser=$row['user_name'];
		/*------ Fetch Info of Registerd User END ------*/
		$invoice = invoice();
		/*------ Fetch PACKAGE Info of Registerd User START ------*/
		$selectLevels="SELECT package_name,first_level_comm,second_level_comm,total_price FROM package WHERE package_id='$pack_id'";
		$executeLevels = mysql_query($selectLevels);
		$fetchLevels = mysql_fetch_array($executeLevels);
		$packname = $fetchLevels['package_name'];
		$userPrice = $fetchLevels['total_price'];
		$first_level_comm = $fetchLevels['first_level_comm'];
		
		$second_level_comm = $fetchLevels['second_level_comm'];
		/*------ Fetch PACKAGE Info of Registerd User END ------*/

		$boardStatusTableOfUser = $this->boardStatusTableOfUser($user_id);
		foreach($boardStatusTableOfUser as $records)
		{
			$cNU = $records['cell_no'];
			$income_id = $records['upper_id'];

			$selectss="SELECT package_amount FROM registration WHERE user_id='$income_id'";
			$exeselectss = mysql_query($selectss);
			$fetchsele = mysql_fetch_array($exeselectss);
			$packageAmountNom = $fetchsele['package_amount'];

			if($cNU == '1' || $cNU == '2' || $cNU == '3' || $cNU == '4')
			{
				$i = 1;
				$first_level_comm= $first_level_comm - 5;
				$commission=$userPrice*$first_level_comm/100;
				if($packageAmountUser > $packageAmountNom)
				{
					$commission=$userPrice*5/100;
				}
				$sqlBoardMember = "select * from board_status where user_id='$user_id' AND upper_id='$income_id'";
				$resBoardMember = mysql_query($sqlBoardMember);
				$rowBoardMember = mysql_fetch_assoc($resBoardMember);
				$board_no = $rowBoardMember['board_number'];
				$Remark=" Get 3 X 2 Level Commission From Member $user_id and Board No. $board_no. ";
	
				$qryInsertLI = "INSERT INTO level_income SET income_id='".$income_id."', level='".$i."', commission='".$commission."', l_date='".$cur_date."', remark='".$Remark."', payout_date='', package='".$packname."', package_id='".$pack_id."', purchaser_id='".$user_id."',purchaser_uname='".$user_namePurchaser."', invoice='".$invoice."',bonus_name='".$bonus."',usdAmount = '".$usdAmount."'";
				$sqlInsetLevelIncome = mysql_query($qryInsertLI);
			}
			else if($cNU == '5' || $cNU == '6' || $cNU == '7' || $cNU == '8' || $cNU == '9' || $cNU == '10' || $cNU == '11' || $cNU == '12' || $cNU == '13')
			{
				$i = 2;
				$commission=$userPrice*$second_level_comm/100;
				if($packageAmountUser > $packageAmountNom)
				{
					$commission=$userPrice*3/100;
				}
				$sqlBoardMember = "select * from board_status where user_id='$user_id' AND upper_id='$income_id'";
				$resBoardMember = mysql_query($sqlBoardMember);
				$rowBoardMember = mysql_fetch_assoc($resBoardMember);
				$board_no = $rowBoardMember['board_number'];
				$Remark=" Get 3 X 2 Level Commission From Member $user_id and Board No. $board_no. ";
	
				$qryInsertLI = "INSERT INTO level_income SET income_id='".$income_id."', level='".$i."', commission='".$commission."', l_date='".$cur_date."', remark='".$Remark."', payout_date='', package='".$packname."', package_id='".$pack_id."', purchaser_id='".$user_id."',purchaser_uname='".$user_namePurchaser."', invoice='".$invoice."',bonus_name='".$bonus."',usdAmount = '".$usdAmount."'";
				$sqlInsetLevelIncome = mysql_query($qryInsertLI);
			}
		}

		/*------ Fetch Info of Registerd User END ------*/
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
