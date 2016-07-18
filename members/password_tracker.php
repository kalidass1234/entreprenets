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
      <h2 class="pull-left">Password Tracker</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Track User Password</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
        
        	<?php
				if(isset($_GET['msg'])):
					if($_GET['res']==1):?>
                    <div style="padding:5px; color:#063; font-weight:bold;"><?php echo strip_tags($_GET['msg']); ?></div>
              <?php else: ?>
                    <div style="padding:5px; color:#F00; font-weight:bold;"><?php echo strip_tags($_GET['msg']); ?></div>	
			<?php
					endif;
				endif;
			?>
        
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Search </div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" id='form1' method="post" name="search">
                  <input type="hidden" name="action" value="search" />
                    <fieldset>
                     
                      <div class="form-group main-wrapper">
                        <div class="left-box">
                          <label for="name"> User id / User Name</label>
                          <input type="text"  name="userid" placeholder="Enter the User id / User name" />
                        </div>
                        
                               
                     
                        <div class="left-box">
                         <br>
                          <button class="btn btn-danger side"  type="submit" id="button" name="show" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
           
<!--      <a href="<?php //echo SITE_URL; ?>admin/category/category-sub-sub.php"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>

-->      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">User Password List</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>User Id.</th>
                  <th>User Name </th>
                  <th>Full Name </th>
                  <th>Login Password</th>
                  <th>Transaction Password</th>
                  <th>Email To User</th>
                </tr>
              </thead>
              <tbody>
             <?php
			 if(isset($_POST['show']))
			 {
				 $a1=$_POST['userid'];
				 
             $args_members = $mxDb->get_information('user_registration', '*',"where user_id='$a1' || username='$a1'",false, 'array');
			  if($args_members):
			
				
                foreach($args_members as $member):
              ?>
                <tr>
                  <td><?php echo $member['user_id']; ?></td>
                  
                  <td><?php echo $member['username']; ?></td>
                  <td> <?php echo $member['first_name']; ?> <?php echo $member['last_name']; ?></td>
                  <td><?php echo $member['password']; ?></td>
                   <td><?php echo $member['t_code']; ?></td>
                    <td><a href="mailto:<?php echo $member['email']?>"><?php echo $member['email']?></a></td>
                                      
                </tr>
                <?php 
					endforeach;
				endif;}
				?>
              </tbody>
            </table>
            
            <script type="text/javascript">
				// delete record
				delete_item = function(url){
					if(confirm("Do you want to delete this record")){
						window.location.href=url;
					}
				}
			</script>
            
            <div class="widget-foot">
              <ul class="pagination pull-right">
              
                <!--<li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>-->
              </ul>
              <div class="clearfix"></div>
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
