<?php
require_once "../includes/all_func.php";
session_start();
//echo "<pre>";print_r($_POST);echo "<pre>"; print_r($_SESSION); exit;
		if($_POST['ref']!='')
		{
			$sp_name=$_POST['ref'];
			if($sp_name=='')
			{
				$sp_name='mike';
			}
			$user_nm=$_POST['user_name'];
			$pass=$_POST['user_pass'];
			$fname=$_POST['first_name'];
			$mname=$_POST['mid_name'];
			$lname=$_POST['last_name'];
	
			$dob=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
			
			$mobile=$_POST['mobile'];
			$sex=$_POST['sex'];
			
			$address1=$_POST['address1'];
			$address2=$_POST['address2'];
			$city=$_POST['city'];
			$state=$_POST['state'];
	
			$country=$_POST['country'];
			$email=$_POST['email'];
			
			$acc_name=$_POST['ac_holder_name'];
			$acc_no=$_POST['ac_no'];
			$ifsc=$_POST['ifsc'];
			$bank_name=$_POST['bank_nm'];
			$bank_branch=$_POST['branch_nm'];
			
			$nominee_name=$_POST['nominee_name'];
			$nom_relation=$_POST['nom_relation'];
			$nom_contact=$_POST['nom_contact'];
			$nimini_dob=$_POST['nom_year'].'-'.$_POST['nom_month'].'-'.$_POST['nom_day'];
			
			$return_page=$_POST['return_page'];
		}
		//echo "<pre>"; print_r($_POST); echo "<pre>"; print_r($_SESSION); exit;
		if(isset($_POST['other_category']))
		{
			$_SESSION['other_category']=$_POST['other_category'];
		}
			$other_category=$_SESSION['other_category'];
			if($other_category==3){$_SESSION['other_amount']=150;}
			if($other_category==2)
			{
				if($_SESSION['other_duration']==1){$_SESSION['other_amount']=29.99;}
				if($_SESSION['other_duration']==3){$_SESSION['other_amount']=254.94;}
				if($_SESSION['other_duration']==6){$_SESSION['other_amount']=509.88;}
				if($_SESSION['other_duration']==12){$_SESSION['other_amount']=1019.76;}
			}
			if($other_category==1)
			{
				if($_SESSION['other_duration']==1){$_SESSION['other_amount']=29.99;}
				if($_SESSION['other_duration']==3){$_SESSION['other_amount']=89.97;}
				if($_SESSION['other_duration']==6){$_SESSION['other_amount']=179.94;}
				if($_SESSION['other_duration']==12){$_SESSION['other_amount']=359.88;}
			}
		if($_POST['pin']!='')
		{
			
			//echo "<pre>"; print_r($_POST); exit;
			if($_SESSION['category']==2)
			{
				$_SESSION['amount']=29.99;
			}
			$plan_name=$_SESSION['amount'];
			$plan_name1=$_SESSION['amount']+$_SESSION['other_amount'];
			// check pin is valid or not 
			$sql_pin="select * from pins where status=0 and amount='$plan_name1' and pin_no='$_POST[pin]'";
			$res_pin=mysql_query($sql_pin);
			$count_pin=mysql_num_rows($res_pin);
			if($count_pin>0)
			{
				$pin=$_POST['pin'];
				$_SESSION['pin']=$pin;
				$paymode='voucher';
				function meberins()
				 {
				  //$encypt1=uniqid(rand(), true);
				  $encypt1=uniqid(rand(1000000000,9999999999), true);
				  $usid1=str_replace(".", "", $encypt1);
				  $pre_userid = substr($usid1, 0, 10);
				  
				  $checkid=mysql_query("select transaction_no from registration where transaction_no='$pre_userid'");
				  if(mysql_num_rows($checkid)>0)
				  {
				   meberins();
				  }
				  else
				   return $pre_userid;
				 }
				 $order_no=meberins();
				/*$order_no=$_POST['pin'];*/
			}
			else
			{
			$return_page=$_POST['return_page'];
			/*echo "<script type='text/javascript'>alert('Wrong Voucher Code.');window.location.href='$return_page';</script>";exit;*/
			}
		}
		else if($_SESSION['orderno'])
		{
			$plan_name=$_SESSION['total_price'];
			$order_no=$_SESSION['orderno'];
			$paymode=$_SESSION['paymode'];
		}
		//echo $pin."__".$order_no."__".$paymode;exit;
		$category=$_SESSION['category'];
		if($category==1)
		{
			$category_one=1;
		}
		else if($category==2)
		{
			$category_two=1;
		}
		else if($category==3)
		{
			$category_three=1;
		}
		
		$sp_name=$_SESSION['ref_id'];
		$sp_name_guru=$_SESSION['ref_id'];
		if($sp_name=='')
		{
			// get top id 
			$sql_top="select * from registration where nom_id='cmp'";
			$res_top=mysql_query($sql_top);
			$row_top=mysql_fetch_assoc($res_top);
			$sp_name=$row_top['user_name'];
		}
		else
		{
			$sql_top="select * from registration where nom_id='cmp'";
			$res_top=mysql_query($sql_top);
			$row_top=mysql_fetch_assoc($res_top);
			/*$sp_name=$row_top['user_name'];*/
			
			$sql_ref_check="select * from registration where user_name='$sp_name' or user_id='$sp_name'";
			$res_ref_check=mysql_query($sql_ref_check);
			$row_ref_check=mysql_fetch_assoc($res_ref_check);
			//echo $row_ref_check['category_two']." && (".$category;
			if($row_ref_check['category_two'] && $row_ref_check['category_three'])
			{
				if($category==2)
				{
					$admin_ref_ref=$row_top['user_id'];
					//echo $admin_ref_ref."=======";
				}
				$sp_name=$row_ref_check['user_id'];
			}
			else if($row_ref_check['category_two'] && $category==2)
			{
				$admin_ref_ref=$row_top['user_id'];
				$sp_name=$row_ref_check['user_id'];
				//echo $admin_ref_ref."=admin_ref_ref======";
			}
			else if($row_ref_check['category_two'] && ($category==1 || $category==3))
			{
				$admin_ref_ref=$row_top['user_id'];
				//echo $admin_ref_ref."==admin_ref_ref";
				$sp_name=$row_top['user_name'];
			}
			
			//echo $sp_name;
		}
		$user_nm=$_SESSION['user_name'];
		$pass=$_SESSION['user_pass'];
		$fname=$_SESSION['fname'];
		$lname=$_SESSION['lname'];
		$image=$_SESSION['image'];
		$dob=$_SESSION['dob'];
		$ssn=$_SESSION['ssn'];
		$mobile=$_SESSION['mobile'];
		$sex=$_SESSION['sex'];
		$address1=$_SESSION['address1'];
		$address2=$_SESSION['address2'];
		$city=$_SESSION['city'];
		$state=$_SESSION['state'];
		$zip=$_SESSION['zip'];
		$email=$_SESSION['email'];
		$duration=$_SESSION['duration'];
		$other_category=$_SESSION['other_category'];
		$amount=$_SESSION['amount'];
		$other_amount=$_SESSION['other_amount'];
		$other_duration=$_SESSION['other_duration'];
		$pin=$_SESSION['pin'];
		$subscription_id=$_SESSION['subscription_id'];
		$other_subscription_id=$_SESSION['other_subscription_id'];
		$mem_type='vip';
		
		//echo $ref."#".$fname."#".$mname."#".$lname."#".$user_nm."#".$email."#".$pass."#".$dob."#".$address1."#".$address2."#".$city."#".$state."#".$country."#".$mobile."#".$sex."#".$acc_name."#".$acc_no."#".$ifsc."#".$bank_name."#".$bank_branch."#".$nominee_name."#".$nom_relation."#".$nom_contact."#".$nimini_dob."#".$zip."#".$image."#".$mem_type."#".$pin."#".$plan_name."#".$ssn."#".$category_one."#".$category_two."#".$category_three."#".$order_no."#".$paymode."#".$admin_ref_ref."#".$admin_ref."#".$duration;exit;
