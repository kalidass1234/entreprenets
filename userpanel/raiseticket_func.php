<?php

include('../includes/all_func.php');
if(!$_SESSION['SD_User_Name'])
{
 header('location:login.php');
}

$idd=showuserid($_SESSION['SD_User_Name']);
$s="select * from registration where user_id='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$name=$f['user_name'];
 
 $category=$_REQUEST['category'];
 $subject=$_REQUEST['filed01'];
 $message=$_REQUEST['filed06'];
 $create_date=date("Y-m-d");

 $query="INSERT INTO tickets(user_id,user_name,subject,tasktype,description,t_date) VALUES('$idd','$name','$subject','$category','$message','$create_date')";
 $res=mysql_query($query) or die("Error");
 $msg=mysql_insert_id();
if($res)
{
$from="ytbsy@yahoo.com"; // shopdeal admin username
	// $name=$fname." ".$lname;
	 $headeruser="Mime-Version: 1.0\r\n";
     $headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $headeruser1="Mime-Version: 1.0\r\n";
     $headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headeruser1.= "From:VTN <$from>" . "\r\n";
	 $url=url.$row['user_name'];
     $msg= "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        
        <td width='43%' align='left'><img src=url'img/logo-1.jpg'/></td>
		<td width='57%'>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      <tr>
        <td width='3%'>&nbsp;</td>
        <td width='93%'><P style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#FF3399;'>Hi ,A user create a ticket of type $category.</P></td>
        <td width='4%'>&nbsp;</td>
      </tr>

      
      
      <tr>
        <td height='130'>&nbsp;</td>
        <td height='130'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='24%'><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Username: </p></td>
            <td width='76%'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($name))."</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>UserId</p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($idd))."</p></td>
          </tr>
          <tr>
           <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Subject: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($subject))."</p></td>
          </tr>
		  <tr>
           <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Task Type: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($category))."</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#FF3399; font-weight:bold;'>Message: </p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#FF3399;'>".stripslashes(htmlentities($message))." </p></td>
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
        <td><p style='font-family:Calibri; font-size:14pt; color:#FF9900; font-weight:bold; font-style:italic;'>VTN Admin</p></td>
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
	$sql_email="select * from master_email ";
   $res_email=mysql_query($sql_email);
   $row_email=mysql_fetch_assoc($res_email);
   $support_email=$row_email['email'];
   mail($support_email,'Ticket',$msg,$headeruser1,'$from');
//header("location:support.php?msg=$msg");
echo "<script>alert('Ticket Created Successfully.'); window.location.href='support.php';</script>";
}
?>