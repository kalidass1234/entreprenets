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
        <span class="divider">/</span> <a href="#" class="bread-current">E-Pins</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->
    <div class="matter">
      <div class="container">
      
        <div> <!--<a href="#myModal" class="btn btn-info" data-toggle="modal" onClick="showformmaterial('');">Add More E-Pins</a>-->
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            </div>
        </div>
         
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Add Epins </div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">


              <form name="marketing_product" id="marketing_product12312" action="create_epin_func.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Announcement" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                    <h4 class="modal-title">Add E-pins</h4>
                  </div>
                  <div class="modal-body">
                   <div class="form-group">
                      <label for="name">Pin-Number</label>
                      <input class="form-control for-height" type="text" name="pin" id="pin" required  />
                      
                   </div>
                    <div class="form-group">
                     <label for="name">Package/Price</label>
					<select name="amt" required="required">
                    <option value="" selected="selected" required>Select Plan/Reg fee</option>
                    <?php
						$str="select * from package order BY total_price ASC";
						$res=mysql_query($str);
						while($package=mysql_fetch_array($res))
						{
					?>
                    <option value="<?php echo $package['package_id'];?>"><?php echo $package['package_name'];?> ($<?php echo $package['total_price'];?>)</option>
                    <?php
					 	}
					 ?>
                  </select>
                    </div>
                    </div>
                  </div>
                  <div class="">
                  <br>
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </div>
              </form>



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
	//alert(id);
	document.getElementById('material_id').value=id;
	showmaterialform(id);
}
function showmaterialform(id) {
	var formData="m_id="+id+"&action=showeaddepin";
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