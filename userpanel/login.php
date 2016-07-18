<script>
window.location.href='../login.php';
</script>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>:: VTN User Admin ::</title>
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
<script type="text/javascript">
$(function(){
	$(window).resize(function(){
		$('.login_container').css({
			position:'absolute',
			left: ($(window).width() - $('.login_container').outerWidth())/2,
			top: ($(window).height() - $('.login_container').outerHeight())/2
		});
	});
	// To initially run the function:
	$(window).resize();
});
$(document).ready(function(){
$('#loginform').submit(function(){
	if($('#username').val()=='' || $('#username').val()=='username')
	{
		alert('Please Input Username');
		$('#username').focus();	
		return false;
	}
	if($('#password').val()=='' || $('#password').val()=='password')
	{
		alert('Please Input Password');
		$('#password').focus();
		return false;	
	}
});
});
</script>
</head>
<body id="theme-default" class="full_block" style="background-color: #f2f2f2!important;">
<div id="login_page" >
	<div class="login_container">
		<div class="login_header">
			<ul class="login_branding">
				<li>
				<div class="logo_small">
					<img src="../img/logo.png" width="99" height="35" alt="bingo">
				</div>
				<!--<span>All Purpose Responsive Admin Template</span>-->
				</li>
				<li class="right go_to"><a href="../index.php" title="Go to Main Site" class="home">Go To Main Site</a></li>
			</ul>
		</div>
		<div class="block_container blue_d">
			<form action="login_check.php" name="loginform" id="loginform" method="post">
				<div class="block_form">
					<ul>
						<li class="login_user">
						<input name="username" id="username" onFocus="if(this.value=='username'){ this.value='';}" onBlur="if(this.value==''){ this.value='username';}" placeholder="username" value="<?php if(isset($_COOKIE['remember_me'])) {echo $_COOKIE['remember_me'];} else { echo "username";} ?>" type="text">
						</li>
						<li class="login_pass">
						<input name="password" id="password" type="password" value="<?php if(isset($_COOKIE['rememberpass_me'])) {echo $_COOKIE['rememberpass_me'];} else { echo "password";} ?>" onFocus="if(this.value=='password'){ this.value='';}"  onblur="if(this.value==''){ this.value='password';}" placeholder="password">
						</li>
					</ul>
					<input class="login_btn blue_lgel" name="login" value="Login" type="submit">
				</div>
				<ul class="login_opt_link">
					<li><a href="../forgot_password.php">Forgot Password?</a></li>
					<li class="remember_me right">
					<input name="remme" class="rem_me" <?php if(isset($_COOKIE['remember_me'])) { echo 'checked="checked"';	} else { echo ''; }	?> type="checkbox" value="checked">
					Remember Me</li>
				</ul>
			</form>
		</div>
	</div>
</div>
</body>
</html>