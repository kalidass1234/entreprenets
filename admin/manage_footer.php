<?php
include("header.php");
include("pagination.php");
$cur_date=date('Y-m-d');
$q = mysql_query("SELECT * FROM manage_footer WHERE id=1");
$row = mysql_fetch_assoc($q);
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
        <span class="divider">/</span> <a href="#" class="bread-current">Manage Footer </a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->

      
    <div class="matter">
      <div class="container">

        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal">Edit Footer Content</a>
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/js/common.js"></script>
            
              <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="manage_footer" />
          	  <input type="hidden" name="id" value="<?=$row['id']?>" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Footer Content </h4>
                  </div>
                  
                  <div class="modal-body">
                  
                        <div class="form-group">
                           <label for="logo">Logo Image</label>
                           <input class="form-control for-height" type="file" id="logo" name="image"/>
                        </div>
                        <div class="form-group">
                            <img src="logo_image/<?=$row['logo']?>" height="100" width="100"/>
                        </div>
                  	<div class="form-group">
                           <label for="logo_content">Logo Content</label>
                           <textarea class="form-control for-height" type="text" id="logo_content" name="logo_content"><?=$row['logo_content']?></textarea>
                        </div>
                  	<div class="form-group">
                           <label for="tel">Telephone</label>
                           <input class="form-control for-height" type="text" id="tel" name="tel" value="<?=$row['tel']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="fax">Fax</label>
                           <input class="form-control for-height" type="text" id="fax" name="fax" value="<?=$row['fax']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="email">Email</label>
                           <input class="form-control for-height" type="text" id="email" name="email" value="<?=$row['email']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="fb_url">Facebook Url</label>
                           <input class="form-control for-height" type="text" id="fb_url" name="fb_url" value="<?=$row['fb_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="tw_url">Twitter Url</label>
                           <input class="form-control for-height" type="text" id="tw_url" name="tw_url" value="<?=$row['tw_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="in_url">Linked In Url</label>
                           <input class="form-control for-height" type="text" id="in_url" name="in_url" value="<?=$row['in_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="gplus_url">G+ Url</label>
                           <input class="form-control for-height" type="text" id="gplus_url" name="gplus_url" value="<?=$row['gplus_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="flickr_url">Flickr Url</label>
                           <input class="form-control for-height" type="text" id="flickr_url" name="flickr_url" value="<?=$row['flickr_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="behance_url">Behance Url</label>
                           <input class="form-control for-height" type="text" id="behance_url" name="behance_url" value="<?=$row['behance_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="rss_url">Rss Url</label>
                           <input class="form-control for-height" type="text" id="rss_url" name="rss_url" value="<?=$row['rss_url']?>" />
                        </div>
                  	<div class="form-group">
                           <label for="cpy_right">Copy Right Content</label>
                           <input class="form-control for-height" type="text" id="cpy_right" name="cpy_right" value="<?=$row['cpy_right']?>" />
                        </div>
                        <div class="form-group">
                           Note: If you want to disable any content then fill it blank.
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
            <div class="pull-left">Footer Content</div>
            <div style='color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_REQUEST['msg'])){echo $_REQUEST['msg'];} ?></div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              
              <tbody>
                  <tr>
                      <td><strong>Logo</strong></td>
                      <td style="text-align: left;"><img src="logo_image/<?=$row['logo']?>" height="100" width="100"/></td>
                  </tr>
                  <tr>
                      <td><strong>Logo content</strong></td>
                      <td style="text-align: left;"><?=$row['logo_content']?></td>
                  </tr>
                  <tr>
                      <td><strong>Telephone</strong></td>
                      <td style="text-align: left;"><?=$row['tel']?></td>
                  </tr>
                  <tr>
                      <td><strong>Fax</strong></td>
                      <td style="text-align: left;"><?=$row['fax']?></td>
                  </tr>
                  <tr>
                      <td><strong>Email</strong></td>
                      <td style="text-align: left;"><?=$row['email']?></td>
                  </tr>
                  <tr>
                      <td><strong>Facebook Url</strong></td>
                      <td style="text-align: left;"><?=$row['fb_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>Twitter Url</strong></td>
                      <td style="text-align: left;"><?=$row['tw_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>Linked In Url</strong></td>
                      <td style="text-align: left;"><?=$row['in_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>G+ Url</strong></td>
                      <td style="text-align: left;"><?=$row['gplus_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>Flickr Url</strong></td>
                      <td style="text-align: left;"><?=$row['flickr_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>Behance Url</strong></td>
                      <td style="text-align: left;"><?=$row['behance_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>Rss Url</strong></td>
                      <td style="text-align: left;"><?=$row['rss_url']?></td>
                  </tr>
                  <tr>
                      <td><strong>Copy Right Content</strong></td>
                      <td style="text-align: left;"><?=$row['cpy_right']?></td>
                  </tr>
                   
              </tbody>
            </table>
            
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
	var formData="m_id="+id+"&action=showeedithowit";
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