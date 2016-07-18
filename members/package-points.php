<?php define('ABSPATH','../../lib/'); include('../header.php'); 
@$point_id=$_GET['id'];
$point = $mxDb->get_information('mx_package','*',"where id='$point_id'",true,'array');
// get main cateogries
$args_categories = $mxDb->get_information('categories', '*', ' order by category_id asc',false, 'assoc');
// unset table name from session
if(isset($_SESSION['cat_tbl']))
	unset($_SESSION['cat_tbl']);
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getState(countryId) {		
		
		var strURL="findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;
						document.getElementById('citydiv').innerHTML='<select name="city" class="validate[required] form-control placeholder">'+
						'<option>Select Sub Sub Categories</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(countryId,stateId) {		
		var strURL="findCity.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
						document.getElementById('productdiv').innerHTML='<select name="product" class="validate[required] form-control placeholder">'+
						'<option>Select Product</option>'+
				        '</select>';		
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	
	
	function getProduct(vId) {		
		var strURL="getproduct.php?product="+vId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('productdiv').innerHTML=req.responseText;
						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	function getBV(bvId) {		
		var strURL="getbv.php?product_id="+bvId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('bvdiv').innerHTML=req.responseText;
											
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
<script>
    function showhide()
     {
           var div = document.getElementById("newpost");
    if (div.style.display !== "none") {
         div.style.display = "none";
    }
    else {
       div.style.display = "block";
    }
     }
	 
	 function showhide1()
     {
           var div = document.getElementById("newpost1");
    if (div.style.display !== "none") {
         div.style.display = "none";
    }
    else {
       div.style.display = "block";
    }
     }
  </script>
<!-- Main content starts -->
<div class="content"> 
  <!-- Sidebar -->
  <?php include('../nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Registration</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Package Points</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
          
          <?php
				if(isset($_GET['msg'])):
					if($_GET['res']==1):?>
                    <div style="padding:5px; color:#063; font-weight:bold;"><?php echo strip_tags($_GET['msg']); ?></div>
              <?php else: ?>
                    <div style="padding:5px; color:#F00; font-weight:bold;"><?php echo strip_tags($_GET['msg']); ?></div>	
			<?php
					endif;
				endif;
			?>
            
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Packages Points</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                <?php if($point_id=='') 
				$action='AddPackagePoint';
					else
					$action='updatePackagePoint';
					?>
                 
                  <form action="../action_control/post-action.php" class="validate" method="post" id='form1' enctype="multipart/form-data" >
                  <input type="hidden" name="action" value="<?php echo $action;?>"/>
                  <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                  <input type="hidden" name="id" value="<?php echo $point_id;?>"/>
                            
                    <fieldset>
                    
                      <div class="form-group">
                       
                         <div class="left-box">
                          <label for="name"> Package Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="name" id="name" placeholder="Point" data-bind="value: name" value="<?php if(isset($point['name'])): echo $point['name']; endif;?>" />
                        </div>
                     
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Package Description</label>
                          <textarea class="validate[required] form-control placeholder" name="description" id="point" placeholder="Point" data-bind="value: name" rows="4" cols="100" /><?php if(isset($point['description'])): echo $point['description']; endif;?></textarea>
                        </div>
                         
                        
                        </div>
                    
                                         
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                        <div class="left-box">
                         
<button class="btn btn-danger side" style="float:left;" type="button" id="button" onclick="showhide()" value="Add" >Add Product To Package</button>
                           </div> <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div>
                      
                           <div id="newpost" style="display:none"><div class="form-group">
                        <h5 style="border-bottom:1px solid #999;"><strong>Add Product to Package</strong></h5>
                       <?php $query="SELECT * FROM categories";
$result=mysql_query($query);?>
  <div class="left-box"><div class="left-box"><label for="name"> Select Category</label><select name="country" onChange="getState(this.value)" class="validate[required] form-control placeholder">
  
	<option value="">Select Category</option>
	<?php while ($row=mysql_fetch_array($result)) { ?>
	<option value=<?php echo $row['category_id']?> <?php if($point['product_category_id']==$row['category_id']) { ?> selected="selected" <?php } ?>/><?php echo $row['name']?></option>
	<?php } ?>
	</select>
               </div>     
                     
<div class="left-box">  <label for="name"> Select Sub Category</label><div id="statediv"><select name="state" class="validate[required] form-control placeholder">
	<option value=<?php echo $point['product_sub_category_id']?> /><?php $point_id=$point['product_sub_category_id'];
$points = mysql_fetch_array(mysql_query("select * from sub_categories where sub_category_id='$point_id'"));echo $points['name']?></option>
    <option>Select Sub Category</option>
        </select></div></div>
     
  <div class="left-box"><label for="name"> Select Sub Sub Category</label><div id="citydiv"><select name="city" class="validate[required] form-control placeholder">
	
    <option value=<?php echo $point['product_sub_sub_category_id']?> /><?php $point_id=$point['product_sub_sub_category_id'];
$points = mysql_fetch_array(mysql_query("select * from sub_sub_categories where sub_sub_category_id='$point_id'"));echo $points['name']?></option>
    <option>Select Sub Sub Category</option>
        </select></div></div>
        
         <div class="left-box"><label for="name"> Select Product</label><div id="productdiv"><select name="product" class="validate[required] form-control placeholder"><option value=<?php echo $point['product_name']?> /><?php $point_id=$point['product_name'];
$points = mysql_fetch_array(mysql_query("select * from products where product_id='$point_id'"));echo $points['product_name']?></option>
	<option>Select Product</option>
        </select></div></div></div>
        
          
  <div class="left-box"><div id="bvdiv">                     
         <div class="left-box"> <label for="name"> Product BV </label> <input type="text" name="bv" id="bv" value="<?php echo $point['product_bv'];?>" onblur="calculatePricePerUnit()" class="validate[required] form-control placeholder"/></div>
<div class="left-box"> <label for="name">Product Price  </label></label> <input type="text"  name="price1" id="price1" value="<?php echo $point['product_price'];?>" onblur="calculatePricePerUnit()"  class="validate[required] form-control placeholder"/></div>
<div class="left-box"> <label for="name">Quantity  </label></label> <input type="text"  name="quantity1" id="quantity1"  onblur="calculatePricePerUnit()"  value="<?php echo $point['product_quantity'];?>" class="validate[required] form-control placeholder"/></div>
<div class="left-box"> <label for="name">Sub Total  </label></label> <input type="text" name="priceperunit" id="priceperunit" value="<?php echo $point['product_sub_total'];?>" class="validate[required] form-control placeholder"/></div>
</div></div>
</div>
<br/><br/><br/>

  <div class="left-box">
                      <div class="clearfix"></div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="left-box"> &nbsp; </div>
                      <div class="clearfix"></div> 
                      
</div>      </div> </div>   </div>
                       
   <div class="form-group">          
<div class="left-box">
                          <label for="name"> Package Amount</label>
                          <input type="text" class="validate[required] form-control placeholder" name="amount" id="priceperunit1" value="<?php if(isset($point['amount'])): echo $point['amount']; endif;?>"/>
                        </div>
                        
                     
                      
                    
                       
                        <div class="left-box">
                          <label for="name"> Package CV Points</label>
                          <input type="text" class="validate[required] form-control placeholder" name="cv_value" id="priceperunitbv1"  value="<?php if(isset($point['cv_value'])): echo $point['cv_value']; endif;?>" />
                        </div>
                        
                       </div>
                       

          
                        
                        <div class="clearfix"></div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="left-box"> &nbsp; </div>
                        <div class="clearfix"></div>
                        
                      
                      <div class="form-group">
                        <div class="left-box"> <br />
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                 
                  <!--<script type="text/javascript">
				  
					  // form validation 
					  var frmValidation = new Validator('form1');
					  
					  <?php if(!isset($_GET['pid'])) : ?>
					  frmValidation.addValidation('category_id','dontselect=000');
					  <?php endif; ?>
					  
					  frmValidation.addValidation('name','req','Please enter product name');
					  frmValidation.addValidation('qty','req','Please enter product quantity');
					  frmValidation.addValidation('qty','decimal','Please enter numeric value with deciaml digit in product quantity');
					  frmValidation.addValidation('price','req','Please enter product price');
					  frmValidation.addValidation('price','decimal','Please enter numeric value with deciaml digit in product price');
					  frmValidation.addValidation('discount','req','Please enter product discount');
					  frmValidation.addValidation('discount','decimal','Please enter numeric value with deciaml digit in product discount');
				  	  frmValidation.addValidation('points','req','Please enter points');
					  frmValidation.addValidation('points','decimal','Please enter numeric value with deciaml digit in points');

					  <?php if(!isset($_GET['pid'])) : ?>
					  frmValidation.addValidation('image','file');
					  <?php endif; ?>
					  
					  frmValidation.addValidation('description','req','Please enter product description');
				  
				  </script>-->
                  
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
 <script type="text/javascript">
 
	function calculatePricePerUnit ()
	{
		var bv = parseFloat(document.getElementById ("bv").value);
		var price = parseFloat(document.getElementById ("price1").value);
		var quantity = parseFloat(document.getElementById ("quantity1").value);
		
		if (!(price == Number.NaN && quantity == Number.NaN))
			document.getElementById ("priceperunit").value = Number(price*quantity);
			
			if (!(price == Number.NaN && quantity == Number.NaN))
			document.getElementById ("priceperunit1").value = Number(price*quantity);
			
			if (!(bv == Number.NaN && quantity == Number.NaN))
			document.getElementById ("priceperunitbv1").value = Number(bv*quantity);
			
			if (!(price == Number.NaN && quantity == Number.NaN))
			document.getElementById ("priceperunitbv1").value = Number(bv*quantity);
	}
	
	</script>
</div>
<!-- Content ends -->
<?php include('../footer.php'); ?>
