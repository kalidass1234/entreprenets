<?php 
include('header.php');
include("pagination.php");


				
            if(isset($_POST['submit']) && $_POST['action']=='bv_price')
			{
				 $bv=$_POST['bv'];
				 $price=$_POST['price'];
			
			
					$updQry=mysql_query("update bv_price set bv='$bv',price='$price'") or die(mysql_query());
					if($updQry)
					{
						$msg="Successfully updated ";
					}
					
			}
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
                  <div class="pull-left">Product Volume Price <?php echo $user_id;?> </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <?php
				  echo $msg; 
				  $qry=mysql_query("select * from bv_price") or die(mysql_error());
				  $row=mysql_fetch_assoc($qry);
				  ?>
                  <form action="" method="post" class="validate" id='form1'>
                  <input type="hidden" name="action" value="bv_price" />
                 
                      <fieldset>
                        
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">BV</label>
                     		<input type="text" class="validate[required] form-control placeholder" id="ref_id" name="bv" placeholder="User ID" data-bind="value: name" value="<?php echo $row['bv']; ?>" />
                        </div>
                         <div class="left-box">
                            <label for="rank">Price in($)</label>
                     		<input type="text" class="validate[required] form-control placeholder" id="ref_id" name="price" placeholder="User ID" data-bind="value: name" value="<?php echo $row['price']; ?>" />
                        </div>
                       
                          <div class="left-box">
                            <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="submit"  type="submit" id="button" >Submit</button>(<?php echo $row['bv']; ?> BV = <?php echo $row['price']; ?> $)
                        </div>
                      </fieldset>
                  </form>
                  </div>
                </div>
              </div>
          
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