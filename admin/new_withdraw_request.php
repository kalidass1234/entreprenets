<?php
include('header.php');
include("pagination.php");
?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Support Ticket</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb "> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">New Support Ticket</a> </div>
      <div class="clearfix"></div>
      <div class="error_page">
       <div class="error">
       	<h1 class="green"><?php echo $_GET['msg'];?></h1>
       </div>
      </div>
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
                <div class="pull-left">Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" method="post" id='form1'>
                  <input type="hidden" name="action" value="add_fund">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> User Id/User Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="user_name" value="<?php echo $_POST['user_name'];?>" id="user_name" placeholder="User Id/ User name" data-bind="value: name" />
                        </div>
                        
                        
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
           <?php
      if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1)
			{
				$c_id=$_REQUEST['category_id'];
				$obj_query->query_execute("delete from final_e_wallet where id='$c_id'");
			}
			if(isset($_REQUEST['search']))
			{
				extract($_REQUEST);
				if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
				{
					
					// get user id
					$res_user=$obj_query->query("*","registration"," user_name='$user_name' or user_id='$user_name'");
					$row_user=$obj_query->get_all_row($res_user);
					$user_id=$row_user['user_id'];
					$search_string.=" and user_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
				
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=43&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=43&'.$search_string;
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
                ?>
      <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">New Withdraw Request(Personal Account)</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <form action="submit.php" method="post" name="myform" onSubmit="return ValidateData(this);">
          <input type="hidden" name="action" value="Close_Withdraw_Bank">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>User Name</th>
                  <!--<th>Category Icon</th>-->
                  <th>Admin Charge</th>
                  <th>Amount</th>
                  <th>Remark</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			//  $res_products_tol=$obj_query->query("id","withdraw_fund","status=0 and admin_status=0 and mode='Personal Account' $search_string $con_search order by id desc ");

			  $res_products_tol=mysql_query("select * from withdraw_fund where (status=0 and admin_status=0) and mode='Personal Account' $search_string $con_search order by id desc") or die(mysql_error());
			  
			  
			  
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 //echo "select * from withdraw_fund where (status=0 and admin_status=0) and mode='Personal Account' $search_string $con_search order by id desc $limit";
			  $res_cat=mysql_query("select * from withdraw_fund where (status=0 and admin_status=0) and mode='Personal Account' $search_string $con_search order by id desc $limit");
			  
			  $s_no = 1;
			  	
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                  <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                  <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                  
                  <td><?php echo $row_cat['admin_charge']; ?></td>
                  <td><?php echo $row_cat['amount']; ?></td>
                  <td><?php echo $row_cat['desc']; ?></td>
                  <td><?php echo $row_cat['with_date']; ?></td>
                </tr>
                <?php 
					$s_no++;
			  }
			?>
            <tr>
            <td colspan="6"><textarea name="response" cols="40" rows="5" id="response" required></textarea></td>
            </tr>
            <tr>
            <td colspan="3"><input type="button" name="Check_All" class="submit" value="Check All" onClick="Check(document.myform.check_list)" /></td>
            <td colspan="3"><div class="form-group">
                        <div class="left-box">
                        <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div></td>
            </tr>
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
       <div class="clearfix"></div>
        <?php /*?><div class="widget">
          <div class="widget-head">
            <div class="pull-left">New Withdraw Request(Cheque)</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <form action="submit.php" method="post" name="myform" onSubmit="return ValidateData(this);">
          <input type="hidden" name="action" value="Close_Withdraw_Bank">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>User Name</th>
                  <!--<th>Category Icon</th>-->
                  <th>Admin Charge</th>
                  <th>Amount</th>
                  <th>Remark</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  $res_products_tol=$obj_query->query("id","withdraw_fund","status=0 and mode='Cheque' $search_string $con_search order by id desc ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 
			  $res_cat=$obj_query->query("*","withdraw_fund"," status=0 and mode='Cheque' $search_string $con_search order by id desc $limit");
			  
			  $s_no = 1;
			  	
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                  <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                  <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                  
                  <td><?php echo $row_cat['admin_charge']; ?></td>
                  <td><?php echo $row_cat['amount']; ?></td>
                  <td><?php echo $row_cat['desc']; ?></td>
                  <td><?php echo $row_cat['with_date']; ?></td>
                  
                 
                </tr>
                <?php 
					$s_no++;
			  }
			?>
            <tr>
            <td colspan="6"><textarea name="response" cols="40" rows="5" id="response" required></textarea></td>
            </tr>
            <tr>
            <td colspan="3"><input type="button" name="Check_All" class="submit" value="Check All" onClick="Check(document.myform.check_list)" /></td>
            <td colspan="3"><div class="form-group">
                        <div class="left-box">
                        <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div></td>
            </tr>
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
        </div><?php */?>
        <div class="clearfix"></div>
        <?php /*?><div class="widget">
          <div class="widget-head">
            <div class="pull-left">New Withdraw Request(Paypal Account)</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <form action="submit.php" method="post" name="myform" onSubmit="return ValidateData(this);">
          <input type="hidden" name="action" value="Close_Withdraw_Bank">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>User Name</th> 
                  <th>Paypal Account</th>
                  <th>Admin Charge</th>
                  <th>Amount</th>
                  <th>Remark</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
			//print_r($_REQUEST); 
			
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  $res_products_tol=$obj_query->query("id","withdraw_fund","status=0 and mode='shopdeal' $search_string $con_search order by id desc ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
						 
			  $res_cat=$obj_query->query("*","withdraw_fund"," status=0 and mode='shopdeal' $search_string $con_search order by id desc $limit");
			  
			  $s_no = 1;
			  	
			while($row_cat=$obj_query->get_all_row($res_cat))
			{
			  ?>
                <tr>
                  <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                  <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'"); ?></td>
                  <td><?php echo $row_cat['shopdeal_email']; ?></td>
                  <td><?php echo $row_cat['admin_charge']; ?></td>
                  <td><?php echo $row_cat['amount']; ?></td>
                  <td><?php echo $row_cat['desc']; ?></td>
                  <td><?php echo $row_cat['with_date']; ?></td>
                </tr>
                <?php 
					$s_no++;
			  }
			?>
            <tr>
            <td colspan="6"><textarea name="response" cols="40" rows="5" id="response" required></textarea></td>
            </tr>
            <tr>
            <td colspan="3"><input type="button" name="Check_All" class="submit" value="Check All" onClick="Check(document.myform.check_list)" /></td>
            <td colspan="3">
            <div class="form-group">
             <div class="left-box">
              <button class="btn btn-danger side" name="search" type="submit" id="button" >Submit</button>
             </div>
            </div>
            </td>
            </tr>
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
        </div><?php */?> 
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
<script language="javascript">

function ValidateData(form)

{



var chks = document.getElementsByName('id[]');

var hasChecked = false;

for (var i = 0; i < chks.length; i++)

{

if (chks[i].checked)

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
if(document.myform.Check_All.value=="Check All"){
for (i = 0; i < chk.length; i++)
chk[i].checked = true ;
document.myform.Check_All.value="UnCheck All";
}else{
for (i = 0; i < chk.length; i++)
chk[i].checked = false ;
document.myform.Check_All.value="Check All";
}
}

</script>