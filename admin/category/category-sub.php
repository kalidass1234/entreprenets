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
      <h2 class="pull-left">Categories</h2>
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
                <div class="pull-left">Add Sub Category</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddCategory';
					$update = false;
					$category = '';
					
				  	if(isset($_GET['category_id'])){
						$category_id = $_GET['sub_category_id'];
						$icon = $_GET['icon'];
						$action = 'UpdateCategory';
						$category = $_GET['category_id'];
						$update = true;
					}
					
					$args_categories = $mxDb->get_information('max_sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');
					
				  ?>
                  
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Category Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="category_name" id="category_name" placeholder="Category name" data-bind="value: name" value="<?php if(isset($_GET['name'])): echo $_GET['name']; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Main Category</label>
                          	<select name="category_id">
                            <option value="0">-Select Category</option>
                            	<?php $Custom_obj->get_options($args_categories, 'category_id', 'category_name',$category, true);?>
                            </select>
                        	<input type="hidden" name="action" value="<?php echo $action; ?>"/>
                            <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                            
                            <?php if($update):?>
                            <input type="hidden" name="id" value="<?php echo $category_id; ?>"/>
                            <input type="hidden" name="old_icon" value="<?php echo $icon; ?>"/>
                            <?php endif; ?>
                            
                        </div>
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
<?php include('../footer.php'); ?>
