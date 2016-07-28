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
        <span class="divider">/</span> <a href="#" class="bread-current">Package</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->

      
    <div class="matter">
      <div class="container">
        <!-----add package------>
        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal" onClick="showformmaterial('');">Add More Package</a>
          <!-- Modal -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
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
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Package</h4>
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
                       <div class="form-group">
                          <label for="name"><strong>CMS Content Future</strong></label>
                       </div>
                        <?php
                        $keyvQ=$obj_query->query_execute("select * from package_feature");
                        $ff=0;
                        while($keyv=$obj_query->get_all_row($keyvQ)){
                        ?>
                        <div class="form-group">
                            <label for="name"><?=$keyv['name'].':'?></label><br>
                           <?php
                            if($keyv['input_type']==1)
                            {
                            ?>
                           <input type="radio" id="cms_col_<?=$keyv['id']?>" name="cms[<?=$keyv['id']?>]" value="1" />Yes
                            <input type="radio" id="cms_col_<?=$keyv['id']?>" name="cms[<?=$keyv['id']?>]" value="0" />No
                            <?php
                            } else {
                            ?>
                            <input class="form-control for-height" type="text" name="cms[<?=$keyv['id']?>]" id="cms_col_<?=$keyv['id']?>" value=""/>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                       
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
            <div class="pull-left">Package Details</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Package Name</th>
                  <th>Package Amount</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['delete']) && $_GET['delete']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from package where package_id='$mid'");
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
					$url='admin_main.php?page_number=156&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=156&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","package","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","package","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php echo $row_prod['package_name'];?></td>
                      <td>$<?php echo $row_prod['total_price'];?></td>

                      <td><a href="admin_main.php?page_number=156&delete=1&id=<?php echo $row_prod['package_id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      <td><a href="#myModal" onClick="showmaterialform(<?php echo $row_prod['package_id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
          
          
        <div> <a href="#myModalF" class="btn btn-info" data-toggle="modal" >Add More Package Feature</a>
          <!-- Modal -->
            <div id="myModalF" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            
              <form name="marketing_product" id="marketing_product1" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_packages_feature" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Package Feature</h4>
                  </div>
                  <div class="modal-body">
                       <div class="form-group">
                          <label for="name">Package Feature Name</label>
                          <input class="form-control for-height" type="text" name="name" value="" placeholder="Enter name"/>
                       </div>
                       <div class="form-group">
                          <label for="name">Input Type</label>
                          <input type="radio" id="input_type" name="input_type" value="1" />Radio Box
                           <input type="radio" id="input_type" name="input_type" value="2"/>Input Box
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
            <div class="pull-left">Package Feature Details</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Package Feature Name</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['deleteF']) && $_GET['deleteF']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from package_feature where id='$mid'");
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
					$url='admin_main.php?page_number=156&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=156&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","package_feature","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","package_feature","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php echo $row_prod['name'];?></td>

                      <td><a href="admin_main.php?page_number=156&deleteF=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      <td><a href="#myModalF" onClick="showfeatureform(<?php echo $row_prod['id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
        
         <div> <a href="#myModalT" class="btn btn-info" data-toggle="modal" >Add More Package CMS Tab</a>
          <!-- Modal -->
            <div id="myModalT" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
            
              <form name="marketing_product" id="marketing_product1" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_packages_tab" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Package Tab</h4>
                  </div>
                  <div class="modal-body">
                       <div class="form-group">
                          <label for="name">Tab Title</label>
                          <input class="form-control for-height" type="text" name="title" id="name" value="<?=$row['title']?>" required  />
                      </div>
                      <div class="form-group">
                          <label for="name">Tab Subtitle Name</label>
                          <input class="form-control for-height" type="text" name="subtitle" id="name" value="<?=$row['subtitle']?>" required  />
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
            <div class="pull-left">Package Tab Details</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Package Tab Title</th>
                  <th>Package Tab Subtitle</th>
                  <th>Manage Tab Content</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['deleteT']) && $_GET['deleteT']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from package_CMS_tab where id='$mid'");
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
					$url='admin_main.php?page_number=156&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=156&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","package_CMS_tab","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","package_CMS_tab","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php echo $row_prod['title'];?></td>
                      <td><?php echo $row_prod['subtitle'];?></td>
                      <td><a href="admin_main.php?page_number=210&id=<?php echo $row_prod['id'];?>">Go to tab content</a></td>

                      <td><a href="admin_main.php?page_number=156&deleteT=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      <td><a href="#myModalT" onClick="showtabform(<?php echo $row_prod['id'];?>);"  data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
        
        <div> 
          <!-- Modal -->
            <div id="myModalC" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <script type="text/javascript" src="<?php echo SITE_URL; ?>admin/ckeditor/ckeditor.js"></script>
                <?php
                $res_prod=$obj_query->query("*","package_CMS_page_title","1=1");
                $row_prod_T=$obj_query->get_all_row($res_prod);
                ?>
              <form name="marketing_product" id="marketing_product1" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_packages_page_title" />
          	  <input type="hidden" name="id" value="<?=$row_prod_T['id']?>" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Package Page Title</h4>
                  </div>
                  <div class="modal-body">
                       <div class="form-group">
                          <label for="name">Page Heading</label>
                          <input class="form-control for-height" type="text" name="heading" id="name" value="<?=$row_prod_T['heading']?>" required  />
                      </div>
                       <div class="form-group">
                          <label for="name">Page Title</label>
                          <input class="form-control for-height" type="text" name="title" id="name" value="<?=$row_prod_T['title']?>" required  />
                      </div>
                      <div class="form-group">
                          <label for="name">Page Subtitle</label>
                          <input class="form-control for-height" type="text" name="subtitle" id="name" value="<?=$row_prod_T['subtitle']?>" required  />
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
            <div class="pull-left">Package Page Title</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Package Page Heading</th>
                  <th>Package Page Title</th>
                  <th>Package Page Subtitle</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['deleteC']) && $_GET['deleteC']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from package_CMS_page_title where id='$mid'");
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
					$url='admin_main.php?page_number=156&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=156&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","package_CMS_page_title","1=1 ");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                                $res_prod=$obj_query->query("*","package_CMS_page_title","1=1 $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><?php echo $row_prod['heading'];?></td>
                      <td><?php echo $row_prod['title'];?></td>
                      <td><?php echo $row_prod['subtitle'];?></td>

                      <td><a href="admin_main.php?page_number=156&deleteC=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      <td><a href="#myModalC" data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button><!--<img src="images/edit.png">--></a>
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
function showfeatureform(id) {
	var formData="m_id="+id+"&action=showeeditpackagefeature";
	//alert(formData);
    $.ajax({
        url: 'ajax.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            //alert(data);
			$("#myModalF").html(data);
        }
    });
}
function showtabform(id) {
	var formData="m_id="+id+"&action=showeeditpackagetab";
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
function showmaterialform(id) {
	var formData="m_id="+id+"&action=showeeditpackage";
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