<?php
//session_start();
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['adid'])
{
	$username=$_SESSION['adid'];
	$s="select user_id from registration where (user_id = '$username' OR user_name='$username')";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$id=$f['user_id'];
	if(isset($_POST) && $_POST['submit']=='edit')
	{
		extract($_POST);
		if($country){$country_cond=", country='$country'";}
		$sqlupdate="update registration set first_name='$first_name',country='".$country."' ,last_name='$last_name',email='$email',aboutus='$aboutus',state='".$state."',zip='".$zip."',mobile='".$mobile."',phoner='".$phoner."' ";
		
		/*$password=isset($_POST['password']) ? $_POST['password'] : '';
		if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
		{
			$image=$username.'_'.time().'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], 'userimages/'.$image);
			 $sqlupdate.="  , image='{$image}'";
			 //echo "INSERT INTO `userimages` (`user_name`, `user_image`) VALUES ('$username', '$image');";
			 mysql_query("INSERT INTO `userimages` (`user_name`, `user_image`,`user_id`) VALUES ('$username', '$image','$id');");
		}
		if($password!='') $sqlupdate.=" , user_pass='$password' ";*/
		if($caccount!='') $sqlupdate.=" ,paid_to='$caccount'"; else $sqlupdate.=" ,paid_to=''"; 
		/*$dob=$_POST['month'] .'-'.$_POST['day'].'-'.$_POST['yy'];
	if($_POST['yy']!=0) $sqlupdate.=" , dob='$dob' "; */
	$sqlupdate.=" where (user_id = '$username' OR user_name='$username')";
	//echo $_FILES['image']['name'].'   '.$sqlupdate;exit;
	//echo $sqlupdate;exit;
	mysql_query($sqlupdate);
	}
	else if(isset($_POST['password']))
	{
		$password=isset($_POST['password']) ? $_POST['password'] : '';
		if($password!='') $sqlupdate=" update registration set user_pass='$password' where (user_id = '$username' OR user_name='$username')";
		mysql_query($sqlupdate);
	}
	else if(isset($_POST['t_code']))
	{
		$t_code=isset($_POST['t_code']) ? $_POST['t_code'] : '';
		if($t_code!='') $sqlt_code=" update registration set t_code='$t_code' where (user_id = '$username' OR user_name='$username')";
		mysql_query($sqlt_code);
	}
	else if(isset($_POST['accept_card']))
	{
		extract($_POST);
		$sql_update=" update registration set accept_card='$accept_card',accept_cheque='$accept_cheque',appointment_only='$appointment_only',wheelchair_access='$wheelchair_access'";
		mysql_query($sql_update);
	}
	$rowuser=showuserprofile($_SESSION['adid']);
	
}
else
{
	echo "<script language='javascript'>window.location.href='../index.php';</script>";exit;
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
<script type="text/javascript" src="js/jquery-1.5.min.js"></script>
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

<link href="mcss/stylesheets.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="../dist/country.js"></script>
<script> 
$(document).ready(function() { 
		$("#image").change(function(){
		
				$("#userprofileimage").html('');
				$("#userprofileimage").html("<img src='images/progress.gif'>");
				$("#my-form").ajaxForm(
				{
					target: '#userprofileimage'
				}).submit();
				$("#image").val('');
		});
		$("#userpass").submit(function(){
		
			var pass=$('#password').val();
			var rpass=$('#repassword').val();
			//alert('subhash'+pass+'='+rpass); return false;
			if(pass.length<5)
			{
				alert('Please Enter your Desired Password of atleast 5 characters long');
				$('#password').focus();
				return false;
			}
			if(pass!=rpass)
			{
				alert('Password and Confirm Password should be same');
				$('#password').focus();
				return false;
			}
		});
		
		$("#usert_code").submit(function(){
		
			var t_code=$('#t_code').val();
			var rt_code=$('#rt_code').val();
			//alert(t_code.length+'='+t_code.length); return false;
			if(t_code.length<4 )
			{
				alert('Please Enter your Desired Transaction Password of atleast 4 characters long');
				$('#t_code').focus();
				return false;
			}
			if(t_code!=rt_code)
			{
				alert('Transaction Password and Confirm Transaction Password should be same');
				$('#t_code').focus();
				return false;
			}
		});
		
		$('#caccount').click(function(){
			if(document.getElementById('caccount').checked==true)
			{
				document.getElementById('caccount').checked=true;
				$("#ccheck").addClass('checked');
				$("#paypal_account").val($('#cpaypal_account').val());
				$("#paypal_account").attr('readonly', 'readonly');
			}
			else
			{
				$("#ccheck").removeClass('checked');
				$("#paypal_account").val('');
				$("#paypal_account").removeAttr('readonly');
			}
		}); 
});
</script>	
<script language="javascript">
function setprofileimage(checkval)
{
	if(document.getElementById('checkbox'+checkval).checked==true)
	{
		document.getElementById('checkbox'+checkval).checked=true;
		var splitarr = $('#idstr').val().split(',');
		var i;
		for(i=0;i<splitarr.length;i++)
		{
			if(splitarr[i]==checkval)
			{
				$("#span"+checkval).addClass('checked');
			}
			else
			{
				$("#span"+splitarr[i]).removeClass('checked');
			}
		}
		applyprofileimage(checkval,'yes');
	}
	else
	{
		document.getElementById('checkbox'+checkval).checked=false;
		$("#span"+checkval).removeClass('checked');
		applyprofileimage(checkval,'no');
	}
}
function applyprofileimage(checkval,cond)
{
var urldata="checkval="+checkval+"&status="+cond;
	  $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_profileimage.php",
                data: urldata,
                success: function(html) {
                    $('#userprofileimage').html(html);
                }
            });
}
</script>
<script src="js/custom-scripts.js"></script>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div>
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
	<!--<div class="page_title">
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Dashboard</h3>
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
	</div>-->
