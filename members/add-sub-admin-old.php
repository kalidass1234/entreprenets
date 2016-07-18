<?php define('ABSPATH','../../lib/'); include('../header.php'); 

// get main cateogries
$args_categories = $mxDb->get_information('categories', '*', ' order by category_id asc',false, 'assoc');

// unset table name from session
if(isset($_SESSION['cat_tbl']))
	unset($_SESSION['cat_tbl']);

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
      <h2 class="pull-left">Sub Admin Manage</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Sub Admin Manage</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Sub Admin Manage</a> </div>
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
                <div class="pull-left">Sub Admin Manage</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  
				  	$action = 'AddSubAdmin';
					$update = false;
					
				  	if(isset($_GET['user_id'])){
						$product_id = $_GET['user_id'];
						$action = 'UpdateSubAdmin';
					
						
						$update = true;
						
						// get product information
						$where = " where user_id='".$product_id."'";
						$args_product = $args_products = $mxDb->get_information('emp', '*', $where, true, 'assoc');
					}
				  ?>
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      
                       <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                      <input type="hidden" name="id" value="<?php echo $product_id; ?>"/>
                     
                       <div class="left-box">
                          <label for="name"> Username</label>
                          <input type="text" class="validate[required] form-control placeholder" name="username" id="username" placeholder="username" data-bind="value: name" value="<?php if(isset($args_product['user_name'])): echo $args_product['user_name']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Password</label>
                          <input type="password" class="validate[required] form-control placeholder" name="password" id="password" placeholder="password" data-bind="value: name" value="<?php if(isset($args_product['pass'])): echo $args_product['pass']; endif;?>" />
                        </div>
                        
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                      
                       <div class="left-box">
                          <label for="name"> First Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="fname" id="fname" placeholder="First name" data-bind="value: name" value="<?php if(isset($args_product['fname'])): echo $args_product['fname']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Middle Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="mname" id="mname" placeholder="Middle name" data-bind="value: name" value="<?php if(isset($args_product['mname'])): echo $args_product['mname']; endif;?>" />
                        </div>
                        
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                   <div class="left-box">
                          <label for="name"> Last Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="lname" id="lname" placeholder="Last name" data-bind="value: name" value="<?php if(isset($args_product['lname'])): echo $args_product['lname']; endif;?>" />
                        </div>
                        
                         <div class="left-box">
                          <label for="name"> Designation</label>
                          <input type="text" class="validate[required] form-control placeholder" name="designation" id="designation" placeholder="Designation" data-bind="value: name" value="<?php if(isset($args_product['designation'])): echo $args_product['designation']; endif;?>" />
                        </div>
                        
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                         <div class="left-box">
                          <label for="name"> Privileges</label><br/><?php if(isset($args_product['privilege'])): $pre=$args_product['privilege'];  @$pres=explode(",",$pre);endif;?>
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="1"  <?php if(@$pres[0]==1 || @$pres[1]==1 || @$pres[2]==1 || @$pres[3]==1 || @$pres[4]==1 || @$pres[5]==1 || @$pres[6]==1 || @$pres[7]==1  || @$pres[8]==1) echo "checked";?>/> CMS Management<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="2" <?php if(@$pres[0]==2 || @$pres[1]==2 || @$pres[2]==2 || @$pres[3]==2 || @$pres[4]==2 || @$pres[5]==2 || @$pres[6]==2 || @$pres[7]==2 || @$pres[8]==2) echo "checked";?>/> User Management<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="3" <?php if(@$pres[0]==3 || @$pres[1]==3 || @$pres[2]==3 || @$pres[3]==3 || @$pres[4]==3 || @$pres[5]==3 || @$pres[6]==3 || @$pres[7]==3 || @$pres[8]==3) echo "checked";?>/> Commision Points Manage<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="4" <?php if(@$pres[0]==4 || @$pres[1]==4 || @$pres[2]==4 || @$pres[3]==4 || @$pres[4]==4 || @$pres[5]==4 || @$pres[6]==4 || @$pres[7]==4 || @$pres[8]==4) echo "checked";?>/> Network<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="5" <?php if(@$pres[0]==5 || @$pres[1]==5 || @$pres[2]==5 || @$pres[3]==5 || @$pres[4]==5 || @$pres[5]==5 || @$pres[6]==5 || @$pres[7]==5 || @$pres[8]==5) echo "checked";?>/> Ewallet Management<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="6" <?php if(@$pres[0]==6 || @$pres[1]==6 || @$pres[2]==6 || @$pres[3]==6 || @$pres[4]==6 || @$pres[5]==6 || @$pres[6]==6 || @$pres[7]==6 || @$pres[8]==6)  echo "checked";?>/> Withdrawal Request<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="7" <?php if(@$pres[0]==7 || @$pres[1]==7 || @$pres[2]==7 || @$pres[3]==7 || @$pres[4]==7 || @$pres[5]==7 || @$pres[6]==7 || @$pres[7]==7 || @$pres[8]==7) echo "checked";?>/> Privilege Manage<br/>
                          
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="8" <?php if(@$pres[0]==8 || @$pres[1]==8 || @$pres[2]==8 || @$pres[3]==8 || @$pres[4]==8 || @$pres[5]==8 || @$pres[6]==8 || @$pres[7]==8  || @$pres[8]==8) echo "checked";?>/> Commission Reports<br/>
                         
                          <input type="checkbox"  name="privileges[]" id="privileges" data-bind="value: name" value="9" <?php if(@$pres[0]==9 || @$pres[1]==9 || @$pres[2]==9 || @$pres[3]==9 || @$pres[4]==9 || @$pres[5]==9 || @$pres[6]==9 || @$pres[7]==9  || @$pres[8]==9) echo "checked";?>/> Products<br/>
                         
                        </div>
                        
                        
                        
                       <div class="left-box">
                       <label  for="inputEmail">View Status</label>
                      <?php $var4=@$args_product['emp_status'];?>
                        <select name="status" class="form-control" id="inputEmail" required>
                        <option value="Active">Select</option>
                        <option value="Active" <?php if($var4=='Active') { ?> selected <?php } ?>>Active</option>
                        <option value="Deactive" <?php if($var4=='Deactive') { ?> selected <?php } ?>>Deactive</option>
                        </select>
                      </div>
                   
                      
                        
                          <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="left-box"> <br />
                          <button class="btn btn-danger side"  type="submit" id="button">Submit</button>
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
<?php include('../footer.php'); ?>
