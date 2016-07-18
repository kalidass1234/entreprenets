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
      <h2 class="pull-left">Fund Transfer</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Add Fund</a> </div>
      <div class="clearfix"></div>
      <div class="error_page">
       <div class="error">
       	<h1 class="green"><?php echo $_GET['msg'];?></h1>
       </div>
      </div>
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
                <div class="pull-left">Add Fund</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddFund';
					$update = false;
					
				  	if(isset($_GET['user_id'])){
						$user_id = $_GET['user_id'];
						$icon = $_GET['icon'];
						$action = 'UpdateFund';
						$update = true;
					$amount=$obj_query->get_field_name("funal_e_wallet","amount","user_id='$user_id'");
					}
				  ?>
                  
                  <form action="submit.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> User Id / User Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="user_name" id="user_name" placeholder="User Id/ User name" data-bind="value: name" value="<?php //if(isset($user_id)): echo $user_id; endif; ?>" />
                          <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                          <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
                           <input type="hidden" name="country_id" value="<?php echo $country_id; ?>"/>
                            <input type="hidden" name="country_name" value="<?php echo $country_name; ?>"/>
                             <input type="hidden" name="admin_type" value="<?php echo $admin_type; ?>"/>
                        </div>
                        <div class="left-box">
                          <label for="name"> Amount</label>
                          <input type="text" class="validate[required] form-control placeholder" name="amount" id="amount" placeholder="Amount" data-bind="value: name" value="<?php if(isset($amount)): echo $amount; endif; ?>" />
                        </div>
                        <!--<div class="left-box">
                          <label for="name" >Category Icon</label>
                          	<input type="file" name="icon" />
                        	<input type="hidden" name="action" value="<?php echo $action; ?>"/>
                            <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                            <?php if($update):?>
                            <input type="hidden" name="id" value="<?php echo $category_id; ?>"/>
                            <input type="hidden" name="old_icon" value="<?php echo $icon; ?>"/>
                            <?php endif; ?>
                        </div>-->
                      </div>
                     <!-- <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Wallet Type</label>
                          <select name="wallet_type" required class="validate[required] form-control placeholder">
                          <option value="">Select Wallet</option>
                          	<?php //$obj_function->_get_wallet_type($_POST['wallet_type']);?>
                          </select>
                        </div>
                        
                        
                      </div>-->
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