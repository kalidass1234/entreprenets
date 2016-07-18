<?
session_start();  
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
$invoice=$_GET['invoice_no'];
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Invoice_$invoice.doc");
$seller_id=showuserid($_SESSION['SD_User_Name']);
$sltpur2=mysql_query("select * from purchase_detail where invoice_no='$invoice' and seller_id='$seller_id' limit 1");
$fetchpur2=mysql_fetch_assoc($sltpur2);
$userid=$fetchpur2['user_id'];
$sltpur=mysql_query("select * from purchase_detail  where  invoice_no='$invoice' and seller_id='$seller_id'");
"select * from registration where user_id='$userid'";
$sltusr=mysql_query("select * from registration where user_id='$userid'");
$fetchusr2=mysql_fetch_assoc($sltusr);
$mail_content="
 
			<html>
				<head>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>Invoice Details</title>
				</head>
				
				<body>
 						<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' id='printArea'>
								<tr>
								<td width='457' height='100' valign='top'><img src='../images/Logo_1.png' width='350' height='100' /></td>
								<td width='343' align='left' valign='middle'>c-69,sector-58<br />
								Maxtra Technologies,Noida<br />
								UP, India.<br />
								Tel : +91120 8768765 Fax : +91120 87879898<br />
								email: gaurav@maxtratechnologies.net</td>
								</tr>
								<tr>
								<td colspan='2'></td>
								</tr>
								<tr>
								<td colspan='2'><table width='100%' border='0' cellpadding='1' cellspacing='1'>
								<tr class='tabr1'>
								<td colspan='4' align='center' bgcolor='#99BBFF' ><span class='style5'>DELIVERY ORDER / INVOICE </span></td>
								</tr>
								<tr>
								<td height='10' colspan='4'></td>
								</tr>
								
								
								<tr>
								<td width='16%'><strong>Name</strong></td>
								<td width='43%'>$fetchusr2[first_name] $fetchusr2[mid_name] $fetchusr2[last_name]</td>
								<td><strong>Invoice No. </strong></td>
								<td>$invoice</td>
								</tr>
								<tr>
								<td valign='top'><strong>Address</strong> </td>
								<td valign='top'>$fetchusr2[address1]</td>
								<td valign='top'><strong>Order Date. </strong> </td>
								<td valign='top'>".date('d-M-Y',strtotime(invoice_date($invoice)))."</td>
								</tr>
								<tr>
								<td><strong>Postal Code </strong></td>
								<td>$fetchusr2[zip]</td>
								<td><strong>Affiliate Name</strong></td>
								<td>$fetchusr2[user_name]</td>
								</tr>
								<tr>
								<td><strong>City</strong></td>
								<td>$fetchusr2[city]</td>
								<td><strong>Affiliate ID</strong></td>
								<td>$userid</td>
								</tr>
							
								<tr>
								<td><strong>Country</strong></td>
								<td>$fetchusr2[country]</td>
								<td><strong>Email</strong></td>
								<td>$fetchusr2[email]</td>
								</tr>
								<tr>
								<td><strong>Contact No. </strong></td>
								<td>$fetchusr2[mobile]</td>
								<td><strong>&nbsp;</strong> </td>
								<td>&nbsp;</td>
								</tr>
								
								</table></td>
								</tr>
								<tr>
								<td colspan='2'></td>
								</tr>
								<tr>
								<td height='30' colspan='2'>&nbsp;</td>
								</tr>
								<tr>
								<td colspan='2'><table width='100%' border='1'   bordercolor='#CCCCCC' cellpadding='2' cellspacing='0' class='tab'>
								<tr class='tabr'>
								<td width='3%' valign='top' align='center' class='tab'><strong>No.</strong></td>
								<td width='12%' valign='top' align='center'><strong>Product ID</strong></td>
								<td width='31%' valign='top' align='center'><strong>Product</strong></td>
								<td width='16%' valign='top' align='center'>Description</td>
								<td width='12%' valign='top' align='center'><strong>Price(USD)</strong></td>
								<td width='12%' valign='top' align='center'><strong>Quantity</strong></td>
								<td width='14%' valign='top' align='center'><strong>Total Price</strong></td>
								</tr>";
								
								
									$tweight=0;
									$tot=0;
									$count=1;
									$overall_tax=0;
									
									while($h=mysql_fetch_array($sltpur))
									{
										$pro=$h['p_id'];
										$qun=$h['quantity'];
										//echo "SELECT * FROM products where p_id='$pro' ";
										$sql=mysql_query("SELECT * FROM product_category where p_cat_id='$pro' ");
										$res=mysql_fetch_array($sql);
										
										//$overall_tax+=$h['tax'];
										if($res['daily_deal'] || $res['gift_card'])
										{
											$price=$h['price'];
											$discount=($h['price']*$h[quantity]*$h['discount']/100);
										}
										else
										{
											$price=$h['price'];
											$discount=$h[discount];
										}
										$tax=0;
										$tax=$h['tax'];
										$totalshipping+=$h['shipping'];
										$tweight+=$h[weight];
										$tp=$price*$h[quantity];
										
										$tottax=$tp*$tax/100;
										
				  						$applytax+= $tottax;
										
										$mail_content.="<tr>
										<td width='3%' valign='top' align='center'>$count.</td>
										<td width='12%' valign='top' align='center'>$pro</td>
										<td width='31%' valign='top' align='center'>$res[product_name]</td>
										<td width='16%' valign='top' align='center'>$res[pro_desc]</td>
										<td width='12%' valign='top' align='center'>$price</td>
										<td width='12%' valign='top' align='center'>$h[quantity]</td>
										<td width='14%' valign='top' align='center'>$tp</td>
										</tr>";
										
										$tot+=$tp;
										$totaldiscount+=$discount;
										$count++;
									}
									/*$slttax=mysql_query("select tax from tax where state='$fetchusr2[state]'");
									if(mysql_num_rows($slttax)>0)
									$tax=mysql_result($slttax,0,0);
									else
									$tax=5;
								$overall_tax+=$tot*$tax/100;*/
								/*$sqltax="select tax from tax where status='1'";
								$restax=mysql_query($sqltax);
								$rowtax=mysql_fetch_assoc($restax);
								$tax=$rowtax['tax'];  
								$totaltax=$tot*$tax/100; */
								$totaltax=$applytax;
								//$totaldiscount=$tot*$discount/100;
								$mail_content.="<tr>
								<td valign='top'>&nbsp;</td>
								<td valign='top'>&nbsp;</td>
								<td valign='top'>&nbsp;</td>
								<td align='left' valign='top'>&nbsp;</td>
								<td align='right' valign='top'>&nbsp;</td>
								<td align='right' valign='top'>&nbsp;</td>
								<td align='right' valign='top'>&nbsp;</td>
								</tr>
								<tr>
								<td colspan='6' align='right' valign='top'>Total</td>
								<td align='right' valign='top'><strong>$tot</strong></td>
								</tr>
								
								<tr>
								<td colspan='6' align='right' valign='top'>Shipping</td>
								<td align='right' valign='top'><strong>$totalshipping</strong></td>
								</tr>
								<tr>
								<td colspan='6' align='right' valign='top'>tax</td>
								<td align='right' valign='top'><strong>".round($totaltax,2)."</strong></td>
								</tr>
								
								<tr>
								<td colspan='6' align='right' valign='top'>Discount</td>
								<td align='right' valign='top'><strong>$totaldiscount</strong></td>
								</tr>
								
								<tr>
								<td colspan='6' align='right' valign='top'>Grand Total </td>
								<td align='right' valign='top'><strong>$fetchpur2[currency] ".round(($tot-$totaldiscount+$totalshipping+$totaltax),2)."</strong></td>
								</tr>
								</table></td>
								</tr>";
