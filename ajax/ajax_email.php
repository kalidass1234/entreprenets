<?php
session_start();
include_once("../controller/connection.php");
 
if(isset($_REQUEST["email_id"]))
{
  $email_id=$_REQUEST['email_id'];
}

 $select_data = mysql_query("select * from registration where email='".$email_id."'");
 $count_record = mysql_num_rows($select_data);
 
 if($count_record > 0)
 {
   echo "yes";
 }
 else
 {
   echo "no";
 }
