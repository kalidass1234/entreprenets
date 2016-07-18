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
      <h2 class="pull-left">Fund Management</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Fund Management</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Fund Management</a> </div>
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
                <div class="pull-left">Fund Management</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  	$update = false;
				  
				  	if(isset($_GET['user_id'])){
						$user_id = $_GET['user_id'];
						// get product information
						$where = " where user_id='".$user_id."'";
						$args_member = $mxDb->get_information('final_e_wallet', '*', $where, true, 'assoc');
						$update = true;
					}
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data" >
                  <input type="hidden" name="action" value="FundManagement"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                            
                  <?php if($update):?>
                  <input type="hidden" name="id" value="<?php echo $args_member['user_id']; ?>"/>
                  <?php endif; ?>
                  
                    <fieldset>
                      <div class="form-group">
                        <h5 style="border-bottom:1px solid #999;"><strong>Review Info</strong></h5>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >User Id</label>
                          <div id="sub_category">
                            <?php echo $args_member['user_id']; ?>
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Total Amount In Ewallet</label>
                          <div id="sub_category">
                           $ <?php echo $args_member['amount']; ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                                                   
                                                   
                                                     
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Select Transaction Type</label>
                          <div id="sub_sub_category">
                            <input type="radio" name="ttype" id="ttype" data-bind="value: name" value="Credit" checked /> Credit amount to this user ewallet<br/>
                            <input type="radio" name="ttype" id="ttype" data-bind="value: name" value="Debit" /> Debit amount from this user ewallet
                          </div>
                        </div></div>
                        <div class="form-group">
                        
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Short Transaction Title</label>
                          <div id="sub_sub_category">
                            <input type="text" class="validate[required] form-control placeholder" name="title" id="title" data-bind="value: name" value="" />
                          </div>
                        </div></div>
                          <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                         <div class="form-group">
                         <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Enter Amount In Integer only</label>
                          <div id="sub_sub_category">
                            <input type="text" class="validate[required] form-control placeholder" name="amount" id="amount" data-bind="value: name" value="" />
                          </div>
                        </div>
                        
                        
                        
                         <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Enter Your Transaction Password</label>
                          <div id="sub_sub_category">
                            <input type="password" class="validate[required] form-control placeholder" name="password" id="password" data-bind="value: name" value="" />
                          </div>
                        </div>
                        
                        
                        
                        
                        </div>
                        
                        <div class="form-group">
                        
                              <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Transaction Detail Description</label>
                          <div id="sub_sub_category">
                            <textarea class="validate[required] form-control placeholder" name="description" style="width:950px;height:150px;" id="description" data-bind="value: name" /></textarea>
                          </div>
                        </div></div>
                        
                        
                        
                       <?php /*?>  <div class="left-box">
                          <label for="name">Branch Name</label>
                          <input type="password" class="validate[required] form-control placeholder" name="password1" id="password1" data-bind="value: name" value="<?php if(isset($args_member['branch_nm'])): echo $args_member['branch_nm']; endif;?>" />
                        </div><?php */?>
                     
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                      <div class="form-group">
                        <div class="left-box"> <br />
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
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
