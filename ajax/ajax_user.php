<?php session_start();

include("../controller/connection.php");
 $id=$_POST['id'];
$pos=isset($_POST['pos']) ? $_POST['pos'] : '';

$selectuser=mysql_query("select user_name, first_name, last_name from registration where (user_id='$id' or user_name='$id')");
$fetchuser=mysql_fetch_array($selectuser);
//echo "select user_name from registration where user_name='$id'";
$selectuser1=mysql_query("select user_name from registration where user_name='$id'");
$fetchuser1=mysql_fetch_array($selectuser1);

$selectuser3=mysql_query("select email from registration where email='$id'");
$fetchuser3=mysql_fetch_array($selectuser3);


if($id!="" && $pos=="email")
{
if($fetchuser4['ref_id']!="" && $fetchuser3['email']==''){
	$selectuser_pros=mysql_fetch_array(mysql_query("select * from registration where user_id='{$fetchuser4['ref_id']}'   "));
	/*echo "<font color='#009900' class='ajaxdiv'>".$fetchuser['first_name']."</font>";*/
	echo ucfirst($selectuser_pros['first_name']).' '.ucfirst($selectuser_pros['last_name']).'#'.$fetchuser4['ref_id'];
}	
else
if($fetchuser3['email']!="")
echo "no";
else
echo  'yes';

}



if($id!="" && $pos=="ref_id")
{
if($fetchuser['user_name']!="")
echo ucfirst($fetchuser['first_name'])." ".ucfirst($fetchuser['mid_name'])." ".ucfirst($fetchuser['last_name']);
else
echo  "no";
}
if($id!="" && $pos=="nom_id")
{
if($fetchuser['user_name']!="")
echo ''/*"<font color='#009900' class='ajaxdiv'>".$fetchuser['user_name']."</font><input type='hidden' id='check_user' value='1'>"*/;
else
echo  "<font color='#FF0000' class='ajaxdiv'>Wrong Place under Id.</font><input type='hidden' id='check_user' value='2' >";
}
 if($id!="" && $pos=="user")
{
if($fetchuser1['user_name']!="" ){
echo  "no";
}
else
echo  "yes";
}
?>
