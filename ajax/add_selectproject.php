<?php
include("../controller/connection.php");
if(isset($_POST['user_id']) && $_POST['user_id'] > 0 && isset($_POST['project_id']) && $_POST['project_id'] > 0){
$upq = mysql_query("select * from user_project WHERE project_id='".$_POST['project_id']."' AND user_id='".$_POST['user_id']."'");
$up = mysql_fetch_array($upq);
if(!empty($up)){
    mysql_query("UPDATE user_project SET status='".$_POST['status']."' WHERE project_id='".$_POST['project_id']."' AND user_id='".$_POST['user_id']."'");
} else {
    mysql_query("INSERT INTO user_project SET status='".$_POST['status']."', project_id='".$_POST['project_id']."', user_id='".$_POST['user_id']."'");
}

}
