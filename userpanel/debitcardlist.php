<?php
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
if(isset($_GET['msg']))
$msg=$_REQUEST['msg'];
else
$msg='';
$regdate_ip = getenv('REMOTE_ADDR');
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$str="select * from registration where user_id='$id'";
$res=mysql_query($str);
$x=mysql_fetch_array($res);
$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];

$sltsub=mysql_query("select max(subs_date) from subscription5 where user_id='$id'");
$sub_date=date("m t Y",strtotime(@mysql_result($sltsub,0,0)));

$page_name="purchase_order.php"; 
			 
$start=$_GET['start'];
if(strlen($start) > 0 && !is_numeric($start)){
echo "Data Error";
exit;
}
			 
$eu = ($start - 0); 
$limit = 10;                                 // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 

if($_POST['Show']=='Search')
{
$frm=$_REQUEST['txtfrm'];
$til=$_REQUEST['txttil'];
$d1=explode("/", $frm);
$dd1=$d1[1];
$mm1=$d1[0];
$yy1=$d1[2];
$d2=explode("/", $til);
$dd2=$d2[1];
$mm2=$d2[0];
$yy2=$d2[2];
$dt1="$yy1-$mm1-$dd1";
$dt2="$yy2-$mm2-$dd2";
$query2="SELECT * FROM purchase_detail PUR inner join product_category PRO on PRO.p_cat_id=PUR.p_id where user_id='$id'  and (PUR.date BETWEEN '$dt1' and '$dt2' ) group by invoice_no order by PUR.date desc";
}
else
$query2="SELECT * FROM purchase_detail PUR inner join product_category PRO where PRO.p_cat_id=PUR.p_id  and user_id='$id' group by invoice_no order by PUR.date desc";
//echo $query2;
$result2=mysql_query($query2);
echo mysql_error();
$nume=mysql_num_rows($result2);
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
<title><?php echo $TITLE_USER;?></title>
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
		<h3>Credit/Debit Card</h3>
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
	<div id="content">
		<div class="grid_container">
			
			
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Credit/Debit Card</h6>
                        <h6><a href="debitcard_new.php">Add New Debit/Credit Card Info</a></h6>
				  </div>
				  <div class="widget_content">
                    <?php 
					$user_id=showuserid($_SESSION['SD_User_Name']);
					$sql_user2=mysql_query("select * from registration where user_id='$user_id'");
					$res_user2=mysql_fetch_assoc($sql_user2);
					if($res_user2['category_two'] || $res_user2['category_one'] || $res_user2['category_three'])
					{
					?>
						
					<table class="display" >
					
					  <?php 
							 $sqluser="select * from billing_address where user_id='$user_id' and status=0";
							 $resuser=mysql_query($sqluser);
							 $countuser=mysql_num_rows($resuser);
							 
							 if($countuser)
							 {
							 	$action="update";
							 }
							 else
							 {
							 	$action="insert";
							 }
							 $sql_user="select * from registration where user_id='$id'";
							 $res_user=mysql_query($sql_user);
							 $row_user=mysql_fetch_assoc($res_user);
							
						?>
						<thead>
                        <tr>
                           
                            <th>
                            	Name On Card
                            </th>
                            <th>
                            	Card Type
                            </th>
                            <th>
                            	Card NO
                            </th>
                            <th>
                            	Expiration Date
                            </th>
                            <th>
                            	Card Security Code   
                            </th>
                            <th>
                            	View Detail
                            </th>
                        </tr>
						</thead>
						<tbody>
						<?php
						$x=1;while($rowuser=mysql_fetch_assoc($resuser)){
					    ?>
						<tr>
							
							<td class="sdate center">
								<a href="#" ><?=$rowuser[card_name];?></a>
							</td>
							<td class="sdate center">
								 <?php echo $rowuser['card_type'];?>
							</td>
							<td class="center">
								<?php echo substr($rowuser['card_no'], -4);?>
							</td>
							<td class="sdate center">
								<?php echo $rowuser['exp_date'];?>
							</td>
							<td class="sdate center">
								<?php echo $rowuser['cvv'];?>
							</td>
							<td class="center">
								<!--<span class="badge_style b_done">--><a href="debitcard_new.php?id=<?=$rowuser[id]; ?>">View Detail</a><!--</span>-->
							</td>
						</tr>
						<?php $x++;
						}
						?>
						</tbody>
						<!--<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox" type="checkbox" value="" class="checkall">
							</th>
							<th>
								 Id
							</th>
							<th>
								 Task
							</th>
							<th>
								 Dead Line
							</th>
							<th>
								 Priority
							</th>
							<th>
								 Status
							</th>
							<th>
								 Complete Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>-->
						</table>
                    <?php
                    }
					else
					{
					echo "<p>You Have Not Access This Part.</p>";
					}
					?>    
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>