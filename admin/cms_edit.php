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
                <div class="pull-left">Edit</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddProduct';
					$update = false;
					$category = '';
					
				  	if(isset($_GET['id'])){
						$m_id=$_GET['id'];
						$res=$obj_query->query("*","cms","id='$m_id'");   
						$row=$obj_query->get_all_row($res);
						$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
						$pro_desc=$row['content'];
					}
					
					//$args_categories = $mxDb->get_information('max_sub_categories', '*', ' order by sub_category_id asc',false, 'assoc');
					
				  ?>
                   
   			<form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              
                 
                <fieldset>
                  <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						$obj_function->_get_cms_category_dropdown($row['category']);
						?>
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                   
                     <label for="name"> Content</label>
                          <textarea id="editor2" name="content" rows="15" cols="80" style="width: 80%"><?php echo $pro_desc; ?></textarea>
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
                  </fieldset>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                
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