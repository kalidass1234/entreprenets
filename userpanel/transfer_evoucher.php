<?php
include('../includes/all_func.php');
include('header.php'); 

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
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
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
	if(jQuery('#username1').val()=='' || jQuery('#username1').val()=='Please enter no of E Vouchers')
	{
		alert("Please enter no of E Vouchers");
		jQuery('#username1').focus();
		return false;
	}
	if(jQuery('#password1').val()=='' || jQuery('#password1').val()=='Enter New Password')
	{
		alert("Please enter the username");
		jQuery('#password1').focus();
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
	// getcaptcha1();
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
	</script>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
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
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","subject.php?q="+str,true);
xmlhttp.send();
}
</script>
<style type="text/css">
table.display td input[type=submit] {
	height: 30px !important;
	padding: 0 5px;
	border: #093868 1px solid;
}
</style>
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
	//include('switch-bar.php');
	
	?>
  <div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
        <h6 align="center" style="color:#0033FF">Welcome <?php echo $_SESSION['SD_User_Name'];?> </h6>
        <div class="widget_wrap ">
          <div class="widget_top" align="center">
            <h6 >Transfer E Vouchers</h6>
          </div>
          <div class="grid_12 full_block">
            <form method="post" action="pin_transfer_func.php" id="form1">
              <div class="widget_wrap ">
                <div class="widget_content">
                <?php
				  $user_id=showuserid($_SESSION['SD_User_Name']);
				  $sql_subs="select * from subscription where user_id='$user_id' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?>
                  <table width="100%" border="0" class="display">
                    <tr>
                      <td>Number Of E Vouchers</td>
                      <td>:</td>
                      <td><input type="text" name="pin" id="username1" value=""  autocomplete="off" onpaste="return false;" oncopy="return false;" oncut="return false;" onKeyPress="if(isNaN(this.value)){ this.value='';}" onBlur="if(isNaN(this.value)){ this.value='';}"></td>
                      <td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                      <td width="39%">User Name to transfer to</td>
                      <td width="19%">:</td>
                      <td width="42%"><input type="text" name="loginid" id="password1" onChange="showUser(this.value);">
                      <span id="txtHint"></span></td>
                      <td>&nbsp;</td>
                    </tr>
                     <?php 
				   $sql_pin="select distinct amount from pins where status=0  order by amount asc";
				   $res_pin=mysql_query($sql_pin);
				   ?>
                    <tr>
                      <td width="39%">E Voucher Type</td>
                      <td width="19%">:</td>
                      <td width="42%">
                      <select name="amt" required>
                      	 <?php
                      while($row_pin=mysql_fetch_assoc($res_pin))
					  {
					  ?>
                      	<option value="<?php echo $row_pin['amount'];?>"><?php echo $row_pin['amount'];?></option>
                      <?php 
					  }
					  ?> 
                      </select>
                     </td>
                        <td>&nbsp;</td>
                    </tr>
                  </table>
                </div>
                <div class="widget_content">
                  <table width="100%" border="0" class="display">
                    <tr>
                      <td colspan="4">&nbsp;</td>
                    </tr>
                   
                    <tr>
                      <td>&nbsp;</td>
                      <td>Enter Transaction Pin:</td>
                      <td><input type="password" name="tcode" id="tcode" onpaste="return false;" autocomplete="off"  oncopy="return false;" oncut="return false;"></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="button" class="btn_small btn_blue" name="submit1" onClick="validate11();">Update</button></td>
                      <td>&nbsp;</td>
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