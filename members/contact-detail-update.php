<?php define('ABSPATH','../../lib/'); include('../header.php');  include('../pagination/pagination.php');

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
      <h2 class="pull-left">Text Update</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Text Update</a> </div>
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
            
          </div>
        </div>
           
            <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Text Update</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          
          <div class="widget-content">
                <div class="padd">
                  <?php
				        $id=$_GET['id'];
						// get about perseus				  	
						$action = 'UpdateAboutPerseus';
						$update = true;
						
						// get product information
						$where = " where id='$id'";
						$args_page = $mxDb->get_information('contactdetail', '*', $where, true, 'assoc');
						
						$pid = $_GET['id'];
					
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group">
                        
                        <div class="left-box">
                          <label for="name" >Page Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="post_title" id="post_title" value="<?php if(isset($args_page['page_name'])): echo $args_page['page_name']; endif;?>" placeholder="Title" data-bind="value: name" />
                          
                          <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                          
						  <?php if($update):?>
                          <input type="hidden" name="id" value="<?php echo $pid; ?>"/>
                          
                          <?php endif; ?>
                          
                        </div>
                      
                      <div class="clearfix"></div>
                      <h5 ><strong>Contents</strong></h5>
                       <?php
						    $text = '' ;
                            if(isset($args_page['description']))
                            {
                               $text = stripslashes($args_page['description']);
                               $texts = str_ireplace('src="','src="../',$text);
                            }
                       ?>
                       
                      <textarea id="editor2" name="post_content"><?php if(isset($texts)): echo $texts; endif;?></textarea>
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
                      
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="left-box"> <br />
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                  
                  <script type="text/javascript">
				  
				  	 // form validation 
					  var frmValidation = new Validator('form1');
					 
					  frmValidation.addValidation('post_title','req','Please enter Title');
					  frmValidation.addValidation('post_content','req','Please enter contents');
					  
				  </script>
                  
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
