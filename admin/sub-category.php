<?php 
	include('header.php');
	include("pagination.php");
?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Sub Categories</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Sub Category</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
        
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Sub Categories Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" method="post" class="validate" id='form1'>
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box  input-append" id="datetimepicker1">
                          <label for="date">Date From</label>
                          <input data-format="yyyy-MM-dd" type="date" class="form-control dtpicker">
                        </div>
                        <div class="left-box  input-append" id="datetimepicker1">
                          <label for="date">Date to</label>
                          <input data-format="yyyy-MM-dd" type="date" class="form-control dtpicker">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Sub Category Name</label>
                          <input type="text" class="validate[required] form-control placeholder" id="category_name" placeholder="SubCategory name" data-bind="value: name" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Status</label>
                          <select name="status" class="form-control placeholder" id="all">
                          <option value="0">Active</option>
                            <option value="1">Inactive</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
           
      <a href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=12"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>
      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Sub Category List</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Category Name</th>
                  <th>Sub Category Name</th>
                  <th>Date</th>
                 <!-- <th>Last Modify</th>-->
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1)
			{
				$sub_id=$_REQUEST['id'];
				$obj_query->query_execute("delete from subcategory where sub_id='$sub_id'");
			}
			  if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['category_name']) && $_REQUEST['category_name']!='')
				{
					$search_string.=" and sub_name like '%$category_name%'";
					$query_string.="&category_name='$category_name'";
				}
				if(isset($_REQUEST['status']) && $_REQUEST['status']!='')
				{
					$search_string.=" and status='$status'";
					$query_string.="&status='$status'";
				}
				if((isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='') && (isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=''))
				{
					$search_string.=" and (date>='$from_date' and date<='$to_date' )";
					$query_string.="&from_date='$from_date'&to_date='$to_date'";
				}
				else if(isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='')
				{
					$search_string.=" and date>='$from_date'";
					$query_string.="&from_date='$from_date'";
				}
				else if(isset($_REQUEST['to_date']) && $_REQUEST['to_date']!='')
				{
					$search_string.=" and date<='$to_date'";
					$query_string.="&to_date='$to_date'";
				}
			}
			  if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=11&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=11&'.$search_string;
			}
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
			$per_page=10;
			if($per_page != "all"){
				$per_page_rec = $per_page;
				$pageno--;
				$start = (int)($pageno*$per_page_rec);
				$last = $per_page_rec;
				$limit = "limit $start , $last";
			}
			else
			$limit = " ";
			  $res_products_tol=$obj_query->query("sub_id","subcategory","1=1 $search_string $con_search  ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
			 $res_subcategory=$obj_query->query("*","subcategory","1=1 $search_string $con_search order by sub_name $limit ");
			 //$args_categories = $mxDb->get_information('max_sub_categories', '*', ' order by sub_category_id desc',false, 'assoc');
			 $s_no = 1;
			 while($row_subcategory=$obj_query->get_all_row($res_subcategory))
			 {
			 ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo $obj_query->get_field_name("category_shop","category_name","c_id='$row_subcategory[cat_id]'"); ?></td>
                  <td><?php echo ucwords($row_subcategory['sub_name']); ?></td>
                  <td><?php echo $row_subcategory['date']; ?></td>
                  <!--<td><?php echo $category['last_modify']; ?></td>-->
                  <td>&nbsp;
                  <span><a href="admin_main.php?page_number=12&sub_id=<?php echo $row_subcategory['sub_id'];?>&sub_name=<?php echo $row_subcategory['sub_name'];?>&category_id=<?php echo $row_subcategory['cat_id'];?>" title="Edit"><img src="../images/edit.png" /></a></span>
                  <span style="margin-left:5px;"><a href="admin_main.php?page_number=11&delete=1&id=<?php echo $row_subcategory['sub_id'];?>" onclick="if(confirm('Do You Want To Delete')){ return true;}else{ return false;}" title="Delete"><img src="../images/Trashcan.png" /></a></span>
                  </td>
                </tr>
                <?php 
					$s_no++;
					}
				?>
              </tbody>
            </table>
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
<?php include('footer.php'); ?>
