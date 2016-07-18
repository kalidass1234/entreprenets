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
      <h2 class="pull-left">Products</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Products</a> </div>
      <div class="clearfix"></div>
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
                <div class="pull-left">Products Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="admin_main.php?page_number=13" class="validate" method="post" id='form1'>
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box  input-append" id="datetimepicker1">
                          <label for="date">Date From</label>
                          <input data-format="yyyy-MM-dd" name="from_date" type="date" value="<?php echo $_POST['from_date'];?>" class="form-control dtpicker">
                        </div>
                        <div class="left-box  input-append" id="datetimepicker1">
                          <label for="date">Date to</label>
                          <input data-format="yyyy-MM-dd" type="date" name="to_date" value="<?php echo $_POST['to_date'];?>" class="form-control dtpicker">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Category Name</label>
                          <select name="cat_id" class="form-control placeholder">
                          <option value="">Select Category</option>
                          <?php
                            $field_arr=array("c_id","category_name");
							$condition=" status=0";
							$obj_query->get_dropdown("category_shop",$field_arr,$condition,"c_id","category_name",$_REQUEST['cat_id']);?>
                          </select>
                          
                        </div>
                        <div class="left-box">
                          <label for="name" >Product Name</label>
                           <input type="text" class="validate[required] form-control placeholder" id="product_name" value="<?php echo $_REQUEST['product_name'];?>" placeholder="Product name" data-bind="value: name" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                        <br />
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
        <a href="javascript:void(0);" style="float:left" onclick="special_product('special_product')"> <button class="btn btn-danger side"  type="button" id="button" >Apply To Special Product</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
        
     <!-- <a href="javascript:void(0);" style="float:left" onclick="apply_dailytask('stock_to_sell')"> <button class="btn btn-danger side"  type="button" id="button" >Apply To Stock To Sell</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="javascript:void(0);" style="float:left; margin-left:5px;" onclick="apply_dailytask('qualification')"> <button class="btn btn-danger side"  type="button" id="button" >Apply To Qualification</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="javascript:void(0);" style="float:left; margin-left:5px;" onclick="apply_dailytask('daily_task')"> <button class="btn btn-danger side"  type="button" id="button" >Apply To Daily Task</button></a>&nbsp;&nbsp;&nbsp;&nbsp;    
      <a href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=14"> <button class="btn btn-danger side"  type="button" id="button" >Add Products</button></a>-->
      
           <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Product List</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Product Volume</th>
                <th>Product Image</th>
                  <!--<th>Product PDF</th>
                  <th>Product Video</th>-->
                 <!-- <th>Product EXE</th>
                  <th>Product ZIP</th>-->
                  <th>Date</th>
                  <!--<th>Last Modify</th>-->
                  <th>Add Product Image</th>
                  <th>Actions</th>
                  <th>Web View</th>
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1)
			{
				$p_id=$_REQUEST['product_id'];
				$obj_query->query_execute("delete from product_category where p_cat_id='$p_id'");
			}
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id']!='')
				{
					$search_string.=" and cat_id ='$cat_id'";
					$query_string.="&cat_id='$cat_id'";
				}
				if(isset($_REQUEST['product_name']) && $_REQUEST['product_name']!='')
				{
					$search_string.=" and product_name like '%$product_name%'";
					$query_string.="&product_name='$product_name'";
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
				$url='admin_main.php?page_number=13&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=13&'.$search_string;
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
			  $res_products_tol=$obj_query->query("p_cat_id","product_category","status=0 $search_string $con_search order by p_cat_id ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 
			  $res_cat=$obj_query->query("*","product_category"," status=0 $search_string $con_search order by p_cat_id $limit");
			  
			  $s_no = 1+(($current_page-1)*$per_page);
			  	
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                  <td><?php echo $s_no; ?><input type="checkbox" name="k[]" value="<?php echo $row_cat['p_cat_id'];?>" /></td>
                  <td><?php echo ucwords($row_cat['p_cat_id']); ?></td>
                  <td><?php echo ucwords($row_cat['product_name']); ?></td>
                   <td>
                   
				   <?php if($row_cat['p_qty']>20) { echo $row_cat['p_qty']; } else { ?>
                   <span style="color:red;"><?php echo $row_cat['p_qty'];  ?></span><?php } ?>
                   </td>
                    <td><?php echo $row_cat['product_volume']; ?></td>
                  <td>
                  <?php
                  if($row_cat['image']!='')
				  {
				  ?>
                  <img src="<?php echo SITE_URL."product_logos/".$row_cat['image']; ?>" width="90" height="90" />
                  <?php
                  }
				  else
				  {
				  ?>
                  <img src="<?php echo SITE_URL."product_logos/nv.jpg"; ?>" width="90" height="90" />
                  <?php
				  }
				  ?>
                  </td>
                   <?php /*?> 
                  <td>
                  <?php
                  if($row_cat['product_pdf']!='')
				  {
				  ?>
                  <a href="<?php echo SITE_URL."product_logos/product_pdf/".$row_cat['product_pdf']; ?>" target="_blank"><img src="../images/PDF.png" width="90" height="90" /></a>
                  <?php
                  }
				  else
				  {
				  ?>
                  <img src="../images/PDF.png" width="90" height="90" />
                  <?php
				  }
				  ?>
                  </td>
                  <td>
                  <?php
                  if($row_cat['product_video']!='')
				  {
				  ?>
                  <a href="<?php echo SITE_URL."product_logos/product_video/".$row_cat['product_video']; ?>"><img src="../images/File-Video-icon.png" width="90" height="90" /></a>
                  <?php
                  }
				  else
				  {
				  ?>
                  <img src="../images/File-Video-icon.png" width="90" height="90" />
                  <?php
				  }
				  ?>
                  </td>
                <td>
                  <?php
                  if($row_cat['product_exe']!='')
				  {
				  ?>
                  <a href="<?php echo SITE_URL."product_logos/product_exe/".$row_cat['product_exe']; ?>">EXE Available</a>
                  <?php
                  }
				  else
				  {
				  ?>
                  EXE not available
                  <?php
				  }
				  ?>
                  </td>
                  <td>
                  <?php
                  if($row_cat['product_zip']!='')
				  {
				  ?>
                  <a href="<?php echo SITE_URL."product_logos/product_zip/".$row_cat['product_zip']; ?>">ZIP Available</a>
                  <?php
                  }
				  else
				  {
				  ?>
                  ZIP not available
                  <?php
				  }
				  ?>
                  </td><?php */?>
                  <td><?php echo $row_cat['add_date']; ?></td>
                  <!--<td><?php //echo $row_cat['last_modify']; ?></td>-->
                   <td><a href="admin_main.php?page_number=176&pid=<?php echo $row_cat['p_cat_id'];?>&product_name=<?php echo $row_cat['product_name'];?>" title="Edit" >Manage Product Gallary</a></td>
                  <td>&nbsp;
                  <span><a href="admin_main.php?page_number=14&product_id=<?php echo $row_cat['p_cat_id'];?>&product_name=<?php echo $row_cat['product_name'];?>" title="Edit"><img src="../images/edit.png" /></a></span>
                  <span style="margin-left:5px;"><a href="admin_main.php?page_number=13&delete=1&product_id=<?php echo $row_cat['p_cat_id'];?>" onclick="if(confirm('Do You Want To Delete')){ return true;}else{ return false;}" title="Delete"><img src="../images/Trashcan.png" /></a></span>
                  </td>
                  <td><a href="../product-detail.php?pid=<?php echo $row_cat['p_cat_id'];?>&product_name=<?php echo $row_cat['product_name'];?>" title="Edit" target="_blank">View Product</a></td>
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
<script>
function apply_dailytask(id) {
var catids=$("input[name='k[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
if(catids==''){ alert("Please select atleast one products"); return false;}
	var formData="action=show_default_product&product_id="+catids+"&type="+id;
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



function special_product(id) {
var catids=$("input[name='k[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
if(catids==''){ alert("Please select atleast one products"); return false;}
	var formData="action=special_product&product_id="+catids+"&type="+id;
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