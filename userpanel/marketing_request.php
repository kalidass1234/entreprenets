<?php
include('../includes/all_func.php');
include('header.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	//transaction history
$user_id=showuserid($_SESSION['SD_User_Name']);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<script>
function showadmincharge(val)
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
			  if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				var str=xmlhttp.responseText;
				var res = str.split(",");
				var tot=res[1];
				document.getElementById("admincharge").innerHTML="$"+res[0];
				document.getElementById("totalpaid").innerHTML="$"+res[1];
				}
			  }
			xmlhttp.open("GET","ajax_admin_charge.php?amount="+val,true);
			xmlhttp.send();
}
function showpricefunc(str)
{
	document.getElementById("showprice").innerHTML=str*4.16;
	document.getElementById("price").value=str*4.16;
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
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Request For Business Card</h3>
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
	<?php //include('switch-bar.php');?>
		<div id="content">
		<div class="grid_container">
	<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Business Card Request</h6>
                        
					</div>
					<div class="widget_content">
						<?php 
							$id=$_GET['id'];
							 $sqluser="select * from materials where m_id='$id' and status=0";
							 $resuser=mysql_query($sqluser);
							 $countuser=mysql_num_rows($resuser);
							 $rowuser=mysql_fetch_assoc($resuser);
							 if($countuser)
							 {
							 	$action="update";
							 }
							 else
							 {
							 	$action="insert";
							 }
							 
							?>
						<div id="tab4">
							<div class="oilhold">
   							<form action="marketing_request_submit.php?action=<?php echo $action;?>" method="post" class="form_container left_label">
							<ul>
                            <li>
								<div class="form_grid_12">
									<label class="field_title">Name</label>
									<div class="form_input">
										<label><input type="text" name="name" value="<?=$row_user['name'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Phone</label>
									<div class="form_input">
										<label><input type="text" name="phone" value="<?=$row_user['phone'];?>"></label>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Url</label>
									<div class="form_input">
										<label><input type="text" name="url_link" value="<?=$row_user['url_link'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Email</label>
									<div class="form_input">
										<label><input type="text" name="email" value="<?=$row_user['email'];?>"></label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Qty</label>
									<div class="form_input">
										<label>
                                        <select name="quantity" onChange="showpricefunc(this.value)">
                                        	<option value="100">100</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                            <option value="2500">2500</option>
                                            <option value="5000">5000</option>
                                        </select>
                                        </label>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Price</label>
									<div class="form_input">
										<label id="showprice">$<?=$row_user['price'];?></label>
									</div>
								</div>
								</li>
                               
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    <input type="hidden" name="price" id="price" value="<?=$row_user['price'];?>">
                                    <input type="hidden" id="id" name="banner_id" value="<?php  echo $rowuser['m_id'];?>" />
										<button type="submit" class="btn_small btn_gray"><span>Submit</span></button>
                                        
										<span class="blue"><?php if($_GET['msg_r']) echo $_GET['msg_r']; else if($_GET['msg']) echo $_GET['msg']; ?></span>
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
					</div>
				</div>
			</div>
			</div></div>
</div>
</body>
</html>
<script language="javascript">
function checkUser(val,target)
{
	//alert(val+'--'+target);
	var urldata="ref="+val+"&target="+target;
             $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_checkuser.php",
                data: urldata,
                success: function(html) {
				//alert(target+'---'+html);
                    if(html)
					{
						$('#user_'+target).html(html);
					}
					else
					{
						return false;	
					}
                }
            });
}
</script>