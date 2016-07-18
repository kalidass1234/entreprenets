<?php session_start(); 
//include_once('connection.php');
//include_once('function.php');

function upgrade_com($invoice, $closing) {
	
	$date=date('Y-m-d');
	$cdate=strtotime($date);
	$check_date=date('Y-m-d',strtotime("-1 months",$cdate)); 
	$sql_tax=mysql_fetch_array(mysql_query("select * from tax order by id desc limit 1"));
	$income_tax=$sql_tax['income'];
	$result_ref=mysql_fetch_array(mysql_query("SELECT reg.user_id, reg.ref_id, reg.user_type, reg.nom_id, reg.mstatus, reg.mem_status, ms.*, reg.first_name, reg.mid_name, reg.last_name, reg.email FROM mem_subscribe ms inner join registration reg ON reg.user_id=ms.user_id WHERE invoice='$invoice'"));
	
	$fullname=$result_ref['first_name'].' '.$result_ref['mid_name'].' '.$result_ref['last_name'];
	$ref_id=$result_ref['ref_id']; 
	$result_reftype=mysql_fetch_array(mysql_query("SELECT mem.user_type, reg.astatus, reg.email from membership mem INNER JOIN registration reg ON reg.user_id=mem.user_id where mem.user_id='$ref_id'  and DATE(date)+INTERVAL 1 YEAR>='$date'"));
	 $id=$result_ref[user_id];
	 $user_type=$result_ref[user_type];
	
	 $plan_amt=$result_ref[price];
	$sub_for=$result_ref[sub_for];
	 $user_typeref=$result_reftype['user_type'];
	 $astatus=$result_reftype['astatus'];
	if($user_typeref=='m' ){
		
 	///////****** For check the member is affiliate or representative
 	 $quers_sid="(select reg.user_type as user_type from registration reg  where reg.user_id='$ref_id' and subs_date>='$date') ";
   $dat_sid=mysql_query($quers_sid) or die(mysql_error());
    $count_ref=mysql_num_rows($dat_sid);
   $level=1;
		$user_nom=$id;
		
		
			$flag=$result_ref['product_no']; 
			 $idnom=$result_ref['nom_id']; $idref=$id;
			 $plan_amt11m=$plan_amt-($plan_amt/$sub_for);
			 $plan_amt11m=round($plan_amt11m, 2);
			 $plan_amt1m=$plan_amt/$sub_for;
		 $plan_amt1m=round($plan_amt1m, 2);
   if($count_ref>=1 ){ 
	///********* For Representative ***********/
	 $flag_fast=1;
	
	 	$i=1;  
		// for 1st sale of first month
 	
	if($flag==2){
		
			/****** FAST START BONUS  *******/
			 $fsb1=(($plan_amt/$sub_for)*0.30);
			 $fsb=($plan_amt/$sub_for)*0.05;
			$fsb=round($fsb, 3);
			$fsb1=round($fsb1, 3);
			 $nom_idfast=$idnom;
			 $ref_id_fast=$ref_id;
			while($ref_id_fast!='cmp'){
			 //echo "SELECT subs_date, ref_id, nom_id FROM registration WHERE user_id='$ref_id_fast'<br>";
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, nom_id, reg.user_id, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$ref_id_fast'"));
				$date_ref=$query_fast['subs_date'];
				$user_id_fast=$query_fast['user_id'];
				
				 $nom_idfast=$query_fast['nom_id'];
				
				if($date_ref>$date){
					if($flag_fast==1){
						 $percent=30;
						if($query_fast['mem_status']==0 && $query_fast['mstatus']==0){
							$tax=($fsb1*$income_tax)/100;
							$amount=$fsb1-$tax;
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt1m', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$fsb1' ") ;
						
						$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$user_id_fast'"));
				$fbalance1=$fbal_1[amount]+$amount;
				/*$fbalance1=round($fbalance1,2);*/
				  $com112="insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')";
				$res11=mysql_query($com112);
				$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'");
						
						
						}
						 $flag_fast=2;
					}
					else{
						 $percent=5;
						 if($query_fast['mem_status']==0 && $query_fast['mstatus']==0){
							 $tax=($fsb*$income_tax)/100;
							$amount=$fsb-$tax;
							mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt1m', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$fsb' ");
						
							$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$user_id_fast'"));
							$fbalance1=$fbal_1[amount]+$amount;
							/*$fbalance1=round($fbalance1,2);*/
							  $com112="insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')";
							$res11=mysql_query($com112);
							mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'");
						}
					}					
					
				}
				
					$ref_id_fast=$query_fast['ref_id'];
				
				if($i==5) break;
				$i++;
			}
			
			//if subscription for 12 month
			
			if($sub_for>1){
			
				 $percent=5;
				$plan_amt1l=$plan_amt-($plan_amt/$sub_for);
				$sub_for1l=$sub_for-1;
				$restcomml=($plan_amt1l);
				$restcomml=round($restcomml, 2);
		
				  $flag_level=1; $il=1;
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			
			if($user_type=='c'){ 
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   user_id FROM registration WHERE user_id='$ref_id'"));
				 $idnom=$query_levelc['user_id'];
			}
			$percentl=7.5;
			$percentm=5;
			$levelc=$restcomml*0.075;
			
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc, 3);
			 $matchc=round($matchc,3);
			//echo "SELECT  ref_id, nom_id, subs_date, user_id FROM registration WHERE user_id='$idnom'";
				while($idnom!='cmp'){
				//echo "SELECT  ref_id, nom_id, subs_date, reg.user_id, mstatus, mem_status, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnom'";
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, reg.user_id, mstatus, mem_status, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnom'"));
					 $date_refl=$query_levelc['subs_date'];
					$userid_match=$query_levelc['user_id'];
					
					$id_refl=$query_levelc['ref_id'];
					if($date_refl>$date  && $query_levelc['astatus']==1){
						$tax=($levelc*$income_tax)/100;
						$amount=$levelc-$tax;
						$idnom_mat=$query_levelc['nom_id'];
						 if($query_levelc['mem_status']==0 && $query_levelc['mstatus']==0){
							 $tax=($levelc*$income_tax)/100;
							$amount=$levelc-$tax;
							mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level, payout_date, closing_no, tax, final_amount) values ('$userid_match', '$id' ,'Valunaire Subscription', '$amount', 'Dynamic Level Based Residual Commission','$date','1', 'r', '$invoice', '$percentl', '$plan_amt11m', '$il', '$date', '$closing', '$tax', '$levelc')");
							
							$fbalance1=$query_levelc['amount']+$amount;
							/*$fbalance1=round($fbalance1,2);*/
							 $com112="insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$userid_match','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$userid_match','Dynamic Level Based Residual Commission Earned','$fbalance1')";
							mysql_query($com112);
							mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$userid_match'");
							
						}
						$il++;
						$im=1; $temp_match=$id_refl;
						while($temp_match!='cmp'){
							/************* MATCHING BONUS ***********/
							
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, gstatus, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match' "));
							$date_refm=$query_levelm['subs_date'];
							
							if($date_refm>$date &&  $query_levelm['gstatus']==1){
								 $tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
								if($query_levelm['mem_status']==0 && $query_levelm['mstatus']==0){
									mysql_query("INSERT INTO level_income SET income_id='$temp_match' , down_id='$userid_match', package='Valunaire Subscription', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$matchc' ");
									$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_match','$amount','Valunaire Admin','$date','Matching Bonus Earned','0','$temp_match','Matching Bonus Earned','$fbalance1')");
									
									mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_match'");
								}
								$im++;
							}
							 $temp_match=$query_levelm['ref_id'];
							if($im>5) break;
						}
					}
					if($il>5)	break;
					 $idnom=$query_levelc['nom_id'];
					
				}	
			}
			
		}
		else{   $flag_level=1; $il=1;
		 'dynamic<BR>';
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   user_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['user_id'];
			}
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $plan_amt11m=$plan_amt-($plan_amt/$sub_for);
			 $plan_amt11m=round($plan_amt11m, 2);
			 $plan_amt1m=$plan_amt/$sub_for;
		 $plan_amt1m=round($plan_amt1m, 2);
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, mem_status, mstatus, fewa.amount, astatus FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['nom_id'];
						$memstatus= $query_levelc['mem_status'];
						$mstatus=$query_levelc['mstatus'];
						if($memstatus==0 && $mstatus==0){
							$tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
							mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level, payout_date, closing_no, tax, final_amount) values ('$idnoml', '$id' ,'Valunaire Subscription', '$amount', 'Dynamic Level Based Residual Commission','$date','1', 'r', '$invoice', '$percentl', '$plan_amt', '$il', '$date', '$closing', '$tax', '$levelc')");
							$fbalance1=$query_levelc[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$idnoml','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$idnoml','Dynamic Level Based Residual Commission Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$idnoml'");
						}
						$il++;
						
						/************* MATCHING BONUS ***********/
							
						$temp_match=$id_refm;
						$im=1;
						while($temp_match!='cmp'){
							 /*and gstatus=1*/
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, gstatus, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match'"));
							$date_refm=$query_levelm['subs_date'];
							
							if($date_refm>$date  && $query_levelm['gstatus']==1){
								
								$memstatus= $query_levelm['mem_status'];
							$mstatus=$query_levelm['mstatus'];
							if($memstatus==0 && $mstatus==0){
								$tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
								mysql_query("INSERT INTO level_income SET income_id='$temp_match' , down_id='$idnoml', package='Valunaire Subscription', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date' , closing_no='$closing', tax='$tax', final_amount='$matchc'");
								$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_match','$amount','Valunaire Admin', '$date', 'Matching Bonus Earned','0','$temp_match','Matching Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_match'");
								}
								$im++;
							}
							$temp_match=$query_levelm['ref_id'];
							
							if($im>5) break;
						}
					} $idnoml=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
		
		}
	 	
		
  	
  }
  
	else { 
		//echo 'affiliate'.'<br>';
		 
		///********* For Affiliate ***********/
		
		/**  If it is member's first product**/	
	if($flag==2){
		$plan_amt1m=$plan_amt/$sub_for;
		$plan_amt1=$plan_amt-($plan_amt1m);
		$memstatus= $result_ref['mem_status'];
			$mstatus=$result_ref['mstatus'];
	 if($user_type=='c')
	  { $percent=50;
		 $onemonthcomm=(($plan_amt/$sub_for)*0.50);
		 
		if($sub_for>1){
			$rest_percent=25;
			
			$restcomm=(($plan_amt1)*0.25);
			
		}
	  }
	  else if ($user_type=='m')
	  {  $percent=50;
		  $onemonthcomm=(($plan_amt/$sub_for)*0.50);
		
			if($sub_for>1){
			$rest_percent=7.5;
			
			$restcomm=(($plan_amt1)*0.075);
			
			}
			
		}
		if($sub_for>1){
			$restcomm=round($restcomm, 2);
			if($memstatus==0 && $mstatus==0){
				$tax=($restcomm*$income_tax)/100;
								 $amount=$restcomm-$tax;
				mysql_query("insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount ) values ('$ref_id', '$id' ,'Valunaire Subscription', '$amount', 'Direct Residual Bonus','$date','1', 'a', 1, '$invoice', '$plan_amt1', '$rest_percent', '$date', '$closing', '$tax', '$restcomm' )");
						
									$fbalance1=$result_ref[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id','$amount','Valunaire Admin','$date','Direct Residual Bonus Earned','0','$ref_id','Direct Residual Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$ref_id'");
			}
		}
		// $onemonthcomm=$onemonthcomm+$restcomm;
		$onemonthcomm=round($onemonthcomm, 2);
		$tax=($onemonthcomm*$income_tax)/100;
								 $amount=$onemonthcomm-$tax;
		$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount) values ('$ref_id', '$id' ,'Valunaire Subscription', '$amount', 'Direct Sale Commission','$date','1', 'a', 1, '$invoice', '$plan_amt1m', '$percent', '$date', '$closing', '$tax', '$onemonthcomm')";
		
			  //	FAST START BONUS
	if($sub_for>1 ){
  $temp_fast=$ref_id;
  $temp_var_fast=2;
   $percent_fast=5;
   $com_fast_start=$plan_amt1m*0.05;
  
   $result_fast=mysql_fetch_array(mysql_query("SELECT  ref_id FROM registration WHERE user_id='$temp_fast'"));
    $temp_fast=$result_fast['ref_id'];
  		while($temp_fast!='cmp'){
			// echo "SELECT subs_date, ref_id, user_id FROM registration WHERE user_id='$temp_fast'";
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, reg.user_id, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_fast'"));
				$date_ref=$query_fast['subs_date'];
				$user_id_fast=$query_fast['user_id'];
				$memstatus= $query_fast['mem_status'];
				$mstatus=$query_fast['mstatus'];
				if($date_ref>$date){
					if($memstatus==0 && $mstatus==0){
						$tax=($com_fast_start*$income_tax)/100;
								 $amount=$com_fast_start-$tax;
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Valunaire Subscription', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent_fast', level='$temp_var_fast', price='$plan_amt1m', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$com_fast_start' ");
						
							
									$fbalance1=$query_fast[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'");
					}
				}
				$temp_fast=$query_fast['ref_id'];
				
				if($temp_var_fast==5) break;
				$temp_var_fast++;
			}
	
	 //	FAST START BONUS:End
	 //Direct level Based residual commission
	 if($user_type=='m'){
	 $percent1=7.5;
	
	  //dynamic lavel commission on 2nd product purchase of affilliate
  			$levelc=$plan_amt11m*0.075;
			$percentl=7.5;
			$percentm=5;
			$il=1;
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			 $res_dynamic_aff=mysql_fetch_array(mysql_query("select nom_id from registration where user_id='$id'"));
			  $temp_dynamic=$res_dynamic_aff['nom_id'];
				while($temp_dynamic!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, mem_status, mstatus, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_dynamic'"));
					 $date_refl=$query_levelc['subs_date'];
					
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['nom_id'];
						$memstatus= $query_levelc['mem_status'];
						$mstatus=$result_ref['mstatus'];
						if($memstatus==0 && $mstatus==0){
							$tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
							mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level, payout_date, closing_no, tax, final_amount) values ('$temp_dynamic', '$id' ,'Valunaire Subscription', '$amount', 'Dynamic Level Based Residual Commission','$date','1', 'r', '$invoice', '$percentl', '$plan_amt11m', '$il', '$date', '$closing', '$tax', '$levelc')");
							
									$fbalance1=$query_levelc[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_dynamic','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$temp_dynamic','Dynamic Level Based Residual Commission Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_dynamic'");
						}
						$il++;
						
						/************* MATCHING BONUS ***********/
							
						$temp_match=$id_refm;
						$im=1;
						while($temp_match!='cmp'){
							 
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, gstatus, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match'"));
							$date_refm=$query_levelm['subs_date'];
							
							if($date_refm>$date  && $query_levelm['gstatus']==1){
								
								$memstatus= $query_levelm['mem_status'];
								$mstatus=$query_levelm['mstatus'];
								if($memstatus==0 && $mstatus==0){
									$tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
									mysql_query("INSERT INTO level_income SET income_id='$temp_match' , down_id='$temp_dynamic', package='Valunaire Subscription', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing',  tax='$tax', final_amount='$matchc'");
									$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_match','$amount','Valunaire Admin','$date','Matching Bonus Earned','0','$temp_match','Matching Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_match'");
								}
								$im++;
							}
							$temp_match=$query_levelm['ref_id'];
							
							if($im>5) break;
						}
					} $temp_dynamic=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
	}
	}
	//dynamic level residual commission: end
	
 }
 else if($flag==1 ){
 	if($user_type=='c'){
		$percent1=25;
		$onemonthcomm=(($plan_amt)*0.25);
		$onemonthcomm=round($onemonthcomm, 2);
		
  }
  else if ($user_type=='m')
  { $percent1=7.5;
	$onemonthcomm=(($plan_amt)*0.075);
	
	  //dynamic lavel commission on 2nd product purchase of affilliate
  			$levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			$il=1;
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			 $res_dynamic_aff=mysql_fetch_array(mysql_query("select nom_id from registration where user_id='$ref_id'"));
			  $temp_dynamic=$res_dynamic_aff['nom_id'];
				while($temp_dynamic!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, mem_status, mstatus, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_dynamic'"));
					 $date_refl=$query_levelc['subs_date'];
					
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['nom_id'];
						$memstatus= $query_levelc['mem_status'];
						$mstatus=$result_ref['mstatus'];
						if($memstatus==0 && $mstatus==0){
							$tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
							mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level, payout_date, closing_no, tax, final_amount) values ('$temp_dynamic', '$id' ,'Valunaire Subscription', '$amount', 'Dynamic Level Based Residual Commission','$date','1', 'r', '$invoice', '$percentl', '$plan_amt', '$il', '$date', '$closing', '$tax', '$levelc')");
							
									$fbalance1=$query_levelc[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_dynamic','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$temp_dynamic','Dynamic Level Based Residual Commission Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_dynamic'");
						}
						$il++;
						
						/************* MATCHING BONUS ***********/
							
						$temp_match=$id_refm;
						$im=1;
						while($temp_match!='cmp'){
							 
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, gstatus, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match'"));
							$date_refm=$query_levelm['subs_date'];
							
							if($date_refm>$date  && $query_levelm['gstatus']==1){
								
								$memstatus= $query_levelm['mem_status'];
								$mstatus=$query_levelm['mstatus'];
								if($memstatus==0 && $mstatus==0){
									$tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
									mysql_query("INSERT INTO level_income SET income_id='$temp_match' , down_id='$temp_dynamic', package='Valunaire Subscription', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$matchc'");
									$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_match','$amount','Valunaire Admin','$date','Matching Bonus Earned','0','$temp_match','Matching Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_match'");
								}
								$im++;
							}
							$temp_match=$query_levelm['ref_id'];
							
							if($im>5) break;
						}
					} $temp_dynamic=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
	}
	//$onemonthcomm=$onemonthcomm+$restcomm;
	$onemonthcomm=round($onemonthcomm, 2);
	$tax=($onemonthcomm*$income_tax)/100;
								 $amount=$onemonthcomm-$tax;
	$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount) values ('$ref_id', '$id' ,'Valunaire Subscription', '$amount', 'Direct Residual Bonus','$date','1', 'a', 1, '$invoice', '$plan_amt', '$percent1', '$date', '$closing', '$tax', '$onemonthcomm' )";

 /***********End: Commision *********/ 
  }  
  	$memstatus= $result_ref['mem_status'];
	$mstatus=$result_ref['mstatus'];
	 if($memstatus==0 && $mstatus==0){
		  $inslevel4=mysql_query($inslev56) or die(mysql_error());
		 
							$fbalance1=$result_ref[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id','$amount','Valunaire Admin','$date','Direct Residual Bonus Earned','0','$ref_id','Direct Residual Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$ref_id'");
	 }
 }
} 
mysql_query("update mem_subscribe set paid_status=1, closing_no='$closing' where invoice='$invoice'");
mysql_error();
}
//upgrade_com(1225555997);



 ///***** BUNDLE COMMISSION ********////
 function bundle_com($invoice, $closing){
	$sql_tax=mysql_fetch_array(mysql_query("select * from tax order by id desc limit 1"));
	$income_tax=$sql_tax['income'];
 	 $date=date('Y-m-d'); 
	 $cdate=strtotime($date);
	 	$check_date=date('Y-m-d',strtotime("-1 months",$cdate)); 
	 //echo "SELECT reg.user_id, reg.ref_id, reg.user_type, mb.* FROM mem_bundle mb inner join registration reg ON reg.user_id=mb.user_id WHERE invoice='$invoice'";
	$result_ref=mysql_fetch_array(mysql_query("SELECT reg.user_id, reg.ref_id, reg.user_type, reg.nom_id, reg.mem_status, reg.mstatus, mb.*, reg.first_name, reg.mid_name, reg.last_name FROM mem_bundle mb inner join registration reg ON reg.user_id=mb.user_id WHERE invoice='$invoice'"));
	$fullname=$result_ref['first_name'].' '.$result_ref['mid_name'].' '.$result_ref['last_name'];
	$ref_id=$result_ref[ref_id];
	 $id=$result_ref[user_id];
	$user_type=$result_ref[user_type];
	$result_reftype=mysql_fetch_array(mysql_query("SELECT mem.user_type, reg.astatus, reg.email from membership mem INNER JOIN registration reg ON reg.user_id=mem.user_id where mem.user_id='$ref_id'  and DATE(date)+INTERVAL 1 YEAR>='$date'"));
	$email=$result_reftype['reg.email'];
	
	 $plan_amt=$result_ref[price];
	$sub_for=$result_ref[sub_for];
	$user_typeref=$result_reftype['user_type'];
 	$astatus=$result_reftype['astatus'];
	if($user_typeref=='m' )
	{
	
	 $level=1;
	 $user_nom=$id;
				$product_name=$result_ref['product_name'];
		
		
				
		 $flag=$result_ref['product_no'];		
	
		///////****** For check the member is affiliate or representative
	  $quers_sid="select reg.user_type as user_type from registration reg  where reg.user_id='$ref_id' and subs_date>='$date'";
	   $dat_sid=mysql_query($quers_sid) or die(mysql_error());
	  
	   $count_ref=mysql_num_rows($dat_sid);
	   $idnom=$result_ref[nom_id];
	   if($count_ref>=1 ){
		 
		///********* For Representative ***********/
		 $flag_fast=1;
	
	 	$i=1;   $idref=$id;
			
	if($flag==2){
			/****** FAST START BONUS  *******/
	//	echo 'fast';
			
			 //'<br>';
			 $idnom_pb=$idnom;
			  $ref_id_fast=$ref_id;
			while($ref_id_fast!='cmp'){
				
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, nom_id, reg.user_id, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$ref_id_fast'"));
				 $date_ref=$query_fast['subs_date'];
				
				$user_id_fast=$query_fast['user_id'];
				$memstatus= $query_fast['mem_status'];
				$mstatus=$query_fast['mstatus'];
				
				if($date_ref>$date){
					if($flag_fast==1){
						$percent=30;
						 $fsb=($plan_amt)*0.30;
			
						$flag_fast=2;
					}
					else{
						$percent=5;
						 $fsb=($plan_amt)*0.05;
						
					}
					
					if($memstatus==0 && $mstatus==0){
						$tax=($fsb*$income_tax)/100;
								 $amount=$fsb-$tax;
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Bundle Purchase', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$fsb' ");
								
									$fbalance1=$query_fast[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
								mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')");
									
								$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'");

						}
				} $ref_id_fast=$query_fast['ref_id'];
			
				
				if($i==5) break;
				$i++;
			}
			
			
		}
		
	 	else if($flag==1){
	  	   $flag_level=1; $il=1;
		//echo 'dynamic<BR>';
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   user_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['user_id'];
			}
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, reg.user_id, mstatus, mem_status, astatus,  fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					$userid_level=$query_levelc['user_id'];
					 $id_refm=$query_levelc['ref_id'];
					
					if($date_refl>$date && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['nom_id'];
						
						//echo "INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$userid_level', '$id' ,'Product Bundle Purchase', '$levelc', 'Dynamic Level Based Residual Commission','$date','0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')".'<br>';
						 $memstatus= $query_levelc['mem_status'];
						$mstatus=$query_levelc['mstatus'];
						 if($memstatus==0 && $mstatus==0){
							 $tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
						mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level, payout_date, closing_no, tax, final_amount ) values ('$idnoml', '$id' ,'Product Bundle Purchase', '$amount', 'Dynamic Level Based Residual Commission','$date','1', 'r', '$invoice', '$percentl', '$plan_amt', '$il', '$date','$closing', '$tax', '$levelc' )");
						$fbalance1=$query_levelc[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$idnoml','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$idnoml','Dynamic Level Based Residual Commission Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$idnoml'");
						 }
						
						/************* MATCHING BONUS ***********/
						$temp_match=$id_refm;
						$im=1;
						while($temp_match!='cmp'){
							
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, gstatus, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match'"));
							$date_refm=$query_levelm['subs_date'];
							
							if($date_refm>$date  && $query_levelm['gstatus']==1){
								
								// "INSERT INTO level_income SET income_id='$id_refm' , down_id='$id', package='Product Bundle Purchase', commission='$matchc', remark='Matching Bonus', l_date='$date',status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'";
								$memstatus= $query_levelm['mem_status'];
								$mstatus=$query_levelm['mstatus'];
								 if($memstatus==0 && $mstatus==0){
									 $tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
									mysql_query("INSERT INTO level_income SET income_id='$temp_match' , down_id='$idnoml', package='Product Bundle Purchase', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$matchc'");
									$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_match','$amount','Valunaire Admin','$date','Matching Bonus Earned','0','$temp_match','Matching Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_match'");
								 }
								$im++;
							}
							$temp_match=$query_levelm['ref_id'];
							if($im>5) break;
						}
						$il++;
					} $idnoml=$query_levelc['nom_id'];
					if($idnom_mat=='cmp') break;
					if($idnoml=='cmp') break;
					if($il>5)	break;
				}	
	
	  }
		
	  }
	else 
	{ //echo 'aff';
	///********* For Affiliate ***********/
	
	 
	/**  If it is member's first product**/
	
	if($flag==2){
		 if($user_type=='c')
		  { $percent=50;
			$onemonthcomm=(($plan_amt)*0.50);
			
		  }
		  else if ($user_type=='m')
		  { $percent=50;
			$onemonthcomm=(($plan_amt)*0.50);
			
		
		}
			$tax=($onemonthcomm*$income_tax)/100;
								 $amount=$onemonthcomm-$tax;
			 $inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount) values ('$ref_id', '$id' ,'Product Bundle Purchase', '$amount', 'Direct Sale Commission','$date','1', 'a', 1, '$invoice', '$plan_amt', '$percent', '$date', '$closing', '$tax', '$onemonthcomm')";
			
			      //	FAST START BONUS
  $temp_fast=$ref_id;
  $temp_var_fast=2;
   $percent_fast=5;
   $com_fast_start=$plan_amt*0.05;
  
   $result_fast=mysql_fetch_array(mysql_query("SELECT  ref_id FROM registration WHERE user_id='$temp_fast'"));
   $temp_fast=$result_fast['ref_id'];
  		while($temp_fast!='cmp'){
			
			$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, reg.user_id, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_fast'"));
				$date_ref=$query_fast['subs_date'];
				$user_id_fast=$query_fast['user_id'];
				
				if($date_ref>$date){
					$memstatus= $query_fast['mem_status'];
					$mstatus=$query_fast['mstatus'];
					 if($memstatus==0 && $mstatus==0){
						$tax=($com_fast_start*$income_tax)/100;
								 $amount=$com_fast_start-$tax;
						mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Bundle Purchase', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent_fast', level='$temp_var_fast', price='$plan_amt', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$amount'");
						$fbalance1=$query_fast[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')");
									
								$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'");
					 }
				}
				$temp_fast=$query_fast['ref_id'];
				
				if($temp_var_fast==5) break;
				$temp_var_fast++;
			}
			//	FAST START BONUS: END		
	}
	 else{ 
		if($user_type=='c'){
			$percent=25;
			$onemonthcomm=(($plan_amt)*0.25);
			
	  }
	  else if ($user_type=='m')
	  { $percent=7.5;
		$onemonthcomm=(($plan_amt)*0.075);
		 if($flag==1){
	  	   $flag_level=1; $il=1;
		//echo 'dynamic<BR>';
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, reg.user_id, mstatus, mem_status, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					$userid_level=$query_levelc['user_id'];
					 $id_refm=$query_levelc['ref_id'];
					if($date_refl>$date && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['nom_id'];
				
						 $memstatus= $query_levelc['mem_status'];
					$mstatus=$query_levelc['mstatus'];
					 if($memstatus==0 && $mstatus==0){
						 $tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
						mysql_query("INSERT INTO level_income SET income_id='$idnoml' , down_id='$id', package='Product Bundle Purchase', commission='$amount', remark='Dynamic Level Based Residual Commission', l_date='$date', status=1, com_type=r, invoice='$invoice', percent='$percentl', price='$plan_amt', level='$il', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$levelc')");
							$fbalance1=$query_levelc[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$idnoml','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$idnoml','Dynamic Level Based Residual Commission Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$idnoml'");
					 }
						
						/************* MATCHING BONUS ***********/
						$temp_match=$id_refm;
						$im=1;
						while($temp_match!='cmp'){
							
							/*and gstatus=1*/
							$query_levelm=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, subs_date, gstatus, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match'"));
							$date_refm=$query_levelm['subs_date'];
							
							if($date_refm>$date  && $query_levelm['gstatus']==1){
								
								
								$memstatus= $query_levelm['mem_status'];
					$mstatus=$query_levelm['mstatus'];
					 if($memstatus==0 && $mstatus==0){
						 		$tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
								mysql_query("INSERT INTO level_income SET income_id='$temp_match' , down_id='$idnoml', package='Product Bundle Purchase', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$matchc'");
								
							$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$temp_match','$amount','Valunaire Admin','$date','Matching Bonus Earned','0','$temp_match','Matching Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$temp_match'");
					 }
								$im++;
							}
							$temp_match=$query_levelm['ref_id'];
							if($im>5) break;
						}
						$il++;
					} $idnoml=$query_levelc['nom_id'];
					if($idnom_mat=='cmp') break;
					if($idnoml=='cmp') break;
					if($il>5)	break;
				}	
	
	  }
		}
		$tax=($onemonthcomm*$income_tax)/100;
								 $amount=$onemonthcomm-$tax;
		$inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount) values ('$ref_id', '$id' ,'Product Bundle Purchase', '$amount', 'Direct Residual Bonus','$date','1', 'a', 1, '$invoice', '$plan_amt', '$percent', '$date', '$closing', '$tax', '$onemonthcomm' )";
	}
	  $memstatus= $result_ref['mem_status'];
	$mstatus=$result_ref['mstatus'];
	 if($memstatus==0 && $mstatus==0){
		  $inslevel4=mysql_query($inslev56) or die(mysql_error());
		 
							$fbalance1=$result_ref[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id','$amount','Valunaire Admin', '$date','Fast Start Bonus Earned','0','$ref_id','Fast Start Bonus Earned','$fbalance1')");
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$ref_id'");
	 }

	 /***********End: Commision *********/ 
	  } 
	  
	  
	   
  }
