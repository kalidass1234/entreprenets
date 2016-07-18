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
	
	function _page_title($page_name)
	{
		$arr_title=array(
		"index.php"=>"WelCome to Trinity",
		"about-us.php"=>"About Us",
		"faq.php"=>"FAQ",
		"e-shop.php"=>"Trinity Shop",
		"cart.php"=>"Shopping Cart",
		"register.php"=>"Register OR Login Here",
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
		$arr_info=array("company_mobile"=>"(+01) 112 345 6789","company_email"=>"info@mukam.com");
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
	
	function _get_category()
	{
		$res=$this->query("c_id,category_name","category_shop","status=0");
		$str.="<div class='menu-categories-container'>
                  <ul id='menu-categories' class='menu'>";
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
					<a href='javascript:showsubcategory($cat_id);'><i class='mukam-list pull-left'></i>".$row['category_name']."(".$prod_cat_count.")</a>";
					$str.="<ul class='sub_menu' id='submenu-item-".$cat_id."' style='display:none'>";
						while($row_sub=$this->get_all_row($res_sub))
						{
							$product_count=$this->_get_product_count($cat_id,$row_sub['sub_id']);
							if($product_count)
							{
								$str.="<li><a href='e-shop.php?category=".$cat_id."&subcategory=".$row_sub['sub_id']."'>".$row_sub['sub_name']."(".$product_count.")</a></li>";
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
		$str.=" </ul></div>";
		return $str;
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
	
	function _get_review_count($pid)
	{
		$res=$this->query("*","product_review","p_id='$pid'");
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
	function _get_related_products($pid)
	{
		 // get other related category products
		 //$res_products=$this->query("*","product_category","status=0 and p_cat_id='$pid' ");
		 $res_products=$this->execute_join_query("p.p_cat_id,p.pro_desc,p.cost_price,p.image, p.product_name, p.cat_id, c.c_id, c.category_name", "product_category as p","category_shop as c"," p.cat_id = c.c_id", "p_cat_id <>$pid", " p_cat_id desc limit 9");
		 $count_products=$this->num_row($res_products);
		 		$str.="<div class='related products'>
			  <h2>Related Products</h2>";
			  while($row_products=$this->get_all_row($res_products))
				{
				$product_name=substr($row_products['product_name'],0,25);
				$product_desc=$row_products['pro_desc'];
				$cost_price=$row_products['cost_price'];
				$discount=$row_products['dailydeal_discount'];
				$shipping=$row_products['shipping'];
				$image=$row_products['image'];

			  $str.="<div class='featuredproduct-item-container'>
				<div  class='post-1036 product type-product status-publish hentry Array featuredproduct-item featured instock'>
				  <div class='widget-thumb'> <img width='500' height='750' src='".$this->_get_product_image($image)."' class='attachment-full wp-post-image' alt='popular-3' title='popular-3' /><span class='overthumb'></span>
					<div class='carousel-icon'><a href='".$this->_get_product_image($image)."' data-rel='prettyPhoto' class='prettyPhoto lightzoom'><i class='mukam-search'></i></a><a href='#' class='postlink'><i class='mukam-link'></i></a></div>
				  </div>
				  <a href='product-detail.php?pid=".$row_products['p_cat_id']."'>
				  <h4>".$product_name."</h4>
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
			  </div>";		
		}	
			$str.="</div>";
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
				//echo $keys.'<br>';
				if(isset($keys))
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
			header("Location:e-shop.php");
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
	function _get_cms_category_dropdown($check=false)
	{
		$arr=$this->cms_arr;
		$res=$this->query("*","cms_category","1");
		while($row=$this->get_all_row($res))
		{
			$key=$row['id'];
			$val=$row['category_name'];
			if($key==$check){ $selected="selected";} else{ $selected="";}
			echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}
		/*foreach($arr as $key=>$val)
		{
			if($key!=0)
			{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
			}
		}*/
	}
	function _get_cms_category_backoffice_dropdown($check=false)
	{
		$arr=$this->cms_arr;
		$res=$this->query("*","cms_category_backoffice","1");
		while($row=$this->get_all_row($res))
		{
			$key=$row['id'];
			$val=$row['category_name'];
			if($key==$check){ $selected="selected";} else{ $selected="";}
			echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}
		/*foreach($arr as $key=>$val)
		{
			if($key!=0)
			{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
			}
		}*/
	}
	function _get_cms_subcategory_backoffice_dropdown($check=false)
	{
		$arr=$this->cms_arr;
		$res=$this->query("*","cms_subcategory_backoffice","1");
		while($row=$this->get_all_row($res))
		{
			$key=$row['id'];
			$val=$row['category_name'];
			if($key==$check){ $selected="selected";} else{ $selected="";}
			echo "<option value='".$key."' ".$selected.">".$val."</option>";
		}
		/*foreach($arr as $key=>$val)
		{
			if($key!=0)
			{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
			}
		}*/
	}
	function _get_cms_category_name($cat_id)
	{
		$arr=$this->cms_arr;
		return $arr[$cat_id];
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
		print_r($arr);
		foreach($arr as $key=>$val)
		{
				if($key==$check){ $selected="selected";} else{ $selected="";}
				echo "<option value='".$key."' ".$selected.">".$val."</option>";
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
	
	function _get_total_sale($year=false,$total=false,$order=false)
	{
		$con_search="";
		if($year)
		{
			$from_date=$year."-01-01";
			$to_date=$year."-12-31";
			$con_search.=" and status=1 and (date between $from_date to $to_date) ";
		}
		if($total=='total')
		{
			$con_search.=" and status=1 ";
		}
		if($order=='order')
		{
			$con_search.=" and status in (0,1,2,3) ";
		}
		
		$res=$this->query("sum(net_amount) as amount","amount_detail","1=1 $con_search ");
		$row=$this->get_all_row($res);
		return round($row['amount'],2);
	}
	function _get_total_user($total=false,$pending=false,$affiliate=false,$reseller=false)
	{	
		$con_search="";
		if($total=='total')
		{
			$con_search.="";
		}
		if($pending=='pending')
		{
			$con_search.=" and mem_status=0 and bonus=0";
		}
		if($affiliate=='affiliate')
		{
			$con_search.=" and bonus=1";
		}
		if($reseller=='reseller')
		{
			$con_search.=" and reseller=1";
		}
		$res=$this->query("id","registration","1=1 $con_search");
		$count=$this->num_row($res);
		return $count;
	}
	
	function _get_wallet_amount($user_id,$type)
	{
		$res=$this->query("amount",$type,"user_id='$user_id'");
		$row=$this->get_all_row($res);
		return $row['amount'];
	}
	
	function _get_downline($user_id, $position=false)
	{
		$query="";
		if($position)
			$query.="and binary_pos='$position' ";
		$res=$this->query("count(nom_id) as total_count","registration","nom_id='$user_id' $query");
		$row=$this->get_all_row($res);
		return $row['total_count'];
	}
	
	function _get_direct_count($user_id,$type=false)
	{
		if($type=='affiliate')
		{
			$cond=" and bonus=1 ";
		}
		if($type=='reseller')
		{
			$cond=" and reseller=1 ";
		}
		
		$res=$this->query("user_id","registration","ref_id='$user_id' $cond");
		$count=$this->num_row($res);
		return $count;
	}
	
	function _Confirm_Order()
	{
		//echo "<pre>"; print_r($_POST);
		foreach($_POST['id'] as $key=>$val)
		{
			
			
			// update the purchase_detail
			$res_pur=$this->query("*","purchase_detail","invoice_no='$val'");
			while($row_pur=$this->get_all_row($res_pur))
			{
				$seller_id=$row_pur['seller_id'];
				$user_id=$row_pur['user_id'];
				$invoice_no=$row_pur['invoice_no'];
				$reseller_id=$row_pur['reseller_id'];
				$invoice_bv=$row_pur['product_volume'];
				$invoice_amt=$row_pur['quantity']*$row_pur['price'];
				$pid=$row_pur['p_id'];
				require_once("class_commission.php");
				$obj_commission=new Class_Commission();
				$obj_commission->_update_product_volume($user_id,$invoice_bv,$invoice_no);
				$obj_commission->_update_product_sale($user_id,$invoice_amt,$invoice_no);
				
				$res_check_st=$this->query("*","stock_to_sell_mp","user_id='$reseller_id' and status=1 and product_id='$pid'");
				$count_check_st=$this->num_row($res_check_st);
				if($count_check_st)
				{
				
				}
				else
				{
					mysql_query("update stock_to_sell_mp set status=1 where user_id='$reseller_id' and product_id='$pid'");
				}
			}
			// check the seller id 
			$res=$this->query("*","amount_detail","invoice_no='$val'");
			$count=$this->num_row($res);
			if($count)
			{
				$row=$this->get_all_row($res);
				$seller_id=$row['seller_id'];
				$user_id=$row['user_id'];
				$invoice_no=$row['invoice_no'];
				$total=$row['total_amount'];
				$reseller_id=$row['reseller_id'];
				require_once("class_commission.php");
				$obj_commission=new Class_Commission();
				$obj_commission->First_Bonus($seller_id,$user_id,$invoice_no,$total);
				if($reseller_id!='')
				{
					$res_check_st=$this->query("*","stock_to_sell_mp","user_id='$reseller_id' and status=1");
					$count_check_st=$this->num_row($res_check_st);
					//echo $count_check_st;
					if($count_check_st>=30)
					{
						$obj_commission->Second_Bonus($reseller_id,$user_id,$invoice_no,$total);
					}
				}
			}
			$update_arr=array("status"=>1);
			$where=" invoice_no='$val'";
			$this->update_tbl($update_arr,"amount_detail",$where);
			$this->update_tbl($update_arr,"purchase_detail",$where);
		}
		header("Location:admin_main.php?page_number=20&update=1&msg=Orders Confirm Successfullt");
	}
	function _Diliver_Order()
	{
		//echo "<pre>"; print_r($_POST);
		foreach($_POST['id'] as $key=>$val)
		{
			$update_arr=array("status"=>2);
			$where=" invoice_no='$val'";
			$this->update_tbl($update_arr,"amount_detail",$where);
			$this->update_tbl($update_arr,"purchase_detail",$where);
		}
		header("Location:admin_main.php?page_number=21&update=1&msg=Orders Confirm Successfullt");
	}
	
	function _Payment_Methods()
	{
		//echo "<pre>"; print_r($_POST);
		foreach($_POST as $key=>$val)
		{	
			if($key=='id' && $val!='')
			{
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=$val;
			}	
		}
		if($_POST['id']!='')
		{
			$this->update_tbl($update_arr,"payment_methods",$where);
		}
		else
		{
			$this->insert_tbl($update_arr,"payment_methods");
		}
		header("Location:admin_main.php?page_number=39&update=1&msg=Update Payment Methods");
	}
	
	function _get_payment_type($type=false)
	{
		if($type){ $selected="selected";} else{$selected="";}
		echo "<option value='paypal' ".$selected.">Paypal</option>";
	}
	function _get_payment_status($type=false)
	{
		if($type){ $selected="selected";} else{$selected="";}
		echo "<option value='0' ".$selected.">Active</option>
		<option value='1' ".$selected.">Inactive</option>
		";
	}
	function _get_payment_mode($type=false)
	{
		if($type=='live'){ $selected1="selected";} else{$selected1="";}
		if($type=='test'){ $selected2="selected";} else{$selected2="";}
		echo "<option value='live' ".$selected1.">Live</option>
		<option value='test' ".$selected2.">Test</option>
		";
	}
	function _get_wallet_type($type=false)
	{
		$arr=array("final_e_wallet"=>"Cash Wallet","final_tp"=>"TP Wallet","final_tfs"=>"TFS Wallet");
		foreach($arr as $key=>$val)
		{
		if($type==$key){ $selected="selected";} else{$selected="";}
		echo "<option value='".$key."' ".$selected.">".$val."</option>";
		/*echo "<option value='final_e_wallet' ".$selected.">Cash Wallet</option>
		<option value='final_tp' ".$selected.">TP Wallet</option>
		<option value='final_tfs' ".$selected.">TFS Wallet</option>
		";*/
		}
	}
	function _CMS_Home_Reg()
	{
		$table_name=TABLE_PREFIX.'cms_registration';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['n_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=151&update=1&msg=".$msg);
	}
	function CMS_Home_Comp()
	{
		$table_name=TABLE_PREFIX.'cms_compansation';
		$flag=false;
		foreach($_POST as $key=>$val)
		{
			if($key=='id')
			{
				$flag=true;
				$where="id='$val'";
			}
			else
			{
				$update_arr[$key]=stripslashes($val);
			}
		}
		if($flag)
		{
			//echo "<pre>"; print_r($update_arr); echo $where;exit;
			
			$this->update_tbl($update_arr,$table_name,$where);
		}
		else
		{
			//$update_arr['n_date']=date('Y-m-d');
			$this->insert_tbl($update_arr,$table_name);
		}
		// upload image of the product with proper validation
		// check image is already available or not
		header("Location:admin_main.php?page_number=175&update=1&msg=".$msg);
	}
	function _Verify_Adds()
	{
		global $host_name;
		//echo "<pre>"; print_r($_POST);
		// check publishidhing link is valid or not
		// check user is valid or not
		$res_user=$this->query("*","registration","user_name='$_POST[user_id]' or user_id='$_POST[user_id]'");
		$count_user=$this->num_row($res_user);
		if($count_user)
		{
			$row_user=$this->get_all_row($res_user);
			$user_id=$row_user['user_id'];
			$flag_publish=$this->_Check_Url_Valid($_POST['publishing_site']);
			$flag_adds=$this->_Check_Url_Valid($_POST['ad_link']);
			$flag_compar=$this->compare_host($_POST['publishing_site'], $_POST['ad_link']);
			if($flag_publish)
			{
				if($flag_adds)
				{
					if($flag_compar)
					{
						// update the add as verify add
						$weekly_adds_id=$_POST['weekly_adds_id'];
						$publishing_site=$_POST['publishing_site'];
						$adds_link=$_POST['ad_link'];
						//$user_id=showuserid($_SESSION['SD_User_Name']);
						$add_date=date('Y-m-d');
						$sql_adds="select * from weekly_adds_mp where user_id='$user_id' and status=0 and id='$weekly_adds_id'";
						$res_adds=mysql_query($sql_adds);
						$row_adds=mysql_fetch_assoc($res_adds);
						$weekly_adds_link=$host_name."/product-detail.php?pid=".$row_adds['product_id'];
						$add_count=$row_adds['add_count'];
						mysql_query("insert into weekly_adds_verify set add_by='$user_id',weekly_adds_id='$weekly_adds_id',publishing_site='$publishing_site',adds_link='$adds_link',add_date='$add_date',weekly_adds_link='$weekly_adds_link',add_count='$add_count'");
						mysql_query("update weekly_adds_mp set status=1,modify_date='$add_date' where id='$weekly_adds_id'");
						
						echo "<script>alert('Adds Verify and Save Successfully.');window.location.href='admin_main.php?page_number=152';</script>";
					}
					else
					{
						echo "<script>alert('Adds not from this site.');window.location.href='admin_main.php?page_number=152';</script>";
					}
				}
				else
				{
					echo "<script>alert('Wrong Add Link.');window.location.href='admin_main.php?page_number=152';</script>";
				}
			}
			else
			{
				echo "<script>alert('Wrong Pulishing Site.');window.location.href='admin_main.php?page_number=152';</script>";
			}
		}
		else
		{
			echo "<script>alert('Wrong User.');window.location.href='admin_main.php?page_number=152';</script>";
		}
	}
	function _Check_Url_Valid($url)
	{
		$file=$url;
		$file_headers=@get_headers($file);
		//echo "<pre>"; print_r($file_headers);
		if($file_headers[0] == 'HTTP/1.1 404 Not Found')
		{
			$exists = false;
			//echo "No";
		}
		else
		{
			$exists = true;
			//echo "Yes";
		}
	return $exists;
	}
	function compare_host($url1, $url2)
	{
	  // PHP prior of 5.3.3 emits a warning if the URL parsing failed.
	  $info = @parse_url($url1);
	  if (empty($info))
	  {
		return FALSE;
	  }
	//echo "<pre>"; print_r($info);
	  $host1 = $info['path'];
	
	  $info = @parse_url($url2);
	  if (empty($info))
	  {
		return FALSE;
	  }
	//echo "<pre>"; print_r($info);
		$host2=$info['path'];
		$arr=explode("/",$host2);
		$host2=$arr[0];
	//echo $host1.'==========='.$host2;
	  return (strtolower($host1) === strtolower($host2));
	}
}
?>