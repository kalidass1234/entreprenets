<?php 
include('header.php');
include("pagination.php");
//include("../controller/commision.php");
 ?>
<!-- Main content starts -->
<script src="../dist/country.js"></script>
<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
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
            <div class="col-md-12">
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Member Upline Detail</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="submit.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="" />
                  <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" />
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Sponser Name:</label>
                           <?php echo $row['ref_id']; ?>
                        </div>
                        <div class="left-box">
                          <label for="name" >Sponser Id:</label>
                           <?php echo $row['ref_id']; ?>
                        </div>
                      </div>
                     <div class="clear" style="clear:both; border-bottom:1px dotted"></div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Upline Name:</label>
                           <?php echo $row['nom_id']; ?>
                        </div>
                        <div class="left-box">
                          <label for="name" >Upline Id:</label>
                           <?php echo $row['nom_id']; ?>
                        </div>
                      </div>
                      <div class="clear" style="clear:both; border-bottom:1px dotted"></div>
                     <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Total Ewallet:</label>
                           <?php echo $obj_function->_get_wallet_amount($user_id,'final_e_wallet'); ?>
                        </div>
                        <?php
							$sqls="select nom_id,package_id from registration where (user_id='".$user_id."' OR user_name ='$user_id')";
							$ress=mysql_query($sqls);
							$rowa=mysql_fetch_assoc($ress);
							
							$countNomTotal = $Commission->countNomTotal($user_id);

							if($countNomTotal[0]!='cmp')
							{
								$ccc =  count($countNomTotal);
							}
							else
							{
								$ccc = '0';	
							}
							$selectPackageInfoOfRegisterdUser="SELECT package_name,total_price FROM package WHERE package_id='".$rowa['package_id']."'";
							$executePackageInfoOfRegisterdUser = mysql_query($selectPackageInfoOfRegisterdUser);
							$fetchPackageInfoOfRegisterdUser = mysql_fetch_array($executePackageInfoOfRegisterdUser);
							$packageName = $fetchPackageInfoOfRegisterdUser['package_name'];
							$totalPrice = $fetchPackageInfoOfRegisterdUser['total_price'];
						?>
<!--                         <div class="left-box">
                          <label for="name" >Total Downline:</label>
                           <?php echo $ccc; ?>
                        </div>-->
                      </div>

                      <div class="clear" style="clear:both; border-bottom:1px dotted"></div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Total Direct Member:</label>
                           <?php echo $obj_function->_get_direct_count($user_id); ?>
                        </div>
                       <div class="left-box">
                          <label for="name" >Package:</label>
                           <?php echo $packageName."(Rs-".$totalPrice.")"; ?>
                        </div>
                      </div>
                      <div class="clear" style="clear:both; border-bottom:1px dotted"></div>
                      <div class="form-group">
<!--                        <div class="left-box">
                          <label for="name" >Track Password:</label>
                           <a href="admin_main.php?page_number=3&user_name=<?php echo $user_id;?>&submit=true">Track Password</a>
                        </div>-->
<!--                        <div class="left-box">
                          <label for="name" >View Downline:</label>
                           <a href="admin_main.php?page_number=5&user_id=<?php echo $user_id;?>&search=true">View Downline</a>
                        </div>-->
                      </div>
                     <!-- <div class="clear" style="clear:both; border-bottom:1px dotted"></div>-->
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
              <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Edit Member Detail</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="submit.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="edit_user_detail" />
                  <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" />
                    <fieldset>
                      
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >First Name:</label>
                           <input type="text" name="first_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['first_name']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Last Name:</label>
                           <input type="text" name="last_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['last_name']; ?>" />
                        </div>
                      </div>
                       <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>   
                       
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Edit Secuirity Details</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="submit.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="edit_user_secure" />
                  <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" />
                    <fieldset>
                      
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Email:</label>
                           <input type="text" name="email" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['email']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Username:</label>
                           <input type="text" name="user_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['user_name']; ?>" />
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Password:</label>
                           <input type="password" name="user_pass" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['user_pass']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Transaction Password:</label>
                           <input type="password" name="t_code" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['t_code']; ?>" />
                        </div>
                      </div>
                      
                       <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>   
                       
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
            
            
<div class="widget">
             <div class="widget-head">
                <div class="pull-left">Edit Other Details</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="submit.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="edit_user_secure" />
                  <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" />
                    <fieldset>
                      
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Country :</label>
                           <input type="text" name="country" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['country']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >State:</label>
                           <input type="text" name="state" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['state']; ?>" />
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Street - 1:</label>
                           <input type="text" name="street1" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['street1']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Street - 2:</label>
                           <input type="text" name="street2" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['street2']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Zip</label>
                           <input type="text" name="zip" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['zip']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Mobile</label>
                           <input type="text" name="phoner" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['phoner']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Other Phonse</label>
                           <input type="text" name="mobile" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['mobile']; ?>" />
                        </div>
                      </div>

                       <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>   
                       
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
                        
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Login Status</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="submit.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="edit_user_login" />
                  <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" />
                    <fieldset>
                       <div class="form-group">
                        <div class="left-box" id="datetimepicker1">
                          <label for="date">Registration Date</label><br />
                          <input data-format="yyyy-MM-dd" name="reg_date" type="date" value="<?php echo $row['reg_date'];?>" class="form-control dtpicker" style="max-width:100% !important;">
                        </div>
                        <div class="left-box">
                          <label for="name" >Login Status:</label>
                           <select name="mem_status" required="required" class="validate[required] form-control placeholder" id="mem_status">
                             <option value="0" <?php if($row['mem_status']==0){ echo "selected";}?>>Active</option>
                             <option value="1" <?php if($row['mem_status']==1){ echo "selected";}?>>Inactive</option>
                            </select>
                        </div>
                        <div class="left-box">
                          <label for="name" >Withdraw Status:</label>
                           <select name="wd_status" required="required" class="validate[required] form-control placeholder" id="wid_status">
                             <option value="0" <?php if($row['wd_status']==0){ echo "selected";}?>>Active</option>
                             <option value="1" <?php if($row['wd_status']==1){ echo "selected";}?>>Inactive</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>   
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
            <!--<div class="widget">
             <div class="widget-head">
                <div class="pull-left">Affiliate Reseller Status</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="submit.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="edit_user_login" />
                  <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" />
                    <fieldset>
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Affiliate Status:</label>
                           <select name="bonus" required="required" class="validate[required] form-control placeholder" id="mem_status">
                             <option value="0" <?php if($row['bonus']==0){ echo "selected";}?>>Inactive</option>
                             <option value="1" <?php if($row['bonus']==1){ echo "selected";}?>>Active</option>
                            </select>
                        </div>
                        <div class="left-box">
                          <label for="name" >Reseller Status:</label>
                           <select name="reseller" required="required" class="validate[required] form-control placeholder" id="wid_status">
                             <option value="0" <?php if($row['reseller']==0){ echo "selected";}?>>Inactive</option>
                             <option value="1" <?php if($row['reseller']==1){ echo "selected";}?>>Active</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>   
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>-->
            </div>
          </div>
        </div>
		<!-- Matter ends -->
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