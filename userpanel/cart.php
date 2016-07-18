<?php @session_start();
//echo "<pre>";print_r($_POST); exit; 
include('../includes/all_func.php');
$sql=mysql_query("SELECT * FROM product_category where p_cat_id='$_REQUEST[product_name]'");
				  $res=mysql_fetch_array($sql);
if($res[status]==1){?>
<script type="text/javascript">
alert('This Product Is Sold Out!');
location.href='eshop.php';
</script>
			<?php
			}else{
			
 $product=$_REQUEST['product_name'];
 $quantity=$_REQUEST['quantity'];
  $product_category=$_REQUEST['product_category'];


 global $p,$q,$p_cat;
 //print_r($product);
 $p=$_SESSION['product_name'];
  $q=$_SESSION['quantity'];
  $p_cat=$_SESSION['product_category'];
 
 
//$product_image=$_REQUEST['product_image'];
 //$checkbox=$_REQUEST['product_category'];
  //$pu_price=$_REQUEST['p_u_price'];
 

 if($p)
 {
 $p .=",".$product;
}
else
{
$p =$product;
}

 if($q)
 {
 $q .=",".floor($quantity);
}
else
{
$q =floor($quantity);
}


 if($p_cat)
 {
 $p_cat .=",".$product_category;
}
else
{
$p_cat =$product_category;
}

/* $q = $_SESSION['$quant'];
// $price = $_SESSION['$pri'];
// $p_img = $_SESSION['$pri_img'];
// $p_cat = $_SESSION['$check'];
*/ 

//print $p;
 $_SESSION['product_name']=$p;

//print $q;
 $_SESSION['quantity']=$q;


//print $p_cat;
 //$_SESSION['product_category']=$p_cat;

//session_unset();


?>
<script type="text/javascript">
//alert('Please Enter The Quantity And Single Product Price!');
location.href='eshop_check.php';
</script>
<?php }?>