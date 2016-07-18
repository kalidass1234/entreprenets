<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);

$cat_id=$_POST['catid'];
 $str=mysql_query("select * from sub_category where cat_id='$cat_id'");
 ?>
 
 <option value="" >------------Please Select Sub Category-----------</option>
 <?php
									while($res1=mysql_fetch_array($str)){
									
									if($res1['sub_id']==$row['sub_id'])
									{
									?>
									<option value="<?=$res1['sub_id']; ?>" selected="selected"><?=$res1['sub_name']; ?></option>
									<?
									}else{
									?>
									<option value="<?=$res1['sub_id']; ?>"><?=$res1['sub_name']; ?></option>
									<? }}?>
