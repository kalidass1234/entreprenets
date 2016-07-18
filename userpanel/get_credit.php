<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$add_by=$_SESSION['SD_User_Name'];
	$s="select user_id,paid_to,paypal_account from registration where user_name='$add_by'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$userid=$f['user_id'];
	if(isset($_POST['member_id']))
	{
		//$member_id=showuserid($_POST['member_id']);
		extract($_POST);
		//echo "select * from registration where user_id='$member_id' or user_name='$member_id' ";exit;
		$res=mysql_query("select * from registration where user_id='$member_id' or user_name='$member_id' ");
		$count=mysql_num_rows($res);
		$row=mysql_fetch_assoc($res);
		if($count>0)
		{
			
		}
		else
		{
			echo "<script language='javascript'>alert('Wrong MemberId Entered.');window.location.href='add_product_for_user.php';</script>";exit;
		}
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

// admin charge
$sl="select * from admin_charge where section='addmoney'";
$rs=mysql_query($sl);
$r=mysql_fetch_assoc($rs);
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
  var html=amount1*<?php echo $r['charge_per'];?>/100;
  //alert(html);
  var total_amount=parseInt(amount1)+parseInt(html);
  $('#product').val(html);
  $('#total_amount').val(total_amount);
    });
});
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
							 
							
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  <th scope="row"></th>
							  </tr>
							  <form name="sss" id="sss" action="get_credit_payment.php" method="post">
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC;">
                                
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th scope="row">Amount</th>
                                  <td><input type="text" name="amount1" id="amount1" required onKeyUp="if(isNaN(this.value)){this.value=''}" onBlur="if(isNaN(this.value)){this.value=''}"><input type="hidden" name="buyer_id" value="<?php echo $row['user_id'];?>"></td>
                                </tr>
								<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  
							  </tr>
							  <tr>
							  <th scope="row">&nbsp;</th>
							  <td><?php echo $r['charge_per'];?>% goes to admin</td>
							
							  </tr>
							<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  <th scope="row"></th>
							  </tr>
								<tr>
                                  <th width="50%" scope="row">Admin Charge</th>
                                  <td width="50%"><label>
                                    <input type="text"  id="product" disabled="disabled">
                                  </label></td>
                                </tr>
								<tr>
							  <th scope="row">&nbsp;</th>
							  <td>&nbsp;</td>
							  <th scope="row"></th>
							  </tr>
								<tr>
                                  <th width="50%" scope="row">Total</th>
                                  <td width="50%"><label>
                                    <input type="text"  id="total_amount" disabled="disabled">
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