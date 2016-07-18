<?php include('header.php'); ?>
<!-- Main content starts -->
  <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Member Package</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">ADD Package</a> </div>
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
                <div class="pull-left">Add package</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddPackage';
					$update = false;
					
				  	if(isset($_GET['id']))
					{
						$user_id = $_GET['id'];
						$icon = $_GET['icon'];
						$action = 'Updatepackage';
						$update = true;
						$res=$obj_query->query("*","member_package","id='$user_id'");
						$row=$obj_query->get_all_row($res);
						$package_name=$row['package_name'];
						$amount=$row['package_amount'];
						$monthly_cost=$row['monthly_cost'];
						$promo_kit_cost=$row['promo_kit_cost'];
						$product_id=$row['product_id'];
						$product_volume=$row['product_volume'];
						$download_link=$row['download_link'];
						$description=$row['description'];
					}
				  ?>
                  <form action="submit.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Package Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="package_name" id="package_name" placeholder="Package Name" data-bind="value: name" value="<?php if(isset($package_name)): echo $package_name; endif; ?>" />
                          <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                          <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
                        </div>
                        <div class="left-box">
                          <label for="name"> Amount</label>
                          <input type="text" class="validate[required] form-control placeholder" name="package_amount" id="package_amount" placeholder="Amount" data-bind="value: name" value="<?php if(isset($amount)): echo $amount; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Monthly Cost</label>
                          <input type="text" class="validate[required] form-control placeholder" name="monthly_cost" id="monthly_cost" placeholder="Monthly Cost" data-bind="value: name" value="<?php if(isset($monthly_cost)): echo $monthly_cost; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Product Volume</label>
                          <input type="text" class="validate[required] form-control placeholder" name="product_volume" id="product_volume" placeholder="Product Volume" data-bind="value: name" value="<?php if(isset($product_volume)): echo $product_volume; endif; ?>" />
                        </div>
                        <!--<div class="left-box">
                          <label for="name"> Promo Kit Cost</label>
                          <input type="text" class="validate[required] form-control placeholder" name="promo_kit_cost" id="promo_kit_cost" placeholder="Promo Kit Cost" data-bind="value: name" value="<?php if(isset($promo_kit_cost)): echo $promo_kit_cost; endif; ?>" />
                        </div>-->
                        <div class="left-box">
                          <label for="name"> Product Code(Comma Seperated)</label>
                          <input type="text" class="validate[required] form-control placeholder" name="product_id" id="product_id" placeholder="Product Code" data-bind="value: name" value="<?php if(isset($product_id)): echo $product_id; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Download Link</label>
                          <input type="text" class="validate[required] form-control placeholder" name="download_link" id="download_link" placeholder="Download Link" data-bind="value: name" value="<?php if(isset($download_link)): echo $download_link; endif; ?>" />
                        </div>
                         <div class="clearfix"></div>
                         <div class="left-box">
                          <label for="name"> Package Description</label>
                          <textarea id="editor2" name="description" rows="15" cols="80" style="width: 80%"><?php echo $description; ?></textarea>
                       <script type="text/javascript">
                         // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor2',
                         {
                              filebrowserBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html',
                              filebrowserImageBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html?type=Images',
                              filebrowserFlashBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html?type=Flash',
                              filebrowserUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                              filebrowserImageUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                              filebrowserFlashUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                              filebrowserWindowWidth : '1000',
                              filebrowserWindowHeight : '700'
                         });
                         </script>

                        </div>
                      </div>
                       <div class="clearfix"></div>
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