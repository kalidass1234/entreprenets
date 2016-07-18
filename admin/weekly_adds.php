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
                  <div class="pull-left">Member List</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=17" class="validate" method="post" id='form1'>
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
                            <label for="name"> First Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="first_name" placeholder="First name" data-bind="value: name" />
                          </div>
                          <div class="left-box">
                            <label for="name"> Last Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personlName" name="last_name" placeholder="Last name" data-bind="value: name" />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">User Id</label>
                            <input type="text" class="validate[required] form-control placeholder" id="User_Id" name="user_id" placeholder="User Id" data-bind="value: name" />
                          </div>
                         <!-- <div class="left-box">
                            <label for="name" >Member Categary</label>
                            <select name="package" required="required" class="validate[required] form-control placeholder" id="personName">
                              <option value="volvo">--choose package--</option>
                              <option value="saab">Saab 95</option>
                              <option value="mercedes">Mercedes SLK</option>
                              <option value="audi">Audi TT</option>
                            </select>
                          </div>-->
                          <div class="left-box">
                            <label for="name" >Status</label>
                            <select name="mem_status"  class="validate[required] form-control placeholder" id="mem_status">
                              <option value="">All</option>
                              <option value="0">Active</option>
                              <option value="1">Inactive</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="user_name" name="user_name" placeholder="User name" data-bind="value: name" />
                          </div>
                          <div class="left-box">
                            <label for="name" >Country</label>
                            <select name="country"  class="validate[required] form-control placeholder" id="country">
                            </select>
                            <script language="javascript">
							populateCountries("country");
						   // populateCountries("country2");
							</script>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="email">Email address</label>
                            <input type="email" class="validate[required,custom[email]] form-control placeholder" id="personEmail" name="email" placeholder="E-mail" data-original-title="Your activation email will be sent to this address." data-bind="value: email, event: { change: checkDuplicateEmail }" />
                          </div>
                          <div class="left-box">
                            <label for="name">State</label>
                            <select name="state"  class="validate[required] form-control placeholder" id="state">
                            </select>
                            <script language="javascript">
							populateCountries("country","state");
						   // populateCountries("country2");
							</script>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Mobile</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="mobile" placeholder="Your Mobile No" data-bind="value: name" />
                          </div>
                          <div class="left-box">
                            <label for="email">Sponsor Id</label>
                            <input type="text" class="validate[required,custom[email]] form-control placeholder" id="sponsor" name="sponsor" placeholder="Your Sponsor Id" data-original-title="Your activation email will be sent to this address." data-bind="value: email, event: { change: checkDuplicateEmail }" />
                          </div>
                        </div>
                        <!--<div class="form-group">
                          <div class="left-box">
                            <label for="name" >Status</label>
                            <select name="package" required="required" class="validate[required] form-control placeholder" id="country">
                              <option value="volvo">All</option>
                              <option value="saab">Active</option>
                              <option value="mercedes">Inactive</option>
                            </select>
                          </div>
                          <div class="left-box"><br>
                            <br>
                          </div>
                        </div>-->
                        <div class="form-group">
                          <div class="left-box">
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
          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Member List</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content">
                  <form action="submit.php" method="post" name="myform" onSubmit="return ValidateData(this);">
                  <input type="hidden" name="action" value="Add_Weekly_Adds" />
                   <input type="hidden" name="product_id" id="product_ids" value="" />
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                        	<th>C.bx</th>
                          <th>S.no.</th>
                          <th>Member Id</th>
                          <th>User Name</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Sponser Id</th>
                           <th>Affiliate Date</th>
                           <th>Date</th>
                          
                        </tr>
                      </thead>
                      <tbody>
						<?php
						//echo "<pre>"; print_r($_REQUEST);
						if(isset($_REQUEST['search']))
						{
							extract($_REQUEST);
							if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
							{
								$search_string.=" and user_id='$user_id'";
								$query_string.="&user_id='$user_id'";
							}
							if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
							{
								$search_string.=" and user_name='$user_name'";
								$query_string.="&user_name='$user_name'";
							}
							if(isset($_REQUEST['mem_status']) && $_REQUEST['mem_status']!='')
							{
								$search_string.=" and mem_status='$mem_status'";
								$query_string.="&mem_status='$mem_status'";
							}
							if(isset($_REQUEST['email']) && $_REQUEST['email']!='')
							{
								$search_string.=" and email='$email'";
								$query_string.="&email='$email'";
							}
							if(isset($_REQUEST['state']) && $_REQUEST['state']!='')
							{
								$search_string.=" and state='$state'";
								$query_string.="&state='$state'";
							}
							if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!='')
							{
								$search_string.=" and mobile='$mobile'";
								$query_string.="&mobile='$mobile'";
							}
						}
						if(isset($_REQUEST['search']))
						{
							$query_string=http_build_query($_REQUEST);
							$url='admin_main.php?page_number=17&'.$query_string;
						}
						else
						{
							$url='admin_main.php?page_number=17&'.$search_string;
						}
						//echo $search_string;
						//$url='member_list.php?';
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
						$per_page=20;
						if($per_page != "all"){
							$per_page_rec = $per_page;

							$pageno--;
							$start = (int)($pageno*$per_page_rec);
							$last = $per_page_rec;
							$limit = "limit $start , $last";
						}
						else
							$limit = " ";
						//echo $limit;
						if(isset($_REQUEST['search']))
						{
                        $res=$obj_query->query("*","registration","bonus=1 and reseller=1 $search_string $limit");
						$res_products_tol=$obj_query->query("id","registration","bonus=1 and reseller=1 $search_string $con_search ");
						$total_row=$obj_query->num_row($res_products_tol);
						 $pages = ceil($total_row/$per_page);
						$sno=1;
						while($row=$obj_query->get_all_row($res))
						{
						?>
                        <tr>
                          <td><input  type="checkbox" name="id[]" id="id[]" value="<?php echo $row['user_id'];?>" /></td>
                          <td><?php echo $sno;?></td>
                          <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $row['user_name'];?></td>
                          <td><?php echo $row['first_name'].' '.$row['mid_name'].' '.$row['last_name'];?></td>
                          <td><?php echo $row['user_type'];?></td>
                          <td><?php echo $row['mem_status'];?></td>
                          <td><?php echo $row['ref_id'];?></td>
                          <td><?php echo $row['bonus_date'];?></td>
                          <td><?php echo $row['reg_date'];?></td>
                          
                        </tr>
						<?php
						$sno++;
                        }
						?>
                        <tr>
                        <td colspan="10"><textarea name="product_ides" id="product_id" class="validate[required,custom[email]] form-control placeholder" placeholder="Enter Product Code With Comma Seperated." cols="40" rows="2"  onkeyup="checkproductcode(this.value);"  onblur="update_product_code();" required></textarea></td>
                        </tr>
                        <tr>
                        <td colspan="10"><div id="show_product_code"></div><div id="show_product_codes"></div></td>
                        </tr>
                        <tr>
                        <td colspan="5"><input type="button" name="Check_All" class="submit" value="Check All" onClick="Check(document.myform.check_list)" /></td>
                        <td colspan="5" align="left"><button class="btn btn-danger side"  type="submit" id="button" >Submit</button></td></tr>
                        <?php
						}
						?>
                      </tbody>
                    </table>
                    </form>
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
	if(count<=5)
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
		var remcount=5-counts;
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
	if(count<=5)
	{
		var remcount=5-count;
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
		var remcount=5-counts;
		document.getElementById('show_product_code').innerHTML=remcount+' Products Remaining';
	}
	else
	{
		alert("Can Not Enter More Than 5 Products Code.");
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