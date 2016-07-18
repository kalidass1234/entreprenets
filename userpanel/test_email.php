<?php
$from='info@visionteamnetwork.com';
			$to="subhash@maxtratechnologies.com";
			$subject =  "Test"; 
			$message ="Hi This is test message";
			
			$header = "From: VTN<" .$from. ">\r\n"; 
			
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-type:text/html; charset=iso-8859-1\r\n";
			$header.= "X-Mailer: PHP/" . phpversion();
			//echo $to;
			//echo $message;exit;
			echo mail($to, $subject, $message, $header);
?>