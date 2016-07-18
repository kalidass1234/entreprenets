<?php
session_start();
include("../includes/all_func.php");
include("../admin/function.php");
include("update-meber-bv.php");
include("additional-product-purchases.php");
include("additional-sponsor-commission.php");
include("../autoship-update.php");
//include("../controller/binary_comission_func.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
$idd=$_SESSION['SD_User_Name'];
$regdate_ip = getenv(REMOTE_ADDR);
$s="select * from registration where user_id='$idd'";
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



  $newID = gen_id(); 



$edone=$_SESSION['edone'];



$emode=$_SESSION['emode'];



$done_date=$_SESSION['done_date'];

$select_leg=$_SESSION['ch_leg'];

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



if($flag){


	if(!empty($product[0])){	

	

		$product_qty=0;

		

		for($i=0; $i<$z; $i++)

		{

		$pro=$product[$i];

		$qun=$quntity[$i];

		$cat_id=$product_category[$i];

	//	echo "SELECT * FROM product_category  where p_cat_id='$pro' and cat_id='$cat_id'";

		 $sql=mysql_query("SELECT * FROM product_category  where p_cat_id='$pro' and cat_id='$cat_id'");

		  $res=mysql_fetch_array($sql);

		  

			$price_cos=$res['total_price'];

			 

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

					  

		//$u_id=$user_id[$i];

		 

		  $sql2342="insert into purchase_detail set user_id='$id',  product_name='$product_name',invoice_no='$newID',p_cat_id='$pro',p_cat_id='$cat_id', currency='$', quantity='$qun',unit_price='$price_cos',date='$date' ,net_price=$direct,p_v='$pv',total_pv='$tot_pv',tax_percnt='$tax_percent',tax_amnt='$tax_amount'";



		  $sql=mysql_query($sql2342) or die($sql2342." Error:".mysql_error());

		//  mysql_query("update final_bv SET  pbv=(pbv+$tot_pv), totalbv=(totalbv+$tot_pv) where user_id='$id'");

		 

		   /* Entry For Direct income with commission  */

		

		 } 

		 

		 /** update final ewallet */

		 $tot_amt=$_SESSION['total_amount_now'];

		 $update="update final_e_wallet set amount=(amount-$tot) where user_id='$id'";

		 query($update);

		 

		 $sql="select amount from final_e_wallet where user_id='$id'";

		 $args_mem_ewallet=getRow(query($sql));

		 $fbalance=$args_mem_ewallet['amount'];

		 $date=date("Y-m-d");

		 

		 $sql="insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,Remark,final_bal)values('$id','0','$tot','Admin','$id', '$date','Product Purchase  Through E-wallet','$fbalance')";

		 query($sql);

		 

		 /** shipping charge */

		 $shipment= $tot_amt-$tot;

		 if( $shipment > 0 )

		 {

			 $sql="select amount from final_e_wallet where user_id='$id'";

			 $args_mem_ewallet=getRow(query($sql));

			 $fbalance=$args_mem_ewallet['amount'];

			 

			 $update="update final_e_wallet set amount=(amount-$shipment) where user_id='$id'";

		 	 query($update);

			 			 

			 $sql="insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,Remark,final_bal)values('$id','0','$shipment','Admin','$id', '$date','Shipment charge','$fbalance')";

			 query($sql);

			 

			 

		 }

		/** check pv for manage autoship */
		$store_amount = 1;
		$sponsor_payout = 0;
		 		
		 /** check additional purchases after the autoship of 90 pv */
		if(check_additional_product($id,90))
		{
			$store_amount = 0;
			$sponsor_payout = 1;
			$sponsor_bv = $total_pv;
			$paid_statu=1;
		}
		else
		{
			$exists_bv = get_member_product_bv($id);
			
			if($total_pv > 45)
			{
				$autoship_bv = $total_pv-$exists_bv;
				if( ($autoship_bv+$exists_bv) == 90 && $exists_bv > 0)
				{
					$store_amount = 1;
					$sponsor_payout = 1;
					$sponsor_bv = $total_pv-$autoship_bv;	
					$paid_statu=1;
				}
				else
				{
					if($exists_bv == 0 && $total_pv == 90)
					{
						$autoship_bv = $total_pv;
						$store_amount = 1;
						$sponsor_payout = 0;
						$paid_statu=0;
					}
					else if($exists_bv == 0 && $total_pv > 90)
					{
						$store_amount = 1;
						$sponsor_payout = 1;
						$autoship_bv = 90;
						$sponsor_bv = $total_pv-$autoship_bv;
						$paid_statu=0;
					}
				}
			}
			else
			{
				$autoship_bv = $total_pv;
				$store_amount = 1;
				$sponsor_payout = 0;
				$paid_statu=0;
			}
		}
		
	
		/** if autoship bv is not available then store in amount table*/
		
			//echo "amount detial : $autoship_bv";
			
			if($_SESSION['total_amount_now'] > $tot)
			{
				 $totals=$_SESSION['total_amount_now'];
				 $shipping_charge=$_SESSION['total_amount_now']-$tot;
			}
			else
			{
				$totals=$tot;
				$shipping_charge=0;
				
			}
	
			 $insert_amt=array('',$id,$id,$newID,$tot,'',$shipping_charge,'',$totals,'credit card',0,'','purchasing',$ref_id,'',date("Y-m-d"),$product_qty,'','',$autoship_bv,$paid_statu,$paid_statu,'');
	
			 insert_tbl($insert_amt,'amount_detail');
		/** if not more than 90 bv */
		if($store_amount)
		{ 
			/** update upliners */
			//update_member_bv($id,$autoship_bv,$totals,$product_qty,$newID,"credit card");
			
			/*** add new autoship date */
			if(get_member_product_bv($id) == 90)
			{
				//echo " update expire date";
				//autoship_member($id,date("Y-m-d"),true);
			}
		}
		 
		 /** give commission of additional product purchasing to sponsor */
		 if($sponsor_payout)
		 {
			 //echo " sponsor payour : $sponsor_bv";
			 $additional_pv=$sponsor_bv;
			
			$commission = ($additional_pv*15)/100;			
			if($commission > 0)
			{				
				//get_sponsor_commission($id,$commission,$additional_pv,$newID,$totals);
			}
		 }
		
		 /***  *****/

		 unset($_SESSION['product_name']);

		 unset($_SESSION['quantity']);

		 unset($_SESSION['product_category']);

		 unset($_SESSION['ch_leg']);

		 unset($_SESSION['delivery_mode']);

		 

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

					

					

					$mail=mail($replicate_email,"New Order from $to_company_cname", $msg, $headeruser1);

					$mail3=mail($to_company_email,"Order ", $msg, $headeruser1); 

		?>
<script language="javascript">

		 location.href='invoice.php?id=<?=$newID?>';

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
 location.href='eshop.php'



</script>
<?php 

}    





?>