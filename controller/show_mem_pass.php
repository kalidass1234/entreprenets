<?php
session_start();

if(!$_SESSION['adid'])
{
header('location:index.php');

}

$id=$_SESSION['adid'];
include("controller/connection.php");	
   echo $quer="select count(*) from registration where user_id='$id'";
	$data=mysql_query($quer);
	$res=mysql_result($data, 0, 0);
	if($res>0)
	{
	
     $quer="select * from registration where user_id='$id'";
	$data=mysql_query($quer);*/
	$x=mysql_fetch_array($data);
	
	?>
	<table width="265" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr><td></td></tr>
      <tr>
	   <td width="261" align="center" class="text">Password :<strong><?php echo $x['user_pass']; ?></strong></td>
      </tr>
    </table>
	
	<?php		
	}
	else
	{
	?>
	<table width="237" border="1" align="center" cellpadding="0" cellspacing="0" >

	<tr>
		<td width="221" align="center" class="text">No Such Record Found for this ID</td>
	</tr>
</table>
	

<?php
	}
?>