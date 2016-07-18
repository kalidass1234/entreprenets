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
      <h2 class="pull-left">Sub Admin Manage</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Sub Admin List</a> </div>
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
            
            <div class="widget" >
             <div class="widget-head">
                <div class="pull-left">Search</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize">
                <i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings">
                <i class="fa fa-wrench"></i></a> <a href="#" class="wclose">
                <i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="admin_main.php?page_number=188" class="validate" method="post" id='form1'>
                  <input type="hidden" name="action" value="add_fund">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> User Id</label>
                          <input type="text" class="validate[required] form-control placeholder" name="user_id" value="<?php echo $_POST['user_id'];?>" id="user_id" placeholder="User Id" data-bind="value: name" />
                        </div>
                        
                        <div class="left-box">
                          <label for="name"> User Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="username" value="<?php echo $_POST['username'];?>" id="username" placeholder="User name" data-bind="value: name" />
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
            <a href="admin_main.php?page_number=187"> <button class="btn btn-danger side"  type="button" id="button" >Add New</button></a>
            <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Pages</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
            <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> 
            <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          
		 
          
            <table class="table table-striped table-bordered table-hover">
             <?php
			 if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1)
			{
				$uid=$_REQUEST['uid'];
				$obj_query->query_execute("delete from admin_master where uid='$uid'");
				$obj_query->query_execute("delete from admin_privileges where admin_id='$uid'");
			}
			 
			 $uid=$_POST['user_id'];
			 $username=$_POST['username'];
             if(($_POST['user_id']!='') && ($_POST['username']!=''))
             {
             $search="and uid='$uid' and userid='$username'";
             }
			 elseif(($_POST['user_id']=='') && ($_POST['username']!=''))
			 {
				  $search="and userid='$username'";
			 }
			 elseif(($_POST['user_id']!='') && ($_POST['username']==''))
			 {
				  $search="and uid='$uid' ";
			 }
			 $con="where uid!='123456' and userid!='admin'";
			// echo "select * from admin_master $con";
              $q=mysql_query("select * from admin_master $con $search") or die(mysql_error());
              $n=mysql_num_rows($q);
              if($n>0)
              {
              ?>
              <thead>
             
                <tr>
                 <th>S.no.</th>
                  <th> User Id</th>
                  <th>Username</th>
                   <th>Name</th>
                  <th>email</th>
                  <th>Country</th>
                  <th>Date / Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
             
              <tbody>
              <?php
               $s_no=1;
              while($users=mysql_fetch_assoc($q))
              {
              ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo $users['uid']; ?></td>
                  <td><?php echo $users['userid']; ?></td>
                   <td><?php echo $users['fname']; ?></td>
                  <td><?php echo $users['email']; ?></td>
                  <td><?php echo $obj_query->get_field_name("country","country_name","id='$users[country]'"); ?></td>
                  <td><?php echo date("d-m-Y H:i:s",strtotime($users['add_date_time'])); ?></td>
               
                  <td>&nbsp;
				  <span style="margin-left:5px;"><a href="admin_main.php?page_number=187&pid=<?php echo $users['uid'];?>&amp;show=true" title="Edit"><img src="../images/edit.png" /></a></span>
                  <span style="margin-left:5px;"><a href="admin_main.php?page_number=188&delete=1&uid=<?php echo $users['uid'];?>" onclick="if(confirm('Do You Want To Delete')){ return true;}else{ return false;}" title="Delete"><img src="../images/Trashcan.png" /></a></span>

                  </td>
                </tr>
                 <?php 
					$s_no++;
					}
				?>
              </tbody>
             <?php
             }
             ?>
            </table>
            
            <div class="widget-foot">
              <ul class="pagination pull-right">
              	<?php  echo pagination($url,$query,$userss,$current_page); ?>
                <!--<li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>-->
              </ul>
              <div class="clearfix"></div>
            </div>
            
             <script type="text/javascript">
				// delete record
				delete_item = function(url){
					if(confirm("Do you want to delete this record")){
						window.location.href=url;
					}
				}
			</script>
            
             <script type="text/javascript">
				// delete record
				delete_item = function(url){
					if(confirm("Do you want to delete this record")){
						window.location.href=url;
					}
				}
			</script>
            
             
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
<?php include('footer.php'); ?>
