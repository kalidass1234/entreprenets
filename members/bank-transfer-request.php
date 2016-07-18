<?php define('ABSPATH','../../lib/'); include('../header.php');  include('../pagination/pagination.php');

// get main cateogries
$args_members = $mxDb->get_information('sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');

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
      <h2 class="pull-left">Bank Transfer Request Member List</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Bank Transfer Request Member List</a> </div>
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
					?>
                    <div style="padding:5px; color:#063; font-weight:bold;"><?php echo strip_tags(@$_GET['msg']); ?></div>
              <?php else: ?>
                    <div style="padding:5px; color:#F00; font-weight:bold;"><?php echo strip_tags(@$_GET['msg']); ?></div>	
			<?php
					
				endif;
			?>
        
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Search Members</div>
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
                          <label for="name"> User Id</label>
                          <input type="text" class="validate[required] form-control placeholder" id="userid" name="userid" placeholder="User id" data-bind="value: id" />
                        </div>
                        
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
            </div>
          </div>
        </div>
           
<!--      <a href="<?php //echo SITE_URL; ?>admin/category/category-sub-sub.php"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>
-->      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Members Lists</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>User ID </th>
                  <th>Reciept Id</th>
                  <th>Total Amount</th>
                  <th>Package Name</th>
                  <th>Status</th>
                  <th>Posted Date</th>
                  <th>Read Status</th>
                  <th>Activate User</th>
                  <th>View Scan copy</th>
                 </tr>
              </thead>
              <tbody>
              <?php 
			  
			 // store query
			  $query = '';
			  
			   // set url
			  $url = SITE_URL.'admin/members/bank-transfer-request.php?';
		  
			  $page = isset($_GET['page'])? $_GET['page'] : '1';
			  $current_page = $page;			  
			  $page--;
			  $per_page = 20;
			  $start = $page*$per_page;
			  $last = $per_page;
			  $total_p = 0;
			  $pages = 0;
				
			  $limit = " limit $start, $last";
			  
			  // get record according filters
			  if(isset($_GET['action'])){
				  
				  $query = http_build_query($_GET);
				  
				  $condition = " where 1=1";
				 // get reocrd from data to To date 
				
				// get reocrd from category name wise 
				if($_GET['userid']){
					$condition .= " and user_id ".$_GET['userid']."'";
				}
				
							
				$args_members = $mxDb->get_information('scan_copy', '*', $condition.' order by id desc '.$limit,false, 'assoc');
				$args_total_member = $mxDb->get_information('scan_copy', 'count(*) as total', $condition.' order by id desc ',true, 'assoc');
							
			  }
			  else
			  {
				$condition = "where 1=1";   
			  	$args_members = $mxDb->get_information('scan_copy', '*', $condition.' order by id desc '.$limit,false, 'assoc');
				$args_total_member = $mxDb->get_information('scan_copy', 'count(*) as total', $condition.' order by id desc ',true, 'assoc');
			  }
			 
			 // get total record for pagination
			 if(isset($args_total_member['total'])){
			  		$total_p = $args_total_member['total'];
			   		$pages = ceil($total_p/$per_page);	 
			 }
			  
			  if(preg_match('/&page=[0-9]$/',$query)){
				  $query = preg_replace('/&page=[0-9]$/','',$query);
			  }
			  
			  /* ====== show records ======== */
			  if($args_members):
			  	$s_no = 1;
				foreach($args_members as $member):
              ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo $member['user_id']; ?></td>
                  <td><?php echo $member['reciept_id']; ?></td>
                  <td>$ <?php echo $member['amount']; ?></td>
                  <td><?php echo $member['package']; ?></td>
                  <td><?php  $status=$member['status']; if($status=='1') { echo "Pending";} else { echo "Confirmed";}?></td>
                  <td><?php echo $member['posted_date']; ?></td>
                  <th><?php  $read_status=$member['status']; if($read_status=='1') { echo "Not Read";} else { echo "Read";}?></th>
                  <td>&nbsp;
				  <span style="margin-left:5px;"><a href="<?php echo SITE_URL; ?>admin/members/activate-scan-copy.php?user_id=<?php echo $member['id'];?>" title="View History">Activate User</a></span></td><td>
                  <span style="margin-left:5px;"><a href="<?php echo SITE_URL; ?>bank_scan_copy/<?php echo $member['file_name'];?>" target="_blank" title="View Scan Copy">View Scan Copy</a></span>
                  </span>

                  </td>
                </tr>
                <?php $s_no++;
					endforeach;
				endif;
				?>
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
              <?php echo pagination($url,$query,$pages,$current_page); ?>
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
