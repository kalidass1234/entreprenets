<?php 
require_once "commissionFunc.php";

	function makeBoard($user_id,$ref,$nom_id,$package_amnt)
	{
		// Fetch MAX BOARD NO From board_main Table
		$fetchResult = maxBoardNumber($user_id);
		$boardNumbers = $fetchResult+1;
		$fetchResult = maxBoardNumber($ref);
		$boardNumbersR = $fetchResult+1;

		$current_date = date('Y-m-d');
		$i=1;
		while($nom_id!='cmp')
     	{
			// Fetch (BOARD NUMBER) From board_main Table
			if($ref!='cmp')
			{


				$countTotalsR =mysql_num_rows(mysql_query("SELECT * FROM board_main WHERE user_id='".$ref."' AND package_id ='$package_amnt' "));
				if($countTotalsR == 0 && $ref!='cmp')
				{
					
					$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='$boardNumbersR', board_date='0000-00-00', user_id='".$ref."', package_id ='$package_amnt'";
					$exeQryInsertBM = mysql_query($qryInsertBM);
				}
			}

			$countTotals =mysql_num_rows(mysql_query("SELECT * FROM board_main WHERE user_id='".$user_id."' AND package_id ='$package_amnt'"));

			if($countTotals == 0)
			{

				
				$fetchResult = maxBoardNumber();
				$boardNumbers = $fetchResult+1;
				$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='$boardNumbers', board_date='0000-00-00', user_id='".$user_id."', package_id ='$package_amnt'";
				$exeQryInsertBM = mysql_query($qryInsertBM);
			}

			$fetchMaxBoardRR = boardMainTableOfUser($nom_id,$package_amnt);
		 	$fetchBoardRR = $fetchMaxBoardRR;

			if($ref != 'cmp')
			{

				
				$fetchMaxRRs = fetchBoard($ref,$package_amnt);
				$newBoardNumbers = $fetchMaxRRs['board_no'];


                 echo "boardno".$fetchMaxRRs['board_no']; 




				$countRef = @mysql_num_rows(mysql_query("select * from board_status where 1 AND (upper_id='".$ref."' OR upper_id='0') AND board_number = '$newBoardNumbers' AND package_id = '$package_amnt' AND cell_status='0'"));

				if($countRef==0 && $ref != 'cmp')
				{

					echo "hai3";
					$queryMaxStage="select MAX(circle) as boardn from board_status where user_id = '$ref' and package_id = '$package_amnt' ";
					$resMaxStage = mysql_query($queryMaxStage);
					$satgeS = mysql_fetch_array($resMaxStage);
					$stage = $satgeS['boardn'];



					
					if($stage == '')
					{
						$stage = 1;	
					}
					else
					{
						$stage = $stage+1;	
					}


					echo "newBoardNumbers".$newBoardNumbers;

					echo "board_owner".$ref;



					$qryInsertBS = "INSERT INTO board_status SET board_number='".$newBoardNumbers."', package_id ='$package_amnt', cell_no='1', board_owner_id='".$ref."', user_id='".$ref."',upper_id='0', circle='$stage'"; 
					$exeQryInsertBS = mysql_query($qryInsertBS);

					echo $exeQryInsertBS;



				}
			}

        

			$maxCellNumber = maxCellNumberA($nom_id,$package_amnt);
			$maxCellRR = $maxCellNumber['max_cell'];
			$newCellNumber = $maxCellRR + 1;

			if($newCellNumber>13)
			{
				$fetchMaxRR = fetchBoard($nom_id,$package_amnt);
				$newBoardNumber = $fetchMaxRR['board_no'];

				$maxCellNumber = maxCellNumberA($nom_id,$package_amnt);
				$maxCellRR = $maxCellNumber['max_cell'];

				if($maxCellRR==14)
				{
					$newCellNumber = 2;
				}
			}
			else
			{
				$fetchMaxRR = fetchBoard($nom_id,$package_amnt);
				$newBoardNumber = $fetchMaxRR['board_no'];
				$maxCellNumber = maxCellNumber($nom_id,$package_amnt);
				$maxCellNumber = $maxCellNumber['max_cell'];
				$newCellNumber = $maxCellNumber+1;
				if($newCellNumber==14)	
				{
					$newCellNumber = 2;
				}
			}
			
			if($nom_id!='cmp' && $nom_id!=0  && $ref!='cmp')
			{
				$qryInsertBS = "INSERT INTO board_status SET board_number='".$newBoardNumber."', package_id ='$package_amnt', cell_no='".$newCellNumber."', board_owner_id='".$ref."', user_id='".$user_id."',upper_id='".$nom_id."',level ='$i'"; 
				
				$exeQryInsertBS = mysql_query($qryInsertBS);
			}
			else
			{
				break;
			}



			if($newCellNumber == 13)
			{
				$fetchResult = maxBoardNumber();
				$boardNumbers = $fetchResult+1;
				$updateBoardMain = "UPDATE board_main SET board_status='1',board_date='$current_date' WHERE user_id='".$nom_id."' AND package_id ='$package_amnt'";
				$exeQryUpdateBM = mysql_query($updateBoardMain);
				
				$updateBoardMain = "UPDATE board_status SET cell_status_bmc1 = '1' WHERE 1 AND (upper_id='".$nom_id."' OR upper_id='0') AND package_id ='$package_amnt'";
				$exeQryUpdateBM = mysql_query($updateBoardMain);

				$qryInsertBM = "INSERT INTO board_main SET board_status='0', board_no='$boardNumbers', board_date='0000-00-00', user_id='".$nom_id."', package_id ='$package_amnt'";
				$exeQryInsertBM = mysql_query($qryInsertBM);

				$updateMainRegis = "UPDATE registration SET cell_status_bmc1 = '1' WHERE 1 AND  ref_id ='$ref'";
				$exeQryUpdateBM = mysql_query($updateMainRegis);
			}

			$selectNom = mysql_query("select nom_id,nom_bmc2,nom_bmc3,ref_id from registration where user_id='$nom_id'");
			$fetchNom = mysql_fetch_array($selectNom);

			if($fetchNom['nom_id']!='0' && $fetchNom['nom_id']!='' && $ref!='cmp')
			{
				$nom_id=$fetchNom['nom_id'];
			}
			else if($fetchNom['nom_bmc2']!='0' && $fetchNom['nom_bmc2']!='' && $ref!='cmp')
			{
				$nom_id=$fetchNom['nom_bmc2'];
			}
			else if($fetchNom['nom_bmc3']!='0' && $fetchNom['nom_bmc3']!='' && $ref!='cmp')
			{
				$nom_id=$fetchNom['nom_bmc3'];
			}
			else
			{
				break;	
			}

			$ref = $fetchNom['ref_id'];
			$i++;
		}
		
	}

	function countNomTotal($user_id)
	{
		$nomArray = array();
		$selectNomIds = "select nom_bmc2,nom_id,nom_bmc3 from registration where (user_name='$user_id' OR user_id='$user_id')";

		$resNomIds=mysql_query($selectNomIds);
		$rowNomIds=mysql_fetch_assoc($resNomIds);
		
		if($rowNomIds['nom_id']!='')
		{
			$nom_bmc2 = $rowNomIds['nom_id'];	
		}
		else if($rowNomIds['nom_bmc2']!='0')
		{
			$nom_bmc2 = $rowNomIds['nom_bmc2'];	
		}
		else
		{
			$nom_bmc2 = $rowNomIds['nom_bmc3'];
		}
		$nomArray[] = $nom_bmc2;
		while($nom_bmc2 !="cmp")
		{
			$selectNomId = "select nom_bmc2,nom_id,nom_bmc3 from registration where user_id='$nom_bmc2'";
			$resNomId=mysql_query($selectNomId);
			$rowNomId=mysql_fetch_assoc($resNomId);

			if(($rowNomId['nom_bmc2'] !='cmp' && $rowNomId['nom_bmc2'] !=0) || ($rowNomId['nom_id'] !='cmp' && $rowNomId['nom_id'] !=0)  || ($rowNomId['nom_bmc3'] !='cmp' && $rowNomId['nom_bmc3'] !=0))
			{
				if($rowNomId['nom_id']!='')
				{
					$nom_bmc2 = $rowNomId['nom_id'];	
				}
				else if($rowNomId['nom_bmc2']!='0')
				{
					$nom_bmc2 = $rowNomId['nom_bmc2'];	
				}
				else
				{
					$nom_bmc2 = $rowNomId['nom_bmc3'];	
				}
				array_push($nomArray,$nom_bmc2);
			}
			else
			{
				break;	
			}
		}
		return $nomArray;
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
                $usdAmount = 0;
		$countNomTotal = countNomTotal($user_id);
		$i=1;
		foreach($countNomTotal as $records)
		{
			//$cNU = $records['cell_no'];
			$income_id = $records;

			$selectss="SELECT package_amount FROM registration WHERE user_id='$income_id'";
			$exeselectss = mysql_query($selectss);
			$fetchsele = mysql_fetch_array($exeselectss);
			$packageAmountNom = $fetchsele['package_amount'];

			if($i <3)
			{
				if($i==1)
				{
					$first_level_comm= $first_level_comm ;
					$userPrice = $userPrice - 5;
					$commission=$userPrice*$first_level_comm/100;

					$Remark=" Get 3 X 2 Level Commission From Member $user_id and Board No. $board_no. ";
					$qryInsertLI = "INSERT INTO level_income SET income_id='".$income_id."', level='".$i."', commission='".$commission."', l_date='".$cur_date."', remark='".$Remark."', payout_date='0000-00-00', package='".$packname."', package_id='".$pack_id."', purchaser_id='".$user_id."',purchaser_uname='".$user_namePurchaser."', invoice='".$invoice."',bonus_name='".$bonus."',usdAmount = '".$usdAmount."'";
					$sqlInsetLevelIncome = mysql_query($qryInsertLI) or die("Error: ".$qryInsertLI.mysql_error());

					$selectLevelCount = mysql_num_rows(mysql_query("SELECT * FROM board_status WHERE upper_id='$income_id' AND package_id='$packageAmountNom' AND level='1'"));

					if($selectLevelCount == 3)
					{
						//$selectLevelCounts = mysql_num_rows(mysql_query("SELECT * FROM bonus_income WHERE income_id='$income_id' AND level='1'"));
						//if($selectLevelCounts == 0)
						//{
							$RemarkS=" Get 1 Level Completion Bonus ";
							$commissions = $commission*3;
							$qryInsertLI = "INSERT INTO bonus_income SET income_id='".$income_id."', level='".$i."', commission='".$commissions."', l_date='".$cur_date."', remark='".$RemarkS."', payout_date='0000-00-00', invoice='".$invoice."'";
							$sqlInsetLevelIncome = mysql_query($qryInsertLI);
						//}
					}
				}
				else if($i==2)
				{
					$commission=$userPrice*$second_level_comm/100;

					$Remark=" Get 3 X 2 Level Commission From Member $user_id and Board No. $board_no. ";
					$qryInsertLI = "INSERT INTO level_income SET income_id='".$income_id."', level='".$i."', commission='".$commission."', l_date='".$cur_date."', remark='".$Remark."', payout_date='0000-00-00', package='".$packname."', package_id='".$pack_id."', purchaser_id='".$user_id."',purchaser_uname='".$user_namePurchaser."', invoice='".$invoice."',bonus_name='".$bonus."',usdAmount = '".$usdAmount."'";
					$sqlInsetLevelIncome = mysql_query($qryInsertLI) or die("Error: ".$qryInsertLI.mysql_error());

					$selectLevelCounts = mysql_num_rows(mysql_query("SELECT * FROM board_status WHERE upper_id='$income_id' AND level='2'"));
					if($selectLevelCounts == 9)
					{
						$RemarkS=" Get 2 Level Completion Bonus ";
						$commissions = $commission*9;
						$qryInsertLI = "INSERT INTO bonus_income SET income_id='".$income_id."', level='".$i."', commission='".$commissions."', l_date='".$cur_date."', remark='".$RemarkS."', payout_date='0000-00-00', invoice='".$invoice."'";
						$sqlInsetLevelIncome = mysql_query($qryInsertLI);
					}

				}
				
			}
			
			$i++;
		}

		/*------ Fetch Info of Registerd User END ------*/
	}

?>
