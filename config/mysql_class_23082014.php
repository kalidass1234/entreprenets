<?php
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

class User_Login
{
	function login($uname,$pass,$return_page,$current_page,$type='')
	{
			
			$query="select * from registration where user_name='$uname' and user_pass='$pass' and mem_status=0"; 
			//echo $query;exit;
			$dat=mysql_query($query);
			$res=mysql_num_rows($dat);
			if($res>0 && $uname!='' && $pass!='')
			{
				$row=mysql_fetch_assoc($dat);
				if(isset($_SESSION['SD_User_Name']))
				{
					
					$_SESSION['SD_User_Name']=$uname;
					$_SESSION['SD_User_ID']=$row['user_id'];
					$_SESSION['SD_User_Type']=$row['user_type'];
					$login_ip=$this->getClientIP();
					$update="update registration set login_ip='$login_ip',last_login=this_login, this_login=now() where user_name='$uname'";
					$sql=mysql_query($update)or die("Error: Login Problem.");
				}
				if(!isset($_SESSION['SD_User_Name']))
				{
					
					$_SESSION['SD_User_Name']=$uname;
					$_SESSION['SD_User_ID']=$row['user_id'];
					$_SESSION['SD_User_Type']=$row['user_type'];
					$login_ip=$this->getClientIP();
					$update="update registration set login_ip='$login_ip',last_login=this_login, this_login=now() where user_name='$uname'";
					$sql=mysql_query($update)or die("Error: Login Problem.");
				}
				
				if($type=='lockscreen')
				{
					$obj=new mysql_func();
					$table_employee=TABLE_PREFIX."registration";
					$update_arr=array("lockscreen"=>0);
					$where="user_id='$row[user_id]'";
					$obj->update_tbl($update_arr,$table_employee,$where);
				}
				//echo $row['user_type'];
				
				if($row['user_type']=='super_admin' || $row['user_type']=='admin' || $row['user_type']=='sub_admin')
				{
					header("location:admin/index.php");
				}
				else
				{
					// check return session
					if(isset($_SESSION['return_url']))
					{
						$return_page=$_SESSION['return_url'];
						unset($_SESSION['return_url']);
						header("Location:".$return_page);
					}
					else
					{
						header("location:userpanel/index.php");
					}
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
	
	function getClientIP() 
	{
		if (isset($_SERVER))
		{
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
				return $_SERVER["HTTP_X_FORWARDED_FOR"];
			if (isset($_SERVER["HTTP_CLIENT_IP"]))
				return $_SERVER["HTTP_CLIENT_IP"];
			return $_SERVER["REMOTE_ADDR"];
		}
		if (getenv('HTTP_X_FORWARDED_FOR'))
			return getenv('HTTP_X_FORWARDED_FOR');
		if (getenv('HTTP_CLIENT_IP'))
			return getenv('HTTP_CLIENT_IP');
		return getenv('REMOTE_ADDR');
	}
}
class mysql_func
{
	function query($slt, $table, $where=false)
	{
		//echo "select ".$slt." from ".$table." where ".$where;
		//echo "<br>";
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
	 //echo $sql; echo "<br>";exit;
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
	// echo $sql; "<br>";
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
	function userid()
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
	}
}

class Representative extends Custom_Function
{
	public $mysql_func;
	public function __construct()
	{
		$this->mysql_func = new mysql_func();
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
	function spill($sponserid)
	{
		global $nom_id1,$lev;
		foreach($sponserid as $key => $val)
		{
			$query1="select * from registration where nom_id='$val' order by id";
			$result1=mysql_query($query1);
			$num_ro1[]=mysql_num_rows($result1);
			while($row=mysql_fetch_array($result1))
			{
				$rclid1[]=$row['user_id'];
			}
		}
		foreach($num_ro1 as $key11 => $valu)
		{
			if($valu<5)
			{
			$key1=$key11;
			break;
			}
		}
			
		   switch ($valu)
		   {
		   case '0':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
		  // print "a";
			   break;
		   case '1':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
				case '2':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
				case '3':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
			 
			  case '4':
		   $nom_id1=$sponserid[$key1];
		   //$i=$num_ro1;
			//  print "bb";
			   break;
			   
			   case '5':
		   
		if(!empty($nom_id1))
		{
		 break;
		}
			spill($rclid1);
		//$lev++;
		}
		return $nom_id1;
	}
	function spill_id1($sponserid,$posi)
	{
		global $nom_id;
		$query1="select * from registration where nom_id='$sponserid' and binary_pos='$posi'";
		$result1=mysql_query($query1);
		$row=mysql_fetch_array($result1);
		$rclid1=$row['user_id'];
		//print $rclid1;
		if($rclid1!="")
		{
		$this->spill_id1($rclid1,$posi);
		}
		else
		{
		$nom_id=$sponserid;
		
		}
		//print $spill_id;
		 
		return $nom_id;
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
	function _user_registration()
	{
		//echo "<pre>"; print_r($_POST); exit;	
		// check sponsor 
		$table_name=TABLE_PREFIX.'registration';
		$curdate=date('Y-m-d H:i:s');
		$user_id=$this->userid();
		// check sponsor and user placement
		if(!isset($_POST['sp_name']) || $_POST['sp_name']=='')
		{
			// find the placement id of the 1234567
			// check the default reg sponsor
			//$res_ds=$this->mysql_func->query("user_id","registration","show_reg_page=1");
			$res_ds=mysql_query("SELECT user_id, (SELECT COUNT( id ) FROM  `registration` AS p WHERE p.ref_id = r.user_id) AS cnt FROM registration AS r WHERE r.bonus =1 HAVING cnt <6 order by cnt desc limit 1");
			$row_ds=$this->mysql_func->get_all_row($res_ds);
			if($row_ds['user_id']!='')
			{
				mysql_query("update registration set show_reg_page=1 where user_id='$row_ds[user_id]'");
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
		$t_code=$_POST['t_code'];
		// update 
		
		if(!$this->checkuser($ref_id) && $this->checkuser($_POST['user_name']))
		{
			// check the unique email of the user 
			/*$res_email=$this->mysql_func->query("id","registration","email='$_POST[email]'");
			$count_email=$this->mysql_func->num_row($res_email);
			if($count_email=1)
			{*/
				// check for other user detail already exists or not like name
				/*$res_check_userd=$this->mysql_func->query("id","registration","first_name='$_POST[first_name]' and last_name='$_POST[last_name]' and tax_id='$_POST[tax_id]'");
				$count_check_userd=$this->mysql_func->num_row($res_check_userd);
				if(!$count_check_userd)
				{*/
					$inser_array=
					array(
						"user_id"=>$user_id,
						"ref_id"=>$ref_id,
						"ref_id_temp"=>$ref_id_temp,
						"nom_id"=>$nom_id,
						"t_code"=>$t_code,
						"user_name"=>$_POST['user_name'],
						"user_pass"=>$_POST['user_pass'],
						"binary_pos"=>$posi,
						"first_name"=>$_POST['first_name'],
						"last_name"=>$_POST['last_name'],
						"email"=>$_POST['email'],
						"address1"=>$_POST['address1'],
						"address2"=>$_POST['address2'],
						"city"=>$_POST['city'],
						"country"=>$_POST['country'],
						"phoner"=>$_POST['phone'],
						"zip"=>$_POST['zip'],
						"power_leg"=>'left',
						"power_status"=>1,
						"tax_id"=>$_POST['tax_id'],
						"reg_date"=>$curdate,
						"mem_status"=>0);
					$this->mysql_func->insert_tbl($inser_array,$table_name);	
					$nom_id=$this->spill_id1($ref_id,$posi);
					$nom=$nom_id;
					$pos=$posi;
					$l=1;
					/*while($nom!='cmp')
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
					}*/
					//mysql_query("update registration set nom_id='$nom_id' where user_id='$user_id'");
					$insert_array=array(
					"user_id"=>$user_id,
					"amount"=>'0'
					);
					// add final_e_wallet
					$this->mysql_func->insert_tbl($insert_array,"final_e_wallet");	
					// add final_tp
					$this->mysql_func->insert_tbl($insert_array,"final_tp");	
					// add final_tfs
					$this->mysql_func->insert_tbl($insert_array,"final_tfs");	
					//$this->_registration_mail($user_id);
					$_SESSION['SD_User_Name']=$_POST['user_name'];
					$_SESSION['SD_User_ID']=$user_id;
					$_SESSION['SD_User_Type']='';
						
					header("Location:userpanel/index.php");
				/*}
				else
				{
					header("Location:register.php?msg=User Detail Already Exists.");
				}*/
			/*}
			else
			{
				header("Location:register.php?msg=Wrong Email Id.");
			}*/
		}
		else
		{
			header("Location:register.php?msg=Wrong Username or Wrong Sponser Detail");
		}
	}
	function _registration_mail($user_id)
	{
		$sql="select * fro registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		$from="subhash@maxtratechnologies.com"; // shopdeal admin username
	// $name=$fname." ".$lname;
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:Trinity <$from>" . "\r\n";
	 $url="http://trinityresell.com/".$user_nm;
     $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src='http://trinityresell.com/images/logo/trinity%20resell.jpg'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>".stripslashes(htmlentities($row['user_name'])).",</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='50'>&nbsp;</td>
        <td height='50'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#3399FF; padding: 5px 0px '>Congratulations!</p></td>
        <td height='50'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'><strong>Welcome to Trinity Resell</strong>. You successfully completed your Registration.
 
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='24%'><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Username: </p></td>
            <td width='76%'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($row['user_name']))."</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>User ID</p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($row['user_id']))."</p></td>
          </tr>
          <tr>
           <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Password: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($row['user_pass']))."</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Transaction Pin: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($row['t_code']))." </p></td>
          </tr>
		  
		  <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Refferal Link: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'><a href='$url'>".stripslashes(htmlentities($url))."</a></p></td>
          </tr>
		  
        </table></td>
        <td height='130'>&nbsp;</td>
      </tr>
	
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>Trinity Resell Admin</p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    </div>
  </div>
</div>
</body>
</html>";
 //  $header="From: info@infinitillio.com";
 //echo $msg;exit;
	  mail($email,'WELCOME',$msg,$headeruser1,'$from');
	  return $user_id;
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
	function _update_profile()
	{
		//echo "<pre>"; print_r($_POST);
		//$dob=date('Y-m-d',strtotime($_POST['dob']));
		$table_name=TABLE_PREFIX.'employee';
			$curdate=date('Y-m-d');
			$USERID=USERID;
			$inser_array=array(
			"emp_email"=>$_POST['email'],
			"emp_cemail"=>$_POST['cemail'],
			"emp_fname"=>$_POST['fname'],
			"emp_mname"=>$_POST['mname'],
			"emp_lname"=>$_POST['lname'],
			"emp_mobile1"=>$_POST['mobile1'],
			"emp_mobile2"=>$_POST['mobile2'],
			"emp_phone"=>$_POST['phone'],
			"modify_by"=>USERNAME,
			"modify_date"=>$curdate
			);
			$where="id='$USERID'";
			$this->mysql_func->update_tbl($inser_array,$table_name,$where);
			return "success";
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
}

class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select id,user_id from registration where nom_id='$dwnid' ";
			//echo $quer3;echo "<br>"; 
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//echo $idx;echo "<br>";
					$data_dwn[]=$idx;
					$levv=level_count($idx,$tid);
					$lel[]=$levv;
					
					//print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select id,user_id from registration where nom_id='$dwnid' ";
		//echo $quer;echo "<br>";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			//echo $user2;echo "<br>";
			showMemX($user2,$tid);
		}
	}
}