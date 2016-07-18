<?php
class Class_Functions extends mysql_func
{
	public $cms_arr=array("","About Us","Testimonial","Privacy Policy","Term and Conditions","Income Disclaimer","Policy and Procedures","Affiliate Agreement and Conditions","E-sign Notice");
	
	public $cms_home_top_arr=array("1"=>"Trinity Ads","2"=>"Trinity CS","3"=>"Trinity Tools","4"=>"Trinity University","5"=>"Trinity Blogs","6"=>"Trinity Buddy");
	
	public $cms_home_footer_arr=array("telephone"=>"Telephone","envelope"=>"Support Mail","globe"=>"Support Link","clock"=>"Timing","direction"=>"Address");
	
	public $cms_home_arr=array("settings"=>"Responsive System","lamp"=>"A Bigger Vision","responsive"=>"Social Capitalism","sandtime"=>"Perfect Support");
	
	function page_url()
	{
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	function host_name()
	{
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
		}
		return $pageURL;
	}
	
	
	
	
	function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


function get_product_price($p_id,$c_id)
{
	
	if($c_id!='')
	{
	$q=mysql_query("select * from product_price where product_id='$p_id' and country_id='$c_id'") or die(mysql_error());
	$r=mysql_fetch_assoc($q);
	$price=$r['product_price'];
	//exit;
	}
	else
	{
		 $c=mysql_fetch_assoc(mysql_query("select * from country where country_name='Other'"));
		
	$q=mysql_query("select * from product_price where product_id='$p_id' and country_id='".$c['id']."'") or die(mysql_error());
	$r=mysql_fetch_assoc($q);
	 $price=$r['product_price'];
	//exit;
}
return $price;

}

	
	
	
	
	
	
	function _page_title($page_name)
	{
		$arr_title=array(
		"index.php"=>"WelCome to Trinity",
		"about-us.php"=>"About Us",
		"faq.php"=>"FAQ",
		"e-shop.php"=>"The Trinity Resell Shop",
		"cart.php"=>"Shopping Cart",
		"registeration.php"=>"Register OR Login Here",
		"login.php"=>"Login",
		"feedback.php"=>"Feedback",
		"contact.php"=>"Contact Us"
		);
		return $arr_title[$page_name];
	}
	
	function _get_page_name()
	{
		return basename($_SERVER['PHP_SELF']);
	}
	
	function _get_trinity_email_mobile($param)
	{
		$arr_info=array("company_mobile"=>"+44 (0) 7450874013","company_email"=>"info@trinitywealthvision.com");
		return $arr_info[$param];
	}
	function _get_product_image($image)
	{
		//echo Image_Path; exit;
		
		if($image && file_exists(Image_Path.'/'.$image))
		{
			$full_image=Image_Path.'/'.$image;
		}
		else
		{
			$full_image=Image_Path.'/nv.jpg';
		}
		return $full_image;
	}
	
	function _get_product_thumb_image($image)
	{
		//echo Image_Path; exit;
		if($image && file_exists(Image_Path.'/thumb/'.$image))
		{
			$full_image=Image_Path.'/thumb/'.$image;
		}
		else
		{
			$full_image=Image_Path.'/nv.jpg';
		}
		return $full_image;
	}
	
	function _get_category()
	{
		$res=$this->query("c_id,category_name","category_shop","status=0");
		$str.="<ul id='menu-categories' class='toggle_content tree dhtml store_list'>";
		while($row=$this->get_all_row($res))
		{
			// check sub category detail
			$cat_id=$row['c_id'];
			$res_sub=$this->query("*","subcategory"," cat_id='$cat_id'");
			$count_sub=$this->num_row($res_sub);
			
			if($count_sub)
			{
				$prod_cat_count=$this->_get_product_count($cat_id);
				if($prod_cat_count)
				{
					$str.="<li id='menu-item-".$cat_id."' class='menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1259'>
					<a href='product.php?category=".$cat_id."'><i class='mukam-list pull-left'></i>".$row['category_name']."(".$prod_cat_count.")</a>";
					$str.="<ul class='sub_menu' id='submenu-item-".$cat_id."' style='display:none'>";
						while($row_sub=$this->get_all_row($res_sub))
						{
							$product_count=$this->_get_product_count($cat_id,$row_sub['sub_id']);
							if($product_count)
							{
								$str.="<li><a href='product.php?category=".$cat_id."&subcategory=".$row_sub['sub_id']."'>".$row_sub['sub_name']."(".$product_count.")</a></li>";
							}
						}
					$str.="</ul>";
					$str.="</li>";
				}
			}
			else
			{
				$prod_cat_count=$this->_get_product_count($cat_id);
				if($prod_cat_count)
				{
					$str.="<li id='menu-item-".$cat_id."' class='menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1259'>
					<a href='e-shop.php?category=".$cat_id."'><i class='mukam-list pull-left'></i>".$row['category_name']."(".$prod_cat_count.")</a></li>";
				}
			}
		}
		$str.=" </ul>";
		return $str;
	}
	
