<?php 
include('header.php');
include("pagination.php");
class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$idx;
					//$levv=level_count($idx,$tid);
					$lel[]=$levv;
					
					//print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid' ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2,$tid);
		}
	}
}
function showlegid($id,$leg)
{
//echo "select * from registration where nom_id='$id' and binary_pos='$leg'";
$sql_nom1l=mysql_query("select * from registration where nom_id='$id' and binary_pos='$leg'");
$ff_nom1l=mysql_fetch_array($sql_nom1l);
return $ff_nom1l;
}
?>
<!-- Main content starts -->

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
        <div id="reportrange" class="pull-right"> <i class="fa fa-calendar"></i> <span></span> <b class="caret"></b> </div>
      </div>
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
        <div class="row">
          <div class="col-md-12 float">
          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Total Direct Member </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <form action="" method="post" class="validate" id='form1'>
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Enter User ID/User Name</label>
                    <input type="text" class="validate[required] form-control placeholder" id="user_id" name="user_id" placeholder="User ID/User name" data-bind="value: name" />
                        </div>
                  	  <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                  </form>
                  </div>
                </div>
              </div>
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Binary Tree</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <?php
			  
			  //$country_search =  check_country($country_id, $country_name,$admin_type);
              	if(isset($_REQUEST['search']))
				{
					extract($_REQUEST);
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and nom_id ='$user_id'";
					$query_string.="&user_id='$user_id'";
					// get user detail
					$res_user=$obj_query->query("*","registration","user_id='$user_id' or user_name='$user_id'");
					$row_user=$obj_query->get_all_row($res_user);
				}
				
				$shdwn = new showDwonMem();
				$shdwn->shoDwnMem($user_id,$user_id);
				$r=count($data_dwn);
				//print_r($data_dwn);
				$dir=mysql_query("select * from registration where nom_id='$user_id' order by id");
				
				$dir_count=mysql_num_rows($dir);
				$tot_mem=$r+$dir_count;				
				$level2=0;
				$level3=0;
				$level4=0;
				$level5=0;
				$level6=0;
				$level7=0;
				$level8=0;					
				for($i=0;$i<$r;$i++)
				{
				$dn=$data_dwn[$i];
				$lel[$i];
				if($lel[$i]==1){$level1++;}	
				if($lel[$i]==2){$level2++;}
				if($lel[$i]==3){$level3++;}
				if($lel[$i]==4){$level4++;}
				if($lel[$i]==5){$level5++;}
				if($lel[$i]==6){$level6++;}
				if($lel[$i]==7){$level7++;}
				if($lel[$i]==8){$level8++;}		
				}
			  ?>
              <div class="widget-content">
             <iframe src="test.php?user_id=<?php echo $row_user['user_id'];?>&first_id=<?php echo $row_user['user_id'];?>" width="1000px" height="400px" frameborder="0"></iframe>
              </div>
             <?php
             }
			 ?> 
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