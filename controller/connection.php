<?php 
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
error_reporting(E_ERROR | E_WARNING | E_PARSE);
define("host","localhost");
define("user","wwwjoinl_join");
define("pass","p@143#");
define("db","wwwjoinl_joinlivingwell");
*/
define('host', 'localhost');
define('user', 'entrepre_envasio');
define('pass', 'Password@!@#$%');
define('db', 'entrepre_envasion');
/*define('host', 'localhost');
define('user', 'seancare_user');
define('pass', 'P@55w0rd!');
define('db', 'seancare_db')*/;


$con=mysql_connect(host, user, pass) or die("not connected to database server");
mysql_select_db(db, $con) or die("Database not Selected");
mysql_query("SET NAMES 'utf8'"); mysql_query('SET CHARACTER_SET utf8');

?>