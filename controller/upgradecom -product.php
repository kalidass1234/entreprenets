<?php session_start(); error_reporting(0);
//include_once('connection.php');
//include_once('function.php');

function upgrade_com($invoice) {
  $date=date('Y-m-d');
$cdate=strtotime($date);
	$check_date=date('Y-m-d',strtotime("-1 months",$cdate)); 
	 "SELECT reg.user_id, reg.ref_id, reg.user_type, ms.* FROM mem_subscribe ms inner join registration reg ON reg.user_id=ms.user_id WHERE invoice='$invoice'";
	$result_ref=mysql_fetch_array(mysql_query("SELECT reg.user_id, reg.ref_id, reg.user_type, reg.nom_id, ms.* FROM mem_subscribe ms inner join registration reg ON reg.user_id=ms.user_id WHERE invoice='$invoice'"));
	$ref_id=$result_ref[ref_id];
	$result_reftype=mysql_fetch_array(mysql_query("SELECT user_type from membership where user_id='$ref_id'"));
	 $id=$result_ref[user_id];
	 $user_type=$result_ref[user_type];
	
	 $plan_amt=$result_ref[price];
	$sub_for=$result_ref[sub_for];
	 $user_typeref=$result_reftype['user_type'];
	if($user_typeref=='m'){
		
 	///////****** For check the member is affiliate or representative
 	$quers_sid="(select reg.user_type as user_type from registration reg  where reg.user_id='$ref_id' and subs_date>='$date') ";
   $dat_sid=mysql_query($quers_sid) or die(mysql_error());
    $count_ref=mysql_num_rows($dat_sid);
   $level=1;
		$user_nom=$id;
		if($user_typeref='m'){
			while($level<=5  ){
				$res_nom=mysql_fetch_array(mysql_query("SELECT nom_id FROM registration WHERE user_id='$user_nom'"));
				  $user_nom=$res_nom[nom_id];
				if($user_nom=='cmp') break;
				mysql_query("INSERT INTO notify SET user_id='$id', nom_id='$user_nom', date=NOW(), note='package', level='$level'") or die(mysql_error());
				
				$level++;
			}		 
		}
		else{
			mysql_query("INSERT INTO notify SET user_id='$id', nom_id='$ref_id', date=NOW(), note='package', level='$level'") or die(mysql_error());
				
		}
  
   /********** For check the user(purchaser) subscription *******/
		$quers_subs = new Database();  
		
		$quers_subs->select('registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and ms.s_date>='$check_date'"); 
		 $count_subs= $quers_subs->numResults;
		
		$show_subs = $quers_subs->getResult(); 
		/**********End: For subscription *******/
		
		/********** For check the Products *******/
		$quers_pro = new Database();  
		
		$quers_pro->select('registration reg INNER JOIN mem_products mp ON mp.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and mp.s_date>='$check_date'"); 
		 $count_pro= $quers_pro->numResults;
		
		$show_pro = $quers_pro->getResult(); 
		/**********End: For Products *******/
		/********** For check the Products'bundle *******/
		$quers_bun = new Database();  
		
		$quers_bun->select('registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and DATE(mb.date)>='$check_date'"); 
		 $count_bun= $quers_bun->numResults;
		
		$show_bun = $quers_bun->getResult(); 
		/**********End: For Products's bundle *******/
   if($count_ref>=1){ 
	///********* For Representative ***********/
	 $flag_fast=1;
	
	 	$i=1;  $idnom=$result_ref[nom_id]; $idref=$id;
		 $flag=1; // for 1st sale of first month
 	if($count_bun==0  || $count_pro==0 || $count_subs==0){
		if($count_bun==0 || $count_pro==0){
			if($count_bun==0){
				if($count_pro==0){
					 if($count_subs==1){
						$flag=2;
					}
				}
				else if($count_subs==0){
					if($count_pro==1)   $flag=2;
				}
				
			}
			else{
				if($count_pro==0 && $count_subs==0){
					if($count_bun==1)  $flag=2;
				}
				else if($count_pro==0 && $count_bun==0){
					if($count_subs==1)  $flag=2;
				}
			}		
			
		} else{
			$flag=1;
		}
	}   $flag;
	if($flag==2){
			/****** FAST START BONUS  *******/
		 'fast';
			 $fsb1=(($plan_amt/$sub_for)*0.30);
			 $fsb=($plan_amt/$sub_for)*0.05;
			 '<br>';
			 $nom_idfast=$idnom;
			 $ref_id_fast=$ref_id;
			while($nom_idfast!='cmp'){
			 "SELECT subs_date, ref_id, nom_id FROM registration WHERE user_id='$idref'";
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, nom_id, user_id, user_name FROM registration WHERE user_id='$ref_id_fast'"));
				$date_ref=$query_fast['subs_date'];
				$user_id_fast=$query_fast['user_id'];
				$ref_id_fast=$query_fast['ref_id'];
				 $nom_idfast=$query_fast['nom_id'];
			//	 echo '<br>'.$query_fast['user_name'];
				
				if($date_ref>$date){
					if($flag_fast==1){
						 $percent=30;
					//	 echo $flag_fast;
					//	echo '<br>';
						//echo '<br>'.$query_fast['user_name'];
					//	echo "INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$fsb1', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r' , invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ";
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$fsb1', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r' , invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ");
						$flag_fast=2;
					}
					else{
						 $percent=5;
						// echo '<br>'.$query_fast['user_name'];
					// echo '<br>';
						// echo "INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$fsb', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ";
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$fsb', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ");
						
					}
				}
				$idref=$ref_id_fast;
				
				
				$i++;
				if($i==5) break;
			}
			
			//if subscription for 12 month
			
			if($sub_for>1){
				 $percent=5;
				$plan_amt1l=$plan_amt-($plan_amt/$sub_for);
				$sub_for1l=$sub_for-1;
				$restcomml=($plan_amt1l/$sub_for1l);
				$restcomml=round($restcomml, 2);
			//echo '<br>';
				  $flag_level=1; $il=1;
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   nom_id FROM registration WHERE user_id='$ref_id'"));
				 $idnom=$query_levelc['nom_id'];
			}
			$percentl=7.5;
			$percentm=5;
			$levelc=$restcomml*0.075;
			$levelc=round($levelc, 3);
			 $matchc=$levelc*0.05;
			 //echo $idnom;
				while($idnom!='cmp'){
				
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$idnom'"));
					 $date_refl=$query_levelc['subs_date'];
					
					
					$id_refl=$query_levelc['ref_id'];
					if($date_refl>$date){
					//echo "INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$idnom', '$id' ,'Valunaire Subscription', '$restcomml', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')";
						
						$idnom_mat=$query_levelc['nom_id'];
						mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$idnom', '$id' ,'Valunaire Subscription', '$restcomml', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')");
						$il++;
						$im=1;
						while($idnom_mat!='cmp'){
							/************* MATCHING BONUS ***********/
							
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$id_refl' and gstatus=1"));
							$date_refm=$query_levelm['subs_date'];
							 $id_refl=$query_levelm['ref_id'];
							$idnom_mat=$query_levelm['nom_id'];
							if($idnom_mat=='cmp') break;
							if($id_refl=='cmp'  || $id_refl=='') break;
							if($date_refm>$date){
								
								mysql_query("INSERT INTO level_income SET income_id='$id_refl' , down_id='$id', package='Valunaire Subscription', commission='$restcomml', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im' ");
								$im++;
							}
							
							if($im==5) break;
						}
					}
					if($il==5)	break;
					 $idnom=$query_levelc['nom_id'];
					if($idnom=='cmp') break;
				}	
			
		
			}
			
		}
		else{   $flag_level=1; $il=1;
		 'dynamic<BR>';
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   nom_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['nom_id'];
			}
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					
					// 'REFID:';
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date){
						
						$idnom_mat=$query_levelc['nom_id'];
						 'LEVEL:<br>';
						 "INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$idnoml', '$id' ,'Valunaire Subscription', '$levelc', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')";
						 '<br>';
						mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$idnoml', '$id' ,'Valunaire Subscription', '$levelc', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')");
						$il++;
						while($idnom_mat!='cmp'){
							/************* MATCHING BONUS ***********/
							$im=1;
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$id_refm' and gstatus=1"));
							$date_refm=$query_levelm['subs_date'];
							$id_refm=$query_levelm['ref_id'];
							$idnom_mat=$query_levelm['nom_id'];
							if($id_refm=='') break;
							if($date_refm>$date){
								
								// 'MATCHING:<br>';
								
								//echo "INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Valunaire Subscription', commission='$matchc', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'";
								 '<br>';
								mysql_query("INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Valunaire Subscription', commission='$matchc', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'");
								$im++;
							}
							
							if($im>5) break;
						}
					} $idnoml=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
			
			
		
		}
	 	
		
  	
  }
  
	else { 
		//echo 'affiliate';
		 '<br>';
		///********* For Affiliate ***********/
		
		
			 /* $quers_subs1="select reg.user_type from registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id where reg.user_id='$id' and ms.s_date>='$check_date' ";
			 
		  $quers_pro1=("select user_type from registration reg inner join mem_products mp ON mp.user_id=reg.user_id where reg.user_id='$id'  and mp.s_date>='$check_date'");
		  $quers_bun1= ("select user_type from registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id where  reg.user_id='$id' and DATE(mb.date)>='$check_date' ");*/
		 
		 
		/**  If it is member's first product**/

 	$flag=1; // for 1st sale of first month
 	if($count_bun==0  || $count_pro==0 || $count_subs==0){
		if($count_bun==0 || $count_pro==0){
			if($count_bun==0){
				if($count_pro==0){
					 if($count_subs==1){
						 $flag=2;
					}
				}
				else if($count_subs==0){
					if($count_pro==1)  $flag=2;
				}
				
			}
			else{ 
				if($count_pro==0 && $count_subs==0){
					if($count_bun==1)   $flag=2;
				}
				else if($count_pro==0 && $count_bun==0){
					if($count_subs==1)  $flag=2;
				}
			}		
			
		} else{
			$flag=1;
		}
	}  $flag;
	if($flag==2){
	 if($user_type=='c')
	  { $percent=50;
		 $onemonthcomm=(($plan_amt/$sub_for)*0.50);
		if($sub_for>1){
			$percent=25;
			$plan_amt1=$plan_amt-($plan_amt/$sub_for);
			$sub_for1=$sub_for-1;
			$restcomm=(($plan_amt1/$sub_for1)*0.25);
			$restcomm=round($restcomm, 2);
			mysql_query("insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Valunaire Subscription', '$restcomm', 'Direct Sale Commission',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')");
		}
	  }
	  else if ($user_type=='m')
	  {  $percent=50;
		  $onemonthcomm=(($plan_amt/$sub_for)*0.50);
		if($sub_for>1){
			$percent=7.5;
			$plan_amt1=$plan_amt-($plan_amt/$sub_for);
			$sub_for1=$sub_for-1;
			$restcomm=(($plan_amt1/$sub_for1)*0.075);
			$restcomm=round($restcomm, 2);
			mysql_query("insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Valunaire Subscription(11 Month)', '$restcomm', 'Direct Sale Commission',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')");
		}
			
			
		}
		// $onemonthcomm=$onemonthcomm+$restcomm;
		$onemonthcomm=round($onemonthcomm, 2);
		$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Valunaire Subscription', '$onemonthcomm', 'Direct Sale Commission',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')";
}
else if($flag==1){
 	if($user_type=='c'){
		$percent=25;
		$onemonthcomm=(($plan_amt/$sub_for)*0.25);
		if($sub_for>1){
				$plan_amt1=$plan_amt-($plan_amt/$sub_for);
				$sub_for1=$sub_for-1;
				$restcomm=(($plan_amt1/$sub_for)*0.25);
				$restcomm=round($restcomm, 2);
				mysql_query("insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Valunaire Subscription(11 Month)', '$restcomm', 'Direct Residual Bonus',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')");
			}
  }
  else if ($user_type=='m')
  { $percent=7.5;
	$onemonthcomm=(($plan_amt/$sub_for)*0.075);
	if($sub_for>1){
			$plan_amt1=$plan_amt-($plan_amt/$sub_for);
			$sub_for1=$sub_for-1;
			$restcomm=(($plan_amt1/$sub_for)*0.075);
			$restcomm=round($restcomm, 2);
				mysql_query("insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Valunaire Subscription', '$restcomm', 'Direct Residual Bonus',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')");
		}
		
		
	}
	//$onemonthcomm=$onemonthcomm+$restcomm;
	$onemonthcomm=round($onemonthcomm, 2);
	$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Valunaire Subscription', '$onemonthcomm', 'Direct Residual Bonus',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')";

	/*$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$ref_id'"));
$fbalance1=$fbal_1[amount]+$onemonthcomm;*/

 /*$com112="insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id','$onemonthcomm','$userid',CURDATE(),'Direct Commission','0','$user_id','Direct Commission from  $user_id','$fbalance1')";
$res11=mysql_query($com112);
$final_ewallet5=mysql_query("update final_e_wallet set amount=(amount+$onemonthcomm) where user_id='$ref_id'");
	
	 
	  $inslev56="insert into  level_income1 (user_id, credit_amt, sender_id,   TranDescription, final_bal, income_id , package,  ,commission, remark,l_date,status) values ('$ref_id','$onemonthcomm','$id',  'Direct Commission', '$id','Direct Commission from  $id','$fbalance1', '$ref_id', '$onemonthcomm', 'Direct Commission', CURDATE(),'0')";
	  */  
  
 /***********End: Commision *********/ 
  }  $flag;
     $inslev56;
  $inslevel4=mysql_query($inslev56) or die(mysql_error());
 }
 }
} 
//upgrade_com(1225555997);
 ///***** BUNDLE COMMISSION ********////
 function bundle_com($invoice){
 	 $date=date('Y-m-d'); 
	 //echo "SELECT reg.user_id, reg.ref_id, reg.user_type, mb.* FROM mem_bundle mb inner join registration reg ON reg.user_id=mb.user_id WHERE invoice='$invoice'";
	$result_ref=mysql_fetch_array(mysql_query("SELECT reg.user_id, reg.ref_id, reg.user_type, reg.nom_id, mb.* FROM mem_bundle mb inner join registration reg ON reg.user_id=mb.user_id WHERE invoice='$invoice'"));
	$ref_id=$result_ref[ref_id];
	 $id=$result_ref[user_id];
	$user_type=$result_ref[user_type];
	$result_reftype=mysql_fetch_array(mysql_query("SELECT user_type from membership where user_id='$ref_id'"));
	
	
	 $plan_amt=$result_ref[price];
	$sub_for=$result_ref[sub_for];
	$user_typeref=$result_reftype['user_type'];
 	/*$quers_sid1="select count(*), user_type from registration where user_id='$ref_id'";
   	$dat_sid=mysql_query($quers_sid1);
 
   $reff_show=mysql_fetch_array($dat_sid);*/
   $date1=strtotime($date);
	$check_date=date('Y-m-d',strtotime("-1 months",$date1));
	if($user_typeref=='m')
	{
	
	
			$quers_subs = new Database();  
	
	$quers_subs->select('registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and ms.s_date>='$check_date'"); 
	 $count_subs= $quers_subs->numResults;
	
	//$show_subs = $quers_subs->getResult(); 
	/**********End: For subscription *******/
	
	/********** For check the Products *******/
	$quers_pro = new Database();  
	
	$quers_pro->select('registration reg INNER JOIN mem_products mp ON mp.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and mp.s_date>='$check_date'"); 
	 $count_pro= $quers_pro->numResults;
	
	//$show_pro = $quers_pro->getResult(); 
	/**********End: For Products *******/
	/********** For check the Products'bundle *******/
	$quers_bun = new Database();  
	
	$quers_bun->select('registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and DATE(mb.date)>='$check_date'"); 
	 $count_bun= $quers_bun->numResults;
	
	//$show_bun = $quers_bun->getResult(); 
		///////****** For check the member is affiliate or representative
	  $quers_sid="select reg.user_type as user_type from registration reg  where reg.user_id='$ref_id' and subs_date>='$date'";
	   $dat_sid=mysql_query($quers_sid) or die(mysql_error());
	   $level=0;
				/*$user_nom=$id;
				while($user_nom!='cmp' || $level==5){
					$res_nom=mysql_fetch_array(mysql_query("SELECT nom_id FROM registration WHERE user_id='$user_nom'"));
					$user_nom=$res_nom[nom_id];
					mysql_query("INSERT INTO notify SET user_id='$id', nom_id='$user_nom', date=NOW(), note='product'");
					
					$level++;
				}*/
	   $count_ref=mysql_num_rows($dat_sid);
	   if($count_ref>=1){
		 
		///********* For Representative ***********/
		 $flag_fast=1;
	
	 	$i=1;  $idnom=$result_ref[nom_id]; $idref=$id;
			if($count_bun==0  || $count_pro==0 || $count_subs==0){
		if($count_bun==0 || $count_pro==0){
			if($count_bun==0){
				if($count_pro==0){
					 if($count_subs==1){
						$flag=2;
					}
				}
				else if($count_subs==0){
					if($count_pro==1) $flag=2;
				}
				
			}
			else{
				if($count_pro==0 && $count_subs==0){
					if($count_bun==1) $flag=2;
				}
				else if($count_pro==0 && $count_bun==0){
					if($count_subs==1) $flag=2;
				}
			}		
			
		} else{
			$flag=1;
		}
	} 	
	if($flag==2){
			/****** FAST START BONUS  *******/
		//echo 'fast';
			 $fsb1=($plan_amt)*0.30;
			 $fsb=($plan_amt)*0.05;
			 '<br>';
			 $idnom_pb=$idnom;
			  $ref_id_fast=$ref_id;
			while($ref_id_fast!='cmp'){
				//echo "SELECT subs_date, ref_id, nom_id FROM registration WHERE user_id='$ref_id_fast'";
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, nom_id, user_id FROM registration WHERE user_id='$ref_id_fast'"));
				 $date_ref=$query_fast['subs_date'];
				
				$user_id_fast=$query_fast['user_id'];
				
				
				if($date_ref>$date){
					if($flag_fast==1){
						$percent=30;
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Bundle Purchase', commission='$fsb1', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r' , invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ");
						$flag_fast=2;
					}
					else{
						$percent=5;
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Bundle Purchase', commission='$fsb', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ");
						
					}
				} $ref_id_fast=$query_fast['ref_id'];
				//$idref=$ref_id_fast;
				$ref_id_fast=$ref_id_fast;
				//if($nom_idfast=='cmp') break;
				
				if($i==5) break;
				$i++;
			}
			
			
		}
		else{   $flag_level=1; $il=1;
		//echo 'dynamic<BR>';
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   nom_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['nom_id'];
			}
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					
					 'REFID:';
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date){
						
						$idnom_mat=$query_levelc['nom_id'];
						 'LEVEL:<br>';
						 "INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$idnoml', '$id' ,'Product Bundle Purchase', '$levelc', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')";
						 '<br>';
						mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$idnoml', '$id' ,'Product Bundle Purchase', '$levelc', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')");
						while($idnom_mat!='cmp'){
							/************* MATCHING BONUS ***********/
							$im=1;
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$id_refm' and gstatus=1"));
							$date_refm=$query_levelm['subs_date'];
							$id_refm=$query_levelm['ref_id'];
						 	$idnom_mat=$query_levelm['nom_id'];
							if($id_refm=='' || $id_refm=='cmp') break;
							if($date_refm>$date){
								$im++;
								// 'MATCHING:<br>';
								
								//echo "INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Product Bundle Purchase', commission='$matchc', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'";
								 '<br>';
								mysql_query("INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Product Bundle Purchase', commission='$matchc', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'");
							}
							
							if($im==5) break;
						}
						$il++;
					} $idnoml=$query_levelc['nom_id'];
					if($idnom_mat=='cmp') break;
					if($idnoml=='cmp') break;
					if($il==5)	break;
				}	
			
			
		
		}
	 	
		
	  }
	else 
	{ //echo 'aff';
	///********* For Affiliate ***********/
	
	/********** For check the subscription *******/

	/**********End: For Products's bundle *******/
		 /* $quers_subs1="select reg.user_type from registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id where reg.user_id='$id' and ms.s_date>='$check_date' ";
		 
	  $quers_pro1=("select user_type from registration reg inner join mem_products mp ON mp.user_id=reg.user_id where reg.user_id='$id'  and mp.s_date>='$check_date'");
	  $quers_bun1= ("select user_type from registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id where  reg.user_id='$id' and DATE(mb.date)>='$check_date' ");*/
	 
	 
	/**  If it is member's first product**/
	 $flag=1; // for 1st sale of first month
 	if($count_bun==0  || $count_pro==0 || $count_subs==0){
		if($count_bun==0 || $count_pro==0){
			if($count_bun==0){
				if($count_pro==0){
					 if($count_subs==1){
						$flag=2;
					}
				}
				else if($count_subs==0){
					if($count_pro==1)   $flag=2;
				}
				
			}
			else{
				if($count_pro==0 && $count_subs==0){
					if($count_bun==1)  $flag=2;
				}
				else if($count_pro==0 && $count_bun==0){
					if($count_subs==1)  $flag=2;
				}
			}		
			
		} else{
			$flag=1;
		}
	}  $flag;
	if($flag==2){
		 if($user_type=='c')
		  { $percent=50;
			$onemonthcomm=(($plan_amt)*0.50);
			
		  }
		  else if ($user_type=='m')
		  { $percent=50;
			$onemonthcomm=(($plan_amt)*0.50);
			
		}
			
			$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Product Bundle Purchase', '$onemonthcomm', 'Direct Sale Commission',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')";
	}
	 else{
		if($user_type=='c'){
			$percent=25;
			$onemonthcomm=(($plan_amt)*0.25);
			
	  }
	  else if ($user_type=='m')
	  { $percent=7.5;
		$onemonthcomm=(($plan_amt)*0.075);
		
		}
		
		$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Product Bundle Purchase', '$onemonthcomm', 'Direct Residual Bonus',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')";
	}
		/*$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$ref_id'"));
	$fbalance1=$fbal_1[amount]+$onemonthcomm;*/
	
	 /*$com112="insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id','$onemonthcomm','$userid',CURDATE(),'Direct Commission','0','$user_id','Direct Commission from  $user_id','$fbalance1')";
	$res11=mysql_query($com112);
	$final_ewallet5=mysql_query("update final_e_wallet set amount=(amount+$onemonthcomm) where user_id='$ref_id'");
		
		 
		  $inslev56="insert into  level_income1 (user_id, credit_amt, sender_id,   TranDescription, final_bal, income_id , package, down_id_package ,commission, remark,l_date,status) values ('$ref_id','$onemonthcomm','$id',  'Direct Commission', '$id','Direct Commission from  $id','$fbalance1', '$ref_id', '$onemonthcomm', 'Direct Commission', CURDATE(),'0')";
		  */  $inslev56;
	  $inslevel4=mysql_query($inslev56) or die(mysql_error());
	  
	 /***********End: Commision *********/ 
	  }  
  }
	
}

