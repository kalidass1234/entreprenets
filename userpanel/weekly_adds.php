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
								   <li><a href="next_step.php"><img src="package_img/NEXT STEP.png" height="35" alt="" border="0" /></a></li>
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
          <?php


//echo $query;
						/*if(mysql_num_rows($result)>0)
						{*/
						?>
          <?php
			// check the member upgrade to affiliate aor not
			$sql_check="select * from  registration where user_id='".USERID."' and reseller=1";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check)
			{	
              
                ?>		
                      <div class="gall_wrap" style="height:auto;">
                      <dl class="group filter_bar">
								<dt>Filter:</dt>
								<dd>
								<ul class="filter group">
									
									<li class="hair"><a href="#">Verified</a></li>
									<li class="onfire"><a href="#">Pending</a></li>
									
								</ul>
								</dd>
                                
							</dl>
							<ul class="portfolio group">
							<?php
							$query=" SELECT * from weekly_adds_mp where user_id='".USERID."' order by status asc";
//echo $query;				
$result=mysql_query($query);
							$s=1;
							while($row=mysql_fetch_assoc($result))
							{
							//echo "<pre>"; print_r($row);
								// find the product detail from product table
								$product_id=$row['product_id'];
								$sql1="select * from product_category where p_cat_id='$product_id'";
								$res1=mysql_query($sql1);
								$row1=mysql_fetch_assoc($res1);
								$image=$row1['image'];
								if($image!='' && file_exists("../product_logos/".$image))
								{
									$image1="../product_logos/".$image;
								}
								else
								{
									$image1="../product_logos/nv.jpg";
								}
							?>
                            <form method="post" action="cart.php">
								<li class="item" data-id="id-1" <?php if($row['status']){ ?>data-type="hair"<?php } else{ ?>data-type="onfire"<?php }?> style="width:22%">
								<a href="../product_logos/<?php echo $image1;?>" rel="gallery" title="Price:$<?php echo $row1['cost_price'];?> Product:<?php echo $row1['product_name'];?> " class="custom_tooltip"> <img src="<?php echo $image1;?>" style="width:95%" alt="<?php echo $row['product_name'];?>"/></a>
                              
                                <br>
                               
                                <!--<span style="color:#000; font-size:12px;">&nbsp;<strong>Copy Link:</strong><textarea name="text_copy" id="text_copy" rows="2" cols="24" style="width:95%" onBlur="CopyToClipboard(this)"><?php echo $host_name."product-redirect.php?seller=".USERID."&pid=".$product_id;?></textarea></span></span>
                                <br>-->
                                <br>
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Module <?php echo $row['add_count'];?>:</strong><?php if($row['status']){ ?>
								<span class="badge_style b_confirmed" style="cursor:pointer" onClick="setLocation('weekly_adds_profile.php?pid=<?php echo $product_id;?>')">Confirmed</span>
                                <!--<a class="action-icons c-approve" href="javascript:void(0);"title="Approve">Suspend</a>-->
                                <!--<a class="p_approve" href="#">Approve</a>-->
								<?php } else{ ?>
                                <span class="badge_style b_pending" style="cursor:pointer" onClick="setLocation('weekly_adds_profile.php?pid=<?php echo $product_id;?>')" >Pending</span>
                                <!--<a class="action-icons c-suspend" href="javscript:void(0);" title="Pending">Suspend</a>--><?php }?></span>
                                <br>

                                <br>
								</li>
                                </form>
                            <?php 
							$s++;
							}
							?>
								
							</ul>
						</div>
                        <?php   } ?>					
						
<div class="clear"></div>
<!--<div style="width:100%; float:left;">
<form name="search_invo" action="" method="post">&nbsp;&nbsp;
<label>Link Verify</label>
<input type="text" name="invoice_no" value="<?php echo $_POST['invoice_no'];?>">
<button name="show" type="submit" class="btn_small btn_gray" value="Search" onClick="shoLst(txtfrm.value, txttil.value);" onMouseOver="formCheck();">Verify</button>
</form>
</div>-->
<div class="clear"></div>
<style>
.classified_list {
list-style: square;
font-size: 20px;
padding:2px 2px 2px 2px;
margin:0px auto;
}

