<?php
include("header.php");
include("pagination.php");

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
         
            <div class="col-md-12">
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Total Direct Member </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <form action="" method="post" class="validate" id='form1'>
                      <fieldset>
                        
                        
                        <div class="form-group">
                       
                          <div class="left-box">
                            <label for="name">Enter User ID/User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="user_id" name="user_id" placeholder="User ID/User name" data-bind="value: name" />
                         
                        </div>
                    <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>    
              
          </div>
          <div class="widget">
	       <div class="widget-head">
                  <div class="pull-left">Direct Member List</div>
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
                  <th>Member Name</th>
                  <th>Member Id</th>
                  <th>Upline Id</th>
                  <th>Upline Name</th>
                  <th>Sponsor Id</th>
                  <th>Sponsor Name</th>
                  <th>Registration Date</th>
                  <!--<th>Last Modify</th>-->
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			$country_search =  check_country($country_id, $country_name,$admin_type);
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$q=mysql_query("select user_id,user_name from registration where (user_id='$user_id' or user_name='$user_id') $country_search");
					$n=mysql_num_rows($q);
					$r=mysql_fetch_assoc($q);
					$user_id=$r['user_id'];
					
					$search_string.=" and ref_id ='$user_id'";
					$query_string.="&user_id='$user_id'";
				}
				$query_string=http_build_query($_REQUEST);
				$url='direct_member.php?'.$query_string;
			
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
			  $res_products_tol=$obj_query->query("id","registration","1=1 $search_string $con_search order by id ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 
			  $res_cat=$obj_query->query("*","registration"," 1=1 $search_string $con_search order by id $limit");
			  
			  $s_no = 1+(($current_page-1)*$per_page);
			  	
				// get downlines
				
				// end to get downlines
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
				if($row_cat[mem_status]=='0'){
                $status_d='Active';}
                else{$status_d='Inactive';}
			  ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo ucwords($row_cat['user_name']); ?></td>
                  <td><?php echo ucwords($row_cat['user_id']); ?></td>
                  <td><?php echo ucwords($row_cat['nom_id']); ?></td>
                  <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[nom_id]'"); ?></td>
                  <td><?php echo ucwords($row_cat['ref_id']); ?></td>
                  <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[ref_id]'"); ?></td>
                  <td><?php echo $row_cat['reg_date']; ?></td>
                  <td><?php echo $status_d;?></td>
                </tr>
                <?php 
					$s_no++;
			  }
			  
			?>
			
              </tbody>
            </table>
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
            <?php
            }
			?>
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
<?php
include("footer.php");
?>