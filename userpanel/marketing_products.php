<?php
include("../includes/all_func.php");
 include_once ("header.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
 
		$sss="select * from product_category p where p.allow_deal=1 and p.status=0 order by p.p_cat_id desc ";
	if (isset($_GET['cid']) && ($_GET['cid']!=''))
		
		{
			  $sss="select * from product_category p inner join category_shop  c on p.cat_id=c.c_id where p.allow_deal=1 and  p.cat_id='$_GET[cid]' and p.status=0 order by p.p_cat_id desc "; 
		}
		
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
		<h3>Marketing Products</h3>
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
      <p align="center"> <br><img src="backend-images/marketing-product.png" alt="" border="0"></p>
      <?php
                    $idd=$_SESSION['SD_User_Name'];
					$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_name='$idd'"));
					?>
                    <?php
                    
					/*if($res_reg['category_two'] || ($res_reg['category_two'] && $res_reg['category_three']) || ($res_reg['category_one'] && $res_reg['category_three']))
					{*/					
					?>
		<form id="form1" name="form1" method="get" action="" enctype="multipart/form-data" >
	  	<div class="grid_4">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Select Your Categories</h6>
					</div>
					<div class="widget_content">
                    
						<h3>
						<div class="form_input">
							<select data-placeholder="Please Select Catrgory" name="cid" id="state" style=" width:250px"   class="chzn-select" tabindex="13" >
										<option value=""></option>
										<optgroup label="Select Catrgory">
											
											 <? $sql=mysql_query("select * from category_shop where type='offline'");
								  				while($fetch=mysql_fetch_array($sql)){?>
										  <option value="<?=$fetch[c_id]?>"><?=$fetch[category_name]?></option><? }?>	
											
											</optgroup>
										
										</select>
						  </div>
						</h3>
						<p></p>
					</div>
				</div>
		</div>
	
			<div class="grid_4">
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
			<div class="grid_4">
				<div class="widget_wrap">
					<div class="widget_top">
						
						<h6>Check Your Cart</h6>
					</div>
					<div class="widget_content">
						<h3>
						<div class="form_input" id="form_input">
							<input type="button" value="Check Your Cart" class="btn_small btn_blue" onClick="window.location='eshop_check.php'">(<?=$ee=($_SESSION['product_name']!='') ? count(explode(",",$_SESSION['product_name'])) : 0; ?> Products)
						  </div>
						</h3>
						<p>
							 
						</p>
					</div>
				</div>
			</div>
			</form>
        <div class="grid_12 full_block">
          <div class="widget_content">
						<h3 class="left">Marketing Products</h3>
						
						<div class="clear"></div>
						<!--<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>-->
						  <?php  /*if($nume>0) {*/?>
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
				<!--<table class="display data_tbl">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						  </tr>
					</thead>
					<tbody>
						<?php
						
						  	while($eshop_fetch=mysql_fetch_array($se_eshop)){ 
							
						?>
         				<tr>
							<td>
								<div class="user-thumb" style="width:80px; height:80px;">
									<img height="80" width="80" alt="<?=$eshop_fetch['product_name']; ?>" src="../product_logos/<?=$eshop_fetch[image];?>" >							</div>							</td>
						  <td valign="top">																					
							  <h3><a href="eshopto.php?p_cat_id=<?=$eshop_fetch[p_cat_id];?>&package=<?=$eshop_fetch[p_cat_id];?>"  class=" "><?=$eshop_fetch['product_name']; ?></a></h3>	
							
							<p><?=$eshop_fetch['prod_desc']; ?></p>	
                    <p> <form method="post" action="cart.php"> 
                   <div class="left"> <label><strong>Product Price : </strong></label> <label>$<?=$eshop_fetch['cost_price']; ?></label><br>
                   
                   </div>
							 <input type="hidden"  name="product_name" value="<?=$eshop_fetch[p_cat_id];?>" />
                             <div class="right">
                             <strong>Quantity:</strong>
                        <input type="text" name="quantity" >
                        <input type="hidden"  name="" value="<?=$eshop_fetch[cat_id];?>" />
                           <input type="submit" class="btn_small btn_blue" value="Add to Cart">
	</div>
    <div class="clear"	></div>				</form>
						</p>
					     								</td>
						  </tr>
						  <?php 
						  } 
						  ?>
						
						</tbody>
						<tfoot>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						  </tr>
						</tfoot>
						</table>-->
						 <?php   /*} else { echo "<strong style=color:99000;>No products available</strong>"; }*/?>
               <div class="gall_wrap" style="height:auto;">
							
					
							
							<ul class="portfolio group">
							<?php
							//$sql="select * from product_category where status=0";
							$sss="select * from product_category p where p.allow_deal=1 and p.status=0 order by p.p_cat_id desc ";
	if (isset($_GET['cid']) && ($_GET['cid']!=''))
		
		{
			  $sss="select * from product_category p inner join category_shop  c on p.cat_id=c.c_id where p.allow_deal=1 and  p.cat_id='$_GET[cid]' and p.status=0 order by p.p_cat_id desc "; 
		}
							$res=mysql_query($sss);
							$count=mysql_num_rows($res);
							if($count)
							{
							while($row=mysql_fetch_assoc($res))
							{
							?>
                            <form method="post" action="cart.php">
								<li class="item" data-id="id-1" data-type="hannah" style="width:22%">
								<a href="../product_logos/<?php echo $row['image'];?>" rel="gallery"><img src="../product_logos/<?php echo $row['image'];?>" style="width:198px;" alt="<?php echo $row['product_name'];?>"/></a>
                                <span style="color:#006699; font-size:14px;"><a href="../product_logos/<?php echo $row['image'];?>" class=""><?php echo $row['product_name'];?></a></span>
                                <br>
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Product Price:</strong>$<?php echo $row['cost_price'];?></span>
                                <br>
                                <br>
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Quantity:</strong><input type="text" name="quantity" ></span>
                                <br>
                                <br>
                                <span style="color:#000; font-size:12px; margin-left:50px;">&nbsp;<input type="hidden"  name="product_name" value="<?=$row[p_cat_id];?>" />
                                <input type="hidden"  name="" value="<?=$row[cat_id];?>" />
                           <input type="submit" class="btn_small btn_blue" value="Add to Cart">
                                </span>
                                <br>
								</li>
                                </form>
                               
							<?php }?>
								<?php   } else { echo "<strong style=color:99000;>No products available</strong>"; }?>
							</ul>
						</div>          
		  </div>
        </div>
		
		<?php
       /* }
		else
		{
			echo "<p>You Are Not Authorize To Access This Section.</p>";
		}*/
		?>
	
      <span class="clear"></span></div>
	  <span class="clear"></span> </div>
	  
	  
</div>
</body>
</html>