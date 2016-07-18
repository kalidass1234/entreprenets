<?php 
session_start();

require_once "connection.php";

require_once "../admin/function.php";

require_once "update-meber-bv.php";
include_once('../rank_class.php');
function spill($sponserid)
{
	$lev=1;
	global $nom_id1,$lev;
	//$lev=1;
	
	foreach($sponserid as $key => $val)
	{
		  $query1="select * from registration where nom_id='$val' order by id";
		$result1=mysql_query($query1);
		 $num_ro1[]=mysql_num_rows($result1);
		while($row=mysql_fetch_array($result1))
		{
			$rclid1[]=$row['user_id'];
		}
	}
	
	foreach($num_ro1 as $key11 => $valu)
	{
		if($valu<4)
		{
			$key1=$key11;
			break;
		}
	}
		
	   switch ($valu)
	   {
		   case '0':
		   $nom_id1=$sponserid[$key1];
			   break;
	
		   case '1':
		   $nom_id1=$sponserid[$key1];
			   break;
	
				case '2':
		   $nom_id1=$sponserid[$key1];
			   break;
			case '3':
		   $nom_id1=$sponserid[$key1];
			   break;
			   case '4':
		   
			if(!empty($nom_id1))
			{
			 break;
			}
			
			$lev++;
		
			spill($rclid1);
	
	}
	
	return $nom_id1;
	return $lev;
}

function invoice()
 {
  //$encypt1=uniqid(rand(), true);
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);
  
  $checkid=mysql_query("select invoice from mem_subscribe where invoice='$pre_userid'");
  if(mysql_num_rows($checkid)>0)
  {
   invoice();
  }
  else
   return $pre_userid;
 }
 