mysql_query("update mem_bundle set paid_status=1, closing_no='$closing' where invoice='$invoice'");	
mysql_error();
}

//bundle_com(1254213522);


//******* Product	COMMISSION membership **********/
 function product_com($invoice, $closing){
 	$sql_tax=mysql_fetch_array(mysql_query("select * from tax order by id desc limit 1"));
	$income_tax=$sql_tax['income'];
 	 $date=date('Y-m-d');
	 $cdate=strtotime($date);
	 	$check_date=date('Y-m-d',strtotime("-1 months",$cdate)); 
 	
 	$result_ref=mysql_fetch_array(mysql_query("SELECT reg.user_id, reg.ref_id, reg.user_type, reg.nom_id, mb.*, reg.mstatus, reg.mem_status, fe.amount, reg.first_name, reg.mid_name, reg.last_name FROM mem_products mb inner join registration reg ON reg.user_id=mb.user_id INNER JOIN final_e_wallet fe ON fe.user_id = reg.user_id WHERE invoice='$invoice'"));
	$fullname=$result_ref['first_name'].' '.$result_ref['mid_name'].' '.$result_ref['last_name'];
	$ref_id=$result_ref[ref_id];
	 $id=$result_ref[user_id];
	 $user_type=$result_ref[user_type];
	$result_reftype=mysql_fetch_array(mysql_query("SELECT mem.user_type, reg.astatus, reg.email from membership mem INNER JOIN registration reg ON reg.user_id=mem.user_id where mem.user_id='$ref_id'  and DATE(date)+INTERVAL 1 YEAR>='$date'"));
	$email=$result_reftype['reg.email'];
	
	 $plan_amt=$result_ref[price];
	$sub_for=$result_ref[sub_for];
	 $user_typeref=$result_reftype['user_type'];
	 $astatus=$result_reftype['astatus'];
	if($user_typeref=='m')
	{
	

	   $quers_sid=" select reg.user_type as user_type from registration reg  where reg.user_id='$ref_id' and subs_date>='$date'";
	   $dat_sid=mysql_query($quers_sid) or die(mysql_error());
	   $level=1;
				$user_nom=$id;
				
			
	   $count_ref=mysql_num_rows($dat_sid);
	   /********** For check the subscription *******/
// '<br>';
	 $flag=$result_ref['product_no'];
	 $idnom=$result_ref[nom_id]; 
	   if($count_ref>=1 ){
		 $idref=$id;
		///********* For Representative ***********/
		 $flag_fast=1;
		
	 	$i=1;  
			
	if($flag==2){ $flag_fast=1;
			/****** FAST START BONUS  *******/
		
			 $ref_id_fast=$ref_id;
			while($idnom!='cmp'){
			
				$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, nom_id, reg.user_id, mem_status, mstatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$ref_id_fast'"));
				$date_ref=$query_fast['subs_date'];
				$ref_id_fast=$query_fast['ref_id'];
				$user_id_fast=$query_fast['user_id'];
				 $nom_idfast=$query_fast['nom_id'];
				
				$memstatus= $query_fast['mem_status'];
				$mstatus=$query_fast['mstatus'];
				if($date_ref>$date){ 
					if($flag_fast==1){
						$percent=30;
						 
						  $fsb=(($plan_amt)*0.30);
						$flag_fast=2;
					}
					else{
						$percent=5;
						
					 $fsb=($plan_amt)*0.05;
						
					}
					 if($memstatus==0 && $mstatus==0){  
						 $tax=($fsb*$income_tax)/100;
						 $amount=$fsb-$tax;
							mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Purchase', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent', level='$i', price='$plan_amt', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$fsb' ") or die(mysql_error());
							$fbalance1=$query_fast[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')") or die(mysql_error());
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'") or die(mysql_error());
						 }
				} 
				$idnom=$nom_idfast;
				
				
				if($i==5) break;
				 $i++;
			}
			
			
		}
	else if($flag==1){   $flag_level=1; $il=1;
		
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   user_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['user_id'];
			}
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			 
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					// "SELECT  ref_id, nom_id, reg.user_id, subs_date, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnoml'";
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, reg.user_id, subs_date, mstatus, mem_status, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnoml'")) or die(mysql_error());
					 $date_refl=$query_levelc['subs_date'];
					$userid_level=$query_levelc['user_id'];
					 
					 $id_refm=$query_levelc['user_id'];
					if($date_refl>$date  && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['user_id'];
						
						$memstatus= $query_levelc['mem_status'];
						$mstatus=$query_levelc['mstatus'];
						 if($memstatus==0 && $mstatus==0){
							 $tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
							mysql_query("INSERT INTO level_income set income_id='$userid_level', down_id='$id' , package='Product Purchase', commission='$amount', remark='Dynamic Level Based Residual Commission', l_date='$date', status='1', com_type='r', invoice='$invoice', percent='$percentl', price='$plan_amt', level='$il', payout_date='$date', closing_no='$closing' , tax='$tax', final_amount='$levelc' ") or die(mysql_error());
							$fbalance1=$query_levelc[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$userid_level','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$userid_level','Dynamic Level Based Residual Commission Earned','$fbalance1')") or die(mysql_error());
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$userid_level'") or die(mysql_error());
						 }
						$il++; 	$im=1;
						
						
						/************* MATCHING BONUS ***********/
						
					$uqery=mysql_fetch_array(mysql_query("select ref_id from registration where user_id='$userid_level'"));	
						$match_id= $uqery['ref_id'];
						 $temp_match=$match_id;
						while($temp_match!='cmp'){
						//	 "SELECT  ref_id, nom_id, subs_date, reg.user_id, gstatus, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match' <br>";
							$sql_levelm=mysql_query("SELECT  ref_id, nom_id, subs_date, reg.user_id, gstatus, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match' ") or die(mysql_error());
							$query_levelm=mysql_fetch_array($sql_levelm);
						 	$date_refm=$query_levelm['subs_date'];
						
							$idnom_mat=$query_levelm['nom_id'];
							$userid_match=$query_levelm['user_id'];
							 $query_levelm['gstatus'];
							if($date_refm>$date && $query_levelm['gstatus']==1){
								//echo  '<br>'."INSERT INTO level_income SET income_id='$userid_match' , down_id='$id', package='Product Purchase', commission='$matchc', remark='Matching Bonus', l_date='$date',status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'".'<br>';
								 $memstatus= $query_levelm['mem_status'];
								$mstatus=$query_levelm['mstatus'];
								 if($memstatus==0 && $mstatus==0){
									 $tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
									mysql_query("INSERT INTO level_income SET income_id='$userid_match' , down_id='$userid_level', package='Product Purchase', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$matchc'") or die(mysql_error());
									$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$userid_match','$amount','Valunaire Admin','$date','Matching Bonus Earned','0','$userid_match','Matching Bonus Earned','$fbalance1')") or die(mysql_error());
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$userid_match'") or die(mysql_error());
								 }
								$im++;
							}
							 $temp_match=$query_levelm['ref_id'];
							 if($temp_match=='') break;
							if($im>5) break;
						}
					}  $idnoml=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
			
		}	
		
	  }
	else 
	{ //echo  'affffffff<br>'.$flag;
	///********* For Affiliate ***********/	 
	/**  If it is member's first product**/
	 
	 	$i=1;  
			
	if($flag==2){
	 
		 if($user_type=='c')
		  { $percent=50;
			 $onemonthcomm=($plan_amt*0.50);
			
		  }
		  else if ($user_type=='m')
		  { $percent=50;
			$onemonthcomm=($plan_amt*0.50);
				
			}
			$tax=($onemonthcomm*$income_tax)/100;
								 $amount=$onemonthcomm-$tax;
			 $inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount) values ('$ref_id', '$id' ,'Product Purchase', '$amount', 'Direct Sale Commission','$date','1', 'a', 1, '$invoice', '$plan_amt', '$percent', '$date', '$closing', '$tax', '$onemonthcomm')";
			 
		 //	FAST START BONUS
		  $temp_fast=$ref_id;
		  $temp_var_fast=2;
		   $percent_fast=5;
		   $com_fast_start=$plan_amt*0.05;
		   "SELECT  ref_id FROM registration WHERE user_id='$temp_fast'";
		   $result_fast=mysql_fetch_array(mysql_query("SELECT  ref_id FROM registration WHERE user_id='$temp_fast'"));
		   $temp_fast=$result_fast['ref_id'];
				while($temp_fast!='cmp'){
					 
						$query_fast=mysql_fetch_array(mysql_query("SELECT subs_date, ref_id, reg.user_id, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_fast'"));
						$date_ref=$query_fast['subs_date'];
						$user_id_fast=$query_fast['user_id'];
						
						if($date_ref>$date){
							$memstatus= $query_fast['mem_status'];
						$mstatus=$query_fast['mstatus'];
						 if($memstatus==0 && $mstatus==0){
							 $tax=($com_fast_start*$income_tax)/100;
								 $amount=$com_fast_start-$tax;
							mysql_query("INSERT INTO level_income SET income_id='$user_id_fast' , down_id='$id', package='Product Purchase', commission='$amount', remark='Fast Start Bonus',l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percent_fast', level='$temp_var_fast', price='$plan_amt', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$com_fast_start' ") or die(mysql_error());
									$fbalance1=$query_fast[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$user_id_fast','$amount','Valunaire Admin','$date','Fast Start Bonus Earned','0','$user_id_fast','Fast Start Bonus Earned','$fbalance1')") or die(mysql_error());
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$user_id_fast'") or die(mysql_error());
						 }
						}
						$temp_fast=$query_fast['ref_id'];
						
						if($temp_var_fast==5) break;
						$temp_var_fast++;
					}
	
	//end:fast start	    
			 
	}
	 else{
		if($user_type=='c'){
			$percent=25;
			$onemonthcomm=(($plan_amt)*0.25);
			
	  }
	  else if ($user_type=='m')
	  { $percent=7.5;
		$onemonthcomm=(($plan_amt)*0.075);
		 if($flag==1){   $flag_level=1; $il=1;
		 'dynamic<BR>';
		  $user_type;
			/****** DYNAMIC LEVEL BASED RESIDUAL BONUS  *******/
			if($user_type=='c'){
				$query_levelc=mysql_fetch_array(mysql_query("SELECT   user_id FROM registration WHERE user_id='$ref_id'"));
				$idnom=$query_levelc['user_id'];
			}
			
			 $levelc=$plan_amt*0.075;
			$percentl=7.5;
			$percentm=5;
			 $matchc=$levelc*0.05;
			 $levelc=round($levelc,3);
			 $matchc=round($matchc,3);
			 
			  $idnoml=$idnom;
				while($idnoml!='cmp'){
					
					$query_levelc=mysql_fetch_array(mysql_query("SELECT  ref_id, nom_id, reg.user_id, subs_date, mstatus, mem_status, astatus, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$idnoml'"));
					 $date_refl=$query_levelc['subs_date'];
					$userid_level=$query_levelc['user_id'];
					 
					 $id_refm=$query_levelc['user_id'];
					if($date_refl>$date  && $query_levelc['astatus']==1){
						
						$idnom_mat=$query_levelc['user_id'];
						//echo "INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level) values ('$userid_level', '$id' ,'Product Purchase', '$levelc', 'Dynamic Level Based Residual Commission','$date','0', 'r', '$invoice', '$percentl', '$plan_amt', '$il')".'<br>';
						 $memstatus= $query_levelc['mem_status'];
						$mstatus=$query_levelc['mstatus'];
						 if($memstatus==0 && $mstatus==0){
							 $tax=($levelc*$income_tax)/100;
								 $amount=$levelc-$tax;
							mysql_query("INSERT INTO level_income(income_id , down_id, package, commission, remark,l_date,status, com_type, invoice, percent, price, level, closing_no, payout_date, tax, final_amount) values ('$userid_level', '$id' ,'Product Purchase', '$amount', 'Dynamic Level Based Residual Commission','$date','1', 'r', '$invoice', '$percentl', '$plan_amt', '$il', '$closing', '$date', '$tax', '$levelc')") or die(mysql_error());
							$fbalance1=$query_levelc[amount]+$amount;
							/*$fbalance1=round($fbalance1,2);*/
							mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$userid_level','$amount','Valunaire Admin','$date','Dynamic Level Based Residual Commission Earned','0','$userid_level','Dynamic Level Based Residual Commission Earned','$fbalance1')") or die(mysql_error());
									
							$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$userid_level'") or die(mysql_error());
						 }
						$il++; 	$im=1;
						
						
						/************* MATCHING BONUS ***********/
						
					$uqery=mysql_fetch_array(mysql_query("select ref_id from registration where user_id='$userid_level'"));	
						$match_id= $uqery['ref_id'];
						 $temp_match=$match_id;
						while($temp_match!='cmp'){
							
						//echo "SELECT  ref_id, nom_id, subs_date, reg.user_id, gstatus, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match' ".'<br>';
							$sql_levelm=mysql_query("SELECT  ref_id, nom_id, subs_date, reg.user_id, gstatus, mstatus, mem_status, fewa.amount FROM registration reg INNER JOIN final_e_wallet fewa on fewa.user_id=reg.user_id  WHERE reg.user_id='$temp_match' ") or die(mysql_error());
							$query_levelm=mysql_fetch_array($sql_levelm);
						 	$date_refm=$query_levelm['subs_date'];
						
							$idnom_mat=$query_levelm['nom_id'];
							$userid_match=$query_levelm['user_id'];
							 $query_levelm['gstatus'];
							if($date_refm>$date && $query_levelm['gstatus']==1){
								//echo  '<br>'."INSERT INTO level_income SET income_id='$userid_match' , down_id='$id', package='Product Purchase', commission='$matchc', remark='Matching Bonus', l_date='$date',status='0', com_type='r', invoice='$invoice', percent='$percentm', price='$plan_amt', level='$im'".'<br>';
								   $memstatus= $query_levelm['mem_status'];
								$mstatus=$query_levelm['mstatus'];
								 if($memstatus==0 && $mstatus==0){
									$tax=($matchc*$income_tax)/100;
								 $amount=$matchc-$tax;
								 /********LEVEL INCOME QUERY********/
									mysql_query("INSERT INTO level_income SET income_id='$userid_match' , down_id='$userid_level', package='Product Purchase', commission='$amount', remark='Matching Bonus', l_date='$date',status='1', com_type='r', invoice='$invoice', percent='$percentm', price='$levelc', level='$im', payout_date='$date', closing_no='$closing', tax='$tax', final_amount='$matchc'") or die(mysql_error());
									$fbalance1=$query_levelm[amount]+$amount;
									/*$fbalance1=round($fbalance1,2);*/
									mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$userid_match','$amount','Valunaire Admin','$date','Matching Bonus','0','$userid_match','Matching Bonus','$fbalance1')") or die(mysql_error());
									
									$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$userid_match'") or die(mysql_error());
								 }
								$im++;
							}
							 $temp_match=$query_levelm['ref_id'];
							 if($temp_match=='') break;
							if($im>5) break;
						}
					}  $idnoml=$query_levelc['nom_id'];
					if($il>5)	break;
				}	
			
		}
		}
		$tax=($onemonthcomm*$income_tax)/100;
		 $amount=$onemonthcomm-$tax;
		 $inslev56="insert into  level_income (income_id , down_id, package, commission, remark,l_date,status, com_type, level, invoice, price, percent, payout_date, closing_no, tax, final_amount) values ('$ref_id', '$id' ,'Product Purchase', '$amount', 'Direct Residual Bonus','$date','1', 'a', 1, '$invoice', '$plan_amt', '$percent', '$date', '$closing', '$tax', '$onemonthcomm')";
	}
		/*$fbal_1=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$ref_id'"));
	$fbalance1=$fbal_1[amount]+$onemonthcomm;*/
	   $memstatus= $result_ref['mem_status'];
	$mstatus=$result_ref['mstatus'];
	 if($memstatus==0 && $mstatus==0){
	  $inslevel4=mysql_query($inslev56) or die(mysql_error());
	  $fbalance1=$result_ref[amount]+$amount;
	/*$fbalance1=round($fbalance1,2);*/
	mysql_query("insert into credit_debit (user_id, credit_amt,  sender_id, receive_date,Remark,status,ttype,TranDescription,final_bal) values('$ref_id','$amount','Valunaire Admin','$date','Direct Residual Bonus Earned','0','$ref_id','Direct Residual Bonus Earned','$fbalance1')") or die(mysql_error());
									
	$final_ewallet5=mysql_query("update final_e_wallet set amount='$fbalance1' where user_id='$ref_id'") or die(mysql_error());
	 }
	  
	
	 /***********End: Commision *********/ 
	  }
	   

	 }// End if of ref user_type
 mysql_query("update mem_products set paid_status=1, closing_no='$closing' where invoice='$invoice'") or die(mysql_error());	

}
//product_com(1292081500); 
?>