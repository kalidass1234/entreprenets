<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.blogspot.com             ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->

<?php 
$stateId=intval($_GET['product_id']);

$con = mysql_connect('localhost', 'root', ''); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('gloress');
$query=mysql_fetch_array(mysql_query("SELECT * FROM products WHERE product_id='$stateId'"));
?>


<div class="left-box"> <label for="name"> Product BV </label> <input type="text" name="bv" id="bv" onblur="calculatePricePerUnit()" value="<?php echo $query['points'];?>" class="validate[required] form-control placeholder"/></div>
<div class="left-box"> <label for="name">Product Price  </label></label> <input type="text"  name="price1" id="price1" onblur="calculatePricePerUnit()"  value="<?php echo $query['price'];?>" class="validate[required] form-control placeholder"/></div>
<div class="left-box"> <label for="name">Quantity  </label></label> <input type="text" name="quantity1" id="quantity1" onblur="calculatePricePerUnit()"  value="1" class="validate[required] form-control placeholder"/></div>
<div class="left-box"> <label for="name">Sub Total  </label></label> <input type="text"  name="priceperunit" id="priceperunit" value="<?php echo $query['price'];?> " class="validate[required] form-control placeholder"/></div>

 <script type="text/javascript">
 
	function calculatePricePerUnit ()
	{
		var price = parseFloat(document.getElementById ("price1").value);
		var quantity = parseFloat(document.getElementById ("quantity1").value);
		
		if (!(price == Number.NaN && quantity == Number.NaN))
			document.getElementById ("priceperunit").value = Number(price*quantity);
	}
	
	</script>