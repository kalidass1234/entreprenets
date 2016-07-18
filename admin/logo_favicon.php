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
						// get product detail 
						$res_product=$obj_query->query("*","logo","1=1");
						$row_product=$obj_query->get_all_row($res_product);
						$logo=$row_product['logo'];
						$favicon=$row_product['favicon'];
						$product_id=$row_product['id'];
						$update = true;
				  ?>
                  <form action="submit.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                  <input type="hidden" name="action" value="Update_Logo"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                  <?php if($update):?>
                  <input type="hidden" name="id" value="<?php echo $product_id; ?>"/>
                  <?php endif; ?>
                    <fieldset>
                       <div class="form-group">
                       
                        <div class="left-box">
                          <label for="name"> Logo</label>
                          <input type="file" class="validate[required] form-control placeholder" name="logo" id="logo"  />
                        </div>
                        
                        <?php if(isset($logo) && $logo!=''): ?>
                        <div class="left-box">
                          <label for="name"> Logo</label>
                          <img src="<?php echo SITE_URL; ?>images/logo/<?php echo $logo; ?>" width="90" height="90" />
                          <input type="hidden" name="old_logo" value="<?php if(isset($logo)): echo $logo; endif; ?>" />
                        </div>
                        <?php endif;?>
                        
                        <div class="left-box">
                          <label for="name"> Favicon</label>
                          <input type="file" class="validate[required] form-control placeholder" name="favicon" id="favicon"  />
                        </div>
                        
                        <?php if(isset($favicon) && $favicon!=''): ?>
                        <div class="left-box">
                          <label for="name"> Favicon</label>
                          <img src="<?php echo SITE_URL; ?>images/favicon/<?php echo $favicon; ?>" width="90" height="90" />
                          <input type="hidden" name="old_favicon" value="<?php if(isset($favicon)): echo $favicon; endif; ?>" />
                        </div>
                        <?php endif;?>
                        
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