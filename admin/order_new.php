<?php
include("header.php");
include("pagination.php");
?>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <?php include("nav.php");?>
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
                  <div class="pull-left">New Order Detail </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=21"  method="post" class="validate" id='form1'>
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date From</label>
                            <input data-format="yyyy-MM-dd" type="date" name="from_date" class="form-control dtpicker">
                           </div>
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date to</label>
                            <input data-format="yyyy-MM-dd" type="date" name="to_date" class="form-control dtpicker">
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name"> User Id</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_id" placeholder="User Id" data-bind="value: name" />
                          </div>
                          <div class="left-box">
                            <label for="name"> User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_name" placeholder="User Name" data-bind="value: name" />
                          </div>
                        </div>
                         <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
              
              
          </div>
        <div class="row">  <div class="printer"><img src="images/printer_icon.png"></div></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">New Orders</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">
				<form action="submit.php" method="post" name="myform" onSubmit="return ValidateData(this);">
                  <input type="hidden" name="action" value="Diliver_Order" />
                   
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>S.no.</th>
                          <th>Invoice No</th>
                          <th>Member Id</th>
                          <th>Name</th>
                          <th>Country</th>
                          <th>Net Amount</th>
                          <th>Total Amount</th>
                          <th>Shipping</th>
                          <th>Payment Mode</th>
                          <th>Status </th>
                   		  <th>Date</th>
                          <th>View Detail</th>
                        </tr>
                      </thead>
                      <tbody>
            <?php
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
				{
					
					// get user id
					$res_user=$obj_query->query("*","registration"," user_name='$user_name' or user_id='$user_name'");
					$row_user=$obj_query->get_all_row($res_user);
					$user_id=$row_user['user_id'];
					$search_string.=" and a.user_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and a.user_id='$user_id'";
					$query_string.="&user_id='$user_id'";
				}
				
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=21&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=21&'.$search_string;
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
			$per_page=50;
			if($per_page != "all"){
				$per_page_rec = $per_page;
				$pageno--;
				$start = (int)($pageno*$per_page_rec);
				$last = $per_page_rec;
				$limit = "limit $start , $last";
			}
			else
				$limit = " ";
				if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					$country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  $res_products_tol=mysql_query("select * from amount_detail a inner join registration r on a.user_id=r.user_id where a.status=1 $country_search $search_string $con_search order by a.am_id desc");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 
			  $res_cat=mysql_query("select * from amount_detail a inner join registration r on a.user_id=r.user_id where a.status=1 $country_search $search_string $con_search order by a.am_id desc $limit");
			  
			  $s_no = 1+$start;
			  $arr_status=array("Pending","Confirm","Diliver","Cancel");
			  while($row_cat=$obj_query->get_all_row($res_cat))
			 {
              ?>
                <tr>
                    <td><?php echo $s_no;?><input  type="checkbox" name="id[]" id="id[]" value="<?php echo $row_cat['invoice_no'];?>" /></td>
                    <td><?php echo $row_cat['invoice_no'];?></td>
                    <td><?php echo $row_cat['user_id'];?></td>
                    <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'");?></td>
                     <td><?php echo $row_cat['country'];?></td>
                    <td><?php echo $row_cat['net_amount'];?></td>
                    <td><?php echo $row_cat['total_amount'];?></td>
                    <td><?php echo $row_cat['shipping_charge'];?></td>
                    <td><?php echo $row_cat['payment_mode'];?></td>
                    <td><?php echo $arr_status[$row_cat['status']];?></td>
                    <td><?php echo $row_cat['date'];?></td>
                    <td><a href="admin_main.php?page_number=182&invoice_no=<?php echo $row_cat['invoice_no'];?>" title="View">View</a></td>
                </tr>
				<?php
				$s_no++;
                }
				?>
                <tr>
                	<td colspan="10"><div id="show_product_code"></div><div id="show_product_codes"></div></td>
                </tr>
                <tr>
                	<td colspan="5"><input type="button" name="Check_All" class="submit" value="Check All" onclick="Check(document.myform.check_list)" /></td>
                	<td colspan="5" align="left"><button class="btn btn-danger side"  type="submit" id="button" >Submit</button></td>
                </tr>
                </tbody>
                    </table>
                    <div class="export padding-space"><a href="#">Export in excel</a></div>
                    <div class="widget-foot">
                     <?php echo pagination($url,$parameters,$pages,$current_page);?>
                      <!--  <ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>
                     -->
                      <div class="clearfix"></div> 
                    </div>
                  </div>
                </div>
        </div>
		<!-- Matter ends -->
    </div>
    </div>
    </div>
    </div>
   <!-- Mainbar ends -->
<!-- Content ends -->
<!-- Footer starts -->
<?php
include("footer.php");
?>
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
</script>