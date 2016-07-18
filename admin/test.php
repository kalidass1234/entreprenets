<?php 
// define site url for include style and js etc.
//define('SITE_URL','http://localhost/creative/creative/');

// include method file. 
//include(ABSPATH.'functions.php');  
include('config/directory.php');
include("config/config.php");
$host_name=$obj_function->host_name();
$host_name=str_replace('admin','',$host_name);
//echo $host_name;

define('SITE_URL',$host_name);
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 
// store current url
$_SESSION['page_url'] = str_ireplace("/creative/","",SITE_URL).$_SERVER['REQUEST_URI'];
//echo $_SESSION['TRINITY_User_Name'];exit;
if(!isset($_SESSION['TRINITY_User_Name']))
{
	header("Location:login.php"); exit;
}
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
function showlegid($id,$leg,$plan,$board)
{
//echo "select * from registration where nom_id='$id' and binary_pos='$leg'";
$sql_nom1l=mysql_query("select * from registration where nom_id='$id' and binary_pos='$leg' and plan_type='$plan' and board_type='$board'");
$ff_nom1l=mysql_fetch_array($sql_nom1l);
return $ff_nom1l;
}
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
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>jQuery Horizontal Tree</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin:400,700,600"/>
<link href="tree.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.8.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.tree.js"></script>
<script>
$(document).ready(function() {
	$('.tree').tree_structure({
		'add_option': false,
		'edit_option': false,
		'delete_option': false,
		'confirm_before_delete' : false,
		'animate_option': [false, 5],
		'fullwidth_option': false,
		'align_option': 'center',
		'draggable_option': false
	});
});
</script>
<style>
						
a.tip2 {
  position: relative;
  text-decoration: none;
  z-index:9999;
}
a.tip2 span {display: none;}
a.tip2:hover span {
  display: block;
  position: absolute; 
  padding: .5em;
  content: attr(title);
  text-align: center;
  width: 350px;
  height: auto;
  border:5px solid #999;

  top: -100px;
  background: rgba(0,0,0,.8);
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  border-radius:10px;    
  color: #fff;
  font-size: .86em;
  z-index:9999;
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
  z-index:9999;
}
.rw{width:330px; height:22px; margin:0 auto;}
.lf-rw{width:40%; height:22px; float:left;padding:3px; text-align:left;}
.rf-rw{width:40%; height:22px; float:left;padding:3px; text-align:left;}
</style>
<script>
	function preLoad()
	{
		document.getElementById('loading').style.display = 'none';
	}
