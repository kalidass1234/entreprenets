<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?
   include("connection.php"); 
   for($i=1;$i<=15;$i++)
   {   
    echo $sll="select * from board_status_trav where board_no='1' AND cel_no='$i'";
  $sl=mysql_query($sll);
  $ress=mysql_fetch_array($sl) ;     
   echo $si11=$ress['uid'];      
  echo $ah11="select count(*) from registration where ref_id='$si11'";
   $ah12=mysql_query($ah11)or die("erroer");
    echo  $sd= mysql_result($ah12,0,0);
  }
  // if($ress111==2)
//   {
//    
//   $upd="update board_status_trav set uid='$si11' where board_no='$asd'";
//   $upd11=mysql_query($upd);
//   $updf="update board_status_trav set uid='$si11' where board_no='$asd1'";
//   $upd121=mysql_query($updf);
//   }
//  
//   if($ress111==1)
//   { 
//     
//   $updk="update board_status_trav set uid='$si11' where board_no='$asd'";
//   $updj11=mysql_query($updk);
//   $updx="update board_status_trav set uid='$si11' where board_no='$asd1'";
//   $upds11=mysql_query($updx);
//  
   
  ?>
</body>
</html>
