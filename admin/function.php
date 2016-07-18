<?php

/*-----------------------------------------------------------
* GET All Record
* Param First Array has select field from tbl
* Param Second has tbl name
* Return Array
*------------------------------------------------------------*/
function getAllRec($fields,$tbl)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl";
	$rs=mysql_query($sql);
	if($rs)
		return getRows($rs);
}

/*-----------------------------------------------------------
* GET one field from table
* Param field name
* Param Second has tbl name
* Param Third has check field name
* Param Fourth field has value of checking
* Return Array
*------------------------------------------------------------*/
function getSingleField($field,$tbl,$fieldname,$val)
{
	$sql="SELECT $field from $tbl where $fieldname='$val'";
	$rs=mysql_query($sql);
	if($rs)
		return getRow($rs);
}


/*-----------------------------------------------------------
* GET Record 
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has other conditions
* Return Array
*------------------------------------------------------------*/
function getAllRecWithCon($fields,$tbl,$condtions,$row)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl $condtions";
	$rs=mysql_query($sql);
	if($rs)
	{
		if($row==1)
			return getRow($rs);
		else
			return getRows($rs);
	}
}


/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getSingleRecWhere($fields,$tbl,$field_name,$val)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl where $field_name='$val'";
	$rs=mysql_query($sql);
	if($rs)
		return getRow($rs);
}

/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getMultiRecWhere($fields,$tbl,$field_name,$val)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl where $field_name=$val";
	$rs=mysql_query($sql);
	if($rs)
		return getRows($rs);
}

/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED with condition
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getMultiRecWhereCond($fields,$tbl,$field_name,$con,$val)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl where $field_name $con $val";
	$rs=mysql_query($sql);
	if($rs)
		return getRows($rs);
}


/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED WITH AND CONDITIONS
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getSingleRecWhereAnd($fields,$tbl,$conditions)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	/* condtion key has field and value has field value for condition */	
	if(is_array($conditions))
	{
		$condition='';
		foreach($conditions as $key=>$val)
			$condition.=$key."='".$val."' and ";
			
	$condition=substr($condition,0,strlen($condition)-4);
	}
	
	$sql="SELECT $field from $tbl where $condition";
	$rs=mysql_query($sql);
	if($rs)
		return getRow($rs);
}


/*-----------------------------------------------------------
* GET Multi RECORD BY PARTICULAR FILED WITH AND CONDITIONS
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getMultiRecWhereAnd($fields,$tbl,$conditions)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	/* condtion key has field and value has field value for condition */	
	if(is_array($conditions))
	{
		$condition='';
		foreach($conditions as $key=>$val)
			$condition.=$key."='".$val."' and ";
			
	$condition=substr($condition,0,strlen($condition)-4);
	}
	
	$sql="SELECT $field from $tbl where $condition";
	$rs=mysql_query($sql);
	if($rs)
		return getRows($rs);
}
/*-----------------------------------------------------------
* GET SINGLE RECORD BY PARTICULAR FILED WITH AND CONDITIONS
* Param First Array has select field from tbl
* Param Second has tbl name
* Param Third has field by which you want to get value
* Param Fourth has a value by which you can check field
* Return Array
*------------------------------------------------------------*/
function getCountRec($field,$tbl,$field_name,$condition,$val)
{
	/* condtion key has field and value has field value for condition */	
	
	$sql="SELECT count($field) as tot from $tbl where $field_name $condition '$val'";
	$rs=mysql_query($sql);
	if($rs)
		return getRow($rs);
}

/*---------------------------------------
* rs is record set
* return Array
*---------------------------------------*/
	
function getRows($rs)
{
	$rows=array();
	while($row=mysql_fetch_array($rs))
	{
		$rows[]=$row;
	}
	if($rows)
		return $rows;
	else
		return false;
}	

/*---------------------------------------
* rs is record set
* return single Record Set
*---------------------------------------*/
	
