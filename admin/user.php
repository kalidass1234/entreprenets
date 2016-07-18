<?php 
include("config/config.php");
$id=$_GET['q'];
$q=mysql_query("select user_name,first_name,last_name from registration where user_id='$id' or user_name='$id'") or die(mysql_error());
$n=mysql_num_rows($q);
if($n>0)
{
		$r=mysql_fetch_assoc($q);
		 $uname=$r['user_name'];
		$name=$r['first_name']." ".$r['last_name'];
		$qry=mysql_query("select * from user_rank ur inner join user_rank_achieve ura on ur.id=ura.rank_id where ura.username='$uname'") or die(mysql_error());
		$row=mysql_fetch_assoc($qry);
		 $bv=$row['total_bv'];
		 $rank_name=$row['rank_name'];
         
         $user.= "<table class='table table-striped table-bordered table-hover' id='txtHint'><tr>
                            <td width='35%'>Name</td>
                     		<td align='left'>".$name."</td></tr>
                            <tr>
                            <td>Star</td>
                     		<td>".$rank_name."</td></tr>
                            <tr>
                            <td>Join BV</td>
                     		<td>".$bv."</td></tr></table>";
                            echo $user;
}
else
{
	echo "User not available";
}
?>
