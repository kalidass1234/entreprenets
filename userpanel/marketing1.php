<?php
include("../includes/all_func.php");
 include_once ("header.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
  $sss="select * from materials mat INNER JOIN language lan ON lan.l_id=mat.l_id   ";
  if(isset($_POST[submit]))
  {
	$sss.=" AND mat.banner='{$_POST[banner]}' ";
  }
  if (isset($_GET['cid']) && ($_GET['cid']!=''))
  {
  	$sss.=" AND mat.c_id='{$_POST[cid]}' ";
  }
  $sss.=" order by m_date desc ";
//echo $sss;
		/*$sss="select * from product_category p  order by p.p_cat_id desc ";
		if (isset($_GET['cid']) && ($_GET['cid']!=''))
		{
			  $sss="select * from product_category p inner join category_shop  c on p.cat_id=c.c_id where  p.cat_id='$_GET[cid]' order by p.p_cat_id desc "; 
		}*/
	$se_eshop=mysql_query($sss) or die($sss." ".mysql_error());
	$nume=mysql_num_rows($se_eshop);
?>
<script type="text/javascript">
function calselect(){	/*==JQUERY SELECTBOX==*/
		$(".chzn-select").chosen(); 
		$(".chzn-select-deselect").chosen({allow_single_deselect: true});
		/*==JQUERY UNIFORM==*/
}
function showUser(str)
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
		
	
    document.getElementById("form_input").innerHTML=xmlhttp.responseText;
	calselect();
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
  }
}
</script>
<style type="text/css">
.display h3{
margin-top:0.1em;
}
</style>
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
<?php include('left-bar.php');?>
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
		<h3>Marketing Tools</h3>
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
		<form id="form1" name="form1" method="get" action="" enctype="multipart/form-data" >
	  	
	
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Select Your Categories</h6>
					</div>
					<div class="widget_content">
						<h3> <select data-placeholder="Please Select Catrgory" name="cid" id="state" style=" width:250px"   class="chzn-select" tabindex="13" >
										<option value=""></option>
										<optgroup label="Select Catrgory">
											
											 <? $sql=mysql_query("select * from category1");
								  				while($fetch=mysql_fetch_array($sql)){?>
										  <option value="<?=$fetch[c_id]?>"><?=$fetch[category_name]?></option><? }?>	
											
											</optgroup>
										
										</select></h3>
						<p>
							 
						</p>
					</div>
				</div>
			</div> 
            
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Click Submit To Search </h6>
					</div>
					<div class="widget_content">
						<h3> <input  type="submit" class="btn_small btn_blue" value="Search Now" ></h3>
						<p>
							 
						</p>
					</div>
				</div>
			</div> 
			
			</form>
        <div class="grid_12 full_block">
          <div class="widget_content">
						<h3 class="left">Products</h3>
						
						<div class="clear"></div>
						<!--<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>-->
						  <?php  if($nume>0) {?>
    <!--  <form action="" method="post" name="form" >-->
	  <style>
	  .ms-2 li{
	  float:left;
	  padding:10px;
	  margin-left:10px;
	  border:1px solid #ccc;
	  border-radius:5px;
	  }
	 
		  .m_text{
		  font-family:"Trebuchet MS";
		  font-size:14px;
		  font-weight:bold;
		  color:#444;
		  padding:5px;
		  }
		  table.display td input {
height: 30px !important;
padding: 0 5px;
border: #093868 1px solid;
}
		  </style>
				<table class="display data_tbl">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
                            <th>&nbsp;</th>
						  </tr>
					</thead>
					<tbody>
						<?php
						
						  	while($row=mysql_fetch_array($se_eshop)){ 
							
						?>
         				<tr>
							<td>
								<?php echo ucfirst($row['language_name']);?>
                            </td>
						  <td valign="top">																					
							
							<p><?=ucfirst($row['material_title'])?></p>	
                    <p> <?= ucfirst($ff['category_name']); ?>
						</p>
                            </td>
                            <td>
                            <a href="materials/<?= $row['material']; ?>" rel="gallery">View Banner</a>
                            </td>
						  </tr>
						  <?php 
						  } 
						  ?>
						  
						<!--<tr>
							<td>
								<div class="user-thumb">
									<a href="#"><img height="40" width="40" alt="User" src="images/user-thumb1.png"></a>								</div>							</td>
							<td>						  							
							<span class="badge_style b_suspend">Suspended</span>														</td>
						  </tr>-->
						</tbody>
						<tfoot>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
                            <th>&nbsp;</th>
						  </tr>
						</tfoot>
						</table>
						 <?php   } else { echo "<strong style=color:99000;>No products available</strong>"; }?>
		  </div>
        </div>
		
		
			
	
      <span class="clear"></span></div>
	  <span class="clear"></span> </div>
	  
	  
</div>
</body>
</html>