function getRow($rs)
{
	return $row=mysql_fetch_array($rs);
}

/*---------------------------------------
* First Param is Array
* Second Param is key of array
* Third Param is show or not
*---------------------------------------*/

function getValue($args,$key,$echo=false)
{
	$arg=isset($args[$key])? $args[$key] : '&nbsp;';
	if($echo)
		echo $arg;
	else
		return $arg;
} 

/*---------------------------------------
* First Param is Array
* Second Param is tbl name
* return boollen value
*---------------------------------------*/

function insert_tbl($insert_arr,$tbl)
{
	$sql="INSERT INTO $tbl VALUES(";
	foreach($insert_arr as $ins)
		$sql.="'".$ins."',";
		
	$sql=substr($sql,0,strlen($sql)-1);
	$sql.=")";
//echo $sql."<br>";
	$rs=mysql_query($sql) or die ($sql."not post".mysql_error());
	if($rs)
		return true;
	else
		return false;
}

/*---------------------------------------
* First Param is Array
* Second Param is tbl name
* return boollen value
*---------------------------------------*/

function deleteRecord($sql)
{
	$rs=mysql_query($sql) or die ("not post".mysql_error());
	if($rs)
		return true;
	else
		return false;
}

/*---------------------------------------
* Get comment Days or Time
* First Param is Date
* Second Param is Time
* return numeric value
*---------------------------------------*/

function getDayTime($date,$time)
{
	$cur_date=date("Y-m-d");
	$cur_time=date("H:i");
	if(strtotime($cur_date)>strtotime($date))
	{
		$d=(strtotime($cur_date)-strtotime($date))/ (60 * 60 * 24);
		if($d==1)
			echo $d." day ago";
		else
			echo $d." days ago";
	}
	else
	{
		/****** explode current time ************/
		$c_t=explode(":",$cur_time);
		/********* explode comment time *********/
		$t=explode(":",$time);
		
		if($c_t[0] > $t[0])
		{
			$h=$c_t[0]-$t[0];
			
			if($c_t[1] > $t[1])
			{
				$m=$c_t[1]-$t[1];
				return $h." hour ".$m." min ago";
			}
			else
			{
				$m=$t[1]-$c_t[1];
				$h=$h-$m;
				return $m." min ago";
			}
		}
		else
		{
			$m=$c_t[1]-$t[1];
			if($m > 0)
				return $m." min ago";
			else
				return "5 sec ago";
		}	
		/*$t=(strtotime($cur_time)-strtotime($time))/ (60 * 60);
		if($t==1)
			echo $t." hour";
		else
			echo $t." hours";*/
			
	}
}


/*---------------------------------------
* Get Day of comment
* First Param is Date
* return numeric value
*---------------------------------------*/

function getDays($date)
{
	$cur_date=date("Y-m-d");
	$cur_time=date("H:i");
	if(strtotime($cur_date)>strtotime($date))
	{
		$d=(strtotime($cur_date)-strtotime($date))/ (60 * 60 * 24);
		if($d==1)
			echo $d." day ago";
		else
			echo $d." days ago";
	}
	else 
		echo date("d F Y",strtotime($date));
}
/*************************
* Execute query
* Return result set
**************************/

function query($sql)
{
	//echo "<br>".$sql;
	$rs=mysql_query($sql) or die($sql.mysql_error());
	return $rs;
}


/**************************************
* Event Day
***************************************/

function eventday($date)
{
	$cur_date=date("Y-m-d");
	
	if(strtotime(date("Y-m-d")) == strtotime($date))
		echo "Upcoming";
	else
		echo "Upcoming";
}

/*--------------------------------------------
* Update Table Record
* Param First is Array
* Param second is tbl name
* key of array is field name that will be update
*------------------------------------------------*/

