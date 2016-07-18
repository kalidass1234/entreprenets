<?php
include('../includes/all_func.php');
include('header.php');
$sql="select * from privacy_page where type='shipping'";
$res=mysql_query($sql);

$count=mysql_num_rows($res);
?>
<script>
function coderHakan(str)
{
var sayfa = window.open('','','width=500,height=500');
sayfa.document.open("text/html");
sayfa.document.write(document.getElementById('printArea_'+str).innerHTML);
sayfa.document.close();
sayfa.print();
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
		<h3>Compansation Detail</h3>
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
						<h6>Compansation Detail</h6>
					</div>
					<div class="widget_content">
					<div class="user_block">
					<?php
						// check category two subscription is available or not
						$sql_subs="select * from subscription where user_id='$id' and status=0 and type='2'";
						$res_subs=mysql_query($sql_subs);
						$count_subs=mysql_num_rows($res_subs);
                        if($category_two && $count_subs)
						{
                        /*if($category_two)
						{*/
						?>
					<?php
                    $sql="select * from error_page ";
				$res=mysql_query($sql);
				$row=mysql_fetch_assoc($res);
				echo $row['heading'];
					?>	
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