<?php
include('../includes/all_func.php');
$idd=$_SESSION['SD_User_Name'];
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
 //echo "<pre>"; print_r($_REQUEST);
 //print_r($_FILES); exit;
$pass=$_REQUEST['password'];
//$desc=mysql_real_escape_string($_REQUEST['desc']);

$sel="select count(id) from registration where t_code='$pass' and user_id='$id'"; 
$sql=mysql_query($sel);
$result=mysql_result($sql,0,0);
if($result>0 )
{
$sql="insert into apply_for_verify set user_id='$id',status=0,apply_date=curdate()";
//echo $sql;exit;
mysql_query($sql);
//print_r($_FILES);
if($_FILES['bl']['name']!='')
	{
		$bl_arr=explode('.',$_FILES['bl']['name']);
		$ext1=end($bl_arr);
		$image1=$idd."_".time().'_bl_'.substr($_FILES['bl']['name'],0,3).'.'.$ext1;
 		$move=move_uploaded_file($_FILES['bl']['tmp_name'],"businessuser_doc/".$image1);
		mysql_query("update `apply_for_verify` set id_doc='$image1' where user_id= '$id'");
	}
	if($_FILES['st']['name']!='')
	{	
		$st_arr=explode('.',$_FILES['st']['name']);
		$ext1=end($st_arr);
		$image1=$idd."_".time().'_st_'.substr($_FILES['st']['name'],0,3).'.'.$ext1;
 		$move=move_uploaded_file($_FILES['st']['tmp_name'],"businessuser_doc/".$image1);
		mysql_query("update `apply_for_verify` set address_doc='$image1' where user_id= '$id'");
	}
	
	//exit;
	?>
	<script type="text/javascript">
	//location.href='apply_for_mlm.php';
	location.href='apply_for_verified.php';
	</script>
	<?php
}
else
{
	?>
	<script type="text/javascript">
	alert('Wrong Transaction Password');
	location.href='apply_for_verified.php';
	</script>
	<?php
}

?>