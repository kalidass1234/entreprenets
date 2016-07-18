<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if(isset($_SESSION["TRINITY_User_Name"]))
{
    include_once('config/directory.php');
	include_once('config/config.php');
	$id=$_REQUEST['page_number'];
	
	if($id=="" || !is_numeric($id) || $id==0)
	{
		$id=0;
		switch($id)
		{
			case 0:
				include('index.php');
				break;
		}
	}
	else
	{
		$res_sub_menu1=$obj_query->query("*","menu_sub","1=1 and page_id='$id' Order By sort_no asc");
		
		$count_sub_menu1=$obj_query->num_row($res_sub_menu1);
		//echo $count_sub_menu1;
		if($count_sub_menu1)
		{
			while($row_sub_menu1=$obj_query->get_all_row($res_sub_menu1))
			{
				if($row_sub_menu1['id']== $id) {	
				include_once($row_sub_menu1['page_name']);
				break;
				}
			}
		}
		else
		{
			include_once("error.php");
			break;
		}
	}
	
	// check the page id is availabale or not
}
else
{
	header("Location:login.php");
}
?>