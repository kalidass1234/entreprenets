<?php
include_once("commision.php");
include("spil_idsearch.php");
//include("level_count_register.php");
class DBConnection
{
	function connection($host,$user,$password='')
	{
		//echo $host.",".$user.",".$password; echo "<br>";
		$res=mysql_connect($host,$user,$password) or die("Database Connection Unsuccessfull");
		if($res)
		{
			return true;
			//echo "Database Connection Successfull"; exit;
		}
		else
		{
			echo "Database Connection Unsuccessfull"; exit;
		}
	}
	function select_database($host,$user,$password='',$database)
	{
		//echo $host.",".$user.",".$password."###".$database;exit;
		if($this->connection($host,$user,$password))
		{
			$res=mysql_select_db($database);
			//var_dump($res);
		}
		else
		{
		echo "Database Selection Unsuccessfull"; exit;
		}
	}
}

function invoice_date($invoice)
{
	$sql="select date from purchase_detail where invoice_no='$invoice'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	return $row['date'];
}


function _get_member_rank($user_name)
{
	
	$qry=mysql_query("select * from user_rank ur inner join user_rank_achieve ura on ur.id=ura.rank_id where ura.username='$user_name'") or die(mysql_error());
	$num=mysql_num_rows($qry);
		$row=mysql_fetch_assoc($qry);
		$rank_name=$row['rank_name'];
		$rank_target=$row['rank_target'];
	if($num>0)
	{
		if($rank_target<30)
		{
			return "Below Rank";
		}
		else
		{
		return $rank_name;
		}
	}
	else
	{
		return "Customer";
	}
	
}

function check_country($country_id, $country_name,$admin_type)
{
	if($admin_type=='super_admin')
	{
			return '';	
	}
	else
	{
		 $country_search=" and (country='$country_id' or country='$country_name')";
		 return $country_search;
	}
}


/*function total_direct_referral_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.date between '$from_date' and '$to_date')";
	}
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	
	 $sql="select d.final_amount from direct_referral_bonus d inner join registration r on d.income_id=r.user_id where d.income_id='$id' $country_search $cond $con_search ORDER BY d.l_id DESC";
 //echo $sql;
						$res=mysql_query($sql) or die(mysql_error());
						while($row=mysql_fetch_assoc($res))
						{
							
							$final_amount +=$row['final_amount'];
						}
						return $final_amount;
}

function total_upgrade_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.date between '$from_date' and '$to_date')";
	}
	
	
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	
	 $sql1="select d.final_amount from upgrade_bonus d inner join registration r on d.income_id=r.user_id where d.income_id='$id' $country_search $cond $con_search ORDER BY d.l_id DESC";
	 
	
 //echo $sql;
						$res1=mysql_query($sql1);
						while($row1=mysql_fetch_assoc($res1))
						{
							
							$final_amount +=$row1['final_amount'];
						}
						return $final_amount;
}
function total_binary_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.b_date between '$from_date' and '$to_date')";
	}
	
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	
	 $sql2="select d.final_amount from binary_income d inner join registration r on d.user_id=r.user_id where d.user_id='$id' $country_search $cond $con_search ORDER BY d.id DESC";
	 
	
	
 //echo $sql;
						$res2=mysql_query($sql2);
						while($row2=mysql_fetch_assoc($res2))
						{
							
							$final_amount +=$row2['final_amount'];
						}	
						return $final_amount;
						
}
function total_five_star_special_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.date between '$from_date' and '$to_date')";
	}
	
	
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	
	 $sql3="select d.final_amount from five_star_special_bonus d inner join registration r on d.income_id=r.user_id where d.income_id='$id' $country_search $cond $con_search ORDER BY d.l_id DESC";
	
	
 //echo $sql;
						$res3=mysql_query($sql3);
						while($row3=mysql_fetch_assoc($res3))
						{
							
							$final_amount +=$row3['final_amount'];
						}
						return $final_amount;	
}
function total_matching_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.date between '$from_date' and '$to_date')";
	}
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	 $sql4="select d.final_amount from matching_bonus d inner join registration r on d.income_id=r.user_id where d.income_id='$id' $country_search $cond $con_search ORDER BY d.l_id DESC";
	
 //echo $sql;
						$res4=mysql_query($sql4);
						while($row4=mysql_fetch_assoc($res4))
						{
							
							$final_amount +=$row4['final_amount'];
						}	
						return $final_amount;
}
function total_repurchase_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.date between '$from_date' and '$to_date')";
	}
	
	
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	 $sql5="select d.final_amount from repurchase_bonus_one d inner join registration r on d.income_id=r.user_id where d.income_id='$id' $country_search $cond $con_search ORDER BY d.l_id DESC";
 //echo $sql;
						$res5=mysql_query($sql5);
						while($row5=mysql_fetch_assoc($res5))
						{
							
							$final_amount +=$row5['final_amount'];
						}
						return $final_amount;	
}

function total_repurchase__binary_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type)
{
	
	if($from_date!='' && $to_date!='')
	{
		$cond="and (d.date between '$from_date' and '$to_date')";
	}
	
	 if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					 $country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
	 $sql5="select d.final_amount from repurchase_binary_income d inner join registration r on d.user_id=r.user_id where d.user_id='$id' $country_search $cond $con_search ORDER BY d.id DESC";
	
	
 //echo $sql;
						$res5=mysql_query($sql5);
						while($row5=mysql_fetch_assoc($res5))
						{
							
							$final_amount +=$row5['final_amount'];
						}
						return $final_amount;	
}

*/

function _get_referral_volume($user_id)
{
	$drbQry=mysql_query("select sum(invoice_bv) as income_bv from direct_referral_bonus where income_id='$user_id' ") or die(mysql_error());
		
		$drbRow=mysql_fetch_assoc($drbQry);
		$income_bv=$drbRow['income_bv'];
		if($income_bv!='')
		return $income_bv;
		else
		return 0;
}

function _get_personal_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id='$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql) ;
	$row=mysql_fetch_assoc($res);
	 $row['total']; 
	if($row['total']!='')
	{
	
	return $row['total'];
	}
	else
	{
		return 0;
	}
}

function _get_team_sale_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id<>'$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	if($row['total']!='')
	{
	return $row['total']." PV";
	}
	else
	{
		return '0 PV';
	}
}

function _get_left_team_sale_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id<>'$user_id' and income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	if($row['total']!='')
	{
	return $row['total']." PV";
	}
	else
	{
		return '0 PV';
	}
}

function _get_right_team_sale_volume($user_id,$leg=false)
{
	if($leg)
	{
		$cond=" and leg='$leg'";
	}
	$sql="select sum(invoice_bv) as total from purchase_history where purcheser_id<>'$user_id' and  income_id='$user_id' and plan='binary_plan' $cond ";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	if($row['total']!='')
	{
	return $row['total']." PV";
	}
	else
	{
		return '0 PV';
	}
}



class User_Login
{
	function login($uname,$pass,$return_page,$current_page,$type='')
	{
			
			$query="select * from admin_master where userid='$uname' and password='$pass' and status=0"; 
			//echo $query;exit;
			$dat=mysql_query($query);
			$res=mysql_num_rows($dat);
			//echo $res;exit;
			if($res>0 && $uname!='' && $pass!='')
			{
				$row=mysql_fetch_assoc($dat);
				
				$con=mysql_fetch_assoc(mysql_query("select * from country where country_id='".$row['country']."'"));
				$country_name=$con['country_name'];
				if(!isset($_SESSION['TRINITY_User_Name']))
				{
					
					$_SESSION['privilege_uid']=$row['uid'];
					$_SESSION['admin_country_id']=$row['country'];
					$_SESSION['admin_country_name']=$country_name;
					$_SESSION['admin_type']=$row['user_type'];
					$_SESSION['TRINITY_User_Name']=$uname;
					$_SESSION['TRINITY_User_ID']=$row['user_id'];
					$_SESSION['TRINITY_User_Type']=$row['user_type'];
					$_SESSION['admin_type']=$row['user_type'];
					
					//$update="update admin_master set last_login=this_login, this_login=now() where user_name='$uname'";
					//$sql=mysql_query($update)or die("Error: Login Problem.");
				}
				if($type=='lockscreen')
				{
					$obj=new mysql_func();
					$table_employee=TABLE_PREFIX."admin_master";
					$update_arr=array("lockscreen"=>0);
					$where="id='$row[id]'";
					$obj->update_tbl($update_arr,$table_employee,$where);
				}
				//echo $row['user_type'];
				
				if($row['user_type']=='super_admin' || $row['user_type']=='admin' || $row['user_type']=='sub_admin')
				{
					header("location:admin_main.php?page_number=1");
					$_SESSION['privilege_uid']=$row['uid'];
					$_SESSION['admin_country_id']=$row['country'];
					$_SESSION['admin_country_name']=$country_name;
					$_SESSION['admin_type']=$row['user_type'];
				}
				else
				{
					header("location:userpanel/index.php");
				}
			}
			else
			{
				if($type=='lockscreen'){$checkscreen="&checkscreen=1";}
				$msg="Wrong Username or Password. Please check it and try again.";
				$msg=$msg.$checkscreen;
				header("Location:".$current_page."?msg=".$msg);
			}
	}
	function _page_title($page_name)
	{
	
		$arr_title=array("index.php"=>"WelCome to AVCARE Admin","management-list.php"=>"Representative List","add-mr.php"=>"Add Representative","teritory-manage.php"=>"Teritory List","add_teritory.php"=>"Add Teritory","dr-manage.php"=>"Doctor List","add_doctor.php"=>"Add Doctor","dr-speciality.php"=>"Doctor Speciality","add_speciality.php"=>"Add Speciality","designation.php"=>"Designation","add_designation.php"=>"Add Designation");
	
		return $arr_title[$page_name];
	
	}
	
