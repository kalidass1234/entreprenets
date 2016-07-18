<?php
class Custom_Function
{
	function _registration_mail($user_id)
	{
		$sql="select user_id,user_name,user_pass,t_code from registration where user_id='$user_id'";
		$res=mysql_query($sql);
		$row=mysql_fetch_assoc($res);
		$user_nm=$row['user_name'];
		$pass=$row['user_pass'];
		$t_code=$row['t_code'];
		$email=$row['email'];
		$from="ytbsy@yahoo.com"; // shopdeal admin username
	 // $name=$fname." ".$lname;
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:Grenature <$from>" . "\r\n";
	 $url="http://198.154.192.169/~divya/grenature/".$user_nm;
     $msg= "<html> <head><title></title></head>
	 <body>
	<div style='width:800px; margin:0px auto;'>
		<table width=100% border='0' cellspacing='0' cellpadding='0' >
	  <tr>
		<td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
		  <tr>
			<td width='43%' align='left'><img src='http://198.154.192.169/~divya/grenature/images/logo.gif'/></td>
			<td width='57%'>&nbsp;</td>
		  </tr>
		</table></td>
	  </tr>
	  <tr>
		<td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
		  <tr>
			<td width='3%'>&nbsp;</td>
			<td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>".stripslashes(htmlentities($user_nm)).",</P></td>
			<td width='4%'>&nbsp;</td>
		  </tr>
		  <tr>
			<td height='50'>&nbsp;</td>
			<td height='50'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#3399FF; padding: 5px 0px '>Congratulations!</p></td>
			<td height='50'>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-style:italic; padding-top:15px;'><strong>Welcome to Trinity Group</strong>. You successfully completed your Registration.
	 
	</p></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td height='130'>&nbsp;</td>
			<td height='130'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
			  <tr>
				<td width='24%'><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Username: </p></td>
				<td width='76%'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($user_nm))."</p></td>
			  </tr>
			  <tr>
				<td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>User ID</p></td>
				<td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($user_id))."</p></td>
			  </tr>
			  <tr>
			   <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Password: </p></td>
				<td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($pass))."</p></td>
			  </tr>
			  <tr>
				<td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Transaction Pin: </p></td>
				<td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($t_code))." </p></td>
			  </tr>
			  
			  <tr>
				<td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Refferal Link: </p></td>
				<td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'><a href='$url'>".stripslashes(htmlentities($url))."</a></p></td>
			  </tr>
			  
			</table></td>
			<td height='130'>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF9900; padding:10px 0px;'>Cheers to your Success!</p></td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>Trinity Group Admin</p></td>
			<td>&nbsp;</td>
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
 //  $header="From: info@infinitillio.com";
 	//	echo $msg;exit;
	  mail($email,'WELCOME',$msg,$headeruser1,'$from');
	}
}
?>