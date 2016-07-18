<?php
include('../includes/all_func.php');
include('header.php');
$sql="select * from privacy_page";
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
		<h3>Thanks For New Registration</h3>

	</div>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
					</div>
					<div class="widget_content">
						<div class="user_block">
                            <div class="norm_text">
                                <h6 style="color:#003333">Thanks .You Have Successfully Join The VTN .</h6>
                            </div>
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