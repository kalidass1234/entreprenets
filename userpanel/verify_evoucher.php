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
	 getcaptcha1();
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
alert(str);
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
xmlhttp.open("GET","subject1.php?q="+str,true);
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
	include('switch-bar.php');
	
	?>
  <div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
        <h6 align="center" style="color:#0033FF">Welcome <?php echo $_SESSION['SD_User_Name'];?> </h6>
        <div class="widget_wrap ">
          <div class="widget_top" align="center">
            <h6 >Verify E Voucher</h6>
          </div>
          <div class="grid_12 full_block">
            <form method="post" action="" id="form1">
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
                      <td>Enter E Voucher Code</td>
                      <td>:</td>
                      <td><input type="text" name="voucher_code" id="username1" value="" required></td>
                    </tr>
                    <tr>
                      <td width="39%">&nbsp;</td>
                      <td width="19%"><div id="txtHint"></div></td>
                      <td width="42%" class="red">E Voucher Code is case sensitive</td>
                    </tr>
                  </table>
                </div>
                <div class="widget_content">
                  <table width="100%" border="0" class="display">
                    <tr>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="39%">&nbsp;</td>
                      <td width="19%"><button type="button" class="btn_small btn_blue" name="submit1" onClick="showUser(voucher_code.value);">Verify Now</button></td>
                      <td width="42%">&nbsp;</td>
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