//bundle_com(1254213522);


//******* Product	COMMISSION **********/
 function product_com($invoice){
 	 $date=date('Y-m-d');
 	 "SELECT reg.user_id, reg.ref_id, reg.user_type, mb.* FROM mem_products mb inner join registration reg ON reg.user_id=mb.user_id WHERE invoice='$invoice'".'<br';
 	$result_ref=mysql_fetch_array(mysql_query("SELECT reg.user_id, reg.ref_id, reg.user_type, reg.nom_id, mb.* FROM mem_products mb inner join registration reg ON reg.user_id=mb.user_id WHERE invoice='$invoice'"));
	$ref_id=$result_ref[ref_id];
	 $id=$result_ref[user_id];
	 $user_type=$result_ref[user_type];
	$result_reftype=mysql_fetch_array(mysql_query("SELECT user_type from membership where user_id='$ref_id'"));
	
	
	 $plan_amt=$result_ref[price];
	$sub_for=$result_ref[sub_for];
	 $user_typeref=$result_reftype['user_type'];
	if($user_typeref=='m')
	{
	
	/* if($user_type=='c')
	  {
		$onemonthcomm=(($plan_amt)*0.50);
		}
		else if ($user_type=='m')
		{
		$onemonthcomm=(($plan_amt)*0.25);
		}
		$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$ref_id'"));
	$fbalance1=$fbal_1[amount]+$onemonthcomm;
	
	  $inslev56="insert into  level_income1 (user_id, credit_amt, sender_id,  ttype, TranDescription, final_bal, income_id , package, down_id_package ,commission, remark,l_date,status) values ('$ref_id','$onemonthcomm','$id', '$id', 'Direct Commission', '$id','Direct Commission from  $id','$fbalance1', '$ref_id', '$onemonthcomm', 'Direct Commission', CURDATE(),'0')";
	  $inslevel4=mysql_query($inslev56);	
	*/  
	
		///////****** For check the member is affiliate or representative
		
		/*(select reg.user_type from registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id where reg.user_id='$ref_id' and ms.s_date>='$check_date') union (select user_type from registration reg inner join mem_products mp ON mp.user_id=reg.user_id where reg.user_id='$ref_id'  and mp.s_date>='$check_date'
	 ) union (select user_type from registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id where  reg.user_id='$ref_id' and DATE(mb.date)>='$check_date' )*/
	   $quers_sid=" select reg.user_type as user_type from registration reg  where reg.user_id='$ref_id' and subs_date>='$date'";
	   $dat_sid=mysql_query($quers_sid) or die(mysql_error());
	   /*$level=0;
				$user_nom=$id;
				while($user_nom!='cmp' || $level==5){
					$res_nom=mysql_fetch_array(mysql_query("SELECT nom_id FROM registration WHERE user_id='$user_nom'"));
					$user_nom=$res_nom[nom_id];
					mysql_query("INSERT INTO notify SET user_id='$id', nom_id='$user_nom', date=NOW(), note='product'");
					
					$level++;
				}*/
	   $count_ref=mysql_num_rows($dat_sid);
	   /********** For check the subscription *******/
	$quers_subs = new Database();  
	
	$quers_subs->select('registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and ms.s_date>='$check_date'"); 
	 $count_subs= $quers_subs->numResults;
	
	$show_subs = $quers_subs->getResult(); 
	/**********End: For subscription *******/
	
	/********** For check the Products *******/
	$quers_pro = new Database();  
	
	$quers_pro->select('registration reg INNER JOIN mem_products mp ON mp.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and mp.s_date>='$check_date'"); 
	 $count_pro= $quers_pro->numResults;
	
	$show_pro = $quers_pro->getResult(); 
	/**********End: For Products *******/
	/********** For check the Products'bundle *******/
	$quers_bun = new Database();  
	
	$quers_bun->select('registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id','reg.user_type',"reg.user_id='$id' and DATE(mb.date)>='$check_date'"); 
	 $count_bun= $quers_bun->numResults;
	
	$show_bun = $quers_bun->getResult(); 
	/**********End: For Products's bundle *******/
	   if($count_ref>=1){
		 
		///********* For Representative ***********/
		 $flag_fast=1;
		$flag=1;
	 	$i=1;  $idnom=$result_ref[nom_id]; $idref=$id;
			if($count_bun==0  || $count_pro==0 || $count_subs==0){
		if($count_bun==0 || $count_pro==0){
			if($count_bun==0){
				if($count_pro==0){
					 if($count_subs==1){
						 $flag=2;
					}
				}
				else if($count_subs==0){
					if($count_pro==1)  $flag=2;
				}
				
			}
			else{ 
				if($count_pro==0 && $count_subs==0){
					if($count_bun==1)   $flag=2;
				}
				else if($count_pro==0 && $count_bun==0){
					if($count_subs==1)  $flag=2;
				}
			}		
			
		} else{
			$flag=1;
		}
	}  $flag;
	if($flag==2){ $flag_fast=1;
			/****** FAST START BONUS  *******/
		 'fast';
		 "<br>";
	
			 $fsb1=(($plan_amt)*0.30);
			 $fsb=($plan_amt)*0.05;
			 '<br>';
			 $ref_id_fast=$ref_id;
			while($idnom!='cmp'){
			//echo  "SELECT subs_date, ref_id, nom_id FROM registration WHERE user_id='$idref'";
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, nom_id, user_id FROM registration WHERE user_id='$ref_id_fast'"));
				$date_ref=$query_fast['subs_date'];
				$ref_id_fast=$query_fast['ref_id'];
				$user_id_fast=$query_fast['user_id'];
				 $nom_idfast=$query_fast['nom_id'];
				//echo $date.'<br>'.$date_ref.'<br>';
				
				if($date_ref>$date){ 
					if($flag_fast==1){
						$percent=30;
						//echo "INSERT INTO level_income SET income_id='$ref_id_fast' , down_id='$id', package='Product Purchase', commission='$fsb1', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r' , invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ";
						
						$flag_fast=2;
					}
					else{
						$percent=5;
						}
						//echo "INSERT INTO level_income SET income_id='$ref_id_fast' , down_id='$id', package='Product Purchase', commission='$fsb', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ";
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Purchase', commission='$fsb', remark='Fast Start Bonus',l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt' ");
						
					
				}  
				//$idref=$ref_id_fast;
				$idnom=$nom_idfast;
				
				
				if($i==5) break;
				$i++;
			}
			
			
		}
		else{   $flag_level=1; $il=1;
		 'dynamic<BR>';
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   user_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['user_id'];
			}
			$i;
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, user_id, subs_date FROM registration WHERE user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					$uderid_level=$query_levelc['user_id'];
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date){
						
						$idnom_mat=$query_levelc['nom_id'];
						 echo '<br>';
						//echo "INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$uderid_level', '$id' ,'Product Purchase', '$levelc', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')";
					//	mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$uderid_level', '$id' ,'Product Purchase', '$levelc', 'Dynamic Level Based Residual Commission',CURDATE(),'0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')");
					//echo	$il++; 
					$im=1;
						while($idnom_mat!='cmp'){
							/************* MATCHING BONUS ***********/
							
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date FROM registration WHERE user_id='$id_refm' and gstatus=1"));
							$date_refm=$query_levelm['subs_date'];
							$id_refm=$query_levelm['ref_id'];
							$idnom_mat=$query_levelm['nom_id'];
							if($id_refm=='') break;
							if($date_refm>$date){
								
								//echo "INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Product Purchase', commission='$matchc', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'";
								 '<br>';
								mysql_query("INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Product Purchase', commission='$matchc', remark='Matching Bonus', l_date=CURDATE(),status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'");
								$im++;
							}
							
							if($im>5) break;
						}
					} $idnoml=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
			
			
		
		}
	 	
		
	  }
	else 
	{   'affffffff';
	///********* For Affiliate ***********/
	
	
		 /* $quers_subs1="select reg.user_type from registration reg INNER JOIN mem_subscribe ms ON ms.user_id=reg.user_id where reg.user_id='$id' and ms.s_date>='$check_date' ";
		 
	  $quers_pro1=("select user_type from registration reg inner join mem_products mp ON mp.user_id=reg.user_id where reg.user_id='$id'  and mp.s_date>='$check_date'");
	  $quers_bun1= ("select user_type from registration reg INNER JOIN mem_bundle mb ON mb.user_id=reg.user_id where  reg.user_id='$id' and DATE(mb.date)>='$check_date' ");*/
	 
	 
	/**  If it is member's first product**/
	 $flag=1; // for 1st sale of first month
 	
	 	$i=1;  $idnom=$result_ref[nom_id]; $idref=$id;
			if($count_bun==0  || $count_pro==0 || $count_subs==0){
		if($count_bun==0 || $count_pro==0){
			if($count_bun==0){
				if($count_pro==0){
					 if($count_subs==1){
						 $flag=2;
					}
				}
				else if($count_subs==0){
					if($count_pro==1)  $flag=2;
				}
				
			}
			else{ 
				if($count_pro==0 && $count_subs==0){
					if($count_bun==1)   $flag=2;
				}
				else if($count_pro==0 && $count_bun==0){
					if($count_subs==1)  $flag=2;
				}
			}		
			
		} else{
			$flag=1;
		} }  $flag;
	if($flag==2){
	 
		 if($user_type=='c')
		  { $percent=50;
			 $onemonthcomm=($plan_amt*0.50);
			
		  }
		  else if ($user_type=='m')
		  { $percent=50;
			$onemonthcomm=($plan_amt*0.50);
				
			}
			
			 $inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Product Purchase', '$onemonthcomm', 'Direct Sale Commission',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')";
	}
	 else{
		if($user_type=='c'){
			$percent=25;
			$onemonthcomm=(($plan_amt)*0.25);
			
	  }
	  else if ($user_type=='m')
	  { $percent=7.5;
		$onemonthcomm=(($plan_amt)*0.075);
		
		}
		
		 $inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent) values ('$ref_id', '$id' ,'Product Purchase', '$onemonthcomm', 'Direct Residual Bonus',CURDATE(),'0', 'a', 1, '$invoice', '$plan_amt', '$percent')";
	}
		/*$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$ref_id'"));
	$fbalance1=$fbal_1[amount]+$onemonthcomm;*/
	 $inslev56;
	  $inslevel4=mysql_query($inslev56) or die(mysql_error());
	  
	 /***********End: Commision *********/ 
	  }
	  
	 }// End if of ref user_type

}
//product_com(1292081500); 
?>