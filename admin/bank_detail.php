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
                  <div class="pull-left">Bank Detail</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <?php
					$res=$obj_query->query("*","bank_detail","1=1");
					$row=$obj_query->get_all_row($res);
					$type=$row['type'];
					$id=$row['id'];
					$account_no=$row['account_no'];
					$account_name=$row['account_name'];
					$bank_name=$row['bank_name'];
					$branch_name=$row['branch_name'];
					$swift_code=$row['swift_code'];
					$ifsc_code=$row['ifsc_code'];
				  ?>
                    <form action="submit.php" class="validate" id='form1' method="post">
                      <input type="hidden" name="action" value="Payment_Bank"> 
                      <input type="hidden" name="id" value="<?php echo $id;?>"> 
                      <fieldset>
                        <div class="form-group">
                            <label for="name">Type</label>
                              <select name="type" class="validate[required] form-control placeholder">
                                <option value="bank_wire" >Bank Wire</option>
                              </select>
                          </div>
                        <div class="form-group">
                            <label for="name"> Account Name</label>
                            <input type="text" class="validate[required] form-control placeholder" name="account_name" value="<?php echo $account_name;?>" placeholder="Account Name" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Account No</label>
                         <input type="text" class="validate[required] form-control placeholder" name="account_no" value="<?php echo $account_no;?>" placeholder="Account No" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Sort Code</label>
                         <input type="text" class="validate[required] form-control placeholder" name="bank_name" value="<?php echo $bank_name;?>" placeholder="Bank Name" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">Bank address</label>
                         <input type="text" class="validate[required] form-control placeholder" name="branch_name" value="<?php echo $branch_name;?>" placeholder="Branch Name" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">SWIFT/BIC</label>
                         <input type="text" class="validate[required] form-control placeholder" name="swift_code" value="<?php echo $swift_code;?>" placeholder="Swift Code" data-bind="value: name" />
                        </div>
                        <div class="form-group">
                         <label for="name">IBAN</label>
                          <input type="text" class="validate[required] form-control placeholder" name="ifsc_code" value="<?php echo $ifsc_code;?>" placeholder="IFSC Code" data-bind="value: name" />
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