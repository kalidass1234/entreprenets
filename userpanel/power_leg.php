<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	$user_id=showuserid($_SESSION['SD_User_Name']);
	//echo "<pre>"; print_r($_POST);
	/*if(isset($_POST['show']) && isset($_POST['power_leg']))
	{
		mysql_query("update registration set power_leg='$_POST[power_leg]' where user_id='$user_id'");
	}
	if(isset($_POST['show']) && isset($_POST['power_status']))
	{
		mysql_query("update registration set power_status='$_POST[power_status]' where user_id='$user_id'");
	}*/
	if(isset($_POST['show']) && $_POST['show']=='Search')
	{
		if($_POST[placement_id_status]==1 && $_POST[placement_id]!='')
		{
			// check the placement is valid or nor 
			$sql_check="select * from registration where user_id='$_POST[placement_id]' or user_name='$_POST[placement_id]'";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check)
			{
				$row_check=mysql_fetch_assoc($res_check);
				$placement_id=$row_check['user_id'];
			mysql_query("update registration set power_leg='$_POST[power_leg]',power_status='$_POST[power_status]',placement_id='$placement_id',placement_id_status='$_POST[placement_id_status]' where user_id='$user_id'");
			}
			else
			{
				mysql_query("update registration set power_leg='$_POST[power_leg]',power_status='$_POST[power_status]' where user_id='$user_id'");
			}
			//echo "update registration set power_leg='$_POST[power_leg]',power_status='$_POST[power_status]',power_automatic='$_POST[power_automatic]',placement_id='$_POST[placement_id]',placement_id_status='$_POST[placement_id_status]' where user_id='$user_id'";
		}
		else
		{
			mysql_query("update registration set power_leg='$_POST[power_leg]',power_status='$_POST[power_status]',power_automatic='$_POST[power_automatic]',placement_id_status='$_POST[placement_id_status]' where user_id='$user_id'");
		}
	}
	$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_name='$idd'"));
	$ref_id=$res_reg[ref_id];
	$useridd=$res_reg['user_id'];
	$power_leg=$res_reg['power_leg'];
	$power_status=$res_reg['power_status'];
	$power_automatic=$res_reg['power_automatic'];
	$placement_id=$res_reg['placement_id'];
	$placement_id_status=$res_reg['placement_id_status'];
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
		<h3>Power Leg</h3>
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
						<h6>Power Leg</h6>
					</div>
                     <form name="userpass" id="userpass" method="post" action="" enctype="multipart/form-data">
