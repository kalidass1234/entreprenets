<?php
function level_st($sp_id,$id)
{
$str_1="select * from registration where user_id='$sp_id'";
$res_1=mysql_query($str_1);
$row_1=mysql_fetch_array($res_1);
$ref_id1=$row_1['ref_id'];
$lev1=2;
$up_1="update registration set level2='$lev1' where user_id='$id'";
$ures_1=mysql_query($up_1);
if($ref_id1)
{
$str_2="select * from registration where user_id='$ref_id1'";
$res_2=mysql_query($str_2);
$row_2=mysql_fetch_array($res_2);
$ref_id2=$row_2['ref_id'];
$lev2=3;
$up_2="update registration set level3='$lev2' where user_id='$id'";
$ures_2=mysql_query($up_2);
if($ref_id2)
{
$str_3="select * from registration where user_id='$ref_id2'";
$res_3=mysql_query($str_3);
$row_3=mysql_fetch_array($res_3);
$ref_id3=$row_3['ref_id'];
$lev3=4;
$up_3="update registration set level4='$lev3' where user_id='$id'";
$ures_3=mysql_query($up_3);

if($ref_id3)
{
$str_4="select * from registration where user_id='$ref_id3'";
$res_4=mysql_query($str_4);
$row_4=mysql_fetch_array($res_4);
$ref_id4=$row_4['ref_id'];
$lev4=5;
$up_4="update registration set level5='$lev4' where user_id='$id'";
$ures_4=mysql_query($up_4);

if($ref_id4)
{
$str_5="select * from registration where user_id='$ref_id4'";
$res_5=mysql_query($str_5);
$row_5=mysql_fetch_array($res_5);
$ref_id5=$row_5['ref_id'];
$lev5=6;
$up_5="update registration set level6='$lev5' where user_id='$id'";
$ures_5=mysql_query($up_5);

}
}
}
}
}
?>