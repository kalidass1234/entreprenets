<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$add_by=$_SESSION['SD_User_Name'];
	$s="select * from registration where user_name='$add_by'";
	$r=mysql_query($s);
	$resuser=mysql_fetch_array($r);
	$userid=$resuser['user_id'];
	
	$sqlcharge="select * from admin_charge where section='addmoney'";
$rscharge=mysql_query($sqlcharge);
$rowcharge=mysql_fetch_assoc($rscharge);
//unset($_SESSION['amount1']);
	if(isset($_SESSION['amount1'])){}else{$_SESSION['amount1']=$_POST['amount1']+$_POST['amount1']*$rowcharge['charge_per']/100;}
	if(isset($_SESSION['amount'])){}else{$_SESSION['amount']=$_POST['amount1'];}
	function transaction_no()
	{
		//$encypt1=uniqid(rand(), true);
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select transaction_no from add_money where transaction_no='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	$transaction_no=transaction_no();
	$_SESSION['t_no']=$transaction_no;
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title><?php echo $TITLE_USER;?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script type="text/javascript" src="js/jquery-1.5.min.js"></script>
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>

<script src="js/custom-scripts.js"></script>
<script language="javascript">
$(document).ready(function(){
  $('#amount1').blur(function(){
  var amount1=$('#amount1').val();
  var html=amount1*10/100;
  //alert(html);
  $('#product').val(html);
    });
});
function frm_submit(val)
{
//alert(val);
	if(val=='debit')
	{
		//document.getElementById("row_debit").style.display='table-row';

		document.getElementById("cardtype").required=true;
		document.getElementById("card_name").required=false;
		document.getElementById("card_no").required=false;
		document.getElementById("cvs_no").required=false;
		document.getElementById('sss').action='get_credit_return.php?mode=debit';
	}
	
	else if(val=='paypal')
	{
		
		//document.getElementById("row_debit").style.display='none';
	
		document.getElementById("cardtype").required=false;
		document.getElementById("card_name").required=false;
		document.getElementById("card_no").required=false;
		document.getElementById("cvs_no").required=false;

		document.getElementById('sss').action='https://www.paypal.com/cgi-bin/webscr';
	}
}
function showcard(cardid)
{
document.getElementById("cardtype").value=cardid;
	if(cardid=='add')
	{
		document.getElementById("add").style.display='';

		document.getElementById("card_name").required=true;
		document.getElementById("card_no").required=true;
		document.getElementById("month").required=true;
		document.getElementById("exyy").required=false;
		document.getElementById("cvs_no").required=true;
		if(document.getElementById("card_no").length<16 || document.getElementById("card_no").length>16){ alert('wrong card number'); return false;}
		if(document.getElementById("cvs_no").length<3 || document.getElementById("cvs_no").length>3){ alert('wrong cvs number'); return false;}
	}
	else
	{
		document.getElementById("add").style.display='none';
		document.getElementById("card_name").required=false;
		document.getElementById("card_no").required=false;
		document.getElementById("month").required=false;
		document.getElementById("exyy").required=false;
		document.getElementById("cvs_no").required=false;
	}
}
</script>
</head>
<body id="theme-default" class="full_block">
<?php
include('left-bar.php');
?>
<div id="container">
	<div id="header" class="blue_lin">
		<div class="header_left">
			<?php
			include('header-left.php');
			?>
			<?php
			include('menu-mobile.php');
			?>
		</div>
		<?php
		include('header-right.php');
		?>
	</div>
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Get Credit </h3>
		<!--<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>-->
	</div>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Get credit  : </h6>
					</div>
					<div class="widget_content">
						
						
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <th colspan="3" scope="row">&nbsp;</th>
							  </tr>
							 <tr id="t_cb">
							  <th scope="row">&nbsp;</th>
							  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC;">
                                <tr>
                                  <th width="50%" scope="row">User Id</th>
                                  <td width="50%"><?php echo $userid;?></td>
                                </tr>
								<tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
								 <tr>
                                  <th width="50%" scope="row">User Name</th>
                                  <td width="50%"><?php echo showusername($userid);?></td>
                                </tr>
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th scope="row">Amount</th>
                                  <td><?php echo $_SESSION['amount1'];?></td>
                                </tr>
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <th scope="row">transaction no</th>
                                  <td><?php echo $_SESSION['t_no'];?></td>
                                </tr>
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
							  <th scope="row"></th>
							  </tr>
							
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  <th scope="row"></th>
							  </tr>
							  <form name="sss" id="sss" action="get_credit_return.php?mode=debit" method="post">
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC;">
                                
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th scope="row"><input type="radio" name="payout" value="debit" checked="checked" onClick="frm_submit('debit');">Credit Card</th>
                                  <td><?php
										$cardinfo="select * from card_info where user_name='$_SESSION[SD_User_Name]' and status='1'";
										$rescard=mysql_query($cardinfo);
										?>
										<select name="cardtype" id="cardtype" required class="inputtext" onChange="showcard(this.value);" >
										<option value="">Select Card</option>
										<?php 
										$sl=1;
										while($rowcard=mysql_fetch_assoc($rescard))
										{
										?>
										<option value="<?php echo $rowcard['id'];?>" <?php if($rowcard['id']==$cardid){ echo "selected";}?>><?php echo $sl.'-'.$rowcard['card_name'];?></option>
										<?php
										$sl++;
										}
										?>
										<option value="add" <?php if($cardid=='add'){ echo "selected";}?>>Add A New Card</option>
										<!--<option value="visa">Visa</option>
										<option value="mastercard">Master Card</option>-->
										</select>
										<input type="hidden" name="buyer_id" value="<?php echo $row['user_id'];?>"></td>
                                </tr>
								<tr id="add"  style="display:none;" >
										<th scope="row">&nbsp;</th>
										<td width="98%" colspan="2">
											<table style="border:1px solid">
												<tbody><tr><td class="commen_tablecont">Card Holder's Name</td><td><input type="text" name="card_name" id="card_name" class="inputtext" ></td></tr>
												<tr><td class="commen_tablecont">Card Number</td><td><input type="text" name="card_no" maxlength="16" onKeyUp="if(isNaN(this.value)){ this.value='';}" id="card_no" class="inputtext" ></td></tr>
												<tr><td class="commen_tablecont">Expiry Date</td><td>
												<select name="exmonth" style="width:75px;" id="month" >
											  <option value="01">January</option>
											  <option value="02">February</option>
											  <option value="03">March</option>
											  <option value="04">April</option>
											  <option value="05">May</option>
											  <option value="06">June</option>
											  <option value="07">July</option>
											  <option value="08">August</option>
											  <option value="09">September</option>
											  <option value="10">October</option>
											  <option value="11">November</option>
											  <option value="12">December</option>
                   					 </select>
									 <select name="exyy" id="exyy" style="width:70px;">
										<?php
										for($y=2013;$y<2038;$y++)
										{
										?>
										<option value="<?php echo $y;?>"><?php echo $y;?></option>									
										<?php
										}
										?>
									</select>
												</td></tr>
												<tr><td class="commen_tablecont">CVV Number</td><td><input type="text" name="cvs_no" id="cvs_no" onKeyUp="if(isNaN(this.value)){ this.value='';}" maxlength="3" class="inputtext" required=""></td></tr>
											</tbody></table>										</td>
									  </tr>
								<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  
							  </tr>
							 
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  <th scope="row"></th>
							  </tr>
								<tr>
                                  <th width="50%" scope="row"><input type="radio" name="payout" value="paypal" onClick="frm_submit('paypal');">Paypal
								  <input type="hidden" name="cmd" value="_xclick">  
 <input type="hidden" name="business" value="info@maxtratechnologies.net">

 <input type="hidden" name="item_name" value="Recharge E-wallet"> 
  <input type="hidden" name="item_number" value="<?=$_SESSION['t_no'];?>"> 
 <input type="hidden" name="amount" value="<?=$_SESSION['amount1'];?>">  
 <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="return" value="http://198.154.192.169/~develope/shopdeal/userpanel/get_credit_return.php?mode=paypal&paypal=1&order_no=<?=$_SESSION['t_no'];?>">
 <input type="hidden" name="cancel_return" value="http://198.154.192.169/~develope/shopdeal/cancel.php?error=Transaction Failed. Please Try Again">
<input type="hidden" name="first_name" value="<?php echo $resuser['first_name'];?>">  
 <input type="hidden" name="last_name" value="<?php echo $resuser['last_name'];?>">  
 <input type="hidden" name="address1" value="<?php echo $resuser['address1'];?>">  
 <input type="hidden" name="address2" value="<? //$address2;?>">  
 <input type="hidden" name="city" value="<?php echo $resuser['city'];?>">  
 <input type="hidden" name="state" value="<?php echo $resuser['state'];?>">  
 <input type="hidden" name="zip" value="<?php echo $resuser['zip'];?>">  
 <input type="hidden" name="night_phone_a" value="<?php echo $resuser['mobile'];?>">  
 <input type="hidden" name="email" value="<?php echo $resuser['email'];?>">
								  </th>
                                  <td width="50%"><label>
                                    &nbsp;
                                  </label></td>
                                </tr>
                              </table></td>
							  <th scope="row"></th>
							  </tr>
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  <th scope="row"></th>
							  </tr>
							
							  <tr>
							  <th scope="row">&nbsp;</th>
                                  <th  align="center" scope="row">&nbsp;</th>
                                </tr>
							  <tr>
							  <th scope="row">&nbsp;</th>
                                  <th  align="center" scope="row"><button type="submit" class="btn_small btn_blue" tabindex="12"><span>Submit</span></button></th>
                                </tr>
							  </form>
							 
							<tr>
							  <th colspan="3" align="left" scope="row"><font size="2" color="#FF0000"><?php echo @$_GET['error'];?></font></th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							<tr>
							  <th colspan="3" align="left" scope="row">&nbsp;</th>
							  </tr>
							</table>
							
                        
						
						
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>
<?php
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
?>