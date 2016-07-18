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
  <?php
  $arr=array("final_e_wallet"=>"Cash Wallet");
			$arr_history=array("final_e_wallet"=>"credit_debit");
  ?>
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Member Wallet</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb "> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Wallet</a> </div>
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
                <div class="pull-left">Fund Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" method="post" id='form1'>
                  
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> User Id/User Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="user_name" value="<?php echo $_POST['user_name'];?>" id="user_name" placeholder="User Id/ User name" data-bind="value: name" />
                        </div>
                        
                        
                      </div>
                     <!-- <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Wallet Type</label>
                          <select name="wallet_type" required class="validate[required] form-control placeholder">
                          <option value="">Select Wallet</option>
                          	<?php //$obj_function->_get_wallet_type($_POST['wallet_type']);?>
                          </select>
                        </div>
                        
                        
                      </div>-->
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
        <?php
		if(isset($_REQUEST['wallet_type']))
		{
		?>  
      <!--<a style="float:left" href="<?php echo SITE_URL; ?>admin/add_fund.php?wallet_type=<?php echo $_REQUEST['wallet_type'];?>"> <button class="btn btn-danger side"  type="button" id="button"  >Add Fund in <?php echo $arr[$_REQUEST['wallet_type']];?></button></a>
      &nbsp;&nbsp;
      <a href="<?php echo SITE_URL; ?>admin/deduct_fund.php?wallet_type=<?php echo $_REQUEST['wallet_type'];?>"> <button class="btn btn-danger side"  type="button" id="button" >Deduct Fund From <?php echo $arr[$_REQUEST['wallet_type']];?></button></a>-->
      <?php
      }
	  ?>
      <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Wallet List</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>User Name</th>
                  <!--<th>Category Icon</th>-->
                  <th>Amount</th>
                  <!--<th>Last Modify</th>-->
                  <!--<th>Actions</th>-->
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			
			if(isset($_REQUEST['wallet_type']))
			{
				$wallet_type='final_e_wallet';
			}
			else
			{
				$wallet_type='';
			}
			
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
				{
					
					// get user id
					$res_user=$obj_query->query("*","registration"," user_name='$user_name' or user_id='$user_name'");
					$row_user=$obj_query->get_all_row($res_user);
					$user_id=$row_user['user_id'];
					$user_name=$row_user['user_name'];
					$search_string.=" and user_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
				
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=54&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=54&1=1'.$search_string;
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
		if($wallet_type='final_e_wallet')
		{
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  
			  
			  $res_products_tol=mysql_query("select * from final_e_wallet where 1=1 $search_string $con_search order by id desc $limit") ;
			  
			  
			 // $res_products_tol=$obj_query->query("id",'final_e_wallet',"1=1 $search_string $con_search order by id desc ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
					
			  $res_cat=mysql_query("select * from final_e_wallet where 1=1 $search_string $con_search order by id desc $limit");
			  
			  $s_no = 1;
			  	
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                  <td><?php echo round($row_cat['amount'],2); ?></td>
                  <!--<td><?php echo $row_cat['last_modify']; ?></td>-->
<!--                  <td>&nbsp;
                  <span><a href="admin_main.php?page_number=55&user_id=<?php echo $row_cat['user_id'];?>&user_name=<?php echo $row_cat['user_name'];?>&wallet_type=<?php echo $wallet_type;?>" title="Edit"><img src="../images/edit.png" /></a></span></td>-->
                </tr>
                <?php 
				$s_no++;
			  }
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