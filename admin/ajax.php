<?php
include("config/config.php");
include("../includes/common_function.php");
$host_name=$obj_function->host_name();
$host_name=str_replace('admin','',$host_name);
//echo $host_name;

define('SITE_URL',$host_name);
//echo "<pre>"; print_r($_POST);
if($_POST['action']=='showsubcategory')
{
	$table_name=$_POST['table_name'];
	$field_value=$_POST['field_value'];
	$field_arr=array("sub_id","sub_name");
	$condition=" cat_id='$field_value'";
	$obj_query->get_dropdown($table_name,$field_arr,$condition,"sub_id","sub_name",'');
}
if($_POST['action']=='showsubcategorybackoffice')
{
	$table_name=$_POST['table_name'];
	$field_value=$_POST['field_value'];
	$field_arr=array("id","category_name");
	$condition=" category_id='$field_value'";
	$obj_query->get_dropdown($table_name,$field_arr,$condition,"id","category_name",'');
}
if($_POST['action']=='showmaterialform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	   
	?>
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
    <?php
}
if($_POST['action']=='showfaqform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","faq","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	?>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Faq" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add FAQ</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question</label>
                      <input type="text" class="form-control placeholder" name="question" id="question" placeholder=" Question" value="<?php echo $row['question'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Answer</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="answer"  placeholder="Textarea"><?php echo $row['answer'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmsform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						$obj_function->_get_cms_category_dropdown($row['category']);
						?>
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmsbackooficeform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_backoffice","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_BackOffice" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" id="category" onChange="getajaxsdropdown('cms_subcategory_backoffice','category_id',this.value,'sub_category','showsubcategorybackoffice');" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						$obj_function->_get_cms_category_backoffice_dropdown($row['category']);
						?>
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span>Sub Category</label>
                      <select name="sub_category" id="sub_category" class="form-control placeholder">
                      	<option value="">Select Sub Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						$obj_function->_get_cms_subcategory_backoffice_dropdown($row['sub_category']);
						?>
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmssevenform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_seven","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Seven" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						//$obj_function->_get_cms_category_dropdown($row['category']);
						for($i=1;$i<8;$i++)
						{
						?>
                        	<option value="<?php echo $i;?>" <?php if($row['category']==$i){ echo "selected";}?>>Step <?php echo $i;?></option>
                        <?php
                        }
						?>
						
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Title" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 1</label>
                      <input type="text" class="form-control placeholder" name="question1" id="question" placeholder=" Question 1" value="<?php echo $row['question1'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 1(Check For Right Answer)</label>
                      <br />
                      <input type="radio" name="answer1" value="1" <?php if($row['answer1']==1){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer1_1" id="question" placeholder=" Answer 1 A" data-bind="value: name" value="<?php echo $row['answer1_1'];?>" />
                      <input type="radio" name="answer1" value="2" <?php if($row['answer1']==2){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer1_2" id="question" placeholder=" Answer 1 B" data-bind="value: name" value="<?php echo $row['answer1_2'];?>" />
                      <input type="radio" name="answer1" value="3" <?php if($row['answer1']==3){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer1_3" id="question" placeholder=" Answer 1 C" data-bind="value: name" value="<?php echo $row['answer1_3'];?>" />
                      <input type="radio" name="answer1" value="4" <?php if($row['answer1']==4){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer1_4" id="question" placeholder=" Answer 1 D" data-bind="value: name" value="<?php echo $row['answer1_4'];?>" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 2 </label>
                      <input type="text" class="form-control placeholder" name="question2" id="question" placeholder=" Question 2" value="<?php echo $row['question2'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 2(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer2" value="1" <?php if($row['answer2']==1){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer2_1" id="question" placeholder=" Answer 1 A" data-bind="value: name" value="<?php echo $row['answer2_1'];?>" />
                      <input type="radio" name="answer2" value="2" <?php if($row['answer2']==2){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer2_2" id="question" placeholder=" Answer 1 B" data-bind="value: name" value="<?php echo $row['answer2_2'];?>" />
                      <input type="radio" name="answer2" value="3" <?php if($row['answer2']==3){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer2_3" id="question" placeholder=" Answer 2 C" data-bind="value: name" value="<?php echo $row['answer2_3'];?>" />
                      <input type="radio" name="answer2" value="4" <?php if($row['answer2']==4){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer2_4" id="question" placeholder=" Answer 2 D" data-bind="value: name" value="<?php echo $row['answer2_4'];?>" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 3 </label>
                      <input type="text" class="form-control placeholder" name="question3" id="question" placeholder=" Question 3" value="<?php echo $row['question3'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 3(Check For Right Answer)</label>
                       <br />
                     <input type="radio" name="answer3" value="1" <?php if($row['answer3']==1){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer3_1" id="question" placeholder=" Answer 3 A" data-bind="value: name" value="<?php echo $row['answer3_1'];?>" />
                      <input type="radio" name="answer3" value="2" <?php if($row['answer3']==2){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer3_2" id="question" placeholder=" Answer 3 B" data-bind="value: name" value="<?php echo $row['answer3_2'];?>" />
                      <input type="radio" name="answer3" value="3" <?php if($row['answer3']==3){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer3_3" id="question" placeholder=" Answer 3 C" data-bind="value: name" value="<?php echo $row['answer3_3'];?>" />
                      <input type="radio" name="answer3" value="4" <?php if($row['answer3']==4){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer3_4" id="question" placeholder=" Answer 3 D" data-bind="value: name" value="<?php echo $row['answer3_4'];?>" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 4 </label>
                      <input type="text" class="form-control placeholder" name="question4" id="question" placeholder=" Question 4" value="<?php echo $row['question4'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 4(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer4" value="1" <?php if($row['answer4']==1){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer4_1" id="question" placeholder=" Answer 4 A" data-bind="value: name" value="<?php echo $row['answer4_1'];?>" />
                      <input type="radio" name="answer4" value="2" <?php if($row['answer4']==2){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer4_2" id="question" placeholder=" Answer 4 B" data-bind="value: name" value="<?php echo $row['answer4_2'];?>" />
                      <input type="radio" name="answer4" value="3" <?php if($row['answer4']==3){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer4_3" id="question" placeholder=" Answer 4 C" data-bind="value: name" value="<?php echo $row['answer4_3'];?>" />
                      <input type="radio" name="answer4" value="4" <?php if($row['answer4']==4){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer4_4" id="question" placeholder=" Answer 4 D" data-bind="value: name" value="<?php echo $row['answer4_4'];?>" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Question 5 </label>
                      <input type="text" class="form-control placeholder" name="question5" id="question" placeholder=" Question 5 " value="<?php echo $row['question5'];?>" data-bind="value: name" />
                    </div>
                   <div class="form-group">
                      <label for="name"><span class="super">*</span> Answer 5(Check For Right Answer)</label>
                       <br />
                      <input type="radio" name="answer5" value="1" <?php if($row['answer5']==1){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer5_1" id="question" placeholder=" Answer 5 A" data-bind="value: name" value="<?php echo $row['answer5_1'];?>" />
                      <input type="radio" name="answer5" value="2" <?php if($row['answer5']==2){ echo "checked";}?> />
                      <input type="text" class="form-control placeholder" name="answer5_2" id="question" placeholder=" Answer 5 B" data-bind="value: name" value="<?php echo $row['answer5_2'];?>" />
                      <input type="radio" name="answer5" value="3" <?php if($row['answer5']==3){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer5_3" id="question" placeholder=" Answer 5 C" data-bind="value: name" value="<?php echo $row['answer5_3'];?>" />
                      <input type="radio" name="answer5" value="4" <?php if($row['answer5']==4){ echo "checked";}?> /> <input type="text" class="form-control placeholder" name="answer5_4" id="question" placeholder=" Answer 5 D" data-bind="value: name" value="<?php echo $row['answer5_4'];?>" />
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmshometopform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_home_top","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	//$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Home_Top" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						$obj_function->_get_cms_home_top_category_dropdown($row['category']);
						//$obj_function->_get_cms_category_dropdown();
						?>
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmshomefooterform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_home_footer","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	//$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Home_Footer" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        /*foreach($arr as $key=>$val)
						{
							if($key==$row['category']){ $selected="selected";} else{ $selected="";}
							echo "<option value='".$key."' ".$selected.">".$val."</option>";
						}*/
						$obj_function->_get_cms_home_footer_category_dropdown($row['category']);
						//$obj_function->_get_cms_category_dropdown();
						?>
                        <!--<option value="1">About Us</option>
                        <option value="2">Testimonial</option>
                        <option value="3">Privacy Policy</option>
                        <option value="4">Term and Conditions</option>
                        <option value="5">Income Disclaimer</option>
                        <option value="6">Policy and Procedures</option>
                        <option value="7">Affiliate Agreement and Conditions</option>-->
                      </select>
                     
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    
                    <!--<div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
                      <script type="text/javascript">
                        
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
                    </div>-->
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </div>
              </form>
    <?php
}
if($_POST['action']=='showcmslatestworkform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_latest_work","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	//$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Latest_Work" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Image</label>
                      <input type="file" class="form-control placeholder" name="image" id="image" placeholder=" Question" value="<?php echo $row['image'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmshomeform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_home","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	//$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Home" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Category</label>
                      <select name="category" class="form-control placeholder">
                      	<option value="">Select Category</option>
                        <?php
                        $obj_function->_get_cms_home_category_dropdown($row['category']);
						?>
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmsclientsayform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_client_say","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	//$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Client_Say" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Image</label>
                      <input type="file" class="form-control placeholder" name="image" id="image" placeholder=" Question" value="<?php echo $row['image'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showcmsrecentpostform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_recent_post","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	//$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Cms_Recent_Post" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS</h4>
                  </div>
                  <div class="modal-body">
                  
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Title</label>
                      <input type="text" class="form-control placeholder" name="title" id="question" placeholder=" Question" value="<?php echo $row['title'];?>" data-bind="value: name" />
                    </div>
                    <div class="form-group">
                      <label for="name"><span class="super">*</span> Image</label>
                      <input type="file" class="form-control placeholder" name="image" id="image" placeholder=" Question" value="<?php echo $row['image'];?>" data-bind="value: name" />
                    </div>
                    <!--<div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
                      <script type="text/javascript">
                      
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
                    </div>-->
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </div>
              </form>
    <?php
}
if($_POST['action']=='showeventform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","promo","n_id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Announcement" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Announcement</h4>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                      <label for="name">Announcement Name</label>
                      <input class="form-control for-height" type="text" name="news_name" value="<?php echo $row['news_name'];?>" />
                      </div>
                   </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="description"  placeholder="Textarea"><?php echo $row['description'];?></textarea>
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
    <?php
}
if($_POST['action']=='showmemberremarkform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","static_page","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="Add_Member_Reamrk" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Member Remark</h4>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="description"  placeholder="Textarea"><?php echo $row['description'];?></textarea>
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
    <?php
}
if($_POST['action']=='showhomeregtandcform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_registration","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="CMS_Home_Reg" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Registration Term And Condition</h4>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='showhomecompansationform')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","cms_compansation","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="CMS_Home_Comp" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $m_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add CMS Compansation</h4>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="content"  placeholder="Textarea"><?php echo $row['content'];?></textarea>
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
    <?php
}
if($_POST['action']=='checkproductvalidity')
{
	//echo "<pre>"; print_r($_POST);
	$product_id=$_POST['product_id'];
	// check product id is valid or not 
	$res=$obj_query->query("p_cat_id","product_category","p_cat_id='$product_id'");
	$count=$obj_query->num_row($res);
	if($count)
	{
		// check the product is already added or not
			echo "1";
	}
	else
	{
		// check the 
		echo "NO";
	}
}
if($_POST['action']=='showonreg')
{
	$sql1="update cms_category set show_reg_page=0";
	$obj_query->query_execute($sql1);
	$sql="update cms_category set show_reg_page=1 where id in ($_POST[catids])";
	$obj_query->query_execute($sql);
	echo "Successfully";
}
if($_POST['action']=='showmodule')
{
	$user_id=$_POST['user_id'];
	$res_user=mysql_query("select * from registration where user_name='$_POST[user_id]' or user_id='$_POST[user_id]'");
		$count_user=mysql_num_rows($res_user);
		if($count_user)
		{
		$row_user=mysql_fetch_assoc($res_user);
		$user_id=$row_user['user_id'];
		$sql_adds="select * from weekly_adds_mp where user_id='$user_id' and status=0";
		$res_adds=mysql_query($sql_adds);
		$arr_add_count=array("","AddAccount");
		echo "<option value=''>Select My AddModule</option>";
		while($row_adds=mysql_fetch_assoc($res_adds))
		{
			echo "<option value='".$row_adds['id']."'>Addmodule".$row_adds['add_count']."</option>";
		}
	}
	else
	{
		
	}	
}
if($_POST['action']=='setsponsor')
{
	$id=$_POST['catids'];
	$sql="update registration set show_reg_page=0 where ref_id='cmp'";
	$obj_query->query_execute($sql);
	$sql="update registration set show_reg_page=1 where id in ($_POST[catids])";
	$obj_query->query_execute($sql);
	echo "Successfully";
}
if($_POST['action']=='show_stock_to_sell')
{
	//echo "<pre>"; print_r($_POST);
	
	//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'stock_to_sell';
		$table_name1=TABLE_PREFIX.'stock_to_sell_mp';
		$add_date=date('Y-m-d');
		// check the member already have assign 30 products
			$sql_thirty="select * from stock_to_sell_assign where user_id='$_POST[user_id]' and type='stock_to_sell'";
			$res_thirty=mysql_query($sql_thirty);
			$count_thirty=mysql_num_rows($res_thirty);
			if(!$count_thirty)
			{
				$update_arr['user_id']=$_POST['user_id'];
				$product_code=$_POST['product_id'];
				$update_arr['product_id']=$product_code;
				
				$update_arr['add_by']=USERID;
				$update_arr['add_date']=date('Y-m-d');
				// start to check the product id validity and product mapped with user or not
				$product_code_arr=explode(",",$product_code);
				$pid_arr=array();
				foreach($product_code_arr as $keys=>$values)
				{
					$pid=$values;
					if($obj_rep->_product_validity($pid) && !$obj_rep->_product_avalidity($pid,$val,"stock_to_sell_mp"))
					{
						$pid_arr[]=$pid;
					}
				}
				// end to check the product id validity and product mapped with user or not
				
				$update['user_id']=$_POST['user_id'];
				//$product_code_arr=explode(",",$product_code);
				//echo "<pre>"; print_r($pid_arr);exit;
				foreach($pid_arr as $keys=>$values)
				{
					$update['product_id']=$values;
					$update['add_by']=USERID;
					$update['add_date']=date('Y-m-d');
					// check the product id with user complete 30 or not
					if($obj_rep->_product_thirty($val,"stock_to_sell_mp",30))
					{
						$obj_query->insert_tbl($update,$table_name1);
					}
				}
				// update the 30 products assign to user
				$products_count=count($pid_arr);
				mysql_query("insert into stock_to_sell_assign set user_id='$_POST[user_id]',products_count='$products_count',add_date='$add_date',type='stock_to_sell'");
			}	
			echo "Update Successfully";
}

if($_POST['action']=='show_qualification')
{
	//echo "<pre>"; print_r($_POST);
	//echo "<pre>"; print_r($_POST);
	$table_name=TABLE_PREFIX.'stock_to_sell';
	$table_name1=TABLE_PREFIX.'stock_qualification_mp';
	$add_date=date('Y-m-d');
	// get one month ago assign date 
	$date = strtotime($add_date);
    $date = strtotime("-1 month", $date);
    $one_month_date=date('Y-m-d', $date);
	$flag=false;
		// check for already assign or not 
		$sql_five="select * from stock_to_sell_assign where user_id='$_POST[user_id]' and type='qualification'";
		$res_five=mysql_query($sql_five);
		$count_five=mysql_num_rows($res_five);
		if($count_five)
		{
			$sql_thirty="select * from stock_to_sell_assign where user_id='$_POST[user_id]' and type='qualification' and add_date>='$one_month_date'";
			$res_thirty=mysql_query($sql_thirty);
			$count_thirty=mysql_num_rows($res_thirty);
			if($count_thirty)
			{
				$flag=true;
			}
			else
			{
				$flag=false;
			}
		
		}
		else
		{
			$flag=true;
		}
		if($flag)
		{
			// check and update lost status of the qualification pending products of the user
			$sql_lost="select * from stock_qualification_mp where user_id='$_POST[user_id]' and status=0 and add_date>='$one_month_date'";
			$res_lost=mysql_query($sql_lost);
			$count_lost=mysql_num_rows($res_lost);
			if($count_lost)
			{
				mysql_query("update stock_qualification_mp set status=2 where user_id='$_POST[user_id]' and status=0 and add_date>='$one_month_date'");
			}
			// end of  check and update lost status of the qualification pending products of the user
			$update_arr['user_id']=$_POST['user_id'];
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($obj_rep->_product_validity($pid) && !$obj_rep->_product_avalidity($pid,$val,"stock_qualification_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			
			$update['user_id']=$_POST['user_id'];
			//$product_code_arr=explode(",",$product_code);
			//echo "<pre>"; print_r($pid_arr);exit;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($obj_rep->_product_thirty($val,"stock_qualification_mp",30))
				{
					$obj_query->insert_tbl($update,$table_name1);
				}
			}
			$products_count=count($pid_arr);
			mysql_query("insert into stock_to_sell_assign set user_id='$_POST[user_id]',products_count='$products_count',add_date='$add_date',type='qualification'");
	}
	echo "Update Successfully";
}

if($_POST['action']=='show_daily_task')
{
	//echo "<pre>"; print_r($_POST);
	$table_name=TABLE_PREFIX.'weekly_adds';
	$table_name1=TABLE_PREFIX.'weekly_adds_mp';
	$add_date=date('Y-m-d');

	$date = strtotime($add_date);
    $date = strtotime("-1 day", $date);
    $one_month_date=date('Y-m-d', $date);
	
	$flag=false;
		// check for already assign or not 
		$sql_five="select * from stock_to_sell_assign where user_id='$_POST[user_id]' and type='daily_task'";
		$res_five=mysql_query($sql_five);
		$count_five=mysql_num_rows($res_five);
		if($count_five)
		{
			$sql_thirty="select * from stock_to_sell_assign where user_id='$_POST[user_id]' and type='daily_task' and add_date>='$one_month_date'";
			$res_thirty=mysql_query($sql_thirty);
			$count_thirty=mysql_num_rows($res_thirty);
			if($count_thirty)
			{
				$flag=true;
			}
			else
			{
				$flag=false;
			}
		
		}
		else
		{
			$flag=true;
		}
		if($flag)
		{
			// check and update lost status of the weekly adds pending products of the user
			$sql_lost="select * from weekly_adds where user_id='$_POST[user_id]' and status=0 and add_date>='$one_month_date'";
			$res_lost=mysql_query($sql_lost);
			$count_lost=mysql_num_rows($res_lost);
			if($count_lost)
			{
				mysql_query("update weekly_adds set status=2 where user_id='$_POST[user_id]' and status=0 and add_date>='$one_month_date'");
			}
			// end of check and update lost status of the weekly adds pending products of the user
			$update_arr['user_id']=$_POST['user_id'];
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($obj_rep->_product_validity($pid) && !$obj_rep->_product_avalidity($pid,$val,"weekly_adds_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			$update['user_id']=$_POST['user_id'];
			$sn=1;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_count']=$sn;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($obj_rep->_product_thirty($val,"weekly_adds_mp",5))
				{
					$obj_query->insert_tbl($update,$table_name1);
				}
				$sn++;	
			}
		mysql_query(" update weekly_adds set status=1 where user_id='$val'");
		$obj_query->insert_tbl($update_arr,$table_name);
		$products_count=count($pid_arr);
		mysql_query("insert into stock_to_sell_assign set user_id='$_POST[user_id]',products_count='$products_count',add_date='$add_date',type='daily_task'");
	}
	echo "Update Successfully";
}

if($_POST['action']=='show_stock_to_sell_all')
{
	//echo "<pre>"; print_r($_POST);
	//echo "Please Wait Processing.........";
	//echo "<pre>"; print_r($_POST);
		$table_name=TABLE_PREFIX.'stock_to_sell';
		$table_name1=TABLE_PREFIX.'stock_to_sell_mp';

		$add_date=date('Y-m-d');
		$sql_user="select * from registration where bonus=1 and reseller=0";
		$res_user=mysql_query($sql_user);
		while($row_user=mysql_fetch_assoc($res_user))
		{
			// check the member already have assign 30 products
			$sql_thirty="select * from stock_to_sell_assign where user_id='$row_user[user_id]' and type='stock_to_sell'";
			$res_thirty=mysql_query($sql_thirty);
			$count_thirty=mysql_num_rows($res_thirty);
			if(!$count_thirty)
			{
				//$update_arr['user_id']=$_POST['user_id'];
				$update_arr['user_id']=$row_user['user_id'];
				$product_code=$_POST['product_id'];
				$update_arr['product_id']=$product_code;
				
				$update_arr['add_by']=USERID;
				$update_arr['add_date']=date('Y-m-d');
				// start to check the product id validity and product mapped with user or not
				$product_code_arr=explode(",",$product_code);
				$pid_arr=array();
				foreach($product_code_arr as $keys=>$values)
				{
					$pid=$values;
					if($obj_rep->_product_validity($pid) && !$obj_rep->_product_avalidity($pid,$val,"stock_to_sell_mp"))
					{
						$pid_arr[]=$pid;
					}
				}
				// end to check the product id validity and product mapped with user or not
				
				$update['user_id']=$row_user['user_id'];
				//$product_code_arr=explode(",",$product_code);
				//echo "<pre>"; print_r($pid_arr);exit;
				foreach($pid_arr as $keys=>$values)
				{
					$update['product_id']=$values;
					$update['add_by']=USERID;
					$update['add_date']=date('Y-m-d');
					// check the product id with user complete 30 or not
					if($obj_rep->_product_thirty($val,"stock_to_sell_mp",30))
					{
						$obj_query->insert_tbl($update,$table_name1);
					}
				}
				// update the 30 products assign to user
				$products_count=count($pid_arr);
				mysql_query("insert into stock_to_sell_assign set user_id='$row_user[user_id]',products_count='$products_count',add_date='$add_date',type='stock_to_sell'");
			}
		}
		
	echo "Update Successfully";		
}

if($_POST['action']=='show_qualification_all')
{
	//echo "<pre>"; print_r($_POST);
	//echo "<pre>"; print_r($_POST);
	//echo "Please Wait Processing.........";
	$table_name=TABLE_PREFIX.'stock_to_sell';
	$table_name1=TABLE_PREFIX.'stock_qualification_mp';
	$add_date=date('Y-m-d');

	// get one month ago assign date 
	$date = strtotime($add_date);
    $date = strtotime("-1 month", $date);
    $one_month_date=date('Y-m-d', $date);
	
	$sql_user="select * from registration where bonus=1 and reseller=1";
	$res_user=mysql_query($sql_user);
	while($row_user=mysql_fetch_assoc($res_user))
	{
		$flag=false;
		// check for already assign or not 
		$sql_five="select * from stock_to_sell_assign where user_id='$row_user[user_id]' and type='qualification'";
		$res_five=mysql_query($sql_five);
		$count_five=mysql_num_rows($res_five);
		if($count_five)
		{
			$sql_thirty="select * from stock_to_sell_assign where user_id='$row_user[user_id]' and type='qualification' and add_date>='$one_month_date'";
			$res_thirty=mysql_query($sql_thirty);
			$count_thirty=mysql_num_rows($res_thirty);
			if($count_thirty)
			{
				$flag=true;
			}
			else
			{
				$flag=false;
			}
		
		}
		else
		{
			$flag=true;
		}
		if($flag)
		{
			// check and update lost status of the qualification pending products of the user
			$sql_lost="select * from stock_qualification_mp where user_id='$row_user[user_id]' and status=0 and add_date>='$one_month_date'";
			$res_lost=mysql_query($sql_lost);
			$count_lost=mysql_num_rows($res_lost);
			if($count_lost)
			{
				mysql_query("update stock_qualification_mp set status=2 where user_id='$row_user[user_id]' and status=0 and add_date>='$one_month_date'");
			}
			// end of  check and update lost status of the qualification pending products of the user
			$update_arr['user_id']=$row_user['user_id'];
			$product_code=$_POST['product_id'];
			$update_arr['product_id']=$product_code;
			
			$update_arr['add_by']=USERID;
			$update_arr['add_date']=date('Y-m-d');
			// start to check the product id validity and product mapped with user or not
			$product_code_arr=explode(",",$product_code);
			$pid_arr=array();
			foreach($product_code_arr as $keys=>$values)
			{
				$pid=$values;
				if($obj_rep->_product_validity($pid) && !$obj_rep->_product_avalidity($pid,$val,"stock_qualification_mp"))
				{
					$pid_arr[]=$pid;
				}
			}
			// end to check the product id validity and product mapped with user or not
			
			$update['user_id']=$row_user['user_id'];
			//$product_code_arr=explode(",",$product_code);
			//echo "<pre>"; print_r($pid_arr);exit;
			foreach($pid_arr as $keys=>$values)
			{
				$update['product_id']=$values;
				$update['add_by']=USERID;
				$update['add_date']=date('Y-m-d');
				// check the product id with user complete 30 or not
				if($obj_rep->_product_thirty($val,"stock_qualification_mp",30))
				{
					$obj_query->insert_tbl($update,$table_name1);
				}
			}
			$products_count=count($pid_arr);
			mysql_query("insert into stock_to_sell_assign set user_id='$row_user[user_id]',products_count='$products_count',add_date='$add_date',type='qualification'");
		}
	}	
	echo "Update Successfully";
}

if($_POST['action']=='show_daily_task_all')
{
	//echo "<pre>"; print_r($_POST);
	//echo "Please Wait Processing.........";
	$table_name=TABLE_PREFIX.'weekly_adds';
	$table_name1=TABLE_PREFIX.'weekly_adds_mp';
	$add_date=date('Y-m-d');
	/*foreach($_POST['id'] as $key=>$val)
	{*/
	// get one month ago assign date 
	$date = strtotime($add_date);
    $date = strtotime("-1 day", $date);
    $one_month_date=date('Y-m-d', $date);
	$sql_user="select * from registration where bonus=1";
	$res_user=mysql_query($sql_user);
	while($row_user=mysql_fetch_assoc($res_user))
	{
		$sql_first="select * from reseller_first where user_id='$row_user[user_id]'";
		$res_first=mysql_query($sql_first);
		$count_first=mysql_num_rows($res_first);
		if($count_first)
		{
			$flag=false;
			// check for already assign or not 
			$sql_five="select * from stock_to_sell_assign where user_id='$row_user[user_id]' and type='daily_task'";
			$res_five=mysql_query($sql_five);
			$count_five=mysql_num_rows($res_five);
			if($count_five)
			{
				$sql_thirty="select * from stock_to_sell_assign where user_id='$row_user[user_id]' and type='daily_task' and add_date='$add_date'";
				$res_thirty=mysql_query($sql_thirty);
				$count_thirty=mysql_num_rows($res_thirty);
				if($count_thirty)
				{
					$flag=false;
				}
				else
				{
					$flag=true;
				}
			
			}
			else
			{
				$flag=true;
			}
			if($flag)
			{
				// check and update lost status of the weekly adds pending products of the user
				$sql_lost="select * from weekly_adds where user_id='$row_user[user_id]' and status=0 and add_date>='$one_month_date'";
				$res_lost=mysql_query($sql_lost);
				$count_lost=mysql_num_rows($res_lost);
				if($count_lost)
				{
					mysql_query("update weekly_adds set status=2 where user_id='$row_user[user_id]' and status=0 and add_date>='$one_month_date'");
				}
				// end of check and update lost status of the weekly adds pending products of the user
				$update_arr['user_id']=$row_user['user_id'];
				$product_code=$_POST['product_id'];
				$update_arr['product_id']=$product_code;
				$update_arr['add_by']=USERID;
				$update_arr['add_date']=date('Y-m-d');
				// start to check the product id validity and product mapped with user or not
				$product_code_arr=explode(",",$product_code);
				$pid_arr=array();
				foreach($product_code_arr as $keys=>$values)
				{
					$pid=$values;
					if($obj_rep->_product_validity($pid) && !$obj_rep->_product_avalidity($pid,$val,"weekly_adds_mp"))
					{
						$pid_arr[]=$pid;
					}
				}
				// end to check the product id validity and product mapped with user or not
				$update['user_id']=$row_user['user_id'];
				$sn=1;
				foreach($pid_arr as $keys=>$values)
				{
					$update['product_id']=$values;
					$update['add_by']=USERID;
					$update['add_count']=$sn;
					$update['add_date']=date('Y-m-d');
					// check the product id with user complete 30 or not
					if($obj_rep->_product_thirty($val,"weekly_adds_mp",5))
					{
						$obj_query->insert_tbl($update,$table_name1);
					}
					$sn++;	
				}
				mysql_query(" update weekly_adds set status=1 where user_id='$val'");
				$obj_query->insert_tbl($update_arr,$table_name);
				$products_count=count($pid_arr);
				mysql_query("insert into stock_to_sell_assign set user_id='$row_user[user_id]',products_count='$products_count',add_date='$add_date',type='daily_task'");
			}
		}
	}
	echo "Update Successfully";
}
if($_POST['action']=='delete_daily_task_all')
{
	$product_code=$_POST['product_id'];
	$product_code_arr=explode(",",$product_code);
	$pid_arr=array();
	foreach($product_code_arr as $keys=>$values)
	{
		$pid=$values;
		mysql_query("delete from product_default where product_id='$pid' and type='daily_task'");
	}
	echo "Deleted Successfully";
}
if($_POST['action']=='delete_stock_to_sell_all')
{
	$product_code=$_POST['product_id'];
	$product_code_arr=explode(",",$product_code);
	$pid_arr=array();
	foreach($product_code_arr as $keys=>$values)
	{
		$pid=$values;
		mysql_query("delete from product_default where product_id='$pid' and type='stock_to_sell'");
	}
	echo "Deleted Successfully";
}
if($_POST['action']=='delete_qualification_all')
{
	$product_code=$_POST['product_id'];
	$product_code_arr=explode(",",$product_code);
	$pid_arr=array();
	foreach($product_code_arr as $keys=>$values)
	{
		$pid=$values;
		mysql_query("delete from product_default where product_id='$pid' and type='qualification'");
	}
	echo "Deleted Successfully";
}
if($_POST['action']=='show_default_product')
{
	//echo "<pre>"; print_r($_POST);
	$table_name1=TABLE_PREFIX.'product_default';
	$product_code=$_POST['product_id'];
	$product_code_arr=explode(",",$product_code);
	foreach($product_code_arr as $keys=>$values)
	{
		$pid=$values;
		$update['product_id']=$values;
		$update['type']=$_POST['type'];
		$obj_query->insert_tbl($update,$table_name1);
	}
	echo "Update Successfully";
}

if($_POST['action']=='special_product')
{
	//echo "<pre>"; print_r($_POST);
	$table_name1=TABLE_PREFIX.'special_product';
	$product_code=$_POST['product_id'];
	$product_code_arr=explode(",",$product_code);
	$q=mysql_query("select product_id from special_product") or die(mysql_error());
	$num=mysql_num_rows($q);
	if($num>0)
	{
		echo "This product already added as special product";
	}
	else
	{
	foreach($product_code_arr as $keys=>$values)
	{
		$pid=$values;
		$update['product_id']=$values;
		$update['created_date']=date("Y-m-d");
		//$update['type']=$_POST['type'];
		$obj_query->insert_tbl($update,$table_name1);
	}
	echo "Update Successfully";
	}
}
if($_POST['action']=='showeeditpackage')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","package","package_id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_packages" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['package_id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Package</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="name">Package Name</label>
                          <input class="form-control for-height" type="text" name="package_name" id="package_name" value="<?=$row['package_name']?>" required  />
                      </div>
                       <div class="form-group">
                          <label for="name">Package Amount</label>
                          <input class="form-control for-height" type="text" name="total_price" id="total_price"  value="<?=$row['total_price']?>" />
                       </div>

                       <div class="form-group">
                          <label for="name"><strong>Commission Setup</strong></label>
                       </div>

                       <div class="form-group">
                          <label for="name">First Level Commission (%)</label>
                          <input class="form-control for-height" type="text" name="first_level_comm" value="<?=$row['first_level_comm']?>" />
                       </div>
                       <div class="form-group">
                          <label for="name">Second Level Commission(%)</label>
                          <input class="form-control for-height" type="text" name="second_level_comm" id="second_level_comm" value="<?=$row['second_level_comm']?>"/>
                       </div>
                   </div>
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="package_desc"  placeholder="Textarea"><?=$row['package_desc']?></textarea>
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
              <?php }
?>
<?php
if($_POST['action']=='showeeditpage')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_pages","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_pages" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Page</h4>
                  </div>
 
                  <div class="modal-body">
                      
                      <div class="form-group">
                          <label for="name">Page Name</label>
                          <input class="form-control for-height" type="text" name="page_name" id="page_name" value="<?=$row['page_name']?>" required  />
                      </div>
                       <div class="form-group">
                          <label for="name">Page Url</label>
                          <input class="form-control for-height" readonly type="text" name="page_url" id="page_url" value="<?=$row['page_url']?>" />
                       </div>

                   </div>
                   
                        <div class="form-group">
                          <label for="name">Main Page Heading (If Any)</label>
                          <textarea class="form-control for-height" rows="3" id="editor21"  name="page_head"  placeholder="Textarea"><?php echo $row['page_head'];?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                        
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="page_desc"  placeholder="Textarea"><?=$row['page_desc']?></textarea>
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
                    <button type="submit" class="btn btn-danger"  onclick="return binarypos();">Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeeditsubpage')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_content","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	
	$cond = " id='".$page_id."'";
	$getInfoByTableNameAndID = getInfoByTableNameAndID('manage_pages',$cond);
	//echo $getInfoByTableNameAndID['page_name'];
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_sub_pages" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id;?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page[<?=$getInfoByTableNameAndID['page_name'];?>]</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="name">Page Name</label>
                          <input class="form-control for-height" type="text" name="page_name" id="page_name" value="<?=$row['page_name']?>" required  />
                      </div>
                       <div class="form-group">
                          <label for="name">Page Url</label>
                          <input class="form-control for-height" type="text" name="page_url" id="page_url" value="<?=$row['page_url']?>" />
                       </div>
                        <div class="form-group">
                          <label for="name">Page Heading Desc</label>
                          <textarea class="form-control for-height" rows="3" id="editor1"  name="page_desc_head"  placeholder="Textarea"><?=$row['page_desc_head']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor1',
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
                    <div class="form-group">
                      <label for="name">Content</label>
                      <textarea class="form-control for-height" rows="3" id="editor2"  name="page_desc"  placeholder="Textarea"><?=$row['page_desc']?></textarea>
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
                    <button type="submit" class="btn btn-danger"  onclick="return binarypos();">Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeeditnews')
{
	//echo "<pre>"; print_r($_POST);
	$cat_id = $_POST['cat_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_news","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_news" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit News Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">News Title</label>
                           <input class="form-control for-height" type="text" id="news_title" name="news_title" value="<?=$row['news_title']?>" />
                           <input type="hidden" id="cat_id" name="cat_id" value="<?=$cat_id;?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Member Name</label>
                           <input class="form-control for-height" type="text" id="member_name" name="member_name" value="<?=$row['member_name']?>" />
                        </div>
                        <div class="form-group">
                           <label for="name">Category</label>
                           <?php
						   

							$cat_idDatabase = $row['cat_id'];
				
							if($cat_idDatabase!='')
							{
								$cat_idDatabase = explode(',',$cat_idDatabase);
							}
			
			
						   	$getInfoByTableName = getInfoByTableName("manage_category_news");
							foreach($getInfoByTableName as $records)
							{?>
                             	<input type="checkbox" id="cat_id[]" name="cat_id[]" value="<?=$records['title']?>"
								<?php if(in_array($records['title'],$cat_idDatabase)){?>checked<?php } ?>/><?=$records['title']?>
                           <?php } ?>
                        </div>

                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                        </div>
                        <div class="form-group">
                           <img src="news_image/<?=$row['image']?>" width="100" height="100">
                        </div>

                  	    <div class="form-group">
                           <label for="name">News Status - </label>
                           <input type="radio" id="news_status2" name="news_status" value="1" <?php if($row['news_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="news_status" value="0" <?php if($row['news_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="news_desc" placeholder="Textarea"><?=$row['news_desc']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeeditsteps')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_steps","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_steps" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="step_desc" placeholder="Textarea"><?=$row['step_desc']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeeditteam')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_team","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_team" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Member Name</label>
                           <input class="form-control for-height" type="text" id="member_name" name="member_name" value="<?=$row['member_name'];?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                        </div>
                        <div class="form-group">
                           <img src="team_image/<?=$row['image']?>" width="100" height="100">
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?> />Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="team_desc" placeholder="Textarea"><?=$row['team_desc'];?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeeditpartner')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_partner","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_partners" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Member Name</label>
                           <input class="form-control for-height" type="text" id="member_name" name="member_name" value="<?=$row['member_name'];?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                        </div>
                        <div class="form-group">
                           <img src="partner_image/<?=$row['image']?>" width="100" height="100">
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?> />Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>

                   </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeeditfeatures')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_member_area_features","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_features" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="features_desc" placeholder="Textarea"><?=$row['features_desc']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeeditprogram')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_program_events","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_program" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="program_desc" placeholder="Textarea"><?=$row['program_desc']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeeditprojects')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_projects","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_projects" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Project Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                        </div>
                        <div class="form-group">
                           <img src="project_image/<?=$row['image']?>" width="100" height="100">
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="project_desc" placeholder="Textarea"><?=$row['project_desc']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeeditslider')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_slider","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_slider" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Slider Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">First Line</label>
                           <input class="form-control for-height" type="text" id="first_title" name="first_title" value="<?=$row['first_title']?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Secont Line</label>
                           <input class="form-control for-height" type="text" id="second_title" name="second_title" value="<?=$row['second_title']?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Third Line</label>
                           <input class="form-control for-height" type="text" id="third_title" name="third_title" value="<?=$row['third_title']?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Link</label>
                           <input class="form-control for-height" type="text" id="slider_link" name="slider_link" value="<?=$row['slider_link']?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                        </div>
                        <div class="form-group">
                           <img src="slider_image/<?=$row['image']?>" width="100" height="100">
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?> />Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                   </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>




<?php
if($_POST['action']=='showeeditcatb')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_category_business","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>

    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_bus_cat" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Category Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                   </div>
				  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeeditcat')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_category_news","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_news_cat" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Category Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        

                   </div>
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="cat_desc" placeholder="Textarea"><?php echo $row['cat_desc'];?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
						<div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeedittestimonial')
{
	//echo "<pre>"; print_r($_POST);
	$page_id = $_POST['page_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_testimonials","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_testim" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Sub Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Member Name</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>
                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                        </div>
                        <div class="form-group">
                           <img src="testimonial_image/<?=$row['image']?>" width="100" height="100">
                        </div>
                  	    <div class="form-group">
                           <label for="name">Designation</label>
                           <input class="form-control for-height" type="text" id="designation" name="designation" value="<?=$row['designation']?>" />
                        </div>
                        <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="step_desc" placeholder="Textarea"><?=$row['step_desc']?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeedithowit')
{
	//echo "<pre>"; print_r($_POST);
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_how_it_other","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="howit" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Page</h4>
                  </div>
 
                  <div class="modal-body">

                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?=$row['title']?>" />
                        </div>

                        <div class="form-group">
                          <label for="name">Second Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor221" name="second_desc" placeholder="Textarea"><?php echo $row['second_desc'];?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor221',
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

                        <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="news_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?>/>Yes
                           <input type="radio" id="news_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Third Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="third_desc" placeholder="Textarea"><?php echo $row['third_desc'];?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                   



                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"  onclick="return binarypos();">Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeeditslidernews')
{
	//echo "<pre>"; print_r($_POST);
	$news_id = $_POST['news_id'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_news_slider","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_slider_news" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Slider Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                           <input type="hidden" id="news_id" name="news_id" value="<?=$news_id;?>" />

                        </div>
                        <div class="form-group">
                           <img src="news_slider/<?=$row['image']?>" width="100" height="100">
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?> />Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
                        
                   </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>


<?php
if($_POST['action']=='showeeditbc')
{
	//echo "<pre>"; print_r($_POST);
	$busi_cat = $_POST['busi_cat'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","manage_b_cat","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>
    <script>
	function total_prices()
	{
		var other_charges = 0;
		var price = document.getElementById("price").value;
		
		var other_charges = document.getElementById("other_charges").value;
		var total_pricess = parseInt(price) + parseInt(other_charges);
		document.getElementById("total_price").value = total_pricess;
	}
	function total_subs_commission()
	{
		var price = document.getElementById("price").value;
		var subs_commissions = document.getElementById("subs_commission").value;
		
		var fsvar = price * subs_commissions/100;
		document.getElementById("subs").innerHTML = fsvar;
	}
	
	function binarypos()
	{
		var binary_type1 = document.getElementById("binary_type1").value;
		var binary_type2 = document.getElementById("binary_type2").value;
		
		if(binary_type1 >2 || binary_type2>2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 <=0 || binary_type2<=0)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
		if(binary_type1 >=2 & binary_type2>=2)
		{
			alert("1:2, 2:1, 1:1 binary types are allowed only.");	
			document.getElementById("binary_type1").focus();
			return false;
		}
	}
	</script>
    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_b_c" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Slider Page</h4>
                  </div>

                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="<?php echo $row['title'];?>" />
                           <input type="hidden" id="busi_cat" name="busi_cat" value="<?=$busi_cat;?>" />
                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?> />Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
						
                        <div class="form-group">
                          <label for="name">Content</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="cat_desc" placeholder="Textarea"><?php echo $row['cat_desc'];?></textarea>
                          <script type="text/javascript">
                             // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'editor21',
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
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>

<?php
if($_POST['action']=='showeedittut')
{
	//echo "<pre>"; print_r($_POST);
	$busi_cat = $_POST['busi_cat'];
	$m_id=$_POST['m_id'];
	$res=$obj_query->query("*","tutorials","id='$m_id'");   
	$row=$obj_query->get_all_row($res);
	$arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions");
	$cond = " id='".$page_id."'";
	?>

    <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_tut" />
         	  <input type="hidden" name="id" id="material_id" value="<?php echo $row['id'];?>" />
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Tutorial Page</h4>
                  </div>

                  <div class="modal-body">
                  
                  	    <div class="form-group">
                           <label for="name">Choose Tutorial Type</label>
                           <input class="form-control for-height" checked type="radio" id="tut_type" name="tut_type" value="<?=$row['tut_type'];?>" />
						   <?php
						   if($row['tut_type']==1)
						   {
							   echo "Doc";
						   }
						   else if($row['tut_type']==2)
						   {
							   echo "Video";
						   }
						   else if($row['tut_type']==3)
						   {
							   echo "Audio";
						   }
						   ?>
                        </div>
						   <?php
						   if($row['tut_type']==1)
						   {?>
						<div class="form-group" id ='tutd' style='display:block'>
                          <label for="name">Description</label>
                          <textarea class="form-control for-height" rows="3" id="editor2"  name="tut_desc"  placeholder="Textarea"><?php echo $row['tut_desc'];?></textarea>
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
						<?php } ?>
                       	   <?php
						   if($row['tut_type']==2)
						   {?>
						<div class="form-group" id ='videoA' style='display:block'>
                          <label for="name">Video Code</label>
                          <textarea class="form-control for-height" rows="3" id="video_code"  name="video_code" placeholder="Textarea"><?php echo $row['video_code'];?></textarea>
                        </div>
                        	<?php } ?>
                  	    <div class="form-group">
                           <label for="name">Link</label>
                           <input class="form-control for-height" type="text" id="doc_link" name="doc_link" value="<?php echo $row['doc_link'];?>" />
                        </div>

                        <div class="form-group">
                           <label for="name">File</label>
                           <input class="form-control for-height" type="file" id="doc_file" name="doc_file" value="" />
                        </div>
                        <div class="form-group">
                           tutorials_logo/<?=$row['doc_file']?>
                        </div>
                        
                        <div class="form-group">
                           <label for="name">Logo</label>
                           <input class="form-control for-height" type="file" id="logo" name="logo" value="" />
                        </div>
                        <div class="form-group">
                           <img src="tutorials_logo/<?=$row['logo']?>" width="100" height="100">
                        </div>
                        
                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" <?php if($row['display_status'] == 1){?> checked <?php } ?> />Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" <?php if($row['display_status'] == 0){?> checked <?php } ?> />No
                        </div>
						
                        
                   </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Submit</button>
                  </div>
                </div>
              </div>
              </form>
<?php } ?>