	function _get_page_name()
	{
		return basename($_SERVER['PHP_SELF']);
	}
}
class mysql_func
{
	public $last_query;
	function query($slt, $table, $where=false)
	{
		
		$this->last_query = "select ".$slt." from ".$table." where ".$where;
		$this->last_query;
		return mysql_query("select ".$slt." from ".$table." where ".$where);
	}
	function query_execute($sql)
	{
		return mysql_query($sql);
	}
	function execute_query($slt, $table, $where=false, $order_by)
	{
		//echo "select ".$slt." from ".$table." where ".$where." order by ".$order_by;
		return mysql_query("select ".$slt." from ".$table." where ".$where." order by ".$order_by );
	}
	function execute_join_query($select, $table1,$table2,$on, $where=false, $order_by)
	{
		 $sql="select ".$select." from ".$table1." inner join ".$table2." on ".$on." where ".$where." order by ".$order_by;
	
		return mysql_query($sql);
	}
	function result($res, $p1, $p2)
	{
		return mysql_result($res, $p1, $p2);
	}
	function num_row($res)
	{
		return mysql_num_rows($res);
	}
	function get_row($res)
	{
		$row=mysql_fetch_array($res);
		return $row[0];
	}
	function get_all_row($res)
	{
		$row=mysql_fetch_assoc($res);
		return $row;
	}
	function get_pid()
	{
		return mysql_insert_id();
	}
	function insert_tbl($insert_arr,$tbl)
	{
		 $sql="INSERT INTO $tbl set ";
		 foreach($insert_arr as $key=>$val)
		 
		 $sql.=$key."='".addslashes($val)."',";
		  
		 $sql=substr($sql,0,strlen($sql)-1);
		 //echo $sql; echo "<br>";exit();
		 $rs=$this->query_execute($sql);
		 
		 if($rs)
		  return true;
		 else
		  return false;
	}
	function insert_tbl1($insert_arr,$tbl)
	{
		 $sql="INSERT INTO $tbl set ";
		 foreach($insert_arr as $key=>$val)
		 
		 $sql.=$key."='".($val)."',";
		  
		 $sql=substr($sql,0,strlen($sql)-1);
		//echo $sql; echo "<br>";
		 $rs=$this->query_execute($sql);
		 
		 if($rs)
		  return true;
		 else
		  return false;
	}
	function update_tbl1($update,$tbl,$where,$addslashes=false)
	{
		 $sql="update $tbl set ";
		 
		 foreach($update as $key=>$val)
		 {
			  if($addslashes)
			  $val = ($val); 
			  $sql.=$key."='".$val."',";
		 }
		  
		 $sql=substr($sql,0,strlen($sql)-1);
		 
		 $sql.=" where $where ";
		 //echo $sql; "<br>"; exit;
		 $rs=$this->query_execute($sql);
		 if($rs)
		  return true;
		 else
		  return false;
	}
	function update_tbl($update,$tbl,$where,$addslashes=false)
	{
		 $sql="update $tbl set ";
		 
		 foreach($update as $key=>$val)
		 {
			  if($addslashes)
			  $val = addslashes($val); 
			  $sql.=$key."='".$val."',";
		 }
		  
		 $sql=substr($sql,0,strlen($sql)-1);
		 
		 $sql.=" where $where ";
		 //echo $sql; "<br>"; exit;
		 $rs=$this->query_execute($sql);
		 if($rs)
		  return true;
		 else
		  return false;
	}
	
	function meeting_time($format,$meet_time)
	{
		if($format==24)
		{
			for($i=1;$i<=24;$i++)
			{
				$value=$i-1;
				$val=$value.'_'.$i;
				$name="From ".$value." To ".$i;
				if($val==$meet_time)
				{
					$select="selected";
				}
				else
				{
					$select="";
				}
				echo "<option value='".$value."' ".$select.">".$name."</option>";
			}
		}
		else if($format==12)
		{
			for($i=0;$i<=23;$i++)
			{
				// check the time format wise
				if($i<12){ $a=$i; $f='AM';}
				else if($i==12){ $a=12; $f='PM'; }
				else if($i==24){ $a=12; $f='AM'; }
				else{ $a=$i%12; $f='PM';}
				if($i==24)
				{
					$value=$a;
				}
				else
				{
					if($a==12) $value=1;
					else $value=$a+1;
				}
				$val=$a.$f.'_'.$value.$f;
				if($val==$meet_time)
				{
					$select="selected";
				}
				else
				{
					$select="";
				}
				$name="From ".$a." ".$f." To ".$value." ".$f;
				echo "<option value='".$val."' ".$select.">".$name."</option>";
			}
		}
	}
	function _change_password()
	{
		$old_pass=$_POST['old_password'];
		$new_pass=$_POST['new_password'];
		$c_pass=$_POST['c_password'];
		$userid=USERNAME;
		$table_name=TABLE_PREFIX.'admin';
		// check the old password is valid or not
		$res=$this->query("*",$table_name," userid='$userid' and password='$old_pass'");
		$count=$this->num_row($res);
		if($count)
		{
			if($new_pass==$c_pass)
			{
				$curdate=date('Y-m-d');
				$update_arr=array("password"=>$new_pass,"modify_by"=>USERNAME,"modify_date"=>$curdate);
				$where=" id='$id'";
				$this->update_tbl($update_arr,$table_name,$where);
				$msg="Password Change Successfully.";
			}
			else
			{
				$msg="Password and Confirm Password Should Be Same.";
			}
		}
		else
		{
			$msg="Wrong Old Password.";
		}
		header("Location:change_password.php?msg=".$msg);
	}
	
	function active_inactive($status,$id,$table_name)
	{
		$curdate=date('Y-m-d');
		$update_arr=array("status"=>$status,"modify_by"=>USERNAME,"modify_date"=>$curdate);
		$where=" id='$id'";
		$this->update_tbl($update_arr,$table_name,$where);
	}
	 
	function get_field_name($table_name,$field,$condition)
	{
		//echo $field."==".$table_name."==".$condition;exit;
		 $res=$this->query($field,$table_name,$condition);
		$row=$this->get_all_row($res);
		return $row[$field];
	}
	
	function get_field_concatname($table_name,$field,$condition)
	{
		$name=strstr($field, ' as ');
		$name=trim($name,' as ');
		//echo $field."==".$table_name."==".$condition;exit;
		$res=$this->query($field,$table_name,$condition);
		$row=$this->get_all_row($res);
		return $row[$name];
	}
	function get_dropdown($tbl_name,$field_arr,$condition,$value,$name,$check=false)
	{
		$table_name=TABLE_PREFIX.$tbl_name;
		$field=implode(",",$field_arr);	
		//echo $field.'=='.$table_name;exit;
		$res=$this->query($field,$table_name,$condition);
		while($row=$this->get_all_row($res))
		{
			if($row[$value]==$check){ $select="selected";}else{$select='';}
            echo "<option value='".$row[$value]."' ".$select.">".$row[$name]."</option>";
		}
	}
	function get_checkboxes($tbl_name,$field_arr,$condition,$value,$name,$checkboxname,$line,$check=false)
	{
		$table_name=TABLE_PREFIX.$tbl_name;
		$field=implode(",",$field_arr);	
		$res=$this->query($field,$table_name,$condition);
		$ln=1;
		
		if($check){ $check_arr=explode(",",$check); $flag=true;}
		//echo "<pre>"; print_r($check_arr); exit;
		while($row=$this->get_all_row($res))
		{
			
			if($flag){if(in_array($row[$value],$check_arr)){ $select="checked";}else{$select='';}}
			echo "&nbsp;<input type='checkbox' name='".$checkboxname."' value='".$row[$value]."' ".$select.">".$row[$name]."&nbsp;";
            //echo "<option value='".$row[$value]."' ".$select.">".$row[$name]."</option>";
			if($ln%$line==0) echo "<br>";
			$ln++;
		}
	}
	function dropdown($table_name,$field_arr,$condition)
	{
		$field=implode(",",$field_arr);	
		$res=$this->query($field,$table_name,$condition);
		while($row=$this->get_all_row($res))
		{
			echo "<option value=''></option>";
		}
	}
	function upload_files($path,$file)
	{
			$filename=$_FILES[$file]['name'];
			$filetype=$_FILES[$file]['type'];
			$filetmp=$_FILES[$file]['tmp_name'];
			$ext=end(explode(",",$filename));
			$file_path="../product_logos/".$path."/";
			$blacklist = array(".php", ".phtml", ".php3", ".php4");
			$flag=0;
			foreach ($blacklist as $item)
			{
				if(preg_match("/$item\$/i",$filename )) 
				{
					$flag++;
				}
			}
			if($flag)
			{
				return "error_ext";
			}
			
			// malicious file validaiton
			
			$fp = fopen($_FILES[$file]['tmp_name'],'r');
			
			fseek($fp,0);
			$data = fread($fp,5);
			//echo $data;exit;
			$flag1=0;
			if(strcmp($data,"%DOC-")==0 || strcmp($data,"%XLS-")==0 || strcmp($data,"%PPT-")==0 || strcmp($data,"%PDF-")==0  || strcmp($data,"PK")==0 || strcmp($data,"MZ")==0)
			{
			 $flag = 1;
			}
			else
			{
				$flag = 1;
				//return "error_type";
			 	//echo "Sorry, we only accept correct doc, pdf, ppt and xls file \n";exit;
			} 
			
			fclose($fp);
			if($filename!='')
			{
				$image2=time().'_'.$ext;
				$r=move_uploaded_file($filetmp,$file_path.$image2);
				if($r)
				{
					return $image2;
				}
				else
				{
					return "error_upload";
				}
			}
	}
	function file_upload($path)
	{
		$filename=$_FILES['avatar']['name'];
		$filetype=$_FILES['avatar']['type'];
		$filetmp=$_FILES['avatar']['tmp_name'];
		$file_path="../userimages/".$path."/";
		$blacklist = array(".php", ".phtml", ".php3", ".php4");
		$flag=0;
		foreach ($blacklist as $item)
		{
			if(preg_match("/$item\$/i",$filename )) 
			{
				$flag++;
			}
		}
		if($flag)
		{
			return "error_ext";
		}
		$imageinfo = @getimagesize($filetmp);
		$flag1=0;
		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') 
		{
			$flag1++;
		}
		if($flag1)
		{
			return "error_type";
		}
		if($filename!='')
		{
			$image2=time().'_'.'.jpg';
			$r=move_uploaded_file($filetmp,$file_path.$image2);
			if($r)
			{
				return $image2;
			}
			else
			{
				return "error_upload";
			}
		}	
	}
	function file_image($path,$file_path)
	{
		$filename=$_FILES['image']['name'];
		$filetype=$_FILES['image']['type'];
		$filetmp=$_FILES['image']['tmp_name'];
		//$file_path="../userimages/".$path."/";
		$blacklist = array(".php", ".phtml", ".php3", ".php4");
		$flag=0;
		foreach ($blacklist as $item)
		{
			if(preg_match("/$item\$/i",$filename )) 
			{
				$flag++;
			}
		}
		if($flag)
		{
			return "error_ext";
		}
		$imageinfo = @getimagesize($filetmp);
		$flag1=0;
		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') 
		{
			$flag1++;
		}
		if($flag1)
		{
			return "error_type";
		}
		if($filename!='')
		{
			$image2=time().'_'.'.jpg';
			$r=move_uploaded_file($filetmp,$file_path.$image2);
			if($r)
			{
				return $image2;
			}
			else
			{
				return "error_upload";
			}
		}	
	}
	function file_image_logo($path,$file_path,$file)
	{
		$filename=$_FILES[$file]['name'];
		$filetype=$_FILES[$file]['type'];
		$filetmp=$_FILES[$file]['tmp_name'];
		//$file_path="../userimages/".$path."/";
		$blacklist = array(".php", ".phtml", ".php3", ".php4");
		$flag=0;
		foreach ($blacklist as $item)
		{
			if(preg_match("/$item\$/i",$filename )) 
			{
				$flag++;
			}
		}
		if($flag)
		{
			return "error_ext";
		}
		$imageinfo = @getimagesize($filetmp);
		$flag1=0;
		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') 
		{
			$flag1++;
		}
		if($flag1)
		{
			return "error_type";
		}
		if($filename!='')
		{
			if($file=='logo')
			{
				//$image2=time().'_'.$file.'_'.'.jpg';
				$image2=$filename;
			}
			else
			{
				$image2=$file.'.ico';
			}
			$r=move_uploaded_file($filetmp,$file_path.$image2);
			if($r)
			{
				return $image2;
			}
			else
			{
				return "error_upload";
			}
		}	
	}
	/*function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'employee';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select user_id from $table_name where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}*/
}

