<?php session_start();
include("../controller/connection.php");
include('../controller/function.php'); 
if(!isset($_SESSION['adid']))
{
 header('location:../index.php');
}
 $db_aff = new Database();   
 $closing=$_REQUEST['closing'];
$remark=$_REQUEST['remark'];
$com_type=$_REQUEST['com_type'];
$id=$_SESSION['adid'];
$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_id='$id'"));
$ref_id=$res_reg[ref_id];
$query="com_type='$com_type' AND income_id='$id' and li.status='1' ";
 $res_closing=mysql_fetch_array(mysql_query("select max(closing_no) as closing from closing_data"));
  $closing=$res_closing['closing'];

 $query="com_type='r' AND income_id='$id' and li.status='1' ";
 if(isset($_REQUEST['closing'])){
 	$closing=$_REQUEST['closing'];
	if($closing!=0) 
 	 $query.=" and closing_no='{$closing}' ";
	
 }
 else  $query.=" and closing_no='{$closing}' ";
 if($remark!=''){
	 $query.=" and remark='{$remark}' ";
 }

 $db_aff->select('level_income li INNER JOIN registration reg ON reg.user_id=li.down_id','li.*, reg.user_name',$query, "li.closing_no desc, li.l_id desc"); 
 $count_aff= $db_aff->numResults;
$show_aff = $db_aff->getResult(); 
$sql_super=mysql_query("select si.*, reg.user_name from super_incentive si inner join registration reg on reg.user_id=si.income_id where income_id='$id' and si.status='1' order by id desc");
$sql_power=mysql_query("select pp.*, reg.user_name from power_pool pp inner join registration reg on reg.user_id=pp.income_id where income_id='$id' and pp.status='1' order by id desc");
//**********SUM ***********//
//echo "select sum(commission) as com from level_income where income_id='$id' AND remark='Matching Bonus'";

 $query_fast="select sum(commission) as comi, sum(tax) as tax, sum(final_amount) as final_amount from level_income li where ".$query;
$sql_fastsum=mysql_fetch_array(mysql_query($query_fast));
 $sum_fast=$sql_fastsum['comi'];

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
window.print() ;
</script>
<style type="text/css">
table th, td{
	padding:4px;
}
table td{
	background:#fff;
	
}
</style>
</head>

<body>
<table  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#ccc">
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              <th> User Id </th>
                              <th> User Name </th>
                              <th>Product Price</th>
                              <th>Level</th>
                              <th >Percentage(%)</th>
                              <th> Commission(USD) </th>
                              <th>Tax</th>
                              <th>Paid Commission </th>
                              <th>Payout Date</th>
                              <th>Status</th>
                              <th>Closing No</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <?php
						  	$sr=1;
	  						if($count_aff==1){
								if($show_aff[package]=='Product Purchase'){
										$type='pro';			
								}
								else if($show_aff[package]=='Valunaire Subscription'){
										$type='pack';			
								}
								else if($show_aff[package]=='Product Bundle Purchase'){
										$type='bun';			
								}
								$totalcom_fast=0;
								
								$totalcom_fast+=$show_aff['commission'];
							 ?>
                            <tr>
                              <td><?= $sr ?></td>
                              <td align="center" class="ptext"><?=$show_aff['down_id']?></td>
                              <td align="center" class="ptext"><?=$show_aff['user_name']?></td>
                              <td class="center"><?=$show_aff['price']?></td>
                              <td align="center" class="ptext"><?=$show_aff['level']?></td>
                              <td align="center" class="ptext"><?=$show_aff['percent']?></td>
                              <td align="center" class="ptext"><?=$show_aff['final_amount']?></td>
                              <td align="center" class="ptext"><?=$show_aff['tax']?></td>
                              <td align="center" class="ptext"><?=$show_aff['commission']?></td>
                              <td class="center"><?= ($show_aff[payout_date]=='0000-00-00') ? 'Waiting' : date('d-m-Y',strtotime($show_aff[payout_date])); ?></td>
                              <td class="center"><span>
                                <?= ($show_aff[status]==0) ? 'Pending' : 'Paid' ?>
                                </span></td>
                              <td align="center" class="ptext"><?=$show_aff['closing_no']?></td>
                              
                            </tr>
                            <?
							
						}
						else{ 
						
						  foreach($show_aff as $aff)
						  { 
						   if($aff[package]=='Product Purchase'){
									$type='pro';			
							}
							else if($aff[package]=='Valunaire Subscription'){
									$type='pack';			
							}
							else if($aff[package]=='Product Bundle Purchase'){
									$type='bun';			
							}
						
						  $totalcom_fast+=$aff['commission'];
			 			 ?>
                            <tr>
                              <td><?= $sr ?></td>
                              <td align="center" class="ptext"><?=$aff['down_id']?></td>
                              <td align="center" class="ptext"><?=$aff['user_name']?></td>
                              <td class="center"><?=$aff['price']?></td>
                              <td align="center" class="ptext"><?=$aff['level']?></td>
                              <td align="center" class="ptext"><?=$aff['percent']?></td>
                              <td align="center" class="ptext"><?=$aff['final_amount']?></td>
                              <td align="center" class="ptext"><?=$aff['tax']?></td>
                              <td align="center" class="ptext"><?=$aff['commission']?></td>
                              <td class="center"><?= ($aff[payout_date]=='0000-00-00') ? 'Waiting' : date('d-m-Y',strtotime($aff[payout_date])); ?></td>
                              <td class="center"><span>
                                <?= ($aff[status]==0) ? 'Pending' : 'Paid' ?>
                                </span></td>
                              <td align="center" class="ptext"><?=$aff['closing_no']?></td>
                              
                            </tr>
                            <?  $sr++;
							
							}
							}	?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td align="center" class="ptext" colspan="3">Total Commission Earned</td>
                              <td align="center" class="ptext"><?=round($sql_fastsum['final_amount'], 2) ?></td>
                              <td align="center" class="ptext">&nbsp;</td>
                              <td align="center" class="ptext" colspan="2">Total Income_tax</td>
                              <td align="center" class="ptext"><?=round($sql_fastsum['tax'], 2) ?></td>
                              <td align="center" class="ptext">&nbsp;</td>
                              <td align="center" class="ptext" colspan="2">Total Commission</td>
                              <td align="center" class="ptext"><?=round($sum_fast, 2) ?></td>
                            </tr>
                          </tfoot>
                        </table>
</body>
</html>