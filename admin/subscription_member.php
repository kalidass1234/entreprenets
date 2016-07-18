<?php include('header.php');
include("pagination.php");
 ?>
<!-- Main content starts -->
<script src="../dist/country.js"></script>
<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left">Dashboard</h2>
        <div class="pull-right">
           <div id="reportrange" class="pull-right">
              <i class="fa fa-calendar"></i>
              <span></span> <b class="caret"></b>
           </div>
        </div>
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Dashboard</a>
        </div>
        <div class="clearfix"></div>
	    </div>
	    <!-- Page heading ends -->
	    <!-- Matter -->
	    <div class="matter">
        <div class="container">
         
          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Member Subscription List</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>C.bx</th>
                          <th>S.no.</th>
                          <th>Member Id</th>
                          <th>User Name</th>
                          <th>Fee</th>
                          <th>Sponser ID</th>
                          <th>Sponser Name</th>
                          <th>Subscription Date</th>
                          <th>Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
						<?php
						//echo "<pre>"; print_r($_REQUEST);
						if(isset($_REQUEST['search']))
						{
							extract($_REQUEST);
							if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
							{
								$search_string.=" and user_id='$user_id'";
								$query_string.="&user_id='$user_id'";
							}
							if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
							{
								$search_string.=" and user_name='$user_name'";
								$query_string.="&user_name='$user_name'";
							}
							if(isset($_REQUEST['mem_status']) && $_REQUEST['mem_status']!='')
							{
								$search_string.=" and mem_status='$mem_status'";
								$query_string.="&mem_status='$mem_status'";
							}
							if(isset($_REQUEST['email']) && $_REQUEST['email']!='')
							{
								$search_string.=" and email='$email'";
								$query_string.="&email='$email'";
							}
							if(isset($_REQUEST['state']) && $_REQUEST['state']!='')
							{
								$search_string.=" and state='$state'";
								$query_string.="&state='$state'";
							}
							if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!='')
							{
								$search_string.=" and mobile='$mobile'";
								$query_string.="&mobile='$mobile'";
							}
						}
						if(isset($_REQUEST['search']))
						{
							$query_string=http_build_query($_REQUEST);
							$url='admin_main.php?page_number=157&'.$query_string;
						}
						else
						{
							$url='admin_main.php?page_number=157&'.$search_string;
						}
						//echo $search_string;
						//$url='member_list.php?';
						if(isset($_GET['page']) && $_GET['page']!='' && is_numeric($_GET['page']))
						{
							$current_page=$_GET['page'];
						}
						else
						{
							$current_page = 1;
						}
						//echo $current_page;
						$pageno = $current_page;
						$per_page=20;
						if($per_page != "all"){
							$per_page_rec = $per_page;
							$pageno--;
							$start = (int)($pageno*$per_page_rec);
							$last = $per_page_rec;
							$limit = "limit $start , $last";
						}
						else
							$limit = " ";
						//echo $limit;
                        $res=$obj_query->query("*","subscription_member","1=1 $search_string $limit");
						$res_products_tol=$obj_query->query("id","subscription_member","1=1 $search_string $con_search ");
						$total_row=$obj_query->num_row($res_products_tol);
						$pages = ceil($total_row/$per_page);
						$sno=1;
						while($row=$obj_query->get_all_row($res))
						{
							// get user sponsor
							$user=$row['user_id'];
							$res_user=$obj_query->query("*","registration","user_id='$user'");
							$row_user=$obj_query->get_all_row($res_user);
							//$row['ref_id']
						?>
                        <tr>
                          <td><input  type="checkbox"  value="<?php echo $row['user_id'];?>" /></td>
                          <td><?php echo $sno;?></td>
                          <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $row_user['user_name'];?></td>
                          <td><?php echo $row['subs_fee'];?></td>
                          <td><?php echo $row_user['ref_id'];?></td>
                          <td><?php echo $obj_query->get_field_name("registration","user_name"," user_id='$row_user[ref_id]'");?></td>
                          <td><?php echo $row['subs_date'];?></td>
                          <td><?php if($row['status']){ echo "Inactive";} else if($row['status']){ echo "Active";}?></td>
                        </tr>
						<?php
						$sno++;
                        }
						?>
                      </tbody>
                    </table>
                    <div class="export"><a href="#">Export in excel</a></div>
                    <div class="widget-foot">
                    <?php echo pagination($url,$parameters,$pages,$current_page);?>
                        <!--<ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>-->
                      <div class="clearfix"></div> 
                    </div>
                  </div>
                </div>
        </div>
		<!-- Matter ends -->
    </div>
    </div>
  <!-- Matter ends --> 
</div>
<!-- Mainbar ends --> 
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->
<?php include('footer.php'); ?>