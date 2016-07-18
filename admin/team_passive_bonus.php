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
                  <div class="pull-left">Team Passive Bonus Detail </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <p>Select The Period Of Date Using Following Date Options</p>
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=52"  method="post" class="validate" id='form1'>
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
                            <label for="name"> User Id</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_id" placeholder="User Id" data-bind="value: name" />
                          </div>
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
        <div class="row">  <div class="printer"><img src="images/printer_icon.png"></div></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Team Passive Bonus</div>
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
                          <th>S.no.</th>
                          <th>Member Id</th>
                          <th>Name</th>
                          <th>Down Id</th>
                          <th>Down Name</th>
                          <th>Commission</th>
                          <th>Level </th>
                   		  <th>Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
            <?php
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
				{
					
					// get user id
					$res_user=$obj_query->query("*","registration"," user_name='$user_name' or user_id='$user_name'");
					$row_user=$obj_query->get_all_row($res_user);
					$user_id=$row_user['user_id'];
					$search_string.=" and income_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and income_id='$user_id'";
					$query_string.="&user_id='$user_id'";
				}
				
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=52&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=52&'.$search_string;
			}
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
			$per_page=10;
			if($per_page != "all"){
				$per_page_rec = $per_page;
				$pageno--;
				$start = (int)($pageno*$per_page_rec);
				$last = $per_page_rec;
				$limit = "limit $start , $last";
			}
			else
				$limit = " ";
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  $res_products_tol=$obj_query->query("l_id","level_income_team_passive","1=1 $search_string $con_search order by l_id desc ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 
			  $res_cat=$obj_query->query("*","level_income_team_passive"," 1=1 $search_string $con_search order by l_id desc $limit");
			  
			  $s_no = 1+$start;
			 $arr_status=array("Pending","Paid","Cancel");
			  while($row_cat=$obj_query->get_all_row($res_cat))
			 {
              ?>
                <tr>
                    <td><?php echo $s_no;?></td>
                    <td><?php echo $row_cat['income_id'];?></td>
                    <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[income_id]'");?></td>
                    <td><?php echo $row_cat['purcheser_id'];?></td>
                    <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[purcheser_id]'");?></td>
                    <td><?php echo $row_cat['commission'];?></td>
                    <td><?php echo $row_cat['level'];?></td>
                    <td><?php echo $row_cat['date'];?></td>
                    <td><?php echo $arr_status[$row_cat['status']];?></td>
                </tr>
				<?php
				$s_no++;
                }
				?>
                </tbody>
                    </table>
                    <div class="export padding-space"><a href="#">Export in excel</a></div>
                    <div class="widget-foot">
                     <?php echo pagination($url,$parameters,$pages,$current_page);?>
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