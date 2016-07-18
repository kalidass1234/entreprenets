<?

$cel="select max(board_no) from board_status_exp where uid='$expid'";
   $bd_no=mysql_query($cel);
   $z=mysql_result($bd_no,0,0);
    $y=$z['board_no'];
   $h=$y+1;
   $cel3="select max(id) from board_status_exp where board_no='$y' and uid!=''";
   $uid3=mysql_query($cel3);
   $z3=mysql_result($uid3,0,0);
   $cel34="select cel_no AS m_cel_id from board_status_exp where id='$z3'";
   $uid34=mysql_query($cel34);
   $z33=mysql_fetch_array($uid34);
   $c3=$z33['m_cel_id']; 
   if($c3==12)
   {
   $d=1;
    } 
	else
	{
   $d=$c3+1;
   }
   
   $ins1234="update board_status_exp set uid='$exid',tuid='$exid' where board_no='$y' and cel_no='$d'";
   $us124=mysql_query($ins1234);
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
?>