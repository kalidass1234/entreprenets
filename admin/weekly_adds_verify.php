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
                  <div class="pull-left">Weekly Adds Verify</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <form action="submit.php" class="validate" method="post" id='form1'>
                      <input type="hidden" name="action" value="Verify_Adds" />
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">User Id/User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="User_Id" name="user_id" onblur="showmaterialform(this.value,'weekly_adds_id');" placeholder="User Id" data-bind="value: name" />
                          </div>
                       
                          <div class="left-box">
                            <label for="name">My AddModule</label>
                            <?php
							$sql_adds="select * from weekly_adds_mp where user_id='$user_id' and status=0";
							$res_adds=mysql_query($sql_adds);
							$arr_add_count=array("","AddAccount");
							?>
                            <select name="weekly_adds_id" id="weekly_adds_id" class="validate[required] form-control placeholder" tabindex="12" required>
                            <option value="">Select My AddModule</option>
                            <?php
                            while($row_adds=mysql_fetch_assoc($res_adds))
                            {
                            ?>
                              <option value="<?php echo $row_adds['id']?>">Addmodule<?php echo $row_adds['add_count'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Publishing Site</label>
                            <input type="text" class="validate[required] form-control placeholder" id="publishing_site" name="publishing_site" placeholder="Pulishing Site" data-bind="value: name" />
                          </div>
                        
                          <div class="left-box">
                            <label for="name">Add Link</label>
                            <input type="text" class="validate[required] form-control placeholder" id="ad_link" name="ad_link" placeholder="Add Link" data-bind="value: name" />
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
function showmaterialform(id,show) {
	var formData="user_id="+id+"&action=showmodule";
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
          //  alert(data);
			$("#"+show).html(data);
        }
    });
}
</script>