<?php
include("../includes/all_func.php");
if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:upgrade_payment_package.php?msg=wrong url access"); exit;
}
$user_id=showuserid($_SESSION['SD_User_Name']);
$bonus_date=date('Y-m-d');
// check the transaction password and match the amount to be deducted
if($_SESSION['payment_mode']=='Cash Wallet')
{
	// check user transaction password 
	$sql_u="select id from registration where t_code='$_POST[t_code]' and user_id='$user_id'";
	$res_u=mysql_query($sql_u);
	$count_u=mysql_num_rows($res_u);
	if($count_u)
	{
		// deduct amount form cash wallet
		$sql_update="update final_e_wallet set amount=amount-160 where user_id='$user_id'";
		mysql_query($sql_update);
		$insert="insert into credit_debit set user_id='$user_id',credit_amt='0',debit_amt='160',receiver_id='admin',sender_id='$user_id',receive_date='$bonus_date',TranDescription='Upgrade Account to affiliate',Remark='Upgrade Account to affiliate'";
		mysql_query($insert);
	}
	else
	{
		echo "<script>alert('wrong transaction password');window.location.href='cash_wallet.php?msg=wrong transaction password';</script>"; exit;
	}
}
include("../config/class_commission.php");
$obj_commission=new Class_Commission();
$obj_query=new mysql_func();
$obj_rep=new Representative();
//echo "<pre>"; print_r($_POST); print_r($_SESSION);exit;
$bonus_date=date('Y-m-d');
$Date=$bonus_date;
$expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));

$package_id=1;
$duration=1;
$amount=160;
$order_no=$_SESSION['orderno'];
$payment_mode=$_SESSION['payment_mode'];
if($payment_mode=='Bank Wire')
{
	$cond=",acc_name='$acc_name',bank_nm='$bank_nm',ac_no='$ac_no',branch_nm='$branch_nm',swift_code='$swift_code'";
}
else
{
	$cond="";
}
// get the product id form the member package id

//echo "update registration set bonus=1 , bonus_date='$bonus_date',category_one=1 where user_id='".$user_id."'";exit;
mysql_query("update registration set transaction_no='$order_no',plan_name='$amount',plan_type='Affiliate',bonus=1 , bonus_date='$bonus_date',category_one='$package_id',duration_one='$duration' $cond where user_id='".$user_id."'");
mysql_query("update subscription set status=1 where user_id='$user_id'");
mysql_query("insert into subscription set order_no='$order_no',user_id='$user_id',subs_fee='$amount',payment_mode='$payment_mode',subs_date='$bonus_date',end_date='$expire_date'");

// check subscription is first time or not
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
	//$ref_id_temp=$row_user['ref_id_temp'];
	if($ref_id!='cmp')
	{
	/*// get sponsor power leg
	if($ref_id_temp!='')
	{
		$leg_pos_is=$ref_id_temp;
	}
	else
	{
		$leg_pos_is=$ref_id;
	}*/
	$leg_pos_is=$ref_id;
	$sql_ref_leg="select power_leg from registration where user_id='$leg_pos_is'";
	$res_ref_leg=mysql_query($sql_ref_leg);
	$row_ref_leg=mysql_fetch_assoc($res_ref_leg);
	if($row_ref_leg['placement_id_status'])
	{
		$ref_id_temp=$row_ref_leg['placement_id'];
		$leg_pos_id=$ref_id_temp;
	}
	else
	{
		$leg_pos_id=$ref_id;
	}
	//echo $row_ref_leg['power_leg'];
	$sql_ref_leg="select power_leg from registration where user_id='$leg_pos_id'";
	$res_ref_leg=mysql_query($sql_ref_leg);
	$row_ref_leg=mysql_fetch_assoc($res_ref_leg);
	
	if($row_ref_leg['power_leg']=='automatic')
	{
		// check the weeker leg
		// find the left leg count
		$sql_left_count="select * from level_income where income_id='$leg_pos_id' and position='left'";
		$res_left_count=mysql_query($sql_left_count);
		$count_left_count=mysql_num_rows($res_left_count);
		// find the right leg count
		$sql_right_count="select * from level_income where income_id='$leg_pos_id' and position='right'";
		$res_right_count=mysql_query($sql_right_count);
		$count_right_count=mysql_num_rows($res_right_count);
		// if both leg same 
		if($count_left_count==$count_right_count)
		{
			$posi='left';
		}
		else
		{
			// find the weeker leg
			$min=min($count_left_count,$count_right_count);
			if($min==$count_left_count)
			{
				$posi='left';
			}
			if($min==$count_right_count)
			{
				$posi='right';
			}
		}
	}
	else if($row_ref_leg['power_leg']=='left' || $row_ref_leg['power_leg']=='right')
	{
		$posi=$row_ref_leg['power_leg'];
	}
	else
	{
		$posi='left';
	}
	
	if($ref_id_temp!='')
	{
		//echo $ref_id_temp;
		$nom_id=$obj_rep->spill_id1($ref_id_temp,$posi);
	}
	else
	{
		$nom_id=$obj_rep->spill_id1($ref_id,$posi);
	}
	
	if($ref_id=='cmp')
	{
		$nom='cmp';
	}
	else
	{
		$nom=$nom_id;
	}
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
	else
	{
		mysql_query("update registration set nom_id='cmp',binary_pos='left',power_status='1',power_leg='left' where user_id='$user_id'");
	}
	// get product volume in the member package
//	$sql_package="SELECT sum(p.product_volume) as product_volume FROM product_category as p inner join `member_package` as m on p.p_cat_id in (m.product_id) WHERE m.id='$package_id'";
	$sql_package="SELECT * from `member_package`  WHERE id='$package_id'";
	$res_package=mysql_query($sql_package);
	$row_package=mysql_fetch_assoc($res_package);
	$product_volume=$row_package['product_volume'];
	$obj_commission->_update_product_volume($user_id,$product_volume,$order_no);

	$sql_package1="SELECT * from `member_package`  WHERE id='$package_id'";
	$res_package1=mysql_query($sql_package1);
	$row_package1=mysql_fetch_assoc($res_package1);
	$invoice_amt=$row_package1['package_amount'];
	$obj_commission->_update_product_sale($user_id,$invoice_amt,$order_no);
	
	
	// check and assign the 30 products of the stock to sell
	// check the member already have assign 30 products
	$sql_thirty="select * from stock_to_sell_assign where user_id='$user_id' and type='stock_to_sell'";
	$res_thirty=mysql_query($sql_thirty);
	$count_thirty=mysql_num_rows($res_thirty);
	if(!$count_thirty)
	{
		// get the 30 products from the default list.
		$sql_product_default="select * from product_default where type='stock_to_sell' limit 30";
		$res_product_default=mysql_query($sql_product_default);
		$count_product_default=mysql_num_rows($res_product_default);
		$add_date=date('Y-m-d');
		if($count_product_default==30)
		{
			while($row_product_default=mysql_fetch_assoc($res_product_default))
			{	
				$update['user_id']=$user_id;
				$update['product_id']=$row_product_default['product_id'];
				$update['add_by']=USERID;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($obj_rep->_product_thirty($user_id,"stock_to_sell_mp",30))
				{
					$obj_query->insert_tbl($update,"stock_to_sell_mp");
				}
			}
			mysql_query("insert into stock_to_sell_assign set user_id='$user_id',products_count='30',add_date='$add_date',type='stock_to_sell'");	
		}	
	}	
}
// end to check subscription is first time
unset($_SESSION['orderno']);
unset($_SESSION['payment_for']);
unset($_SESSION['payment_mode']);
header("Location:upgrade_payment_package.php");
?>