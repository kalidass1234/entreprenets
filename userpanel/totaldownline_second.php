<?php
include('../includes/all_func.php');
class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select id,user_id from registration where nom_id='$dwnid' ";
			//echo $quer3;echo "<br>"; 
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					//echo $idx;echo "<br>";
					$data_dwn[]=$idx;
					//$levv=level_count($idx,$tid);
					$lel[]=$levv;
					
					//print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select id,user_id from registration where nom_id='$dwnid'";
		//echo $quer;echo "<br>";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			//echo $user2;echo "<br>";
			showMemX($user2,$tid);
		}
	}
}
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION) && $_SESSION['adid'])
{
$idd=$_SESSION['adid'];
if(isset($_GET['msg']))
$msg=$_REQUEST['msg'];
else
$msg='';
$regdate_ip = getenv('REMOTE_ADDR');
$s="select * from registration where user_name='$idd'";
$ffr=mysql_query($s);
$f=mysql_fetch_array($ffr);
 $id=$f['user_id'];
$package_amount=$f['package_amount'];

$str="select * from registration where user_id='$id' AND package_amount='$package_amount'";
$res=mysql_query($str);
$x=mysql_fetch_array($res);
$ref_id=$x['ref_id'];
 $name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
  $category_one=$x['category_one'];
$category_two=$x['category_two'];
$category_three=$x['category_three'];
//echo $id;
$shdwn = new showDwonMem();
$shdwn->shoDwnMem($id,$id);

$r=count($data_dwn);
//print_r($data_dwn);

$dir=mysql_query("select * from registration where nom_id='$id' AND package_amount = '70.00' order by id");
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
//end summary
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Welcome To BMC</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>

<script src="js/custom-scripts.js"></script>
</head>
<style>
.binary_line1{background: url(images/topline.gif) no-repeat center top;border-top: solid #000 2px;}
</style>
<script language="javascript">
function search_node(val)
{
	if(val=='jdate')
	{
		document.getElementById('search-td2').style.display='table-row';
		document.getElementById('search-td1').style.display='none';
	}
	else if(val=='unm')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate Login Name';
		document.getElementById('uid').name='unm';
	}
	else if(val=='uid')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate User ID';
		document.getElementById('uid').name='uid';
	}
}
</script>
<body id="theme-default" class="full_block">
<?php
include('left-bar.php');
?>
<div id="container">
	<div id="header" class="blue_lin">
		<div class="header_left">
			<?php
			include('header-left.php');
			?>
			<?php
			include('menu-mobile.php');
			?>
		</div>
		<?php
		include('header-right.php');
		?>
	</div>
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>My Team</h3>
		<!--<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>-->
	</div>
    <?php
		//include('switch-bar.php');
		$sql_ref="select * from registration where user_id='$ref_id' AND package_amount = '70.00' ";
		$res_ref=mysql_query($sql_ref);
		$row_ref=mysql_fetch_assoc($res_ref);
  	?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
          
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>My Team( Total Matrix Downline)</h6>
						
					</div>
					<div class="widget_content">
						
						<div id="tab2" >
							<table class="display data_tbl">
					
													
						<thead>
					
                                                        <tr>
                                                         <th >S.No.</th>
                              <th >User ID</th>
							   <th >Username</th>
                              <th >Member Name</th>
                              <th >Status</th>
							  
							<th >Sponsor ID</th>				  
							  
                              <th>Sponsor Name</th>
                              
                               <th >Upline ID</th>				  
							  
                              <th>Upline Name</th>

                              <th>Join Date</th>
							  
                             
                                                        </tr>
                           </thead>                             
                                                      
                                                        
                                             <tbody>           
                          <?php 
							$j=1;
							while($direct=mysql_fetch_array($dir)){
							if($direct[mem_status]=='0'){$status='Active';} else{$status='De-active';}
							$name_direct=ucfirst($direct['first_name'])." ".ucfirst($direct['mid_name'])." ".ucfirst($direct['last_name']);
							if($direct[user_type]=='personal') 
							{
							 if($direct[plan_name]){ $user_type=ucfirst($direct[user_type])." VIP Memeber";} else { $user_type=ucfirst($direct[user_type])." Free Memeber";} 
							}
							else
							{
								$user_type=ucfirst($direct[user_type])." Member";
							}
							?>
							 <tr>
                              <td class="center"><?php echo $j;?></td>
                              <td class="center"><?php echo $direct['user_id'];?></td>
							  <td class="center"><?php echo $direct['user_name'];?></td>
                              <td class="center"><?php echo $name_direct;?></td>
							<td class="center"><?php echo $status;?></td>  
                  			<td class="center"><?php echo $direct['ref_id'];?></td>
                              <td class="center"><?php echo showusername($direct['ref_id']);?></td>
                              <td class="center"><?php echo $direct['nom_id'];?></td>
                              <td class="center"><?php echo showusername($direct['nom_id']);?></td>

                              <td class="center"><?php echo date('d-m-Y',strtotime($direct['reg_date']));?></td>
                            </tr>
                            <?php
							$j++;
							}
							?>
							<?php
									$srl1=1;	
									for($i=0;$i<$r;$i++)
									{
					$dn=$data_dwn[$i];
		$ss_dn=mysql_query("select * from registration where user_id='$dn' AND package_amount = '70.00'   ");
	
		$ff_dn=mysql_fetch_array($ss_dn);
if($ff_dn['user_id']!='')
{
		$memlevel=$lel[$i];
		
						
	
							if($ff_dn[mem_status]=='0'){
$status_d='Active';}

else{$status_d='Inactive';}
if($ff_dn[user_type]=='personal') 
							{
							 if($ff_dn[plan_name]){ $user_type=ucfirst($ff_dn[user_type])." VIP Memeber";} else { $user_type=ucfirst($ff_dn[user_type])." Free Memeber";} 
							}
							else
							{
								$user_type=ucfirst($direct[user_type])." Member";
							}

  ?>                      
                            <tr>
                              <td class="center"><?php echo $dir_count+$i+1;?></td>
                              <td class="center"><?php echo $ff_dn['user_id'];?></td>
							  <td class="center"><?php echo $ff_dn['user_name'];?></td>
                              <td class="center"><?php echo ucfirst($ff_dn[first_name])." ".ucfirst($ff_dn[last_name]);?></td>
							  <td class="center"><?php echo $status_d;?></td>
                              <td class="center"><?php echo $ff_dn['ref_id'];?></td>
                              <td class="center"><?php echo showusername($ff_dn['ref_id']);?></td>
                              <td class="center"><?php echo $ff_dn['nom_id'];?></td>
                              <td class="center"><?php echo showusername($ff_dn['nom_id']);?></td>

                              <?php /*?><td bgcolor="#F4F7FC" style="border-right-color:#FFFFFF; border-right-style:solid; border-right-width:1px"><div align="center"><?php echo $dn['level'];?></div></td><?php */?>
                              <td class="center"><?php echo date('d-m-Y',strtotime($ff_dn['reg_date']));?></td>
                            </tr>
                            <?php
							$srl1++;
							} }
							?>
						</tbody>
					  </table>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>