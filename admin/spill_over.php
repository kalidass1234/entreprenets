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
  <div class="mainbar">
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Dashboard</h2>
      <div class="pull-right">
        <div id="reportrange" class="pull-right"> <i class="fa fa-calendar"></i> <span></span> <b class="caret"></b> </div>
      </div>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <!-- Divider -->
        <span class="divider">/</span> <a href="#" class="bread-current">Dashboard</a> </div>
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
                  <div class="pull-left">Set Placement</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <form action="" method="post" class="validate" id='form1'>
                  
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Enter User ID/User Name</label>
                    <input type="text" class="validate[required] form-control placeholder" id="user_id" name="user_id" placeholder="User ID/User name" data-bind="value: name" />
                        </div>
                        </div>
                     <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                  </form>
                  </div>
                </div>
              </div>
            <?php
            if(isset($_POST['search']))
			{
				if($_POST['user_id']!='')
				{
					$res_user=$obj_query->query("*","registration","user_id='$_POST[user_id]'");
					$count_user=$obj_query->num_row($res_user);
					$row_user=$obj_query->get_all_row($res_user);
					$user_id=$row_user['user_id'];
					$power_leg=$row_user['power_leg'];
					$power_status=$row_user['power_status'];
					$placement_id=$row_user['placement_id'];
				}
				if($count_user)
				{
			?>
            	<div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Set Placement Of <?php echo $user_id;?> </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <form action="submit.php" method="post" class="validate" id='form1'>
                  <input type="hidden" name="action" value="Set_Placement" />
                  <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
                      <fieldset>
                        
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Placement Id</label>
                     		<input type="text" class="validate[required] form-control placeholder" id="placement_id" name="placement_id" placeholder="Placement ID" data-bind="value: name" value="<?php echo $placement_id;?>" />
                        </div>
                       
                          <div class="left-box">
                            <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </fieldset>
                  </form>
                  </div>
                </div>
              </div>
          	<?php
				}
            }
			?>
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