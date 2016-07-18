<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
$pid=$_GET['pid'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$add_by=$_SESSION['SD_User_Name'];
$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_name='$add_by'"));
 $from=$res_reg['email'];
 $full_name=$res_reg['first_name']." ".$res_reg['mid_name']." ".$res_reg['last_name'];
 if(isset($_POST['Show']))
 {
 /*$ref_id=showuserid($_SESSION['SD_User_Name']);
 $sql="SELECT * FROM registration WHERE ref_id='$ref_id' OR  ref_id=''";
 	if($_POST['user_type']=='free' ){
		$sql.=" AND plan_name=0";
	}
	else if($_POST['user_type']=='vip'){
		$sql.="  AND plan_name!=0";
	}
	
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
	    $addresses[] = $row['email'];
	}
	$to = implode(", ", $addresses);*/
	
	//echo "<pre>"; print_r($_POST); print_r($_FILES);exit;
		if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name']!='')
		{
			$mailto=implode(',',$_POST['email']);
			$subject=$_POST['subject'];
			$msg=$_POST['message'];
			$from_mail='ytbsy@yahoo.com';
			$from_name='Grenature';
			$replyto='ytbsy@yahoo.com';
			// upload file 
			$arr_file=explode(".",$_FILES['attachment']['name']);
			$ext=end($arr_file);
			$filename=$arr_file[0];
			$file_name=$filename."_".time().".".$ext;
			move_uploaded_file($_FILES['attachment']['tmp_name'],"attachfile/".$file_name);
			// end of upload file
			$file = "attachfile/".$file_name;
			//$file=$_FILES['attachment']['name'];
			$file_size = filesize($file);
			$handle = fopen($file, "rb");
			$content = fread($handle, $file_size);
			fclose($handle);
			$content = chunk_split(base64_encode($content));
			$uid = md5(uniqid(time()));
			$name = basename($file);
			$header = "From: ".$from_name." <".$from_mail.">\r\n";
			$header.= "Reply-To: ".$replyto."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
			$msg1= "This is a multi-part message in MIME format.\r\n";
			$msg1.= "--".$uid."\r\n";
			$msg1.= "Content-type:text/plain; charset=iso-8859-1\r\n";
			$msg1.= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$msg1.= $msg."\r\n\r\n";
			$msg1.= "--".$uid."\r\n";
			$msg1.= "Content-Type: application/octet-stream; name=\"".$file_name."\"\r\n"; // use different content types here
			$msg1.= "Content-Transfer-Encoding: base64\r\n";
			$msg1.= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
			$msg1.= $content."\r\n\r\n";
			$msg1.= "--".$uid."--";
			
			$file_size = filesize($file);
			$handle = fopen($file, "rb");
			$content = fread($handle, $file_size);
			fclose($handle);
			$attachment = chunk_split(base64_encode($content));
			//$attachment = chunk_split(base64_encode($pdfDocument));

	/*
	some variables needed for creating the email with attachment
	*/
	$email_subject = $_POST['subject'];
	$message = "Please See Attachment.";
	// a random hash will be necessary to send mixed content
	$separator = md5(time());
	// carriage return type (we use a PHP end of line constant)
	$eol = PHP_EOL;
	// attachment name
	$filename  = "attachfile/".$file_name;

	// main header (multipart mandatory)
	$headers  = "From: ".$property." - V.I.P.".$eol;
	$headers .= "MIME-Version: 1.0".$eol; 
	$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol; 
	$headers .= "Content-Transfer-Encoding: 7bit".$eol;
	$headers .= "This is a MIME encoded message.".$eol.$eol;
	// message
	$headers.= "--".$separator.$eol;
	$headers.= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
	$headers.= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	$headers.= $message.$eol.$eol;
	// attachment
	$headers .= "--".$separator.$eol;
	$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
	$headers .= "Content-Transfer-Encoding: base64".$eol;
	$headers .= "Content-Disposition: attachment".$eol.$eol;
	$headers .= $attachment.$eol.$eol;
	$headers .= "--".$separator."--";		

	// sending the email
	echo mail($mailto, $email_subject, "", $headers);
			//echo mail($mailto, $subject, $msg1, $headers);
			 exit;
		}
		else
		{
			$from='ytbsy@yahoo.com';
			$to=implode(',',$_POST["email"]);
			$subject =  $_POST["subject"]; 
			$message =stripslashes($_POST["message"]);
			$header = "From: Grenature<" .$from. ">\r\n"; 
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-type:text/html; charset=iso-8859-1\r\n";
			$header.= "X-Mailer: PHP/" . phpversion();
			//echo $to;
			//echo $message;exit;
			mail($to, $subject, $message, $header);
		}
	}
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

.form_container ul {

    background:none;!important

    border-top:none;!important

	border-bottom:none;!important

    padding: 15px 15px 15px 10px;

    position: relative;

}

.form_container ul li {

    background:none;!important

    border-top:none;!important

	border-bottom:none;!important

    padding: 15px 15px 15px 10px;

    position: relative;

}

.input_txt{

	width:290px!important;

	height:30px!important;}

	

.input_grow{width:490px!important;

	height:160px!important;}

.form_container ul li label.field_title{

	font-size:16px;

	font-weight:normal;

	margin-left:20px;

	text-transform:capitalize;}

.btn-blu{

	border:none;

	line-height:30px;

	padding:0 20px;

	color:#fff;

	margin-left:170px;

	text-shadow:none;

	font-weight:bold;

	background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */

}

.btn-blu1{

	border:none;

	border-radius:5px;

	line-height:30px;

	padding:0 20px;

	color:#fff;

	text-shadow:none;

	font-weight:bold;

	background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */

}



.btn_30_blue a{

border-radius:10px;

box-shadow:none;

border:none;

background: #62bded; /* Old browsers */
background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */
background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */
}

.btn_30_blue a:hover
{
border:none;
background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */}

.chzn-container-multi .chzn-choices .search-field input{ background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;

    border: 0 none !important;

    box-shadow: none;

    color: #666666;

    font-family: sans-serif;

    font-size: 100%;

    height: 25px;

    margin: 1px 0;

    outline: 0 none;

    padding: 5px;}
	
	
	.sms_quick{margin-right:40px;
}

.sms_quick img{
	}

.sms_quick img:hover{ 
width:94px;
height:94px;
}

</style>
<script>
function change_number(num)
{
	//alert(num);
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
				document.getElementById("multiple_email").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","ajax_multiple_email.php?num="+num,true);
			xmlhttp.send();
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
		<span class="title_icon"><span style="float:left;"><img src="backend-images/mail.png" height="20" width="20" alt="" border="0" /></span></span>
		<h3>Invite by Email</h3>
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
						<h6 >Invite by Email</h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Email</a></li>
								<li><a href="email_search.php">Bulk Email</a></li>
								
							</ul>
						</div>-->
 					</div>
					<div class="widget_content" >
                   
						<div class="oilhold">
   							<form action="" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
                            <!--<li>
							  <div class="form_grid_12">
								<label class="field_title" >Number of Emails</label>
									<div class="form_input" >
										<input name="count_email" type="text" tabindex="1" onBlur="change_number(this.value);"  style="width:44%;" />(Note: If you want to send email to multiple email addresses)
                                    </div>
							  </div>
							</li>-->
							<li id="multiple_email">
							  <div class="form_grid_12">
								<label class="field_title" >Email</label>
								  <div class="form_input" >
										<input name="email[]" type="text" tabindex="1" required style="width:44%;" />
                                   </div>
								</div>
                             
							</li>
								<li >
								<div class="form_grid_12">
									<label class="field_title" >Subject</label>
									<div class="form_input" >
										<input name="subject" type="text" tabindex="4"  style="width:44%;" />
									</div>
								</div>
								</li>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title">Amount</label>
									<div class="form_input">
										<input name="filed01" type="text" tabindex="1" class="" style="width:44%;" />
										
									</div>
								</div>
								</li>-->
								<li>
									<div class="form_grid_12">
                                        <label class="field_title" >Message </label>
                                        <div class="form_input" >
                                            <!--<textarea name="message" class="input_grow" cols="50" rows="6" tabindex="5" ></textarea>-->
                                            <textarea id="txt_editor" name="message" cols="50" rows="10" required="required" tabindex="10"><?php echo  $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src='".$host_name."/images/trinity-logo.gif'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>Hi,</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
    
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'><strong>Congratulation you been Invited to join Vision Team Network Inc,to a wonderful Business Opportunity If you looking for a financial freedom</strong>.
 
</p></td>
        <td>&nbsp;</td>
      </tr>
      
      
      <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>Hi this is $full_name I run in to this wonderful business opportunity that I got involve in so I was thinking about you  maybe you may want to make some extra cash their no buying or to resale any products. You can benefit amazing discount from this company and also make a lot of money. I have attach  the compensation plan files so you can read about it and also you can make copy to show your associate partners if you decided to refer your friend and family members to join your network</p></td>
        <td height='130'>&nbsp;</td>
      </tr>
	  <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'></p></td>
        <td height='130'>&nbsp;</td>
      </tr>
	  <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'></p></td>
        <td height='130'>&nbsp;</td>
      </tr>
	   <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>I was like ok tell me more so he got my attention for a few minutes so I can hear what he had to say after he explain the business plan to me I said I was in this good friend of mind became my best friend because he was in my best interest It like he knew I needed some extra income believe it this is my best investment I ever make in my life sometime is good to explore other options in life so to tell you the truth this change my life so much success doesn’t  happen by accident .

so this is the link to my business website I hope it can change your life as it change my. after your watch this video you can join me as a partner so we can help our friends and family to save money and make money if you like to come to our presentation to learn more please call me at 1- 215-307-9519 to register seats are limited ask for Mike Lauture we have meeting on every Thursdays at 6:30pm and Sundays 4:00pm At my television studio 1135 west Cheltenham avenue suite 8 Melrose park pa 19027</p></td>
        <td height='130'>&nbsp;</td>
      </tr>
	  <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>if you have any question feel free to call me 215-307-9519 so I can answer any questions you want. become my partner so we can make a lot of money together thanks after you go over the files if you decided to join my network call me so I can show you how to enroll so you can become an associate member</p></td>
        <td height='130'>&nbsp;</td>
      </tr>
	  <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>To joins as partner please visit <a href='".$host_name."/$add_by'>".$host_name."/$add_by</a> and click on join now</p></td>
        <td height='130'>&nbsp;</td>
      </tr>
	  <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>if you feel this business opportunity not for you to join me as partner please support me by forwarding this email to your friend and family thank you for taking the time to read this testimonies thank you once again</p></td>
        <td height='130'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>$COMPANY Admin</p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    </div>
  </div>
 
</div>

</body>
</html>";?></textarea>
                                        </div>
									</div>
								</li>
                               <!-- <li>
									<div class="form_grid_12">
									<label class="field_title" >Attachment </label>
									<div class="form_input" >
										<input type="file" name="attachment">
									</div>
								</div>
								</li>-->
								<li >
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn-blu" name="Show"><span>SEND</span></button>
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
		<span class="clear"></span>
	</div>
</div>
</body>
</html>