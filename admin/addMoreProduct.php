<?php include('header.php'); ?>
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
                <div class="pull-left">Add Product</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddProduct';
					$update = false;
					$category = '';
					
				  	if(isset($_GET['product_id'])){
						$product_id = $_GET['product_id'];
						$icon = $_GET['icon'];
						$action = 'UpdateProduct';
						// get product detail 
						$res_product=$obj_query->query("*","product_category","p_cat_id='$product_id'");
						$row_product=$obj_query->get_all_row($res_product);
						$category=$row_product['cat_id'];
						$subcategory=$row_product['sub_id'];
						$product_name=$row_product['product_name'];
						$cost_price=$row_product['cost_price'];
						$dailydeal_discount=$row_product['dailydeal_discount'];
						$shipping=$row_product['shipping'];
						$product_volume=$row_product['product_volume'];
						$image=$row_product['image'];
						$p_qty=$row_product['p_qty'];
						$pro_desc=$row_product['pro_desc'];
						$product_pdf=$row_product['product_pdf'];
						$product_exe=$row_product['product_exe'];
						$product_zip=$row_product['product_zip'];
						$video_link=$row_product['video_link'];
						$download_link=$row_product['download_link'];
						$pre_written_add=$row_product['pre_written_add'];
						$update = true;
					}
					
					//$args_categories = $mxDb->get_information('max_sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');
					
				  ?>
                  <form action="submit.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                  <input type="hidden" name="action" value="AddMoreProductImage"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                 
                  <input type="hidden" name="p_id" value="<?php echo $_GET['pid']; ?>"/>
                  
                    <fieldset>
                       <div class="form-group">
                         <div class="left-box">
                          <label for="name"> Product Image</label>
                          <input type="file" class="validate[required] form-control placeholder" name="files[]" id="image"  />
                          
                        </div>
                        
                        <?php if(isset($image) && $image!=''): ?>
                        <div class="left-box">
                          <label for="name"> Product Image</label>
                          <img src="<?php echo SITE_URL; ?>product_logos/thumb<?php echo $image; ?>" width="90" height="90" />
                          <input type="hidden" name="old_image" value="<?php if(isset($image)): echo $image; endif; ?>" />
                        </div>
                        <?php endif;?>
                        <div class="left-box">&nbsp;</div>
                        
                     </div>
                       <div class="clearfix">&nbsp;</div>
                       <div class="clearfix"></div>
                      <div class="form-group">
                      
                        <div class="left-box">
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
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