<div class="span3" style="float:left; margin:5px 5px 5px 0px; background-color:#FFFFFF">
   
    <div class="block-fluid without-head">
    <div class="toolbar clear clearfix"></div>   
    <div class="toolbar nopadding-toolbar clearfix"><h4>Power Leg Position: <?php echo ucfirst($power_leg);?></h4></div>
    <div class="clearfix"><br></div>                                                 
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <div class="span8">
        <select name="power_leg" id="power_leg" required>
            <option value="" >Set Power Leg</option>
            <option value="left" <?php if($power_leg=='left'){ echo "selected";}?>>Left</option>
            <option value="right" <?php if($power_leg=='right'){ echo "selected";}?>>Right</option>
            <option value="automatic" <?php if($power_leg=='automatic'){ echo "selected";}?>>Automatic</option>
        </select>
    </div>
    </div>
    <div class="clearfix"><br></div>   
	<!--<div class="row-form clearfix" style="border-top-width: 0px;">
     <div class="left" style="margin:10px 10px 0px 0px;">                                
      <button name="show" type="submit" class="btn_small btn_gray" value="Search" onClick="shoLst(txtfrm.value, txttil.value);" onMouseOver="formCheck();">Set Power Leg</button>    </div>
    </div>--> 
		<div class="clearfix"><br></div>                        
     </div>                     
	 <!--</form>-->
     </div>
     <div class="span3" style="float:left; margin:5px 5px 5px 50px; background-color:#FFFFFF;">
    <!--<form name="userpass" id="userpass" method="post" action="" enctype="multipart/form-data">-->
    <div class="block-fluid without-head">
    <div class="toolbar clear clearfix"></div>   
    <div class="toolbar nopadding-toolbar clearfix">
    	<h4>Self Product Volume: <?php if($power_status==1){ echo "Left";} elseif($power_status==2){ echo "Right";} elseif($power_status==3){ echo "Automatic";}?></h4>
    </div>
    <div class="clearfix"><br></div>                                                 
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <div class="span8">
        <select name="power_status" id="power_status" required>
            <option value="" >Set Power Leg</option>
            <option value="1" <?php if($power_status==1){ echo "selected";}?>>Left</option>
            <option value="2" <?php if($power_status==2){ echo "selected";}?>>Right</option>
            <option value="3" <?php if($power_status==3){ echo "selected";}?>>Automatic</option>
        </select>
    </div>
    </div>
    <div class="clearfix"><br></div>   
	<!--<div class="row-form clearfix" style="border-top-width: 0px;">
     <div class="left" style="margin:10px 10px 0px 0px;">                                
      <button name="show" type="submit" class="btn_small btn_gray" value="Search" onClick="shoLst(txtfrm.value, txttil.value);" onMouseOver="formCheck();">Set Power Leg</button>    </div>
    </div>--> 
		<div class="clearfix"><br></div>                        
     </div>
                          

     </div>
     
     <div class="clearfix"><br></div>   
     <div class="span3" style="float:left; margin:5px 5px 5px 0px; background-color:#FFFFFF">
    
    <div class="block-fluid without-head">
    <div class="toolbar clear clearfix"></div>   
    <div class="toolbar nopadding-toolbar clearfix"><h4>Placement Id Status: </h4></div>
    <div class="clearfix"><br></div>                                                 
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <div class="span4">
        <input type="radio" name="placement_id_status" value="0" onClick="show_content(this.value);" <?php if($placement_id_status==0){ echo "checked";}?>> Disable
    </div>
     <div class="span4">
        <input type="radio" name="placement_id_status" value="1" onClick="show_content(this.value);" <?php if($placement_id_status==1){ echo "checked";}?>> Enable
    </div>
    </div>
    <div class="clearfix"><br></div>   
	<!--<div class="row-form clearfix" style="border-top-width: 0px;">
     <div class="left" style="margin:10px 10px 0px 0px;">                                
      <button name="show" type="submit" class="btn_small btn_gray" value="Search" onClick="shoLst(txtfrm.value, txttil.value);" onMouseOver="formCheck();">Set Placement Id</button>    </div>
    </div>--> 
		<div class="clearfix"><br></div>                        
     </div>                     
     </div>
     <div class="span3" style="float:left; margin:5px 5px 5px 0px; background-color:#FFFFFF; <?php if($placement_id_status==0){ echo "display:none";} else if($placement_id_status==1){ echo "";}?>" id="show_placement_button">
    
    <div class="block-fluid without-head">
    <div class="toolbar clear clearfix"></div>   
    <div class="toolbar nopadding-toolbar clearfix"><h4>Placement Id: </h4></div>
    <div class="clearfix"><br></div>                                                 
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <div class="span8">
        <input type="text" name="placement_id" id="placement_id" value="<?php echo ucfirst($placement_id);?>">
    </div>
    </div>
    <div class="clearfix"><br></div>   
	<!--<div class="row-form clearfix" style="border-top-width: 0px;">
     <div class="left" style="margin:10px 10px 0px 0px;">                                
      <button name="show" type="submit" class="btn_small btn_gray" value="Search" onClick="shoLst(txtfrm.value, txttil.value);" onMouseOver="formCheck();">Set Placement Id</button>    </div>
    </div>--> 
		<div class="clearfix"><br></div>                        
     </div>                     
     </div>
     <div class="clearfix"><br></div> 
     <div class="span3" style="float:left; margin:5px 5px 5px 0px; background-color:#FFFFFF;" >
    
    <div class="block-fluid without-head">
    <div class="toolbar clear clearfix"></div>   
    <div class="toolbar nopadding-toolbar clearfix"><h4>Submit: </h4></div>
    <div class="clearfix"><br></div>                                                 
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <div class="span8">
        <div class="row-form clearfix" style="border-top-width: 0px;">
     <div class="left" style="margin:10px 10px 0px 0px;">                                
      <button name="show" type="submit" class="btn_small btn_gray" value="Search" onClick="shoLst(txtfrm.value, txttil.value);" onMouseOver="formCheck();">Submit</button>    </div>
    </div>
    </div>
    </div>
    <div class="clearfix"><br></div>   
	<!----> 
		<div class="clearfix"><br></div>                        
     </div>                     
     </div>
     <div class="clearfix"><br></div> 
     
     </form>
 </div>    
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>
<script>
	function show_content(val)
	{
		if(val==1)
		{
			document.getElementById('show_placement_button').style.display='block';
		}
		else
		{
			document.getElementById('show_placement_button').style.display='none';
		}
	}
</script>