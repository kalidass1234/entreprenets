<?php
include('../includes/all_func.php');
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
	$str="select * from registration where user_id='$id'";
	$res=mysql_query($str);
	$x=mysql_fetch_array($res);
	$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
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
</head>
<style>
.binary_line1{background: url(images/topline.gif) no-repeat center top;border-top: solid #000 2px;}
</style>
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
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Daily Task</h3>
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
			
			
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Daily Task</h6>
                        <div id="widget_tab">
							<ul>
								<li><a href="weekly_adds.php"><img src="package_img/PREVIOUS STEP.png" height="35" alt="" border="0" /></a></li>
                                <li><a href="weekly_adds_verify.php"><img src="package_img/NEXT STEP.png" height="35" alt="" border="0" /></a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
   <style>
	  .ms-2 li{
	  float:left;
	  padding:10px;
	  margin-left:10px;
	  border:1px solid #ccc;
	  border-radius:5px;
	  }
	 
		  .m_text{
		  font-family:"Trebuchet MS";
		  font-size:14px;
		  font-weight:bold;
		  color:#444;
		  padding:5px;
		  }
		  table.display td input {
height: 30px !important;
padding: 0 5px;
border: #093868 1px solid;
}
.custom_tooltip{
    display: inline;
    position: relative;
}

.custom_tooltip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 70%;
}
		  </style>

<div class="clear"></div>
<style>
.classified_list {
list-style: square;
font-size: 20px;
padding:5px 5px 5px 5px;
margin:0px auto;
}

classified_list:before {
content:"·";
font-size:120px;
vertical-align:middle;
line-height:20px;
}
</style>
<div style="width:50%; float:left">
<ol class="classified_list">
<li><a href="http://trinity.auto-publisher.com/" target="_blank">http://trinity.auto-publisher.com/</a></li>
<li><a href="http://www.aufreeads.com" target="_blank">http://www.aufreeads.com</a></li>
<li><a href="http://www.mais-anuncios.com" target="_blank">http://www.mais-anuncios.com</a></li>
<li><a href="http://www.multiclassificados.com" target="_blank">http://www.multiclassificados.com</a></li>
<li><a href="http://wantedwants.com" target="_blank">http://wantedwants.com</a></li>
<li><a href="http://www.zikbay.com" target="_blank">http://www.zikbay.com</a></li>
<li><a href="http://www.classifiedsgiant.com" target="_blank">http://www.classifiedsgiant.com</a></li>
<li><a href="http://www.freeadsplanet.com" target="_blank">http://www.freeadsplanet.com</a></li>
<li><a href="http://www.postaclassified.com" target="_blank">http://www.postaclassified.com</a></li>
<li><a href="http://www.classifiedsforfree.com/" target="_blank">http://www.classifiedsforfree.com/</a></li>
<li><a href="http://www.classifiedads.com/" target="_blank">http://www.classifiedads.com/</a></li>








<li><a href="http://www.howtobuynow.com/" target="_blank">http://www.howtobuynow.com/</a><br>
</li>
<li><a href="http://www.ensantacruzbolivia.com/" target="_blank"> http://www.ensantacruzbolivia.com/</a><br>
</li>
<li><a href="http://www.classified--free.com/" target="_blank"> http://www.classified--free.com/</a><br>
</li>
<li><a href="http://www.free--classified.com/" target="_blank">http://www.free--classified.com/</a><br>
</li>
<li><a href="http://www.free-classified-ads.info/" target="_blank">http://www.free-classified-ads.info/</a><br>
</li>
<li><a href="http://www.digitaledutools.info/" target="_blank">http://www.digitaledutools.info/</a><br>
</li>

