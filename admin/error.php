<?php 
include('header.php');
//echo "<pre>"; print_r($GLOBALS);
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
        
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="index.php" class="bread-current">Dashboard</a>
        </div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row">
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-6">
                <div class="widget">

                
                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      
                      <tbody>

                        <tr>
                          <td><img src="images/error.jpg" /></td>
                          
                        </tr>


                        
                    </tbody>
                    </table>

                    

                  </div>
				 </div>
              </div>
              <!--<div class="col-md-6 portlets">
              <div class="widget">
               
                <div class="widget-head">
                  <div class="pull-left">Calendar</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div id="calendar"></div>
                  </div>
                </div>
              </div> 
               
            </div>-->
              </div>  
            </div>
          </div>
          <div class="row">
           <div class="col-md-12">

				 <!-- Realtime chart starts -->

                <!--<div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Real Time Chart</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>             

                  <div class="widget-content">
                    <div class="padd">
						</div>
                      <div id="live-chart"></div>
                      <hr />
                      Time Inverval: <input id="updateInterval" type="text" class="form-control" value="">
                    </div>
                  </div>-->
                </div>

                <!-- Realtime chart ends -->

            
            
            
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

