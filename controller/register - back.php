<?php 
session_start();

require_once "connection.php";

require_once "../admin/function.php";

require_once "update-meber-bv.php";

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

	if("manual" == $payment_mode || $package==0)
		$nom_id='';		
	else{
		/*$result_spill=mysql_fetch_array(mysql_query("select power_leg, power_status  from registration where user_id='$ref' and nom_id!=''"));
	
		if($result_spill['power_status']==1){
			 $nom=$result_spill['power_leg'];
			$idx[]=$nom;
				$idx2[]=$nom;
				$nom_id=spill($idx);
		}
		else*/
		$nom_id=spill(array($ref));
	}
		
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
			
	$package = $args_package['package_name'];
	$total_price = $args_package['total_fees'];
	$price = $total_price;

	$t_code="12345";
//	echo "select user_id from registration where nom_id='$nom_id'";
	$sql_pos=mysql_query("select user_id from registration where nom_id='$nom_id'");
	$count_pos=mysql_num_rows($sql_pos);
	$position=$count_pos+1;
	 $query_reg="insert into registration SET user_id='$user_id', user_name='$user_nm', nom_id='$nom_id', user_pass='$pass', t_code=$t_code, plan_name='$plan_name', pin_no='$pin', ref_id='$ref',mem_status=0, first_name='$fname', mid_name='$mname', last_name='$lname', email='$email', address1='$address1', address2='$address2', city='$city',state='$state',country='$country',zip='$zipcode', user_type='$user_type', mobile='$mobile', reg_date='$date', package='$package', dob='$birth_date', ship_street1='$ShipStreet1', ship_street2='$ShipStreet2', ship_country='$ShipCountry', ship_zip='$ShipPostalCode', ship_city='$ShipCity', ship_state='$ShipState', co_fname='$CoFirstName', co_lname='$CoLastName', co_company='$CoCompany', co_ssn='$CoSSN', co_email='$coemail', company='$company', phoner='$phoner', phoneo='$phoneo', fax='$fax', position_tree='$position',ssn='$ssn',sex='$gender',plan_amt='$plan_amt'";

	$result=mysql_query($query_reg) or die("Error: ".$query_reg.mysql_error());
	
	/** send in mail */
	
	$_SESSION['shipping_charge'] = $_SESSION['total_price']-$args_package['total_fees'];
	$_SESSION['product_charge'] = $args_package['total_fees'];
	$_SESSION['package_name'] = $package;
	
	if("manual" != $payment_mode)
	{

	/** Insert user record in E - wallet for manage amount */
	$query1="insert into final_e_wallet (user_id,amount) values ('$user_id','0')";
	 $invoice=invoice();
	
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
	 $invoicem=meberins();
 
	  $sql_ins=mysql_query("INSERT INTO mem_subscribe  SET user_id='$user_id', user_name='$user_nm', s_date='$date', package='$package', price='$price', invoice='$invoicem',  total_price='$price',  product_name='$package'") or die(mysql_error());
	 /* 
	  mysql_query("INSERT INTO level_income SET income_id='$ref_id' , down_id='$user_id', package='$package_name', commission='$amount', remark='$package_name',l_date='$date',status='0', invoice='$invoice',  price='$price' ");
	  */
	  	mysql_query("INSERT INTO membership SET  user_id='{$user_id}', date='$date', member_fees='$plan_amt', payment_type='', user_type='', invoice='$invoicem', total_price='$plan_amt'");
		
				
		mkdir("/home/develope/public_html/joshua/$user_nm", 0755);
		copy("/home/develope/public_html/joshua/index_format.php","/home/develope/public_html/joshua/$user_nm/index.php");//** Create random invoice no */
			
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
				$insert=array('',$invoicem,$user_id,$products[$i],$_SESSION['package_s'],'',$product_qty[$i],$s_prod_cost[$i],'','','',date("Y-m-d"),'$',0,$payment_mode,'',$product_costs[$i],$s_prod_bv[$i],$products_bv[$i],'','');
				//print_r($insert);
				insert_tbl($insert,'purchase_detail');
			}			
			
			/*** show in main and thank you page */
			$shipping_charge=$_SESSION['total_price']-$args_package['total_fees'];
						
			/** insert record in amount details  of member */
			$insert_amt=array('',$user_id,$user_id,$invoicem,$args_package['total_fees'],'',$shipping_charge,'',$_SESSION['total_price'],$payment_mode,0,'','',$_SESSION['ref_id'],'',date("Y-m-d"),$qty,'','',$args_package['total_bv'],'','','');
			insert_tbl($insert_amt,'amount_detail');
						
			
			update_member_bv($user_id,$args_package['total_bv'],$args_package['total_fees'],$qty,$invoicem);
			
			/** padin bonus to member */
			$bonus_amt=$amount;
			
			if($bonus_amt > 0) 
			{
				$insert_lvl=array('',$_SESSION['ref_id'],'',$bonus_amt,date("Y-m-d"),'Direct sponsorship bonus',0,0,'',$package,$_SESSION['package_s'],$args_package['total_fees'],$invoicem,'','','',$_SESSION['total_price']);
				insert_tbl($insert_lvl,'level_income');
			}
		
		}
		
		unset($_SESSION['payment_for']);
		
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
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300;'>¡Hola $name, </P></td>
        <td width='4%'>&nbsp;</td>
      </tr>
      <tr>
        <td height='40'>&nbsp;</td>
        <td height='40'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:5px 0px;'>Gracias por registrarse.</p></td>
        <td height='40'>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#CC3300; font-style:italic; padding-top:15px;'> Ha completado con éxito Proceso de Inscripción.
</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:#000; font-style:italic;'>
 Por favor completar su registro haciendo clic o copiar y pegar en la barra de direcciones del navegador el siguiente enlace:
</p></td>
        <td>&nbsp;</td>
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
        <td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#CC3300; padding:10px 0px;'>Saludos cordiales,</p></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><p style='font-family:Calibri; font-size:13pt; color:color:#CC3300; font-style:italic;'>seancare.com administratión</p></td>
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
//echo $msg;exit;
	mail($to,' Seancare REGISTRATION',$msg,$headeruser1,"-f$from");
	

		$_SESSION['adid']=$user_id;
		
		header("Location:../userpanel/member_profile.php");
	
	}
	else
	{
		/*** get package information */
		$sql="select * from package1";
		$args_package=getRows(query($sql));
		
		
		/*** semd mail for payment if member make manual payment */
		$from="support@seancare.com"; // shopdeal admin username
			
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
			<td ><p style='font-family:Calibri; font-size:13pt; '><a href='http://seancare.com/manual-payment.php?uid=$userid&paymet=manual'>http://seancare.com/manual-payment.php?uid=$userid&paymet=manual</p></td>
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
		
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Bank: Wells Fargo Bank</p></td>
			
		  </tr>
		  
		   <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Account Name:  Seancare USA</p></td>
			
		  </tr>
		  <tr>
			
			<td ><p style='font-family:Calibri; font-size:13pt; font-weight:bold;'>Accout Nunber:  2987846900</p></td>
			
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

$payment_mode=$_GET['payment'];

if($count_check==0)
{
	if($payment_mode == "creditcard" && isset($_SESSION['orderno']))
	{
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
	else if($payment_mode=='free')
	registernow($payment_mode);
	else 
		header("Location:payment.php?msg=choose right option of payment");
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