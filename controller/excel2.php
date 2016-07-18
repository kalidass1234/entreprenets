<?php
//print "sd";
$tid=$_REQUEST['tid'];
$pos=$_REQUEST['pos'];
include("connection.php");
//include("showwithdrawmem.php");
//$shdwn = new showDwonMem_rt();
//$shdwn->shoDwnMem_rt($tid,$pos);
//$shdwn = new showwithdrawMem();
//$shdwn->showwithdrawMem($tid,$dwnid);

//$r=count($data_dwn_rt);
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=downline.xls ");
header("Content-Transfer-Encoding: binary ");
xlsBOF();
/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/
xlsWriteLabel(0,0,"Member Detail.");
// Make column labels. (at line 3)
xlsWriteLabel(2,0,"Sr.");
xlsWriteLabel(2,1,"User ID");
xlsWriteLabel(2,2,"User Name");
xlsWriteLabel(2,3,"Upline ID");
xlsWriteLabel(2,4,"Sponser ID");
xlsWriteLabel(2,5,"Leg");
xlsWriteLabel(2,6,"Plan");
xlsWriteLabel(2,7,"DOJ");
xlsWriteLabel(2,8,"Contact No.");
xlsWriteLabel(2,9,"E-Mail");
xlsWriteLabel(2,10,"State");

$xlsRow = 3;
// Put data records from mysql by while loop.
$str="select * from registration where state='$tid'";
$res=mysql_query($str);

while($row=mysql_fetch_array($res)){
$dn=$data_dwn_rt[$i];
xlsWriteLabel($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,1,$row['user_id']);
xlsWriteLabel($xlsRow,2,$row['first_name']);
xlsWriteLabel($xlsRow,3,$row['nom_id']);
xlsWriteLabel($xlsRow,4,$row['ref_id']);
xlsWriteLabel($xlsRow,5,$row['binary_pos']);
xlsWriteLabel($xlsRow,6,$row['plan_name']);
xlsWriteLabel($xlsRow,7,$row['reg_date']);
xlsWriteLabel($xlsRow,8,$row['mobile']);
xlsWriteLabel($xlsRow,9,$row['email']);
xlsWriteLabel($xlsRow,10,$row['State']);


$xlsRow++;
}
xlsEOF();
exit();
?>