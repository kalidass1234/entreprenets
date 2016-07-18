<?php

require_once "../includes/all_func.php";

session_start();
include("../upsapi/ups.php");
$tot=0;$count=0;
//$p=$_SESSION['product_name'];
$p=$_SESSION['p_cat_id'];
$q=$_SESSION['quantity'];
if($p!="")
$product=explode(",",$p);
$quantity=explode(",",$q);
$z=count($product);
for($h=0;$h<$z;$h++)
{
				$pro=$product[$h];
				$qun=$quantity[$h];
				$sql=mysql_query("SELECT * FROM category_shop PR inner join product_category PRO on PRO.cat_id=PR.c_id where p_cat_id='$pro' ");
				$res=mysql_fetch_array($sql);
				$dailydeal=$res['daily_deal'];
				$gift_card=$res['gift_card'];
				if($_SESSION['cost_price']){ $price=$_SESSION['cost_price'];}
				else if($dailydeal || $gift_card)
				{
					$price=$res['cost_price']-($res['cost_price']*$res['dailydeal_discount']/100);
				}
				else
				{
					$price=$res['cost_price'];
				}
				//$shipping+=$res['shipping'];
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
				$shipping+=$shipp;
			}
			else
			{
				$shipp=$res['shipping'];
				$shipping+=$res['shipping'];
			}
				 // $shipping+=$res['shipping'];
				// end shipping
				$seller_id=$res['add_by'];
					 
 				  $sqltax="select tax from tax where user_id='$seller_id' and status=1 ";
				  $restax=mysql_query($sqltax);
				  $rowtax=mysql_fetch_assoc($restax);
				  $tax=$rowtax['tax'];
				  $tottax=$qun*$price*$tax/100;
				  $applytax+= $tottax;
	//echo $shipp;			  
$tot+=($price*$qun);$count++;
$arr_item_total[]=$price*$qun+$shipp+$tottax;
$arr_itme_name[]=$res['product_name'];
$arr_item_qty[]=$qun;
}

$sql_master="select * from payment_methods where type='paypal'";
   $res_master=mysql_query($sql_master);
   $row_master=mysql_fetch_assoc($res_master);
?>
<form name="paypal" id="paypal" method="post" action="<?php echo $row_master['production_url'];?>"><!--https://www.sandbox.paypal.com/cgi-bin/websc-->
<input type="hidden" name="cmd" value="_cart">  
<input type="hidden" name="business" value="<?php echo $row_master['account'];?>"><!--subhash-facilitator@maxtratechnologies.com-->
<input type="hidden" name="upload" value="1">
<input type="hidden" name="item_number" value="<?=$_SESSION['orderno'];?>"> 
<?php
$ppp=0;
for($pidc=0;$pidc<count($arr_item_total);$pidc++)
{
$ppp++;
?>
<input type="hidden" name="item_name_<?php echo $ppp;?>" value="<?=$arr_itme_name[$pidc];?>"> 
<input type="hidden" name="amount_<?php echo $ppp;?>" value="<?=round($arr_item_total[$pidc],2);?>">  
<!--<input type="hidden" name="quantity_<?php echo $ppp;?>" value="<?=$arr_item_qty[$pidc];?>">-->  
<?php
}
?> 
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="return" value="http://visionteamnetwork.com/userpanel/confirmorder.php?pay_mode=paypal&paypal=1&invoice=<?=$_SESSION['orderno'];?>">
<input type="hidden" name="cancel_return" value="http://visionteamnetwork.com/userpanel/payment_fail.php?error=Transaction Failed. Please Try Again">
<input type="hidden" name="first_name" value="<?php echo $_SESSION['first_name'];?>">  
<input type="hidden" name="last_name" value="<?php echo $_SESSION['last_name'];?>">  
<input type="hidden" name="address1" value="<?php echo $_SESSION['address1'];?>">  
<input type="hidden" name="city" value="<?php echo $_SESSION['city'];?>">  
<input type="hidden" name="state" value="<?php echo $_SESSION['state'];?>">  
<input type="hidden" name="zip" value="<?php echo $_SESSION['zip'];?>">  
<input type="hidden" name="night_phone_a" value="<?php echo $_SESSION['mobile'];?>">  
<input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>">
</form>
<script>
document.getElementById('paypal').submit();
</script>