<?php
session_start();
include("controller/connection.php");
$id=$_SESSION['adid'];
$name=$_REQUEST['name'];
$sql="select * from registration where user_id='$id'";
$res=mysql_query($sql);
$x=mysql_fetch_array($res);
$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to Wealth Managers Investment Group</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="fos" name="fos" method="post" action="updateprofilecode.php" onsubmit="return formSumit();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="4%"><img src="images/left-btn.jpg" width="40" height="93" /></td>
            <td width="68%"><img src="images/logo.jpg" width="621" height="93" /></td>
            <td width="28%"><img src="images/icon-call.jpg" width="279" height="93" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top"><?php include('include/header.php');?></td>
          </tr>
          <tr>
            <td align="left" valign="top"><img src="images/top-strip.jpg" width="980" height="3" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="table-bg"><table width="980" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" width="57"><img src="images/left-patern.jpg" width="40" height="266" /></td>
            <td align="left" valign="top" width="900"><table width="900" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><img src="images/banner1.jpg" width="868" height="227" /></td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top" width="18">&nbsp;</td>
                <td align="left" valign="top" width="868"><table width="868" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="604" rowspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="top" class="login-text">Welcome to Wealth Managers Investment Group</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                          <tr>
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td background="images/bg_new.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="84%" height="25">&nbsp;</td>
                                    <td width="16%" class="links"><a href="home.php">Back To User Panel</a></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="center" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="41%" valign="middle" class="title">&nbsp;<span class="login-text">&nbsp;..... <strong class="title">&nbsp;&nbsp;</strong>WELCOME TO</span><strong class="title">
                            <?=$name?> 
                            </strong></td>
                            <td width="21%" valign="top">&nbsp;</td>
                            <td width="38%" valign="middle"><span class="head">User ID:</span><span class="title"><?php echo $id;?></span></td>
                          </tr>
                          <tr>
                            <td colspan="3" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3" align="center" valign="top"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="para">
                              <tr>
                                <td colspan="3" height="26" align="left" class="login-text">Update Profile </td>
                              </tr>
                              <tr>
                                <td colspan="3" height="26" align="left" class="para"><strong>Sponser Information </strong></td>
                              </tr>
                              <tr>
                                <td colspan="3" align="right" class="para">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="177" align="left" class="para">Sponser ID :  * </td>
                                <td width="200" align="left"><?php echo $x['ref_id'];?></td>
                                <td width="353" align="left" id="sid">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Selected Plan :* </td>
                                <td colspan="2" align="left"><?php echo $x['plan_name'];?></td>
                              </tr>
                              
                              <tr>
                                <td width="177" align="left" class="para">Position : *</td>
                                <td colspan="2" align="left"><?php echo $x['binary_pos'];?></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="26" align="left" class="para"><strong>Personal Information </strong></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Title :</td>
                                <td colspan="2" align="left" class="para">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="177" align="left" class="para">First Name:* </td>
                                <td colspan="2" align="left"><?php echo $x['first_name'];?>                                </td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Middle Name: </td>
                                <td colspan="2" align="left"><?php echo $x['mid_name'];?></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Last Name: </td>
                                <td colspan="2" align="left"><?php echo $x['last_name'];?></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Age:</td>
                                <td colspan="2" align="left"><input name="age" type="text" id="age" value="<? echo $x['age'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Date of Birth:* </td>
                                <td colspan="2" align="left"><select name="dd">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
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
                                    <select name="mm">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                    </select>
                                    <select name="yy">
                                      <option value="1944">1944</option>
                                      <option value="1945">1945</option>
                                      <option value="1946">1946</option>
                                      <option value="1947">1947</option>
                                      <option value="1948">1948</option>
                                      <option value="1949">1949</option>
                                      <option value="1950">1950</option>
                                      <option value="1951">1951</option>
                                      <option value="1952">1952</option>
                                      <option value="1953">1953</option>
                                      <option value="1954">1954</option>
                                      <option value="1955">1955</option>
                                      <option value="1956">1956</option>
                                      <option value="1957">1957</option>
                                      <option value="1958">1958</option>
                                      <option value="1959">1959</option>
                                      <option value="1960">1960</option>
                                      <option value="1961">1961</option>
                                      <option value="1962">1962</option>
                                      <option value="1963">1963</option>
                                      <option value="1964">1964</option>
                                      <option value="1965">1965</option>
                                      <option value="1966">1966</option>
                                      <option value="1967">1967</option>
                                      <option value="1968">1968</option>
                                      <option value="1969">1969</option>
                                      <option value="1970">1970</option>
                                      <option value="1971">1971</option>
                                      <option value="1972">1972</option>
                                      <option value="1973">1973</option>
                                      <option value="1974">1974</option>
                                      <option value="1975">1975</option>
                                      <option value="1976">1976</option>
                                      <option value="1977">1977</option>
                                      <option value="1978">1978</option>
                                      <option value="1979">1979</option>
                                      <option value="1980">1980</option>
                                      <option value="1981">1981</option>
                                      <option value="1982">1982</option>
                                      <option value="1983">1983</option>
                                      <option value="1984">1984</option>
                                      <option value="1985">1985</option>
                                      <option value="1986">1986</option>
                                      <option value="1987">1987</option>
                                      <option value="1988">1988</option>
                                      <option value="1989">1989</option>
                                      <option value="1990">1990</option>
                                      <option value="1991">1991</option>
                                    </select>                                </td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Father Name :*</td>
                                <td colspan="2" align="left"><input name="father_name" type="text" id="dob2" value="<? echo $x['fathr_nme'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Marital Status :</td>
                                <td colspan="2" align="left"><input name="sex" type="radio"  value="single" />
                                  Single
                                  <input name="sex" type="radio"  value="married" />
                                  Married </td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Gender :</td>
                                <td colspan="2" align="left"><input name="gender" type="radio"  value="Male" />
                                  Male
                                  <input name="gender" type="radio"  value="Female" />
                                  Female</td>
                              </tr>
                              <tr>
                                <td colspan="3" height="26" align="left" class="para"><strong>Contact Information </strong></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Address :*</td>
                                <td colspan="2" align="left"><textarea name="address" cols="32" rows="3"><? echo $x['address'];?></textarea></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Country :*</td>
                                <td colspan="2" align="left"><select name="country" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$ContactInfo1$ddlCountry\',\'\')', 0)" id="ctl00_ContentPlaceHolder1_ContactInfo1_ddlCountry" class="ControlDropDown">
                                  <option value="0">Please Select</option>
                                  <option value="AF">AFGHANISTAN</option>
                                  <option value="AL">ALBANIA</option>
                                  <option value="DZ">ALGERIA</option>
                                  <option value="AS">AMERICAN SAMOA</option>
                                  <option value="AD">ANDORRA</option>
                                  <option value="AO">ANGOLA</option>
                                  <option value="AI">ANGUILLA</option>
                                  <option value="AQ">ANTARCTICA</option>
                                  <option value="AR">ARGENTINA</option>
                                  <option value="AM">AMENIA</option>
                                  <option value="AW">ARUBA</option>
                                  <option value="AU">AUSTRALIA</option>
                                  <option value="AT">AUSTRIA</option>
                                  <option value="AZ">AZERBAIJAN</option>
                                  <option value="BS">BAHAMAS</option>
                                  <option value="BH">BAHRAIN</option>
                                  <option value="BD">BANGLADESH</option>
                                  <option value="BB">BARBADOS</option>
                                  <option value="BY">BELARUS</option>
                                  <option value="BE">BELGIUM</option>
                                  <option value="BZ">BELIZE</option>
                                  <option value="BJ">BENIN</option>
                                  <option value="BM">BERMUDA</option>
                                  <option value="BT">BHUTAN</option>
                                  <option value="BO">BOLIVIA</option>
                                  <option value="BA">BOSNIA</option>
                                  <option value="BW">BOTSWANA</option>
                                  <option value="BV">BOUVET ISLAND</option>
                                  <option value="BR">BRAZIL</option>
                                  <option value="BG">BULGARIA</option>
                                  <option value="BF">BURKINA FASO</option>
                                  <option value="BI">BURUNDI</option>
                                  <option value="KH">CAMBODIA</option>
                                  <option value="CM">CAMEROON</option>
                                  <option value="CA">CANADA</option>
                                  <option value="CV">CAPE VERDE</option>
                                  <option value="KY">CAYMAN ISLANDS</option>
                                  <option value="CF">CENTRAL AFRICA</option>
                                  <option value="TD">CHAD</option>
                                  <option value="CL">CHILE</option>
                                  <option value="CN">CHINA</option>
                                  <option value="CC">COCOS</option>
                                  <option value="CO">COLOMBIA</option>
                                  <option value="KM">COMOROS</option>
                                  <option value="CG">CONGO</option>
                                  <option value="CK">COOK ISLANDS</option>
                                  <option value="CR">COSTA RICA</option>
                                  <option value="CI">COTE D'IVOIRE</option>
                                  <option value="HR">CROATIA</option>
                                  <option value="CU">CUBA</option>
                                  <option value="CY">CYPRUS</option>
                                  <option value="CZ">CZECH REPUBLIC</option>
                                  <option value="DK">DENMARK</option>
                                  <option value="DJ">DJIBOUTI</option>
                                  <option value="DM">DOMINICA</option>
                                  <option value="DO">DOMINICAN REPUBLIC</option>
                                  <option value="EC">ECUADOR</option>
                                  <option value="EG">EGYPT</option>
                                  <option value="SV">EL SALVADOR</option>
                                  <option value="GQ">EQUATORIAL GUINEA</option>
                                  <option value="ER">ERITREA</option>
                                  <option value="EE">ESTONIA</option>
                                  <option value="ET">ETHIOPIA</option>
                                  <option value="FK">FALKLAND ISLANDS</option>
                                  <option value="FO">FAROE ISLANDS</option>
                                  <option value="FJ">FIJI</option>
                                  <option value="FI">FINLAND</option>
                                  <option value="FR">FRANCE</option>
                                  <option value="FX">FRANCE, METROPOLITAN</option>
                                  <option value="GF">FRENCH GUIANA</option>
                                  <option value="PF">FRENCH POLYNESIA</option>
                                  <option value="TF">FRENCH TERRITORIES</option>
                                  <option value="GA">GABON</option>
                                  <option value="GM">GAMBIA</option>
                                  <option value="GE">GEORGIA</option>
                                  <option value="DE">GERMANY</option>
                                  <option value="GH">GHANA</option>
                                  <option value="GI">GIBRALTAR</option>
                                  <option value="GR">GREECE</option>
                                  <option value="GL">GREENLAND</option>
                                  <option value="GD">GRENADA</option>
                                  <option value="GP">GUADELOUPE</option>
                                  <option value="GU">GUAM</option>
                                  <option value="GT">GUATEMALA</option>
                                  <option value="GN">GUINEA</option>
                                  <option value="GW">GUINEA-BISSAU</option>
                                  <option value="GY">GUYANA</option>
                                  <option value="HT">HAITI</option>
                                  <option value="HN">HONDURAS</option>
                                  <option value="HK">HONG KONG</option>
                                  <option value="HU">HUNGARY</option>
                                  <option value="IS">ICELAND</option>
                                  <option selected="selected" value="IN">INDIA</option>
                                  <option value="ID">INDONESIA</option>
                                  <option value="IR">IRAN</option>
                                  <option value="IQ">IRAQ</option>
                                  <option value="IE">IRELAND</option>
                                  <option value="IL">ISRAEL</option>
                                  <option value="IT">ITALY</option>
                                  <option value="JM">JAMAICA</option>
                                  <option value="JP">JAPAN</option>
                                  <option value="JO">JORDAN</option>
                                  <option value="KZ">KAZAKHSTAN</option>
                                  <option value="KE">KENYA</option>
                                  <option value="KI">KIRIBATI</option>
                                  <option value="KP">KOREA</option>
                                  <option value="KW">KUWAIT</option>
                                  <option value="KG">KYRGYZSTAN</option>
                                  <option value="LV">LATVIA</option>
                                  <option value="LB">LEBANON</option>
                                  <option value="LS">LESOTHO</option>
                                  <option value="LR">LIBERIA</option>
                                  <option value="LY">LIBYAN</option>
                                  <option value="LI">LIECHTENSTEIN</option>
                                  <option value="LT">LITHUANIA</option>
                                  <option value="LU">LUXEMBOURG</option>
                                  <option value="MO">MACAU</option>
                                  <option value="MG">MADAGASCAR</option>
                                  <option value="MW">MALAWI</option>
                                  <option value="MY">MALAYSIA</option>
                                  <option value="MV">MALDIVES</option>
                                  <option value="ML">MALI</option>
                                  <option value="MT">MALTA</option>
                                  <option value="MH">MARSHALL ISLANDS</option>
                                  <option value="MQ">MARTINIQUE</option>
                                  <option value="MR">MAURITANIA</option>
                                  <option value="MU">MAURITIUS</option>
                                  <option value="YT">MAYOTTE</option>
                                  <option value="MX">MEXICO</option>
                                  <option value="MC">MONACO</option>
                                  <option value="MN">MONGOLIA</option>
                                  <option value="MS">MONTSERRAT</option>
                                  <option value="MA">MOROCCO</option>
                                  <option value="MZ">MOZAMBIQUE</option>
                                  <option value="MM">MYANMAR</option>
                                  <option value="NA">NAMIBIA</option>
                                  <option value="NR">NAURU</option>
                                  <option value="NP">NEPAL</option>
                                  <option value="NL">NETHERLANDS</option>
                                  <option value="AN">NETHERLANDS ANTILLES</option>
                                  <option value="NC">NEW CALEDONIA</option>
                                  <option value="NZ">NEW ZEALAND</option>
                                  <option value="NI">NICARAGUA</option>
                                  <option value="NE">NIGER</option>
                                  <option value="NG">NIGERIA</option>
                                  <option value="NU">NIUE</option>
                                  <option value="NF">NORFOLK ISLAND</option>
                                  <option value="NO">NORWAY</option>
                                  <option value="OM">OMAN</option>
                                  <option value="PK">PAKISTAN</option>
                                  <option value="PW">PALAU</option>
                                  <option value="PA">PANAMA</option>
                                  <option value="PG">PAPUA NEW GUINEA</option>
                                  <option value="PY">PARAGUAY</option>
                                  <option value="PE">PERU</option>
                                  <option value="PH">PHILIPPINES</option>
                                  <option value="PN">PITCAIRN</option>
                                  <option value="PL">POLAND</option>
                                  <option value="PT">PORTUGAL</option>
                                  <option value="PR">PUERTO RICO</option>
                                  <option value="QA">QATAR</option>
                                  <option value="RE">REUNION</option>
                                  <option value="RO">ROMANIA</option>
                                  <option value="RU">RUSSIAN FEDERATION</option>
                                  <option value="RW">RWANDA</option>
                                  <option value="SH">SAINT HELENA</option>
                                  <option value="KN">SAINT KITTS AND NEVIS</option>
                                  <option value="LC">SAINT LUCIA</option>
                                  <option value="WS">SAMOA</option>
                                  <option value="SM">SAN MARINO</option>
                                  <option value="ST">SAO TOME AND PRINCIPE</option>
                                  <option value="SA">SAUDI ARABIA</option>
                                  <option value="SN">SENEGAL</option>
                                  <option value="SC">SEYCHELLES</option>
                                  <option value="SL">SIERRA LEONE</option>
                                  <option value="SG">SINGAPORE</option>
                                  <option value="SK">SLOVAKIA</option>
                                  <option value="SI">SLOVENIA</option>
                                  <option value="SB">SOLOMON ISLANDS</option>
                                  <option value="SO">SOMALIA</option>
                                  <option value="ZA">SOUTH AFRICA</option>
                                  <option value="ES">SPAIN</option>
                                  <option value="LK">SRI LANKA</option>
                                  <option value="SD">SUDAN</option>
                                  <option value="SR">SURINAME</option>
                                  <option value="SZ">SWAZILAND</option>
                                  <option value="SE">SWEDEN</option>
                                  <option value="CH">SWITZERLAND</option>
                                  <option value="SY">SYRIAN ARAB REPUBLIC</option>
                                  <option value="TW">TAIWAN</option>
                                  <option value="TJ">TAJIKISTAN</option>
                                  <option value="TZ">TANZANIA</option>
                                  <option value="TH">THAILAND</option>
                                  <option value="TG">TOGO</option>
                                  <option value="TK">TOKELAU</option>
                                  <option value="TO">TONGA</option>
                                  <option value="TT">TRINIDAD AND TOBAGO</option>
                                  <option value="TN">TUNISIA</option>
                                  <option value="TR">TURKEY</option>
                                  <option value="TM">TURKMENISTAN</option>
                                  <option value="TV">TUVALU</option>
                                  <option value="UG">UGANDA</option>
                                  <option value="UA">UKRAINE</option>
                                  <option value="AE">UNITED ARAB EMIRATES</option>
                                  <option value="GB">UNITED KINGDOM</option>
                                  <option value="US">UNITED STATES</option>
                                  <option value="UY">URUGUAY</option>
                                  <option value="UZ">UZBEKISTAN</option>
                                  <option value="VU">VANUATU</option>
                                  <option value="VE">VENEZUELA</option>
                                  <option value="VN">VIET NAM</option>
                                  <option value="EH">WESTERN SAHARA</option>
                                  <option value="YE">YEMEN</option>
                                  <option value="YU">YUGOSLAVIA</option>
                                  <option value="ZR">ZAIRE</option>
                                  <option value="ZM">ZAMBIA</option>
                                  <option value="ZW">ZIMBABWE</option>
                                </select></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">State :</td>
                                <td colspan="2" align="left" class="Policy1">
                                  <select name="state" onchange="getCities() " class="DropDown">
                                    <option value="<? echo $x['state'];?>">&lt;? echo $x['state'];?&gt;</option>
                                    <option value="AN">ANDAMAN AND NICOBAR</option>
                                    <option value="AP">ANDHRA PRADESH</option>
                                    <option value="AR">ARUNACHAL PRADESH</option>
                                    <option value="AS">ASSAM</option>
                                    <option value="BH">BIHAR</option>
                                    <option value="CH">CHANDIGARH</option>
                                    <option value="CG">CHATTISGARH</option>
                                    <option value="DN">DADAR &amp; NAGAR HAVELI</option>
                                    <option value="DD">DAMAN &amp; DIU</option>
                                    <option value="DL">DELHI</option>
                                    <option value="GA">GOA</option>
                                    <option value="GJ">GUJARAT</option>
                                    <option value="HR">HARYANA</option>
                                    <option value="HP">HIMACHAL PRADESH</option>
                                    <option value="JK">JAMMU &amp; KASHMIR</option>
                                    <option value="JH">JHARKHAND</option>
                                    <option value="KA">KARNATAKA</option>
                                    <option value="KL">KERALA</option>
                                    <option value="MP">MADHYA PRADESH</option>
                                    <option value="MH">MAHARASHTRA</option>
                                    <option value="MA">MANIPUR</option>
                                    <option value="ML">MEGHALAYA</option>
                                    <option value="MZ">MIZORAM</option>
                                    <option value="NG">NAGALAND</option>
                                    <option value="OR">ORISSA</option>
                                    <option value="PY">PONDICHERRY</option>
                                    <option value="PB">PUNJAB</option>
                                    <option value="RJ">RAJASTHAN</option>
                                    <option value="SK">SIKKIM</option>
                                    <option value="TN">TAMIL NADU</option>
                                    <option value="TR">TRIPURA</option>
                                    <option value="UP">UTTAR PRADESH</option>
                                    <option value="UC">UTTARANCHAL</option>
                                    <option value="WB">WEST BENGAL</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td align="left" class="para">City :*</td>
                                <td colspan="2" align="left"><input name="city" type="text" id="city" value="<? echo $x['city'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Pin Code :*</td>
                                <td colspan="2" align="left"><input name="pincode" type="text" id="Pin-Code" value="<? echo $x['pin_no'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Phone Number (R) :</td>
                                <td colspan="2" align="left"><input name="phoner" type="text" id="dob24" value="<? echo $x['phoner'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Phone Number (O) :</td>
                                <td colspan="2" align="left"><input name="phoneo" type="text" id="dob25" value="<? echo $x['phoneo'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Mobile :*</td>
                                <td colspan="2" align="left"><input name="email2" type="text" id="email" value="<? echo $x['mobile'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Email :</td>
                                <td colspan="2" align="left"><input name="email" type="text" id="dob27" value="<? echo $x['email'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="26" align="left" class="para"><strong>Nominee Information </strong></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Nominee Name :*</td>
                                <td colspan="2" align="left"><input name="nominee" type="text" id="dob273" value="<? echo $x['nominee'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Nominee Age:*</td>
                                <td colspan="2" align="left"><input name="nominee_age" type="text" id="dob273" value="<? echo $x['nage'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Relation With Applicant :*</td>
                                <td colspan="2" align="left"><select name="txtrel">
                                    <option value="<? echo $x['relation'];?>"><? echo $x['relation'];?></option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Husband">Husband</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Son">Son</option>
                                    <option value="Company">Company</option>
                                </select></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="26" align="left" class="para"><strong>Bank Information </strong></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Bank Name :</td>
                                <td colspan="2" align="left"><input name="txtbanknm" type="text" id="dob2732" value="<? echo $x['bank_nm'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Branch Name :</td>
                                <td colspan="2" align="left"><input name="txtbranchnm" type="text" id="dob2733" value="<? echo $x['branch_nm'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Account Holder Number :</td>
                                <td colspan="2" align="left"><input name="txtacno" type="text" id="dob2734" value="<? echo $x['ac_no'];?>" size="32" /></td>
                              </tr>
                              <tr>
                                <td align="left" class="para">Pan Number :</td>
                                <td colspan="2" align="left"><input name="pan" type="text" id="dob2736" value="<? echo $x['pan_no'];?>" size="32" /></td>
                              </tr>
                              
                              
                              
                              <tr>
                                <td align="left" class="para">&nbsp;</td>
                                <td colspan="2" align="left">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><input name="Submit" type="submit" class="button-bg" value="  Save  " /></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="3" valign="top" class="para">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3" valign="top">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>                  </tr>
                  
                  <tr>
                    <td align="left" valign="top" width="11">&nbsp;</td>
                  </tr>
                  
                </table></td>
                <td align="left" valign="top" width="18">&nbsp;</td>
              </tr>
              
            </table></td>
            <td align="left" valign="top" width="67"><img src="images/right-patern.jpg" width="40" height="266" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="footer-bg"><table width="980" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top" width="57">&nbsp;</td>
            <td align="left" valign="top" width="900"><?php include('include/footer.php');?></td>
            <td align="left" valign="top" width="67">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