classified_list:before {
content:"·";
font-size:120px;
vertical-align:middle;
line-height:20px;
}
</style>
<!--<div style="width:50%; float:left">
<ol class="classified_list">
<li><a href="http://www.007adsposting.co.cc/" target="_blank"> www.007adsposting.co.cc</a><br>
</li>
<li><a href="http://www.caribiznet.in/" target="_blank"> www.caribiznet.in</a><br>
</li>
<li><a href="http://www.123classifieds.us/" target="_blank"> www.123classifieds.us</a><br>
</li>
<li><a href="http://www.123ukclassified.com/" target="_blank"> www.123ukclassified.com</a><br>
</li>
<li><a href="http://www.143share.com/" target="_blank"> www.143share.com</a><br>
</li>
<li><a href="http://www.1click-ads.com/" target="_blank"> www.1click-ads.com</a><br>
</li>
<li><a href="http://www.1smartlist.com/" target="_blank"> www.1smartlist.com
</a><br>
</li>
<li><a href="http://www.24needs.com/" target="_blank"> www.24needs.com
</a><br>
</li>
<li><a href="http://www.2indiaclassifieds.com/" target="_blank"> www.2indiaclassifieds.com</a><br>
</li>
<li><a href="http://www.4ufreeclassifiedads.com/" target="_blank"> www.4ufreeclassifiedads.com</a><br>
</li>
<li><a href="http://www.adsplus.co.uk/" target="_blank"> www.adsplus.co.uk</a><br>
</li>
<li><a href="http://www.caribiznet.in/" target="_blank">www.caribiznet.in</a><br>
</li>
<li><a href="http://www.carolfreeposting.in/" target="_blank">www.carolfreeposting.in</a><br>
</li>
<li><a href="http://www.carrslist.com/" target="_blank">www.carrslist.com</a><br>
</li>
<li><a href="http://www.catchus.in/" target="_blank">www.catchus.in</a><br>
</li>
<li><a href="http://www.caterfreelist.in/" target="_blank">www.caterfreelist.in</a><br>
</li>
<li><a href="http://www.cautious.in/" target="_blank">www.cautious.in</a><br>
</li>
<li><a href="http://www.classifiedads.com/" target="_blank">www.classifiedads.com</a><br>
</li>
<li><a href="http://www.classifiedinchina.com/" target="_blank">www.classifiedinchina.com</a><br>
</li>
<li><a href="http://www.classifieds4me.com/" target="_blank">www.classifieds4me.com</a><br>
</li>
<li><a href="http://www.classifiedssaudi.com/" target="_blank">www.classifiedssaudi.com</a><br>
</li>
<li><a href="http://www.classifio.com/" target="_blank">www.classifio.com</a><br>
</li>
<li><a href="http://www.dohaclassified.com/" target="_blank">www.dohaclassified.com</a><br>
</li>
<li><a href="http://www.dubaiclassifiedsfree.com/" target="_blank">www.dubaiclassifiedsfree.com</a><br>
</li>
<li><a href="http://www.ecraigslists.com/" target="_blank">www.ecraigslists.com</a><br>
</li>
<li><a href="http://www.freeadlists.com/" target="_blank">www.freeadlists.com</a><br>
</li>
<li><a href="http://www.freeadsinfo.com/" target="_blank">www.freeadsinfo.com</a><br>
</li>
<li><a href="http://www.freeclassifiedssites.com/" target="_blank">www.freeclassifiedssites.com</a><br>
</li>
<li><a href="http://www.goodclassified.com/" target="_blank">www.goodclassified.com</a><br>
</li>
<li><a href="http://www.indiababa.in/" target="_blank">www.indiababa.in</a><br>
</li>
<li><a href="http://www.indiad.com/" target="_blank">www.indiad.com</a><br>
</li>
<li><a href="http://www.inkiti.com/" target="_blank">www.inkiti.com</a><br>
</li>
<li><a href="http://www.jaipurclassifieds.com/" target="_blank">www.jaipurclassifieds.com</a><br>
</li>
<li><a href="http://www.jicka.com/" target="_blank">www.jicka.com</a><br>
</li>
<li><a href="http://www.kifaa.com/" target="_blank">www.kifaa.com</a><br>
</li>
<li><a href="http://www.kuwaitclassifiedslist.com/" target="_blank">www.kuwaitclassifiedslist.com</a><br>
</li>
<li><a href="http://www.listaboo.com/" target="_blank">www.listaboo.com</a><br>
</li>
<li><a href="http://www.listingsin.com/" target="_blank">www.listingsin.com</a><br>
</li>
<li><a href="http://www.locanto.com/" target="_blank">www.locanto.com</a><br>
</li>
<li><a href="http://www.manamaclassifiedads.com/" target="_blank">www.manamaclassifiedads.com</a><br>
</li>
<li><a href="http://www.my.classifieds.co.uk/" target="_blank">www.my.classifieds.co.uk</a><br>
</li>
<li><a href="http://www.myadmonster.com/" target="_blank">www.myadmonster.com</a><br>
</li>
<li><a href="http://www.oddbark.com/" target="_blank">www.oddbark.com</a><br>
</li>
<li><a href="http://www.phinditt.com/" target="_blank">www.phinditt.com</a><br>
</li>
<li><a href="http://www.post.adeex.in/" target="_blank">www.post.adeex.in</a><br>
</li>
<li><a href="http://www.quikr.com/" target="_blank">www.quikr.com</a><br>
</li>
<li><a href="http://www.singaporeclassifiedsfree.com/" target="_blank">www.singaporeclassifiedsfree.com</a><br>
</li>
<li><a href="http://www.sulekhalist.com/" target="_blank">www.sulekhalist.com</a><br>
</li>
<li><a href="http://www.umadclassifieds.com/" target="_blank">www.umadclassifieds.com</a><br>
</li>
<li><a href="http://www.zuzki.com/" target="_blank">www.zuzki.com</a><br>
</li>
</ol>
</div>
<div style="width:50%; float:right">
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