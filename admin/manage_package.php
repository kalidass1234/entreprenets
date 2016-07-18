<?php
include("header.php");
?>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <?php
    include("nav.php");
	?>
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
          <a href="#" class="bread-current">Dashboard</a>
        </div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">
         <div class="row">
         
            
              
              
          </div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Package Details</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Package Name</th>
                          <th>Product Name</th>
                          <th>Product Cost</th>
                          <th>Registration Fees</th>
                          <th>Other Fees</th>
                          <th>VP</th>
                          <th>Total</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>1</td>
                          <td>John Doe</td>
                          <td>Norway</td>
                          <td>550</td>
                          <td>950</td>
                          <td>0</td>
                           <td>0</td>
                            <td>Paid</td>
                          <td><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                              </td>
                        </tr>


                        <tr>
                          <td>1</td>
                          <td>John Doe</td>
                          <td>Norway</td>
                          <td>550</td>
                          <td>950</td>
                          <td>0</td>
                           <td>0</td>
                            <td>Paid</td>
                          <td><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                              </td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>John Doe</td>
                          <td>Norway</td>
                          <td>550</td>
                          <td>950</td>
                          <td>0</td>
                           <td>0</td>
                            <td>Paid</td>
                          <td><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                              </td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>John Doe</td>
                          <td>Norway</td>
                          <td>550</td>
                          <td>950</td>
                          <td>0</td>
                           <td>0</td>
                            <td>Paid</td>
                          <td><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                              </td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>John Doe</td>
                          <td>Norway</td>
                          <td>550</td>
                          <td>950</td>
                          <td>0</td>
                           <td>0</td>
                            <td>Paid</td>
                          <td><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                              </td>
                        </tr>                                                            

                      </tbody>
                    </table>
					<div class="widget-foot">
                        <ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>
                      <div class="clearfix"></div> 
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