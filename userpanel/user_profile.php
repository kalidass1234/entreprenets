<?php
include('../includes/all_func.php');
include('header.php');

if(isset($_SESSION) && $_SESSION['adid'])
{
	$username=$_SESSION['adid'];
	$rowuser=showuserprofile($_SESSION['adid']);
	$user_id=showuserid($username);
}
?>
<script>
$(function(){
			//demo 1
			$('select#speed').selectToUISlider({labels: 5}).next();
			//demo 2
			$('select#valueA, select#valueB').selectToUISlider();
			//demo 3
			$('select#valueAA, select#valueBB').selectToUISlider({
				labels: 12
			});
			//Chart
	});
	$(function() {
		var select = $( "#minbeds" );
		var slider = $( "<div id='slider' class='black_w slider_max box_inset_s'></div>" ).insertAfter( select ).slider({
			min: 1,
			max: 6,
			range: "min",
			value: select[ 0 ].selectedIndex + 1,
			slide: function( event, ui ) {
				select[ 0 ].selectedIndex = ui.value - 1;
			}
		});
		$( "#minbeds" ).change(function() {
			slider.slider( "value", this.selectedIndex + 1 );
		});
	});
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
		<span class="title_icon"><span class="list_images"></span></span>
		<h3>Welcome  <?php echo $_SESSION['adid'];?></h3>
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
						<span class="h_icon list"></span>
						<h6>User Profile</h6>
					</div>
					<div class="widget_content">
						<div class="elem_grid">
							<div id="progress1">
								<div class="span12">
				<div class="box-widget">
				  <div class="widget-container">
					  <div class="widget-block clearfix">
							<div class="btn-toolbar profile-toolbar pull-right">
							  <div class="btn-group"></div>
						</div>
							<div class="profile-thumb">
							<?php 
							if($rowuser['image'] && file_exists("userimages/".$rowuser['image']))
							{
							?>
								<img class="img-polaroid" src="userimages/<?php echo $rowuser['image'];?>" width="140" height="140">
							<?php
							}
							else
							{
							?>
								<img class="img-polaroid" src="http://placehold.it/140x140" width="140" height="140">
							<?php
							}
							?>
								<ul class="list-item">
									<li><a href="secure_edit_user.php"><i class="gray-icons pencil"></i> Edit Profile </a></li>
<!--									<li><a href="gallery.php"><i class="gray-icons image_1"></i> Gallery</a></li>
									<li><a href="support.php"><i class="gray-icons cog_2"></i> Support</a></li>-->
								</ul>
							</div>
						<div class="profile-info">
								<h4 class="profile-title"><?php echo showuser($rowuser['user_name']);?></h4>
								<p>&nbsp;
									<?php $arrys=array('NA','Your Membership is <strong>active</strong>');?>
								</p>
								<ul class="profile-intro">
									<li style="background-color:#F5FCFB; border-bottom:1px dotted #FFFFFF;">
									<label style="width: 29em;padding-bottom: 15px;">Name:</label> <?php echo ($rowuser['first_name']." ".$rowuser['last_name']);?> </li>
									<li style="background-color:#F5FCFB; border-bottom:1px dotted #FFFFFF;"><label style="width: 29em;padding-bottom: 15px;">Email:</label> <?php echo $rowuser['email'];?></li>
									<li style="background-color:#F5FCFB; border-bottom:1px dotted #FFFFFF;"><label style="width: 29em;padding-bottom: 15px;">Username:</label> <?php echo $rowuser['user_name'];?></li>
         <li style="background-color:#F5FCFB; border-bottom:1px dotted #FFFFFF;"><label style="width: 29em;padding-bottom: 15px;">Join Date:</label>
		 <?php echo date('m/d/Y',strtotime($rowuser['reg_date']));?></li>
         
         		</ul>
			<!--<h4>About</h4>
				<p>
					<?php echo $rowuser['aboutus'];?>
				</p>
			<h4>Recent Activity</h4>
  <div class="activity-timeline">
	<div class="timeline-title">
	 <?php 
	if($rowuser['image'] && file_exists("userimages/".$rowuser['image']))
	{
	?>
		<img class="img-polaroid" src="userimages/<?php echo $rowuser['image'];?>" width="50" height="50">
	<?php
	}
	else
	{
	?>
		<img class="img-polaroid" src="http://placehold.it/50x50">
	<?php
	}
	?>	
		<div class="title-info">
            <h3><?php echo showuser($rowuser['user_name']);?> </h3>
            <p>
           	 <i class="gray-icons money"></i> <?php if($rowuser['plan_name']){ echo "Affiliate Member";} else { echo "Free Member";}?>  
            </p>-->
		<!--</div>
	</div>-->
								
						  </div>
						</div>
					</div>
				</div>
  </div>
</div>
							</div>
							<!--
							<div id="progress3">
								<p>If you want to show some other text you can put it here</p>
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