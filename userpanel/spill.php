<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=showuserid($_SESSION['SD_User_Name']);
	$show_member=mysql_fetch_array(mysql_query("select * from registration where user_id='$idd'"));
	$ref_id=$show_member['ref_id'];
	$category_one=$show_member['category_one'];
	$category_two=$show_member['category_two'];
	$category_three=$show_member['category_three'];
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<?php 
include_once("header.php"); 
if(isset($_POST['submit'])){
	$result_spill=mysql_fetch_array(mysql_query("select * from registration where (user_id='{$_POST['userid']}' or user_name='{$_POST['userid']}') and mem_status=0"));
	$user_spill=$result_spill['user_id'];
	if($user_spill!=''){
	//echo "UPDATE registration set power_status='$_POST[check]', power_leg='$user_spill' WHERE user_id='{$idd}'";
		mysql_query("UPDATE registration set power_status='$_POST[check]', power_leg='$user_spill' WHERE user_id='{$idd}'");
		?><script type="text/javascript">document.location.href='spill.php?status=1'</script>
	<?php }
	else $msg="This is not a valid Userid Or Username or inactive userid";
}
if($show_member['power_status']!=0)
	$power_leg_value=$show_member['power_leg'];
?>
<script type="text/javascript" src="../ajax/function.js"></script>
<script type="text/javascript">
function checkUser(str)
{
if (str!="")
  {
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("user").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checkuser.php?q="+str,true);
xmlhttp.send();
  }
}
//function for user validation
function valid(){
/*var s=document.getElementById('user').innerHTML;
s.replace(/\s+/g, ' ');*/
	if( !$.trim( $('#user').html() ).length ) {
	
		return true;
	}
	else {
	 return false;
	}
}
function ableInput(){
	//alert('display');
	document.getElementById('text1').style.display='';	
	
}
function disableInput(){
	//alert('hidden');
	document.getElementById('text1').style.display='none';	
	document.getElementById('text_name').style.display='none';	
	document.getElementById('text_user').style.display='none';	
}
</script>
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
    <div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Spill Over</h3>
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
	$power_status=$show_member['power_status'];
	$power_leg=$show_member['power_leg'];
	$result_spill_leg=mysql_fetch_array(mysql_query("select * from registration where (user_id='$power_leg' ) and mem_status=0"));
	?>
     <?php
		//include('switch-bar.php');
		$sql_ref="select * from registration where user_id='$ref_id'";
		$res_ref=mysql_query($sql_ref);
		$row_ref=mysql_fetch_assoc($res_ref);
  	?>
	<div id="content">
      <div class="grid_container">
     
        <div class="grid_12 full_block">
        <h6 align="center" style="color:#0033FF">
          <p style="text-align:left; overflow:hidden;">
          <img src="userimages/<?php echo $row_ref['image'];?>" width="100" style="float:left; border:2px solid #e1e1e1; border-radius:5px; margin:0 10px 0 0" height="100">  
		  
		  <strong>Sponser:</strong> <?php echo $row_ref['user_name'];?><br><br>
          
          <strong>Status:</strong><?php if($row_ref['user_name']){ echo "Active";}else{ echo "Inactive";}?>
          </p>
          
          </h6>
          <div class="widget_wrap">
            <div class="grid_12">
		  <div class="widget_wrap tabby">
					<div class="widget_top">
						<h6 class="left">Spill Over</h6>
						
                        <h6 class="clear"></h6>
					</div>
					<div class="widget_content">
                    <?php
                    if($category_two)
					{
						$obj_spill=new SpillOver();
						if(!$obj_spill->get_twenty_reserve($idd))
						{
					?>
						<form action="" method="post" class="form_container left_label">
                        	<div class="form_grid_12" style="margin:5%; padding-top:1%;">
                                <span class="checked"><input name="check" class="radio" type="radio" value="2" tabindex="19" style="opacity: 0;" onClick="disableInput()" <?php echo ($power_status!=1) ? 'checked="checked"' : '' ?>></span> Disabled
                                <span class="checked">
                            <input type="radio" value="1" name="check" onClick="ableInput()" class="radio" tabindex="19" style="opacity: 0;" <?php echo ($power_status==1) ? 'checked="checked"' : '' ?>> Enabled
                                </span>	
								</div>
							<ul >
								<li id="text1" <?php if($power_status!=1){ ?>style="display:none;"<?php } ?>>
								<div class="form_grid_12">
									<label class="field_title"> Enter Username/Userid </label>
									<div class="form_input">
										<input type="text" name="userid" value="<?=$power_leg_value ?>" id="userid" onKeyUp="checksponser(this.value);" style="width:50%;">
                                        <input type="hidden" id="ref_id" value="<?=$idd ?>">
										<span id="sponser"></span>
									</div>
								</div>
								</li>
                                <?php if($power_status==1){ ?>
								<li id="text_name" >
								<div class="form_grid_12">
									<label class="field_title"> Name </label>
									<div class="form_input">
										<?= $result_spill_leg['first_name'].' '.$result_spill['result_spill_leg'] ?>
									</div>
								</div>
								</li>
                                <li id="text_user" >
								<div class="form_grid_12">
									<label class="field_title"> User Name </label>
									<div class="form_input">
										<?= $result_spill_leg['user_name'] ?>
									</div>
								</div>
								</li>
                                <?php } ?>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" class="btn_small btn_blue"><span>ACTIVATE</span></button>
										<span class="red"><?=$msg ?></span>
									</div>
								</div>
								</li>
							</ul>
						</form>
						<?php
							}
							else
							{
							?>
                            <p>
                                You Have Not Twenty Reserve Person. If You Have Twenty Reserve Person . You Can Transfer To Other Member.
                            </p>
                            <?php
							}
                        }
						else  
						{
						?>
                        <p>
							You Need To Upgrade Your Account To Earn The Residual Income.<br>
                            <span ><a href="upgrade_account.php" class="badge_style b_pending">Upgrade</a></span>
						</p>
                        <?php
						}
						?>
					</div>
				</div>
			</div>
	  
          </div>
        </div>
      <span class="clear"></span></div>
	  <span class="clear"></span> </div>
	  
	  
</div>
</body>
</html>