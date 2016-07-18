<?php 
include('header.php');
include("pagination.php");
?>
<!-- Main content starts -->
<script src="../dist/country.js"></script>
<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left">Dashboard</h2>
        <div class="pull-right">
           <div id="reportrange" class="pull-right">
              <i class="fa fa-calendar"></i>
              <span></span> <b class="caret"></b>
           </div>
        </div>
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Dashboard</a>
        </div>
        <div class="clearfix"></div>
	    </div>
	    <!-- Page heading ends -->
	    <!-- Matter -->
	    <div class="matter">
        <div class="container">
         <div class="row">
            <div class="col-md-12">
            
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Weekly Adds List</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=18" class="validate" method="post" id='form1'>
                      <fieldset>
                       <!-- <div class="form-group">
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date From</label>
                            <input data-format="yyyy-MM-dd" type="date" class="form-control dtpicker">
                           </div>
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date to</label>
                            <input data-format="yyyy-MM-dd" type="date" class="form-control dtpicker">
                            </div>
                        </div>-->
                        
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">User Id/User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="User_Id" name="user_id" placeholder="User Id" data-bind="value: name" />
                          </div>
                          <div class="left-box">
                            <label for="name" >Status</label>
                            <select name="status"  class="validate[required] form-control placeholder" id="mem_status">
                              <option value="">All</option>
                              <option value="0">No</option>
                              <option value="1">Yes</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                          <br>
                            <button name="search" class="btn btn-danger side"  type="submit" id="button" >Submit</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Start User Wise Products Shows-->
         
                  	<?php
					if(isset($_REQUEST['search']))
						{
							extract($_REQUEST);
							if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
							{
								// get user_id
								$res_user=$obj_query->query("*","registration","user_id='$user_id' or user_name='$user_id' ");
								$row_user=$obj_query->get_all_row($res_user);
								$search_string.=" and user_id='$row_user[user_id]'";
								$query_string.="&user_id='$user_id'";
							}
							
							if(isset($_REQUEST['status']) && $_REQUEST['status']!='')
							{
								$search_string.=" and status='$status'";
								$query_string.="&status='$status'";
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
                    	$res=$obj_query->query("*","weekly_adds_mp","1=1 $search_string ");
						$res_products_tol=$obj_query->query("id","weekly_adds_mp","1=1 $search_string $con_search ");
						$total_row=$obj_query->num_row($res_products_tol);
						$pages = ceil($total_row/$per_page);
						$sno=1;
						?>
			<div class="col-md-12 float">
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Show Result Of <?php echo $row_user['user_name'];?></div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                      <fieldset>
                        <div class="form-group">
                        <?php
                        // get the active and inactive products in the  list
						echo "Total Products: ".$total_row;
						echo "<br>";
						$res_products_tola=$obj_query->query("id","weekly_adds_mp","status=0 and user_id='$row_user[user_id]' ");
						$active=$obj_query->num_row($res_products_tola);
						echo "Total Active: ".$active;
						echo "<br>";
						$res_products_toli=$obj_query->query("id","weekly_adds_mp","status=1 and user_id='$row_user[user_id]' ");
						$inactive=$obj_query->num_row($res_products_toli);
						echo "Total Inactive: ".$inactive;
						?>
                        </div>
                     </fieldset>
                  </div>
                 </div>
                </div>
               </div>
						<?php
						while($row=$obj_query->get_all_row($res))
						{
							$res_user=$obj_query->query("*","registration","user_id='$row[user_id]' ");
							$row_user=$obj_query->get_all_row($res_user);
							$image=$obj_query->get_field_name("product_category","image","p_cat_id='$row[product_id]'");
							if($image!='' && file_exists("../product_logos/".$image))
							{
								$image1="../product_logos/".$image;
							}
							else
							{
								$image1="../product_logos/nv.jpg";
							}
							$product_name=$obj_query->get_field_name("product_category","product_name","p_cat_id='$row[product_id]'");
							if($product_name=='')
							{
								$product_name="Product Name Not Available";
							}
						?>
                     
		<div class="col-md-2 float">
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left"><?php echo $row['user_id'];?>: <?php echo $row_user['user_name'];?></div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    
                      <fieldset>
                        
                        <div class="form-group">
                            
                            <img src="<?php echo $image1;?>" width="100" height="100">
                          </div>
                            <div class="form-group">
                            <?php echo  $product_name;?>
                        </div>
                        <div class="form-group">
                          <div class="left-box right-side">
                            <button class="btn <?php if($row['status']){ echo "btn-green";}else{ echo "btn-danger";}?> side " type="submit" id="button"><?php if($row['status']){ echo "YES";}else{ echo "NO";}?></button>
                          </div>
                        </div>
                      </fieldset>
                    
                  </div>
                </div>
              </div>
            </div>
                        <?php
						}
						}
					?>
                        
          <!--End User Wise Product Show-->
          
        </div>
		<!-- Matter ends -->
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
<script language="javascript">
function ValidateData(form)
{
	var chks = document.getElementsByName('id[]');
	var hasChecked = false;
	for (var i = 0; i < chks.length; i++)
	{
		if(chks[i].checked)
		{
			hasChecked = true;
			break;
		}
	}
	if (hasChecked == false)
	{
		alert("Please select at least one Request.");
		return false;
	}
} 
function Check(chk)
{
	var chk = document.getElementsByName('id[]');
	if(document.myform.Check_All.value=="Check All")
	{
		for (i = 0; i < chk.length; i++)
		chk[i].checked = true ;
		document.myform.Check_All.value="UnCheck All";
	}
	else
	{
		for (i = 0; i < chk.length; i++)
		chk[i].checked = false ;
		document.myform.Check_All.value="Check All";
	}
}
function update_product_code()
{
	var str_arr=Array();
	str_arr=document.getElementById('product_ids').value.split(",");
	//str_arr.sort();
	//str_arr=fine_unique_array(str_arr);
	str_arr = str_arr.filter( function( item, index, inputArray ) {
           return inputArray.indexOf(item) == index;
    });
	var count=str_arr.length;
	var arr=[];
	if(count<=30)
	{
		var j=0;
		for(var i=0;i<count;i++)
		{
			var product_id=str_arr[i];
			//alert(product_id);
			if(product_id!='')
			{
				checl=checkproductvalidity(product_id);
			}
			else
			{
				checl='';
			}
			if(checl!='')
			{
				
				arr[j]=	product_id;
				j++;
			}
			else
			{
			
			}
		}
		var products=arr.join();
		//find_unique_characters(products);
		//alert(products);
		document.getElementById('product_ids').value=products;
		document.getElementById('show_product_codes').innerHTML='';
		var counts=arr.length;
		var remcount=30-counts;
		document.getElementById('show_product_code').innerHTML=remcount+' Products Remaining';
	}
	else
	{
	
	}
	document.getElementById('product_id').value=document.getElementById('product_ids').value;	
}
function checkproductcode(str)
{
	//alert(str);
	var str_arr=Array();
	str_arr=str.split(",");
	//str_arr.sort();
	var count=str_arr.length;
	var arr=[];
	//alert(count);
	var checl='';
	if(count<=30)
	{
		var remcount=30-count;
		document.getElementById('show_product_code').innerHTML=remcount+' Products Remaining';
		var j=0;
		for(var i=0;i<count;i++)
		{
			var product_id=str_arr[i];
			//alert(product_id);
			if(product_id!='')
			{
				checl=checkproductvalidity(product_id);
			}
			else
			{
				checl='';
			}
			if(checl!='')
			{
				
				arr[j]=	product_id;
				j++;
			}
			else
			{
			
			}
		}
		//arr=fine_unique_array(arr)
		var products=arr.join();
		//find_unique_characters(products);
		//alert(products);
		document.getElementById('product_ids').value=products;
		document.getElementById('show_product_codes').innerHTML=products;
		var counts=arr.length;
		var remcount=30-counts;
		document.getElementById('show_product_code').innerHTML=remcount+' Products Remaining';
	}
	else
	{
		alert("Can Not Enter More Than 30 Products Code.");
	}
	// check everyproduct that is valid or not
	
}
function find_unique_characters( string ){
    var unique='';
    for(var i=0; i<string.length; i++){
        if(unique.indexOf(string[i])==-1){
            unique += string[i];
        }
    }
    return unique;
}
function fine_unique_array(arr)
{
	var sorted_arr = arr.sort(); // You can define the comparing function here. 
								 // JS by default uses a crappy string compare.
	var results = [];
	for (var i = 0; i < arr.length - 1; i++) 
	{
		if (sorted_arr[i + 1] == sorted_arr[i]) 
		{
			results.push(sorted_arr[i]);
		}
	}
	return sorted_arr;
}
function checkproductvalidity(product_id)
{
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
				
				if(xmlhttp.responseText!='NO')
				{
					return xmlhttp.responseText;
					<!--document.getElementById('showproducts').innerHTML=xmlhttp.responseText;-->
					/*var record = JSON.parse(xmlhttp.responseText);
					document.getElementById('default_product_page').innerHTML = '';
					document.getElementById('result').innerHTML = record.content;
					document.getElementById('pagination').style.display = 'none';
					document.getElementById('show_pagination').innerHTML = record.pagination;*/
				}
				else
				{
				//alert(xmlhttp.responseText);
					return "";
				}
			}
		}
	}
	
	var param = "product_id="+product_id+"&action=checkproductvalidity";
	
	//alert(param);
	xmlhttp.open("POST","ajax.php",true);
	//xmlhttp.setRequestHeader('Content-Type','text; charset=UTF-8');
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
	xmlhttp.send(param);
}
</script>