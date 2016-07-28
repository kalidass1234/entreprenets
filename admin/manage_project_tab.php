<?php
include("header.php");
include("pagination.php");
?>
<!-- Main content starts -->
	
    
<div class="content">
  <!-- Sidebar -->
  <?php
    include("nav.php");
    $tabq="";
    $res_prod=$obj_query->query("*","manage_projects","id='".$_REQUEST['id']."'");
    $row_prod_T=$obj_query->get_all_row($res_prod);
    if(!empty($row_prod_T)){
	?>
  <!-- Sidebar ends -->
  <!-- Main bar -->
  <div class="mainbar">
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Dashboard</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <!-- Divider -->
        <span class="divider">/</span> <a href="admin_main.php?page_number=31" class="bread-current">Projects</a> 
        <span class="divider">/</span> <a href="#" class="bread-current"><?=$row_prod_T['title']?></a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->

      
    <div class="matter">
      <div class="container">
        <!-----add package------>
        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal" onClick="showformmaterial('<?=$row_prod_T['id']?>');">Add More "<?=$row_prod_T['title']?>" Tab Content</a>
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            
              <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_project_tab_content" />
          	  <input type="hidden" name="project_id" value="<?=$row_prod_T['id']?>" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add "<?=$row_prod_T['title']?>" Tab Content</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                           <label for="name">Tab Category</label>
                           <select name="tab_id">
                               <?php
                               $catq=$obj_query->query("*","manage_projects_tab_category","display_status=1");
				while($cat=$obj_query->get_all_row($catq))
				{
                                    echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                      <div class="form-group">
                          <label for="name">Title</label>
                          <input class="form-control for-height" type="text" name="name" id="package_name" value="" required  />
                      </div>
                       <div class="form-group">
                          <label for="name">Description</label>
                          <textarea class="form-control for-height" name="description" rows="5"></textarea>
                       </div>
                       <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" accept="image/*" id="image" name="image" value="" />
                        </div>
                   </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
        </div>
         
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left"><?=$row_prod_T['title']?> Content</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Tab Category</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['delete']) && $_GET['delete']==1)
				{
					$mid=$_GET['did'];
					$obj_query->query_execute("delete from manage_projects_tab_content where id='$mid'");
				}
				if(isset($_GET['page']) && $_GET['page']!='' && is_numeric($_GET['page']))
				{
					$current_page=$_GET['page'];
				}
				else
				{
					$current_page = 1;
				}
				if(isset($_REQUEST['search']))
				{
					$query_string=http_build_query($_REQUEST);
					$url='admin_main.php?page_number=211&id='.$row_prod_T['id'].'&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=211&id='.$row_prod_T['id'].'&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","manage_projects_tab_content","project_id=".$row_prod_T['id']);
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","manage_projects_tab_content","project_id=".$row_prod_T['id']." $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php  
                        $tabres_prod=$obj_query->query("*","manage_projects_tab_category","id='".$row_prod['tab_id']."'");
                        $tabrow_prod_T=$obj_query->get_all_row($tabres_prod);
                        echo $tabrow_prod_T['name'];
                      ?></td>
                      <td><?php echo $row_prod['name'];?></td>
                      <td><?php echo $row_prod['description'];?></td>

                      <td><a href="admin_main.php?page_number=211&id=<?=$row_prod_T['id'];?>&delete=1&did=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      <td><a href="#myModal" onClick="showmaterialform(<?php echo $row_prod['id'];?>,<?php echo $row_prod['project_id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
                      </td>
                     <!-- cms_edit.php?delete=1&id=<?php echo $row_prod['id'];?>-->
                    </tr>
                <?php
				$sn++;
                }
				?>
              </tbody>
            </table>
            <div class="widget-foot"> <?php echo pagination($url,$parameters,$pages,$current_page);?>
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
  
  <?php
  }
  ?>
</div>
</div>
<!-- Mainbar ends -->
<!-- Content ends -->
<!-- Footer starts -->
<?php
include("footer.php");
?>

<script type="text/javascript">
function showformmaterial(id)
{
	//alert(id);
	document.getElementById('material_id').value=id;
	showmaterialform('',id);
}

function showmaterialform(id,project_id) {
	var formData="m_id="+id+"&action=showeeditprojecttabcontent&project_id="+project_id;
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            //alert(data);
			$("#myModal").html(data);
        }
    });
}
</script>