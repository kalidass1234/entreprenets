<?php
include("../includes/all_func.php");
 include_once ("header.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
 
		$sss="select * from product_category p where p.allow_deal=0 and p.status=0 order by p.p_cat_id desc ";
	if (isset($_GET['cid']) && ($_GET['cid']!=''))
		
		{
			  $sss="select * from product_category p inner join category_shop  c on p.cat_id=c.c_id where p.allow_deal=0 and  p.cat_id='$_GET[cid]' and p.status=0 order by p.p_cat_id desc "; 
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
<!--/*<script src="../dist/jquery.zclip.js"></script>
<style>
#dynamic {
    font-size: 15px;
    height: 28px;
    width: 357px;
}
</style>

<script>
jQuery(document).ready(function(){
jQuery("a#copy-dynamic").zclip({
path:"http://demo.phpgang.com/copy-text-to-clipboard-using-jquery/ZeroClipboard.swf",
copy:function(){return $("input#dynamic").val();}
});
});
</script>

<input type="text" id="dynamic" value="PHPGang demo is available!!" />
<a href="#copy" id="copy-dynamic">Copy Now</a>  */  -->
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
		<h3>Stock To Sell</h3>
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
     <!-- <p align="center"> <br><img src="backend-images/eshop.png" alt="" border="0"></p>-->
		<!--<form id="form1" name="form1" method="get" action="" enctype="multipart/form-data" >
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
											
											 <? $sql=mysql_query("select * from category_shop where type='online'");
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
			</form>-->
            <?php
            $sss="select * from stock_to_sell_mp where user_id='".USERID."' and status=0";
			$res=mysql_query($sss);
			$count=mysql_num_rows($res);
			
			$sss_sold="select * from stock_to_sell_mp where user_id='".USERID."' and status=1";
			$res_sold=mysql_query($sss_sold);
			$count_sold=mysql_num_rows($res_sold);
			?>
        <div class="grid_12 full_block">
          <div class="widget_content">
			<h3 class="left"><?php if($count_sold>=30){ echo "You Qualified";} else if($count){ echo "Total ".$count." Products Need To Sell";} else{ "No Products Assign To User";}?></h3>
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
.custom_tooltip{
    display: inline;
    position: relative;
}

.custom_tooltip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 70%;
}
		  </style>
				<?php
			// check the member upgrade to affiliate aor not
			$sql_check="select * from  registration where user_id='".USERID."' and bonus=1";
			$res_check=mysql_query($sql_check);
			$count_check=mysql_num_rows($res_check);
			if($count_check)
			{	
                if($count)
                {
                ?>		
                      <div class="gall_wrap" style="height:auto;">
							<ul class="portfolio group">
							<?php
							$s=1;
							while($row=mysql_fetch_assoc($res))
							{
								// find the product detail from product table
								$product_id=$row['product_id'];
								$sql1="select * from product_category where p_cat_id='$product_id'";
								$res1=mysql_query($sql1);
								$row1=mysql_fetch_assoc($res1);
								$image=$row1['image'];
								if($image!='' && file_exists("../product_logos/".$image))
								{
									$image1="../product_logos/".$image;
								}
								else
								{
									$image1="../product_logos/nv.jpg";
								}
							?>
                            <form method="post" action="cart.php">
								<li class="item" data-id="id-1" data-type="hannah" style="width:22%">
								<a href="../product_logos/<?php echo $image1;?>" rel="gallery" title="Price:$<?php echo $row1['cost_price'];?> Product:<?php echo $row1['product_name'];?> " class="custom_tooltip"> <img src="<?php echo $image1;?>" style="width:95%" alt="<?php echo $row['product_name'];?>"/></a>
                              <br>
                               
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Pre-Written Add:</strong>
                                <?php if($row1['pre_written_add']!=''):?>
                                <textarea name="text_copy" id="text_copy" rows="2" cols="24" style="width:95%" onBlur="CopyToClipboard(this)"><?php echo $row1['pre_written_add'];?></textarea>
                                <?php
                                endif;
								?>
                                </span></span>
                                <br>
                               
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Copy Link:<!--<input type="button" onClick="CopyToClipboard(this,'<?php echo $s;?>')" value="Copy">--></strong><textarea name="text_copy" id="text_copy" rows="2" cols="24" style="width:95%" onBlur="CopyToClipboard(this)"><?php echo $host_name."product-redirect.php?seller=".USERID."&pid=".$product_id;?></textarea><!--<input type="hidden" name="link" id="link_<?php echo $s;?>" value="<?php echo $host_name."product-detail.php?pid=".$product_id;?>" ><span id="show_copy_<?php echo $s;?>">--></span></span>
                                <!--<br>
                                <br>
                                
                                <br>-->
								<span style="color:#000; font-size:12px;">&nbsp;<strong>Product Sale:</strong><?php if($row['status']){ ?>
								<span class="badge_style b_confirmed" style="cursor:pointer">Confirmed</span>
								<?php } else{ ?><span class="badge_style b_pending" style="cursor:pointer">Pending</span><?php }?></span>
                                <br>
								</li>
                                </form>
                               
							<?php 
							$s++;
							}
							?>
								
							</ul>
						</div>
                        <?php   } ?>

                  <span class="clear"></span>    
                  <h3 class="left">Total Sold Products: <?php echo $count_sold;?></h3>
				<div class="clear"></div>
                  <?php
        if($count_sold)
		{
		?>		
      <div class="gall_wrap" style="height:auto;">
							<ul class="portfolio group">
							<?php
							
							$s=1;
							while($row_sold=mysql_fetch_assoc($res_sold))
							{
								// find the product detail from product table
								$product_id=$row_sold['product_id'];
								$sql1="select * from product_category where p_cat_id='$product_id'";
								$res1=mysql_query($sql1);
								$row1=mysql_fetch_assoc($res1);
								$image=$row1['image'];
								if($image!='' && file_exists("../product_logos/".$image))
								{
									$image1="../product_logos/".$image;
								}
								else
								{
									$image1="../product_logos/nv.jpg";
								}
							?>
                            <form method="post" action="cart.php">
								<li class="item" data-id="id-1" data-type="hannah" style="width:22%">
								<a href="../product_logos/<?php echo $image1;?>" rel="gallery"><img src="<?php echo $image1;?>" style="width:95%" alt="<?php echo $row['product_name'];?>"/></a>
                               <!-- <span style="color:#006699; font-size:14px;"><a href="../product_logos/<?php echo $row1['image'];?>"  class=" "><?php echo $row1['product_name'];?></a></span>
                                <br>
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Product Price:</strong>$<?php echo $row1['cost_price'];?></span>
                                <br>
                                <br>
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Product Sale:</strong><?php if($row_sold['status']){ echo " <font color='green'>YES</font>";} else{ echo " <font color='red'>NO</font>";}?></span>
                                <br>-->
                                <span style="color:#000; font-size:12px;">&nbsp;<strong>Product Sale:</strong><?php if($row_sold['status']){ ?>
								<span class="badge_style b_confirmed" style="cursor:pointer">Confirmed</span>
								<?php } else{ ?><span class="badge_style b_pending" style="cursor:pointer">Pending</span><?php }?></span>
                                <br>
								</li>
                                </form>
							<?php 
							$s++;
							}
							?>
								
							</ul>
						</div>
                        <?php   } else { echo "<strong style=color:99000;>No products available</strong>"; }?>  
                        
              <?php
              }
			  else
			  {
			  	echo "<strong style=color:99000;>You have not authorize to use this section</strong>";
			  }
			  ?>          
      </div>
    </div>
  <span class="clear"></span></div>
  <span class="clear"></span> </div>
</div>
</body>
</html>
<script language="JavaScript">
/*function CopyToClipboard(text,no) {
//alert(no);
document.getElementById('show_copy_'+no).innerHTML='Link Copied';
var holdtext=document.getElementById('link_'+no).value;
var Copied = holdtext.createTextRange();
Copied.execCommand("Copy");*/
/*var text=document.getElementById('text_copy');
var holdtext=text;*/
//holdtext.innerText = copytext.innerText;
//alert(holdtext.innerText)
/*Copied = holdtext.createTextRange();
Copied.execCommand("Copy");*/
   /* Copied = text.createTextRange();
	alert(Copied);
    Copied.execCommand("Copy");*/
/*}*/
function CopyToClipboard(p,s) {
    if (window.clipboardData && clipboardData.setData) {
        clipboardData.setData('text', s);
    }
}
</script>
