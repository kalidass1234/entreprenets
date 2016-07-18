<?php
include('config/directory.php');
include("config/config.php");
//echo "<pre>"; print_r($_POST); print_r($_FILES);exit;
if(isset($_POST['action']))
{
	$value = $_POST['action'];
	// unset some field of post
	unset($_POST['action']);
	unset($_POST['rand']);
	switch($value)
	{
		case "admin_login":
		$obj_rep->login($uname,$pass,$return_page,$current_page,$type='');
		break;
		case "edit_user_detail":
		$obj_rep->_edit_user_detail();
		break;
		case "edit_user_secure":
		$obj_rep->_edit_user_detail();
		break;
		case "edit_user_login":
		$obj_rep->_edit_user_detail();
		break;
		case "AddCategory":
		$obj_rep->_AddCategory();
		break;
		case "UpdateCategory":
		$obj_rep->_AddCategory();
		break;
		case "AddSubCategory":
		$obj_rep->_AddSubCategory();
		break;
		case "UpdateSubCategory":
		$obj_rep->_AddSubCategory();
		break;
		case "AddProduct":
		$obj_rep->_AddProduct();
		break;
		case "UpdateProduct":
		$obj_rep->_AddProduct();
		break;
		case "AddMoreProductImage":
		$obj_rep->_AddMoreProductImage();
		break;
		case "Update_Logo":
		$obj_rep->_Update_Logo();
		break;
		case "Add_Marketing":
		$obj_rep->_Add_Marketing();
		break;
		case "Add_Faq":
		$obj_rep->_Add_Faq();
		break;
		case "Add_Cms":
		$obj_rep->_Add_Cms();
		break;
		case "Add_Cms_BackOffice":
		$obj_rep->_Add_Cms_BackOffice();
		break;
		case "Add_Cms_Seven":
		$obj_rep->_Add_Cms_Seven();
		break;
		case "Add_Cms_Home_Top":
		$obj_rep->_Add_Cms_Home_Top();
		break;
		case "Add_Cms_Home_Footer":
		$obj_rep->_Add_Cms_Home_Footer();
		break;
		case "Add_Cms_Home":
		$obj_rep->_Add_Cms_Home();
		break;
		case "Add_Cms_Latest_Work":
		$obj_rep->_Add_Cms_Latest_Work();
		break;
		case "Add_Cms_Client_Say":
		$obj_rep->_Add_Cms_Client_Say();
		break;
		case "Add_Cms_Recent_Post":
		$obj_rep->_Add_Cms_Recent_Post();
		break;
		case "AddFund":
		$obj_rep->_Add_Fund();
		break;
		case "DeductFund":
		$obj_rep->_Deduct_Fund();
		break;
		case "Close_Ticket":
		$obj_rep->_Close_Ticket();
		break;
		case "Add_Announcement":
		$obj_rep->_Add_Announcement();
		break;
		case "add_packages":
		$obj_rep->_Add_Package();
		break;
		case "Add_Member_Reamrk":
		$obj_rep->_Add_Member_Remark();
		break;
		case "AddPackage":
		$obj_rep->_AddPackage();
		break;
		case "Updatepackage":
		$obj_rep->_AddPackage();
		break;
		case "AddCmsCategory":
		$obj_rep->_AddCmsCategory();
		break;
		case "UpdateCmsCategory":
		$obj_rep->_AddCmsCategory();
		break;
		case "AddCountry":
		$obj_rep->_AddCountry();
		break;
		case "UpdateCountry":
		$obj_rep->_AddCountry();
		break;
		case "AddCmsBackOfficeCategory":
		$obj_rep->_AddCmsBackOfficeCategory();
		break;
		case "UpdateCmsBackOfficeCategory":
		$obj_rep->_AddCmsBackOfficeCategory();
		break;
		case "AddCmsBackOfficeSubCategory":
		$obj_rep->_AddCmsBackOfficeSubCategory();
		break;
		case "UpdateCmsBackOfficeSubCategory":
		$obj_rep->_AddCmsBackOfficeSubCategory();
		break;
		case "ADD_Social_Page":
		$obj_rep->_ADD_Social_Page();
		break;
		case "Add_Stock_To_Sell":
		$obj_rep->_Add_Stock_To_Sell();
		break;
		case "Add_Weekly_Adds":
		$obj_rep->_Add_Weekly_Adds();
		break;
		case "Set_Power_Leg":
		$obj_rep->_Set_Power_Leg();
		break;
		case "Confirm_Order":
		$obj_function->_Confirm_Order();
		break;
		case "Diliver_Order":
		$obj_function->_Diliver_Order();
		break;
		case "Payment_Methods":
		$obj_function->_Payment_Methods();
		break;
		case "CMS_Home_Reg":
		$obj_function->_CMS_Home_Reg();
		break;
		case "CMS_Home_Comp":
		$obj_function->CMS_Home_Comp();
		break;
		case "Verify_Adds":
		$obj_function->_Verify_Adds();
		break;
		case "new_registration":
		$obj_rep->_new_registration();
		break;
		case "jump_member":
		$obj_rep->_jump_member();
		break;
		case "Set_Placement":
		$obj_rep->_Set_Placement();
		break;
		case "Change_Sponsor":
		$obj_rep->_Change_Sponsor();
		break;
		case "Payment_Bank":
		$obj_rep->_Payment_Bank();
		break;
		case "Close_Withdraw_Bank":
		$obj_rep->_Close_Withdraw_Bank();
		break;
		case "Repurchase_Binary_Income":
		$obj_rep->_Repurchase_Binary_Income();
		break;
		case "AddUser":
		$obj_rep->_AddUser();
		break;
		case "UpdateUser":
		$obj_rep->_UpdateUser();
		break;
		case "add_pages":
		$obj_rep->_Add_Page();
		break;
		case "add_sub_pages":
		$obj_rep->_Add_Page_Sub();
		break;
		case "add_news":
		$obj_rep->_Add_News();
		break;
		case "add_steps":
		$obj_rep->_Add_Steps();
		break;
		case "add_team":
		$obj_rep->_Add_Team();
		break;
		
		
		
		
		
		case "add_slider":
		$obj_rep->_Add_Slider();
		break;
		case "add_features":
		$obj_rep->_Add_Features();
		break;
		case "add_program":
		$obj_rep->_Add_Program();
		break;
		case "add_projects":
		$obj_rep->_Add_Project();
		break;
		case "add_partners":
		$obj_rep->_Add_Partner();
		break;
		case "add_news_cat":
		$obj_rep->_Add_Category();
		break;
		case "add_testim":
		$obj_rep->_Add_Testi();
		break;
		case "howit":
		$obj_rep->_Add_How();
		break;
		case "add_slider_news":
		$obj_rep->_Add_Slider_News();
		break;
		case "add_b_c":
		$obj_rep->_Add_b_c();
		break;
		case "add_bus_cat":
		$obj_rep->_Add_business();
		break;
		case "add_tut":
		$obj_rep->_Add_Tut();
		break;
	}
}
?>