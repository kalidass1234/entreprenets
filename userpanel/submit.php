<?php
include("../includes/all_func.php");
//echo "<pre>"; print_r($_POST);echo "<pre>"; print_r($_SESSION);exit;
if(isset($_POST['action']))
{
	//echo "<pre>"; print_r($_POST['rand']); echo "<pre>"; print_r($_SESSION['rand']); 
	/*if($_POST['rand'] == $_SESSION['rand'])
	{*/
		
		$value = $_POST['action'];
		// unset some field of post
		unset($_POST['action']);
		unset($_POST['rand']);
		unset($_POST['submit']);
		switch($value)
		{
			case "add_contat":
				_add_contact();
			break; 
			case "tp_tranfer_user":
				_tp_tranfer_user();
			break; 
			case "tp_tranfer_cash":
				_tp_tranfer_cash();
			break; 
			case "fund_tranfer_user":
				_fund_tranfer_user();
			break;
			case "Veirfy_Adds":
				_Veirfy_Adds();
			break;  
		}
	/*}*/
}

$minimum_transfer_amount=300;
$maximum_transfer_amount=2000;
function _add_contact()
{
	global $minimum_transfer_amount,$maximum_transfer_amount;
	//echo "<pre>"; print_r($_POST);echo "<pre>"; print_r($_SESSION);exit;
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
			$update_arr[$key]=$val;
		}
	}
	if($flag)
	{
		_update_tbl($update_arr,"address",$where);
		echo "<script>alert('Contact is updated successfully.');window.location.href='address.php';</script>";
	}
	else
	{
		$idd=USERID;
		$sql_contact=mysql_query("select * from address where user_id='$idd' and email='{$_POST['email']}'");
		if(mysql_num_rows($sql_contact)>0)
		{
			echo "<script>alert('This email id is already exists');window.location.href='address.php';</script>";
		}
		else
		{
			mysql_query("INSERT INTO address set user_name='{$_SESSION['adid']}', contact='{$_POST['contact']}', name='{$_POST['name']}', address='{$_POST['address']}', user_id='$idd', email='{$_POST['email']}'");
			echo "<script>alert('Contact is added successfully.');window.location.href='address.php';</script>";
		}
	}
}

