<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
include('header.php');
$pid=$_GET['pid'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$add_by=$_SESSION['SD_User_Name'];
	$user_id=showuserid($add_by);
$res_reg=mysql_fetch_array(mysql_query("SELECT email FROM registration WHERE user_name='$add_by'"));
 $from=$res_reg['email'];
 if(isset($_POST['Show'])){
/*echo "<pre>"; print_r($_POST);
echo "<pre>"; print_r($_FILES);*/
extract($_POST);

mysql_query("insert into pin_request  set pins_count='$pins_count',email='$email',`name`='$name',mobile='$mobile',amount='$amount',bank_name='$bank_name',branch_name='$branch_name',bank_address='$bank_address',user_id='$user_id',message='$message'");
	$id=mysql_insert_id();
		if($_FILES['receipt_file']['name']!='')
		{
			$arr_file=explode(".",$_FILES['receipt_file']['name']);
			$ext=end($arr_file);
			$filename=$arr_file[0];
			$file_name=$filename."_".time().".".$ext;
			move_uploaded_file($_FILES['receipt_file']['tmp_name'],"attachfile/".$file_name); 
			mysql_query("update pin_request set receipt_file='$file_name' where id='$id'");
		}
	$msg="1";
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
<style>
.form_container ul {
   background:none;!important
    border-top:none;!important
	border-bottom:none;!important
    padding: 15px 15px 15px 10px;
    position: relative;
}
.form_container ul li {
    background:none;!important
    border-top:none;!important
	border-bottom:none;!important
    padding: 15px 15px 15px 10px;

}

.input_txt{

	width:290px!important;

	height:30px!important;}

	

.input_grow{width:490px!important;

	height:160px!important;}

.form_container ul li label.field_title{

	font-size:16px;

	font-weight:normal;

	margin-left:20px;

	text-transform:capitalize;}

.btn-blu{

	border:none;

	line-height:30px;

	padding:0 20px;

	color:#fff;

	margin-left:170px;

	text-shadow:none;

	font-weight:bold;

	background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */

}

.btn-blu1{

	border:none;

	border-radius:5px;

	line-height:30px;

	padding:0 20px;

	color:#fff;

	text-shadow:none;

	font-weight:bold;

	background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */

}



.btn_30_blue a{

border-radius:10px;

box-shadow:none;

border:none;

background: #62bded; /* Old browsers */
background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */
background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */
}

.btn_30_blue a:hover
{
border:none;
background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */}

.chzn-container-multi .chzn-choices .search-field input{ background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;

    border: 0 none !important;

    box-shadow: none;

    color: #666666;

    font-family: sans-serif;

    font-size: 100%;

    height: 25px;

    margin: 1px 0;

    outline: 0 none;

    padding: 5px;}
	
	
	.sms_quick{margin-right:40px;
}

.sms_quick img{
	}

.sms_quick img:hover{ 
width:94px;
height:94px;
}

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
		<span class="title_icon"><span style="float:left;"><img src="backend-images/mail.png" height="20" width="20" alt="" border="0" /></span></span>
		<h3>Epin Request</h3>
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
						<h6 >Request For E-Pin</h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Email</a></li>
								<li><a href="email_search.php">Bulk Email</a></li>
								
							</ul>
						</div>-->
 					</div>
					<div class="widget_content" >
						<div class="oilhold">
   							<form action="" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul >
                            <?php
                            if($msg!='')
							{
							?>
							<li >
								<div class="form_grid_12">
									<label class="field_title" >&nbsp;</label>
									<div class="form_input" >
									<font color="#003300">Request Sent Successfully</font>                                    </div>
							  </div>
								</li>
                            <?php
                            }
							?>  
                             <li >
								<div class="form_grid_12">
									<label class="field_title" >Number Of Pins</label>
									<div class="form_input" >
										<input name="pins_count" type="text" tabindex="1"  style="width:44%;" />
                                     </div>
								</div>
								</li> 
                            <li >
								<div class="form_grid_12">
									<label class="field_title" >Name</label>
									<div class="form_input" >
										<input name="name" type="text" tabindex="1"  style="width:44%;" />
                                     </div>
								</div>
								</li>  
                            <li >
								<div class="form_grid_12">
									<label class="field_title" >Email</label>
									<div class="form_input" >
										<input name="email" type="text" tabindex="1"  style="width:44%;" />
                                     </div>
								</div>
								</li>
                                
                                 <li >
								<div class="form_grid_12">
									<label class="field_title" >Mobile</label>
									<div class="form_input" >
										<input name="mobile" type="text" tabindex="1"  style="width:44%;" />
                                     </div>
								</div>
								</li>
								<li >
								<div class="form_grid_12">
									<label class="field_title" >Amount</label>
									<div class="form_input" >
										<input name="amount" type="text" tabindex="4"  style="width:44%;" />
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Bank Name</label>
									<div class="form_input">
										<input name="bank_name" type="text" tabindex="1" class="" style="width:44%;" />
										
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Branch Name</label>
									<div class="form_input">
										<input name="branch_name" type="text" tabindex="1" class="" style="width:44%;" />
										
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Bank Address</label>
									<div class="form_input">
										<input name="bank_address" type="text" tabindex="1" class="" style="width:44%;" />
										
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Upload Receipt</label>
									<div class="form_input">
										<input name="receipt_file" type="file" tabindex="1" class="" style="width:44%;" />
										
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" >Message </label>
									<div class="form_input" >
										<textarea name="message" class="input_grow" cols="50" rows="6" tabindex="5" ></textarea>
									</div>
								</div>
								</li>
								<li >
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn-blu" name="Show"><span>SEND</span></button>
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
		<span class="clear"></span>
	</div>
</div>
</body>
</html>