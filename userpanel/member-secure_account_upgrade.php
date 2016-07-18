<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_id=showuserid($_SESSION['SD_User_Name']);		
	$res_user=mysql_fetch_array(mysql_query("select * from registration where user_id='$user_id'"));
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
  
        <!-- The plugin stylehseet -->
        <link rel="stylesheet" href="vtncard/jquery.bubbleSlideshow/jquery.bubbleSlideshow.css" />
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
<script>
function showpayment(str)
{
	if(str=='credit card')
	{
		document.getElementById('show_card').style.display='block';
		document.getElementById('show_voucher').style.display='none';
	}
	else if(str=='voucher')
	{
		document.getElementById('show_card').style.display='none';
		document.getElementById('show_voucher').style.display='block';
	}
}
function shownext1(path)
{
	if(document.getElementById("checkbox1").checked!=true)
	{
		alert("You have not accept VTN Member Agreement.");
		return false;
	}
	if(document.getElementById('evoucher').value=='')
	{
		alert("Please Enter Valid Evoucher Code");
		return false;
	}
	var pin=document.getElementById("evoucher").value;
		post_to_url(path, {'pin':pin,'return_page':'member-secure.php'});
}
function shownext(path)
{
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


	if(document.getElementById("checkbox1").checked!=true)
	{
		alert("You have not accept VTN Member Agreement.");
		return false;
	}
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
	
		cardnumber(inputtxt,card_type);
		
post_to_url(path, {'x_first_name':x_first_name,'x_last_name':x_last_name,'exp_year':exp_year,'exp_month':exp_month,'card_type':card_type,'card_no':card_no,'cvv':cvv,'x_address':x_address,'x_city':x_city,'x_state':x_state,'x_zip':x_zip,'x_mobile':x_mobile,'x_email':x_email});
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
		<h3>Upgrade Payment Package</h3>
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
						<h6>Upgrade Payment Package</h6>
					</div>
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
					<div class="widget_content" style="background-color:#FFFFFF">
			
					  <form action="upgrade_one.php" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
								<li>
                                
                                <div class="entry-content">	
				
				<!--<h5 class="post-title cufon_headings">Upgrade Payment Package</h5>-->
			</div>
								<div class="norm_text">
                                <h4>Membership Secure Checkout</h4>
                    
<table width="100%" align="center" border="0">
  <tr valign="middle">
   <th height="20" colspan="5" bgcolor="#009395" align="center" class="show_vision_level">MEMBERSHIP LEVEL&nbsp;&nbsp;<a href="upgrade_account_level_one.php"><font size="2" color="#990000" style="float:right;">Change</font></a></th>
  </tr>
  <tr valign="middle">
   <td colspan="5" align="center" style="border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777; border-left: 1px solid #eee;"><p>You have selected the <strong>Vision Team Network Membership - <?php if($_SESSION['duration']==12){ echo "Yearly Membership Payment";} else if($_SESSION['duration']==1){ echo "Monthly Membership Payment";} else{ echo $_SESSION['duration']." month option Membership level";}?></strong> .</p>
<p>     

<?php if($_SESSION['duration']==1){?>
Membership initial registration fee of $29.99 By signing up for discount membership club with Vision Team Network Inc you will enjoy our discount prices that we have, we had partner with affiliated program and benefit membership club as well as our own products. When you become a member you will pay a fee of 29.99 each month for your discount membership club. that will allow you to enjoy your benefit discount club on every day purchases. access over 100,000 name brands at hundreds of your favorite retailers. You'll also find restaurants,gyms, Group on deals and thousands of other local offers too, as well as tickets to sporting events, concerts, theaters, movies and theme parks. a full range of membership services provided by the Vision Team Network; and a 24-hour customer service support. 
<?php
}
?>
<?php if($_SESSION['duration']==3){?>
Membership initial registration fee of $89.97 By signing up for discount membership club with Vision Team Network Inc you will enjoy our discount prices that we have, we had partner with affiliated program and benefit membership club as well as our own products. When you become a member you will pay a fee of 89.97 each 3 months for your discount membership club. that will allow you to enjoy your benefit discount club on every day purchases. access over 100,000 name brands at hundreds of your favorite retailers. You'll also find restaurants,gyms, Group on deals and thousands of other local offers too, as well as tickets to sporting events, concerts, theaters, movies and theme parks. a full range of membership services provided by the Vision Team Network; and a 24-hour customer service support.
<?php }?>
<?php if($_SESSION['duration']==6){?>
Membership initial registration fee of $179.94 By signing up for discount membership club with Vision Team Network Inc you will enjoy our discount prices that we have, we had partner with affiliated program and benefit membership club as well as our own products. When you become a member you will pay a fee of 179.94 every 3 months for your discount membership club. that will allow you to enjoy your benefit discount club on every day purchases. access over 100,000 name brands at hundreds of your favorite retailers. You'll also find restaurants,gyms, Group on deals and thousands of other local offers too, as well as tickets to sporting events, concerts, theaters, movies and theme parks. a full range of membership services provided by the Vision Team Network; and a 24-hour customer service support.
<?php }?>
<?php if($_SESSION['duration']==12){?>
Membership initial registration fee of $359.88 By signing up for discount membership club with Vision Team Network Inc you will enjoy our discount prices that we have, we had partner with affiliated program and benefit membership club as well as our own products. When you become a member you will pay a fee of 359.88 every 12 months for your discount membership club. that will allow you to enjoy your benefit discount club on every day purchases. access over 100,000 name brands at hundreds of your favorite retailers. You'll also find restaurants,gyms, Group on deals and thousands of other local offers too, as well as tickets to sporting events, concerts, theaters, movies and theme parks. a full range of membership services provided by the Vision Team Network; and a 24-hour customer service support.<?php }?>
</p>

<p style="margin-left:100px; margin-right:100px;"> 
<strong>
<?php if($_SESSION['duration']==1){?>The price for membership is $29.99 per Month for 12 more payments. Membership expires after 1 year.<?php }?>
<?php if($_SESSION['duration']==3){?>The price for membership is $89.97 now and then $89.97 every 3 Months for 3 more payments. Membership expires after 1 year.<?php }?>
<?php if($_SESSION['duration']==6){?>The price for membership is $179.94 now and then $179.94 every 6 Months for 1 more payments. Membership expires after 1 year.<?php }?>
<?php if($_SESSION['duration']==12){?>The price for membership is $359.88 now and then $359.88 every 12 Months. Membership expires after 1 year.<?php }?>
</strong>.  </p>
</td>
    </tr>
    
<tr valign="middle">
 <td colspan="5" align="center">
 <p>You are logged in as <strong><?php echo $_SESSION['SD_User_Name'];?></strong>. If you would like to use a different account for this membership, <a href="logout.php">log out now</a>.</p>
 <!--<p>You are logged in as <strong>admin</strong>. If you would like to use a different account for this membership, <a href="#">log out now</a>.</p>-->
 </td>
</tr>
<tr valign="middle">
 <th height="20" colspan="5" bgcolor="#009395" align="center" class="show_vision_level">TERMS & CONDITIONS</th>
</tr>
    
    <tr>
    <td colspan="5" style="border-left: 1px solid #eee; border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;"><div style="padding: 0px 10px 0px 20px; width: 97%; overflow:scroll; height:280px; top: -12382px;">
<?php
	$category="level".$_SESSION[category];
	$sql="select * from term_and_condition where category='$category' and month='$_SESSION[duration]'";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	echo $row['description'];
?>
    <!--<p><strong>INDEPENDENT ASSOCIATE TERMS & CONDITIONS</strong></p>
    <p>
These terms and conditions govern your use of this website; by using this website, you accept these terms and conditions in full.  If you disagree with these terms and conditions or any part of these terms and conditions, you must not use this website. You must be at least 18 years of age to use this website.  By using this website and by agreeing to these terms and conditions you warrant and represent that you are at least 18 years of age.
<br>
<br>
1. I understand that this Application is subject to acceptance by VTN. Upon acceptance by VTN, this Application, together with the VTN Policies and Procedures and VTN Marketing Compensation Plan, as may be amended from time to time, shall constitute the entire agreement (the "Agreement") between VTN and me. I acknowledge that all of my rights and responsibilities as an VTN Independent Associate ("IA") are governed by these Terms and Conditions, the VTN Policies and Procedures and VTN Marketing Compensation Plan.
<br><br>
2. I certify that I have received and carefully reviewed the VTN Policies and Procedures and VTN Marketing Compensation Plan. I agree to be bound by any changes to these Terms and Conditions, the VTN Policies and Procedures and VTN Marketing Compensation Plan that VTN, in its sole discretion, may announce from time to time. Notification of amendments shall be posted on the VTN website and become effective 30 days after publication ("Effective Date"). The continuation of my VTN business or my acceptance of bonuses or commissions after the Effective Date shall constitute my acceptance of any and all amendments.
<br><br>
3. I understand that I have the right to terminate this Agreement at any time by submitting a written notice of cancellation to VTN at its address of record. I further understand that this Agreement must be renewed annually. I further understand that I must be in good standing and not in violation of any of the terms of the Agreement to be eligible to receive remuneration from VTN. I acknowledge that VTN may terminate this Agreement or impose disciplinary action, including the forfeiture of compensation and bonuses in the event of any breach, default or violation by me of the Agreement. In the event of any termination or non-renewal of the Agreement, I understand and agree that I will permanently lose all rights as an VTN Independent Associate including the right to receive remuneration from VTN based upon the activities of myself and any VTN Independent Associates enrolled down-line from me.
<br><br>
4. I agree that as an VTN Independent Associate I am an independent contractor and not an employee, agent, partner or franchisee of VTN. I alone am responsible for my business and for paying all expenses I incur in the operation of my VTN business including but not limited to taxes, travel, food, lodging and office supplies. I UNDERSTAND THAT I SHALL NOT BE TREATED AS AN EMPLOYEE FOR FEDERAL OR STATE TAX PURPOSES. I further understand that I am not an agent of VTN for any purpose and I will not do any act that would cause anyone to believe otherwise.
<br><br>
5. I understand that VTN Independent Associates are eligible to earn compensation from VTN based upon the mere act of recruiting or sponsoring other Independent Associates. I certify that neither VTN nor my sponsor has made any claims of guaranteed profits as a result of my efforts as an VTN Independent Associate.
<br><br>
6. I understand that there are no exclusive territories granted to any VTN IAs and I am not hereby acquiring any interest in a security or property right. I acknowledge that the only rights granted by this Agreement are the intangible right to enroll other Independent Associates and participate in VTN Marketing Compensation Plan.
<br><br>
7. I understand that this Agreement is non-transferable except as expressly set forth in the Policies and Procedures. Any attempt to transfer or assign this Agreement without the express written consent of VTN renders this Agreement null and void at the option of VTN and may result in termination of this Agreement.
<br><br>
8. As part of the consideration exchanged for the opportunity to become an IA, I expressly waive and disclaim any right to bring any claim in any and all forums as a class action or as a private Attorney General. I further agree to not serve as a class representative or a member of a class in litigation adverse to VTN. If the dispute pertains to a matter which is generally administered by certain VTN policies or procedures, the procedures set forth in that procedure must be fully exhausted by me before I may invoke my right to arbitration under this Agreement.
<br><br>
9. This Agreement (including the VTN Policies and Procedures and VTN Marketing Compensation Plan) as modified from time to time constitutes the entire agreement between the parties and supersedes all prior or existing oral or written agreements between the parties. Any promises, representations, guarantees, offers or other communications not expressly set forth in this Agreement are of no force or effect.
<br><br>
10. IN THE EVENT OF A DISPUTE BETWEEN ME AND VTN OR ITS PARENTS, SUBSIDIARIES OR AFFILIATED COMPANIES, INCLUDING A DISPUTE ARISING OUT OF OR RELATING TO THIS AGREEMENT, THE PARTIES AGREE THAT SUCH DISPUTES, FOLLOWING EXHAUSTION OF INTERNAL VTN DISPUTE PROCEDURES, SHALL BE EXCLUSIVELY RESOLVED BY BINDING ARBITRATION IN DALLAS COUNTY, PA PURSUANT TO THE COMMERCIAL RULES OF THE AMERICAN ARBITRATION ASSOCATION, WITH EACH PARTY BEARING ITS OWN COSTS. The parties further agree that this Agreement shall be governed by and construed in accordance with the laws of PA without regard to conflicts of law principles. This provision shall not restrict VTN from seeking preliminary or permanent injunctive relief in a court of competent jurisdiction.  Cheltenham Residents: notwithstanding the foregoing, Cheltenham residents may bring an action against VTN  with jurisdiction and venue as provided by Cheltenham Township law.
<br><br>
11. Subject to the requirements of paragraph 10 herein, the parties consent to exclusive jurisdiction and venue before any court in Melrose Park, PA for the limited purposes of enforcing an arbitration award, pursuing an action for equitable relief, or litigating a matter not subject to arbitration pursuant to this Agreement. The prevailing party in any such action shall be entitled to recover its reasonable attorney's fees and costs.
<br><br>
NOTICE OF RIGHT TO CANCEL
<br><br>
You may CANCEL this transaction, without any penalty or obligation, within THREE BUSINESS DAYS from the above If you cancel, any payments made by you under the contract of Membership, and any negotiable instrument executed by you will be returned within TEN BUSINESS DAYS following receipt by VTN  of your cancellation notice. To cancel this transaction, mail or deliver a signed and dated copy of this Cancellation Notice or any other written notice, or send a fax to Vision Team Network, Inc. 1135 West Cheltenham ave, Suite 6, Melrose Park, Suite 6.  PA  19027
<br><br>
Office Number is 1800-991-3153 ext 1135 Fax Number is 1-888-742-3770
<br><br>
NOT LATER THAN MIDNIGHT of the third business day following the date set forth above
</p>-->
       
    </div></td>
    </tr>
    
    
    <tr valign="middle">
     <td colspan="5" align="left">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="5" align="center" style="border-left: 1px solid #eee; border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777;">
       <input type="checkbox" id="checkbox1" name="checkbox1" required />&nbsp;&nbsp; <label for="tos">I agree to the TERMS &amp; CONDITIONS</label>
      </td>
    </tr>
    
    <tr valign="middle">
     <td colspan="5" align="left">&nbsp;</td>
    </tr>
    
    <tr valign="middle">
     <td colspan="2" align="left"><input type="radio" name="pay_mode" value="credit card" checked onClick="showpayment(this.value)">Credit or Debit Card</td>
     <td>&nbsp;</td>
     <td colspan="2" align="left"><input type="radio" name="pay_mode" value="voucher" onClick="showpayment(this.value)">E-Voucher</td>
    </tr>
    
    </table>
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
      <td>First Name</td>
      <td><input type="text" name="x_first_name" id="x_first_name" style="width:50%" /></td>
      
      <td>Last Name</td>
      <td><input type="text" name="x_last_name" id="x_last_name" /></td>
    </tr>
    
     <tr>
    <td>Address1</td>
    <td><input type="text" name="x_address" id="x_address" style="width:50%" /></td>
    
    <td>Address2</td>
    <td><input type="text" name="" id="" /></td>
    </tr>
    
    <tr>
    <td>City, State Zip </td>
    <td><input type="text" name="x_city"  style="width:20%;" id="x_city" /> <input type="text" name="x_state" id="x_state" style="width:14%;" />
     <input type="text" style="width:14%;" name="x_zip" id="x_zip" /></td>
     
    <td>Phone</td>
    <td><input type="text" name="x_mobile" id="x_mobile" /></td>
    </tr>
    
    <tr>
    <td>E-mail Address</td>
    <td><input type="text" name="x_email" id="x_email" style="width:50%" /></td>
   
    <td>Confirm E-mail</td>
    <td><input type="text" name="" id="" /></td>
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
    <td colspan="4" align="center"><a href="javascript:void(0);" onClick="shownext('pay_authorize_upgrade_account.php');" class="link-select">Submit & Checkout</a></td>
    </tr>
   </table>
   </div>
   <div id="show_voucher"  style="border-left: 1px solid #eee; border-right: 1px solid #eee;
border-bottom: 1px solid #eee;
background: #fff;
color: #777; display:none">
    <table width="100%">
     <tr valign="middle">
     <th height="20" colspan="4" bgcolor="#009395" align="center" class="show_vision_level">Enter Evoucher Code</th>
    </tr>
    <tr valign="middle">
     <td colspan="4" align="left">&nbsp;</td>
    </tr>
    
    <tr>
      <td valign="top" colspan="2" align="left"><span>E-Voucher Code</span></td>
     <td class="in" colspan="2" align="left"><input type="text" placeholder="E-voucher Code" class="int" name="evoucher" id="evoucher" style="width:50%"></td>
    </tr>
    <tr valign="middle">
     <td colspan="4" align="left">&nbsp;</td>
    </tr>
    <tr>
    <td colspan="4" align="center"><a href="javascript:void(0);" onClick="shownext1('check_evoucher_code.php?return_page=member-secure_account_upgrade.php');" class="link-select">Submit & Checkout</a></td>
    </tr>
    </table>
  </div>
  		</div>
		</li>
  </ul>
</form>
            </div>
        </div>
    </div>
</div>
		<span class="clear"></span>
  </div>
</div>
</body>
</html>

