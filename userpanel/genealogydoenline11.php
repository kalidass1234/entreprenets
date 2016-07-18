<?php
include('header.php');
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	$cl=$_REQUEST['cl'];
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
	$page_no=$r/100;
	$data_dwn;
	if($cl=="")
	{
		$cl=1;
		$min=0;
		$max=100;
	}
	else
	{
		$max=$cl*100;
		$min=$max-100;
	}
	if(($r % 100)!=0)
	{
		$restp=$r % 100;
		$page_no=$r/100+1;
	}
	if($max>$r)
	{
		$max=$r;
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>
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
	</div>
	<div class="switch_bar">
		<ul>
			<li>
			<a href="#"><span class="stats_icon current_work_sl"></span><span class="label">Free Member</span></a>
			</li>
			<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="stats_icon user_sl"><span class="alert_notify orange">30</span></span><span class="label"> Vip Users</span></a>
			  <div class="notification_list dropdown-menu blue_d">
				<div class="white_lin nlist_block">
					<ul>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
						</div>
						</li>
					</ul>
					<span class="btn_24_blue"><a href="#">View All</a></span>
				</div>
			</div>
			</li>
			<li><a href="#"><span class="stats_icon administrative_docs_sl"></span><span class="label">Sell</span></a></li>
			<li><a href="#"><span class="stats_icon finished_work_sl"><span class="alert_notify blue">30</span></span><span class="label">My Store</span></a></li>
			<li><a href="#"><span class="stats_icon config_sl"></span><span class="label">Settings</span></a></li>
			<li><a href="#"><span class="stats_icon archives_sl"></span><span class="label">Spending Act</span></a></li>
			<li><a href="#"><span class="stats_icon address_sl"></span><span class="label">Contact</span></a></li>
			<li><a href="#"><span class="stats_icon folder_sl"></span><span class="label">Media</span></a></li>
			<li><a href="#"><span class="stats_icon category_sl"></span><span class="label">VIP Account</span></a></li>
			<li><a href="#"><span class="stats_icon calendar_sl"><span class="alert_notify orange">30</span></span><span class="label">Events</span></a></li>
			<li><a href="#"><span class="stats_icon lightbulb_sl"></span><span class="label">Support</span></a></li>
			<li><a href="#"><span class="stats_icon bank_sl"><span class="alert_notify blue">30</span></span><span class="label">Income</span></a></li>
		</ul>
	</div>
	<div class="grid_12 full_block">
				<div class="widget_wrap" >
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Genealogy>>View Total Downlines</h6>
					</div>
					<div align="left" style="font-size:14px; padding-bottom:8px;">
  <br />

	<span class='account-detail'><a href="genealogy11.php">Summary</a></span>&nbsp;&nbsp;<span class="class"><a href="genealogyview.php"></a></span>&nbsp;&nbsp;<span class="account-detail">View Total Downlines</span> <span class="class"><a href="genealogydoenline.php">Direct Members</a></span><!--&nbsp;&nbsp;<span class="class"><a href="matrix_genealogy.php">Matrix Genealogy</a></span>--></div>


						  <table class="display data_tbl">
                          <thead>
						    <tr>
                              <th >S.No.</th>
                              <th >User ID</th>
                              <th >MemberName</th>
                              <th >Status</th>
							  
							<th >Parent User ID</th>				  
							  
                              <th>Sponser</th>
                              
                               
                              <th>Join Date</th>
                              <th >Package Type</th>
                            </tr>
                            
							</thead>
							<tbody>
							<? $dir=mysql_query("select * from registration where nom_id='$id' order by id");
							$dir_count=mysql_num_rows($dir);
							$j=1;
							while($direct=mysql_fetch_array($dir)){
							
							if($direct[mem_status]=='0'){
$status='Active';}

else{$status='De-active';}

							$name_direct=$direct['first_name']." ".$direct['mid_name']." ".$direct['last_name'];
							?>
							
							 <tr>
                              <td ><?php echo $j;?></td>
                              <td ><?php echo $direct['user_id'];?></td>
                              <td ><?php echo $name_direct;?></td>
							<td ><?php echo $status;?></td>  
							  
                  <td ><?php echo $direct['nom_id'];?></td>
                              <td ><?php echo $direct['ref_id'];?></td>
                              
                              
                              <td><?php echo date('d-m-Y',strtotime($direct['reg_date']));?></td>
                              <td ><?php echo $direct[package];?></td>
                            </tr>
                            <?php
		$j++;
		}
		?>
							
							<?php
									$srl=1;	
							
									for($i=$min;$i<$max;$i++)
									{
									$level=$lel[$i];
								
									$dn=$data_dwn[$i];
		$u_id=$dn['user_id'];
		$p_id=$dn['nom_id'];
		$r_id=$dn['ref_id'];
		$query="select * from registration where user_id='$u_id'";
		$q=mysql_query($query);
		$flag=1;
		$row=mysql_fetch_array($q);
		$name1=$row['first_name'];
		
		$query_p="select * from registration where user_id='$p_id'";
		$q_p=mysql_query($query_p);
		
		$row_p=mysql_fetch_array($q_p);
		$pname1=$row_p['first_name'];
		
		$query_r="select * from registration where user_id='$r_id'";
		$q_r=mysql_query($query_r);
		
		$row_r=mysql_fetch_array($q_r);
		$rname1=$row_r['first_name'];
		$rplace=$row_r['binary_pos'];
						
	
							if($dn[mem_status]=='0'){
$status_d='Active';}

else{$status_d='De-active';}
if($level<7){
  ?>                      
                            <tr>
                              <td ><?php echo $dir_count+$srl;?></td>
                              <td ><?php echo $dn['user_id'];?></td>
                              <td ><?php echo $name1;?></td>
							  
							  <td ><?php echo $status_d;?></td>
                              <td ><?php echo $dn['nom_id'];?></td>
                              <td ><?php echo $dn['ref_id'];?></td>
                              
                              <?php /*?><td bgcolor="#F4F7FC" style="border-right-color:#FFFFFF; border-right-style:solid; border-right-width:1px"><div align="center"><?php echo $dn['level'];?></div></td><?php */?>
                              
                              <td ><?php echo date('d-m-Y',strtotime($dn['reg_date']));?></td>
                              <td ><?php echo $dn[package];?></td>
                            </tr>
							
                            <?php
		$srl++;
		}}
		?>
                            
                       </tbody>   
					 
					</table>
	</div>
				</div>
			</div>

</div>

</body>
</html>