<?php

	function boardMainTableOfUser($user_id,$package_amnt)
	{
		$selectBoardNoOfUserIds = "select board_no from board_main where 1 AND  package_id = '".$package_amnt."' AND user_id ='".$user_id."' AND board_status='0'";
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
		
		if($fetchResult['maxboard']!='')
		{
			return $fetchResult['maxboard'];	
		}
		else
		{
			return $maxBoardNo = 0;
		}
	}


	function maxCellNumber($user_id,$package_amnt)
	{
		$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND (upper_id='".$user_id."' OR upper_id='0') AND package_id = '".$package_amnt."' AND cell_status='0'";

		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}

	function maxCellNumberA($user_id,$package_amnt)
	{
		$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND (upper_id='".$user_id."' OR upper_id='0') AND package_id = '".$package_amnt."' AND cell_status='0'";

		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}
	
	function maxCellNumber70140($ref,$package_amnt)
	{
		$selectBoardNoOfUserId = "SELECT MAX(cell_no) as max_cell,board_number as boardN, board_owner_id FROM board_status WHERE 1 AND (upper_id='0' OR upper_id='$ref') AND package_id = '".$package_amnt."'";

		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);
	}
	
	function fetchBoard($user_id,$package_amnt)
	{
		
		$selectBoardNoOfUserId = "SELECT board_no FROM board_main WHERE 1 AND user_id='".$user_id."' AND package_id = '".$package_amnt."' AND board_status = '0'";



		$result = mysql_query($selectBoardNoOfUserId);
		return $fetchResult=mysql_fetch_assoc($result);


	}

?>