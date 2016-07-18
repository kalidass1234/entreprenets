<?php
include("header.php");
include("pagination.php");
?>
<!-- Main content starts -->

<div class="content">
  <!-- Sidebar -->
  <?php
    include("nav.php");
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
        <span class="divider">/</span> <a href="#" class="bread-current">Dashboard</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->
    <div class="matter">
      <div class="container">
      
        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal" onclick="showformmaterial('');">Add More Banner</a>
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Marketing" />
         	  <input type="hidden1" name="m_id" id="material_id"  />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Banner Add</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <button type="button" class="btn btn-primary btn-xs  right-side">View </button>
                      <br>
                      <label for="country"><span class="super">*</span>Select Categary Name</label>
                      <select class="form-control placeholder" id="c_id" name="c_id" data-bind="options: availableCountries, value: selectedCountry, optionsCaption: 'Country'">
                        <option value>Enter the categary</option>
                        <?php
						$field_arr=array("c_id","category_name");
						$condition="1=1";
						$value="c_id";
						$name="category_name";
                        $obj_query->get_dropdown("category1",$field_arr,$condition,$value,$name,$check=false);
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="country"><span class="super">*</span>Select Language</label>
                      <select class="form-control placeholder" id="l_id" name="l_id" data-bind="options: availableCountries, value: selectedCountry, optionsCaption: 'Country'">
                        <option value="">Select Language</option>
                        <?php
						$field_arr=array("l_id","language_name");
						$condition="1=1";
						$value="l_id";
						$name="language_name";
                        $obj_query->get_dropdown("language",$field_arr,$condition,$value,$name,$check=false);
						?>                      </select>
                    </div>
                    <div class="form-group">
                      <label for="country"><span class="super">*</span>Select Banner Size</label>
                      <select class="form-control placeholder" id="banner" name="banner" data-bind="options: availableCountries, value: selectedCountry, optionsCaption: 'Country'">
                        <option value="">Select Size</option>
                        <?php
						$field_arr=array("id","size");
						$condition="1=1";
						$value="id";
						$name="size";
                        $obj_query->get_dropdown("banner_size",$field_arr,$condition,$value,$name,$check=false);
						?>  
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="material_title" id="material_title" placeholder=" Name" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Banner Id</label>
                      <input type="text" class="form-control placeholder" name="material_id" id="material_id" placeholder=" Name" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Uplaod Material</label>
                      <input type="file" class="form-control placeholder" name="image" id="material" placeholder=" Name" data-bind="value: name" />
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
            <div class="pull-left">Banner Details</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Language</th>
                  <th>Title</th>
                  <th>Materials Id</th>
                  <th>Categary Name</th>
                  <th>Banner</th>
                  <th>Banner size</th>
                  <th>Code</th>
                  <th>Date</th>
                  <th>Delete</th>
                  <th>Edit</th>
                  <th>Share with facebook</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['delete']) && $_GET['delete']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from materials where m_id='$mid'");
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
			  $res_products_tol=$obj_query->query("*","materials","1=1 ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
			  
                $res_prod=$obj_query->query("*","materials","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				 $m=$row_prod['material'];
				 $url_landing="http://198.154.192.169/~subhash/trinity/$idd";
				 $image_show="http://198.154.192.169/~subhash/trinity/materials/$m";
				 $url="<a href='http://198.154.192.169/~subhash/trinity/$idd' target=_blank ><img src='http://198.154.192.169/~subhash/trinity/materials/$m'></a>";
				?>
                <tr>
                  <td><?php echo $sn;?></td>
                  <td><?php echo $obj_query->get_field_name("language","language_name","l_id='$row_prod[l_id]'");?></td>
                  <td><?php echo $row_prod['material_title'];?></td>
                  <td><?php echo $row_prod['material_id'];?></td>
                  <td><?php echo $obj_query->get_field_name("category1","category_name","c_id='$row_prod[c_id]'");?></td>
                  <td><img src="../materials/<?php echo $row_prod['material'];?>" width="90" height="90"></td>
                  <td><?php echo $obj_query->get_field_name("banner_size","size","id='$row_prod[banner]'");?></td>
                  <td><textarea class="form-control for-height" rows="3"   placeholder="Textarea"><?php echo $url;?></textarea></td>
                  <td><?php echo $row_prod['m_date'];?></td>
                  <td><a href="marketing_material.php?delete=1&id=<?php echo $row_prod['m_id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                  <td><a href="#myModal" onclick="showmaterialform('<?php echo $row_prod['m_id'];?>');" data-toggle="modal"><img src="images/edit.png"></a></td>
                  <td><img src="images/Facebook-Icon.png"></td>
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
	alert(id);
	document.getElementById('material_id').value=id;
}
function showmaterialform(id) {
	var formData="m_id="+id+"&action=showmaterialform";
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