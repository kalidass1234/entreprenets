<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	 $sql_welcome=mysql_fetch_array(mysql_query("SELECT * FROM static_page order by id desc limit 0,1"));	
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_name='{$_SESSION['SD_User_Name']}'"));
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
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
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
	<!--<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Add a Credit or Debit Card </h3>
		<div class="top_search">
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
		</div>
	</div>-->
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6><?php if($id){ echo "Edit";} else echo "Add";?> a Credit or Debit Card </h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Compose Message</a></li>
								
								<li><a href="inbox.php">Indox</a></li>
								<li><a href="#tab3">Sent </a></li>
							</ul>
						</div>-->
					</div>
					<!--<div class="widget_content">
					<div>-->
				
						<div id="tab1">
							<div class="oilhold">
							<?php
							$sqlcard1="select * from card_info where  id='$id'";
							$rescard1=mysql_query($sqlcard1);
							$rowcard1=mysql_fetch_assoc($rescard1);
							$sqlcard2="select * from billing_address where card_id='$id'";
							$rescard2=mysql_query($sqlcard2);
							$rowcard2=mysql_fetch_assoc($rescard2);

							?>
   							<form action="addcard.php" method="post" class="form_container left_label">
							<ul>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<input name="u_name" type="text" tabindex="1" class="" style="width:44%;" />
									
									</div>
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<label class="field_title">Cardholder's Name:</label>
									<div class="form_input">
										<input name="card_name" maxlength="25" type="text" value="<?php echo $rowcard1['card_name'];?>" required='required' tabindex="1" style="width:44%;" />
										
									</div>
								</div>
								</li>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Card No:</label>
									<div class="form_input">
										<input name="card_no" maxlength="16" required='required' onKeyUp="if(isNaN(this.value)){ this.value=''}" onBlur="if(isNaN(this.value)){ this.value=''}" type="text" value="<?php echo $rowcard1['card_no'];?>" tabindex="2" style="width:44%;" />
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Expiration Date:</label>
									<div class="form_input">
											<?php 
											$exarr=explode('-',$rowcard1['expiry_month_year']);
											$month=$exarr[0];
											$yy=$exarr[1];
											?>
										<select name="month" style="width:100px;" id="month" class="chzn-select" tabindex="3" required='required'>
											  <option value="01" <?php if($month=='01'){ echo "selected='selected'";}?>>January</option>
											  <option value="02" <?php if($month=='02'){ echo "selected='selected'";}?>>February</option>
											  <option value="03" <?php if($month=='03'){ echo "selected='selected'";}?>>March</option>
											  <option value="04" <?php if($month=='04'){ echo "selected='selected'";}?>>April</option>
											  <option value="05" <?php if($month=='05'){ echo "selected='selected'";}?>>May</option>
											  <option value="06" <?php if($month=='06'){ echo "selected='selected'";}?>>June</option>
											  <option value="07" <?php if($month=='07'){ echo "selected='selected'";}?>>July</option>
											  <option value="08" <?php if($month=='08'){ echo "selected='selected'";}?>>August</option>
											  <option value="09" <?php if($month=='09'){ echo "selected='selected'";}?>>September</option>
											  <option value="10" <?php if($month=='10'){ echo "selected='selected'";}?>>October</option>
											  <option value="11" <?php if($month=='11'){ echo "selected='selected'";}?>>November</option>
											  <option value="12" <?php if($month=='12'){ echo "selected='selected'";}?>>December</option>
					                    </select>
								 <select name="yy" id="yy" style="width:100px;" class="chzn-select" tabindex="4" required='required'>
									 <?php 
									 for($y=2013;$y<2038;$y++)
									 {
									 ?>
										<option value="<?php echo $y;?>" <?php if($y==$yy) {?>selected="selected" <?php }?>><?php echo $y;?></option>
									 <?php
									 }
									 ?>
								 </select> 
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">CVS NO:</label>
									<div class="form_input">
										<input name="cvs_no" maxlength="3" id="cvs_no" onKeyUp="if(isNaN(this.value)){ this.value=''}" onBlur="if(isNaN(this.value)){ this.value=''}" type="text" value="<?php echo $rowcard1['cvs_no'];?>" tabindex="5" style="width:44%;" />
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title"></label>
									<div class="form_input">
										<label class="field_title">Billing Address</label>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Name</label>
									<div class="form_input">
										<input name="first_name" type="text" value="<?php echo $rowcard2['first_name'];?>" tabindex="6" style="width:44%;" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address1</label>
									<div class="form_input">
										<input name="address1" type="text" value="<?php echo $rowcard2['address1'];?>" tabindex="7" style="width:44%;" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address2</label>
									<div class="form_input">
										<input name="address2" type="text" value="<?php echo $rowcard2['address2'];?>" tabindex="8" style="width:44%;" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">City</label>
									<div class="form_input">
										<input name="city" type="text" value="<?php echo $rowcard2['city'];?>" tabindex="9" style="width:44%;" />
									</div>
								</div>
								</li><li>
								<div class="form_grid_12">
									<label class="field_title">State/Province/Region</label>
									<div class="form_input">
										<input name="state" type="text" value="<?php echo $rowcard2['state'];?>" tabindex="10" style="width:44%;" />
									</div>
								</div>
								</li><li>
								<div class="form_grid_12">
									<label class="field_title">ZIP</label>
									<div class="form_input">
										<input name="zip" type="text" value="<?php echo $rowcard2['zip'];?>" tabindex="11" style="width:44%;" />
									</div>
								</div>
								</li><li>
								<div class="form_grid_12">
									<label class="field_title">Country</label>
									<div class="form_input">
										<select name="country" id="country" class="chzn-select" tabindex="12" >
								<option value="<?=$rowcard2['country'];?>"><?=$rowcard2['country'];?></option>
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
              <option value="British Ind. Ocean Terr.">British Ind Ocean 
                Terr.</option>
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
              <option value="USA">USA</option>
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
									</div>
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
									<input type="hidden" id="card_id" name="card_id" value="<? echo $id;?>" />
									<input type="hidden" id="edit" name="edit" value="<? echo $id;?>" />
										<button type="submit" name="submit" tabindex="13" class="btn_small btn_gray"><span><?php if($id){ echo "Edit";} else echo "Add";?> Card Info</span></button>
										<button type="reset" class="btn_small btn_gray" tabindex="14"><span>Reset</span></button>
										
									</div>
								</div>
								</li>
							</ul>
						</form>
					 
					</div>	
					</div>
				
						
						
					</div>
				</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>