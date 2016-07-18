<?php
include("header.php");
include("pagination.php");
$cur_date=date('Y-m-d');
if(isset($_REQUEST['news_id']))
{
	$news_id = $_REQUEST['news_id'];
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
        <span class="divider">/</span> <a href="#" class="bread-current">Slider (News)</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->

    <div class="matter">
      <div class="container">

        <div> <a href="#myModal" class="btn btn-info" data-toggle="modal" onClick="showformmaterial('');">Add Slider(News)</a>
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
	function change_status(status,id,news_id)
	{
		 
		  var con=confirm("Do you want to change display status?"); 
		   if(con==true)
			   {
				   var link="admin_main.php?page_number=196&news_id="+news_id+"&id="+id+"&display_status="+status+"&action1=status";
				   document.location.href=link;
			   }
			else 
			   {
				return false ;
			   }
		  
	}
	</script>
              <form name="marketing_product" id="marketing_product12312" action="submit.php" method="post" enctype="multipart/form-data">
          	  <input type="hidden" name="action" value="add_slider_news" />
         	  <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Slider(News)</h4>
                  </div>
                  
                  <div class="modal-body">


                        <div class="form-group">
                           <label for="name">Image</label>
                           <input class="form-control for-height" type="file" id="image" name="image" value="" />
                           <input type="hidden" id="news_id" name="news_id" value="<?=$news_id;?>" />

                        </div>

                  	    <div class="form-group">
                           <label for="name">Display Status - </label>
                           <input type="radio" id="display_status2" name="display_status" value="1" checked/>Yes
                           <input type="radio" id="display_status1" name="display_status" value="0" />No
                        </div>

                   </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" onclick="return binarypos();">Submit</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
        </div>
         
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Slider List</div>
            <div style='color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_REQUEST['msg'])){echo $_REQUEST['msg'];} ?></div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Image</th>
                  <th>Display Status</th>
		          <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
				if(isset($_GET['delete']) && $_GET['delete']==1)
				{
					$mid=$_GET['id'];
					$obj_query->query_execute("delete from manage_news_slider where id='$mid'");
				}
				
				if(isset($_GET['action1']) && isset($_GET['id']))
				{
					if(isset($_GET['display_status']))
					{
						$status=$_GET['display_status'];
					}

					$sql_change = "UPDATE manage_news_slider set display_status='".$status."' WHERE id='".$_GET['id']."'";
					$states2 = mysql_query($sql_change);

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
					$url='admin_main.php?page_number=196&'.$query_string;
				}
				else
				{
					$url='admin_main.php?page_number=196&'.$search_string;
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
			  	$res_products_tol=$obj_query->query("*","manage_news_slider","1=1 AND news_id='".$news_id."'");
			  	$total_row=$obj_query->num_row($res_products_tol);
			  	$pages = ceil($total_row/$per_page);
                $res_prod=$obj_query->query("*","manage_news_slider","1=1 AND news_id='".$news_id."' $limit");
				$sn=1;
				while($row_prod=$obj_query->get_all_row($res_prod))
				{
				?>
                    <tr>
                      <td><?php echo $sn;?></td>
                      <td><img src="news_slider/<?php echo $row_prod['image'];?>" width="50" height="50"></td>
                     <!-- <td><?php echo $row_prod['added_date'];?></td>-->
                      <!--<td><?php echo $row_prod['binary_type1'];?></td>-->
                      <td>	   
					  	<?php if(stripslashes($row_prod["display_status"])=='1'){?>
                        <a href="javascript:void(0);" onClick="return change_status(0,<?=$row_prod["id"]?>,<?=$news_id?>);"><img border="0" src="images/visible.gif" width="25" height="25"></a>
                        <?php } else { ?>
                        <a href="javascript:void(0);" onClick="return change_status(1,<?=$row_prod["id"]?>,<?=$news_id?>);"><img src="images/invisible.gif" border="0" width="25" height="25"></a>
                        <?php } ?>	  
                      </td>
                      <!--<td><a href="admin_main.php?page_number=196&id=<?php echo $row_prod['id'];?>" >Enable Disable</a></td>-->
                      <td><a href="admin_main.php?page_number=196&delete=1&id=<?php echo $row_prod['id'];?>" onClick="if(confirm('Do You Want To Delete')){return true;} else { return false;}"><img src="images/intext-close5.png"></a></td>
                      
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
	var formData="m_id="+id+"&action=showeeditslidernews";
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