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

                <div class="widget-head">
                  <div class="pull-left">Overview</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      
                      <tbody>

                        <tr>
                          <td>Total Sales</td>
                          <td><?php echo CURRENCY.''.$obj_function->_get_total_sale(false,'total',false);?></td>
                        </tr>


                        <tr>
                          <td>Total Sales This Year:</td>
                          <td><?php echo CURRENCY.''.$obj_function->_get_total_sale($year,false,false);?></td>
                         </tr>
                        <tr>
                          <td>Total Orders:</td>
                          <td><?php echo CURRENCY.''.$obj_function->_get_total_sale(false,false,'order');?></td>
                         

                        </tr>
                        <tr>
                          <td>Total No. of Users</td>
                          <td><?php echo $obj_function->_get_total_user('total',false,false,false);?></td>
                          </tr>
                       <!-- <tr>
                          <td>Total Non Affiliate Users:</td>
                          <td><?php //echo $obj_function->_get_total_user(false,'pending',false,false);?></td>
                        </tr>
						 <tr>
                          <td>Total Affiliate Users:</td>
                          <td><?php //echo $obj_function->_get_total_user(false,false,'affiliate',false);?></td>
                        </tr>
                         <tr>
                          <td>Total Reseller Users:</td>
                          <td><?php //echo $obj_function->_get_total_user(false,false,false,'reseller');?></td>
                        </tr>
                         <!--<tr>
                          <td>Affiliates Awaiting Approval</td>
                          <td>12</td>
                        </tr>-->
                        
                    </tbody>
                    </table>

                    

                  </div>
				 </div>
                 
                 
                 
                 
                 
                 <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Top Rank Member</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