//unset($_SESSION['voucher']);
//print_r($_SESSION);echo $user_nm.'=='.$ref;exit;
	$checkuser=checkuser($user_nm);
	$checkref=checkuser($sp_name);
	//exit;
//echo $checkuser.'=='.$checkref;exit;

	if($checkuser && !$checkref)
	{
		$ref=showuserid($sp_name);
		$user_id=registernow();
		if($user_id)
		{
			//$_SESSION['SD_User_Id']=$user_id;
			$usernam=showusername($user_id);
			//$_SESSION['SD_User_Name']=showusername($user_id);
			//echo "<pre>"; print_r($_SESSION);exit;
			// send email to user and upline
				$obj_email1=new EMAILTOUSER();
				$obj_email1->email_to_user($user_id,$category);
				$obj_email1->email_to_sponser($user_id,$category);
				$obj_email1->email_to_admin($user_id,$category);
			if(isset($other_category))
			{
				
				$sp_name=$_SESSION['ref_id'];
				$sql_top="select * from registration where nom_id='cmp'";
				$res_top=mysql_query($sql_top);
				$row_top=mysql_fetch_assoc($res_top);
				/*$sp_name=$row_top['user_name'];*/
				
				$sql_ref_check="select * from registration where user_name='$sp_name' or user_id='$sp_name'";
				$res_ref_check=mysql_query($sql_ref_check);
				$row_ref_check=mysql_fetch_assoc($res_ref_check);
				//echo $row_ref_check['category_two']." && (".$category;
				if($row_ref_check['category_two'] && $row_ref_check['category_three'])
				{
					if($other_category==2)
					{
						$admin_ref_ref=$row_top['user_id'];
						//echo $admin_ref_ref."=======";
						$sp_name=$row_ref_check['user_id'];
					}
				}
				else if($row_ref_check['category_two'] && $other_category==2)
				{
					$admin_ref_ref=$row_top['user_id'];
					$sp_name=$row_ref_check['user_id'];
					//echo $admin_ref_ref."=admin_ref_ref======";
				}
				else if($row_ref_check['category_two'] && ($other_category==1 || $other_category==3))
				{
					$admin_ref_ref=$row_top['user_id'];
					//echo $admin_ref_ref."==admin_ref_ref";
					$sp_name=$row_top['user_name'];
				}
				$ref_for_nom=showuserid($sp_name);
				
				$obj=new MultipleJoin();
				$obj->joinmultiple($user_id,$other_category,$other_duration,$order_no,$other_amount,$paymode,$ref_for_nom);
		
				if($admin_ref_ref)
				{
					$ref1=$admin_ref_ref;
				}
				else 
				{
					$ref1=$ref_for_nom;
				}
				
				$obj_spill=new SpillOver();
				$sql_ref_cat="select * from registration where user_id='$ref1'";
				
				$res_ref_cat=mysql_query($sql_ref_cat);
				$row_ref_cat=mysql_fetch_assoc($res_ref_cat);
				//echo $category_three." || ".$category_one." || ".$category_two;	exit;
				if($other_category==2)
				{
					if($row_ref_cat['category_three'] && $row_ref_cat['category_two'])
					{
						$ref2=$ref_for_nom;
						//$guru_ref=$sp_name_guru;
					}
					else if($row_ref_cat['category_two'])
					{
						$ref2=$ref_for_nom;
					}
					else if($row_ref_cat['category_three'])
					{
						$ref2=1234568;
						$guru_ref=$sp_name_guru;
					}
					
					/*if($ref==1234567)
					{
						$guru_ref=$sp_name_guru;
					}*/
				}
				//echo $row_ref_cat['category_three']."&&".$row_ref_cat['category_two']."&&".$guru_ref."&&".$other_category;
				if($row_ref_cat['category_three'] && $row_ref_cat['category_two'])
				{
					if($other_category==3 || $other_category==1)
					{
						$obj_com=new Commission();
						$obj_com->commission_ref($ref_for_nom,$nom_id,$user_id,$plan_name,$other_category);
					}
					else if($other_category==2)
					{
						if($obj_spill->get_five_person($ref2))
						{
			    			/*if($obj_spill->get_twenty_reserve($ref2))
							{}
							else
							{*/
							
							/*}*/
							if($guru_ref)
							{
								$obj_com=new Commission();
								$obj_com->commission_ref_guru($guru_ref,$nom_id,$user_id,$plan_name,$other_category);
							}
							else
							{
							$obj_com=new Commission();
							$obj_com->commission_distribute($ref_for_nom,$nom_id,$user_id,$plan_name,$other_category);
							}
						}
						//email_to_upline($nom_id,$user_id,$user_nm);
					}
				}
				else if($row_ref_cat['category_two'])
				{
					if($other_category==3 || $other_category==1)
					{
						$obj_com=new Commission();
						if($guru_ref)
						{
							$obj_com->commission_ref_guru($guru_ref,$nom_id,$user_id,$plan_name,$other_category);
						}
						else
						{
						$obj_com->commission_ref($ref_for_nom,$nom_id,$user_id,$plan_name,$other_category);
						}
					}
					else if($other_category==2)
					{
							$obj_com=new Commission();
							$obj_com->commission_distribute($ref_for_nom,$nom_id,$user_id,$plan_name,$other_category);
						//email_to_upline($nom_id,$user_id,$user_nm);
					}
				}
				else if($row_ref_cat['category_three'])
				{
					$obj_com=new Commission();
					if($guru_ref)
					{
						$obj_com->commission_ref_guru($guru_ref,$nom_id,$user_id,$plan_name,$other_category);
					}
					else
					{
						$obj_com->commission_ref($ref_for_nom,$nom_id,$user_id,$plan_name,$other_category);
					}
				}
				// send email to user and upline
				$obj_email=new EMAILTOUSER();
				$obj_email->email_to_user($user_id,$other_category);
				$obj_email->email_to_sponser($user_id,$other_category);
				$obj_email1->email_to_admin($user_id,$other_category);
			}
			
			if($return_page=='')
			{
			//echo "<pre>"; print_r($_SESSION); exit;
				unset($_SESSION['user_name']);
				unset($_SESSION['user_pass']);
				unset($_SESSION['fname']);
				unset($_SESSION['lname']);
				unset($_SESSION['image']);
				unset($_SESSION['dob']);
				unset($_SESSION['ssn']);
				unset($_SESSION['mobile']);
				unset($_SESSION['sex']);
				unset($_SESSION['address1']);
				unset($_SESSION['address2']);
				unset($_SESSION['city']);
				unset($_SESSION['state']);
				unset($_SESSION['zip']);
				unset($_SESSION['email']);
				unset($_SESSION['duration']);
				unset($_SESSION['other_category']);
				unset($_SESSION['other_amount']);
				unset($_SESSION['title']);
				unset($_SESSION['ref_id']);
				unset($_SESSION['ref_name']);
				unset($_SESSION['country']);
				unset($_SESSION['user_name']);
				unset($_SESSION['category_member']);
				unset($_SESSION['amount']);
				unset($_SESSION['category']);
				unset($_SESSION['pin']);
				unset($_SESSION['subscription_id']);
				unset($_SESSION['other_subscription_id']);
				//exit;
				echo "<script type='text/javascript'>window.location.href='member_register.php?user_id=$user_id';</script>";
				//header('Location:member_register.php?user_id='.$user_id);
			}
			else
			{
				//header('Location:$return_page');
				echo "<script type='text/javascript'>window.location.href='$return_page';</script>";
			}	
		}
		else
		{
			echo "<script type='text/javascript'>window.location.href='$return_page';</script>";
		}
	}
	else
	{
		if($checkref)
		{
			echo "<script type='text/javascript'>alert('Wrong Sponser.');window.location.href='../enroll.php';</script>";
		}
		if(!$checkuser)
		{
			echo "<script type='text/javascript'>alert('Please Choose Different Username.');window.location.href='../enroll.php';</script>";
		}
		//header("Location:registration.php");
	}
?>
