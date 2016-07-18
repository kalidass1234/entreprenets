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
                  <div class="pull-left">Final Bonus Detail </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=53"  method="post" class="validate" id='form1'>
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
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="user_name" placeholder="User Name" data-bind="value: name" value="<?php echo $_POST['user_name']; ?>" />
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
        <div class="row">  <div class="printer">  <script>

function setLocation(url)
{
	window.location.href=url;
}
</script>
       
                      <!-- <img src="../images/excel.png" onClick="setLocation('ExportExcelBinaryBonus.php');" name="getReport" id="getReport" >-->
                      <!-- <img src="../images/word.png" onClick="setLocation('ExportDocBinaryBonus.php');" name="getReport" id="getReport">-->
                      <!-- <img src="../images/print.png"  onClick="printDiv('example');">-->
                       
                      <script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>
<script>function coderHakan(){var sayfa = window.open('','','width=800,height=800');sayfa.document.open("text/html");sayfa.document.write(document.getElementById('printArea').innerHTML);sayfa.document.close();sayfa.print();
}
</script>
</div></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Final Bonus</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">
<div style="width:96%; " id="printArea">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>S.no.</th>
                          <th>Date</th>
                          <th>Member Id</th>
                          <th>Member Name</th>
                          <th>Binary Pair Bonus </th>
                          <th>Matching Bonus </th>
                          <th>Sponsorship Bonus </th>
                          <th>Final Amount(Rs.)</th>
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
					$search_string.=" and income_id='$user_id'";
					$query_string.="&user_name='$user_name'";
				}
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and income_id='$user_id'";
					$query_string.="&income_id='$user_id'";
				}
				if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!='')
				{
					$search_string.=" and b_date between '".$_REQUEST['from_date']."' and '".$_REQUEST['to_date']."'";
				}
				
			}	
			if(isset($_REQUEST['search']))
			{
				$query_string=http_build_query($_REQUEST);
				$url='admin_main.php?page_number=53&'.$query_string;
			}
			else
			{
				$url='admin_main.php?page_number=53&'.$search_string;
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
//echo "select * from binary_income b inner join registration r on b.income_id=r.user_id where b.income_id!='cmp' $search_string $con_search order by b.id desc";
			  $res_products_tol=mysql_query("select * from binary_income b inner join registration r on b.income_id=r.user_id where b.income_id!='56789' AND b.bonus_name='2' $search_string $con_search order by b.id desc");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
					
			//echo "select * from binary_income b inner join registration r on b.income_id=r.user_id where b.income_id!='cmp' $search_string $con_search order by b.id desc $limit";	 
			  //$res_cat=mysql_query("select sum(final_amount) as finss,b_date,income_id,bonus_name from binary_income where income_id!='56789' $search_string $con_search GROUP by income_id,bonus_name $limit");
			  $res_cat=mysql_query("select income_id, b_date,income_id,bonus_name from binary_income where income_id!='56789' $search_string $con_search GROUP by income_id $limit");
			  
			 // $res_cat=mysql_query("select * from binary_income b inner join registration r on b.income_id=r.user_id where b.income_id!='56789' AND b.bonus_name='2' $search_string $con_search order by b.id desc $limit");
			  
			  
			  $s_no = 1+$start;
			  $arr_status=array("Paid","Paid","Lost");
			  
			  while($row_cat=$obj_query->get_all_row($res_cat))
			  {
					$res_catb=mysql_fetch_array(mysql_query("select SUM(final_amount) as fis from binary_income where bonus_name='1' AND income_id!='56789' AND income_id='".$row_cat['income_id']."' "));
					$res_catm=mysql_fetch_array(mysql_query("select SUM(final_amount) as fis  from binary_income where bonus_name='2' AND income_id!='56789' AND income_id='".$row_cat['income_id']."'"));
					$res_cats=mysql_fetch_array(mysql_query("select SUM(final_amount) as fis  from binary_income where bonus_name='3' AND income_id!='56789'  AND income_id='".$row_cat['income_id']."'"));

				$finalAmounts = $res_catb['fis'] + $res_catm['fis']+ $res_cats['fis'];
              ?>
                <tr>
                    <td><?php echo $s_no;?></td>
                    <td><?php echo $row_cat['b_date'];?></td>
                    <td><?php echo $row_cat['income_id'];?></td>
                    <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row_cat[income_id]'");?></td>
                   
                    
						<td class="center"><?php echo $res_catb['fis'];?></td>
						<td class="center"><?php echo $res_catm['fis'];?></td>
						<td class="center"><?php echo $res_cats['fis'];?></td>
<td><?php echo $finalAmounts;?></td>
                    <td><?php echo "Paid";?></td>
                </tr>
				<?php
				$s_no++;
                }
				?>
                </tbody>
                    </table>
                    </div>
                    <div class="export padding-space"><a href="exportFinal.php">Export in excel</a></div>
                     <div class="export padding-space"><a href="javascript:void();" onclick="coderHakan()">Print</a></div>
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