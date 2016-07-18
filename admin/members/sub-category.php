<?php define('ABSPATH','../../lib/'); include('../header.php'); ?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('../nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Sub Categories</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
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
                  <form action="#" class="validate" id='form1'>
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
                          <input type="text" class="validate[required] form-control placeholder" id="category_name" placeholder="Category name" data-bind="value: name" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Status</label>
                          <select name="all" class="form-control placeholder" id="all">
                            <option value="1">All</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
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
           
      <a href="<?php echo SITE_URL; ?>admin/category/category-sub.php"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>
      
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
                  <th>Last Modify</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  
			  $args_categories = $mxDb->get_information('max_sub_categories', '*', ' order by sub_category_id desc',false, 'assoc');
			  
			  if($args_categories):
			  	$s_no = 1;
			  	foreach($args_categories as $category):
              ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php $mxDb->get_information('max_categories', 'category_name', ' where category_id=('.$category['category_id'].')order by sub_category_id desc', 'assoc', true); ?></td>
                  <td><?php echo ucwords($category['name']); ?></td>
                  <td><?php echo $category['date']; ?></td>
                  <td><?php echo $category['last_modify']; ?></td>
                  <td>&nbsp;
                  <span><a href="category.php?<?php echo http_build_query($category);?>" title="Edit"><img src="../images/edit.png" /></a></span>
                  <span style="margin-left:5px;"><a href="category.php?<?php echo http_build_query($category);?>" title="Delete"><img src="../images/Trashcan.png" /></a></span>
                  </td>
                </tr>
                <?php 
					endforeach;
				endif;
				?>
              </tbody>
            </table>
            <div class="widget-foot">
              <ul class="pagination pull-right">
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
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
