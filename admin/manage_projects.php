<?php
include("header.php");
include("pagination.php");
$cur_date=date('Y-m-d');
if(isset($_GET['delete']) && $_GET['delete']==1)
{
        $mid=$_GET['id'];
        $obj_query->query_execute("delete from manage_projects where id='$mid'");
}

if(isset($_GET['action1']) && isset($_GET['id']))
{
        if(isset($_GET['display_status']))
        {
                $status=$_GET['display_status'];
        }

        $sql_change = "UPDATE manage_projects set display_status='".$status."' WHERE id='".$_GET['id']."'";
        $states2 = mysql_query($sql_change);

}
if(isset($_GET['deleteC']) && $_GET['deleteC']==1)
{
        $mid=$_GET['id'];
        $obj_query->query_execute("delete from manage_projects_category where id='$mid'");
}

if(isset($_GET['actionC']) && isset($_GET['id']))
{
        if(isset($_GET['display_status']))
        {
                $status=$_GET['display_status'];
        }

        $sql_change = "UPDATE manage_projects_category set display_status='".$status."' WHERE id='".$_GET['id']."'";
        $states2 = mysql_query($sql_change);

}
if(isset($_GET['deleteT']) && $_GET['deleteT']==1)
{
        $mid=$_GET['id'];
        $obj_query->query_execute("delete from manage_projects_tab_category where id='$mid'");
}

