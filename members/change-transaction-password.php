<?php define('ABSPATH','../../lib/'); include('../header.php'); 

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
      <h2 class="pull-left">Change Admin Transaction Password</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Change Password</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Change Password</a> </div>
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
                <div class="pull-left">Change Password</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
                   <form class="form-horizontal" action="../action_control/post-action.php" method="post" id="form1" name="form1">
                  <input type="hidden" name="action" value="EditTransactionPasswordSection">
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                                  
                    <!-- Email --><?php @$message=$_GET['msg']; if($message!='') { ?>
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail"></label>
                      <div class="col-lg-9">
                        <span style="color:#F00;"><?php  echo $message;?> </span>
                      </div>
                    </div> <?php } ?>
                    
                                        <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">Old Password</label>
                      <div class="col-lg-9">
                        <input type="password" name="oldpassword" class="form-control" id="inputEmail" value="" required>
                      </div>
                    </div>
                    
                    
                     <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">New Passsword</label>
                      <div class="col-lg-9">
                        <input type="password" name="newpassword" class="form-control" id="inputEmail"  value=""  required>
                      </div>
                    </div>
                    
                    
                     <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">Confirm New Password</label>
                      <div class="col-lg-9">
                        <input type="password" name="retypepassword" class="form-control" id="inputEmail"  value=""  required>
                      </div>
                    </div>
                   
                        <div class="col-lg-9 col-lg-offset-3">
							<button type="submit" class="btn btn-danger">Update</button>
							
						</div>
                    <br />
                  </form>
                  
                  <!--<script type="text/javascript">
				  
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
				  
				  </script>-->
                  
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
