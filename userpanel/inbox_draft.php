<?php
include('../includes/all_func.php');
error_reporting(0);
//session_start();
if(isset($_SESSION) && $_SESSION['adid'])
{
$idd=$_SESSION['adid'];
$id=showuserid($_SESSION['adid']);

}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
//include('includes/notificationcount.php');

	$str_sent="select * from message_sender where sender_id='$id' and status=0 order by id desc";
	$res_sent=mysql_query($str_sent);
	$count_sent=mysql_num_rows($res_sent);
	
	$str11="select * from message where reciever_id='$id' and status=0 order by id desc";
	$res11=mysql_query($str11);
	$count11=mysql_num_rows($res11);

	$str_draft="select * from message_draft where sender_id='$id' and status=0 order by id desc";
	$res_draft=mysql_query($str_draft);
	$count_draft=mysql_num_rows($res_draft);
	
	$str_trash="select *,'sender' as type from message_sender where sender_id='$id' and status=1 
union all 
select *,'receiver' as type from message where reciever_id='$id' and status=1
union all 
select *,'draft' as type from message_draft where reciever_id='$id' and status=1
 order by ts desc
";
	$res_trash=mysql_query($str_trash);
	$count_trash=mysql_num_rows($res_trash);
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
<script language="javascript">
$(document).ready(function(){
$('#attachfile1').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'PDF':
		case 'JPG':
        case 'JPEG':
        case 'PNG':
        case 'GIF':
		case 'pdf':
		case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
		case 'DOC':
		case 'DOCX':
        case 'XLS':
        case 'XLSX':
        case 'doc':
		case 'docs':
		case 'xls':
        case 'xlsx':
        case 'png':
        case 'gif':
               break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
		});
});

function deletemessage()
{
/*	 var val = [];
	 var allval='';
        $('input[name=checkbox]:checked').each(function(i){
          val[i] = $(this).val();
		  allval=allval+','+$(this).val();
        });*/
	var ss=$('input[name="checkbox[]"]:checked').map(function() {return this.value;}).get().join(',');
    if(ss!='')
	{
		var urldata="ss="+ss+"&target=draft";
		$.ajax({
		type :'POST',
	   url: "ajax_files/ajax_message.php",
	   cache: false,
	   data: urldata,
	   success: function(data) {
	   alert(data+' message moves to trash');
		window.location.href='';
	   }
	   });
	}
	else
	{
		alert("Please Select Message Before Delete");
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
		<span class="title_icon"><span style="float:left;"><img src="backend-images/messaging.png" height="20" width="20" alt="" border="0" /></span></span>
		<h3>Message</h3>
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
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Message</h6>
						<div id="widget_tab">
							<ul>
								<li><a href="compose.php">Compose Message</a></li>
								<li><a href="inbox.php">Inbox(<?php echo $count11;?>)</a></li>
								<li><a href="inbox_sent.php"  >Sent(<?php echo $count_sent;?>)</a></li>
								<li><a href="#tab3" class="active_tab">Draft(<?php echo $count_draft;?>)</a></li>
								<li><a href="inbox_trash.php">Trash(<?php echo $count_trash;?>)</a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
					<div>
						
					</div>
						<?php
					$user_id=showuserid($_SESSION['adid']);
					$sql_subs="select * from registration where user_id='$user_id' and mem_status=0";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?>
					
						
						<div id="tab3">
							 <form id="form_send_box1" name="form_send_box" action="delete_message_func1.php" method="post">
							
					<div class="widget_content">
						
						<h6 style="margin-top:0px; margin-left:-22px;"><!--<span><a class="action-icons c-delete" href="javascript:deletemessage();" title="Delete"></a></span><span onClick="javascript:deletemessage();" style="color:#0099CC; font-size:14px; cursor:pointer; margin-left:10px;">Delete Message</span>-->
						<div class="btn_30_blue" style="height:20px;">
									<a href="javascript:deletemessage();" style="height:25px;"><span class="icon cross_octagon_fram_co"></span><span class="btn_link" style="border-left:0px;">Delete</span></a>
								</div>
						</h6>
						<table class="display" id="action_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox1" type="checkbox" value="" class="checkall">
							</th>
							<!--<th>
								 Id
							</th>-->
							<th>
								 To
							</th>
							<th >
								 Subject
							</th>
							<th style="border-right:none;">Message</th>
							<th>&nbsp;</th>
							<th>
								 Saved Date
							</th>
							<th>
								  Attachment
							</th>
							<th>
								 Compose
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
				
						  $i=1;
						  while($x1=mysql_fetch_array($res_draft))
						  {
						  
			 			 ?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox[]" type="checkbox" value="<?=$x1[id];?> ">
							</td>
							
							<!--<td>
								<a href="#"><?= $i; ?></a>
							</td>-->
							<td class="center tr_select ">
								<a  href="view-message.php?type=draft&id=<?=$x1['id']?>" title="View"><?=$x1['reciever_name']?> </a>
							</td>
							<td class=" center" >
								<a  href="view-message.php?type=draft&id=<?=$x1['id']?>" title="View"> <?=$x1['subject']?></a>
							</td>
							<td class="center" style="border-right:none;"><a  href="view-message.php?type=draft&id=<?=$x1['id']?>" title="View"><?php echo substr($x1['message'],0,20);?></a></td>
							<td class="center">&nbsp;</td>
							<td class="center sdate">
								 <span class=" "><a  href="view-message.php?type=draft&id=<?=$x1['id']?>" title="View"><?php
								 $curdate=date('Y-m-d');
								 $sentdate=date('Y-m-d', strtotime($x1['ts']));
								 $curtime=strtotime($curdate);
								 $senttime=strtotime($sentdate);
								 if($senttime==$curtime){ echo date('H:i:s', strtotime($x1['ts']));}
								 else {  echo date('d M, Y',strtotime($x1['ts']));}
								//echo date('d M, Y',strtotime($x1['ts']));?></a></span>
							</td>
							<td class="center sdate">
								 <span class=" "><?php if($x1['file_name']){?><a href="attachfile/<?=$x1['file_name']?>" target="_blank">Attach File</a><?php } else{ echo "No Attachment.";}?></span>
							</td>
							<td class="center">
								<span><a class="action-icons c-approve" href="compose.php?draft=draft&id=<?=$x1['id']?>" title="View">Compose</a></span>
							</td>
						</tr>
						<?php $i++; } ?>
						
						
						
						</tbody>
						<tfoot>
						<!--<tr>
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
						</tr>-->
						</tfoot>
						</table>
					</div>
					<input type="submit" style="display:none;" name="Submit">
					
					</form>
						</div>
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
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>