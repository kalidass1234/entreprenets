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
      <?php
      for($i=1;$i<8;$i++)
		{
			$arr_cat[$i]="Step ".$i;
		}
	  ?>
        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal" onClick="showformmaterial('');">Add More CMS</a>
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
              <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Seven" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                   <div class="form-group">
                      <label for="name"><span class="super">*</span> Step</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Step</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						//$obj_function->_get_cms_category_dropdown();
						for($i=1;$i<8;$i++)
						{
						?>
                        	<option value="<?php echo $i;?>">Step <?php echo $i;?></option>
                        <?php
                        }
						?>
                        <!--<option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Title" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 1</label>
                      <input type="text" class="form-control placeholder" name="question1" id="question" placeholder=" Question 1" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 1(Check For Right Answer)</label>
                      <br />
                      <input type="radio" name="answer1" value="1" /><input type="text" class="form-control placeholder" name="answer1_1" id="question" placeholder=" Answer 1 A" data-bind="value: name" />
                      <input type="radio" name="answer1" value="2" /> <input type="text" class="form-control placeholder" name="answer1_2" id="question" placeholder=" Answer 1 B" data-bind="value: name" />
                      <input type="radio" name="answer1" value="3" /> <input type="text" class="form-control placeholder" name="answer1_3" id="question" placeholder=" Answer 1 C" data-bind="value: name" />
                      <input type="radio" name="answer1" value="4" /> <input type="text" class="form-control placeholder" name="answer1_4" id="question" placeholder=" Answer 1 D" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 2 </label>
                      <input type="text" class="form-control placeholder" name="question2" id="question" placeholder=" Question 2" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 2(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer2" value="1" /><input type="text" class="form-control placeholder" name="answer2_1" id="question" placeholder=" Answer 2 A" data-bind="value: name" />
                      <input type="radio" name="answer2" value="2" /> <input type="text" class="form-control placeholder" name="answer2_2" id="question" placeholder=" Answer 2 B" data-bind="value: name" />
                      <input type="radio" name="answer2" value="3" /> <input type="text" class="form-control placeholder" name="answer2_3" id="question" placeholder=" Answer 2 C" data-bind="value: name" />
                      <input type="radio" name="answer2" value="4" /> <input type="text" class="form-control placeholder" name="answer2_4" id="question" placeholder=" Answer 2 D" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 3 </label>
                      <input type="text" class="form-control placeholder" name="question3" id="question" placeholder=" Question 3" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 3(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer3" value="1" /><input type="text" class="form-control placeholder" name="answer3_1" id="question" placeholder=" Answer 3 A" data-bind="value: name" />
                      <input type="radio" name="answer3" value="2" /> <input type="text" class="form-control placeholder" name="answer3_2" id="question" placeholder=" Answer 3 B" data-bind="value: name" />
                      <input type="radio" name="answer3" value="3" /> <input type="text" class="form-control placeholder" name="answer3_3" id="question" placeholder=" Answer 3 C" data-bind="value: name" />
                      <input type="radio" name="answer3" value="4" /> <input type="text" class="form-control placeholder" name="answer3_4" id="question" placeholder=" Answer 3 D" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 4 </label>
                      <input type="text" class="form-control placeholder" name="question4" id="question" placeholder=" Question 4" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 4(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer4" value="1" /><input type="text" class="form-control placeholder" name="answer4_1" id="question" placeholder=" Answer 4 A" data-bind="value: name" />
                        <input type="radio" name="answer4" value="2" /> <input type="text" class="form-control placeholder" name="answer4_2" id="question" placeholder=" Answer 4 B" data-bind="value: name" />
                      <input type="radio" name="answer4" value="3" /> <input type="text" class="form-control placeholder" name="answer4_3" id="question" placeholder=" Answer 4 C" data-bind="value: name" />
                      <input type="radio" name="answer4" value="4" /> <input type="text" class="form-control placeholder" name="answer4_4" id="question" placeholder=" Answer 4 D" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 5 </label>
                      <input type="text" class="form-control placeholder" name="question5" id="question" placeholder=" Question 5 " data-bind="value: name" />
                    </div>
                   <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 5(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer5" value="1" /><input type="text" class="form-control placeholder" name="answer5_1" id="question" placeholder=" Answer 5 A" data-bind="value: name" />
                        <input type="radio" name="answer5" value="2" /> <input type="text" class="form-control placeholder" name="answer5_2" id="question" placeholder=" Answer 5 B" data-bind="value: name" />
                      <input type="radio" name="answer5" value="3" /> <input type="text" class="form-control placeholder" name="answer5_3" id="question" placeholder=" Answer 5 C" data-bind="value: name" />
                      <input type="radio" name="answer5" value="4" /> <input type="text" class="form-control placeholder" name="answer5_4" id="question" placeholder=" Answer 5 D" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $url;?></textarea>
                      <script type="text/javascript">
                         // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor2',
                         {
                              filebrowserBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html',
                              filebrowserImageBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html?type=Images',
                              filebrowserFlashBrowseUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/ckfinder.html?type=Flash',
                              filebrowserUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                              filebrowserImageUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                              filebrowserFlashUploadUrl : '<?php echo SITE_URL; ?>admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                              filebrowserWindowWidth : '1000',
                              filebrowserWindowHeight : '700'
                         });
                         </script>
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
            <div class="pull-left">Seven step CMS Details</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Date</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['delete']) && $_GET['delete']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from cms_seven where id='$mid'");
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
					$url='admin_main.php?page_number=153&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=153&'.$search_string;
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
			  $res_products_tol=$obj_query->query("*","cms_seven","1=1 ");
			  $total_row=$obj_query->num_row($res_products_tol);
			  $pages = ceil($total_row/$per_page);
			  
                $res_prod=$obj_query->query("*","cms_seven","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
					// get category_name from cms_category table
					//$category_name=$obj_query->get_field_name("cms_category","category_name","id='$row_prod[category]'");
					$category_name=$arr_cat[$row_prod[category]];
				?>
                <tr>
                  <td><?php echo $sn;?></td>
                  <td><?php echo $category_name;//$obj_function->cms_arr[$row_prod['category']];?></td>
                  <td><?php echo $row_prod['title'];?></td>
                  <td><?php 
				  $regex = '/(\s|\\\\[rntv]{1})/';
				  $content=preg_replace($regex, '', $row_prod['content']);
				  echo substr(strip_tags($content),0,50);?></td>
                  <td><?php echo $row_prod['ts'];?></td>
                  <td><a href="admin_main.php?page_number=153&delete=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                  <td><a href="#myModal" onclick="showmaterialform(<?php echo $row_prod['id'];?>);"  data-toggle="modal"><img src="images/edit.png"></a></td>
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
	showmaterialform('');
}
function showmaterialform(id) {
	var formData="m_id="+id+"&action=showcmssevenform";
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