<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style><?php
include "models/connection.php";

include('function.php');

include("../controller/spil_idsearch.php");

include ("../controller/update-meber-bv.php");

if(isset($_GET['action']))
{
	$value=$_GET['action'];
	switch($value)
	{
		case "verify":
			VerifyUser();
		break;
		case "reject":
			RejectUser();
		break;
	}
}

/*---------------------------------------
* change subscription status
*----------------------------------------*/
function VerifyUser()
{

	$user_id=$_GET['id'];
	
	$sql="select * from registration where user_id='$user_id'";
	$args_ref=getRow(query($sql));
	$ref=getValue($args_ref,'ref_id',false);
	$package=getValue($args_ref,'package',false);
	
	$email=getValue($args_ref,'email',false);
	$result_spill=mysql_fetch_array(mysql_query("select power_leg, power_status  from registration where user_id='$ref'"));
		if($result_spill['power_status']==1){
			 $nom=$result_spill['power_leg'];
			$idx[]=$nom;
				$idx2[]=$nom;
				$nom_id=spill($idx);
		}
		else
	$nom_id=spill(array($ref));
	
	/**update nom of member */
	$update="update registration set nom_id='$nom_id', mem_status='0' where user_id='$user_id'"	;
	query($update);
	
	/** Insert user record in E - wallet for manage amount */
		$query1="insert into final_e_wallet (user_id,amount) values ('$user_id','0')";
		$result1=mysql_query($query1) ; //or die($query1.mysql_error());
		//$invoice=invoice();

		/** get package id */
		$sql="select * from package1 where package_name='".$args_ref['package']."'";
		$args_package=getRow(query($sql));		
		
		 if($args_package['package_id']==1){
			$amount=25;
		 }
		  if($args_package['package_id']==2){
			$amount=50;
		 }
		  if($args_package['package_id']==3){
			$amount=100;
		 }
		 
		 $date = date("Y-m-d");
		 $package = $args_ref['package'];
		 
		 
		  $invoicem=meberins();
	 
		  $sql_ins=mysql_query("INSERT INTO mem_subscribe  SET user_id='$user_id', user_name='".$args_ref['user_name']."', s_date='$date', package='$package', price='".$args_ref['plan_amt']."', invoice='$invoicem',  total_price='".$args_ref['plan_amt']."',  product_name='$package'") or die(mysql_error());
		 /* 
		  mysql_query("INSERT INTO level_income SET income_id='$ref_id' , down_id='$user_id', package='$package_name', commission='$amount', remark='$package_name',l_date='$date',status='0', invoice='$invoice',  price='$price' ");
		  */
			mysql_query("INSERT INTO membership SET  user_id='$user_id', date='$date', member_fees='".$args_ref['plan_amt']."', payment_type='', user_type='', invoice='$invoicem', total_price='".$args_ref['plan_amt']."'");
			
					
				
				/** Update new member final business volume */
				$insert_bv=array('',$user_id,'','','',$args_package['total_bv'],$args_package['total_bv']);
				insert_tbl($insert_bv,'final_bv');
		
				/************ unserilize product and infromations **/
				$products=unserialize(stripslashes($args_package['products']));
				$product_qty=unserialize(stripslashes($args_package['product_qty']));
				$product_costs=unserialize(stripslashes($args_package['product_cost']));
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
					$insert=array('',$invoicem,$user_id,$products[$i],$args_package['package_id'],'',$product_qty[$i],$s_prod_cost[$i],'','','',date("Y-m-d"),'$',0,'Direct','',$product_costs[$i],$s_prod_bv[$i],$products_bv[$i],'','');
					//print_r($insert);
					insert_tbl($insert,'purchase_detail');
				}			
				
				$shipping_charge=$args_ref['plan_amt']-$args_package['total_fees'];
				/** insert record in amount details  of member */
				$insert_amt=array('',$user_id,$user_id,$invoicem,$args_package['total_fees'],'',$shipping_charge,'',$args_ref['plan_amt'],"Direct",0,'','',$ref,'',date("Y-m-d"),$qty,'','',$args_package['total_bv'],'','','');
				insert_tbl($insert_amt,'amount_detail');
							
				
				update_member_bv($user_id,$args_package['total_bv'],$args_package['total_fees'],$qty,$invoicem);
				
				/** padin bonus to member */
				$bonus_amt=$amount;
				
				if($bonus_amt > 0) 
				{
					$insert_lvl=array('',$ref,'',$bonus_amt,date("Y-m-d"),'Direct sponsorship bonus',0,0,'',$package,$args_package['package_id'],$args_package['total_fees'],$invoicem,'','','',$args_ref['plan_amt']);
					insert_tbl($insert_lvl,'level_income');
				}
			
			}
			
			/*** update manual payment table */
			$update=array('status'=>1);
			update_tbl($update,'manual_payment','user_id',$user_id);
			
		/*** get package information */
		$sql="select * from package1";
		$args_package=getRows(query($sql));	
			
		$from="support@seancare.com"; // shopdeal admin username
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
	
		 $name=$args_ref['first_name']." ".$args_ref['last_name'];
		 
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
			
			<td ><P style='font-family:Calibri; font-size:16pt; '>Dear $name, </P></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:16pt;'>Thank you for Registering with Joinlivingwell.com.</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:12pt;'>Your login information
	</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:12pt;'>Username : ".$args_ref['user_name']."
	
	</p></td>
			
		  </tr>
		  <tr>
			<td >Password : ".$args_ref['user_pass']."</td>
			
		  </tr>
		  <tr>
			<td >Transaction Password: ".$args_ref['t_code'].".</td>
			
		  </tr>
		  <tr>
			<td >Replicated Website URL: <a href='http://198.154.192.169/~develope/joshua/".$args_ref['user_name']."' target='blank'>http://198.154.192.169/~develope/joshua/".$args_ref['user_name']."</td>
			
		  </tr>
		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'>Change you transaction password when you login.</p></td>
			
		  </tr>
		  
		  		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'>Thanks in advance and welcome to Seancare.</p></td>
			
		  </tr>
		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; '>Seancare team</p></td>
			
		  </tr>
		  		  
		
	</table>
	</div>
		
	</body>
	</html>";
	
		mail($to,' Seancare REGISTRATION',$msg,$headeruser1,"-f$from");
			
	?>
    <script type="text/javascript">
		window.location.href="admin_main.php?idq=240";
	</script>
   <?php
}

