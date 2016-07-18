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
<a href="javascript:void(0);" style="float:left" onclick="apply_qualification(<?php echo $_GET['userid'];?>)"> <button class="btn btn-danger side"  type="button" id="button" >Apply To Stock To Sell</button></a>&nbsp;
<a href="javascript:void(0);" style="float:right" onclick="delete_qualification(<?php echo $_GET['userid'];?>)"> <button class="btn btn-danger side"  type="button" id="button" >Delete Stock To Sell Products</button></a>&nbsp;
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
                  <th>S.no.<input type="checkbox" name="select_all_k" id="select_all_k"  onclick="check_all(this.id,'k')" /></th>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Product Icon</th>
                  <th>Date</th>
                  <th>Web View</th>
                </tr>
              </thead>
              <tbody>
              <?php
				if(isset($_REQUEST['search']))
				{
					$query_string=http_build_query($_REQUEST);
					$url='admin_main.php?page_number=164&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=164&'.$search_string;
				}
				if(isset($_GET['page']) && $_GET['page']!='' && is_numeric($_GET['page']))
				{
					$current_page=$_GET['page'];
				}
				else
				{
					$current_page = 1;
				}
			  $res=$obj_query->query("*","product_default"," status=0 and type='stock_to_sell'  order by product_id ");
			  $s_no = 1+(($current_page-1)*$per_page);
			while($row=$obj_query->get_all_row($res))
			{
				$pid=$row['product_id'];
				 $res_cat=$obj_query->query("*","product_category"," p_cat_id='$pid'");
				  $row_cat=$obj_query->get_all_row($res_cat);
			  ?>
                <tr>
                  <td><input type="checkbox" name="k[]" class="checkbox_k" value="<?php echo $row_cat['p_cat_id'];?>" /></td>
                  <td><?php echo ucwords($row_cat['p_cat_id']); ?></td>
                  <td><?php echo ucwords($row_cat['product_name']); ?></td>
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
                  
                  <td><?php echo $row_cat['add_date']; ?></td>
                  <td><a href="../product-detail.php?pid=<?php echo $row_cat['p_cat_id'];?>&product_name=<?php echo $row_cat['product_name'];?>" title="Edit" target="_blank">View Product</a></td>
                </tr>
                <?php 
				$s_no++;
			  }
			?>
              </tbody>
            </table>
            
          </div>
        </div>
      
         <div class="clearfix"></div>
        
        <a href="javascript:void(0);" style="float:left" onclick="apply_dailytask(<?php echo $_GET['userid'];?>);"> <button class="btn btn-danger side"  type="button" id="button" >Apply To Daily Task</button></a>
        <a href="javascript:void(0);" style="float:right" onclick="delete_dailytask(<?php echo $_GET['userid'];?>);"> <button class="btn btn-danger side"  type="button" id="button" >Delete Daily Task Product</button></a>
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
                  <th>S.no.<input type="checkbox" name="select_all_d" id="select_all_d"  onclick="check_all(this.id,'d')" /></th>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Product Icon</th>
                  <th>Date</th>
                  <th>Web View</th>
                </tr>
              </thead>
              <tbody>
              <?php
				if(isset($_REQUEST['search']))
				{
					$query_string=http_build_query($_REQUEST);
					$url='admin_main.php?page_number=161&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=161&'.$search_string;
				}
				if(isset($_GET['page']) && $_GET['page']!='' && is_numeric($_GET['page']))
				{
					$current_page=$_GET['page'];
				}
				else
				{
					$current_page = 1;
				}
			  $res=$obj_query->query("*","product_default"," status=0 and type='daily_task'  order by product_id ");
			  $s_no = 1+(($current_page-1)*$per_page);
			while($row=$obj_query->get_all_row($res))
			{
				$pid=$row['product_id'];
				 $res_cat=$obj_query->query("*","product_category"," p_cat_id='$pid'");
				  $row_cat=$obj_query->get_all_row($res_cat);
			  ?>
                <tr>
                  <td><input type="checkbox" name="d[]" class="checkbox_d" value="<?php echo $row_cat['p_cat_id'];?>" /></td>
                  <td><?php echo ucwords($row_cat['p_cat_id']); ?></td>
                  <td><?php echo ucwords($row_cat['product_name']); ?></td>
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
                  
                  <td><?php echo $row_cat['add_date']; ?></td>
                  <td><a href="../product-detail.php?pid=<?php echo $row_cat['p_cat_id'];?>&product_name=<?php echo $row_cat['product_name'];?>" title="Edit" target="_blank">View Product</a></td>
                </tr>
                <?php 
				$s_no++;
			  }
			?>
              </tbody>
            </table>
            
          </div>
        </div>
        
        <div class="clearfix"></div>
       
        <a href="javascript:void(0);" style="float:left" onclick="apply_qualification1(<?php echo $_GET['userid'];?>);"> <button class="btn btn-danger side"  type="button" id="button" >Apply To  Qualification</button></a>
        <a href="javascript:void(0);" style="float:right" onclick="delete_qualification1(<?php echo $_GET['userid'];?>);"> <button class="btn btn-danger side"  type="button" id="button" >Delete Qualification Products</button></a>
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
                  <th>S.no.<input type="checkbox" name="select_all_q" id="select_all_q"  onclick="check_all(this.id,'q')" /></th>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Product Icon</th>
                  <th>Date</th>
                  <th>Web View</th>
                </tr>
              </thead>
              <tbody>
              <?php
				if(isset($_REQUEST['search']))
				{
					$query_string=http_build_query($_REQUEST);
					$url='admin_main.php?page_number=161&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=161&'.$search_string;
				}
				if(isset($_GET['page']) && $_GET['page']!='' && is_numeric($_GET['page']))
				{
					$current_page=$_GET['page'];
				}
				else
				{
					$current_page = 1;
				}
			  $res=$obj_query->query("*","product_default"," status=0 and type='qualification'  order by product_id ");
			  $s_no = 1+(($current_page-1)*$per_page);
			while($row=$obj_query->get_all_row($res))
			{
				$pid=$row['product_id'];
				 $res_cat=$obj_query->query("*","product_category"," p_cat_id='$pid'");
				 $row_cat=$obj_query->get_all_row($res_cat);
			  ?>
                <tr>
                  <td><input type="checkbox" name="q[]" class="checkbox_q" value="<?php echo $row_cat['p_cat_id'];?>" /></td>
                  <td><?php echo ucwords($row_cat['p_cat_id']); ?></td>
                  <td><?php echo ucwords($row_cat['product_name']); ?></td>
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
                  
                  <td><?php echo $row_cat['add_date']; ?></td>
                  <td><a href="../product-detail.php?pid=<?php echo $row_cat['p_cat_id'];?>&product_name=<?php echo $row_cat['product_name'];?>" title="Edit" target="_blank">View Product</a></td>
                </tr>
                <?php 
				$s_no++;
			  }
			?>
              </tbody>
            </table>
            
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
function apply_qualification(id) {
/*var allVals = [];
$('input[name="showonreg"]:checked').each(function() {
	allVals.push($(this).val());
}
alert(allVals);*/
var catids=$("input[name='k[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
	 
/*var catids=$('input[name="showonreg[]"]:checked').join(',');
alert(catids);*/
if(catids==''){ alert("Please select 30 products"); return false;}
	var formData="action=show_stock_to_sell_all&product_id="+catids+"&user_id="+id;
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

function delete_qualification(id) {
/*var allVals = [];
$('input[name="showonreg"]:checked').each(function() {
	allVals.push($(this).val());
}
alert(allVals);*/
var catids=$("input[name='k[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
	 
/*var catids=$('input[name="showonreg[]"]:checked').join(',');
alert(catids);*/
if(catids==''){ alert("Please select 30 products"); return false;}
	var formData="action=delete_stock_to_sell_all&product_id="+catids;
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            alert(data);
			window.location.reload();
        }
    });
}