	function _getSpecialProduct()
	{
		
		$qry = mysql_query("select p.p_cat_id,p.p_qty, p.product_name, p.cost_price, p.image,p.dailydeal_discount from product_category p inner join special_product s on p.p_cat_id=s.product_id") or die(mysql_error());
		
		if($qry)
		{
			
			return $qry;
		}
	}
	
	function _get_special_product()
	{
		$obj_function=new Class_Functions();	
		$qry = mysql_query("select p.p_cat_id, p.product_name, p.cost_price, p.image,p.dailydeal_discount from product_category p inner join special_product s on p.p_cat_id=s.product_id limit 0,5") or die(mysql_error());
		 $num = mysql_num_rows($qry);
		if($num>0)
		{
			
			$special_product = "<ul>";
			while($row=mysql_fetch_array($qry))
			{
				
				//$cp = $row['cost_price'];
				$cp=$obj_function->get_product_price($row['p_cat_id'],$_SESSION['country']);
				$dd = $row['dailydeal_discount'];
				$dis = ($cp*$dd)/100;
				$fp = $cp-$dis;
				
			
				
				$special_product .= "<li class='shop_box  clearfix'>
				<a class='products_block_img' href='#'><img src='".$obj_function->_get_product_image($row['image'])."' alt='' title='".$row['product_name']."' /></a>
				<div>
				<h5><a class='product_link' href='#' title='".$row['product_name']."'>".$row['product_name']."</a></h5>
				<p class='product_desc'>".$row['short_desc']."</p>                
            	<span class='price'>".Currency." ".$fp."</span>
				<span class='reduction price'>(-".$row['dailydeal_discount']."%)</span>
            																									
															
				<span class='price-discount price'>".Currency." ".$cp."</span>
				</div>
			</li>";
		
				
				
			}
			$special_product .= "</ul>";
		
		}
		return $special_product;
		
		
	}
	
	function _get_product_count($category,$subcategory=false)
	{
		if($category && $subcategory)
		{
			$where.=" status=0 and cat_id='$category' and sub_id='$subcategory'";
		}
		else if($category)
		{
			$where.=" status=0 and cat_id='$category' and sub_id<>0";
		}
		$res=$this->query("p_cat_id","product_category",$where);
		$count=$this->num_row($res);
		return $count;
	}
	function _get_review_user($pid,$user_id=false)
	{
		if($user_id){ $cond=" and user_id='$user_id'";}
		$res=$this->query("*","product_review","p_id='$pid' $cond ");
		$row=$this->get_all_row($res);
		return $row;
	}
	function _get_review_count($pid,$user_id=false)
	{
		if($user_id){ $cond=" and user_id='$user_id'";}
		$res=$this->query("*","product_review","p_id='$pid' $cond ");
		$count=$this->num_row($res);
		return $count;
	}
	function _get_avg_review_count($pid)
	{
		//echo " select avg(rating) as rating from product_review where p_id='$pid'";
		$res=$this->query_execute(" select avg(rating_quality) as rating from product_review where p_id='$pid'");
		$row=$this->get_all_row($res);
		return $row['rating']*10;
	}
	
