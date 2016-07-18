<?php

function update_member_bv($user_id,$prod_vol,$price,$qty,$invoiceno,$pay_type)
{
	
	/** get nom of register member */
	$sql="select ref_id,reg_date, user_name, nom_id from registration where user_id='$user_id'";
	$args_user=getRow(query($sql));
	$refid=$args_user['ref_id'];
	$nomid=$args_user['nom_id'];
	$reg_date=$args_user['reg_date'];
	$user_name=$args_user['user_name'];
	$i=0;	
	//** update upper level member BV by loop */
	while($nomid!="cmp")
	{
		/** update final BV of upper members */
		$update="update final_bv set totalbv=(totalbv+$prod_vol), uni_lvl=(uni_lvl+$prod_vol) where user_id='$refid'";
		query($update);
		 $update_rank_bv="update rank_bv set tbv=(tbv+$prod_vol), bv=(bv+$prod_vol) where user_id='$refid'";
		query($update_rank_bv);
		/** get referal id*/
		$sql="select ref_id from registration where user_id='$refid'";
		$args_ref=getRow(query($sql));
		
		/** insert record in amount_detail of pv */
		$insert_amt=array('',$refid,$user_id,$invoiceno,$price,'',$shipping_charge,'',$price,$pay_type,0,'','registration',$args_ref['ref_id'],'',date("Y-m-d"),$qty,'','',$prod_vol,'','','', $user_name,'','', $i);
		insert_tbl($insert_amt,'amount_detail');
		
		
		/** select nom again*/
		
		$sql="select ref_id,reg_date, nom_id from registration where user_id='$refid'";
		$args_nom=getRow(query($sql));
		$refid=$args_nom['ref_id'];
		$nomid=$args_nom['nom_id'];
		$reg_date=$args_nom['reg_date'];	
		$i++;
	}
	
}

?>