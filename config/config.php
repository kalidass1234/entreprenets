<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);
$show_popup = 0; if(!isset($_COOKIE['jquery_popup'])){setcookie('jquery_popup','jQuery Popup',time() + 900); // 60 = 1 minute
	   $show_popup = 1;
	}
    
error_reporting(E_ALL ^ E_NOTICE);
#this file have the global declaration of variables
define('Config_Path','config');
if($_SERVER['HTTP_HOST']=='localhost')
{
	define('Host','localhost');
	define('User','root');
	define('Password','');
	define('Database','envision');
}
else
{
	define('Host','localhost');
	define('User','entrepre_envasio');
	define('Password','Password@!@#$%');
	define('Database','entrepre_envasion');
}
define('TITLE_USER','Welcome To BMC');
/*define('Currency','£');*/
//define('Currency','£');
/*define('CURRENCY','&pound;');*/

define('Currency','$');
define('CURRENCY','USD ');
define('Image_Path','product_logos');
define('TABLE_PREFIX','');
define('USERID',$_SESSION['adid']);
define('USERNAME',$_SESSION['adid_user']);


date_default_timezone_set('Europe/London');
include("custom_function.php");
include("mysql_class.php");
include("class_functions.php");
$obj_custom=new Custom_Function();
$obj_conn=new DBConnection();
$obj_query=new mysql_func();
$obj_rep=new Representative();
$obj_login=new User_Login();
$obj_function=new Class_Functions();
$obj_conn->select_database(Host,User,Password,Database);
?>