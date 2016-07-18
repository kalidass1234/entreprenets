<?php
include("header.php");
?>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <?php 
	include("nav.php");
	?>
    <!-- Sidebar ends -->

  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left">Dashboard</h2>
        <div class="pull-right">
           <div id="reportrange" class="pull-right">
              <i class="fa fa-calendar"></i>
              <span></span> <b class="caret"></b>
           </div>
        </div>
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Dashboard</a>
        </div>
        <div class="clearfix"></div>
	    </div>
	    <!-- Page heading ends -->
	    <!-- Matter -->
	    <div class="matter">
        <div class="container">
         <div class="row">
            <div class="col-md-12 float">
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Paypal</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <?php
				  if(isset($_GET['id']) && $_GET['id'])
				  {
                  	$id=$_GET['id'];
					$res=$obj_query->query("*","payment_methods","id='$id'");
					$row=$obj_query->get_all_row($res);
					$type=$row['type'];
					$merchant_account=$row['merchant_account'];
					$production_url=$row['production_url'];
					$return_url=$row['return_url'];
					$cancel_url=$row['cancel_url'];
					$notify_url=$row['notify_url'];
					$test_merchant_account=$row['test_merchant_account'];
					$test_url=$row['test_url'];
					$mode=$row['mode'];
					$status=$row['status'];
				  }
				  ?>
                    <form action="submit.php" class="validate" id='form1' method="post">
                      <input type="hidden" name="action" value="Payment_Methods"> 
                      <input type="hidden" name="id" value="<?php echo $id;?>"> 
                      <fieldset>
                        <div class="form-group">
                            <label for="name">Type</label>
                              <select name="type" class="validate[required] form-control placeholder">
                                <?php $obj_function->_get_payment_type($type);?>
                              </select>
                          </div>
                        <div class="form-group">
                            <label for="name"> Merchant ID</label>
                            <input type="text" class="validate[required] form-control placeholder" name="merchant_account" value="<?php echo $merchant_account;?>" placeholder="Merchant ID" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Production Server URL</label>
                         <input type="text" class="validate[required] form-control placeholder" name="production_url" value="<?php echo $production_url;?>" placeholder="Production Server URL" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Return Server URL</label>
                         <input type="text" class="validate[required] form-control placeholder" name="return_url" value="<?php echo $return_url;?>" placeholder="Return Server URL" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Cancel Server URL</label>
                         <input type="text" class="validate[required] form-control placeholder" name="cancel_url" value="<?php echo $cancel_url;?>" placeholder="Cancel Server URL" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Notify Server URL</label>
                         <input type="text" class="validate[required] form-control placeholder" name="notify_url" value="<?php echo $notify_url;?>" placeholder="Notify Server URL" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Test Account</label>
                          <input type="text" class="validate[required] form-control placeholder" name="test_merchant_account" value="<?php echo $test_merchant_account;?>" placeholder=" Test Account" data-bind="value: name" />
                    	</div>
                       
                        <div class="form-group">
                         <label for="name"> Test Server URL</label>
                            <input type="text" class="validate[required] form-control placeholder" name="test_url" value="<?php echo $test_url;?>" placeholder=" Test Server URL" data-bind="value: name" />
                        </div>
                         <div class="form-group">
                            <label for="name">Mode</label>
                            <select name="mode" class="validate[required] form-control placeholder">
                             <?php $obj_function->_get_payment_mode($mode);?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select name="status" class="validate[required] form-control placeholder">
                             <?php $obj_function->_get_payment_status($status);?>
                            </select>
                        </div>
                        <div class="form-group">
                          <div class="left-box right-side">
                            <button class="btn btn-danger side "  type="submit" id="button" >Save</button>
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
		<!-- Matter ends -->
    </div>
    </div>
    </div>
    </div>
   <!-- Mainbar ends -->
   
<!-- Content ends -->

<!-- Footer starts -->
<?php
include("footer.php");
?>