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
      <h2 class="pull-left">Support System</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Support System</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Close Ticket Response</a> </div>
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
                <div class="pull-left">Support System</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  	$update = false;
				  
				  	if(isset($_GET['id'])){
						$user_id = $_GET['id'];
						// get product information
						$where = " where id='".$user_id."'";
						$args_member = $mxDb->get_information('tickets', '*', $where, true, 'assoc');
						
						$update = true;
					}
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data" >
                  <input type="hidden" name="action" value="updatecloseticketresponse"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                            
                  <?php if($update):?>
                  <input type="hidden" name="id" value="<?php echo $args_member['id']; ?>"/>
                  <?php endif; ?>
                  
                    <fieldset>
                      <div class="form-group">
                        <h5 style="border-bottom:1px solid #999;"><strong>Message Info</strong></h5>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Ticket Number</label>
                          <div id="sub_category">
                            <?php echo $args_member['ticket_no']; ?>
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >User Name</label>
                          <div id="sub_category">
                           <?php echo $args_member['user_name']; ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >User Id</label>
                          <div id="sub_category">
                            <?php echo $args_member['user_id']; ?> 
                          </div>
                        </div>
                        
                         <div class="left-box" id="show_sub_category">
                          <label for="name" >Category Type</label>
                          <div id="sub_category">
                           <?php echo $args_member['tasktype']; ?> 
                          </div>
                        </div>
                        
                         <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                       
                        
                         <div class="left-box" id="show_sub_category">
                          <label for="name" >Subject</label>
                          <div id="sub_category">
                            <?php echo $args_member['subject']; ?> 
                          </div>
                        </div>
                        
                                                 
                        <div class="left-box" id="show_sub_category" >
                          <label for="name" >Posted Date</label>
                          <div id="sub_category">
                              <?php echo $args_member['t_date']; ?> 
							</div>
                        </div>
                        
                         <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                       
                        
                         <div class="left-box" id="show_sub_category">
                          <label for="name" >Description</label>
                          <div id="sub_category">
                            <?php echo $args_member['description']; ?> 
                          </div>
                        </div>
                        
                      
<div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
           	  

        
                        
                         <h5 style="border-bottom:1px solid #999;"><strong>Response to user</strong></h5>
                         
                        
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Response Description</label>
                          <div id="sub_sub_category">
                            <?php echo $args_member['response']; ?>
                          </div>
                        </div>
                        
                        
                        
                       <?php /*?>  <div class="left-box">
                          <label for="name">Branch Name</label>
                          <input type="password" class="validate[required] form-control placeholder" name="password1" id="password1" data-bind="value: name" value="<?php if(isset($args_member['branch_nm'])): echo $args_member['branch_nm']; endif;?>" />
                        </div><?php */?>
                     
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
