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
		<h3>Term & Condition And Privacy Policy</h3>
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
        	
		<?php
		while($row=mysql_fetch_assoc($res))
		{
		?>
		<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6><?php if($row['type']=='tandc'){?>Term & Condition<?php } else {?>Privacy Policy<?php }?></h6>
					</div>
					<div class="widget_content">
					<div class="user_block" id="printArea_<?php echo $row['type'];?>">
					<?php
					if($count>0)
					{
					?>
						<div class="btn_30_light" style="float:right;">
							<a href="#" original-title="Print" onClick="coderHakan('<?php echo $row['type'];?>');"><span class="icon printer_co"></span></a>
						</div>
					<?php
					}
					?>
                        <div class="norm_text">
                            <?php 
                            echo $row['description'];
                            ?>
                        </div>
						</div>	
					</div>
				</div>
			</div>
			<?php 
			}
			?>
			
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>