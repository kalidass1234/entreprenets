<?php ob_start();define('ABSPATH','../../lib/'); include('../header.php');  include('../pagination/pagination.php');
// get main cateogries
$args_logos = $mxDb->get_information('categories', '*', ' order by category_id asc',false, 'assoc');
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script>
$(function() {
	var pickerOpts = {
	        dateFormat: $.datepicker.ATOM
    };  
$( "#datepicker" ).datepicker(pickerOpts);
});

$(function() {
	var pickerOpts = {
	        dateFormat: $.datepicker.ATOM
    }; 
$( "#datepicker1" ).datepicker(pickerOpts);
});
</script>
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
      <h2 class="pull-left">Fast Start Bonus</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Fast Start Bonus</a> </div>
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
                          <label for="name"> Start Date</label>
                          <input type="text"  id="datepicker" name="start_date" placeholder="YYYY-MM-DD" />
                        </div>
                        
                      
                        <div class="left-box">
                          <label for="name"> End Date</label>
                          <input type="text"  id="datepicker1" name="end_date" placeholder="YYYY-MM-DD"/>
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
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Fast Start Bonus</div>
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
                  <th>Invoice No</th>
                  <th>Purchase Id</th>
                  <th>Income Id</th>
                    <th>Total Invoice Amount</th>
                  <th>Total Invoice Wholesale Amount</th>
                   <th>Invoice BV</th>
                    
                     <th>Total Commision In BV</th>
                   <th>Remark</th>
                   <th>Quantity</th>
                   <th>Payout Date</th>
                    <th>Commision Date</th>
                    <th>Paid Status</th>
                 
                
                </tr>
              </thead>
              <tbody>
              <?php 
			  if(isset($_POST['show']))
			 {
				  $start_date=$_POST['start_date'];
				 $end_date=$_POST['end_date'];
				
				  $args_banners_week = $mxDb->get_information('level_income_fast_start_bonus', '*', "where 1=1 and (date between '$start_date' and '$end_date') order by l_id asc ",false, 'assoc');
			 }
			 else
			 {
			 // get best offer banners 
			  $args_banners_week = $mxDb->get_information('level_income_fast_start_bonus', '*', "where 1=1 order by l_id asc ",false, 'assoc');
			 }
			  /* ====== show records ======== */
			  if($args_banners_week):
			  	$s_nos = 1;
				
				
				
			  	foreach($args_banners_week as $banners):
				
				
					
              ?>
                <tr>
                  <td><?php echo $s_nos; ?></td>
                  <td><?php echo $banners['invoice_no']; ?></td>
                  <td><?php echo $banners['purcheser_id']; ?></td>
                  <td> <?php echo $banners['income_id']; ?></td>
                   <td>$ <?php echo $banners['invoice_amt']; ?></td>
                   <td>$ <?php echo $banners['invoice_wholesale_price']; ?></td>
                   <td><?php echo $banners['invoice_bv']; ?></td>
                  
                     <td> <?php echo $banners['commission_bv']; ?></td>
                     <td><?php echo $banners['remark']; ?></td>
                        <td><?php echo $banners['total_quantity_invoice_product']; ?></td>
                           <td><?php echo $banners['payout_date']; ?></td>
                              <td><?php echo $banners['date']; ?></td>
                               <td><?php $paid=$banners['paid_status']; if($paid=='0') echo "Pending"; else if($paid=='1') echo "Paid"; else echo "Lapsed";?></td>
                  
                 <?php @$total_amount=$total_amount+$banners['commission_bv'];?>
                 
                </tr>
                <?php $s_nos++;
					endforeach;
				endif;
				?>
                <tr><td  colspan="13">Total Fast Start Bonus Commission <?php echo @$total_amount;?> BV</td></tr>
                  
						
                        
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