if(isset($_GET['actionT']) && isset($_GET['id']))
{
        if(isset($_GET['display_status']))
        {
                $status=$_GET['display_status'];
        }

        $sql_change = "UPDATE manage_projects_tab_category set display_status='".$status."' WHERE id='".$_GET['id']."'";
        $states2 = mysql_query($sql_change);

}
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
        <span class="divider">/</span> <a href="#" class="bread-current">All Projects</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->

      
    <div class="matter">
        <div class="container">
        
        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal" onClick="showformmaterial('');">Add More Project</a>
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            <script>
            function change_status(status,id)
            {

                      var con=confirm("Do you want to change display status?"); 
                       if(con==true)
                               {
                                       var link="admin_main.php?page_number=31&id="+id+"&display_status="+status+"&action1=status";
                                       document.location.href=link;
                               }
                            else 
                               {
                                    return false ;
                               }

            }
            </script>
              <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_projects" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Projects</h4>
                  </div>
                  
                  <div class="modal-body">
                        <div class="form-group">
                           <label for="name">Project Type</label>
                           <select name="project_type">
                               <option value="1">Offline Business</option>
                               <option value="2">Online Business</option>
                               <option value="3">Feature Online Business</option>
                               <option value="4">Hot eBusinesses</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="name">Project Category</label>
                           <select name="category_id">
                               <?php
                               $catq=$obj_query->query("*","manage_projects_category","display_status=1");
				while($cat=$obj_query->get_all_row($catq))
				{
                                    echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                  	    <div class="form-group">
                           <label for="name">Title</label>
                           <input class="form-control for-height" type="text" id="title" name="title" value="" />
                           <!--<input type="hidden" id="added_date" name="added_date" value="<?=$cur_date;?>" />-->
                        </div>
                        <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image[]" value="" multiple=""/>
                           You can select multiple image.
                        </div>
                        <div class="form-group">
                           <label for="name">Youtube Video Id</label>
                           <input class="form-control for-height" type="text" id="youtube_id" name="youtube_id" value="" />
                           Only enter youtube video id. Example: A3PDXmYoF5U
                        </div>
                        
                  	<div class="form-group">
                           <label for="name">Short Description</label>
                           <textarea name="short_desc" class="form-control for-height" rows="3" placeholder="Enter short description"></textarea>
                        </div>    

                        <div class="form-group">
                          <label for="name">Description</label>
                          <textarea class="form-control for-height" rows="3" id="editor21" name="project_desc" placeholder="Textarea"><?php echo $project_desc;?></textarea>
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
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" checked/>Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" />No
                        </div>
                   </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Projects List</div>
            <div style='color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_REQUEST['msg'])){echo $_REQUEST['msg'];} ?></div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Project Type</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Manage Tab Content</th>
                  <th>Display Status</th>
		  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				
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
					$url='admin_main.php?page_number=31&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=31&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","manage_projects","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","manage_projects","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php 
                        if($row_prod['project_type']==1){
                            echo "Offline Business";
                        }
                        else if($row_prod['project_type']==2){
                            echo "Online Business";
                        }
                        else if($row_prod['project_type']==3){
                            echo "Feature Online Business";
                        }
                        else if($row_prod['project_type']==4){
                            echo "Hot eBusinesses";
                        }
                      ?></td>
                      <td><?php 
                        $catNq=$obj_query->query("name","manage_projects_category","id='".$row_prod['category_id']."' AND display_status=1");
                        $catN=$obj_query->get_row($catNq);
                        print_r($catN);
                      ?></td>
                      <td><?php echo $row_prod['title'];?></td>
                      <td><a href="admin_main.php?page_number=211&id=<?php echo $row_prod['id'];?>">Go to tab content</a></td>
                      <!--<td><?php echo $row_prod['binary_type1'];?></td>-->
                      <td>	   
					  	<?php if(stripslashes($row_prod["display_status"])=='1'){?>
                        <a href="javascript:void(0);" onClick="return change_status(0,<?=$row_prod["id"]?>);"><img border="0" src="images/visible.gif" width="25" height="25"></a>
                        <?php } else { ?>
                        <a href="javascript:void(0);" onClick="return change_status(1,<?=$row_prod["id"]?>);"><img src="images/invisible.gif" border="0" width="25" height="25"></a>
                        <?php } ?>	  
                      </td>
                      <!--<td><a href="admin_main.php?page_number=31&id=<?php echo $row_prod['id'];?>" >Enable Disable</a></td>-->
                      <td><a href="admin_main.php?page_number=31&delete=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      
                      <td><a href="#myModal" onClick="showmaterialform(<?php echo $row_prod['id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
            
        <script>
	
	function change_statusC(status,id)
	{
		 
		  var con=confirm("Do you want to change display status?"); 
		   if(con==true)
			   {
				   var link="admin_main.php?page_number=31&id="+id+"&display_status="+status+"&actionC=status";
				   document.location.href=link;
			   }
			else 
			   {
				return false ;
			   }
		  
	}
	</script>    
        <div> <a href="#myModalC" class="btn btn-info" data-toggle="modal" onClick="showcategory('');">Add Project Category</a>
          <!-- Modal -->
            <div id="myModalC" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            
              <form name="marketing_product" id="marketing_product1" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_projects_category" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Project Category</h4>
                  </div>
                  
                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Name</label>
                           <input class="form-control for-height" type="text" id="name" name="name" value="" />
                           <!--<input type="hidden" id="added_date" name="added_date" value="<?=$cur_date;?>" />-->
                        

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" checked/>Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" />No
                            </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                    </div>
                </div>
              </div>
              </form>
            </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Category</div>
            <div style='color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_REQUEST['msgc'])){echo $_REQUEST['msgc'];} ?></div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Name</th>
                  <th>Display Status</th>
		  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				
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
					$url='admin_main.php?page_number=31&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=31&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","manage_projects_category","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","manage_projects_category","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php echo $row_prod['name'];?></td>
                      <td>	   
			<?php if(stripslashes($row_prod["display_status"])=='1'){?>
                        <a href="javascript:void(0);" onClick="return change_statusC(0,<?=$row_prod["id"]?>);"><img border="0" src="images/visible.gif" width="25" height="25"></a>
                        <?php } else { ?>
                        <a href="javascript:void(0);" onClick="return change_statusC(1,<?=$row_prod["id"]?>);"><img src="images/invisible.gif" border="0" width="25" height="25"></a>
                        <?php } ?>	  
                      </td>
                      <!--<td><a href="admin_main.php?page_number=31&id=<?php echo $row_prod['id'];?>" >Enable Disable</a></td>-->
                      <td><a href="admin_main.php?page_number=31&deleteC=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      
                      <td><a href="#myModalC" onClick="showcategoryform(<?php echo $row_prod['id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
        
        
        <script>
	
	function change_statusT(status,id)
	{
		 
		  var con=confirm("Do you want to change display status?"); 
		   if(con==true)
			   {
				   var link="admin_main.php?page_number=31&id="+id+"&display_status="+status+"&actionT=status";
				   document.location.href=link;
			   }
			else 
			   {
				return false ;
			   }
		  
	}
	</script>    
        <div> <a href="#myModalT" class="btn btn-info" data-toggle="modal" onClick="showtabcategory('');">Add Project Tab Section Category</a>
          <!-- Modal -->
            <div id="myModalT" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            
              <form name="marketing_product" id="marketing_product1" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_projects_tab_category" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Project Tab Category</h4>
                  </div>
                  
                  <div class="modal-body">
                  	    <div class="form-group">
                           <label for="name">Name</label>
                           <input class="form-control for-height" type="text" id="name" name="name" value="" />
                           <!--<input type="hidden" id="added_date" name="added_date" value="<?=$cur_date;?>" />-->
                        

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" checked/>Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" />No
                            </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                    </div>
                </div>
              </div>
              </form>
            </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Tab Category</div>
            <div style='color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_REQUEST['msgt'])){echo $_REQUEST['msgt'];} ?></div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Name</th>
                  <th>Display Status</th>
		  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				
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
					$url='admin_main.php?page_number=31&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=31&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","manage_projects_tab_category","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","manage_projects_tab_category","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php echo $row_prod['name'];?></td>
                      <td>	   
			<?php if(stripslashes($row_prod["display_status"])=='1'){?>
                        <a href="javascript:void(0);" onClick="return change_statusT(0,<?=$row_prod["id"]?>);"><img border="0" src="images/visible.gif" width="25" height="25"></a>
                        <?php } else { ?>
                        <a href="javascript:void(0);" onClick="return change_statusT(1,<?=$row_prod["id"]?>);"><img src="images/invisible.gif" border="0" width="25" height="25"></a>
                        <?php } ?>	  
                      </td>
                      <!--<td><a href="admin_main.php?page_number=31&id=<?php echo $row_prod['id'];?>" >Enable Disable</a></td>-->
                      <td><a href="admin_main.php?page_number=31&deleteT=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      
                      <td><a href="#myModalT" onClick="showtabcategoryform(<?php echo $row_prod['id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
	var formData="m_id="+id+"&action=showeeditprojects";
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
function showcategory(id)
{
	//alert(id);
	document.getElementById('material_id').value=id;
	showcategoryform(id);
}
function showcategoryform(id) {
	var formData="m_id="+id+"&action=showeeditprojectscategory";
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            //alert(data);
			$("#myModalC").html(data);
        }
    });
}
function showtabcategory(id)
{
	//alert(id);
	document.getElementById('material_id').value=id;
	showtabcategoryform(id);
}
function showtabcategoryform(id) {
	var formData="m_id="+id+"&action=showeeditprojectstabcategory";
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            //alert(data);
			$("#myModalT").html(data);
        }
    });
}
</script>