class Representative 
{
	public $mysql_func;
	public function __construct()
	{
		$this->mysql_func = new mysql_func();
	}
	function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'registration';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select user_id from $table_name where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}

	function showuserid($user_name)
	{
		$sql="select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$result=mysql_query($sql);
			if(mysql_num_rows($result)>0)
			{
				$row=mysql_fetch_assoc($result);
				return $row['user_id'];
			}
	}
	function checkuser($user_name)
	{
	 //echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$checkid=mysql_query("select user_id from registration where user_name='$user_name' or user_id='$user_name'");
			if(mysql_num_rows($checkid)>0)
			{
				return false;
			}
			else
				return true;
	}
	function checkuser_with_id($user_name,$user_id)
	{
	 //echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$checkid=mysql_query("select user_id from registration where user_name='$user_name' and user_id='$user_id'");
			if(mysql_num_rows($checkid)>0)
			{
				return false;
			}
			else
				return true;
	}
	function _user_registration()
	{
		//echo "<pre>"; print_r($_POST); exit;	
		// check sponsor 
		
		$table_name=TABLE_PREFIX.'registration';
		$curdate=date('Y-m-d H:i:s');
		$user_id=$this->userid();
		//$ref_id=$this->showuserid($_POST['sp_name']);
		if(!isset($_POST['sp_name']) || $_POST['sp_name']=='')
		{
			// find the placement id of the 1234567
			// check the default reg sponsor
			$res_ds=$this->mysql_func->query("user_id","registration","show_reg_page=1");
			$row_ds=$this->mysql_func->get_all_row($res_ds);
			if($row_ds['user_id']!='')
			{
				$ref_id123=$row_ds['user_id'];
			}
			else
			{
				$ref_id123=1234567;
			}
		}
		else
		{
			$ref_id123=$this->showuserid($_POST['sp_name']);
		}
			$res_p=$this->mysql_func->query("placement_id,placement_id_status","registration","user_id='$ref_id123'");
			$row_p=$this->mysql_func->get_all_row($res_p);
			if($row_p['placement_id']!='' && $row_p['placement_id_status'])
			{
				$ref_id_temp=$row_p['placement_id'];
				$ref_id=$ref_id123;
			}
			else
			{
				$ref_id=$ref_id123;
			}
		$posi=$_POST['position'];
		// check sponsor and user
		if(!$this->checkuser($ref_id) && $this->checkuser($_POST['user_name']))
		{
			$inser_array=
			array(
				"user_id"=>$user_id,
				"ref_id"=>$ref_id,
				"nom_id"=>$nom_id,
				"user_name"=>$_POST['user_name'],
				"user_pass"=>$_POST['user_pass'],
				"binary_pos"=>$posi,
				"first_name"=>$_POST['first_name'],
				"last_name"=>$_POST['last_name'],
				"email"=>$_POST['email'],
				"address1"=>$_POST['adress1'],
				"address2"=>$_POST['adress2'],
				"city"=>$_POST['city'],
				"country"=>$_POST['country'],
				"phoner"=>$_POST['phone'],
				"zip"=>$_POST['zip'],
				"power_leg"=>'left',
				"power_status"=>1,
				"reg_date"=>$curdate,
				"mem_status"=>0);
		$this->mysql_func->insert_tbl($inser_array,$table_name);	
		/*$nom_id=$this->spill_id1($ref_id,$posi);
		$nom=$nom_id;
		$pos=$posi;
		$l=1;
		while($nom!='cmp')
		{
			if($nom!='cmp')
			{
			mysql_query("insert into level_income set invoice_no='$newID',purcheser_id='$user_id',income_id='$nom',level='$l',commission='',date=curdate(),invoice_amt='$plan_name',com_percent='',invoice_bv='$bv',closing='',status=0, position='$pos'"); 
			
			}
			$selectnompos=mysql_query("select binary_pos, nom_id from registration where user_id='$nom' ");
			$fetchnompos=mysql_fetch_array($selectnompos);
			$pos=$fetchnompos['binary_pos'];
			$nom=$fetchnompos['nom_id'];
			$l++;
		}
		mysql_query("update registration set nom_id='$nom_id' where user_id='$user_id'");*/
		$_SESSION['SD_User_Name']=$_POST['user_name'];
		$_SESSION['SD_User_ID']=$user_id;
		$_SESSION['SD_User_Type']='';	
		header("Location:userpanel/index.php");
		}
		else
		{
			header("Location:register.php?msg=Wrong Username or Wrong Sponser Detail");
		}
	}
	
	function _newsletter()
	{
		//echo "<pre>"; print_r($_POST);
		$insert_arr=array("email"=>$_POST['EMAIL']);
		$table_name=TABLE_PREFIX.'newsletter';
		$this->mysql_func->insert_tbl($inser_array,$table_name);
		header("Location:".$_POST['return_page']);
	}
	function _password_request()
	{
		//echo "<pre>"; print_r($_POST);
		// check username 
		$result=$this->mysql_func->query("*",TABLE_PREFIX.'admin',"userid='$_POST[username]'");
		$count_user=$this->mysql_func->num_row($result);
		$flag=0;
		if($count_user)
		{
			$curdate=date('Y-m-d H:i:s');
			$table_name=TABLE_PREFIX.'password_request';
			$inser_array=
			array(
				"username"=>$_POST['username'],
				"request_date"=>$curdate,"reset_password"=>0);
			$this->mysql_func->insert_tbl($inser_array,$table_name);
			$msg="Request Sent To Admin Successfully.";
			$flag=1;
		}
		else
		{
			$msg="Request Cannot Sent. Please Check Your Username";
			$flag=0;
		}
		if($_POST['return_page'])
		{
			$page_name=$_POST['return_page'];
		}
		else
		{
			$page_name='index.php';
		}
		header("Location:".$page_name."?msg=".$msg."&password=true&change=".$flag);
	}
		
	function _edit_user_detail()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name=TABLE_PREFIX.'registration';
		$flag==false;
		foreach($_POST as $key=>$val)
		{
			if($key=='bonus')
			{
				$flag=true;
			}
			if($key=='submit' || $key=='user_id')
			{
			}
			else
			{
				// check for country and user_name
				if($key=='country' && $val=='')
				{
				}
				else if($key=='user_name' && !$this->checkuser($val) && !$this->checkuser_with_id($user_name,$user_id) )
				{
				
				}
				else if($key=='user_name' && !$this->checkuser($val))
				{
				
				}
				else
				{
					$update_arr[$key]=$val;
				}
			}
		}
		$user_id=$_POST['user_id'];
		//print_r($update_arr); exit;
		$where=" user_id='$user_id'";
		$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		
		if($flag && $_POST['bonus'])
		{
			$bonus_date=date('Y-m-d');
			$Date=$bonus_date;
			$expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));
			$this->mysql_func->query_execute("update registration set bonus=1,bonus_date='$bonus_date' where user_id='$user_id'");
			$this->mysql_func->query_execute("update subscription set status=1 where user_id='$user_id'");
