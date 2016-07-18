<? session_start();
include('../includes/all_func.php');
  $p=$_SESSION['product_name'];

 $q=$_SESSION['quantity'];
$p_cat=$_SESSION['product_category'];
//$p=str_replace($p,$newp,$p);
/*echo $p;
echo $newp;
*/?>



<?php if($_GET[del]){
$str=$_GET['p_id'];
$keyv=$_GET['keyv'];
if ($p) {
		$items = explode(',',$p);
		//print_r ($items);
			$newp = '';
			foreach ($items as $key => $value) {
				if ($keyv != $key) {
					if ($newp != '') {
						 $newp .= ','.$value;
					} else {
						$newp = $value;
					}
		
					}
				
			}
		unset($p);
	  $p=$newp;
		
		}

if ($p_cat) {
			$items = explode(',',$p_cat);
			$newp_cat = '';
			foreach ($items as $key => $value) {
				if ($keyv != $key) {
					if ($newp_cat != '') {
						$newp_cat .= ','.$value;
					} else {
						$newp_cat = $value;
					}
		
					}
				
			}
			unset($p_cat);
			   $p_cat = $newp_cat;
		}


if ($q) {
			$items = explode(',',$q);
			$new_q = '';
				foreach ($items as $key => $value) {
				if ($keyv != $key) {
					if ($new_q != '') {
						$new_q .= ','.$value;
					} else {
						$new_q = $value;
					}
		
					}
				
			}
			unset($q);
			 $q= $new_q;
		}
		
		
$_SESSION['product_name']=$p;

  $_SESSION['quantity']=$q;

 // $_SESSION['product_category']=$p_cat;



?><script type="text/javascript">
//alert('Please Enter The Quantity And Single Product Price!');
location.href='eshop_check.php';
</script>
<? }?><? //echo $p;?>



<?php if($_GET[edit]){ 

$car=$p;
if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$id = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;
						} else {
							$newcart = $item;
						}
					}
				}
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$id;
					} else {
						$newcart = $id;
					}
				}
			}
		}
	}
	$cart = $newcart;
	


?><script type="text/javascript">
//alert('Please Enter The Quantity And Single Product Price!');
//location.href='eshop_check.php';
</script>
<? }?>