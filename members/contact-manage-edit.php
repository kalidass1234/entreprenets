<?php define('ABSPATH','../../lib/'); include('../header.php'); 
$point_id=$_GET['id'];
$point = $mxDb->get_information('contact_us','*',"where id='$point_id'",true,'array');


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
      <h2 class="pull-left">User Contact Manage</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">User Contact Manage</a> </div>
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
            
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">User Contact Manage</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data" >
                  <input type="hidden" name="action" value="updateRegistrationPoint"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                  <input type="hidden" name="id" value="<?php echo $point_id;?>"/>
                            
                    <fieldset>
                      <div class="form-group">
                       
                         <div class="left-box">
                          <label for="name"> Name:</label>
                         <?php echo $point['name'];?>
                        </div>
                        
                           <div class="left-box">
                          <label for="name"> Email:</label>
                         <a href="mailto:<?php echo $point['email'];?>"><?php echo $point['email'];?></a>
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Contact Number:</label>
                         <?php echo $point['number'];?>
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Subject:</label>
                         <?php echo $point['subject'];?>
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Message:</label>
                         <?php echo $point['message'];?>
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Posted Date:</label>
                         <?php echo $point['posted_date'];?>
                        </div>
                        
                        
                        <?php mysql_query("update contact_us set read_status='Read' where id='$point_id'");?>
                      </div>
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                    
                    </fieldset>
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
