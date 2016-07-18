<?php 
function curPageURL() {
 if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } 
 else {
   $pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function get_page_information($id)
{
  $select_page_data = mysql_query("select * from nav where nav_id='".$id."' AND status=0");
  $fetch_page_data = mysql_fetch_array($select_page_data);
  return $fetch_page_data;
}

function getUserName($id)
{
  $select_page_data = mysql_query("select user_name from registration where user_id='".$id."'");
  $fetch_page_data = mysql_fetch_array($select_page_data);
  return $fetch_page_data;
}

function redirect($page)
 {
  if(!headers_sent())
   header("location:$page");
  else
   echo "<script>location.href='$page'</script>";
 }
 
function send_email($to, $fromname, $from, $subject, $message ,$copy_meesage="") 
{
			
		global $wwwroot;
		$headers = "From: ".$fromname."<".$from.">\n";      
        $headers .= "Reply-To: <".$from.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		 
        $curr_date1=date("Y");
		$abc1="&copy";
        $copy1=stripslashes($copy_meesage);
        $mess1 = str_replace("##year##", $curr_date1, $copy1);
		$mess1 = str_replace("##copy##", $abc1, $mess1);
		
        $html_mailer = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>.:: Ladakh Vacation ::.</title>
		</head><body><table width="700" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="700" border="0" cellspacing="0" cellpadding="0"><tr><td height="120" align="center"><img src="'.$wwwroot.'images/logo.png"  /></td></tr><tr><td height="1" bgcolor="#CCCCCC"><img src="'.$wwwroot.'images/dot.png" width="1" height="1" /></td></tr><tr><td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#666; line-height:18px;"><p>'.$message.'</p></td></tr><tr><td height="45" align="center" bgcolor="#e5e5e5" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#666; line-height:18px;">'.$mess1.'</td></tr></table></body>';

        $ok = @mail($to, $subject, $html_mailer, $headers);
        return $ok;
		//return $html_mailer;		
}

function getCountry()
{
  $country = array();
  $select_country  = mysql_query("select * from country where status=1 order by country_id ASC");
  while($fetch_country = mysql_fetch_array($select_country))
  {
    $country[] = $fetch_country;
  }
    return  $country;
}

function getCountrys($id)
{
  $select_country  = mysql_query("select * from country where status=1 AND country_id = '".$id."'");
  $fetch_country = mysql_fetch_array($select_country);
  return  $fetch_country['title'];
}

function getStates($country_id)
{
  $select_state  = mysql_query("select * from state where status=1 AND state_id='".$country_id."'");
  $fetch_state = mysql_fetch_array($select_state);
  return  $fetch_state['title'];
}

function getState($country_id)
{
  $state = array();
  $select_state  = mysql_query("select * from state where status=1 AND country_id='".$country_id."'");
  while($fetch_state = mysql_fetch_array($select_state))
  {
    $state[] = $fetch_state;
  }
    return  $state;
}

function getInfoByTableNameAndID($table,$id)
{
	$select = "select * from $table where $id";
	$select_page_data = mysql_query($select);
	$fetch_page_data = mysql_fetch_array($select_page_data);
	return $fetch_page_data;
}

function getInfoByTableName($table)
{
	$record = array();
	$select = "select * from $table where 1 AND display_status='1' ORDER BY id asc";
	$select_page_data = mysql_query($select);
	while($fetch_page_data = mysql_fetch_array($select_page_data))
	{
		$record[] = $fetch_page_data;
	}
	return $record;
}
function getInfoByTableNameN($table)
{
	$record = array();
	$select = "select * from $table where 1 AND news_status='1' ORDER BY id asc";

	$select_page_data = mysql_query($select);
	while($fetch_page_data = mysql_fetch_array($select_page_data))
	{
		$record[] = $fetch_page_data;
	}
	return $record;
}

function getInfoByTableNameNL($table, $limit)
{
	$record = array();
	$select = "select * from $table where 1 AND news_status='1' ORDER BY id asc $limit";

	$select_page_data = mysql_query($select);
	while($fetch_page_data = mysql_fetch_array($select_page_data))
	{
		$record[] = $fetch_page_data;
	}
	return $record;
}

function getInfoByTableNameNLID($table,$id, $limit)
{
	$record = array();
	$select = "select * from $table where 1 $id AND news_status='1' ORDER BY id asc $limit";

	$select_page_data = mysql_query($select);
	while($fetch_page_data = mysql_fetch_array($select_page_data))
	{
		$record[] = $fetch_page_data;
	}
	return $record;
}

function getInfoByTableNameID($table,$id)
{
	$record = array();
	$select = "select * from $table where $id AND display_status='1' ORDER BY id asc";
	$select_page_data = mysql_query($select);
	while($fetch_page_data = mysql_fetch_array($select_page_data))
	{
		$record[] = $fetch_page_data;
	}
	return $record;
}



/*function getInfoByTableNameAndID($id,$table)
{
	$select_page_data = mysql_query("select * from $table where user_id='".$id."'");
	$fetch_page_data = mysql_fetch_array($select_page_data);
	return $fetch_page_data;
}*/

 // End of file here
?>