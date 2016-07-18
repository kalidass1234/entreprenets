<?php //error_reporting(0);
define('HOST', 'localhost');
define('USER', 'develope_joshua');
define('PASS', 'joshua@123');
define('DB', 'develope_joshua');
$con=mysql_connect(HOST, USER, PASS) or die(mysql_error());
mysql_select_db(DB, $con) or die("Database not Selected");
mysql_query("SET NAMES 'utf8'"); mysql_query('SET CHARACTER_SET utf8');
?>