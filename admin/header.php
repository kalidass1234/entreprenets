<?php 
// define site url for include style and js etc.
//define('SITE_URL','http://localhost/creative/creative/');

// include method file. 
//include(ABSPATH.'functions.php');  
/*include_once('config/directory.php');
include_once("config/config.php");*/
$page_name=basename($_SERVER['PHP_SELF']);
if($page_name=='admin_main.php')
{
	
}
else if($page_name=='index.php')
{
	header("Location:admin_main.php?page_number=1");
}
else
{
	header("Location:admin_main.php?page_number=999999");
}
$host_name=$obj_function->host_name();
$host_name=str_replace('admin','',$host_name);

//echo $host_name;
define('SITE_URL',$host_name);
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 
// store current url
$_SESSION['page_url'] = str_ireplace("/creative/","",SITE_URL).$_SERVER['REQUEST_URI'];
//echo $_SESSION['page_url']; die();

//echo $_SESSION['TRINITY_User_Name'];exit;
if(!isset($_SESSION['TRINITY_User_Name']))
{
	header("Location:login.php"); exit;
}

					$privilege_id=$_SESSION['privilege_uid'];
					$country_id=$_SESSION['admin_country_id'];
					$country_name=$_SESSION['admin_country_name'];
					$admin_type=$_SESSION['admin_type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <!-- Stylesheets -->
  <link href="<?php echo SITE_URL; ?>admin/css/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/font-awesome.css"> 
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/jquery-ui-1.9.2.custom.min.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/prettyPhoto.css">  
  <!-- Star rating -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/jquery.cleditor.css"> 
  <!-- Uniform -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/uniform.default.css"> 
  <!-- Uniform -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/daterangepicker-bs3.css" />
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="<?php echo SITE_URL; ?>admin/css/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="<?php echo SITE_URL; ?>admin/css/widgets.css" rel="stylesheet">   
    <!-- Gritter Notifications stylesheet -->
  <link href="<?php echo SITE_URL; ?>admin/css/jquery.gritter.css" rel="stylesheet"> 
  <link href="<?php echo SITE_URL; ?>admin/css/font-awesome.css" rel="stylesheet">
  <link href="<?php echo SITE_URL; ?>admin/css/font-awesome.min.css" rel="stylesheet">  
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo SITE_URL; ?>admin/img/favicon/favicon.png">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/css/pagination_css.css">
</head>

<body>
<header>
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
  
    <div class="container">
      <!-- Menu button for smallar screens -->
      <div class="navbar-header">
		  <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span>Menu</span></button>
      <a href="#" class="pull-left menubutton hidden-xs"><i class="fa fa-bars"></i></a>
		  <!-- Site name for smallar screens -->
          <?php 
		  // get log from admin database
		  //$res_logo=$obj_query->query("logo","logo","status=0");
		  //$row_logo=$obj_query->get_all_row($res_logo);
		  //if($row_logo['logo']!='' && file_exists("../images/logo/".$row_logo['logo']))
		  //$logo="images/logo/".$row_logo['logo'];
		 // else
		  $logo="images/logo.png";
		  ?>
		  <a href="admin_main.php?page_number=1" class="navbar-brand"><img src="<?php echo SITE_URL.$logo; ?>" style="width:58%"></a>
		</div>

      <!-- Navigation starts -->
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        
        <!-- Links -->
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown pull-right user-data">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img src="<?php echo SITE_URL; ?>admin/images/b.png" width="30" height="30"> Admin <span class="bold"> &nbsp;</span> <b class="caret"></b>              
            </a>
            
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
              <!--<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>-->
              <li><a href="login.php"><i class="fa fa-key"></i> Logout</a></li>
            </ul>
          </li>
          <!-- Upload to server link. Class "dropdown-big" creates big dropdown -->
          

          <!-- Sync to server link -->
                  <!--  <li class="dropdown dropdown-big leftonmobile">              <a class="dropdown-toggle" href="#" data-toggle="dropdown">                <i class="fa fa-comments"></i><span class="label label-info">6</span>               </a>                <ul class="dropdown-menu">                  <li class="dropdown-header padless">                                    <h5><i class="fa fa-comments"></i> Chats</h5>                                                        </li>                  <li>                    <hr />                                      <h6><a href="#">Hi :)</a> <span class="label label-warning pull-right">10:42</span></h6>                    <div class="clearfix"></div>                    <hr />                  </li>                  <li>                    <h6><a href="#">How are you?</a> <span class="label label-warning pull-right">20:42</span></h6>                    <div class="clearfix"></div>                    <hr />                  </li>                  <li>                    <h6><a href="#">What are you doing?</a> <span class="label label-warning pull-right">14:42</span></h6>                    <div class="clearfix"></div>                    <hr />                  </li>                                    <li>                    <div class="drop-foot">                      <a href="#">View All</a>                    </div>                  </li>                                                    </ul>            </li>-->                        <!-- Message button with number of latest messages count-->   
                  <!--           <li class="dropdown dropdown-big messages-dd leftonmobile">              <a class="dropdown-toggle" href="#" data-toggle="dropdown">                <i class="fa fa-envelope-o"></i> <span class="label label-primary">3</span>               </a>                <ul class="dropdown-menu">                  <li class="dropdown-header padless">                            <h5><i class="fa fa-envelope-alt"></i> Messages</h5>                                                  </li>                  <li>                    <hr />                <h6><a href="#">Hello how are you?</a></h6>                                 <p>Quisque eu consectetur erat eget  semper...</p>                    <hr />                  </li>                  <li>                    <h6><a href="#">Today is wonderful?</a></h6>
                    <p>Quisque eu consectetur erat eget  semper...</p>
                    <hr />
                  </li>
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li>-->

            <!-- Members button with number of latest members count -->
            <li class="dropdown dropdown-big">
              <!--<a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-user"></i> <span class="label label-success">7</span> 
              </a>-->

                <ul class="dropdown-menu">
                  <li class="dropdown-header padless">
                    <h5><i class="fa fa-user"></i> Users</h5>
                  </li>
                  <li>
                    <hr />
                    
                    <h6><a href="#">John Doe</a> <span class="label label-warning pull-right">Free</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <!--<li>
                    <h6><a href="#">Iron Man</a> <span class="label label-important pull-right">Premium</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <h6><a href="#">Salamander</a> <span class="label label-warning pull-right">Free</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>         -->         
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li> 
        </ul>
      </nav>

    </div>
  </div>
</header>
<div id="loading" style="display:none"><img id="loader-img" src="images/loading.gif"></div>