<?php
include("../includes/all_func.php");
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	// user id
	$user_id=showuserid($_SESSION['SD_User_Name']);
	$invoice=$_GET['invoice'];
	$pid=$_GET['pid'];
	$type=$_GET['type'];
	//echo "select * from purchase_detail  where  invoice_no='$invoice' and p_id='$pid' and status<>0";
	$sltpur=mysql_query("select * from purchase_detail  where  invoice_no='$invoice' and p_id='$pid' and status<>0");
	$count=mysql_num_rows($sltpur);
	//echo $count;
	if($count)
	{
		// get the pdf name
		$sql_p="select * from product_category where p_cat_id='$pid'";
		$res_p=mysql_query($sql_p);
		$row_p=mysql_fetch_assoc($res_p);
		if($type=='product_pdf')
		{
			 $filename="../product_logos/product_pdf/".$row_p['product_pdf'];
			//$url_download = BASE_URL . RELATIVE_PATH . $filename;            
			//header("Content-type:application/pdf");   
			header("Content-type: application/octet-stream");                       
			header("Content-Disposition:inline;filename='".basename($filename)."'");            
			header('Content-Length:'.filesize($filename));
			header("Cache-control: private"); //use this to open files directly                     
			readfile($filename);
		}
	}
	else if($type=='pdf')
	{
		// get the pdf name
		$sql_p="select * from product_category where p_cat_id='$pid'";
		$res_p=mysql_query($sql_p);
		$row_p=mysql_fetch_assoc($res_p);
		if($type=='pdf')
		{
			 $filename="../product_logos/product_pdf/".$row_p['product_pdf'];
			//$url_download = BASE_URL . RELATIVE_PATH . $filename;            
			//header("Content-type:application/pdf");   
			header("Content-type: application/octet-stream");                       
			header("Content-Disposition:inline;filename='".basename($filename)."'");            
			header('Content-Length:'.filesize($filename));
			header("Cache-control: private"); //use this to open files directly                     
			readfile($filename);
		}
	}
}
else
{
	echo "Session Out";
}
?>