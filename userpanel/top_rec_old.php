<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_name='$idd'"));
$ref_id=$res_reg[ref_id];


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
		<h3>Top Recruiter</h3>
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
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Top Recruiter</h6>
					</div>
                    <?php
				  $user_id=showuserid($_SESSION['SD_User_Name']);
				  $sql_subs="select * from subscription where user_id='$user_id' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    
					?>
				<?php
                    if(($res_reg['category_two'] && $count_subs) || $res_reg['category_three'])
					{
					?>
						
					<table class="display data_tbl">
					
													
						<thead>
						<!--<tr>
						<td colspan="8">
						<form name="frm1" action=""  method="post">
					<div align="left" style="font-size:14px; padding-bottom:8px; border:1px solid;">
                                                        <div class='account-detail'>Search with <select name="search_type" onChange="search_node(this.value);"><option value="uid">User ID</option><option value="unm" <? if($_POST['search_type']=='unm') echo "selected='selected'";?>>User Name</option><option value="jdate" <? if($_POST['search_type']=='jdate') echo "selected='selected'";?>>Joining Date</option></select></th>
                                                    </div>
												
													<div  id="search-td1">
													Enter Affiliate User ID</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="uid" value="<? if($_POST['search_type']=='unm') echo $_POST['unm']; else echo $_POST['uid'];?>" id="uid" />&nbsp;&nbsp;<input type="submit" name="search_sub" value="Search" /></td>
                                                    </div>
													<div id="search-td2" style="display:none;">
													Date From :</span>
                   <input type="text" name="txtfrm" class="datepicker" id="txtfrm" readonly="true" size="15" style="margin-left:3em;" value="<?=$frm?>" required />
				   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="ptext">Date To :</span>
                    <input type="text" name="txttil" class="datepicker" id="txttil" readonly="true" placeholder="Till" size="15" value="<?=$til?>" required />&nbsp;&nbsp;<input type="submit" name="search_sub" value="Search" /> </div>
                 </div>
				</form>								
						</td></tr>-->
                                                        <tr>
                                                          <th>
								 User Id
							</th>
							<th>
								 User Name
							</th>
							<th>
								 Name
							</th>
							
							<th>Number Of Recruitment</th>
							<th>&nbsp;</th>
							<th>Date Of Joining</th>
                                                        </tr>
                           </thead>                             
                                                      
                                                        
                                             <tbody>           
                                                        <?php
						  $str11="select * from registration where ref_id='$ref_id'";
							$res11=mysql_query($str11);
							/*xnew($ref_id);
	  						function xnew($sql1){
								
								$sql_ref=mysql_fetch_array(mysql_query("select count(*) as c1, ref_id from registration where ref_id='$sql1'"));
								if($sql_ref[ref_id]=='');
								else
								xnew($sql_ref[ref_id]);
							
							}*/
							
						  while($x11=mysql_fetch_array($res11))
						  {
						  $sql=	mysql_query("SELECT count(*) as c FROM registration WHERE ref_id='{$x11['user_id']}'");
						  while($res=mysql_fetch_array($sql)){
						 if($res[c]==0);
						 else {
			 			 ?>
							<tr>
                                  
                                  <td align="center" class="ptext"><?=$x11['user_id']?></td>
                                  <td align="center" class="ptext"><?=$x11['user_name']?></td>
                                  <td align="center" class="ptext"><?=$x11['first_name'].' '.$x11['last_name']?></td>
                                  
                                 <td align="center" class="ptext"><?=$res[c];?></td>
								 <td>&nbsp;</td>
								 <td class="center">
								<span><?php echo date('m-d-Y',strtotime($x11[reg_date])); ?></span>
							</td>
                                </tr>
								
                                <?
								}
								}
						  }
								?>
						
</tbody>
						
					  </table>
					  <?php
                        }
						else
						{
						echo "<p>You are not Authorize to access this section.</p>";
						}
						?>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>