	function _get_breadcrum_of_product($pid)
	{
		//echo "select * from product_category p inner join category_shop c on p.cat_id=c.c_id inner join sub_category s on c.c_id=s.cat_id where p.p_cat_id='$pid'";
		
		$qry=mysql_query("select * from product_category p inner join category_shop c on p.cat_id=c.c_id  where p.p_cat_id='$pid'") or die(mysql_error());
		$num=mysql_num_rows($qry);
		$row=mysql_fetch_array($qry);
		$cat_name=$row['category_name'];
		$sub_name=$row['sub_name'];
		$product_name=$row['product_name'];
		$bread .= "<a href='#' title='".$cat_name."'>".$cat_name."</a><span class='navigation-pipe'>></span>".$product_name;
		return $bread; 
		
	}
	
	function _get_related_products($cid)
	{
		 // get other related category products
		 //$res_products=$this->query("*","product_category","status=0 and p_cat_id='$pid' ");
		
//echo "p.p_cat_id,p.pro_desc,p.cost_price,p.image, p.product_name, p.cat_id, c.c_id, c.category_name", "product_category as p","category_shop as c"," p.cat_id = c.c_id", "p_cat_id <>$pid", " p_cat_id desc limit 9";
		 $res_products=$this->execute_join_query("*", "product_category as p","category_shop as c"," p.cat_id = c.c_id", "p.cat_id = $cid", " p_cat_id desc limit 9") ;
		 $count_products=$this->num_row($res_products);
		if($count_products>0)
		{
		 		//$str.="<div class='related products'>
			 // <h2>Related Products</h2>";
			  while($row_products=$this->get_all_row($res_products))
				{
				$product_name=substr($row_products['product_name'],0,20);
				$product_desc=$row_products['pro_desc'];
				$cost_price=$row_products['cost_price'];
				$discount=$row_products['dailydeal_discount'];
				$shipping=$row_products['shipping'];
				$image=$row_products['image'];


 $str .= "<li class='item'>
                <div class='clearfix'>
                    <a href='product-detail.php?pid=".$row_products['p_cat_id']."' class='lnk_img' title='".$product_name."'><img src='".$this->_get_product_image($image)."' alt='".$product_name."' width='140' height='130'/></a>
                </div>
                        <a class='product_link noSwipe' href='product-detail.php?pid=".$row_products['p_cat_id']."' title='".$product_name."'>".$product_name."</a>
                                        <p class='price_display'>
                        <span class='price'>".Currency.' '.$cost_price."</span>
                    </p>
                                    </li>";

				


			  /*$str.="<div class='featuredproduct-item-container'>
				<div  class='post-1036 product type-product status-publish hentry Array featuredproduct-item featured instock'>
				  <div class='widget-thumb'> <img width='500' height='750' src='".$this->_get_product_image($image)."' class='attachment-full wp-post-image' alt='popular-3' title='popular-3' style='max-width:180px; max-height:180px;' /><span class='overthumb'></span>
					<div class='carousel-icon'><a href='".$this->_get_product_image($image)."' data-rel='prettyPhoto' class='prettyPhoto lightzoom'><i class='mukam-search'></i></a><a href='#' class='postlink'><i class='mukam-link'></i></a></div>
				  </div>
				  <a href='product-detail.php?pid=".$row_products['p_cat_id']."'>
				  <h4><nobr>".$product_name."</nobr></h4>
				  </a>
				 
				  <div class='price-rating'>
					<div class='product-price'>
					  <p><span class='amount'>".CURRENCY.' '.$cost_price."</span> </p>
					</div>
					<div class='star-rating' title='Rated  out of 5'><span style='width:".$this->_get_avg_review_count($row_products['p_cat_id'])."%'></span></div>
					<div class='clearfix'></div>
				  </div>
				  <div class='clearfix'></div>
				  <div class='addtocart'> <a href='javascript:void(0);' onClick='AddToCart(".$row_products[p_cat_id].");' rel='nofollow' data-product_id='".$row_products['p_cat_id']."' data-product_sku=''>
					<p><i class='mukam-shop'></i> ADD TO CART</p>
					</a> </div>
				</div>
			  </div>";		*/
		}
		}
				else
				{
					$str .= "<li class='item'>Product not found</li>";
				}
	
			//$str.="</div>";
			return $str;
	}
	
