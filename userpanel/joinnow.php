<?php
error_reporting(0);
include("../includes/all_func.php");
include_once ("header.php");

//echo "<pre>";print_r($_SESSION);
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
$sss="select * from product_category p where p.allow_deal=1 and p.status=0 order by p.p_cat_id desc ";
if (isset($_GET['cid']) && ($_GET['cid']!=''))
{
	$sss="select * from product_category p inner join category_shop  c on p.cat_id=c.c_id where p.allow_deal=1 and  p.cat_id='$_GET[cid]' and p.status=0 order by p.p_cat_id desc ";}
$se_eshop=mysql_query($sss) or die($sss." ".mysql_error());
$nume=mysql_num_rows($se_eshop);
?>
<script type="text/javascript">
function calselect()
{	/*==JQUERY SELECTBOX==*/
	$(".chzn-select").chosen(); 
	$(".chzn-select-deselect").chosen({allow_single_deselect: true});
	/*==JQUERY UNIFORM==*/
}
function showuser(str)
{
if (str!="")
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
	//alert(xmlhttp.responseText);
    document.getElementById("display_user").innerHTML=xmlhttp.responseText;
	calselect();
    }
  }
xmlhttp.open("GET","ajax_checkuser1.php?ref="+str,true);
xmlhttp.send();
  }
}
function showssn(str)
{
if (str!="")
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
	//alert(xmlhttp.responseText);
    document.getElementById("display_ssn").innerHTML=xmlhttp.responseText;
	calselect();
    }
  }