</ol>
</div>
<!--<div style="width:50%; float:right">
<ol class="classified_list" style="float:right">
<li><a href="http://www.zuxxx.com/" target="_blank"> www.zuxxx.com</a><div id="chitikaSelectBeacon0" style="float: left;"></div><br>
</li>
<li><a href="http://www.wantedwants.com/" target="_blank"> www.wantedwants.com</a><br>
</li>
<li><a href="http://www.wafagu.com/" target="_blank"> www.wafagu.com</a><br>
</li>
<li><a href="http://www.usnetads.com/" target="_blank"> www.usnetads.com</a><br>
</li>
<li><a href="http://www.urdulist.com/" target="_blank"> www.urdulist.com</a><br>
</li>
<li><a href="http://www.truprofitsclassifieds.com/" target="_blank"> www.truprofitsclassifieds.com</a><br>
</li>
<li><a href="http://www.todaysfreeclassifieds.com/" target="_blank"> www.todaysfreeclassifieds.com</a><br>
</li>
<li><a href="http://www.sundaysclassifieds.com/" target="_blank"> www.sundaysclassifieds.com</a><br>
</li>
<li><a href="http://www.regional-classifieds.com/" target="_blank"> www.regional-classifieds.com</a><br>
</li>
<li><a href="http://www.pureclassified.com/" target="_blank"> www.pureclassified.com</a><br>
</li>
<li><a href="http://www.postyourclassified.com/" target="_blank"> www.postyourclassified.com</a><br>
</li>
<li><a href="http://www.postings.in//" target="_blank"> www.postings.in/</a><br>
</li>
<li><a href="http://www.porkypost.com/" target="_blank"> www.porkypost.com</a><br>
</li>
<li><a href="http://www.penrithclassifieds.com.au/" target="_blank"> www.penrithclassifieds.com.au</a><br>
</li>
<li><a href="http://www.ozclassifieds.net/" target="_blank"> www.ozclassifieds.net</a><br>
</li>
<li><a href="http://www.myanmarclassifieds.net/" target="_blank"> www.myanmarclassifieds.net</a><br>
</li>
<li><a href="http://www.myadsclassified.com/" target="_blank"> www.myadsclassified.com</a><br>
</li>
<li><a href="http://www.muamat.com/" target="_blank"> www.muamat.com</a><br>
</li>
<li><a href="http://www.mcslist.com/" target="_blank"> www.mcslist.com</a><br>
</li>
<li><a href="http://www.luckyclassified.com/" target="_blank"> www.luckyclassified.com</a><br>
</li>
<li><a href="http://www.kentclassifieds.com/" target="_blank"> www.kentclassifieds.com</a><br>
</li>
<li><a href="http://www.justaroundtown.com/" target="_blank"> www.justaroundtown.com</a><br>
</li>
<li><a href="http://www.jacksonsclassifieds.com/" target="_blank"> www.jacksonsclassifieds.com</a><br>
</li>
<li><a href="http://www.iperads.com/" target="_blank"> www.iperads.com</a><br>
</li>
<li><a href="http://www.iabolish.com/" target="_blank"> www.iabolish.com</a><br>
</li>
<li><a href="http://www.hot-web-ads.com//" target="_blank"> www.hot-web-ads.com/</a><br>
</li>
<li><a href="http://www.hi5freeclassifieds.com/" target="_blank"> www.hi5freeclassifieds.com</a><br>
</li>
<li><a href="http://www.freetoclassifieds.com/" target="_blank"> www.freetoclassifieds.com</a><br>
</li>
<li><a href="http://www.freeclassifiedspost.com/" target="_blank"> www.freeclassifiedspost.com</a><br>
</li>
<li><a href="http://www.fishbuckads.com/" target="_blank"> www.fishbuckads.com</a><br>
</li>
<li><a href="http://www.emiratesclassifiedsads.com/" target="_blank"> www.emiratesclassifiedsads.com</a><br>
</li>
<li><a href="http://www.easylistclassifieds.com/" target="_blank"> www.easylistclassifieds.com</a><br>
</li>
<li><a href="http://www.eastlondonclassified.com/" target="_blank"> www.eastlondonclassified.com</a><br>
</li>
<li><a href="http://www.dciads.ca/" target="_blank"> www.dciads.ca</a><br>
</li>
<li><a href="http://www.craigsautoclassifieds.com/" target="_blank"> www.craigsautoclassifieds.com</a><br>
</li>
<li><a href="http://www.classtize.com/" target="_blank"> www.classtize.com</a><br>
</li>
<li><a href="http://www.classifiedillinoisads.com/" target="_blank"> www.classifiedillinoisads.com/</a><br>
</li>
<li><a href="http://www.bwtelcomclassifieds.net/" target="_blank"> www.bwtelcomclassifieds.net</a><br>
</li>
<li><a href="http://www.buzzari.com/" target="_blank"> www.buzzari.com</a><br>
</li>
<li><a href="http://www.buysell.ph/" target="_blank"> www.buysell.ph</a><br>
</li>
<li><a href="http://www.brandonshopper.com/" target="_blank"> www.brandonshopper.com</a><br>
</li>
<li><a href="http://www.beatyourprice.com/" target="_blank"> www.beatyourprice.com</a><br>
</li>
<li><a href="http://www.bayareaclassifieds.com/" target="_blank"> www.bayareaclassifieds.com</a><br>
</li>
<li><a href="http://www.bakerclassifieds.com/" target="_blank"> www.bakerclassifieds.com</a><br>
</li>
<li><a href="http://www.altclassifieds.com/" target="_blank"> www.altclassifieds.com</a><br>
</li>
<li><a href="http://www.adverts.pk/" target="_blank"> www.adverts.pk</a><br>
</li>
<li><a href="http://www.advertjunky.com/" target="_blank"> www.advertjunky.com</a><br>
</li>
<li><a href="http://www.adireo.com/" target="_blank"> www.adireo.com</a><br>
</li>
<li><a href="http://www.254texasclassifieds.com/" target="_blank"> www.254texasclassifieds.com</a><br>
</li>
<li><a href="http://www.serviceseva.com/" target="_blank">  www.serviceseva.com</a><br>
</li>
</ol>
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
<script>
function setLocation(url)
{
	window.location.href=url;
}
</script>