</script>
</head>
<body onLoad="preLoad()">
<div id="loading" style="display:block"><img id="loader-img" src="images/loading.gif"></div>
<!--<div><img src="images/loading.gif"></div>-->
<div class="overflow">
	<div><a href="test.php?first_id=<?php echo $_REQUEST['first_id'];?>&user_id=<?php echo $_REQUEST['first_id'];?>">Go Back</a></div>
    <?php
    	// get level 
		$first_id=$_REQUEST['first_id'];
		$user_id=$_REQUEST['user_id'];
		$board_type=$row_user['board_type'];
		$plan_type=$row_user['plan_type'];
		$res_level=$obj_query->query("level","level_income","purcheser_id='$user_id' and income_id='$first_id'");
		$row_level=$obj_query->get_all_row($res_level);
	?>
    <div>Level <?php echo $row_level['level'];?></div>
    <div>
		<ul class="tree">
			<li>
				<div class="parent"><?php if($row_user['user_id']){echo $row_user['user_id']."<br>".$row_user['user_name'];} else{ echo "Empty";}?></div>
				<ul >
					<li>
                    	<?php 
						$row_left1=showlegid($user_id,'left',$plan_type,$board_type); 
						//echo "<pre>"; print_r($row_left1);
						?>
						<div class="current">
                        <?php if($row_left1['user_id']){?>
                        <a href="test.php?first_id=<?php echo $_REQUEST['first_id'];?>&user_id=<?php echo $row_left1['user_id'];?>" class="tip2">
                        <?php echo $row_left1['user_id'];?><br /><?php echo $row_left1['user_name'];?>
                         <!--<span>
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
                        </span>--></a>
                        <?php }
						else{ echo "Empty";}
						?>
                        </div>
						<ul>
							<li>
                            <?php 
							$row_left11=showlegid($row_left1['user_id'],'left',$plan_type,$board_type); 
							//echo "<pre>"; print_r($row_left1);
							?>
								<div class="current"> 
                                <?php if($row_left11['user_id']){?>
                                <a href="test.php?first_id=<?php echo $_REQUEST['first_id'];?>&user_id=<?php echo $row_left11['user_id'];?>" class="tip2"><?php echo $row_left11['user_id'];?><br /><?php echo $row_left11['user_name'];?></a>
                                <?php } else{ echo "Empty";}?>
                                </div>
                                <!--<ul>
                                	<li>
                                    <?php 
									$row_left12=showlegid($row_left11['user_id'],'left'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_left12['user_id'];?><br /><?php echo $row_left12['user_name'];?>C</div>
                                    </li>
                                    <li>
                                    <?php 
									$row_right12=showlegid($row_left11['user_id'],'right'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_right12['user_id'];?><br /><?php echo $row_right12['user_name'];?>D</div>
                                    </li>
                                </ul>-->
							</li>
							<li>
                            <?php 
							$row_right11=showlegid($row_left1['user_id'],'right',$plan_type,$board_type);
							//echo "<pre>"; print_r($row_right1); 
							?>
								<div class="current">
                                <?php if($row_right11['user_id']){?>
                                <a href="test.php?first_id=<?php echo $_REQUEST['first_id'];?>&user_id=<?php echo $row_right11['user_id'];?>" class="tip2"><?php echo $row_right11['user_id'];?><br /><?php echo $row_right11['user_name'];?></a>
                                <?php } else{ echo "Empty";}?>
                                </div>
                                 <!--<ul>
                                	<li>
                                    <?php 
									$row_left12=showlegid($row_right11['user_id'],'left'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_left12['user_id'];?><br /><?php echo $row_left12['user_name'];?>F</div>
                                    </li>
                                    <li>
                                    <?php 
									$row_right12=showlegid($row_right11['user_id'],'right'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_right12['user_id'];?><br /><?php echo $row_right12['user_name'];?>G</div>
                                    </li>
                                </ul>-->
							</li>
						</ul>
					</li>
					<li>
                    	<?php 
						$row_right1=showlegid($user_id,'right',$plan_type,$board_type);
						//echo "<pre>"; print_r($row_right1); 
						?>
						<div class="current">
                        <?php if($row_right1['user_id']){?>
                        <a href="test.php?first_id=<?php echo $_REQUEST['first_id'];?>&user_id=<?php echo $row_right1['user_id'];?>" class="tip2"><?php echo $row_right1['user_id'];?><br /><?php echo $row_right1['user_name'];?></a>
                        <?php }else{ echo "Empty";}?>
                        </div>
						<ul>
							<li>
                            <?php 
							$row_left11=showlegid($row_right1['user_id'],'left',$plan_type,$board_type); 
							//echo "<pre>"; print_r($row_left1);
							?>
								<div class="current">
                                <?php if($row_left11['user_id']){?>
                                <a href="test.php?user_id=<?php echo $row_left11['user_id'];?>" class="tip2"><?php echo $row_left11['user_id'];?><br /><?php echo $row_left11['user_name'];?></a>
                                <?php }else{ echo "Empty";}?>
                                </div>
                                <!--<ul>
                                	<li>
                                    <?php 
									$row_left12=showlegid($row_left11['user_id'],'left'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_left12['user_id'];?><br /><?php echo $row_left12['user_name'];?></div>
                                    </li>
                                    <li>
                                    <?php 
									$row_right12=showlegid($row_left11['user_id'],'right'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_right12['user_id'];?><br /><?php echo $row_right12['user_name'];?></div>
                                    </li>
                                </ul>-->
							</li>
							<li>
                            <?php 
							$row_right11=showlegid($row_right1['user_id'],'right',$plan_type,$board_type);
							//echo "<pre>"; print_r($row_right1); 
							?>
								<div class="current">
                                <?php if($row_right11['user_id']){?>
                                <a href="test.php?first_id=<?php echo $_REQUEST['first_id'];?>&user_id=<?php echo $row_right11['user_id'];?>" class="tip2"><?php echo $row_right11['user_id'];?><br /><?php echo $row_right11['user_name'];?></a>
                                <?php }else{ echo "Empty";}?>
                                </div>
                                <!--<ul>
                                	<li>
                                    <?php 
									$row_left13=showlegid($row_right11['user_id'],'left'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_left13['user_id'];?><br /><?php echo $row_left13['user_name'];?></div>
                                    </li>
                                    <li>
                                    <?php 
									$row_right13=showlegid($row_right11['user_id'],'right'); 
									//echo "<pre>"; print_r($row_left1);
									?>
                                    <div><?php echo $row_right13['user_id'];?><br /><?php echo $row_right13['user_name'];?></div>
                                    </li>
                                </ul>-->
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>

</body>
</html>