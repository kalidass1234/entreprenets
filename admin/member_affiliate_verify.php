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
         
          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Member Affiliate Verification List</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                  <div class="widget-content">
                  <form name="member_list" id="member_list" action="<?php echo SITE_URL;?>admin/excel/index.php" method="post">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>C.bx</th>
                          <th>S.no.</th>
                          <th>Member Id</th>
                          <th>User Name</th>
                          <!--<th>Name</th>-->
                          <th>Id Doc</th>
                          <th>Address Doc</th>
                          <th>Status</th>
                          <th>Action</th>
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
							$url='admin_main.php?page_number=172&'.$query_string;
						}
						else
						{
							$url='admin_main.php?page_number=172&'.$search_string;
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
						$per_page=100;
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
                        $res=$obj_query->query("*","apply_for_verify","1=1 $search_string order by id desc $limit");
						$res_products_tol=$obj_query->query("id","apply_for_verify","1=1 $search_string $con_search ");
						$total_row=$obj_query->num_row($res_products_tol);
						 $pages = ceil($total_row/$per_page);
						$sno=1;
						while($row=$obj_query->get_all_row($res))
						{
						?>
                        <tr>
                          <td><input  type="checkbox" name="user_id[]" checked="checked" value="<?php echo $row['user_id'];?>" /></td>
                          <td><?php echo $sno;?></td>
                          <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $obj_query->get_field_name("registration","user_name","user_id='$row[user_id]'");?></td>
                          <!--<td><?php echo $row['first_name'].' '.$row['mid_name'].' '.$row['last_name'];?></td>-->
                          <td><a href="../userpanel/businessuser_doc/<?php echo $row['id_doc'];?>" target="_blank">ID Doc</a></td>
                          <td><a href="../userpanel/businessuser_doc/<?php echo $row['address_doc'];?>" target="_blank">Address Doc</a></td>
                          <td><?php if($row['status']) echo "Active"; else echo "Pending";?></td>
                          <td>
                          <?php if($row['status']) echo "Active"; else{?>
                          <a href="activate_member_verify.php?user_id=<?php echo $row['user_id'];?>">Activate</a>
                          <?php
                          }
						  ?>
                          </td>
                          
                        </tr>
						<?php
						$sno++;
                        }
						?>
                      </tbody>
                    </table>
                    <div class="export"><a href="javscript:void(0);" onclick="submitform();">Export in excel</a></div>
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
<script>
function submitform()
{
var formObj = $("#member_list");
    var formURL = formObj.attr("action");
	//alert(formURL);
	var formData = new FormData(formObj);
	var formdata=formObj.serialize();
	alert(formURL);
        $.ajax({
            url: formURL,
            type: 'POST',
            data:  formdata,
            mimeType:"multipart/form-data",
            contentType: true,
            cache: false,
            processData:true,
            success: function(data, textStatus, jqXHR)
            {
 				  alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
 
            }           
       });
}
</script>