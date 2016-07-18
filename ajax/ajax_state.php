<?php
session_start();
include_once("../controller/connection.php");
include_once("../includes/common_function.php");
if(isset($_REQUEST["id"]))
{
  $country_id=$_REQUEST["id"];
}


?>
<select  class="select" name="state" id="state" required>
<option value="" >State</option>
<?php
$state = getState($country_id);
foreach($state as $state)
{
?>
<option value="<?=$state["state_id"]?>"><?=$state["title"]?></option>
<?php
}
?>
</select>