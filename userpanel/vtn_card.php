<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	 $sql_welcome=mysql_fetch_array(mysql_query("SELECT * FROM static_page order by id desc limit 0,1"));	
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_name='{$_SESSION['SD_User_Name']}'"));
	 $user_id=$res_user['user_id'];
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
<style>
table td span{
	margin-right:10px;}
.inputs{ background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;
	border-radius: 4px;
    color: #555555;
    display: inline-block;
    font-size: 12px;
    height: 18px;
    line-height: 18px;
    margin-bottom: 9px;
    padding: 4px 6px;
	}
.select {
	background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    width: 145px;
	height: 28px;
    line-height: 28px;
	border-radius: 4px;
    color: #555555;
    display: inline-block;
    font-size: 12px;
	margin-bottom: 9px;
    padding: 4px 6px;
    }
.select1 {
	background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    width: 70px;
	height: 28px;
    line-height: 28px;
	border-radius: 4px;
    color: #555555;
    display: inline-block;
    font-size: 12px;
	margin-bottom: 9px;
    padding: 4px 6px;
    }
.reg-btn {
	background: none repeat scroll 0 0 #0DCCD7;
    border: medium none;
    border-radius: 4px;
    box-shadow: none;
    color: #FFFFFF;
    display: inline-block;
    font: 16px 'Roboto',Roboto,Arial,Helvetica,sans-serif;
    letter-spacing: 0;
    padding: 7px 26px 11px 25px;
    position: relative;
    text-decoration: none !important;
    text-shadow: none;
    text-transform: none;
    transition: all 0.25s ease 0s;}
