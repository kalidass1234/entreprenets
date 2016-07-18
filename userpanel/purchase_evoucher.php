<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	if(isset($_GET['msg']))
	$msg=$_REQUEST['msg'];
	else
	$msg='';
	$regdate_ip = getenv('REMOTE_ADDR');
	$s="select * from registration where user_name='$idd'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$id=$f['user_id'];
}
else
{
	echo "<script language='javascript'>window.location.href='../member_login.php';</script>";exit;
}
include('header.php'); 
$res_ref=showuserinfo($f['ref_id']);
$res_nom=showuserinfo($f['nom_id']);
if(isset($_POST['tcode'])){
	 $t_code=$_POST['tcode'];
	$password=$_POST['password'];
	$old=$_POST['username1'];
mysql_query("update registration SET  user_pass='$password'  WHERE user_id='$id' and t_code='$t_code' and user_pass='$old'") or die(mysql_error());	
 $count=mysql_affected_rows();
if($count>0){
echo "<script language='javascript'>window.location.href='view_profile.php';</script>";exit;
}
else{
	echo "<script language='javascript'>alert('Your old password or transaction password is incorrect.');</script>";
}
}
?>
<style>
.binary_line1 {
	background: url(images/topline.gif) no-repeat center top;
	border-top: solid #000 2px;
}
</style>
<script type="text/javascript">
function validate11()
{
	if(jQuery('#username1').val()=='' || jQuery('#username1').val()=='Enter Old Password')
	{
		alert("Please Enter Old Password");
		jQuery('#username1').focus();
		return false;
	}
	if(jQuery('#password1').val()=='' || jQuery('#password1').val()=='Enter New Password')
	{
		alert("Please Enter New Password");
		jQuery('#password1').focus();
		return false;
	}
	if(jQuery('#password1').val()!=jQuery('#password_con').val())
	{
		alert("New Password and Confirm Password Should Be Same");
		jQuery('#password_con').focus();
		return false;
	}
	if(jQuery('#txtcapture').val()=='' || jQuery('#txtcapture').val()=='Enter Verification Code')
	{
		alert("Please Input Verification Code");
		jQuery('#txtcapture').focus();
		return false;
	}
	if(jQuery('#txtcapture').val()!=jQuery('#captcha12').val())
	{
		alert("Please Enter Valid Verification Code");
		jQuery('#txtcapture').focus();
		return false;
	}
	if(jQuery('#txtConfCapture').val()=='' || jQuery('#txtConfCapture').val()=='Confirm Verification code')
	{
		alert("Please Input Confirm Verification Code");
		jQuery('#txtConfCapture').focus();
		return false;
	}
	if(jQuery('#txtcapture').val()!=jQuery('#txtConfCapture').val())
	{
		alert("Verification Code and Confirm Verification Code Should Be Same");
		jQuery('#txtConfCapture').focus();
		return false;
	}
	if(jQuery('#tcode').val()=='')
	{
		alert("Please Enter Transaction Pin");
		jQuery('#tcode').focus();
		return false;
	}
	document.getElementById('form1').submit();
}
</script>
<script language="javascript">
function search_node(val)
{
	if(val=='jdate')
	{
		document.getElementById('search-td2').style.display='table-row';
		document.getElementById('search-td1').style.display='none';
	}
	else if(val=='unm')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate Login Name';
		document.getElementById('uid').name='unm';
	}
	else if(val=='uid')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate User ID';
		document.getElementById('uid').name='uid';
	}
}
</script>
<script type="text/javascript">
	function refreshCaptcha1()
	{
	 var img = document.images['captchaimg'];
	 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	 //getcaptcha1();
	}
	function getcaptcha1()
	{
	var urldata="ref=1";
		 jQuery.ajax({
                type: "POST",
                async: "false",
                url: "../captcha_sess.php",
                data: urldata,
                success: function(html) {
                jQuery('#captcha12').val(html);
				}
            });	
	}
	
	function showpayment(str)
{
	if(str=='credit card')
	{
		document.getElementById('show_card').style.display='block';
		document.getElementById('show_voucher').style.display='none';
	}
	else if(str=='final_e_wallet')
	{
		document.getElementById('show_card').style.display='none';
		document.getElementById('show_voucher').style.display='block';
	}
}

