<?php $country=$_GET['country'];
echo $country;exit();
$con = mysql_connect('localhost', 'root', ''); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('gloress');
$query="SELECT  * from products WHERE category_id='$country'";
$result=mysql_query($query);

?>
<select name="state">
<option>Select Product</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['product_id']?>><?php echo $row['product_name']?></option>
<?php } ?>
</select>