</style>
<script>
function showmailing()
{
	if(document.getElementById('checkbox1').checked==true)
	{
		document.getElementById('mailing_address').value=document.getElementById('address').value;
		document.getElementById('mailing_pobox_no').value=document.getElementById('pobox_no').value;
		document.getElementById('mailing_city').value=document.getElementById('city').value;
		//alert(document.getElementById('zip').value);
		document.getElementById('mailing_zip1').value=document.getElementById('zip').value;
	}
	else
	{
		document.getElementById('mailing_address').value='';
		document.getElementById('mailing_pobox_no').value='';
		document.getElementById('mailing_city').value='';
		document.getElementById('mailing_zip1').value='';
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
		<h3>VTN Card</h3>
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
<p style="margin: 0 0 0.5em 0;">
Thank you for becoming a part of Vision Team Network family our Company will pay each associate Members their Monthly Residual Income every 15th of the month and if you gain your one time $50.00 bonus before the 30 days you will receive your $50.00 bonus payment within two week.
</p>

<p style="margin: 0 0 0.5em 0;">
Each individual associate member are responsible for their taxes in the end of the year because each associate member are subject to 1099. 
</p>

<p style="margin: 0 0 0.5em 0;">
Vision Team Network,Inc will be issuing a pay-roll card for every member your payment will be direct deposit in to your pay-roll card once you receive your pay-roll card please call the toll free number on the application form or behind the Debit Card to activate your pay-roll card.
<p>

<p style="margin: 0 0 0.5em 0;">
Note: all information will be verifier if you submit false Information to our company your membership will be terminated and you will loose all your benefits and we'll report you to local federal agency and prosecute you.
</p>
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>VTN Card</h6>
					</div>
					<div class="widget_content">
                    <?php
                    $sql="select * from vtn_card where user_id='$user_id'";
					$res=mysql_query($sql);
					$count=mysql_num_rows($res);
					if($count)
					{
					echo "<p>You Have Filled The Card Information.</p>";
					}
					else{
					
					$sql_user="select * from registration where user_id='$user_id'";
					$res_user=mysql_query($sql_user);
					$row_user=mysql_fetch_assoc($res_user);
					?>
<form name="vtn_card_registration" action="vtn_card_before.php" method="post">
<table width="100%">
     
      <tr bgcolor="#0099FF">
     <th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Register New Cardholder </th>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
     <td width="20%" height="30" align="right" valign="top"><span>10-digit Card ID</span></td>
     <td width="30%" height="30" ><input class="inputs" type="text" placeholder="" name="" id="">&nbsp;&nbsp;Office Use Only</td>
     <td width="20%" height="30" align="right" valign="top" class="txt"><span>Customer ID</span></td>
     <td width="30%" height="30"><input class="inputs" type="text" placeholder="" name="" id="">&nbsp;&nbsp;Office Use Only</td>
     </tr>
     
     <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr bgcolor="#0099FF">
     <th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Cardholder Information</th>
     </tr>
     
     <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>Title</span></td>
     <td height="30"><select class="select1" name="title" required>
     					<option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option>
                        <option value="Dr">Dr</option>
                       </select></td>
     <td height="30" align="right" valign="top"><span>First Name                                 </span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="fname" id="fname" value="<?php echo $row_user['first_name'];?>" required></td>
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>Middle Name/Initial</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="mname" id="mname" value="<?php echo $row_user['middle_name'];?>"></td>
     <td height="30" align="right" valign="top"><span>Last Name</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="lname" id="lname" value="<?php echo $row_user['last_name'];?>" required></td>
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>&nbsp;</span></td>
     <td height="30" colspan="3"><input type="checkbox" name="check" id="checkbox1" onClick="showmailing();">&nbsp;Check here if mailing address and physical address are the same</td>
     
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>Physical Address </span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="address" id="address" value="<?php echo $row_user['address1'];?>"></td>
     <td height="30" align="right" valign="top"><span>Mailing Address</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="mailing_address" id="mailing_address" value="<?php echo $row_user['address1'];?>"></td>
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>P.O. Box is not allowed as the physical address</span></td>
     <td height="30" valign="top"><input class="inputs" type="text" placeholder="" name="pobox_no" id="pobox_no"></td>
     <td height="30" align="right" valign="top"><span>&nbsp;</span></td>
     <td height="30" valign="top"><input class="inputs" type="text" placeholder="" name="mailing_pobox_no" id="mailing_pobox_no"></td>
     </tr>
     
      <tr>
     <td height="30" align="right" valign="top"><span>City</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="city" id="city" value="<?php echo $row_user['city'];?>"></td>
     <td height="30" align="right" valign="top"><span>City</span></td>
     <td height="30">
     <input class="inputs" type="text" placeholder="" name="mailing_city" id="mailing_city" value="<?php echo $row_user['city'];?>">
     </td>
     </tr>
     
     
      <tr>
     <td height="30" align="right" valign="top"><span>Country</span></td>
     <td height="30"><select name="country" id="country" class="select">
								<option value="<?=$row_user['country'];?>"><?=$row_user['country'];?></option>
								  <option value="Afghanistan">Afghanistan</option>
								  <option value="Albania">Albania</option>
								  <option value="Algeria">Algeria</option>
								  <option value="American Samoa">American Samoa</option>
								  <option value="Andorra">Andorra</option>
								  <option value="Angola">Angola</option>
								  <option value="Anguilla">Anguilla</option>
								  <option value="Antarctica">Antarctica</option>
								  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
								  <option value="Argentina">Argentina</option>
								  <option value="Armenia">Armenia</option>
								  <option value="Aruba">Aruba</option>
								  <option value="Australia">Australia</option>
								  <option value="Austria">Austria</option>
								  <option value="Azerbaijan">Azerbaijan</option>
								  <option value="Bahamas">Bahamas</option>
								  <option value="Bahrain">Bahrain</option>
								  <option value="Bangladesh">Bangladesh</option>
								  <option value="Barbados">Barbados</option>
								  <option value="Belarus">Belarus</option>
								  <option value="Belgium">Belgium</option>
								  <option value="Belize">Belize</option>
								  <option value="Benin">Benin</option>
								  <option value="Bermuda">Bermuda</option>
								  <option value="Bhutan">Bhutan</option>
								  <option value="Bolivia">Bolivia</option>
								  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								  <option value="Botswana">Botswana</option>
								  <option value="Bouvet Island">Bouvet Island</option>
								  <option value="Brazil">Brazil</option>
								  <option value="British Ind. Ocean Terr.">British Ind Ocean Terr.</option>
								  <option value="Brunei Darussalam">Brunei Darussalam</option>
								  <option value="Bulgaria">Bulgaria</option>
								  <option value="Burkina Faso">Burkina Faso</option>
								  <option value="Burundi">Burundi</option>
								  <option value="Cambodia">Cambodia</option>
								  <option value="Cameroon">Cameroon</option>
								  <option value="Canada">Canada</option>
								  <option value="Cape Verde">Cape Verde</option>
								  <option value="Cayman Islands">Cayman Islands</option>
								  <option value="Central African Rep.">Central African Rep.</option>
								  <option value="Chad">Chad</option>
								  <option value="Chile">Chile</option>
								  <option value="China">China</option>
								  <option value="Christmas Island">Christmas Island</option>
								  <option value="Cocos Keeling">Cocos Keeling</option>
								  <option value="Colombia">Colombia</option>
								  <option value="Comoros">Comoros</option>
								  <option value="Congo">Congo</option>
								  <option value="Cook Islands">Cook Islands</option>
								  <option value="Costa Rica">Costa Rica</option>
								  <option value="country.PS">country PS</option>
								  <option value="Croatia">Croatia</option>
								  <option value="Cuba">Cuba</option>
								  <option value="Cyprus">Cyprus</option>
								  <option value="Czech Republic">Czech Republic</option>
								  <option value="Cote d Ivoire">Cote d Ivoire</option>
								  <option value="Denmark">Denmark</option>
								  <option value="Djibouti">Djibouti</option>
								  <option value="Dominica">Dominica</option>
								  <option value="Dominican Republic">Dominican Republic</option>
								  <option value="East Timor">East Timor</option>
								  <option value="Ecuador">Ecuador</option>
								  <option value="Egypt">Egypt</option>
								  <option value="El salvador">El salvador</option>
								  <option value="Equatorial Guinea">Equatorial Guinea</option>
								  <option value="Eritrea">Eritrea</option>
								  <option value="Estonia">Estonia</option>
								  <option value="Ethiopia">Ethiopia</option>
								  <option value="Falkland Islands">Falkland Islands</option>
								  <option value="Faroe Islands">Faroe Islands</option>
								  <option value="Fiji">Fiji</option>
								  <option value="Finland">Finland</option>
								  <option value="France">France</option>
								  <option value="French Guiana">French Guiana</option>
								  <option value="French Polynesia">French Polynesia</option>
								  <option value="French Sthern Terr.">French Southern Terr</option>
								  <option value="Gabon">Gabon</option>
								  <option value="Gambia">Gambia</option>
								  <option value="Georgia">Georgia</option>
								  <option value="Germany">Germany</option>
								  <option value="Ghana">Ghana</option>
								  <option value="Gibraltar">Gibraltar</option>
								  <option value="Greece">Greece</option>
								  <option value="Greenland">Greenland</option>
								  <option value="Grenada">Grenada</option>
								  <option value="Guadeloupe">Guadeloupe</option>
								  <option value="Guam">Guam</option>
								  <option value="Guatemala">Guatemala</option>
								  <option value="Guinea">Guinea</option>
								  <option value="Guinea Bissau">Guinea Bissau</option>
								  <option value="Guyana">Guyana</option>
								  <option value="Haiti">Haiti</option>
								  <option value="Heard Is McDonald Is">Heard Is McDonald Is</option>
								  <option value="Honduras">Honduras</option>
								  <option value="Hong Kong">Hong Kong</option>
								  <option value="Hungary">Hungary</option>
								  <option value="Iceland">Iceland</option>
								  <option value="India">India</option>
								  <option value="Indonesia">Indonesia</option>
								  <option value="Ireland">Ireland</option>
								  <option value="Israel">Israel</option>
								  <option value="Italy">Italy</option>
								  <option value="Jamaica">Jamaica</option>
								  <option value="Japan">Japan</option>
								  <option value="Jordan">Jordan</option>
								  <option value="Kazakstan">Kazakstan</option>
								  <option value="Kenya">Kenya</option>
								  <option value="Kiribati">Kiribati</option>
								  <option value="Kuwait">Kuwait</option>
								  <option value="Kyrgystan">Kyrgystan</option>
								  <option value="Lao">Lao</option>
								  <option value="Latvia">Latvia</option>
								  <option value="Lebanon">Lebanon</option>
								  <option value="Lesotho">Lesotho</option>
								  <option value="Liberia">Liberia</option>
								  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								  <option value="Liechtenstein">Liechtenstein</option>
								  <option value="Lithuania">Lithuania</option>
								  <option value="Luxembourg">Luxembourg</option>
								  <option value="Macau">Macau</option>
								  <option value="Macedonia: FYR">Macedonia FYR</option>
								  <option value="Madagascar">Madagascar</option>
								  <option value="Malawi">Malawi</option>
								  <option value="Malaysia">Malaysia</option>
								  <option value="Maldives">Maldives</option>
								  <option value="Mali">Mali</option>
								  <option value="Malta">Malta</option>
								  <option value="Marshall Islands">Marshall Islands</option>
								  <option value="Martinique">Martinique</option>
								  <option value="Mauritania">Mauritania</option>
								  <option value="Mauritius">Mauritius</option>
								  <option value="Mayotte">Mayotte</option>
								  <option value="Mexico">Mexico</option>
								  <option value="Micronesia">Micronesia</option>
								  <option value="Moldova">Moldova</option>
								  <option value="Monaco">Monaco</option>
								  <option value="Mongolia">Mongolia</option>
								  <option value="Montserrat">Montserrat</option>
								  <option value="Morocco">Morocco</option>
								  <option value="Mozambique">Mozambique</option>
								  <option value="Myanmar">Myanmar</option>
								  <option value="Namibia">Namibia</option>
								  <option value="Nauru">Nauru</option>
								  <option value="Nepal">Nepal</option>
								  <option value="Netherlands">Netherlands</option>
								  <option value="Netherlands Antilles">Netherlands Antilles</option>
								  <option value="New Caledonia">New Caledonia</option>
								  <option value="New Zealand">New Zealand</option>
								  <option value="Nicaragua">Nicaragua</option>
								  <option value="Niger">Niger</option>
								  <option value="Nigeria">Nigeria</option>
								  <option value="Niue">Niue</option>
								  <option value="Norfolk Island">Norfolk Island</option>
								  <option value="North Korea">North Korea</option>
								  <option value="Northern Mariana Is.">Northern Mariana Is</option>
								  <option value="Norway">Norway</option>
								  <option value="Oman">Oman</option>
								  <option value="Pakistan">Pakistan</option>
								  <option value="Palau">Palau</option>
								  <option value="Panama">Panama</option>
								  <option value="Papua New Guinea">Papua New Guinea</option>
								  <option value="Paraguay">Paraguay</option>
								  <option value="Peru">Peru</option>
								  <option value="Philippines">Philippines</option>
								  <option value="Pitcairn">Pitcairn</option>
								  <option value="Poland">Poland</option>
								  <option value="Portugal">Portugal</option>
								  <option value="Puerto Rico">Puerto Rico</option>
								  <option value="Qatar">Qatar</option>
								  <option value="Reunion">Reunion</option>
								  <option value="Romania">Romania</option>
								  <option value="Russian Federation">Russian Federation</option>
								  <option value="Rwanda">Rwanda</option>
								  <option value="Samoa">Samoa</option>
								  <option value="San Marino">San Marino</option>
								  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
								  <option value="Saudi Arabia">Saudi Arabia</option>
								  <option value="Senegal">Senegal</option>
								  <option value="Seychelles">Seychelles</option>
								  <option value="Sierra Leone">Sierra Leone</option>
								  <option value="Singapore">Singapore</option>
								  <option value="Slovakia">Slovakia</option>
								  <option value="Slovenia">Slovenia</option>
								  <option value="Solomon Islands">Solomon Islands</option>
								  <option value="Somalia">Somalia</option>
								  <option value="South Africa">South Africa</option>
								  <option value="South Georgia">South Georgia</option>
								  <option value="South Korea">South Korea</option>
								  <option value="Spain">Spain</option>
								  <option value="Sri Lanka">Sri Lanka</option>
								  <option value="St Helena">St Helena</option>
								  <option value="St Kitts+Nevis">St Kitts Nevis</option>
								  <option value="St Lucia">St Lucia</option>
								  <option value="St Pierre Miquelon">St Pierre Miquelon</option>
								  <option value="St Vincent+Grenadines">St Vincent Grenadines</option>
								  <option value="Sudan">Sudan</option>
								  <option value="Suriname">Suriname</option>
								  <option value="Svalbard Jan Mayen Is">Svalbard Jan Mayen Is</option>
								  <option value="Swaziland">Swaziland</option>
								  <option value="Sweden">Sweden</option>
								  <option value="Switzerland">Switzerland</option>
								  <option value="Syria">Syria</option>
								  <option value="Taiwan">Taiwan</option>
								  <option value="Tajikistan">Tajikistan</option>
								  <option value="Tanzania">Tanzania</option>
								  <option value="Thailand">Thailand</option>
								  <option value="Togo">Togo</option>
								  <option value="Tokelau">Tokelau</option>
								  <option value="Tonga">Tonga</option>
								  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
								  <option value="Tunisia">Tunisia</option>
								  <option value="Turkey">Turkey</option>
								  <option value="Turkmenistan">Turkmenistan</option>
								  <option value="Turks and Caicos Is">Turks and Caicos Is</option>
								  <option value="Tuvalu">Tuvalu</option>
								  <option value="Uganda">Uganda</option>
								  <option value="Ukraine">Ukraine</option>
								  <option value="United Arab Emirates">United Arab Emirates</option>
								  <option value="United Kingdom">United Kingdom</option>
								  <option value="Uruguay">Uruguay</option>
								  <option value="US Minor Outlying Is">US Minor Outlying Is</option>
								  <option value="USA" selected>USA</option>
								  <option value="Uzbekistan">Uzbekistan</option>
								  <option value="Vanuatu">Vanuatu</option>
								  <option value="Vatican City State">Vatican City State</option>
								  <option value="Venezuela">Venezuela</option>
								  <option value="Viet Nam">Viet Nam</option>
								  <option value="Virgin Is British">Virgin Is British</option>
								  <option value="Virgin Is US">Virgin Is US</option>
								  <option value="Wallis and Futuna Is">Wallis and Futuna Is</option>
								  <option value="Western Sahara">Western Sahara</option>
								  <option value="Yemen">Yemen</option>
								  <option value="Yugoslavia">Yugoslavia</option>
								  <option value="Zaire">Zaire</option>
								  <option value="Zambia">Zambia</option>
								  <option value="Zimbabwe">Zimbabwe</option>
            				</select></td>
     <td height="30" align="right" valign="top"><span>Country</span></td>
     <td height="30"><select name="mailing_country" id="mailing_country" class="select">
								<option value="<?=$rowuser['country'];?>"><?=$rowuser['country'];?></option>
								  <option value="Afghanistan">Afghanistan</option>
								  <option value="Albania">Albania</option>
								  <option value="Algeria">Algeria</option>
								  <option value="American Samoa">American Samoa</option>
								  <option value="Andorra">Andorra</option>
								  <option value="Angola">Angola</option>
								  <option value="Anguilla">Anguilla</option>
								  <option value="Antarctica">Antarctica</option>
								  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
								  <option value="Argentina">Argentina</option>
								  <option value="Armenia">Armenia</option>
								  <option value="Aruba">Aruba</option>
								  <option value="Australia">Australia</option>
								  <option value="Austria">Austria</option>
								  <option value="Azerbaijan">Azerbaijan</option>
								  <option value="Bahamas">Bahamas</option>
								  <option value="Bahrain">Bahrain</option>
								  <option value="Bangladesh">Bangladesh</option>
								  <option value="Barbados">Barbados</option>
								  <option value="Belarus">Belarus</option>
								  <option value="Belgium">Belgium</option>
								  <option value="Belize">Belize</option>
								  <option value="Benin">Benin</option>
								  <option value="Bermuda">Bermuda</option>
								  <option value="Bhutan">Bhutan</option>
								  <option value="Bolivia">Bolivia</option>
								  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								  <option value="Botswana">Botswana</option>
								  <option value="Bouvet Island">Bouvet Island</option>
								  <option value="Brazil">Brazil</option>
								  <option value="British Ind. Ocean Terr.">British Ind Ocean Terr.</option>
								  <option value="Brunei Darussalam">Brunei Darussalam</option>
								  <option value="Bulgaria">Bulgaria</option>
								  <option value="Burkina Faso">Burkina Faso</option>
								  <option value="Burundi">Burundi</option>
								  <option value="Cambodia">Cambodia</option>
								  <option value="Cameroon">Cameroon</option>
								  <option value="Canada">Canada</option>
								  <option value="Cape Verde">Cape Verde</option>
								  <option value="Cayman Islands">Cayman Islands</option>
								  <option value="Central African Rep.">Central African Rep.</option>
								  <option value="Chad">Chad</option>
								  <option value="Chile">Chile</option>
								  <option value="China">China</option>
								  <option value="Christmas Island">Christmas Island</option>
								  <option value="Cocos Keeling">Cocos Keeling</option>
								  <option value="Colombia">Colombia</option>
								  <option value="Comoros">Comoros</option>
								  <option value="Congo">Congo</option>
								  <option value="Cook Islands">Cook Islands</option>
								  <option value="Costa Rica">Costa Rica</option>
								  <option value="country.PS">country PS</option>
								  <option value="Croatia">Croatia</option>
								  <option value="Cuba">Cuba</option>
								  <option value="Cyprus">Cyprus</option>
								  <option value="Czech Republic">Czech Republic</option>
								  <option value="Cote d Ivoire">Cote d Ivoire</option>
								  <option value="Denmark">Denmark</option>
								  <option value="Djibouti">Djibouti</option>
								  <option value="Dominica">Dominica</option>
								  <option value="Dominican Republic">Dominican Republic</option>
								  <option value="East Timor">East Timor</option>
								  <option value="Ecuador">Ecuador</option>
								  <option value="Egypt">Egypt</option>
								  <option value="El salvador">El salvador</option>
								  <option value="Equatorial Guinea">Equatorial Guinea</option>
								  <option value="Eritrea">Eritrea</option>
								  <option value="Estonia">Estonia</option>
								  <option value="Ethiopia">Ethiopia</option>
								  <option value="Falkland Islands">Falkland Islands</option>
								  <option value="Faroe Islands">Faroe Islands</option>
								  <option value="Fiji">Fiji</option>
								  <option value="Finland">Finland</option>
								  <option value="France">France</option>
								  <option value="French Guiana">French Guiana</option>
								  <option value="French Polynesia">French Polynesia</option>
								  <option value="French Sthern Terr.">French Southern Terr</option>
								  <option value="Gabon">Gabon</option>
								  <option value="Gambia">Gambia</option>
								  <option value="Georgia">Georgia</option>
								  <option value="Germany">Germany</option>
								  <option value="Ghana">Ghana</option>
								  <option value="Gibraltar">Gibraltar</option>
								  <option value="Greece">Greece</option>
								  <option value="Greenland">Greenland</option>
								  <option value="Grenada">Grenada</option>
								  <option value="Guadeloupe">Guadeloupe</option>
								  <option value="Guam">Guam</option>
								  <option value="Guatemala">Guatemala</option>
								  <option value="Guinea">Guinea</option>
								  <option value="Guinea Bissau">Guinea Bissau</option>
								  <option value="Guyana">Guyana</option>
								  <option value="Haiti">Haiti</option>
								  <option value="Heard Is McDonald Is">Heard Is McDonald Is</option>
								  <option value="Honduras">Honduras</option>
								  <option value="Hong Kong">Hong Kong</option>
								  <option value="Hungary">Hungary</option>
								  <option value="Iceland">Iceland</option>
								  <option value="India">India</option>
								  <option value="Indonesia">Indonesia</option>
								  <option value="Ireland">Ireland</option>
								  <option value="Israel">Israel</option>
								  <option value="Italy">Italy</option>
								  <option value="Jamaica">Jamaica</option>
								  <option value="Japan">Japan</option>
								  <option value="Jordan">Jordan</option>
								  <option value="Kazakstan">Kazakstan</option>
								  <option value="Kenya">Kenya</option>
								  <option value="Kiribati">Kiribati</option>
								  <option value="Kuwait">Kuwait</option>
								  <option value="Kyrgystan">Kyrgystan</option>
								  <option value="Lao">Lao</option>
								  <option value="Latvia">Latvia</option>
								  <option value="Lebanon">Lebanon</option>
								  <option value="Lesotho">Lesotho</option>
								  <option value="Liberia">Liberia</option>
								  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								  <option value="Liechtenstein">Liechtenstein</option>
								  <option value="Lithuania">Lithuania</option>
								  <option value="Luxembourg">Luxembourg</option>
								  <option value="Macau">Macau</option>
								  <option value="Macedonia: FYR">Macedonia FYR</option>
								  <option value="Madagascar">Madagascar</option>
								  <option value="Malawi">Malawi</option>
								  <option value="Malaysia">Malaysia</option>
								  <option value="Maldives">Maldives</option>
								  <option value="Mali">Mali</option>
								  <option value="Malta">Malta</option>
								  <option value="Marshall Islands">Marshall Islands</option>
								  <option value="Martinique">Martinique</option>
								  <option value="Mauritania">Mauritania</option>
								  <option value="Mauritius">Mauritius</option>
								  <option value="Mayotte">Mayotte</option>
								  <option value="Mexico">Mexico</option>
								  <option value="Micronesia">Micronesia</option>
								  <option value="Moldova">Moldova</option>
								  <option value="Monaco">Monaco</option>
								  <option value="Mongolia">Mongolia</option>
								  <option value="Montserrat">Montserrat</option>
								  <option value="Morocco">Morocco</option>
								  <option value="Mozambique">Mozambique</option>
								  <option value="Myanmar">Myanmar</option>
								  <option value="Namibia">Namibia</option>
								  <option value="Nauru">Nauru</option>
								  <option value="Nepal">Nepal</option>
								  <option value="Netherlands">Netherlands</option>
								  <option value="Netherlands Antilles">Netherlands Antilles</option>
								  <option value="New Caledonia">New Caledonia</option>
								  <option value="New Zealand">New Zealand</option>
								  <option value="Nicaragua">Nicaragua</option>
								  <option value="Niger">Niger</option>
								  <option value="Nigeria">Nigeria</option>
								  <option value="Niue">Niue</option>
								  <option value="Norfolk Island">Norfolk Island</option>
								  <option value="North Korea">North Korea</option>
								  <option value="Northern Mariana Is.">Northern Mariana Is</option>
								  <option value="Norway">Norway</option>
								  <option value="Oman">Oman</option>
								  <option value="Pakistan">Pakistan</option>
								  <option value="Palau">Palau</option>
								  <option value="Panama">Panama</option>
								  <option value="Papua New Guinea">Papua New Guinea</option>
								  <option value="Paraguay">Paraguay</option>
								  <option value="Peru">Peru</option>
								  <option value="Philippines">Philippines</option>
								  <option value="Pitcairn">Pitcairn</option>
								  <option value="Poland">Poland</option>
								  <option value="Portugal">Portugal</option>
								  <option value="Puerto Rico">Puerto Rico</option>
								  <option value="Qatar">Qatar</option>
								  <option value="Reunion">Reunion</option>
								  <option value="Romania">Romania</option>
								  <option value="Russian Federation">Russian Federation</option>
								  <option value="Rwanda">Rwanda</option>
								  <option value="Samoa">Samoa</option>
								  <option value="San Marino">San Marino</option>
								  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
								  <option value="Saudi Arabia">Saudi Arabia</option>
								  <option value="Senegal">Senegal</option>
								  <option value="Seychelles">Seychelles</option>
								  <option value="Sierra Leone">Sierra Leone</option>
								  <option value="Singapore">Singapore</option>
								  <option value="Slovakia">Slovakia</option>
								  <option value="Slovenia">Slovenia</option>
								  <option value="Solomon Islands">Solomon Islands</option>
								  <option value="Somalia">Somalia</option>
								  <option value="South Africa">South Africa</option>
								  <option value="South Georgia">South Georgia</option>
								  <option value="South Korea">South Korea</option>
								  <option value="Spain">Spain</option>
								  <option value="Sri Lanka">Sri Lanka</option>
								  <option value="St Helena">St Helena</option>
								  <option value="St Kitts+Nevis">St Kitts Nevis</option>
								  <option value="St Lucia">St Lucia</option>
								  <option value="St Pierre Miquelon">St Pierre Miquelon</option>
								  <option value="St Vincent+Grenadines">St Vincent Grenadines</option>
								  <option value="Sudan">Sudan</option>
								  <option value="Suriname">Suriname</option>
								  <option value="Svalbard Jan Mayen Is">Svalbard Jan Mayen Is</option>
								  <option value="Swaziland">Swaziland</option>
								  <option value="Sweden">Sweden</option>
								  <option value="Switzerland">Switzerland</option>
								  <option value="Syria">Syria</option>
								  <option value="Taiwan">Taiwan</option>
								  <option value="Tajikistan">Tajikistan</option>
								  <option value="Tanzania">Tanzania</option>
								  <option value="Thailand">Thailand</option>
								  <option value="Togo">Togo</option>
								  <option value="Tokelau">Tokelau</option>
								  <option value="Tonga">Tonga</option>
								  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
								  <option value="Tunisia">Tunisia</option>
								  <option value="Turkey">Turkey</option>
								  <option value="Turkmenistan">Turkmenistan</option>
								  <option value="Turks and Caicos Is">Turks and Caicos Is</option>
								  <option value="Tuvalu">Tuvalu</option>
								  <option value="Uganda">Uganda</option>
								  <option value="Ukraine">Ukraine</option>
								  <option value="United Arab Emirates">United Arab Emirates</option>
								  <option value="United Kingdom">United Kingdom</option>
								  <option value="Uruguay">Uruguay</option>
								  <option value="US Minor Outlying Is">US Minor Outlying Is</option>
								  <option value="USA" selected>USA</option>
								  <option value="Uzbekistan">Uzbekistan</option>
								  <option value="Vanuatu">Vanuatu</option>
								  <option value="Vatican City State">Vatican City State</option>
								  <option value="Venezuela">Venezuela</option>
								  <option value="Viet Nam">Viet Nam</option>
								  <option value="Virgin Is British">Virgin Is British</option>
								  <option value="Virgin Is US">Virgin Is US</option>
								  <option value="Wallis and Futuna Is">Wallis and Futuna Is</option>
								  <option value="Western Sahara">Western Sahara</option>
								  <option value="Yemen">Yemen</option>
								  <option value="Yugoslavia">Yugoslavia</option>
								  <option value="Zaire">Zaire</option>
								  <option value="Zambia">Zambia</option>
								  <option value="Zimbabwe">Zimbabwe</option>
            				</select></td>
     </tr>
     
     
      <tr>
     <td height="30" align="right" valign="top"><span>State/Province</span></td>
     <td height="30">
     <?php
	 $sql_state="select * from states";
	 $res_state=mysql_query($sql_state);
	 ?>
     <select  class="select" name="state" id="state">
    <?php
	while($row_state=mysql_fetch_assoc($res_state))
	{
	?>
    <option value="<?php echo $row_state['abbreviation'];?>" <?php if($row_user['state']==$row_state['abbreviation']){ echo "selected";}?>><?php echo $row_state['state'];?></option>
	<?php
    }
    ?>
                       </select></td>
     <td height="30" align="right" valign="top"><span>State/Province</span></td>
     <td height="30">
     <?php
	 $sql_state="select * from states";
	 $res_state=mysql_query($sql_state);
	 ?>
     <select class="select" name="mailing_state" id="state">
     <?php
	while($row_state=mysql_fetch_assoc($res_state))
	{
	?>
    <option value="<?php echo $row_state['abbreviation'];?>" <?php if($row_user['state']==$row_state['abbreviation']){ echo "selected";}?>><?php echo $row_state['state'];?></option>
	<?php
    }
    ?>
   </select></td>
     </tr>
     
     
     
     <tr>
     <td height="30" align="right" valign="top"><span>Postal Code</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="zip" id="zip" value="<?php echo $row_user['zip'];?>"></td>
     <td height="30" align="right" valign="top"><span>Postal Code</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="mailing_zip" id="mailing_zip1"></td>
     </tr>
     
          
     <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr bgcolor="#0099FF">
     <th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Personal Information</th>
     </tr>
     
     <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>Birth Date</span></td>
     <td height="30">
     <?php 
	 $dob=$row_user['dob'];
	 $arr_dob=explode("-",$dob);
	 ?>
            <select name="months"  class="select1"  id="months" required>
            <option value="">Month</option>
            <option value="01" <?php if($arr_dob[1]=='01'){ echo "selected";}?>>January</option>
            <option value="02" <?php if($arr_dob[1]=='02'){ echo "selected";}?>>February</option>
            <option value="03" <?php if($arr_dob[1]=='03'){ echo "selected";}?>>March</option>
            <option value="04" <?php if($arr_dob[1]=='04'){ echo "selected";}?>>April</option>
            <option value="05" <?php if($arr_dob[1]=='05'){ echo "selected";}?>>May</option>
            <option value="06" <?php if($arr_dob[1]=='06'){ echo "selected";}?>>June</option>
            <option value="07" <?php if($arr_dob[1]=='07'){ echo "selected";}?>>July</option>
            <option value="08" <?php if($arr_dob[1]=='08'){ echo "selected";}?>>August</option>
            <option value="09" <?php if($arr_dob[1]=='09'){ echo "selected";}?>>September</option>
            <option value="10" <?php if($arr_dob[1]=='10'){ echo "selected";}?>>October</option>
            <option value="11" <?php if($arr_dob[1]=='11'){ echo "selected";}?>>November</option>
            <option value="12" <?php if($arr_dob[1]=='12'){ echo "selected";}?>>December</option>
            
            </select>
			
            <select name="day"  class="select1"  id="day" required>
              <option value="">Day</option>
              <option value="01" <?php if($arr_dob[2]=='01'){ echo "selected";}?>>01</option>
              <option value="02" <?php if($arr_dob[2]=='02'){ echo "selected";}?>>02</option>
              <option value="03" <?php if($arr_dob[2]=='03'){ echo "selected";}?>>03</option>
              <option value="04" <?php if($arr_dob[2]=='04'){ echo "selected";}?>>04</option>
              <option value="05" <?php if($arr_dob[2]=='05'){ echo "selected";}?>>05</option>
              <option value="06" <?php if($arr_dob[2]=='06'){ echo "selected";}?>>06</option>
              <option value="07" <?php if($arr_dob[2]=='07'){ echo "selected";}?>>07</option>
              <option value="08" <?php if($arr_dob[2]=='08'){ echo "selected";}?>>08</option>
              <option value="09" <?php if($arr_dob[2]=='09'){ echo "selected";}?>>09</option>
              <option value="10" <?php if($arr_dob[2]=='10'){ echo "selected";}?>>10</option>
              <option value="11" <?php if($arr_dob[2]=='11'){ echo "selected";}?>>11</option>
              <option value="12" <?php if($arr_dob[2]=='12'){ echo "selected";}?>>12</option>
              <option value="13" <?php if($arr_dob[2]=='13'){ echo "selected";}?>>13</option>
              <option value="14" <?php if($arr_dob[2]=='14'){ echo "selected";}?>>14</option>
              <option value="15" <?php if($arr_dob[2]=='15'){ echo "selected";}?>>15</option>
              <option value="16" <?php if($arr_dob[2]=='16'){ echo "selected";}?>>16</option>
              <option value="17" <?php if($arr_dob[2]=='17'){ echo "selected";}?>>17</option>
              <option value="18" <?php if($arr_dob[2]=='18'){ echo "selected";}?>>18</option>
              <option value="19" <?php if($arr_dob[2]=='19'){ echo "selected";}?>>19</option>
              <option value="20" <?php if($arr_dob[2]=='20'){ echo "selected";}?>>20</option>
              <option value="21" <?php if($arr_dob[2]=='21'){ echo "selected";}?>>21</option>
              <option value="22" <?php if($arr_dob[2]=='22'){ echo "selected";}?>>22</option>
              <option value="23" <?php if($arr_dob[2]=='23'){ echo "selected";}?>>23</option>
              <option value="24" <?php if($arr_dob[2]=='24'){ echo "selected";}?>>24</option>
              <option value="25" <?php if($arr_dob[2]=='25'){ echo "selected";}?>>25</option>
              <option value="26" <?php if($arr_dob[2]=='26'){ echo "selected";}?>>26</option>
              <option value="27" <?php if($arr_dob[2]=='27'){ echo "selected";}?>>27</option>
              <option value="28" <?php if($arr_dob[2]=='28'){ echo "selected";}?>>28</option>
              <option value="29" <?php if($arr_dob[2]=='29'){ echo "selected";}?>>29</option>
              <option value="30" <?php if($arr_dob[2]=='30'){ echo "selected";}?>>30</option>
              <option value="31" <?php if($arr_dob[2]=='31'){ echo "selected";}?>>31</option>
             </select>
                  
            <select  class="select1" name="year" id="year" required >
              <option value="">Year</option>
              <?php
              $yy=date('Y');
			  for($i=$yy;$i>=1920;$i--)
			  {
			  ?>
			   <option value="<?php echo $i;?>" <?php if($i==$arr_dob[0]){ echo "selected";}?>><?php echo $i;?></option>
			  <?php }?>
            </select>
                           
                </td>
     <td height="30" align="right" valign="top"><span>Email Address</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="email" id="email" value="<?php echo $row_user['email'];?>" required></td>
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>U. S. Citizen ?</span></td>
     <td height="30">No &nbsp;<input type="radio" name="us_citizen" value="0" onClick="showhides()">&nbsp;&nbsp;&nbsp;&nbsp;Yes &nbsp;<input type="radio" name="us_citizen" value="1" checked  onClick="showhides()"></td>
     <td height="30" align="right" valign="top"><span>SSN (ex. 123456789)</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="ssn_no" id="ssn_no" value="<?php echo $row_user['pan_no'];?>" onKeyUp="showssn()" maxlength="9"></td>
     </tr>
     <script>
	 	function showssn()
		{
			var cardValue = $('#ssn_no').val();
			cardLength = cardValue.length;
			if(cardLength==3)
			{
				cardValue += "-";
				$('#ssn_no').val(cardValue);
			}
			if(cardLength<7 && cardLength>5)
			{
				cardValue += "-";
				$('#ssn_no').val(cardValue);
			}
		}
		function showhides()
		{
			//alert("subhash");
		}
	 </script>
     <tr>
     <td height="30" align="right" valign="top" ><span>ID Type</span></td>
     <td height="30"><select  class="select" name="id_type" id="id_type">
     					<!--<option value="Birth certificate">Birth certificate</option>-->
                        <option value="Green Card">Green Card</option>
                        <option value="Visa">Visa</option>
                        <option value="Passport">Passport</option>
                        <option value="Matricula Consular">Matricula Consular</option>
                        <option value="State Isued ID">State Isued ID</option>
                        <option value="US Military ID">US Military ID</option>
                        <option value="Native American Tribal ID Card">Native American Tribal ID Card</option>
                        
                        <option value="Driver's license">Driver's license</option>
                        <option value="Passport">Passport</option>
                        <!--<option value="Social Security card">Social Security card</option>
                        <option value="Department of Defense Identification Card">Department of Defense Identification Card</option>
                        <option value="Other specialized cards">Other specialized cards</option>-->
                       </select></td>
     <td height="30" align="right" valign="top" ><span>ID Number </span></td>
     <td height="30"><input class="inputs" type="text"  placeholder="" name="id_no" id="id_no"></td>
     </tr>
     
      <tr>
     <td height="30" align="right" valign="top"><span>ID Issuing Country/State</span></td>
     <td height="30"><select class="select1" name="id_issue_country" id="id_issue_country">
     
								<option value="<?=$rowuser['country'];?>"><?=$rowuser['country'];?></option>
								  <option value="Afghanistan">Afghanistan</option>
								  <option value="Albania">Albania</option>
								  <option value="Algeria">Algeria</option>
								  <option value="American Samoa">American Samoa</option>
								  <option value="Andorra">Andorra</option>
								  <option value="Angola">Angola</option>
								  <option value="Anguilla">Anguilla</option>
								  <option value="Antarctica">Antarctica</option>
								  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
								  <option value="Argentina">Argentina</option>
								  <option value="Armenia">Armenia</option>
								  <option value="Aruba">Aruba</option>
								  <option value="Australia">Australia</option>
								  <option value="Austria">Austria</option>
								  <option value="Azerbaijan">Azerbaijan</option>
								  <option value="Bahamas">Bahamas</option>
								  <option value="Bahrain">Bahrain</option>
								  <option value="Bangladesh">Bangladesh</option>
								  <option value="Barbados">Barbados</option>
								  <option value="Belarus">Belarus</option>
								  <option value="Belgium">Belgium</option>
								  <option value="Belize">Belize</option>
								  <option value="Benin">Benin</option>
								  <option value="Bermuda">Bermuda</option>
								  <option value="Bhutan">Bhutan</option>
								  <option value="Bolivia">Bolivia</option>
								  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								  <option value="Botswana">Botswana</option>
								  <option value="Bouvet Island">Bouvet Island</option>
								  <option value="Brazil">Brazil</option>
								  <option value="British Ind. Ocean Terr.">British Ind Ocean Terr.</option>
								  <option value="Brunei Darussalam">Brunei Darussalam</option>
								  <option value="Bulgaria">Bulgaria</option>
								  <option value="Burkina Faso">Burkina Faso</option>
								  <option value="Burundi">Burundi</option>
								  <option value="Cambodia">Cambodia</option>
								  <option value="Cameroon">Cameroon</option>
								  <option value="Canada">Canada</option>
								  <option value="Cape Verde">Cape Verde</option>
								  <option value="Cayman Islands">Cayman Islands</option>
								  <option value="Central African Rep.">Central African Rep.</option>
								  <option value="Chad">Chad</option>
								  <option value="Chile">Chile</option>
								  <option value="China">China</option>
								  <option value="Christmas Island">Christmas Island</option>
								  <option value="Cocos Keeling">Cocos Keeling</option>
								  <option value="Colombia">Colombia</option>
								  <option value="Comoros">Comoros</option>
								  <option value="Congo">Congo</option>
								  <option value="Cook Islands">Cook Islands</option>
								  <option value="Costa Rica">Costa Rica</option>
								  <option value="country.PS">country PS</option>
								  <option value="Croatia">Croatia</option>
								  <option value="Cuba">Cuba</option>
								  <option value="Cyprus">Cyprus</option>
								  <option value="Czech Republic">Czech Republic</option>
								  <option value="Cote d Ivoire">Cote d Ivoire</option>
								  <option value="Denmark">Denmark</option>
								  <option value="Djibouti">Djibouti</option>
								  <option value="Dominica">Dominica</option>
								  <option value="Dominican Republic">Dominican Republic</option>
								  <option value="East Timor">East Timor</option>
								  <option value="Ecuador">Ecuador</option>
								  <option value="Egypt">Egypt</option>
								  <option value="El salvador">El salvador</option>
								  <option value="Equatorial Guinea">Equatorial Guinea</option>
								  <option value="Eritrea">Eritrea</option>
								  <option value="Estonia">Estonia</option>
								  <option value="Ethiopia">Ethiopia</option>
								  <option value="Falkland Islands">Falkland Islands</option>
								  <option value="Faroe Islands">Faroe Islands</option>
								  <option value="Fiji">Fiji</option>
								  <option value="Finland">Finland</option>
								  <option value="France">France</option>
								  <option value="French Guiana">French Guiana</option>
								  <option value="French Polynesia">French Polynesia</option>
								  <option value="French Sthern Terr.">French Southern Terr</option>
								  <option value="Gabon">Gabon</option>
								  <option value="Gambia">Gambia</option>
								  <option value="Georgia">Georgia</option>
								  <option value="Germany">Germany</option>
								  <option value="Ghana">Ghana</option>
								  <option value="Gibraltar">Gibraltar</option>
								  <option value="Greece">Greece</option>
								  <option value="Greenland">Greenland</option>
								  <option value="Grenada">Grenada</option>
								  <option value="Guadeloupe">Guadeloupe</option>
								  <option value="Guam">Guam</option>
								  <option value="Guatemala">Guatemala</option>
								  <option value="Guinea">Guinea</option>
								  <option value="Guinea Bissau">Guinea Bissau</option>
								  <option value="Guyana">Guyana</option>
								  <option value="Haiti">Haiti</option>
								  <option value="Heard Is McDonald Is">Heard Is McDonald Is</option>
								  <option value="Honduras">Honduras</option>
								  <option value="Hong Kong">Hong Kong</option>
								  <option value="Hungary">Hungary</option>
								  <option value="Iceland">Iceland</option>
								  <option value="India">India</option>
								  <option value="Indonesia">Indonesia</option>
								  <option value="Ireland">Ireland</option>
								  <option value="Israel">Israel</option>
								  <option value="Italy">Italy</option>
								  <option value="Jamaica">Jamaica</option>
								  <option value="Japan">Japan</option>
								  <option value="Jordan">Jordan</option>
								  <option value="Kazakstan">Kazakstan</option>
								  <option value="Kenya">Kenya</option>
								  <option value="Kiribati">Kiribati</option>
								  <option value="Kuwait">Kuwait</option>
								  <option value="Kyrgystan">Kyrgystan</option>
								  <option value="Lao">Lao</option>
								  <option value="Latvia">Latvia</option>
								  <option value="Lebanon">Lebanon</option>
								  <option value="Lesotho">Lesotho</option>
								  <option value="Liberia">Liberia</option>
								  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								  <option value="Liechtenstein">Liechtenstein</option>
								  <option value="Lithuania">Lithuania</option>
								  <option value="Luxembourg">Luxembourg</option>
								  <option value="Macau">Macau</option>
								  <option value="Macedonia: FYR">Macedonia FYR</option>
								  <option value="Madagascar">Madagascar</option>
								  <option value="Malawi">Malawi</option>
								  <option value="Malaysia">Malaysia</option>
								  <option value="Maldives">Maldives</option>
								  <option value="Mali">Mali</option>
								  <option value="Malta">Malta</option>
								  <option value="Marshall Islands">Marshall Islands</option>
								  <option value="Martinique">Martinique</option>
								  <option value="Mauritania">Mauritania</option>
								  <option value="Mauritius">Mauritius</option>
								  <option value="Mayotte">Mayotte</option>
								  <option value="Mexico">Mexico</option>
								  <option value="Micronesia">Micronesia</option>
								  <option value="Moldova">Moldova</option>
								  <option value="Monaco">Monaco</option>
								  <option value="Mongolia">Mongolia</option>
								  <option value="Montserrat">Montserrat</option>
								  <option value="Morocco">Morocco</option>
								  <option value="Mozambique">Mozambique</option>
								  <option value="Myanmar">Myanmar</option>
								  <option value="Namibia">Namibia</option>
								  <option value="Nauru">Nauru</option>
								  <option value="Nepal">Nepal</option>
								  <option value="Netherlands">Netherlands</option>
								  <option value="Netherlands Antilles">Netherlands Antilles</option>
								  <option value="New Caledonia">New Caledonia</option>
								  <option value="New Zealand">New Zealand</option>
								  <option value="Nicaragua">Nicaragua</option>
								  <option value="Niger">Niger</option>
								  <option value="Nigeria">Nigeria</option>
								  <option value="Niue">Niue</option>
								  <option value="Norfolk Island">Norfolk Island</option>
								  <option value="North Korea">North Korea</option>
								  <option value="Northern Mariana Is.">Northern Mariana Is</option>
								  <option value="Norway">Norway</option>
								  <option value="Oman">Oman</option>
								  <option value="Pakistan">Pakistan</option>
								  <option value="Palau">Palau</option>
								  <option value="Panama">Panama</option>
								  <option value="Papua New Guinea">Papua New Guinea</option>
								  <option value="Paraguay">Paraguay</option>
								  <option value="Peru">Peru</option>
								  <option value="Philippines">Philippines</option>
								  <option value="Pitcairn">Pitcairn</option>
								  <option value="Poland">Poland</option>
								  <option value="Portugal">Portugal</option>
								  <option value="Puerto Rico">Puerto Rico</option>
								  <option value="Qatar">Qatar</option>
								  <option value="Reunion">Reunion</option>
								  <option value="Romania">Romania</option>
								  <option value="Russian Federation">Russian Federation</option>
								  <option value="Rwanda">Rwanda</option>
								  <option value="Samoa">Samoa</option>
								  <option value="San Marino">San Marino</option>
								  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
								  <option value="Saudi Arabia">Saudi Arabia</option>
								  <option value="Senegal">Senegal</option>
								  <option value="Seychelles">Seychelles</option>
								  <option value="Sierra Leone">Sierra Leone</option>
								  <option value="Singapore">Singapore</option>
								  <option value="Slovakia">Slovakia</option>
								  <option value="Slovenia">Slovenia</option>
								  <option value="Solomon Islands">Solomon Islands</option>
								  <option value="Somalia">Somalia</option>
								  <option value="South Africa">South Africa</option>
								  <option value="South Georgia">South Georgia</option>
								  <option value="South Korea">South Korea</option>
								  <option value="Spain">Spain</option>
								  <option value="Sri Lanka">Sri Lanka</option>
								  <option value="St Helena">St Helena</option>
								  <option value="St Kitts+Nevis">St Kitts Nevis</option>
								  <option value="St Lucia">St Lucia</option>
								  <option value="St Pierre Miquelon">St Pierre Miquelon</option>
								  <option value="St Vincent+Grenadines">St Vincent Grenadines</option>
								  <option value="Sudan">Sudan</option>
								  <option value="Suriname">Suriname</option>
								  <option value="Svalbard Jan Mayen Is">Svalbard Jan Mayen Is</option>
								  <option value="Swaziland">Swaziland</option>
								  <option value="Sweden">Sweden</option>
								  <option value="Switzerland">Switzerland</option>
								  <option value="Syria">Syria</option>
								  <option value="Taiwan">Taiwan</option>
								  <option value="Tajikistan">Tajikistan</option>
								  <option value="Tanzania">Tanzania</option>
								  <option value="Thailand">Thailand</option>
								  <option value="Togo">Togo</option>
								  <option value="Tokelau">Tokelau</option>
								  <option value="Tonga">Tonga</option>
								  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
								  <option value="Tunisia">Tunisia</option>
								  <option value="Turkey">Turkey</option>
								  <option value="Turkmenistan">Turkmenistan</option>
								  <option value="Turks and Caicos Is">Turks and Caicos Is</option>
								  <option value="Tuvalu">Tuvalu</option>
								  <option value="Uganda">Uganda</option>
								  <option value="Ukraine">Ukraine</option>
								  <option value="United Arab Emirates">United Arab Emirates</option>
								  <option value="United Kingdom">United Kingdom</option>
								  <option value="Uruguay">Uruguay</option>
								  <option value="US Minor Outlying Is">US Minor Outlying Is</option>
								  <option value="USA" selected>USA</option>
								  <option value="Uzbekistan">Uzbekistan</option>
								  <option value="Vanuatu">Vanuatu</option>
								  <option value="Vatican City State">Vatican City State</option>
								  <option value="Venezuela">Venezuela</option>
								  <option value="Viet Nam">Viet Nam</option>
								  <option value="Virgin Is British">Virgin Is British</option>
								  <option value="Virgin Is US">Virgin Is US</option>
								  <option value="Wallis and Futuna Is">Wallis and Futuna Is</option>
								  <option value="Western Sahara">Western Sahara</option>
								  <option value="Yemen">Yemen</option>
								  <option value="Yugoslavia">Yugoslavia</option>
								  <option value="Zaire">Zaire</option>
								  <option value="Zambia">Zambia</option>
								  <option value="Zimbabwe">Zimbabwe</option>
            				</select>
                            <?php
                                $sql_state="select * from states";
								$res_state=mysql_query($sql_state);
								
								?>
                       <select class="select1" name="id_issue_state" id="id_issue_state">
     						<?php
                                while($row_state=mysql_fetch_assoc($res_state))
								{
								?>
                                	<option value="<?php echo $row_state['abbreviation'];?>" <?php if($rowuser['state']==$row_state['abbreviation']){ echo "selected";}?>><?php echo $row_state['state'];?></option>
                                <?php
                                }
								?>
                       </select>
                </td>
     <td height="30" align="right" valign="top"><span>ID Expiration Date month</span></td>
     <td height="30">
     <select name="id_month" class="select1" required>
        <option value="">Month</option>
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
			
     <select name="id_day" class="select1" required>
        <option value="">Day</option>
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
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
            <select name="id_year" required class="select1">
              <option value="">Year</option>
			  <?php
			  $yy=2040; 
			  for($ii=$yy;$ii>=1920;$ii--)
			  {
			  ?>
              <option value="<?php echo $ii;?>"><?php echo $ii;?></option>
			   <?php }?>             
            </select></td>
     </tr>
     
     <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr bgcolor="#0099FF">
     	<th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Additional Contact Information</th>
     </tr>
     
     <tr><td colspan="4">&nbsp;</td></tr>
     
     <tr>
         <td height="30" align="right" valign="top"><span>Home Phone</span></td>
         <td height="30"><input class="inputs" type="text" placeholder="" name="home_phone" id="home_phone"></td>
         <td height="30" align="right" valign="top"><span>Office Phone</span></td>
         <td height="30"><input class="inputs" type="text" placeholder="" name="office_phone" id="office_phone"></td>
     </tr>
     
     <tr>
         <td height="30" align="right" valign="top"><span>Mobile Phone</span></td>
         <td height="30"><input class="inputs" type="text" placeholder="" name="mobile_phone" id="mobile_phone" value="<?php echo $row_user['mobile'];?>"></td>
         <td height="30" align="right" valign="top"><span>Fax Number</span></td>
         <td height="30"><input class="inputs" type="text" placeholder="" name="fax_no" id=""></td>
     </tr>
     
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
         <td colspan="4" align="center"><input type="submit" value="Registeration!" id="" name="" class="reg-btn"> &nbsp;&nbsp;
         <a href="vtn_terms_condition.php">Paycard terms &amp; conditions</a></td>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     </table>
</form>
<?php
}
?>
				  </div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>
<script>

	 $("input:radio[name=us_citizen]").click(function() {
	 alert("subhash");
    var value = $(this).val();
	alert(value);
	});
	 </script>