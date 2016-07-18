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
                  <div class="pull-left">Repurchase Binary Bonus Detail </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=185"  method="post" class="validate" id='form1'>
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date From</label>
                            <input data-format="yyyy-MM-dd" type="date" name="from_date" class="form-control dtpicker" value="<?php echo $_POST['from_date']; ?>">
                           </div>
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date to</label>
                            <input data-format="yyyy-MM-dd" type="date" name="to_date" class="form-control dtpicker" value="<?php echo $_POST['to_date']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name"> User Id</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_id" placeholder="User Id" data-bind="value: name" value="<?php echo $_POST['user_id']; ?>" />
                          </div>
                          <div class="left-box">
                            <label for="name"> User Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_name" placeholder="User Name" data-bind="value: name" value="<?php echo $_POST['user_name']; ?>"/>
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
        <div class="row">  <!--<div class="printer"> <img src="../images/excel.png" onClick="document.forms['form3'].submit();" name="getReport" id="getReport" >
                       <img src="../images/word.png" onClick="document.forms['form2'].submit();" name="getReport" id="getReport">
                       <img src="../images/print.png"  onClick="printDiv('example');">
                        <?php
						//$heading.="<table border='1'><tr>";
						//$heading.="<td>Date</td><td>Member Id</td><td>Left Carry Forword</td><td>Right Carry Forword</td><td>Left Match</td><td>Right Match</td><td>Cycle</td><td>Bonus(BV)</td><td>Bonus($)</td></tr>";
						
						//$heading3="Date,Member Id,Left Carry Forword,Right Carry Forword,Left Match,Right Match,Cycle,Bonus(BV),Bonus($)";
						
						//$record = "b_date,user_id,carry_fwd_left,carry_fwd_right,match_left,match_right,income_pair,commission_bv,commission";
						//$table="repurchase_binary_income";
						?>
                        
                       <form id="form3" name="form3" method="post" action="../userpanel/ExportExcel.php">
                       <input type="hidden" name="record" value="<?php //echo $record; ?>">
                       <input type="hidden" name="table" value="<?php //echo $table; ?>">
                        <input type="hidden" name="heading3" value="<?php //echo $heading3; ?>">
                       <label></label></form>
                      
                       
                        <form id="form2" name="form2" method="post" action="../userpanel/ExportDoc.php">
                       <input type="hidden" name="record" value="<?php //echo $record; ?>">
                       <input type="hidden" name="table" value="<?php //echo $table; ?>">
                        <input type="hidden" name="heading" value="<?php //echo $heading; ?>">
                       <label></label></form> 
                       
                      <script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>
</div>--></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Repurchase Binary Income</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">
                   <form action="submit.php" method="post" name="myform" onSubmit="return ValidateData(this);">
          <input type="hidden" name="action" value="Repurchase_Binary_Income">

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>S.no.</th>
                           <th>Date</th>
                          <th>Member Id</th>
                          <th>Member Name</th>
                          <th>Left Carry Forword</th>
                          <th>Right Carry Forword</th>
                          <th>match Left</th>
                          <th>Match right</th>
                          <th>Income Pair</th>
                          <th>Loss Pair</th>
                          <th>Bonus (BV)</th>
                          <th>Bonus ($)</th>
                         <th>TDS (%)</th>
							<th>TDS Amount</th>
							<th>Misc. (%)</th>
							<th>Misc. Amount</th>
							<th>Final Bonus</th>
                          <th>Status</th>
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
					$search_string.=" and m.user_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and m.user_id='$user_id'";
					$query_string.="&user_id='$user_id'";
				}
				if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!='')
				{
					$search_string.=" and m.b_date between '".$_REQUEST['from_date']."' and '".$_REQUEST['to_date']."'";
				}
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=185&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=185&'.$search_string;
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
				$con_search="and m.status=0";
				if($admin_type=='super_admin')
				{
					$country_search= "";
				}
				else
				{
					$country_search= "and (r.country='$country_id' or r.country='$country_name')";
				}
			  //$args_categories = $mxDb->get_information('max_categories', '*', ' order by category_id desc',false, 'assoc');
			  $res_products_tol=mysql_query("select * from repurchase_binary_income m inner join registration r on m.user_id=r.user_id where m.user_id!='cmp' $country_search $search_string $con_search order by m.id desc");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
				
				
				
			  $res_cat=mysql_query("select m.id,m.b_date,m.user_id,m.carry_fwd_left,m.carry_fwd_right,m.match_left,m.match_right,m.income_pair,m.loss_pair,m.commission_bv,m.commission,m.tds_percent,m.tds_amount,m.miscellaneous_percent,m.miscellaneous_amount,m.final_amount,m.status from repurchase_binary_income m inner join registration r on m.user_id=r.user_id where m.user_id!='cmp' $country_search $search_string $con_search order by m.id desc $limit");
			  
			  $s_no = 1+$start;
			  $arr_status=array("Unpaid","Paid","Lost");
			  while($row_cat=$obj_query->get_all_row($res_cat))
			 {
				
              ?>
                <tr>
                    <td><input name="id[]" type="checkbox" id="id[]" value="<?php echo $row_cat['id']; ?>" /><?php echo $s_no; ?></td>
                    <td><?php echo $row_cat['b_date'];?></td>
                    <td><?php echo $row_cat['user_id'];?></td>
                    <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[user_id]'");?></td>
                   
                    <td><?php echo $row_cat['carry_fwd_left'];?></td>
                    <td><?php echo $row_cat['carry_fwd_right'];?></td>
                    <td><?php echo $row_cat['match_left'];?></td>
                    <td><?php echo $row_cat['match_right'];?></td>
                     <td><?php echo $row_cat['income_pair'];?></td>
                     <td><?php echo $row_cat['loss_pair'];?></td>
                    <td><?php echo $row_cat['commission_bv'];?></td>
                    <td><?php echo $row_cat['commission'];?></td>
                     <td class="center"><?php echo $row_cat['tds_percent'];?></td>
						<td class="center"><?php echo $row_cat['tds_amount'];?></td>
						<td class="center"><?php echo $row_cat['miscellaneous_percent'];?></td>
						<td class="center"><?php echo $row_cat['miscellaneous_amount'];?></td>
						<td class="center"><?php echo $row_cat['final_amount'];?></td>
                    <td><?php echo $arr_status[$row_cat['status']];?></td>
                </tr>
				<?php
				$s_no++;
                }
				?>
                <tr>
            <td colspan="18">Enter Amount(Per Cycle): <input type="text" name="response"  id="response" required></td>
            </tr>
                 <tr>
            <td colspan="6"><input type="button" name="Check_All" class="submit" value="Check All" onClick="Check(document.myform.check_list)" /></td>
            <td colspan="12"><div class="form-group">
                        <div class="left-box">
                        <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div></td>
            </tr>
                </tbody>
                    </table>
                    </form>
                    <!--<div class="export padding-space"><a href="#">Export in excel</a></div>-->
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