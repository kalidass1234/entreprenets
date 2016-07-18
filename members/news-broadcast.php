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
      <h2 class="pull-left">News Broadcast for Registered User</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> News Broadcast</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">News Broadcast for User Panel</a> </div>
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
        
            <!--<div class="widget">
             <div class="widget-head">
                <div class="pull-left">Search Data</div>
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
                          <label for="name"> User Name</label>
                          <input type="text" class="validate[required] form-control placeholder" id="user_name" name="user_name" placeholder="User Name" data-bind="value: name" />
                        </div>
                        
                  
                   
                        <div class="left-box">
                          <label for="name"> User Id</label>
                          <input type="text" class="validate[required] form-control placeholder" id="user_id" name="user_id" placeholder="User Id" data-bind="value: name" />
                        </div>
                        
                      </div>
                      
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Ticket Number</label>
                          <input type="text" class="validate[required] form-control placeholder" id="ticket_no" name="ticket_no" placeholder="Ticket Number" data-bind="value: name" />
                        </div>
                        
                      </div>
                      <div class="form-group">
                        
                        <div class="left-box">
                         <br>
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>-->
          </div>
        </div>
           
<!--      <a href="<?php //echo SITE_URL; ?>admin/category/category-sub-sub.php"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>
-->      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Official Announcement</div>
            <div class="widget-icons pull-right"><a href="news-broadcast-add.php">Add New</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Announcement Subject</th>
                  <th>Announcement Date </th>
                
                 
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  
			 // store query
			  $query = '';
			  
			   // set url
			  $url = SITE_URL.'admin/members/news-broadcast.php?';
		  
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
				  
				  $condition = " where status=0";
				 // get reocrd from data to To date 
				
				
							
				
				$args_members = $mxDb->get_information('promo', '*', $condition.' order by n_id desc '.$limit,false, 'assoc');
				$args_total_member = $mxDb->get_information('promo', 'count(*) as total', $condition.' order by n_id desc ',true, 'assoc');
							
			  }
			  else
			  {
				$condition = "where status=0";   
			  	$args_members = $mxDb->get_information('promo', '*', $condition.' order by n_id desc '.$limit,false, 'assoc');
				$args_total_member = $mxDb->get_information('promo', 'count(*) as total', $condition.' order by n_id desc ',true, 'assoc');
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
                   <td><?php echo $member['news_name']; ?></td>
               
                   <th><?php echo $member['n_date']; ?></th>
                 
                  <td>&nbsp;
				  <span style="margin-left:5px;"><a href="<?php echo SITE_URL; ?>admin/members/news-broadcast-add.php?<?php echo http_build_query($member);?>" title="View Detail"><img src="../images/edit.png" /></a></span>
                  <span style="margin-left:5px;"><a href="javascript:void(0)" onclick="delete_item('../action_control/get-action.php?rand=<?php echo $_SESSION['rand']; ?>&id=<?php echo $member['n_id'];?>&tbl=promo&return=members/news-broadcast.php&field=n_id&action=DeleteRecord&delete=true')" title="Delete"><img src="../images/Trashcan.png" /></a></span>
                 

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
