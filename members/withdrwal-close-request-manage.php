<?php ob_start();define('ABSPATH','../../lib/'); include('../header.php');  include('../pagination/pagination.php');

// get main cateogries
$args_logos = $mxDb->get_information('categories', '*', ' order by category_id asc',false, 'assoc');

?>
<!-- Main content starts -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script type="text/javascript">
function ValidateData(form)
{
 var chks = document.getElementsByName('list[]');
 var hasChecked = false;
 for (var i = 0; i < chks.length; i++)
 {
  if(chks[i].checked)
  {
   hasChecked = true;
   break;
  }
 }
 if (hasChecked == false)
 {
  alert("Please select at least one Request.");
  return false;
 }
} 
function Check(chk)
{
 var chk = document.getElementsByName('list[]');
 if(document.myform.Check_All.value=="Check All")
 {
  for (i = 0; i < chk.length; i++)
  chk[i].checked = true ;
  document.myform.Check_All.value="UnCheck All";
 }
 else
 {
  for (i = 0; i < chk.length; i++)
  chk[i].checked = false ;
  document.myform.Check_All.value="Check All";
 }
}
</script>
<div class="content"> 
  <!-- Sidebar -->
  <?php include('../nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Withdraw Request Close</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Withdraw Request Close</a> </div>
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
					if($_GET['msg']=='ist'):?>
                    <div style="padding:5px; color:#063; font-weight:bold;"><?php echo "Successfully Updated Data  !"; ?></div>
              <?php else: ?>
                    <div style="padding:5px; color:#F00; font-weight:bold;"><?php echo "Sorry Unable to Send !"; ?></div>	
			<?php
					endif;
				endif;
			?>
        
            
          </div>
        </div>
        
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Withdraw Request Response</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <form name="myform" onSubmit="return ValidateData(this);" method="post" action="">
  <input type="hidden" name="token_id" value="<?php echo token; ?>" /> 
            <table class="table table-striped table-bordered table-hover">
              <thead>
              
					
                            <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
					 
                <tr>
                  <th>S.no.</th>
                  <th>User Id</th>
                  <th>Full Name</th>
                  <th>Request Amount</th>
                    <th>Transaction Id</th>
                  <th>Posted Date</th>
                  <th>Response Date</th>
                   <th>Remark</th>
                 
                
                </tr>
              </thead>
              <tbody>
              <?php 
			 
			 // get best offer banners 
			  $args_banners_week = $mxDb->get_information('withdraw_request', '*', "where status='1' order by id asc ",false, 'assoc');
			  
			  /* ====== show records ======== */
			  if($args_banners_week):
			  	$s_nos = 1;
				
				$status = array('0'=>'Active','1'=>'Deactive');
				
			  	foreach($args_banners_week as $banners):
				
				$status = ($banners['status'] == 0)? 'Active' : 'Deactive';
				$status_title = ($banners['status'] == 0)? 'Deactive' : 'Active';
					
              ?>
                <tr>
                  <td><?php echo $s_nos; ?></td>
                  <td><?php echo $banners['user_id']; ?></td>
                  <td><?php echo $banners['first_name']; ?>&nbsp;<?php echo $banners['last_name']; ?></td>
                  <td>$ <?php echo $banners['request_amount']; ?></td>
                   <td><?php echo $banners['transaction_number']; ?></td>
                   <td><?php echo $banners['posted_date']; ?></td>
                   <td><?php echo $banners['admin_response_date']; ?></td>
                    <td><?php echo $banners['admin_remark']; ?></td>
                  
                 <?php @$total_amount=$total_amount+$banners['request_amount'];?>
                 
                </tr>
                <?php $s_nos++;
					endforeach;
				endif;
				?>
                <tr><td  colspan="8">Total Withdraw Amount Request Is $ <?php echo @$total_amount;?></td></tr>
                  
						
                         <tr><td colspan="9">
                        <a href="export-withdraw-closed-request.php"><input type="button" name="export" value="Export Data"></a>
                 </td></tr>
              </tbody>
            </table>
            
            </form>
            
          </div>
        </div>
      
     
      
           <div class="clearfix"></div>
        
          
                            <!--editor code starts here use with ckfinder-->
           
      
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
