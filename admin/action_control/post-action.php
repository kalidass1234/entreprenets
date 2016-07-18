<?php 
// define site url constant
define('SITE_URL','http://localhost/john/'); 

// define absolute path of include library files
define('ABSPATH','../../lib/');

include(ABSPATH.'functions.php');

/*
This file handle all request of post 
*/  

if( isset($_POST['action']) && isset($_POST['rand']) ){

	// check page request from correct path or not (security points)
	if( $_POST['rand'] ==  $_SESSION['rand'] && $_SESSION['page_url'] == $_SERVER['HTTP_REFERER']){
		
		$action = $_POST['action'];
		// use swith case 
		switch($action){
			
			case "AddCategory":
				_AddCategory();
			break;
			
			case "UpdateCategory":
				_UpdateCategory();
			break;
			
		}
		
	}
	
}

// add cateogry
function _AddCategory(){
	
	// check category field has value or not
	if(isset($_POST['category_name'])){
		
		global $mxDb;
		
		// get last position of category
		$position = $mxDb->get_field_information('max_categories', 'position', ' order by category_id desc', 'array', false);
		
		$position = $position + 1;
		$iconName = '';
		// check icon and upload it
		if($_FILES['icon']['name']){
			
			if($mxDb->image_validation($_FILES['icon']['name'],$_FILES['icon']['tmp_name'])){
				$iconName = "icon".time().$_FILES['icon']['name'];
				move_uploaded_file($_FILES['icon']['tmp_name'],"../../images/".$iconName);
			}
		}
		
		$insert_array = array('name'=>$_POST['category_name'],'icon'=>$iconName,'date'=>date('Y-m-d'),'date_time_create'=>date('Y-m-d H:i:s'),'position'=>$position);
				
		if($mxDb->insert_record('max_categories', $insert_array)){
			header("Location:../category/index.php?msg=Add Category Successfully!");
		}
		else{
			header("Location:../category/index.php?msg=Category Insertion failed!");
		}
	}	
}

// update cateogry
function _UpdateCategory(){
	
	// check category field has value or not
	if(isset($_POST['category_name']) && isset($_POST['id'])){
		
		global $mxDb;
		
		$update_array = array('name'=>$_POST['category_name']);
		
		$iconName = '';
		// check icon and upload it 
		if($_FILES['icon']['name'] && !empty($_FILES['icon']['name'])){
			
			if($mxDb->image_validation($_FILES['icon']['name'],$_FILES['icon']['tmp_name'])){
				
				// delete old image
				if(file_exists("../../images/".$_POST['old_icon']))
					unlink("../../images/".$_POST['old_icon']);
				
				$iconName = "icon".time().$_FILES['icon']['name'];
				move_uploaded_file($_FILES['icon']['tmp_name'],"../../images/".$iconName);
				
				$update_array = array_merge($update_array,array('icon'=>$iconName));
			}
		}
		
		$condition = " category_id='".$_POST['id']."'";
		
		if($mxDb->update_record('max_categories', $update_array,$condition)){
			header("Location:../category/index.php?msg=Update Category Successfully!");
		}
		else{
			header("Location:../category/index.php?msg=Category Updation failed!");
		}
	}	
}
?>

