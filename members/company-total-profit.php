<?php define('ABSPATH','../../lib/'); include('../header.php'); 

// get main cateogries
$args_categories = $mxDb->get_information('categories', '*', ' order by category_id asc',false, 'assoc');

// unset table name from session
if(isset($_SESSION['cat_tbl']))
	unset($_SESSION['cat_tbl']);

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
	      <h2 class="pull-left">Company Total Profit</h2>
        
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Company Total Profit</a>
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
              <div class="col-md-12">
                <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Overview</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content" >

                    <table class="table table-striped table-bordered table-hover" >
                      
                      <tbody>

                        <tr>
                          <td>No. of Users</td>
                          <td><?php $res_user=mysql_query("select * from user_registration where user_status='0' and admin_status='0'");
						            $res=mysql_num_rows($res_user);
									
									$res_user1=mysql_query("select * from user_registration where user_status!='0' || admin_status!='0'");
						            $res1=mysql_num_rows($res_user1);
									$total_user=$res+$res1;
									?>
                                    <?php echo $total_user;?>
                                    
						  </td>
                          </tr>
                        
                          
                          
                          <tr>
                          <td>No. of Package Services Users</td>
                          <td><?php $starter_kit_user2=mysql_query("select * from user_registration where user_status='0' and admin_status='0' and plan_name!='1' and plan_name!='0'");
						            $starter_kit_user2=mysql_num_rows($starter_kit_user2);
									
									?>
                                    <?php echo $starter_kit_user2;?>
                                    
						  </td>
                          </tr>
                        
                        
                        
                          <tr>
                          <td>No. of Product Sale</td>
                          <td><?php $res_amount=mysql_query("select * from amount_detail");
						            $res_amt=mysql_num_rows($res_amount);
									
								?>
                                    <?php echo $res_amt;?>
                                    
						  </td>
                          </tr>
                        
                          <tr>
                          <td>Total Amount Of Product Sales</td>
                          <td><?php $res_amount1=mysql_query("select * from amount_detail");
						            while($res_amt1=mysql_fetch_array($res_amount1))
									{
                                          $amt=$res_amt1['total_amount'];
									      @$amt1=$amt1+$amt; 
									}
								?>
                                    <?php echo "$ ".@$amt1;?>
                                    
						  </td>
                          </tr>
                          
                          
                           <tr>
                          <td>Total Amount Of Starter Kit Sales</td>
                          <td><?php $res_amounts1=mysql_query("select * from registration_payment where plan_name='Business Success Starter Kit'");
						            $nums=mysql_num_rows($res_amounts1);
						            while($res_amts1=mysql_fetch_array($res_amounts1))
									{
                                          $amts=$res_amts1['amount'];
									      @$amts1=$amts1+$amts; 
									}
								?>
                                  
                                     <?php echo "$ ".@$amts1;?>
						  </td>
                          </tr>
                          
                            <tr>
                          <td>Total Amount Of Package Sales</td>
                          <td><?php $pres_amounts1=mysql_query("select * from registration_payment where plan_name!='Business Success Starter Kit'");
						            $numsp=mysql_num_rows($pres_amounts1);
						            while($pres_amts1=mysql_fetch_array($pres_amounts1))
									{
                                          $pamts=$pres_amts1['amount'];
									      @$pamts1=$pamts1+$pamts; 
									}
								?>
                                  
                                     <?php echo "$ ".@$pamts1;?>
						  </td>
                          </tr>
                         
					 <tr>
                          <td>Total Number Of Sales (Complete)</td>
                          <td><?php echo "$ ".@$s=$amts1+$pamts1+$amt1;?>
						  </td>
                          </tr>
                          
                        
                    </tbody>
                    </table>

                    

                  </div>
				 </div>
                 
                 
                 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Commision Profit Report</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content" >
