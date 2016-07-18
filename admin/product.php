<?php 

include('header.php'); ?>
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
						$short_desc=$row_product['short_desc'];
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
                  <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                  <?php if($update):?>
                  <input type="hidden" name="p_cat_id" value="<?php echo $product_id; ?>"/>
                  <?php endif; ?>
                    <fieldset>
                       <div class="form-group">
                       
                       
                     
                      <?php 
					  $q=mysql_query("select * from country where status=0") or die(mysql_error());
					  $n=mysql_num_rows($q);
					  if($n>0)
					  {
					while($r=mysql_fetch_assoc($q))
					{
						
						$price=$obj_rep->get_product_price($_GET['product_id'],$r['id']);	  
					  ?>
                      <div class="left-box">
                          <label for="name" ><?php echo $r['country_name']."'s Product Price(USD)"; ?></label>
                          <input type="hidden" name="country_id[]" value="<?php echo $r['id']; ?>">
                          	<input type="text" value="<?php echo $price; ?>" name="product_price[]"  class="validate[required] form-control placeholder">
                        </div> 
                       
                       <?php
					  }
					  }
					  ?>
                       
                      
                      
                       
                       <div class="left-box">
                          <label for="name" >Main Category</label>
                          	<select name="cat_id" class="form-control placeholder" onChange="getajaxsdropdown('subcategory','cat_id',this.value,'sub_id','showsubcategory');">
                            <option value="">-Select Category</option>
                            <?php
                            $field_arr=array("c_id","category_name");
							$condition=" status=0";
							$obj_query->get_dropdown("category_shop",$field_arr,$condition,"c_id","category_name",$category);?>
                            </select>
                        </div>
                        <div class="left-box">
                          <label for="name" >Sub Category</label>
                          	<select name="sub_id" id="sub_id" class="form-control placeholder">
                            <option value="">-Select Sub Category</option>
                            <?php
                            $field_arr=array("sub_id","sub_name");
							$condition=" cat_id='$category'";
							$obj_query->get_dropdown("subcategory",$field_arr,$condition,"sub_id","sub_name",$subcategory);?>
                            </select>
                        </div>
                        <div class="left-box">
                          <label for="name"> Product Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="product_name" id="product_name" placeholder="Product name" data-bind="value: name" value="<?php if(isset($product_name)): echo $product_name; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Product Price</label>
                          <input type="text" class="validate[required] form-control placeholder" name="cost_price" id="cost_price" placeholder="Product Price" data-bind="value: name" value="<?php if(isset($cost_price)): echo $cost_price; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Discount(%) </label>
                          <input type="text" class="validate[required] form-control placeholder" name="dailydeal_discount" id="dailydeal_discount" placeholder="Discount in %" data-bind="value: name" value="<?php if(isset($dailydeal_discount)): echo $dailydeal_discount; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Shipping Price</label>
                          <input type="text" class="validate[required] form-control placeholder" name="shipping" id="shipping" placeholder="Shipping Price" data-bind="value: name" value="<?php if(isset($shipping)): echo $shipping; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Product Volume </label>
                          <input type="text" class="validate[required] form-control placeholder" name="product_volume" id="product_volume" placeholder="Product Volume" data-bind="value: name" value="<?php if(isset($product_volume)): echo $product_volume; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Product Quantity </label>
                          <input type="text" class="validate[required] form-control placeholder" name="p_qty" id="p_qty" placeholder="Product Quantity" data-bind="value: name" value="<?php if(isset($p_qty)): echo $p_qty; endif; ?>" />
                        </div>
                       <!-- <div class="left-box">
                          <label for="name"> Product Video Link </label>
                          <input type="text" class="validate[required] form-control placeholder" name="video_link" id="video_link" placeholder="Product Video Link" data-bind="value: name" value="<?php //if(isset($video_link)): echo $video_link; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Product Download Link </label>
                          <input type="text" class="validate[required] form-control placeholder" name="download_link" id="download_link" placeholder="Product Download Link" data-bind="value: name" value="<?php //if(isset($download_link)): echo $download_link; endif; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name"> Pre-Written Add </label>
                          <input type="text" class="validate[required] form-control placeholder" name="pre_written_add" id="pre_written_add" placeholder="Pre Written Add" data-bind="value: name" value="<?php //if(isset($download_link)): echo $pre_written_add; endif; ?>" />
                        </div>-->
                        <div class="left-box">
                          <label for="name"> Product Image</label>
                          <input type="file" class="validate[required] form-control placeholder" name="image" id="image"  />
                        </div>
                        
                        <?php if(isset($image) && $image!=''): ?>
                        <div class="left-box">
                          <label for="name"> Product Image</label>
                          <img src="<?php echo SITE_URL; ?>product_logos/<?php echo $image; ?>" width="90" height="90" />
                          <input type="hidden" name="old_image" value="<?php if(isset($image)): echo $image; endif; ?>" />
                        </div>
                        <?php endif;?>
                        
                       <!-- <div class="left-box">
                          <label for="name"> Product PDF</label>
                          <input type="file" class="validate[required] form-control placeholder" name="product_pdf" id="product_pdf"  />
                        </div>
                        <?php //if(isset($product_pdf) && $product_pdf!=''): ?>
                        <div class="left-box">
                          <label for="name"> Product PDF</label>
                          <a href="<?php //echo SITE_URL; ?>product_logos/product_pdf/<?php //echo $product_pdf; ?>" target="_blank"><img src="../images/PDF.png" width="90" height="90" /></a>
                          <input type="hidden" name="old_product_pdf" value="<?php //if(isset($product_pdf)): echo $product_pdf; endif; ?>" />
                        </div>
                        <?php //endif;?>-->
                        
                        <!--<div class="left-box">
                          <label for="name"> Product EXE</label>
                          <input type="file" class="validate[required] form-control placeholder" name="product_exe" id="product_exe"  />
                        </div>
                        <?php //if(isset($product_exe) && $product_exe!=''): ?>
                        <div class="left-box">
                          <label for="name"> Product EXE</label>
                          <a href="<?php //echo SITE_URL; ?>product_logos/product_exe/<?php //echo $product_exe; ?>" target="_blank">Click Here</a>
                          <input type="hidden" name="old_product_exe" value="<?php //if(isset($product_exe)): echo $product_exe; endif; ?>" />
                        </div>
                        <?php //endif;?>
                        
                        <div class="left-box">
                          <label for="name"> Product ZIP</label>
                          <input type="file" class="validate[required] form-control placeholder" name="product_zip" id="product_zip"  />
                        </div>
                        <?php //if(isset($product_zip) && $product_zip!=''): ?>
                        <div class="left-box">
                          <label for="name"> Product ZIP</label>
                          <a href="<?php //echo SITE_URL; ?>product_logos/product_zip/<?php //echo $product_zip; ?>" target="_blank">Click Here</a>
                          <input type="hidden" name="old_product_zip" value="<?php //if(isset($product_zip)): echo $product_zip; endif; ?>" />
                        </div>
                        <?php //endif;?>-->
                        
                      </div>
                       <div class="left-box">
                          <label for="name"> Product Short Description </label>
                          <input type="text" class="validate[required] form-control placeholder" name="short_desc" id="short_desc" placeholder="Short Description" data-bind="value: name" value="<?php if(isset($short_desc)): echo $short_desc; endif; ?>"  />
                        </div>
                       <div class="clearfix"></div>
                       <div class="form-group">
                       <div class="box">
                          <label for="name"> Product Description</label>
                          <textarea id="editor2" name="pro_desc" rows="15" cols="80" style="width: 80%"><?php $str=stripslashes($pro_desc); echo $str=html_entity_decode($str) ?></textarea>
                       <script type="text/javascript">
                         // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor2',
                         {
                              filebrowserBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html',
                              filebrowserImageBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html?type=Images',
                              filebrowserFlashBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html?type=Flash',
                              filebrowserUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                              filebrowserImageUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                              filebrowserFlashUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                              filebrowserWindowWidth : '1000',
                              filebrowserWindowHeight : '700'
                         });
                         </script>

                        </div>
                       </div>
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