<?php
	$qry=mysql_query("select ur.rank_name,ura.username from user_rank ur inner join user_rank_achieve ura on ur.id=ura.rank_id order by ura.total_bv desc limit 0,5") or die(mysql_error());
	 $num=mysql_num_rows($qry);
	
	if($num>0)
	{
		?>
                    <table class="table table-striped table-bordered table-hover">
                      
                      <tbody>
<?php

	while($row=mysql_fetch_assoc($qry))
	{
		
		$user_name=$row['username'];
		$rank_name=$row['rank_name'];
		
		
?>
                        <tr>
                          <td><?php echo $user_name;?></td>
                          <td><?php echo $rank_name;?></td>
                        </tr>

<?php
	}
	?>
                       
                    </tbody>
                    </table>
<?php
	}
	else
	{
		echo "There is no rank achiever member";
	}
	?>
                    

                  </div>
				 </div>
                 
                 
                 
                 
                 
                 
              </div>
             <div class="col-md-6 portlets">
              <div class="widget">
               
                <div class="widget-head">
                  <div class="pull-left">Stock Availability</div>
                  <div class="widget-icons pull-right">
                   
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  
                  <?php
                  $qry=mysql_query("select p_cat_id,product_name,image,p_qty from product_category  order by p_qty asc limit 0, 10") or die(mysql_error());
			$num=mysql_num_rows($qry);
			if($num>0)
			{
				?>
                     <table class="table table-striped table-bordered table-hover">
                      <tbody>
                     <tr>
                     <td>Product Name</td><td>Quantity</td>
                     </tr>
                      <?php
				 $i=1;
					
			while($row=mysql_fetch_assoc($qry))
			{
				?>
                     <tr>
                     <td><?php echo $row['product_name']; ?> </td>
                     <td> <?php if($row['p_qty']>20) { echo $row['p_qty']; } else { ?>
                   <span style="color:red;"><?php echo $row['p_qty'];  ?></span><?php } ?></td>
                     </tr>
                     <?php
			}
			?>
            </tbody>
                     </table>
                     <?php
			}
			else
			{
				echo "There is no product";
			}
			?>
                 
                </div>
              </div> 
               
            </div>
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
            <div class="row">
            	    <div class="col-md-12">
                 <h4>Recent Activity</h4>
                    <div class="tabbable" style="margin-bottom: 18px;">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Latest Order</a></li>
                        <li><a href="#tab2" data-toggle="tab">Latest Tickets</a></li>
                        <li><a href="#tab3" data-toggle="tab">Latest Withdraw Request</a></li>
                      </ul>
                      <?php
                      $limit=" limit 10 ";
					  ?>
                      <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                        <div class="tab-pane active" id="tab1">
                          <p><!--class="table table-striped table-bordered table-hover"-->
                          <table class="table  table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>S.no.</th>
                              <th>Date</th>
                              <th>User Name</th>
                              <!--<th>Category Icon</th>-->
                              <th>Invoice No</th>
                              <th>Net Amount</th>
                              <th>Total Amount</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
						  if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					$country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
                            $res_products_tol=mysql_query("select * from amount_detail a inner join registration r on a.user_id=r.user_id where a.status=1 $country_search $search_string $con_search order by a.am_id desc");
                            $total_row=$obj_query->num_row($res_products_tol);
                            //$pages = ceil($total_row/$per_page);
                            $res_cat=mysql_query("select * from amount_detail a inner join registration r on a.user_id=r.user_id where a.status=1 $country_search $search_string $con_search order by a.am_id desc $limit");
                            $s_no = 1;
                            while($row_cat=$obj_query->get_all_row($res_cat))
                            {
                          ?>
                            <tr>
                              <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                               <td><?php echo $row_cat['date']; ?></td>
                              <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                              <td><?php echo $row_cat['invoice_no']; ?></td>
                              <td><?php echo $row_cat['net_amount']; ?></td>
                              <td><?php echo $row_cat['total_amount']; ?></td>
                              <td><a href="admin_main.php?page_number=182&invoice_no=<?php echo $row_cat['invoice_no'];?>" title="View">View</a></td>
                            </tr>
                            <?php 
                                $s_no++;
                          }
                        ?>
                        <tr>
                         </tbody>
                        </table>
                          </p>
                        </div>
                        <div class="tab-pane" id="tab2">
                          <p>
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>S.no.</th>
                              <th>User Name</th>
                              <!--<th>Category Icon</th>-->
                              <th>Subject</th>
                              <th>Type</th>
                              <th>Remark</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
						  
						  
						    if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					$country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}

			 
			  $res_products_tol=mysql_query("select * from tickets f inner join registration r on f.user_id=r.user_id where f.status=0 $country_search $search_string $con_search order by f.id desc") ;
			  
                           // $res_products_tol=$obj_query->query("id","tickets","status=0 $search_string $con_search order by id desc ");
                            $total_row=$obj_query->num_row($res_products_tol);
                            //$pages = ceil($total_row/$per_page);
                            $res_cat=mysql_query("select * from tickets f inner join registration r on f.user_id=r.user_id where f.status=0 $country_search $search_string $con_search order by f.id desc $limit");
                            $s_no = 1;
                            while($row_cat=$obj_query->get_all_row($res_cat))
                            {
                          ?>
                            <tr>
                              <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                              <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                              <td><?php echo $row_cat['subject']; ?></td>
                              <td><?php echo $row_cat['tasktype']; ?></td>
                              <td><?php echo $row_cat['description']; ?></td>
                              <td><?php echo $row_cat['t_date']; ?></td>
                            </tr>
                            <?php 
                                $s_no++;
                          }
                        ?>
                        <tr>
                         </tbody>
                        </table>
                          </p>
                        </div>
                        <div class="tab-pane" id="tab3">
                          <p>
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>S.no.</th>
                              <th>User Name</th>
                              <!--<th>Category Icon</th>-->
                              <th>Admin Charge</th>
                              <th>Request Mode</th>
                              <th>Amount</th>
                              <th>Remark</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                        //print_r($_REQUEST); 
                         if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					$country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}

			 
			  $res_products_tol=mysql_query("select * from withdraw_fund f inner join registration r on f.user_id=r.user_id where (f.status=0 and f.admin_status=0) and f.mode='Personal Account' $country_search $search_string $con_search order by f.id desc") or die(mysql_error());
						  
						  
						  
						 // $res_products_tol=$obj_query->query("id","withdraw_fund","status=0  $search_string $con_search order by id desc ");
						  $total_row=$obj_query->num_row($res_products_tol);
						  $res_cat=mysql_query("select * from withdraw_fund f inner join registration r on f.user_id=r.user_id where (f.status=0 and f.admin_status=0) and f.mode='Personal Account' $country_search $search_string $con_search order by f.id desc $limit");
						  $s_no = 1;
						  $arr_mod=array("Personal Account"=>"Bank Account","Cheque"=>"Cheque","shopdeal"=>"Paypal Account","vtncard"=>"");
                            while($row_cat=$obj_query->get_all_row($res_cat))
                            {
                          ?>
                            <tr>
                              <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                              <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                              <td><?php echo $row_cat['admin_charge']; ?></td>
                              <td><?php echo $arr_mod[$row_cat['mode']]; ?></td>
                              <td><?php echo $row_cat['amount']; ?></td>
                              <td><?php echo $row_cat['desc']; ?></td>
                              <td><?php echo $row_cat['with_date']; ?></td>
                            </tr>
                            <?php 
                                $s_no++;
                          }
                        ?>
                          </tbody>
                        </table>
                          </p>
                        </div>
                      </div>
                    </div>
                    <br>
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