function _tp_tranfer_user()
{
	$minimum_transfer_amount=300;
	$maximum_transfer_amount=2000;
	//echo "<pre>"; print_r($_POST);
	$receive_date=date('Y-m-d');
	// check user id valid or not
	$tuser=$_POST['loginid'];
	$max_amt=$_POST['max_amt'];
	$remark=$_POST['remark'];
	$user_name=$_SESSION['adid'];
	$user_id=showuserid($_SESSION['adid']);
	$sql_user="select user_id,user_name from registration where user_id='$tuser' or user_name='$tuser'";
	$res_user=mysql_query($sql_user);
	$count_user=mysql_num_rows($res_user);
	if($count_user)
	{
		$row_user=mysql_fetch_assoc($res_user);
		$tuser_id=$row_user['user_id'];
		$tuser_name=$row_user['user_name'];
		$admin_charge=3;
		$total_amount=$max_amt+$admin_charge;
		// check the points in the final_tp
		$sql_check_tp="select * from final_tp where user_id='$user_id'";
		$res_check_tp=mysql_query($sql_check_tp);
		$row_check_tp=mysql_fetch_assoc($res_check_tp);
		if($total_amount>=33)
		{
			/*if($total_amount<=$maximum_transfer_amount)
			{*/
				if($row_check_tp['amount']>=$total_amount)
				{
					// deduct amount from user tp wallet 
					$deduct_user="update final_tp set amount=amount-$total_amount where user_id='$user_id'";
					mysql_query($deduct_user);
					// update history
					$Remark="TP transfer to $tuser_name<br> $remark";
					$insert_deduct="insert into final_tp_history set user_id='$user_id',credit_amt='0',debit_amt='$total_amount',receiver_id='$tuser_id',sender_id='$user_id',receive_date='$receive_date',TranDescription='$Remark',Remark='$Remark'";
					mysql_query($insert_deduct);
					// add amount in the member wallet 
					$add_user="update final_tp set amount=amount+$max_amt where user_id='$tuser_id'";
					mysql_query($add_user);
					// update history
					$Remarkt="TP receive from $user_name<br> $remark";
					$insert_add="insert into final_tp_history set user_id='$tuser_id',credit_amt='$max_amt',debit_amt='0',receiver_id='$tuser_id',sender_id='$user_id',receive_date='$receive_date',TranDescription='$Remarkt',Remark='$Remarkt'";
					mysql_query($insert_add);
					// update history
					echo "<script>alert('TP Transfer to member $tuser_name TP Wallet.');window.location.href='tp_trans.php';</script>";
				}
				else
				{
					echo "<script>alert('You dont have suffient Point in TP Wallet.');window.location.href='tp_trans.php';</script>";
				}
			}
			else
			{
				echo "<script>alert('Maximum Transfer Limit is $maximum_transfer_amount.');window.location.href='tp_trans.php';</script>";
			}
		/*}
		else
		{
			echo "<script>alert('Minimum Transfer Limit is $minimum_transfer_amount.');window.location.href='tp_trans.php';</script>";
		}	*/	
	}
	else
	{
		echo "<script>alert('Wrong Member.');window.location.href='tp_trans.php';</script>";
	}
}	
function _tp_tranfer_cash()
{
	$minimum_transfer_amount=300;
	$maximum_transfer_amount=2000;
	//echo "<pre>"; print_r($_POST);
	$receive_date=date('Y-m-d');
	// check user id valid or not
	//$tuser=$_POST['loginid'];
	$max_amt=$_POST['max_amt'];
	$remark=$_POST['remark'];
	$user_name=$_SESSION['adid'];
	$user_id=showuserid($_SESSION['adid']);
	$sql_user="select user_id,user_name from registration where user_id='$user_id' or user_name='$user_id'";
	$res_user=mysql_query($sql_user);
	$count_user=mysql_num_rows($res_user);
	if($count_user)
	{
		$row_user=mysql_fetch_assoc($res_user);
		$tuser_id=$row_user['user_id'];
		$tuser_name=$row_user['user_name'];
		$admin_charge=3;
		$total_amount=$max_amt+$admin_charge;
		// check the points in the final_tp
		$sql_check_tp="select * from final_tp where user_id='$user_id'";
		$res_check_tp=mysql_query($sql_check_tp);
		$row_check_tp=mysql_fetch_assoc($res_check_tp);
		if($total_amount>=$minimum_transfer_amount)
		{
			/*if($total_amount<=$maximum_transfer_amount)
			{*/
				if($row_check_tp['amount']>=$total_amount)
				{
					// deduct amount from user tp wallet 
					$deduct_user="update final_tp set amount=amount-$total_amount where user_id='$user_id'";
					mysql_query($deduct_user);
					// update history
					$Remark="TP transfer to $tuser_name Cash Wallet<br> $remark";
					$insert_deduct="insert into final_tp_history set user_id='$user_id',credit_amt='0',debit_amt='$total_amount',receiver_id='$tuser_id',sender_id='$user_id',receive_date='$receive_date',TranDescription='$Remark',Remark='$Remark'";
					mysql_query($insert_deduct);
					// add amount in the member cash wallet 
					$add_user="update final_e_wallet set amount=amount+$max_amt where user_id='$tuser_id'";
					mysql_query($add_user);
					// update history
					$Remarkt="TP receive from $user_name TP Wallet<br> $remark";
					$insert_add="insert into credit_debit set user_id='$tuser_id',credit_amt='$max_amt',debit_amt='0',receiver_id='$tuser_id',sender_id='$user_id',receive_date='$receive_date',TranDescription='$Remarkt',Remark='$Remarkt'";
					mysql_query($insert_add);
					// update history
					echo "<script>alert('TP Transfer to member $tuser_name Cash Wallet.');window.location.href='tp_trans_to_cash_wallet.php';</script>";
				}
				else
				{
					echo "<script>alert('You dont have suffient Point in TP Wallet.');window.location.href='tp_trans_to_cash_wallet.php';</script>";
				}
			/*}
			else
			{
				echo "<script>alert('Maximum Transfer Limit is $maximum_transfer_amount.');window.location.href='tp_trans_to_cash_wallet.php';</script>";
			}*/
		}
		else
		{
			echo "<script>alert('Minimum Transfer Limit is $minimum_transfer_amount.');window.location.href='tp_trans_to_cash_wallet.php';</script>";
		}		
	}
	else
	{
		echo "<script>alert('Wrong Member.');window.location.href='tp_trans_to_cash_wallet.php';</script>";
	}
}
function _fund_tranfer_user()
{
	
	$minimum_transfer_amount=30;
	$maximum_transfer_amount=1660;
	//echo "<pre>"; print_r($_POST);
	$receive_date=date('Y-m-d');
	// check user id valid or not
	$tuser=$_POST['loginid'];
	$max_amt=$_POST['max_amt'];
	$remark=$_POST['remark'];
	$user_name=$_SESSION['adid'];
	$user_id=showuserid($_SESSION['adid']);
	$sql_user="select user_id,user_name from registration where user_id='$tuser' or user_name='$tuser'";
	$res_user=mysql_query($sql_user);
	$count_user=mysql_num_rows($res_user);
	if($count_user)
	{
		$row_user=mysql_fetch_assoc($res_user);
		$tuser_id=$row_user['user_id'];
		$tuser_name=$row_user['user_name'];
		$admin_charge=3;
		$total_amount=$max_amt+$admin_charge;
		// check the points in the final_tp
		$sql_check_tp="select * from final_e_wallet where user_id='$user_id'";
		$res_check_tp=mysql_query($sql_check_tp);
		$row_check_tp=mysql_fetch_assoc($res_check_tp);
		//echo $total_amount.">=".$minimum_transfer_amount;exit;
		if($total_amount>=$minimum_transfer_amount)
		{
			if($total_amount<=$maximum_transfer_amount)
			{
				if($row_check_tp['amount']>=$total_amount)
				{
					// deduct amount from user tp wallet 
					$deduct_user="update final_e_wallet set amount=amount-$total_amount where user_id='$user_id'";
					mysql_query($deduct_user);
					// update history
					$Remark="Fund transfer to $tuser_name<br> $remark";
					$insert_deduct="insert into credit_debit set user_id='$user_id',credit_amt='0',debit_amt='$total_amount',admin_charge='$admin_charge',receiver_id='$tuser_id',sender_id='$user_id',receive_date='$receive_date',TranDescription='$Remark',Remark='$Remark'";
					mysql_query($insert_deduct);
					// add amount in the member wallet 
					$add_user="update final_e_wallet set amount=amount+$max_amt where user_id='$tuser_id'";
					mysql_query($add_user);
					// update history
					$Remarkt="Fund receive from $user_name<br> $remark";
					$insert_add="insert into credit_debit set user_id='$tuser_id',credit_amt='$max_amt',debit_amt='0',receiver_id='$tuser_id',sender_id='$user_id',receive_date='$receive_date',TranDescription='$Remarkt',Remark='$Remarkt'";
					mysql_query($insert_add);
					// update history
					echo "<script>alert('Fund Transfer to member $tuser_id Cash Wallet.');window.location.href='fund_trans.php';</script>";
				}
				else
				{
					echo "<script>alert('You dont have suffient Point in Cash Wallet.');window.location.href='fund_trans.php';</script>";
				}
			}
			else
			{
				echo "<script>alert('Maximum Transfer Limit is $maximum_transfer_amount.');window.location.href='fund_trans.php';</script>";
			}
		}
		else
		{
			echo "<script>alert('Minimum Transfer Limit is $minimum_transfer_amount.');window.location.href='fund_trans.php';</script>";
		}
	}
	else
	{
		echo "<script>alert('Wrong Member.');window.location.href='fund_trans.php';</script>";
	}
}

