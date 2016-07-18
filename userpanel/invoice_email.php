<?php
$sql1email_com=mysql_fetch_array(mysql_query("SELECT * FROM registration  where user_id='$id'"));
$address=$sql1email_com[address1]."-".$sql1email_com[city]."-".$sql1email_com[state]."-".$sql1email_com[country];
$mobile=$sql1email_com['mobile'];
$first_name=$sql1email_com['first_name'];
$mid_name=$sql1email_com['mid_name'];
$last_name=$sql1email_com['last_name'];
$address1=$sql1email_com['address1'];
$address2=$sql1email_com['address2'];
$city=$sql1email_com['city'];
$state=$sql1email_com['state'];
$country=$sql1email_com['country'];
$zip=$sql1email_com['zip'];
		
$email_from='poonam@maxtratechnologies.com';
$to_company_email=$sql1email_com[email];
$to_company_cname=$sql1email_com[user_name];
$headeruser1="Mime-Version: 1.0\r\n";
$headeruser1.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headeruser1.="From:Vision Team Network<".$email_from.">" . "\r\n";	
$str="<html>
		<head>
		<meta http-equiv= 'Content-Type ' content= 'text/html; charset=utf-8 '>
		<title>http://198.154.192.169/~develope/mike</title>
		</head>
		<body style= 'margin:0px; padding:0px; color:#cc0000; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; '>
		  <div id= 'content ' style= 'width:98.5%; overflow:hidden;  '>";
$str.="<table border='2' cellspacing='0' cellpadding='2' width='100%' style= 'border-collapse:collapse'>
<tbody>
<tr>
<td width='100%' align='left'>
<table border='0' cellspacing='0' cellpadding='2' width='100%'>
<tbody>
<tr>
<td width='50%'>
<table border='0' cellspacing='0' cellpadding='2' width='100%'>
<tbody>
<tr>
<td>
<p>Address:$address1<br /><br />Phone: $mobile<br />E-mail:$to_company_email<br />URL:</p>
</td>
<td>
<p>+1-888-908-2640<br />support@visionteamnetwork.com<br />http://198.154.192.169/~develope/mike</p>
</td>
</tr>
</tbody>
</table>
</td>
<td width='50%' align='center' valign='middle'><img src='http://198.154.192.169/~develope/mike/img/logo.png'></td>
</tr>
<tr>
<td style='background-color:#D6D6D6;' colspan='2' align='left'>
<h4 style='margin:0px;'>Order Information</h4>
</td>
</tr>
<tr>
<td colspan='2' width='100%' align='left'>
<table border='0' cellspacing='0' cellpadding='2' width='100%'>
<tbody>
<tr>
<td colspan='2' width='100%' align='left' valign='top'>
<table style='width: 100%;' border='0' cellspacing='0' cellpadding='2'>
<tbody>
<tr>
<td width='25%' align='left'>Order Number:</td>
<td align='left'>$newID</td>
</tr>
<tr>
<td width='25%' align='left'>Order Date:</td>
<td align='left'>$curdate</td>
</tr>
<tr>
<td width='25%' align='left'>Order Status:</td>
<td align='left'>Pending</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style='background-color:#D6D6D6;' colspan='2' align='left'>
<h4 style='margin:0px;'>Customer Information</h4>
</td>
</tr>
<tr>
<td colspan='2' width='100%' align='left'>
<table style='width: 100%;' border='0' cellspacing='0' cellpadding='2'>
<tbody>
<tr>
<td width='50%' align='left' valign='top'>
<table style='width: 100%;' border='0' cellspacing='0' cellpadding='2'>
<tbody>
<tr>
<td colspan='2' align='left'>
<h4 style='margin:0px;'>Billing address</h4>
</td>
</tr>
<tr>
<td align='left'>Email:</td>
<td align='left'>$to_company_email</td>
</tr>
<tr>
<td align='left'>Company Name:</td>
<td align='left'>Siensafrica</td>
</tr>
<tr>
<td align='left'>First Name:</td>
<td align='left'>$first_name</td>
</tr>
<tr>
<td align='left'>Last Name:</td>
<td align='left'>$last_name</td>
</tr>
<tr>
<td align='left'>Middle Name:</td>
<td align='left'>$mid_name</td>
</tr>
<tr>
<td align='left'>Address 1:</td>
<td align='left'>$address1</td>
</tr>
<tr>
<td align='left'>Address 2:</td>
<td align='left'>$address2</td>
</tr>
<tr>
<td align='left'>City:</td>
<td align='left'>$city</td>
</tr>
<tr>
<td align='left'>Zip/Postal Code:</td>
<td align='left'>$zip</td>
</tr>
<tr>
<td align='left'>Country:</td>
<td align='left'>$country</td>
</tr>
<tr>
<td align='left'>State/Province/Region:</td>
<td align='left'>$state</td>
</tr>
<tr>
<td align='left'>Mobile phone:</td>
<td align='left'>$mobile</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td width='50%' align='left' valign='top'>
<table style='width: 100%;' border='0' cellspacing='0' cellpadding='2'>
<tbody>
<tr>
<td style='background-color:#D6D6D6;' colspan='2' align='left'>
<h4 style='margin:0px;'>Payment information</h4>
</td>
</tr>
<tr>
<td align='left'>Payment Method:</td>
<td align='left'>$pay_mode</td>
</tr>
<tr>
<td align='left'></td>
<td align='left'></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style='background-color:#D6D6D6;' colspan='2' align='left'>
<h4 style='margin:0px;'>Order Items</h4>
</td>
</tr>";
$str.="<tr>
<td colspan='2' width='100%' align='left'>
<table border='2' cellspacing='0' cellpadding='2' width='100%' style= 'border-collapse:collapse'>