	function _get_valid_query_string($table_name,$field_name,$value)
	{
		// check the vlaue should be numeric
		if(is_numeric($value))
		{
			$where="$field_name='$value'";
			$res=$this->query($field_name,$table_name,$where);
			$count=$this->num_row($res);
			if($count)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function _updateCart()
	{
		//echo "<pre>"; print_r($_SESSION);
		//echo "<pre>"; print_r($_POST);
		if($_POST['update_cart']=='Update Cart')
		{
			$cart= $_POST['cart']['qty'];
			foreach($cart as $key=>$val)
			{
				$keys = array_search($key,$_SESSION['market_place_cart_product']);
				//echo $keys.'<br>'; exit;
				if(isset($keys) && $val)
				{
					$_SESSION['market_place_cart_qty'][$keys] = $val;
				}	
			}
			//exit;
			header("Location:cart.php");
		}
		else if($_POST['clear_cart']=='Clear Cart')
		{
			$this->_clearShoppingCart();
		}
		else
		{
			header("Location:index.php");
		}
	}
	function _RemoveProductCart()
	{
		$product_id = $_REQUEST['product_id'];
		// get key of product id in session array
		$key = array_search($product_id,$_SESSION['market_place_cart_product']);
		if(isset($key))
		{
			// delete product from cart or(delete from session array)
			unset($_SESSION['market_place_cart_product'][$key]);
			unset($_SESSION['market_place_cart_price'][$key]);
			unset($_SESSION['market_place_cart_qty'][$key]);
			// check product in gift cart session
		}
		header("Location:cart.php");
	}

	function _clearShoppingCart(){
		// remove products from shopping cart
		unset($_SESSION['market_place_cart_product']);
		unset($_SESSION['market_place_cart_price']);
		unset($_SESSION['market_place_cart_qty']);	
		header("Location:cart.php");
	}
	function _submit_review()
	{
		//echo "<pre>"; print_r($_POST);
		if(isset($_SESSION['SD_User_Name']) && $_SESSION['SD_User_Name']!='')
		{
		$insert_arr=array(
		"user_id"=>USERID,
		"p_id"=>$_POST['p_id'],
		"nikname"=>$_POST['author'],
		"section"=>$_POST['email'],
		"rating_quality"=>$_POST['rating'],
		"review"=>$_POST['comment']
		);
		$this->insert_tbl($insert_arr,"product_review");
		header("Location:".$_POST['return_page']."?pid=".$_POST['p_id']);
		}
		else
		{
			header("Location:register.php?return_page=".$_POST['return_page']."?pid=".$_POST['p_id']);
		}
	}
	function _get_cms_home_top_category_dropdown($check=false)
	{
		$arr=$this->cms_home_top_arr;
		/*$res=$this->query("*","cms_category","1");
		while($row=$this->get_all_row($res))
		{
			$key=$row['id'];
			$val=$row['category_name'];
			if($key==$check){ $selected="selected";} else{ $selected="";}
			echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}*/
		foreach($arr as $key=>$val)
		{
			if($key!=0)
			{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
			}
		}
	}
	function _get_cms_home_top_category_name($cat_id)
	{
		$arr=$this->cms_home_top_arr;
		return $arr[$cat_id];
	}
	function _get_cms_home_footer_category_dropdown($check=false)
	{
		$arr=$this->cms_home_footer_arr;
		/*$res=$this->query("*","cms_category","1");
		while($row=$this->get_all_row($res))
		{
			$key=$row['id'];
			$val=$row['category_name'];
			if($key==$check){ $selected="selected";} else{ $selected="";}
			echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}*/
		foreach($arr as $key=>$val)
		{
			if($key!=0)
			{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
			}
		}
	}
	function _get_cms_home_footer_category_name($cat_id)
	{
		$arr=$this->cms_home_footer_arr;
		return $arr[$cat_id];
	}
	function _get_cms_home_category_dropdown($check=false)
	{
		$arr=$this->cms_home_arr;
		/*$res=$this->query("*","cms_category","1");
		while($row=$this->get_all_row($res))
		{
			$key=$row['id'];
			$val=$row['category_name'];
			if($key==$check){ $selected="selected";} else{ $selected="";}
			echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}*/
		print_r($arr);
		foreach($arr as $key=>$val)
		{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}
	}
	function _get_cms_home_category_name($cat_id)
	{
		$arr=$this->cms_home_arr;
		return $arr[$cat_id];
	}
	
	function _contact_us()
	{
		echo "<pre>"; print_r($_POST);
	}
}
?>