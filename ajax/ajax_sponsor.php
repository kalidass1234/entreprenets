<?php
session_start();
include_once("../controller/connection.php");
 
if(isset($_REQUEST["id"]))
{
  $id=$_REQUEST['id'];
}

 $select_data = mysql_query("select * from registration where (user_id='".$id."' or user_name='".$id."')");
 $count_record = mysql_num_rows($select_data);
 
 if($count_record > 0)
 {
   $fetch_data = mysql_fetch_array($select_data);
   $user_name = $fetch_data["user_name"]; 
   echo  ucfirst($user_name);
 }
 else
 {
   echo "no";
 }
