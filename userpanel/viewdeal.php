<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
		$idd=showuserid($_SESSION['SD_User_Name']);
	 	$str1="select * from final_deal where buser_id='$idd' and id='$id' order by id desc";
		$res1=mysql_query($str1);
		$x1=mysql_fetch_array($res1);
		$pid=$x1['p_id'];
		$str2="select * from product_category where p_cat_id='$pid'";
		$res2=mysql_query($str2);
		$x2=mysql_fetch_array($res2);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

//echo "update `final_deal` set `read_receiver`='0' where deal_id='$_GET[id]' and suser_id = '$idd'";
mysql_query("update `final_deal` set `read_sender`='0' where id='$_GET[id]' and buser_id = '$idd'");
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
<script src="js/validationOnNumber.js"></script>
<style>
.popup_left{
	width:200px; height:200px; float:left; background:#ccc;}
	
.popup_right{
	width:400px; float:right; height:200px; background:#000;}
	
	
	.main {
    background: #aaa url(../images/bg.jpg) no-repeat;
    width: 800px;
    height: 600px;
    margin: 50px auto;
}
.panel {
    background-color: #444;
    height: 34px;
    padding: 10px;
}
.panel a#login_pop, .panel a#join_pop {
    border: 2px solid #aaa;
    color: #fff;
    display: block;
    float: right;
    margin-right: 10px;
    padding: 5px 10px;
    text-decoration: none;
    text-shadow: 1px 1px #000;

    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    -o-border-radius: 10px;
    border-radius: 10px;
}
a#login_pop:hover, a#join_pop:hover {
    border-color: #eee;
}
.overlay {
    background-color: rgba(0, 0, 0, 0.6);
    bottom: 0;
    cursor: default;
    left: 0;
    opacity: 0;
    position: fixed;
    right: 0;
    top: 0;
    visibility: hidden;
    z-index: 1;

    -webkit-transition: opacity .5s;
    -moz-transition: opacity .5s;
    -ms-transition: opacity .5s;
    -o-transition: opacity .5s;
    transition: opacity .5s;
}
.overlay:target {
    visibility: visible;
    opacity: 1;
}
.popup {
    background-color: #fff;
    border: 3px solid #fff;
    display: inline-block;
    left: 50%;
    opacity: 0;
    padding: 15px;
    position: fixed;
    text-align: justify;
    top: 40%;
    visibility: hidden;
    z-index: 10;

    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);

    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    -o-border-radius: 10px;
    border-radius: 10px;

    -webkit-box-shadow: 0 1px 1px 2px rgba(0, 0, 0, 0.4) inset;
    -moz-box-shadow: 0 1px 1px 2px rgba(0, 0, 0, 0.4) inset;
    -ms-box-shadow: 0 1px 1px 2px rgba(0, 0, 0, 0.4) inset;
    -o-box-shadow: 0 1px 1px 2px rgba(0, 0, 0, 0.4) inset;
    box-shadow: 0 1px 1px 2px rgba(0, 0, 0, 0.4) inset;

    -webkit-transition: opacity .5s, top .5s;
    -moz-transition: opacity .5s, top .5s;
    -ms-transition: opacity .5s, top .5s;
    -o-transition: opacity .5s, top .5s;
    transition: opacity .5s, top .5s;
}
.overlay:target+.popup {
    top: 50%;
    opacity: 1;
    visibility: visible;
}
.close {
    background-color: rgba(0, 0, 0, 0.8);
    height: 30px;
    line-height: 30px;
    position: absolute;
    right: 0;
    text-align: center;
    text-decoration: none;
    top: -15px;
    width: 30px;

    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    -ms-border-radius: 15px;
    -o-border-radius: 15px;
    border-radius: 15px;
}
.close:before {
    color: rgba(255, 255, 255, 0.9);
    content: "X";
    font-size: 24px;
    text-shadow: 0 -1px rgba(0, 0, 0, 0.9);
}
.close:hover {
    background-color: rgba(64, 128, 128, 0.8);
}
.popup p, .popup div {
    margin-bottom: 10px;
}
.popup label {
    display: inline-block;
    text-align: left;
    width: 120px;
}
.popup input[type="text"], .popup input[type="password"] {
    border: 1px solid;
    border-color: #999 #ccc #ccc;
    margin: 0;
    padding: 2px;

    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
}
.popup input[type="text"]:hover, .popup input[type="password"]:hover {
    border-color: #555 #888 #888;
}

