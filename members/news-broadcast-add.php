<?php define('ABSPATH','../../lib/'); include('../header.php'); 

// get main cateogries
$args_categories = $mxDb->get_information('categories', '*', ' order by category_id asc',false, 'assoc');

// unset table name from session
if(isset($_SESSION['cat_tbl']))
	unset($_SESSION['cat_tbl']);

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
      <h2 class="pull-left">New Official Announcement Posting</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> New Official Announcement Posting</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">New Official Announcement Posting</a> </div>
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
                <div class="pull-left">New Official Announcement Posting</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  
				  	$action = 'AddNewsBroadcast';
					$update = false;
					
				  	if(isset($_GET['n_id'])){
						$product_id = $_GET['n_id'];
						$action = 'UpdateNewsBroadcast';
					
						
						$update = true;
						
						// get product information
						$where = " where n_id='".$product_id."'";
						$args_product = $args_products = $mxDb->get_information('promo', '*', $where, true, 'assoc');
					}
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      
                       <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                      <input type="hidden" name="id" value="<?php echo $product_id; ?>"/>
                     
                       <div class="left-box">
                          <label for="name"> News Title / Subject</label>
                          <input type="text" class="validate[required] form-control placeholder" name="title" id="title" placeholder="title" data-bind="value: name" value="<?php if(isset($args_product['news_name'])): echo $args_product['news_name']; endif;?>" />
                        </div>
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                      
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      <h5 ><strong>News Description</strong></h5>
                       <?php
						    $text = '' ;
                            if(isset($args_product['description']))
                            {
                               $text = stripslashes($args_product['description']);
                               $texts = str_ireplace('src="','src="../',$text);
                            }
                       ?>
                       
                      <textarea id="editor2" name="description"><?php if(isset($texts)): echo $texts; endif;?></textarea>
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
                         
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="left-box"> <br />
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                  
                  <script type="text/javascript">
				  
					var counter = parseInt(<?php echo $counter; ?>);
					
					Add_more = function(){
						$('<div id="more_'+counter+'"><div class="left-box"><label for="name"> Level</label><input type="text" id="levels_'+counter+'" class="validate[required] form-control placeholder" name="level[]" data-bind="value: name" /></div><div class="left-box"><label for="name"> Points</label><input type="text" id="points_'+counter+'" class="validate[required] form-control placeholder" name="point[]" data-bind="value: name" /></div> <div class="left-box"><button class="btn btn-danger side" onclick="remove_more('+counter+')"  type="button" id="button" style="float:left;" >Remove</button></div> <div class="clearfix"></div> </div>').appendTo("#level_point");
						counter++;
					}
					
					// remove product 
					remove_more = function(id){
						$("#levels_"+id).val('');
						$("#points_"+id).val('');
						$("#more_"+id).hide();
						$("#more_"+id).html('');
					}
				  
					  // form validation 
					  var frmValidation = new Validator('form1');
					  
					  <?php if(!isset($_GET['pid'])) : ?>
					  frmValidation.addValidation('category_id','dontselect=000');
					  <?php endif; ?>
					  
					  frmValidation.addValidation('name','req','Please enter product name');
					  frmValidation.addValidation('qty','req','Please enter product quantity');
					  frmValidation.addValidation('qty','decimal','Please enter numeric value with deciaml digit in product quantity');
					  frmValidation.addValidation('price','req','Please enter product price');
					  frmValidation.addValidation('price','decimal','Please enter numeric value with deciaml digit in product price');
					  frmValidation.addValidation('discount','req','Please enter product discount');
					  frmValidation.addValidation('discount','decimal','Please enter numeric value with deciaml digit in product discount');
				  	  frmValidation.addValidation('points','req','Please enter points');
					  frmValidation.addValidation('points','decimal','Please enter numeric value with deciaml digit in points');

					  <?php if(!isset($_GET['pid'])) : ?>
					  frmValidation.addValidation('image','file');
					  <?php endif; ?>
					  
					  frmValidation.addValidation('description','req','Please enter product description');
				  
				  </script>
                  
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
