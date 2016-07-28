<?php
if(isset($_REQUEST['email']) && !empty($_REQUEST['email']) && isset($_REQUEST['message']) && !empty($_REQUEST['message']))
{
$from = "info@entreprenets.com"; // shopdeal admin username
$email = 'info@entreprenets.com';
// $name=$fname." ".$lname;
$headeruser = "Mime-Version: 1.0\r\n";
$headeruser.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headeruser1 = "Mime-Version: 1.0\r\n";
$headeruser1.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headeruser1.= "From:Entreprenets <$from>" . "\r\n";
$msg = "<html> <head><title></title></head>
	 <body>
<div style='width:800px; margin:0px auto;'>
    <table width=100% border='0' cellspacing='0' cellpadding='0' >
  
  <tr>
    <td><table width='100%' border='0' cellspacing='0'cellpadding='0'>
      
      <tr>
        <td height='50'>&nbsp;</td>
        <td height='50'><p style='font-family:Calibri; font-size:16pt; font-weight:bold; font-style:italic; color:#3399FF; padding: 5px 0px '>You have new contact us request.</p></td>
        <td height='50'>&nbsp;</td>
      </tr>
      
      <tr>
        <td height='50'>&nbsp;</td>
        <td height='100'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='24%'><p style='font-family:Calibri; font-size:14pt; color:#000; font-weight:bold;'>Emai id: </p></td>
            <td width='76%'><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#000;'>" . stripslashes(htmlentities($_REQUEST['email'])) . "</p></td>
          </tr>
          <tr>
            <td><p style='font-family:Calibri; font-size:14pt; color:#000; font-weight:bold;'>Message:</p></td>
            <td><p style='font-family:Calibri; font-size:14pt; font-weight:normal; color:#000;'>" . stripslashes(htmlentities($_REQUEST['message'])) . "</p></td>
          </tr>
          
		  
        </table></td>
        <td height='100'>&nbsp;</td>
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
//echo $msg;exit;

if(mail($email, 'New Contect us request!', $msg, $headeruser1, $from)){
    echo "TRUE";
} else {
    echo "FALSE";
}
} else {
    echo "FALSE";
}