function RejectUser()
{
	$userid=$_GET['id'];
	
	$updates=array('status'=>2);
	
	update_tbl($updates,'manual_payment','user_id',$userid);
	
	$sql="select * from registration where user_id='$userid'";
	$args_ref=getRow(query($sql));
	$email=getValue($args_ref,'email',false);
	
	
	$from="support@seancare.com";

	// $name=$fname." ".$lname;

		$headeruser="Mime-Version: 1.0\r\n";

        $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

       $headeruser.= "From:Join Living <$from>" . "\r\n";

		$msg="<html><head><title></title></head>
		
		<div style='width:800px; margin:0px auto;'>
		
			<table width=100% border='0' cellspacing='0' cellpadding='0'>
		  <tr>
		
			<td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
		
			  <tr>
		
				<td height='50'>&nbsp;</td>
		
				<td height='50'><p style='font-family:Calibri; font-size:12pt; padding: 5px 0px '> <b>Mr/Mrs. ".stripslashes(htmlentities(getValue($args_ref,'first_name',false)))." ".stripslashes(htmlentities(getValue($args_ref,'last_name',false)))."</b> 
				 Your payment information in not correct.
				 
				 So, Send correct payment information for join <b>Seancare team</b>	
				</p></td>
		
				<td height='50'>&nbsp;</td>
		
			  </tr>
			   <tr>
		
				<td height='50'>&nbsp;</td>
		
				<td height='50'><p style='font-family:Calibri; font-size:16pt; padding: 5px 0px '> Seancare team
				</p></td>
		
				<td height='50'>&nbsp;</td>
		
			  </tr>
				</table></td>
		
		  </tr>
		
		  <tr>
		
			<td>&nbsp;</td>
		
		  </tr>
		
		</table>
		
		</div>
		
			</div>
		
		  </div>
		
		 
		
		</div>
		
		
		
		</body>
		
		</html>";  
		
			mail($email,'Reject Payment',$msg,$headeruser,"-f$from");
	
	?>
    <script type="text/javascript">
		//window.location.href="admin_main.php?idq=240";
	</script>
   <?php
}


/*---------------------------------
* Verify or reject multiple users
*---------------------------------*/

if(isset($_POST['action']))
{
	$value=$_POST['action'];
	switch($value)
	{
		case "verifyusers":
			VerifyMultiUser();
		break;
		case "rejectusers":
			RejectMultiUser();
		break;
		case "deleteusers":
			deleteUsers();
		break;
	}
}