</style>
</head>
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
		<h3>Deal View</h3>
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
						<!--<h6>Welcome Letter</h6>-->
					</div>
					<div class="widget_content">
						<!--<h3>Welcome Letter</h3>-->
						
						<form action="" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Deal Price: </label>
									<div class="form_input">
										$<?=$x1['udeal_price'];?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Counter Offer: </label>
									<div class="form_input">
										<?php
										$sql_makeadeal1="select user_id from make_a_deal where deal_id='$id' order by id desc limit 0,1";
										$res_makedeal1=mysql_query($sql_makeadeal1);
										$row_makedeal1=mysql_fetch_assoc($res_makedeal1);
										 
										/*if($x1['status']==0){ $text='sent you a counter offer';}
										else if($x1['status']==1){ $text='accept  counter offer';}
										else if($x1['status']==2){ $text='decline  counter offer';} */
										if(showlastcounteroffer($x1['id'],$row_makedeal1['user_id'])) echo showlastcounteroffer($x1['id'],$x1['suser_id'])  ; else echo "NA";?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Date Of Deal: </label>
									<div class="form_input">
										<?=date('m/d/Y',strtotime($x1['deal_date']));?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Seller:</label>
									<div class="form_input">
										<?=showusername($x1['suser_id']);?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Status: </label>
									<div class="form_input">
										<?php 
										if($x1['status']==2)
										{
											echo "Decline";
										}
										else if($x1['status']==1)
										{
											echo "Accept";
										}
										else
										{
											echo "Pending";
										}
										?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Product:</label>
									<div class="form_input">
										<?=$x2['product_name'];?>
										<img src="../product_logos/<?php echo $x2['image'];?>" width="80" height="80" >
									</div>
								</div>
								</li>
								
							<li>
								<div class="form_grid_12">
									<label class="field_title"></label>
									<div class="form_input">
									<?php
									if(($x1['status']==0) && showlastcounteroffer($x1['id'],$x1['suser_id']))
									{
									?>
										<p>
										<?php
										if($x1['count_ucounter']==0)
										{
										?>
										<a href="#login_form"><button type="button" class="btn_small btn_blue" tabindex="12"><span>Counter Offer</span></button></a>	&nbsp;
										<?php
										}
										?>
										<a href="dealbuyer.php?accept=accept&id=<?php echo $x1['id'];?>"><button type="button" class="btn_small btn_blue" tabindex="12"><span>Accept Offer</span></button></a>	&nbsp;<a href="dealbuyer.php?del=del&id=<?php echo $x1['id'];?>"><button type="button" class="btn_small btn_blue" tabindex="12"><span>Decline Offer</span></button></a>	</p>
									<?php
									}
									?>	
									</div>
								</div>
								</li>
							
								
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon help"></span>
						<h6>Offer History</h6>
					</div>
					<div class="widget_content">
						<div class="ticket_list">
						<?php
						$sql_makeadeal="select * from make_a_deal where deal_id='$id' order by id desc";
						$res_makedeal=mysql_query($sql_makeadeal);
						$i=1;
						while($row_makedeal=mysql_fetch_assoc($res_makedeal))
						{
						$status=$row_makedeal['status'];
						if($i==1) { $udeal_price=$row_makedeal['udeal_price']; $sdeal_price=$row_makedeal['sdeal_price'];}
						?>
						
							<div class="ticket_block">
								<div class="ticket_info">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="User">
									</div>
									<span class="user-info">  <?php if($row_makedeal['sender_id']==$x1['buser_id']){ echo "You :".showusername($x1['buser_id']);} else if($row_makedeal['reciever_id']==$x1['buser_id']) { echo "Seller :".showusername($x1['suser_id']);}?></span>
									<span class="user-info"><p> 
										<?php 
										if((!$row_makedeal['ucounter_offer'] && !$row_makedeal['scounter_offer']) && $status==0){ echo "<b>Submitted Deal: </b>";}
										else if($status==1){ echo "<b>Accepted Deal: </b>";}
										else if($status==2){ echo "<b>Decline Deal: </b>";}
										else { echo "<b>Counter Offer: </b>";} 
										if(($row_makedeal['sender_id']==$x1['buser_id']) && ($row_makedeal['ucounter_offer'])){ echo "$".$row_makedeal['ucounter_offer']; }  
										else if(($row_makedeal['reciever_id']==$x1['buser_id']) && ($row_makedeal['scounter_offer'])) { echo "$".$row_makedeal['scounter_offer']; }
										else if(($row_makedeal['sender_id']==$x1['buser_id'])){ echo "$".$row_makedeal['udeal_price']; }  
										else if(($row_makedeal['reciever_id']==$x1['buser_id']) ) { echo "$".$row_makedeal['sdeal_price']; }
										
										echo " &nbsp;&nbsp;<nobr>".date('F  d , Y',strtotime($row_makedeal['ts']))."</nobr>";
										?>
									</p></span>

								</div>
								
								<!--<ul class="action_list">
									<li><a class="p_reply" href="#">Reply</a></li>
									<li><a class="p_forward" href="#">Forward</a></li>
									<li class="right"><a class="p_approve" href="#">Resolved</a></li>
								</ul>-->
							</div>
						<?php 
						$i++;}
						?>	
							
							<!--<div class="ticket_block">
								<div class="ticket_info">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="User">
									</div>
									<span class="user-info"> User: kjaman on IP: 192.118.1.1 <b>ID #12467RS</b></span>
									<p>
										<a href="#">Suspendisse convallis laoreet lectus in aliquam. Vivamus quis elit nisl, ut posuere leo.</a>
									</p>
								</div>
								<ul class="action_list">
									<li><a class="p_reply" href="#">Reply</a></li>
									<li><a class="p_forward" href="#">Forward</a></li>
									<li class="right"><a class="p_approve" href="#">Resolved</a></li>
								</ul>
							</div>
							<div class="ticket_block">
								<div class="ticket_info">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="User">
									</div>
									<span class="user-info"> User: kjaman on IP: 192.118.1.1 <b>ID #12467RS</b></span>
									<p>
										<a href="#">Suspendisse convallis laoreet lectus in aliquam. Vivamus quis elit nisl, ut posuere leo.</a>
									</p>
								</div>
								<ul class="action_list">
									<li><a class="p_reply" href="#">Reply</a></li>
									<li><a class="p_forward" href="#">Forward</a></li>
									<li class="right"><a class="p_approve" href="#">Resolved</a></li>
								</ul>
							</div>-->
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<a href="#x" class="overlay" id="login_form"></a>
        <div class="popup">
            <form name="updatetitle" id="updatetitle" action="updatedeal.php?r=bdeal" method="post">
            <div>
                <label for="login">Counter Offer</label>
                $<input type="text" name="bcounter_offer" onBlur="extractNumber(this,2,false);" onKeyUp="extractNumber(this,2,false);" onKeyPress="return blockNonNumbers(this, event, true, false);" autocomplete='off' value="" tabindex="1" required="required" />
            </div>
            <div>
                <label for="password">Quantiy</label>
                <input type="text" name="deal_qty" name="deal_qty" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false); if(parseInt(this.value)>parseInt(document.getElementById('product_qty').value)){ this.value=document.getElementById('product_qty').value}" onkeypress="return blockNonNumbers(this, event, false, false);" autocomplete='off' value="1" tabindex="2" required="required" /><?php echo get_product_vailable_qty($pid);?> Quantity  Available 
				<input type="hidden" name="product_quantity" id="product_qty" value="<?php echo get_product_vailable_qty($pid);?>">
            </div>
			<div>
                <label for="login">Detail</label>
                <textarea name="remark" cols="50" rows="5" required="required" tabindex="3"><?php echo $_SESSION['pro_desc'];?></textarea>
            </div>
			<div>
			<label for="login">&nbsp;</label>
			<input type="hidden" name="deal_id" value="<?php echo $id;?>">
			<input type="hidden" name="udeal_price" value="<?php echo $udeal_price;?>">
			<input type="hidden" name="sdeal_price" value="<?php echo $sdeal_price;?>">
			<input type="hidden" name="pid" value="<?php echo $pid;?>">
			<input type="hidden" name="deal_date" value="<?php echo $x1['deal_date'];?>">
			<input type="hidden" name="suser_id" value="<?php echo $x1['suser_id'];?>">
			<input type="hidden" name="cost_price" value="<?php echo $x1['cost_price'];?>">
			<input type="hidden" name="ipbo_price" value="<?php echo $x1['ipbo_price'];?>">
            <input type="submit" value="Counter Offer" />
			</div>
			</form>
            <a class="close" href="#close"></a>
        </div>
</body>
</html>
<?php

function showlastcounteroffer($dealid,$user_id)
{
$arr_status=array('Sent Counter Offer',' Accept Counter Offer',' Decline Counter Offer');
	 $sql="select scounter_offer,status,user_id from make_a_deal where deal_id='$dealid'  order by id desc limit 0,1";
	$res=mysql_query($sql);
	$row=mysql_fetch_assoc($res);
	$s=$row['status'];
	if($row['scounter_offer'])
	{
	return showusername($row['user_id']).' '.$arr_status[$s].' $'.$row['scounter_offer'];
	}
	else
	return 0;
}

?>