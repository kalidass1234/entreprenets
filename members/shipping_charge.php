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
      <h2 class="pull-left">Shipping Charge</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Shipping Charge List</a> </div>
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
        
            
          </div>
        </div>
           
<!--      <a href="<?php //echo SITE_URL; ?>admin/category/category-sub-sub.php"> <button class="btn btn-danger side"  type="button" id="button" >Add Sub Category</button></a>
-->      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Shipping Charge Lists</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>If Total Invoice amount is greater than </th>
                  <th>If Total Invoice amount is less than </th>
                  <th>Than shipping charge will be</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
             <?php
             $args_members = $mxDb->get_information('shipping_charge', '*',"",false, 'array');
			  if($args_members):
			  	$s_no = 1;
				
                foreach($args_members as $member):
              ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  
                  <td>$ <?php echo $member['less_than']; ?></td>
                  <td>$ <?php echo $member['geater_than']; ?></td>
                  <td>$ <?php echo $member['charge']; ?></td>
                                       <td>&nbsp;
				  <span style="margin-left:5px;"><a href="shipping-point.php?id=<?php echo $member['id'];?>" title="View Detail"><img src="../images/edit.png" /></a></span>
                 
                  <?php /*?><span style="margin-left:5px;"><a href="../action_control/get-action.php?rand=<?php echo $_SESSION['rand']; ?>&id=<?php echo $member['id'];?>&tbl=registration_points&return=members/points.php&field=id&status=<?php echo $member['status'];?>&action=changeStatus1&delete=true" title="<?php echo $title_status; ?>"><img src="../images/enable.png" /></a></span><?php */?>

                  </td>
                </tr>
                <?php $s_no++;
					endforeach;
				endif;
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
