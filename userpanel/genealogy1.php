<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$regdate_ip = getenv(REMOTE_ADDR);
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$str="select * from registration where user_id='$id'";
$res=mysql_query($str);
$x=mysql_fetch_array($res);
$name=$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
$shdwn = new showDwonMem();
$shdwn->shoDwnMem($id,$id);
 $r=count($data_dwn);


$dir=mysql_query("select * from registration where nom_id='$id' order by id");
							$dir_count=mysql_num_rows($dir);
							
			$tot_mem=$r+$dir_count;				
		
		$level2=0;
		$level3=0;
		$level4=0;
		$level5=0;
		$level6=0;
		
							
	
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
		}						
		
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
$to=$x['total_count'];	
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
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
</head>
<style>
.binary_line1{background: url(images/topline.gif) no-repeat center top;border-top: solid #000 2px;}
</style>
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
		<div class="top_search">
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
		</div>
	</div>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>GENEOLOGY</h6>
					</div>
					<table width="100%" align="left" cellpadding="0" cellspacing="0"   id="table1" class="display" >
      <tr >
    <th width="39%" style="padding-left:30px; text-align:left; background: #23488f;" >Summary </th>
    <th width="61%" style="text-align:left; background: #23488f;">&nbsp;</th>  
  </tr>
	<tr >
		<td style="padding-left:30px;" class="light-blue">&nbsp;</td>
		<td style="padding-left:30px;" class="light-blue">&nbsp;</td>
    </tr>
   
	<tr >
    <td colspan="2" style="padding-left:30px;"></td>
    </tr>
	
  <tr>
    <td colspan="2" align="center" class="light-blue" style="padding-left:30px;"><table cellspacing="0" cellpadding="0" width="100%" class="display">
        <col width="64" span="2" />
        <col width="56" />
        <col width="48" />
        <tr height="40">
          <td align="center">Levels</td>
          <td  align="center">Total</td>
          <td  align="center">Closed spots</td>
          <td  align="center">Open spots</td>
        </tr>
        <tr height="20">
          <td height="20" align="center">1</td>
          <td align="center"><?=$t1=4;?></td>
          <td align="center"><?=$dir_count;?></td>
          <td align="center"><?=$t1-$dir_count;?></td>
        </tr>
        <tr height="20">
          <td height="20" align="center">2</td>
          <td align="center"><?=$t2=16;?></td>
          <td align="center"><?=$level2;?></td>
          <td align="center"><?=$t2-$level2;?></td>
        </tr>
        <tr height="20">
          <td height="20" align="center">3</td>
          <td align="center"><?=$t3=64;?></td>
          <td align="center"><?=$level3;?></td>
          <td align="center"><?=$t3-$level3;?></td>
        </tr>
        <tr height="20">
          <td height="20" align="center">4</td>
          <td align="center"><?=$t4=256;?></td>
          <td align="center"><?=$level4;?></td>
          <td align="center"><?=$t4-$level4;?></td>
        </tr>
        <tr height="20">
          <td height="20" align="center">5</td>
          <td align="center"><?=$t5=1024;?> </td>
          <td align="center"><?=$level5;?></td>
          <td align="center"><?=$t5-$level5;?></td>
        </tr>
        <tr height="20">
          <td height="20" align="center">6</td>
          <td align="center"> <?=$t6=4096;?> </td>
          <td align="center"><?=$level6;?></td>
          <td align="center"><?=$t6-$level6;?></td>
        </tr><tr >
    <td style="padding-left:30px;"  >&nbsp;</td>
    <td style="padding-left:30px;" colspan="4">&nbsp;</td>
    </tr>
        <tr >
          <td style="padding-left:30px;"  ><span class="light-blue" style="padding-left:30px;">Total  Downline</span></td>
          <td style="padding-left:30px;" colspan="4"><span class="light-blue" style="padding-left:30px;">
            <?=$dir_count+$level2+$level3+$level4+$level5+$level6;?>
          </span></td>
        </tr>
        </table></td>
    </tr>
	</table>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>