function convertNumber($num)  
{  
   list($num, $dec) = explode(".", $num);  
  
   $output = "";  
  
   if($num{0} == "-")  
   {  
      $output = "negative ";  
      $num = ltrim($num, "-");  
   }  
   else if($num{0} == "+")  
   {  
      $output = "positive ";  
      $num = ltrim($num, "+");  
   }  
  
   if($num{0} == "0")  
   {  
      $output .= "zero";  
   }  
   else  
   {  
      $num = str_pad($num, 36, "0", STR_PAD_LEFT);  
      $group = rtrim(chunk_split($num, 3, " "), " ");  
      $groups = explode(" ", $group);  
  
      $groups2 = array();  
      foreach($groups as $g) $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});  
  
      for($z = 0; $z < count($groups2); $z++)  
      {  
         if($groups2[$z] != "")  
         {  
            $output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))  
             && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");  
         }  
      }  
  
      $output = rtrim($output, ", ");  
   }  
  
   if($dec > 0)  
   {  
      $output .= " point";  
      for($i = 0; $i < strlen($dec); $i++) $output .= " ".convertDigit($dec{$i});  
   }  
  
   return $output;  
}  
  
function convertGroup($index)  
{  
   switch($index)  
   {  
      case 11: return " decillion";  
      case 10: return " nonillion";  
      case 9: return " octillion";  
      case 8: return " septillion";  
      case 7: return " sextillion";  
      case 6: return " quintrillion";  
      case 5: return " quadrillion";  
      case 4: return " trillion";  
      case 3: return " billion";  
      case 2: return " million";  
      case 1: return " thousand";  
      case 0: return "";  
   }  
}  
  