$this->mysql_func->query_execute("insert into subscription set order_no='Admin',user_id='$user_id',subs_fee='160',payment_mode='From Admin',subs_date='$bonus_date',end_date='$expire_date'");

			$sql_check="select * from subscription where user_id='$user_id'";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check==1)
			{
				// get user sponsor and position
				$sql_user="select * from registration where user_id='$user_id'";
				$res_user=mysql_query($sql_user);
				$row_user=mysql_fetch_assoc($res_user);
				$ref_id=$row_user['ref_id'];
				// get sponsor power leg
				$sql_ref_leg="select power_leg from registration where user_id='$ref_id'";
				$res_ref_leg=mysql_query($sql_ref_leg);
				$row_ref_leg=mysql_fetch_assoc($res_ref_leg);
				$posi=$row_ref_leg['power_leg'];
				
				if($ref_id!='cmp')
				{
					$nom_id=spill(array($ref_id));
					
					$nom=$nom_id;
					$pos=$posi;
					//echo $nom.'='.$ref_id.'='.$posi;exit;
					$l=1;
					while($nom!='cmp')
					{
						if($nom!='cmp')
						{
							mysql_query("insert into level_income set invoice_no='$newID',purcheser_id='$user_id',income_id='$nom',level='$l',commission='',date=curdate(),invoice_amt='$amount',com_percent='',invoice_bv='$bv',closing='',status=0, position='$pos'"); 
						}
						$selectnompos=mysql_query("select binary_pos, nom_id from registration where user_id='$nom' ");
						$fetchnompos=mysql_fetch_array($selectnompos);
						$pos=$fetchnompos['binary_pos'];
						$nom=$fetchnompos['nom_id'];
						$l++;
					}
					mysql_query("update registration set nom_id='$nom_id',binary_pos='$posi',power_status='1',power_leg='left' where user_id='$user_id'");
				}
				// get product volume in the member package
			}
		}
		header("Location:admin_main.php?page_number=2&update=1&userid=".$user_id);
	}
	/*function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'registration';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select user_id from $table_name where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	
	function checkuser($user_name)
	{
	 //echo "select user_id from registration where user_name='$user_name' or user_id='$user_name'";
		$checkid=mysql_query("select user_id from registration where user_name='$user_name' or user_id='$user_name'");
			if(mysql_num_rows($checkid)>0)
			{
				return false;
			}
			else
				return true;
	}*/
	
	function _new_registration()
	{
		$sp_name=$_POST['sp_name'];
		$selectUserSponsor = mysql_fetch_array(mysql_query("SELECT user_id FROM registration WHERE (user_id='$sp_name' OR user_name='$sp_name')"));
		$sp_name=$selectUserSponsor['user_id'];
		$posi = $_POST['binary_pos'];
		$res_sp=$this->mysql_func->query("*","registration","user_name='$sp_name' or user_id='$sp_name'");
		
		$count_sp=$this->mysql_func->num_row($res_sp);
		
		if($count_sp >0)
		{
			$row_sp=$this->mysql_func->get_all_row($res_sp);
			$ref_id=$row_sp['user_id'];
			$update_arr['ref_id']=$ref_id;
			if($row_sp['placement_id']!='' && $row_sp['placement_id_status'])
			{
				$update_arr['ref_id_temp']=$row_sp['placement_id'];
			}
		}
		else if($sp_name=='cmp')
		{
			$ref_id=$sp_name;
			$update_arr['ref_id']=$sp_name;
			$update_arr['nom_id']=$sp_name;
		}
		else
		{
			header("Location:admin_main.php?page_number=154&msg=wrong sponsor&update=1&userid=".$user_id);exit;
		}
		$curdate=date('Y-m-d');
		$start_date = $curdate;
	$date = strtotime($start_date);
	$dateAfterOneMonth = strtotime("+365 day", $date);
	$dateAfterOneMonth =date('Y-m-d', $dateAfterOneMonth);

		$user_id=$this->userid();
		$update_arr['user_id']=$user_id;
		$update_arr['reg_date']=$curdate;
		$update_arr['power_status']=1;
		$update_arr['nom_id']=$this->spill_id1($sp_name,$posi);

		if((!$this->checkuser($ref_id) && $this->checkuser($_POST['user_name'])) || $ref_id=='cmp')
		{
			$table_name=TABLE_PREFIX.'registration';
			foreach($_POST as $key=>$val)
			{
				if($key=='submit' || $key=='user_id' || $key=='sp_name')
				{
				}
				else
				{
					$update_arr[$key]=$val;
				}
			}

			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$insert_array=array(
						"user_id"=>$user_id,
						"amount"=>'0'
						);
			$this->mysql_func->insert_tbl($insert_array,"final_e_wallet");	
			$Commission = new Commission();
			if($nom_id!='')
			{
				$invoice = $Commission->invoice();
				mysql_query("INSERT INTO subscribe SET user_id='".$user_id."', s_date='".$start_date."', e_date='".$dateAfterOneMonth."',status='0',invoice = '".$invoice."'");
				//mysql_query("INSERT INTO final_bv SET user_id='".$user_id."', personel_bv='".$point_value."', totalbv='".$point_value."', invoice='".$invoice."'");
			}
			$binaryPairBonus = $Commission->binaryPairBonus($user_id);
			header("Location:admin_main.php?page_number=1&update=1&userid=".$user_id);
		}
		else
		{
			header("Location:admin_main.php?page_number=154&msg=Wrong Sponsor or User&update=1&userid=".$user_id);
		}
	}
	function _jump_member()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'registration';
		unset($_POST['search']);
		$bonus_date=date('Y-m-d');
		$Date=$bonus_date;
$expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));
		$res_u=$this->mysql_func->query("user_id","registration","user_name='$_POST[user_name]' or user_id='$_POST[user_name]'");
		$row_u=$this->mysql_func->get_all_row($res_u);
		if($_POST['type']=='affliate')
		{
			//$update_arr['bonus']=1;
			//echo "update registration set bonus=1 where user_id='$row_u[user_id]'";exit;
			$this->mysql_func->query_execute("update registration set bonus=1,bonus_date='$bonus_date' where user_id='$row_u[user_id]'");
			$this->mysql_func->query_execute("update subscription set status=1 where user_id='$row_u[user_id]'");
$this->mysql_func->query_execute("insert into subscription set order_no='Admin',user_id='$row_u[user_id]',subs_fee='160',payment_mode='From Admin',subs_date='$bonus_date',end_date='$expire_date'");
			
			$user_id=$row_u['user_id'];
			
			$sql_check="select * from subscription where user_id='$user_id'";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check==1)
			{
				// get user sponsor and position
				$sql_user="select * from registration where user_id='$user_id'";
				$res_user=mysql_query($sql_user);
				$row_user=mysql_fetch_assoc($res_user);
				$ref_id=$row_user['ref_id'];
				// get sponsor power leg
				$sql_ref_leg="select power_leg from registration where user_id='$ref_id'";
				$res_ref_leg=mysql_query($sql_ref_leg);
				$row_ref_leg=mysql_fetch_assoc($res_ref_leg);
				$posi=$row_ref_leg['power_leg'];
				
				$nom_id=$this->spill_id1($ref_id,$posi);
				if($ref_id!='cmp')
				{
					$nom=$nom_id;
					$pos=$posi;
					//echo $nom.'='.$ref_id.'='.$posi;exit;
					$l=1;
					while($nom!='cmp')
					{
						if($nom!='cmp')
						{
							mysql_query("insert into level_income set invoice_no='$newID',purcheser_id='$user_id',income_id='$nom',level='$l',commission='',date=curdate(),invoice_amt='$amount',com_percent='',invoice_bv='$bv',closing='',status=0, position='$pos'"); 
						}
						$selectnompos=mysql_query("select binary_pos, nom_id from registration where user_id='$nom' ");
						$fetchnompos=mysql_fetch_array($selectnompos);
						$pos=$fetchnompos['binary_pos'];
						$nom=$fetchnompos['nom_id'];
						$l++;
					}
					mysql_query("update registration set nom_id='$nom_id',binary_pos='$posi',power_status='1',power_leg='left' where user_id='$user_id'");
				}
				// get product volume in the member package
			}
		}
		else if($_POST['type']=='reseller')
		{
			//$update_arr['reseller']=1;
			//echo "update registration set reseller=1 where user_id='$row_u[user_id]'";exit;
			$this->mysql_func->query_execute("update registration set reseller=1,reseller_date='$bonus_date' where user_id='$row_u[user_id]'");
			$res_subs_count=$this->mysql_func->query("id","subscription_member","user_id='$row_u[user_id]' and status=0");
				$count_subs_count=$this->mysql_func->num_row($res_subs_count);
				if($count_subs_count)
				{}
				else
				{
				$this->mysql_func->query_execute("update subscription_member set status=1 where user_id='$subs_user_id'");
				$subs_date=date('Y-m-d H:i:s');
				$date = strtotime($subs_date);
				$date = strtotime("+30 day", $date);
				$end_date=date('Y-m-d H:i:s', $date);
				$this->mysql_func->query_execute("insert into subscription_member set status=0,user_id='$subs_user_id',subs_date='$subs_date',end_date='$end_date',cat_duration=cat_duration+1");
				}
		}
		//  get user user_id
		
		/*$where="user_id='$row_u[user_id]'";
		
		echo "<pre>"; print_r($update_arr); exit;
		$this->mysql_func->update_tbl($update_arr,$table_name,$where);*/
		header("Location:admin_main.php?page_number=1&update=1&userid=".$user_id);
	}
	
	function _Set_Placement()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'registration';
		unset($_POST['search']);
		$sql_u=mysql_num_rows(mysql_query("select id from registration where user_id='$_POST[placement_id]'"));
		if($sql_u)
		{
			$this->mysql_func->query_execute("update registration set placement_id=$_POST[placement_id] where user_id='$_POST[user_id]'");
			header("Location:admin_main.php?page_number=158&update=1&userid=".$user_id);
		}
		else
		{
			header("Location:admin_main.php?page_number=158&update=1&userid=".$user_id);
		}
	}
	function _Change_Sponsor()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'registration';
		unset($_POST['search']);
		$sql_u=mysql_num_rows(mysql_query("select id from registration where user_id='$_POST[ref_id]'"));
		if($sql_u)
		{
			$this->mysql_func->query_execute("update registration set ref_id=$_POST[ref_id] where user_id='$_POST[user_id]'");
			header("Location:admin_main.php?page_number=159&update=1&userid=".$user_id);
		}
		else
		{
			header("Location:admin_main.php?page_number=159&update=1&userid=".$user_id);
		}
	}
	
	function _AddCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'category_shop';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='c_id' && $val!='')
			{
				$flag=true;
				$where=" c_id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//echo "<pre>"; print_r($update_arr);exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=9&update=1");
	}
	function _AddCmsCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_category';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=27&update=1");
	}
	
	
	function _AddCountry()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'country';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=184&update=1");
	}
	
	
	
	function _AddCmsBackOfficeCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_category_backoffice';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
				$product_id=$val;
			}
			else if($key=='old_icon')
			{
				$update_arr['icon']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="cmsbackoffice/";
			$pdf=$this->mysql_func->file_image($path,$file_path.'cmsbackoffice/');
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_ar=array("icon"=>$pdf);
				$where=" id='$product_id'";
				$msg="Icon uploaded";
				$this->mysql_func->update_tbl($update_ar,$table_name,$where);
			}
		}
		else if(isset($_POST['old_icon']) && $_POST['old_icon'])
		{
			$old_icon=$_POST['old_icon'];
		}

		header("Location:admin_main.php?page_number=165&update=1");
	}
	function _AddCmsBackOfficeSubCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_subcategory_backoffice';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where=" id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=168&update=1");
	}
	function _AddSubCategory()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'subcategory';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='sub_id')
			{
				$flag=true;
				$where=" sub_id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		header("Location:admin_main.php?page_number=11&update=1");
	}
	
	function get_product_price($p_id,$c_id)
{
	
	if($c_id!='')
	{
	$q=mysql_query("select * from product_price where product_id='$p_id' and country_id='$c_id'") or die(mysql_error());
	$r=mysql_fetch_assoc($q);
	$price=$r['product_price'];
	}
	else
	{
		$c=mysql_fetch_assoc(mysql_query("select * from country where country_name='Other'"));
		
	$q=mysql_query("select * from product_price where product_id='$p_id' and country_id='".$c['id']."'") or die(mysql_error());
	$r=mysql_fetch_assoc($q);
	$price=$r['product_price'];
}
return $price;

}
	
	
	
	function _AddProduct()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'product_category';
		
		$flag=false;
		
		
		 $pid=$_POST['p_cat_id'];
		$quantity=$_POST['p_qty'];
		$add_date=date("Y-m-d");
		$remark=$qauntity." products added by admin";
		
		
		
			mysql_query("insert into stock_to_sell_history set product_id='$pid',quantity='$quantity',add_by='admin',remark='$remark', add_date='$add_date'") or die(mysql_error());	
		
		foreach($_POST as $key=>$val)
		{
			if($key=='p_cat_id')
			{
				$flag=true;
				
				$where="p_cat_id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else if($key=='old_product_pdf')
			{
				$update_arr['product_pdf']=mysql_real_escape_string($val);
			}
			
			else
			{
				if($key=='pro_desc')
				{
					$update_arr[$key]=$val;
				//$update_arr[$key]=addslashes($val);
				}
				else
				{
					$update_arr[$key]=$val;
				//$update_arr[$key]=mysql_real_escape_string($val);
				}
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where; exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['p_cat_id'];
			$country_id1=$_POST['country_id'];
			$product_price1=$_POST['product_price'];
			
			for($i=0; $i<count($country_id1); $i++)
			{
			$product_price=$product_price1[$i];
			$country_id=$country_id1[$i];	
				
			$q=mysql_query("select * from product_price where product_id='$product_id' and country_id='$country_id'") or die(mysql_error());
			$n=mysql_num_rows($q);
			if($n>0)
			{
			mysql_query("update product_price set product_price='$product_price' where product_id='$product_id' and country_id='$country_id'") or die(mysql_error()); 
			}
			else
			{
				mysql_query("insert into product_price set product_price='$product_price', product_id='$product_id', country_id='$country_id'") or die(mysql_error());
			}
			}
			
			
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
			$country_id1=$_POST['country_id'];
			$product_price1=$_POST['product_price'];
			
			for($i=0; $i<count($country_id1); $i++)
			{
			$product_price=$product_price1[$i];
			$country_id=$country_id1[$i];
			mysql_query("insert into product_price set product_price='$product_price', product_id='$product_id', country_id='$country_id'") or die(mysql_error());
			}
			
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['image']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="";
			$image=$this->mysql_func->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" p_cat_id='$product_id'";
				$msg="image uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
			
		}
		if($_FILES['product_pdf']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="product_pdf";
			$pdf=$this->mysql_func->upload_files($path,'product_pdf');
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_arr=array("product_pdf"=>$pdf);
				$where=" p_cat_id='$product_id'";
				$msg="PDF uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_product_pdf']) && $_POST['old_product_pdf'])
		{
			$pdf=$_POST['old_product_pdf'];
		}
		
		if($_FILES['product_exe']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="product_exe";
			$pdf=$this->mysql_func->upload_files($path,'product_exe');
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_arr=array("product_exe"=>$pdf);
				$where=" p_cat_id='$product_id'";
				$msg="EXE uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_product_exe']) && $_POST['old_product_exe'])
		{
			$pdf=$_POST['old_product_exe'];
		}
		
		if($_FILES['product_zip']['name']!='')
		{
			$file_path="../product_logos/"; 
			$path="product_zip";
			$pdf=$this->mysql_func->upload_files($path,'product_zip');
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_arr=array("product_zip"=>$pdf);
				$where=" p_cat_id='$product_id'";
				$msg="ZIP uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_product_zip']) && $_POST['old_product_zip'])
		{
			$pdf=$_POST['old_product_zip'];
		}
		
		header("Location:admin_main.php?page_number=13&update=1&msg=".$msg);
	}
	
	
	function _AddMoreProductImage()
	{
		
		$product_id=$_POST['p_id']; 
		 $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $query="INSERT into images(`id`,`p_id`,`p_image`,`status`) VALUES(NULL,'$product_id','$file_name','1')";
        $desired_dir="../product_logos/thumb";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"../product_logos/thumb/".$file_name);
            }else{									//rename the file if another one exist
                $new_dir="../product_logos/thumb/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
            mysql_query($query) or die(mysql_error());			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		$msg= "Success";
	}
	header("Location:admin_main.php?page_number=176&pid=".$product_id."&msg=".$msg);
	}
	
	function _Update_Logo()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'logo';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_logo')
			{
				$update_arr['logo']=mysql_real_escape_string($val);
			}
			else if($key=='old_favicon')
			{
				$update_arr['favicon']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			//$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['logo']['name']!='')
		{
			$file_path="../images/logo/"; 
			$path="";
			$file='logo';
			
			$image=$this->mysql_func->file_image_logo($path,$file_path,$file);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("logo"=>$image);
				$where=" id='$product_id'";
				$msg="logo uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_logo']) && $_POST['old_logo']!='')
		{
			
		}
		if($_FILES['favicon']['name']!='')
		{
			$file_path="../images/favicon/"; 
			$path="favicon";
			$file='favicon';
			$pdf=$this->mysql_func->file_image_logo($path,$file_path,$file);;
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($pdf,$error_array))
			{
				$msg=$pdf;
			}
			else
			{
				$update_arr=array("favicon"=>$pdf);
				$where=" id='$product_id'";
				$msg="favicon uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_favicon']) && $_POST['old_favicon'])
		{
			$favicon=$_POST['old_favicon'];
		}
		header("Location:admin_main.php?page_number=156&update=1&msg=".$msg);
	}
	function _Add_Marketing()
	{
		//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
		$table_name=TABLE_PREFIX.'materials';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='m_id' && $val!='')
			{
				$flag=true;
				$where="m_id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['p_cat_id'];
		}
		else
		{
			$update_arr['m_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		if($_FILES['image']['name']!='')
		{
			$file_path="../materials/"; 
			$path="";
			$image=$this->mysql_func->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("material"=>$image);
				$where=" m_id='$product_id'";
				$msg="image uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		header("Location:admin_main.php?page_number=26&update=1&msg=".$msg);
	}
	function _Add_Faq()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'faq';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=26&update=1&msg=".$msg);
	}
	function _Add_Cms()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=29&update=1&msg=".$msg);
	}
	function _Add_Cms_BackOffice()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_backoffice';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=167&update=1&msg=".$msg);
	}
	function _Add_Cms_Seven()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_seven';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				if($key=='content')
				{
					$update_arr[$key]=stripslashes($val);
				}
				else
				{
					$update_arr[$key]=mysql_real_escape_string($val);
				}
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=153&update=1&msg=".$msg);
	}
	function _Add_Cms_Home_Top()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_home_top';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=31&update=1&msg=".$msg);
	}
	function _Add_Cms_Home_Footer()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_home_footer';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=32update=1&msg=".$msg);
	}
	function _Add_Cms_Home()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_home';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=30&update=1&msg=".$msg);
	}
	function _Add_Cms_Latest_Work()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_latest_work';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../client_image/"; 
			$path="";
			$image=$this->mysql_func->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" id='$product_id'";
				$msg="image uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=33&update=1&msg=".$msg);
	}
	function _Add_Cms_Client_Say()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_client_say';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../client_image/"; 
			$path="";
			$image=$this->mysql_func->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" id='$product_id'";
				$msg="image uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=34&update=1&msg=".$msg);
	}
	function _Add_Cms_Recent_Post()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'cms_recent_post';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else if($key=='old_image')
			{
				$update_arr['image']=mysql_real_escape_string($val);
			}
			else
			{
				
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$product_id=$_POST['id'];
		}
		else
		{
			//$update_arr['add_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$product_id=$this->mysql_func->get_pid();
		}
		if($_FILES['image']['name']!='')
		{
			$file_path="../client_image/"; 
			$path="";
			$image=$this->mysql_func->file_image($path,$file_path);
			// error_array
			$error_array=array('error_upload','error_type','error_ext');
			if(in_array($image,$error_array))
			{
				$msg=$image;
			}
			else
			{
				$update_arr=array("image"=>$image);
				$where=" id='$product_id'";
				$msg="image uploaded";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
		}
		else if(isset($_POST['old_image']) && $_POST['old_image']!='')
		{
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=35&update=1&msg=".$msg);
	}
	function _Add_Fund()
	{
		//echo "<pre>"; print_r($_POST); exit;
		// get user id from user_name field and check for valid user
		$arr_history=array("final_e_wallet"=>"credit_debit","final_tp"=>"final_tp_history","final_tfs"=>"final_tfs_history");
		$user_name=$_POST['user_name'];
		$wallet_type='final_e_wallet';
		$table_history='credit_debit';
		$remark="Fund Transfer By Admin ";
		
		if($_POST['admin_type']=='super_admin')
				{
					 $country_search= "";
					
				}
				else
				{
					 $country_search= "and (country='".$_POST['country_id']."' or country='".$_POST['country_name']."')";
				}
		$res_user=$this->mysql_func->query("*","registration"," (user_name='$user_name' or user_id='$user_name') $country_search");
		$count_user=$this->mysql_func->num_row($res_user);
		//echo $count_user;exit;
		if($count_user)
		{
			$row_user=$this->mysql_func->get_all_row($res_user);
			$user_id=$row_user['user_id'];
			$table_name=TABLE_PREFIX.$wallet_type;
			$amount=$_POST['amount'];
			$query=" update $table_name set amount=amount+$amount where user_id='$user_id'";
			$this->mysql_func->query_execute($query);
			$curdate=date('Y-m-d');
			$final_bal=$this->mysql_func->get_field_name($table_name,"amount","user_id='$user_id'");
			$insert_arr=array(
			"user_id"=>$user_id,
			"credit_amt"=>$amount,
			"debit_amt"=>'0',
			"receiver_id"=>$user_id,
			"sender_id"=>'Admin',
			"receive_date"=>$curdate,
			"TranDescription"=>$remark,
			"Remark"=>$remark,
			"final_bal"=>$final_bal
			);
			$this->mysql_func->insert_tbl($insert_arr,$table_history);
			$update=1;
			$error=0;
			$msg="Fund Added To User Wallet";
		}
		else
		{
			$update=0;
			$error=1;
			$msg="Wrong User";
		}
		header("Location:admin_main.php?page_number=57&update=".$update."&error=".$error."&msg=".$msg);
	}
	function _Deduct_Fund()
	{
		//echo "<pre>"; print_r($_POST); exit;
		// get user id from user_name field
		$arr_history=array("final_e_wallet"=>"credit_debit","final_tp"=>"final_tp_history","final_tfs"=>"final_tfs_history");
		$user_name=$_POST['user_name'];
		$wallet_type='final_e_wallet';
		$table_history='credit_debit';
		$remark="Fund Deducted By Admin ";
		
		 if($_POST['admin_type']=='super_admin')
				{
					 $country_search= "";
					
				}
				else
				{
					 $country_search= "and (country='".$_POST['country_id']."' or country='".$_POST['country_name']."')";
				}
		
		$res_user=$this->mysql_func->query("*","registration"," (user_name='$user_name' or user_id='$user_name') $country_search");
		$row_user=$this->mysql_func->get_all_row($res_user);
		$count_user=$this->mysql_func->num_row($res_user);
		if($count_user)
		{
			$user_id=$row_user['user_id'];
			$table_name=TABLE_PREFIX.$wallet_type;
			$amount=$_POST['amount'];
			// check user wallet before deduct
			$res_amount=$this->mysql_func->query("*",$table_name," user_id='$user_id'");
			$row_amount=$this->mysql_func->get_all_row($res_amount);
			$count_amount=$this->mysql_func->num_row($res_amount);
			if($row_amount['amount']>=$_POST['amount'])
			{
				$query=" update $table_name set amount=amount-$amount where user_id='$user_id'";
				$this->mysql_func->query_execute($query);
				$curdate=date('Y-m-d');
				$final_bal=$this->mysql_func->get_field_name($table_name,"amount","user_id='$user_id'");
				$insert_arr=array(
				"user_id"=>$user_id,
				"credit_amt"=>'0',
				"debit_amt"=>$amount,
				"receiver_id"=>'Admin',
				"sender_id"=>$user_id,
				"receive_date"=>$curdate,
				"TranDescription"=>$remark,
				"Remark"=>$remark,
				"final_bal"=>$final_bal
				);
				$this->mysql_func->insert_tbl($insert_arr,$table_history);
				$update=1;
				$error=0;
				$msg="Fund Deducted From User Wallet";
			}
			else
			{
				$update=0;
				$error=1;
				$msg="User Dont Have Enough Amount In Wallet";
			}
		}
		else
		{
			$update=0;
			$error=1;
			$msg="Wrong User";
		}
		header("Location:admin_main.php?page_number=58&update=".$update."&error=".$error."&msg=".$msg);
	}
	function _Close_Ticket()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$curdate=date('Y-m-d');
		$table_name=TABLE_PREFIX."tickets";
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr=array("status"=>1,"response"=>$_POST['response'],"c_t_date"=>$curdate);
			$where=" id='$val'";
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		$update=1;
		$error=0;
		$msg="Resonse To Support Tickets.";
		header("Location:admin_main.php?page_number=41&update=".$update."error=".$error."&msg=".$msg);
	}
	
	function _Close_Withdraw_Bank()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$curdate=date('Y-m-d');
		 $table_name=TABLE_PREFIX."withdraw_fund";
		
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr=array("status"=>1,"response"=>$_POST['response'],"varify_date"=>$curdate);
			$where=" id='$val'";
			
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		$update=1;
		$error=0;
		$msg="Bank Transfer Confirm.";
		header("Location:admin_main.php?page_number=43&update=".$update."error=".$error."&msg=".$msg);
	}
	
	function BV_Price()
{
	$bvQry=mysql_query("select * from bv_price") or die(mysql_error());
		$rowBv=mysql_fetch_assoc($bvQry);
		$bv=$rowBv['bv'];
		$price=$rowBv['price'];
		$finalbv=$price/$bv;
		return $finalbv;
}
	
	
	function _Repurchase_Binary_Income()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$curdate=date('Y-m-d');
		 $table_name=TABLE_PREFIX."repurchase_binary_income";
		
		
		foreach($_POST['id'] as $key=>$val)
		{
			
			$q=mysql_fetch_assoc(mysql_query("select * from $table_name where id='$val' and status=0"));
			$cycle=$q['income_pair'];
			
			
			$commission=$cycle*$_POST['response'];
			
			
			//calculate commission on product volume
			$finalbv=$this->BV_Price();
			$commission_bv=$commission;
			$commission=$commission*$finalbv;
			//calculate tds and miscellaneous amount
			//$row= mysql_fetch_assoc(mysql_query("select * from repurchase_binary_income where id='$val'") or die(mysql_error()));
			
			
		$uid=$q['user_id'];
		$comRemark=$q['com_percent'];
		$invoice_no=$q['invoice_no'];
		$final_amount=$q['final_amount'];
			
			$tds_percent=$q['tds_percent'];
			$miscellaneous_percent=$q['miscellaneous_percent'];
			$tds_amount=($commission*$tds_percent)/100;
			$miscellaneous_amount=($commission*$miscellaneous_percent)/100;
			$final_amount=$commission-($tds_amount+$miscellaneous_amount);
		/////////end/////////////
			
			$update_arr=array("status"=>1,"commission_bv"=>$commission_bv,"commission"=>$commission,
			"tds_amount"=>$tds_amount,
			"miscellaneous_amount"=>$miscellaneous_amount,
			"final_amount"=>$final_amount);
			$where=" id='$val'";
			
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			
			
			
			mysql_query("update final_e_wallet set amount=amount+$final_amount where user_id='$user_id'");
				$inserarr=array(
					"user_id"=>$uid,
					"credit_amt"=>$final_amount,
					"debit_amt"=>'0',
					"receiver_id"=>$uid,
					"sender_id"=>$uid,
					"receive_date"=>$to_date,
					"TranDescription"=>"Get $comRemark % as Repurchase Bonus ",
					"Remark"=>"Get $comRemark % as as Repurchase Bonus",
					"invoice_no"=>$invoice_no
					);
					$this->mysql_func->insert_tbl($inserarr,"credit_debit");
			
			
		}
		$update=1;
		$error=0;
		$msg="Update Repurchase Binary Income";
		header("Location:admin_main.php?page_number=185&update=".$update."error=".$error."&msg=".$msg);
	}
	
	function _Add_Package()
	{
		$table_name=TABLE_PREFIX.'package';
		$flag=false;
		//print_r($_POST);
		
		foreach($_POST as $key=>$val)
		{
			//print_r($key);
			//
			if($key=='id')
			{
				$flag=true;
				$where="package_id='$val'";
				
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=156&update=1&msg=".$msg);
	}

	
	function _Add_Announcement()
	{
		$table_name=TABLE_PREFIX.'promo';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="n_id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			$update_arr['n_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been updated successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=45&update=1&msg=".$msg);
	}
	
	function adminuserid()
	{
		//$encypt1=uniqid(rand(), true);
		$table_name=TABLE_PREFIX.'admin_master';
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select userid from $table_name where userid='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	
	
	// Add new user
	 function _AddUser(){
	
		// check category field has value or not
		if(isset($_POST['fname']) && isset($_POST['email'])  && isset($_POST['username']) && isset($_POST['password']) ){
				
			if( !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) ){
					
				//global $mxDb;
	
				$user_id = $this->adminuserid();
	
				//Update Contact Us
				$insert = array(
						'fname'=>$_POST['fname'],
						'uid'=>$user_id,
						'userid'=>$_POST['username'],
						'country'=>$_POST['country'],
						'password'=>$_POST['password'],
						'email'=>$_POST['email'],
						'user_type'=>'sub_admin',
						'add_date'=>date('Y-m-d'),
						'ts'=>date('Y-m-d H:i:s')
				);
	
				if($this->mysql_func->insert_tbl($insert,'admin_master')){
						
					// insert privileage
					$privileage = $_POST['privileage'];
						
					foreach( $privileage as $privil){
	
						$insert_array = array(
								'privilege_page'=>$privil,
								'date'=>date('Y-m-d'),
								'add_date_time'=>date('Y-m-d H:i:s'),
								'admin_id'=>$user_id
						);
	
						$this->mysql_func->insert_tbl($insert_array, 'admin_privileges');
	
					}
						
					header("Location:admin_main.php?page_number=188&msg=Add user successfully!&res=1");
				}
				else{
					header("Location:admin_main.php?page_number=188&msg=Failed record insertion!&res=1");
				}
			}
			else
				header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
		}
		else
			header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
	
	}
	



	// Update User report
	function _UpdateUser(){
	
		// check category field has value or not
		if(isset($_POST['fname']) && isset($_POST['email'])  && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['id']) ){
			
			//exit;
				
			if( !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['id']) ){
					
					
				//global $mxDb;
	
				$user_id = $_POST['id'];
	
	
	            $res=mysql_fetch_array(mysql_query("select * from admin_master where uid='$user_id'"));
				$res1=$res['password'];
				
				//echo $res1;print_r("<br/>");
				//echo $_POST['password'];
				
	            if($res1==$_POST['password'])
				{
					$update = array(
						'fname'=>$_POST['fname'],
						'userid'=>$_POST['username'],
						'country'=>$_POST['country'],
						'email'=>$_POST['email']
				);
				}
				else
				{
	
				//Update Contact Us
				$update = array(
						'fname'=>$_POST['fname'],
						'userid'=>$_POST['username'],
						'country'=>$_POST['country'],
						'password'=>$_POST['password'],
						'email'=>$_POST['email']
				);
				}
	
				$where = " uid=".$user_id;
	
				if($this->mysql_func->update_tbl($update,'admin_master', $where )){
						
					// delete old privileage
					//$mxDb->delete_record('admin_privileges', "admin_id='".$user_id."'");
					mysql_query("delete from admin_privileges where admin_id='$user_id'") or die(mysql_error());	
					// insert privileage
					$privileage = $_POST['privileage'];
						
					foreach( $privileage as $privil){
	
						$insert_array = array(
								'privilege_page'=>$privil,
								'date'=>date('Y-m-d'),
								'add_date_time'=>date('Y-m-d H:i:s'),
								'admin_id'=>$user_id
						);
	
						$this->mysql_func->insert_tbl($insert_array,'admin_privileges' );
	
					}
						
					header("Location:admin_main.php?page_number=188&msg=Update User successfully!&res=1");
				}
				else{
					header("Location:admin_main.php?page_number=188&msg=Failed record updation!&res=1");
				}
			}
			else
				header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
		}
		else
			header("Location:admin_main.php?page_number=188&msg=Please fill fields information!&res=0");
	
	}
	
	
	
	
	
	
	
	
	
	function _Add_Member_Remark()
	{
		$table_name=TABLE_PREFIX.'static_page';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['n_date']=date('Y-m-d');
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=46&update=1&msg=".$msg);
	}
	function _AddPackage()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name=TABLE_PREFIX.'member_package';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$update=1;
			$error=0;
			$msg="Package Updated Successfully.";
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$update=1;
			$error=0;
			$msg="Package Created Successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=36&update=1&msg=".$msg);
	}
	function _ADD_Social_Page()
	{
		$table_name=TABLE_PREFIX.'social_media_page';
		$flag=false;
		unset($update);
		//echo "<pre>"; print_r($_POST);
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!=0)
			{
				$flag=true;
				echo $val;
			}
			else
			{
				$update['page_name'][]=$key;
				$update['link'][]=mysql_real_escape_string($val);
			}
		}
		//print_r($update);exit;
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			foreach($update['page_name'] as $keys=>$value)
			{
				if($value=='id')
				{}
				else
				{
				$update_arr['page_name']=$value;
				$update_arr['link']=$update['link'][$keys];	
				$where="page_name='$value'";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				}
			}
			$update=1;
			$error=0;
			$msg="Updated Successfully.";
		}
		else
		{
			$update_arr['add_date']=date('Y-m-d');
			foreach($update['page_name'] as $keys=>$value)
			{
				if($value=='id')
				{}
				else
				{
				$update_arr['page_name']=$value;
				$update_arr['link']=$update['link'][$keys];	
				//$where="page_name='$value'";
				//print_r($update_arr);exit;
				$this->mysql_func->insert_tbl($update_arr,$table_name);
				}
			}
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			$update=1;
			$error=0;
			$msg="Inserted Successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=38&update=1&msg=".$msg);	
	}
	function _product_validity($pid)
	{
		$res=$this->mysql_func->query("p_cat_id","product_category","p_cat_id in ($pid)");
		$count=$this->mysql_func->num_row($res);
		//echo "_product_validity:".$count."<br>";
		if($count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function _product_avalidity($pid,$user_id,$table_name)
	{
		$res=$this->mysql_func->query("id",$table_name,"product_id='$pid' and user_id='$user_id' and status=0");
		$count=$this->mysql_func->num_row($res);
		//echo "_product_avalidity:".$count."<br>";
		if($count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function _product_thirty($user_id,$table_name,$temp_count)
	{
		//echo $pid.'=='.$user_id;
		$res=$this->mysql_func->query("id",$table_name,"user_id='$user_id' and status=0");
		$count=$this->mysql_func->num_row($res);
		//echo "_product_thirty:".$count."<br>"; exit;
		if($count<$temp_count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function _Add_Stock_To_Sell()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'stock_to_sell';
		$table_name1=TABLE_PREFIX.'stock_to_sell_mp';
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr['user_id']=$val;
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($this->_product_validity($pid) && !$this->_product_avalidity($pid,$val,"stock_to_sell_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			
			$update['user_id']=$val;
			//$product_code_arr=explode(",",$product_code);
			//echo "<pre>"; print_r($pid_arr);exit;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($this->_product_thirty($val,"stock_to_sell_mp",30))
				{
					$this->mysql_func->insert_tbl($update,$table_name1);
				}
			}
			// start to check user already mapped or not
			/*$res_check=$this->mysql_func->query("id",$table_name,"user_id='$val'");
			$count_chekc=$this->mysql_func->num_row($res_check);
			//echo $count_chekc;exit;
			if($count_chekc)
			{
				// find all products mapped and update 
				$where="user_id='$val'";
				$res_map=$this->mysql_func->query("product_id",$table_name1,"user_id='$val'");
				$product_map=array();
				while($row_map=$this->mysql_func->num_row($res_map))
				{
					$product_map[]=$row_map['product_id'];
				}
				$product_string=implode(",",$product_map);
				$update_arr['product_id']=$product_string;
				$this->mysql_func->update_tbl($update,$table_name,$where);
			}
			else
			{
				$this->mysql_func->insert_tbl($update_arr,$table_name);
			}*/
		}
		header("Location:admin_main.php?page_number=15&update=1&msg=".$msg);	
	}
	function _Add_Weekly_Adds()
	{
		//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'weekly_adds';
		$table_name1=TABLE_PREFIX.'weekly_adds_mp';
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr['user_id']=$val;
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($this->_product_validity($pid) && !$this->_product_avalidity($pid,$val,"weekly_adds_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			
			$update['user_id']=$val;
			//$product_code_arr=explode(",",$product_code);
			//echo "<pre>"; print_r($pid_arr);exit;
			$sn=1;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_count']=$sn;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($this->_product_thirty($val,"weekly_adds_mp",5))
				{
					$this->mysql_func->insert_tbl($update,$table_name1);
				}
				$sn++;	
			}
			// start to check user already mapped or not
			/*$res_check=$this->mysql_func->query("id",$table_name,"user_id='$val'");
			$count_chekc=$this->mysql_func->num_row($res_check);
			//echo $count_chekc;exit;
			if($count_chekc)
			{
				// find all products mapped and update 
				$where="user_id='$val'";
				$res_map=$this->mysql_func->query("product_id",$table_name1,"user_id='$val'");
				$product_map=array();
				while($row_map=$this->mysql_func->num_row($res_map))
				{
					$product_map[]=$row_map['product_id'];
				}
				$product_string=implode(",",$product_map);
				$update_arr['product_id']=$product_string;
				$this->mysql_func->update_tbl($update,$table_name,$where);
			}
			else
			{*/
				//echo " update weekly_adds set status=1 where user_id='$val'";exit;
				mysql_query(" update weekly_adds set status=1 where user_id='$val'");
				$this->mysql_func->insert_tbl($update_arr,$table_name);
			/*}*/
		}
		header("Location:admin_main.php?page_number=17&update=1&msg=".$msg);	
	}
	function _Set_Power_Leg()
	{
		$power_leg=$_POST['power_leg'];
		$power_status=$_POST['power_status'];
		$user_id=$_POST['user_id'];
		$table_name=TABLE_PREFIX.'registration';
		//echo "<pre>"; print_r($_POST);exit;
		// check the old password is valid or not
		$res=$this->mysql_func->query("*",$table_name," user_id='$user_id'");
		$count=$this->mysql_func->num_row($res);
		if($count)
		{
				$curdate=date('Y-m-d');
				$update_arr=array("power_leg"=>$power_leg,"power_status"=>$power_status);
				$where=" user_id='$user_id'";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Set Power Leg and Status Successfully.";
		}
		else
		{
			$msg="Wrong User.";
		}
		header("Location:admin_main.php?page_number=150&update=1&msg=".$msg);	
	}
	
	function _Payment_Bank()
	{
		//echo "<pre>"; print_r($_POST);exit;
		$table_name="bank_detail";
		unset($_POST['type']);
		foreach($_POST as $key=>$val)
		{
			if($key=='id' && $val!='')
			{
				$where="id='$val'";
				$flag=true;
			}
			else
			{
				$update_arr[$key]=$val;
			}
		}
		//echo "<pre>"; echo $where;print_r($update_arr); exit;
			if($flag)
			{
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else
			{
				$this->mysql_func->insert_tbl($update_arr,$table_name);
			}
		header("Location:admin_main.php?page_number=163");
	}
	
	function _change_password()
	{
		$old_pass=$_POST['old_password'];
		$new_pass=$_POST['new_password'];
		$c_pass=$_POST['confirm_password'];
		$userid=USERNAME;
		$table_name=TABLE_PREFIX.'admin';
		// check the old password is valid or not
		$res=$this->query("*",$table_name," userid='$userid' and password='$old_pass'");
		$count=$this->num_row($res);
		if($count)
		{
			if($new_pass==$c_pass)
			{
				$curdate=date('Y-m-d');
				$update_arr=array("password"=>$new_pass,"modify_by"=>USERNAME,"modify_date"=>$curdate);
				$where=" id='$id'";
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Password Change Successfully.";
			}
			else
			{
				$msg="Password and Confirm Password Should Be Same.";
			}
		}
		else
		{
			$msg="Wrong Old Password.";
		}
	}
	
	function _Add_Page()
	{
		$table_name=TABLE_PREFIX.'manage_pages';
		$flag=false;
		//print_r($_POST);
		str_replace('\"', '"',$_POST['page_desc']);
		foreach($_POST as $key=>$val)
		{
			//print_r($key);
			
			//
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
				
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		
		if($flag)
		{
		
			$update_arr['page_desc'] = $_POST['page_desc'];
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			$update_arr['page_desc'] = $_POST['page_desc'];
			
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=165&update=1&msg=".$msg);
	} 
	
	function _Add_Page_Sub()
	{
		
		$table_name=TABLE_PREFIX.'manage_content';
		$flag=false;
		//print_r($_POST);
		str_replace('\"', '"',$_POST['page_desc']);

		foreach($_POST as $key=>$val)
		{
			//print_r($key);
			//
			if($key=='page_id')
			{
				$page_id = $_POST['page_id'];
			}
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		//exit();
		if($flag)
		{
			$update_arr['page_desc'] = $_POST['page_desc'];
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//print_r($update_arr);
			$update_arr['page_desc'] = $_POST['page_desc'];
			$this->mysql_func->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=27&id=$page_id&update=1&msg=".$msg);
	} 

	function _Add_Steps()
	{
		$table_name=TABLE_PREFIX.'manage_steps';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		str_replace('\"', '"',$_POST['step_desc']);

		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$update_arr['step_desc'] = $_POST['step_desc'];
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$update_arr['step_desc'] = $_POST['step_desc'];
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=175&update=1&msg=".$msg);
	} 

	function makeURLFriendly($input)
	{
		$output = strtolower($input);
		$output = preg_replace("/[^[:space:]a-z0-9]/e", "", $output);
		$output = preg_replace("/\\s/", "_", $output);
		$output = trim($output);
		$output = preg_replace('/\s\s+/', '_', $output);
		return $output;
	}
	
	function _Add_News()
	{

		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"news_image/".$image2);
			$ap_img="image='$image2'";
		}

		$table_name=TABLE_PREFIX.'manage_news';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);
			if($key=='cat_id')
			{
				$cat_id = $_POST['cat_id'];
			}
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=($val);
				$update_arr['image']=($image2);
			}
		}
		if($flag)
		{
			if(isset($_POST['cat_id']))
			{
				$cat_id = implode(',',$_POST['cat_id']);
			}

			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=($image2);
				$update_arr['cat_id']=($cat_id);
				$this->mysql_func->update_tbl1($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
			
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_news where id='".$_POST['id']."'"));
				$update_arr['image']=$select['image'];
				$update_arr['cat_id']=($cat_id);

				$this->mysql_func->update_tbl1($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
		}
		else
		{
			if(isset($_POST['cat_id']))
			{
				$cat_id = implode(',',$_POST['cat_id']);
			}
			//print_r($update_arr);
			$update_arr['cat_id']=($cat_id);

			$this->mysql_func->insert_tbl1($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=32&update=1&cat_id=".$cat_id."&msg=".$msg);
	} 
	

function _Add_Slider()
	{
		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"slider_image/".$image2);
			$ap_img="image='$image2'";
		}

		$table_name=TABLE_PREFIX.'manage_slider';
		$flag=false;

		$cur_date=date('Y-m-d');
		
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['image']=mysql_real_escape_string($image2);
			}
		}
		if($flag)
		{
			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=mysql_real_escape_string($image2);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_slider where id='".$_POST['id']."'"));
				
				$update_arr['image']=$select['image'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=28&update=1&msg=".$msg);
	} 
	function _Add_Team()
	{
		
		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"team_image/".$image2);
			$ap_img="image='$image2'";
		}

		$table_name=TABLE_PREFIX.'manage_team';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['image']=mysql_real_escape_string($image2);
			}
		}
		if($flag)
		{
			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=mysql_real_escape_string($image2);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_team where id='".$_POST['id']."'"));
				$update_arr['image']=$select['image'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=34&update=1&msg=".$msg);
	} 
	function _Add_Project()
	{
		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"project_image/".$image2);
			$ap_img="image='$image2'";
		}
		
		$table_name=TABLE_PREFIX.' manage_projects';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['image']=mysql_real_escape_string($image2);
			}
		}
		if($flag)
		{
			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=mysql_real_escape_string($image2);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_projects where id='".$_POST['id']."'"));
				$update_arr['image']=$select['image'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
		}
		else
		{
				//print_r($update_arr);
				$this->mysql_func->insert_tbl($update_arr,$table_name);
				$msg="Record has been inserted successfully.";

		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=31&update=1&msg=".$msg);
	} 
	
	function _Add_Partner()
	{
		
		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"partner_image/".$image2);
			$ap_img="image='$image2'";
		}

		$table_name=TABLE_PREFIX.'manage_partner';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['image']=mysql_real_escape_string($image2);
			}
		}
		if($flag)
		{
			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=mysql_real_escape_string($image2);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_partner where id='".$_POST['id']."'"));
				$update_arr['image']=$select['image'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=35&update=1&msg=".$msg);
	} 


	function _Add_Features()
	{
		$table_name=TABLE_PREFIX.'manage_member_area_features';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=166&update=1&msg=".$msg);
	} 
	
	function _Add_Program()
	{
		$table_name=TABLE_PREFIX.'manage_program_events';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=167&update=1&msg=".$msg);
	} 


	function _Add_Category()
	{
		$table_name=TABLE_PREFIX.'manage_category_news';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=195&update=1&msg=".$msg);
	} 
	
	function _Add_Testi()
	{
		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"testimonial_image/".$image2);
			$ap_img="image='$image2'";
		}


		$table_name=TABLE_PREFIX.'manage_testimonials';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['image']=mysql_real_escape_string($image2);
			}
		}
		if($flag)
		{
			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=mysql_real_escape_string($image2);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_testimonials where id='".$_POST['id']."'"));
				$update_arr['image']=$select['image'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
				$msg="Record has been updated successfully.";
			}
		}

		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=197&update=1&msg=".$msg);
	} 

	function _Add_How()
	{
		$table_name=TABLE_PREFIX.'manage_how_it_other';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		str_replace('\"', '"',$_POST['second_desc']);
		str_replace('\"', '"',$_POST['third_desc']);
			
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$update_arr['third_desc'] = $_POST['third_desc'];
			$update_arr['second_desc'] = $_POST['second_desc'];
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$update_arr['third_desc'] = $_POST['third_desc'];
			$update_arr['second_desc'] = $_POST['second_desc'];
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=198&update=1&msg=".$msg);
	} 

	function _Add_Slider_News()
	{
		if(isset($_REQUEST['news_id']))
		{
			$news_id=$_REQUEST['news_id'];
		}

		if(isset($_FILES['image']['name']))
		{
			if($_FILES['image']['name']!='')
			$file=$_FILES['image']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['image']['tmp_name'],"news_slider/".$image2);
			$ap_img="image='$image2'";
		}

		$table_name=TABLE_PREFIX.'manage_news_slider';
		$flag=false;

		$cur_date=date('Y-m-d');
		
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['image']=mysql_real_escape_string($image2);
				$update_arr['news_id']=mysql_real_escape_string($news_id);
			}
		}
		if($flag)
		{
			if($_FILES['image']['name']!='')
			{
				$update_arr['image']=mysql_real_escape_string($image2);
				$update_arr['news_id']=mysql_real_escape_string($news_id);

				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select image from manage_news_slider where id='".$_POST['id']."'"));
				
				$update_arr['image']=$select['image'];
				$update_arr['news_id']=mysql_real_escape_string($news_id);

				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$update_arr['news_id']=mysql_real_escape_string($news_id);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=196&news_id=$news_id&update=1&msg=".$msg);
	} 

	function _Add_business()
	{
		$table_name=TABLE_PREFIX.'manage_category_business';
		$flag=false;

		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			$msg="Record has been inserted successfully.";
		}
		
		header("Location:admin_main.php?page_number=206&update=1&msg=".$msg);
	} 

	function _Add_b_c()
	{
		if(isset($_REQUEST['busi_cat']))
		{
			$busi_cat=$_REQUEST['busi_cat'];
		}

		$table_name=TABLE_PREFIX.'manage_b_cat';
		$flag=false;

		$cur_date=date('Y-m-d');
		
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['busi_cat']=mysql_real_escape_string($busi_cat);
			}
		}
		if($flag)
		{
			$update_arr['busi_cat']=mysql_real_escape_string($busi_cat);
			$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$update_arr['busi_cat']=mysql_real_escape_string($busi_cat);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=207&busi_cat=$busi_cat&update=1&msg=".$msg);
	} 
	
	function _Add_Tut()
	{
		if(isset($_FILES['doc_file']['name']))
		{
			if($_FILES['doc_file']['name']!='')
			{
				$file=$_FILES['doc_file']['name'];
			}
			else
			{
				$file='';
			}
			
			$fileType = pathinfo($file, PATHINFO_EXTENSION);
			//print_r($_FILES);
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image2="pro_".$c_name.'_'.time().'.'.$fileType;
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['doc_file']['tmp_name'],"tutorials_file/".$image2);
			$ap_img="doc_file='$image2'";
		}

		if(isset($_FILES['logo']['name']))
		{
			if($_FILES['logo']['name']!='')
			$file=$_FILES['logo']['name'];
			else
			$file='';
			$c_name=$this->makeURLFriendly($_POST['member_name']);
			$image21="pro_".$c_name.'_'.time().'.jpg';
		}
		if($file!='')
		{
			move_uploaded_file($_FILES['logo']['tmp_name'],"tutorials_logo/".$image21);
			$ap_img="logo='$image2'";
		}


		$table_name=TABLE_PREFIX.'tutorials';
		$flag=false;

		$cur_date=date('Y-m-d');
		
		foreach($_POST as $key=>$val)
		{
			//print_r($key);
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
				$update_arr['doc_file']=mysql_real_escape_string($image2);
				$update_arr['logo']=mysql_real_escape_string($image21);
			}
		}
		if($flag)
		{
			if($_FILES['doc_file']['name']!='' && $_FILES['logo']['name']!='')
			{
				$update_arr['doc_file']=mysql_real_escape_string($image2);
				$update_arr['logo']=mysql_real_escape_string($image21);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else if($_FILES['doc_file']['name']=='' && $_FILES['logo']['name']!='')
			{
				$select = mysql_fetch_array(mysql_query("select logo,doc_file from tutorials where id='".$_POST['id']."'"));
				$update_arr['doc_file']=$select['doc_file'];
				$update_arr['logo']=mysql_real_escape_string($image21);
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else if($_FILES['doc_file']['name']!='' && $_FILES['logo']['name']=='')
			{
				$select = mysql_fetch_array(mysql_query("select logo,doc_file from tutorials where id='".$_POST['id']."'"));
				$update_arr['doc_file']=mysql_real_escape_string($image21);
				$update_arr['logo']=$select['logo'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}
			else
			{
				$select = mysql_fetch_array(mysql_query("select logo,doc_file from tutorials where id='".$_POST['id']."'"));
				$update_arr['doc_file']=$select['doc_file'];
				$update_arr['logo']=$select['logo'];
				$this->mysql_func->update_tbl($update_arr,$table_name,$where);
			}

			$msg="Record has been updated successfully.";
		}
		else
		{
			//print_r($update_arr);
			$this->mysql_func->insert_tbl($update_arr,$table_name);
			
			$msg="Record has been inserted successfully.";
		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=203&update=1&msg=".$msg);
	} 

        function _Add_manage_homepage(){
            
		
		$table_name=TABLE_PREFIX.'manage_homepage';
		$flag=false;
		//print_r($_POST);
		$cur_date=date('Y-m-d');
		foreach($_POST as $key=>$val)
		{
			//print_r($key);

			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=mysql_real_escape_string($val);
			}
		}
		if($flag)
		{
			
                    
                    $this->mysql_func->update_tbl($update_arr,$table_name,$where);
                    $msg="Record has been updated successfully.";
		}
		else
		{
				//print_r($update_arr);
				$this->mysql_func->insert_tbl($update_arr,$table_name);
				$msg="Record has been inserted successfully.";

		}
		// upload image of the product with proper validation
		// check image is already available or not
		
		header("Location:admin_main.php?page_number=209&update=1&msg=".$msg);
        }
}