<?php
class Class_Commission extends mysql_func
{
	function First_Bonus($ref_id,$user_id,$invoice_no,$invoice_amt)
	{
		// this function is used to make the commission of the 10% from invoice purchase
		// 10% commission goes to the replicated person from which store user purchase products
		//echo $ref_id."=".$user_id."=".$invoice_no."=".$invoice_amt;
		$commission=$invoice_amt*10/100;
		$commission_fix=$commission;
		$date=date('Y-m-d');
		if($commission>0)
		{
			$tfs_amount=$commission*10/100;
			$commission=$commission-$tfs_amount;
			// insert first bonus commission
			$insert_arr=array(
			"invoice_no"=>$invoice_no,
			"purcheser_id"=>$user_id,
			"seller_id"=>$ref_id,
			"income_id"=>$ref_id,
			"commission"=>$commission_fix,
			"status"=>1,
			"date"=>$date,
			"payout_date"=>$date,
			"remark"=>'Get 10% Cashback On The Invoice'.$invoice_no
			);
			$this->insert_tbl($insert_arr,"level_income_bonus");
			
			// update cash wallet
			$this->query_execute("update final_tp set amount=amount+$commission where user_id='$ref_id'");
			// insert credit debit history
			$inserarr=array(
			"user_id"=>$ref_id,
			"credit_amt"=>$commission,
			"debit_amt"=>'0',
			"receiver_id"=>$ref_id,
			"sender_id"=>'admin',
			"receive_date"=>$date,
			"TranDescription"=>'Get 10% Cashback On The Invoice'.$invoice_no,
			"Remark"=>'Get 10% Cashback On The Invoice'.$invoice_no,
			"invoice_no"=>$invoice_no
			);
			$this->insert_tbl($inserarr,"final_tp_history");
			
			// updtae 10% of every commission into tfs wallet
			$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$ref_id'");
			$inserarr=array(
			"user_id"=>$ref_id,
			"credit_amt"=>$tfs_amount,
			"debit_amt"=>'0',
			"receiver_id"=>$ref_id,
			"sender_id"=>'admin',
			"receive_date"=>$date,
			"TranDescription"=>'Get 10% Of Cashback On The Invoice'.$invoice_no,
			"Remark"=>'Get 10% of Cashback On The Invoice'.$invoice_no,
			"invoice_no"=>$invoice_no
			);
			$this->insert_tbl($inserarr,"final_tfs_history");
		}
		$this->Fifth_Bonus($user_id,$invoice_amt,$invoice_no);
	}
	