xmlhttp.open("GET","ajax_checkssn.php?ssn="+str,true);
xmlhttp.send();
  }
}
function validate_data()
{
	var fname=document.getElementById("fname").value;
	var lname=document.getElementById("lname").value;
	var day=document.getElementById("day").value;
	var month=document.getElementById("months").value;
	var year=document.getElementById("year").value;
	var address1=document.getElementById("address1").value;
	var address2=document.getElementById("address2").value;
	var city=document.getElementById("city").value;
	var state=document.getElementById("state").value;
	var country=document.getElementById("country").value;
	var zip=document.getElementById("zip").value;
	var email=document.getElementById("email").value;
	var ssn=document.getElementById("ssn").value;
	var mobile=document.getElementById("mobile").value;
	var user_name=document.getElementById("user_name").value;
	var user_pass=document.getElementById("user_pass").value;
	if(fname=='')
	{
		alert("Please Enter Your First Name");
		document.getElementById("fname").focus();
		return false;
	}
	if(lname=='')
	{
		alert("Please Enter Your Last Name");
		document.getElementById("lname").focus();
		return false;
	}
	var dob=year+'-'+month+'-'+day;
	
	var age=getAge(new Date(year, month, day)) ;
	if(parseInt(age)<18)
	{
		alert("Please Select Your Valid Birth Date. Above 18 Year");
		document.getElementById("day").focus();
		return false;
	}
	if(address1=='')
	{
		alert("Please Enter Your Address1");
		document.getElementById("address1").focus();
		return false;
	}
	if(city=='')
	{
		alert("Please Enter Your City");
		document.getElementById("city").focus();
		return false;
	}
	if(state=='')
	{
		alert("Please Enter Your State");
		document.getElementById("state").focus();
		return false;
	}
	if(country=='')
	{
		alert("Please Enter Your Country");
		document.getElementById("country").focus();
		return false;
	}
	if(zip=='')
	{
		alert("Please Enter Your Zip");
		document.getElementById("zip").focus();
		return false;
	}
	if(email=='')
	{
		alert("Please Enter Your EmailId");
		document.getElementById("email").focus();
		return false;
	}
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(document.getElementById('email').value=='' || regex.test(document.getElementById('email').value)==false)
	{
		alert("Please Enter correct Email ID");
		document.getElementById('email').focus();
		return false;
	}
	var TLDs = new Array("ac", "ad", "ae", "aero", "af", "ag", "ai", "al", "am", "an", "ao", "aq", "ar", "arpa", "as", "asia", "at", "au", "aw", "ax", "az", "ba", "bb", "bd", "be", "bf", "bg", "bh", "bi", "biz", "bj", "bm", "bn", "bo", "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cat", "cc", "cd", "cf", "cg", "ch", "ci", "ck", "cl", "cm", "cn", "co", "com", "coop", "cr", "cu", "cv", "cx", "cy", "cz", "de", "dj", "dk", "dm", "do", "dz", "ec", "edu", "ee", "eg", "er", "es", "et", "eu", "fi", "fj", "fk", "fm", "fo", "fr", "ga", "gb", "gd", "ge", "gf", "gg", "gh", "gi", "gl", "gm", "gn", "gov", "gp", "gq", "gr", "gs", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu", "id", "ie", "il", "im", "in", "info", "int", "io", "iq", "ir", "is", "it", "je", "jm", "jo", "jobs", "jp", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "la", "lb", "lc", "li", "lk", "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "me", "mg", "mh", "mil", "mk", "ml", "mm", "mn", "mo", "mobi", "mp", "mq", "mr", "ms", "mt", "mu", "museum", "mv", "mw", "mx", "my", "mz", "na", "name", "nc", "ne", "net", "nf", "ng", "ni", "nl", "no", "np", "nr", "nu", "nz", "om", "org", "pa", "pe", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "pro", "ps", "pt", "pw", "py", "qa", "re", "ro", "rs", "ru", "rw", "sa", "sb", "sc", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl", "sm", "sn", "so", "sr", "st", "su", "sv", "sy", "sz", "tc", "td", "tel", "tf", "tg", "th", "tj", "tk", "tl", "tm", "tn", "to", "tp", "tr", "travel", "tt", "tv", "tw", "tz", "ua", "ug", "uk", "us", "uy", "uz", "va", "vc", "ve", "vg", "vi", "vn", "vu", "wf", "ws", "xn--0zwm56d", "xn--11b5bs3a9aj6g", "xn--3e0b707e", "xn--45brj9c", "xn--80akhbyknj4f", "xn--90a3ac", "xn--9t4b11yi5a", "xn--clchc0ea0b2g2a9gcd", "xn--deba0ad", "xn--fiqs8s", "xn--fiqz9s", "xn--fpcrj9c3d", "xn--fzc2c9e2c", "xn--g6w251d", "xn--gecrj9c", "xn--h2brj9c", "xn--hgbk6aj7f53bba", "xn--hlcj6aya9esc7a", "xn--j6w193g", "xn--jxalpdlp", "xn--kgbechtv", "xn--kprw13d", "xn--kpry57d", "xn--lgbbat1ad8j", "xn--mgbaam7a8h", "xn--mgbayh7gpa", "xn--mgbbh1a71e", "xn--mgbc0a9azcg", "xn--mgberp4a5d4ar", "xn--o3cw4h", "xn--ogbpf8fl", "xn--p1ai", "xn--pgbs0dh", "xn--s9brj9c", "xn--wgbh1c", "xn--wgbl6a", "xn--xkc2al3hye2a", "xn--xkc2dl3a5ee0h", "xn--yfro4i67o", "xn--ygbi2ammx", "xn--zckzah", "xxx", "ye", "yt", "za", "zm", "zw");
		
	if(regex.test(document.getElementById('email').value)==true)
	{
		var ext=document.getElementById('email').value.split('.');
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
	if(user_name=='')
	{
		alert('Please Enter The Valid UserName');
		document.getElementById('user_name').focus();
		return false;
	}
	//alert(document.getElementById("checkuser").innerHTML);
	if(document.getElementById("display_user").innerHTML=="<font color='#f00'>Alredy exists.</font>")
	{
		alert('Please Enter The Valid UserName');
		document.getElementById('user_name').focus();
		return false;
	}
	if(document.getElementById("display_ssn").innerHTML=="<font color='#f00'>Alredy exists.</font>")
	{
		alert('Please Enter The Valid SSN No');
		document.getElementById('ssn').focus();
		return false;
	}
	if(user_pass=='')
	{
		alert('Please Enter The Valid Password');
		document.getElementById('user_pass').focus();
		return false;
	}
}
function getAge(d1, d2)
{
    d2 = d2 || new Date();
    var diff = d2.getTime() - d1.getTime();
    return Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));
}
</script>
<style type="text/css">
.display h3{
margin-top:0.1em;
}
</style>
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
<?php include('left-bar.php');?>
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
		<h3>Register New Member</h3>
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
      <?php
                    $idd=$_SESSION['SD_User_Name'];
					$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_name='$idd'"));
					
					// check category two subscription is available or not
					$sql_subs="select * from subscription where user_id='$idd' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    
					?>
                    <?php
				  if(($res_reg['category_two'] || $res_reg['category_three']) && $count_subs)
				  {
					?>
		
        <div class="grid_12 full_block">
          <div class="widget_content">
					<form id="form1" name="form1" method="post" action="joinnow_submit.php" enctype="multipart/form-data" onSubmit="return validate_data();" >
	  <table width="100%" border="1">
     
      <tr bgcolor="#0099FF">
     <th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Register New Member </th>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
     <td width="20%" height="30" align="right" valign="top">Sponser Id</td>
     <td width="30%" height="30" ><input class="inputs" type="text" placeholder="" name="ref_id" id="ref_id" readonly value="<?php echo showuserid($_SESSION['SD_User_Name']);?>" rquired>&nbsp;&nbsp;</td>
     <td width="20%" height="30" align="right" valign="top" class="txt"><span>Sponser Name</span></td>
     <td width="30%" height="30"><input class="inputs" type="text" placeholder="" name="ref_name" id="ref_name" readonly value="<?php echo $_SESSION['SD_User_Name'];?>" rquired>&nbsp;&nbsp;</td>
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
                       </select></td>
     <td height="30" align="right" valign="top"><span>First Name </span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="fname" id="fname" required></td>
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>Middle Name/Initial</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="mname" id="mname"></td>
     <td height="30" align="right" valign="top"><span>Last Name</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="lname" id="lname" required></td>
     </tr>
     
     
     
     <tr>
     <td height="30" align="right" valign="top"><span>Gender </span></td>
     <td height="30"><input type="radio" name="sex" value="male" checked>Male&nbsp;<input type="radio" name="sex" value="female">Female</td>
     <td height="30" align="right" valign="top"><span>Birth Date</span></td>
     <td height="30"><?php 
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
            </select></td>
     </tr>
     
     <tr>
     <td height="30" align="right" valign="top"><span>Address1</span></td>
     <td height="30" valign="top"><input class="inputs" type="text" placeholder="" name="address1" id="address1" required></td>
     <td height="30" align="right" valign="top"><span>Address2</span></td>
     <td height="30" valign="top"><input class="inputs" type="text" placeholder="" name="address2" id="address2"></td>
     </tr>
     
      <tr>
     <td height="30" align="right" valign="top"><span>City</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="city" id="city" value="<?php echo $row_user['city'];?>" required></td>
     <td height="30" align="right" valign="top"><span>State</span></td>
     <td height="30">
<?php
$sql_state="select * from states";
$res_state=mysql_query($sql_state);
?>
  <select  class="select" name="state" id="state" required>
    <?php
	while($row_state=mysql_fetch_assoc($res_state))
	{
	?>
    <option value="<?php echo $row_state['abbreviation'];?>" <?php if($row_user['state']==$row_state['abbreviation']){ echo "selected";}?>><?php echo $row_state['state'];?></option>
	<?php
    }
    ?>
  </select>
     </td>
     </tr>
     <tr>
     <td height="30" align="right" valign="top"><span>Country</span></td>
     <td height="30"><select name="country" id="country" class="select" required>
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
     <td height="30" align="right" valign="top"><span>Zip</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="zip" id="zip" value="<?php echo $row_user['zip'];?>" required></td>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr bgcolor="#0099FF">
     <th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Personal Information</th>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
     <td height="30" align="right" valign="top"><span>Email Address</span></td>
     <td height="30">
     <input class="inputs" type="text" placeholder="" name="email" id="email" value="" required>         
     </td>
     <td height="30" align="right" valign="top"><span>SSN No</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="ssn" id="ssn" value="" onBlur="showssn(this.value)" required><span id="display_ssn"></span></td>
     </tr>
     <tr>
     <td height="30" align="right" valign="top"><span>Mobile</span></td>
     <td height="30"><input class="inputs" type="text" placeholder="" name="mobile" id="mobile" value="" required></td>
     <td height="30" align="right" valign="top"><span>Upload Image</span></td>
     <td height="30"><input type="file" name="image"></td>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr bgcolor="#0099FF">
     	<th style="line-height:40px; background:#009ea0; color:#fff; text-transform:uppercase;" colspan="4">Login Information</th>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     <tr>
        <td height="30" align="right" valign="top"><span>Username</span></td>
        <td height="30"><input class="inputs" type="text" placeholder="" name="user_name" id="user_name" onBlur="showuser(this.value)" required><span id="display_user"></span></td>
        <td height="30" align="right" valign="top"><span>Password</span></td>
        <td height="30"><input class="inputs" type="password" placeholder="" name="user_pass" id="user_pass" required></td>
     </tr>
     <tr>
         <td height="30" align="center" valign="top" colspan="4"><input type="radio" name="category" value="1" checked>
            Discount Benifit Members
           <input type="radio" name="category" value="2">
            Discount Benifit Members+Residual Income
           <input type="radio" name="category" value="3">
            Affiliated Refferal
         </td>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr> 
     <tr>
       <td colspan="4">&nbsp;</td>
     </tr>
     <tr>
         <td colspan="4" align="center"><input type="submit" value="Registeration!" id="" name="" class="reg-btn"> </td>
     </tr>
     <tr><td colspan="4">&nbsp;</td></tr>
     </table>
	</form>	
		  </div>
        </div>
		<?php
   		}
		else
		{
			echo "<p>You  are not authorize to access this section.<br></p>";
		}
		?>
      <span class="clear"></span></div>
	  <span class="clear"></span> </div>
</div>
</body>
</html>