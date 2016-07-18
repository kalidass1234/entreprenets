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
      <h2 class="pull-left">Activate Bank Transfer User</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Activate Bank Transfer User</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Activate Bank Transfer User</a> </div>
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
                <div class="pull-left">Activate Bank Transfer User</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  	$update = false;
				  
				  	if(isset($_GET['user_id'])){
						$user_id = $_GET['user_id'];
						mysql_query("update scan_copy set read_status='0' where id='$user_id'");
						// get product information
						$where = " where id='".$user_id."'";
						$args_member = $mxDb->get_information('scan_copy', '*', $where, true, 'assoc');
						$update = true;
					}
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data" >
                  <input type="hidden" name="action" value="ActivateBankWiredUser"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                            
                  <?php if($update):?>
                  <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
                  <?php endif; ?>
                  <?php $usr=$args_member['user_id']; $user_sponsor=mysql_fetch_array(mysql_query("select * from user_registration where user_id='$usr'")); $spon=$user_sponsor['ref_id'];?>
                    <fieldset>
                      <div class="form-group">
                        <h5 style="border-bottom:1px solid #999;"><strong>Review Info</strong></h5>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >User Id</label>
                          <div id="sub_category">
                            <input type="text" name="userid" class="validate[required] form-control placeholder" readonly value="<?php echo $args_member['user_id']; ?>">
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Reciept Number</label>
                          <div id="sub_category">
                          <input type="text" class="validate[required] form-control placeholder" name="reciept" readonly value="<?php echo $args_member['reciept_id']; ?>">
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                        
                          <div class="form-group">
                                               
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Package Name</label>
                          <div id="sub_category">
                           <?php echo $usr=$args_member['package']; ?>
                          </div>
                        </div>
                        
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Total Amount</label>
                          <div id="sub_category">
                          <?php echo $args_member['amount']; ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                                            
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Activate User</label>
                          <div id="sub_sub_category">
                            <select name="status" required class="validate[required] form-control placeholder"><option value="1" <?php if($args_member['status']=='1') { ?> selected <?php } ?>>Deactive</option><option value="0" <?php if($args_member['status']=='0') { ?> selected <?php } ?>>Active</option></select>
                          </div>
                        </div></div>   
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Sponsor Id</label>
                          <div id="sub_category">
                          <input type="text" class="validate[required] form-control placeholder" name="sponsor" readonly value="<?php echo $spon;?>">
                          </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                        
                        <div class="form-group">
                        <div class="left-box" id="show_sub_sub_category">
                          <label for="name" >Select If User Paid For Starter Kit </label>
                          <div id="sub_sub_category">
                            <input type="radio" name="starterkit" value="1" required> Yes <br/> <input type="radio" name="starterkit" value="0"> No 
                          </div>
                        </div></div>   
                        <div class="left-box" id="show_sub_category">
                          <label for="name" >Select If User Paid For Package</label>
                          <div id="sub_category">
                          <?php
						 $package_mode=mysql_query("select * from mx_package where status='0' and id!='5'");
						 while($package_mode1=mysql_fetch_array($package_mode))
						  { ?>
                          <input type="radio" name="pack_mode" value="<?php echo $package_mode1['id'];?>" required> <?php echo $package_mode1['name'];?>
                          <?php } ?>
                          <input type="radio" name="pack_mode" value="0" required> Not Added
                          </div>
                        </div>
                     </div>
                          <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                                                                   
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
