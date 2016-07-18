<?php include('header.php'); ?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Categories</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Main Category</a> </div>
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
                <div class="pull-left">Add Category</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddCmsBackOfficeSubCategory';
					$update = false;
					
				  	if(isset($_GET['category_id'])){
						$category_id = $_GET['category_id'];
						$icon = $_GET['icon'];
						$action = 'UpdateCmsBackOfficeSubCategory';
						$update = true;
					$category_name=$obj_query->get_field_name("cms_subcategory_backoffice","category_name","id='$category_id'");
					$category_ids=$obj_query->get_field_name("cms_subcategory_backoffice","category_id","id='$category_id'");
					$link=$obj_query->get_field_name("cms_subcategory_backoffice","link","id='$category_id'");
						$link_status=$obj_query->get_field_name("cms_subcategory_backoffice","link_status","id='$category_id'");
						$target=$obj_query->get_field_name("cms_subcategory_backoffice","target","id='$category_id'");
					}
				  ?>
                  
                  <form action="submit.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group">
                      <div class="left-box">
                          <label for="name"> Category </label>
                           <select name="category_id" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
						$obj_function->_get_cms_category_backoffice_dropdown($category_ids);
						?>
                        </select>
                          <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                          <input type="hidden" name="id" value="<?php echo $category_id; ?>"/>
                        </div>
                        <div class="left-box">
                          <label for="name"> Sub Category Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="category_name" id="category_name" placeholder="Category name" data-bind="value: name" value="<?php if(isset($category_name)): echo $category_name; endif; ?>" />
                         
                        </div>
                      </div>
                      </div>
                      <div class="clearfix"></div>
                        <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Link Status</label>
                          	<select name="link_status" class="validate[required] form-control placeholder">
                            	<option value="0" <?php if($link_status==0){ echo "selected";}?>>Active</option>
                                <option value="1" <?php if($link_status==1){ echo "selected";}?>>Inactive</option>
                            </select> 
                        </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Link</label>
                          	<input type="text" name="link" class="validate[required] form-control placeholder" value="<?php echo $link;?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Open Type</label>
                          	<select name="target" class="validate[required] form-control placeholder">
                            	<option value="_blank" <?php if($target=='_blank'){ echo "selected";}?>>_blank</option>
                                <option value="_parent" <?php if($target=='_parent'){ echo "selected";}?>>_parent</option>
                                <option value="_self" <?php if($target=='_self'){ echo "selected";}?>>_self</option>
                                <option value="_top" <?php if($target=='_top'){ echo "selected";}?>>_top</option>
                            </select> 
                        </div>
                       <div class="clearfix"></div>
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