<?php $res_userss=mysql_fetch_array(mysql_query("select * from registration_points where id='12'"));
$points=$res_userss['point'];
?>
                    <table class="table table-striped table-bordered table-hover" >
                      
                      <tbody>
                      
                       <tr>
                          <td>Registration Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user8=mysql_query("select * from level_income_registration where paid_status='1'");
						            while($breakeven_bonus8=mysql_fetch_array($breakeven_res_user8))
									{
										@$breakeven_profit8=@$breakeven_profit8+$breakeven_bonus8['commission'];
									}
									
									?>
                                    <?php echo "$". $tot=@$breakeven_profit8/$points;?>
                                    
						  </td>
                          </tr> 
                      
                         <tr>
                          <td>Product Purchase Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user2=mysql_query("select * from level_product_purchase_bonus where paid_status='1'");
						            while($breakeven_bonus2=mysql_fetch_array($breakeven_res_user2))
									{
										@$breakeven_profit2=@$breakeven_profit2+$breakeven_bonus2['commission'];
									}
									
									?>
                                    <?php echo "$". $tot1=@$breakeven_profit2/$points;?>
                                    
						  </td>
                          </tr> 

                        <tr>
                          <td>Retail Profit Bonus Given Till Now</td>
                          <td><?php $retail_res_user=mysql_query("select * from level_income_retail where paid_status='1'");
						            while($retail_bonus=mysql_fetch_array($retail_res_user))
									{
										@$retail_profit=@$retail_profit+$retail_bonus['commission'];
									}
							  ?>
                                    <?php echo "$". $tot2=@$retail_profit;?> <?php if(!$retail_profit) echo "0";?>
                              </td>
                          </tr>
                        
                              <tr>
                          <td>Break Even Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user=mysql_query("select * from level_income_break_even_bonus where paid_status='1'");
						            while($breakeven_bonus=mysql_fetch_array($breakeven_res_user))
									{
										@$breakeven_profit=@$breakeven_profit+$breakeven_bonus['commission'];
									}
									
									?>
                                    <?php echo "$". $tot3=@$breakeven_profit/$points;?>
                                    
						  </td>
                          </tr>
                        
                           <tr>
                          <td>Fast Start Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user1=mysql_query("select * from level_income_fast_start_bonus where paid_status='1'");
						            while($breakeven_bonus1=mysql_fetch_array($breakeven_res_user1))
									{
										@$breakeven_profit1=@$breakeven_profit1+$breakeven_bonus1['commission'];
									}
									
									?>
                                    <?php echo "$". $tot4=@$breakeven_profit1/$points;?>
                                    
						  </td>
                          </tr>
                        
                                              
                       
                       <tr>
                          <td>Weekly Matrix Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user3=mysql_query("select * from level_weekly_matrix_bonus where paid_status='1'");
						            while($breakeven_bonus3=mysql_fetch_array($breakeven_res_user3))
									{
										@$breakeven_profit3=@$breakeven_profit3+$breakeven_bonus3['commission'];
									}
									?>
                                    <?php echo "$". $tot5=@$breakeven_profit3/$points;?>
                                    
						  </td>
                          </tr> 
                       
                        
                       <tr>
                          <td>Weekly Matrix Match Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user4=mysql_query("select * from level_weekly_matrix_match_bonus where paid_status='1'");
						            while($breakeven_bonus4=mysql_fetch_array($breakeven_res_user4))
									{
										@$breakeven_profit4=@$breakeven_profit4+$breakeven_bonus4['commission'];
									}
									?>
                                    <?php echo "$". $tot6=@$breakeven_profit4/$points;?>
                                    
						  </td>
                          </tr> 
                       
                         
                       <tr>
                          <td>Weekly Coded Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user5=mysql_query("select * from level_coded_bonus where paid_status='1'");
						            while($breakeven_bonus5=mysql_fetch_array($breakeven_res_user5))
									{
										@$breakeven_profit5=@$breakeven_profit5+$breakeven_bonus5['commission'];
									}
									?>
                                    <?php echo "$". $tot7=@$breakeven_profit5/$points;?>
                                    
						  </td>
                          </tr> 
                          
                            <tr>
                          <td>Weekly Coded Match Bonus Given Till Now</td>
                          <td><?php $breakeven_res_user6=mysql_query("select * from level_coded_bonus where paid_status='1'");
						            while($breakeven_bonus6=mysql_fetch_array($breakeven_res_user6))
									{
										@$breakeven_profit6=@$breakeven_profit6+$breakeven_bonus6['commission'];
									}
									?>
                                    <?php echo "$". $tot8=@$breakeven_profit6/$points;?>
                                    
						  </td>
                          </tr> 
                       
                         <tr>
                          <td>Total Bonus Given Till Now</td>
                          <td>$ <?php echo $tots=$tot+$tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8; ?>
                                    
						  </td>
                          </tr> 
                       
                         
                         <tr>
                          <td><strong>Total Profit to Company</strong> </td>
                          <td><strong>$ <?php echo $s-$tots;?></strong>
                                    
						  </td>
                          </tr> 
                       
                    </tbody>
                    </table>

                    

                  </div>
				 </div>
                 
                 
                 
              </div>
              <!--<div class="col-md-6 portlets">
              <div class="widget">
                <!-- Widget title -->
                <!--<div class="widget-head">
                  <div class="pull-left">Calendar</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <!-- Widget content -->
                  <!--<div class="padd">
                    <!-- Below line produces calendar. I am using FullCalendar plugin. -->
                    <!--<div id="calendar"></div>
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
            <!--<div class="row">
            	    <div class="col-md-12">
                 <h4>Recent Activity</h4>
                    <div class="tabbable" style="margin-bottom: 18px;">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Task</a></li>
                        <li><a href="#tab2" data-toggle="tab">Tickets</a></li>
                        <li><a href="#tab3" data-toggle="tab">Comment</a></li>
                      </ul>
                      <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                        <div class="tab-pane active" id="tab1">
                          <p></p>
                        </div>
                        <div class="tab-pane" id="tab2">
                          <p></p>
                        </div>
                        <div class="tab-pane" id="tab3">
                          <p></p>
                        </div>
                      </div>
                    </div>
                    <br>

            
            
            
            
            
            
            
            	</div>
            
            </div>-->
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