	function Second_Bonus($ref_id,$user_id,$invoice_no,$invoice_amt)
	{
		$commission=100;
		$date=date('Y-m-d');
		// find the ref_id sponsor also a reseller
		$res_ref=$this->query("ref_id","registration","user_id='$ref_id'");
		$count_ref=$this->num_row($res_ref);
		if($count_ref)
		{
			$row_ref=$this->get_all_row($res_ref);
			$income_id=$row_ref['ref_id'];
		}
		//echo $ref_id.",".$user_id.",".$invoice_no.",".$invoice_amt.",".$commission.",".$count_ref;
		if($commission>0 && $count_ref)
		{	
			// check the sponsor income_id become reseller
			$res_income_id=$this->query("ref_id","registration","user_id='$income_id' and reseller=1");
			$count_income_id=$this->num_row($res_income_id);
			if($count_income_id)
			{
				$status=1;
			}
			else
			{
				$status=0;
			}
			
			$insert_arr=array(
			"invoice_no"=>$invoice_no,
			"purcheser_id"=>$user_id,
			"seller_id"=>$income_id,
			"income_id"=>$income_id,
			"commission"=>$commission,
			"status"=>$status,
			"date"=>$date,
			"payout_date"=>$date,
			"remark"=>'Get 100 TP On the sell of the 30 stock to sell products'
			);
			$this->insert_tbl($insert_arr,"level_income_total");
			// update cash wallet
			$tfs_amount=$commission*10/100;
			$commission=$commission-$tfs_amount;
			if($count_income_id)
			{
				$this->query_execute("update final_tp set amount=amount+$commission where user_id='$income_id'");
				// insert credit debit history
				$inserarr=array(
				"user_id"=>$ref_id,
				"credit_amt"=>$commission,
				"debit_amt"=>'0',
				"receiver_id"=>$income_id,
				"sender_id"=>'admin',
				"receive_date"=>$date,
				"TranDescription"=>'Get 100 TP On the sell of the 30 stock to sell products',
				"Remark"=>'Get 100 TP On the sell of the 30 stock to sell products',
				"invoice_no"=>$invoice_no
				);
				$this->insert_tbl($inserarr,"final_tp_history");
				// updtae 10% of every commission into tfs wallet
				$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$income_id'");
				$inserarr=array(
				"user_id"=>$income_id,
				"credit_amt"=>$tfs_amount,
				"debit_amt"=>'0',
				"receiver_id"=>$income_id,
				"sender_id"=>'admin',
				"receive_date"=>$date,
				"TranDescription"=>'Get 10% Of Cashback On The Invoice'.$invoice_no,
				"Remark"=>'Get 10% of Cashback On The Invoice'.$invoice_no,
				"invoice_no"=>$invoice_no
				);
				$this->insert_tbl($inserarr,"final_tfs_history");
			}
			// user become reseller
			//echo "update registration set reseller=1,reseller_date='$date' where user_id='$ref_id'";exit;
			$myfile = fopen($ref_id."newfile_second_com.txt", "w") or die("Unable to open file!");
			$txt = "update registration set reseller=1,reseller_date='$date' where user_id='$ref_id'";
			fwrite($myfile, $txt);
			fclose($myfile);
			$this->query_execute("update registration set reseller=1,reseller_date='$date' where user_id='$ref_id'");
			// start subscription
			// get user sponsor
			$res_subs_sp=$this->query("ref_id","registration","user_id='$ref_id'");
			$row_subs_sp=$this->get_all_row($res_subs_sp);
			$subs_user_id=$row_subs_sp['ref_id'];
			if($subs_user_id!='cmp')
			{
				// check the suscription count
				$res_subs_count=$this->query("id","subscription_member","user_id='$ref_id' and status=0");
				$count_subs_count=$this->num_row($res_subs_count);
				if($count_subs_count)
				{}
				else
				{
				$this->query_execute("update subscription_member set status=1 where user_id='$ref_id'");
				$subs_date=date('Y-m-d H:i:s');
				$date = strtotime($subs_date);
				$date = strtotime("+30 day", $date);
				$end_date=date('Y-m-d H:i:s', $date);
				$this->query_execute("insert into subscription_member set status=0,user_id='$ref_id',subs_date='$subs_date',end_date='$end_date',cat_duration=cat_duration+1");
				
				$add_date=date('Y-m-d');
				$date = strtotime($add_date);
				$date = strtotime("-1 day", $date);
				$one_month_date=date('Y-m-d', $date);
				
					$flag=false;
					// check for already assign or not 
					$sql_five="select * from stock_to_sell_assign where user_id='$ref_id' and type='daily_task'";
					$res_five=mysql_query($sql_five);
					$count_five=mysql_num_rows($res_five);
					if($count_five)
					{
						$sql_thirty="select * from stock_to_sell_assign where user_id='$ref_id' and type='daily_task' and add_date>='$one_month_date'";
						$res_thirty=mysql_query($sql_thirty);
						$count_thirty=mysql_num_rows($res_thirty);
						if($count_thirty)
						{
							$flag=true;
						}
						else
						{
							$flag=false;
						}
					
					}
					else
					{
						$flag=true;
					}
					if($flag)
					{
					
						$sql_check_last_five="select * from weekly_adds_mp where user_id='$ref_id' and status=0 order by id desc limit 5";
						$res_check_last_five=mysql_query($sql_check_last_five);
						$cnt=mysql_num_rows($res_check_last_five);
	
						if(!$cnt)
						{
							$sql_product_default="select * from product_default where type='daily_task' limit 5";
							$res_product_default=mysql_query($sql_product_default);
							$count_product_default=mysql_num_rows($res_product_default);
							if($count_product_default==5)
							{
								$sn=1;
								while($row_product_default=mysql_fetch_assoc($res_product_default))
								{
										$update['user_id']=$ref_id;
										$update['product_id']=$row_product_default['product_id'];
										$update['add_by']=USERID;
										$update['add_count']=$sn;
										$update['add_date']=date('Y-m-d');
										// check the product id with user complete 30 or not
										if($this->_product_thirty($user_id,"weekly_adds_mp",5))
										{
											$this->insert_tbl($update,"weekly_adds_mp");
										}
										$sn++;
								}
							}
						}
					}	
				}
			}
			// call sixth bonus
			//$this->Seventh_Bonus($ref_id);
			$this->Seventh_Bonus($income_id);
			$this->Ninth_Bonus($income_id);
			$this->_Update_Pending_Commission($ref_id);
		}
		//exit;	
	}
	function _product_thirty($user_id,$table_name,$temp_count)
	{
		//echo $pid.'=='.$user_id;
		$res=$this->query("id",$table_name,"user_id='$user_id' and status=0");
		$count=$this->num_row($res);
		//echo "_product_thirty:".$count."<br>"; exit;
		if($count<$temp_count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function Third_Bonus($user_id)
	{
		// check members direct resellers
		$date=date('Y-m-d');
		$week_no=date('W');
		$res_reseller=$this->query("id","registration","ref_id='$user_id' and reseller=1");
		$count_reseller=$this->num_row($res_reseller);
		//echo $count_reseller;exit;
		if($count_reseller==1)
		{
			$commission=25;
			$pending_commission=75;
			$flag_p=3;
			$flag=1;
		}
		if($count_reseller==2)
		{
			$commission=50;
			$pending_commission=50;
			$flag_p=2;
			$flag=2;
		}
		if($count_reseller==3)
		{
			$commission=75;
			$pending_commission=25;
			$flag_p=1;
			$flag=3;
		}
		if($count_reseller>=4)
		{
			$commission=100;
			$pending_commission=0;
			$flag_p=0;
			$flag=4;
		}
		if($commission>0)
		{
			if($flag)
			{
				// check here and paid pending commission
				if($flag>1 && $flag<=4)
				{ 
					// check the previous commission paid
					$res_ccount=$this->query("max(commission_count) as commission_count","level_income_weekly","income_id='$user_id'");
					$row_ccount=$this->get_all_row($res_ccount);
					$commission_count=$row_ccount['commission_count'];
					
					if($flag==2){ $cond_loop=" and commission_loop ='2'" ;}
					if($flag==3) { $cond_loop=" and commission_loop in (2,3) " ;}
					if($flag==4) { $cond_loop=" and commission_loop in (2,3,4) " ;}
					/*$res_previoupd=$this->query("*","level_income_weekly","income_id='$user_id' and status=1 and commission_retroactive=0 and commission_count='$commission_count'");
					$count_previoupd=$this->num_row($res_previoupd);
					if($count_previoupd)
					{
						
					}*/
					
					$res_previoud=$this->query("*","level_income_weekly","income_id='$user_id' and status=0 and commission_retroactive=1 $cond_loop");
					while($row_previoud=$this->get_all_row($res_previoud))
					{
						$l_id=$row_previoud['l_id'];
						$amount=$row_previoud['commission'];
						$week_no_p=$row_previoud['week_no'];
						$tfs_amount=$amount*10/100;
						$amount=$amount-$tfs_amount;
						$this->Fifth_Part_Bonus($user_id,$amount);
						// get the commission count 
						$this->query_execute("update level_income_weekly set status=1,payout_date='$date' where l_id='$l_id'");
						// update cash wallet
						$myfile = fopen($user_id."third_bonus.txt", "w") or die("Unable to open file!");
						$txt = "update final_tp set amount=amount+$amount where user_id='$user_id'";
						fwrite($myfile, $txt);
						fclose($myfile);
						$this->query_execute("update final_tp set amount=amount+$amount where user_id='$user_id'");
						// insert credit debit history
						$inserarr=array(
						"user_id"=>$user_id,
						"credit_amt"=>$amount,
						"debit_amt"=>'0',
						"receiver_id"=>$user_id,
						"sender_id"=>'admin',
						"receive_date"=>$date,
						"TranDescription"=>"Get $amount TP On week no Retroactive $week_no_p",
						"Remark"=>"Get $amount TP On week no Retroactive $week_no_p",
						"invoice_no"=>$invoice_no
						);
						$this->insert_tbl($inserarr,"final_tp_history");
						// updtae 10% of every commission into tfs wallet
						$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$user_id'");
						$inserarr=array(
						"user_id"=>$user_id,
						"credit_amt"=>$tfs_amount,
						"debit_amt"=>'0',
						"receiver_id"=>$user_id,
						"sender_id"=>'admin',
						"receive_date"=>$date,
						"TranDescription"=>"Get 10% of Cashback On Weekly Retroactive Commission".$invoice_no,
						"Remark"=>"Get 10% of Cashback On Weekly Retroactive Commission".$invoice_no,
						"invoice_no"=>$invoice_no
						);
						$this->insert_tbl($inserarr,"final_tfs_history");
					}
				}			
				// end to check and paid pending commission
				for($i=1;$i<=$flag;$i++)
				{
					$commission=25;
					$tfs_amount=$commission*10/100;
					
					$commission=$commission-$tfs_amount;
					$this->Fifth_Part_Bonus($user_id,$commission);
					// get the commission count 
					$res_ccount=$this->query("max(commission_count)+1 as commission_count","level_income_weekly","income_id='$user_id'");
					$row_ccount=$this->get_all_row($res_ccount);
					$commission_count=$row_ccount['commission_count'];
					$insert_arr=array(
					"invoice_no"=>$invoice_no,
					"purcheser_id"=>$user_id,
					"seller_id"=>$ref_id,
					"income_id"=>$user_id,
					"commission"=>25,
					"date"=>$date,
					"week_no"=>$week_no,
					"reseller_count"=>$count_reseller,
					"commission_count"=>$commission_count,
					"commission_loop"=>$i,
					"status"=>1,
					"payout_date"=>$date,
					"remark"=>"Get $commission TP On week no $week_no"
					);
					$this->insert_tbl($insert_arr,"level_income_weekly");
					// update cash wallet
					$myfile = fopen($user_id."third_bonus.txt", "w") or die("Unable to open file!");
					$txt = "update final_tp set amount=amount+$commission where user_id='$user_id'";
					fwrite($myfile, $txt);
					fclose($myfile);
					$this->query_execute("update final_tp set amount=amount+$commission where user_id='$user_id'");
					// insert credit debit history
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$commission,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get $commission TP On week no $week_no",
					"Remark"=>"Get $commission TP On week no $week_no",
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tp_history");
					// updtae 10% of every commission into tfs wallet
					$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$user_id'");
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$tfs_amount,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get 10% of Cashback On Weekly Commission".$invoice_no,
					"Remark"=>"Get 10% of Cashback On Weekly Commission".$invoice_no,
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tfs_history");
				}
			}
			
			// give pending commission 
			if($flag_p)
			{
				for($i=1;$i<=$flag_p;$i++)
				{
					$insert_arr=array(
					"invoice_no"=>$invoice_no,
					"purcheser_id"=>$user_id,
					"seller_id"=>$ref_id,
					"income_id"=>$user_id,
					"commission"=>25,
					"date"=>$date,
					"week_no"=>$week_no,
					"reseller_count"=>$count_reseller,
					"commission_count"=>$commission_count,
					"commission_loop"=>$i+$flag,
					"status"=>0,
					"commission_retroactive"=>1,
					"remark"=>"Get $commission TP On week no $week_no"
					);
					$this->insert_tbl($insert_arr,"level_income_weekly");
				}
			}
		}
		# find the previous remaining income and update commission
		# this is the fourth bonus
		/*if($count_reseller>=4)
		{
			// check the previous remaining income
			$res_prev=$this->query("*","level_income_weekly","income_id='$user_id' and commission_count<'$commission_count' group by commission_count");
			while($row_prev=$this->get_all_row($res_prev))
			{
				$reseller_count=$row_prev['reseller_count'];
				$week_no=$row_prev['week_no'];
				$commission_count=$row_prev['commission_count'];
				if($reseller_count<4)
				{
					$remaining_reseller=$count_reseller-$reseller_count;
					if($remaining_reseller==1)
					{
						$commission=25;
					}
					if($remaining_reseller==2)
					{
						$commission=50;
					}
					if($remaining_reseller==3)
					{
						$commission=75;
					}
					if($remaining_reseller==4)
					{
						$commission=100;
					}
					
					$tfs_amount=$commission*10/100;
					$commission=$commission-$tfs_amount;
					$this->Fifth_Part_Bonus($user_id,$commission);
					// update remaining commission into level_income_weekly
					$insert_arr=array(
					"invoice_no"=>$invoice_no,
					"purcheser_id"=>$user_id,
					"seller_id"=>$ref_id,
					"income_id"=>$user_id,
					"commission"=>$commission,
					"date"=>$date,
					"week_no"=>$week_no,
					"reseller_count"=>$count_reseller,
					"commission_count"=>$commission_count,
					"remark"=>"Get Retroactive Balance $commission TP On week no $week_no"
					);
					$this->insert_tbl($insert_arr,"level_income_weekly_retroactive");
					
					$this->query_execute("update final_tp set amount=amount+$commission where user_id='$user_id'");
					// insert credit debit history
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$commission,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get $commission TP On week no $week_no",
					"Remark"=>"Get Retroactive Balance $commission TP On week no $week_no",
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tp_history");
					// updtae 10% of every commission into tfs wallet
					$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$user_id'");
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$tfs_amount,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get 10% Of Cashback On Weekly Retroactive Balance Commission".$invoice_no,
					"Remark"=>"Get 10% of Cashback On Weekly Retroactive Balance Commission".$invoice_no,
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tfs_history");
				}
			}
		}*/
	}
	
	function Fifth_Bonus($user_id,$invoice_amt,$invoice_no)
	{
		$total=$this->_team_weekly_earning($user_id);
		$direct=$this->_get_direct_count($user_id,'reseller');
		// set the commission level
		$commission=$invoice_amt*2/100;
		$arr_level=array("2"=>5,"3"=>6,"4"=>7,"5"=>7,"6"=>7);
		
		$date=date('Y-m-d');
		$generation=7;
		/*if($commission>0)
		{*/
			$res=$this->query("ref_id","registration","user_id='$user_id'");
			$row=$this->get_all_row($res);
			$cnt=1;
			$ref_id=$row['ref_id'];
			$l=$ref_id;
			
			while($l!='cmp')
			{
				if($l!='')
				{
					$res_com=$this->query("*"," registration ","user_id='$l'");
					$row_com=$this->get_all_row($res_com);
					$l=$row_com['ref_id'];
					$com_id=$row_com['user_id'];
					if($row_com['reseller'])
					{
						$mem_status=$row_com['mem_status'];
						
						$direct=$this->_get_direct_count($com_id,'reseller');
						$team_sale=$this->_team_sale($com_id);
						
						//$team_weekly_earning=$this->_team_weekly_earning_level_wise($com_id);
						//$commission=$team_weekly_earning*2/100;
						//$commission_ts=$team_sale*1/100;
						$commission_ts=$invoice_amt*1/100;
						
						//echo $com_id.','.$team_sale.','.$team_weekly_earning.','.$commission_ts.','.$direct;exit;
						if($direct==6 && ($cnt<=7))
						{
							if($commission>0)
							{
								//$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
							if($cnt==7)
							{
								$commission_ts=$invoice_amt*2/100;
							}
							if($commission_ts>0)
							{
								$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission_ts,$cnt,$count_check,$ref_id,$invoice_no);
							}
						}
						else if($direct==5 && ($cnt<=7))
						{
							if($commission>0)
							{
								//$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
							if($cnt==7)
							{
								$commission_ts=$invoice_amt*1.5/100;
							}
							if($commission_ts>0)
							{
								$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission_ts,$cnt,$count_check,$ref_id,$invoice_no);
							}
						}

						else if($direct==4 && ($cnt<=7))
						{
							if($commission>0)
							{
								//$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
							if($commission_ts>0)
							{
								$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission_ts,$cnt,$count_check,$ref_id,$invoice_no);
							}
						}
						else if($direct==3 && ($cnt<=6))
						{
							if($commission>0)
							{
								//$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
							if($commission_ts>0)
							{
								$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission_ts,$cnt,$count_check,$ref_id,$invoice_no);
							}
						}
						else if($direct==2 && ($cnt<=5))
						{
							if($commission>0)
							{
								//$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
							if($commission_ts>0)
							{
								$this->_update_commission_and_wallet_and_history($user_id,$com_id,$commission_ts,$cnt,$count_check,$ref_id,$invoice_no);
							}
						}
					}
				}
				if($cnt==$generation){break;}
				$cnt++;
			}
		//exit;		
	}
	
	function Fifth_Part_Bonus($user_id,$invoice_amt)
	{
		$myfile = fopen($user_id."fift_part_bonus.txt", "w") or die("Unable to open file!");
			$txt = $invoice_amt;
			fwrite($myfile, $txt);
			fclose($myfile);
		//$total=$this->_team_weekly_earning($user_id);
		$direct=$this->_get_direct_count($user_id,'reseller');
		// set the commission level
		$commission=$invoice_amt*2/100;
		$arr_level=array("2"=>5,"3"=>6,"4"=>7,"5"=>7,"6"=>7);
		
		$date=date('Y-m-d');
		$generation=7;
		/*if($commission>0)
		{*/
			$res=$this->query("ref_id","registration","user_id='$user_id'");
			$row=$this->get_all_row($res);
			$cnt=1;
			$ref_id=$row['ref_id'];
			$l=$ref_id;
			
			while($l!='cmp')
			{
				if($l!='')
				{
					$res_com=$this->query("*"," registration ","user_id='$l'");
					$row_com=$this->get_all_row($res_com);
					$l=$row_com['ref_id'];
					$com_id=$row_com['user_id'];
					if($row_com['reseller'])
					{
						$mem_status=$row_com['mem_status'];
						
						$direct=$this->_get_direct_count($com_id,'reseller');
						$team_sale=$this->_team_sale($com_id);
						
						//$team_weekly_earning=$this->_team_weekly_earning_level_wise($com_id);
						//$commission=$team_weekly_earning*2/100;
						//$commission_ts=$team_sale*1/100;
						$commission=$invoice_amt*2/100;
						
						//echo $com_id.','.$cnt.','.$commission.','.$direct." <br>";
						if($direct==6 && ($cnt<=7))
						{
							if($commission>0)
							{
								$this->_update_commission_and_wallet_and_history_two($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
						}
						else if($direct==5 && ($cnt<=7))
						{
							if($commission>0)
							{
								$this->_update_commission_and_wallet_and_history_two($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
						}
						else if($direct==4 && ($cnt<=7))
						{
							if($commission>0)
							{
								$this->_update_commission_and_wallet_and_history_two($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
						}
						else if($direct==3 && ($cnt<=6))
						{
							if($commission>0)
							{
								$this->_update_commission_and_wallet_and_history_two($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
						}
						else if($direct==2 && ($cnt<=5))
						{
							if($commission>0)
							{
								$this->_update_commission_and_wallet_and_history_two($user_id,$com_id,$commission,$cnt,$count_check,$ref_id);
							}
						}
					}
				}
				if($cnt==$generation){break;}
				$cnt++;
			}
			//exit;		
	}
	
	function Sixth_Bonus($ref_id,$user_id)
	{
		
	}
	function Seventh_Bonus($user_id)
	{
		//find the user sponsor
		$res_ref=$this->query("ref_id,reseller","registration","user_id='$user_id'");
		$row_ref=$this->get_all_row($res_ref);
		$income_id=$row_ref['ref_id'];
		$reseller_id=$row_ref['reseller'];
		// check the income_id have four sponsor or six sponsor within 30 days
		$reg_date=date('Y-m-d');
		$date = strtotime($reg_date);
		$date = strtotime("+ 30 day", $date);
		$to_date=date('Y-m-d', $date);
		
		$res_check=$this->query("id","registration","ref_id='$income_id' and reseller=1 and (reg_date between '$reg_date' and '$to_date')");
		$count_check=$this->num_row($res_check);
		if($count_check==4)
		{
			$commission=400;
			// check commission already exists or not
			$res_check_com=$this->query("*","level_income_faststart","income_id='$income_id' and commission='400'");
			$count_check_cm=$this->num_row($res_check_com);
		}
		if($count_check==6)
		{
			$commission=600;
			$res_check_com=$this->query("*","level_income_faststart","income_id='$income_id' and commission='600'");
			$count_check_cm=$this->num_row($res_check_com);
		}
		// check the commission already exist or not
		if(!$count_check_cm && $commission>0)
		{
			$commission_fix=$commission;
			$tfs_amount=$commission*10/100;
			$commission=$commission-$tfs_amount;
			
			// check the member already got the commission or not
			// first for 4 direct reseller
			if($count_check==4 || $count_check==6)
			{
				$sql_check="select * from level_income_faststart where income_id='$income_id' and reseller_count='$count_check'";
				$res_check=mysql_fetch_assoc($sql_check);
				$count_c=mysql_num_rows($res_check);
				if(!$count_c)
				{	
					if($reseller_id==1)
					{
						$status=1;
					}
					else
					{
						$status=0;
					}
					$insert_arr=array(
					"invoice_no"=>$invoice_no,
					"purcheser_id"=>$user_id,
					"seller_id"=>$ref_id,
					"income_id"=>$income_id,
					"commission"=>$commission_fix,
					"date"=>$reg_date,
					"reseller_count"=>$count_check,
					"status"=>$status,
					"remark"=>"Get $commission TP as Fast Track bonus "
					);
					$this->insert_tbl($insert_arr,"level_income_faststart");
					
					if($status)
					{
						$this->query_execute("update final_tp set amount=amount+$commission where user_id='$income_id'");
						// insert credit debit history
						$inserarr=array(
						"user_id"=>$user_id,
						"credit_amt"=>$commission,
						"debit_amt"=>'0',
						"receiver_id"=>$income_id,
						"sender_id"=>'admin',
						"receive_date"=>$reg_date,
						"TranDescription"=>"Get $commission TP Of Fast Start Bonus",
						"Remark"=>"Get $commission TP Of Fast Start Bonus",
						"invoice_no"=>$invoice_no
						);
						$this->insert_tbl($inserarr,"final_tp_history");
						// updtae 10% of every commission into tfs wallet
						$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$income_id'");
						$inserarr=array(
						"user_id"=>$user_id,
						"credit_amt"=>$tfs_amount,
						"debit_amt"=>'0',
						"receiver_id"=>$income_id,
						"sender_id"=>'admin',
						"receive_date"=>$reg_date,
						"TranDescription"=>"Get 10% Of Cashback Of Fast Start Bonus".$invoice_no,
						"Remark"=>"Get 10% of Cashback Of Fast Start Bonus".$invoice_no,
						"invoice_no"=>$invoice_no
						);
						$this->insert_tbl($inserarr,"final_tfs_history");
					}
				}
			}
		}
		//exit;
	}
	
	function Ninth_Bonus($user_id)
	{
		// check the user activated his Point Volume System By six direct reseller or not
		// get direct count
		$date=date('Y-m-d');
		//echo $user_id;
		$direct=$this->_get_direct_count($user_id,'reseller');
		//echo $direct;exit;
		//$direct=6;
		if($direct>=6)
		{
			// get the total team purchasing product volume
			$team_purchasing=$this->_get_product_volume($user_id,'team');
			// get the user rank
			$res_user=$this->query("*","registration","user_id='$user_id'");
			$row_user=$this->get_all_row($res_user);
			$user_rank=$row_user['user_rank'];
			$reseller=$row_user['reseller'];
			// get the rank configuration
			//echo $user_rank;exit;
			if($user_rank==7)
			{
				$flag=false;
				$flag_rank=false;
			}
			else if($user_rank==6)
			{
				$flag=$this->_check_rank_config(7,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,7);
			}
			else if($user_rank==5)
			{
				$flag=$this->_check_rank_config(6,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,6);
			}
			else if($user_rank==4)
			{
				$flag=$this->_check_rank_config(5,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,5);
			}
			else if($user_rank==3)
			{
				$flag=$this->_check_rank_config(4,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,4);
			}
			else if($user_rank==2)
			{
				$flag=$this->_check_rank_config(3,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,3);
			}
			else if($user_rank==1)
			{
				$flag=$this->_check_rank_config(2,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,2);
			}
			else
			{
				$flag=$this->_check_rank_config(1,$team_purchasing);
				$flag_rank=$this->_get_rank_bonus($user_id,1);
			}
			//echo '<br>,'.$flag.' && '.$flag_rank;
			//exit;
			if($flag && $flag_rank)
			{
				// get the member commission point
				$rank_config=$this->query("*","user_rank","id='$flag' and '$team_purchasing'>=rank_target");
				$row_config=$this->get_all_row($rank_config);
				$commission=$row_config['target_day'];
				$commission_fix=$commission;
				$new_rank=$row_config['id'];
				$rank_name=$row_config['rank_name'];
				$tfs_amount=$commission*10/100;
				$commission=$commission-$tfs_amount;
				// update member rank
				//echo "update registration set user_rank='$new_rank',user_plan='$rank_name' where user_id='$user_id'";
				if($reseller)
				{
					$this->query_execute("update registration set user_rank='$new_rank',user_plan='$rank_name' where user_id='$user_id'");
					// update the user_rank_achieve table
					$arr_insert=array(
					"rank_id"=>$new_rank,
					"user_id"=>$user_id
					);
					$this->insert_tbl($arr_insert,"user_rank_achieve");
					// update commission
					$insert_arr=array(
					"invoice_no"=>$invoice_no,
					"purcheser_id"=>$user_id,
					"seller_id"=>$ref_id,
					"income_id"=>$user_id,
					"commission"=>$commission_fix,
					"date"=>$date,
					"payout_date"=>$date,
					"status"=>1,
					"reseller_count"=>$count_check,
					"user_level"=>$new_rank,
					"remark"=>"Get $commission TP as Rank Incentive "
					);
					$this->insert_tbl($insert_arr,"level_income_rank");
					// update TP wallet
					$this->query_execute("update final_tp set amount=amount+$commission where user_id='$user_id'");
					// insert credit debit history
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$commission,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get $commission TP Of Rank Incentive",
					"Remark"=>"Get $commission TP Of Rank Incentive",
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tp_history");
					// update TP Wallet History
					// updtae 10% of every commission into tfs wallet
					$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$user_id'");
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$tfs_amount,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get 10% Of Cashback Of Rank Incentive".$invoice_no,
					"Remark"=>"Get 10% of Cashback Of Rank Incentive".$invoice_no,
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tfs_history");
				}
			}
			//exit;
		}
	}
	
	function _update_commission_and_wallet_and_history($user_id,$com_id,$commission,$cnt,$count_check,$ref_id,$invoice_no=false)
	{
		$date=date('Y-m-d');
		$commission_fix=$commission;
		$tfs_amount=$commission*10/100;
		$commission=$commission-$tfs_amount;
		$insert_arr=array(
		"invoice_no"=>$invoice_no,
		"purcheser_id"=>$user_id,
		"seller_id"=>$ref_id,
		"income_id"=>$com_id,
		"commission"=>$commission_fix,
		"date"=>$date,
		"payout_date"=>$date,
		"status"=>1,
		"reseller_count"=>$count_check,
		"level"=>$cnt,
		"remark"=>"Get $commission as Team Sale Passive Bonus "
		);
		$this->insert_tbl($insert_arr,"level_income_team_passive");
		//echo "update final_tp set amount=amount+$commission where user_id='$com_id'";
		$this->query_execute("update final_tp set amount=amount+$commission where user_id='$com_id'");
		// insert credit debit history
		$inserarr=array(
		"user_id"=>$com_id,
		"credit_amt"=>$commission,
		"debit_amt"=>'0',
		"receiver_id"=>$com_id,
		"sender_id"=>'admin',
		"receive_date"=>$date,
		"TranDescription"=>"Get $commission as Team Passive Bonus ",
		"Remark"=>"Get $commission as Team Passive Bonus ",
		"invoice_no"=>$invoice_no
		);
		$this->insert_tbl($inserarr,"final_tp_history");
		$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$com_id'");
		// insert credit debit history
		$inserarr=array(
		"user_id"=>$com_id,
		"credit_amt"=>$tfs_amount,
		"debit_amt"=>'0',
		"receiver_id"=>$com_id,
		"sender_id"=>'admin',
		"receive_date"=>$date,
		"TranDescription"=>"Get $commission as Team Passive Bonus ",
		"Remark"=>"Get $commission as Team Passive Bonus ",
		"invoice_no"=>$invoice_no
		);
		$this->insert_tbl($inserarr,"final_tfs_history");
		//exit;
	}
	
	function _update_commission_and_wallet_and_history_two($user_id,$com_id,$commission,$cnt,$count_check,$ref_id)
	{
		$myfile = fopen($user_id."fift_part_bonuslevel_income_team_passive.txt", "w") or die("Unable to open file!");
			$txt = $invoice_amt;
			fwrite($myfile, $txt);
			fclose($myfile);
			
		$date=date('Y-m-d');
		$commission_fix=$commission;
		$tfs_amount=$commission*10/100;
		$commission=$commission-$tfs_amount;
		$insert_arr=array(
		"invoice_no"=>$invoice_no,
		"purcheser_id"=>$user_id,
		"seller_id"=>$ref_id,
		"income_id"=>$com_id,
		"commission"=>$commission_fix,
		"date"=>$date,
		"payout_date"=>$date,
		"status"=>1,
		"reseller_count"=>$count_check,
		"level"=>$cnt,
		"remark"=>"Get $commission as Team Weekly Passive Bonus "
		);
		$this->insert_tbl($insert_arr,"level_income_team_passive");
		//echo "update final_tp set amount=amount+$commission where user_id='$com_id'";
		$this->query_execute("update final_tp set amount=amount+$commission where user_id='$com_id'");
		// insert credit debit history
		$inserarr=array(
		"user_id"=>$com_id,
		"credit_amt"=>$commission,
		"debit_amt"=>'0',
		"receiver_id"=>$com_id,
		"sender_id"=>'admin',
		"receive_date"=>$date,
		"TranDescription"=>"Get $commission as Team Weekly Passive Bonus ",
		"Remark"=>"Get $commission as Team Weekly Passive Bonus ",
		"invoice_no"=>$invoice_no
		);
		$this->insert_tbl($inserarr,"final_tp_history");
		$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$com_id'");
		// insert credit debit history
		$inserarr=array(
		"user_id"=>$com_id,
		"credit_amt"=>$tfs_amount,
		"debit_amt"=>'0',
		"receiver_id"=>$com_id,
		"sender_id"=>'admin',
		"receive_date"=>$date,
		"TranDescription"=>"Get $commission as Team Weekly Passive Bonus ",
		"Remark"=>"Get $commission as Team Weekly Passive Bonus ",
		"invoice_no"=>$invoice_no
		);
		$this->insert_tbl($inserarr,"final_tfs_history");
		//exit;
	}
	
	function _check_rank_config($user_rank,$team_purchasing)
	{
		//echo "select id from user_rank where id='$user_rank' and '$team_purchasing'>=rank_target";
		$rank_config=$this->query("id","user_rank","id='$user_rank' and '$team_purchasing'>=rank_target");
		$count_config=$this->num_row($rank_config);
		//echo $count_config;
		if($count_config)
		{
			return $user_rank;
		}
		else
		{
			return false;
		}
	}
	
	function _get_rank_bonus($user_id,$rank)
	{
	//echo "<br>";
	//echo "select user_level from level_income_rank where income_id='$user_id' and user_level='$rank'";
		$res=$this->query("user_level","level_income_rank","income_id='$user_id' and user_level='$rank'");
		$count=$this->num_row($res);
		if($count)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function _team_weekly_earning($user_id)
	{
		$total=0;
		// find total downline generation wise
		$res=$this->query("user_id","registration","ref_id='$user_id'");
		while($row=$this->get_all_row($res))
		{
			$income_id=$row['user_id'];
			$res_amt=$this->query("sum(commission) as total","level_income_total","income_id='$income_id'");
			$row_amt=$this->get_all_row($res_amt);
			$total=$total+$row_amt['total'];
		}
		return $total;
	}
	function _team_weekly_earning_level_wise($user_id)
	{
		$total=0;
		// find total downline generation wise
		$res=$this->query("user_id","registration","ref_id='$user_id'");
		while($row=$this->get_all_row($res))
		{
			$income_id=$row['user_id'];
			$res_amt=$this->query("sum(commission) as total","level_income_weekly_retroactive","income_id='$income_id'");
			$row_amt=$this->get_all_row($res_amt);
			
			$res_amt1=$this->query("sum(commission) as total","level_income_weekly","income_id='$income_id'");
			$row_amt1=$this->get_all_row($res_amt1);
			
			$total=$total+$row_amt['total']+$row_amt1['total'];
		}
		return $total;
	}
	
	function _team_sale($user_id)
	{
		$res=$this->query("sum(invoice_amt) as total","purchase_sale","income_id='$user_id'");
		$row=$this->get_all_row($res);
		return $row['total'];
	}
	
	function _get_direct_count($user_id,$type=false)
	{
		if($type=='affiliate')
		{
			$cond=" and bonus=1 ";
		}
		if($type=='reseller')
		{
			$cond=" and reseller=1 ";
		}
		
		$res=$this->query("user_id","registration","ref_id='$user_id' $cond");
		$count=$this->num_row($res);
		return $count;
	}
	
	function _get_product_volume($user_id,$type=false)
	{
		if($type=='personal')
		{
			$cond=" and purcheser_id='$user_id' and income_id='$user_id'";
		}
		else if($type=='team')
		{
			$cond=" and income_id='$user_id'";
		}
		else if($type=='team_exclude')
		{
			$cond=" and purcheser_id<>'$user_id' and income_id='$user_id'";
		}
		else
		{
			$cond="";
		}
		$res=$this->query("SUM(invoice_bv) AS total","purchase_history","status=0 $cond");
		$row=$this->get_all_row($res);
		return $row['total'];
	}
	
	function _get_product_volume_leg($user_id,$leg,$from_date,$to_date,$type=false)
	{
		if($type=='personal')
		{
			$cond=" and purcheser_id='$user_id' and income_id='$user_id'";
		}
		else if($type=='team')
		{
			$cond=" and income_id='$user_id'";
		}
		else if($type=='team_exclude')
		{
			$cond=" and purcheser_id<>'$user_id' and income_id='$user_id'";
		}
		else
		{
			$cond="";
		}
		if($to_date!='')
		{
			$cond_date=" and (date between '$from_date' and '$to_date')";
		}
		//echo "select SUM(invoice_bv) AS total from purchase_history where status=0 and leg='$leg' $cond_date  $cond"."<br>";
		$res=$this->query("SUM(invoice_bv) AS total","purchase_history","status=0 and leg='$leg' $cond_date  $cond");
		$row=$this->get_all_row($res);
		return $row['total'];
	}
	
	function _update_product_volume($id,$invoice_bv,$invoice_no)
	{
		// echo $id.','.$invoice_bv.','.$invoice_no;echo $invoice_bv;exit;
		if($invoice_bv)
		{
			$date=date('Y-m-d');
			// get user power_status
			$res_leg=$this->query("power_status,binary_pos,bonus,ref_id","registration","user_id='$id'");
			$row_leg=$this->get_all_row($res_leg);
			$leg=$row_leg['power_status'];
			$ref_id=$row_leg['ref_id'];
			if($leg==1){$posi='left';}
			else if($leg==2){$posi='right';}
			else{$posi=$row_leg['binary_pos'];}
			// update product volume
			$insert_arr=array(
			"income_id"=>$id,
			"purcheser_id"=>$id,
			"invoice_no"=>$invoice_no,
			"leg"=>$posi,
			"invoice_bv"=>$invoice_bv,
			"remark"=>"Update Product Volume Of Invoice No $invoice_no",
			"date"=>$date,
			);
			$this->insert_tbl($insert_arr,"purchase_history");
			
			$this->Ninth_Bonus($id);
			// update to upline as team purchasing
			if(!$row_leg['bonus'])
			{
				$res_ref=$this->query("power_status,binary_pos,bonus,ref_id","registration","user_id='$ref_id'");
				$row_ref=$this->get_all_row($res_ref);
				$leg=$row_ref['power_status'];
				if($leg==1){$posi='left';}
				else if($leg==2){$posi='right';}
				else{$posi=$row_ref['binary_pos'];}
				$insert_arr=array(
				"income_id"=>$id,
				"purcheser_id"=>$ref_id,
				"invoice_no"=>$invoice_no,
				"leg"=>$posi,
				"invoice_bv"=>$invoice_bv,
				"remark"=>"Update Product Volume Of Invoice No $invoice_no",
				"date"=>$date,
				);
				$this->insert_tbl($insert_arr,"purchase_history");
				$this->Ninth_Bonus($ref_id);
			}
			// get the all uplines of the user
			$res_upline=$this->query("*","level_income","purcheser_id='$id'");
			$cnt=1;
			while($row_upline=$this->get_all_row($res_upline))
			{
				$income_id=$row_upline['income_id'];
				$purcheser_id=$row_upline['purcheser_id'];
				$posi=$row_upline['position'];
	
				$insert_arr=array(
				"income_id"=>$income_id,
				"purcheser_id"=>$purcheser_id,
				"invoice_no"=>$invoice_no,
				"leg"=>$posi,
				"invoice_bv"=>$invoice_bv,
				"level"=>$cnt,
				"remark"=>"Update Product Volume Of Invoice No $invoice_no",
				"date"=>$date,
				);
				$cnt++;
				$this->insert_tbl($insert_arr,"purchase_history");
				$this->Ninth_Bonus($income_id);
			}
		}
	}
	function _update_product_sale($id,$invoice_amt,$invoice_no)
	{
		// echo $id.','.$invoice_amt.','.$invoice_no;echo $invoice_amt;exit;
		if($invoice_amt)
		{
			$date=date('Y-m-d');
			// get user power_status
			$res_leg=$this->query("power_status,binary_pos,bonus,ref_id","registration","user_id='$id'");
			$row_leg=$this->get_all_row($res_leg);
			$leg=$row_leg['power_status'];
			$ref_id=$row_leg['ref_id'];
			if($leg==1){$posi='left';}
			else if($leg==2){$posi='right';}
			else{$posi=$row_leg['binary_pos'];}
			// update product volume
			$insert_arr=array(
			"income_id"=>$id,
			"purcheser_id"=>$id,
			"invoice_no"=>$invoice_no,
			"leg"=>$posi,
			"invoice_amt"=>$invoice_amt,
			"remark"=>"Update Product Volume Of Invoice No $invoice_no",
			"date"=>$date,
			);
			$this->insert_tbl($insert_arr,"purchase_sale");
			
			$this->Ninth_Bonus($id);
			// update to upline as team purchasing
			if(!$row_leg['bonus'])
			{
				$res_ref=$this->query("power_status,binary_pos,bonus,ref_id","registration","user_id='$ref_id'");
				$row_ref=$this->get_all_row($res_ref);
				$leg=$row_ref['power_status'];
				if($leg==1){$posi='left';}
				else if($leg==2){$posi='right';}
				else{$posi=$row_ref['binary_pos'];}
				$insert_arr=array(
				"income_id"=>$id,
				"purcheser_id"=>$ref_id,
				"invoice_no"=>$invoice_no,
				"leg"=>$posi,
				"invoice_bv"=>$invoice_bv,
				"remark"=>"Update Product Volume Of Invoice No $invoice_no",
				"date"=>$date,
				);
				$this->insert_tbl($insert_arr,"purchase_history");
				$this->Ninth_Bonus($ref_id);
			}
			
			// get the all uplines of the user
			$res_upline=$this->query("*","level_income","purcheser_id='$id'");
			$cnt=1;
			while($row_upline=$this->get_all_row($res_upline))
			{
				$income_id=$row_upline['income_id'];
				$purcheser_id=$row_upline['purcheser_id'];
				$posi=$row_upline['position'];
	
				$insert_arr=array(
				"income_id"=>$income_id,
				"purcheser_id"=>$purcheser_id,
				"invoice_no"=>$invoice_no,
				"leg"=>$posi,
				"invoice_amt"=>$invoice_amt,
				"level"=>$cnt,
				"remark"=>"Update Product Volume Of Invoice No $invoice_no",
				"date"=>$date,
				);
				$cnt++;
				$this->insert_tbl($insert_arr,"purchase_sale");
				$this->Ninth_Bonus($income_id);
			}
		}
	}
	
	function Binary_Commission($user_id,$closing,$last_date)
	{	
		$b_date=date('Y-m-d');
		// check 6 direct 
		$direct=$this->_get_direct_count($user_id,'reseller');
			if($direct>=6)
				{
					$status=2;
				}
				else
				{
					$status=0;
				}
			// count left pv of the member date wise
				$left_count=$this->_get_product_volume_leg($user_id,'left',$b_date,$last_date,'team');
			// count right pv of the member date wise
			    $right_count=$this->_get_product_volume_leg($user_id,'right',$b_date,$last_date,'team');
			// get minimum carry between left and right 
			$sql_carry="select * from binary_income where user_id='$user_id' order by id desc limit 1";
			$res_carry=mysql_query($sql_carry);
			$row_carry=mysql_fetch_assoc($res_carry);
			$carry_fwd_left=$row_carry['carry_fwd_left'];
			$carry_fwd_right=$row_carry['carry_fwd_right'];
			// set left right for testing
			/*$left_count=1000;
			$right_count=1000;
			$carry_fwd_left=400;
			$carry_fwd_right=100;*/
			// end  to set 
			$left_count=$left_count+$carry_fwd_left;
			$right_count=$right_count+$carry_fwd_right;
			// end to set testing
			$min=min($left_count,$right_count);
			$cycle=floor($min/300);
			$left_exp=floor($left_count/300);
			$right_exp=floor($right_count/300);
			
			//echo "Right Cycle:".$right_exp."__&Left Cycle:".$left_exp."__&Cycle:".$cycle."__&Left Count:".$left_count."__&Right Count:".$right_count;
			//echo "<br>";
			if($left_exp<$right_exp)
			{
				if(($left_exp*2)==$right_exp)
				{
					$left_cycle=$left_exp;
					$rightt_cycle=$right_exp;
				}
				else if(($left_exp*2)<=$right_exp || ($left_exp*2)>=$right_exp)
				{
					$left_exp_temp=floor($right_exp/2);
					if($left_exp_temp<=$left_exp)
					{
						$left_exp=$left_exp_temp;
						$right_exp=$left_exp_temp*2;
					}
					else
					{
						$left_exp=$left_exp;
						$right_exp=$left_exp*2;
					}
					$left_cycle=$left_exp;
					$rightt_cycle=$right_exp;
				}
			}
			else if($right_exp<$left_exp)
			{
				if(($right_exp*2)==$left_exp)
				{
					$left_cycle=$left_exp;
					$rightt_cycle=$right_exp;
				}
				else if(($right_exp*2)<=$left_exp || ($right_exp*2)>=$left_exp)
				{
					$right_exp_tmp=floor($left_exp/2);
					if($right_exp_tmp<=$right_exp)
					{
						$right_exp=$right_exp_tmp;
						$left_exp=$right_exp_tmp*2;
					}
					else
					{
						$right_exp=$right_exp;
						$left_exp=$right_exp*2;
					}
					$left_cycle=$left_exp;
					$rightt_cycle=$right_exp;
				}
			}
			else if($right_exp==$left_exp)
			{
				$left_exp=floor($left_exp/2);
				if($left_exp<$right_exp)
				{
					$left_exp_temp=floor($right_exp/2);
					if($left_exp_temp<=$left_exp)
					{
						$left_exp=$left_exp_temp;
						$right_exp=$left_exp_temp*2;
					}
					else
					{
						$left_exp=$left_exp;
						$right_exp=$left_exp*2;
					}
					$left_cycle=$left_exp;
					$rightt_cycle=$right_exp;
				}
			}
			
			$min_cycle=min($left_cycle,$rightt_cycle);
			$commission=$min_cycle*60;
			
			// set binary commission
			//echo "Right Cycle:".$rightt_cycle."__&Left Cycle:".$left_cycle."__&Cycle:".$min_cycle."__&Commission:".$commission;
			//echo "<br>";
			// update volume of the commission and remain is carry forword
			// left update
			$match_lcount=$left_cycle*300;
			$match_rcount=$rightt_cycle*300;
			
			$carry_left=$left_count-$match_lcount;
			$carry_right=$right_count-$match_rcount;
			
			//echo "Right Cycle:".$rightt_cycle."__&Left Cycle:".$left_cycle."__&Cycle:".$min_cycle."__&Commission:".$commission."__&Left Carry:".$carry_left."__&Right Carry:".$carry_right."__&Match Left:".$match_lcount."__&Match Right:".$match_rcount;
			
			$insert="insert into binary_income set user_id='$user_id',match_left='$match_lcount',match_right='$match_rcount',carry_fwd_left='$carry_left',carry_fwd_right='$carry_right',pair='$min_cycle',lpair='$left_cycle',rpair='$rightt_cycle',commission='$commission',status='$status',remark='Get Binary Commission pair wise',b_date='$b_date',closing='$closing'";
			mysql_query($insert);
			
			if($commission>0)
			{
				$date=date('Y-m-d');
				// update the left and right pv
				if($last_date!='')
				{
					$this->query_execute("update purchase_history set status=1 where income_id='$user_id' and status=0 and (date between '$b_date' and '$last_date')");
				}
				else
				{
					$this->query_execute("update purchase_history set status=1 where income_id='$user_id' and status=0");
				}
				// end to update 
				if($direct>=6)
				{
					$tfs_amount=$commission*10/100;
					$commission=$commission-$tfs_amount;
					//echo "update final_tp set amount=amount+$commission where user_id='$com_id'";
					$this->query_execute("update final_tp set amount=amount+$commission where user_id='$user_id'");
					// insert credit debit history
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$commission,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get $commission as Binary Bonus ",
					"Remark"=>"Get $commission as Binary Bonus ",
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tp_history");
					$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$user_id'");
					// insert credit debit history
					$inserarr=array(
					"user_id"=>$user_id,
					"credit_amt"=>$tfs_amount,
					"debit_amt"=>'0',
					"receiver_id"=>$user_id,
					"sender_id"=>'admin',
					"receive_date"=>$date,
					"TranDescription"=>"Get $commission as Binary Bonus ",
					"Remark"=>"Get $commission as Binary Bonus ",
					"invoice_no"=>$invoice_no
					);
					$this->insert_tbl($inserarr,"final_tfs_history");
				}
			}
	}
	
	# update pending commission
	function _Update_Pending_Commission($user_id)
	{
		$date=date('Y-m-d');
		// check the pending commission of the user
		// first check and update the direct sponsored bonus
		$res=$this->query("*","level_income_total","income_id='$user_id' and status=0");
		while($row=$this->get_all_row($res))
		{
			$income_id=$row['income_id'];
			$commission=$row['commission'];
			$invoice_no=$row['invoice_no'];
			$l_id=$row['l_id'];
			// update commission to paid status
			$this->query_execute("update level_income_total set status=1,payout_date='$date' where l_id='$l_id'");
			$tfs_amount=$commission*10/100;
			$commission=$commission-$tfs_amount;
			// update cash wallet
				$this->query_execute("update final_tp set amount=amount+$commission where user_id='$income_id'");
				// insert credit debit history
				$inserarr=array(
				"user_id"=>$income_id,
				"credit_amt"=>$commission,
				"debit_amt"=>'0',
				"receiver_id"=>$income_id,
				"sender_id"=>'admin',
				"receive_date"=>$date,
				"TranDescription"=>'Get 100 TP On the sell of the 30 stock to sell products',
				"Remark"=>'Get 100 TP On the sell of the 30 stock to sell products',
				"invoice_no"=>$invoice_no
				);
				$this->insert_tbl($inserarr,"final_tp_history");
				// updtae 10% of every commission into tfs wallet
				$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$income_id'");
				$inserarr=array(
				"user_id"=>$income_id,
				"credit_amt"=>$tfs_amount,
				"debit_amt"=>'0',
				"receiver_id"=>$income_id,
				"sender_id"=>'admin',
				"receive_date"=>$date,
				"TranDescription"=>'Get 10% Of Cashback On The Invoice'.$invoice_no,
				"Remark"=>'Get 10% of Cashback On The Invoice'.$invoice_no,
				"invoice_no"=>$invoice_no
				);
				$this->insert_tbl($inserarr,"final_tfs_history");
		}
		
		// second check and update the fast start commission
		
		$res_fast=$this->query("*","level_income_faststart","income_id='$user_id' and status=0");
		while($row_fast=$this->get_all_row($res_fast))
		{
			$income_id=$row_fast['income_id'];
			$commission=$row_fast['commission'];
			$invoice_no=$row_fast['invoice_no'];
			$l_id=$row_fast['l_id'];
			// update commission to paid status
			$this->query_execute("update level_income_faststart set status=1,payout_date='$date' where l_id='$l_id'");
			$tfs_amount=$commission*10/100;
			$commission=$commission-$tfs_amount;
			// update cash wallet
				$this->query_execute("update final_tp set amount=amount+$commission where user_id='$income_id'");
				// insert credit debit history
				$inserarr=array(
				"user_id"=>$income_id,
				"credit_amt"=>$commission,
				"debit_amt"=>'0',
				"receiver_id"=>$income_id,
				"sender_id"=>'admin',
				"receive_date"=>$date,
				"TranDescription"=>'Get 100 TP On the sell of the 30 stock to sell products',
				"Remark"=>'Get 100 TP On the sell of the 30 stock to sell products',
				"invoice_no"=>$invoice_no
				);
				$this->insert_tbl($inserarr,"final_tp_history");
				// updtae 10% of every commission into tfs wallet
				$this->query_execute("update final_tfs set amount=amount+$tfs_amount where user_id='$income_id'");
				$inserarr=array(
				"user_id"=>$income_id,
				"credit_amt"=>$tfs_amount,
				"debit_amt"=>'0',
				"receiver_id"=>$income_id,
				"sender_id"=>'admin',
				"receive_date"=>$date,
				"TranDescription"=>'Get 10% Of Cashback On The Invoice'.$invoice_no,
				"Remark"=>'Get 10% of Cashback On The Invoice'.$invoice_no,
				"invoice_no"=>$invoice_no
				);
				$this->insert_tbl($inserarr,"final_tfs_history");
		}
		
	}	
}
?>