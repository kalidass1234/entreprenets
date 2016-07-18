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
                  <div class="pull-left">Stock Availability</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                
                <div class="widget-content">
                  <div class="padd">
                    <form action="admin_main.php?page_number=15"  method="post" class="validate" id='form1'>
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date From</label>
                            <input data-format="yyyy-MM-dd" type="date" name="from_date" value="<?php echo $_POST['from_date'];?>" class="form-control dtpicker">
                           </div>
                          <div class="left-box  input-append" id="datetimepicker1">
                            <label for="date">Date to</label>
                            <input data-format="yyyy-MM-dd" type="date" name="to_date" value="<?php echo $_POST['to_date'];?>"  class="form-control dtpicker">
                            </div>
                        </div>
                        
                        <div class="form-group">
                         
                          <div class="left-box">
                            <label for="name"> Product Name</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" value="<?php echo $_POST['product_name'];?>" name="product_name" placeholder="Product Name" data-bind="value: name" />
                          </div>
                        </div>
                        
                        <div class="form-group">
                         
                          <div class="left-box">
                            <label for="name"> Quantity</label>
                           <!-- <input type="text" class="validate[required] form-control placeholder" id="personName" value="<?php echo $_POST['quantity'];?>" name="quantity" placeholder="Quantity" data-bind="value: name" />-->
                            <select name="quantity" class="validate[required] form-control placeholder">
                            <option value="">Quantity</option>
                            <option value="20">Less than 20</option>
                             <option value="50">Less than 50</option>
                             <option value="100">Less than 100</option>
                             <option value="500">Less than 500</option>
                             <option value="1000">Less than 1000</option>
                             <option value="5000">Less than 5000</option>
                              <option value="10000">Less than 10000</option>
                             </select>
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
        <div class="row">  <div class="printer">
        
        
       
                       
                       <img src="../images/print.png"  onClick="printDiv('example');">
                       
                       
                      <script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }
</script>

        
      </div></div>
          <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Stock Availability</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content" id="example">

                   <table class="table table-striped table-bordered table-hover">
                        <?php
						 $from_date=$_POST['from_date'];
						$to_date=$_POST['to_date'];
						$quantity=$_POST['quantity'];
				if(isset($_POST['search']) && $_POST['product_name']!='' && ($_POST['from_date']!='' && $_POST['to_date']!='') && $quantity!='')
				{
					$cond="where product_name like '".$_POST['product_name']."%' and ( add_date between '$from_date' and '$to_date' ) and p_qty='$quantity'";
				}
				elseif(isset($_POST['search']) && $_POST['product_name']!='')
				{
					$cond="where product_name like '".$_POST['product_name']."%'";
				}
				elseif(isset($_POST['search']) && ($_POST['from_date']!='' && $_POST['to_date']!=''))
				{
					$cond="where add_date between '$from_date' and '$to_date'";
				}
				elseif(isset($_POST['search']) && $quantity!='')
				{
					$cond="where p_qty <='$quantity'";
				}
				elseif(isset($_POST['search']) && $quantity!='' && $_POST['product_name']!='')
				{
					$cond="where p_qty<='$quantity' and product_name like '".$_POST['product_name']."%'";
				}
				//echo "select p.p_cat_id,p.product_name,p.image,s.user_id,s.quantity,s.add_by,s.remark from product_category p inner join stock_to_sell_history s on p.p_cat_id=s.product_id $cond";
					
			$qry=mysql_query("select p_cat_id,product_name,image,p_qty from product_category $cond") or die(mysql_error());
			$num=mysql_num_rows($qry);
			if($num>0)
			{
					?>
						<thead>
                        
						<tr>
                        <th>S. No.</th>
							<th>Product Name</th>
                            <th>Image</th>
							<th>Quantity</th>
							<th>Action</th>
                          
						</tr>
						</thead>
						<tbody>
                 
                 
                 <?php
				 $i=1;
					
			while($row=mysql_fetch_assoc($qry))
			{
				?>
						<tr>
						 <td class="center">
                        <?php echo $i;?> 
						</td>
                        
                         <td class="center">
                        <?php echo $row['product_name']; ?> 
						</td>
                      
                        <td class="center">
                       <?php
                  if($row['image']!='')
				  {
				  ?>
                  <img src="<?php echo SITE_URL."product_logos/".$row['image']; ?>" width="60" height="60" />
                  <?php
                  }
				  else
				  {
				  ?>
                  <img src="<?php echo SITE_URL."product_logos/nv.jpg"; ?>" width="60" height="60" />
                  <?php
				  }
				  ?>
						</td>
                       
                        <td class="center">
                       <?php if($row['p_qty']>20) { echo $row['p_qty']; } else { ?>
                   <span style="color:red;"><?php echo $row['p_qty'];  ?></span><?php } ?>
						</td>
                        <td class="center">
                        <a href="admin_main.php?page_number=181&product_id=<?php echo $row['p_cat_id'];?>&product_name=<?php echo $row['product_name'];?>" title="Edit"><img src="../images/edit.png" /></a>
						</td>
                       
						</tr>
                        <?php
			
			}
			?>
						</tbody>
                        <?php
			}
			else
			{
				
			?>
                        <tfoot>
                        <tr><td><?php echo "There is no product"; ?></td></tr></tfoot>
                        <?php
			}
			?>
						</table>
                        
                 
                   <!-- <div class="export padding-space"><a href="#">Export in excel</a></div>-->
                    <div class="widget-foot">
                     <?php //echo pagination($url,$parameters,$pages,$current_page);?>
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