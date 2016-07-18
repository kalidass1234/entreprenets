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
      <h2 class="pull-left">Categories</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Main Category</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
       <a href="javascript:void(0);"> <button class="btn btn-danger side"  type="button" id="button" onclick="showonregcheck();">Apply Changes</button></a>
      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Categories List</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Company Name</th>
                  <!--<th>Category Icon</th>-->
                  <th>Registration Date</th>
                  <th>Set As Default Sponsor</th>
                  <!--<th>Actions</th>-->
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1)
			{
				$c_id=$_REQUEST['category_id'];
				$obj_query->query_execute("delete from cms_category where id='$c_id'");
			}
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['category_name']) && $_REQUEST['category_name']!='')
				{
					$search_string.=" and category_name like '%$category_name%'";
					$query_string.="&category_name='$category_name'";
				}
				if(isset($_REQUEST['status']) && $_REQUEST['status']!='')
				{
					$search_string.=" and status='$status'";
					$query_string.="&status='$status'";
				}
				if((isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='') && (isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=''))
				{
					$search_string.=" and (add_date>='$from_date' and add_date<='$to_date' )";
					$query_string.="&from_date='$from_date'&to_date='$to_date'";
				}
				else if(isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='')
				{
					$search_string.=" and add_date>='$from_date'";
					$query_string.="&from_date='$from_date'";
				}
				else if(isset($_REQUEST['to_date']) && $_REQUEST['to_date']!='')
				{
					$search_string.=" and add_date<='$to_date'";
					$query_string.="&to_date='$to_date'";
				}
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=160&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=160&'.$search_string;
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
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  $res_products_tol=$obj_query->query("id","registration"," bonus=1 $search_string $con_search order by user_name ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
			  $res_cat=$obj_query->query("*","registration"," bonus=1 $search_string $con_search order by user_name $limit");
			  $s_no = 1;
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                  <td><?php echo $s_no; ?></td>
                  <td><?php echo ucwords($row_cat['user_name']); ?></td>
                  <!--<td><img src="<?php echo SITE_URL."images/".$row_cat['icon']; ?>" /></td>-->
                  <td><?php echo $row_cat['reg_date']; ?></td>
                  <td><input type="radio" name="showonreg" <?php if($row_cat['show_reg_page']){ echo "checked";}?> value="<?php echo $row_cat['id'];?>" /></td>
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
<script type="text/javascript">

function showonregcheck(id) {
/*var allVals = [];
$('input[name="showonreg"]:checked').each(function() {
	allVals.push($(this).val());
}
alert(allVals);*/
var catids=$("input[name='showonreg']:checked").map(
     function () {return $(this).val();}).get().join(",");
	 
/*var catids=$('input[name="showonreg[]"]:checked').join(',');
alert(catids);*/
	var formData="action=setsponsor&catids="+catids;
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            alert(data);
        }
    });
}
</script>