<?
//include("connection.php");
function exp_break($expid,$exid)
{

$cel="select max(board_no) from board_status_exp where uid='$expid'";
   $bd_no=mysql_query($cel);
   $z=mysql_result($bd_no,0,0);
    $y=$z['board_no'];
   $h=$y+1;
   
      
   $quers_sid1="select count(*) from board_cmp_exp where board_no='$y' and status=0";
   $dat_sid1=mysql_query($quers_sid1);
   $red_sid1=mysql_result($dat_sid1,0,0);   
   if($red_sid1>0)
   {
  
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
   
   
   
   //-------------- start process for board breaking--------------------------
   if($d==8)
   {
   
   
   
   $cmp11="select max(board_no) from board_cmp_exp";
   $cp11=mysql_query($cmp11);
   $result11=mysql_result($cp11,0,0);
   $asd=$result11+1;
    $asd1=$result11+2;
  for($i=15;$i>=1;$i--)
   {
     if($i==14)
	{
	$j=13;
	}
	if($i==13)
	{
	$j=14;
	}
	if($i==12)
	{
	$j=9;
	}
	if($i==11)
	{
	$j=10;
	}
	if($i==10)
	{
	$j=11;
	}
	if($i==9)
	{
	$j=12;
	}
	if($i==8)
	{
	$j=1;
	}
	if($i==7)
	{
	$j=2;
	}
	if($i==6)
	{
	$j=3;
	}
	if($i==5)
	{
	$j=4;
	}
	if($i==4)
	{
	$j=5;
	}
	if($i==3)
	{
	$j=6;
	}
	if($i==2)
	{
	$j=7;
	}
	if($i==1)
	{
	$j=8;
	}
		if($i==15)
	{
	$j=15;
	}
   $ins123="insert into board_status_exp (board_no,cel_no) values('$asd','$j')";
   $us12=mysql_query($ins123);
   }   
    for($i=15;$i>=1;$i--)
   {
    if($i==14)
	{
	$j=13;
	}
	if($i==13)
	{
	$j=14;
	}
	if($i==12)
	{
	$j=9;
	}
	if($i==11)
	{
	$j=10;
	}
	if($i==10)
	{
	$j=11;
	}
	if($i==9)
	{
	$j=12;
	}
	if($i==8)
	{
	$j=1;
	}
	if($i==7)
	{
	$j=2;
	}
	if($i==6)
	{
	$j=3;
	}
	if($i==5)
	{
	$j=4;
	}
	if($i==4)
	{
	$j=5;
	}
	if($i==3)
	{
	$j=6;
	}
	if($i==2)
	{
	$j=7;
	}
	if($i==1)
	{
	$j=8;
	}
		if($i==15)
	{
	$j=15;
	}
   $ins123="insert into board_status_exp (board_no,cel_no) values('$asd1','$j')";
   $us12=mysql_query($ins123);
   }
   
    $cmp="select max(board_no) from board_cmp_exp";
   $cp=mysql_query($cmp);
   $result=mysql_result($cp,0,0);
   $j=$result+1;
   $k=$j+1;
   
   for($i=$j;$i<=$k;$i++)
	{
	
	$ins2="insert into board_cmp_exp(board_no,status) values('$i','0')";
   $us15=mysql_query($ins2);
	} 
   
   
   $update="update board_cmp_exp set status='1' where board_no='$y'";
   $upd=mysql_query($update);
   
   
   
  
  $sll_13="select * from board_status_exp where board_no='$y' AND cel_no=13";
    $sl_13=mysql_query($sll_13);
    $ress_13=mysql_fetch_array($sl_13) ;     
     $si11_13=$ress_13['uid'];

   $x_13="update board_status_exp set uid='$si11_13' where board_no='$asd' AND cel_no=15";
   $s_13=mysql_query($x_13);
  $xtop_13="update board_status_exp set tuid='$si11_13' where board_no='$asd'";
   $stop_13=mysql_query($xtop_13);
  $sll_14="select * from board_status_exp where board_no='$y' AND cel_no=14";
    $sl_14=mysql_query($sll_14);
    $ress_14=mysql_fetch_array($sl_14) ;     
     $si11_14=$ress_14['uid'];
$x_14="update board_status_exp set uid='$si11_14' where board_no='$asd1' AND cel_no=15";
   $s_14=mysql_query($x_14);
   $xtop_14="update board_status_exp set tuid='$si11_14' where board_no='$asd1'";
   $stop_14=mysql_query($xtop_14);

   
   
   for($i=9;$i<=20;$i++)
   {   
   if($i>12)
      {
	  $j1=$i-12;
   }
   else
   {
   $j1=$i;
   }
  $sll="select * from board_status_exp where board_no='$y' AND cel_no='$j1'";
    $sl=mysql_query($sll);
    $ress=mysql_fetch_array($sl) ;     
     $si11=$ress['uid'];      
	 $ssxid[]=$si11;
      $ah11="select count(*) from registration_exp where ref_id='$si11'";
     $ah12=mysql_query($ah11);
      $sd[]= mysql_result($ah12,0,0);
	
	 }
	 //print_r($ssxid);
	  $arrcnt=count($sd);
	 $sval1=2;
	 $sval2=1;
	 $sval3=0;
	 for($mm=0;$mm<$arrcnt;$mm++)
	 {
	 if($sval1<=$sd[$mm])
	 {
	 $xxid1[]=$ssxid[$mm];
	 }
	 if($sval2==$sd[$mm])
	 {
	 //print $mm;
	  $xxid2[]=$ssxid[$mm];
	 }
	 if($sval3==$sd[$mm])
	 {
	 $xxid3[]=$ssxid[$mm];
	 }
	 
	 }
	//print_r($xxid2);
	 
	 
	  $two_ref_id_num=count($xxid1);
	  $one_ref_id_num=count($xxid2);
	  $zero_ref_id_num=count($xxid3);
	 
	 
	 
	//--------------- start  inertion into two new board arrangement-------------------------------
   if($two_ref_id_num==12)
   {
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   

   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid1[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid1[10]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid1[11]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   elseif(($two_ref_id_num==11) && ($one_ref_id_num==1))
   {
   
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid1[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid1[10]' where board_no='$asd1`' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }  
   
   
   elseif(($two_ref_id_num==11) && ($zero_ref_id_num==1))
   {
   
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid1[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid1[10]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }  
   
   elseif(($two_ref_id_num==10) && ($one_ref_id_num==2))
   {
   
  
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid1[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   elseif(($two_ref_id_num==10) && ($zero_ref_id_num==2))
   {
   
  
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid1[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   elseif(($two_ref_id_num==10) && ($one_ref_id_num==1) && ($zero_ref_id_num==1))
   {
   
  
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid1[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
    elseif(($two_ref_id_num==9) && ($one_ref_id_num==3))
   {
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
    elseif(($two_ref_id_num==9) && ($one_ref_id_num==2) && ($zero_ref_id_num==1))
   {
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
    elseif(($two_ref_id_num==9) && ($one_ref_id_num==1) && ($zero_ref_id_num==2))
   {
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   elseif(($two_ref_id_num==9) && ($zero_ref_id_num==3))
   {
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid1[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
      elseif(($two_ref_id_num==8) && ($one_ref_id_num==4))
   {
   
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
      elseif(($two_ref_id_num==8) && ($one_ref_id_num==3) && ($zero_ref_id_num==1))
   {
   
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
      elseif(($two_ref_id_num==8) && ($one_ref_id_num==2) && ($zero_ref_id_num==2))
   {
   
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  

   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
      elseif(($two_ref_id_num==8) && ($one_ref_id_num==1) && ($zero_ref_id_num==3))
   {
   
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
  elseif(($two_ref_id_num==8) && ($zero_ref_id_num==4))
   {
   
   
  
 
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid1[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
  
  elseif(($two_ref_id_num==7) && ($one_ref_id_num==5))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
  
  elseif(($two_ref_id_num==7) && ($one_ref_id_num==4) && ($zero_ref_id_num==1))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
  
  
  elseif(($two_ref_id_num==7) && ($one_ref_id_num==3) && ($zero_ref_id_num==2))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
  
  elseif(($two_ref_id_num==7) && ($one_ref_id_num==2) && ($zero_ref_id_num==3))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
  
   
  elseif(($two_ref_id_num==7) && ($one_ref_id_num==1) && ($zero_ref_id_num==4))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
   
  elseif(($two_ref_id_num==7) && ($zero_ref_id_num==5))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid1[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   }
   
    elseif(($two_ref_id_num==6) && ($one_ref_id_num==6))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==6) && ($one_ref_id_num==5)  && ($zero_ref_id_num==1))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
    elseif(($two_ref_id_num==6) && ($one_ref_id_num==4)  && ($zero_ref_id_num==2))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==6) && ($one_ref_id_num==3)  && ($zero_ref_id_num==3))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==6) && ($one_ref_id_num==2)  && ($zero_ref_id_num==4))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==6) && ($one_ref_id_num==1)  && ($zero_ref_id_num==5))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==6) && ($zero_ref_id_num==6))
   {
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid1[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
    elseif(($two_ref_id_num==5) && ($one_ref_id_num==7))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }

    elseif(($two_ref_id_num==5) && ($one_ref_id_num==6) && ($one_ref_id_num==1))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==5) && ($one_ref_id_num==5) && ($one_ref_id_num==2))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==5) && ($one_ref_id_num==4) && ($one_ref_id_num==3))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
    elseif(($two_ref_id_num==5) && ($one_ref_id_num==3) && ($one_ref_id_num==4))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==5) && ($one_ref_id_num==2) && ($one_ref_id_num==5))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
elseif(($two_ref_id_num==5) && ($one_ref_id_num==1) && ($one_ref_id_num==6))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }

elseif(($two_ref_id_num==5) && ($one_ref_id_num==7))
   {
   
   
    $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid1[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
     elseif(($two_ref_id_num==4) && ($one_ref_id_num==8))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
    elseif(($two_ref_id_num==4) && ($one_ref_id_num==7) && ($zero_ref_id_num==1))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==4) && ($one_ref_id_num==6) && ($zero_ref_id_num==2))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
    elseif(($two_ref_id_num==4) && ($one_ref_id_num==5) && ($zero_ref_id_num==3))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }

elseif(($two_ref_id_num==4) && ($one_ref_id_num==4) && ($zero_ref_id_num==4))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }   

elseif(($two_ref_id_num==4) && ($one_ref_id_num==3) && ($zero_ref_id_num==5))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }   


elseif(($two_ref_id_num==4) && ($one_ref_id_num==2) && ($zero_ref_id_num==6))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }   


elseif(($two_ref_id_num==4) && ($one_ref_id_num==1) && ($zero_ref_id_num==7))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }   
   
   
elseif(($two_ref_id_num==4) && ($zero_ref_id_num==8))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid1[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }   
   
   
     elseif(($two_ref_id_num==3) && ($one_ref_id_num==9))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
     elseif(($two_ref_id_num==3) && ($one_ref_id_num==8) && ($zero_ref_id_num==1))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
     elseif(($two_ref_id_num==3) && ($one_ref_id_num==7) && ($zero_ref_id_num==2))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   elseif(($two_ref_id_num==3) && ($one_ref_id_num==6) && ($zero_ref_id_num==3))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==3) && ($one_ref_id_num==5) && ($zero_ref_id_num==4))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==3) && ($one_ref_id_num==4) && ($zero_ref_id_num==5))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
   elseif(($two_ref_id_num==3) && ($one_ref_id_num==3) && ($zero_ref_id_num==6))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
   elseif(($two_ref_id_num==3) && ($one_ref_id_num==2) && ($zero_ref_id_num==7))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
   elseif(($two_ref_id_num==3) && ($one_ref_id_num==1) && ($zero_ref_id_num==8))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==3) && ($zero_ref_id_num==9))
   {
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid1[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
    elseif(($two_ref_id_num==2) && ($one_ref_id_num==10))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[9]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
    elseif(($two_ref_id_num==2) && ($one_ref_id_num==9) && ($zero_ref_id_num==1))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
    elseif(($two_ref_id_num==2) && ($one_ref_id_num==8) && ($zero_ref_id_num==2))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==7) && ($zero_ref_id_num==3))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==6) && ($zero_ref_id_num==4))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==5) && ($zero_ref_id_num==5))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==4) && ($zero_ref_id_num==6))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==3) && ($zero_ref_id_num==7))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==2) && ($zero_ref_id_num==8))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
   elseif(($two_ref_id_num==2) && ($one_ref_id_num==1) && ($zero_ref_id_num==9))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   elseif(($two_ref_id_num==2) && ($zero_ref_id_num==10))
   {
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid1[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[9]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   
   }
   
   
    elseif(($two_ref_id_num==1) && ($one_ref_id_num==11))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[9]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[10]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==1) && ($one_ref_id_num==10) && ($zero_ref_id_num==1))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[9]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
    elseif(($two_ref_id_num==1) && ($one_ref_id_num==9) && ($zero_ref_id_num==2))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  

   
   $x7="update board_status_exp set uid='$xxid2[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==8) && ($zero_ref_id_num==3))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[7]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==7) && ($zero_ref_id_num==4))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==6) && ($zero_ref_id_num==5))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);

  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==5) && ($zero_ref_id_num==6))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==4) && ($zero_ref_id_num==7))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==3) && ($zero_ref_id_num==8))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==2) && ($zero_ref_id_num==9))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($one_ref_id_num==1) && ($zero_ref_id_num==10))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[9]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($two_ref_id_num==1) && ($zero_ref_id_num==11))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid1[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[9]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[10]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif($one_ref_id_num==12)
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[10]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid2[11]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==11) && ($zero_ref_id_num==1))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x8);
  
   $x8="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid2[10]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==10) && ($zero_ref_id_num==2))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid2[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==9) && ($zero_ref_id_num==3))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid2[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==8) && ($zero_ref_id_num==4))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid2[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($one_ref_id_num==7) && ($zero_ref_id_num==5))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  

   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid2[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($one_ref_id_num==6) && ($zero_ref_id_num==6))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid2[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==5) && ($zero_ref_id_num==7))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==5) && ($zero_ref_id_num==7))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid2[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==4) && ($zero_ref_id_num==8))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid2[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[4]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==3) && ($zero_ref_id_num==9))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid2[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[1]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[2]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[3]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[4]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[5]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif(($one_ref_id_num==2) && ($zero_ref_id_num==10))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid2[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid3[0]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[2]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[3]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[4]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[5]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[6]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[9]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   elseif(($one_ref_id_num==1) && ($zero_ref_id_num==11))
   {
     
     
    
   $x="update board_status_exp set uid='$xxid2[0]' where board_no='$asd' AND cel_no=13";
   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid3[0]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid3[1]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[3]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[4]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[5]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[6]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[7]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[9]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[10]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   
   elseif($zero_ref_id_num==12)
   {
     
     
    
   $x="update board_status_exp set uid='$xxid3[0]' where board_no='$asd' AND cel_no=13";

   $s=mysql_query($x);
  
   
   $x1="update board_status_exp set uid='$xxid3[1]' where board_no='$asd'  AND cel_no=14";
   $s1=mysql_query($x1);
  
   $x2="update board_status_exp set uid='$xxid3[2]' where board_no='$asd1' AND cel_no=13";
   $s2=mysql_query($x2);
  
   
   $x3="update board_status_exp set uid='$xxid3[3]' where board_no='$asd1'  AND cel_no=14";
   $s3=mysql_query($x3);
  
   $x4="update board_status_exp set uid='$xxid3[4]' where board_no='$asd' AND cel_no=9";
   $s4=mysql_query($x4);
  
   
   $x5="update board_status_exp set uid='$xxid3[5]' where board_no='$asd'  AND cel_no=10";
   $s5=mysql_query($x5);
  
   $x6="update board_status_exp set uid='$xxid3[6]' where board_no='$asd' AND cel_no=11";
   $s6=mysql_query($x6);
  
   
   $x7="update board_status_exp set uid='$xxid3[7]' where board_no='$asd'  AND cel_no=12";
   $s7=mysql_query($x7);
  
   $x8="update board_status_exp set uid='$xxid3[8]' where board_no='$asd1' AND cel_no=9";
   $s8=mysql_query($x8);
  
   
   $x9="update board_status_exp set uid='$xxid3[9]' where board_no='$asd1'  AND cel_no=10";
   $s9=mysql_query($x9);
  
   $x10="update board_status_exp set uid='$xxid3[10]' where board_no='$asd1' AND cel_no=11";
   $s10=mysql_query($x10);
  
   
   $x11="update board_status_exp set uid='$xxid3[11]' where board_no='$asd1'  AND cel_no=12";
   $s11=mysql_query($x11);
   
   }
   
   //----------------------end inserting into two board--------------------------
   
//----------------re-entry----------------------

$sll_15="select * from board_status_exp where board_no='$y' AND cel_no=15";
    $sl_15=mysql_query($sll_15);
    $ress_15=mysql_fetch_array($sl_15) ;     
     $si11_15=$ress_15['uid'];


$sll_15_info="select * from registration_exp where user_id='$si11_15'";
    $sl_15_info=mysql_query($sll_15_info);
    $ress_15_info=mysql_fetch_array($sl_15_info) ;
	$re_ref_id=  $ress_15_info['ref_id'];   
     $upass_exp=$ress_15_info['user_pass'];
     $tupass_exp=$ress_15_info['t_code'];
	 $plan_exp=$ress_15_info['plan_name'];

//$exp_ref_id=ck_exp_ref($si11_15);

   
    $quer_exp="insert into registration_exp(user_id, nom_id, user_pass, t_code, plan_name, pair_id, binary_pos, pin_no, ref_id, ref_nm, first_name, dob, sex, mstatus, nationality, pan_no, phoner, mobile, email, address, city, state, zip, country, nominee, relation, bank_nm, branch_nm, reg_date, terms, blood, status) values('$si11_15', '', '$upass_exp', '$tupass_exp', '$plan_exp', '$dyid12', '$binary', '$pin', '$re_ref_id', '$ref_nm', '$usernm', '$dob', '$sex', '$mstatus', '$nation', '$pancard', '$phoner', '$mobile', '$email', '$address', '$city', '$state', '$zip', '$country', '$nominee', '$relation', '$bankname', '$branchname', '$regdate', '$terms', '$blgroup', 0)";
	$data_exp=mysql_query($quer_exp) or die('ff');
	exp_break($re_ref_id,$si11_15);
	//------------------- end rentry------------------------------   
   
   
   
   
   
   
   }
   //-----------end process of board breaking--------------------
  
}
else
{
print "ib";
}
}
/*exp_break('ibc','122861');
print "mast";
*/?>