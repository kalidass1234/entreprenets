<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);
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
define('TITLE_USER','Welcome To Envision');
/*define('Currency','£');
define('CURRENCY','&pound;');*/
define('Currency','$');
define('CURRENCY','USD');
define('Image_Path','product_logos');
define('TABLE_PREFIX','');
define('USERID',$_SESSION['TRINITY_User_ID']);
define('USERNAME',$_SESSION['TRINITY_User_Name']);
define('USERTYPE',$_SESSION['TRINITY_User_Type']);

date_default_timezone_set('America/New_York');
include(Config_Path."/mysql_class.php");
include(Config_Path."/class_functions.php");
$obj_conn=new DBConnection();
$obj_query=new mysql_func();
$obj_rep=new Representative();
$obj_login=new User_Login();
$obj_function=new Class_Functions();
$obj_conn->select_database(Host,User,Password,Database);
?>