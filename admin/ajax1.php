<?php
include("../includes/all_func.php");

if($_REQUEST['mode']=='changehistory'){
	$_SESSION['changehistoryval']=$_REQUEST['val'];
	echo $_SESSION['changehistoryval'];
	exit();
}
?>
