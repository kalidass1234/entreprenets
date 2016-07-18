<?php include('header.php');
include("pagination.php");
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
          <a href="#" class="bread-current">Change Password</a>
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
                <div class="pull-left">Change Member Password </div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
				    $country_search=  check_country($country_id, $country_name,$admin_type);
				  if(isset($_REQUEST['submit']))
				  {
				  	 $user_name=$_REQUEST['user_name'];
					// get user_id from fiend
					$res=$obj_query->query("*","registration","(user_id='$user_name' or user_name='$user_name') $country_search ");
					
				  	$row=$obj_query->get_all_row($res);
					 $user_id=$row['user_id'];
					
					$res_user=$obj_query->query("*","registration","(user_id='$user_id' or user_name='$user_name') $country_search");
					$count_user=$obj_query->num_row($res_user);
				  	$row_user=$obj_query->get_all_row($res_user);
				  }
                  //$user_id=$_GET['userid'];
				  
				  ?>
                  <form action="" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="track_password" />
                  <input type="hidden" name="user_id" value="<?php echo $_REQUEST['user_name'];?>" />
                    <fieldset>
                      
                       <div class="form-group">
                        
                        <div class="left-box">
                          <label for="name" >Username:</label>
                           <input type="text" name="user_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row_user['user_name']; ?>" />
                        </div>
                        
                      </div>
                      <div style="clear:both"></div>
                       <?php
                       if($count_user):
					   ?>
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Password:</label>
                           <?php echo $row_user['user_pass']; ?>
                        </div>
                        <div class="left-box">
                          <label for="name" >Transaction Password:</label>
                           <?php echo $row_user['t_code']; ?>
                        </div>
                      </div>
                      <?php endif;?>
                       <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>   
                       
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Search</button>
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
  <!-- Matter ends --> 
</div>
<!-- Mainbar ends --> 
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->
<?php include('footer.php'); ?>