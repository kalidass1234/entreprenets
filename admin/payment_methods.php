<?php
include('header.php');
include("pagination.php");
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
      <h2 class="pull-left">Payment Methods</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb "> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span>Payment Methods</div>
      <div class="clearfix"></div>
      <div class="error_page">
       <div class="error">
       	<h1 class="green"><?php echo $_GET['msg'];?></h1>
       </div>
      </div>
    </div>
    
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
        
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left"> Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" method="post" id='form1'>
                  <input type="hidden" name="action" value="add_package">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name">Type</label>
                          <select name="type" class="validate[required] form-control placeholder">
                          	<option value="paypal" >Paypal</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <a style="float:left" href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=40"> <button class="btn btn-danger side"  type="button" id="button"  >Add Payment Methods</button></a>
      <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Payment Methods List</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Payment Type</th>
                  <th>Merchant Account</th>
                 <!-- <th>Production Url</th>-->
                  <!--<th>Return Url</th>
                   <th>Return Url</th>
                  <th>Notify Url</th>-->
                  <th>Test Merchant Account</th>
                  <!--<th>Test Url</th>-->
                  <th>Status</th>
                  <th>Mode</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1)
			{
				$c_id=$_REQUEST['category_id'];
				$obj_query->query_execute("delete from member_package where id='$c_id'");
			}
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
				{
					$search_string.=" and user_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=39&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=39&'.$search_string;
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
			  $res_products_tol=$obj_query->query("id","payment_methods","1=1 $search_string $con_search order by id desc ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
			  $res_cat=$obj_query->query("*","payment_methods"," 1=1 $search_string $con_search order by id desc $limit");
			  $s_no = 1;
			  $arr_status=array("Active","Inactive");	
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                 <td><?php echo $s_no; ?></td>
                 <td><?php echo $row_cat['type'];?></td>
                 <td><?php echo $row_cat['merchant_account'];?></td>
                <!-- <td><?php echo $row_cat['production_url'];?></td>-->
                 <!--<td><?php echo $row_cat['return_url'];?></td>
                 <td><?php echo $row_cat['cancel_url'];?></td>
                 <td><?php echo $row_cat['notify_url'];?></td>-->
                 <td><?php echo $row_cat['test_merchant_account'];?></td>
                 <!--<td><?php echo $row_cat['test_url'];?></td>-->
                 <td><?php echo $arr_status[$row_cat['status']];?></td>
                 <td><?php echo $row_cat['mode']; ?></td>
                 <td>&nbsp;
                  <span><a href="admin_main.php?page_number=40&id=<?php echo $row_cat['id'];?>" title="Edit"><img src="../images/edit.png" /></a></span>
                 </td>
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
          </div>
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