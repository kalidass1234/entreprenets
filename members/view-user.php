<?php define('ABSPATH','../../lib/'); include('../header.php'); 

?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('../nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Member</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Member Detail</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Member Detail</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  	$update = false;
				  
				  	if(isset($_GET['user_id'])){
						$user_id = $_GET['user_id'];
						// get product information
						$where = " where user_id='".$user_id."'";
						$args_member = $mxDb->get_information('user_registration', '*', $where, true, 'assoc');
						
						$update = true;
					}
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data" >
                  <input type="hidden" name="action" value="updateMemberInfo"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                            
                  <?php if($update):?>
                  <input type="hidden" name="id" value="<?php echo $args_member['user_id']; ?>"/>
                  <?php endif; ?>
                  
                    <fieldset>
                      <div class="form-group">
                        <h5 style="border-bottom:1px solid #999;"><strong>Sponsor Info</strong></h5>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Sponsor ID</label>
                          <div id="sub_category">
                            <?php echo $user=$args_member['ref_id']; ?>
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Sponsor Name</label>
                          <div id="sub_category">
                            <?php $mxDb->get_field_information('user_registration', "concat_ws(' ', first_name, last_name)", " where user_id=".$args_member['ref_id'],'assoc',true); ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Total Direct Member</label>
                          <div id="sub_category">
                            <?php $res_nums1=mysql_query("select * from user_registration where ref_id='$user'");
						            echo $res_nums=mysql_num_rows($res_nums1);
									
								?> 
                          </div>
                        </div>
                        
                         <div class="left-box" id="show_sub_category">
                          <label for="name" >Total Downline Member</label>
                          <div id="sub_category">
                            <?php $res_nums1=mysql_query("select * from user_registration where nom_id='$user'");
						            echo $res_nums=mysql_num_rows($res_nums1);
									
								?> 
                          </div>
                        </div>
                        
                         <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                        <h5 style="border-bottom:1px solid #999;"><strong>User Usefull Information</strong></h5>
                        
                         <div class="left-box" id="show_sub_category">
                          <label for="name" >Total Direct Enrollment</label>
                          <div id="sub_category">
                            <?php $res_nums1=mysql_query("select * from user_registration where ref_id='$user_id'");
						            echo $res_nums=mysql_num_rows($res_nums1);
									
								?> 
                          </div>
                        </div>
                        
                                                 
                        <div class="left-box" id="show_sub_category" >
                          <label for="name" >Total Amount In E-Wallet</label>
                          <div id="sub_category">
                              <?php echo "$ ".number_format($mxDb->get_field_information('final_e_wallet', 'amount', " where user_id=".$args_member['user_id'], 'assoc'),2); ?>
							</div>
                        </div>
                      
<div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
           	  

          <?php $check_id=$user_id;$starter_kit=mysql_fetch_array(mysql_query("select * from registration_payment where amount_deduct_by='$check_id' and plan_name='Business Success Starter Kit' order by id desc limit 0,1"));
			
		

			
			
			$check_id=$user_id;$starter_kit=mysql_fetch_array(mysql_query("select * from registration_payment where amount_deduct_by='$check_id' and plan_name!='Business Success Starter Kit' order by id desc limit 0,1"));
			
			
			?>
                        
                        <?php /*?>    <div class="left-box" id="show_sub_category">
                          <label for="name" >Starter Kit Purchase Date</label>
                          <div id="sub_category">
                            <?php 	$date=substr($starter_kit['deduction_date'],0,10);
			echo "Starter Kit Purchase Date :  ". $date;print_r("<br/>");
			
			$dateOneYearAdded = strtotime(date("Y-m-d", strtotime($date)) . " +1 year");
echo "Starter Kit Renew Date: ".date('Y-m-d', $dateOneYearAdded)."<br>";
									
								?> 
                          </div>
                        </div>
                                               
                        <div class="left-box" id="show_sub_category" >
                          <label for="name" >Pacakge Purchase Date</label>
                          <div id="sub_category">
                              <?php $date=substr($starter_kit['deduction_date'],0,10);
			echo "Package Purchase Date :  ". $date;print_r("<br/>");
			
			$dateOneYearAdded1 = strtotime(date("Y-m-d", strtotime($date)) . " +1 Month");
echo "Package Renew Date: ".date('Y-m-d', $dateOneYearAdded1)."<br>"; ?>
							</div>
                        </div>
                       <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                         <div class="left-box" id="show_sub_category">
                          <label for="name" >User Package Type</label>
                          <div id="sub_category">
                             <?php if($args_member['plan_name']!=0 && $args_member['plan_name']!=2){ echo "Purchase a Package";?>  <?php } else if($args_member['plan_name']==2) { echo "This User Is a ".$args_member['user_plan']." "."Package User"; } else { echo "Purchase Starter Kit";?>  <?php }?><br/>  
                          </div>
                        </div>
                         <?php */?>
                                                 
                        <div class="left-box" id="show_sub_category" >
                          <label for="name" >User Registration Date</label>
                          <div id="sub_category">
                              <?php echo $args_member['registration_date']; ?>
							</div>
                        </div>
                        
                        
                        
                         <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                        
                          <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >User Designation Type (Status)</label>
                          <div id="sub_sub_category">
                            <?php echo $args_member['designation']; ?>
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >User Personal CV</label>
                          <div id="sub_sub_category">
                             <?php echo $mxDb->get_field_information('user_bv_record', 'bv', " where user_id=".$args_member['user_id'], 'assoc'); ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                         <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >User Personal GV</label>
                          <div id="sub_sub_category">
                            <?php echo $mxDb->get_field_information('user_bv_record', 'tbv', " where user_id=".$args_member['user_id'], 'assoc'); ?>
                          </div>
                        </div>
                        
                        <?php /*?><div class="left-box" id="show_sub_sub_category">
                          <label for="name" >User Level Hold On the Matrix Tree</label>
                          <div id="sub_sub_category">
                            <?php echo $args_member['username']; ?>
                          </div>
                        </div><?php */?>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                         <h5 style="border-bottom:1px solid #999;"><strong>Personal Information</strong></h5>
                         
                         <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >User ID</label>
                          <div id="sub_sub_category">
                            <?php echo $args_member['user_id']; ?>
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Username</label>
                          <div id="sub_sub_category">
                            <?php echo $args_member['username']; ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >First Name</label>
                          <div id="sub_sub_category">
                            <input type="text" class="validate[required] form-control placeholder" name="first_name" id="first_name" value="<?php if(isset($args_member['first_name'])): echo $args_member['first_name']; endif;?>" placeholder="First name" data-bind="value: name" />
                          </div>
                        </div>
                        
                        <div class="left-box">
                          <label for="name"> Last Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="last_name" id="last_name" value="<?php if(isset($args_member['last_name'])): echo $args_member['last_name']; endif;?>" placeholder="Last name" data-bind="value: name" />
                        </div><div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box">
                          <label for="name"> Email</label>
                          <input type="text" class="validate[required] form-control placeholder" name="email" id="email" placeholder="Email" data-bind="value: name" value="<?php if(isset($args_member['email'])): echo $args_member['email']; endif;?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Address</label>
                          <input type="text" class="validate[required] form-control placeholder" name="address" id="address" placeholder="Address" data-bind="value: name" value="<?php if(isset($args_member['address'])): echo $args_member['address']; endif;?>" />
                        </div><div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box">
                          <label for="name"> City</label>
                          <input type="text" class="validate[required] form-control placeholder" name="city" id="city" placeholder="City" data-bind="value: name" value="<?php if(isset($args_member['city'])): echo $args_member['city']; endif;?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Zip / Postal code</label>
                          <input type="text" class="validate[required] form-control placeholder" name="zip" id="zip" placeholder="Zip / Postal Code" data-bind="value: name" value="<?php if(isset($args_member['zipcode'])): echo $args_member['zipcode']; endif;?>" />
                        </div><div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box">
                          <label for="name"> Country</label>
                          
                          <select name="country" id="country" class="validate[required] form-control placeholder">
                          <option value="<?php echo $args_member['country']; ?>"><?php echo $args_member['country']; ?></option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antartica">Antartica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Ashmore and Cartier Island">Ashmore and Cartier Island</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="British Virgin Islands">British Virgin Islands</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burma">Burma</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Clipperton Island">Clipperton Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Congo, Republic of the">Congo, Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote d'Ivoire">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czeck Republic">Czeck Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Europa Island">Europa Island</option><option value="Falkland Islands (Islas Malvinas)">Falkland Islands (Islas Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option><option value="Gabon">Gabon</option><option value="Gambia, The">Gambia, The</option><option value="Gaza Strip">Gaza Strip</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Glorioso Islands">Glorioso Islands</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Howland Island">Howland Island</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Ireland, Northern">Ireland, Northern</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Jan Mayen">Jan Mayen</option><option value="Japan">Japan</option><option value="Jarvis Island">Jarvis Island</option><option value="Jersey">Jersey</option><option value="Johnston Atoll">Johnston Atoll</option><option value="Jordan">Jordan</option><option value="Juan de Nova Island">Juan de Nova Island</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, North">Korea, North</option><option value="Korea, South">Korea, South</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia, Former Yugoslav Republic of">Macedonia, Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Man, Isle of">Man, Isle of</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Midway Islands">Midway Islands</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcaim Islands">Pitcaim Islands</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romainia">Romainia</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Scotland">Scotland</option><option value="Senegal">Senegal</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and South Sandwich Islands">South Georgia and South Sandwich Islands</option><option value="Spain">Spain</option><option value="Spratly Islands">Spratly Islands</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard">Svalbard</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Tobago">Tobago</option><option value="Toga">Toga</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad">Trinidad</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="Uruguay">Uruguay</option><option value="USA">USA</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Virgin Islands">Virgin Islands</option><option value="Wales">Wales</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="West Bank">West Bank</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Yugoslavia">Yugoslavia</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
                        </div>
                        
                        <div class="left-box">
                          <label for="name"> State</label>
                          <input type="text" class="validate[required] form-control placeholder" name="state" id="state" placeholder="State" data-bind="value: name" value="<?php if(isset($args_member['state'])): echo $args_member['state']; endif;?>" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box">
                          <label for="name"> Contact No</label>
                          <input type="text" class="validate[required] form-control placeholder" name="phone" id="phone" placeholder="Contact No" data-bind="value: name" value="<?php if(isset($args_member['telephone'])): echo $args_member['telephone']; endif;?>" />
                        </div>
                        
                        <div class="left-box">
                          <label for="name"> Mobile No</label>
                          <input type="text" class="validate[required] form-control placeholder" name="mobile" id="mobile" placeholder="mobile No" data-bind="value: name" value="<?php if(isset($args_member['mobile'])): echo $args_member['mobile']; endif;?>" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                         <div class="left-box">
                          <label for="name"> Password</label>
                          <input type="password" class="validate[required] form-control placeholder" name="password" id="password" data-bind="value: name" value="<?php if(isset($args_member['password'])): echo $args_member['password']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name">Transaction Password</label>
                          <input type="password" class="validate[required] form-control placeholder" name="password1" id="password1" data-bind="value: name" value="<?php if(isset($args_member['t_code'])): echo $args_member['t_code']; endif;?>" />
                        </div><div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                          <div class="left-box">
                          <label for="name"> Fax</label>
                          <input type="text" class="validate[required] form-control placeholder" name="fax" id="fax" data-bind="value: name" value="<?php if(isset($args_member['fax'])): echo $args_member['fax']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name">Age</label>
                          <input type="text" class="validate[required] form-control placeholder" name="age" id="age" data-bind="value: name" value="<?php if(isset($args_member['age'])): echo $args_member['age']; endif;?>" />
                        </div>
                        
                      </div>
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                      
                      
                       <div class="left-box">
                          <label for="name"> Date Of Birth</label>
                          <input type="text" class="validate[required] form-control placeholder" name="dob" id="dob" data-bind="value: name" value="<?php if(isset($args_member['dob'])): echo $args_member['dob']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name">Maritual Status</label>
                          <input type="text" class="validate[required] form-control placeholder" name="merried_status" id="merried_status" data-bind="value: name" value="<?php if(isset($args_member['merried_status'])): echo $args_member['merried_status']; endif;?>" />
                        </div>
                        
                     
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                       <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                       <h5 style="border-bottom:1px solid #999;"><strong>Bank Details</strong></h5>
                      
                       <div class="left-box">
                          <label for="name"> Account Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="acc_name" id="acc_name" data-bind="value: name" value="<?php if(isset($args_member['acc_name'])): echo $args_member['acc_name']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name">Account Number</label>
                          <input type="text" class="validate[required] form-control placeholder" name="ac_no" id="ac_no" data-bind="value: name" value="<?php if(isset($args_member['ac_no'])): echo $args_member['ac_no']; endif;?>" />
                        </div>
                        
                    
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                      <div class="left-box">
                          <label for="name"> Bank Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="bank_nm" id="bank_nm" data-bind="value: name" value="<?php if(isset($args_member['bank_nm'])): echo $args_member['bank_nm']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name">Branch Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="branch_nm" id="branch_nm" data-bind="value: name" value="<?php if(isset($args_member['branch_nm'])): echo $args_member['branch_nm']; endif;?>" />
                        </div>
                        
                     
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                       <div class="left-box">
                          <label for="name"> Swift Code</label>
                          <input type="text" class="validate[required] form-control placeholder" name="swift_code" id="swift_code" data-bind="value: name" value="<?php if(isset($args_member['swift_code'])): echo $args_member['swift_code']; endif;?>" />
                        </div>
                        
                       <?php /*?>  <div class="left-box">
                          <label for="name">Branch Name</label>
                          <input type="password" class="validate[required] form-control placeholder" name="password1" id="password1" data-bind="value: name" value="<?php if(isset($args_member['branch_nm'])): echo $args_member['branch_nm']; endif;?>" />
                        </div><?php */?>
                     
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <div class="left-box"> <br />
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                  
                  <!--<script type="text/javascript">
				  
					  // form validation 
					  var frmValidation = new Validator('form1');
					  
					  <?php if(!isset($_GET['pid'])) : ?>
					  frmValidation.addValidation('category_id','dontselect=000');
					  <?php endif; ?>
					  
					  frmValidation.addValidation('name','req','Please enter product name');
					  frmValidation.addValidation('qty','req','Please enter product quantity');
					  frmValidation.addValidation('qty','decimal','Please enter numeric value with deciaml digit in product quantity');
					  frmValidation.addValidation('price','req','Please enter product price');
					  frmValidation.addValidation('price','decimal','Please enter numeric value with deciaml digit in product price');
					  frmValidation.addValidation('discount','req','Please enter product discount');
					  frmValidation.addValidation('discount','decimal','Please enter numeric value with deciaml digit in product discount');
				  	  frmValidation.addValidation('points','req','Please enter points');
					  frmValidation.addValidation('points','decimal','Please enter numeric value with deciaml digit in points');

					  <?php if(!isset($_GET['pid'])) : ?>
					  frmValidation.addValidation('image','file');
					  <?php endif; ?>
					  
					  frmValidation.addValidation('description','req','Please enter product description');
				  
				  </script>-->
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Today status ends --> 
      
      <!-- Dashboard Graph starts --> 
      
      <!-- Dashboard graph ends --> 
      <!-- Chats, File upload and Recent Comments --> 
    </div>
  </div>
  <!-- Matter ends --> 
</div>
<!-- Mainbar ends --> 
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->
<?php include('../footer.php'); ?>
