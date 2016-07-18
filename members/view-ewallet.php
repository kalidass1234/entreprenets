<?php define('ABSPATH','../../lib/'); include('../header.php');  include('../pagination/pagination.php');

// get main cateogries
$args_members = $mxDb->get_information('sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');
$userid=$_GET['user_id'];
?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('../nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Member Credit Debit History</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Ewallet</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Member Credit Debit History</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
        
        	<?php
				if(isset($_GET['msg'])):
					if($_GET['res']==1):?>
                    <div style="padding:5px; color:#063; font-weight:bold;"><?php echo strip_tags($_GET['msg']); ?></div>
              <?php else: ?>
                    <div style="padding:5px; color:#F00; font-weight:bold;"><?php echo strip_tags($_GET['msg']); ?></div>	
			<?php
					endif;
				endif;
			?>
        
            <?php /*?><div class="widget">
             <div class="widget-head">
                <div class="pull-left">Search members</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" id='form1'>
                  <input type="hidden" name="action" value="search" />
                    <fieldset>
                     
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> First Name</label>
                          <input type="text" class="validate[required] form-control placeholder" id="first_name" name="first_name" placeholder="First Name" data-bind="value: name" />
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Last Name</label>
                          <input type="text" class="validate[required] form-control placeholder" id="last_name" name="last_name" placeholder="Last Name" data-bind="value: name" />
                        </div>
                        
                      </div>
                      
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Username</label>
                          <input type="text" class="validate[required] form-control placeholder" id="username" name="username" placeholder="username" data-bind="value: name" />
                        </div>
                        
                      </div>
                      <div class="form-group">
                          <div class="left-box">
                          <label for="name" >Status</label>
                          <select name="status" class="form-control placeholder" id="all">
                          <option value="">Select Status</option>
                            <option value="all">All</option>
                            <option value="0">Active</option>
                            <option value="1">Deactive</option>
                          </select>
                        </div>
                        <div class="left-box">
                         <br>
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div><?php */?>
          </div>
        </div>
           
<!--      <a href="<?php //echo SITE_URL; ?>admin/category/category-sub-sub.php"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>
-->      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Ewallet Credit Debit History</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.No.</th>
                            <th>Transaction No</th>
                             <th>Transaction Date</th>
							<th>Reason</th>
							<th>Credit</th>
						<th>Debit</th>
                        <th>Transaction Type</th>
                            <th>Status</th>
                 </tr>
              </thead>
              <tbody>
              <?php

						$bal=0;

						$ii=0; $s_no=1;
						$sqll2=mysql_query("select * from credit_debit where (user_id='$userid' || receiver_id='$userid') order by id desc");
						while($sq=mysql_fetch_array($sqll2))
						{
							$sq1=$sq['credit_amt'];
							$sq2=$sq['debit_amt'];
							$sq3=$sq['Remark'];
							$sq4=$sq['receive_date'];
							$sq5=$sq['ewallet_used_by'];
							$sq6=$sq['transaction_no'];
							$sq7=$sq['ttype'];
							
							
							if($sq2=='0')
							{
							$filter="receiver_id";	
							}
							else
							{
								 $filter="user_id";	print_r("<br/>");
							}
							
						$sqll=mysql_query("select * from credit_debit where $filter='$userid' order by id desc"); 
						$is=0;
		
						    while($fetch=mysql_fetch_array($sqll)){

			 			 

						 $ii++;
						 $is++;
				

						 ?><?php if($is=='1')
						 {?>

               <tr>

								<td align="center" class="ptext"><?php echo $s_no;?></td>
                                  <td align="center" class="ptext"><?=$sq6;?></td>
                                                                   <td align="center" class="ptext"><?=$sq4;?></td>

								  <td align="center" class="ptext"><?=$sq3;?></td>

                                  <td align="center" class="ptext"><?=$sq1;?></td>
                                  <td align="center" class="ptext"><?=$sq2;?></td>

                                <td align="center" class="ptext"><?=$sq7;?></td>

                                  <td align="center" class="ptext"><?php $pstatus=$fetch['paid_status'];if($pstatus==1) { echo "Not Paid";} else { echo "Paid";}?></td>

                                  <?php @$credit_total=$credit_total+$sq1;@$debit_total=$debit_total+$sq2;?>

                                </tr><?php } ?>

                                <?

								} $s_no++;}

								?>
                                
                                <tr><td></td><td></td><td></td><td></td><td>Total Credit Amount : $ <?php echo $credit_total;?></td><td>Total Debit Amount : $ <?php echo $debit_total;?></td></tr>
              </tbody>
            </table>
            
            <script type="text/javascript">
				// delete record
				delete_item = function(url){
					if(confirm("Do you want to delete this record")){
						window.location.href=url;
					}
				}
			</script>
            
            <div class="widget-foot">
              <ul class="pagination pull-right">
              
                <!--<li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>-->
              </ul>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Today status ends --> 
      
      <!-- Dashboard Graph starts --> 
      
      <!-- Dashboard graph ends --> 
      <!-- Chats, File upload and Recent Comments --> 
    </div>
  </div>
  <!-- Matter ends --> 
</div>
<!-- Mainbar ends --> 
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->
<?php include('../footer.php'); ?>
