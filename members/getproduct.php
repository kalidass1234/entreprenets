<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.blogspot.com             ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->

<?php 
$stateId=intval($_GET['product']);

$con = mysql_connect('localhost', 'root', ''); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('gloress');

$query="SELECT * FROM products WHERE category_id='$stateId'";
$result=mysql_query($query);

?>
<select name="product"  onchange="getBV(this.value)" class="validate[required] form-control placeholder" >
<option>Select Product</option>
<?php while($row=mysql_fetch_array($result)) { ?>
<option value="<?php echo $row['product_id'];?>" ><?php echo $row['product_name'];?></option>
<?php } ?>
</select>
