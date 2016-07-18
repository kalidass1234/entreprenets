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
<script type="text/javascript" src="scripts/jquery.form.js"></script>
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
		var urldata="ss="+ss;
		$.ajax({
		type :'POST',
	   url: "ajax_files/ajax_message.php",
	   cache: false,
	   data: urldata,
	   success: function(data) {
	   //	alert(data);
		window.location.href='';
	   }
	   });
	}
	else
	{
		alert("Please Select Message Before Delete");
	}
}
function savemessage(str)
{
	// save the message into draft
	$u_name=$("#u_name").val();
	$filed01=$("#filed01").val();
	$filed06=$("#filed06").val();
	
	//alert (dataString);return false;
	  if(str=='sent')
	  {
	  	$("#compose_mail").attr('action','message1.php');
	  }
	  else if(str=='saved')
	  {
	  	$("#compose_mail").attr('action','message2.php');
	  }
	  $("#compose_mail").ajaxSubmit({
      target: '#draft_id',
      success:  function(data){
	  $('#draft_id').val(data);
	  alert('Message has been saved Successfully');
	  }
     });
	return false;  
}

function savemessage1(str)
{
	// save the message into draft
	$u_name=$("#u_name").val();
	$filed01=$("#filed01").val();
	$filed06=$("#filed06").val();
	if($u_name=='')
	{
		alert("Please Enter Valid Username.");
		$("#u_name").focus();
		return false;
	}
	//alert (dataString);return false;
	  if(str=='sent')
	  {
	  	$("#compose_mail").attr('action','message1.php');
	  }
	  else if(str=='saved')
	  {
	  	$("#compose_mail").attr('action','message2.php');
	  }
	  $("#compose_mail").ajaxSubmit({
      target: '#output',
      success:  function(data){
	  window.location.href='compose.php';
	  }
     });
	return false;  
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
								<li><a href="#tab1" class="active_tab">Compose Message</a></li>
								<li><a href="inbox.php">Inbox(<?php echo $count11;?>)</a></li>
								<li><a href="inbox_sent.php">Sent(<?php echo $count_sent;?>) </a></li>
								<li><a href="inbox_draft.php">Draft(<?php echo $count_draft;?>) </a></li>
								<li><a href="inbox_trash.php">Trash (<?php echo $count_trash;?>)</a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
					<h6 id="output"></h6>
					<div>
						
					</div>
                    <?php
					$user_id=showuserid($_SESSION['adid']);
					$sql_subs="select * from registration where user_id='$user_id' and mem_status=0";
					$res_subs=mysql_query($sql_subs) or die(mysql_error());
					$count_subs=mysql_num_rows($res_subs);
                    if($count_subs)
					{
					?> 
						<div id="tab1">
							<div class="oilhold">
   							<form action="message1.php" method="post" name="compose_mail" id="compose_mail" class="form_container left_label" enctype="multipart/form-data">
							<ul>
							<li>
								<div class="form_grid_12">
									<label class="field_title">&nbsp;</label>
									<div class="form_input">
										<label>&nbsp;</label>
										
									</div>
								</div>
								</li>
								<?php 
								if($_REQUEST['draft']=='draft')
								{
								$draft_id=$_REQUEST['id'];
								$sql_draft=mysql_query("select * from message_draft where id='$draft_id'");
								$row_draft=mysql_fetch_assoc($sql_draft);
								}
								if($_REQUEST['reply']=='reply' || $_REQUEST['forword']=='forword')
								{
								$draft_id=$_REQUEST['id'];
								$sql_draft=mysql_query("select * from message where id='$draft_id'");
								$row_draft=mysql_fetch_assoc($sql_draft);
								}
								?>
							
							
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<input name="u_name" id="u_name" type="text" value="<?php if($_REQUEST['draft']=='draft'){echo $row_draft['reciever_name'];}else if($_REQUEST['reply']=='reply'){echo $row_draft['sender_name'];}?>" tabindex="1"  class="" style="width:44%;" onChange="checkUser(this.value);" />
										<span id="user"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Email(If You Send This Message To Other Network)</label>
									<div class="form_input">
										<input name="email" id="email" type="text" value="" tabindex="1"  class="" style="width:44%;" />
										<span id="user"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">CC(If You Send This Message To Other Network)</label>
									<div class="form_input">
										<input name="cc" id="cc" type="text" value="" tabindex="1"  class="" style="width:44%;" />
										<span id="user"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">BCC(If You Send This Message To Other Network)</label>
									<div class="form_input">
										<input name="bcc" id="bcc" type="text" value="" tabindex="1"  class="" style="width:44%;" />
										<span id="user"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Subject</label>
									<div class="form_input">
										<input name="filed01" id="filed01" type="text" tabindex="2" value="<?php if($_REQUEST['forword']=='forword'){echo "Forword: ";}else if($_REQUEST['reply']=='reply'){echo "Reply: ";} echo $row_draft['subject'];?>" class="limiter" style="width:44%;" />
										
									</div>
								</div>
								</li>
							
								<li>
								<div class="form_grid_12">
									<label class="field_title">Message </label>
									<div class="form_input">
										<textarea name="filed06" id="filed06"  style="width:50%" cols="50" rows="5" tabindex="3" ><?php echo $row_draft['message'];?></textarea>
									</div>
								</div>
								</li>
								
								<?php
								if($row_draft['file_name'])
								{
								?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Attach File </label>
									<div class="form_input">
										<?php echo $row_draft['file_name'];?>
										<input name="attachfile_name" id="attachfile_name" type="hidden" value="<?php echo $row_draft['file_name'];?>" tabindex="4"  style="width:44%;" />
									</div>
								</div>
								</li>
								<?php
								}
								else
								{
								?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Attach File </label>
									<div class="form_input">
										<input name="attachfile" id="attachfile" type="file" tabindex="4"  style="width:44%;" />
									</div>
								</div>
								</li>
								<?php 
								}
								?>
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
									<input type="hidden" name="draft_id" id="draft_id" value="<?php echo $draft_id;?>">
										<button type="button" onClick="savemessage1('sent');" class="btn_small btn_gray"><span>Send To User</span></button>
										<button type="button" onClick="savemessage('saved');" class="btn_small btn_gray"><span>Save</span></button>
									</div>
								</div>
								</li>
								
							</ul>
						</form>
					  <!--<img src="images/support-ticket.jpg" border="0" />
					<br />
					 <div align="center" style="padding-top:20px;">
					  <input name="raise_ticket" class="btn" type="button"  value="Raise Ticket" onClick="window.location.href='raise-ticket.php'"/>
					  </div>-->
					</div>	
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