function update_tbl($update,$tbl,$field_name,$value)
{
	if(is_array($update))
	{
		$upd='';
		foreach($update as $key=>$val)
			$upd.=$key."='".$val."',";
		
		$upd=substr($upd,0,strlen($upd)-1);
	}
		
	echo	$sql="UPDATE $tbl SET $upd	WHERE $field_name='$value' ";
		echo "<br>";
		return $rs=mysql_query($sql) or die ("tbl not update".mysql_error());
		
}

/*******************************************
* Get Single Record with order
********************************************/

function getSingleRecWhereOrder($fields,$tbl,$field_name,$val,$order_field,$order)
{
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	$sql="SELECT $field from $tbl where $field_name='$val' order by $order_field $order";
	$rs=mysql_query($sql);
	if($rs)
		return getRow($rs);
}


/***********************************************
* Check Banner Available date
* return date with add 1 day extra
***********************************************/
function fromDate($args_avl,$date)
{
	$flag=0;
	foreach($args_avl as $d)
	{
		if(strtotime(getValue($d,'start_date',false)) > strtotime($date) )
		{
			$flag=1;
		}
	}
	if($flag==1)
		$dats=getValue($d,'start_date',false);
	else
		$dats=$date;
		
	return date("Y-m-d",strtotime($dats." + 1 days"));
}

/***********************************************
* Banner End date
* return date with add 30 day extra
***********************************************/
function toDate($date)
{	
	return date("Y-m-d",strtotime($date." + 30 days"));
}


/*****************************************
* Search Record 
* Get Array
* Return SQL
******************************************/
function searchWhere($get,$fields,$tbl_name,$limit)
{
	list($key,$val)=each($get);
	
	if(is_array($fields))
	{
		$field='';
		foreach($fields as $f)
			$field.=$f.",";
			
	$field=substr($field,0,strlen($field)-1);
	}
	else
		$field=$fields;
	
	
	if($limit)
	{
		if($key=='membername')
		{
			$ar=explode(" ",$val);
			
			if(count($ar)==1)
			{
				
				$rs=mysql_query("select $field from $tbl_name where first_name like'".$val."%' limit $limit");
				if(!mysql_num_rows($rs))
				{
					$rs=mysql_query("select $field from $tbl_name where last_name='".$ar[0]."' limit $limit");
				}
			}
			else if(count($ar)==2)
			{
				$rs=mysql_query("select $field from $tbl_name where first_name='".$ar[0]."' and mid_name='".$ar[1]."' limit $limit");
				if(!mysql_num_rows($rs))
				{
					$rs=mysql_query("select $field from $tbl_name where first_name='".$ar[0]."' and last_name='".$ar[1]."' limit $limit");
				}
			}
			else if(count($ar)==3)
			{
				$rs=mysql_query("select $field from $tbl_name where first_name='".$ar[0]."' and mid_name='".$ar[1]."' and last_name='".$ar[2]."' limit $limit");
			}
		}
		else
		{
			$rs=mysql_query("select $field from $tbl_name where $key='$val' limit $limit");
		}
	}
	else
		$rs=mysql_query("select $field from $tbl_name where $key='$val'");
	
	return $rs;	
}

/********************************
* send mail trhough admin
*********************************/

function sendmail($to,$status,$subject,$message)
{
	$sql="select email from admin_master where username='".$_SESSION['uid']."'";
	$rst=query($sql);
	
	if(mysql_num_rows($rst)==0)
	{
		$sql="select email from emp where user_name='".$_SESSION['uid']."'";
		$result=query($sql);
		$args_mail=getRow($result);
	}
	else
		$args_mail=getRow($rst);
		
	$from=getValue($args_mail,'email',false);
	$header="From:".$from;
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail($to,$subject,$message,$header);
	return $from;
}

/*------------------
* Get member name
*------------------*/
function get_member_name($args,$userid)
{
	$sql="select concat(' ',$args) as name from registration where user_id='$userid'";
	$args_user=getRow(query($sql));
	if($args_user)
	{
		echo  ucfirst($args_user['name']);
	}
}

?>