function convertThreeDigit($dig1, $dig2, $dig3)  
{  
   $output = "";  
  
   if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";  
  
   if($dig1 != "0")  
   {  
      $output .= convertDigit($dig1)." hundred";  
      if($dig2 != "0" || $dig3 != "0") $output .= " and ";  
   }  
  
   if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);  
   else if($dig3 != "0") $output .= convertDigit($dig3);  
  
   return $output;  
}  
  
function convertTwoDigit($dig1, $dig2)  
{  
   if($dig2 == "0")  
   {  
      switch($dig1)  
      {  
         case "1": return "ten";  
         case "2": return "twenty";  
         case "3": return "thirty";  
         case "4": return "forty";  
         case "5": return "fifty";  
         case "6": return "sixty";  
         case "7": return "seventy";  
         case "8": return "eighty";  
         case "9": return "ninety";  
      }  
   }  
   else if($dig1 == "1")  
   {  
      switch($dig2)  
      {  
         case "1": return "eleven";  
         case "2": return "twelve";  
         case "3": return "thirteen";  
         case "4": return "fourteen";  
         case "5": return "fifteen";  
         case "6": return "sixteen";  
         case "7": return "seventeen";  
         case "8": return "eighteen";  
         case "9": return "nineteen";  
      }  
   }  
   else  
   {  
      $temp = convertDigit($dig2);  
      switch($dig1)  
      {  
         case "2": return "twenty-$temp";  
         case "3": return "thirty-$temp";  
         case "4": return "forty-$temp";  
         case "5": return "fifty-$temp";  
         case "6": return "sixty-$temp";  
         case "7": return "seventy-$temp";  
         case "8": return "eighty-$temp";  
         case "9": return "ninety-$temp";  
      }  
   }  
}  
  
