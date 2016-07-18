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
      <h2 class="pull-left">Member</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Members List</a> </div>
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
        
            <div class="widget">
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
                  <th>Member Name</th>
                  <th>Username</th>
                  <th>Sponsor ID</th>
                  <th>Sponsor Name</th>
                  <th>Reg Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  
			 // store query
			  $query = '';
			  
			   // set url
			  $url = SITE_URL.'admin/members/index.php?';
		  
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
				  
				  $condition = " where ref_id <>'cmp'  and user_status=0 and admin_status=0";
				 // get reocrd from data to To date 
				
				// get reocrd from category name wise 
				if($_GET['first_name']){
					$condition .= " and first_name like'%".$_GET['first_name']."'";
				}
				
				// get reocrd from category name wise 
				if($_GET['last_name']){
					$condition .= " and last_name like'%".$_GET['last_name']."'";
				}
				
				// get reocrd from according main category
				if($_GET['username']){
					$condition .= " and username ='".$_GET['username']."'";
				}
				
				// get reocrd from status wise
				if($_GET['status']){
					
					if(is_numeric($_GET['status']))
						$condition .= " and user_status ='".$_GET['status']."'";
					else
					 	 $condition = " where ref_id <>'cmp'  and user_status=0 and admin_status=0";
						
				}
				
				$args_members = $mxDb->get_information('user_registration', '*', $condition.' order by id desc '.$limit,false, 'assoc');
				$args_total_member = $mxDb->get_information('user_registration', 'count(*) as total', $condition.' order by id desc ',true, 'assoc');
							
			  }
			  else
			  {
				$condition = "where ref_id <>'cmp'  and user_status=0 and admin_status=0";   
			  	$args_members = $mxDb->get_information('user_registration', '*', $condition.' order by id desc '.$limit,false, 'assoc');
				$args_total_member = $mxDb->get_information('user_registration', 'count(*) as total', $condition.' order by id desc ',true, 'assoc');
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
				
				$status = array('0'=>'Active','1'=>'Deactive');
				$title_status = ( @$member['user_status'] == 0 )? 'Deactive' : 'Active';
				
			  	foreach($args_members as $member):
              ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><a target="_blank" href="<?php echo SITE_URL; ?>admin/members/login_user_account.php?uid=<?php echo $member['user_id']; ?>&amp;username=<?php echo $member['username']; ?>"><?php echo $member['user_id']; ?></a></td>
                  <td><?php echo ucwords($member['first_name']." ".$member['last_name']); ?></td>
                  <td><?php echo $member['username']; ?></td>
                  <td><?php echo $member['ref_id']; ?></td>
                  <td><?php $mxDb->get_field_information('user_registration','concat_ws(" ", first_name, last_name)', "where user_id=".$member['ref_id'],'assoc', true); ?></td>
                  <td><?php echo $member['registration_date']; ?></td>
                  <th><?php echo @$status[$member['user_status']]; ?></th>
                  <td>&nbsp;
				  <span style="margin-left:5px;"><a href="<?php echo SITE_URL; ?>admin/members/view-user.php?<?php echo http_build_query($member);?>" title="View Detail"><img src="../images/edit.png" /></a></span>
                  <span style="margin-left:5px;"><a href="javascript:void(0)" onclick="delete_item('../action_control/get-action.php?rand=<?php echo $_SESSION['rand']; ?>&id=<?php echo $member['user_id'];?>&tbl=user_registration&return=members/index.php&field=user_id&action=DeleteRecord&delete=true')" title="Delete"><img src="../images/Trashcan.png" /></a></span>
                  <span style="margin-left:5px;"><a href="../action_control/get-action.php?rand=<?php echo $_SESSION['rand']; ?>&id=<?php echo $member['user_id'];?>&tbl=user_registration&return=members/index.php&field=user_id&user_status=<?php echo $member['user_status'];?>&action=changeStatus&delete=true" title="<?php echo $title_status; ?>"><img src="../images/enable.png" /></a></span>

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