/*---------------------------------------
* change subscription status
*----------------------------------------*/
function VerifyMultiUser()
{

	$users=$_POST['id'];
	
	foreach($users as $user)
	{
		$user_id=$user;
		$sql="select * from registration where user_id='$user_id'";
		$args_ref=getRow(query($sql));
		$ref=getValue($args_ref,'ref_id',false);
		$package=getValue($args_ref,'package',false);
		
		$email=getValue($args_ref,'email',false);
		
		$result_spill=mysql_fetch_array(mysql_query("select power_leg, power_status  from registration where user_id='$ref'"));
		if($result_spill['power_status']==1){
			 $nom=$result_spill['power_leg'];
			$idx[]=$nom;
				$idx2[]=$nom;
				$nom_id=spill($idx);
		}
		else
		$nom_id=spill(array($ref));
	
		/**update nom of member */
		$update="update registration set nom_id='$nom_id', mem_status='0' where user_id='$user_id'"	;
		query($update);
		
		/** Insert user record in E - wallet for manage amount */
			$query1="insert into final_e_wallet (user_id,amount) values ('$user_id','0')";
			$result1=mysql_query($query1) ;//or die($query1.mysql_error());
			//$invoice=invoice();
	
			/** get package id */
			$sql="select * from package1 where package_name='".$args_ref['package']."'";
			$args_package=getRow(query($sql));		
			
			 if($args_package['package_id']==1){
				$amount=25;
			 }
			  if($args_package['package_id']==2){
				$amount=50;
			 }
			  if($args_package['package_id']==3){
				$amount=100;
			 }
			 
			 $date = date("Y-m-d");
			 $package = $args_ref['package'];
			 			 
			 $invoicem=meberins();
		 
			  $sql_ins=mysql_query("INSERT INTO mem_subscribe  SET user_id='$user_id', user_name='".$args_ref['user_name']."', s_date='$date', package='$package', price='".$args_ref['plan_amt']."', invoice='$invoicem',  total_price='".$args_ref['plan_amt']."',  product_name='$package'") or die(mysql_error());
			 /* 
			  mysql_query("INSERT INTO level_income SET income_id='$ref_id' , down_id='$user_id', package='$package_name', commission='$amount', remark='$package_name',l_date='$date',status='0', invoice='$invoice',  price='$price' ");
			  */
				mysql_query("INSERT INTO membership SET  user_id='$user_id', date='$date', member_fees='".$args_ref['plan_amt']."', payment_type='', user_type='', invoice='$invoicem', total_price='".$args_ref['plan_amt']."'");
				
						
				 
					
					/** Update new member final business volume */
					$insert_bv=array('',$user_id,'','','',$args_package['total_bv'],$args_package['total_bv']);
					insert_tbl($insert_bv,'final_bv');
			
					/************ unserilize product and infromations **/
					$products=unserialize(stripslashes($args_package['products']));
					$product_qty=unserialize(stripslashes($args_package['product_qty']));
					$product_costs=unserialize(stripslashes($args_package['product_cost']));
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
						$insert=array('',$invoicem,$user_id,$products[$i],$args_package['package_id'],'',$product_qty[$i],$s_prod_cost[$i],'','','',date("Y-m-d"),'$',0,'Direct','',$product_costs[$i],$s_prod_bv[$i],$products_bv[$i],'','');
						//print_r($insert);
						insert_tbl($insert,'purchase_detail');
					}			
					
					$shipping_charge=$args_ref['plan_amt']-$args_package['total_fees'];
					/** insert record in amount details  of member */
					$insert_amt=array('',$user_id,$user_id,$invoicem,$args_package['total_fees'],'',$shipping_charge,'',$args_ref['plan_amt'],"Direct",0,'','',$ref,'',date("Y-m-d"),$qty,'','',$args_package['total_bv'],'','','');
					insert_tbl($insert_amt,'amount_detail');
								
					
					update_member_bv($user_id,$args_package['total_bv'],$args_package['total_fees'],$qty,$invoicem);
					
					/** padin bonus to member */
					$bonus_amt=$amount;
					
					if($bonus_amt > 0) 
					{
						$insert_lvl=array('',$ref,'',$bonus_amt,date("Y-m-d"),'Direct sponsorship bonus',0,0,'',$package,$args_package['package_id'],$args_package['total_fees'],$invoicem,'','','',$args_ref['plan_amt']);
						insert_tbl($insert_lvl,'level_income');
					}
				
				}
		
		/*** update manual payment table */
		$update=array('status'=>1);
		update_tbl($update,'manual_payment','user_id',$user_id);
				
		/*** get package information */
		$sql="select * from package1";
		$args_package=getRows(query($sql));	
			
		$from="support@seancare.com"; // shopdeal admin username
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
	
		 $name=$args_ref['first_name']." ".$args_ref['last_name'];
		 
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
			
			<td ><P style='font-family:Calibri; font-size:16pt; '>Dear $name, </P></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:16pt;'>Thank you for Registering with Joinlivingwell.com.</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:12pt;'>Your login information
	</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:12pt;'>Username : ".$args_ref['user_name']."
	
	</p></td>
			
		  </tr>
		  <tr>
			<td >Password : ".$args_ref['user_pass']."</td>
			
		  </tr>
		  <tr>
			<td >Transaction Password: ".$args_ref['t_code'].".</td>
			
		  </tr>
		  <tr>
			<td >Replicated Website URL: <a href='http://198.154.192.169/~develope/joshua/".$args_ref['user_name']."' target='blank'>http://198.154.192.169/~develope/joshua/".$args_ref['user_name']."</td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'>Change you transaction password after login in account.</p></td>
			
		  </tr>
		  
		  		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt;'>Thanks in advance and welcome to Seancare.</p></td>
			
		  </tr>
		  
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; '>Seancare team</p></td>
			
		  </tr>
		  		  
		
	</table>
	</div>
		
	</body>
	</html>";
			mail($to,' Seancare REGISTRATION',$msg,$headeruser1,"-f$from");
 
	}
	
	if(isset($_POST['url']))
	{
		?>
		<script type="text/javascript">
			window.location.href="<?php echo $_POST['url']; ?>";
		</script>
	   <?php
	}
	else
	{
		?>
		<script type="text/javascript">
			window.location.href="admin_main.php?idq=240";
		</script>
	   <?php
	}
}

