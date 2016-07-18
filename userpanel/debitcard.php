<?php
include('../includes/all_func.php');
include('header.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	//transaction history
$id=showuserid($_SESSION['SD_User_Name']);
$query2=" select * from credit_debit where user_id='$id' order by receive_date";
$result2=mysql_query($query2);
echo mysql_error();
$nume=mysql_num_rows($result2);
$sqll=mysql_query("select * from credit_debit where user_id='$id' order by receive_date  limit $eu, $limit");
$sqql=mysql_query("select * from final_e_wallet where user_id='$id'");
$f_current=mysql_fetch_array($sqql);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<script>
function showadmincharge(val)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	 xmlhttp=new XMLHttpRequest();
    }
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
			xmlhttp.onreadystatechange=function()
			  {
			  if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				var str=xmlhttp.responseText;
				var res = str.split(",");
				var tot=res[1];
				document.getElementById("admincharge").innerHTML="$"+res[0];
				document.getElementById("totalpaid").innerHTML="$"+res[1];
				}
			  }
			xmlhttp.open("GET","ajax_admin_charge.php?amount="+val,true);
			xmlhttp.send();
}
</script>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div>
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
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Update Debit/Credit Card Info</h3>
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
	<?php //include('switch-bar.php');?>
		<div id="content">
		<div class="grid_container">
	<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Update Debit/Credit Card Info</h6>
                        <h6><a href="debitcard_new.php">Add New Debit/Credit Card Info</a></h6>
					</div>
					<div class="widget_content">
						<?php 
							 $sqluser="select * from billing_address where user_id='$id' and status=0";
							 $resuser=mysql_query($sqluser);
							 $countuser=mysql_num_rows($resuser);
							 $rowuser=mysql_fetch_assoc($resuser);
							 if($countuser)
							 {
							 	$action="update";
							 }
							 else
							 {
							 	$action="insert";
							 }
							 $sql_user="select * from registration where user_id='$id'";
							 $res_user=mysql_query($sql_user);
							 $row_user=mysql_fetch_assoc($res_user);
							?>
						<div id="tab4">
							<div class="oilhold">
   							<form action="update_creditcard.php?action=<?php echo $action;?>" method="post" class="form_container left_label">
							<ul>
                            <li>
								<div class="form_grid_12">
									<label class="field_title">First Name</label>
									<div class="form_input">
										<label><input type="text" name="first_name" value="<?=$row_user['first_name'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Middle Name</label>
									<div class="form_input">
										<label><input type="text" name="mid_name" value="<?=$row_user['mid_name'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Last Name</label>
									<div class="form_input">
										<label><input type="text" name="last_name" value="<?=$row_user['last_name'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Email</label>
									<div class="form_input">
										<label><input type="text" name="email" value="<?=$row_user['email'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Mobile</label>
									<div class="form_input">
										<label><input type="text" name="mobile" value="<?=$row_user['mobile'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Address1</label>
									<div class="form_input">
										<label><input type="text" name="address1" value="<?=$row_user['address1'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Address2</label>
									<div class="form_input">
										<label><input type="text" name="address2" value="<?=$row_user['address2'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">City</label>
									<div class="form_input">
										<label><input type="text" name="city" value="<?=$row_user['city'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">State</label>
									<div class="form_input">
										<label><input type="text" name="state" value="<?=$row_user['state'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Zip</label>
									<div class="form_input">
										<label><input type="text" name="zip" value="<?=$row_user['zip'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Country</label>
									<div class="form_input">
										<label><select name="country" id="country" class="select">
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
            				</select></label>
									</div>
								</div>
								</li>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Card Type</label>
									<div class="form_input">
										<label>
                                        <select name="card_type">
                                        <option value="Visa" <?php if($rowuser['card_type']=='Visa'){ echo "selected";}?>>Visa</option>
                                        <option value="Mastercard" <?php if($rowuser['card_type']=='Mastercard'){ echo "selected";}?>>Mastercard</option>
                                        <option value="Discover" <?php if($rowuser['card_type']=='Discover'){ echo "selected";}?>>Discover</option>
                                        </select>
                                        <!--<input type="text" name="card_tyep" value="<?=$rowuser['card_type'];?>">--></label>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Card No</label>
									<div class="form_input">
										<label><input type="text" name="card_no" value="<?=$rowuser['card_no'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Expiry Date</label>
									<div class="form_input">
										<label><input type="text" name="exp_date" value="<?=$rowuser['exp_date'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Card Security Code </label>
									<div class="form_input">
										<label><input type="text" name="cvv" value="<?=$rowuser['cvv'];?>"></label>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="id" name="id" value="<?php  echo $rowuser['id'];?>" />
										<button type="submit" class="btn_small btn_gray"><span>Submit</span></button>
                                        <?php
                                        if($countuser)
							 			{
										?>
                                        <a href="cancel_debitcard.php?id=<?php  echo $rowuser['id'];?>">Cancel</a>
                                        <?php
										}
										?>
										<span class="blue"><?php if($_GET['msg_r']) echo $_GET['msg_r']; else if($_GET['msg']) echo $_GET['msg']; ?></span>
									</div>
								</div>
								</li>
							</ul>
						</form>
					  <!--<img src="images/support-ticket.jpg" border="0" />
					<br />
					 <div align="center" style="padding-top:20px;">
					  <input name="raise_ticket" class="btn" type="button"  value="Raise Ticket" onClick="window.location.href='raise-ticket.php'"/>
					  </div>-->
					</div>
				</div>
					</div>
				</div>
			</div>
			</div></div>
</div>
</body>
</html>
<script language="javascript">
function checkUser(val,target)
{
	//alert(val+'--'+target);
	var urldata="ref="+val+"&target="+target;
             $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_checkuser.php",
                data: urldata,
                success: function(html) {
				//alert(target+'---'+html);
                    if(html)
					{
						$('#user_'+target).html(html);
					}
					else
					{
						return false;	
					}
                }
            });
}
</script>