<div class="workplace">

                <div class="page-header">
                    <h1>Edit user <small><?php echo showuser($_SESSION['adid']); ?></small></h1>
                </div>                  
                
                <div class="row-fluid">                
                    <div class="span3">
					
					<form action="ajaximage.php" method="post" class="form_container left_label" enctype="multipart/form-data" id="my-form">
                        <div class="ushort clearfix">
                            <a href="#"><?php echo showuser($_SESSION['adid']);?></a>
                            <a href="#" id="userprofileimage"><img  class="img-polaroid" <?php if($rowuser['image'] && file_exists("userimages/".$rowuser['image'])) {  echo "src=userimages/$rowuser[image] width='140px' height='140px'";    }else { echo "src=http://placehold.it/140x140"; }?> ></a>
                            <div class="uploader">
							
							<input type="file" name="image" id="image" style="opacity: 0;" size="19"><span class="filename">No file selected</span><span class="action">Choose File</span>
						
							</div>
                        </div>      
						</form>
						<form name="userpass" id="userpass" method="post" action="" enctype="multipart/form-data">
                        <div class="block-fluid without-head">
                            <div class="toolbar nopadding-toolbar clearfix">
                                <h4>Change password</h4>
                            </div>                                                 
                            <div class="row-form clearfix" style="border-top-width: 0px;">
                                <div class="span4">Password</div>
                                <div class="span8"><input type="password" name="password" id="password" required="required"></div>
                            </div>
                            <div class="row-form clearfix" style="border-bottom-width: 0px;">
                                <div class="span4">Confirm</div>
                                <div class="span8"><input type="password" name="repassword" id="repassword" required="required"></div>
                            </div>                        
                           
                                <div class="right" style="margin:10px 10px 0px 0px;">                                
                                    <button type="submit" class="btn btn-small btn-warning"><span class="icon-ok icon-white"></span></button>                                
                                </div>
								 <div class="toolbar clear clearfix">
                            </div>                         
                        </div>                     
						</form>
						<div class="row-form clearfix" style="border-top-width: 0px;"></div>
						<form name="usert_code" id="usert_code" method="post" action="" enctype="multipart/form-data">
                        <div class="block-fluid without-head">
                            <div class="toolbar nopadding-toolbar clearfix">
                                <h4>Change Transaction password</h4>
                            </div>                                                 
                            <div class="row-form clearfix" style="border-top-width: 0px;">
                                <div class="span4"> Transaction Password</div>
                                <div class="span8"><input type="password" name="t_code" id="t_code" required="required"></div>
                            </div>
                            <div class="row-form clearfix" style="border-bottom-width: 0px;">
                                <div class="span4">Confirm Transaction </div>
                                <div class="span8"><input type="password" name="rt_code" id="rt_code" required="required"></div>
                            </div>                        
                           
                                <div class="right" style="margin:10px 10px 0px 0px;">                                
                                    <button type="submit" class="btn btn-small btn-warning"><span class="icon-ok icon-white"></span></button>                                
                                </div>
								 <div class="toolbar clear clearfix">
                            </div>                         
                        </div>                     
						</form>
					
                    </div>
					<form name="userprofile" id="userprofile" method="post" action="" enctype="multipart/form-data">
					
                    <div class="span9">                                        
                        <div class="block-fluid without-head"> 
						                       
                            <div class="toolbar clearfix">
                                <div class="left">
                                    <div class="btn-group">
                                     <!--   <button type="button" class="btn btn-small btn-success tip" data-original-title="Send mail"><span class="icon-envelope icon-white"></span></button>-->
                                <!--        <button type="button" class="btn btn-small btn-info tip" data-original-title="User page"><span class="icon-info-sign icon-white"></span></button>                                  -->  
                                    </div>                                
                                </div>
                                <div class="right">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-small btn-warning tip" data-original-title="Quick save"><span class="icon-ok icon-white"></span></button>
                                        <button type="reset" class="btn btn-small btn-danger tip" data-original-title="Delete user"><span class="icon-remove icon-white"></span></button>
                                    </div>
                                </div>
                            </div>                        

                            <div class="row-form clearfix" style="border-top-width: 0px;">
                                <div class="span3">Name</div>
                                <div class="span9"><input  type="text" name="first_name" id="first_name" value="<?php echo $rowuser['first_name'];?>" readonly ></div>
                            </div>

                            <div class="row-form clearfix">
                                <div class="span3">Surname</div>
                                <div class="span9"><input  type="text" name="last_name" id="last_name" value="<?php echo $rowuser['last_name'];?>" readonly ></div>
                            </div>
					
                            <div class="row-form clearfix">
                                <div class="span3">Email</div>
                                <div class="span9"><input type="text" name="email" value="<?php echo $rowuser['email'];?>" id="acpro_inp9"></div>
                            </div>          
                            
                            <div class="row-form clearfix">
                                <div class="span3">Country</div>
                                <div class="span9"><input type="text" name="country" value="<?php echo $rowuser['country'];?>" id="acpro_inp9"></div>
                            </div>  

                            <div class="row-form clearfix">
                                <div class="span3">State</div>
                                <div class="span9"><input type="text" name="state" value="<?php echo $rowuser['state'];?>" id="acpro_inp9"></div>
                            </div>  

                            <div class="row-form clearfix">
                                <div class="span3">Zip</div>
                                <div class="span9"><input type="text" name="zip" value="<?php echo $rowuser['zip'];?>" id="acpro_inp9"></div>
                            </div>  
                            <div class="row-form clearfix">
                                <div class="span3">Mobile</div>
                                <div class="span9"><input type="text" name="phoner" value="<?php echo $rowuser['phoner'];?>" id="acpro_inp9"></div>
                            </div>  
                            <div class="row-form clearfix">
                                <div class="span3">Other Phone</div>
                                <div class="span9"><input type="text" name="mobile" value="<?php echo $rowuser['mobile'];?>" id="acpro_inp9"></div>
                            </div>  

                            <div class="row-form clearfix">
                                <div class="span3">Sponsor Id</div>
                                <div class="span9"><?php echo $rowuser['ref_id'];?></div>
                            </div> 
                            <!--<div class="row-form clearfix">
                                <div class="span3">Age</div>
                                <div class="span9"><input  type="text" name="age" id="age" value="<?php echo $rowuser['age'];?>" class="input-mini" ></div>
                            </div>-->

							 <div class="row-form clearfix" style="border-bottom-width: 0px;">
                                <div class="span3">About Us</div>
                                <div class="span9"><textarea name="aboutus" id="signature"><?php echo $rowuser['aboutus'];?></textarea></div>
                            </div>
							<input type="hidden" name="submit" value="edit" />
							</form>                        
                        </div>                    
                    </div>
               </div> 
                <!--<div class="row-fluid">
                    <div class="span11">
                        <div class="block-fluid without-head">                        
                            <div class="toolbar nopadding-toolbar clearfix">
                                <h4>User images</h4>
                            </div>                         
                            <div class="toolbar clearfix">
                                <div class="left">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-small btn-warning tip" data-original-title="Hide"><span class="icon-eye-close icon-white"></span></button>
                                        <button type="button" class="btn btn-small btn-danger tip" data-original-title="Delete"><span class="icon-remove icon-white"></span></button>
                                    </div>                                
                                </div>                        
                            </div>

                            <table cellpadding="0" cellspacing="0" width="100%" class="table images">
                                <thead>
                                    <tr>
                                        <th width="30"><div class="checker"><span><input type="checkbox" name="checkall" style="opacity: 0;"></span></div></th>
                                        <th width="60">Image</th>
                                        <th>Name</th>
                                        <th width="60">Size</th>
                                        <th width="40">Actions</th>                                
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php
									$sqlimages="select * from userimages where (user_id = '$username' OR user_name='$username')";
									$result=mysql_query($sqlimages);
									while($rowimages=mysql_fetch_assoc($result)){
									$idstr.=$rowimages['id'].',';
									if($rowimages['user_image']==$rowuser['image']){  $class="class='checked'";} else {$class='';}
									?>
									<tr>
                                        <td><div class="checker"><span id="span<?php echo $rowimages['id'];?>" <?php echo $class;?>><input type="checkbox" name="checkbox<?php echo $rowimages['id'];?>" id="checkbox<?php echo $rowimages['id'];?>" value="<?php echo $rowimages['id'];?>" onClick="setprofileimage(this.value);"  style=""></span></div></td>
                                        <td><a class="fancybox" rel="group" href="<?php if($rowimages['user_image']){ echo "userimages/$rowimages[user_image]";} else { echo "img/example_xmini.jpg";}?>">
										<img src="<?php if($rowimages['user_image']){ echo "userimages/$rowimages[user_image]";} else { echo "img/example_xmini.jpg";}?>" width="40" height="40" class="img-polaroid">
										</a></td>
                                        <td class="info"><a class="fancybox" rel="group" href="<?php if($rowimages['user_image']){ echo "userimages/$rowimages[user_image]";} else { echo "img/example_xmini.jpg";}?>"><?php echo $rowimages['user_image'];?></a> <span><?php echo $rowimages['user_image'];?></span> <span><?php echo date('d.m.Y H:i',strtotime($rowimages['ts']));?></span></td>
                                        <td><?php echo formatbytes("userimages/".$rowimages['user_image'], 'KB') ;?></td>
                                        <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                    </tr>
									<?php
									}
									$idstr=rtrim($idstr,',');
									?>
									<input type="hidden" id="idstr" value="<?php echo $idstr;?>">
                                   <!-- <tr>
                                        <td><div class="checker"><span><input type="checkbox" name="checkbox" style="opacity: 0;"></span></div></td>
                                        <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"></a></td>
                                        <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                        <td>260 Kb</td>
                                        <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                    </tr>
                                    <tr>
                                        <td><div class="checker"><span><input type="checkbox" name="checkbox" style="opacity: 0;"></span></div></td>
                                        <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"></a></td>
                                        <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                        <td>260 Kb</td>
                                        <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                    </tr>
                                    <tr>
                                        <td><div class="checker"><span><input type="checkbox" name="checkbox" style="opacity: 0;"></span></div></td>
                                        <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"></a></td>
                                        <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                        <td>260 Kb</td>
                                        <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                    </tr>
                                    <tr>
                                        <td><div class="checker"><span><input type="checkbox" name="checkbox" style="opacity: 0;"></span></div></td>
                                        <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"></a></td>
                                        <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                        <td>260 Kb</td>
                                        <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                    </tr>      -->                                        
                               <!-- </tbody>
                            </table>                    

                            <div class="toolbar bottom-toolbar clearfix">
                                <div class="left">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-small btn-warning tip" data-original-title="Hide"><span class="icon-eye-close icon-white"></span></button>
                                        <button type="button" class="btn btn-small btn-danger tip" data-original-title="Delete"><span class="icon-remove icon-white"></span></button>
                                    </div>                                
                                </div>                            
                                <div class="right">
                                        <div class="pagination pagination-mini">
                                            <ul>
                                                <li class="disabled"><a href="#">Prev</a></li>
                                                <li class="disabled"><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">Next</a></li>
                                            </ul>
                                        </div>                             
                                </div>                        
                            </div>        -->            

                        </div>
                    </div>

                    <!--<div class="span6">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="block-fluid nm without-head">
                                    <div class="toolbar nopadding-toolbar clear clearfix">
                                        <h4>Current uploads</h4>
                                    </div>                                  
                                </div>
                                <div class="block uploads">
                                    <div class="item">
                                        <p><span class="icon-picture"></span> SP-20031.jpg</p>
                                        <div id="progressbar-3" class="tipb ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="65" data-original-title="65%"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: 65%;"></div></div>
                                        <div class="controls">
                                            <a href="#"><span class="icon-pause tip" data-original-title="Pause"></span></a>
                                            <a href="#"><span class="icon-stop tip" data-original-title="Stop"></span></a>
                                            <a href="#"><span class="icon-remove tip" data-original-title="Delete"></span></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <p><span class="icon-film"></span> MOV-80131.mov</p>
                                        <div id="progressbar-4" class="tipb ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="35" data-original-title="30%"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: 35%;"></div></div>
                                        <div class="controls">
                                            <a href="#"><span class="icon-pause tip" data-original-title="Pause"></span></a>
                                            <a href="#"><span class="icon-stop tip" data-original-title="Stop"></span></a>
                                            <a href="#"><span class="icon-remove tip" data-original-title="Delete"></span></a>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>                                        
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="block-fluid nm without-head">
                                    <div class="toolbar nopadding-toolbar clear clearfix">
                                        <h4>Send message</h4>
                                    </div>                                  
                                </div>                            
                                <div class="block messaging">

                                    <div class="itemIn">
                                        <a href="#" class="image"><img src="img/users/olga.jpg" class="img-polaroid"></a>
                                        <div class="text">
                                            <div class="info">
                                                <span class="name">Olga</span>
                                                <span class="date">15 sec ago</span>
                                                <div class="clear"></div>
                                            </div>  
                                            Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus. Maecenas nulla felis, commodo et adipiscing vel, accumsan eget augue morbi volutpat.
                                        </div>
                                    </div>   

                                    <div class="itemOut">
                                        <a href="#" class="image"><img src="img/users/aqvatarius.jpg" class="img-polaroid"></a>
                                        <div class="text">
                                            <div class="info">
                                                <span class="name">Aqvatarius</span>
                                                <span class="date">7 min ago</span>
                                                <div class="clear"></div>
                                            </div>                                
                                            In id adipiscing diam. Sed lobortis dui ut odio tempor blandit. Suspendisse scelerisque mi nec nunc gravida quis mollis lacus dignissim. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.
                                        </div>
                                    </div>                                                                     

                                    <div class="controls">
                                        <div class="control">
                                            <textarea name="textarea" placeholder="Your message..." style="height: 70px; width: 100%;"></textarea>
                                        </div>
                                        <button class="btn">Send message</button>
                                    </div>                        
                                </div>                            

                            </div>
                        </div>                      
                    </div>-->

                <!--</div>-->         



            </div>
			</div>
</body>
</html>