function shownext(path)
{
//alert("subhash");
//alert(document.getElementById("checkbox1").checked);
var x_first_name=document.getElementById('x_first_name').value;
var x_last_name=document.getElementById('x_last_name').value;
var x_address=document.getElementById('x_address').value;
var x_city=document.getElementById('x_city').value;
var x_state=document.getElementById('x_state').value;
var x_zip=document.getElementById('x_zip').value;
var x_mobile=document.getElementById('x_mobile').value;
var x_email=document.getElementById('x_email').value;

var card_type=document.getElementById('card_type').value;
var card_no=document.getElementById('card_no').value;
var cvv=document.getElementById('cvv').value;
var exp_year=document.getElementById('exp_year').value;
var exp_month=document.getElementById('exp_month').value;
var inputtxt=document.getElementById('card_no');
var amount=document.getElementById('amount').value;
var evoucher=document.getElementById('evoucher').value;

	if(document.getElementById('x_first_name').value=='')
	{
		alert("Please Enter Your First Name.");
		return false;
	}
	if(document.getElementById('x_last_name').value=='')
	{
		alert("Please Enter Your Last Name.");
		return false;
	}
	if(document.getElementById('x_address').value=='')
	{
		alert("Please Enter Your Address.");
		return false;
	}
	if(document.getElementById('x_city').value=='')
	{
		alert("Please Enter Your City.");
		return false;
	}
	if(document.getElementById('x_state').value=='')
	{
		alert("Please Enter Your State.");
		return false;
	}
	if(document.getElementById('x_zip').value=='')
	{
		alert("Please Enter Your Zip.");
		return false;
	}
	if(document.getElementById('x_mobile').value=='')
	{
		alert("Please Enter Your Mobile.");
		return false;
	}
	if(document.getElementById('x_email').value=='')
	{
		alert("Please Enter Your Email.");
		return false;
	}
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(document.getElementById('x_email').value=='' || regex.test(document.getElementById('x_email').value)==false)
	{
		alert("Please Enter correct Email ID");
		document.getElementById('x_email').focus();
		return false;
	}
	var TLDs = new Array("ac", "ad", "ae", "aero", "af", "ag", "ai", "al", "am", "an", "ao", "aq", "ar", "arpa", "as", "asia", "at", "au", "aw", "ax", "az", "ba", "bb", "bd", "be", "bf", "bg", "bh", "bi", "biz", "bj", "bm", "bn", "bo", "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cat", "cc", "cd", "cf", "cg", "ch", "ci", "ck", "cl", "cm", "cn", "co", "com", "coop", "cr", "cu", "cv", "cx", "cy", "cz", "de", "dj", "dk", "dm", "do", "dz", "ec", "edu", "ee", "eg", "er", "es", "et", "eu", "fi", "fj", "fk", "fm", "fo", "fr", "ga", "gb", "gd", "ge", "gf", "gg", "gh", "gi", "gl", "gm", "gn", "gov", "gp", "gq", "gr", "gs", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu", "id", "ie", "il", "im", "in", "info", "int", "io", "iq", "ir", "is", "it", "je", "jm", "jo", "jobs", "jp", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "la", "lb", "lc", "li", "lk", "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "me", "mg", "mh", "mil", "mk", "ml", "mm", "mn", "mo", "mobi", "mp", "mq", "mr", "ms", "mt", "mu", "museum", "mv", "mw", "mx", "my", "mz", "na", "name", "nc", "ne", "net", "nf", "ng", "ni", "nl", "no", "np", "nr", "nu", "nz", "om", "org", "pa", "pe", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "pro", "ps", "pt", "pw", "py", "qa", "re", "ro", "rs", "ru", "rw", "sa", "sb", "sc", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl", "sm", "sn", "so", "sr", "st", "su", "sv", "sy", "sz", "tc", "td", "tel", "tf", "tg", "th", "tj", "tk", "tl", "tm", "tn", "to", "tp", "tr", "travel", "tt", "tv", "tw", "tz", "ua", "ug", "uk", "us", "uy", "uz", "va", "vc", "ve", "vg", "vi", "vn", "vu", "wf", "ws", "xn--0zwm56d", "xn--11b5bs3a9aj6g", "xn--3e0b707e", "xn--45brj9c", "xn--80akhbyknj4f", "xn--90a3ac", "xn--9t4b11yi5a", "xn--clchc0ea0b2g2a9gcd", "xn--deba0ad", "xn--fiqs8s", "xn--fiqz9s", "xn--fpcrj9c3d", "xn--fzc2c9e2c", "xn--g6w251d", "xn--gecrj9c", "xn--h2brj9c", "xn--hgbk6aj7f53bba", "xn--hlcj6aya9esc7a", "xn--j6w193g", "xn--jxalpdlp", "xn--kgbechtv", "xn--kprw13d", "xn--kpry57d", "xn--lgbbat1ad8j", "xn--mgbaam7a8h", "xn--mgbayh7gpa", "xn--mgbbh1a71e", "xn--mgbc0a9azcg", "xn--mgberp4a5d4ar", "xn--o3cw4h", "xn--ogbpf8fl", "xn--p1ai", "xn--pgbs0dh", "xn--s9brj9c", "xn--wgbh1c", "xn--wgbl6a", "xn--xkc2al3hye2a", "xn--xkc2dl3a5ee0h", "xn--yfro4i67o", "xn--ygbi2ammx", "xn--zckzah", "xxx", "ye", "yt", "za", "zm", "zw");
		
	if(regex.test(document.getElementById('x_email').value)==true)
	{
		var ext=document.getElementById('x_email').value.split('.');
		var endext=ext[ext.length-1];
		var i=0;
		var flag=false;
		for(i=-0;i<TLDs.length;i++)
		{
			if(TLDs[i]==endext)
			{
				flag=true;
			}
		}
		if(flag)
		{
			
		}
		else
		{
			alert("Please Select Valid EmailId With Valid Domain.");
			return false;
		}
	}
	
	if(document.getElementById('x_email').value!=document.getElementById('c_x_email').value)
	{
		alert("Email and Confirm Email should be same.");
			return false;
	}
	if(document.getElementById('card_no').value=='')
	{
		alert("Please Enter Your Card Number.");
		return false;
	}

	if(document.getElementById('cvv').value=='')
	{
		alert("Please Enter Your CVV Number.");
		return false;
	}
	//alert("Mike");
		cardnumber(inputtxt,card_type);
		
post_to_url(path, {'x_first_name':x_first_name,'x_last_name':x_last_name,'exp_year':exp_year,'exp_month':exp_month,'card_type':card_type,'card_no':card_no,'cvv':cvv,'x_address':x_address,'x_city':x_city,'x_state':x_state,'x_zip':x_zip,'x_mobile':x_mobile,'x_email':x_email,'evoucher':evoucher,'amount':amount});
}

function cardnumber(inputtxt,card_type)  
{  
  //alert(inputtxt+"________"+card_type);
  if(card_type=='American Express')
  {
	  var cardno = /^(?:3[47][0-9]{13})$/;  
	  if(inputtxt.value.match(cardno))  
			{  
		  //return true;  
			}  
		  else  
			{  
			alert("Not a valid Amercican Express credit card number!");  
			return false;  
			}  
   }
   if(card_type=='Visa')
   {
      var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/; 
	  //alert(inputtxt.value.match(cardno)); 
  	  if(inputtxt.value.match(cardno))  
      {  
      	//return true;  
      }  
      else  
      {  
        alert("Not a valid Visa credit card number!");  
        return false;  
      } 
   }
   if(card_type=='Mastercard')
   {
   	  var cardno = /^(?:5[1-5][0-9]{14})$/;  
  if(inputtxt.value.match(cardno))  
        {  
      //return true;  
        }  
      else  
        {  
        alert("Not a valid Mastercard number!");  
        return false;  
        } 
   }
   if(card_type=='Discover')
   {
   	  var cardno = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;  
  if(inputtxt.value.match(cardno))  
        {  
     // return true;  
        }  
      else  
        {  
        alert("Not a valid Discover card number!");  
        return false;  
        } 
   }
   
} 

 function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
         }
    }
    document.body.appendChild(form);
    form.submit();
}
	</script>
