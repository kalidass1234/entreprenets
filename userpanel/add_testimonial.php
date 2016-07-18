<?php
session_start();
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);

$pid=$_GET['pid'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$add_by=$_SESSION['SD_User_Name'];
	$user_id=showuserid($add_by);
$res_reg=mysql_fetch_array(mysql_query("SELECT email FROM registration WHERE user_name='$add_by'"));
 $from=$res_reg['email'];
 if(isset($_POST['Show']))
 {	
 		extract($_POST);
 		$add_date=date('Y-m-d');
		$id=$_POST['id'];
		 if(isset($_POST['id']) && $_POST['id']!='')
		 {
		 	$update="update testimonial set heading='$heading',page_content='$message',rating='$rating' where id='$_POST[id]'";
			mysql_query($update);
		 }
		 else
		 {
		 	$insert="insert into testimonial set heading='$heading',page_content='$message',rating='$rating',add_date='$add_date',page_name='$user_id'";
			mysql_query($insert);
			$id=mysql_insert_id();
		 }
		if(isset($_FILES['attachment']))
		{
			
			$arr_file=explode(".",$_FILES['attachment']['name']);
			$ext=end($arr_file);
			$filename=$arr_file[0];
			$file_name=$filename."_".time().".jpg";
			move_uploaded_file($_FILES['attachment']['tmp_name'],"../admin/page_control/".$file_name);
			// end of upload file
			//$file=$_FILES['attachment']['name'];
			$update="update testimonial set page_image='$file_name' where id='$id'";
			mysql_query($update);
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
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
		<h3>Add Testimonial</h3>
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
						<h6 >Add Testimonial</h6>
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
                            
							<?php
                            $sql="select * from testimonial where id='$_REQUEST[id]'";
							$res=mysql_query($sql);
							$row=mysql_fetch_assoc($res);
							
							$user_id=showuserid($_SESSION['SD_User_Name']);
							$res_user=mysql_query("select * from registration where user_id='$user_id'");
							$row_user=mysql_fetch_assoc($res_user);
							$full_name=$row_user['first_name']." ".$row_user['mid_name']." ".$row_user['last_name'];
							?>
								<li >
								<div class="form_grid_12">
									<label class="field_title" >User Full Name</label>
									<div class="form_input" >
										<input name="heading" type="text" tabindex="4" value="<?php echo $full_name;?>" readonly style="width:44%;" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Rating</label>
									<div class="form_input">
										<input type="radio" name="rating" value="1" checked>1
                                        <input type="radio" name="rating" value="2">2
                                        <input type="radio" name="rating" value="3">3
                                        <input type="radio" name="rating" value="4">4
                                        <input type="radio" name="rating" value="5">5
									</div>
								</div>
								</li>
								<li>
									<div class="form_grid_12">
                                        <label class="field_title" >Comment </label>
                                        <div class="form_input" >
                                            <!--<textarea name="message" class="input_grow" cols="50" rows="6" tabindex="5" ></textarea>-->
                                            <textarea id="txt_editor" name="message" cols="50" rows="10" required="required" tabindex="10"><?php echo $row['page_content'];?></textarea>
                                        </div>
									</div>
								</li>
                                <!--<li>
									<div class="form_grid_12">
									<label class="field_title" >Image </label>
									<div class="form_input" >
										<input type="file" name="attachment">
									</div>
								</div>
								</li>-->
								<li >
								<div class="form_grid_12">
									<div class="form_input">
                                    <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
										<button type="submit" class="btn-blu" name="Show"><span>Add</span></button>
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