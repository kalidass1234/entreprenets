<?php define('ABSPATH','../../lib/'); include('../header.php');  include('../pagination/pagination.php');

// get main cateogries
$args_members = $mxDb->get_information('sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');

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
      <h2 class="pull-left">Site Setting</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="../admin/index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Site Setting</a> </div>
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
                <div class="pull-left">Site Setting</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                      
                  <form action="../action_control/post-action.php" method="post" id='form1' enctype="multipart/form-data">
                  <input type="hidden" name="action" value="UpdateSiteSetting"/>
                   <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                    <input type="hidden" name="old_img" value="<?php echo $args_user['image'];?>"/>
                    
                    <input type="hidden" name="id" value="<?php echo $args_user['user_id']; ?>"/>
                    <?php $data=mysql_fetch_array(mysql_query("select * from site_settings where id='1'"));
					
				
					       $name1=$data['email_confirmation_link'];
						   $name2=$data['admin_register_user_email'];
						   $name3=$data['admin_mail_subscribe_newsletter'];
						   $name4=$data['product_purcahse_sent_email_admin'];
						   $name5=$data['package_purcahse_sent_email_admin'];
						    $name6=$data['admin_activate_user'];
						   $name7=$data['contact_form_detail'];
						   $name8=$data['shipping_charge'];
						   $name9=$data['registration_payment_option'];
						   $name10=$data['product_purchase_payment_option'];
						    $name11=$data['withdrawal_request'];
						   $name12=$data['create_subadmin'];
						   $name13=$data['mail_user_send_userpanel'];
						   $name14=$data['security_question'];
						   $name15=$data['forgot_password_option'];
						    $name16=$data['tax_charge'];
						   $name17=$data['discount_used'];
						   $name18=$data['incoming_email'];
						   $name19=$data['outgoing_email'];
						  
				
					
					?>
                    
                    <fieldset>
                      <div class="form-group">
                       
                          <label for="name"> Email confirmation link sent to user after registration </label><br/>
                          <input type="radio"   name="fieldname1" id="email-confirm"  value="1" <?php if($name1=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          <input type="radio"   name="fieldname1" id="email-confirm"  value="0" <?php if($name1=='0') { ?>checked="checked" <?php } ?> /> No
                        </div>
                        <br/>
                        
                         <div class="form-group">
                       
                          <label for="name"> Sent a email to admin if any one register </label><br/>
                          <input type="radio"   name="fieldname2" id="email-confirm"  value="1" <?php if($name2=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          <input type="radio"   name="fieldname2" id="email-confirm"  value="0" <?php if($name2=='0') { ?>checked="checked" <?php } ?> /> No
                        </div>
                        <br/>
                        
                         <div class="form-group">
                         <label for="name"> Sent a email to admin if any one Subscribe Newsletter </label><br/>
                          <input type="radio"   name="fieldname3" id="email-confirm"  value="1" <?php if($name3=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          <input type="radio"   name="fieldname3" id="email-confirm"  value="0" <?php if($name3=='0') { ?>checked="checked" <?php } ?> /> No
                        </div>
                        <br/>
                        
                          <div class="form-group">
                         <label for="name"> Sent a email to admin if any one purchase a product</label><br/>
                          <input type="radio"   name="fieldname4" id="email-confirm"  value="1" <?php if($name4=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          <input type="radio"   name="fieldname4" id="email-confirm"  value="0" <?php if($name4=='0') { ?>checked="checked" <?php } ?> /> No
                        </div>
                        <br/>
                        
                         <div class="form-group">
                         <label for="name"> Sent a email to admin if any one purchase a package </label><br/>
                          <input type="radio"   name="fieldname5" id="email-confirm"  value="1" checked="checked" <?php if($name5=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          <input type="radio"   name="fieldname5" id="email-confirm"  value="0" <?php if($name5=='0') { ?>checked="checked" <?php } ?> /> No
                        </div>
                        <br/>
                        
                          <div class="form-group">  
                          <label for="name"> Admin will also activate the user </label><br/>
                          <input type="radio"   name="fieldname6" id="email-confirm"  value="1" <?php if($name6=='1') { ?>checked="checked" <?php } ?>/> Yes Admin Will also activate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname6" id="email-confirm"  value="0" <?php if($name6=='0') { ?>checked="checked" <?php } ?>/> No activate automatically
                       </div><br/>
                                       
                      <div class="form-group">
                         <label for="name"> Site Contact us form detail where to sent</label><br/>
                          <input type="radio"   name="fieldname7" id="email-confirm"  value="1" <?php if($name7=='1') { ?>checked="checked" <?php } ?>/> Sent to database only&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname7" id="email-confirm"  value="2" <?php if($name7=='2') { ?>checked="checked" <?php } ?>/> Sent to email only&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname7" id="email-confirm"  value="3" <?php if($name7=='3') { ?>checked="checked" <?php } ?>/> Sent to both database and email to
                      </div><br/>
                      
                        <div class="form-group">
                         <label for="name"> How to use shipping charge</label><br/>
                          <input type="radio"   name="fieldname8" id="email-confirm"  value="1" <?php if($name8=='1') { ?>checked="checked" <?php } ?>/> With seperate product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname8" id="email-confirm"  value="2" <?php if($name8=='2') { ?>checked="checked" <?php } ?>/> Depends on total Invoice Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname8" id="email-confirm"  value="3" <?php if($name8=='3') { ?>checked="checked" <?php } ?>/> A Fixed Amount to all product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio"   name="fieldname8" id="email-confirm"  value="4" <?php if($name8=='4') { ?>checked="checked" <?php } ?>/> A Fixed percentage apply to all invoice &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname8" id="email-confirm"  value="5" <?php if($name8=='5') { ?>checked="checked" <?php } ?>/> Free shipping
                      </div><br/>
                      
                                               
                      
                       <div class="form-group">
                          <label for="name"> Payment Option at the time of registration</label><br/>
                          <input type="radio"   name="fieldname9" id="email-confirm"  value="1" <?php if($name9=='1') { ?>checked="checked" <?php } ?>/> Paypal &nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname9" id="email-confirm"  value="2" <?php if($name9=='2') { ?>checked="checked" <?php } ?>/> Bank Wired&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname9" id="email-confirm"  value="3" <?php if($name9=='3') { ?>checked="checked" <?php } ?>/> Sponsor Ewallet&nbsp;&nbsp;&nbsp;&nbsp;
                           
                        
                          <input type="radio"   name="fieldname9" id="email-confirm"  value="4" <?php if($name9=='4') { ?>checked="checked" <?php } ?>/> Paypal & Bank Wired&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname9" id="email-confirm"  value="5" <?php if($name9=='5') { ?>checked="checked" <?php } ?>/> Bank Wired & Sponsor Ewallet&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname9" id="email-confirm"  value="6" <?php if($name9=='6') { ?>checked="checked" <?php } ?>/> Sponsor Ewallet & Paypal
                           &nbsp;&nbsp;&nbsp;&nbsp;<br/>                           
                           <input type="radio"   name="fieldname9" id="email-confirm"  value="7" <?php if($name9=='7') { ?>checked="checked" <?php } ?>/>Paypal & Bank Wired & Sponsor Ewallet &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"   name="fieldname9" id="email-confirm"  value="0" <?php if($name9=='0') { ?>checked="checked" <?php } ?>/>No Payment Option
                      </div><br/>
                        
                           <div class="form-group">
                          <label for="name"> Payment Option at the time of product purchasing</label><br/>
                          <input type="radio"   name="fieldname10" id="email-confirm"  value="1" <?php if($name10=='1') { ?>checked="checked" <?php } ?>/> Paypal &nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname10" id="email-confirm"  value="2" <?php if($name10=='2') { ?>checked="checked" <?php } ?>/> Bank Wired&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname10" id="email-confirm"  value="3" <?php if($name10=='3') { ?>checked="checked" <?php } ?>/> Self Ewallet&nbsp;&nbsp;&nbsp;&nbsp;
                           
                        
                          <input type="radio"   name="fieldname10" id="email-confirm"  value="4" <?php if($name10=='4') { ?>checked="checked" <?php } ?>/> Paypal & Bank Wired&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname10" id="email-confirm"  value="5" <?php if($name10=='5') { ?>checked="checked" <?php } ?>/> Bank Wired & Sponsor Ewallet&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname10" id="email-confirm"  value="6" <?php if($name10=='6') { ?>checked="checked" <?php } ?>/> Self Ewallet & Paypal
                           &nbsp;&nbsp;&nbsp;&nbsp;<br/>                           
                           <input type="radio"   name="fieldname10" id="email-confirm"  value="7" <?php if($name10=='7') { ?>checked="checked" <?php } ?>/>Paypal & Bank Wired & Self Ewallet 
                      </div><br/>
                      
                      
                      
                       <div class="form-group">  
                          <label for="name"> Provide withdrawal request in userpanel </label><br/>
                          <input type="radio"   name="fieldname11" id="email-confirm"  value="1" <?php if($name11=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname11" id="email-confirm"  value="0" <?php if($name11=='0') { ?>checked="checked" <?php } ?>/> No 
                       </div><br/>
                       
                       <div class="form-group">  
                          <label for="name"> Want to create sub admin </label><br/>
                          <input type="radio"   name="fieldname12" id="email-confirm"  value="1" <?php if($name12=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname12" id="email-confirm"  value="0" <?php if($name12=='0') { ?>checked="checked" <?php } ?>/> No 
                       </div><br/>
                       
                        <div class="form-group">  
                          <label for="name"> How many mails user can send in a day from userpanel</label><br/>
                          <input type="radio"   name="fieldname13" id="email-confirm"  value="10" <?php if($name13=='10') { ?>checked="checked" <?php } ?>/> Not More Than 10 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname13" id="email-confirm"  value="25" <?php if($name13=='25') { ?>checked="checked" <?php } ?>/> Not More Than 25  
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname13" id="email-confirm"  value="50" <?php if($name13=='50') { ?>checked="checked" <?php } ?>/> Not More Than 50  
                       </div><br/>
                      
                         <div class="form-group">  
                          <label for="name"> Ask for security Question at the time of registration</label><br/>
                          <input type="radio"   name="fieldname14" id="email-confirm"  value="1" <?php if($name14=='1') { ?>checked="checked" <?php } ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname14" id="email-confirm"  value="0" <?php if($name14=='0') { ?>checked="checked" <?php } ?>/> No  
                         </div><br/>
                      
                       <div class="form-group">  
                          <label for="name"> Forgot password recover option</label><br/>
                          <input type="radio"   name="fieldname15" id="email-confirm"  value="1" <?php if($name15=='1') { ?>checked="checked" <?php } ?>/> Send password to user registered email. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname15" id="email-confirm"  value="2" <?php if($name15=='2') { ?>checked="checked" <?php } ?>/> Send reset password link to user registered email  
                         </div><br/>
                      
                      
                       <div class="form-group">
                         <label for="name"> How to use tax charge</label><br/>
                          <input type="radio"   name="fieldname16" id="email-confirm"  value="1" <?php if($name16=='1') { ?>checked="checked" <?php } ?>/> With seperate product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname16" id="email-confirm"  value="2" <?php if($name16=='2') { ?>checked="checked" <?php } ?>/> Depends on total Invoice Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname16" id="email-confirm"  value="3"<?php if($name16=='3') { ?>checked="checked" <?php } ?> /> A Fixed Amount to all product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio"   name="fieldname16" id="email-confirm"  value="4" <?php if($name16=='4') { ?>checked="checked" <?php } ?>/> A Fixed percentage apply to all invoice &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname16" id="email-confirm"  value="5" <?php if($name16=='5') { ?>checked="checked" <?php } ?>/> Free Tax
                      </div><br/>
                      
                         <div class="form-group">
                         <label for="name"> Provide Discount by </label><br/>
                          <input type="radio"   name="fieldname17" id="email-confirm"  value="1" <?php if($name17=='1') { ?>checked="checked" <?php } ?>/> With seperate product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio"   name="fieldname17" id="email-confirm"  value="2" <?php if($name17=='2') { ?>checked="checked" <?php } ?>/> With Coupon Codes Only&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname17" id="email-confirm"  value="3" <?php if($name17=='3') { ?>checked="checked" <?php } ?>/> A Fixed Amount to all product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio"   name="fieldname17" id="email-confirm"  value="4" <?php if($name17=='4') { ?>checked="checked" <?php } ?>/> A Fixed percentage apply to all invoice &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio"   name="fieldname17" id="email-confirm"  value="5" <?php if($name17=='5') { ?>checked="checked" <?php } ?>/> No Discount Apply
                      </div><br/>
                      
                                           
                          <div class="form-group">
                         <label for="name"> Email Id for Incoming email</label><br/>
                          <input type="text"   name="fieldname18" id="email-confirm"  value="<?php echo $name18;?>" class="validate[required] form-control placeholder" required /> 
                        
                      </div><br/>
                      
                       <div class="form-group">
                         <label for="name"> Email Id for Outgoing email</label><br/>
                          <input type="text"   name="fieldname19" id="email-confirm"  value="<?php echo $name19;?>" class="validate[required] form-control placeholder" required/> 
                        
                      </div><br/>
                    
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