<style type="text/css">
table.display td input[type=submit] {
	height: 30px !important;
	padding: 0 5px;
	border: #093868 1px solid;
}
</style>
<script language="javascript">
function show_total()
{
	var amount=document.getElementById('amount').value;
	var count=document.getElementById('evoucher').value;
	var total=amount*count;
	document.getElementById('show_total').innerHTML=total;
}
</script>
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
  <?php
	include('switch-bar.php');
//echo "SELECT SUM( fuew.amount + flew.amount + fiew.amount ) AS fuew_am FROM funding_e_wallet  fuew INNER JOIN flifejacket_e_wallet flew ON flew.user_id=fuew.user_id INNER JOIN final_e_wallet fiew on fiew.user_id=flew.user_id where fiew.user_id='$userid'";
	?>
  <?php round($fund_sql['fuew_am'], 2);?>
  <div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
        <h6 align="center" style="color:#0033FF">Welcome <?php echo $_SESSION['SD_User_Name'];?> </h6>
        <div class="widget_wrap ">
          <div class="widget_top" align="center">
            <h6 >Purchase Member-to-Member E Vouchers</h6>
          </div>
          <div class="grid_12 full_block">
            <form method="post" action="create_pin_func.php" id="form1">
              <div class="widget_wrap ">
                <div class="widget_content">
                <div class="form_grid_12" >
                <div style="font-size:14px; padding:1% 0%;  line-height:18px; ">
