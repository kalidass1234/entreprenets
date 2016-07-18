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

<div class="content" style="margin-top:50px;">
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
                <div class="pull-left">Matrix Tree</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <?php
              	if(isset($_REQUEST['search']))
				{
				extract($_REQUEST);
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and nom_id ='$user_id'";
					$query_string.="&user_id='$user_id'";
					// get user detail
					$res_user=$obj_query->query("*","registration","user_id='$user_id'");
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
              <link href="tree.css" rel="stylesheet" type="text/css">
				<script src="js/jquery-1.8.1.min.js"></script>
                <script src="js/jquery-ui.js"></script>
                <script src="js/jquery.tree.js"></script>
                <script>
                $(document).ready(function() {
                    $('.tree').tree_structure({
                        'add_option': true,
                        'edit_option': true,
                        'delete_option': true,
                        'confirm_before_delete' : true,
                        'animate_option': [true, 5],
                        'fullwidth_option': false,
                        'align_option': 'center',
                        'draggable_option': true
                    });
                });
                </script>
                <div class="overflow">
                <div>
                <ul class="tree">
                <li>
                <div>1</div>
                <ul>
                    <li>
                        <div>1.1</div>
                        <ul>
                            <li>
                                <div>1.1.1</div>
                            </li>
                            <li>
                                <div>1.1.2</div>
                            </li>
                            <li>
                                <div>1.1.3</div>
                                <ul>
                                    <li>
                                        <div>1.1.3.1</div>
                                        <ul>
                                            <li>
                                                <div>1.1.3.1.1</div>
                                            </li>
                                            <li>
                                                <div>1.1.3.1.2</div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div>1.1.3.1</div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div>1.2</div>
                        <ul>
                            <li>
                                <div>1.2.1</div>
                            </li>
                            <li>
                                <div>1.2.2</div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div>1.3</div>
                        <ul>
                            <li>
                                <div>1.3.1</div>
                            </li>
                            <li>
                                <div>1.3.2</div>
                            </li>
                            <li>
                                <div>1.3.3</div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div>1.4</div>
                        <ul>
                            <li>
                                <div>1.4.1</div>
                            </li>
                            <li>
                                <div>1.4.2</div>
                            </li>
                            <li>
                                <div>1.4.3</div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div>1.5</div>
                        <ul>
                            <li>
                                <div>1.5.1</div>
                            </li>
                            <li>
                                <div>1.5.2</div>
                            </li>
                            <li>
                                <div>1.5.3</div>
                            </li>
                        </ul>
                    </li>
                </ul>
                </li>
                </ul>
                </div>
                </div>
           
                <div class="padd newpadd">
                  <div class="matrix_box">
                    <div class="parent_1">
                      <div class="img_box">
                        <!-- Button to trigger modal -->
                        <style>
a.tip2 {
  position: relative;
  text-decoration: none;
}
a.tip2 span {display: none;}
a.tip2:hover span {
  display: block;
  position: absolute; 
  padding: .5em;
  content: attr(title);
  text-align: center;
  width: 250px;
  height: auto;
  border:5px solid #999;

  top: -170px;
  background: rgba(0,0,0,.8);
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  border-radius:10px;    
  color: #fff;
  font-size: .86em;
}
a.tip2:hover span:after {
  position: absolute;
  display: block;
  content: "";  
  border-color: rgba(0,0,0,.8) transparent transparent transparent;
  border-style: solid;
  border-width: 10px;
  height:0;
  width:0;
  position:absolute;
  bottom: -16px;
  left:1em;
}
.rw{width:auto; height:22px; margin:0 auto;}
.lf-rw{width:50%; height:22px; float:left;padding:3px; text-align:left;}
.rf-rw{width:50%; height:22px; float:left;padding:3px; text-align:left;}
                        </style>
                        <a href="#" class="tip2">
                        <img src="images/b.png" > <span>
                        <div class="rw">
                          <div class="lf-rw">User Id</div>
                          <div class="rf-rw"><?php echo $row_user['user_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Full Name</div>
                          <div class="rf-rw"><?php echo $row_user['first_name'].' '.$row_user['mid_name'].' '.$row_user['last_name'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Mobile</div>
                          <div class="rf-rw"><?php echo $row_user['mobile'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Country</div>
                          <div class="rf-rw"><?php echo $row_user['country'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">E-mail</div>
                          <div class="rf-rw"><?php echo $row_user['email'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Sponsor Id</div>
                          <div class="rf-rw"><?php echo $row_user['ref_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">D.O.J</div>
                          <div class="rf-rw"><?php echo $row_user['reg_date'];?></div>
                        </div>
                        </span></a>
                        <!-- Modal -->
                      </div>
                    </div>
                    <div class="parent_1">
                      <div class="rule"></div>
                    </div>
                    <div class="parent_1">
                      <div class="left-rule"></div>
                    </div>
                    <div class="parent_1">
                    <?php
                    // show first left member
					$row_left1=showlegid($id_show,'left'); 
					?>
                      <div class="half-box">
                        <div class="img_box">
                          <a href="#" class="tip2"><img src="images/bb.png" > <span>
                          <div class="rw">
                          <div class="lf-rw">User Id</div>
                          <div class="rf-rw"><?php echo $row_left1['user_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Full Name</div>
                          <div class="rf-rw"><?php echo $row_left1['first_name'].' '.$row_left1['mid_name'].' '.$row_left1['last_name'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Mobile</div>
                          <div class="rf-rw"><?php echo $row_left1['mobile'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Country</div>
                          <div class="rf-rw"><?php echo $row_left1['country'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">E-mail</div>
                          <div class="rf-rw"><?php echo $row_left1['email'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Sponsor Id</div>
                          <div class="rf-rw"><?php echo $row_left1['ref_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">D.O.J</div>
                          <div class="rf-rw"><?php echo $row_left1['reg_date'];?></div>
                        </div>
                          </span></a>
                          
                        </div>
                      </div>
                                          
                      <div class="parent_1">
                        <div class="half-box">
                          <div class="img_box">
                            <!-- Button to trigger modal -->
                            <a href="#" class="tip2"><img src="images/g.png" > <span>
                            <div class="rw">
                              <div class="lf-rw">User Id</div>
                              <div class="rf-rw">123456</div>
                            </div>
                            <div class="rw">
                              <div class="lf-rw">Full Name</div>
                              <div class="rf-rw">Auj</div>
                            </div>
                            <div class="rw">
                              <div class="lf-rw">Mobile</div>
                              <div class="rf-rw">012343652</div>
                            </div>
                            <div class="rw">
                              <div class="lf-rw">Country</div>
                              <div class="rf-rw">Botswana</div>
                            </div>
                            <div class="rw">
                              <div class="lf-rw">E-mail</div>
                              <div class="rf-rw">abx@gmail.com</div>
                            </div>
                            <div class="rw">
                              <div class="lf-rw">Sponsor Id</div>
                              <div class="rf-rw">1233</div>
                            </div>
                            <div class="rw">
                              <div class="lf-rw">D.O.J</div>
                              <div class="rf-rw">10-12-12</div>
                            </div>
                            </span></a></div>
                        </div>
                        <div class="parent_1">
                          <div class="sec-parent">
                            <div class="parent_1">
                              <div class="rule"></div>
                            </div>
                            <div class="parent_1">
                              <div class="left-rule"></div>
                            </div>
                            <div class="parent_1">
                              <div class="half-box">
                                <div class="img_box"> <a href="#" class="tip2"><img src="images/bb.png" > <span>
                                  <div class="rw">
                                    <div class="lf-rw">User Id</div>
                                    <div class="rf-rw">123456</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Full Name</div>
                                    <div class="rf-rw">Auj</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Mobile</div>
                                    <div class="rf-rw">012343652</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Country</div>
                                    <div class="rf-rw">Botswana</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">E-mail</div>
                                    <div class="rf-rw">abx@gmail.com</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Sponsor Id</div>
                                    <div class="rf-rw">1233</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">D.O.J</div>
                                    <div class="rf-rw">10-12-12</div>
                                  </div>
                                  </span></a></div>
                              </div>
                              <div class="half-box">
                                <div class="img_box"> <a href="#" class="tip2"><img src="images/bb.png" > <span>
                                  <div class="rw">
                                    <div class="lf-rw">User Id</div>
                                    <div class="rf-rw">123456</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Full Name</div>
                                    <div class="rf-rw">Auj</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Mobile</div>
                                    <div class="rf-rw">012343652</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Country</div>
                                    <div class="rf-rw">Botswana</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">E-mail</div>
                                    <div class="rf-rw">abx@gmail.com</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Sponsor Id</div>
                                    <div class="rf-rw">1233</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">D.O.J</div>
                                    <div class="rf-rw">10-12-12</div>
                                  </div>
                                  </span></a></div>
                              </div>
                            </div>
                          </div>
                          <div class="sec-parent">
                            <div class="parent_1">
                              <div class="rule"></div>
                            </div>
                            <div class="parent_1">
                              <div class="left-rule"></div>
                            </div>
                            <div class="parent_1">
                              <div class="half-box">
                                <div class="img_box"> <a href="#" class="tip2"><img src="images/g.png" > <span>
                                  <div class="rw">
                                    <div class="lf-rw">User Id</div>
                                    <div class="rf-rw">123456</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Full Name</div>
                                    <div class="rf-rw">Auj</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Mobile</div>
                                    <div class="rf-rw">012343652</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Country</div>
                                    <div class="rf-rw">Botswana</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">E-mail</div>
                                    <div class="rf-rw">abx@gmail.com</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Sponsor Id</div>
                                    <div class="rf-rw">1233</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">D.O.J</div>
                                    <div class="rf-rw">10-12-12</div>
                                  </div>
                                  </span></a></div>
                              </div>
                              <div class="half-box">
                                <div class="img_box"> <a href="#" class="tip2"><img src="images/g.png" > <span>
                                  <div class="rw">
                                    <div class="lf-rw">User Id</div>
                                    <div class="rf-rw">123456</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Full Name</div>
                                    <div class="rf-rw">Auj</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Mobile</div>
                                    <div class="rf-rw">012343652</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Country</div>
                                    <div class="rf-rw">Botswana</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">E-mail</div>
                                    <div class="rf-rw">abx@gmail.com</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">Sponsor Id</div>
                                    <div class="rf-rw">1233</div>
                                  </div>
                                  <div class="rw">
                                    <div class="lf-rw">D.O.J</div>
                                    <div class="rf-rw">10-12-12</div>
                                  </div>
                                  </span></a></div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="parent_1">
                            <div class="third-parent">
                              <div class="parent_1">
                                <div class="rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="left-rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/bb.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/bb.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                              </div>
                            </div>
                            <div class="third-parent">
                              <div class="parent_1">
                                <div class="rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="left-rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/bb.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/bb.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                              </div>
                            </div>
                            <div class="third-parent">
                              <div class="parent_1">
                                <div class="rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="left-rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/g.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/g.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                              </div>
                            </div>
                            <div class="third-parent">
                              <div class="parent_1">
                                <div class="rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="left-rule"></div>
                              </div>
                              <div class="parent_1">
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/g.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                                <div class="half-box">
                                  <div class="img_box"> <a href="#" class="tip2"><img src="images/g.png" > <span>
                                    <div class="rw">
                                      <div class="lf-rw">User Id</div>
                                      <div class="rf-rw">123456</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Full Name</div>
                                      <div class="rf-rw">Auj</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Mobile</div>
                                      <div class="rf-rw">012343652</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Country</div>
                                      <div class="rf-rw">Botswana</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">E-mail</div>
                                      <div class="rf-rw">abx@gmail.com</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">Sponsor Id</div>
                                      <div class="rf-rw">1233</div>
                                    </div>
                                    <div class="rw">
                                      <div class="lf-rw">D.O.J</div>
                                      <div class="rf-rw">10-12-12</div>
                                    </div>
                                    </span></a></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Copyright info -->
        <p class="copy">Copyright &copy; 2013 | <a href="#">Your Site</a> </p>
      </div>
    </div>
  </div>
</footer>
<!-- Footer ends -->
<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span>
<script>
function myFunction()
{
alert("Hello\nHow are you?");
}
</script>
<!-- JS -->
<script src="js/jquery.js"></script>
<!-- jQuery -->
<script src="js/bootstrap.js"></script>
<!-- Bootstrap -->
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<!-- jQuery UI -->
<script src="js/fullcalendar.min.js"></script>
<!-- Full Google Calendar - Calendar -->
<script src="js/jquery.rateit.min.js"></script>
<!-- RateIt - Star rating -->
<script src="js/jquery.prettyPhoto.js"></script>
<!-- prettyPhoto -->
<!-- Morris JS -->
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>
<!-- jQuery Flot -->
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/toucheffects.js"></script>
<!-- jQuery Notification - Noty -->
<script src="js/jquery.noty.js"></script>
<!-- jQuery Notify -->
<script src="js/themes/default.js"></script>
<!-- jQuery Notify -->
<script src="js/layouts/bottom.js"></script>
<!-- jQuery Notify -->
<script src="js/layouts/topRight.js"></script>
<!-- jQuery Notify -->
<script src="js/layouts/top.js"></script>
<!-- jQuery Notify -->
<!-- jQuery Notification ends -->
<!-- Daterangepicker -->
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>
<script src="js/sparklines.js"></script>
<!-- Sparklines -->
<!--<script src="js/jquery.gritter.min.js"></script> <!-- jQuery Gritter -->
<script src="js/jquery.cleditor.min.js"></script>
<!-- CLEditor -->
<script src="js/bootstrap-datetimepicker.min.js"></script>
<!-- Date picker -->
<script src="js/jquery.uniform.min.js"></script>
<!-- jQuery Uniform -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- jQuery SlimScroll -->
<script src="js/bootstrap-switch.min.js"></script>
<!-- Bootstrap Toggle -->
<script src="js/jquery.maskedinput.min.js"></script>
<!-- jQuery Masked Input -->
<script src="js/dropzone.js"></script>
<!-- jQuery Dropzone -->
<script src="js/filter.js"></script>
<!-- Filter for support page -->
<script src="js/custom.js"></script>
<!-- Custom codes -->
<script src="js/charts.js"></script>
<!-- Charts & Graphs -->
<script src="js/index.js"></script>
<!-- Index Javascripts -->
</body>
</html>