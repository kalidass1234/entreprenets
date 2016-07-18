<?php
include("header.php");
include("pagination.php");
?>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <?php include("nav.php");?>
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
         
            <div class="col-md-12">
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Final Bonus Report </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=53"  method="post" class="validate" id='form1'>
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date From</label>
                            <input data-format="yyyy-MM-dd" type="date" name="from_date" class="form-control dtpicker">
                           </div>
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date to</label>
                            <input data-format="yyyy-MM-dd" type="date" name="to_date" class="form-control dtpicker">
                            </div>
                        </div>
                        
                        <div class="form-group">
                         
                          <div class="left-box">
                            <label for="name"> User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_name" placeholder="User Name" data-bind="value: name" />
                          </div>
                        </div>
                         <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
              
              
          </div>
        <div class="row">  <div class="printer">
        
        
       
                       
                       <img src="../images/print.png"  onClick="printDiv('example');">
                       
                       
                      <script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>

        
      </div></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Final Bonus Report Detail</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content" id="example">

                   <table class="table table-striped table-bordered table-hover">
                        <?php
				if(isset($_POST['search']) && $_POST['user_name']!='')
				{
					$cond="where user_name='".$_POST['user_name']."'";
				}
					
			$qry=mysql_query("select user_id,user_name from registration $cond") or die(mysql_error());
			$num=mysql_num_rows($qry);
			if($num>0)
			{
					?>
						<thead>
                        
						<tr>
                        <th>S. No.</th>
							<th>User Id</th>
                            <th>User Name</th>
							<th>Direct Refferal Bonus</th>
							<th>Upgrade Bonus</th>
							<th>Binary Bonus</th>
                            <th>5 Star Special Bonus</th>
                            <th>Matching Bonus</th>
                             <th>Repurchase Bonus (Generation)</th>
                            <th>Total</th>
						</tr>
						</thead>
						<tbody>
                 
                 
                 <?php
				 $i=1;
					
			while($row=mysql_fetch_assoc($qry))
			{
				$id=$row['user_id'];
				$username=$row['user_name'];
				
				if(isset($_POST['search']))
				{
					$from_date=$_POST['from_date'];
					$to_date=$_POST['to_date'];
				}
				
					
						
				$commission=total_direct_referral_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				$commission1=total_upgrade_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				$commission2=total_binary_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				$commission3=total_five_star_special_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				$commission4=total_matching_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				$commission5=total_repurchase_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				$commission6=total_repurchase__binary_commission($id,$from_date,$to_date,$country_id,$country_name,$admin_type);
				if(	($commission!=0) ||($commission1!=0) ||($commission2!=0) ||($commission3!=0) ||($commission4!=0) ||($commission5!=0) ||($commission6!=0))
				{
						
				$total=$commission+$commission1+$commission2+$commission3+$commission4+$commission5+$commission6; ?>
						<tr>
						 <td class="center">
                        <?php echo $i;?> 
						</td>
                         <td class="center">
                        <?php echo $id;?> 
						</td>
                         <td class="center">
                        <?php echo $username;?> 
						</td>
                      
                        <td class="center">
                        <?php if( $commission=='') echo "0"; else  echo $commission;?> 
						</td>
                        <td class="center">
                        <?php if( $commission1=='') echo "0"; else  echo $commission1;?> 
						</td>
                        <td class="center">
                        <?php if( $commission2=='') echo "0"; else  echo $commission2;?> 
						</td>
                        <td class="center">
                        <?php if( $commission3=='') echo "0"; else  echo $commission3;?> 
						</td>
                        <td class="center">
                        <?php if( $commission4=='') echo "0"; else  echo $commission4;?> 
						</td>
                        <td class="center">
                        <?php if( $commission5=='') echo "0"; else  echo $commission5;?> 
						</td>
                        <td class="center">
                        <?php if( $total=='') echo "0"; else  echo $total;?> 
						</td>
						</tr>
                        <?php
			}
			}
			?>
						</tbody>
                        <?php
			}
			else
			{
				
			?>
                        <tfoot>
                        <tr><td><?php echo "There is no commission"; ?></td></tr></tfoot>
                        <?php
			}
			?>
						</table>
                        
                 
                   <!-- <div class="export padding-space"><a href="#">Export in excel</a></div>-->
                    <div class="widget-foot">
                     <?php //echo pagination($url,$parameters,$pages,$current_page);?>
                      <!--  <ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>
                     -->
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