</div>
                </div>
                <?php
				  $user_id=showuserid($_SESSION['SD_User_Name']);
				  $sql_subs="select * from subscription where user_id='$user_id' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?>
                  <table width="100%" border="0" class="display">
                   <?php 
				   $sql_pin="select distinct amount from pins where status=0 order by amount asc";
				   $res_pin=mysql_query($sql_pin);
				   ?>
                    <tr>
                      <td width="39%">E Voucher Type</td>
                      <td width="19%">:</td>
                      <td width="42%"><select name="amt" id="amount" required>
                        <option value="29.99" <?php if($_POST['amt']==29.99){ echo "selected";}?> >$29.99</option>
                        <option value="84.98" <?php if($_POST['amt']==84.98){ echo "selected";}?>>$84.98</option>
                        <option value="89.97" <?php if($_POST['amt']==89.97){ echo "selected";}?>>$89.97</option>
                        <option value="150" <?php if($_POST['amt']==150){ echo "selected";}?>>$150</option>
                        <option value="179.94" <?php if($_POST['amt']==179.94){ echo "selected";}?>>$179.94</option>
                        <option value="179.99" <?php if($_POST['amt']==179.99){ echo "selected";}?>>$179.99</option>
                        <option value="239.97" <?php if($_POST['amt']==239.97){ echo "selected";}?>>$239.97</option>
                        <option value="254.94" <?php if($_POST['amt']==254.94){ echo "selected";}?>>$254.94</option>
                        <option value="329.94" <?php if($_POST['amt']==329.94){ echo "selected";}?>>$329.94</option>
                        <option value="359.88" <?php if($_POST['amt']==359.88){ echo "selected";}?>>$359.88</option>
                        <option value="404.94" <?php if($_POST['amt']==404.94){ echo "selected";}?>>$404.94</option>
                        <option value="509.88" <?php if($_POST['amt']==509.88){ echo "selected";}?>>$509.88</option>
                        <option value="659.88" <?php if($_POST['amt']==659.88){ echo "selected";}?>>$659.88</option>
                        <option value="1019.76" <?php if($_POST['amt']==1019.76){ echo "selected";}?>>$1019.76</option>
                        <option value="1169.76" <?php if($_POST['amt']==1169.76){ echo "selected";}?>>$1,169.76</option>
                       <!-- <option value="10">10</option>-->
                      </select></td>
                    </tr>
                     <tr>
                      <td>No Of E Vouchers</td>
                      <td>:</td>
                      <td><input type="text" name="evoucher" id="evoucher" value="" autocomplete="off" onpaste="return false;" oncopy="return false;" oncut="return false;" onKeyPress="if(isNaN(this.value)){ this.value='';}" onBlur="if(isNaN(this.value)){ this.value='';} show_total(); "></td>
                    </tr>
                    <tr>
                      <td width="39%">Total Due</td>
                      <td width="19%">:</td>
                      <td width="42%">$<span id="show_total">0</span></td>
                    </tr>
                  </table>
                </div>
                <div class="widget_content">
                  <table width="100%" border="0" class="display">
				<?php
				$user_id=showuserid($_SESSION['SD_User_Name']);
				$sql_wallet="select * from final_e_wallet where user_id='$user_id'";
				$res_wallet=mysql_query($sql_wallet);
				$row_wallet=mysql_fetch_assoc($res_wallet);
				if($_REQUEST['notamount']!='')
				{
				?>
				<!--<tr>
                   <td> <input type="radio" name="payopt" value="final_e_wallet" checked="checked" >
                    E-Wallet Amount(<?php echo round($row_wallet['amount'], 2);?>)
					</td>
                     <td width="39%" align="right">&nbsp;
					</td>
                  <td>&nbsp;</td>
                </tr>-->
                
                <?php
				}
				else
				{
				?>
				<!--<tr>
                   <td> <input type="radio" name="payopt" value="final_e_wallet" checked="checked" >
                    E-Wallet Amount(<?php echo round($row_wallet['amount'], 2);?>)
					</td>
                    <td width="39%" align="right">&nbsp;
					</td>
                  <td>&nbsp; </td>
                </tr>-->
				<?php
				}
				?>
                <tr valign="middle">
     <td colspan="2" align="left"><input type="radio" name="pay_mode" value="credit card" checked onClick="showpayment(this.value)">Credit or Debit Card</td>
     <td>&nbsp;</td>
     <td colspan="2" align="left"><input type="radio" name="pay_mode" value="final_e_wallet" onClick="showpayment(this.value)">E-Voucher<br>E-Wallet Amount(<?php echo round($row_wallet['amount'], 2);?>)</td>
    </tr>
                    
                  </table>
                 
                       <style>
