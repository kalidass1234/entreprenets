<?php
session_start();
include("../includes/all_func.php");
include("../upsapi/ups.php");
//echo "<pre>"; print_r($_SESSION);exit;
//include("../controller/binary_comission_func.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
$idd=$_SESSION['SD_User_Name'];
$regdate_ip = getenv(REMOTE_ADDR);
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
$ref_id=$f['ref_id'];
$u_name=$f['user_name'];
$packag=$f['package'];
$user_type=$f['user_type'];
function gen_id() 
{ 
    $id=''; 
    for ($i=1; $i<=10; $i++) { 
        if (rand(0,1)) { 
            // letter 
            $id .= rand(65, 90); 
        } else { 
            // number; 
            $id .= rand(0, 9); 
        } 
    } 
    return $id; 
} 
//echo "<pre>"; print_r($_SESSION); exit;
$section=$_SESSION['section'];
$pay_mode=$_GET['pay_mode'];
$newID = gen_id(); 
$edone=$_SESSION['edone'];
$emode=$_SESSION['emode'];
$done_date=$_SESSION['done_date'];
$select_leg=$_SESSION['ch_leg'];
$_SESSION['product_name']=$_SESSION['p_cat_id'];
$p=$_SESSION['product_name'];
$q=$_SESSION['quantity'];
$p_cat=$_SESSION['product_category'];
$delivery_mode=$_SESSION['delivery_mode'];
$date = date('Y-m-d');
$product=explode(",",$p);
$quntity=explode(",",$q);
$product_category=explode(",",$p_cat);
$z=count($product);
$flag=false;
if (isset($_REQUEST['ewallet']))
{
	$pass=$_REQUEST['password'];
	 $sel="select count(*) from registration where t_code='$pass' and user_id='$idd'";
	$sql=mysql_query($sel);
	 $result=mysql_num_rows($sql);
	if($result>0 )
	{	
		$flag=true;	
	}
	else{
	?>
<script language="javascript">
 location.href='evallet.php'
alert("Wrong Transaction Password");
</script>
<?php	
	}
}
if(isset($_SESSION['orderno']))
{
$flag=true;
}
if($flag){
	if(!empty($product[0])){	
		$product_qty=0;
		for($i=0; $i<$z; $i++)
		{
		$pro=$product[$i];
		$qun=$quntity[$i];
		
	//	echo "SELECT * FROM product_category  where p_cat_id='$pro' and cat_id='$cat_id'";
		$sql=mysql_query("SELECT * FROM product_category  where p_cat_id='$pro'");
		$res=mysql_fetch_array($sql);
		  
		$sql_cat="select * from category_shop where c_id='$res[cat_id]'";
		$res_cat=mysql_query($sql_cat);
		$row_cat=mysql_fetch_assoc($res_cat);
		  //$cat_id=$product_category[$i];
		$cat_id=$res['cat_id'];
		$price_cos=$res['cost_price'];
		$product_name=$res['product_name'];
		$pv=$res['business_volume'];
		$direct=$qun*$price_cos;
					$product_qty+=$qun;
					$tot +=$direct;
					$tot_pv=$pv*$qun;
					$total_pv+=$tot_pv;
					$tax_percent=$res['tax']; 
					$tax_amount=$price_cos*$tax_percent/100;
					$tax_amount=$tax_amount*$qun;
					$tax_amount1+=$tax_amount;
					
					$shipping=$res['shipping'];
					$weight=$res['shipping_weight'];
	$length=$res['ship_length'];
	$width=$res['ship_width'];
	$height=$res['ship_height'];
	if($res['doba_product'])
	{
		$service = '03';
		if(isset($_SESSION['SD_User_Name']))
		{
		$user_id=showuserid($_SESSION['SD_User_Name']);
		$dest_zip=showuser_location($user_id);
		}
		$shipp=ups($dest_zip,$service,$weight,$length,$width,$height);
		$shipping=$shipp;
	}
	else
	{
		$shipping=$res['shipping'];
	}
					$tot_shipping+=$shipping;
					$discount=$price_cos*$res['dailydeal_discount']/100;
					$total_discount=$discount+$total_discount;
					$color=$_SESSION['color_code_'.$pro];
					$color_qty=$_SESSION['color_qty_'.$pro];
					$product_size=$_SESSION['length_'.$pro];
					$arr_session_color=explode(",",$color);
					$arr_session_qty=explode(",",$color_qty);
					//print_r($arr_session_color);
					// update color qty from old color qty
					// get old color qty
					$old_color=$res['colors'];
					$old_qty=$res['colors_qty'];
					$old_color_arr=explode(",",$old_color);
					$old_qty_arr=explode(",",$old_qty);
					foreach($old_color_arr as $key=>$val)
					{
						$old_colors=$val;
						//echo $old_colors."==".$color;
						//echo "<br>";
						$keys=array_search($old_colors,$arr_session_color);
						$vals=$arr_session_qty[$keys];
						
						//echo $old_qty_arr[$key]."-".$vals;
							$old_qty_arr[$key]=$old_qty_arr[$key]-$vals;
						
					}
					$new_colors=implode(",",$old_color_arr);
					$new_colors_qty=implode(",",$old_qty_arr);
					 unset($_SESSION['color_code_'.$pro]);
					  unset($_SESSION['color_qty_'.$pro]);
					// end to updat ecolor qty
		//$u_id=$user_id[$i];
		  $sql2342="insert into purchase_detail set user_id='$id',  product_name='$product_name',invoice_no='$newID',p_id='$pro', currency='$', quantity='$qun',price='$price_cos',date='$date' ,net_price=$direct,tax='$tax_amount',shipping='$shipping',discount='$discount',pay_mode='$pay_mode',section='$section',color='$color',color_qty='$color_qty',product_size='$product_size'";
		  //echo $sql2342; exit;
		  $sql=mysql_query($sql2342) or die($sql2342." Error:".mysql_error());
		  // deduct product qty 
		  //echo "<br>";
		 // echo "update product_category set p_qty=p_qty-$qun,colors_qty='$new_colors_qty' where p_cat_id='$pro'";
		  mysql_query("update product_category set p_qty=p_qty-$qun,colors_qty='$new_colors_qty' where p_cat_id='$pro'");
		  // end to deduct product qty
		//  mysql_query("update final_bv SET  pbv=(pbv+$tot_pv), totalbv=(totalbv+$tot_pv) where user_id='$id'");
		   /* Entry For Direct income with commission  */
		 } 
		 /** update final ewallet */
		 $tot_amt=$_SESSION['total_amount_now'];
		 if($pay_mode=='ewallet')
		 {
		 $update="update final_e_wallet set amount=(amount-$tot_amt) where user_id='$id'";
		 mysql_query($update);
		 $sql="select amount from final_e_wallet where user_id='$id'";
		 $args_mem_ewallet=mysql_fetch_array(mysql_query($sql));
		 $fbalance=$args_mem_ewallet['amount'];
		 $date=date("Y-m-d");
		$sql="insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,Remark,TranDescription,final_bal)values('$id','0','$tot_amt','Admin','$id', '$date','Withdraw Request for E-Shop/Purchase','Withdraw Request for E-Shop/Purchase','$fbalance')";
		//exit;
		 mysql_query($sql);
		 }
		 /** shipping charge */
		 $shipment= $tot_amt-$tot;
		 /*if( $shipment > 0 )
		 {
			 $sql="select amount from final_e_wallet where user_id='$id'";
			 $args_mem_ewallet=mysql_fetch_array(mysql_query($sql));
			 $fbalance=$args_mem_ewallet['amount'];
			 $update="update final_e_wallet set amount=(amount-$shipment) where user_id='$id'";
		 	 mysql_query($update);
			 $sql="insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,Remark,final_bal)values('$id','0','$shipment','Admin','$id', '$date','Shipment charge','$fbalance')";
			 mysql_query($sql);
		 }*/
		/** check pv for manage autoship */
		$store_amount = 1;
		$sponsor_payout = 0;
		 /** check additional purchases after the autoship of 90 pv */
	
		/** if autoship bv is not available then store in amount table*/
		
			//echo "amount detial : $autoship_bv";
			
			/*if($_SESSION['total_amount_now'] > $tot)
			{
				 $totals=$_SESSION['total_amount_now'];
				 $shipping_charge=$_SESSION['total_amount_now']-$tot;
			}
			else
			{
				$totals=$tot;
				$shipping_charge=0;
				
			}*/
	
			 /*$insert_amt=array('',$id,$id,$newID,$tot,'',$shipping_charge,'',$totals,'credit card',0,'','purchasing',$ref_id,'',date("Y-m-d"),$product_qty,'','',$autoship_bv,$paid_statu,$paid_statu,'');
	
			 insert_tbl($insert_amt,'amount_detail');*/
		/** if not more than 90 bv */
		
			 $curdate=date("Y-m-d");
			 $net_totals=$totals+$total_shipping+$tax;
			 //echo "insert into amount_detail set user_id='$id',seller_id='admin',invoice_no='$newID',net_amount='$net_totals',shipping_charge='$total_shipping',tax='$tax',total_amount='$totals',date='$curdate',payment_mode='credit card'"; exit;
			 mysql_query("insert into amount_detail set user_id='$id',seller_id='admin',invoice_no='$newID',net_amount='$tot_amt',shipping_charge='$tot_shipping',tax='$tax_amount1',total_amount='$tot_amt',date='$curdate',discount='$total_discount',payment_mode='$pay_mode',section='$section',card_no='$_GET[x_account_number]'");
		 /***  *****/
		 unset($_SESSION['total_amount_now']);
		 unset($_SESSION['tot_tax']);
		 unset($_SESSION['total_discount']);
		 unset($_SESSION['p_cat_id']);
		 unset($_SESSION['product_name']);
		 unset($_SESSION['quantity']);
		 unset($_SESSION['product_category']);
		 unset($_SESSION['ch_leg']);
		 unset($_SESSION['delivery_mode']);
		 unset($_SESSION['section']);
		 unset($_SESSION['x_account_number']);
		 unset($_SESSION['x_trans_id']);
		 include("invoice_email.php");
		 $sql1email_com=mysql_fetch_array(mysql_query("SELECT * FROM registration  where user_id='$id'"));
		$email_from='subhash@maxtratechnologies.com';
		$to_company_email=$sql1email_com[email];
		$to_company_cname=$sql1email_com[user_name];
		$headeruser1="Mime-Version: 1.0\r\n";
		 $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 $headeruser1 .= "From:  <".$email_from.">" . "\r\n";	
		$msg="<html>
		<head>
		<meta http-equiv= 'Content-Type ' content= 'text/html; charset=utf-8 '>
		<title>livingwell.com</title>
		</head>
		<body style= 'margin:0px; padding:0px; color:#cc0000; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; '>
		  <div id= 'content ' style= 'width:98.5%; overflow:hidden; border:8px solid  #FF0000; '>
		<table width= '100% ' border= '0 ' cellspacing= '0 ' cellpadding= '0 '>
		  <tr>
			<td width= '2% '>&nbsp;</td>
			<td width= '96% '>&nbsp;</td>
			<td width= '2% '>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><strong>Hi VTN Member </strong></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td> A order has been placed  <br>Please check your order box </td>
			<td>&nbsp;</td>
		  </tr>
		   <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		   <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		   <tr>
			<td>&nbsp;</td>
			<td><strong>VTN  Admin</strong></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</table>
		</div>
		</body>
		</html>";
					$replicate_email="subhash@maxtratechnologies.com";
					$sql_email="select * from master_email ";
					$res_email=mysql_query($sql_email);
					$row_email=mysql_fetch_assoc($res_email);
					if($section=='eshop')
					{
					$replicate_email=$row_email['eshop'];
					}
					else if($section=='marketing_product')
					{
					$replicate_email=$row_email['marketing_product'];
					}
					$mail=mail($replicate_email,"New Order from $to_company_cname", $msg, $headeruser1);
					//$mail3=mail($to_company_email,"Order ", $msg, $headeruser1); 
		?>
<script language="javascript">
		 location.href='invoice.php?invoice_no=<?=$newID?>';
		</script>
<?php
	}
	else
	{
	?>
<script language="javascript">
	alert("Select Products  First ");
	 location.href='eshop.php'
	</script>
<?php 
	}    
} ///  FLAG END HERE
else
{
?>
<script language="javascript">
alert("Select Products  First ");
 location.href='../eshop/'
</script>
<?php 
}    
?>