function _Veirfy_Adds()
{
	global $host_name;
	$obj_query=new mysql_func();
	$obj_rep=new Representative();
	//echo "<pre>"; print_r($_POST);
	// check publishidhing link is valid or not
	$flag_publish=_Check_Url_Valid($_POST['publishing_site']);
	$flag_adds=_Check_Url_Valid($_POST['ad_link']);
	$flag_compar=compare_host($_POST['publishing_site'], $_POST['ad_link']);
	if($flag_publish)
	{
		if($flag_adds)
		{
			if($flag_compar)
			{
				// update the add as verify add
				$weekly_adds_id=$_POST['weekly_adds_id'];
				$publishing_site=$_POST['publishing_site'];
				$adds_link=$_POST['ad_link'];
				$user_id=showuserid($_SESSION['adid']);
				$add_date=date('Y-m-d');
				$sql_adds="select * from weekly_adds_mp where user_id='$user_id' and status=0 and id='$weekly_adds_id'";
    			$res_adds=mysql_query($sql_adds);
				$row_adds=mysql_fetch_assoc($res_adds);
				$weekly_adds_link=$host_name."/product-detail.php?pid=".$row_adds['product_id'];
				$add_count=$row_adds['add_count'];
				mysql_query("insert into weekly_adds_verify set add_by='$user_id',weekly_adds_id='$weekly_adds_id',publishing_site='$publishing_site',adds_link='$adds_link',add_date='$add_date',weekly_adds_link='$weekly_adds_link',add_count='$add_count'");
				mysql_query("update weekly_adds_mp set status=1,modify_date='$add_date' where id='$weekly_adds_id'");
				
				// check the five add done then update the next five products
				
				echo "<script>alert('Adds Verify and Save Successfully.');window.location.href='weekly_adds_verify.php';</script>";
			}
			else
			{
				echo "<script>alert('Adds not from this site.');window.location.href='weekly_adds_verify.php';</script>";
			}
		}
		else
		{
			echo "<script>alert('Wrong Add Link.');window.location.href='weekly_adds_verify.php';</script>";
		}
	}
	else
	{
		echo "<script>alert('Wrong Pulishing Site.');window.location.href='weekly_adds_verify.php';</script>";
	}
}

function _Check_Url_Valid($url)
{
	$file=$url;
	$file_headers=@get_headers($file);
	//echo "<pre>"; print_r($file_headers);
	if($file_headers[0] == 'HTTP/1.1 404 Not Found')
	{
		$exists = false;
		//echo "No";
	}
	else
	{
		$exists = true;
		//echo "Yes";
	}
return $exists;
}
function compare_host($url1, $url2)
{
  // PHP prior of 5.3.3 emits a warning if the URL parsing failed.
  $info = @parse_url($url1);
  if (empty($info))
  {
    return FALSE;
  }
//echo "<pre>"; print_r($info);
  $host1 = $info['path'];

  $info = @parse_url($url2);
  if (empty($info))
  {
    return FALSE;
  }
//echo "<pre>"; print_r($info);
	$host2=$info['path'];
	$arr=explode("/",$host2);
	$host2=$arr[0];
//echo $host1.'==========='.$host2;
  return (strtolower($host1) === strtolower($host2));
}	
?>