function registernow($payment_mode)
{
	global $ref, $fname, $lname,  $user_nm, $email, $pass,$address1,$city,$state,$zipcode, $mobile;
	$cur_date=date('Y-m-d');
	$fname=ucfirst($fname);
	$lname=ucfirst($lname);
	$package=$_SESSION['package_s']; 
	/*$sql_pac=mysql_fetch_array(mysql_query("select * from package where package_id='$package'"));
	$package_name=$sql_pac['package_name'];
	$price=$sql_pac['total_price'];*/
	
	$birth_date=$_SESSION['year_s'].'-'.$_SESSION['month_s'].'-'.$_SESSION['day_s'];
	$country=$_SESSION['country_s'];
	$address2=$_SESSION['address2_s'];
	$mname=$_SESSION['mname_s'];
	$mname=ucfirst($mname);
	$ssn=$_SESSION['ssn_s'];	
	$CoFirstName=$_SESSION['CoFirstName_s'];
	$CoCompany=$_SESSION['CoCompany_s'];
	$coemail=$_SESSION['CoEmail_s'];
	$CoLastName=$_SESSION['CoLastName_s'];
	$CoSSN=$_SESSION['CoSSN_s'];
	$ShipStreet1=$_SESSION['ShipStreet1_s'];
	$ShipStreet2=$_SESSION['ShipStreet2_s'];
	$ShipCountry=$_SESSION['ShipCountry_s'];
	$ShipPostalCode=$_SESSION['ShipPostalCode_s'];
	$ShipCity=$_SESSION['ShipCity_s'];
	$ShipState=$_SESSION['ShipState_s'];
	 $phoner=$_SESSION['phoner_s'];
	$phoneo=$_SESSION['phoneo_s'];
	$fax=$_SESSION['fax_s'];
	$mobile=$_SESSION['mobile_s'];
	$company=$_SESSION['Company_s'];
	$gender=$_SESSION['gender_s'];
	$plan_amt=$_SESSION['total_price'];

	if("manual" == $payment_mode || $package==3){
		
		$rank='Customer'; 
		
	}
	else{
		$result_spill=mysql_fetch_array(mysql_query("select power_leg, power_status  from registration where user_id='$ref' and nom_id!=''"));
	
		if($result_spill['power_status']==1){
			 $nom=$result_spill['power_leg'];
			$idx[]=$nom;
				$idx2[]=$nom;
				$nom_id=spill($idx);
		}
		//else
		$rank='Trainee';
		
	}
	$nom_id=spill(array($ref));	
	$date=date('Y-m-d');
	function userid()
	{
		//$encypt1=uniqid(rand(), true);
		$encypt1=uniqid(rand(1000000000,9999999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		
		$checkid=mysql_query("select user_id from registration where user_id='$pre_userid'");
		if(mysql_num_rows($checkid)>0)
		{
			userid();
		}
		else
			return $pre_userid;
	}
	$user_id=userid();
	
	/*-----------------------------------------
	 * Get BV of Product according Package
	 * Product Volume get from product table
	 * Insert Rec in Final BV Table
	*----------------------------------------*/
	$pack_sql="select * from package1 where package_id='".$_SESSION['package_s']."'";
	$args_package=getRow(query($pack_sql));
	
	$package_name = $args_package['package_name'];
	$total_price = $args_package['total_fees'];
	$price = $total_price;

	$t_code="12345";
//	echo "select user_id from registration where nom_id='$nom_id'";
	$sql_pos=mysql_query("select user_id, rank from registration where nom_id='$nom_id'");
	$res_nom=mysql_fetch_array($sql_pos);
	$count_pos=mysql_num_rows($sql_pos);
	$position=$count_pos+1;
	 $query_reg="insert into registration SET user_id='$user_id', user_name='$user_nm', nom_id='$nom_id', user_pass='$pass', t_code=$t_code, plan_name='$plan_name', pin_no='$pin', ref_id='$ref',mem_status=0, first_name='$fname', mid_name='$mname', last_name='$lname', email='$email', address1='$address1', address2='$address2', city='$city',state='$state',country='$country',zip='$zipcode', user_type='$user_type', mobile='$mobile', reg_date='$date', package='$package_name', dob='$birth_date', ship_street1='$ShipStreet1', ship_street2='$ShipStreet2', ship_country='$ShipCountry', ship_zip='$ShipPostalCode', ship_city='$ShipCity', ship_state='$ShipState', co_fname='$CoFirstName', co_lname='$CoLastName', co_company='$CoCompany', co_ssn='$CoSSN', co_email='$coemail', company='$company', phoner='$phoner', phoneo='$phoneo', fax='$fax', position_tree='$position',ssn='$ssn',sex='$gender',plan_amt='$plan_amt', rank='$rank'";
//echo "<br>". $query_reg; exit;
	$result=mysql_query($query_reg) or die("Error: ".$query_reg.mysql_error());
	$regid=mysql_insert_id();
	/** send in mail */
	
	$_SESSION['shipping_charge'] = $_SESSION['total_price']-$args_package['total_fees'];
	$_SESSION['product_charge'] = $args_package['total_fees'];
	$_SESSION['package_name'] = $package_name;
	
	if("manual" != $payment_mode && $package!=3)
	{

	/** Insert user record in E - wallet for manage amount */
	$query1="insert into final_e_wallet (user_id,amount) values ('$user_id','0')";
	
	
	
	$result1=mysql_query($query1) or die($query1.mysql_error());
	 if($_SESSION['package_s']==1){
		$amount=155.95;
	 }
	  if($_SESSION['package_s']==2){
		$amount=280;
	 }
	 /* if($_SESSION['package_s']==3){
		$amount=100;
	 }*/
	 
	 $invoicem=$_SESSION['invoice'];
 
			/*************  Training Bonus   *****************/
			if($nom_id!=''){
				
	  $sql_ins=mysql_query("INSERT INTO mem_subscribe  SET user_id='$user_id', user_name='$user_nm', s_date='$date', package='$package', price='$price', invoice='$invoicem',  total_price='$price',  product_name='$package'") or die(mysql_error());
	 /* 
	  mysql_query("INSERT INTO level_income SET income_id='$ref_id' , down_id='$user_id', package='$package_name', commission='$amount', remark='$package_name',l_date='$date',status='0', invoice='$invoice',  price='$price' ");
	  */
	  	mysql_query("INSERT INTO membership SET  user_id='{$user_id}', date='$date', member_fees='$plan_amt', payment_type='', user_type='', invoice='$invoicem', total_price='$plan_amt'");
		
				
	//	mkdir("/home/develope/public_html/seancare/$user_nm", 0755);
		//copy("/home/develope/public_html/seancare/index_format.php","/home/develope/public_html/seancare/$user_nm/index.php");//** Create random invoice no */
			
			/** Update new member final business volume */
			$insert_bv=array('',$user_id,'','','',$args_package['total_bv'],$args_package['total_bv'],'','');
			insert_tbl($insert_bv,'final_bv');
			//echo "INSERT INTO rank_bv SET user_id='$user_id', date='$date', bv='{$args_package['total_bv']}', tbv='{$args_package['total_bv']}'";
			mysql_query("INSERT INTO rank_bv SET user_id='$user_id', date='$date', bv='{$args_package['total_bv']}', tbv='{$args_package['total_bv']}'");
				$regid=$regid-1;
				//echo "select * from registration order by id desc limit 1, 2";
				//exit;
				$sql_reg=mysql_query("SELECT user_id FROM registration ORDER BY id DESC LIMIT 1,2");
				
				while($res_reg_traing=mysql_fetch_array($sql_reg)){
					if($res_reg_traing['user_id']!=''){
					//$sql_traing=mysql_fetch_array($regid);
					//echo "<br>INSERT INTO level_income SET income_id='{$res_reg_traing['user_id']}', level='', commission=5, l_date='$cur_date', remark='Training Bonus', payout_date='', package='$package', package_id='{$_SESSION['package_s']}'<br>";
					//echo "select id from level_income where income_id='{$res_reg_traing['user_id']}' and remark='Training Bonus'";
					if(mysql_num_rows(mysql_query("select income_id from level_income where income_id='{$res_reg_traing['user_id']}' and remark='Training Bonus'"))<2){
				mysql_query("INSERT INTO level_income SET income_id='{$res_reg_traing['user_id']}', level='', commission=5, l_date='$cur_date', remark='Training Bonus', payout_date='', package='$package', package_id='{$_SESSION['package_s']}', purchaser_id='$user_id', invoice='$invoicem'");
				
				//updateRank($nom_id, $res_nom['rank']);	
				}
				}
				$update_rank=new RankUpdate;
				$update_rank->update_rank();
				
				}
			} 
			/************ unserilize product and infromations **/
			$products=unserialize(stripslashes($args_package['products']));
			$product_qty=unserialize(stripslashes($args_package['product_qty']));
			$product_costs=$args_package['total_fees'];
			$products_bv=unserialize(stripslashes($args_package['business_volume']));
			$s_prod_cost=unserialize(stripslashes($args_package['single_product_cost']));
			$s_prod_bv=unserialize(stripslashes($args_package['single_product_bv']));
			
		if(!empty($product_qty[0]))
		{				
			$qty=0;
			for($i=0; $i<count($products); $i++)
			{	
				$qty+=$product_qty[$i];
				/* store record of product in purchase table  */
				$insert=array('',$invoicem,$user_id,$products[$i],$_SESSION['package_s'],$_SESSION['package_s'],$product_qty[$i],$s_prod_cost[$i],'','','',date("Y-m-d"),'$',0,$payment_mode,'',$product_costs,$s_prod_bv[$i],$products_bv[$i],'','', $user_nm);
				//print_r($insert);
				insert_tbl($insert,'purchase_detail');
			}			
			
			/*** show in main and thank you page */
			$shipping_charge=$_SESSION['total_price']-$args_package['total_fees'];
						
			/** insert record in amount details  of member */
			$insert_amt=array('',$user_id,$user_id,$invoicem,$args_package['total_fees'],'',$shipping_charge,'',$_SESSION['total_price'],$payment_mode,0,'','registration',$_SESSION['ref_id'],'',date("Y-m-d"),$qty,'','',$args_package['total_bv'],'','','',$user_nm,'', '','0');
			insert_tbl($insert_amt,'amount_detail');
						
			
			update_member_bv($user_id,$args_package['total_bv'],$args_package['total_fees'],$qty,$invoicem, $payment_mode);
			
			/** padin bonus to member */
			$bonus_amt=$amount;
			//Fast Start Bonus
			if($bonus_amt > 0) 
			{	$enroller_per=50;
				//echo "select * from registration where user_id='$ref'";
				//mysql_query("select * from registration where user_id='$ref'") or die(mysql_error());
				$sql_fast=mysql_fetch_array(mysql_query("select rank, ref_id from registration where user_id='$ref'"));
				/*if($sql_fast['rank']=='tt') $enroller_per+=4;
				if($sql_fast['rank']=='ett') $enroller_per+=4;
				if($sql_fast['rank']=='etl') $enroller_per+=4;
				if($sql_fast['rank']=='tcc') $enroller_per+=4;
				if($sql_fast['rank']=='rd') $enroller_per+=4;
				if($sql_fast['rank']=='rvp') $enroller_per+=4;
				if($sql_fast['rank']=='svp') $enroller_per+=4;*/
				//$enroller_com=(($args_package['total_bv'])*$enroller_per)/100;
				$enroller_com=50;
				$level=1;
				
				///       Training Bonus        //
				mysql_query("insert into level_income set income_id='{$ref}', level='1', commission='$enroller_com', l_date='$cur_date', remark='Fast Start Bonus', payout_date='', package='$package_name', package_id='{$_SESSION['package_s']}', purchaser_id='$user_id', invoice='$invoicem'");
				
				 $ref_fast=$sql_fast['ref_id']; 
				 
				while($ref_fast!='cmp'){
					$level++;
					
					 $rank_array=array( 'tt', 'ett' , 'etl', 'rd', 'rvp', 'svp', 'President');
					
					$sql_fast_level=mysql_fetch_array(mysql_query("select user_id, rank, ref_id from registration where user_id='$ref_fast'"));
					if($level==2) $com_ref=4; else $com_ref=2;
					//if($sql_fast_level['rank']!='Trainee' && $sql_fast['rank']!='Trainee'){ //$com_ref=$amount*0.04;
					
						mysql_query("insert into level_income set income_id='{$ref_fast}', level='$level', commission='$com_ref', l_date='$cur_date', remark='Fast Start Bonus', payout_date='', package='$package_name', package_id='{$_SESSION['package_s']}', purchaser_id='$user_id', invoice='$invoicem'");
						
					/*for($i=0; $i<count($rank_array); $i++){
						echo $rank_array[$i]."<br> sql_fast['rank']-".$sql_fast['rank'];
						if($rank_array[$i]==$sql_fast['rank']){ 
						$check=1;
						break;
						}
					}*/
					
					
					$ref_fast=$sql_fast_level['ref_id'];
					if($level==4) break;
				}
			}
		
		}
		
		unset($_SESSION['payment_for']);
		
 	$from="support@seancare.com"; //  admin username
	// $name=$fname." ".$lname;

	$time=date("Y-m-d_H:i:s", time());
	$to=$email;
	/*$email = base64_encode($email);
	$check_sp = base64_encode($check_sp);
	$mem_type = base64_encode($mem_type);
	$user_type = base64_encode($user_type);
	$sponser_id = base64_encode($ref);
	$nom_id = base64_encode($nom_id);*/
	$userid=base64_encode($user_id);

	 $name=$fname;
	 
	 $headeruser="Mime-Version: 1.0\r\n";
       $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headeruser1="Mime-Version: 1.0\r\n";
       $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headeruser1.= "From: info@seancare.com <$from>" . "\r\n";
     $msg= "<html><head><title></title></head>
	 <body>
 <div style='width:800px; margin:0px auto;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>Hello $name, </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Thank you for joining our exciting business opportunity; we look forward to seeing you succeed.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
	    <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Please be sure to save this e-mail or make note of your unique User ID; You will need to use your User ID when logging in and managing your site. </p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'>Your new team members' details are:
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Your Distributor ID is:  $user_nm
</p></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Username : $user_nm
</p></td>
        <td>&nbsp;</td>
      </tr>
        <tr>
			<td >Password : $pass</td>
			
		  </tr> 
		  <tr>
			<td >Transaction Password: $ref</td>
			
		  </tr>
		  <tr>
			<td >Your New Website URL is: <a href='http://www.seancare.com/$user_nm' target='blank'>http://www.seancare.com/$user_nm</a></td>
			
		  </tr>
		  
		  
      <tr>
        <td height='77'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Yours in Success, </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Seancare LLC </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@seancare.com </p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    
</body>
</html>";
//echo $msg;
//exit;
	mail($to,' Seancare REGISTRATION',$msg,$headeruser1,"-f$from");
	



$sql_spondetl=mysql_query("select * from registration where user_id='$ref'");
$rec_sponse=mysql_fetch_array($sql_spondetl);
$spon_name=$rec_sponse['first_name']." ".$rec_sponse['last_name'];
$spon_email=$rec_sponse['email'];


/////////////******************************//
 	$from="support@seancare.com"; //  admin username
	// $name=$fname." ".$lname;

	$time=date("Y-m-d_H:i:s", time());
	$to=$email;
	/*$email = base64_encode($email);
	$check_sp = base64_encode($check_sp);
	$mem_type = base64_encode($mem_type);
	$user_type = base64_encode($user_type);
	$sponser_id = base64_encode($ref);
	$nom_id = base64_encode($nom_id);*/
	$userid=base64_encode($user_id);

	 $name=$fname;
	 
	 $headeruser="Mime-Version: 1.0\r\n";
       $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headeruser1="Mime-Version: 1.0\r\n";
       $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headeruser1.= "From: info@seancare.com <$from>" . "\r\n";
     $msg= "<html><head><title></title></head>
	 <body>
 <div style='width:800px; margin:0px auto;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
 
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>Hello $spon_name, </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Congratulations! You now have a new team member. I would like to take this opportunity to advise you that ".ucfirst($name)." has joined your team.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
	    <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Please take the time to contact them and welcome them to your team. Guide them through their new site and any questions they may have. </p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'>Your new team members' details are:
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
  Name:  $name
</p></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Email: $to
</p></td>
        <td>&nbsp;</td>
      </tr>
        
		  
		  <tr>
			<td >Site Name: : <a href='http://www.seancare.com/$user_nm' target='blank'>http://www.seancare.com/$user_nm</a></td>
			
		  </tr>
		  
		  
      <tr>
        <td height='77'>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Yours in Success, </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>Seancare LLC </p></td>
        <td>&nbsp;</td>
      </tr>
	    <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>info@seancare.com </p></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
    
</body>
</html>";
//echo $msg;
//exit;
	mail($spon_email,' Your Seancare New Team Membres',$msg,$headeruser1,"-f$from");




		$_SESSION['adid']=$user_id;
		if($_SESSION['return_page']!=''){
			$return_page=$_SESSION['return_page'];
			
			header("Location:../$return_page");
		}
		else
		header("Location:../userpanel/member_profile.php");
	
	}
	else
	{
		/*** get package information */
		$sql="select * from package1";
		$args_package=getRows(query($sql));
		
		
		/*** semd mail for payment if member make manual payment */
		$from="support@seancare.com"; //  admin username
			
		$time=date("Y-m-d_H:i:s", time());
		$to=$email;
		
		$userid=base64_encode($user_id);
	
		 $name=$fname;
		 
		 $headeruser="Mime-Version: 1.0\r\n";
		   $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headeruser1="Mime-Version: 1.0\r\n";
		   $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		   $headeruser1.= "From: info@seancare.com <$from>" . "\r\n";
		 $msg= "<html><head><title></title></head>
		 <body>
	 <div style='width:800px; margin:0px auto;'>
		<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	 
	 
		  <tr>
			<td ><P style='font-family:Calibri; font-size:13pt; '>Dear $name, </P></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'>Thank you for Registering with seancare.com.</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'> Our credit card processor is almost ready to go live, on the mean time in order to permanently place you

in the system you need to complete your activation by making the payment manually.
	</p></td>
			
		  </tr>
		  <tr>
			<td ><p style='font-family:Calibri; font-size:13pt;'>
	We made this process simple.
	</p></td>

		  </tr>
		  <tr>
			<td >Just go to any Wells Fargo branch and make a deposit into the corporate account.</td>
		  </tr>
		  <tr>
			<td >After your deposit is done make sure you scan your receipt to upload it in the system.</td>
		  </tr>
		  <tr>
			<td ><p style='font-family:Calibri; font-size:13pt;'>Once you have completed the wire transfer, click the link below to upload the scanned receipt.</p></td>
		  </tr>
		  
		  <tr>
			<td ><p style='font-family:Calibri; font-size:13pt; '><a href='http://www.seancare.com/manual-payment.php?uid=$userid&paymet=manual'>http://www.seancare.com/manual-payment.php?uid=$userid&paymet=manual</p></td>
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'>You will be activated as soon deposit confirmation is completed.</p></td>
			
		  </tr>
		  <tr>	
		  		<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td ><p style='font-family:Calibri; font-size:13pt;'>Below is the total amount you need to deposit accordingly:</p></td>
		  </tr>
		  <tr>
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>".$_SESSION['package_name'].": $".$_SESSION['product_charge']."</p></td>

		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;font-weight:bold;'>Shipping Charge: $".$_SESSION['shipping_charge']."</p></td>
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Total Charge: $".$_SESSION['total_price']."</p></td>
			
		  </tr>
		  
		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; '>Below is the corporate account information to make your deposit:</p></td>
			
		  </tr>
		  
		  <tr>
		
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Bank: Test</p></td>
			
		  </tr>
		  
		   <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Account Name:  Seancare Test</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Accout Nunber:  000000000</p></td>
			
		  </tr>
		   
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Thanks in advance and welcome to Seancare.</p></td>
			
		  </tr>
		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Seancare team</p></td>
			
		  </tr>
		
	</table>
	</div>
		
	</body>
	</html>";

		mail($to,' Seancare REGISTRATION',$msg,$headeruser1,"-f$from");
		
		header("Location:../thank-you.php?uid=$user_id&msg=thank you");		
	}
	
}
//print_r($_POST);
$ref=$_SESSION['sponsor_id_s'];
$fname=$_SESSION['fname_s'];

$lname=$_SESSION['lname_s'];
 $email=$_SESSION['email_s'];
$user_nm=$_SESSION['user_name_s'];
$mobile=$_SESSION['mobile_s'];
$address1=$_SESSION['address_s'];
$city=$_SESSION['city_s'];

$state=$_SESSION['state_s'];
$zipcode=$_SESSION['zipcode_s'];
$pass=$_SESSION['pass_s'];

 $sql_check="select id from registration where email='$email'";

$res_check=mysql_query($sql_check);
 $count_check=mysql_num_rows($res_check);
//$_SESSION['payment_mode']='free';
  $payment_mode=isset($_SESSION['payment_mode']) ? $_SESSION['payment_mode'] : $_GET['payment'] ; 
 $sql_check_cust="select id from registration where user_id='$ref' and package='Customer'";

$res_check_cust=mysql_query($sql_check_cust);
 $count_check_cust=mysql_num_rows($res_check_cust);

if($count_check==0)
{
	if($count_check_cust==0){	
		if($payment_mode == "voguepay" && isset($_SESSION['orderno']))
		{
			unset($_SESSION['payment_mode']);
			if($_SESSION['payment_for'] == "registration" )
				registernow($payment_mode);
			else
			{?>
				<script language="javascript">
					document.location.href='../userpanel/confirm-order-by-online.php';
				</script>
	
			<?php }
		}
		else if("manual" == $payment_mode)
			registernow($payment_mode);
		else if($payment_mode=='free' || $payment_mode=='payza'){
			registernow($payment_mode);
		}
		else if($payment_mode=='voguepay' && isset($_SESSION['invoice'])){
			//echo "select * from vogue_notify where user1='{$user_nm}' and status=0<br>".$_SESSION['invoice']."<br>";
			
			$sql_vogue=mysql_fetch_array(mysql_query("select * from vogue_notify where user1='{$user_nm}' and status=0"));
			if($sql_vogue['item_id']==$_SESSION['invoice']){
				//echo 'item_id-'.$sql_vogue['item_id'].'<br>order no-'.$_SESSION['invoice'];
				registernow($payment_mode);
				mysql_query("update vogue_notify set status=1 where item_id='{$sql_vogue['item_id']}'");
				
			}
			else 
			header("Location:../payment.php?msg=Payment has been altered.");
		}
		else { 
			header("Location:../payment.php?msg=choose right option of payment");
		}
	}
	else{
	
		?>
		<script language="javascript">
        alert("This user can not be register any member.");
        document.location.href='../';
        </script>
        <?php
		
	}
}
else
{
	?>
	<script language="javascript">
	alert("This email is already registered. Please choose different Email");
	document.location.href='../';
	</script>
	<?php
}
?>