function RejectMultiUser()
{
	$users=$_POST['id'];
	
	foreach($users as $user)
	{
		$userid=$user;		
		$updates=array('status'=>2);
		
		update_tbl($updates,'manual_payment','user_id',$userid);
		
		$sql="select * from registration where user_id='$userid'";
		$args_ref=getRow(query($sql));
		$email=getValue($args_ref,'email',false);
	
	
		$from="support@seancare.com";

	// $name=$fname." ".$lname;

		$headeruser="Mime-Version: 1.0\r\n";

        $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

       $headeruser.= "From:Join Living <$from>" . "\r\n";

		$msg="<html><head><title></title></head>
		
		<div style='width:800px; margin:0px auto;'>
		
			<table width=100% border='0' cellspacing='0' cellpadding='0'>
		  <tr>
		
			<td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
		
			  <tr>
		
				<td height='50'>&nbsp;</td>
		
				<td height='50'><p style='font-family:Calibri; font-size:12pt; padding: 5px 0px '> <b>Mr/Mrs. ".stripslashes(htmlentities(getValue($args_ref,'first_name',false)))." ".stripslashes(htmlentities(getValue($args_ref,'last_name',false)))."</b> 
				 Your payment information in not correct.
				 
				 So, Send correct payment information for join <b>Seancare team</b>	
				</p></td>
		
				<td height='50'>&nbsp;</td>
		
			  </tr>
			   <tr>
		
				<td height='50'>&nbsp;</td>
		
				<td height='50'><p style='font-family:Calibri; font-size:16pt; padding: 5px 0px '> Seancare team
				</p></td>
		
				<td height='50'>&nbsp;</td>
		
			  </tr>
				</table></td>
		
		  </tr>
		
		  <tr>
		
			<td>&nbsp;</td>
		
		  </tr>
		
		</table>
		
		</div>
		
			</div>
		
		  </div>
		
		 
		
		</div>
		
		
		
		</body>
		
		</html>";  
		
			mail($email,'Reject Payment',$msg,$headeruser,"-f$from");
		
	}
	header("Location:admin_main.php?idq=240");
}
	
	
function deleteUsers()
{
	$users=$_POST['id'];
	
	foreach($users as $user)
	{
		$userid=$user;		
			
		$delete="delete from manual_payment where user_id='$userid'";
		mysql_query($delete) or die ($delete.mysql_error());	
		
		$deletes="delete from registration where user_id='$userid'";
		mysql_query($deletes) or die ($deletes.mysql_error());	
		
	}
	header("Location:admin_main.php?idq=240");
}


/*** Generate invoice no */
function meberins()
{
  //$encypt1=uniqid(rand(), true);
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);

  $checkid=mysql_query("select invoice from membership where invoice='$pre_userid'");
  if(mysql_num_rows($checkid)>0)
  {
	  meberins();
  }
  else
   return $pre_userid;
 }


?>