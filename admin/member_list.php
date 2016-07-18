<?php 
include('header.php');
include("pagination.php");

?>
<!-- Main content starts -->
<script src="../dist/country.js"></script>
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
                  <div class="pull-left">Member List</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=1" class="validate" method="post" id='form1'>
                      <fieldset>
                       <!-- <div class="form-group">
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date From</label>
                            <input data-format="yyyy-MM-dd" type="date" class="form-control dtpicker">
                           </div>
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date to</label>
                            <input data-format="yyyy-MM-dd" type="date" class="form-control dtpicker">
                            </div>
                        </div>-->
                        <!--<div class="form-group">
                          <div class="left-box">
                            <label for="name"> First Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="first_name" placeholder="First name" data-bind="value: name" />
                          </div>
                          <div class="left-box">
                            <label for="name"> Last Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personlName" name="last_name" placeholder="Last name" data-bind="value: name" />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">User Id</label>
                            <input type="text" class="validate[required] form-control placeholder" id="User_Id" name="user_id" placeholder="User Id" data-bind="value: name" />
                          </div>-->
                         <!-- <div class="left-box">
                            <label for="name" >Member Categary</label>
                            <select name="package" required="required" class="validate[required] form-control placeholder" id="personName">
                              <option value="volvo">--choose package--</option>
                              <option value="saab">Saab 95</option>
                              <option value="mercedes">Mercedes SLK</option>
                              <option value="audi">Audi TT</option>
                            </select>
                          </div>-->

                       <!-- </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="user_name" name="user_name" placeholder="User name" data-bind="value: name" />
                          </div>
                          
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="email">Email address</label>
                            <input type="email" class="validate[required,custom[email]] form-control placeholder" id="personEmail" name="email" placeholder="E-mail" data-original-title="Your activation email will be sent to this address." data-bind="value: email, event: { change: checkDuplicateEmail }" />
                          </div>

                          <div class="left-box">
                            <label for="email">Sponsor Id</label>
                            <input type="text" class="validate[required,custom[email]] form-control placeholder" id="sponsor" name="sponsor" placeholder="Your Sponsor Id" data-original-title="Your activation email will be sent to this address." data-bind="value: email, event: { change: checkDuplicateEmail }" />
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="left-box">
                            <button name="search" class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                          </div>
                        </div>
                      </fieldset>-->
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Member List</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content">
                  <form name="member_list" id="member_list" action="<?php echo SITE_URL;?>admin/excel/index.php" method="post">
                    <div style="width:96%; " id="printArea">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th valign="top">C.bx</th>
                          <th valign="top">S.no.</th>
                          <th valign="top">Member Id</th>
                          <th valign="top">User Name</th>
                          <th valign="top">Name</th>
                          <th valign="top">Email</th>
                         <!-- <th>Rank</th>-->
                          <th valign="top">Status</th>
                          <th valign="top">Sponser Id</th>
                           <th valign="top">Total E-wallet</th>

                          <!-- <th>Reseller</th>-->
                           <th valign="top">Date</th>
                            <th valign="top">View</th>
                           <!-- <th>Product Selection</th>-->
                        </tr>
                      </thead>
                      <tbody>
						<?php
						// $country_search=  check_country($country_id, $country_name,$admin_type);

						if(isset($_REQUEST['search']))
						{
							
							extract($_REQUEST);
							if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
							{
								$search_string.=" and user_id='$user_id'";
								$query_string.="&user_id='$user_id'";
							}
							if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
							{
								$search_string.=" and user_name='$user_name'";
								$query_string.="&user_name='$user_name'";
							}

							if(isset($_REQUEST['email']) && $_REQUEST['email']!='')
							{
								$search_string.=" and email='$email'";
								$query_string.="&email='$email'";
							}

						}
						if(isset($_REQUEST['search']))
						{
							$query_string=http_build_query($_REQUEST);
							$url='admin_main.php?page_number=1&'.$query_string;
						}
						else
						{
							$url='admin_main.php?page_number=1&'.$search_string;
						}
						//echo $search_string;
						//$url='member_list.php?';
						if(isset($_GET['page']) && $_GET['page']!='' && is_numeric($_GET['page']))
						{
							$current_page=$_GET['page'];
						}
						else
						{
							$current_page = 1;
						}
						//echo $current_page;
						$pageno = $current_page;
						$per_page=100;
						if($per_page != "all"){
							$per_page_rec = $per_page;
							$pageno--;
							$start = (int)($pageno*$per_page_rec);
							$last = $per_page_rec;
							$limit = "limit $start , $last";
						}
						else
							$limit = " ";
						//echo $search_string;
                        $res=$obj_query->query("*","registration","1=1 $search_string $limit");
						$res_products_tol=$obj_query->query("id","registration","1=1 $search_string $country_search $con_search ");
						$total_row=$obj_query->num_row($res_products_tol);
						 $pages = ceil($total_row/$per_page);
						$sno=1;
						while($row=$obj_query->get_all_row($res))
						{
						?>
                        <tr>
                          <td><input  type="checkbox" name="user_id[]" checked="checked" value="<?php echo $row['user_id'];?>" /></td>
                          <td><?php echo $sno;?></td>
                          <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $row['user_name'];?></td>
                          <td><?php echo $row['first_name'].' '.$row['mid_name'].' '.$row['last_name'];?></td>
                          <td><?php echo $row['email'];?></td>
                          <!--<td><?php //echo $row['user_plan'];?></td>-->
                          <td><?php if( $row['mem_status']==0) echo "Active"; else echo "Inactive";?></td>
                          <td><?php echo $row['ref_id'];?></td>
                          <td><?php echo round($obj_query->get_field_name("final_e_wallet","amount"," user_id='$row[user_id]'"),2);?></td>
                         <!-- <td><?php //if($row['reseller']) echo "Reseller";?></td>-->
                          <td><?php echo $row['reg_date'];?></td>
                          <td><a href="admin_main.php?page_number=2&userid=<?php echo $row['user_id'];?>">Details</a></td>
                         <!-- <td><a href="admin_main.php?page_number=161&userid=<?php //echo $row['user_id'];?>">Product Selection</a></td>-->
                        </tr>
						<?php
						$sno++;
                        }
						?>
                      </tbody>
                    </table>
                    </div>
                    <div class="export"><a href="exportBinaryBonus.php">Export in excel</a></div>
                    <div class="export"><a href="javascript:void();" onclick="coderHakan()">Print</a></div>
                    </form>
                    <div class="widget-foot">
                    <?php echo pagination($url,$parameters,$pages,$current_page);?>
                        <!--<ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>-->
                      <div class="clearfix"></div> 
                    </div>
                  </div>
                </div>
        </div>
		<!-- Matter ends -->
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
<script>function coderHakan(){var sayfa = window.open('','','width=800,height=800');sayfa.document.open("text/html");sayfa.document.write(document.getElementById('printArea').innerHTML);sayfa.document.close();sayfa.print();
}

</script>