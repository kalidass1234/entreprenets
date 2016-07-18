<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$id=showuserid($_SESSION['SD_User_Name']);
$sql_user="select * from registration where user_id='$id'";
$res_user=mysql_query($sql_user);
$row_user=mysql_fetch_assoc($res_user);
$ref_id=$row_user['ref_id'];
$bonus=$row_user['bonus'];
$reg_date=$row_user['reg_date'];
$category_one=$row_user['category_one'];
$category_two=$row_user['category_two'];
$category_three=$row_user['category_three'];
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}


function export_excel_csv()
{
    
    $sql = "SELECT * FROM upgrade_bonus";
    $rec = mysql_query($sql) or die (mysql_error());
    
    $num_fields = mysql_num_fields($rec);
    
    for($i = 0; $i < $num_fields; $i++ )
    {
        $header .= mysql_field_name($rec,$i)."\\t";
    }
    
    while($row = mysql_fetch_row($rec))
    {
        $line = '';
        foreach($row as $value)
        {                                            
            if((!isset($value)) || ($value == ""))
            {
                $value = "\\t";
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '"' . $value . '"' . "\\t";
            }
            $line .= $value;
        }
        $data .= trim( $line ) . "\\n";
    }
    
    $data = str_replace("\\r" , "" , $data);
    
    if ($data == "")
    {
        $data = "\\n No Record Found!\n";                        
    }
    
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=reports.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\\n$data";
}
?>