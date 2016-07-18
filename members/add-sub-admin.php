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
      <h2 class="pull-left">Add / Edit Sub Admin</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="<?php echo SITE_URL; ?>admin/index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Add / Edit Sub Admin</a> </div>
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
                <div class="pull-left">Add / Edit Sub Admin</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                  <?php
				  
				  	$action = 'AddUser';
					$update = false;
					$privileage = array();
					
				  	if(isset($_GET['pid'])){
						
						$user_id = $_GET['pid'];
						$action = 'UpdateUser';
						$update = true;
						
						// get product information
					   $where = " where user_id='".$user_id."'";
					   $args_user_edit = $mxDb->get_information('admin', '*', $where, true, 'assoc');
					   
					   $privileage = array();
					   $where_privileage = " where admin_id='".$user_id."'";
					   // get privileage
					   $args_privileage = $mxDb->get_information('admin_privileges', 'privilege_page', $where_privileage, false, 'assoc');
					   
					   if( $args_privileage ){
						   foreach( $args_privileage as $privil ){
							   $privileage[] = $privil['privilege_page'];
						   }
					   }
					   
					}
					
				  ?>
                  
                  <style>
					  	.left-box input[type="checkbox"]{ padding:2px 3px 3px 3px !important; margin-left:5px !important;}
						#passstrength {
						color:red;
						font-family:verdana;
						font-size:10px;
						font-weight:bold;
					}

                   	  </style>
                      
                  <form action="../action_control/post-action.php" method="post" id='form1'>
                  <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                    <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                    
                    <?php if($update):?>
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
                    <?php endif; ?>
                    
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Name</label>
                          <input type="text"   name="name" id="name" class="validate[required] form-control placeholder"  placeholder="Name" data-bind="value: name" value="<?php if(isset($args_user_edit['name'])): echo $args_user_edit['name']; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> E-mail Address</label>
                          <input type="text"   name="email" id="email" class="validate[required] form-control placeholder" placeholder="Email Address" data-bind="value: name" value="<?php if(isset($args_user_edit['email'])): echo $args_user_edit['email']; endif; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                      
                        <div class="left-box">
                          <label for="name"> Username</label>
                          <input type="text"   name="username" id="username" class="validate[required] form-control placeholder" placeholder="Username" data-bind="value: name" value="<?php if(isset($args_user_edit['username'])): echo $args_user_edit['username']; endif; ?>" onBlur="check_usernameAdmin(this.value,'username')" />
                          <div id="msg_username"></div>
                          
                        </div>
                        <div class="left-box">
                          <label for="name"> Password </label>
                          <input type="password"   name="password" class="validate[required] form-control placeholder" id="password" data-bind="value: name" value="<?php if(isset($args_user_edit['password'])): echo $args_user_edit['password']; endif; ?>" />
                          <span id="passstrength"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Comfirm Password </label>
                          <input type="password"   name="confirm_password" class="validate[required] form-control placeholder" id="confirm_password" data-bind="value: name" value="<?php if(isset($args_user_edit['password'])): echo $args_user_edit['password']; endif; ?>" onBlur="match_password()" />
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">                   
                      
                      <p>&nbsp;</p>
                        <h3>Privileage</h3>
                        <div class="left-box">
                          <label for="name"> CMS Management </label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='1'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div>
                          
                            <div class="left-box">
                          <label for="name"> User Management </label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='2'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div></div>
                          
                          
                          <br/><br/>
                          
                           <div class="form-group">                   
                      
                   
                        <div class="left-box">
                          <label for="name"> Commision Points Manage </label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='3'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div>
                          
                            <div class="left-box">
                          <label for="name">Network </label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='4'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div></div>
                          
                          <br/><br/>
                          
                           <div class="form-group"> 
                          
                           <div class="left-box">
                          <label for="name"> Ewallet Management</label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='5'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div>
                          
                            <div class="left-box">
                          <label for="name">Withdrawal Request </label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='6'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div></div>
                          
                           
                          
                          <br/><br/>
                          
                           <div class="form-group"> 
                          
                           <div class="left-box">
                          <label for="name"> Privileage Management</label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='7'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                        
                        <br/><br/>
                        
                         <label for="name"> Products Management</label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='9'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                          
                          </div>
                          
                            <div class="left-box">
                          <label for="name">Commision Reports </label>
                          <div class="clearfix"></div>
                           <?php $men=mysql_query("select * from sub_admin_sub_category where cat_id='8'");
		   while($menu=mysql_fetch_array($men))
		   { ?>
             <?php $link=$menu['link'];?>
                          
                          <input type="checkbox" name="privileage[]" <?php if(in_array($link,$privileage)):?> checked <?php endif; ?>  value="<?php echo $link;?>" /> <?php echo $menu['sub_cat_name'];?><br/><?php  } ?>
                         
                        
                          
                          </div></div>
                          
                          
                          
                          
                          
                          
                          
                          
                          
                        <div class="clearfix"></div>
                     
                     
                        
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="left-box"><br>
                          <br>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box"> <br>
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                  
                  <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/js/utf8_encode.js"></script>
				  <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/js/md5.js"></script>
                  
                  <script type="text/javascript">
				  
					  // form validation 
					  var frmValidation = new Validator('form1');
					  frmValidation.addValidation('name','req','Please enter name');
					  frmValidation.addValidation('name','alpha_s','Please enter character and space only in name');
					  frmValidation.addValidation('email','req','Please enter email address');
					  frmValidation.addValidation('email','email');
					  frmValidation.addValidation('username','req','Please enter your username');
					  frmValidation.addValidation('password','req','Please enter your password');
					  frmValidation.addValidation('password','minlen=8','Please enter your password minimum 8 digit');
					  frmValidation.addValidation('confirm_password','req','Please enter your confirm Password');
					
					
					// validation for check password and confirm password
					function match_password(){
						
						var password = $("#password").val();
						var confirm_password = $("#confirm_password").val();
						
						if(password != '' ){
							
							if(confirm_password != '' ){
								
								if( confirm_password == password ){
									
									var pass = password;
									
									document.getElementById('password').value = pass;
									document.getElementById('confirm_password').value = pass;
									return true;
							
								}
								else{
									alert('Please enter same password in confirm password');
									confirm_password = '';
									return false;
								}
							}
							else{
								alert("Please enter your confirm password");
								return false;
							}
						}
						
						return false;
					}
					
					// strong password
					$('#password').keyup(function(e) {
					 var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
					 var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
					 var enoughRegex = new RegExp("(?=.{6,}).*", "g");
					 if (false == enoughRegex.test($(this).val())) {
							 $('#passstrength').html('More Characters');
					 } else if (strongRegex.test($(this).val())) {
							 $('#passstrength').className = 'ok';
							 $('#passstrength').html('Strong!');
					 } else if (mediumRegex.test($(this).val())) {
							 $('#passstrength').className = 'alert';
							 $('#passstrength').html('Medium!');
					 } else {
							 $('#passstrength').className = 'error';
							 $('#passstrength').html('Weak!');
					 }
					 return true;
				});
					 
				  </script> 
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