<tr>
<th width='8%' align='left' valign='top'>Product Name</th>

<th width='8%' align='left' valign='top'>Quantity</th>
<th width='12%' align='left' valign='top'>Price</th>
<th width='12%' align='left' valign='top'>Sub Total</td>
</tr>";
$sql_prod="select * from purchase_detail where invoice_no='$newID'";
$res_prod=mysql_query($sql_prod);
while($row_prod=mysql_fetch_assoc($res_prod))
{
$pid=$row_prod['p_id'];
$sub_total=$row_prod[quantity]*$row_prod[price];
$sub_total_total=$sub_total_total+$sub_total;
$shipping1=$shipping1+$row_prod['shipping'];
$tax=$tax+$row_prod['tax'];
$discount=$discount+$row_prod['discount'];
$product_name=$row_prod[product_name];
$price=$row_prod[price];
$quantity=$row_prod[quantity];
$sql_img="select image from product_category where p_cat_id='$pid'";
$res_img=mysql_query($sql_img);
$row_img=mysql_fetch_assoc($res_img);
$image="http://198.154.192.169/~develope/mike/product_logos/".$row_img[image];
//$sql_p="select * from";
$str.="<tr>
<td width='8%' align='left' valign='top'>$product_name</td>

<td width='8%' align='left' valign='top'>$quantity</td>
<td width='12%' align='left' valign='top'>$price USD</td>
<td width='12%' align='left' valign='top'>$sub_total USD</td>
</tr>";
}
$total=$sub_total_total+$shipping1+$tax-$discount;
$str.="</table></td></tr><tr>
<td  align='right' valign='top'>SubTotal :</td>
<td align='left' valign='top'>$sub_total_total USD</td>
</tr>
<tr>
<td  align='right' valign='top'>Shipping and Handling Fee :</td>
<td align='left' valign='top'>$shipping USD</td>
</tr>
<tr>
<td align='right' valign='top'>Tax Total :</td>
<td align='left' valign='top'>$tax USD</td>
</tr>
<tr>
<td align='right' valign='top'>Order Discount :</td>
<td align='left' valign='top'>$discount USD</td>
</tr>
<tr>
<td  align='right' valign='top'>Total :</td>
<td align='left' valign='top'>$total USD</td>
</tr>
</tbody>
</table>
</td>
</tr>";

$str.="<tr>
<td style='background-color:#D6D6D6;' colspan='2' align='left'>
<h4 style='margin:0px;'>Customer Note</h4>
</td>
</tr>
<tr>
<td colspan='2' width='100%' align='left'>
<table style='width: 100%;' border='0' cellspacing='0' cellpadding='2'>
<tbody>
<tr>
<td>{customer_note}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>";
$str.="</div></body></html>";
//echo md5("manish@123");
//echo $str;exit;		
$mail3=mail($to_company_email,"Order ", $str, $headeruser1);
$mail3=mail('subhash@maxtratechnologies.com',"Order ", $str, $headeruser1);
?>