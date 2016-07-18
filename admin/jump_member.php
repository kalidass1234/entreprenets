<?php
include('header.php');
include("pagination.php");
?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <?php
  $arr=array("final_e_wallet"=>"Cash Wallet","final_tp"=>"TP Wallet","final_tfs"=>"TFS Wallet");
			$arr_history=array("final_e_wallet"=>"credit_debit","final_tp"=>"final_tp_history","final_tfs"=>"final_tfs_history");
  ?>
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Member Wallet</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb "> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Wallet</a> </div>
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
                <div class="pull-left">Jump Member Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="submit.php" class="validate" method="post" id='form1'>
                  <input type="hidden" name="action" value="jump_member" />
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> User Id/User Name</label>
   							<input type="text" class="validate[required] form-control placeholder" name="user_name" value="<?php echo $_POST['user_name'];?>" id="user_name" placeholder="User Id/ User name" data-bind="value: name" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Type</label>
                          <select name="type" required class="validate[required] form-control placeholder">
                          	<option value="">Select Type</option>
                          	<option value="affliate">Affiliate</option>
                            <option value="reseller">Reseller</option>
                          </select>
                        </div>
                      </div>
               
                      <div class="form-group">
                        <div class="left-box">
                          <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="clearfix"></div>
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