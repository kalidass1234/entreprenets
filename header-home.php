<?php
include("controller/connection.php");
include("includes/common_function.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BMC System</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/style.css">
        
        <!-- jQuery 2.1.4 --> 
        <script src="dist/js/jQuery-2.1.4.min.js"></script> 

        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> 

        <!-- Bootstrap 3.3.5 --> 
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header>
                <div class="container">
                    <div class="top-head">
                        <div class="col-sm-3"><a href="index-new.php"><img src="dist/img/logo.png" alt=""></a></div>
                        <div class="col-sm-9 col-xs-12 pull-right">
                            <!-- Navbar -->
                            <div class="navbar navbar-default pull-right" role="navigation">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse">
                                    <!-- Left nav -->
                                    <ul class="nav navbar-nav">
                                        <li><a href="index-new.php">HOME</a></li>
                                        <li><a href="about-us.php">ABOUT US</a></li>
                                        <li><a href="about-us.php">PROGRAMS</a></li>
                                        <li><a href="#">DROPSHIPPING </a></li>
                                        <li><a href="#">BLOG</a></li>
                                        <li class="login"><a href="login-new.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Login</a></li>

                                    </ul>

                                </div><!--/.nav-collapse -->
                            </div>
                        </div>
                    </div>
                    <?php
                    if($_SERVER['REQUEST_URI']=='/index.php' || $_SERVER['REQUEST_URI']=='/index-new.php')
                    {
                    ?>
                    <div class="slider-form">
                        <img src="http://dev.entreprenets.com/wp-content/uploads/2016/05/banner-txt.png" alt="" style="width: 563.882px; height: 136.699px;">
                        <form class="banner-form" method="post" action="step-1.php">
                            <ul class="form-field">
                                <li><input type="text" name="sub-email" id="sub-email" placeholder="Email*"></input></li>
                                <li><input type="text" name="sub-phone" id="sub-phone" maxlength="80" placeholder="Mobile number*"></input></li>
                                <li><input type="text" name="sub-ext1" id="sub-ext1" maxlength="80" placeholder="Name*"></input></li>
                                <li><input type="text" name="sub-ext2" id="sub-ext2" maxlength="80" placeholder="Last name*"></li>
                            </ul>
                            <div class="muSubmit"><input type="submit" name="submit" value="SignUp Now »"></div>
                        </form>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </header>