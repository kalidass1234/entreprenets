<?php 
include('header.php'); 
if(isset($_POST['submit_stock']))
{
	$pid=$_POST['p_cat_id'];
	$qty=$_POST['p_qty'];
	$q=mysql_query("update product_category set p_qty='$qty' where p_cat_id='$pid'") or die(mysql_error());
	
		$add_date=date("Y-m-d");
		$remark=$qty." products added by admin";
			mysql_query("insert into stock_to_sell_history set product_id='$pid',quantity='$qty',add_by='admin',remark='$remark', add_date='$add_date'") or die(mysql_error());	
	?>
    
    <script>
	window.location.href='admin_main.php?page_number=15';
	</script>
<?php	
}
?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>

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
        <span class="divider">/</span> <a href="#" class="bread-current">Product</a> </div>
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
                <div class="pull-left">Edit Product Quantity</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  
                  <?php
				  
				  	
					
				  	if(isset($_GET['product_id'])){
						$product_id = $_GET['product_id'];
						
						// get product detail 
						$res_product=$obj_query->query("*","product_category","p_cat_id='$product_id'");
						$row_product=$obj_query->get_all_row($res_product);
						
						$product_name=$row_product['product_name'];
						
						$p_qty=$row_product['p_qty'];
						
						
					}
					
					//$args_categories = $mxDb->get_information('max_sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');
					
				  ?>
                  <form action="" class="validate" method="post" id='form1' enctype="multipart/form-data">
                  
                 <input type="hidden" name="p_cat_id" value="<?php echo $product_id; ?>"/>
                    <fieldset>
                       <div class="form-group">
                         <div class="left-box">
                          <label for="name"> Product Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="product_name" id="product_name" placeholder="Product name" data-bind="value: name" value="<?php if(isset($product_name)): echo $product_name; endif; ?>" />
                        </div>
                         <div class="left-box">
                          <label for="name"> Product Quantity </label>
                          <input type="text" class="validate[required] form-control placeholder" name="p_qty" id="p_qty" placeholder="Product Quantity" data-bind="value: name" value="<?php if(isset($p_qty)): echo $p_qty; endif; ?>" />
                        </div>
                      
                        
                      
                        
                        
                      </div>
                       <div class="clearfix"></div>
                       <div class="clearfix"></div>
                      <div class="form-group">
                      
                        <div class="left-box">
                          <button class="btn btn-danger side"  type="submit" id="button" name="submit_stock" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
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
function getajaxsdropdown(table_name,field_name,value,div_id,action)
{
			
   loading_show();  
   
   if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
			if(xmlhttp.responseText){
				loading_hide();
				//alert(xmlhttp.responseText);
				if(xmlhttp.responseText)
				{
					document.getElementById(div_id).innerHTML=xmlhttp.responseText;
					/*var record = JSON.parse(xmlhttp.responseText);
					document.getElementById('default_product_page').innerHTML = '';
					document.getElementById('result').innerHTML = record.content;
					document.getElementById('pagination').style.display = 'none';
					document.getElementById('show_pagination').innerHTML = record.pagination;*/
				}
			}
		}
	}
	var param = "table_name="+table_name+"&field_name="+field_name+"&field_value="+value+"&action="+action;
	
	//alert(param);
	xmlhttp.open("POST","ajax.php",true);
	//xmlhttp.setRequestHeader('Content-Type','text; charset=UTF-8');
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
	xmlhttp.send(param);

}
function loading_show()
{
	document.getElementById('loading').style.display = 'block';
    //document.getElementById('loading').innerHTML = '<img src="ajax_pagination/loading.gif"/>';
}

// hide loader
function loading_hide()
{
   	document.getElementById('loading').style.display = 'none';
    //document.getElementById('loading').innerHTML = '';
} 
window.onload = function(){
	document.getElementById('loading').style.height = screen.height+'px';
} 

</script>
<link type="text/css" rel="stylesheet" href="ckeditor/jquery-te-1.4.0.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="ckeditor/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$('.jqte-test').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>