function convertDigit($digit)  
{  
   switch($digit)  
   {  
      case "0": return "zero";  
      case "1": return "one";  
      case "2": return "two";  
      case "3": return "three";  
      case "4": return "four";  
      case "5": return "five";  
      case "6": return "six";  
      case "7": return "seven";  
      case "8": return "eight";  
      case "9": return "nine";  
   }  
} 

								$mail_content.="<tr>
								<td colspan='2'>&nbsp;</td>
								</tr>
								<tr>
								<td colspan='2'><strong>Total Amount (in words) : ".convertNumber($tot+$totalshipping+$totaltax-$totaldiscount)."</strong></td>
								</tr>
								<tr>
								<td colspan='2'>&nbsp;</td>
								</tr>
								<tr>
								<td colspan='2'>
									<table width='100%' border='1'  bordercolor='#CCCCCC' cellpadding='1' cellspacing='0'>
									<tbody>
									<tr  class='tabr1'>
									  <td colspan='4'>Payment(s)</td>
									</tr>
									<tr class='tabr'>
									  <td width='22%' align='center'><strong>Mode</strong></td>
									  <td width='52%' align='center'><strong>Description</strong></td>
									  <td width='12%' align='center'><strong>Percentage</strong></td>
									  <td width='14%' align='center'><strong>Amount (USD)</strong></td>
									</tr>
									<tr>
									  <td align='center'>".ucwords($fetchpur2['pay_mode'])."</td>
									  <td align='center'>The net amount will deduct from your Ewallet.</td>
									  <td align='center'>";
									  if($fetchpur2['pay_mode']=='eWallet') $mail_content.="0"; else {}
									  $mail_content.="</td>
									  <td align='center'>";
									  if($fetchpur2['pay_mode']=='eWallet') $mail_content.=$tot+$overall_tax+$shipping; else {}
									  $mail_content.="</td>
									</tr>";
									if($fetchpur2['pay_mode']=='credit')
									{
									$sql="select card_name,card_no,expiry_month_year,cvs_no from amount_detail where invoice_no='$invoice'";
									$res=mysql_query($sql);
									$row=mysql_fetch_assoc($res);
									$mail_content.="<tr class='tabr'>
									  <td width='22%' align='center'><strong>Cardholder's Name</strong></td>
									  <td width='52%' align='center'><strong>Card Number</strong></td>
									  <td width='12%' align='center'><strong>Expiry Date</strong></td>
									  <td width='14%' align='center'><strong>CVV No </strong></td>
									</tr>
									<tr>
									  <td align='center'>".$row['card_name']."</td>
									  <td align='center'>".$row['card_no']."</td>
									  <td align='center'>".$row['expiry_month_year']."</td>
									  <td align='center'>".$row['cvs_no']."</td>
									</tr>";
									}
									$mail_content.="</tbody>
									</table>
								</td>
								</tr>
								<tr>
								<td colspan='2'>&nbsp;</td>
								</tr>
								<tr>
								<td colspan='2'>Processed By: $fetchusr2[user_name] / ".date('d-M-Y')." </td>
								</tr>
								<tr>
								<td colspan='2'>&nbsp;</td>
								</tr>
								
								
								<tr class='tabr1'>
								<td colspan='2'><table border='1' bordercolor='#CCCCCC' cellpadding='1' cellspacing='0' width='100%'>
								<tr class='tabr1'>
								<td width='50%'><strong>Admin Remarks </strong></td>
								<td width='50%'><strong>Affiliate Remarks </strong></td>
								</tr>
								<tr>
								<td height='62' valign='top' colspan='2'>&nbsp;</td>
								</tr>
								</table></td>
								</tr>
								<tr>
								<td height='15' colspan='2' valign='top'>&nbsp;</td>
								</tr>
								<tr>
								<td colspan='2'><table border='0' bordercolor='#CCCCCC' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
								  <td width='70%' height='30' valign='top'><strong>For and on behalf of: </strong></td>
								  <td width='30%' valign='top'><strong>I acknowledge    receipt of the Product in good condition.</strong></td>
								</tr>
								<tr>
								  <td height='80' valign='bottom'><hr align='left' width='300' />
									  <strong>Shop Deal Share</strong></td>
								  <td valign='bottom'><hr align='left' width='300' />
								  <strong>Affiliate</strong></td>
								</tr>
								</table></td>
								</tr>
								<tr>
								<td colspan='2'>&nbsp;</td>
								</tr>
								
							</table>
				</body>
			</html>
					 ";
echo $mail_content;

?>
				