function apply_qualification1(id) {
var catids=$("input[name='q[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
if(catids==''){ alert("Please select 3 products"); return false;}
	var formData="action=show_qualification_all&product_id="+catids+"&user_id="+id;
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

function delete_qualification1(id) {
var catids=$("input[name='q[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
if(catids==''){ alert("Please select 3 products"); return false;}
	var formData="action=delete_qualification_all&product_id="+catids;
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            alert(data);
			window.location.reload();
        }
    });
}

function apply_dailytask(id) {
var catids=$("input[name='d[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
if(catids==''){ alert("Please select 5 products"); return false;}
	var formData="action=show_daily_task_all&product_id="+catids+"&user_id="+id;
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
function delete_dailytask(id) {
var catids=$("input[name='d[]']:checked").map(
     function () {return $(this).val();}).get().join(",");
if(catids==''){ alert("Please select 5 products"); return false;}
	var formData="action=delete_daily_task_all&product_id="+catids;
	//alert(formData);
	
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            alert(data);
			window.location.reload();
        }
    });
}
function check_all(id,name)
{
//"#select_all_k"
var obj=document.getElementById(id);
	//alert($(obj).checked);
	//alert(obj.checked);
	 if(obj.checked) { // check select status
            $(".checkbox_"+name).each(function() { //loop through each checkbox
              //alert("Subhash<br>"+this.checked);
			   
			    this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $(".checkbox_"+name).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
}


</script>