.form_container ul li {
	background: url(../images/dot.png) repeat-x bottom;
position: relative;
padding: 5px 15px 15px 10px;
}
.show_vision_level
{
font-weight: bold;
color: #ffffff;
padding: 10px;border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
border-top: 1px solid #eee;
background: #555;
}
.odd
{
border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;background: #F8F9FC;
}
.even
{
border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;
}
.link-select
{
background-color: #666;
background-image: url(http://visionteamnetwork.com/wp-content/plugins/paid-memberships-pro/images/bg_grad-chrome.gif);
color: #FFF;
display: inline-block;
margin: 0;
background-position: top left;
background-repeat: repeat-x;
cursor: pointer;
border-radius: 4px;
-moz-border-radius: 4px;
padding: 5px 10px;
text-decoration: none;
text-shadow: 1px 1px 3px #000;
border: none;
font-family: Arial, Helvetica, sans-serif;
}
	 </style> 
                  <div id="show_card"  style="border-left: 1px solid #eee; border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;">
    <table width="98%" >
     <tr valign="middle">
     <th height="20" colspan="4" bgcolor="#009395" align="center" class="show_vision_level">Please enter your credit or debit card billing address if it’s different from the information below</th>
    </tr>
    <tr valign="middle">
     <td colspan="4" align="left">&nbsp;</td>
    </tr>
    
    <tr>
      <td>First Name<font color="#FF0000">*</font></td>
      <td><input type="text" name="x_first_name" id="x_first_name" style="width:50%" value="<?php echo $f['first_name'];?>" /></td>
      
      <td>Last Name<font color="#FF0000">*</font></td>
      <td><input type="text" name="x_last_name" id="x_last_name" value="<?php echo $f['last_name'];?>" /></td>
    </tr>
    
     <tr>
    <td>Address1<font color="#FF0000">*</font></td>
    <td><input type="text" name="x_address" id="x_address" style="width:50%"  value="<?php echo $f['address1'];?>"  /></td>
    
    <td>Address2</td>
    <td><input type="text" name="" id="" /></td>
    </tr>
    
    <tr>
    <td>City, State Zip<font color="#FF0000">*</font></td>
    <td><input type="text" name="x_city"  style="width:20%;" id="x_city"  value="<?php echo $f['city'];?>"  />
     <input type="text" name="x_state" id="x_state" style="width:15%;" value="<?php echo $f['state'];?>" />
     <input type="text" style="width:15%;" name="x_zip" id="x_zip"  value="<?php echo $f['zip'];?>" /></td>
     
    <td>Phone<font color="#FF0000">*</font></td>
    <td><input type="text" name="x_mobile" id="x_mobile"  value="<?php echo $f['mobile'];?>" /></td>
    </tr>
    
    <tr>
    <td>E-mail Address<font color="#FF0000">*</font></td>
    <td><input type="text" name="x_email" id="x_email" style="width:50%"  value="<?php echo $f['email'];?>" /></td>
   
    <td>Confirm E-mail</td>
    <td><input type="text" name="" id="c_x_email"  value="<?php echo $f['email'];?>" /></td>
    </tr>
    
     <tr valign="middle">
     <td colspan="4" align="left">&nbsp;</td>
    </tr>
    
    <tr valign="middle">
     <th height="40" colspan="5" bgcolor="#009395" align="center">Payment Information We Accept Visa, Mastercard, American Express, and Discover</th>
    </tr>
    
    <tr valign="middle">
     <td colspan="4" align="left">&nbsp;</td>
    </tr>
    
    
     <tr>
    <td colspan="2">Card Type</td>
    <td colspan="2"><select name="card_type" id="card_type" required>
    <option value="Visa">Visa</option>
<option value="Mastercard">Mastercard</option>
<option value="American Express">American Express</option>
<option value="Discover">Discover</option>
    </select></td>
    <!--<td rowspan="4" align="center"><img src="../img/secure90x72.gif.png" alt="" border="0" /></td>-->
           </tr>
      
       <tr>
    <td colspan="2">Card Number</td>
    <td colspan="2"><input type="text" name="card_no" id="card_no" onBlur="cardnumber(this,document.getElementById('card_type').value)" required /></td>
    </tr>
    
     <tr>
    <td colspan="2">Expiration Date</td>
    <td colspan="2">
    <select name="exp_month" id="exp_month" required>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select>
      
  <select name="exp_year" id="exp_year" required>
  	<?php
    $yy=date('Y');
	for($ii=$yy;$ii<2031;$ii++)
	{
	?>
    <option value="<?php echo $ii;?>"><?php echo $ii;?></option>
    <?php
    }
	?>
  </select>
    </td>
    </tr>
    <tr>
    <td colspan="2">CVV</td>
    <td colspan="2"><input type="text" name="cvv" style="width:20%;" id="cvv" required /> &nbsp; <a href="#">(what's this?)</a></td>
    </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    <td colspan="4" align="center"><a href="javascript:void(0);" onClick="shownext('pay_authorize_voucher.php');" class="link-select">Submit & Checkout</a></td>
    </tr>
   </table>
</div>
<div id="show_voucher"  style="border-left: 1px solid #eee; border-right: 1px solid #eee;
border-bottom: 1px solid #eee;background: #fff;color: #777; display:none">
<table width="100%">
    <tr>
        <td>&nbsp;</td>
        <td>Enter Transaction Pin:</td>
        <td><input type="password" name="tcode" id="tcode" autocomplete="off" onpaste="return false;" oncopy="return false;" oncut="return false;"></td>
    </tr>
    <tr>
        <td class="red"><?=$_GET['msg'] ?></td>
        <td><button type="button" class="btn_small btn_blue" name="submit1" onClick="validate11();">Update</button></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php
                        }
						else
						{
						echo "<p>You  are not authorize to access this section.</p>";
						}
						?>
</div>
            </div>
          </div>
        </form>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<span class="clear"></span> </div>
</div>
</body>
</html>