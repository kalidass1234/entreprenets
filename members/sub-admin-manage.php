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
      <h2 class="pull-left">Sub Admin Manage</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Sub Admin List</a> </div>
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
            
            <div class="widget" >
             <div class="widget-head">
                <div class="pull-left">Search</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize">
                <i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings">
                <i class="fa fa-wrench"></i></a> <a href="#" class="wclose">
                <i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" id='form1'>
                  <input type="hidden" name="action" value="search" />
                    <fieldset>
                      
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name">Name</label>
                          <input type="text" class="validate[required] form-control placeholder" id="name" name="name" placeholder="Name" data-bind="value: name" />
                        </div>
                        
                        <div class="left-box">
                          <label for="name">Username</label>
                          <input type="text" class="validate[required] form-control placeholder" id="username" name="username" placeholder="Username" data-bind="value: name" />
                        </div>
                        
                        <div class="left-box">
                          <label for="name">ALL </label>
                          <input type="checkbox"  class=" form-control " value="1" id="all" name="all" placeholder="Name" data-bind="value: name" />
                        </div>
                        
                      </div>
                      
                      <div class="form-group">
                       <div class="left-box">
                       <br>
                      	<button class="btn btn-danger side"  type="submit" id="button" >Search</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
            <a href="<?php echo SITE_URL; ?>admin/members/add-sub-admin.php"> <button class="btn btn-danger side"  type="button" id="button" >Add New</button></a>
            <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Pages</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
            <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> 
            <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          
		  <?php
		   // store query
			  $query = '';
			  
			   // set url
			  $url = SITE_URL.'admin/members/sub-admin-manage.php?';

		  
			  $users = isset($_GET['page'])? $_GET['page'] : '1';
			  $current_page = $users;			  
			  $users--;
			  $per_page = 20;
			  $start = $users*$per_page;
			  $last = $per_page;
			  $total_p = 0;
			  $userss = 0;
				
			  $limit = " limit $start, $last";
			  
			  $condition = "where type='sub_admin'";
			  
			   // get record according filters
			  if(isset($_GET['action'])){
				  
				  $query = http_build_query($_GET);
				  
				$condition = "where type='sub_admin'";
				
				// get reocrd from category name wise 
				if($_GET['username']){
					$condition .= " and username ='".$_GET['username']."'";
				}
				
				// get reocrd from category name wise 
				if($_GET['name']){
					$condition .= " and name ='".$_GET['name']."'";
				}
				
				// show all records
				if(isset($_GET['all'])){
					$condition = "where type='sub_admin'";
				}
				
				 $args_user_list = $mxDb->get_information('admin', '*', $condition.' order by id asc'.$limit,false, 'assoc');
				 $args_total_user = $mxDb->get_information('admin', 'count(*) as total', $condition.' order by id asc ',true, 'assoc');
				 
			  }
			  else{
				  
				 $args_user_list = $mxDb->get_information('admin', '*', $condition.' order by id asc'.$limit,false, 'assoc');
				 $args_total_user = $mxDb->get_information('admin', 'count(*) as total', $condition.' order by id asc ',true, 'assoc');
			  }
				  
				 // get total record for pagination
				 if(isset($args_total_user['total'])){
						$total_p = $args_total_user['total'];
						$userss = ceil($total_p/$per_page);	 
				 }
				  
				  if(preg_match('/&page=[0-9]$/',$query)){
					  $query = preg_replace('/&page=[0-9]$/','',$query);
				  }

			  
		  ?>
          
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                 <th>S.no.</th>
                  <th> Name</th>
                  <th>Username</th>
                  <th>email</th>
                  <th>Date / Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  
			  
			  if( $args_user_list ):
			  	$s_no = 1;
			  	foreach( $args_user_list as $users ):
				
              ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo $users['name']; ?></td>
                  <td><?php echo $users['username']; ?></td>
                  <td><?php echo $users['email']; ?></td>
                  <td><?php echo date("d-m-Y H:i:s",strtotime($users['add_date_time'])); ?></td>
               
                  <td>&nbsp;
				  <span style="margin-left:5px;"><a href="<?php echo SITE_URL; ?>admin/members/add-sub-admin.php?pid=<?php echo $users['user_id'];?>&amp;show=true" title="Edit"><img src="../images/edit.png" /></a></span>
                 <span style="margin-left:5px;"><a href="javascript:void(0)" onclick="delete_item('../action_control/get-action.php?rand=<?php echo $_SESSION['rand']; ?>&id=<?php echo $users['user_id'];?>&tbl=admin&return=user/index.php&field=user_id&action=DeleteUser&delete=true')" title="Delete"><img src="../images/Trashcan.png" /></a></span>

                  </td>
                </tr>
                <?php 
					$s_no++;
					endforeach;
				endif;
				?>
              </tbody>
            </table>
            
            <div class="widget-foot">
              <ul class="pagination pull-right">
              	<?php echo pagination($url,$query,$userss,$current_page); ?>
                <!--<li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>-->
              </ul>
              <div class="clearfix"></div>
            </div>
            
             <script type="text/javascript">
				// delete record
				delete_item = function(url){
					if(confirm("Do you want to delete this record")){
						window.location.href=url;
					}
				}
			</script>
            
             <script type="text/javascript">
				// delete record
				delete_item = function(url){
					if(confirm("Do you want to delete this record")){
						window.location.href=url;
					}
				}
			</script>
            
             
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
